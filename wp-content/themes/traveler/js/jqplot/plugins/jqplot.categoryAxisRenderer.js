(function($){$.jqplot.CategoryAxisRenderer=function(options){$.jqplot.LinearAxisRenderer.call(this);this.sortMergedLabels=!1};$.jqplot.CategoryAxisRenderer.prototype=new $.jqplot.LinearAxisRenderer();$.jqplot.CategoryAxisRenderer.prototype.constructor=$.jqplot.CategoryAxisRenderer;$.jqplot.CategoryAxisRenderer.prototype.init=function(options){this.groups=1;this.groupLabels=[];this._groupLabels=[];this._grouped=!1;this._barsPerGroup=null;this.reverse=!1;$.extend(!0,this,{tickOptions:{formatString:'%d'}},options);var db=this._dataBounds;for(var i=0;i<this._series.length;i++){var s=this._series[i];if(s.groups){this.groups=s.groups}
var d=s.data;for(var j=0;j<d.length;j++){if(this.name=='xaxis'||this.name=='x2axis'){if(d[j][0]<db.min||db.min==null){db.min=d[j][0]}
if(d[j][0]>db.max||db.max==null){db.max=d[j][0]}}
else{if(d[j][1]<db.min||db.min==null){db.min=d[j][1]}
if(d[j][1]>db.max||db.max==null){db.max=d[j][1]}}}}
if(this.groupLabels.length){this.groups=this.groupLabels.length}};$.jqplot.CategoryAxisRenderer.prototype.createTicks=function(){var ticks=this._ticks;var userTicks=this.ticks;var name=this.name;var db=this._dataBounds;var dim,interval;var min,max;var pos1,pos2;var tt,i;if(userTicks.length){if(this.groups>1&&!this._grouped){var l=userTicks.length;var skip=parseInt(l/this.groups,10);var count=0;for(var i=skip;i<l;i+=skip){userTicks.splice(i+count,0,' ');count++}
this._grouped=!0}
this.min=0.5;this.max=userTicks.length+0.5;var range=this.max-this.min;this.numberTicks=2*userTicks.length+1;for(i=0;i<userTicks.length;i++){tt=this.min+2*i*range/(this.numberTicks-1);var t=new this.tickRenderer(this.tickOptions);t.showLabel=!1;t.setTick(tt,this.name);this._ticks.push(t);var t=new this.tickRenderer(this.tickOptions);t.label=userTicks[i];t.showMark=!1;t.showGridline=!1;t.setTick(tt+0.5,this.name);this._ticks.push(t)}
var t=new this.tickRenderer(this.tickOptions);t.showLabel=!1;t.setTick(tt+1,this.name);this._ticks.push(t)}
else{if(name=='xaxis'||name=='x2axis'){dim=this._plotDimensions.width}
else{dim=this._plotDimensions.height}
if(this.min!=null&&this.max!=null&&this.numberTicks!=null){this.tickInterval=null}
if(this.min!=null&&this.max!=null&&this.tickInterval!=null){if(parseInt((this.max-this.min)/this.tickInterval,10)!=(this.max-this.min)/this.tickInterval){this.tickInterval=null}}
var labels=[];var numcats=0;var min=0.5;var max,val;var isMerged=!1;for(var i=0;i<this._series.length;i++){var s=this._series[i];for(var j=0;j<s.data.length;j++){if(this.name=='xaxis'||this.name=='x2axis'){val=s.data[j][0]}
else{val=s.data[j][1]}
if($.inArray(val,labels)==-1){isMerged=!0;numcats+=1;labels.push(val)}}}
if(isMerged&&this.sortMergedLabels){if(typeof labels[0]=="string"){labels.sort()}else{labels.sort(function(a,b){return a-b})}}
this.ticks=labels;for(var i=0;i<this._series.length;i++){var s=this._series[i];for(var j=0;j<s.data.length;j++){if(this.name=='xaxis'||this.name=='x2axis'){val=s.data[j][0]}
else{val=s.data[j][1]}
var idx=$.inArray(val,labels)+1;if(this.name=='xaxis'||this.name=='x2axis'){s.data[j][0]=idx}
else{s.data[j][1]=idx}}}
if(this.groups>1&&!this._grouped){var l=labels.length;var skip=parseInt(l/this.groups,10);var count=0;for(var i=skip;i<l;i+=skip+1){labels[i]=' '}
this._grouped=!0}
max=numcats+0.5;if(this.numberTicks==null){this.numberTicks=2*numcats+1}
var range=max-min;this.min=min;this.max=max;var track=0;var maxVisibleTicks=parseInt(3+dim/10,10);var skip=parseInt(numcats/maxVisibleTicks,10);if(this.tickInterval==null){this.tickInterval=range/(this.numberTicks-1)}
for(var i=0;i<this.numberTicks;i++){tt=this.min+i*this.tickInterval;var t=new this.tickRenderer(this.tickOptions);if(i/2==parseInt(i/2,10)){t.showLabel=!1;t.showMark=!0}
else{if(skip>0&&track<skip){t.showLabel=!1;track+=1}
else{t.showLabel=!0;track=0}
t.label=t.formatter(t.formatString,labels[(i-1)/2]);t.showMark=!1;t.showGridline=!1}
t.setTick(tt,this.name);this._ticks.push(t)}}};$.jqplot.CategoryAxisRenderer.prototype.draw=function(ctx,plot){if(this.show){this.renderer.createTicks.call(this);var dim=0;var temp;if(this._elem){this._elem.emptyForce()}
this._elem=this._elem||$('<div class="jqplot-axis st_report_date_custom jqplot-'+this.name+'" style="position:absolute;"></div>');if(this.name=='xaxis'||this.name=='x2axis'){this._elem.width(this._plotDimensions.width)}
else{this._elem.height(this._plotDimensions.height)}
this.labelOptions.axis=this.name;this._label=new this.labelRenderer(this.labelOptions);if(this._label.show){var elem=this._label.draw(ctx,plot);elem.appendTo(this._elem)}
var t=this._ticks;for(var i=0;i<t.length;i++){var tick=t[i];if(tick.showLabel&&(!tick.isMinorTick||this.showMinorTicks)){var elem=tick.draw(ctx,plot);elem.appendTo(this._elem)}}
this._groupLabels=[];for(var i=0;i<this.groupLabels.length;i++)
{var elem=$('<div style="position:absolute;" class="jqplot-'+this.name+'-groupLabel"></div>');elem.html(this.groupLabels[i]);this._groupLabels.push(elem);elem.appendTo(this._elem)}}
return this._elem};$.jqplot.CategoryAxisRenderer.prototype.set=function(){var dim=0;var temp;var w=0;var h=0;var lshow=(this._label==null)?!1:this._label.show;if(this.show){var t=this._ticks;for(var i=0;i<t.length;i++){var tick=t[i];if(tick.showLabel&&(!tick.isMinorTick||this.showMinorTicks)){if(this.name=='xaxis'||this.name=='x2axis'){temp=tick._elem.outerHeight(!0)}
else{temp=tick._elem.outerWidth(!0)}
if(temp>dim){dim=temp}}}
var dim2=0;for(var i=0;i<this._groupLabels.length;i++){var l=this._groupLabels[i];if(this.name=='xaxis'||this.name=='x2axis'){temp=l.outerHeight(!0)}
else{temp=l.outerWidth(!0)}
if(temp>dim2){dim2=temp}}
if(lshow){w=this._label._elem.outerWidth(!0);h=this._label._elem.outerHeight(!0)}
if(this.name=='xaxis'){dim+=dim2+h;this._elem.css({'height':dim+'px',left:'0px',bottom:'0px'})}
else if(this.name=='x2axis'){dim+=dim2+h;this._elem.css({'height':dim+'px',left:'0px',top:'0px'})}
else if(this.name=='yaxis'){dim+=dim2+w;this._elem.css({'width':dim+'px',left:'0px',top:'0px'});if(lshow&&this._label.constructor==$.jqplot.AxisLabelRenderer){this._label._elem.css('width',w+'px')}}
else{dim+=dim2+w;this._elem.css({'width':dim+'px',right:'0px',top:'0px'});if(lshow&&this._label.constructor==$.jqplot.AxisLabelRenderer){this._label._elem.css('width',w+'px')}}}};$.jqplot.CategoryAxisRenderer.prototype.pack=function(pos,offsets){var ticks=this._ticks;var max=this.max;var min=this.min;var offmax=offsets.max;var offmin=offsets.min;var lshow=(this._label==null)?!1:this._label.show;var i;for(var p in pos){this._elem.css(p,pos[p])}
this._offsets=offsets;var pixellength=offmax-offmin;var unitlength=max-min;if(!this.reverse){this.u2p=function(u){return(u-min)*pixellength/unitlength+offmin};this.p2u=function(p){return(p-offmin)*unitlength/pixellength+min};if(this.name=='xaxis'||this.name=='x2axis'){this.series_u2p=function(u){return(u-min)*pixellength/unitlength};this.series_p2u=function(p){return p*unitlength/pixellength+min}}
else{this.series_u2p=function(u){return(u-max)*pixellength/unitlength};this.series_p2u=function(p){return p*unitlength/pixellength+max}}}
else{this.u2p=function(u){return offmin+(max-u)*pixellength/unitlength};this.p2u=function(p){return min+(p-offmin)*unitlength/pixellength};if(this.name=='xaxis'||this.name=='x2axis'){this.series_u2p=function(u){return(max-u)*pixellength/unitlength};this.series_p2u=function(p){return p*unitlength/pixellength+max}}
else{this.series_u2p=function(u){return(min-u)*pixellength/unitlength};this.series_p2u=function(p){return p*unitlength/pixellength+min}}}
if(this.show){if(this.name=='xaxis'||this.name=='x2axis'){for(i=0;i<ticks.length;i++){var t=ticks[i];if(t.show&&t.showLabel){var shim;if(t.constructor==$.jqplot.CanvasAxisTickRenderer&&t.angle){var temp=(this.name=='xaxis')?1:-1;switch(t.labelPosition){case 'auto':if(temp*t.angle<0){shim=-t.getWidth()+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2}
else{shim=-t._textRenderer.height*Math.sin(t._textRenderer.angle)/2}
break;case 'end':shim=-t.getWidth()+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2;break;case 'start':shim=-t._textRenderer.height*Math.sin(t._textRenderer.angle)/2;break;case 'middle':shim=-t.getWidth()/2+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2;break;default:shim=-t.getWidth()/2+t._textRenderer.height*Math.sin(-t._textRenderer.angle)/2;break}}
else{shim=-t.getWidth()/2}
var val=this.u2p(t.value)+shim+'px';t._elem.css('left',val);t.pack()}}
var labeledge=['bottom',0];if(lshow){var w=this._label._elem.outerWidth(!0);this._label._elem.css('left',offmin+pixellength/2-w/2+'px');if(this.name=='xaxis'){this._label._elem.css('bottom','0px');labeledge=['bottom',this._label._elem.outerHeight(!0)]}
else{this._label._elem.css('top','0px');labeledge=['top',this._label._elem.outerHeight(!0)]}
this._label.pack()}
var step=parseInt(this._ticks.length/this.groups,10)+1;for(i=0;i<this._groupLabels.length;i++){var mid=0;var count=0;for(var j=i*step;j<(i+1)*step;j++){if(j>=this._ticks.length-1)continue;if(this._ticks[j]._elem&&this._ticks[j].label!=" "){var t=this._ticks[j]._elem;var p=t.position();mid+=p.left+t.outerWidth(!0)/2;count++}}
mid=mid/count;this._groupLabels[i].css({'left':(mid-this._groupLabels[i].outerWidth(!0)/2)});this._groupLabels[i].css(labeledge[0],labeledge[1])}}
else{for(i=0;i<ticks.length;i++){var t=ticks[i];if(t.show&&t.showLabel){var shim;if(t.constructor==$.jqplot.CanvasAxisTickRenderer&&t.angle){var temp=(this.name=='yaxis')?1:-1;switch(t.labelPosition){case 'auto':case 'end':if(temp*t.angle<0){shim=-t._textRenderer.height*Math.cos(-t._textRenderer.angle)/2}
else{shim=-t.getHeight()+t._textRenderer.height*Math.cos(t._textRenderer.angle)/2}
break;case 'start':if(t.angle>0){shim=-t._textRenderer.height*Math.cos(-t._textRenderer.angle)/2}
else{shim=-t.getHeight()+t._textRenderer.height*Math.cos(t._textRenderer.angle)/2}
break;case 'middle':shim=-t.getHeight()/2;break;default:shim=-t.getHeight()/2;break}}
else{shim=-t.getHeight()/2}
var val=this.u2p(t.value)+shim+'px';t._elem.css('top',val);t.pack()}}
var labeledge=['left',0];if(lshow){var h=this._label._elem.outerHeight(!0);this._label._elem.css('top',offmax-pixellength/2-h/2+'px');if(this.name=='yaxis'){this._label._elem.css('left','0px');labeledge=['left',this._label._elem.outerWidth(!0)]}
else{this._label._elem.css('right','0px');labeledge=['right',this._label._elem.outerWidth(!0)]}
this._label.pack()}
var step=parseInt(this._ticks.length/this.groups,10)+1;for(i=0;i<this._groupLabels.length;i++){var mid=0;var count=0;for(var j=i*step;j<(i+1)*step;j++){if(j>=this._ticks.length-1)continue;if(this._ticks[j]._elem&&this._ticks[j].label!=" "){var t=this._ticks[j]._elem;var p=t.position();mid+=p.top+t.outerHeight()/2;count++}}
mid=mid/count;this._groupLabels[i].css({'top':mid-this._groupLabels[i].outerHeight()/2});this._groupLabels[i].css(labeledge[0],labeledge[1])}}}}})(jQuery)