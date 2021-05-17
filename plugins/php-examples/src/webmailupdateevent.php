<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
include('common.php');  
?>
<?php
class webmailupdateevent 
{
	var $queryVars;
	function webmailupdateevent($queryVars)
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
		 $saveOption=$this->queryVars['saveOption']; 
		 $seq=$this->queryVars['sequence']; 
		 $isRecurring=$this->queryVars['recurring']; 
		$input=array();
		
 
		if($isRecurring=="1")
		{
			if($saveOption=="ALL")
			{
				$db->query("update events set start_time='".$sTime."',  end_time='".$eTime."'  where event_id=".$eventId); 
				$input=getEventById($eventId);		
			}else
			if($saveOption=="ONE")
			{
					//if an event exists for the eventID and sequence, then update that event else insert... 
					$ev=$db->get_row("select * from events where rel_event_id=".$eventId." and recur_sequence=".$seq);
					if($ev->event_id>0)
					{
						$db->query("update events set start_time='".$sTime."',  end_time='".$eTime."'  where event_id=".$ev->event_id); 
					}
					else
					{
						$db->query("INSERT INTO EVENTS ( rel_event_id, event_type, calendar_id, start_time, end_time,recur_sequence) values ( ".$eventId.", 'EXCLUDE', '".$groupId."', '".$sTime."', '".$eTime."', ".$seq.")"); 	
					}


					
					$input=getEventById($eventId);	
					$input['eventType']="EXCLUDE";
					$input['sequence']=$seq; 
					$input['startTime']=$sTime; 
					$input['endTime']=$eTime; 
					$input['group']['groupId']=$groupId;
			}
		}else //its not a recurring event.. just delete the entire event
		{ 
			$db->query("update events set start_time='".$sTime."',  end_time='".$eTime."'  where event_id=".$eventId);	
			 
			$input=getEventById($eventId);	
		}  
		//After updating.. get the latest event object and return... 
		return $input;
	}
	
	function is_authorized()
	{
		return true;
	}
}

?>