(function($){$.jqplot.DateAxisRenderer=function(){$.jqplot.LinearAxisRenderer.call(this);this.date=new $.jsDate()};var second=1000;var minute=60*second;var hour=60*minute;var day=24*hour;var week=7*day;var month=30.4368499*day;var year=365.242199*day;var daysInMonths=[31,28,31,30,31,30,31,30,31,30,31,30];var niceFormatStrings=['%M:%S.%#N','%M:%S.%#N','%M:%S.%#N','%M:%S','%M:%S','%M:%S','%M:%S','%H:%M:%S','%H:%M:%S','%H:%M','%H:%M','%H:%M','%H:%M','%H:%M','%H:%M','%a %H:%M','%a %H:%M','%b %e %H:%M','%b %e %H:%M','%b %e %H:%M','%b %e %H:%M','%v','%v','%v','%v','%v','%v','%v'];var niceIntervals=[0.1*second,0.2*second,0.5*second,second,2*second,5*second,10*second,15*second,30*second,minute,2*minute,5*minute,10*minute,15*minute,30*minute,hour,2*hour,4*hour,6*hour,8*hour,12*hour,day,2*day,3*day,4*day,5*day,week,2*week];var niceMonthlyIntervals=[];function bestDateInterval(min,max,titarget){var badness=Number.MAX_VALUE;var temp,bestTi,bestfmt;for(var i=0,l=niceIntervals.length;i<l;i++){temp=Math.abs(titarget-niceIntervals[i]);if(temp<badness){badness=temp;bestTi=niceIntervals[i];bestfmt=niceFormatStrings[i]}}
return[bestTi,bestfmt]}
$.jqplot.DateAxisRenderer.prototype=new $.jqplot.LinearAxisRenderer();$.jqplot.DateAxisRenderer.prototype.constructor=$.jqplot.DateAxisRenderer;$.jqplot.DateTickFormatter=function(format,val){if(!format){format='%Y/%m/%d'}
return $.jsDate.strftime(val,format)};$.jqplot.DateAxisRenderer.prototype.init=function(options){this.tickOptions.formatter=$.jqplot.DateTickFormatter;this.tickInset=0;this.drawBaseline=!0;this.baselineWidth=null;this.baselineColor=null;this.daTickInterval=null;this._daTickInterval=null;$.extend(!0,this,options);var db=this._dataBounds,stats,sum,s,d,pd,sd,intv;for(var i=0;i<this._series.length;i++){stats={intervals:[],frequencies:{},sortedIntervals:[],min:null,max:null,mean:null};sum=0;s=this._series[i];d=s.data;pd=s._plotData;sd=s._stackData;intv=0;for(var j=0;j<d.length;j++){if(this.name=='xaxis'||this.name=='x2axis'){d[j][0]=new $.jsDate(d[j][0]).getTime();pd[j][0]=new $.jsDate(d[j][0]).getTime();sd[j][0]=new $.jsDate(d[j][0]).getTime();if((d[j][0]!=null&&d[j][0]<db.min)||db.min==null){db.min=d[j][0]}
if((d[j][0]!=null&&d[j][0]>db.max)||db.max==null){db.max=d[j][0]}
if(j>0){intv=Math.abs(d[j][0]-d[j-1][0]);stats.intervals.push(intv);if(stats.frequencies.hasOwnProperty(intv)){stats.frequencies[intv]+=1}
else{stats.frequencies[intv]=1}}
sum+=intv}
else{d[j][1]=new $.jsDate(d[j][1]).getTime();pd[j][1]=new $.jsDate(d[j][1]).getTime();sd[j][1]=new $.jsDate(d[j][1]).getTime();if((d[j][1]!=null&&d[j][1]<db.min)||db.min==null){db.min=d[j][1]}
if((d[j][1]!=null&&d[j][1]>db.max)||db.max==null){db.max=d[j][1]}
if(j>0){intv=Math.abs(d[j][1]-d[j-1][1]);stats.intervals.push(intv);if(stats.frequencies.hasOwnProperty(intv)){stats.frequencies[intv]+=1}
else{stats.frequencies[intv]=1}}}
sum+=intv}
if(s.renderer.bands){if(s.renderer.bands.hiData.length){var bd=s.renderer.bands.hiData;for(var j=0,l=bd.length;j<l;j++){if(this.name==='xaxis'||this.name==='x2axis'){bd[j][0]=new $.jsDate(bd[j][0]).getTime();if((bd[j][0]!=null&&bd[j][0]>db.max)||db.max==null){db.max=bd[j][0]}}
else{bd[j][1]=new $.jsDate(bd[j][1]).getTime();if((bd[j][1]!=null&&bd[j][1]>db.max)||db.max==null){db.max=bd[j][1]}}}}
if(s.renderer.bands.lowData.length){var bd=s.renderer.bands.lowData;for(var j=0,l=bd.length;j<l;j++){if(this.name==='xaxis'||this.name==='x2axis'){bd[j][0]=new $.jsDate(bd[j][0]).getTime();if((bd[j][0]!=null&&bd[j][0]<db.min)||db.min==null){db.min=bd[j][0]}}
else{bd[j][1]=new $.jsDate(bd[j][1]).getTime();if((bd[j][1]!=null&&bd[j][1]<db.min)||db.min==null){db.min=bd[j][1]}}}}}
var tempf=0,tempn=0;for(var n in stats.frequencies){stats.sortedIntervals.push({interval:n,frequency:stats.frequencies[n]})}
stats.sortedIntervals.sort(function(a,b){return b.frequency-a.frequency});stats.min=$.jqplot.arrayMin(stats.intervals);stats.max=$.jqplot.arrayMax(stats.intervals);stats.mean=sum/d.length;this._intervalStats.push(stats);stats=sum=s=d=pd=sd=null}
db=null};$.jqplot.DateAxisRenderer.prototype.reset=function(){this.min=this._options.min;this.max=this._options.max;this.tickInterval=this._options.tickInterval;this.numberTicks=this._options.numberTicks;this._autoFormatString='';if(this._overrideFormatString&&this.tickOptions&&this.tickOptions.formatString){this.tickOptions.formatString=''}
this.daTickInterval=this._daTickInterval};$.jqplot.DateAxisRenderer.prototype.createTicks=function(plot){var ticks=this._ticks;var userTicks=this.ticks;var name=this.name;var db=this._dataBounds;var iv=this._intervalStats;var dim=(this.name.charAt(0)==='x')?this._plotDimensions.width:this._plotDimensions.height;var interval;var min,max;var pos1,pos2;var tt,i;var threshold=30;var insetMult=1;var daTickInterval=null;if(this.tickInterval!=null)
{if(Number(this.tickInterval)){daTickInterval=[Number(this.tickInterval),'seconds']}
else if(typeof this.tickInterval=="string"){var parts=this.tickInterval.split(' ');if(parts.length==1){daTickInterval=[1,parts[0]]}
else if(parts.length==2){daTickInterval=[parts[0],parts[1]]}}}
var tickInterval=this.tickInterval;min=new $.jsDate((this.min!=null)?this.min:db.min).getTime();max=new $.jsDate((this.max!=null)?this.max:db.max).getTime();var cursor=plot.plugins.cursor;if(cursor&&cursor._zoom&&cursor._zoom.zooming){this.min=null;this.max=null}
var range=max-min;if(this.tickOptions==null||!this.tickOptions.formatString){this._overrideFormatString=!0}
if(userTicks.length){for(i=0;i<userTicks.length;i++){var ut=userTicks[i];var t=new this.tickRenderer(this.tickOptions);if(ut.constructor==Array){t.value=new $.jsDate(ut[0]).getTime();t.label=ut[1];if(!this.showTicks){t.showLabel=!1;t.showMark=!1}
else if(!this.showTickMarks){t.showMark=!1}
t.setTick(t.value,this.name);this._ticks.push(t)}
else{t.value=new $.jsDate(ut).getTime();if(!this.showTicks){t.showLabel=!1;t.showMark=!1}
else if(!this.showTickMarks){t.showMark=!1}
t.setTick(t.value,this.name);this._ticks.push(t)}}
this.numberTicks=userTicks.length;this.min=this._ticks[0].value;this.max=this._ticks[this.numberTicks-1].value;this.daTickInterval=[(this.max-this.min)/(this.numberTicks-1)/1000,'seconds']}
else if(this.min==null&&this.max==null&&db.min==db.max)
{var onePointOpts=$.extend(!0,{},this.tickOptions,{name:this.name,value:null});var delta=300000;this.min=db.min-delta;this.max=db.max+delta;this.numberTicks=3;for(var i=this.min;i<=this.max;i+=delta)
{onePointOpts.value=i;var t=new this.tickRenderer(onePointOpts);if(this._overrideFormatString&&this._autoFormatString!=''){t.formatString=this._autoFormatString}
t.showLabel=!1;t.showMark=!1;this._ticks.push(t)}
if(this.showTicks){this._ticks[1].showLabel=!0}
if(this.showTickMarks){this._ticks[1].showTickMarks=!0}}
else if(this.min==null&&this.max==null){var opts=$.extend(!0,{},this.tickOptions,{name:this.name,value:null});var nttarget,titarget;if(!this.tickInterval&&!this.numberTicks){var tdim=Math.max(dim,threshold+1);var spacingFactor=115;if(this.tickRenderer===$.jqplot.CanvasAxisTickRenderer&&this.tickOptions.angle){spacingFactor=115-40*Math.abs(Math.sin(this.tickOptions.angle/180*Math.PI))}
nttarget=Math.ceil((tdim-threshold)/spacingFactor+1);titarget=(max-min)/(nttarget-1)}
else if(this.tickInterval){titarget=new $.jsDate(0).add(daTickInterval[0],daTickInterval[1]).getTime()}
else if(this.numberTicks){nttarget=this.numberTicks;titarget=(max-min)/(nttarget-1)}
if(titarget<=19*day){var ret=bestDateInterval(min,max,titarget);var tempti=ret[0];this._autoFormatString=ret[1];min=new $.jsDate(min);min=Math.floor((min.getTime()-min.getUtcOffset())/tempti)*tempti+min.getUtcOffset();nttarget=Math.ceil((max-min)/tempti)+1;this.min=min;this.max=min+(nttarget-1)*tempti;if(this.max<max){this.max+=tempti;nttarget+=1}
this.tickInterval=tempti;this.numberTicks=nttarget;for(var i=0;i<nttarget;i++){opts.value=this.min+i*tempti;t=new this.tickRenderer(opts);if(this._overrideFormatString&&this._autoFormatString!=''){t.formatString=this._autoFormatString}
if(!this.showTicks){t.showLabel=!1;t.showMark=!1}
else if(!this.showTickMarks){t.showMark=!1}
this._ticks.push(t)}
insetMult=this.tickInterval}
else if(titarget<=9*month){this._autoFormatString='%v';var intv=Math.round(titarget/month);if(intv<1){intv=1}
else if(intv>6){intv=6}
var mstart=new $.jsDate(min).setDate(1).setHours(0,0,0,0);var tempmend=new $.jsDate(max);var mend=new $.jsDate(max).setDate(1).setHours(0,0,0,0);if(tempmend.getTime()!==mend.getTime()){mend=mend.add(1,'month')}
var nmonths=mend.diff(mstart,'month');nttarget=Math.ceil(nmonths/intv)+1;this.min=mstart.getTime();this.max=mstart.clone().add((nttarget-1)*intv,'month').getTime();this.numberTicks=nttarget;for(var i=0;i<nttarget;i++){if(i===0){opts.value=mstart.getTime()}
else{opts.value=mstart.add(intv,'month').getTime()}
t=new this.tickRenderer(opts);if(this._overrideFormatString&&this._autoFormatString!=''){t.formatString=this._autoFormatString}
if(!this.showTicks){t.showLabel=!1;t.showMark=!1}
else if(!this.showTickMarks){t.showMark=!1}
this._ticks.push(t)}
insetMult=intv*month}
else{this._autoFormatString='%v';var intv=Math.round(titarget/year);if(intv<1){intv=1}
var mstart=new $.jsDate(min).setMonth(0,1).setHours(0,0,0,0);var mend=new $.jsDate(max).add(1,'year').setMonth(0,1).setHours(0,0,0,0);var nyears=mend.diff(mstart,'year');nttarget=Math.ceil(nyears/intv)+1;this.min=mstart.getTime();this.max=mstart.clone().add((nttarget-1)*intv,'year').getTime();this.numberTicks=nttarget;for(var i=0;i<nttarget;i++){if(i===0){opts.value=mstart.getTime()}
else{opts.value=mstart.add(intv,'year').getTime()}
t=new this.tickRenderer(opts);if(this._overrideFormatString&&this._autoFormatString!=''){t.formatString=this._autoFormatString}
if(!this.showTicks){t.showLabel=!1;t.showMark=!1}
else if(!this.showTickMarks){t.showMark=!1}
this._ticks.push(t)}
insetMult=intv*year}}
else{if(name=='xaxis'||name=='x2axis'){dim=this._plotDimensions.width}
else{dim=this._plotDimensions.height}
if(this.min!=null&&this.max!=null&&this.numberTicks!=null){this.tickInterval=null}
if(this.tickInterval!=null&&daTickInterval!=null){this.daTickInterval=daTickInterval}
if(min==max){var adj=24*60*60*500;min-=adj;max+=adj}
range=max-min;var optNumTicks=2+parseInt(Math.max(0,dim-100)/100,10);var rmin,rmax;rmin=(this.min!=null)?new $.jsDate(this.min).getTime():min-range/2*(this.padMin-1);rmax=(this.max!=null)?new $.jsDate(this.max).getTime():max+range/2*(this.padMax-1);this.min=rmin;this.max=rmax;range=this.max-this.min;if(this.numberTicks==null){if(this.daTickInterval!=null){var nc=new $.jsDate(this.max).diff(this.min,this.daTickInterval[1],!0);this.numberTicks=Math.ceil(nc/this.daTickInterval[0])+1;this.max=new $.jsDate(this.min).add((this.numberTicks-1)*this.daTickInterval[0],this.daTickInterval[1]).getTime()}
else if(dim>200){this.numberTicks=parseInt(3+(dim-200)/100,10)}
else{this.numberTicks=2}}
insetMult=range/(this.numberTicks-1)/1000;if(this.daTickInterval==null){this.daTickInterval=[insetMult,'seconds']}
for(var i=0;i<this.numberTicks;i++){var min=new $.jsDate(this.min);tt=min.add(i*this.daTickInterval[0],this.daTickInterval[1]).getTime();var t=new this.tickRenderer(this.tickOptions);if(!this.showTicks){t.showLabel=!1;t.showMark=!1}
else if(!this.showTickMarks){t.showMark=!1}
t.setTick(tt,this.name);this._ticks.push(t)}}
if(this.tickInset){this.min=this.min-this.tickInset*insetMult;this.max=this.max+this.tickInset*insetMult}
if(this._daTickInterval==null){this._daTickInterval=this.daTickInterval}
ticks=null}})(jQuery)