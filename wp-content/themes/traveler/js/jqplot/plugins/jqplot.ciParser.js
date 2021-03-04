(function($){$.jqplot.ciParser=function(data,plot){var ret=[],line,temp,i,j,k,kk;if(typeof(data)=="string"){data=$.jqplot.JSON.parse(data,handleStrings)}
else if(typeof(data)=="object"){for(k in data){for(i=0;i<data[k].length;i++){for(kk in data[k][i]){data[k][i][kk]=handleStrings(kk,data[k][i][kk])}}}}
else{return null}
function handleStrings(key,value){var a;if(value!=null){if(value.toString().indexOf('Date')>=0){a=/^\/Date\((-?[0-9]+)\)\/$/.exec(value);if(a){return parseInt(a[1],10)}}
return value}}
for(var prop in data){line=[];temp=data[prop];switch(prop){case "PriceTicks":for(i=0;i<temp.length;i++){line.push([temp[i].TickDate,temp[i].Price])}
break;case "PriceBars":for(i=0;i<temp.length;i++){line.push([temp[i].BarDate,temp[i].Open,temp[i].High,temp[i].Low,temp[i].Close])}
break}
ret.push(line)}
return ret}})(jQuery)