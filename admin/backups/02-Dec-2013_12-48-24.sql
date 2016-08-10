-- --------------------------------------------------------------------------------
-- 
-- @version: sing_cm.sql Dec 2, 2013 12:48 gewa
-- @package CMS Pro
-- @author wojoscripts.com.
-- @copyright 2010
-- 
-- --------------------------------------------------------------------------------
-- Host: localhost
-- Database: sing_cm
-- Time: Dec 2, 2013-12:48
-- MySQL version: 5.1.70-cll
-- PHP version: 5.3.27
-- --------------------------------------------------------------------------------

#
# Database: `sing_cm`
#


-- --------------------------------------------------
# -- Table structure for table `custom_fields`
-- --------------------------------------------------
DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) DEFAULT NULL,
  `tooltip_en` varchar(100) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `req` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sorting` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `custom_fields`
-- --------------------------------------------------

INSERT INTO `custom_fields` (`id`, `title_en`, `tooltip_en`, `name`, `type`, `req`, `active`, `sorting`) VALUES ('1', 'Company Name', 'Please enter your company name', 'profile00001', 'profile', '1', '1', '1');
INSERT INTO `custom_fields` (`id`, `title_en`, `tooltip_en`, `name`, `type`, `req`, `active`, `sorting`) VALUES ('2', 'Country', 'Please enter your country', 'profile00002', 'profile', '1', '1', '2');


-- --------------------------------------------------
# -- Table structure for table `email_templates`
-- --------------------------------------------------
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(200) NOT NULL,
  `subject_en` varchar(255) NOT NULL,
  `help_en` text,
  `body_en` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `email_templates`
-- --------------------------------------------------

INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('1', 'Registration Email', 'Please verify your email', 'This template is used to send Registration Verification Email, when Configuration->Registration Verification is set to YES', '&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! Thanks for registering.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;         &lt;hr /&gt;\n            The administrator of this site has requested all new accounts&lt;br /&gt;\n            to be activated by the users who created them thus your account&lt;br /&gt;\n            is currently inactive. To activate your account,&lt;br /&gt;\n            please visit the link below and enter the following:&lt;hr /&gt;\n            Token: &lt;strong&gt;[TOKEN]&lt;/strong&gt;&lt;br /&gt;\n            Email: &lt;strong&gt;[EMAIL]&lt;/strong&gt;         &lt;hr /&gt;\n            &lt;a href=&quot;[LINK]&quot;&gt;Click here to activate tour account&lt;/a&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('2', 'Forgot Password Email', 'Password Reset', 'This template is used for retrieving lost user password', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;New password reset from [SITE_NAME]!&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Hello, &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            &lt;br /&gt;\n            It seems that you or someone requested a new password for you.&lt;br /&gt;\n            We have generated a new password, as requested:&lt;br /&gt;\n            &lt;br /&gt;\n            Your new password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;&lt;br /&gt;\n            &lt;br /&gt;\n            To use the new password you need to activate it. To do this click the link provided below and login with your new password.&lt;br /&gt;\n            &lt;a href=&quot;[LINK]&quot;&gt;[LINK]&lt;/a&gt;&lt;br /&gt;\n            &lt;br /&gt;\n            You can change your password after you sign in.&lt;hr /&gt;\n            Password requested from IP: [IP]&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('3', 'Welcome Mail From Admin', 'You have been registered', 'This template is used to send welcome email, when user is added by administrator', '&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! You have been Registered.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('4', 'Default Newsletter', 'Newsletter', 'This is a default newsletter template', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello [NAME]!&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You are receiving this email as a part of your newsletter subscription.         &lt;hr /&gt;\n            Here goes your newsletter content         &lt;hr /&gt;\n            &lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;         &lt;hr /&gt;\n            &lt;span style=&quot;font-size: 11px;&quot;&gt;&lt;em&gt;To stop receiving future newsletters please login into your account         and uncheck newsletter subscription box.&lt;/em&gt;&lt;/span&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('5', 'Transaction Completed', 'Payment Completed', 'This template is used to notify administrator on successful payment transaction', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello, Admin&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have received new payment following:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Membership: &lt;strong&gt;[ITEMNAME]&lt;/strong&gt;&lt;br /&gt;\n            Price: &lt;strong&gt;[PRICE]&lt;/strong&gt;&lt;br /&gt;\n            Status: &lt;strong&gt;[STATUS] &lt;/strong&gt;&lt;br /&gt;\r\n            Processor: &lt;strong&gt;[PP] &lt;/strong&gt;&lt;br /&gt;\n            IP: &lt;strong&gt;[IP] &lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;&lt;em&gt;You can view this transaction from your admin panel&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('6', 'Transaction Suspicious', 'Suspicious Transaction', 'This template is used to notify administrator on failed/suspicious payment transaction', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color:#ccc&quot;&gt;Hello, Admin&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align:left&quot;&gt;The following transaction has been disabled due to suspicious activity:&lt;br /&gt;\n            &lt;br /&gt;\n            Buyer: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Item: &lt;strong&gt;[ITEM]&lt;/strong&gt;&lt;br /&gt;\n            Price: &lt;strong&gt;[PRICE]&lt;/strong&gt;&lt;br /&gt;\n            Status: &lt;strong&gt;[STATUS]&lt;/strong&gt;&lt;/td&gt;\r\n            Processor: &lt;strong&gt;[PP] &lt;/strong&gt;&lt;br /&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align:left&quot;&gt;&lt;em&gt;Please verify this transaction is correct. If it is, please activate it in the transaction section of your site&#039;s &lt;br /&gt;\n            administration control panel. If not, it appears that someone tried to fraudulently obtain products from your site.&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('7', 'Welcome Email', 'Welcome', 'This template is used to welcome newly registered user when Configuration->Registration Verification and Configuration->Auto Registration are both set to YES', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! Thanks for registering.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('8', 'Membership Expire 7 days', 'Your membership will expire in 7 days', 'This template is used to remind user that membership will expire in 7 days', '&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello, [NAME]&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;\n            &lt;h2 style=&quot;color: rgb(255, 0, 0);&quot;&gt;Your current membership will expire in 7 days&lt;/h2&gt;\n            Please login to your user panel to extend or upgrade your membership.&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('9', 'Membership expired today', 'Your membership has expired', 'This template is used to remind user that membership had expired', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello, [NAME]&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;\n            &lt;h2 style=&quot;color: rgb(255, 0, 0);&quot;&gt;Your current membership has expired!&lt;/h2&gt;\n            Please login to your user panel to extend or upgrade your membership.&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('10', 'Contact Request', 'Contact Inquiry', 'This template is used to send default Contact Request Form', '\n&lt;div align=&quot;center&quot;&gt;\n\t&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n\t\t&lt;tbody&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;\n\t\t\t&lt;/tr&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new contact request: &lt;hr /&gt;\n\t\t\t\t\t [MESSAGE] &lt;hr /&gt;\n\t\t\t\t\t From: &lt;span style=&quot;font-weight: bold;&quot;&gt;[SENDER] - [NAME]&lt;/span&gt;&lt;br /&gt;\n\t\t\t\t\tTelephone: &lt;span style=&quot;font-weight: bold;&quot;&gt;[PHONE]&lt;/span&gt;&lt;br /&gt;\n\t\t\t\t\tSubject: &lt;span style=&quot;font-weight: bold;&quot;&gt;[MAILSUBJECT]&lt;/span&gt;&lt;br /&gt;\n\t\t\t\t\tSenders IP: &lt;span style=&quot;font-weight: bold;&quot;&gt;[IP]&lt;/span&gt;&lt;/td&gt;\n\t\t\t&lt;/tr&gt;\n\t\t&lt;/tbody&gt;\n\t&lt;/table&gt;&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('11', 'New Comment', 'New Comment Added', 'This template is used to notify admin when new comment has been added', '&lt;div align=&quot;center&quot;&gt;\n&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new comment post. You can login into your admin panel to view details:         &lt;hr /&gt;\n            [MESSAGE]         &lt;hr /&gt;\n            From: &lt;strong&gt;[SENDER] - [NAME]&lt;/strong&gt;&lt;br /&gt;\n            www: &lt;strong&gt;[WWW]&lt;/strong&gt;&lt;br /&gt;\n            Page Url: &lt;strong&gt;&lt;a href=&quot;[PAGEURL]&quot;&gt;[PAGEURL]&lt;/a&gt;&lt;/strong&gt;&lt;br /&gt;\n            Senders IP: &lt;strong&gt;[IP]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('12', 'Single Email', 'Single User Email', 'This template is used to email single user', '&lt;div align=&quot;center&quot;&gt;\n  &lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n      &lt;tr&gt;\n        &lt;th style=&quot;background-color:#ccc&quot;&gt;Hello [NAME]&lt;/th&gt;\n      &lt;/tr&gt;\n      &lt;tr&gt;\n        &lt;td valign=&quot;top&quot; style=&quot;text-align:left&quot;&gt;Your message goes here...&lt;/td&gt;\n      &lt;/tr&gt;\n      &lt;tr&gt;\n        &lt;td style=&quot;text-align:left&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n          [SITE_NAME] Team&lt;br /&gt;\n          &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n      &lt;/tr&gt;\n    &lt;/tbody&gt;\n  &lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('13', 'Notify Admin', 'New User Registration', 'This template is used to notify admin of new registration when Configuration->Registration Notification is set to YES', '&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new user registration. You can login into your admin panel to view details:&lt;hr /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Name: &lt;strong&gt;[NAME]&lt;/strong&gt;&lt;br /&gt;\n            IP: &lt;strong&gt;[IP]&lt;/strong&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('14', 'Registration Pending', 'Registration Verification Pending', 'This template is used to send Registration Verification Email, when Configuration->Auto Registration is set to NO', '&lt;div align=&quot;center&quot;&gt;\n&lt;table cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; width=&quot;600&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;\n    &lt;tbody&gt;\n        &lt;tr&gt;\n            &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Welcome [NAME]! Thanks for registering.&lt;/th&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Hello,&lt;br /&gt;\n            &lt;br /&gt;\n            You&#039;re now a member of [SITE_NAME].&lt;br /&gt;\n            &lt;br /&gt;\n            Here are your login details. Please keep them in a safe place:&lt;br /&gt;\n            &lt;br /&gt;\n            Username: &lt;strong&gt;[USERNAME]&lt;/strong&gt;&lt;br /&gt;\n            Password: &lt;strong&gt;[PASSWORD]&lt;/strong&gt;         &lt;hr /&gt;\n            The administrator of this site has requested all new accounts&lt;br /&gt;\n            to be activated by the users who created them thus your account&lt;br /&gt;\n            is currently pending verification process.&lt;/td&gt;\n        &lt;/tr&gt;\n        &lt;tr&gt;\n            &lt;td style=&quot;text-align: left;&quot;&gt;&lt;em&gt;Thanks,&lt;br /&gt;\n            [SITE_NAME] Team&lt;br /&gt;\n            &lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/em&gt;&lt;/td&gt;\n        &lt;/tr&gt;\n    &lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`) VALUES ('15', 'Offline Payment', 'Offline Notification', 'This template is used to send notification to a user when offline payment method is being used', '\n&lt;div align=&quot;center&quot; style=&quot;font-family: Arial,Helvetica,sans-serif; font-size: 13px; margin: 20px;&quot;&gt;\n\t&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;10&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 2px solid rgb(187, 187, 187);&quot;&gt;\n\t\t&lt;tbody&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;th style=&quot;background-color: rgb(204, 204, 204); font-size: 16px; padding: 5px; border-bottom: 2px solid rgb(255, 255, 255);&quot;&gt;Hello [NAME]&lt;/th&gt;\n\t\t\t&lt;/tr&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have purchased the following:&lt;/td&gt;\n\t\t\t&lt;/tr&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;[ITEMS]&lt;/td&gt;\n\t\t\t&lt;/tr&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;Please send your payment to:&lt;br /&gt;\n\t\t\t\t\t&lt;/td&gt;\n\t\t\t&lt;/tr&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;[INFO]&lt;/td&gt;\n\t\t\t&lt;/tr&gt;\n\t\t\t&lt;tr&gt;\n\t\t\t\t&lt;td valign=&quot;top&quot; style=&quot;text-align: left; background-color: rgb(255, 255, 255); border-top: 2px solid rgb(204, 204, 204);&quot;&gt;&lt;span style=&quot;font-style: italic;&quot;&gt;Thanks,&lt;br /&gt;\n\t\t\t\t\t\t[SITENAME] Team&lt;br /&gt;\n\t\t\t\t\t\t&lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;\n\t\t\t&lt;/tr&gt;\n\t\t&lt;/tbody&gt;\n\t&lt;/table&gt;&lt;/div&gt;');


-- --------------------------------------------------
# -- Table structure for table `gateways`
-- --------------------------------------------------
DROP TABLE IF EXISTS `gateways`;
CREATE TABLE `gateways` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `demo` tinyint(1) NOT NULL DEFAULT '1',
  `extra_txt` varchar(255) NOT NULL,
  `extra_txt2` varchar(255) NOT NULL,
  `extra_txt3` varchar(255) DEFAULT NULL,
  `extra` varchar(255) NOT NULL,
  `extra2` varchar(255) NOT NULL,
  `extra3` text,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `gateways`
-- --------------------------------------------------

INSERT INTO `gateways` (`id`, `name`, `displayname`, `dir`, `demo`, `extra_txt`, `extra_txt2`, `extra_txt3`, `extra`, `extra2`, `extra3`, `is_recurring`, `active`) VALUES ('1', 'paypal', 'PayPal', 'paypal', '0', 'Email Address', 'Currency Code', 'Not in Use', 'paypal@address.com', 'CAD', '', '1', '1');
INSERT INTO `gateways` (`id`, `name`, `displayname`, `dir`, `demo`, `extra_txt`, `extra_txt2`, `extra_txt3`, `extra`, `extra2`, `extra3`, `is_recurring`, `active`) VALUES ('2', 'moneybookers', 'MoneyBookers', 'moneybookers', '1', 'Email Address', 'Currency Code', 'Secret Passphrase', 'moneybookers@address.com', 'EUR', 'mypassphrase', '1', '1');
INSERT INTO `gateways` (`id`, `name`, `displayname`, `dir`, `demo`, `extra_txt`, `extra_txt2`, `extra_txt3`, `extra`, `extra2`, `extra3`, `is_recurring`, `active`) VALUES ('3', 'offline', 'Offline Payment', 'offline', '0', 'Not in Use', 'Not in Use', 'Instructions', '', '', 'Please submit all payments to:\nBank Name:\nBank Account:\netc...', '0', '1');


-- --------------------------------------------------
# -- Table structure for table `language`
-- --------------------------------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `flag` varchar(2) DEFAULT NULL,
  `langdir` enum('ltr','rtl') DEFAULT 'ltr',
  `author` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `language`
-- --------------------------------------------------

INSERT INTO `language` (`id`, `name`, `flag`, `langdir`, `author`) VALUES ('1', 'English', 'en', 'ltr', 'http://www.wojoscripts.com');


-- --------------------------------------------------
# -- Table structure for table `layout`
-- --------------------------------------------------
DROP TABLE IF EXISTS `layout`;
CREATE TABLE `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plug_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL DEFAULT '0',
  `modalias` varchar(30) DEFAULT NULL,
  `page_slug` varchar(50) DEFAULT NULL,
  `place` varchar(20) NOT NULL,
  `space` tinyint(1) NOT NULL DEFAULT '-1',
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_layout_id` (`page_id`),
  KEY `idx_plugin_id` (`plug_id`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `layout`
-- --------------------------------------------------

INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('196', '40', '1', '0', '', 'Inicio', 'top', '-1', '28');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('198', '41', '21', '0', '', 'Home', 'right', '-1', '35');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('204', '44', '21', '0', '', 'Home', 'bottom', '-1', '35');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('205', '43', '21', '0', '', 'Home', 'bottom', '-1', '36');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('202', '42', '21', '0', '', 'Home', 'left', '-1', '32');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('188', '5', '19', '0', '', 'Proyectos', 'bottom', '-1', '29');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('185', '38', '19', '0', '', 'Proyectos', 'left', '-1', '30');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('186', '31', '19', '0', '', 'Proyectos', 'right', '-1', '30');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('189', '30', '19', '0', '', 'Proyectos', 'bottom', '-1', '30');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('146', '31', '1', '0', '', 'Inicio', 'right', '-1', '23');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('192', '30', '1', '0', '', 'Inicio', 'bottom', '-1', '30');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('191', '5', '1', '0', '', 'Inicio', 'bottom', '-1', '29');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('148', '31', '15', '0', '', 'Nosotros', 'right', '-1', '26');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('164', '5', '15', '0', '', 'Nosotros', 'bottom', '-1', '26');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('165', '30', '15', '0', '', 'Nosotros', 'bottom', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('208', '45', '21', '0', '', 'Home', 'top', '-1', '33');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('168', '30', '16', '0', '', 'Servicios', 'bottom', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('167', '5', '16', '0', '', 'Servicios', 'bottom', '-1', '26');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('169', '31', '16', '0', '', 'Servicios', 'right', '-1', '25');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('172', '30', '17', '0', '', 'Clientes', 'bottom', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('171', '5', '17', '0', '', 'Clientes', 'bottom', '-1', '26');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('173', '31', '17', '0', '', 'Clientes', 'right', '-1', '25');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('174', '31', '18', '0', '', 'Contacto', 'right', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('176', '5', '18', '0', '', 'Contacto', 'bottom', '-1', '26');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('177', '30', '18', '0', '', 'Contacto', 'bottom', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('193', '39', '16', '0', '', 'Servicios', 'top', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('180', '38', '1', '0', '', 'Inicio', 'left', '-1', '26');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('181', '38', '17', '0', '', 'Clientes', 'left', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('182', '38', '18', '0', '', 'Contacto', 'left', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('183', '38', '15', '0', '', 'Nosotros', 'left', '-1', '27');
INSERT INTO `layout` (`id`, `plug_id`, `page_id`, `mod_id`, `modalias`, `page_slug`, `place`, `space`, `position`) VALUES ('184', '38', '16', '0', '', 'Servicios', 'left', '-1', '27');


-- --------------------------------------------------
# -- Table structure for table `log`
-- --------------------------------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `failed` tinyint(5) NOT NULL,
  `failed_last` int(11) NOT NULL,
  `type` enum('system','admin','user') NOT NULL,
  `message` text NOT NULL,
  `info_icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `importance` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=361 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `log`
-- --------------------------------------------------

INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('1', 'admin', '186.29.253.45', '2013-11-19 20:50:42', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('2', 'admin', '186.29.253.45', '2013-11-19 20:57:24', '0', '0', 'system', '<span>Success!</span>System Configuration updated successfully!', 'config', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('3', 'admin', '186.29.253.45', '2013-11-19 21:28:23', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('4', 'admin', '186.29.253.45', '2013-11-19 21:42:20', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('5', 'admin', '186.29.253.45', '2013-11-19 22:03:26', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('6', 'admin', '201.244.247.244', '2013-11-19 22:34:19', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('7', 'admin', '201.244.247.244', '2013-11-19 22:42:38', '0', '0', 'system', '<span>Success!</span>System Configuration updated successfully!', 'config', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('8', 'admin', '201.244.247.244', '2013-11-19 22:46:07', '0', '0', 'system', '<span>Success!</span>Slider added successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('9', 'admin', '201.244.247.244', '2013-11-19 22:48:32', '0', '0', 'system', '<span>Success!</span>Content Page updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('10', 'admin', '201.244.247.244', '2013-11-19 22:56:10', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('11', 'admin', '201.244.247.244', '2013-11-19 22:56:27', '0', '0', 'system', 'Post <strong>Welcome to CMS Pro!</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('12', 'admin', '201.244.247.244', '2013-11-19 23:02:06', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('13', 'admin', '201.244.247.244', '2013-11-19 23:08:52', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('14', 'admin', '186.30.78.248', '2013-11-19 23:12:10', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('15', 'admin', '186.30.78.248', '2013-11-19 23:12:53', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('16', 'admin', '186.30.78.248', '2013-11-19 23:14:01', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('17', 'admin', '186.30.78.248', '2013-11-19 23:15:26', '0', '0', 'system', '<span>Success!</span>System Configuration updated successfully!', 'config', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('18', 'admin', '186.30.78.248', '2013-11-19 23:15:46', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('19', 'admin', '186.30.78.248', '2013-11-19 23:15:48', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('20', 'admin', '186.30.78.248', '2013-11-19 23:15:52', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('21', 'admin', '186.30.78.248', '2013-11-19 23:18:36', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('22', 'admin', '186.30.78.248', '2013-11-19 23:18:39', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('23', 'admin', '186.30.78.248', '2013-11-19 23:18:41', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('24', 'admin', '186.30.78.248', '2013-11-19 23:19:01', '0', '0', 'system', '<span>Success!</span>Slider updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('25', 'admin', '186.30.78.248', '2013-11-19 23:22:16', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('26', 'admin', '186.30.78.248', '2013-11-19 23:27:38', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('27', 'admin', '186.30.78.248', '2013-11-19 23:27:41', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('28', 'admin', '186.30.78.248', '2013-11-19 23:27:43', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('29', 'admin', '186.30.78.248', '2013-11-19 23:29:19', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('30', 'admin', '186.30.78.248', '2013-11-19 23:29:29', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('31', 'admin', '186.30.78.248', '2013-11-19 23:29:39', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('32', 'admin', '186.30.78.248', '2013-11-19 23:29:48', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('33', 'admin', '186.30.78.248', '2013-11-19 23:30:08', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('34', 'admin', '186.30.78.248', '2013-11-19 23:30:26', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('35', 'admin', '186.30.78.248', '2013-11-19 23:30:38', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('36', 'admin', '186.30.78.248', '2013-11-19 23:30:50', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('37', 'admin', '186.30.78.248', '2013-11-19 23:41:09', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('38', 'admin', '186.30.78.248', '2013-11-19 23:42:07', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('39', 'admin', '186.30.78.248', '2013-11-19 23:54:18', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('40', 'admin', '186.30.78.248', '2013-11-19 23:57:47', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('41', 'admin', '186.30.78.248', '2013-11-20 00:00:07', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('42', 'admin', '186.30.78.248', '2013-11-20 00:06:11', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('43', 'admin', '186.30.78.248', '2013-11-20 00:08:17', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('44', 'admin', '186.30.78.248', '2013-11-20 00:08:56', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('45', 'admin', '186.30.78.248', '2013-11-20 00:10:25', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('46', 'admin', '186.30.78.248', '2013-11-20 00:11:02', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('47', 'admin', '186.30.78.248', '2013-11-20 00:11:26', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('48', 'admin', '186.30.78.248', '2013-11-20 00:11:57', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('49', 'admin', '186.30.78.248', '2013-11-20 00:12:41', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('50', 'admin', '186.30.78.248', '2013-11-20 00:13:05', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('51', 'admin', '186.30.78.248', '2013-11-20 00:13:30', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('52', 'admin', '186.30.78.248', '2013-11-20 00:13:54', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('53', 'admin', '186.30.78.248', '2013-11-20 00:14:31', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('54', 'admin', '186.30.78.248', '2013-11-20 00:15:34', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('55', 'admin', '186.30.78.248', '2013-11-20 00:15:59', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('56', 'admin', '186.30.78.248', '2013-11-20 00:16:22', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('57', 'admin', '186.30.78.248', '2013-11-20 00:21:50', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('58', 'admin', '186.30.78.248', '2013-11-20 00:23:45', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('59', 'admin', '186.30.78.248', '2013-11-20 00:26:45', '0', '0', 'system', 'Post <strong>About Us</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('60', 'admin', '186.30.78.248', '2013-11-20 00:26:49', '0', '0', 'system', 'Post <strong>Contact Information</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('61', 'admin', '186.30.78.248', '2013-11-20 00:28:05', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('62', 'admin', '186.30.78.248', '2013-11-20 00:28:53', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('63', 'admin', '186.30.78.248', '2013-11-20 00:30:04', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('64', 'admin', '186.30.78.248', '2013-11-20 00:35:12', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('65', 'admin', '186.30.78.248', '2013-11-20 00:36:50', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('66', 'admin', '186.30.78.248', '2013-11-20 00:44:05', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('67', 'admin', '186.30.78.248', '2013-11-20 00:45:32', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('68', 'admin', '186.30.78.248', '2013-11-20 01:01:52', '0', '0', 'system', 'Post <strong>Gallery Demo</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('69', 'admin', '186.30.78.248', '2013-11-20 01:01:57', '0', '0', 'system', 'Post <strong>All Module Positions</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('70', 'admin', '186.30.78.248', '2013-11-20 01:02:01', '0', '0', 'system', 'Post <strong>More Sample Pages</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('71', 'admin', '186.30.78.248', '2013-11-20 01:02:04', '0', '0', 'system', 'Post <strong>Registered Users Only</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('72', 'admin', '186.30.78.248', '2013-11-20 01:02:08', '0', '0', 'system', 'Post <strong>Membership Access</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('73', 'admin', '186.30.78.248', '2013-11-20 01:02:12', '0', '0', 'system', 'Post <strong>Event Calendar</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('74', 'admin', '186.30.78.248', '2013-11-20 01:02:16', '0', '0', 'system', 'Post <strong>Slideout Demo</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('75', 'admin', '186.30.78.248', '2013-11-20 01:02:20', '0', '0', 'system', 'Post <strong>Content Slider Demo</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('76', 'admin', '186.30.78.248', '2013-11-20 01:02:24', '0', '0', 'system', 'Post <strong>Video Slider Demo</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('77', 'admin', '186.30.78.248', '2013-11-20 01:02:31', '0', '0', 'system', 'Post <strong>Visual Forms Demo</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('78', 'admin', '186.30.78.248', '2013-11-20 01:07:42', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('79', 'admin', '186.30.78.248', '2013-11-20 01:15:29', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('80', 'admin', '186.30.78.248', '2013-11-20 01:20:21', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('81', 'admin', '186.30.78.248', '2013-11-20 01:21:11', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('82', 'admin', '186.30.78.248', '2013-11-20 01:24:35', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('83', 'admin', '186.30.78.248', '2013-11-20 01:25:09', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('84', 'admin', '186.30.78.248', '2013-11-20 01:25:47', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('85', 'admin', '186.30.78.248', '2013-11-20 01:27:21', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('86', 'admin', '186.30.78.248', '2013-11-20 01:32:37', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('87', 'admin', '186.30.78.248', '2013-11-20 01:33:18', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('88', 'admin', '186.30.78.248', '2013-11-20 01:39:59', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('89', 'admin', '186.30.78.248', '2013-11-20 01:40:49', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('90', 'admin', '186.30.78.248', '2013-11-20 01:41:42', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('91', 'admin', '186.30.78.248', '2013-11-20 01:47:44', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('92', 'admin', '186.30.78.248', '2013-11-20 01:50:22', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('93', 'admin', '186.30.78.248', '2013-11-20 01:52:46', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('94', 'admin', '186.30.78.248', '2013-11-20 02:03:32', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('95', 'admin', '186.30.78.248', '2013-11-20 02:05:28', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('96', 'admin', '186.30.78.248', '2013-11-20 02:07:23', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('97', 'admin', '186.30.78.248', '2013-11-20 02:07:53', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('98', 'admin', '186.30.78.248', '2013-11-20 02:13:00', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('99', 'admin', '186.30.78.248', '2013-11-20 02:14:40', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('100', 'admin', '186.30.78.248', '2013-11-20 02:15:34', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('101', 'admin', '186.30.78.248', '2013-11-20 02:18:21', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('102', 'admin', '186.30.78.248', '2013-11-20 02:21:27', '0', '0', 'system', '<span>Success!</span>CMS Gallery added successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('103', 'admin', '186.30.78.248', '2013-11-20 02:21:37', '0', '0', 'system', 'Gallery <strong>Demo Gallery</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('104', 'admin', '186.30.78.248', '2013-11-20 02:25:12', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('105', 'admin', '186.30.78.248', '2013-11-20 08:02:10', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('106', 'admin', '186.30.78.248', '2013-11-20 08:05:37', '0', '0', 'system', '<span>Success!</span>System Configuration updated successfully!', 'config', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('107', 'admin', '186.30.78.248', '2013-11-20 08:20:16', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('108', 'admin', '186.30.78.248', '2013-11-20 09:03:27', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('109', 'admin', '186.30.78.248', '2013-11-20 09:04:38', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('110', 'admin', '186.30.78.248', '2013-11-20 09:07:38', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('111', 'admin', '186.30.78.248', '2013-11-20 09:09:57', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('112', 'admin', '186.30.78.248', '2013-11-20 09:12:29', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('113', 'admin', '186.30.78.248', '2013-11-20 09:15:57', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('114', 'admin', '186.30.78.248', '2013-11-20 09:19:29', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('115', 'admin', '186.30.78.248', '2013-11-20 09:23:16', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('116', 'admin', '186.30.78.248', '2013-11-20 09:26:20', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('117', 'admin', '186.30.78.248', '2013-11-20 09:29:31', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('118', 'admin', '186.30.78.248', '2013-11-20 09:33:47', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('119', 'admin', '186.30.78.248', '2013-11-20 09:35:34', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('120', 'admin', '186.30.78.248', '2013-11-20 09:36:46', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('121', 'admin', '186.30.78.248', '2013-11-20 09:42:53', '0', '0', 'system', '<span>Success!</span>Slider added successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('122', 'admin', '186.30.78.248', '2013-11-20 09:49:39', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('123', 'admin', '186.30.78.248', '2013-11-20 10:11:32', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('124', 'admin', '186.30.78.248', '2013-11-20 10:13:28', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('125', 'admin', '186.30.78.248', '2013-11-20 10:33:38', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('126', 'admin', '186.29.255.93', '2013-11-20 10:47:04', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('127', 'admin', '186.29.255.93', '2013-11-20 11:05:12', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('128', 'admin', '186.29.255.93', '2013-11-20 11:31:01', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('129', 'admin', '186.29.255.93', '2013-11-20 11:43:59', '0', '0', 'system', 'Post <strong>Three Column Page</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('130', 'admin', '186.29.255.93', '2013-11-20 11:47:10', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('131', 'admin', '186.29.255.93', '2013-11-20 11:49:44', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('132', 'admin', '186.29.255.93', '2013-11-20 11:50:37', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('133', 'admin', '186.29.255.93', '2013-11-20 12:03:26', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('134', 'admin', '186.29.255.93', '2013-11-20 12:13:28', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('135', 'admin', '186.29.255.93', '2013-11-20 12:35:39', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('136', 'admin', '186.29.255.93', '2013-11-20 12:36:52', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('137', 'admin', '186.28.199.21', '2013-11-20 17:35:52', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('138', 'admin', '186.28.199.21', '2013-11-20 17:36:37', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('139', 'admin', '186.28.199.21', '2013-11-20 17:46:08', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('140', 'admin', '186.28.199.21', '2013-11-20 17:46:11', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('141', 'admin', '186.28.199.21', '2013-11-20 17:46:13', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('142', 'admin', '186.28.199.21', '2013-11-20 17:47:16', '0', '0', 'system', 'Plugin <strong>pie de pagina esp</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('143', 'admin', '186.28.199.21', '2013-11-20 17:47:22', '0', '0', 'system', 'Plugin <strong>pie de pagina esp</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('144', 'admin', '186.28.199.21', '2013-11-20 17:49:50', '0', '0', 'system', 'Page <strong>Content Slider</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('145', 'admin', '186.28.199.21', '2013-11-20 17:49:54', '0', '0', 'system', 'Page <strong>Demo Gallery Page</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('146', 'admin', '186.28.199.21', '2013-11-20 17:49:58', '0', '0', 'system', 'Page <strong>Event Calendar Demo</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('147', 'admin', '186.28.199.21', '2013-11-20 17:50:03', '0', '0', 'system', 'Page <strong>Members Only</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('148', 'admin', '186.28.199.21', '2013-11-20 17:50:08', '0', '0', 'system', 'Page <strong>Membership Only</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('149', 'admin', '186.28.199.21', '2013-11-20 17:50:12', '0', '0', 'system', 'Page <strong>More Pages</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('150', 'admin', '186.28.199.21', '2013-11-20 17:50:22', '0', '0', 'system', 'Page <strong>What is CMS pro!</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('151', 'admin', '186.28.199.21', '2013-11-20 17:50:26', '0', '0', 'system', 'Page <strong>Video Slider</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('152', 'admin', '186.28.199.21', '2013-11-20 17:50:30', '0', '0', 'system', 'Page <strong>Three Column Page</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('153', 'admin', '186.28.199.21', '2013-11-20 17:50:35', '0', '0', 'system', 'Page <strong>Slideout Slider</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('154', 'admin', '186.28.199.21', '2013-11-20 17:50:43', '0', '0', 'system', 'Page <strong>Our Contact Info</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('155', 'admin', '186.28.199.21', '2013-11-20 17:50:50', '0', '0', 'system', 'Page <strong>All Modules</strong> deleted successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('156', 'admin', '186.28.199.21', '2013-11-20 17:55:22', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('157', 'admin', '186.28.199.21', '2013-11-20 17:56:01', '0', '0', 'system', '<span>Success!</span>CMS Gallery configuration updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('158', 'admin', '186.28.199.21', '2013-11-20 18:04:09', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('159', 'admin', '186.28.199.21', '2013-11-20 18:04:26', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('160', 'admin', '186.28.199.21', '2013-11-20 18:06:09', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('161', 'admin', '186.28.199.21', '2013-11-20 18:10:43', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('162', 'admin', '186.28.199.21', '2013-11-20 18:11:54', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('163', 'admin', '186.28.199.21', '2013-11-20 18:11:59', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('164', 'admin', '186.28.199.21', '2013-11-20 18:12:05', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('165', 'admin', '186.28.199.21', '2013-11-20 18:12:11', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('166', 'admin', '186.28.199.21', '2013-11-20 18:12:17', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('167', 'admin', '186.28.199.21', '2013-11-20 18:12:24', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('168', 'admin', '186.28.199.21', '2013-11-20 18:12:30', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('169', 'admin', '186.28.199.21', '2013-11-20 18:12:36', '0', '0', 'system', 'Image <strong>Mantenimiento e Instalación</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('170', 'admin', '186.28.199.21', '2013-11-20 18:14:06', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('171', 'admin', '186.28.199.21', '2013-11-20 18:15:08', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('172', 'admin', '186.28.199.21', '2013-11-20 18:15:10', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('173', 'admin', '186.28.199.21', '2013-11-20 18:15:27', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('174', 'admin', '186.28.199.21', '2013-11-20 18:16:16', '0', '0', 'system', 'Image <strong>Reparación de aires acondicionados</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('175', 'admin', '186.28.199.21', '2013-11-20 18:16:22', '0', '0', 'system', 'Image <strong>Reparación de aires acondicionados</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('176', 'admin', '186.28.199.21', '2013-11-20 18:16:27', '0', '0', 'system', 'Image <strong>Reparación de aires acondicionados</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('177', 'admin', '186.28.199.21', '2013-11-20 18:16:33', '0', '0', 'system', 'Image <strong>Reparación de aires acondicionados</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('178', 'admin', '186.28.199.21', '2013-11-20 18:16:39', '0', '0', 'system', 'Image <strong>Reparación de aires acondicionados</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('179', 'admin', '186.28.199.21', '2013-11-20 18:19:15', '0', '0', 'system', 'Image <strong>Reparación de motoniveladores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('180', 'admin', '186.28.199.21', '2013-11-20 18:19:20', '0', '0', 'system', 'Image <strong>Reparación de motoniveladores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('181', 'admin', '186.28.199.21', '2013-11-20 18:19:26', '0', '0', 'system', 'Image <strong>Reparación de motoniveladores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('182', 'admin', '186.28.199.21', '2013-11-20 18:19:32', '0', '0', 'system', 'Image <strong>Reparación de motoniveladores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('183', 'admin', '186.28.199.21', '2013-11-20 18:19:39', '0', '0', 'system', 'Image <strong>Reparación de motoniveladores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('184', 'admin', '186.28.199.21', '2013-11-20 18:22:15', '0', '0', 'system', 'Image <strong>Servicios de Suministro</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('185', 'admin', '186.28.199.21', '2013-11-20 18:22:24', '0', '0', 'system', 'Image <strong>Servicios de Suministro</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('186', 'admin', '186.28.199.21', '2013-11-20 18:22:32', '0', '0', 'system', 'Image <strong>Servicios de Suministro</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('187', 'admin', '186.28.199.21', '2013-11-20 18:22:37', '0', '0', 'system', 'Image <strong>Servicios de Suministro</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('188', 'admin', '186.28.199.21', '2013-11-20 18:22:45', '0', '0', 'system', 'Image <strong>Servicios de Suministro</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('189', 'admin', '186.28.199.21', '2013-11-20 18:49:23', '0', '0', 'system', 'Image <strong>Equipos de Infraestructura</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('190', 'admin', '186.28.199.21', '2013-11-20 18:49:32', '0', '0', 'system', 'Image <strong>Equipos de Infraestructura</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('191', 'admin', '186.28.199.21', '2013-11-20 18:49:39', '0', '0', 'system', 'Image <strong>Equipos de Infraestructura</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('192', 'admin', '186.28.199.21', '2013-11-20 18:49:45', '0', '0', 'system', 'Image <strong>Equipos de Infraestructura</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('193', 'admin', '186.28.199.21', '2013-11-20 18:49:53', '0', '0', 'system', 'Image <strong>Equipos de Infraestructura</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('194', 'admin', '186.28.199.21', '2013-11-20 18:50:00', '0', '0', 'system', 'Image <strong>Equipos de Infraestructura</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('195', 'admin', '186.28.199.21', '2013-11-20 18:53:02', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('196', 'admin', '186.28.199.21', '2013-11-20 18:53:12', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('197', 'admin', '186.28.199.21', '2013-11-20 18:53:19', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('198', 'admin', '186.28.199.21', '2013-11-20 18:53:25', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('199', 'admin', '186.28.199.21', '2013-11-20 18:53:33', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('200', 'admin', '186.28.199.21', '2013-11-20 18:53:40', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('201', 'admin', '186.28.199.21', '2013-11-20 18:53:46', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('202', 'admin', '186.28.199.21', '2013-11-20 18:54:00', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('203', 'admin', '186.28.199.21', '2013-11-20 18:54:04', '0', '0', 'system', 'Image <strong>Equipos para Obras Civiles</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('204', 'admin', '186.28.199.21', '2013-11-20 18:56:14', '0', '0', 'system', 'Image <strong>Cambio de crucetas</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('205', 'admin', '186.28.199.21', '2013-11-20 18:56:17', '0', '0', 'system', 'Image <strong>Cambio de crucetas</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('206', 'admin', '186.28.199.21', '2013-11-20 18:56:22', '0', '0', 'system', 'Image <strong>Cambio de crucetas</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('207', 'admin', '186.28.199.21', '2013-11-20 18:56:29', '0', '0', 'system', 'Image <strong>Cambio de crucetas</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('208', 'admin', '186.28.199.21', '2013-11-20 18:56:35', '0', '0', 'system', 'Image <strong>Cambio de crucetas</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('209', 'admin', '186.28.199.21', '2013-11-20 18:59:23', '0', '0', 'system', 'Image <strong>Cambio de pararayos</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('210', 'admin', '186.28.199.21', '2013-11-20 18:59:29', '0', '0', 'system', 'Image <strong>Cambio de pararayos</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('211', 'admin', '186.28.199.21', '2013-11-20 18:59:50', '0', '0', 'system', 'Image <strong>Cambio de pararayos</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('212', 'admin', '186.28.199.21', '2013-11-20 18:59:56', '0', '0', 'system', 'Image <strong>Cambio de pararayos</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('213', 'admin', '186.28.199.21', '2013-11-20 19:00:03', '0', '0', 'system', 'Image <strong>Cambio de pararayos</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('214', 'admin', '186.28.199.21', '2013-11-20 19:00:17', '0', '0', 'system', 'Image <strong>-/-</strong> deleted successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('215', 'admin', '186.28.199.21', '2013-11-20 19:01:37', '0', '0', 'system', 'Image <strong>Cambio de transformadores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('216', 'admin', '186.28.199.21', '2013-11-20 19:01:43', '0', '0', 'system', 'Image <strong>Cambio de transformadores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('217', 'admin', '186.28.199.21', '2013-11-20 19:01:52', '0', '0', 'system', 'Image <strong>Cambio de transformadores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('218', 'admin', '186.28.199.21', '2013-11-20 19:02:00', '0', '0', 'system', 'Image <strong>Cambio de transformadores</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('219', 'admin', '186.28.199.21', '2013-11-20 19:02:38', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('220', 'admin', '186.28.199.21', '2013-11-20 19:02:44', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('221', 'admin', '186.28.199.21', '2013-11-20 19:02:51', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('222', 'admin', '186.28.199.21', '2013-11-20 19:03:01', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('223', 'admin', '186.28.199.21', '2013-11-20 19:03:06', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('224', 'admin', '186.28.199.21', '2013-11-20 19:03:12', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('225', 'admin', '186.28.199.21', '2013-11-20 19:03:57', '0', '0', 'system', 'Image <strong>Sistemas de puesta a tierra</strong> updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('226', 'admin', '186.28.199.21', '2013-11-20 19:08:31', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('227', 'admin', '186.28.38.124', '2013-11-25 16:11:59', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('228', 'admin', '186.28.38.124', '2013-11-25 16:14:31', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('229', 'admin', '186.28.38.124', '2013-11-25 16:15:31', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('230', 'admin', '186.28.38.124', '2013-11-25 16:16:35', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('231', 'admin', '186.28.38.124', '2013-11-25 16:17:10', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('232', 'admin', '186.28.38.124', '2013-11-25 16:27:09', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('233', 'admin', '186.28.38.124', '2013-11-25 16:29:10', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('234', 'admin', '186.28.38.124', '2013-11-25 16:30:15', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('235', 'admin', '186.28.38.124', '2013-11-25 16:31:29', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('236', 'admin', '186.28.38.124', '2013-11-25 16:32:21', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('237', 'admin', '186.28.38.124', '2013-11-25 16:34:14', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('238', 'admin', '190.25.42.80', '2013-11-25 16:37:33', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('239', 'admin', '190.25.42.80', '2013-11-25 16:39:20', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('240', 'admin', '190.25.42.80', '2013-11-25 16:54:39', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('241', 'admin', '190.25.42.80', '2013-11-25 17:08:23', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('242', 'admin', '186.29.198.91', '2013-11-25 17:26:52', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('243', 'admin', '186.29.198.91', '2013-11-25 17:34:47', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('244', 'admin', '186.29.198.91', '2013-11-25 17:35:36', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('245', 'admin', '186.29.198.91', '2013-11-25 17:42:57', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('246', 'admin', '186.29.198.91', '2013-11-25 17:46:20', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('247', 'admin', '186.29.198.91', '2013-11-25 17:47:18', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('248', 'admin', '186.29.198.91', '2013-11-25 18:02:37', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('249', 'admin', '186.29.198.91', '2013-11-25 18:16:29', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('250', 'admin', '201.244.195.93', '2013-11-25 18:36:58', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('251', 'admin', '186.30.182.17', '2013-11-25 18:40:06', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('252', 'admin', '186.30.182.17', '2013-11-25 18:41:01', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('253', 'admin', '186.30.182.17', '2013-11-25 18:41:48', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('254', 'admin', '186.30.182.17', '2013-11-25 18:44:53', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('255', 'admin', '186.30.182.17', '2013-11-25 18:53:14', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('256', 'admin', '186.30.182.17', '2013-11-25 18:54:04', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('257', 'admin', '186.30.182.17', '2013-11-25 18:54:40', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('258', 'admin', '186.30.182.17', '2013-11-25 18:56:28', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('259', 'admin', '186.30.182.17', '2013-11-25 18:58:04', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('260', 'admin', '186.30.182.17', '2013-11-25 18:59:27', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('261', 'admin', '186.30.182.17', '2013-11-25 19:01:11', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('262', 'admin', '186.30.182.17', '2013-11-25 19:02:20', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('263', 'admin', '186.30.182.17', '2013-11-25 19:04:37', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('264', 'admin', '186.30.182.17', '2013-11-25 19:05:50', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('265', 'admin', '186.30.182.17', '2013-11-25 19:09:19', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('266', 'admin', '186.30.182.17', '2013-11-25 19:11:17', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('267', 'admin', '186.30.182.17', '2013-11-25 19:12:34', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('268', 'admin', '186.30.182.17', '2013-11-25 19:14:12', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('269', 'admin', '186.30.182.17', '2013-11-25 20:53:01', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('270', 'admin', '186.30.182.17', '2013-11-25 20:54:07', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('271', 'admin', '186.30.182.17', '2013-11-25 20:55:03', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('272', 'admin', '186.30.182.17', '2013-11-25 20:55:56', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('273', 'admin', '186.30.182.17', '2013-11-25 20:56:49', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('274', 'admin', '186.30.182.17', '2013-11-25 20:57:19', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('275', 'admin', '186.30.182.17', '2013-11-25 20:57:58', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('276', 'admin', '186.30.182.17', '2013-11-25 21:08:35', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('277', 'admin', '186.30.182.17', '2013-11-25 21:09:09', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('278', 'admin', '186.30.182.17', '2013-11-25 21:10:54', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('279', 'admin', '186.30.182.17', '2013-11-25 21:13:13', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('280', 'admin', '186.30.182.17', '2013-11-25 21:13:58', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('281', 'admin', '186.30.182.17', '2013-11-25 21:15:23', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('282', 'admin', '186.30.182.17', '2013-11-25 21:16:21', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('283', 'admin', '186.30.182.17', '2013-11-25 21:17:30', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('284', 'admin', '186.30.182.17', '2013-11-25 21:18:03', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('285', 'admin', '186.30.182.17', '2013-11-25 21:20:46', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('286', 'admin', '186.30.182.17', '2013-11-25 21:29:39', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('287', 'admin', '186.30.182.17', '2013-11-25 21:30:40', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('288', 'admin', '186.30.182.17', '2013-11-25 21:49:24', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('289', 'admin', '186.30.182.17', '2013-11-25 21:51:01', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('290', 'admin', '186.30.182.17', '2013-11-25 21:56:54', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('291', 'admin', '186.30.182.17', '2013-11-25 21:57:24', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('292', 'admin', '201.245.228.195', '2013-11-25 22:05:52', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('293', 'admin', '201.245.228.195', '2013-11-25 22:06:16', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('294', 'admin', '201.245.228.195', '2013-11-25 22:13:01', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('295', 'admin', '201.245.228.195', '2013-11-25 22:13:50', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('296', 'admin', '201.245.228.195', '2013-11-25 22:14:53', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('297', 'admin', '201.245.228.195', '2013-11-25 22:29:26', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('298', 'admin', '201.245.228.195', '2013-11-25 22:30:23', '0', '0', 'system', '<span>Success!</span>Slider updated successfully!', 'module', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('299', 'admin', '201.245.228.195', '2013-11-25 22:34:45', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('300', 'admin', '201.245.228.195', '2013-11-25 22:39:02', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('301', 'admin', '201.245.228.195', '2013-11-25 22:39:58', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('302', 'admin', '186.30.79.218', '2013-11-26 01:11:11', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('303', 'admin', '190.24.251.29', '2013-11-26 08:25:14', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('304', 'admin', '190.24.251.29', '2013-11-26 08:37:27', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('305', 'admin', '190.24.251.29', '2013-11-26 09:15:28', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('306', 'admin', '190.24.251.29', '2013-11-26 09:35:12', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('307', 'admin', '190.24.251.29', '2013-11-26 09:36:49', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('308', 'admin', '190.24.251.29', '2013-11-26 09:37:50', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('309', 'admin', '190.24.251.29', '2013-11-26 09:39:46', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('310', 'admin', '190.24.251.29', '2013-11-26 09:41:05', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('311', 'admin', '190.24.251.29', '2013-11-26 09:47:46', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('312', 'admin', '190.24.251.29', '2013-11-26 10:03:48', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('313', 'admin', '190.24.251.29', '2013-11-26 10:07:12', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('314', 'admin', '190.24.251.29', '2013-11-26 10:10:44', '0', '0', 'system', 'Slide Image <strong>Tu auxiliar intention sia</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('315', 'admin', '190.24.251.29', '2013-11-26 10:10:51', '0', '0', 'system', 'Slide Image <strong>In anque svedese abstracte del</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('316', 'admin', '190.24.251.29', '2013-11-26 10:10:56', '0', '0', 'system', 'Slide Image <strong>Il via unic populos</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('317', 'admin', '190.24.251.29', '2013-11-26 10:11:00', '0', '0', 'system', 'Slide Image <strong>Infra latino appellate le sia</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('318', 'admin', '190.24.251.29', '2013-11-26 10:11:07', '0', '0', 'system', 'Slide Image <strong>Via o basate nomina proposito</strong> deleted successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('319', 'admin', '190.24.251.29', '2013-11-26 10:21:42', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('320', 'admin', '190.24.251.29', '2013-11-26 10:22:38', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('321', 'admin', '190.24.251.29', '2013-11-26 10:41:26', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('322', 'admin', '190.25.36.109', '2013-11-26 17:42:38', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('323', 'admin', '190.25.36.109', '2013-11-26 17:42:50', '0', '0', 'system', '<span>Success!</span>Backup created successfully!', 'database', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('324', 'admin', '190.25.36.109', '2013-11-26 17:42:56', '0', '0', 'system', '<span>Success!</span>Backup deleted successfully!', 'database', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('325', 'admin', '190.25.36.109', '2013-11-26 17:42:59', '0', '0', 'system', '<span>Success!</span>Backup deleted successfully!', 'database', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('326', 'admin', '190.25.36.109', '2013-11-26 17:43:03', '0', '0', 'system', '<span>Success!</span>Backup deleted successfully!', 'database', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('327', 'admin', '186.31.13.50', '2013-11-27 21:53:14', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('328', 'admin', '186.31.13.50', '2013-11-27 21:59:08', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('329', 'admin', '186.31.13.50', '2013-11-27 22:01:13', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('330', 'admin', '186.31.13.50', '2013-11-27 22:02:23', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('331', 'admin', '186.31.13.50', '2013-11-27 22:03:20', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('332', 'admin', '186.31.13.50', '2013-11-27 22:06:51', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('333', 'admin', '186.31.13.50', '2013-11-27 22:32:08', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('334', 'admin', '186.31.13.50', '2013-11-27 22:32:18', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('335', 'admin', '186.31.13.50', '2013-11-27 22:32:29', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('336', 'admin', '186.31.13.50', '2013-11-27 22:32:40', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('337', 'admin', '186.31.13.50', '2013-11-27 22:32:51', '0', '0', 'system', '<span>Success!</span>Content Page added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('338', 'admin', '186.31.13.50', '2013-11-27 22:33:08', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('339', 'admin', '186.31.13.50', '2013-11-27 22:33:36', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('340', 'admin', '186.31.13.50', '2013-11-27 22:33:51', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('341', 'admin', '186.31.13.50', '2013-11-27 22:34:09', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('342', 'admin', '186.31.13.50', '2013-11-27 22:34:26', '0', '0', 'system', '<span>Success!</span>Content Post added successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('343', 'admin', '186.31.13.50', '2013-11-27 22:36:54', '0', '0', 'system', '<span>Success!</span>Content Page updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('344', 'admin', '186.31.13.50', '2013-11-27 22:37:04', '0', '0', 'system', '<span>Success!</span>Content Post updated successfully!', 'content', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('345', 'admin', '186.31.13.50', '2013-11-27 22:52:03', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('346', 'admin', '186.31.13.50', '2013-11-27 22:52:57', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('347', 'admin', '186.31.13.50', '2013-11-27 22:57:57', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('348', 'admin', '186.31.13.50', '2013-11-27 23:00:39', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('349', 'admin', '186.31.13.50', '2013-11-27 23:03:27', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('350', 'admin', '186.31.13.50', '2013-11-27 23:04:20', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('351', 'admin', '186.31.13.50', '2013-11-27 23:07:31', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('352', 'admin', '186.31.13.50', '2013-11-27 23:08:45', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('353', 'admin', '186.31.13.50', '2013-11-27 23:12:14', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('354', 'admin', '186.31.13.50', '2013-11-27 23:22:07', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('355', 'admin', '186.31.13.50', '2013-11-27 23:42:17', '0', '0', 'system', '<span>Success!</span>Plugin added successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('356', 'admin', '186.31.13.50', '2013-11-27 23:43:42', '0', '0', 'user', 'User admin has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('357', 'admin', '190.24.251.29', '2013-11-28 08:31:51', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('358', 'admin', '190.24.251.29', '2013-11-28 08:35:30', '0', '0', 'system', '<span>Success!</span>Plugin updated successfully!', 'plugin', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('359', 'Guest', '190.24.251.29', '2013-11-28 11:14:18', '0', '0', 'user', 'User Guest has successfully logged out.', 'user', 'no');
INSERT INTO `log` (`id`, `user_id`, `ip`, `created`, `failed`, `failed_last`, `type`, `message`, `info_icon`, `importance`) VALUES ('360', 'admin', '186.28.39.65', '2013-12-02 11:47:39', '0', '0', 'user', 'User admin has successfully logged in.', 'user', 'no');


-- --------------------------------------------------
# -- Table structure for table `memberships`
-- --------------------------------------------------
DROP TABLE IF EXISTS `memberships`;
CREATE TABLE `memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `description_en` text NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `days` int(5) NOT NULL DEFAULT '0',
  `period` varchar(1) NOT NULL DEFAULT 'D',
  `trial` tinyint(1) NOT NULL DEFAULT '0',
  `recurring` tinyint(1) NOT NULL DEFAULT '0',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `memberships`
-- --------------------------------------------------

INSERT INTO `memberships` (`id`, `title_en`, `description_en`, `price`, `days`, `period`, `trial`, `recurring`, `private`, `active`) VALUES ('1', 'Trial 7', 'This is 7 days trial membership...', '0.00', '7', 'D', '1', '0', '0', '1');
INSERT INTO `memberships` (`id`, `title_en`, `description_en`, `price`, `days`, `period`, `trial`, `recurring`, `private`, `active`) VALUES ('2', 'Basic 30', 'This is 30 days basic membership', '2.99', '1', 'M', '0', '0', '0', '1');
INSERT INTO `memberships` (`id`, `title_en`, `description_en`, `price`, `days`, `period`, `trial`, `recurring`, `private`, `active`) VALUES ('3', 'Basic 90', 'This is 90 days basic membership', '6.99', '90', 'D', '0', '0', '0', '1');
INSERT INTO `memberships` (`id`, `title_en`, `description_en`, `price`, `days`, `period`, `trial`, `recurring`, `private`, `active`) VALUES ('4', 'Platinum Subscription', 'Platinum Monthly Subscription.', '49.99', '1', 'Y', '0', '1', '0', '1');
INSERT INTO `memberships` (`id`, `title_en`, `description_en`, `price`, `days`, `period`, `trial`, `recurring`, `private`, `active`) VALUES ('5', 'Weekly Access', 'This is 7 days basic membership', '1.99', '1', 'W', '0', '0', '0', '1');


-- --------------------------------------------------
# -- Table structure for table `menus`
-- --------------------------------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `page_slug` varchar(50) NOT NULL,
  `mod_id` int(6) NOT NULL DEFAULT '0',
  `name_en` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content_type` varchar(20) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` enum('_self','_blank') NOT NULL DEFAULT '_blank',
  `icon` varchar(50) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `home_page` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `content_id` (`active`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `menus`
-- --------------------------------------------------

INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('1', '0', '3', 'Our-Contact-Info', '0', 'Contact Us', 'Contact-Us', 'page', '', '', '', '22', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('2', '0', '1', 'Inicio', '0', 'Home', 'Home', 'page', '', '', '', '1', '1', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('3', '0', '7', 'All-Modules', '0', 'All Modules', 'All-Modules', 'page', '', '', '', '2', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('4', '0', '6', 'Tree-Column-Page', '0', 'Three Columns', 'Three-Columns', 'page', '', '', '', '3', '0', '0');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('5', '0', '5', 'Demo-Gallery-Page', '0', 'Full Page', 'Full-Page', 'page', '', '', '', '10', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('6', '0', '0', '', '0', 'External Link', 'External-Link', 'web', 'http://www.google.com', '_blank', '', '11', '0', '0');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('7', '0', '8', 'More-Pages', '0', 'More Pages', 'More-Pages', 'page', '', '', 'day.png', '4', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('10', '18', '3', 'Our-Contact-Info', '0', 'New Submenu 3', 'New-Submenu-3', 'page', '', '', '', '21', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('11', '0', '2', 'What-is-CMS-pro', '0', 'About Us', 'About-Us', 'page', '', '', '', '18', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('17', '11', '9', 'Members-Only', '0', 'Members Only', 'Members-Only', 'page', '', '', '', '19', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('18', '11', '10', 'Membership-Only', '0', 'Membership Only', 'Membership-Only', 'page', '', '', '', '20', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('19', '7', '11', 'Event-Calendar-Demo', '0', 'Event Calendar Demo', 'Event-Calendar-Demo', 'page', '', '', 'calendar.png', '5', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('20', '7', '12', 'Slideout-Slider', '0', 'Slideout Slider', 'Slideout-Slider', 'page', '', '', '', '7', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('21', '7', '13', 'Content-Slider', '0', 'Content Slider', 'Content-Slider', 'page', '', '', '', '6', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('22', '7', '14', 'Video-Slider', '0', 'Video Slider', 'Video-Slider', 'page', '', '', '', '8', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `page_slug`, `mod_id`, `name_en`, `slug`, `content_type`, `link`, `target`, `icon`, `position`, `home_page`, `active`) VALUES ('29', '7', '0', '', '0', 'Features', 'Features', 'web', 'features.php', '_self', '', '9', '0', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_adblock`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_adblock`;
CREATE TABLE `mod_adblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_views_allowed` int(11) NOT NULL,
  `total_clicks_allowed` int(11) NOT NULL,
  `minimum_ctr` decimal(10,2) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_image_link` varchar(255) NOT NULL,
  `banner_image_alt` varchar(255) NOT NULL,
  `banner_html` text NOT NULL,
  `block_assignment` varchar(255) NOT NULL,
  `total_views` int(11) NOT NULL,
  `total_clicks` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_adblock`
-- --------------------------------------------------

INSERT INTO `mod_adblock` (`id`, `title_en`, `created`, `start_date`, `end_date`, `total_views_allowed`, `total_clicks_allowed`, `minimum_ctr`, `banner_image`, `banner_image_link`, `banner_image_alt`, `banner_html`, `block_assignment`, `total_views`, `total_clicks`) VALUES ('1', 'My Campaign', '2013-01-12 06:02:21', '2013-01-04', '0000-00-00', '0', '0', '0.00', 'default.png', 'wojoscripts.com', 'Wojoscripts', '', 'adblock/Advert-Wojoscripts', '246', '4');


-- --------------------------------------------------
# -- Table structure for table `mod_adblock_memberlevels`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_adblock_memberlevels`;
CREATE TABLE `mod_adblock_memberlevels` (
  `adblock_id` int(11) NOT NULL,
  `memberlevel_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`adblock_id`,`memberlevel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_adblock_memberlevels`
-- --------------------------------------------------

INSERT INTO `mod_adblock_memberlevels` (`adblock_id`, `memberlevel_id`) VALUES ('1', '0');
INSERT INTO `mod_adblock_memberlevels` (`adblock_id`, `memberlevel_id`) VALUES ('1', '1');
INSERT INTO `mod_adblock_memberlevels` (`adblock_id`, `memberlevel_id`) VALUES ('1', '8');
INSERT INTO `mod_adblock_memberlevels` (`adblock_id`, `memberlevel_id`) VALUES ('1', '9');


-- --------------------------------------------------
# -- Table structure for table `mod_comments`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_comments`;
CREATE TABLE `mod_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `username` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `www` varchar(220) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(16) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent_id`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_comments`
-- --------------------------------------------------

INSERT INTO `mod_comments` (`id`, `parent_id`, `page_id`, `username`, `user_id`, `email`, `body`, `www`, `created`, `ip`, `active`) VALUES ('1', '0', '2', 'Webmaster', '0', 'webmaster@wojoscripts.com', 'First comment is on me.', 'http://www.wojoscripts.com', '2011-01-30 16:34:55', '127.0.0.1', '1');
INSERT INTO `mod_comments` (`id`, `parent_id`, `page_id`, `username`, `user_id`, `email`, `body`, `www`, `created`, `ip`, `active`) VALUES ('2', '3', '2', 'Admin', '1', 'admin@mail.com', '<pre>Cum sociis natoque penatibus et <strong>magnis dis parturient</strong> montes, </pre>nascetur ridiculus mus. Nam nec odio nulla. Cras ullamcorper suscipit justo, at mattis odio auctor quis.', '', '2011-01-31 08:40:42', '127.0.0.1', '1');
INSERT INTO `mod_comments` (`id`, `parent_id`, `page_id`, `username`, `user_id`, `email`, `body`, `www`, `created`, `ip`, `active`) VALUES ('3', '5', '2', 'User1', '0', 'user1@mail.com', 'Ut dictum, eros eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna sit amet nibh. Suspendisse sed tortor nisi. Nulla facilisi. In sed risus in est cursus ornare....', '', '2011-01-31 08:45:54', '127.0.0.1', '1');
INSERT INTO `mod_comments` (`id`, `parent_id`, `page_id`, `username`, `user_id`, `email`, `body`, `www`, `created`, `ip`, `active`) VALUES ('4', '0', '2', 'User2', '0', 'user2@mail.com', 'Etiam non lacus ac velit <em>lobortis rutrum sed</em> id turpis. <code>Ut dictum, eros eu blandit pellentesque, nisi nisl dapibus mauris,</code>sed feugiat enim urna sit amet nibh. Suspendisse sed tortor nisi. Nulla facilisi. In sed risus in est cursus ornare. Fusce tempor hendrerit commodo.', '', '2011-01-31 08:48:26', '127.0.0.1', '1');
INSERT INTO `mod_comments` (`id`, `parent_id`, `page_id`, `username`, `user_id`, `email`, `body`, `www`, `created`, `ip`, `active`) VALUES ('5', '0', '2', 'User3', '0', 'user3@mail.com', 'In hac habit***e platea dictumst.ivamus leo diam, dignissim eu convallis in, posuere quis magna. Curabitur mollis, lectus sit amet bibendum faucibus, nisi ligula ultricies purus', '', '2011-01-31 08:51:25', '127.0.0.1', '1');
INSERT INTO `mod_comments` (`id`, `parent_id`, `page_id`, `username`, `user_id`, `email`, `body`, `www`, `created`, `ip`, `active`) VALUES ('6', '0', '2', 'User4', '0', 'user4@mail.com', 'Morbi sodales accumsan arcu sed venenatis. Vivamus leo diam, dignissim eu convallis in, posuere quis magna. Curabitur mollis, lectus sit amet bibendum faucibus, nisi ligula ultricies purus, in malesuada arcu sem ut mauris. Proin lobortis rutrum ultrices.', '', '2011-01-31 08:53:51', '127.0.0.1', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_comments_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_comments_config`;
CREATE TABLE `mod_comments_config` (
  `username_req` tinyint(1) NOT NULL DEFAULT '0',
  `email_req` tinyint(1) NOT NULL DEFAULT '0',
  `show_captcha` tinyint(1) NOT NULL DEFAULT '1',
  `show_www` tinyint(1) NOT NULL DEFAULT '0',
  `show_username` tinyint(1) DEFAULT '1',
  `show_email` tinyint(1) DEFAULT '1',
  `auto_approve` tinyint(1) NOT NULL DEFAULT '0',
  `notify_new` tinyint(1) NOT NULL DEFAULT '0',
  `public_access` tinyint(1) NOT NULL DEFAULT '0',
  `sorting` varchar(4) NOT NULL DEFAULT 'DESC',
  `blacklist_words` text,
  `char_limit` varchar(6) NOT NULL DEFAULT '400',
  `perpage` varchar(3) NOT NULL DEFAULT '10',
  `dateformat` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_comments_config`
-- --------------------------------------------------

INSERT INTO `mod_comments_config` (`username_req`, `email_req`, `show_captcha`, `show_www`, `show_username`, `show_email`, `auto_approve`, `notify_new`, `public_access`, `sorting`, `blacklist_words`, `char_limit`, `perpage`, `dateformat`) VALUES ('1', '1', '1', '1', '1', '0', '0', '0', '1', 'DESC', 'arse\narses\nass\nasses\nbollocks\ncrap', '400', '5', '%d %B %Y %H:%M');


-- --------------------------------------------------
# -- Table structure for table `mod_events`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_events`;
CREATE TABLE `mod_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `title_en` varchar(150) NOT NULL,
  `venue_en` varchar(150) DEFAULT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date DEFAULT '0000-00-00',
  `time_start` time DEFAULT '00:00:00',
  `time_end` time DEFAULT '00:00:00',
  `body_en` text,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_email` varchar(80) DEFAULT NULL,
  `contact_phone` varchar(16) DEFAULT NULL,
  `color` varchar(6) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_events`
-- --------------------------------------------------

INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('1', '1', 'Free Coffee for Each Monday', 'Office Rental Showroom', '2012-12-17', '2011-12-30', '11:18:00', '21:00:00', 'Vestibulum dictum elit eu risus porta egestas. Sed quis enim neque, sed  fringilla erat. Nunc feugiat tortor eu sem consequat aliquam. Cras non  nibh at lorem auctor interdum. Donec ut lacinia massa.', 'John Doe', 'john@gmail.com', '555-555-5555', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('2', '1', 'Lucky Draw', 'Office Rental Showroom', '2013-02-20', '2013-02-20', '13:30:00', '19:30:00', '\n&lt;p&gt;&lt;img src=&quot;uploads/images/pages/thumbs/thumb_demo_1.jpg&quot; alt=&quot;thumb_demo_1.jpg&quot; class=&quot;img-left&quot; /&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla posuere nibh auctor urna tincidunt fringilla. &lt;br /&gt;\n\tDonec imperdiet, orci quis aliquet laoreet, magna purus semper ligula, sit amet aliquam sapien enim in orci. Pellentesque at iaculis nibh.&lt;/p&gt; ', 'John Doe', 'john@gmail.com', '555-555-5555', '008000', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('3', '1', 'E-Commerce Seminar', 'Office Rental Showroom', '2011-12-19', '2011-12-26', '09:30:00', '13:30:00', 'Proin nec nisl est, id ornare lacus. Etiam mauris neque, scelerisque ut  ultrices vel, blandit et nisi. Nam commodo fermentum lectus vulputate  auctor. Maecenas hendrerit sapien sit amet erat mollis venenatis nec sit', 'John Doe', 'john@gmail.com', '555-555-5555', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('4', '1', 'E-Commerce Seminar II', 'Office Rental Showroom', '2011-12-19', '2011-12-22', '17:00:00', '19:00:00', 'Aliquam auctor molestie ipsum ultricies tincidunt. Suspendisse potenti.  Nulla volutpat urna et mi consectetur placerat iaculis lacus lacinia.  Integer a nisi id diam tempus commodo eget a tellus. In consequat augue  nec tortor bibendum vel semper metus sodales. Donec ut dui nisi, id  posuere augue.', 'John Doe', 'john@gmail.com', '555-555-5555', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('5', '1', 'New Year', 'New Year&#039;s Day in Canada', '2012-01-01', '2012-01-01', '00:00:00', '00:00:00', 'According to the Gregorian calendar, used in Canada and many other countries, January 1 is the first day of a new year. This date is commonly known as New Year&#039;s Day and is a statutory holiday in all Canadian provinces and territories.', '', '', '', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('6', '1', 'Epiphany', 'Epiphany in Canada', '2012-01-06', '2012-01-06', '00:00:00', '00:00:00', 'Epiphany is celebrated in Canada on January 6 each year. It remembers the three wise menÃ¢â‚¬â„¢s visit to baby Jesus and his baptism, according to events in the Christian Bible. Mummers or naluyuks may visit homes in Newfoundland and Labrador at this time of the year.', '', '', '', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('7', '1', 'Groundhog Day', 'Groundhog Day in Canada', '2012-12-27', '2012-09-26', '13:30:00', '00:00:00', 'Many Canadians take the time to observe Groundhog Day on February 2 each year, which is also Candlemas. Groundhog Day in Canada focuses on the concept of a groundhog coming out of its home in mid-winter to &quot;predictÃ¢â‚¬Â if spring is on its way in the northern hemisphere.', '', '', '', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('8', '1', 'Valentine&#039;s Day', 'Valentine&#039;s Day in Canada', '2012-02-14', '2012-02-14', '00:00:00', '00:00:00', 'Valentine&#039;s Day is an opportunity for people in Canada to tell somebody that they love them in a romantic way. It falls on February 14, the name day of two saints, St Valentine of Rome and St Valentine of Terni. In pre-Christian times, the middle of February was a time of pagan fertility festivals in Europe and allegedly the time when birds chose a mate.', '', '', '', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('9', '1', 'Recurring Event 2', 'Recurring Demo Event 2', '2012-04-16', '2012-04-16', '00:00:00', '00:00:00', 'Family Day is observed in the Canadian provinces of Alberta, Ontario and Saskatchewan on the third Monday of February. This holiday celebrates the importance of families and family life to people and their communities.', '', '', '', '', '1');
INSERT INTO `mod_events` (`id`, `user_id`, `title_en`, `venue_en`, `date_start`, `date_end`, `time_start`, `time_end`, `body_en`, `contact_person`, `contact_email`, `contact_phone`, `color`, `active`) VALUES ('10', '1', 'Recurring Event', 'Recurring Demo Event', '2012-04-17', '2012-05-02', '11:00:00', '16:00:00', 'This event shows recurring feature in event manager&lt;br /&gt;\n', '', '', '', '', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_events_data`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_events_data`;
CREATE TABLE `mod_events_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `color` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_events_data`
-- --------------------------------------------------

INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('20', '10', '2012-06-26', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('19', '10', '2012-06-25', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('18', '10', '2012-06-24', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('17', '10', '2012-06-23', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('16', '10', '2012-06-22', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('15', '10', '2012-06-21', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('14', '10', '2012-06-20', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('13', '9', '2012-12-27', '09F');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('12', '9', '2012-06-24', '09F');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('11', '10', '2012-04-17', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('21', '10', '2012-04-27', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('22', '10', '2012-04-28', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('23', '10', '2012-04-29', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('24', '10', '2012-04-30', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('25', '10', '2012-05-01', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('26', '10', '2012-05-02', 'F00');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('27', '9', '2012-04-18', '09F');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('48', '7', '2011-12-27', 'ff9900');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('50', '2', '2013-02-20', 'ffffff');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('43', '7', '2012-12-27', 'ff9900');
INSERT INTO `mod_events_data` (`id`, `event_id`, `event_date`, `color`) VALUES ('42', '1', '2012-12-17', 'ff9900');


-- --------------------------------------------------
# -- Table structure for table `mod_gallery_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_gallery_config`;
CREATE TABLE `mod_gallery_config` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) DEFAULT NULL,
  `folder` varchar(30) DEFAULT NULL,
  `rows` int(4) NOT NULL DEFAULT '0',
  `thumb_w` int(4) NOT NULL DEFAULT '0',
  `thumb_h` int(4) NOT NULL DEFAULT '0',
  `image_w` int(4) NOT NULL DEFAULT '0',
  `image_h` int(4) NOT NULL DEFAULT '0',
  `watermark` tinyint(1) NOT NULL DEFAULT '0',
  `method` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_gallery_config`
-- --------------------------------------------------

INSERT INTO `mod_gallery_config` (`id`, `title_en`, `folder`, `rows`, `thumb_w`, `thumb_h`, `image_w`, `image_h`, `watermark`, `method`, `created`) VALUES ('2', 'PROYECTOS', 'MI', '0', '0', '0', '280', '280', '0', '0', '2013-11-20 02:21:27');


-- --------------------------------------------------
# -- Table structure for table `mod_gallery_images`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_gallery_images`;
CREATE TABLE `mod_gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(6) NOT NULL DEFAULT '0',
  `title_en` varchar(100) DEFAULT NULL,
  `description_en` varchar(250) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `width` varchar(4) NOT NULL DEFAULT '100',
  `height` varchar(4) NOT NULL DEFAULT '100',
  `sorting` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_gallery_images`
-- --------------------------------------------------

INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('80', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_1491C2-89E5D9-8AD97C-A5527E-0236AF-8666DD.jpg', '100', '100', '58');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('81', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_A64718-D37851-22B563-D6A82D-F61874-48ACF5.jpg', '100', '100', '57');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('78', '2', 'Cambio de transformadores', '-/-', 'IMG_C38A01-0B6981-B6C8EA-C9096B-CA54B5-E4799D.jpg', '100', '100', '50');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('79', '2', 'Cambio de transformadores', '-/-', 'IMG_F2D6C1-87411D-A1721A-F39B6C-F81229-48277D.jpg', '100', '100', '52');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('77', '2', 'Cambio de transformadores', '-/-', 'IMG_17BB52-BA37FC-9BFE2B-0DC8C5-50D1AC-78B77B.jpg', '100', '100', '51');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('75', '2', 'Cambio de pararayos', '-/-', 'IMG_9DD0DA-07CAFB-CE37D8-ECDA80-B35FDA-EE1803.jpg', '100', '100', '45');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('76', '2', 'Cambio de pararayos', '-/-', 'IMG_F130F4-9F14E7-48BD0A-608D30-2CD15B-3B0442.jpg', '100', '100', '48');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('73', '2', 'Cambio de crucetas', '-/-', 'IMG_BC26CF-166820-B8EF09-DBEEE9-BCD842-F50A30.jpg', '100', '100', '43');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('74', '2', 'Cambio de pararayos', '-/-', 'IMG_EDE8E1-F2A5DA-04708B-8EA3F5-AB0F57-A9122F.jpg', '100', '100', '46');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('72', '2', 'Cambio de crucetas', '-/-', 'IMG_18BC17-CEA6BA-10A9D1-1880FA-41E5BB-EDCF83.jpg', '100', '100', '39');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('70', '2', 'Cambio de crucetas', '-/-', 'IMG_F4DD8C-5BAEFA-A5FEDB-9AD5FD-43F086-DE5320.jpg', '100', '100', '41');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('71', '2', 'Cambio de crucetas', '-/-', 'IMG_7E7A2C-4B21FE-A283E6-339F07-21652F-766A21.jpg', '100', '100', '40');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('68', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_3071D8-48D91D-9FD790-004A5F-701951-B09652.jpg', '100', '100', '4');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('69', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_53B329-D37C3C-4ED94C-CB3A75-8B5ACA-5F5E0D.jpg', '100', '100', '3');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('67', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_7FCB63-5337F3-A258EC-D7A8A6-6DB2E0-F9792B.jpg', '100', '100', '6');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('65', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_F826B3-B0384B-C94485-8B2207-380D7B-C254C1.jpg', '100', '100', '8');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('66', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_C6C84B-40ECF1-4CEC43-86E7F7-32CCC2-FD7170.jpg', '100', '100', '7');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('63', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_5030EF-D92A21-806FDD-AF5B76-F54171-28443D.jpg', '100', '100', '2');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('62', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_0A2DD6-0FA290-CD338C-EF82AC-485390-B12CE0.jpg', '100', '100', '33');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('60', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_5877C9-7199B9-2E597C-4397F7-B952A8-01F65A.jpg', '100', '100', '36');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('61', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_64B16E-005532-F96B31-40B5AD-F7D6AC-25473F.jpg', '100', '100', '35');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('58', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_D6C7EF-BBD37B-18372B-4C333E-4541BF-1F76B8.jpg', '100', '100', '30');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('59', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_C49E67-1629A0-19B00F-14545A-5B2921-930E2A.jpg', '100', '100', '38');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('57', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_BA7EE2-1A8F7D-253E38-6B9A77-8D187E-CBCF43.jpg', '100', '100', '31');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('56', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_E6EB2B-E24284-3972B4-FBE5B7-B92331-9C3FEA.jpg', '100', '100', '32');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('49', '0', '-/-', '-/-', 'IMG_9904CA-C51FE1-EA15CF-2501CF-481509-138002.jpg', '100', '100', '0');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('50', '0', '-/-', '-/-', 'IMG_D953B0-4F2CF6-F02471-506FD1-75C54B-083D9F.jpg', '100', '100', '0');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('51', '0', '-/-', '-/-', 'IMG_84AE2E-6A2767-08943C-856310-C5ADD7-4530F2.jpg', '100', '100', '0');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('55', '2', 'Equipos de Infraestructura', '-/-', 'IMG_24265F-13F0C9-FBC6CA-6351FA-91E533-F0208D.jpg', '100', '100', '24');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('54', '2', 'Equipos de Infraestructura', '-/-', 'IMG_AA66FE-A13333-3E86BB-54A8A7-2F6162-6DBBF1.jpg', '100', '100', '26');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('53', '2', 'Equipos de Infraestructura', '-/-', 'IMG_3686CC-D5AB91-F183A9-115780-3D7FEE-BFC028.jpg', '100', '100', '25');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('52', '2', 'Equipos de Infraestructura', '-/-', 'IMG_D52371-72A156-ADAABA-8623AE-0194E5-7CB09B.jpg', '100', '100', '28');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('82', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_89D238-7893E2-01B217-171DF2-9DBF47-D30420.jpg', '100', '100', '56');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('83', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_4E8D74-13B114-C0ED3D-4D111C-3BAD9A-6A69D9.jpg', '100', '100', '55');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('84', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_46ED0E-91280D-B10A19-C51700-3D9C4E-9ED368.jpg', '100', '100', '54');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('85', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_D3D614-4A664D-0E6E73-C7FB98-073716-C90DB2.jpg', '100', '100', '59');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('86', '2', 'Reparación de aires acondicionados', '-/-', 'IMG_803BCA-286D78-597A30-6A98E3-10CAE7-50291A.jpg', '100', '100', '12');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('87', '2', 'Reparación de aires acondicionados', '-/-', 'IMG_EEFFD4-1DC213-B86A04-BE1ABC-42A6DF-63BE82.jpg', '100', '100', '10');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('88', '2', 'Reparación de aires acondicionados', '-/-', 'IMG_BDD1DD-0F8CA4-A14A11-972F23-EBB6DF-043A39.jpg', '100', '100', '11');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('89', '2', 'Reparación de aires acondicionados', '-/-', 'IMG_177193-8E6394-59AD9C-790283-B758C7-FEACA4.jpg', '100', '100', '13');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('90', '2', 'Reparación de motoniveladores', '-/-', 'IMG_D57506-6294EC-2BEF0D-9CAC25-2BA1A3-F88E14.jpg', '100', '100', '17');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('91', '2', 'Reparación de motoniveladores', '-/-', 'IMG_F248E1-6EB12E-601C5D-5423D9-8A7C6F-C1EAF8.jpg', '100', '100', '16');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('92', '2', 'Reparación de motoniveladores', '-/-', 'IMG_D5270F-9F7CC2-395E95-47C9C0-B3BDB8-AF2B3A.jpg', '100', '100', '14');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('93', '2', 'Servicios de Suministro', '-/-', 'IMG_091ABF-3C28E5-16EEE0-06CB22-2E49B1-D83F22.jpg', '100', '100', '22');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('94', '2', 'Servicios de Suministro', '-/-', 'IMG_88008E-541362-8053E2-D09FB4-50AFD2-A1ADC6.jpg', '100', '100', '21');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('95', '2', 'Servicios de Suministro', '-/-', 'IMG_2F18CA-94F66C-370296-F4EB56-BEFD25-0BB266.jpg', '100', '100', '19');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('96', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_484BB2-FFBD49-2A8502-94389D-3B6EDB-3CEADC.jpg', '100', '100', '1');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('99', '2', 'Mantenimiento e Instalación', '-/-', 'IMG_EB82B3-8B6033-BFBB7A-323AF5-DF257E-835E94.jpg', '100', '100', '5');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('102', '2', 'Reparación de aires acondicionados', '-/-', 'IMG_D441EE-08471C-9C8DD6-5B6962-9153D9-729B1D.jpg', '100', '100', '9');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('103', '2', 'Reparación de motoniveladores', '-/-', 'IMG_256ADD-AE8B0F-619E61-CE9BAA-B177E8-5322CF.jpg', '100', '100', '15');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('104', '2', 'Reparación de motoniveladores', '-/-', 'IMG_C8E1D8-237571-93EF1C-C314A1-D2E398-011B78.jpg', '100', '100', '18');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('105', '2', 'Servicios de Suministro', '-/-', 'IMG_B0957C-933065-5EF41C-BF7BBE-24789F-32FA94.jpg', '100', '100', '23');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('106', '2', 'Servicios de Suministro', '-/-', 'IMG_E8969F-7956DB-8D4380-549794-297FCB-AD6BA2.jpg', '100', '100', '20');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('107', '2', 'Equipos de Infraestructura', '-/-', 'IMG_B98969-F39359-A2600A-312C17-179B47-474266.jpg', '100', '100', '29');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('108', '2', 'Equipos de Infraestructura', '-/-', 'IMG_90C2C3-B58C0B-A52F84-9BFCC8-DD99EB-3BB3EC.jpg', '100', '100', '27');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('109', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_38FB15-97DF23-479CA6-E0C641-D7AEA8-6D5A25.jpg', '100', '100', '37');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('110', '2', 'Equipos para Obras Civiles', '-/-', 'IMG_6F7DA2-66EED9-E9C7A1-66B45E-BFB8CF-E800D2.jpg', '100', '100', '34');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('111', '2', 'Cambio de crucetas', '-/-', 'IMG_D5569D-CB938A-F24941-576896-312A8B-19E08B.jpg', '100', '100', '42');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('112', '2', 'Cambio de pararayos', '-/-', 'IMG_66E05E-649848-21200D-DD2850-B6892D-5C2EDF.jpg', '100', '100', '47');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('115', '2', 'Cambio de transformadores', '-/-', 'IMG_BD4D57-99AA2F-14C4A5-2DC116-188F64-C5C431.jpg', '100', '100', '49');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('114', '2', 'Cambio de pararayos', '-/-', 'IMG_EDE40D-3D6437-B032E9-BA67CB-F27FE8-B9BA71.jpg', '100', '100', '44');
INSERT INTO `mod_gallery_images` (`id`, `gallery_id`, `title_en`, `description_en`, `thumb`, `width`, `height`, `sorting`) VALUES ('116', '2', 'Sistemas de puesta a tierra', '-/-', 'IMG_5E3423-3AFE38-BF22FF-01C92C-2E7CBA-37124B.jpg', '100', '100', '53');


-- --------------------------------------------------
# -- Table structure for table `mod_gmaps`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_gmaps`;
CREATE TABLE `mod_gmaps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `lng` decimal(10,6) NOT NULL,
  `zoom` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_gmaps`
-- --------------------------------------------------



-- --------------------------------------------------
# -- Table structure for table `mod_slidecms`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_slidecms`;
CREATE TABLE `mod_slidecms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `plug_name` varchar(60) DEFAULT NULL,
  `height` smallint(1) NOT NULL DEFAULT '400',
  `navtype` varchar(10) NOT NULL DEFAULT '0',
  `navpos` varchar(10) NOT NULL DEFAULT 'bottom',
  `navplace` enum('innernav','outer') NOT NULL DEFAULT 'outer',
  `navarrows` tinyint(1) NOT NULL DEFAULT '1',
  `fullscreen` tinyint(1) NOT NULL DEFAULT '0',
  `transition` varchar(20) NOT NULL DEFAULT 'slide',
  `durration` int(11) NOT NULL DEFAULT '300',
  `captions` tinyint(1) NOT NULL DEFAULT '1',
  `autoplay` tinyint(1) NOT NULL DEFAULT '0',
  `loop` tinyint(1) NOT NULL DEFAULT '0',
  `fit` enum('none','contain','cover','scaledown') NOT NULL DEFAULT 'contain',
  `shuffle` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`navtype`,`navpos`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_slidecms`
-- --------------------------------------------------

INSERT INTO `mod_slidecms` (`id`, `title`, `plug_name`, `height`, `navtype`, `navpos`, `navplace`, `navarrows`, `fullscreen`, `transition`, `durration`, `captions`, `autoplay`, `loop`, `fit`, `shuffle`) VALUES ('1', 'home', 'slidecms/home', '416', 'dots', 'bottom', 'innernav', '0', '0', 'crossfade', '350', '0', '1', '1', 'none', '0');
INSERT INTO `mod_slidecms` (`id`, `title`, `plug_name`, `height`, `navtype`, `navpos`, `navplace`, `navarrows`, `fullscreen`, `transition`, `durration`, `captions`, `autoplay`, `loop`, `fit`, `shuffle`) VALUES ('2', 'servicios', 'slidecms/servicios', '393', 'false', 'bottom', 'outer', '0', '0', 'crossfade', '350', '0', '0', '0', 'none', '0');


-- --------------------------------------------------
# -- Table structure for table `mod_slidecms_data`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_slidecms_data`;
CREATE TABLE `mod_slidecms_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL DEFAULT '0',
  `data_type` enum('img','txt','vid') DEFAULT 'img',
  `data` varchar(200) DEFAULT NULL,
  `caption_en` varchar(200) DEFAULT NULL,
  `body` text,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sorting` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_slidecms_data`
-- --------------------------------------------------

INSERT INTO `mod_slidecms_data` (`id`, `slider_id`, `data_type`, `data`, `caption_en`, `body`, `created`, `sorting`) VALUES ('12', '2', 'img', 'IMG_E2FDA3-242611-0E5D26-E05968-50BEF3-A275CD.png', '-/-', '', '2013-11-25 22:31:16', '0');
INSERT INTO `mod_slidecms_data` (`id`, `slider_id`, `data_type`, `data`, `caption_en`, `body`, `created`, `sorting`) VALUES ('10', '1', 'img', 'IMG_C5A3B0-A219B6-02D9AC-64B5B2-1D964E-9D287A.png', '-/-', '', '2013-11-19 23:28:02', '0');
INSERT INTO `mod_slidecms_data` (`id`, `slider_id`, `data_type`, `data`, `caption_en`, `body`, `created`, `sorting`) VALUES ('11', '1', 'img', 'IMG_FDD40C-F121DD-89F476-463320-A97824-B527BC.png', '-/-', '', '2013-11-19 23:28:18', '0');


-- --------------------------------------------------
# -- Table structure for table `modules`
-- --------------------------------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(120) NOT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '0',
  `info_en` text,
  `modalias` varchar(50) NOT NULL,
  `hasconfig` tinyint(1) NOT NULL DEFAULT '0',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey_en` varchar(200) DEFAULT NULL,
  `metadesc_en` text,
  `theme` varchar(50) DEFAULT NULL,
  `ver` varchar(4) DEFAULT '1.00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `modules`
-- --------------------------------------------------

INSERT INTO `modules` (`id`, `title_en`, `show_title`, `info_en`, `modalias`, `hasconfig`, `system`, `created`, `metakey_en`, `metadesc_en`, `theme`, `ver`, `active`) VALUES ('1', 'Comments', '0', 'Encourage your readers to join in the discussion and leave comments and respond promptly to the comments left by your readers to make them feel valued', 'comments', '1', '0', '2011-01-10 14:10:24', '', '', '', '1.00', '1');
INSERT INTO `modules` (`id`, `title_en`, `show_title`, `info_en`, `modalias`, `hasconfig`, `system`, `created`, `metakey_en`, `metadesc_en`, `theme`, `ver`, `active`) VALUES ('2', 'Gallery', '0', 'Fully featured gallery module', 'gallery', '1', '0', '2011-04-28 06:19:32', '', '', '', '1.00', '1');
INSERT INTO `modules` (`id`, `title_en`, `show_title`, `info_en`, `modalias`, `hasconfig`, `system`, `created`, `metakey_en`, `metadesc_en`, `theme`, `ver`, `active`) VALUES ('3', 'Event Manager', '0', 'Easily publish and manage your company events.', 'events', '1', '0', '2011-11-22 14:18:10', '', '', '', '1.05', '1');
INSERT INTO `modules` (`id`, `title_en`, `show_title`, `info_en`, `modalias`, `hasconfig`, `system`, `created`, `metakey_en`, `metadesc_en`, `theme`, `ver`, `active`) VALUES ('4', 'AdBlock', '0', 'Manage Ad Campaigns', 'adblock', '1', '0', '2012-12-24 22:22:22', '', '', '', '1.00', '1');
INSERT INTO `modules` (`id`, `title_en`, `show_title`, `info_en`, `modalias`, `hasconfig`, `system`, `created`, `metakey_en`, `metadesc_en`, `theme`, `ver`, `active`) VALUES ('5', 'Google Maps', '0', 'Create multiple google maps', 'gmaps', '1', '0', '2013-05-22 14:15:16', '', '', '', '1.00', '1');
INSERT INTO `modules` (`id`, `title_en`, `show_title`, `info_en`, `modalias`, `hasconfig`, `system`, `created`, `metakey_en`, `metadesc_en`, `theme`, `ver`, `active`) VALUES ('6', 'Slider Manager', '0', 'Create unlimited video/image sliders with different layout styles', 'slidecms', '1', '0', '2013-09-07 16:28:45', '', '', '', '1.00', '1');


-- --------------------------------------------------
# -- Table structure for table `pages`
-- --------------------------------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(200) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `contact_form` tinyint(1) NOT NULL DEFAULT '0',
  `membership_id` varchar(20) NOT NULL DEFAULT '0',
  `module_id` int(4) NOT NULL DEFAULT '0',
  `module_data` varchar(100) NOT NULL DEFAULT '0',
  `module_name` varchar(50) DEFAULT NULL,
  `custom_bg` varchar(100) DEFAULT NULL,
  `access` enum('Public','Registered','Membership') NOT NULL DEFAULT 'Public',
  `keywords_en` text NOT NULL,
  `description_en` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `pages`
-- --------------------------------------------------

INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('1', 'Inicio', 'Inicio', '0', '0', '0', '0', '', '', 'Public', '', '', '2010-07-22 20:11:55', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('15', 'Nosotros', 'Nosotros', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-19 23:29:19', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('16', 'Servicios', 'Servicios', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-19 23:29:29', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('17', 'Clientes', 'Clientes', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-19 23:29:39', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('18', 'Contacto', 'Contacto', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-19 23:29:48', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('19', 'Proyectos', 'Proyectos', '0', '0', '2', '2', 'gallery', '', 'Public', '', '', '2013-11-20 18:04:09', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('20', 'Who are we', 'Who-are-we', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-27 22:32:08', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('21', 'Home', 'Home', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-27 22:32:18', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('22', 'Services', 'Services', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-27 22:32:29', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('23', 'Our clients', 'Our-clients', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-27 22:32:40', '1');
INSERT INTO `pages` (`id`, `title_en`, `slug`, `contact_form`, `membership_id`, `module_id`, `module_data`, `module_name`, `custom_bg`, `access`, `keywords_en`, `description_en`, `created`, `active`) VALUES ('24', 'Contact us', 'Contact-us', '0', '0', '0', '0', '', '', 'Public', '', '', '2013-11-27 22:32:51', '1');


-- --------------------------------------------------
# -- Table structure for table `payments`
-- --------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(100) DEFAULT NULL,
  `membership_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate_amount` varchar(255) NOT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `date` datetime NOT NULL,
  `pp` enum('PayPal','MoneyBookers') DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `payments`
-- --------------------------------------------------

INSERT INTO `payments` (`id`, `txn_id`, `membership_id`, `user_id`, `rate_amount`, `currency`, `date`, `pp`, `ip`, `status`) VALUES ('1', '', '2', '1', '5.00', '', '2013-01-09 14:12:32', 'PayPal', '', '1');
INSERT INTO `payments` (`id`, `txn_id`, `membership_id`, `user_id`, `rate_amount`, `currency`, `date`, `pp`, `ip`, `status`) VALUES ('2', '', '2', '2', '5.00', '', '2013-01-03 14:12:32', 'PayPal', '', '1');
INSERT INTO `payments` (`id`, `txn_id`, `membership_id`, `user_id`, `rate_amount`, `currency`, `date`, `pp`, `ip`, `status`) VALUES ('3', '', '3', '3', '10.00', '', '2013-01-04 16:47:36', 'MoneyBookers', '', '1');


-- --------------------------------------------------
# -- Table structure for table `plug_content_slider`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_content_slider`;
CREATE TABLE `plug_content_slider` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) DEFAULT NULL,
  `description_en` text,
  `filename` varchar(50) DEFAULT NULL,
  `align` tinyint(1) NOT NULL DEFAULT '0',
  `position` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_content_slider`
-- --------------------------------------------------

INSERT INTO `plug_content_slider` (`id`, `title_en`, `description_en`, `filename`, `align`, `position`) VALUES ('1', 'Just a Background Image', 'Erat. Pellentesque erat. Mauris vehicula vestibulum justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pulvinar est. Integer urna. Pellentesque pulvinar dui a magna. Nulla facilisi. Proin imperdiet. Aliquam ornare, metus vitae gravida dignissim, nisi nisl ultricies felis, ac tristique enim pede eget elit. Integer non erat nec turpis sollicitudin malesuada. &lt;br /&gt;\r\n&lt;br /&gt;\r\nVestibulum dapibus. Nulla facilisi. Nulla iaculis, leo sit amet mollis luctus, sapien eros consectetur...&lt;br /&gt; Nea fi pasko s\'joro definitive. Ina pobo nevo vo. Fore predikativo ba iel, tiel pleja mikrometro er kie. Ali neniaÄµo anstataÅ­e ac, sen dato tele he, ene u unuj onklo esceptinte. ', 'FILE_D63F4A-0AF465-166E89-3AB392-A3DDBF-A77698.jpg', '0', '1');
INSERT INTO `plug_content_slider` (`id`, `title_en`, `description_en`, `filename`, `align`, `position`) VALUES ('2', 'Content with linked button', 'Pellentesque erat. Mauris vehicula vestibulum justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pulvinar est. Integer urna. Pellentesque pulvinar dui a magna. Nulla facilisi. Proin imperdiet. Aliquam ornare, metus vitae gravida dignissim, nisi nisl ultricies felis, ac tristique enim pede eget elit. Integer non erat nec turpis sollicitudin malesuada. &lt;br /&gt;\r\n&lt;br /&gt;\r\nVestibulum dapibus. Nulla facilisi. Nulla iaculis, leo sit amet mollis luctus, sapien eros consectetur&lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;a class=&quot;button&quot; href=&quot;#&quot;&gt;Read More...&lt;/a&gt;&lt;br /&gt; ', 'FILE_C6D5B5-050CF5-28C7B4-9591DF-B88E06-8CF47C.jpg', '0', '2');
INSERT INTO `plug_content_slider` (`id`, `title_en`, `description_en`, `filename`, `align`, `position`) VALUES ('3', 'Content with an additional image', '&lt;img width=&quot;290&quot; height=&quot;119&quot; align=&quot;left&quot; class=&quot;image&quot; src=&quot;uploads/images/pages/demo_1.jpg&quot; title=&quot;&quot; alt=&quot;CMS pro!&quot; style=&quot;margin-bottom: 15px; margin-right: 15px;&quot; /&gt;Pellentesque erat. Mauris vehicula vestibulum justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pulvinar est. Integer urna. Pellentesque pulvinar dui a magna. Nulla facilisi. Proin imperdiet. Aliquam ornare, metus vitae gravida dignissim, nisi nisl ultricies felis, ac tristique enim pede eget elit. Integer non erat nec turpis sollicitudin malesuada. Vestibulum dapibus. Nulla facilisi. Nulla iaculis, leo sit amet mollis luctus, sapien eros consectetur.&lt;br /&gt;\r\n', 'FILE_C4B436-1D7C31-7F2B49-CCB423-9E14CC-DFC38B.jpg', '0', '3');
INSERT INTO `plug_content_slider` (`id`, `title_en`, `description_en`, `filename`, `align`, `position`) VALUES ('4', 'Content aligned to the right', 'Pellentesque erat. Mauris vehicula vestibulum justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pulvinar est. Integer urna. Pellentesque pulvinar dui a magna. Nulla facilisi. Proin imperdiet. Aliquam ornare, metus vitae gravida dignissim, nisi nisl ultricies felis, ac tristique enim pede eget elit. Integer non erat nec turpis sollicitudin malesuada. Vestibulum dapibus. Nulla facilisi. Nulla iaculis, leo sit amet mollis luctus, sapien eros consectetur&lt;br /&gt;\r\n&lt;br /&gt;\r\nVestibulum dapibus. Nulla facilisi. Nulla iaculis, leo sit amet mollis luctus, sapien eros consectetur&lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;a href=&quot;#&quot; class=&quot;button&quot;&gt;Read More...&lt;/a&gt;', 'FILE_860000-15C6EA-3AE42A-503B48-F2C4CD-536821.jpg', '1', '4');


-- --------------------------------------------------
# -- Table structure for table `plug_donate`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_donate`;
CREATE TABLE `plug_donate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_donate`
-- --------------------------------------------------

INSERT INTO `plug_donate` (`id`, `name`, `email`, `amount`, `created`) VALUES ('1', 'Web Master', 'webmaster@domain.com', '125.00', '2012-06-28 10:41:55');
INSERT INTO `plug_donate` (`id`, `name`, `email`, `amount`, `created`) VALUES ('2', 'Web Master', 'webmaster@domain.com', '15.00', '2012-06-28 10:53:56');


-- --------------------------------------------------
# -- Table structure for table `plug_donate_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_donate_config`;
CREATE TABLE `plug_donate_config` (
  `atarget` decimal(13,2) NOT NULL,
  `paypal` varchar(80) NOT NULL,
  `thankyou` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_donate_config`
-- --------------------------------------------------

INSERT INTO `plug_donate_config` (`atarget`, `paypal`, `thankyou`) VALUES ('750.00', 'webmaster@paypal.com', 'Tree-Column-Page');


-- --------------------------------------------------
# -- Table structure for table `plug_elastic`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_elastic`;
CREATE TABLE `plug_elastic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description_en` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `filename` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `position` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='contains slider data';

-- --------------------------------------------------
# Dumping data for table `plug_elastic`
-- --------------------------------------------------

INSERT INTO `plug_elastic` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('1', 'Piko', 'Verbatium', 'FILE_472CBE-2F37A5-2C6705-23F422-FACC3A-70B2CB.jpg', '1');
INSERT INTO `plug_elastic` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('2', 'Simil', 'Homonimo', 'FILE_F83BB2-0550CB-F31AA6-8F6201-F8EA03-D86934.jpg', '2');
INSERT INTO `plug_elastic` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('3', 'Kioma', 'Volitivo', 'FILE_4D7E14-4A7FEA-52F99E-5C4464-843D7F-706B1E.jpg', '3');
INSERT INTO `plug_elastic` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('4', 'Memmortigo', 'Multiplikite', 'FILE_D5D36F-768049-E68040-DFF5A5-398C34-BF91BD.jpg', '4');
INSERT INTO `plug_elastic` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('5', 'Eligi', 'Verbatium', 'FILE_75D54A-9A2D05-04AC78-06ED6D-2F2748-883FD9.jpg', '5');


-- --------------------------------------------------
# -- Table structure for table `plug_elastic_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_elastic_config`;
CREATE TABLE `plug_elastic_config` (
  `animation` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'center',
  `autoplay` tinyint(1) NOT NULL DEFAULT '1',
  `interval` smallint(4) NOT NULL DEFAULT '3000',
  `speed` smallint(3) NOT NULL DEFAULT '800',
  `titlespeed` smallint(3) NOT NULL DEFAULT '800',
  `thumbMaxWidth` smallint(2) NOT NULL DEFAULT '150',
  `height` smallint(2) NOT NULL DEFAULT '350'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='contains slider configuration data';

-- --------------------------------------------------
# Dumping data for table `plug_elastic_config`
-- --------------------------------------------------

INSERT INTO `plug_elastic_config` (`animation`, `autoplay`, `interval`, `speed`, `titlespeed`, `thumbMaxWidth`, `height`) VALUES ('center', '1', '3000', '800', '800', '250', '375');


-- --------------------------------------------------
# -- Table structure for table `plug_newsslider`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_newsslider`;
CREATE TABLE `plug_newsslider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(150) DEFAULT NULL,
  `body_en` text,
  `show_title` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `show_created` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_newsslider`
-- --------------------------------------------------

INSERT INTO `plug_newsslider` (`id`, `title_en`, `body_en`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('1', 'Etiam non lacus', 'Morbi sodales accumsan arcu sed venenatis. Vivamus leo diam, dignissim  eu convallis in, posuere quis magna. Curabitur mollis, lectus sit amet  bibendum faucibus, nisi ligula ultricies purus', '1', '2010-10-28 04:14:11', '1', '1', '1');
INSERT INTO `plug_newsslider` (`id`, `title_en`, `body_en`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('2', 'Cras ullamcorper', 'Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut dictum, eros  eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna  sit amet nibh. Suspendisse sed tortor nisi. Nulla facilisi. In sed  risus in est cursus ornare.', '1', '2010-10-28 04:14:33', '1', '2', '1');
INSERT INTO `plug_newsslider` (`id`, `title_en`, `body_en`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('3', 'Vivamus vitae', 'Lusce pulvinar velit sit amet ligula ornare tempus vulputate ipsum  semper. Praesent non lorem odio. Fusce sed dui massa, eu viverra erat.  Proin posuere nulla in lectus malesuada volutpat. Cras tristique blandit  tellus, eu consequat ante', '1', '2010-10-28 04:21:34', '1', '3', '1');
INSERT INTO `plug_newsslider` (`id`, `title_en`, `body_en`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('4', 'Another News', 'Vivamus vitae augue sed lacus placerat sollicitudin quis vel arcu. Vestibulum auctor, magna sit amet pulvinar tristique, nunc felis viverra tortor, venenatis convallis leo mauris eu massa. Intege', '1', '2010-10-28 04:43:36', '1', '4', '1');


-- --------------------------------------------------
# -- Table structure for table `plug_poll_options`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_poll_options`;
CREATE TABLE `plug_poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `value_en` varchar(250) NOT NULL,
  `position` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_poll_options`
-- --------------------------------------------------

INSERT INTO `plug_poll_options` (`id`, `question_id`, `value_en`, `position`) VALUES ('5', '1', 'Very Hard', '5');
INSERT INTO `plug_poll_options` (`id`, `question_id`, `value_en`, `position`) VALUES ('4', '1', 'Hard', '4');
INSERT INTO `plug_poll_options` (`id`, `question_id`, `value_en`, `position`) VALUES ('3', '1', 'Easy', '3');
INSERT INTO `plug_poll_options` (`id`, `question_id`, `value_en`, `position`) VALUES ('2', '1', 'Very Easy', '2');
INSERT INTO `plug_poll_options` (`id`, `question_id`, `value_en`, `position`) VALUES ('1', '1', 'Piece of cake', '1');


-- --------------------------------------------------
# -- Table structure for table `plug_poll_questions`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_poll_questions`;
CREATE TABLE `plug_poll_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_en` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_poll_questions`
-- --------------------------------------------------

INSERT INTO `plug_poll_questions` (`id`, `question_en`, `created`, `status`) VALUES ('1', 'How do you find CMS pro! Installation?', '2010-10-13 07:42:18', '1');


-- --------------------------------------------------
# -- Table structure for table `plug_poll_votes`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_poll_votes`;
CREATE TABLE `plug_poll_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `voted_on` datetime NOT NULL,
  `ip` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_poll_votes`
-- --------------------------------------------------

INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('1', '2', '2010-10-14 14:00:55', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('2', '1', '2010-10-14 14:01:27', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('3', '1', '2010-10-14 14:02:04', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('4', '1', '2010-10-14 14:02:13', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('5', '3', '2010-10-14 14:02:16', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('6', '4', '2010-10-14 14:02:21', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('7', '3', '2010-10-14 14:02:24', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('8', '1', '2010-10-14 14:02:27', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('9', '2', '2010-10-14 14:02:31', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('10', '5', '2010-10-14 14:02:35', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('11', '1', '2010-10-14 14:02:38', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('12', '2', '2010-10-14 14:02:43', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('13', '1', '2010-10-14 14:02:46', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('14', '1', '2010-10-14 14:02:50', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('15', '1', '2010-10-14 14:05:26', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('16', '1', '2010-10-14 14:05:29', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('17', '4', '2010-10-14 14:05:33', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('18', '2', '2010-10-14 14:05:36', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('19', '1', '2010-10-14 14:05:40', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('20', '3', '2010-10-14 14:05:46', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('21', '2', '2010-10-14 14:05:49', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('22', '2', '2010-10-14 14:21:37', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('23', '1', '2010-10-14 14:21:53', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('24', '5', '2010-10-14 14:21:59', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('25', '1', '2010-10-14 14:35:27', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('26', '1', '2010-10-15 00:42:05', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('27', '3', '2010-10-15 00:49:42', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('28', '2', '2010-10-15 01:22:00', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('29', '2', '2010-10-15 01:24:51', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('30', '1', '2010-10-15 01:37:21', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('31', '1', '2010-10-15 01:38:48', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('32', '1', '2010-10-15 01:41:30', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('33', '1', '2010-10-15 01:42:21', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('34', '1', '2010-10-15 04:53:42', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('35', '3', '2010-10-15 05:09:14', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('36', '3', '2010-11-24 21:00:27', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('37', '3', '2010-11-28 00:56:07', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('38', '3', '2012-12-22 21:57:05', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('39', '1', '2012-12-22 22:46:26', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('40', '5', '2012-12-24 15:20:53', '127.0.0.1');
INSERT INTO `plug_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('41', '1', '2012-12-26 20:20:01', '127.0.0.1');


-- --------------------------------------------------
# -- Table structure for table `plug_rss_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_rss_config`;
CREATE TABLE `plug_rss_config` (
  `url` varchar(200) DEFAULT NULL,
  `title_trim` varchar(3) DEFAULT NULL,
  `show_body` tinyint(1) NOT NULL DEFAULT '0',
  `body_trim` varchar(3) DEFAULT NULL,
  `show_date` tinyint(1) NOT NULL DEFAULT '1',
  `dateformat` varchar(30) DEFAULT NULL,
  `perpage` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_rss_config`
-- --------------------------------------------------

INSERT INTO `plug_rss_config` (`url`, `title_trim`, `show_body`, `body_trim`, `show_date`, `dateformat`, `perpage`) VALUES ('http://codecanyon.net/feeds/users/gewa13', '0', '0', '100', '0', '%b %d %Y', '5');


-- --------------------------------------------------
# -- Table structure for table `plug_slideout`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_slideout`;
CREATE TABLE `plug_slideout` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) DEFAULT NULL,
  `description_en` text,
  `filename` varchar(100) DEFAULT NULL,
  `position` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_slideout`
-- --------------------------------------------------

INSERT INTO `plug_slideout` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('1', 'We believe in', 'Tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.', 'FILE_3691C4-E1C5E4-8BE3FC-B8B5E1-E1FB2B-48A0BC.jpg', '1');
INSERT INTO `plug_slideout` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('2', 'making the web', 'Tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.', 'FILE_5B2FB7-17F69F-028F93-1B0BE9-07AE9C-A7F763.jpg', '2');
INSERT INTO `plug_slideout` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('3', 'a better place', 'Tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.', 'FILE_DB6414-743863-9DDDAD-4B27FF-1093E4-FB162F.jpg', '3');
INSERT INTO `plug_slideout` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('4', 'through innovation', 'Tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.', 'FILE_B1F6F8-CD645E-9DDE38-81222B-C9D77C-51F736.jpg', '4');
INSERT INTO `plug_slideout` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('5', 'and technology', 'Tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.', 'FILE_2718CE-E249BB-C0F3CE-84D187-6F1A8F-0D5F4E.jpg', '5');
INSERT INTO `plug_slideout` (`id`, `title_en`, `description_en`, `filename`, `position`) VALUES ('6', 'with CMS pro!', 'Tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.\r\n', 'FILE_4E1B30-8EFA5E-E12025-3AA1BA-9F3728-4B42D2.jpg', '6');


-- --------------------------------------------------
# -- Table structure for table `plug_slider`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_slider`;
CREATE TABLE `plug_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(150) NOT NULL DEFAULT '',
  `description_en` text,
  `filename` varchar(150) NOT NULL DEFAULT '',
  `url` varchar(150) NOT NULL DEFAULT '',
  `page_id` int(6) DEFAULT '0',
  `urltype` enum('int','ext','nourl') DEFAULT 'nourl',
  `position` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_slider`
-- --------------------------------------------------



-- --------------------------------------------------
# -- Table structure for table `plug_slider_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_slider_config`;
CREATE TABLE `plug_slider_config` (
  `animation` varchar(30) NOT NULL,
  `anispeed` varchar(6) NOT NULL DEFAULT '0',
  `anitime` varchar(10) NOT NULL DEFAULT '0',
  `shownav` tinyint(1) NOT NULL DEFAULT '0',
  `shownavhide` tinyint(1) NOT NULL DEFAULT '0',
  `controllnav` tinyint(1) NOT NULL DEFAULT '0',
  `hoverpause` tinyint(1) NOT NULL DEFAULT '0',
  `showcaption` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_slider_config`
-- --------------------------------------------------

INSERT INTO `plug_slider_config` (`animation`, `anispeed`, `anitime`, `shownav`, `shownavhide`, `controllnav`, `hoverpause`, `showcaption`) VALUES ('fade', '7000', '600', '1', '1', '1', '1', '1');


-- --------------------------------------------------
# -- Table structure for table `plug_tabs`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_tabs`;
CREATE TABLE `plug_tabs` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(50) NOT NULL DEFAULT '',
  `body_en` text,
  `position` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_tabs`
-- --------------------------------------------------

INSERT INTO `plug_tabs` (`id`, `title_en`, `body_en`, `position`, `active`) VALUES ('1', 'Website Design', '&lt;img width=&quot;305&quot; height=&quot;220&quot; style=&quot;margin-left: 15px; float: right;&quot; alt=&quot;webdesign.png&quot; src=&quot;uploads/images/pages/webdesign.png&quot; /&gt;\n&lt;h2&gt;Website Design&lt;/h2&gt;\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing ultrices.&lt;/p&gt;\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;&lt;br class=&quot;clear&quot; /&gt;\n', '1', '1');
INSERT INTO `plug_tabs` (`id`, `title_en`, `body_en`, `position`, `active`) VALUES ('2', 'Content Management', '&lt;img width=&quot;305&quot; height=&quot;220&quot; style=&quot;margin-left: 15px; float: right;&quot; alt=&quot;cms.png&quot; src=&quot;uploads/images/pages/cms.png&quot; /&gt;\n&lt;h2&gt;Content Management&lt;/h2&gt;\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing ultrices.&lt;/p&gt;\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;&lt;br class=&quot;clear&quot; /&gt;\n', '2', '1');
INSERT INTO `plug_tabs` (`id`, `title_en`, `body_en`, `position`, `active`) VALUES ('3', 'E-Commerce', '&lt;img width=&quot;305&quot; height=&quot;220&quot; src=&quot;uploads/images/pages/ecommerce.png&quot; alt=&quot;ecommerce.png&quot; style=&quot;margin-left: 15px; float: right;&quot; /&gt;\n&lt;h2&gt;E-Commerce&lt;/h2&gt;\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis  facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium  malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing  ultrices.&lt;/p&gt;\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin  dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat  eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra  eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;&lt;br class=&quot;clear&quot; /&gt;\n', '4', '1');
INSERT INTO `plug_tabs` (`id`, `title_en`, `body_en`, `position`, `active`) VALUES ('4', 'Search Engines', '&lt;img width=&quot;305&quot; height=&quot;220&quot; src=&quot;uploads/images/pages/seo.png&quot; alt=&quot;seo.png&quot; style=&quot;margin-left: 15px; float: right;&quot; /&gt;\n&lt;h2&gt;Search Engines&lt;/h2&gt;\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis  facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium  malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing  ultrices.&lt;/p&gt;\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin  dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat  eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra  eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;&lt;br /&gt;\n\n&lt;p&gt;&lt;a href=&quot;#&quot; class=&quot;button shadow&quot;&gt;Read More&lt;/a&gt;&lt;/p&gt;&lt;br class=&quot;clear&quot; /&gt;\n', '3', '1');


-- --------------------------------------------------
# -- Table structure for table `plug_twitter_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_twitter_config`;
CREATE TABLE `plug_twitter_config` (
  `username` varchar(150) DEFAULT NULL,
  `counter` int(1) NOT NULL DEFAULT '5',
  `speed` varchar(6) NOT NULL,
  `show_image` tinyint(1) NOT NULL DEFAULT '1',
  `timeout` varchar(10) NOT NULL,
  `consumer_key` varchar(50) DEFAULT NULL,
  `consumer_secret` varchar(100) DEFAULT NULL,
  `access_token` varchar(100) DEFAULT NULL,
  `access_secret` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_twitter_config`
-- --------------------------------------------------

INSERT INTO `plug_twitter_config` (`username`, `counter`, `speed`, `show_image`, `timeout`, `consumer_key`, `consumer_secret`, `access_token`, `access_secret`) VALUES ('', '5', '300', '1', '10000', '', '', '', '');


-- --------------------------------------------------
# -- Table structure for table `plug_upevent_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_upevent_config`;
CREATE TABLE `plug_upevent_config` (
  `event_id` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_upevent_config`
-- --------------------------------------------------

INSERT INTO `plug_upevent_config` (`event_id`) VALUES ('2');


-- --------------------------------------------------
# -- Table structure for table `plug_videoslider`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plug_videoslider`;
CREATE TABLE `plug_videoslider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(150) NOT NULL DEFAULT '',
  `description_en` varchar(200) DEFAULT NULL,
  `vidurl` varchar(150) DEFAULT NULL,
  `position` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plug_videoslider`
-- --------------------------------------------------

INSERT INTO `plug_videoslider` (`id`, `title_en`, `description_en`, `vidurl`, `position`) VALUES ('1', 'Megamind', 'Megamind hits theaters on November 5th, 2010', 'CzzPbEA6vVU', '1');
INSERT INTO `plug_videoslider` (`id`, `title_en`, `description_en`, `vidurl`, `position`) VALUES ('2', 'Ice Age 4', 'Ice Age: Continental Drift, also known as Ice Age 4', 'hzixp8s4pyg', '2');
INSERT INTO `plug_videoslider` (`id`, `title_en`, `description_en`, `vidurl`, `position`) VALUES ('3', 'Toy Story 3', 'Trailer for upcoming Disney Pixar movie Toy Story 3', 'roADdYWAv4A', '3');
INSERT INTO `plug_videoslider` (`id`, `title_en`, `description_en`, `vidurl`, `position`) VALUES ('4', 'Big Buck Bunny animation', 'An animated short film about a Big Buck Bunny in HD', 'XSGBVzeBUbk', '4');
INSERT INTO `plug_videoslider` (`id`, `title_en`, `description_en`, `vidurl`, `position`) VALUES ('5', 'Married Life - Carl &amp; Ellie', 'This is the best part of the movie UP when Carl met Ellie', 'GroDErHIM_0', '5');
INSERT INTO `plug_videoslider` (`id`, `title_en`, `description_en`, `vidurl`, `position`) VALUES ('6', 'Pixar For the birds', 'A high definition 1080p animation about a big bird.', 'zqmrEa5DLig', '6');


-- --------------------------------------------------
# -- Table structure for table `plugins`
-- --------------------------------------------------
DROP TABLE IF EXISTS `plugins`;
CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(120) NOT NULL,
  `body_en` text,
  `jscode` text,
  `show_title` tinyint(1) NOT NULL DEFAULT '0',
  `alt_class` varchar(100) NOT NULL DEFAULT '',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `info_en` text,
  `plugalias` varchar(50) NOT NULL,
  `hasconfig` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ver` varchar(4) NOT NULL DEFAULT '1.00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `plugins`
-- --------------------------------------------------

INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('2', 'News Slider', '', '', '1', 'light', '1', 'Displays latest news items', 'newsslider', '1', '2010-07-20 14:10:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('6', 'jQuery Slider', '', '', '0', '', '1', 'jQuery Slider is one great way to display portfolio pieces, eCommerce product images, or even as an image gallery.', 'jqueryslider', '1', '2010-07-20 14:10:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('10', 'Latest Twitts', '', '', '1', 'green', '1', 'Shows your latest twitts', 'twitts', '1', '2010-07-22 11:42:08', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('13', 'Ajax Poll', '', '', '1', 'noclass', '1', 'jQuery Ajax poll module.', 'poll', '1', '2010-10-25 14:12:20', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('7', 'jQuery Tabs', '', '', '0', '', '1', 'jQuery Dynamic Tabs', 'jtabs', '1', '2010-12-20 12:12:20', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('12', 'Event Manager', '', '', '1', '', '1', 'Easily publish and manage your company events.', 'events', '0', '2010-12-28 10:12:14', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('14', 'Vertical Navigation', '', '', '1', '', '1', 'Vertical flyout menu module', 'vmenu', '0', '2010-12-27 08:12:14', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('16', 'Rss Parser', '', '', '1', '', '1', 'Show rss feeds (RSS 0.9 / RSS 1.0). Also RSS 2.0, and Atom a with few exceptions.', 'rss', '1', '2011-04-16 08:11:55', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('18', 'User Login', '', '', '1', 'red', '1', 'Shows login form.', 'login', '0', '2011-05-10 02:12:14', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('19', 'Slide Out', '', '', '0', 'hide-phone nowrap', '1', 'Slide out smooth slider', 'slideout', '1', '2011-12-11 07:28:19', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('20', 'Smooth Content Slider', '', '', '0', 'hide-phone nowrap', '1', 'Any type of content slider', 'contentslider', '1', '2011-12-12 14:18:58', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('21', 'Youtube Video Slider', '', '', '0', '', '1', '', 'videoslider', '1', '2011-12-15 18:14:51', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('22', 'Upcoming Event', '', '', '1', 'red', '1', '', 'upevent', '1', '2012-06-27 16:47:10', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('23', 'You&#039;ve Helped Raise…', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit Nam pulvinar. ', '', '1', 'light', '1', '', 'donate', '1', '2012-06-28 00:21:32', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('24', 'Elastic Slider', '', '', '0', 'nowrap', '1', 'Elastic image slideshow', 'elastic', '1', '2013-03-12 00:21:32', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('1', 'Testimonials', '&lt;p class=&quot;testimonial&quot;&gt;&lt;em&gt;Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut dictum, eros eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna sit amet nibh. Suspendisse sed tortor nisi.&lt;/em&gt;&lt;/p&gt;\r\n&lt;em&gt;John Smith&lt;/em&gt;, &lt;strong&gt;www.somesite.com&lt;/strong&gt;', '', '1', 'dark green', '0', '', '', '0', '2010-07-20 14:10:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('8', 'More Pages', '&lt;ul class=&quot;lists&quot;&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Page Types&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Templates&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;About Us&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Services &lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Projects&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Blog&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Contact Us&lt;/a&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', '', '1', '', '0', '', '', '0', '2010-07-22 11:38:51', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('3', 'An unordered list', 'This plugin contains a dummy list of items\n&lt;ul&gt;    \n\t&lt;li&gt;List item 1&lt;/li&gt;    \n\t&lt;li&gt;List item 2&lt;/li&gt;    \n\t&lt;li&gt;List item 3&lt;/li&gt;    \n\t&lt;li&gt;List item 4&lt;/li&gt;\n&lt;/ul&gt;', '', '1', 'dark', '0', '', '', '0', '2010-07-20 14:10:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('4', 'Info Point', '&lt;ul id=&quot;infopoint-list&quot; class=&quot;clearfix&quot;&gt;\r\n\t&lt;li class=&quot;row box&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;uploads/icons/iphone.png&quot; class=&quot;img-left&quot; /&gt; Cum sociis natoque penatibus et magnis dis parturient montes&lt;/li&gt;\r\n\t&lt;li class=&quot;row box whitebox top5&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;uploads/icons/green.png&quot; class=&quot;img-left&quot; /&gt; Curabitur mollis, lectus sit amet bibendum faucibus ligula&lt;/li&gt;\r\n\t&lt;li class=&quot;row box bluebox top5&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;uploads/icons/installer_box.png&quot; class=&quot;img-left&quot; /&gt; Morbi sodales accumsan arcu sed venenatis. Vivamus leo&lt;/li&gt;\r\n\t&lt;li class=&quot;row box greenbox top5&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;uploads/icons/headphone.png&quot; class=&quot;img-left&quot; /&gt; Cras ullamcorper suscipit justo, at mattis odio auctor quis alteno&lt;/li&gt;\r\n\t&lt;li class=&quot;row box redbox top5&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;uploads/icons/coins.png&quot; class=&quot;img-left&quot; /&gt; Vestibulum auctor, magna sit amet pulvinar tristique, nunc felis&lt;/li&gt;\r\n\t&lt;li class=&quot;row box top5&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;uploads/icons/color_wheel.png&quot; class=&quot;img-left&quot; /&gt; Integer aliquet libero sed lorem consequat ut tempus faucibus&lt;/li&gt;\r\n&lt;/ul&gt;', '', '1', '', '0', '', '', '0', '2010-07-20 14:10:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('5', 'Sedes', '&lt;span style=&quot;font-weight: bold;&quot;&gt;Sede Bogotá&lt;/span&gt;&lt;br /&gt;\nDir. Cra 52 # 68-30 Barrio San Fernando&lt;br /&gt;\nTels. +571 8052716 - 8052717&lt;br /&gt;\n&lt;br /&gt;\n&lt;span style=&quot;font-weight: bold;&quot;&gt;Sede Barranquilla&lt;/span&gt;&lt;br /&gt;\nDir. Cra 71 # 74-62&lt;br /&gt;\nTels. +575 3049483&lt;br /&gt;\n&lt;br /&gt;\n&lt;span style=&quot;font-weight: bold;&quot;&gt;Email: callcenter@singsas.com&lt;/span&gt;   ', '', '0', '', '0', '', '', '0', '2010-07-20 14:10:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('11', 'Contact Information', '&lt;ul&gt;\r\n    &lt;li&gt;&lt;b&gt;E-mail:&lt;/b&gt; &lt;a href=&quot;mailto:info@mywebsite.com&quot;&gt;info@mywebsite.com&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;b&gt;Telephone:&lt;/b&gt; 0080 000 000&lt;/li&gt;\r\n    &lt;li&gt;&lt;b&gt;Fax:&lt;/b&gt; 0080 000 000&lt;/li&gt;\r\n    &lt;li&gt;&lt;b&gt;Address:&lt;/b&gt;     1600 Amphitheatre Parkway                 Toronto, ON M2K 1Z7&lt;/li&gt;\r\n&lt;/ul&gt;', '', '1', 'red', '0', '', '', '0', '2010-07-22 11:44:15', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('9', 'Even More Pages', '&lt;ul class=&quot;lists&quot;&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Updates&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;News&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Press Releases&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;New Offers&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Our Staff &lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Policy&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Events&lt;/a&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', '', '1', 'light', '0', '', '', '0', '2010-07-22 11:39:22', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('29', 'Advert Space', '\n&lt;div style=&quot;text-align:center;margin-bottom:10px&quot;&gt;Image banners and adSense suported&lt;/div&gt;', '', '1', '', '1', '', 'adblock/Advert-Wojoscripts', '0', '2013-01-04 18:30:51', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('30', 'Contacto', '\n&lt;div class=&quot;cfg-contactform&quot; id=&quot;cfg-contactform-1&quot;&gt;\n\t&lt;div class=&quot;cfg-contactform-content&quot;&gt;\n\t\t&lt;div class=&quot;row&quot;&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-3-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Correo&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-3-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;input type=&quot;text&quot; class=&quot;cfg-type-text cfg-form-value &quot; name=&quot;cfg-element-1-3&quot; id=&quot;cfg-element-1-3&quot; /&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-6-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Nombre&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-6-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;input type=&quot;text&quot; class=&quot;cfg-type-text cfg-form-value &quot; name=&quot;cfg-element-1-6&quot; id=&quot;cfg-element-1-6&quot; /&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;div class=&quot;row&quot;&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-7-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Contacto&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-7-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;input type=&quot;text&quot; class=&quot;cfg-type-text cfg-form-value &quot; name=&quot;cfg-element-1-7&quot; id=&quot;cfg-element-1-7&quot; /&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-4-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Mensaje&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-4-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;textarea class=&quot;cfg-type-textarea cfg-form-value &quot; name=&quot;cfg-element-1-4&quot; id=&quot;cfg-element-1-4&quot; rows=&quot;3&quot;&gt;&lt;/textarea&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-5-set&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t&lt;input type=&quot;submit&quot; class=&quot;cfg-submit &quot; name=&quot;cfg-element-1-5&quot; id=&quot;cfg-element-1-5&quot; value=&quot;Escribenos&quot; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;div class=&quot;cfg-loading&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;\n\t&lt;!--\n\tcfg-contactform-content\n\t--&gt;\n\t&lt;/div&gt;\n&lt;!--\ncfg-contactform\n--&gt;\n', '', '0', '', '0', '', '', '0', '2013-11-19 22:03:26', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('31', 'menu sp', '\n&lt;div class=&quot;hs-area&quot;&gt;    &lt;img src=&quot;http://signsas.com/uploads/menusp/si_top.png&quot; data-imgdim=&quot;1200,267&quot; /&gt;    \n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;index.php&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;70,58&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_logo.png&quot; width=&quot;224&quot; height=&quot;143&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_logo.png&quot; width=&quot;224&quot; height=&quot;143&quot; /&gt;&lt;/div&gt;&lt;/a&gt;        \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;            \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;    &lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;index.php&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;501,55&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_inicio_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_inicio_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Nosotros&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;627.5,55&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_nosotros_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_nosotros_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Servicios&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;756.5,55&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip white&quot; data-anim=&quot;goin&quot; data-dir=&quot;bottom&quot; data-width=&quot;740&quot; data-pos=&quot;-420&quot;&gt;           &lt;a href=&quot;/content.php?pagename=Servicios&quot;&gt; &lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_mei.png&quot; border=&quot;0&quot; /&gt;            &lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_sm.png&quot; border=&quot;0&quot; /&gt;            &lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_eq.png&quot; border=&quot;0&quot; /&gt;            &lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_mt.png&quot; border=&quot;0&quot; /&gt;            &lt;img src=&quot;http://signsas.com/uploads/menusp/si_servicios_rp.png&quot; border=&quot;0&quot; /&gt;        &lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Clientes&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;886.5,56&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_clientes_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_clientes_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Contacto&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;1020.5,58&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_contacto_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_contacto_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;http://proyecto.signsas.com&quot; target=&quot;_blank&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;968,206&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/so.png&quot; width=&quot;158&quot; height=&quot;50&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/so.png&quot; width=&quot;158&quot; height=&quot;50&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;index.php&quot;&gt;\n\t\t\t&lt;div class=&quot;red-spot&quot; data-coord=&quot;998,21&quot; data-dim=&quot;59,18,0&quot; data-activeon=&quot;hover&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=home&quot;&gt;\n\t\t\t&lt;div class=&quot;red-spot&quot; data-coord=&quot;1074,21&quot; data-dim=&quot;50,18,0&quot; data-activeon=&quot;hover&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', ' &lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;jquery-hotspotter-1.8.0.min.css&quot; /&gt;\n        &lt;!--[if lt IE 9]&gt;&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;ie7-8.min.css&quot; /&gt;&lt;![endif]--&gt;\n         \n        &lt;script type=&quot;text/javascript&quot; src=&quot;jquery-hotspotter-1.8.0.min.js&quot;&gt;&lt;/script&gt;\n \n        &lt;script type=&quot;text/javascript&quot;&gt;\n        jQuery(document).ready(function($) {\n            //Run plugin when DOM is ready\n            $(&#039;.hs-area&#039;).hotspotter();\n        });\n        &lt;/script&gt;\n&lt;style type=&quot;text/css&quot;&gt;\nimg.displayed {\n\tdisplay: block;\n\tmargin-left: auto;\n\tmargin-right: auto }\n&lt;/style&gt;', '0', '', '0', '', '', '0', '2013-11-19 22:34:19', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('32', 'Slider - home', '', '', '0', '', '1', '', 'slidecms/home', '0', '2013-11-19 22:46:07', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('33', 'vacio pie', '&lt;br /&gt;\n\n&lt;table style=&quot;border-collapse:collapse;width:120px;&quot;&gt;\n\t&lt;tbody&gt;\n\t\t&lt;tr&gt;\n\t\t\t&lt;td&gt;&amp;nbsp;&lt;/td&gt;\n\t\t&lt;/tr&gt;\n\t&lt;/tbody&gt;\n&lt;/table&gt;&lt;br /&gt;\n', '', '0', '', '0', '', '', '0', '2013-11-20 00:23:45', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('34', 'Slider - servicios', '', '', '0', '', '1', '', 'slidecms/servicios', '0', '2013-11-20 09:42:53', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('35', 'head servicios', '&lt;img src=&quot;uploads/servicios/servicios-02.png&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;&quot; /&gt;', '', '0', '', '0', '', '', '0', '2013-11-20 09:49:38', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('39', 'top servicios', '\n&lt;div style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;uploads/servicios/servicios-top.jpg&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;margin-right: auto; margin-left: auto;&quot; /&gt;&lt;/div&gt;', '', '0', '', '0', '', '', '0', '2013-11-25 22:39:02', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('40', 'inicio top', '\n&lt;div style=&quot;text-align: center;&quot;&gt;&lt;a href=&quot;/content.php?pagename=Nosotros&quot; title=&quot;&quot;&gt;&lt;img src=&quot;uploads/inicio/bienvenidos.jpg&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;border: none; float: none; margin: 0px;&quot; /&gt;&lt;/a&gt;&lt;/div&gt; ', '', '0', '', '0', '', '', '0', '2013-11-26 10:07:12', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('41', 'menu en', '\n&lt;div class=&quot;hs-area&quot;&gt;    &lt;img src=&quot;http://signsas.com/uploads/menuen/sien_top.png&quot; data-imgdim=&quot;1200,267&quot; /&gt;    \n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Home&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;70,58&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_logo.png&quot; width=&quot;224&quot; height=&quot;143&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/si_logo.png&quot; width=&quot;224&quot; height=&quot;143&quot; /&gt;&lt;/div&gt;&lt;/a&gt;        \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;            \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;    &lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Home&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;501,55&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_home_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_home_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Who-are-we&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;627.5,55&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_aboutus_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_aboutus_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Services&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;756.5,55&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_services_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_services_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip white&quot; data-anim=&quot;goin&quot; data-dir=&quot;bottom&quot; data-width=&quot;740&quot; data-pos=&quot;-420&quot;&gt;&lt;a href=&quot;/content.php?pagename=Services&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_services_mei.png&quot; border=&quot;0&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_services_sp.png&quot; border=&quot;0&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_services_eq.png&quot; border=&quot;0&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_services_eass.png&quot; border=&quot;0&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_repairs.png&quot; border=&quot;0&quot; /&gt;        &lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Our-clients&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;886.5,56&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_customers_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_customers_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=Contact-us&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;1020.5,58&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_contactus_off.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menuen/si_contactus_on.png&quot; width=&quot;105&quot; height=&quot;115&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;http://proyecto.signsas.com&quot; target=&quot;_blank&quot;&gt;\n\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;968,206&quot; data-activeon=&quot;hover&quot;&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/so.png&quot; width=&quot;158&quot; height=&quot;50&quot; /&gt;&lt;img src=&quot;http://signsas.com/uploads/menusp/so.png&quot; width=&quot;158&quot; height=&quot;50&quot; /&gt;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;index.php&quot;&gt;\n\t\t\t&lt;div class=&quot;red-spot&quot; data-coord=&quot;998,21&quot; data-dim=&quot;59,18,0&quot; data-activeon=&quot;hover&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t&lt;div class=&quot;hs-wrap&quot;&gt;&lt;a href=&quot;content.php?pagename=home&quot;&gt;\n\t\t\t&lt;div class=&quot;red-spot&quot; data-coord=&quot;1074,21&quot; data-dim=&quot;50,18,0&quot; data-activeon=&quot;hover&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/a&gt;    \n\t\t&lt;div class=&quot;tt-wrap&quot;&gt;        \n\t\t\t&lt;div class=&quot;tip-tooltip&quot; data-anim=&quot;goin&quot; data-dir=&quot;top&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', ' &lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;jquery-hotspotter-1.8.0.min.css&quot; /&gt;\n        &lt;!--[if lt IE 9]&gt;&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;ie7-8.min.css&quot; /&gt;&lt;![endif]--&gt;\n         \n        &lt;script type=&quot;text/javascript&quot; src=&quot;jquery-hotspotter-1.8.0.min.js&quot;&gt;&lt;/script&gt;\n \n        &lt;script type=&quot;text/javascript&quot;&gt;\n        jQuery(document).ready(function($) {\n            //Run plugin when DOM is ready\n            $(&#039;.hs-area&#039;).hotspotter();\n        });\n        &lt;/script&gt;\n&lt;style type=&quot;text/css&quot;&gt;\nimg.displayed {\n\tdisplay: block;\n\tmargin-left: auto;\n\tmargin-right: auto }\n&lt;/style&gt;', '0', '', '0', '', '', '0', '2013-11-27 22:52:03', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('38', 'pie de pagina esp', '\n&lt;div class=&quot;container&quot;&gt;  \n\t&lt;!--\n\tCopyrights\n\t--&gt;\n\t    \n\t&lt;div class=&quot;row&quot;&gt;\n\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t&lt;div class=&quot;copyright&quot;&gt;                           \n\t\t\t\t&lt;div class=&quot;copyright top10&quot;&gt;Copyright &amp;copy; SIGN Servicios de Ingenieria Todos los derechos reservados.&lt;/div&gt;                &lt;/div&gt;&lt;/div&gt;      \n\t\t&lt;!--\n\t\tMenu\n\t\t--&gt;\n\t\t\n\t\t&lt;div class=&quot;col grid_12 top10&quot;&gt;\n\t\t\t&lt;nav id=&quot;sub-menu&quot;&gt;\n\t\t\t\t&lt;ul&gt;    \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Nosotros&quot;&gt;NOSOTROS&lt;/a&gt;&lt;/li&gt;                    \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Servicios&quot;&gt;SERVICIOS&lt;/a&gt;&lt;/li&gt;                    \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Clientes&quot;&gt;CLIENTES&lt;/a&gt;&lt;/li&gt;                    \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Contacto&quot;&gt;CONTACTO&lt;/a&gt;&lt;/li&gt;    \n\t\t\t\t&lt;/ul&gt;&lt;/nav&gt;&lt;/div&gt;   \n  &lt;/div&gt;  &lt;/div&gt;', '', '0', '', '0', '', '', '0', '2013-11-20 17:46:13', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('42', 'pie de pag ingles', '\n&lt;div class=&quot;container&quot;&gt;  \n\t&lt;!--\n\tCopyrights\n\t--&gt;\n\t    \n\t&lt;div class=&quot;row&quot;&gt;\n\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t&lt;div class=&quot;copyright&quot;&gt;                           \n\t\t\t\t&lt;div class=&quot;copyright top10&quot;&gt;Copyright &amp;copy; SIGN Servicios de Ingenieria All rights reserved.&lt;/div&gt;                &lt;/div&gt;&lt;/div&gt;      \n\t\t&lt;!--\n\t\tMenu\n\t\t--&gt;\n\t\t\n\t\t&lt;div class=&quot;col grid_12 top10&quot;&gt;\n\t\t\t&lt;nav id=&quot;sub-menu&quot;&gt;\n\t\t\t\t&lt;ul&gt;    \n                  \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Who-are-we&quot;&gt;WHO ARE WE?&lt;/a&gt;&lt;/li&gt;                    \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Services&quot;&gt;SERVICES&lt;/a&gt;&lt;/li&gt;                    \n                  \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Our-clients&quot;&gt;OUR CLIENTS&lt;/a&gt;&lt;/li&gt;                    \n                  \n\t\t\t\t\t&lt;li&gt;&lt;a href=&quot;content.php?pagename=Contact-us&quot;&gt;CONTACT US&lt;/a&gt;&lt;/li&gt;    \n\t\t\t\t&lt;/ul&gt;&lt;/nav&gt;&lt;/div&gt;   \n  &lt;/div&gt;  &lt;/div&gt; ', '', '0', '', '0', '', '', '0', '2013-11-27 22:57:57', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('43', 'Contact', '\n&lt;div class=&quot;cfg-contactform&quot; id=&quot;cfg-contactform-1&quot;&gt;\n\t&lt;div class=&quot;cfg-contactform-content&quot;&gt;\n\t\t&lt;div class=&quot;row&quot;&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-3-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Email&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-3-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;input type=&quot;text&quot; class=&quot;cfg-type-text cfg-form-value &quot; name=&quot;cfg-element-1-3&quot; id=&quot;cfg-element-1-3&quot; /&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-6-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Name&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-6-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;input type=&quot;text&quot; class=&quot;cfg-type-text cfg-form-value &quot; name=&quot;cfg-element-1-6&quot; id=&quot;cfg-element-1-6&quot; /&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;div class=&quot;row&quot;&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-7-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Contact&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-7-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;input type=&quot;text&quot; class=&quot;cfg-type-text cfg-form-value &quot; name=&quot;cfg-element-1-7&quot; id=&quot;cfg-element-1-7&quot; /&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div class=&quot;col grid_12&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t\t\t&lt;label class=&quot;cfg-label&quot; id=&quot;cfg-element-1-4-label&quot;&gt;&lt;span class=&quot;cfg-label-value&quot;&gt;Message&lt;/span&gt;&lt;span class=&quot;cfg-required&quot;&gt;*&lt;/span&gt;&lt;/label&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-4-set&quot;&gt;\n\t\t\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t\t\t&lt;textarea class=&quot;cfg-type-textarea cfg-form-value &quot; name=&quot;cfg-element-1-4&quot; id=&quot;cfg-element-1-4&quot; rows=&quot;3&quot;&gt;&lt;/textarea&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t\t\t&lt;div class=&quot;cfg-clear&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;div class=&quot;cfg-element-container&quot;&gt;\n\t\t\t&lt;div class=&quot;cfg-element-set&quot; id=&quot;cfg-element-1-5-set&quot;&gt;\n\t\t\t\t&lt;div class=&quot;cfg-element-content&quot;&gt;\n\t\t\t\t\t&lt;input type=&quot;submit&quot; class=&quot;cfg-submit &quot; name=&quot;cfg-element-1-5&quot; id=&quot;cfg-element-1-5&quot; value=&quot;Send&quot; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;div class=&quot;cfg-loading&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;\n\t&lt;!--\n\tcfg-contactform-content\n\t--&gt;\n\t&lt;/div&gt;\n&lt;!--\ncfg-contactform\n--&gt;\n', '', '0', '', '0', '', '', '0', '2013-11-27 23:00:39', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('44', 'stores', '&lt;span style=&quot;font-weight: bold;&quot;&gt;Store Bogotá&lt;/span&gt;&lt;br /&gt;\nAddress. Cra 52 # 68-30 Barrio San Fernando&lt;br /&gt;\nPhone. +571 8052716 - 8052717&lt;br /&gt;\n&lt;br /&gt;\n&lt;span style=&quot;font-weight: bold;&quot;&gt;Store Barranquilla&lt;/span&gt;&lt;br /&gt;\nAddress. Cra 71 # 74-62&lt;br /&gt;\nPhone. +575 3049483&lt;br /&gt;\n&lt;br /&gt;\n&lt;span style=&quot;font-weight: bold;&quot;&gt;Email: callcenter@singsas.com&lt;/span&gt;', '', '0', '', '0', '', '', '0', '2013-11-27 23:12:14', '1.00', '1');
INSERT INTO `plugins` (`id`, `title_en`, `body_en`, `jscode`, `show_title`, `alt_class`, `system`, `info_en`, `plugalias`, `hasconfig`, `created`, `ver`, `active`) VALUES ('45', 'home top', '\n&lt;div style=&quot;text-align: center;&quot;&gt;&lt;a href=&quot;/content.php?pagename=Home&quot;&gt;&lt;img src=&quot;uploads/home/welcome.png&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;border: none;&quot; /&gt;&lt;/a&gt;&lt;/div&gt;', '', '0', '', '0', '', '', '0', '2013-11-27 23:42:17', '1.00', '1');


-- --------------------------------------------------
# -- Table structure for table `posts`
-- --------------------------------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `page_slug` varchar(50) NOT NULL,
  `title_en` varchar(200) NOT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `body_en` text NOT NULL,
  `jscode` text,
  `position` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `posts`
-- --------------------------------------------------

INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('22', '18', 'Contacto', 'Contacto', '0', '&lt;img src=&quot;uploads/contacto-18.jpg&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;margin-left: auto; margin-right: auto;&quot; /&gt;', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('23', '19', 'Proyectos', 'Proyectos', '0', '\n', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('24', '21', 'Home', 'Home', '0', '\n', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('25', '20', 'Who-are-we', 'Who are we?', '0', '\n', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('26', '22', 'Services', 'Services', '0', '\n', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('27', '23', 'Our-clients', 'Our Clients', '0', '\n', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('28', '24', 'Contact-us', 'Contact us', '0', '\n', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('18', '1', 'Inicio', 'inicio', '0', '\n&lt;table width=&quot;91.4%&quot; style=&quot;margin-left:auto; margin-right:auto;&quot;&gt;  \n\t&lt;tbody&gt;\n\t\t&lt;tr&gt;    \n\t\t\t&lt;td width=&quot;33%&quot; align=&quot;center&quot;&gt;&lt;a href=&quot;/content.php?pagename=Servicios&quot;&gt;&lt;img src=&quot;uploads/inicio/equipos.png&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;&lt;/td&gt;  \n\t\t\t&lt;td width=&quot;33%&quot; align=&quot;center&quot;&gt;&lt;a href=&quot;/content.php?pagename=Servicios&quot;&gt;&lt;img src=&quot;uploads/inicio/suministros.png&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;&lt;/td&gt;  \n\t\t\t&lt;td width=&quot;33%&quot; align=&quot;center&quot;&gt;&lt;a href=&quot;/content.php?pagename=Servicios&quot;&gt;&lt;img src=&quot;uploads/inicio/reparaciones.png&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;&lt;/td&gt;\n\t\t&lt;/tr&gt;  \n\t\t&lt;tr&gt;    \n          \n\t\t\t&lt;td colspan=&quot;3&quot; align=&quot;center&quot;&gt;\n\t\t\t\t&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;a href=&quot;/content.php?pagename=Proyectos&quot;&gt;&lt;img src=&quot;uploads/inicio/galeriadeproyectos.png&quot; alt=&quot;&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;          &lt;/td&gt;\n\t\t&lt;/tr&gt;\n\t&lt;/tbody&gt;\n&lt;/table&gt;', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('19', '15', 'Nosotros', 'Nosotros', '0', '\n&lt;div class=&quot;row&quot;&gt;  \n\t&lt;div class=&quot;col grid_2&quot;&gt;&amp;nbsp;&lt;/div&gt;  \n\t&lt;div class=&quot;col grid_21&quot;&gt;\n\t\t&lt;div class=&quot;hs-area&quot;&gt;    &lt;img src=&quot;uploads/nosotros/nosotros_bg.png&quot; data-imgdim=&quot;335,320&quot; /&gt;    \n\t\t\t&lt;div class=&quot;hs-wrap&quot;&gt;        \n\t\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;-4,0&quot; data-handler=&quot;Aim&quot; data-activeon=&quot;click&quot; data-name=&quot;qs&quot;&gt;            &lt;img src=&quot;uploads/nosotros/qs_on.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;            &lt;img src=&quot;uploads/nosotros/qs_off.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;        &lt;/div&gt;        \n\t\t\t\t&lt;div class=&quot;tt-wrap&quot;&gt;            \n\t\t\t\t\t&lt;div class=&quot;aim-tooltip&quot; data-dir=&quot;right&quot; data-width=&quot;720&quot;&gt;                \n\t\t\t\t\t\t&lt;div class=&quot;tt-content&quot;&gt;                    \n\t\t\t\t\t\t\t&lt;table border=&quot;0&quot; width=&quot;720px&quot; height=&quot;320px&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;                        \n\t\t\t\t\t\t\t\t&lt;tbody&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;tr&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;60px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                                \n                              \n\t\t\t\t\t\t\t\t\t\t&lt;td&gt;&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t                                  \n\t\t\t\t\t\t\t\t\t\t\t&lt;h4&gt;SIGN SAS es un proveedor experimentado y competente  en la prestación de los servicios de operación y mantenimiento de estaciones base de telecomunicaciones&lt;/h4&gt;&lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;40px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;/tr&gt;                        \n\t\t\t\t\t\t\t\t&lt;/tbody&gt;                    \n\t\t\t\t\t\t\t&lt;/table&gt;                &lt;/div&gt;            &lt;/div&gt;        &lt;/div&gt;    &lt;/div&gt;&lt;/div&gt;    \n  \n  \n  \n  \n  &lt;/div&gt;&lt;/div&gt;    &lt;br /&gt;\n&lt;br /&gt;\n\n&lt;div class=&quot;row&quot;&gt;  \n\t&lt;div class=&quot;col grid_2&quot;&gt;&amp;nbsp;&lt;/div&gt;  \n\t&lt;div class=&quot;col grid_21&quot;&gt;\n\t\t&lt;div class=&quot;hs-area&quot;&gt;    &lt;img src=&quot;uploads/nosotros/nosotros_bg.png&quot; data-imgdim=&quot;335,320&quot; /&gt;    \n\t\t\t&lt;div class=&quot;hs-wrap&quot;&gt;        \n\t\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;0,0&quot; data-handler=&quot;Aim&quot; data-activeon=&quot;click&quot; data-name=&quot;qs&quot;&gt;            &lt;img src=&quot;uploads/nosotros/mision_on.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;            &lt;img src=&quot;uploads/nosotros/mision_off.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;        &lt;/div&gt;        \n\t\t\t\t&lt;div class=&quot;tt-wrap&quot;&gt;            \n\t\t\t\t\t&lt;div class=&quot;aim-tooltip&quot; data-dir=&quot;right&quot; data-width=&quot;720&quot;&gt;                \n\t\t\t\t\t\t&lt;div class=&quot;tt-content&quot;&gt;                    \n\t\t\t\t\t\t\t&lt;table border=&quot;0&quot; width=&quot;720px&quot; height=&quot;320px&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;                        \n\t\t\t\t\t\t\t\t&lt;tbody&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;tr&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;60px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td&gt;&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t\t\t&lt;h4&gt;Ser líder en la prestación de  servicios de ingeniería, suministro, instalación mantenimiento de grupos electrógenos y Aires Acondicionados, así como la ejecución y sostenimiento de obras civiles de todo tipo; contando con un equipo humano comprometido en brindar un servicio, profesional, confiable y eficiente.&lt;/h4&gt;&lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;40px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;/tr&gt;                        \n\t\t\t\t\t\t\t\t&lt;/tbody&gt;                    \n\t\t\t\t\t\t\t&lt;/table&gt;                &lt;/div&gt;            &lt;/div&gt;        &lt;/div&gt;    &lt;/div&gt;  &lt;/div&gt;      \n      \n      \n     &lt;/div&gt;&lt;/div&gt; &lt;br /&gt;\n&lt;br /&gt;\n\n&lt;div class=&quot;row&quot;&gt;  \n\t&lt;div class=&quot;col grid_2&quot;&gt;&amp;nbsp;&lt;/div&gt;  \n\t&lt;div class=&quot;col grid_21&quot;&gt;\n\t\t&lt;div class=&quot;hs-area&quot;&gt;    &lt;img src=&quot;uploads/nosotros/nosotros_bg.png&quot; data-imgdim=&quot;335,320&quot; /&gt;    \n\t\t\t&lt;div class=&quot;hs-wrap&quot;&gt;        \n\t\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;0,0&quot; data-handler=&quot;Aim&quot; data-activeon=&quot;click&quot; data-name=&quot;qs&quot;&gt;            &lt;img src=&quot;uploads/nosotros/vision_on.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;            &lt;img src=&quot;uploads/nosotros/vision_off.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;        &lt;/div&gt;        \n\t\t\t\t&lt;div class=&quot;tt-wrap&quot;&gt;            \n\t\t\t\t\t&lt;div class=&quot;aim-tooltip&quot; data-dir=&quot;right&quot; data-width=&quot;720&quot;&gt;                \n\t\t\t\t\t\t&lt;div class=&quot;tt-content&quot;&gt;                    \n\t\t\t\t\t\t\t&lt;table border=&quot;0&quot; width=&quot;720px&quot; height=&quot;320px&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;                        \n\t\t\t\t\t\t\t\t&lt;tbody&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;tr&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;60px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td&gt;&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t\t\t&lt;h4&gt;Dentro de los próximos 5 años ocupar una posición de solides en el mercado, generada del buen servicio y cumplimiento de sus proyectos ejecutados de tal forma de quien piense en servicios de ingeniería piense en SING SAS como su mejor opción. &lt;/h4&gt;                                  &lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t\t\t&lt;h4&gt;Presencia en Colombia: (  con esto quiero que el mapa quede grande y la ubicación en cada departamento el logo de Sign y a un lado el nombre del departamento.&lt;/h4&gt;&lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;40px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;/tr&gt;                        \n\t\t\t\t\t\t\t\t&lt;/tbody&gt;                    \n\t\t\t\t\t\t\t&lt;/table&gt;                &lt;/div&gt;            &lt;/div&gt;        &lt;/div&gt;    &lt;/div&gt;  &lt;/div&gt;      \n       &lt;/div&gt;&lt;/div&gt;      &lt;br /&gt;\n&lt;br /&gt;\n\n&lt;div class=&quot;row&quot;&gt;  \n\t&lt;div class=&quot;col grid_2&quot;&gt;&amp;nbsp;&lt;/div&gt;  \n\t&lt;div class=&quot;col grid_21&quot;&gt;\n\t\t&lt;div class=&quot;hs-area&quot;&gt;    &lt;img src=&quot;uploads/nosotros/nosotros_bg.png&quot; data-imgdim=&quot;335,320&quot; /&gt;    \n\t\t\t&lt;div class=&quot;hs-wrap&quot;&gt;        \n\t\t\t\t&lt;div class=&quot;img-spot&quot; data-coord=&quot;0,0&quot; data-handler=&quot;Aim&quot; data-activeon=&quot;click&quot; data-name=&quot;qs&quot;&gt;            &lt;img src=&quot;uploads/nosotros/mapa_on.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;            &lt;img src=&quot;uploads/nosotros/mapa_off.png&quot; width=&quot;335&quot; height=&quot;320&quot; /&gt;        &lt;/div&gt;        \n\t\t\t\t&lt;div class=&quot;tt-wrap&quot;&gt;            \n\t\t\t\t\t&lt;div class=&quot;aim-tooltip&quot; data-dir=&quot;right&quot; data-width=&quot;720&quot;&gt;                \n\t\t\t\t\t\t&lt;div class=&quot;tt-content&quot;&gt;                    \n\t\t\t\t\t\t\t&lt;table border=&quot;0&quot; width=&quot;720px&quot; height=&quot;320px&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;                        \n\t\t\t\t\t\t\t\t&lt;tbody&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;tr&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;60px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td&gt;\n\t\t\t\t\t\t\t\t\t\t\t&lt;h3&gt;&lt;/h3&gt;                              \n\t\t\t\t\t\t\t\t\t\t\t&lt;div align=&quot;center&quot;&gt;\n\t\t\t\t\t\t\t\t\t\t\t\t&lt;iframe src=&quot;http://signsas.com/map/html/examples/map/autocomplete-with-radius.html&quot; scrolling=&quot;no&quot; frameborder=&quot;0&quot; style=&quot;border:none; overflow:hidden; width:700px; height:320px;&quot; allowtransparency=&quot;true&quot;&gt;&lt;/iframe&gt;&lt;/div&gt;                              \n                              &lt;/td&gt;                                \n\t\t\t\t\t\t\t\t\t\t&lt;td width=&quot;40px&quot; nowrap=&quot;nowrap&quot;&gt;&lt;/td&gt;                            \n\t\t\t\t\t\t\t\t\t&lt;/tr&gt;                        \n\t\t\t\t\t\t\t\t&lt;/tbody&gt;                    \n\t\t\t\t\t\t\t&lt;/table&gt;                &lt;/div&gt;            &lt;/div&gt;        &lt;/div&gt;    &lt;/div&gt;  &lt;/div&gt;      \n      \n      &lt;/div&gt;&lt;/div&gt;', '', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('20', '16', 'Servicios', 'Servicios', '0', '\n&lt;div id=&quot;mainform&quot;&gt;\n\t&lt;!--\n\tSTART TABION\n\t--&gt;\n\t\n\t&lt;div class=&quot;tabionjs verticaltab&quot; id=&quot;tabionjs&quot;&gt;\n\t\t&lt;!--\n\t\tStart Responsive Button\n\t\t--&gt;\n\t\t\n\t\t&lt;div class=&quot;responsive-tab&quot;&gt;&lt;span class=&quot;resbutton light-text&quot;&gt;&lt;i class=&quot;icon-reorder&quot;&gt;&lt;/i&gt;&lt;/span&gt;&lt;/div&gt;\n\t\t&lt;!--\n\t\tEnd Responsive Button\n\t\t--&gt;\n\t\t\n\t\t&lt;!--\n\t\tStart Tab Button Holder\n\t\t--&gt;\n\t\t\n\t\t&lt;div class=&quot;button-holder tab-leftside tab-smallbar metrostyle-1 light-text&quot;&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-1&quot; class=&quot;tabbt button-smalltile solid-yellow tab-active&quot;&gt;&lt;span class=&quot;button-title&quot;&gt;INSTALACIÓN Y MANTENIMIENTO&lt;/span&gt;&lt;span class=&quot;button-icon&quot;&gt;&lt;img src=&quot;images/fantasma.png&quot; /&gt;&lt;/span&gt;&lt;/div&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-2&quot; class=&quot;tabbt button-smalltile solid-yellow &quot;&gt;&lt;span class=&quot;button-title&quot;&gt;SUMINISTROS&lt;/span&gt;&lt;span class=&quot;button-icon&quot;&gt;&lt;img src=&quot;images/fantasma.png&quot; /&gt;&lt;/span&gt;&lt;/div&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-3&quot; class=&quot;tabbt button-smalltile solid-yellow &quot;&gt;&lt;span class=&quot;button-title&quot;&gt;EQUIPOS&lt;/span&gt;&lt;span class=&quot;button-icon&quot;&gt;&lt;img src=&quot;images/fantasma.png&quot; /&gt;&lt;/span&gt;&lt;/div&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-4&quot; class=&quot;tabbt button-smalltile solid-yellow &quot;&gt;&lt;span class=&quot;button-title&quot;&gt;MONTAJES&lt;/span&gt;&lt;span class=&quot;button-icon&quot;&gt;&lt;img src=&quot;images/fantasma.png&quot; /&gt;&lt;/span&gt;&lt;/div&gt;      \n\t\t\t&lt;div data-tabid=&quot;tab-5&quot; class=&quot;tabbt button-smalltile solid-yellow &quot;&gt;&lt;span class=&quot;button-title&quot;&gt;REPARACIONES&lt;/span&gt;&lt;span class=&quot;button-icon&quot;&gt;&lt;img src=&quot;images/fantasma.png&quot; /&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t&lt;!--\n\t\tEnd Tab Button Holder\n\t\t--&gt;\n\t\t\n\t\t&lt;!--\n\t\tStart Tab Content Holder\n\t\t--&gt;\n\t\t\n\t\t&lt;div class=&quot;content-holder tab-leftside width-680&quot;&gt;  \n\t\t\t&lt;div data-tabid=&quot;tab-1&quot; data-animin=&quot;flipInX&quot; class=&quot;tabcontent solid-yellow2 dark-text shadow-black&quot;&gt;\n\t\t\t\t&lt;h3 class=&quot;title&quot;&gt;INSTALACIÓN Y MANTENIMIENTO&lt;/h3&gt;&lt;hr size=&quot;2&quot; width=&quot;90%&quot; color=&quot;red&quot; /&gt;\n\t\t\t\t&lt;br /&gt;\n\t\t\t\t\n\t\t\t\t&lt;ul class=&quot;sign-list&quot;&gt;\n\t\t\t\t\t&lt;li&gt;Aires acondicionados&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Planta el&amp;eacute;ctrica&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Rectificadores&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Tableros El&amp;eacute;ctricos &lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;UPS, rectificadores, plantas de emergencia, baterías, inversores, subestaciones y sistema el&amp;eacute;ctrico en general.&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Redes de media y baja tensión.&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Sistemas internos y externos de iluminación.&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Acometidas el&amp;eacute;ctricas, Redes el&amp;eacute;ctricas internas y externa&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Sistemas Puesta a Tierra&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Torres&lt;/li&gt;\n\t\t\t\t\t&lt;li&gt;Locativos&lt;/li&gt;\n\t\t\t\t&lt;/ul&gt;              \n              &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI1.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI2.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;  &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI3.jpg&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI4.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI5.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;  &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI46.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut]&quot; href=&quot;uploads/servicios/galeria-iym/MI7.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-myi/MI8.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;  &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI9.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI9.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt; &lt;a rel=&quot;imagebox[aut1]&quot; href=&quot;uploads/servicios/galeria-iym/MI10.jpg&quot; id=&quot;Instalacion y Mantenimiento&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;\n\t\t\t\t&lt;div&gt;\n\t\t\t\t\t&lt;p align=&quot;right&quot;&gt;&lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Instalacion y Mantenimiento&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Galeria&lt;/a&gt;&lt;/p&gt;\n\t\t\t\t\t&lt;div class=&quot;clearspace&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-2&quot; data-animin=&quot;flipInX&quot; class=&quot;tabcontent solid-yellow2 dark-text shadow-black&quot;&gt;\n\t\t\t\t&lt;h3 class=&quot;title&quot;&gt;SUMINISTROS&lt;/h3&gt;&lt;hr size=&quot;2&quot; width=&quot;90%&quot; color=&quot;red&quot; /&gt;\n\t\t\t\t&lt;br /&gt;\n\t\t\t\t\n\t\t\t\t&lt;p align=&quot;justify&quot;&gt;PROYECTO ERICSSON Servicios de suministro y distribución de combustible biodiesel en estaciones base de telecomunicaciones, así mismo como el servicio de reparaciones mayores y locativas en infraestructura de telecomunicaciones&lt;/p&gt;&lt;a rel=&quot;imagebox[aut]&quot; href=&quot;uploads/servicios/galeria-sm/ACPM1.jpg&quot; id=&quot;Suministros&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut]&quot; href=&quot;uploads/servicios/galeria-sm/ACPM2.jpg&quot; id=&quot;Suministros&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut]&quot; href=&quot;uploads/servicios/galeria-sm/ACPM3.jpg&quot; id=&quot;Suministros&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut]&quot; href=&quot;uploads/servicios/galeria-sm/ACPM4.jpg&quot; id=&quot;Suministros&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut]&quot; href=&quot;uploads/servicios/galeria-sm/ACPM5.jpg&quot; id=&quot;Suministros&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;\n\t\t\t\t&lt;div&gt;\n\t\t\t\t\t&lt;p align=&quot;right&quot;&gt;&lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Suministros&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Galeria&lt;/a&gt;&lt;/p&gt;\n\t\t\t\t\t&lt;div class=&quot;clearspace&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-3&quot; data-animin=&quot;flipInX&quot; class=&quot;tabcontent solid-yellow2 dark-text shadow-black&quot;&gt;\n\t\t\t\t&lt;h3 class=&quot;title&quot;&gt;EQUIPOS&lt;/h3&gt; &lt;hr size=&quot;2&quot; width=&quot;90%&quot; color=&quot;red&quot; /&gt;\n\t\t\t\t&lt;br /&gt;\n\t\t\t\t             \n\t\t\t\t&lt;ul class=&quot;sign-list&quot;&gt;                \n\t\t\t\t\t&lt;li&gt;Instalación de Baterías&lt;/li&gt;                 \n\t\t\t\t\t&lt;li&gt;Suministro e instalación de:&lt;/li&gt;                 \n\t\t\t\t\t&lt;li&gt;Aire acondicionado&lt;/li&gt;              \n\t\t\t\t&lt;/ul&gt;\n\t\t\t\t&lt;p&gt;&lt;img src=&quot;uploads/servicios/grafica.png&quot; alt=&quot;&quot; border=&quot;0&quot; style=&quot;margin: 0px; float: none;&quot; /&gt;&lt;/p&gt;              &lt;a rel=&quot;imagebox[aut2]&quot; href=&quot;uploads/servicios/galeria-ei/ei1.jpg&quot; id=&quot;Equipos de Infraestructura&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut2]&quot; href=&quot;uploads/servicios/galeria-ei/ei2.jpg&quot; id=&quot;Equipos de Infraestructura&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut2]&quot; href=&quot;uploads/servicios/galeria-ei/ei3.jpg&quot; id=&quot;Equipos de Infraestructura&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut2]&quot; href=&quot;uploads/servicios/galeria-ei/ei4.jpg&quot; id=&quot;Equipos de Infraestructura&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut2]&quot; href=&quot;uploads/servicios/galeria-ei/ei5.jpg&quot; id=&quot;Equipos de Infraestructura&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut2]&quot; href=&quot;uploads/servicios/galeria-ei/ei6.jpg&quot; id=&quot;Equipos de Infraestructura&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;          \n              \n              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc1.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc2.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc3.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc4.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc5.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc6.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc7.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc8.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;             \n              &lt;a rel=&quot;imagebox[aut3]&quot; href=&quot;uploads/servicios/galeria-eoc/eoc9.jpg&quot; id=&quot;Equipos de Obra Civil&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;\n\t\t\t\t&lt;div&gt;\n\t\t\t\t\t&lt;p align=&quot;right&quot;&gt;&lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Equipos de Infraestructura&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Galeria Infraestructura&lt;/a&gt;  \n             &amp;nbsp;&amp;nbsp;  &lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Equipos de Obra Civil&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Galeria Obra Civil&lt;/a&gt;   &lt;/p&gt;\n\t\t\t\t\t&lt;div class=&quot;clearspace&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\n\t\t\t&lt;div data-tabid=&quot;tab-4&quot; data-animin=&quot;flipInX&quot; class=&quot;tabcontent solid-yellow2 dark-text shadow-black&quot;&gt;\n\t\t\t\t&lt;h3 class=&quot;title&quot;&gt;MONTAJES&lt;/h3&gt;&lt;hr size=&quot;2&quot; width=&quot;90%&quot; color=&quot;red&quot; /&gt;\n\t\t\t\t&lt;br /&gt;\n\t\t\t\t\n\t\t\t\t&lt;p&gt;Montajes en líneas de media tensión:&lt;/p&gt;              \n\t\t\t\t&lt;ul class=&quot;sign-list&quot;&gt;                \n\t\t\t\t\t&lt;li&gt;Cambio de pararrayo.&lt;/li&gt;                  \n\t\t\t\t\t&lt;li&gt;Transformadores.&lt;/li&gt;\n\t\t\t\t&lt;/ul&gt;              \n              \n\t\t\t\t&lt;p align=&quot;right&quot;&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;GALERIAS&lt;/span&gt;&lt;/p&gt;              &lt;a rel=&quot;imagebox[aut6]&quot; href=&quot;uploads/servicios/galeria-mcc/mcc1.jpg&quot; id=&quot;Cambio de crucetas&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut6]&quot; href=&quot;uploads/servicios/galeria-mcc/mcc2.jpg&quot; id=&quot;Cambio de crucetas&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut6]&quot; href=&quot;uploads/servicios/galeria-mcc/mcc3.jpg&quot; id=&quot;Cambio de crucetas&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut6]&quot; href=&quot;uploads/servicios/galeria-mcc/mcc4.jpg&quot; id=&quot;Cambio de crucetas&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut6]&quot; href=&quot;uploads/servicios/galeria-mcc/mcc5.jpg&quot; id=&quot;Cambio de crucetas&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut7]&quot; href=&quot;uploads/servicios/galeria-mcp/mcp1.jpg&quot; id=&quot;Cambio de pararayos&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut7]&quot; href=&quot;uploads/servicios/galeria-mcp/mcp2.jpg&quot; id=&quot;Cambio de pararayos&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut7]&quot; href=&quot;uploads/servicios/galeria-mcp/mcp3.jpg&quot; id=&quot;Cambio de pararayos&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut7]&quot; href=&quot;uploads/servicios/galeria-mcp/mcp4.jpg&quot; id=&quot;Cambio de pararayos&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut7]&quot; href=&quot;uploads/servicios/galeria-mcp/mcp5.jpg&quot; id=&quot;Cambio de pararayos&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut8]&quot; href=&quot;uploads/servicios/galeria-mct/mct1.jpg&quot; id=&quot;Cambio de transformadores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut8]&quot; href=&quot;uploads/servicios/galeria-mct/mct2.jpg&quot; id=&quot;Cambio de transformadores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut8]&quot; href=&quot;uploads/servicios/galeria-mct/mct3.jpg&quot; id=&quot;Cambio de transformadores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut8]&quot; href=&quot;uploads/servicios/galeria-mct/mct4.jpg&quot; id=&quot;Cambio de transformadores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt1.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt2.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt3.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt4.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt5.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt6.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut9]&quot; href=&quot;uploads/servicios/galeria-mspt/mspt7.jpg&quot; id=&quot;Sistemas de puesta a tierra&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              \n              \n\t\t\t\t&lt;div&gt;\n\t\t\t\t\t&lt;p align=&quot;right&quot;&gt;&lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Cambio de crucetas&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Cambio de crucetas&lt;/a&gt;  \n             &amp;nbsp;&amp;nbsp;  &lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Cambio de pararayos&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Cambio de pararayos&lt;/a&gt;&lt;br /&gt;\n\t\t\t\t\t\t&lt;br /&gt;\n\t\t\t\t\t\t  &lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Cambio de transformadores&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Cambio de transfomadores&lt;/a&gt;            &amp;nbsp;&amp;nbsp;  &lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Sistemas de puesta a tierra&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Sistema de puesta en tierra&lt;/a&gt;           &lt;/p&gt;\n\t\t\t\t\t&lt;div class=&quot;clearspace&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt; \n          \n      \n\t\t\t&lt;div data-tabid=&quot;tab-5&quot; data-animin=&quot;flipInX&quot; class=&quot;tabcontent solid-yellow2 dark-text shadow-black&quot;&gt;\n\t\t\t\t&lt;h3 class=&quot;title&quot;&gt;REPARACIONES&lt;/h3&gt;&lt;hr size=&quot;2&quot; width=&quot;90%&quot; color=&quot;red&quot; /&gt;\n\t\t\t\t&lt;br /&gt;\n\t\t\t\t\n\t\t\t\t&lt;p&gt;Reparaciones en equipos de energía:&lt;/p&gt;\n\t\t\t\t&lt;ul class=&quot;sign-list&quot;&gt;  \n\t\t\t\t\t&lt;li&gt;Moto generadores.&lt;/li&gt;  \n\t\t\t\t\t&lt;li&gt;Aires acondicionados.&lt;/li&gt;\n\t\t\t\t&lt;/ul&gt;              &lt;a rel=&quot;imagebox[aut4]&quot; href=&quot;uploads/servicios/galeria-raa/raa1.jpg&quot; id=&quot;Reparacion de aires acondicionados&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut4]&quot; href=&quot;uploads/servicios/galeria-raa/ra2.jpg&quot; id=&quot;Reparacion de aires acondicionados&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut4]&quot; href=&quot;uploads/servicios/galeria-raa/raa3.jpg&quot; id=&quot;Reparacion de aires acondicionados&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut4]&quot; href=&quot;uploads/servicios/galeria-raa/raa4.jpg&quot; id=&quot;Reparacion de aires acondicionados&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;&lt;a rel=&quot;imagebox[aut4]&quot; href=&quot;uploads/servicios/galeria-raa/raa5.jpg&quot; id=&quot;Reparacion de aires acondicionados&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              \n              &lt;a rel=&quot;imagebox[aut5]&quot; href=&quot;uploads/servicios/galeria-rm/rm1.jpg&quot; id=&quot;Reparacion de motogeneradores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut5]&quot; href=&quot;uploads/servicios/galeria-rm/rm2.jpg&quot; id=&quot;Reparacion de motogeneradores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut5]&quot; href=&quot;uploads/servicios/galeria-rm/rm3.jpg&quot; id=&quot;Reparacion de motogeneradores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut5]&quot; href=&quot;uploads/servicios/galeria-rm/rm4.jpg&quot; id=&quot;Reparacion de motogeneradores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;              &lt;a rel=&quot;imagebox[aut5]&quot; href=&quot;uploads/servicios/galeria-rm/rm5.jpg&quot; id=&quot;Reparacion de motogeneradores&quot; class=&quot;thumbnail&quot;&gt;&lt;/a&gt;&lt;span class=&quot;cover&quot;&gt;&lt;/span&gt;\n\t\t\t\t&lt;div&gt;\n\t\t\t\t\t&lt;p align=&quot;right&quot;&gt;&lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Reparacion de aires acondicionados&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Galeria Aires Acondicionados&lt;/a&gt;  \n             &amp;nbsp;&amp;nbsp;  &lt;a href=&quot;javascript:imagebox.open(document.getElementById(&#039;Reparacion de motogeneradores&#039;));&quot; class=&quot;thumbnail button&quot; rel=&quot;nofollow&quot;&gt;Galeria Motogeneradores&lt;/a&gt; &lt;/p&gt;\n\t\t\t\t\t&lt;div class=&quot;clearspace&quot;&gt;&amp;nbsp;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;      &lt;/div&gt;\n\t\t&lt;!--\n\t\tEnd Tab Content Holder\n\t\t--&gt;\n\t\t&lt;/div&gt;\n\t&lt;!--\n\tEND TABION\n\t--&gt;\n\t\n\t&lt;div class=&quot;clearspace&quot;&gt;&amp;nbsp;&lt;/div&gt;    \n    &lt;/div&gt;', '&lt;script src=&quot;imagebox/imagebox.min.js&quot;&gt;&lt;/script&gt;\n\t\t&lt;script&gt;\n\t\t\t\n\t\t\t// create the galleries\nimagebox.creategallery(&#039;aut1&#039;, &#039;Instalacion y Mantenimiento&#039;);\nimagebox.creategallery(&#039;aut&#039;, &#039;Suministros&#039;);\nimagebox.creategallery(&#039;aut2&#039;, &#039;Equipos de Infraestructura&#039;);\nimagebox.creategallery(&#039;aut3&#039;, &#039;Equipos de Obra Civil&#039;);\nimagebox.creategallery(&#039;aut4&#039;, &#039;Reparacion de aires acondicionados&#039;);\nimagebox.creategallery(&#039;aut5&#039;, &#039;Reparacion de motogeneradores&#039;);\nimagebox.creategallery(&#039;aut6&#039;, &#039;Cambio de crucetas&#039;);\nimagebox.creategallery(&#039;aut7&#039;, &#039;cambio de pararayos&#039;);\nimagebox.creategallery(&#039;aut8&#039;, &#039;Cambio de transformadores&#039;);\nimagebox.creategallery(&#039;aut9&#039;, &#039;Sistema de puesta a tierra&#039;);\n\t\t\t// build imagebox\n\t\t\timagebox.build({\n\t\t\t\t// global options go here, these will affect all images\n\t\t\t});\n\t\t\t\n\t\t&lt;/script&gt;', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `page_slug`, `title_en`, `show_title`, `body_en`, `jscode`, `position`, `active`) VALUES ('21', '17', 'Clientes', 'Clientes', '0', '\n&lt;div style=&quot;text-align: center;&quot;&gt;  &lt;span style=&quot;font-size: 24pt; color: rgb(204, 0, 23);&quot;&gt;NUESTROS CLIENTES&lt;/span&gt;&lt;br /&gt;\n\t&lt;br /&gt;\n\t  \n\t&lt;!--\n\tRegular Table ==================================================\n\t--&gt;\n\t    \n\t&lt;div class=&quot;center&quot;&gt;          \n\t\t&lt;div class=&quot;row grid_22&quot;&gt;       \n    \n          \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-07.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;    \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-08.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;    \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-09.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;    \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-10.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;  \n  &lt;/div&gt; \n  &lt;br /&gt;\n\t\t\n\t\t&lt;div class=&quot;row grid_22&quot;&gt; \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-11.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;        \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-12.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;        \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-13.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;        \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-14.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt; &lt;/div&gt; &lt;br /&gt;\n\t\t\n\t\t&lt;div class=&quot;row grid_22&quot;&gt; \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-15.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;       \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-16.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;        \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-16.png&quot; border=&quot;0&quot; /&gt; &lt;/div&gt;   \n        \n\t\t\t&lt;div class=&quot;col grid_3&quot;&gt;&lt;img src=&quot;uploads/clientes/clientes-16.png&quot; border=&quot;0&quot; /&gt;&lt;/div&gt;    &lt;/div&gt;  &lt;/div&gt;&lt;/div&gt;&lt;br /&gt;\n', '', '0', '1');


-- --------------------------------------------------
# -- Table structure for table `settings`
-- --------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `site_name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `site_url` varchar(150) NOT NULL,
  `site_email` varchar(50) NOT NULL,
  `theme` varchar(32) NOT NULL,
  `theme_var` varchar(32) DEFAULT NULL,
  `seo` tinyint(1) NOT NULL DEFAULT '0',
  `perpage` tinyint(4) NOT NULL DEFAULT '10',
  `backup` varchar(64) NOT NULL,
  `thumb_w` varchar(5) NOT NULL,
  `thumb_h` varchar(5) NOT NULL,
  `img_w` varchar(5) NOT NULL,
  `img_h` varchar(5) NOT NULL,
  `avatar_w` varchar(3) DEFAULT '80',
  `avatar_h` varchar(3) DEFAULT '80',
  `short_date` varchar(50) NOT NULL,
  `long_date` varchar(50) NOT NULL,
  `dtz` varchar(120) DEFAULT NULL,
  `weekstart` tinyint(1) NOT NULL DEFAULT '1',
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `show_lang` tinyint(1) NOT NULL DEFAULT '0',
  `langdir` varchar(3) NOT NULL DEFAULT 'ltr',
  `eucookie` tinyint(1) NOT NULL DEFAULT '0',
  `offline` tinyint(1) NOT NULL DEFAULT '0',
  `offline_msg` text,
  `offline_data` varchar(20) DEFAULT '0000:00:00 00:00:00',
  `logo` varchar(100) DEFAULT NULL,
  `showlogin` tinyint(1) NOT NULL DEFAULT '1',
  `showsearch` tinyint(1) NOT NULL DEFAULT '1',
  `showcrumbs` tinyint(1) NOT NULL DEFAULT '1',
  `bgimg` varchar(60) DEFAULT NULL,
  `repbg` tinyint(1) DEFAULT '0',
  `bgalign` enum('left','right','center') DEFAULT 'left',
  `bgfixed` tinyint(1) DEFAULT '0',
  `bgcolor` varchar(7) DEFAULT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `cur_symbol` varchar(2) DEFAULT NULL,
  `reg_verify` tinyint(1) NOT NULL DEFAULT '1',
  `auto_verify` tinyint(1) NOT NULL DEFAULT '1',
  `reg_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `notify_admin` tinyint(1) NOT NULL DEFAULT '0',
  `user_limit` varchar(6) DEFAULT NULL,
  `flood` varchar(6) DEFAULT NULL,
  `attempt` varchar(2) DEFAULT NULL,
  `logging` tinyint(1) NOT NULL DEFAULT '0',
  `enablefb` tinyint(1) NOT NULL DEFAULT '0',
  `fbapi` varchar(50) DEFAULT NULL,
  `fbsecret` varchar(120) DEFAULT NULL,
  `metakeys` text,
  `metadesc` text,
  `analytics` text,
  `mailer` enum('PHP','SMTP','SMAIL') DEFAULT NULL,
  `sendmail` varchar(60) DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(3) DEFAULT NULL,
  `is_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `settings`
-- --------------------------------------------------

INSERT INTO `settings` (`site_name`, `company`, `site_url`, `site_email`, `theme`, `theme_var`, `seo`, `perpage`, `backup`, `thumb_w`, `thumb_h`, `img_w`, `img_h`, `avatar_w`, `avatar_h`, `short_date`, `long_date`, `dtz`, `weekstart`, `lang`, `show_lang`, `langdir`, `eucookie`, `offline`, `offline_msg`, `offline_data`, `logo`, `showlogin`, `showsearch`, `showcrumbs`, `bgimg`, `repbg`, `bgalign`, `bgfixed`, `bgcolor`, `currency`, `cur_symbol`, `reg_verify`, `auto_verify`, `reg_allowed`, `notify_admin`, `user_limit`, `flood`, `attempt`, `logging`, `enablefb`, `fbapi`, `fbsecret`, `metakeys`, `metadesc`, `analytics`, `mailer`, `sendmail`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `is_ssl`, `version`) VALUES ('SIGN', 'SIGN', 'http://signsas.com', 'site@mail.com', 'lorna', '', '0', '30', '26-Nov-2013_18-42-50.sql', '150', '150', '1200', '1000', '40', '40', '%b %d %Y', '%d %B %Y %H:%M', 'America/Toronto', '2', 'en', '0', 'ltr', '0', '0', 'We are currently working on improving our site. Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.\r\n\r\nPraesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', '2013:01:08 23:00:00', '', '0', '0', '0', 'fondo.png', '1', 'center', '0', '#EDF1F5', 'COP', '$', '0', '0', '0', '0', '0', '1800', '3', '1', '0', '340635415947196', '06eaa18fa7e6ce708d3f61422e46cac3', 'metakeys, separated,by coma', 'Your website description goes here', '', 'PHP', '/usr/sbin/sendmail -t -i', 'mail.hostname.com', 'yourusername', 'yourpass', '25', '0', '3.65');


-- --------------------------------------------------
# -- Table structure for table `stats`
-- --------------------------------------------------
DROP TABLE IF EXISTS `stats`;
CREATE TABLE `stats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL DEFAULT '0000-00-00',
  `pageviews` int(10) NOT NULL DEFAULT '0',
  `uniquevisitors` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `stats`
-- --------------------------------------------------

INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('1', '2013-11-19', '39', '3');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('2', '2013-11-20', '329', '25');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('3', '2013-11-21', '25', '3');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('4', '2013-11-22', '22', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('5', '2013-11-24', '18', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('6', '2013-11-25', '146', '7');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('7', '2013-11-26', '63', '8');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('8', '2013-11-27', '23', '3');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('9', '2013-11-28', '31', '4');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('10', '2013-11-30', '1', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('11', '2013-12-01', '3', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('12', '2013-12-02', '1', '1');


-- --------------------------------------------------
# -- Table structure for table `users`
-- --------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` bigint(11) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `membership_id` tinyint(3) NOT NULL DEFAULT '0',
  `mem_expire` datetime DEFAULT '0000-00-00 00:00:00',
  `trial_used` tinyint(1) NOT NULL DEFAULT '0',
  `memused` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `token` varchar(40) NOT NULL DEFAULT '0',
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `userlevel` tinyint(1) NOT NULL DEFAULT '1',
  `custom_fields` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `lastlogin` datetime DEFAULT '0000-00-00 00:00:00',
  `lastip` varchar(16) DEFAULT '0',
  `avatar` varchar(50) DEFAULT NULL,
  `access` text,
  `active` enum('y','n','t','b') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `users`
-- --------------------------------------------------

INSERT INTO `users` (`id`, `fbid`, `username`, `password`, `membership_id`, `mem_expire`, `trial_used`, `memused`, `email`, `fname`, `lname`, `token`, `newsletter`, `userlevel`, `custom_fields`, `created`, `lastlogin`, `lastip`, `avatar`, `access`, `active`) VALUES ('1', '0', 'admin', '96394e32de4070048d7c917fe6854028a78428af', '0', '0000-00-00 00:00:00', '0', '0', 'site@mail.com', '', '', '0', '0', '9', '', '2013-11-19 20:49:04', '2013-12-02 11:47:39', '186.28.39.65', '', '', 'y');

