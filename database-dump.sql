CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `middle_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `birth_year` smallint(4) unsigned DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `marital_status` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `password` varchar(36) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `education` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `experience` text CHARACTER SET utf8,
  `phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `additional` text CHARACTER SET utf8,
  `filename` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_uniq` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;