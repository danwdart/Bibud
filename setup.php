<?php
include 'includes/db_connect.php';

$q5="
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL auto_increment,
  `author_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(20000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$q6="
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL auto_increment,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `text` varchar(20000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";

$q7 = "CREATE TABLE IF NOT EXISTS `users` (
		`id` int(11) NOT NULL auto_increment,
		`username` VARCHAR(64) NOT NULL ,
		`password` VARCHAR(64) NOT NULL,
		`fname` VARCHAR(48) NOT NULL ,
		`lname` VARCHAR(48) NOT NULL ,
		`email` VARCHAR(128) NOT NULL ,
		`useragent` VARCHAR(256) NOT NULL ,
		`IP` VARCHAR( 15 ) NOT NULL ,
		`joindate` DATE NOT NULL ,
		`isEnabled` BOOL NOT NULL ,
		`level` TINYINT NOT NULL ,
		`lastActive` DATE NOT NULL ,
		`theme` VARCHAR ( 50 ) NOT NULL,
		`background` VARCHAR ( 50 ) NOT NULL,
		`background_repeat` VARCHAR( 20 ) NOT NULL DEFAULT 'no-repeat',
PRIMARY KEY  (`id`) )ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

$q8 =  "CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_1` varchar(20) NOT NULL,
  `user_2` varchar(20) NOT NULL,
  `xgroup` varchar(20) NOT NULL,
  `xstatus` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$q9 = "CREATE TABLE IF NOT EXISTS `shared_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `tags` varchar(512) NOT NULL,
  `views` int(11) NOT NULL,
  `path` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";


$q10 = "CREATE TABLE IF NOT EXISTS `videos_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `replyTo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$q11 = "CREATE TABLE IF NOT EXISTS `chatroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `chattext` varchar(500) NOT NULL,
  `chatdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

$q12 = "CREATE TABLE IF NOT EXISTS `chatroom_online` (
`user_id` INT(11) NOT NULL ,
`time` INT NOT NULL
) ENGINE = MyISAM ;";

mysql_query("CREATE TABLE IF NOT EXISTS `media` (
        `id` int(10) NOT NULL auto_increment,
	`user_id` int(11) NOT NULL,
        `artist` varchar(40) NOT NULL default 'Unknown Artist',
        `album` varchar(80) NOT NULL default 'Unknown Album',
        `title` varchar(40) NOT NULL default 'Unknown Title',
        `track` int(3) NOT NULL default '0',
        `comments` text NULL,
        `path` varchar(255) NOT NULL,
        PRIMARY KEY  (`id`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1") or die("Can't create media table!");

mysql_query( "CREATE TABLE IF NOT EXISTS `video` (
        `id` int(10) NOT NULL auto_increment,
	`user_id` int(11) NOT NULL,
        `artist` varchar(40) NOT NULL default 'Unknown Artist',
        `album` varchar(80) NOT NULL default 'Unknown Album',
        `title` varchar(40) NOT NULL default 'Unknown Title',
        `track` int(3) NOT NULL default '0',
        `comments` text NULL,
        `path` varchar(255) NOT NULL,
        PRIMARY KEY  (`id`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1") or die("Can't create videos table!");

mysql_query("CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) collate latin1_general_ci NOT NULL,
  `path` varchar(512) collate latin1_general_ci NOT NULL,
  `thumb_path` varchar(512) collate latin1_general_ci NOT NULL,
  `orientation` varchar(1) collate latin1_general_ci NOT NULL, 
  `comments` varchar(512) collate latin1_general_ci NULL,
  `rating` int(11) default NULL,
  `date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;") or die("Can't create pictures table!");

mysql_query("CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) collate latin1_general_ci NULL,
  `body` varchar(400) collate latin1_general_ci NULL,
  `date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;") or die("Can't create notes table!");

if (!mysql_query($q5)) {
echo "Cannot create blog table! ".mysql_error();

}
if (!mysql_query($q6)) {
echo "Cannot create email table! ".mysql_error();

}
if (!mysql_query($q7)) {
echo "Cannot create userinfo table! " .mysql_error();

}

if (!mysql_query($q8)) {
echo "Cannot create friends table! ".mysql_error();

}

if (!mysql_query($q9)) {
echo "Cannot create videos table! ".mysql_error();
}

if (!mysql_query($q10)) {
echo "Cannot create video comments table! ".mysql_error();
}

if (!mysql_query($q11)) {
echo "Cannot create chatroom data table! ".mysql_error();
}

if (!mysql_query($q12)) {
echo "Cannot create chatroom daemon table! ".mysql_error();
}

// Now create Demo User


$dq_userinfo = "INSERT INTO `users` (`username`,`password`,`fname`,`lname`,`email`,`useragent`,`IP`,`joindate`,`isEnabled`,`level`,`lastActive`,`theme`,`background`,`background_repeat`)
VALUES ('demouser','".sha1("demopass")."','Demo', 'User', '', 'Bibud', '127.0.0.1', '".date("Y-m-d")."', '1', '1', '".date("Y-m-d")."', 'default', '../../default/emotion1.jpg', 'none');";
//erind's Files table
/*
$dfilesquery="CREATE TABLE IF NOT EXISTS `files` (
`id` int(11) NOT NULL auto_increment,
`name` varchar(255) collate latin1_general_ci NOT NULL,
`path` varchar(512) collate latin1_general_ci NOT NULL,
`mimetype` varchar(40) collate latin1_general_ci default NULL,
`size` int(12) NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;";
*/

$dnotesquery="CREATE TABLE IF NOT EXISTS `notes` (
`id` int(11) NOT NULL auto_increment,
`user_id` int(11) NOT NULL,
`title` varchar(30) collate latin1_general_ci NOT NULL,
`body` varchar(400) collate latin1_general_ci NOT NULL,
`date` date collate latin1_general_ci default NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;";


if (!mysql_query($dq_userinfo)) {
	echo("Can't insert userinfo! Error performing query: ".mysql_error());
}
/*
if  (!mysql_query($dfilesquery)) {
echo("Can't create files table!!".mysql_error());
exit();
}
*/
if  (!mysql_query($dnotesquery)) {
echo("Can't create notes table!!".mysql_error());
exit();
}

mysql_close();

?>
<br />Initialised Bibud. If you see any errors, then something has gone wrong.
