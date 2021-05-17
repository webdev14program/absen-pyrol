Web2CalLanguage_EN={
	 CLOSE: "Close"
	 ,DAYS:[ "Sunday", "Monday","Tuesday","Wednesday", "Thursday" , "Friday","Saturday"]
	 ,DAYS_SHORT: [ "Sun","Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
	 ,DAYS_SHORT2: [ "Su","Mo", "Tu", "We", "Th", "Fr", "Sa"]
	 ,MONTHS_SHORT: ["Jan", "Feb","Mar", "Apr","May" ,"Jun", "Jul","Aug", "Sep","Oct","Nov","Dec"] 
	 ,MONTHS: ["January", "February","March", "April","May" ,"June", "July","August", "September","October","November","December"]
	,LABEL_MONTH: "Month"
	
	,LABEL_WEEK: "Week"
	,LABEL_DAY: "Day"
	,LABEL_NEXT: "Next "
	,LABEL_AGENDA: "Agenda"
	,LABEL_WORKSHIFT: "Workshift"
	,LABEL_DAYS: "Days"
	,LABEL_WORKWEEK: "Work Week"
	,LABEL_HIDESHOW: "Hide / Show" 
	,LABEL_RECUR_EDIT_WINDOW:"Edit Recurring Event"
	,LABEL_EDIT_RECUR_EVENT_DESC: "	Would you like to change only this event, all events, or this and all future events in the series?"
	,LABEL_IS_RECURRING_EVENT: "This is a recurring Event"
	,LABEL_AM: "AM"
	,LABEL_PM: "PM" 
	,LABEL_EVENTNAME: "Event Name"
	,LABEL_STARTDATE: "Start Date"
	,LABEL_STARTTIME: "Start Time"
	,LABEL_ENDDATE: "End Date"
	,LABEL_ENDTIME: "End Time"
	,LABEL_GROUP: "Group"
	,LABEL_ALLDAY: "All Day?"
	,LABEL_CREATEEVENT: "Create Event"
	,LABEL_DESCRIPTION: "Description" 
	,LABEL_INFORMATION: "Information" 
	,LABEL_VIEWALL: "View All"
	,LABEL_DESCRIPTION: "Description"  
	,LABEL_NOTITLE: "No Title" 
	,LABEL_CREATENEWEVENT: "Create New Event" 
	,LABEL_CREATENEW: "Create New" 
	,LABEL_OPTIONS: "Settings" 
	,LABEL_FILTER: "Filter" 
	,LABEL_EXPAND_DETAILS: "Expand Details" 
	,LABEL_COLLAPSE_DETAILS: "Collapse Details" 
	,LABEL_MORE: "More" 
	,MSG_LOADINGMSG: "Loading.. Please Wait"  
	,MSG_RETRIEVING: "Retrieving Events" 	
	,MSG_VIEW_NOTFOUND:"View '{0}' Not found. \nCheck your settings. The Default View may not be in the selected views"
}

Web2Cal.LANG=Web2CalLanguage_EN;
Web2Cal.defaultSettings=new Array();
Web2Cal.defaultSettings['leftNavTitle']						=  Web2Cal.LANG.HIDESHOW; 
Web2Cal.defaultSettings['startOfWeek']			 			= 0;
Web2Cal.defaultSettings['date'] 							= new Date();
Web2Cal.defaultSettings['defaultView'] 						= "week";
Web2Cal.defaultSettings['startTime']						= 0;
Web2Cal.defaultSettings['endTime'] 							= 23;
Web2Cal.defaultSettings['customViewSize'] 					= 4;
Web2Cal.defaultSettings['timeFormat'] 						= 12;
Web2Cal.defaultSettings['dwSlotHeight'] 					= 43; 
Web2Cal.defaultSettings['timeZoneOffset']					= -new Date().getTimezoneOffset();
Web2Cal.defaultSettings['controlWidth'] 					= '99%';
Web2Cal.defaultSettings['controlHeight'] 					= '500px';
Web2Cal.defaultSettings["showLeftNav"] 						= true;   
Web2Cal.defaultSettings["showAllDay"]	 					= true;
Web2Cal.defaultSettings["showQuickFilter"]	 				= true;  
Web2Cal.defaultSettings["showOptions"]		 				= false;  
Web2Cal.defaultSettings["newEventInPopUp"]					= false;  
Web2Cal.defaultSettings["interval"]							= 4;
Web2Cal.defaultSettings["timeSlotTemplate"]					= "timeSlotTemplate";
Web2Cal.defaultSettings["weekDataTemplate"]  				= "dayWeekEventTemplate";	 	
Web2Cal.defaultSettings["monthDataTemplate"]  				= "monthEventTemplate";	 
Web2Cal.defaultSettings["agendaDataTemplate"]  				= "agendaViewTemplate";	 
Web2Cal.defaultSettings["monthAllDayTemplate"]				= "monthAllDayTemplate";

Web2Cal.defaultSettings["previewTemplate"]					= "previewTemplate";
Web2Cal.defaultSettings["newEventTemplate"]					= "defaultNewEventTemplate";
 
//callbacks 
Web2Cal.defaultSettings["loadEvents"]  							= function(){}; 




Web2Cal.dictionary=function(){};
/**
 * 
 * @param {Object} key
 * @param {Object} params
 */
Web2Cal.dictionary.getMsg=function(key, params){
 
	var msg=Web2Cal.LANG[key];
	if(!msg)
		return;
	
	if(params!=undefined)
	{
		for(var x=0; x<params.length; x++)
		{ 
			msg= msg.replace( "{"+x+"}" , params[x]);
		} 
	}
	return msg;
} 

/**
 * Method to Show Preview
 * @param {jQuery Element} element
 * @param {Array} options
 * 			1. container - jQuery Container Object
 * 			2. activeElement - Element that was clicked on
 * 			3. perspective - Left | Top
 */
Web2Cal.showPreview=function(element, options)
{ 
	var as=GetBounds(options.activeElement); 
	var containerOffset=options.container.offset();
	var viewPort=getViewport();
	var delay=0;
	var bodyscrolltop=options.container.find("div.calbodyContainer").get(0).scrollTop;
	var pointerTop=25;
	var pointerHeight=10;
	var pointerDimension=4;	
	
	var top=as.Top;
	
	var left=as.Left; 
 	
	if(options.removeBodyScroll && options.removeBodyScroll!=false){
		top=top-bodyscrolltop; 					
	}
	
	if (options.leftOffset != undefined && options.leftOffset == false) 
	{
	}
	else 
	{
		left = left -containerOffset.left;
	}
	var jqEle=jQuery(element).hide(); 
	var pointerObj=jqEle.find(".aPointer").css({top:pointerTop+"px"})
						.removeClass("p-left")
						.removeClass("p-right")
						.removeClass("p-bottom")
						.removeClass("p-top");
						
	var eleW= jqEle.width();

	if(options.heightOffset==undefined)options.heightOffset=0;
	
	top=top+options.heightOffset;	
	
	if(options.perspective =="bottom" || options.perspective=="top")
	{
		pointerObj.addClass("p-top");
		left=as.Left+(as.Width/2)-eleW/2-14;

		jqEle.fadeIn(delay).css({
					left:(left )+"px"
					, top: (top+as.Height )+"px"
				});
	} 
	else
	{
		if ((containerOffset.left+ left + as.Width + eleW) > ( viewPort.w)) {
			left =as.Left - eleW-pointerDimension -containerOffset.left;  
			if(left<0)
			{
				jqEle.css({left:"0px"});
			}
			
			pointerObj.addClass("p-right");
		}
		else
		{
			left=left+as.Width-pointerDimension;
										
			pointerObj.addClass("p-left"); 
		}  
		if ((left+ containerOffset.left) < (viewPort.l )) { 
			 left = as.Left + options.activeElement.offsetWidth/2-jqEle.width();
		}
	 
		
		top=top+(options.activeElement.offsetHeight/2)-pointerDimension;		
		var overflowingHeight=viewPort.h-(top+jqEle.height()+5)+options.heightOffset+getBodyScrollY();		
		if(overflowingHeight<0)
		{
			pointerObj.css({top:-overflowingHeight });
			top=top+overflowingHeight;
		}else
		{
			pointerObj.css({top:pointerTop });
			top=top-pointerTop;
		} 
		jqEle.show().css({
				left:(left )+"px"
				, top: (top-pointerHeight)+"px"
			});
	}
}
/**
 * 
 * Method to Show New Event Form
 * @param {jQuery Element} element
 * @param {Array} options
 * 			1. container - jQuery Container Object
 * 			2. activeElement - New Event Element that was just created.
 * 			3. perspective - Left | Top
 */
Web2Cal.showNewEventForm=function(element, options)
{ 
	if (options.asPopup) 
	{
		options.activeElement.style.display = "none"; 
 
		jQuery(element).show().height(400).dialog({ 
			title: "Create New Event",
			modal: true,
			autoOpen:true,
			minWidth: 500 ,
			minHeight: 400,
			width: 500 ,
			height: 400
		});
	}
	else 
	{ 
		var calbodyContainer=options.container.find("div.calbodyContainer");
		var calbodyOffset=calbodyContainer.offset();
		var bodyscrolltop= calbodyContainer.get(0).scrollTop;
		var as = GetBounds(options.activeElement);
		var viewPort = getViewport();
		var delay = 0;
		var pointerTop = 12;
		var pointerDimension =10;
		var top = as.Top;
		
		var left = as.Left;  
		var jqEle = jQuery(element).hide();
		var pointerObj = jqEle.find(".aPointer").css({
			top: pointerTop + "px"
		}).removeClass("p-left").removeClass("p-right").removeClass("p-bottom").removeClass("p-top");
		
		var eleW = jqEle.width();
		
		if(options.removeBodyScroll && options.removeBodyScroll!=false){
			 top=top-bodyscrolltop; 
			 
			 					
		}
		if(options.heightOffset==undefined)options.heightOffset=0;
	
		top=top+options.heightOffset;
		if (options.perspective == "bottom" || options.perspective == "top") 
		{
			pointerObj.addClass("p-top").css({
				top: "-14px"
			});
			left = as.Left + (as.Width / 2) - eleW / 2 - 14;
			jqEle.show().css({
				left: (left) + "px",
				top: (top + as.Height  ) + "px"
			});
		}
		else 
		{
			if ((left + as.Width + eleW) > (viewPort.w)) 
			{
				left = Math.abs(as.Left - eleW - pointerDimension);
				pointerObj.addClass("p-right");
			}
			else 
			{
				left = left + as.Width - pointerDimension;
				pointerObj.addClass("p-left");
			}
			if (left < viewPort.l) 
			{
				left = as.Left + options.activeElement.offsetWidth;
			}
			top = top + (options.activeElement.offsetHeight / 2);
			var overflowingHeight = viewPort.h - (top + jqEle.height() )+options.heightOffset+getBodyScrollY();
			if (overflowingHeight < 0) 
			{ 
				pointerObj.css({
					top: -overflowingHeight
				});
				top = top + overflowingHeight;
			}
			else 
			{
				pointerObj.css({
					top: pointerTop
				});
				top = top - pointerTop;
			}
			jqEle.show().css({
				left: (left) + "px",
				top: (top - pointerDimension) + "px"
			});
		} 
	}
}



Web2CalConstants.HIGHLIGHT_TIME=1800; 
Web2CalConstants.START_OF_WEEK = 0; 
Web2CalConstants.NEW_EVENT_POPUP_WIDTH	= "500px"; 
Web2CalConstants.NEW_EVENT_POPUP_HEIGHT	= "350px;";  
Web2CalConstants.MONTH_EVENT_HEIGHT = 20;	


SSPlotter.colors=new Array();
SSPlotter.colors.push({color:"teal", css: "tealTemplate"});
SSPlotter.colors.push({color:"lightGreen", css: "lightGreenTemplate"});
SSPlotter.colors.push({color:"brown", css: "brownTemplate"});
SSPlotter.colors.push({color:"blue", css: "blueTemplate"});
SSPlotter.colors.push({color:"green", css: "greenTemplate"});
SSPlotter.colors.push({color:"gray", css: "grayTemplate"});
SSPlotter.colors.push({color:"dirtyPink", css: "dirtyPinkTemplate"});
SSPlotter.colors.push({color:"purple", css: "purpleTemplate"});
SSPlotter.colors.push({color:"cyan", css: "cyanTemplate"});
SSPlotter.colors.push({color:"brick", css: "brickTemplate"});
SSPlotter.colors.push({color:"lightPurple", css: "lightPurpleTemplate"});
SSPlotter.colors.push({color:"brightGreen", css: "brightGreenTemplate"});
SSPlotter.colors.push({color:"dirtyYellow", css: "dirtyYellowTemplate"});
SSPlotter.colors.push({color:"brightBlue", css: "brighBlueTemplate"});
SSPlotter.colors.push({color:"pink", css: "pinkTemplate"});

