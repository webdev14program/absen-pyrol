<?php

function getEventFromTable($arr)
{
		$event='';
		$event["eventId"]=$arr->event_id;
	  
		$event['eventName']=$arr->event_name;
		$event['eventDesc']=$arr->event_description;
		$event['startTime']=$arr->start_time;
		$event['endTime']=$arr->end_time;
		$event['group']['groupId']=$arr->calendar_id; 
		$event['eventType']=$arr->event_type; 
		$repeatEvent=''; 

		$repeatEvent['mode']=$arr->repeat_mode;
		$repeatEvent['repeatCount']=$arr->repeat_count;
		$repeatEvent['endDate']=$arr->repeat_end_date;

		//day repeat
		$dayOptionOnlyWeekDays=$arr->day_only_weekdays;						
		$repeatEvent['day']['onlyWeekDays']=($dayOptionOnlyWeekDays==1)?true:null; 
		
		//week repeat info
		$weekDaysStr=$arr->week_days;
		$repeatEvent['week']['days']=split(",", $weekDaysStr);
		
		//month
		$repeatEvent['month']['weekNumber']=$arr->month_weeknumber;
		$repeatEvent['month']['weekDay']=$arr->month_weekday;
		$repeatEvent['month']['repeatDate']=$arr->month_repeatdate; 
		$event['repeatEvent']=$repeatEvent;
		$event['relEventId']=$arr->rel_event_id; 
		$event['allDay']=($arr->all_day==0)?false:true; 
		$event['sequence']= $arr->recur_sequence;
		$event['deleted']=($arr->event_delete_ind==null || $arr->event_delete_ind==0 )?false:true;
		$eventsarray[$evCount]=$event; 
		return $event;
}

function getEventById($id)
{
		$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
		$evVal=$db->get_row("select * from events where event_id=".$id);
		$ev=getEventFromTable($evVal);	
		return $ev;
}
?>