--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `accountid` int(11) NOT NULL auto_increment,
  `contactid` int(11) NOT NULL default '0',
  `name` varchar(100) collate utf8_bin NOT NULL,
  `identifier` varchar(32) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`accountid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
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

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoiceid` int(11) NOT NULL auto_increment,
  `accountid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `due` datetime NOT NULL,
  `paid` datetime NOT NULL,
  `paymethod` varchar(255) collate utf8_bin default NULL,
  PRIMARY KEY  (`invoiceid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lineitem`
--

CREATE TABLE IF NOT EXISTS `lineitem` (
  `lineitemid` int(11) NOT NULL auto_increment,
  `invoiceid` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) collate utf8_bin NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY  (`lineitemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;