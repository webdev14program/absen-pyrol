
CREATE TABLE `calendar` (
  `calendar_id` int(11) NOT NULL auto_increment,
  `calendar_name` varchar(20) default NULL,
  PRIMARY KEY  (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO calendar(calendar_id,calendar_name) VALUES (1,'Work'), (2,'Personal');

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL auto_increment,
  `event_name` varchar(20) default NULL,
  `event_description` varchar(20) default NULL,
  `calendar_id` int(11) default NULL,
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  `all_day` smallint(6) default '0',
  `repeat_mode` varchar(11) default NULL,
  `repeat_count` int(11) default NULL,
  `day_only_weekdays` int(11) default NULL,
  `week_days` varchar(20) default NULL COMMENT 'comma number of days',
  `month_weeknumber` int(11) default NULL,
  `month_weekday` int(11) default NULL,
  `month_repeatdate` datetime default NULL,
  `event_type` varchar(20) default NULL,
  `rel_event_id` int(11) default NULL,
  `repeat_end_date` datetime default NULL,
  `event_delete_ind` int(11) default NULL,
  `recur_sequence` int(11) default NULL,
  PRIMARY KEY  (`event_id`),
  KEY `events_ibfk_1` (`calendar_id`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
