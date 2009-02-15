--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountid` int(11) NOT NULL auto_increment,
  `contactid` int(11) NOT NULL default '0',
  `name` varchar(100) collate utf8_bin NOT NULL,
  `identifier` varchar(32) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`accountid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactid` int(11) NOT NULL auto_increment,
  `fname` varchar(20) collate utf8_bin NOT NULL,
  `lname` varchar(20) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `phone` varchar(10) collate utf8_bin NOT NULL,
  `address1` varchar(100) collate utf8_bin NOT NULL,
  `address2` varchar(100) collate utf8_bin default NULL,
  `city` varchar(50) collate utf8_bin NOT NULL,
  `state` varchar(20) collate utf8_bin NOT NULL,
  `zip` varchar(5) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`contactid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceid` int(11) NOT NULL auto_increment,
  `accountid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `due` datetime NOT NULL,
  `paid` datetime NOT NULL,
  PRIMARY KEY  (`invoiceid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='YYYY-MM-DD HH:MM:SS (24-hour)' AUTO_INCREMENT=1 ;