<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
include('common.php');  
?>
<?php 

class webmailgetevents 
{
	var $queryVars;
	function webmailgetevents($queryVars)
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
		$res = $db->get_results("select calendar_id, calendar_name from calendar");   
 
		$ax=array();
		//return count($res);
		//
		$count=0;
		foreach ($res as &$value) {
			
			$count=$count+1;
			$calendar='';
			$calendarId=$value->calendar_id;
			$name=$value->calendar_name;

			
			//Get Events for the calendar... 
			$condition=array();
			$condition['calendar_id']=$calendarId;
			$resEvents = $db->get_results("select * from events where calendar_id=".$calendarId);   
			$eventsarray=array(); 
			$evCount=0;
			  
    		if(count($resEvents)>0)
			{ 
				foreach($resEvents as &$evVal)	
				{
						$evCount=$evCount+1;
						$event=getEventFromTable($evVal); 
						$eventsarray[$evCount]=$event; 
					
				}
				$calendar['events']=$eventsarray;
			}
			
			$calendar["groupId"]=$calendarId;
			$calendar["name"]=$name;
			$ax[$count]=$calendar;
			
		}
		return $ax; 
	}
	function is_authorized()
	{
		return true;
	} 

}

?>