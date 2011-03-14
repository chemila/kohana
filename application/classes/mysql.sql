CREATE TABLE IF NOT EXISTS `yule_roles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `yule_roles` (`id`, `name`, `description`) VALUES(1, 'admin', 'super admin');
INSERT INTO `yule_roles` (`id`, `name`, `description`) VALUES(2, 'login', 'login users');

CREATE TABLE IF NOT EXISTS `yule_roles_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `yule_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` int(10) UNSIGNED,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `yule_users` (`id`, `username`, `email`, `password`, `logins`, `last_login`) VALUES(1, 'admin', 'yule_admin@leju.sina.com.cn', '000', 1, unix_timestamp());

CREATE TABLE IF NOT EXISTS `yule_user_tokens` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE `yule_roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `yule_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `yule_roles` (`id`) ON DELETE CASCADE;

INSERT INTO `yule_roles_users` values(1, 1);
INSERT INTO `yule_roles_users` values(1, 2);

ALTER TABLE `yule_user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `yule_users` (`id`) ON DELETE CASCADE;

CREATE TABLE `yule_category` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL DEFAULT '',
    `cn` varchar(50) NOT NULL DEFAULT '',
    `pid` int(11) NOT NULL DEFAULT '0',
    `ct` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `ut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_name` (`name`),
    KEY `idx_cn` (`cn`),
    KEY `idx_pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `yule_category` values(1, 'yule', '娱乐', 0, '', NULL);

CREATE TABLE `yule_advertise` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `code` text NOT NULL COMMENT 'source code',
    `url` varchar(255) NOT NULL DEFAULT '',
    `description` varchar(127) NOT NULL DEFAULT '',
    `position` smallint(6) NOT NULL DEFAULT '0',
    `ct` int(10) unsigned NOT NULL COMMENT 'create time',
    `ut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `yule_misc` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `code` text NOT NULL,
    `url` varchar(255) NOT NULL DEFAULT '',
    `type` varchar(20) NOT NULL DEFAULT '',
    `tag` smallint(6) NOT NULL DEFAULT '0',
    `title` varchar(55) NOT NULL DEFAULT '',
    `summary` text NOT NULL,
    `ct` int(10) NOT NULL DEFAULT '0',
    `ut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `yule_search` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `category_id` int(11) NOT NULL COMMENT 'foreign key for category',
    `url` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT 'link url',
    `title` varchar(255) NOT NULL DEFAULT '',
    `summary` text NOT NULL,
    `picurl` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT 'related image link url',
    `pub_time` int(10) NOT NULL DEFAULT '0' COMMENT 'news publish time',
    `ct` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'create time',
    `ut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'update time',
    `author` varchar(50) NOT NULL DEFAULT '',
    `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:fetch result, 1: added manually, 2: show ahead',
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_category_title` (`category_id`,`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
