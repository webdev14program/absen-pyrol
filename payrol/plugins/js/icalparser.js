/**
http://skogsmaskin.dyns.net/projects/ical_javascript_parser/iCalReader.js   
iCalendar Reader for Javascript v. 1.1
    Parses and reads iCalendar data format.

    By Per-Kristian Nordnes (pk@yammin.com), august 2007.  
    Copyright (C) 2007 - Per Kristian Nordnes.
    All rights reserved.  
The parsing algorithm in iCalendar.parse() is inspired by a PHP-script by Roman OÅ¾ana.
   
      Web2Cal has slightly modified this script to suit web2cal format
*/
Web2Cal.readIcal=function(path, callback, opts )
{ 
	var arr=new Array();
	if(SSUtil.isString(path))
	{
		arr.push(path);
	}
	else
	{
		arr=path;
	}

	var icalGroups=new Array();
	for(var i=0; i<arr.length; i++)
	{
		jQuery.get(arr[i], [],
			function (content)
				{  var icalParser=new iCalReader();
					icalParser.prepareData(content);
					icalParser.parse(); 

					var calendarPropertyNames = icalParser.getCalendar().getPropertyNames(); // Get the list of availale properties.           
					var calendarInfo="";
					for(var i=0; i<calendarPropertyNames.length; i++) { // Loop through all the properties.

						var propertyName = calendarPropertyNames[i];
						var propertyValue = icalParser.getCalendar().getProperty(propertyName);
					 
						calendarInfo = "Calendar property '"+propertyName+"' has value: '"+propertyValue+"'<BR/>" ;
					 
					}       
					var calendarObj= icalParser.getCalendar(); // Get all events.
			 		
				//	var list=new Array();
					//list.push(calendarObj);
				 	//ical.render(list); 
					icalGroups.push(calendarObj);
					//sslg(calendarObj.name+" - "+icalGroups.length);
					if(icalGroups.length==arr.length)
					{
				 		callback(icalGroups);
				 	}
			} 
			, "text")
	}
}
function iCalReader() {
	this.data = null; // Holds the iCalendar input data.
	this.calendar = new vCalendar(); // The VCALENDAR object.
	this.eventCount = -1; // Tracks the number of events in the calendar.
	this.lastKey = null;	// Reference to last proccessed key (property).
}
iCalReader.stripTime=function(utc)
{
	var t= ( utc.getTime() - ((utc.getHours()*60*60*1000) + ( utc.getMinutes() *60*1000 )+(utc.getSeconds()*1000)+utc.getMilliseconds() ));
	return t;
}
  // Class methods
  function convertIcalKey(k, isGroup)
  {
  var key="";
  	switch(k) {	
  			case 'DTSTART':
				key="startTime";
				break;
			case 'DTEND':
				key="endTime";
				break;
			case 'UID':
				key="eventId";
				break;    
			case 'PRODID':
				key="groupId";
				break;    
			case 'X-WR-CALNAME':
				key="name";
				break;    
			case 'DESCRIPTION':
				key="description"; 
				break;    
			case 'SUMMARY':
				key="name"; 
				break;    
			case 'LOCATION':
				key="location";
				break;    
			// Add data to the calendar or event.
			default:
				 key=k;
  	}
  	if(isGroup && key=="eventId")
  		key="groupId";
	
  	return key;
  }
  iCalReader.prototype = {
  /**
   * Prepares and sets the data for the parser.
   * @input calendar file data (string).
   * @throws invalidCalendarException
   * @return prepared data (array of lines)       
   */     
      prepareData: function(data) {
        // Fix for malformed Mozilla VCALENDAR syntax.
      	this.data = data.replace(/[\r\n]{1,} ([:;])/g, '$1');
      	// Make array of all the lines.
        this.data = this.data.split(/\r?\n/);                
        // Is it really a VCALENDAR?
        if(this.data[0].indexOf('BEGIN:VCALENDAR') == -1) {
          throw('invalidCalendarException');
        }
      	return this.data;
      },
	/**
	 * Method that does the actual parsing.
	 */   	
      parse: function() {
      	this.calendar = new vCalendar();
        // Loop through all lines and analyze them.
      	for(var i=0; i<this.data.length; i++) {
    			var line = this.data[i];
  			 // Get possible key/value for line.
  				var values = this.returnKeyValue(line);
  				key = values[0];
  				value = values[1];
  				switch(line) {	
  					// It's a new event.
  					case 'BEGIN:VEVENT':
  						this.eventCount++;
  						type = 'VEVENT';
  						break;
  					// It's a calendar property.
  					case 'BEGIN:VCALENDAR':
  					case 'BEGIN:DAYLIGHT':
  					case 'BEGIN:VTIMEZONE':
  					case 'BEGIN:STANDARD':
  						type = value;
  						break;
  					// It's the end of the calendar property or event.
  					case 'END:VEVENT':
  						this.addCommonEventProperties(type, key, value);
  					case 'END:VCALENDAR':
  					case 'END:DAYLIGHT':
  					case 'END:VTIMEZONE':
  					case 'END:STANDARD':
  						type = 'VCALENDAR';
  						break;
  					// Add data to the calendar or event.
  					default:
  						this.addToCalendar(type, key, value);
  						break;
  				}				
        } 
      },
      addCommonEventProperties: function (type, key, value) {  
      
      	 this.calendar.getWeb2CalEvent(this.eventCount)["group"]={groupId:this.calendar.groupId, name: this.calendar.name}
      },
  /**
   * Adds data to the calendar object from the parser.
   * @input type of current item in parsing queue.
   * @input key (name) of item property.
   * @input value of item property.                     
   */     
      addToCalendar: function(type, key, value) {    
        // Make a new event if we are not proccessing a current one and type is VEVENT.
        if(type == 'VEVENT') {        
          try {
            var event = this.calendar.getEventAtIndex(this.eventCount);
          } catch(e) {
            var event = new vEvent();
            this.calendar.addEvent(event);
            this.calendar.addWeb2CalEvent({});
          }
        }    
        // If no key, add the current value to currently proccessing property's value.
    		if (key == false) {
    			key = this.lastKey;
    			var oldValue;
    			switch(type) {
    				case 'VEVENT':
    			      oldValue = this.calendar.getEventAtIndex(this.eventCount).getProperty(key); 			 
                value = oldValue+this.trimStart(value);
                break;
    			}
    		}
    		// Convert calendar date properties to javascript date.
    		if ((key == 'DTSTAMP') || (key == 'LAST-MODIFIED') || (key == 'CREATED')) {
    		    value = this.toDate(value);
        } 
        // Convert event date properties to own detailed mapping.
    		if (key.indexOf('DTSTART') > -1 || key.indexOf('DTEND') > -1) {
    		    var dateArray = this.toDateProperties(key,value);
    		    key = dateArray[0];
    		    value = dateArray[1];
        }
    		// Parse any rules for item.
        if (key == 'RRULE' ) {
          value = this.makeRuleProperties(value);
        }
        // Add the data.    
        switch(type) {
          // It's an event. Add property and value to event.
    			case 'VEVENT': 
    	   var v=value;
		   //Escape some characters. This is a temporary fix.	
	
			
    	    if(value.properties && value.properties.JSDATE!=undefined){    	    
				var dx=value.properties.JSDATE;
				var ms=dx.getMinutes();
				dx.setMinutes(ms-dx.getTimezoneOffset());
    	       v=dx;
    	     }
			
			if(key=="UID")		{
				 v=v.replace(/\@/g, "");
				 v=v.replace(/\./g, "");
			}
    	    this.calendar.getWeb2CalEvent(this.eventCount)[convertIcalKey(key)]=v;
			if (convertIcalKey(key) == "endTime") 
			{
				var st=this.calendar.getWeb2CalEvent(this.eventCount).startTime;
				var ed=this.calendar.getWeb2CalEvent(this.eventCount).endTime;
				if((( iCalReader.stripTime(ed)-iCalReader.stripTime(st) )/864e5)  > 1)
				{
					this.calendar.getWeb2CalEvent(this.eventCount).allDay=true;
				}

			}
            this.calendar.getEventAtIndex(this.eventCount).setProperty(key,value);
            break;
    			// It's a calendar's property. 
    			default:
					
				
    				this.calendar[convertIcalKey(key, true)]=value;
    				this.calendar.setProperty(key,value);
    				break;
    		}
        // Reference last proccessed key.
        this.lastKey = key;
    	},
  /**
   * Make rule property map.
   * @input string RRULE-string.
   * @return PropertyMap of rules.   
   */     
      makeRuleProperties: function(value) {      
        var ruledata = value.split(';');
        var rule = new PropertyMap();
        for(var r in ruledata) {
            var data = ruledata[r].split('=');
            rule.put(data[0], data[1]);
        }
        return rule;
      },    	
  /**
   * Parse a VEVENT type date to a own property map object.
   * @input string property name (like "DTSTART;TZID=Europe/Oslo")
   * @input string property value (like "20070719T220000").       
   * @return array(string DTSTART or DTEND, PropertyMap{ property JSDATE = [Date], property TZID = [string] } )   
   */     
      toDateProperties: function(key,value) {

          var dtProperty = new PropertyMap();
          dtProperty.put('TZID', 'Undefined'); // Default in case we don't find any timezone data.
          
          // Convert time to JS-date and make property.
          dtProperty.put('JSDATE', this.toDate(value));

          // Get date info from key value.
          var dtInfo = key.split(';');
          
          key = dtInfo[0]; // Shorten the key to read DTSTART or DTEND not "DTSTART;TZID=Europe/Oslo".
          dtProperty.put(key, value);
          
          if(typeof(dtInfo[1]) != 'undefined') { // Timezone is specified.
            // Get timezone.
            var tzInfo = dtInfo[1].split('=');
            var timezoneValue = tzInfo[1];
            dtProperty.put('TZID', timezoneValue);
        		return new Array(key,dtProperty);          
          } else {
            // Try get the calendar default TZ.
            try { dtProperty.put('TZID', this.calendar.getProperty('TZID')); } catch(e) {}
            try { dtProperty.put('TZID', this.calendar.getProperty('X-WR-TIMEZONE')); } catch(e) {}            
            return new Array(key,dtProperty);
        	}
      },
  /**
   * Convert a iCal type timestamp to Javascript date.
   * @input calendar type date string.
   * @return javascript date object.
   * @throws invalidDateException.     
   */     
      toDate: function(dateString) {
        dateString = dateString.replace('T', '');
        dateString = dateString.replace('Z', '');
        var pattern = /([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})([0-9]{0,2})/; 
        
        try {
          var dArr = pattern.exec(dateString);
          var calDate = new Date();

          var months = (dArr[2][0] == '0') ? dArr[2][1] : dArr[2];
          months = parseInt(months)-1;
          var days = (dArr[3][0] == '0') ? dArr[3][1] : dArr[3];
          days = parseInt(days);
          
          var hours = (dArr[4][0] == '0') ? dArr[4][1] : dArr[4];
          hours = hours == '' ? '0' : hours;
          hours = parseInt(hours);
          
          var minutes = (dArr[5][0] == '0') ? dArr[5][1] : dArr[5];
          minutes = minutes == '' ? '0' : minutes;
          minutes = parseInt(minutes);
          
          var seconds = (dArr[6][0] == '0') ? dArr[6][1] : dArr[6];
          seconds = seconds == '' ? '0' : seconds;
          seconds = parseInt(seconds);
          
          calDate.setFullYear(dArr[1]);
          calDate.setMonth(months);
          calDate.setDate(days);
          calDate.setHours(hours);
          calDate.setMinutes(minutes);
          calDate.setSeconds(seconds);

        } catch(e) {
          throw('invalidDateException');
        }
        return calDate;
      },
  /**
   * Returns a possible value/key-set of a calendar data line.
   * @input calendar data line (string).
   * @return array of key,value.       
   */     
    	returnKeyValue: function(line) {    
        // Regex for VCALENDAR syntax. Match letters in uppercase in the beginning
        // of the line followed by VCALENDAR-type operator and value.
        var pattern = /^([A-Z]+[^:]+)[:]([\w\W]*)/;
        var matches = pattern.exec(line);
        if(matches) {
              return matches.splice(1,2);
        }
        // No key found, just return value.
        return new Array(false,line);
    	},
  /**
   * Trims the beginning of string one whitespace character.
   * @input string to trim.
   * @return trimmed string.          
   */     
      trimStart: function(str) {
        str=str.replace(/^\s{0,1}(.*)/, '$1');
        return str;
      },            
	/**
	 * Get the calendar object for the reader.
	 * @return vCalendar object.    	 
	 */   	
    	getCalendar: function() {
    		return this.calendar;
    	},
  /**
   * Sorts the calendar events by time desc.   
   *
   */
      sort: function(){
        this.calendar.sort();
      }     
}

/**
 * Object to hold the calendar propterties.
 */   
function vCalendar() {
    this.vEvents = new Array();
    this.events=new Array();
    this.properties = new PropertyMap();
}
    // Class methods
    
  vCalendar.prototype = {
  /**
   * Gets the event array.
   * @return array of event objects.       
   */ 
      getEvents: function() {
        return this.vEvents;
      }, 
      events: function() {
        return this.vEvents;
      },
  /**
   * Gets the properties hashmap.
   * @return PropertyMap.       
   */     
      getProperties: function() {
        return this.properties;
      },
  /**
   * Get the number of events.
   * @return number   
   */        
      getNrOfEvents: function() {
        return this.vEvents.length;
      },
  /**
   * Sorts the array of events by time desc.   
   *
   */
      sort: function(){
        this.vEvents = this.vEvents.sort(this.sortByDate);
      },        
  /**
   * Get list of available properties for the calendar.
   * @return array of strings.       
   */     
      getPropertyNames: function() {
        return this.properties.keys();
      },
  /**
   * Get an event at a given index.
   * @input int index.
   * @return vEvent event.              
   */
      getEventAtIndex: function(index) {
        var evt = this.vEvents[index];
        if(typeof(evt) == 'undefined') {
          throw('eventNotFoundException');
        }
        return this.vEvents[index];
      } ,
      createWeb2CalEventObject: function(evt)
      { 
      	/*return {eventId: evt.getEventId(), startTime:evt.getStartDate()
      			, endTime:evt.getEndDate()
      			//, group:{groupId: this.getProperty("PRODID"), name: this.getProperty("X-WR-CALNAME")}
      			, allDay: false      			
      			} ;
      		*/return evt;
      },
      
  /**
   * Get value of a given property.
   * @input string property name.
   * @return object value.         
   */
      getProperty: function(property) {  
        try {
          return this.properties.get(property);      
        } catch(e) {
          throw(e); 
        }
      },
  /**
   * Adds a vEvent object to the event array.
   * @input vEvent event.       
   */
      addEvent: function(vEvent) {
     //  this.vEvents.push(this.createWeb2CalEventObject(vEvent) ) ;
       this.vEvents.push(vEvent);
      },
      addWeb2CalEvent: function(vEvent) { 
     //  this.vEvents.push(this.createWeb2CalEventObject(vEvent) ) ;
       this.events.push(vEvent);
      },
      getWeb2CalEvent: function(index) {
        var evt = this.events[index];
        if(typeof(evt) == 'undefined') {
          throw('eventNotFoundException');
        }
        return this.events[index];
      } ,
  /**
   * Set a property to the calendar.
   * @input string property name.
   * @input object value.              
   */
      setProperty: function(property, value) {
        if(typeof(property) == 'string' && property != null && property != '') {      
          this.properties.put(property,value);
        } else {
          throw('invalidKeyNameException');
        }
      },
  /**
   * Sorting method for the events.
   *
   */
      sortByDate: function(a, b) {
          var x = a.getStartDate();
          var y = b.getStartDate();
          return ((x < y) ? -1 : ((x > y) ? 1 : 0));
      }      
  }

/**
 * Object to hold the VEVENT propterties.
 */   
function vEvent() {
  this.properties = new PropertyMap();
  
}
  // Class methods
  
  vEvent.prototype = {
  	toString:function()
  	{
  		return "VEVENT";
  	},
    /**
     * Get start time for event.
     * @return Date start.         
     */
        getStartDate: function() {
           var dt = this.getProperty('DTSTART');
           return dt.get('JSDATE');
        },
  	
    /**
     * Get end time for event.
     * @return Date end.              
     */
        getEndDate: function() {
           var dt = this.getProperty('DTEND');
           return dt.get('JSDATE');
        },
    /**
     * Get timezone for event.
     * @return string timezone.              
     */
        getTimeZone: function() {
           var dt = this.getProperty('DTSTART');
           return dt.get('TZID');
        },
        
        getEventId: function(){
        	var evId=this.getProperty('UID');
        	return evId;
        },
    /**
     * Get rules for event.
     * @return PropertyMap of rules.              
     */
        getRuleProperties: function() {
            var r;
            try {
              var r = this.getProperty('RRULE');
            } catch(e) {
              r = new PropertyMap();
            }
            return r;
        },
    /**
     * Get a property by name.
     * @input string property
     * @return property value.
     * @throws invalidPropertyException.         
     */     
        getProperty: function(property) {  
          try {
            return this.removeSlashes(this.properties.get(property));      
          } catch(e) {
            throw(e); 
          }
        },
    /**
     * Sets a property with given name and value.
     * @input string property name.
     * @input object value.              
     */
        setProperty: function(property, value) {
            if(typeof(property) == 'string' && property != null && property != '') {
              this.properties.put(property, value);
            } else {
              throw('invalidKeyNameException');
            }
        },
    /**
     * Get property with given key in HTML-format.
     * @input string property name.       
     * @return HTML-string.       
     */
        getHtmlValue: function(property) {
          prop = this.removeSlashes(this.properties.get(property));
          if(typeof(prop) == 'string') {
            prop = prop.replace('\n','<br/>', 'g');
            return prop; 
          } else {
            return prop;
          }                    
        },
    /**
     * Get a list of property- names for this event.
     * @return array of strings.       
     */     
        getPropertyNames: function() {
          return this.properties.keys();
        },
    /**
     * Removes slashes from a string
     * @input string.       
     * @return fixed string.       
     */  
        removeSlashes: function(str) {
            if(typeof(str) == 'string') {
              str = str.replace('\\n','\n', 'g');
              str = str.replace('\\,','\,', 'g');
              str = str.replace('\\;','\;', 'g');
            }    
            return str;
        }  
  }

/**
 * Hashmap class to hold properties
 * for calendar and events.   
 */ 
function PropertyMap()  {   
  this.size = 0;   
  this.properties = new Object();
}

  // Class methods
  
  PropertyMap.prototype = {
    /**
     * Add or update property.
     */            
        put: function(key, value) {   
          if(!this.containsKey(key)) {   
              this.size++ ;   
          }   
          this.properties[key] = value;   
        },   
    /**
     * Get property with given key.
     * @input property name.     
     * @return object.
     * @throws invalidPropertyException.
     */            
        get: function(key) {
          if(this.containsKey(key)) {
            return this.properties[key];
          } else {
            throw('invalidPropertyException');
          }   
        },
    /**
     * Alias for get method to keep consistancy in syntax in regard to the other classes.
     * @input property name.     
     * @return object.
     * @throws invalidPropertyException.
     */            
        getProperty: function(key) {
          try {
            return this.get(key);
          } catch(e) {
            throw(e);
          }
        },
    /**
     * Remove property with key.
     */
        remove: function(key) {   
          if( this.containsKey(key) && (delete this.properties[key])) {   
              size--;   
          } 
        },   
    /**
     * Check if a property exists.
     */
        containsKey: function(key) {   
          return (key in this.properties);   
        },    
    /**
     * Check if a value exists.
     * @return boolean.     
     */
        containsValue: function(value) {   
          for(var prop in this.properties) {   
              if(this.properties[prop] == value) {   
                  return true; 
              }   
          }   
          return false;   
        },   
    /**
     * Get all the values.
     * @return array of values.     
     */
        values: function () {   
          var values = new Array();   
          for(var prop in this.properties) {   
              values.push(this.properties[prop]);   
          }   
          return values;   
        },
    /**
     * Get all the keys.
     * @return array of keys.     
     */
        keys: function () {   
          var keys = new Array();   
          for(var prop in this.properties) {   
              keys.push(prop);   
          }   
          return keys;   
        },
    /**
     * Get the size of map.
     * @return int size.     
     */
        size: function () {   
          return this.size;   
        },   
    /**
     * Clears all properties.
     */
        clear: function () {   
          this.size = 0;   
          this.properties = new Object();   
        },
    /**
     * Gives a string representation of this propertymap.
     */         
        toString: function() {
            var str = '';
            for(var prop in this.properties) {   
                str += prop+'='+this.get(prop)+', ';   
            }        
            return '{ '+str.substring(0,(str.length-2))+' }'; 
        }
}   
