<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
?>
<?php
class webmailcreateevent 
{
	var $queryVars;
	function webmailcreateevent($queryVars)
	{
		$this->queryVars = $queryVars; 
	}
	/**
	 * Method to return the status of the AJAX transaction
	 *
	 * @return  string A string of raw HTML fetched from the Server
	 */
	function return_response()
	{
		$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
		$sTimeStr=$this->queryVars['st'];
		$eTimeStr=$this->queryVars['et'];
		$evName=$this->queryVars['eventName'];
		$desc=$this->queryVars['desc'];
		$allDayIndicator=$this->queryVars['allDay'];
		$groupId=$this->queryVars['groupId'];


		$repeatMode=$this->queryVars['repeatMode'];
		$repeatCount=$this->queryVars['repeatCount'];
		$repeatEndDate=$this->queryVars['repeatEndDate'];
		$dayOptionOnlyWeekDays=$this->queryVars['onlyWeekDays'];//day repeat option
		$weekOptionWeekDays=$this->queryVars['weekdays'];//week repeat option
		
		$monthOptionWeekNumber=$this->queryVars['weekNumber'];//month repeat option
		$monthOptionWeekDay=$this->queryVars['weekDay'];//month repeat option
		$monthOptionRepeatDate=$this->queryVars['repeatDate'];//month repeat option

		$relEventId=$this->queryVars['relEventId'];//Related Event Id...
		$eventType=$this->queryVars['eventType'];

		$db->query("insert into events(event_name,event_description, calendar_id, all_day, start_time, end_time, repeat_mode, repeat_count, day_only_weekdays, week_days, month_weeknumber, month_weekday, month_repeatdate, event_type, rel_event_id, repeat_end_date) VALUES ('".$desc."', '".$desc."', '".$groupId."', ".$allDayIndicator.",  '".$sTimeStr."', '".$eTimeStr."' , '".$repeatMode."' , '".$repeatCount."' , '".$dayOptionOnlyWeekDays."' , '".$weekOptionWeekDays."' , '".$monthOptionWeekNumber."' , '".$monthOptionWeekDay."' , '".$monthOptionRepeatDate."'      ,null ,'".$relEventId."' , '".$repeatEndDate."' )");
		 
		$input=array(); 
		$input['eventName']=$desc;
		$input['eventDesc']=$desc;
		$input['group']['groupId']=$groupId; 
		
		if($allDayIndicator==0)
		{
			$input['allDay']=false;
		}else
		{
			$input['allDay']=true;
		}
		$input['eventId']=$db->insertedId;
		if($repeatEndDate=='null')
		{
			$db->query("update events set rel_event_id=".$input['eventId'].",repeat_end_date=null  where event_id=".$input['eventId']);
		}else
		{ 
			$db->query("update events set rel_event_id=".$input['eventId']." where event_id=".$input['eventId']);
		}
		$input['startTime']=$sTimeStr;
		$input['endTime']=$eTimeStr; 
 
		$rObj='';
		if($repeatEndDate=='null')
		{
			$rObj['endDate']=null; 
		}
		else
		{
			$rObj['endDate']=$repeatEndDate; 
		}
		$rObj['mode']=$repeatMode; 
		$rObj['repeatCount']=0; 
		if($dayOptionOnlyWeekDays==1)
		{
			$rObj['day']['onlyWeekDays']=true; 
		}
		else
		{
			$rObj['day']['onlyWeekDays']=false; 
		}
		$rObj['week']['days']=split(",", $weekDaysStr);; 
		$rObj['month']['weekNumber']=$monthOptionWeekNumber; 
		$rObj['month']['weekDay']=$monthOptionWeekDay; 
		$rObj['month']['repeatDate']=$monthOptionRepeatDate;  
		

		$input['repeatEvent']=$rObj;
		
		return $input;
		 
	}
	
	function is_authorized()
	{
		return true;
	}
}

?>