(function($){$.jqplot.Cursor=function(options){this.style='crosshair';this.previousCursor='auto';this.show=$.jqplot.config.enablePlugins;this.showTooltip=!0;this.followMouse=!1;this.tooltipLocation='se';this.tooltipOffset=6;this.showTooltipGridPosition=!1;this.showTooltipUnitPosition=!0;this.showTooltipDataPosition=!1;this.tooltipFormatString='%.4P, %.4P';this.useAxesFormatters=!0;this.tooltipAxisGroups=[];this.zoom=!1;this.zoomProxy=!1;this.zoomTarget=!1;this.looseZoom=!0;this.clickReset=!1;this.dblClickReset=!0;this.showVerticalLine=!1;this.showHorizontalLine=!1;this.constrainZoomTo='none';this.shapeRenderer=new $.jqplot.ShapeRenderer();this._zoom={start:[],end:[],started:!1,zooming:!1,isZoomed:!1,axes:{start:{},end:{}},gridpos:{},datapos:{}};this._tooltipElem;this.zoomCanvas;this.cursorCanvas;this.intersectionThreshold=2;this.showCursorLegend=!1;this.cursorLegendFormatString=$.jqplot.Cursor.cursorLegendFormatString;this._oldHandlers={onselectstart:null,ondrag:null,onmousedown:null};this.constrainOutsideZoom=!0;this.showTooltipOutsideZoom=!1;this.onGrid=!1;$.extend(!0,this,options)};$.jqplot.Cursor.cursorLegendFormatString='%s x:%s, y:%s';$.jqplot.Cursor.init=function(target,data,opts){var options=opts||{};this.plugins.cursor=new $.jqplot.Cursor(options.cursor);var c=this.plugins.cursor;if(c.show){$.jqplot.eventListenerHooks.push(['jqplotMouseEnter',handleMouseEnter]);$.jqplot.eventListenerHooks.push(['jqplotMouseLeave',handleMouseLeave]);$.jqplot.eventListenerHooks.push(['jqplotMouseMove',handleMouseMove]);if(c.showCursorLegend){opts.legend=opts.legend||{};opts.legend.renderer=$.jqplot.CursorLegendRenderer;opts.legend.formatString=this.plugins.cursor.cursorLegendFormatString;opts.legend.show=!0}
if(c.zoom){$.jqplot.eventListenerHooks.push(['jqplotMouseDown',handleMouseDown]);if(c.clickReset){$.jqplot.eventListenerHooks.push(['jqplotClick',handleClick])}
if(c.dblClickReset){$.jqplot.eventListenerHooks.push(['jqplotDblClick',handleDblClick])}}
this.resetZoom=function(){var axes=this.axes;if(!c.zoomProxy){for(var ax in axes){axes[ax].reset();axes[ax]._ticks=[];if(c._zoom.axes[ax]!==undefined){axes[ax]._autoFormatString=c._zoom.axes[ax].tickFormatString}}
this.redraw()}
else{var ctx=this.plugins.cursor.zoomCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);ctx=null}
this.plugins.cursor._zoom.isZoomed=!1;this.target.trigger('jqplotResetZoom',[this,this.plugins.cursor])};if(c.showTooltipDataPosition){c.showTooltipUnitPosition=!1;c.showTooltipGridPosition=!1;if(options.cursor.tooltipFormatString==undefined){c.tooltipFormatString=$.jqplot.Cursor.cursorLegendFormatString}}}};$.jqplot.Cursor.postDraw=function(){var c=this.plugins.cursor;if(c.zoomCanvas){c.zoomCanvas.resetCanvas();c.zoomCanvas=null}
if(c.cursorCanvas){c.cursorCanvas.resetCanvas();c.cursorCanvas=null}
if(c._tooltipElem){c._tooltipElem.emptyForce();c._tooltipElem=null}
if(c.zoom){c.zoomCanvas=new $.jqplot.GenericCanvas();this.eventCanvas._elem.before(c.zoomCanvas.createElement(this._gridPadding,'jqplot-zoom-canvas',this._plotDimensions,this));c.zoomCanvas.setContext()}
var elem=document.createElement('div');c._tooltipElem=$(elem);elem=null;c._tooltipElem.addClass('jqplot-cursor-tooltip');c._tooltipElem.css({position:'absolute',display:'none'});if(c.zoomCanvas){c.zoomCanvas._elem.before(c._tooltipElem)}
else{this.eventCanvas._elem.before(c._tooltipElem)}
if(c.showVerticalLine||c.showHorizontalLine){c.cursorCanvas=new $.jqplot.GenericCanvas();this.eventCanvas._elem.before(c.cursorCanvas.createElement(this._gridPadding,'jqplot-cursor-canvas',this._plotDimensions,this));c.cursorCanvas.setContext()}
if(c.showTooltipUnitPosition){if(c.tooltipAxisGroups.length===0){var series=this.series;var s;var temp=[];for(var i=0;i<series.length;i++){s=series[i];var ax=s.xaxis+','+s.yaxis;if($.inArray(ax,temp)==-1){temp.push(ax)}}
for(var i=0;i<temp.length;i++){c.tooltipAxisGroups.push(temp[i].split(','))}}}};$.jqplot.Cursor.zoomProxy=function(targetPlot,controllerPlot){var tc=targetPlot.plugins.cursor;var cc=controllerPlot.plugins.cursor;tc.zoomTarget=!0;tc.zoom=!0;tc.style='auto';tc.dblClickReset=!1;cc.zoom=!0;cc.zoomProxy=!0;controllerPlot.target.bind('jqplotZoom',plotZoom);controllerPlot.target.bind('jqplotResetZoom',plotReset);function plotZoom(ev,gridpos,datapos,plot,cursor){tc.doZoom(gridpos,datapos,targetPlot,cursor)}
function plotReset(ev,plot,cursor){targetPlot.resetZoom()}};$.jqplot.Cursor.prototype.resetZoom=function(plot,cursor){var axes=plot.axes;var cax=cursor._zoom.axes;if(!plot.plugins.cursor.zoomProxy&&cursor._zoom.isZoomed){for(var ax in axes){axes[ax].reset();axes[ax]._ticks=[];axes[ax]._autoFormatString=cax[ax].tickFormatString}
plot.redraw();cursor._zoom.isZoomed=!1}
else{var ctx=cursor.zoomCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);ctx=null}
plot.target.trigger('jqplotResetZoom',[plot,cursor])};$.jqplot.Cursor.resetZoom=function(plot){plot.resetZoom()};$.jqplot.Cursor.prototype.doZoom=function(gridpos,datapos,plot,cursor){var c=cursor;var axes=plot.axes;var zaxes=c._zoom.axes;var start=zaxes.start;var end=zaxes.end;var min,max,dp,span,newmin,newmax,curax,_numberTicks,ret;var ctx=plot.plugins.cursor.zoomCanvas._ctx;if((c.constrainZoomTo=='none'&&Math.abs(gridpos.x-c._zoom.start[0])>6&&Math.abs(gridpos.y-c._zoom.start[1])>6)||(c.constrainZoomTo=='x'&&Math.abs(gridpos.x-c._zoom.start[0])>6)||(c.constrainZoomTo=='y'&&Math.abs(gridpos.y-c._zoom.start[1])>6)){if(!plot.plugins.cursor.zoomProxy){for(var ax in datapos){if(c._zoom.axes[ax]==undefined){c._zoom.axes[ax]={};c._zoom.axes[ax].numberTicks=axes[ax].numberTicks;c._zoom.axes[ax].tickInterval=axes[ax].tickInterval;c._zoom.axes[ax].daTickInterval=axes[ax].daTickInterval;c._zoom.axes[ax].min=axes[ax].min;c._zoom.axes[ax].max=axes[ax].max;c._zoom.axes[ax].tickFormatString=(axes[ax].tickOptions!=null)?axes[ax].tickOptions.formatString:''}
if((c.constrainZoomTo=='none')||(c.constrainZoomTo=='x'&&ax.charAt(0)=='x')||(c.constrainZoomTo=='y'&&ax.charAt(0)=='y')){dp=datapos[ax];if(dp!=null){if(dp>start[ax]){newmin=start[ax];newmax=dp}
else{span=start[ax]-dp;newmin=dp;newmax=start[ax]}
curax=axes[ax];_numberTicks=null;if(curax.alignTicks){if(curax.name==='x2axis'&&plot.axes.xaxis.show){_numberTicks=plot.axes.xaxis.numberTicks}
else if(curax.name.charAt(0)==='y'&&curax.name!=='yaxis'&&curax.name!=='yMidAxis'&&plot.axes.yaxis.show){_numberTicks=plot.axes.yaxis.numberTicks}}
if(this.looseZoom&&(axes[ax].renderer.constructor===$.jqplot.LinearAxisRenderer||axes[ax].renderer.constructor===$.jqplot.LogAxisRenderer)){ret=$.jqplot.LinearTickGenerator(newmin,newmax,curax._scalefact,_numberTicks);if(axes[ax].tickInset&&ret[0]<axes[ax].min+axes[ax].tickInset*axes[ax].tickInterval){ret[0]+=ret[4];ret[2]-=1}
if(axes[ax].tickInset&&ret[1]>axes[ax].max-axes[ax].tickInset*axes[ax].tickInterval){ret[1]-=ret[4];ret[2]-=1}
if(axes[ax].renderer.constructor===$.jqplot.LogAxisRenderer&&ret[0]<axes[ax].min){ret[0]+=ret[4];ret[2]-=1}
axes[ax].min=ret[0];axes[ax].max=ret[1];axes[ax]._autoFormatString=ret[3];axes[ax].numberTicks=ret[2];axes[ax].tickInterval=ret[4];axes[ax].daTickInterval=[ret[4]/1000,'seconds']}
else{axes[ax].min=newmin;axes[ax].max=newmax;axes[ax].tickInterval=null;axes[ax].numberTicks=null;axes[ax].daTickInterval=null}
axes[ax]._ticks=[]}}}
ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);plot.redraw();c._zoom.isZoomed=!0;ctx=null}
plot.target.trigger('jqplotZoom',[gridpos,datapos,plot,cursor])}};$.jqplot.preInitHooks.push($.jqplot.Cursor.init);$.jqplot.postDrawHooks.push($.jqplot.Cursor.postDraw);function updateTooltip(gridpos,datapos,plot){var c=plot.plugins.cursor;var s='';var addbr=!1;if(c.showTooltipGridPosition){s=gridpos.x+', '+gridpos.y;addbr=!0}
if(c.showTooltipUnitPosition){var g;for(var i=0;i<c.tooltipAxisGroups.length;i++){g=c.tooltipAxisGroups[i];if(addbr){s+='<br />'}
if(c.useAxesFormatters){for(var j=0;j<g.length;j++){if(j){s+=', '}
var af=plot.axes[g[j]]._ticks[0].formatter;var afstr=plot.axes[g[j]]._ticks[0].formatString;s+=af(afstr,datapos[g[j]])}}
else{s+=$.jqplot.sprintf(c.tooltipFormatString,datapos[g[0]],datapos[g[1]])}
addbr=!0}}
if(c.showTooltipDataPosition){var series=plot.series;var ret=getIntersectingPoints(plot,gridpos.x,gridpos.y);var addbr=!1;for(var i=0;i<series.length;i++){if(series[i].show){var idx=series[i].index;var label=series[i].label.toString();var cellid=$.inArray(idx,ret.indices);var sx=undefined;var sy=undefined;if(cellid!=-1){var data=ret.data[cellid].data;if(c.useAxesFormatters){var xf=series[i]._xaxis._ticks[0].formatter;var yf=series[i]._yaxis._ticks[0].formatter;var xfstr=series[i]._xaxis._ticks[0].formatString;var yfstr=series[i]._yaxis._ticks[0].formatString;sx=xf(xfstr,data[0]);sy=yf(yfstr,data[1])}
else{sx=data[0];sy=data[1]}
if(addbr){s+='<br />'}
s+=$.jqplot.sprintf(c.tooltipFormatString,label,sx,sy);addbr=!0}}}}
c._tooltipElem.html(s)}
function moveLine(gridpos,plot){var c=plot.plugins.cursor;var ctx=c.cursorCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);if(c.showVerticalLine){c.shapeRenderer.draw(ctx,[[gridpos.x,0],[gridpos.x,ctx.canvas.height]])}
if(c.showHorizontalLine){c.shapeRenderer.draw(ctx,[[0,gridpos.y],[ctx.canvas.width,gridpos.y]])}
var ret=getIntersectingPoints(plot,gridpos.x,gridpos.y);if(c.showCursorLegend){var cells=$(plot.targetId+' td.jqplot-cursor-legend-label');for(var i=0;i<cells.length;i++){var idx=$(cells[i]).data('seriesIndex');var series=plot.series[idx];var label=series.label.toString();var cellid=$.inArray(idx,ret.indices);var sx=undefined;var sy=undefined;if(cellid!=-1){var data=ret.data[cellid].data;if(c.useAxesFormatters){var xf=series._xaxis._ticks[0].formatter;var yf=series._yaxis._ticks[0].formatter;var xfstr=series._xaxis._ticks[0].formatString;var yfstr=series._yaxis._ticks[0].formatString;sx=xf(xfstr,data[0]);sy=yf(yfstr,data[1])}
else{sx=data[0];sy=data[1]}}
if(plot.legend.escapeHtml){$(cells[i]).text($.jqplot.sprintf(c.cursorLegendFormatString,label,sx,sy))}
else{$(cells[i]).html($.jqplot.sprintf(c.cursorLegendFormatString,label,sx,sy))}}}
ctx=null}
function getIntersectingPoints(plot,x,y){var ret={indices:[],data:[]};var s,i,d0,d,j,r,p;var threshold;var c=plot.plugins.cursor;for(var i=0;i<plot.series.length;i++){s=plot.series[i];r=s.renderer;if(s.show){threshold=c.intersectionThreshold;if(s.showMarker){threshold+=s.markerRenderer.size/2}
for(var j=0;j<s.gridData.length;j++){p=s.gridData[j];if(c.showVerticalLine){if(Math.abs(x-p[0])<=threshold){ret.indices.push(i);ret.data.push({seriesIndex:i,pointIndex:j,gridData:p,data:s.data[j]})}}}}}
return ret}
function moveTooltip(gridpos,plot){var c=plot.plugins.cursor;var elem=c._tooltipElem;switch(c.tooltipLocation){case 'nw':var x=gridpos.x+plot._gridPadding.left-elem.outerWidth(!0)-c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top-c.tooltipOffset-elem.outerHeight(!0);break;case 'n':var x=gridpos.x+plot._gridPadding.left-elem.outerWidth(!0)/2;var y=gridpos.y+plot._gridPadding.top-c.tooltipOffset-elem.outerHeight(!0);break;case 'ne':var x=gridpos.x+plot._gridPadding.left+c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top-c.tooltipOffset-elem.outerHeight(!0);break;case 'e':var x=gridpos.x+plot._gridPadding.left+c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top-elem.outerHeight(!0)/2;break;case 'se':var x=gridpos.x+plot._gridPadding.left+c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top+c.tooltipOffset;break;case 's':var x=gridpos.x+plot._gridPadding.left-elem.outerWidth(!0)/2;var y=gridpos.y+plot._gridPadding.top+c.tooltipOffset;break;case 'sw':var x=gridpos.x+plot._gridPadding.left-elem.outerWidth(!0)-c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top+c.tooltipOffset;break;case 'w':var x=gridpos.x+plot._gridPadding.left-elem.outerWidth(!0)-c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top-elem.outerHeight(!0)/2;break;default:var x=gridpos.x+plot._gridPadding.left+c.tooltipOffset;var y=gridpos.y+plot._gridPadding.top+c.tooltipOffset;break}
elem.css('left',x);elem.css('top',y);elem=null}
function positionTooltip(plot){var grid=plot._gridPadding;var c=plot.plugins.cursor;var elem=c._tooltipElem;switch(c.tooltipLocation){case 'nw':var a=grid.left+c.tooltipOffset;var b=grid.top+c.tooltipOffset;elem.css('left',a);elem.css('top',b);break;case 'n':var a=(grid.left+(plot._plotDimensions.width-grid.right))/2-elem.outerWidth(!0)/2;var b=grid.top+c.tooltipOffset;elem.css('left',a);elem.css('top',b);break;case 'ne':var a=grid.right+c.tooltipOffset;var b=grid.top+c.tooltipOffset;elem.css({right:a,top:b});break;case 'e':var a=grid.right+c.tooltipOffset;var b=(grid.top+(plot._plotDimensions.height-grid.bottom))/2-elem.outerHeight(!0)/2;elem.css({right:a,top:b});break;case 'se':var a=grid.right+c.tooltipOffset;var b=grid.bottom+c.tooltipOffset;elem.css({right:a,bottom:b});break;case 's':var a=(grid.left+(plot._plotDimensions.width-grid.right))/2-elem.outerWidth(!0)/2;var b=grid.bottom+c.tooltipOffset;elem.css({left:a,bottom:b});break;case 'sw':var a=grid.left+c.tooltipOffset;var b=grid.bottom+c.tooltipOffset;elem.css({left:a,bottom:b});break;case 'w':var a=grid.left+c.tooltipOffset;var b=(grid.top+(plot._plotDimensions.height-grid.bottom))/2-elem.outerHeight(!0)/2;elem.css({left:a,top:b});break;default:var a=grid.right-c.tooltipOffset;var b=grid.bottom+c.tooltipOffset;elem.css({right:a,bottom:b});break}
elem=null}
function handleClick(ev,gridpos,datapos,neighbor,plot){ev.preventDefault();ev.stopImmediatePropagation();var c=plot.plugins.cursor;if(c.clickReset){c.resetZoom(plot,c)}
var sel=window.getSelection;if(document.selection&&document.selection.empty)
{document.selection.empty()}
else if(sel&&!sel().isCollapsed){sel().collapse()}
return!1}
function handleDblClick(ev,gridpos,datapos,neighbor,plot){ev.preventDefault();ev.stopImmediatePropagation();var c=plot.plugins.cursor;if(c.dblClickReset){c.resetZoom(plot,c)}
var sel=window.getSelection;if(document.selection&&document.selection.empty)
{document.selection.empty()}
else if(sel&&!sel().isCollapsed){sel().collapse()}
return!1}
function handleMouseLeave(ev,gridpos,datapos,neighbor,plot){var c=plot.plugins.cursor;c.onGrid=!1;if(c.show){$(ev.target).css('cursor',c.previousCursor);if(c.showTooltip&&!(c._zoom.zooming&&c.showTooltipOutsideZoom&&!c.constrainOutsideZoom)){c._tooltipElem.empty();c._tooltipElem.hide()}
if(c.zoom){c._zoom.gridpos=gridpos;c._zoom.datapos=datapos}
if(c.showVerticalLine||c.showHorizontalLine){var ctx=c.cursorCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);ctx=null}
if(c.showCursorLegend){var cells=$(plot.targetId+' td.jqplot-cursor-legend-label');for(var i=0;i<cells.length;i++){var idx=$(cells[i]).data('seriesIndex');var series=plot.series[idx];var label=series.label.toString();if(plot.legend.escapeHtml){$(cells[i]).text($.jqplot.sprintf(c.cursorLegendFormatString,label,undefined,undefined))}
else{$(cells[i]).html($.jqplot.sprintf(c.cursorLegendFormatString,label,undefined,undefined))}}}}}
function handleMouseEnter(ev,gridpos,datapos,neighbor,plot){var c=plot.plugins.cursor;c.onGrid=!0;if(c.show){c.previousCursor=ev.target.style.cursor;ev.target.style.cursor=c.style;if(c.showTooltip){updateTooltip(gridpos,datapos,plot);if(c.followMouse){moveTooltip(gridpos,plot)}
else{positionTooltip(plot)}
c._tooltipElem.show()}
if(c.showVerticalLine||c.showHorizontalLine){moveLine(gridpos,plot)}}}
function handleMouseMove(ev,gridpos,datapos,neighbor,plot){var c=plot.plugins.cursor;if(c.show){if(c.showTooltip){updateTooltip(gridpos,datapos,plot);if(c.followMouse){moveTooltip(gridpos,plot)}}
if(c.showVerticalLine||c.showHorizontalLine){moveLine(gridpos,plot)}}}
function getEventPosition(ev){var plot=ev.data.plot;var go=plot.eventCanvas._elem.offset();var gridPos={x:ev.pageX-go.left,y:ev.pageY-go.top};var dataPos={xaxis:null,yaxis:null,x2axis:null,y2axis:null,y3axis:null,y4axis:null,y5axis:null,y6axis:null,y7axis:null,y8axis:null,y9axis:null,yMidAxis:null};var an=['xaxis','yaxis','x2axis','y2axis','y3axis','y4axis','y5axis','y6axis','y7axis','y8axis','y9axis','yMidAxis'];var ax=plot.axes;var n,axis;for(n=11;n>0;n--){axis=an[n-1];if(ax[axis].show){dataPos[axis]=ax[axis].series_p2u(gridPos[axis.charAt(0)])}}
return{offsets:go,gridPos:gridPos,dataPos:dataPos}}
function handleZoomMove(ev){var plot=ev.data.plot;var c=plot.plugins.cursor;if(c.show&&c.zoom&&c._zoom.started&&!c.zoomTarget){ev.preventDefault();var ctx=c.zoomCanvas._ctx;var positions=getEventPosition(ev);var gridpos=positions.gridPos;var datapos=positions.dataPos;c._zoom.gridpos=gridpos;c._zoom.datapos=datapos;c._zoom.zooming=!0;var xpos=gridpos.x;var ypos=gridpos.y;var height=ctx.canvas.height;var width=ctx.canvas.width;if(c.showTooltip&&!c.onGrid&&c.showTooltipOutsideZoom){updateTooltip(gridpos,datapos,plot);if(c.followMouse){moveTooltip(gridpos,plot)}}
if(c.constrainZoomTo=='x'){c._zoom.end=[xpos,height]}
else if(c.constrainZoomTo=='y'){c._zoom.end=[width,ypos]}
else{c._zoom.end=[xpos,ypos]}
var sel=window.getSelection;if(document.selection&&document.selection.empty)
{document.selection.empty()}
else if(sel&&!sel().isCollapsed){sel().collapse()}
drawZoomBox.call(c);ctx=null}}
function handleMouseDown(ev,gridpos,datapos,neighbor,plot){var c=plot.plugins.cursor;if(plot.plugins.mobile){$(document).one('vmouseup.jqplot_cursor',{plot:plot},handleMouseUp)}else{$(document).one('mouseup.jqplot_cursor',{plot:plot},handleMouseUp)}
var axes=plot.axes;if(document.onselectstart!=undefined){c._oldHandlers.onselectstart=document.onselectstart;document.onselectstart=function(){return!1}}
if(document.ondrag!=undefined){c._oldHandlers.ondrag=document.ondrag;document.ondrag=function(){return!1}}
if(document.onmousedown!=undefined){c._oldHandlers.onmousedown=document.onmousedown;document.onmousedown=function(){return!1}}
if(c.zoom){if(!c.zoomProxy){var ctx=c.zoomCanvas._ctx;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);ctx=null}
if(c.constrainZoomTo=='x'){c._zoom.start=[gridpos.x,0]}
else if(c.constrainZoomTo=='y'){c._zoom.start=[0,gridpos.y]}
else{c._zoom.start=[gridpos.x,gridpos.y]}
c._zoom.started=!0;for(var ax in datapos){c._zoom.axes.start[ax]=datapos[ax]}
if(plot.plugins.mobile){$(document).bind('vmousemove.jqplotCursor',{plot:plot},handleZoomMove)}else{$(document).bind('mousemove.jqplotCursor',{plot:plot},handleZoomMove)}}}
function handleMouseUp(ev){var plot=ev.data.plot;var c=plot.plugins.cursor;if(c.zoom&&c._zoom.zooming&&!c.zoomTarget){var xpos=c._zoom.gridpos.x;var ypos=c._zoom.gridpos.y;var datapos=c._zoom.datapos;var height=c.zoomCanvas._ctx.canvas.height;var width=c.zoomCanvas._ctx.canvas.width;var axes=plot.axes;if(c.constrainOutsideZoom&&!c.onGrid){if(xpos<0){xpos=0}
else if(xpos>width){xpos=width}
if(ypos<0){ypos=0}
else if(ypos>height){ypos=height}
for(var axis in datapos){if(datapos[axis]){if(axis.charAt(0)=='x'){datapos[axis]=axes[axis].series_p2u(xpos)}
else{datapos[axis]=axes[axis].series_p2u(ypos)}}}}
if(c.constrainZoomTo=='x'){ypos=height}
else if(c.constrainZoomTo=='y'){xpos=width}
c._zoom.end=[xpos,ypos];c._zoom.gridpos={x:xpos,y:ypos};c.doZoom(c._zoom.gridpos,datapos,plot,c)}
c._zoom.started=!1;c._zoom.zooming=!1;$(document).unbind('mousemove.jqplotCursor',handleZoomMove);if(document.onselectstart!=undefined&&c._oldHandlers.onselectstart!=null){document.onselectstart=c._oldHandlers.onselectstart;c._oldHandlers.onselectstart=null}
if(document.ondrag!=undefined&&c._oldHandlers.ondrag!=null){document.ondrag=c._oldHandlers.ondrag;c._oldHandlers.ondrag=null}
if(document.onmousedown!=undefined&&c._oldHandlers.onmousedown!=null){document.onmousedown=c._oldHandlers.onmousedown;c._oldHandlers.onmousedown=null}}
function drawZoomBox(){var start=this._zoom.start;var end=this._zoom.end;var ctx=this.zoomCanvas._ctx;var l,t,h,w;if(end[0]>start[0]){l=start[0];w=end[0]-start[0]}
else{l=end[0];w=start[0]-end[0]}
if(end[1]>start[1]){t=start[1];h=end[1]-start[1]}
else{t=end[1];h=start[1]-end[1]}
ctx.fillStyle='rgba(0,0,0,0.2)';ctx.strokeStyle='#999999';ctx.lineWidth=1.0;ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);ctx.fillRect(0,0,ctx.canvas.width,ctx.canvas.height);ctx.clearRect(l,t,w,h);ctx.strokeRect(l,t,w,h);ctx=null}
$.jqplot.CursorLegendRenderer=function(options){$.jqplot.TableLegendRenderer.call(this,options);this.formatString='%s'};$.jqplot.CursorLegendRenderer.prototype=new $.jqplot.TableLegendRenderer();$.jqplot.CursorLegendRenderer.prototype.constructor=$.jqplot.CursorLegendRenderer;$.jqplot.CursorLegendRenderer.prototype.draw=function(){if(this._elem){this._elem.emptyForce();this._elem=null}
if(this.show){var series=this._series,s;var elem=document.createElement('table');this._elem=$(elem);elem=null;this._elem.addClass('jqplot-legend jqplot-cursor-legend');this._elem.css('position','absolute');var pad=!1;for(var i=0;i<series.length;i++){s=series[i];if(s.show&&s.showLabel){var lt=$.jqplot.sprintf(this.formatString,s.label.toString());if(lt){var color=s.color;if(s._stack&&!s.fill){color=''}
addrow.call(this,lt,color,pad,i);pad=!0}
for(var j=0;j<$.jqplot.addLegendRowHooks.length;j++){var item=$.jqplot.addLegendRowHooks[j].call(this,s);if(item){addrow.call(this,item.label,item.color,pad);pad=!0}}}}
series=s=null;delete series;delete s}
function addrow(label,color,pad,idx){var rs=(pad)?this.rowSpacing:'0';var tr=$('<tr class="jqplot-legend jqplot-cursor-legend"></tr>').appendTo(this._elem);tr.data('seriesIndex',idx);$('<td class="jqplot-legend jqplot-cursor-legend-swatch" style="padding-top:'+rs+';">'+'<div style="border:1px solid #cccccc;padding:0.2em;">'+'<div class="jqplot-cursor-legend-swatch" style="background-color:'+color+';"></div>'+'</div></td>').appendTo(tr);var td=$('<td class="jqplot-legend jqplot-cursor-legend-label" style="vertical-align:middle;padding-top:'+rs+';"></td>');td.appendTo(tr);td.data('seriesIndex',idx);if(this.escapeHtml){td.text(label)}
else{td.html(label)}
tr=null;td=null}
return this._elem}})(jQuery)