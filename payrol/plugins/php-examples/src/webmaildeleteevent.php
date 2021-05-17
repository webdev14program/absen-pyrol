<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
?>
<?php
class webmaildeleteevent 
{
	var $queryVars;
	function webmaildeleteevent ($queryVars)
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
		  
		 $eventId=$this->queryVars['eventId']; 
		 $deleteAll=$this->queryVars['deleteAll']; 
		 $seq=$this->queryVars['sequence']; 
		$input=array();
		
		$input['name']=$name; 
		$input['eventId']=$eventId;



		//If the object is a recurring object, then add an exclusion with delete indicator =true
		$event=$db->get_row("select * from events where event_id=".$eventId);
		if($event->repeat_mode!=null && $event->repeat_mode!="")
		{
			//its recurring event;
			//check if user wants to delete just this occurence or all of the events. else insert an "exclude". web2cal will treat this as an exception.
			if($deleteAll==0)
			{
					$db->query("INSERT INTO EVENTS (event_delete_ind, rel_event_id, event_type, calendar_id, start_time, end_time,recur_sequence) values (1, ".$eventId.", 'EXCLUDE', ".$event->calendar_id.", '".$event->start_time."', '".$event->end_time."', ".$seq.")");
					
				//	$input['eventId']=$db->insertedId;
					$input['eventType']="EXCLUDE";
					$input['relEventId']=$eventId;
					$input['deleted']=true;
					$input['sequence']=$seq;
					$input['startTime']=$event->start_time;
					$input['endTime']=$event->end_time;
					$input['group']['groupId']=$event->calendar_id;
			}else
			{
				$db->query("delete from events  where event_id=".$eventId);
					$input['relEventId']=$eventId;
			}

		}else //its not a recurring event.. just delete the entire event
		{ 
			$db->query("delete from events  where event_id=".$eventId);
		}  
		return $input;
	}
	function is_authorized()
	{
		return true;
	}
}

?>