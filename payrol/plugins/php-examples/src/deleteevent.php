<?php 
error_reporting(E_ERROR);
include('dbConfig.php');  
include('dbutil.php');  
?>
<?php
class deleteevent 
{
	var $queryVars;
	function deleteevent ($queryVars)
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
		$input=array();
		
		$input['name']=$name; 
		$input['eventId']=$eventId; 
		$db->query("delete from events  where event_id=".$eventId);
		 
		return $input;
	}
	function is_authorized()
	{
		return true;
	}
}

?>