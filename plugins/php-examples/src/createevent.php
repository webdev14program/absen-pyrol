<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
?>
<?php
class createevent 
{
	var $queryVars;
	function createevent($queryVars)
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
		 

		$db->query("insert into events(event_name,event_description, calendar_id, all_day, start_time, end_time) VALUES ('".$desc."', '".$desc."', '".$groupId."', ".$allDayIndicator.",  '".$sTimeStr."', '".$eTimeStr."')");
		 
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
		$input['startTime']=$sTimeStr;
		$input['endTime']=$eTimeStr; 
	  
		return $input;
		 
	}
	
	function is_authorized()
	{
		return true;
	}
}

?>