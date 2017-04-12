--
-- Table structure for table `vspc_press_releases`
--

CREATE TABLE IF NOT EXISTS `vspc_videos` (
  `vspc_video_id` int(11) NOT NULL AUTO_INCREMENT,
  `vspc_title` varchar(100) NOT NULL,
  `vspc_summary` varchar(1250),
  `vspc_date_release` datetime NOT NULL,
  `vspc_link` varchar(1250) NOT NULL,
  `vspc_language_id` int(11) NOT NULL,
  `vspc_translate_id` int(11) NOT NULL,
  PRIMARY KEY (`vspc_video_id`),
  UNIQUE KEY `vspc_video_id` (`vspc_video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1492 ;
