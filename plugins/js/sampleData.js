/**
 * Creates Sample data for calendar.
 var group = {
		 name: <Calendar / Group Name>
		 groupId: <unique calendar / Group ID>
		 events{ [
			 <Event Object 1>,
			 <Event Object 2>,
			 <Event Object 3>,
			 <Event Object 4>,
			 <Event Object 5>,
			 ...
		 ]
 }
 var event = {
	 name: <String>,
	 eventId: <String /Number>,
	 location: <String>,
	 instructor: <String>,
	 startTime: <Date>,
	 endTime: <Date>,
	 description: <String>,
	 allDay: <boolean>
 }
 */
function getCalendarData()
{
    var d = new Array();
    var events = new Array();
    events.push(createEvent("Sales Meeting", 1, "Conf 201 ( 35th Floor )", "John Smith, Sue, James, Dan, Lisa", createDateTime(9, 0, 0), createDateTime(12, 0, 0), "Discuss Monthly Sales Target", false));
    events.push(createEvent("Discuss Application Design", 2, "Conf 805, 300 Pine St, 8th Fl", "App Design Team, John, Joe, Jane, Lisa", createDateTime(23, 0, -13), createDateTime(23, 30, -8), "Discuss design and refractor of Application interface", true));
    events.push(createEvent("Sample Event ", 3, "Test Location", "John Smith", createDateTime(23, 0, -4), createDateTime(23, 30, 0), "Yoga is good for health", true));
    events.push(createEvent("Event can span for many days", 5, "My Desk", "John Smith", createDateTime(23, 0, -4), createDateTime(23, 30, 1), "Yoga is good for health", true));
    events.push(createEvent("Web2Cal Supports any number of attributes", 6, "yoga aud", "John Smith", createDateTime(23, 0, -18), createDateTime(23, 30, -18), "Yoga is good for health", true));
    events.push(createEvent("Web2Cal use in all business", 7, "yoga aud", "John Smith", createDateTime(0, 30, -2), createDateTime(3, 30, -2), "Yoga is good for health", false));
 	events.push(createEvent("Test Event 200", 8, "yoga aud", "John Smith", createDateTime(5, 0, 1), createDateTime(8, 30, 1), "Yoga is good for health", false));
    events.push(createEvent("Another Event 300", 9, "yoga aud", "John Smith", createDateTime(9, 0, 2), createDateTime(12, 30, 2), "Yoga is good for health", false));
    
    var group = {
        name: "Category 1",
        groupId: "100",
		show:true,
        events: events 
    };
   d.push(group);
   
    var events = new Array();
    
	events.push(createEvent("Morning Yoga", 10, "Yoga Auditorium", "Instructor1", createDateTime(15, 0, 1), createDateTime(19, 30, 1), "Morning Yoga is good for health"));
    events.push(createEvent("Event <b>HTML</b> 2", 11, "Event Location 2", "Instructor2", createDateTime(8, 0, -1), createDateTime(10, 30, -1), "Event Description ..."));
    events.push(createEvent("<div style='color:red'>Event 3</div>", 12, "Event Location 3", "Instructor3", createDateTime(11, 0, 0), createDateTime(15, 45, 0), "Event Description ..."));
    events.push(createEvent("Customizable with Templates....", 13, "Event Location 4", "Instructor4", createDateTime(6, 0), createDateTime(10, 0), "Event Description ..."));
    events.push(createEvent("Event 5", 14, "Event Location 5", "Instructor5", createDateTime(7, 0), createDateTime(10, 0), "Event Description ..."));
    
    events.push(createEvent("Event 6", 15, "Event Location 6", "Instructor6", createDateTime(16, 0, -2), createDateTime(20, 0, -2), "Event Description ..."));
    events.push(createEvent("Event 7", 16, "Event Location 7", "Instructor7", createDateTime(10, 0, -3), createDateTime(15, 0, -3), "Event Description ..."));
    events.push(createEvent("Event 8", 17, "Event Location 8", "Instructor8", createDateTime(9, 0, -5), createDateTime(11, 15, -5), "Event Description ..."));
    events.push(createEvent("Event 9", 18, "Event Location 9", "Instructor9", createDateTime(9, 0, 1), createDateTime(11, 15, 1), "Event Description ..."));
    

    var group = {
        name: "Category 2",
        groupId: "200",
        events: events 
    }; 
   d.push(group);
    return d;
    
} 
function createDateTime(ti, h, numofDays)
{
    var dd = new Date();
    dd.setHours(ti);
    dd.setMinutes(h);
    
    var x = new UTC(dd.getTime());
    
    if (numofDays) 
    {
        x = new UTC();
		x.addDays(numofDays);
    } 
    return x;
}

function createEvent(name, id, location, instructor, timestart, timeend, desc, allDay, repeatObject)
{

    if (allDay == undefined) 
        allDay = false;
    
    return {
        name: name,
        eventId: id,
        location: location,
        instructor: instructor,
        startTime: timestart.getDateObj(),
        endTime: timeend.getDateObj(),
        description: desc,
        allDay: allDay,
        repeatEvent: repeatObject
    };
} 