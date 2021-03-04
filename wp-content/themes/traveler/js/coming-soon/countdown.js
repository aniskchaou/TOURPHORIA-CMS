(function($){$.fn.countdown=function(options){defaults={schedule:null,datetime:null,showYears:!1,showDays:!0,showHours:!0,showMinutes:!0,showSeconds:!0,showOnZeroYears:!1,showOnZeroDays:!0,showOnZeroHours:!0,showOnZeroMinutes:!0,showOnZeroSeconds:!0,unixFormat:!1};var options=$.extend({timerCallback:function(options){},initCallback:function(options){},zeroCallback:function(options){}},defaults,options);options.datetime=$(this).attr('data-countdown')?$(this).attr('data-countdown'):null;return this.each(function(){var upcomingDate=scheduler(options);var element=$(this);var intervalHandle=setInterval(function(){var timerObject=makeTimer(upcomingDate,options);options.timerObject=timerObject;var timerHtml=htmlParser(timerObject,options);updateElement(element,timerHtml,options);if(timerObject.timeLeft<=0){clearInterval(intervalHandle);options.zeroCallback(options)}
else{options.timerCallback(options)}},1000)});options.initCallback.call(this)};var updateElement=function(element,html,options){$(element).html(html)}
var scheduler=function(options){if(options.datetime!=null){return options.datetime}
var upcomingDates=[];for(var day in options.schedule){var nextDate=nextDayByName(day);for(var time in options.schedule[day]){var timeString=nextDate+" "+options.schedule[day][time];upcomingDates.push(timeString)}}
schedule=[];for(var key in upcomingDates){schedule.push(new Date(upcomingDates[key]))}
parsedSchedule=[];for(var key in schedule){parsedSchedule.push(Date.parse(schedule[key])/1000)}
var currentTime=new Date(),currentTimeParsed=Date.parse(currentTime)/1000;timeDifferences=[];for(var key in parsedSchedule){timeDifferences.push(parsedSchedule[key]-currentTimeParsed)}
timeDifferencesParsed=[];for(key in timeDifferences){if(timeDifferences[key]>0){timeDifferencesParsed.push(timeDifferences[key])}}
var shortTime=Math.min.apply(null,timeDifferencesParsed);for(var prop in timeDifferences){if(shortTime==timeDifferences[prop]){var shortTimeKey=prop}}
var scheduledDate=upcomingDates[shortTimeKey];if(scheduledDate!=""){return scheduledDate}
return null}
var makeTimer=function(upcomingDate,options){if(upcomingDate==null){return ""}
var currentTime=new Date();if(options.unixFormat){var endTime=(upcomingDate/1000)}else{var endTime=(Date.parse(upcomingDate)/1000)}
var currentTime=(Date.parse(currentTime)/1000);var timeLeft=endTime-currentTime;var years=0;var days=0;var hours=0;var minutes=0;var seconds=0;if(timeLeft>0){var years=Math.floor((timeLeft/31536000));var days=Math.floor((timeLeft/86400));var hours=Math.floor((timeLeft-(days*86400))/3600);var minutes=Math.floor((timeLeft-(days*86400)-(hours*3600))/60);var seconds=Math.floor((timeLeft-(days*86400)-(hours*3600)-(minutes*60)));if(days>365){days=days%365}}
var timerObject={"years":years,"days":days,"hours":hours,"minutes":minutes,"seconds":seconds,"timeLeft":timeLeft};return timerObject}
var htmlParser=function(timerObject,options,format){if(timerObject.years<"10"){timerObject.years="0"+timerObject.years}
if(timerObject.days<"10"){timerObject.days="0"+timerObject.days}
if(timerObject.hours<"10"){timerObject.hours="0"+timerObject.hours}
if(timerObject.minutes<"10"){timerObject.minutes="0"+timerObject.minutes}
if(timerObject.seconds<"10"){timerObject.seconds="0"+timerObject.seconds}
var counter_years='<div class="years"><span class="count">'+timerObject.years+'</span><span class="title">Years</span></div>';var counter_days='<div class="days"><span class="count">'+timerObject.days+'</span><span class="title">Days</span></div>';var counter_hours='<div class="hours"><span class="count">'+timerObject.hours+'</span><span class="title">Hours</span></div>';var counter_minutes='<div class="minutes"><span class="count">'+timerObject.minutes+'</span><span class="title">Minutes</span></div>';var counter_seconds='<div class="seconds"><span class="count">'+timerObject.seconds+'</span><span class="title">Seconds</span></div>';var includeYears=!1,includeDays=!1,includeHours=!1,includeMinutes=!1,includeSeconds=!1;if(options.showYears){includeYears=!0}
if(options.showDays){includeDays=!0}
if(options.showHours){includeHours=!0}
if(options.showMinutes){includeMinutes=!0}
if(options.showSeconds){includeSeconds=!0}
if((!options.showOnZeroYears)&&(timerObject.years=="00")){includeYears=!1}
if((!options.showOnZeroDays)&&(timerObject.days=="00")){includeDays=!1}
if((!options.showOnZeroHours)&&(timerObject.hours=="00")){includeHours=!1}
if((!options.showOnZeroMinutes)&&(timerObject.minutes=="00")){includeMinutes=!1}
if((!options.showOnZeroSeconds)&&(timerObject.seconds=="00")){includeSeconds=!1}
var counter_html="";if(includeYears){counter_html+=counter_years}
if(includeDays){counter_html+=counter_days}
if(includeHours){counter_html+=counter_hours}
if(includeMinutes){counter_html+=counter_minutes}
if(includeSeconds){counter_html+=counter_seconds}
return counter_html}
var nextDayByName=function(scheduledDay){var D=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],M=['January','February','March','April','May','June','July','August','September','October','November','December'];for(var prop in D){if(scheduledDay==D[prop]){var whichNext=prop}}
var date=new Date();var dif=date.getDay()-whichNext;dif=dif>0?dif=7-dif:-dif;date.setDate(date.getDate()+dif);date.setHours(1);var dd=date.getDate();dd<0?dd='0'+dd:null;var yyyy=date.getFullYear();var mm=M[date.getMonth()];var nextDatebyDayofWeek=mm+' '+dd+', '+yyyy;return nextDatebyDayofWeek}}(jQuery))