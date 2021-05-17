<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
?>
<?php
class updateeventfull 
{
	var $queryVars;
	function updateeventfull($queryVars)
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
		 
		$allday=$this->queryVars['allDay'];
		$sTime=$this->queryVars['st'];
		$eTime=$this->queryVars['et'];
		$evName=$this->queryVars['eventName'];
		$desc=$this->queryVars['desc'];
		$allDayIndicator=$this->queryVars['allDay'];
		$eventId=$this->queryVars['eventId'];
		$groupId=$this->queryVars['groupId'];
		$input=array();
		
		$input['eventId']=$eventId;
		$input['startTime']=$sTime;
		$input['endTime']=$eTime;   	
		$input['allDay']=($allday==1)?true:false; 
		$input['group']['groupId']=$groupId;
		$input['eventId'] = $eventId;
		//echo ($sTime."===".$eTime."update  events set start_time='".$sTime."',  end_time='".$eTime."', event_name='".$evName."',event_description='".$desc."', calendar_id='".$groupId."', all_day='".$allDayIndicator."'  where event_id=".$eventId);
		$db->query("update events set start_time='".$sTime."',  end_time='".$eTime."', event_name='".$evName."',event_description='".$desc."', calendar_id='".$groupId."', all_day='".$allDayIndicator."'  where event_id=".$eventId);
		  
		$input['eventName']=$evName;
		$input['eventDesc']=$desc;
			
		return $input;
	}
	
	function is_authorized()
	{
		return true;
	}
}

?>