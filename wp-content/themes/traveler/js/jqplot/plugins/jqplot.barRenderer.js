(function($){$.jqplot.BarRenderer=function(){$.jqplot.LineRenderer.call(this)};$.jqplot.BarRenderer.prototype=new $.jqplot.LineRenderer();$.jqplot.BarRenderer.prototype.constructor=$.jqplot.BarRenderer;$.jqplot.BarRenderer.prototype.init=function(options,plot){this.barPadding=8;this.barMargin=10;this.barDirection='vertical';this.barWidth=null;this.shadowOffset=2;this.shadowDepth=5;this.shadowAlpha=0.08;this.waterfall=!1;this.groups=1;this.varyBarColor=!1;this.highlightMouseOver=!0;this.highlightMouseDown=!1;this.highlightColors=[];this.transposedData=!0;this.renderer.animation={show:!1,direction:'down',speed:3000,_supported:!0};this._type='bar';if(options.highlightMouseDown&&options.highlightMouseOver==null){options.highlightMouseOver=!1}
$.extend(!0,this,options);$.extend(!0,this.renderer,options);this.fill=!0;if(this.barDirection==='horizontal'&&this.rendererOptions.animation&&this.rendererOptions.animation.direction==null){this.renderer.animation.direction='left'}
if(this.waterfall){this.fillToZero=!1;this.disableStack=!0}
if(this.barDirection=='vertical'){this._primaryAxis='_xaxis';this._stackAxis='y';this.fillAxis='y'}
else{this._primaryAxis='_yaxis';this._stackAxis='x';this.fillAxis='x'}
this._highlightedPoint=null;this._plotSeriesInfo=null;this._dataColors=[];this._barPoints=[];var opts={lineJoin:'miter',lineCap:'round',fill:!0,isarc:!1,strokeStyle:this.color,fillStyle:this.color,closePath:this.fill};this.renderer.shapeRenderer.init(opts);var sopts={lineJoin:'miter',lineCap:'round',fill:!0,isarc:!1,angle:this.shadowAngle,offset:this.shadowOffset,alpha:this.shadowAlpha,depth:this.shadowDepth,closePath:this.fill};this.renderer.shadowRenderer.init(sopts);plot.postInitHooks.addOnce(postInit);plot.postDrawHooks.addOnce(postPlotDraw);plot.eventListenerHooks.addOnce('jqplotMouseMove',handleMove);plot.eventListenerHooks.addOnce('jqplotMouseDown',handleMouseDown);plot.eventListenerHooks.addOnce('jqplotMouseUp',handleMouseUp);plot.eventListenerHooks.addOnce('jqplotClick',handleClick);plot.eventListenerHooks.addOnce('jqplotRightClick',handleRightClick)};function barPreInit(target,data,seriesDefaults,options){if(this.rendererOptions.barDirection=='horizontal'){this._stackAxis='x';this._primaryAxis='_yaxis'}
if(this.rendererOptions.waterfall==!0){this._data=$.extend(!0,[],this.data);var sum=0;var pos=(!this.rendererOptions.barDirection||this.rendererOptions.barDirection==='vertical'||this.transposedData===!1)?1:0;for(var i=0;i<this.data.length;i++){sum+=this.data[i][pos];if(i>0){this.data[i][pos]+=this.data[i-1][pos]}}
this.data[this.data.length]=(pos==1)?[this.data.length+1,sum]:[sum,this.data.length+1];this._data[this._data.length]=(pos==1)?[this._data.length+1,sum]:[sum,this._data.length+1]}
if(this.rendererOptions.groups>1){this.breakOnNull=!0;var l=this.data.length;var skip=parseInt(l/this.rendererOptions.groups,10);var count=0;for(var i=skip;i<l;i+=skip){this.data.splice(i+count,0,[null,null]);this._plotData.splice(i+count,0,[null,null]);this._stackData.splice(i+count,0,[null,null]);count++}
for(i=0;i<this.data.length;i++){if(this._primaryAxis=='_xaxis'){this.data[i][0]=i+1;this._plotData[i][0]=i+1;this._stackData[i][0]=i+1}
else{this.data[i][1]=i+1;this._plotData[i][1]=i+1;this._stackData[i][1]=i+1}}}}
$.jqplot.preSeriesInitHooks.push(barPreInit);$.jqplot.BarRenderer.prototype.calcSeriesNumbers=function(){var nvals=0;var nseries=0;var paxis=this[this._primaryAxis];var s,series,pos;for(var i=0;i<paxis._series.length;i++){series=paxis._series[i];if(series===this){pos=i}
if(series.renderer.constructor==$.jqplot.BarRenderer){nvals+=series.data.length;nseries+=1}}
return[nvals,nseries,pos]};$.jqplot.BarRenderer.prototype.setBarWidth=function(){var i;var nvals=0;var nseries=0;var paxis=this[this._primaryAxis];var s,series,pos;var temp=this._plotSeriesInfo=this.renderer.calcSeriesNumbers.call(this);nvals=temp[0];nseries=temp[1];var nticks=paxis.numberTicks;var nbins=(nticks-1)/2;if(paxis.name=='xaxis'||paxis.name=='x2axis'){if(this._stack){this.barWidth=(paxis._offsets.max-paxis._offsets.min)/nvals*nseries-this.barMargin}
else{this.barWidth=((paxis._offsets.max-paxis._offsets.min)/nbins-this.barPadding*(nseries-1)-this.barMargin*2)/nseries}}
else{if(this._stack){this.barWidth=(paxis._offsets.min-paxis._offsets.max)/nvals*nseries-this.barMargin}
else{this.barWidth=((paxis._offsets.min-paxis._offsets.max)/nbins-this.barPadding*(nseries-1)-this.barMargin*2)/nseries}}
return[nvals,nseries]};function computeHighlightColors(colors){var ret=[];for(var i=0;i<colors.length;i++){var rgba=$.jqplot.getColorComponents(colors[i]);var newrgb=[rgba[0],rgba[1],rgba[2]];var sum=newrgb[0]+newrgb[1]+newrgb[2];for(var j=0;j<3;j++){newrgb[j]=(sum>570)?newrgb[j]*0.8:newrgb[j]+0.3*(255-newrgb[j]);newrgb[j]=parseInt(newrgb[j],10)}
ret.push('rgb('+newrgb[0]+','+newrgb[1]+','+newrgb[2]+')')}
return ret}
function getStart(sidx,didx,comp,plot,axis){var seriesIndex=sidx,prevSeriesIndex=sidx-1,start,prevVal,aidx=(axis==='x')?0:1;if(seriesIndex>0){prevVal=plot.series[prevSeriesIndex]._plotData[didx][aidx];if((comp*prevVal)<0){start=getStart(prevSeriesIndex,didx,comp,plot,axis)}
else{start=plot.series[prevSeriesIndex].gridData[didx][aidx]}}
else{start=(aidx===0)?plot.series[seriesIndex]._xaxis.series_u2p(0):plot.series[seriesIndex]._yaxis.series_u2p(0)}
return start}
$.jqplot.BarRenderer.prototype.draw=function(ctx,gridData,options,plot){var i;var opts=$.extend({},options);var shadow=(opts.shadow!=undefined)?opts.shadow:this.shadow;var showLine=(opts.showLine!=undefined)?opts.showLine:this.showLine;var fill=(opts.fill!=undefined)?opts.fill:this.fill;var xaxis=this.xaxis;var yaxis=this.yaxis;var xp=this._xaxis.series_u2p;var yp=this._yaxis.series_u2p;var pointx,pointy;this._dataColors=[];this._barPoints=[];if(this.barWidth==null){this.renderer.setBarWidth.call(this)}
var temp=this._plotSeriesInfo=this.renderer.calcSeriesNumbers.call(this);var nvals=temp[0];var nseries=temp[1];var pos=temp[2];var points=[];if(this._stack){this._barNudge=0}
else{this._barNudge=(-Math.abs(nseries/2-0.5)+pos)*(this.barWidth+this.barPadding)}
if(showLine){var negativeColors=new $.jqplot.ColorGenerator(this.negativeSeriesColors);var positiveColors=new $.jqplot.ColorGenerator(this.seriesColors);var negativeColor=negativeColors.get(this.index);if(!this.useNegativeColors){negativeColor=opts.fillStyle}
var positiveColor=opts.fillStyle;var base;var xstart;var ystart;if(this.barDirection=='vertical'){for(var i=0;i<gridData.length;i++){if(!this._stack&&this.data[i][1]==null){continue}
points=[];base=gridData[i][0]+this._barNudge;if(this._stack&&this._prevGridData.length){ystart=getStart(this.index,i,this._plotData[i][1],plot,'y')}
else{if(this.fillToZero){ystart=this._yaxis.series_u2p(0)}
else if(this.waterfall&&i>0&&i<this.gridData.length-1){ystart=this.gridData[i-1][1]}
else if(this.waterfall&&i==0&&i<this.gridData.length-1){if(this._yaxis.min<=0&&this._yaxis.max>=0){ystart=this._yaxis.series_u2p(0)}
else if(this._yaxis.min>0){ystart=ctx.canvas.height}
else{ystart=0}}
else if(this.waterfall&&i==this.gridData.length-1){if(this._yaxis.min<=0&&this._yaxis.max>=0){ystart=this._yaxis.series_u2p(0)}
else if(this._yaxis.min>0){ystart=ctx.canvas.height}
else{ystart=0}}
else{ystart=ctx.canvas.height}}
if((this.fillToZero&&this._plotData[i][1]<0)||(this.waterfall&&this._data[i][1]<0)){if(this.varyBarColor&&!this._stack){if(this.useNegativeColors){opts.fillStyle=negativeColors.next()}
else{opts.fillStyle=positiveColors.next()}}
else{opts.fillStyle=negativeColor}}
else{if(this.varyBarColor&&!this._stack){opts.fillStyle=positiveColors.next()}
else{opts.fillStyle=positiveColor}}
if(!this.fillToZero||this._plotData[i][1]>=0){points.push([base-this.barWidth/2,ystart]);points.push([base-this.barWidth/2,gridData[i][1]]);points.push([base+this.barWidth/2,gridData[i][1]]);points.push([base+this.barWidth/2,ystart])}
else{points.push([base-this.barWidth/2,gridData[i][1]]);points.push([base-this.barWidth/2,ystart]);points.push([base+this.barWidth/2,ystart]);points.push([base+this.barWidth/2,gridData[i][1]])}
this._barPoints.push(points);if(shadow&&!this._stack){var sopts=$.extend(!0,{},opts);delete sopts.fillStyle;this.renderer.shadowRenderer.draw(ctx,points,sopts)}
var clr=opts.fillStyle||this.color;this._dataColors.push(clr);this.renderer.shapeRenderer.draw(ctx,points,opts)}}
else if(this.barDirection=='horizontal'){for(var i=0;i<gridData.length;i++){if(!this._stack&&this.data[i][0]==null){continue}
points=[];base=gridData[i][1]-this._barNudge;xstart;if(this._stack&&this._prevGridData.length){xstart=getStart(this.index,i,this._plotData[i][0],plot,'x')}
else{if(this.fillToZero){xstart=this._xaxis.series_u2p(0)}
else if(this.waterfall&&i>0&&i<this.gridData.length-1){xstart=this.gridData[i-1][0]}
else if(this.waterfall&&i==0&&i<this.gridData.length-1){if(this._xaxis.min<=0&&this._xaxis.max>=0){xstart=this._xaxis.series_u2p(0)}
else if(this._xaxis.min>0){xstart=0}
else{xstart=0}}
else if(this.waterfall&&i==this.gridData.length-1){if(this._xaxis.min<=0&&this._xaxis.max>=0){xstart=this._xaxis.series_u2p(0)}
else if(this._xaxis.min>0){xstart=0}
else{xstart=ctx.canvas.width}}
else{xstart=0}}
if((this.fillToZero&&this._plotData[i][0]<0)||(this.waterfall&&this._data[i][0]<0)){if(this.varyBarColor&&!this._stack){if(this.useNegativeColors){opts.fillStyle=negativeColors.next()}
else{opts.fillStyle=positiveColors.next()}}
else{opts.fillStyle=negativeColor}}
else{if(this.varyBarColor&&!this._stack){opts.fillStyle=positiveColors.next()}
else{opts.fillStyle=positiveColor}}
if(!this.fillToZero||this._plotData[i][0]>=0){points.push([xstart,base+this.barWidth/2]);points.push([xstart,base-this.barWidth/2]);points.push([gridData[i][0],base-this.barWidth/2]);points.push([gridData[i][0],base+this.barWidth/2])}
else{points.push([gridData[i][0],base+this.barWidth/2]);points.push([gridData[i][0],base-this.barWidth/2]);points.push([xstart,base-this.barWidth/2]);points.push([xstart,base+this.barWidth/2])}
this._barPoints.push(points);if(shadow&&!this._stack){var sopts=$.extend(!0,{},opts);delete sopts.fillStyle;this.renderer.shadowRenderer.draw(ctx,points,sopts)}
var clr=opts.fillStyle||this.color;this._dataColors.push(clr);this.renderer.shapeRenderer.draw(ctx,points,opts)}}}
if(this.highlightColors.length==0){this.highlightColors=$.jqplot.computeHighlightColors(this._dataColors)}
else if(typeof(this.highlightColors)=='string'){var temp=this.highlightColors;this.highlightColors=[];for(var i=0;i<this._dataColors.length;i++){this.highlightColors.push(temp)}}};$.jqplot.BarRenderer.prototype.drawShadow=function(ctx,gridData,options,plot){var i;var opts=(options!=undefined)?options:{};var shadow=(opts.shadow!=undefined)?opts.shadow:this.shadow;var showLine=(opts.showLine!=undefined)?opts.showLine:this.showLine;var fill=(opts.fill!=undefined)?opts.fill:this.fill;var xaxis=this.xaxis;var yaxis=this.yaxis;var xp=this._xaxis.series_u2p;var yp=this._yaxis.series_u2p;var pointx,points,pointy,nvals,nseries,pos;if(this._stack&&this.shadow){if(this.barWidth==null){this.renderer.setBarWidth.call(this)}
var temp=this._plotSeriesInfo=this.renderer.calcSeriesNumbers.call(this);nvals=temp[0];nseries=temp[1];pos=temp[2];if(this._stack){this._barNudge=0}
else{this._barNudge=(-Math.abs(nseries/2-0.5)+pos)*(this.barWidth+this.barPadding)}
if(showLine){if(this.barDirection=='vertical'){for(var i=0;i<gridData.length;i++){if(this.data[i][1]==null){continue}
points=[];var base=gridData[i][0]+this._barNudge;var ystart;if(this._stack&&this._prevGridData.length){ystart=getStart(this.index,i,this._plotData[i][1],plot,'y')}
else{if(this.fillToZero){ystart=this._yaxis.series_u2p(0)}
else{ystart=ctx.canvas.height}}
points.push([base-this.barWidth/2,ystart]);points.push([base-this.barWidth/2,gridData[i][1]]);points.push([base+this.barWidth/2,gridData[i][1]]);points.push([base+this.barWidth/2,ystart]);this.renderer.shadowRenderer.draw(ctx,points,opts)}}
else if(this.barDirection=='horizontal'){for(var i=0;i<gridData.length;i++){if(this.data[i][0]==null){continue}
points=[];var base=gridData[i][1]-this._barNudge;var xstart;if(this._stack&&this._prevGridData.length){xstart=getStart(this.index,i,this._plotData[i][0],plot,'x')}
else{if(this.fillToZero){xstart=this._xaxis.series_u2p(0)}
else{xstart=0}}
points.push([xstart,base+this.barWidth/2]);points.push([gridData[i][0],base+this.barWidth/2]);points.push([gridData[i][0],base-this.barWidth/2]);points.push([xstart,base-this.barWidth/2]);this.renderer.shadowRenderer.draw(ctx,points,opts)}}}}};function postInit(target,data,options){for(var i=0;i<this.series.length;i++){if(this.series[i].renderer.constructor==$.jqplot.BarRenderer){if(this.series[i].highlightMouseOver){this.series[i].highlightMouseDown=!1}}}}
function postPlotDraw(){if(this.plugins.barRenderer&&this.plugins.barRenderer.highlightCanvas){this.plugins.barRenderer.highlightCanvas.resetCanvas();this.plugins.barRenderer.highlightCanvas=null}
this.plugins.barRenderer={highlightedSeriesIndex:null};this.plugins.barRenderer.highlightCanvas=new $.jqplot.GenericCanvas();this.eventCanvas._elem.before(this.plugins.barRenderer.highlightCanvas.createElement(this._gridPadding,'jqplot-barRenderer-highlight-canvas',this._plotDimensions,this));this.plugins.barRenderer.highlightCanvas.setContext();this.eventCanvas._elem.bind('mouseleave',{plot:this},function(ev){unhighlight(ev.data.plot)})}
function highlight(plot,sidx,pidx,points){var s=plot.series[sidx];var canvas=plot.plugins.barRenderer.highlightCanvas;canvas._ctx.clearRect(0,0,canvas._ctx.canvas.width,canvas._ctx.canvas.height);s._highlightedPoint=pidx;plot.plugins.barRenderer.highlightedSeriesIndex=sidx;var opts={fillStyle:s.highlightColors[pidx]};s.renderer.shapeRenderer.draw(canvas._ctx,points,opts);canvas=null}
function unhighlight(plot){var canvas=plot.plugins.barRenderer.highlightCanvas;canvas._ctx.clearRect(0,0,canvas._ctx.canvas.width,canvas._ctx.canvas.height);for(var i=0;i<plot.series.length;i++){plot.series[i]._highlightedPoint=null}
plot.plugins.barRenderer.highlightedSeriesIndex=null;plot.target.trigger('jqplotDataUnhighlight');canvas=null}
function handleMove(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];var evt1=jQuery.Event('jqplotDataMouseOver');evt1.pageX=ev.pageX;evt1.pageY=ev.pageY;plot.target.trigger(evt1,ins);if(plot.series[ins[0]].show&&plot.series[ins[0]].highlightMouseOver&&!(ins[0]==plot.plugins.barRenderer.highlightedSeriesIndex&&ins[1]==plot.series[ins[0]]._highlightedPoint)){var evt=jQuery.Event('jqplotDataHighlight');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins);highlight(plot,neighbor.seriesIndex,neighbor.pointIndex,neighbor.points)}}
else if(neighbor==null){unhighlight(plot)}}
function handleMouseDown(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];if(plot.series[ins[0]].highlightMouseDown&&!(ins[0]==plot.plugins.barRenderer.highlightedSeriesIndex&&ins[1]==plot.series[ins[0]]._highlightedPoint)){var evt=jQuery.Event('jqplotDataHighlight');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins);highlight(plot,neighbor.seriesIndex,neighbor.pointIndex,neighbor.points)}}
else if(neighbor==null){unhighlight(plot)}}
function handleMouseUp(ev,gridpos,datapos,neighbor,plot){var idx=plot.plugins.barRenderer.highlightedSeriesIndex;if(idx!=null&&plot.series[idx].highlightMouseDown){unhighlight(plot)}}
function handleClick(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];var evt=jQuery.Event('jqplotDataClick');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins)}}
function handleRightClick(ev,gridpos,datapos,neighbor,plot){if(neighbor){var ins=[neighbor.seriesIndex,neighbor.pointIndex,neighbor.data];var idx=plot.plugins.barRenderer.highlightedSeriesIndex;if(idx!=null&&plot.series[idx].highlightMouseDown){unhighlight(plot)}
var evt=jQuery.Event('jqplotDataRightClick');evt.which=ev.which;evt.pageX=ev.pageX;evt.pageY=ev.pageY;plot.target.trigger(evt,ins)}}})(jQuery)