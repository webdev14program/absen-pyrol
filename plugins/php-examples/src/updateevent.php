<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
?>
<?php
class updateevent 
{
	var $queryVars;
	function updateevent($queryVars)
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
		$eventId=$this->queryVars['eventId'];
		$groupId=$this->queryVars['groupId'];
		$input=array();
		
		$input['eventId']=$eventId;
		$input['startTime']=$sTime;
		$input['endTime']=$eTime;   	
		$input['allDay']=($allday==1)?true:false; 
		$input['group']['groupId']=$groupId;
		$db->query("update events set start_time='".$sTime."',  end_time='".$eTime."'  where event_id=".$eventId);
		
		//After updating.. get the latest event object and return...
		$event=$db->get_row("select * from events where event_id=".$eventId);
		$input['eventName']=$event->event_name;
		$input['eventDesc']=$event->event_desc;
		 
		return $input;
	}
	
	function is_authorized()
	{
		return true;
	}
}

?>