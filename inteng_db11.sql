SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `post_id`) VALUES
(1, 'This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', NULL, 2),
(2, 'вап', 2, 1468832045, 'ав', 'dfgdfg@drgdfh.gh', '', 1);

CREATE TABLE IF NOT EXISTS `tbl_lookup` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Draft', 1, 'PostStatus', 1),
(2, 'Published', 2, 'PostStatus', 2),
(3, 'Archived', 3, 'PostStatus', 3),
(4, 'Pending Approval', 1, 'CommentStatus', 1),
(5, 'Approved', 2, 'CommentStatus', 2);

CREATE TABLE IF NOT EXISTS `tbl_message` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date_add` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `tbl_message` (`id`, `sender_user_id`, `receiver_user_id`, `text`, `date_add`) VALUES
(1, 1, 1, 'message1', 1);

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_add` int(11) NOT NULL,
  `is_approved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tbl_points` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `travel_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_points` (`id`, `name`, `full_name`, `travel_id`) VALUES
(60, 'Hermann-Bahlsen-Allee', 'Hermann-Bahlsen-Allee', 77),
(61, 'fdg', 'fdg', 81),
(62, 'Flemesstraße', 'Flemesstraße', 84),
(63, 'Flemesstraße', 'Flemesstraße', 85);

CREATE TABLE IF NOT EXISTS `tbl_position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='разные адреса';

INSERT INTO `tbl_position` (`id`, `name`) VALUES
(1, 'pos1'),
(2, 'pos2');

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_post` (`id`, `title`, `content`, `tags`, `status`, `create_time`, `update_time`, `author_id`) VALUES
(1, 'Welcome!', 'This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\r\n\r\nFeel free to try this system by writing new posts and posting comments.', 'yii, blog', 2, 1230952187, 1230952187, 1),
(2, 'A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'test', 2, 1230952187, 1230952187, 1);

CREATE TABLE IF NOT EXISTS `tbl_request` (
  `id` int(11) NOT NULL,
  `user_request_id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `freie` int(11) NOT NULL,
  `gep` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_request` (`id`, `user_request_id`, `travel_id`, `freie`, `gep`) VALUES
(18, 1, 58, 2, 1),
(30, 2, 57, 3, 1);

CREATE TABLE IF NOT EXISTS `tbl_routs_search` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `name_from` varchar(255) NOT NULL,
  `name_to` varchar(255) NOT NULL,
  `full_name_from` varchar(255) NOT NULL,
  `full_name_to` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

INSERT INTO `tbl_routs_search` (`id`, `travel_id`, `name_from`, `name_to`, `full_name_from`, `full_name_to`) VALUES
(77, 75, 'Volgersweg 1', 'Hohenzollernstraße 1', 'Volgersweg 1', 'Hohenzollernstraße 1'),
(79, 77, 'Lister Damm', 'Hermann-Bahlsen-Allee', 'Lister Damm', 'Hermann-Bahlsen-Allee'),
(80, 77, 'Lister Damm', 'Züttlinger Straße', 'Lister Damm', 'Züttlinger Straße'),
(81, 77, 'Hermann-Bahlsen-Allee', 'Züttlinger Straße', 'Hermann-Bahlsen-Allee', 'Züttlinger Straße'),
(82, 78, 'Spargelstraße', 'Ikarusallee', 'Spargelstraße', 'Ikarusallee'),
(83, 79, 'Flemesstraße', 'Vahrenwalder Straße 145', 'Flemesstraße', 'Vahrenwalder Straße 145'),
(84, 80, 'test', 'Tessenowstraße', 'test', 'Tessenowstraße'),
(85, 81, 'dfg', 'fdg', 'dfg', 'fdg'),
(86, 81, 'dfg', 'fdg', 'dfg', 'fdg'),
(87, 81, 'fdg', 'fdg', 'fdg', 'fdg'),
(88, 84, 'Spargelstraße', 'Flemesstraße', 'Spargelstraße', 'Flemesstraße'),
(89, 84, 'Spargelstraße', 'Ikarusallee', 'Spargelstraße', 'Ikarusallee'),
(90, 84, 'Flemesstraße', 'Ikarusallee', 'Flemesstraße', 'Ikarusallee'),
(91, 85, 'Spargelstraße', 'Flemesstraße', 'Spargelstraße', 'Flemesstraße'),
(92, 85, 'Spargelstraße', 'Ikarusallee', 'Spargelstraße', 'Ikarusallee'),
(93, 85, 'Flemesstraße', 'Ikarusallee', 'Flemesstraße', 'Ikarusallee');

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_tag` (`id`, `name`, `frequency`) VALUES
(1, 'yii', 1),
(2, 'blog', 1),
(3, 'test', 1);

CREATE TABLE IF NOT EXISTS `tbl_travels` (
  `id` int(11) NOT NULL,
  `travel_owner_id` int(11) NOT NULL,
  `position_from_id` int(11) NOT NULL,
  `position_from_name` varchar(255) NOT NULL,
  `position_destination_id` int(11) NOT NULL,
  `position_destination_name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_add` int(11) NOT NULL,
  `date_edit` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descrition` text NOT NULL,
  `form_stadt` varchar(255) NOT NULL,
  `form_start` varchar(255) NOT NULL,
  `form_ziel` varchar(255) NOT NULL,
  `form_automarke` varchar(244) NOT NULL,
  `form_sonstige_inweise` text NOT NULL,
  `form_freie_platze` int(11) NOT NULL,
  `form_gepack` int(11) NOT NULL,
  `form_raucher` int(11) NOT NULL DEFAULT '2',
  `datum_start` varchar(50) NOT NULL,
  `datum_start_time` double(4,2) NOT NULL,
  `time_stamp` int(11) NOT NULL,
  `form_umweg` int(11) NOT NULL,
  `form_max_2` int(11) NOT NULL DEFAULT '2',
  `total_visits` int(11) NOT NULL DEFAULT '1',
  `date_start_time_2` double(4,2) NOT NULL,
  `estimate_time` varchar(255) NOT NULL,
  `date_start_timestamp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

INSERT INTO `tbl_travels` (`id`, `travel_owner_id`, `position_from_id`, `position_from_name`, `position_destination_id`, `position_destination_name`, `is_active`, `date_add`, `date_edit`, `title`, `descrition`, `form_stadt`, `form_start`, `form_ziel`, `form_automarke`, `form_sonstige_inweise`, `form_freie_platze`, `form_gepack`, `form_raucher`, `datum_start`, `datum_start_time`, `time_stamp`, `form_umweg`, `form_max_2`, `total_visits`, `date_start_time_2`, `estimate_time`, `date_start_timestamp`) VALUES
(77, 1, 1, '', 1, '', 0, 1470647703, 0, '', '', 'Hannover', 'Lister Damm', 'Züttlinger Straße', 'Lexus', '', 5, 5, 2, '27.08.2016', 11.11, 0, 5, 1, 8, 0.00, '824', 1472289060),
(78, 1, 1, '', 1, '', 0, 1470651983, 0, '', '', 'Hannover', 'Spargelstraße', 'Ikarusallee', 'Ford', 'Hahhgss', 3, 3, 1, '10.08.2016', 11.00, 0, 5, 0, 18, 0.00, '989', 1470819600),
(79, 1, 1, '', 1, '', 0, 1470653788, 0, '', '', 'Hannover', 'Flemesstraße', 'Vahrenwalder Straße 145', 'Ford', 'hhhggdfd', 3, 3, 1, '11.08.2016', 8.00, 0, 5, 0, 16, 0.00, '943', 1470897300),
(84, 2, 1, '', 1, '', 0, 1470832141, 0, '', '', 'Hannover', 'Spargelstraße', 'Ikarusallee', '', 'test', 3, 3, 2, '10.08.2016', 13.00, 0, 5, 1, 2, 0.00, '989', 1470826800),
(85, 2, 1, '', 1, '', 0, 1470832384, 0, '', '', 'Hannover', 'Spargelstraße', 'Ikarusallee', '', 'test', 2, 2, 2, '11.08.2016', 11.00, 0, 10, 1, 20, 0.00, '989', 1470906000);

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `form_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_boden` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_stadt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_handy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_automarke` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `geburtsdatum` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `form_alter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `form_uber_mich` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `geschlecht` int(11) NOT NULL DEFAULT '0',
  `vorname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `raucher` int(11) NOT NULL DEFAULT '2',
  `haustiere` int(11) NOT NULL DEFAULT '2',
  `musik` int(11) NOT NULL DEFAULT '2',
  `farbe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_visit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_visit_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `profile`, `form_name`, `form_boden`, `form_stadt`, `form_handy`, `form_email`, `form_automarke`, `geburtsdatum`, `form_alter`, `form_uber_mich`, `geschlecht`, `vorname`, `nachname`, `raucher`, `haustiere`, `musik`, `farbe`, `last_visit`, `last_visit_time`, `date_create`) VALUES
(1, 'demo', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 'mybiznetmail+1@gmail.com', '', '11', '', 'wwww', '3453534', '', 'Lexus', '04.09.1997', '', 'sdfsdfsd', 1, 'demo1', 'demo1', 2, 2, 2, 'Dunkelgrau', '10.08.2016', '16:07', 1470398725),
(2, 'demo2', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 'mybiznetmail+2@gmail.com', '', '', '', 'stadt 2', '09999 9999', '', 'Ford', '11.11.1980', '', 'text message', 2, 'vorn 2', 'demo 2', 2, 2, 1, '', '10.08.2016', '16:12', 0),
(3, 'demo3', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 'mybiznetmail+3@gmail.com', '', 'demo3', '', '', '', '', '', '', '', '', 1, 'demo3', 'demo3', 2, 1, 2, '', '0', '', 0);


ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_comment_post` (`post_id`);

ALTER TABLE `tbl_lookup`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_user_id` (`sender_user_id`),
  ADD KEY `receiver_user_id` (`receiver_user_id`);

ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_id` (`travel_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `tbl_points`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_post_author` (`author_id`);

ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_routs_search`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_travels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_owner_id` (`travel_owner_id`),
  ADD KEY `position_from_id` (`position_from_id`),
  ADD KEY `position_destination_id` (`position_destination_id`);

ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tbl_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `tbl_lookup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `tbl_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tbl_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
ALTER TABLE `tbl_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `tbl_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
ALTER TABLE `tbl_routs_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
ALTER TABLE `tbl_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `tbl_travels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON DELETE CASCADE;

ALTER TABLE `tbl_message`
  ADD CONSTRAINT `tbl_message_ibfk_1` FOREIGN KEY (`sender_user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_message_ibfk_2` FOREIGN KEY (`receiver_user_id`) REFERENCES `tbl_user` (`id`);

ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`travel_id`) REFERENCES `tbl_travels` (`id`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

ALTER TABLE `tbl_post`
  ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

ALTER TABLE `tbl_travels`
  ADD CONSTRAINT `tbl_travels_ibfk_1` FOREIGN KEY (`travel_owner_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_travels_ibfk_2` FOREIGN KEY (`position_from_id`) REFERENCES `tbl_position` (`id`),
  ADD CONSTRAINT `tbl_travels_ibfk_3` FOREIGN KEY (`position_destination_id`) REFERENCES `tbl_position` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
