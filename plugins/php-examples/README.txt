This software is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE. Use this at your own risk. 


Installation Instructions

1. Extract the entire package to a php capable server.
2. Create a database and run the sql script provided to create tables.
3. Edit src/dbconfig.php and update the database configuration.
 

The demo application uses a 3rdparty package [MyBIC] to provide ajax functionality. 
You can learn more here http://www.litfuel.net/mybic/. You are not limited to use this package. You can use any of the available ajax frameworks. 

The application is merely an example and is not the recommended style of programming. Nor do we recommend a particular package. 

DB-Structure Explained. 

	Calendar 
		-calendar_id - Unique identifier for the group
		-calendar_name - Name for this calendar
	Events
		event_id - Unique identifier for the event
		event_name - event name
		event_description - event description
		calendar_id - event belongs to which calendar.
		start_time - event start time
		end_time - event end time
		all_day - all day event identifier
		