/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50620
Source Host           : 127.0.0.1:3306
Source Database       : sclmgt

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2019-11-15 15:02:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for in_sysprvlg
-- ----------------------------
DROP TABLE IF EXISTS `in_sysprvlg`;
CREATE TABLE `in_sysprvlg` (
  `prvCode` int(11) NOT NULL,
  `prvName` varchar(100) NOT NULL,
  `prvStatus` int(3) NOT NULL DEFAULT '1',
  `usrPrvMnuName` varchar(100) NOT NULL,
  `usrPrvMnuName_sinhala` varchar(255) DEFAULT NULL,
  `usrPrvMnuIcon` varchar(45) DEFAULT '',
  `usrPrvMnuPath` varchar(100) NOT NULL,
  `usrPrnt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prvCode`),
  UNIQUE KEY `user_privilage_code` (`prvCode`),
  UNIQUE KEY `user_privilage_code_2` (`prvCode`,`prvName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_sysprvlg
-- ----------------------------
INSERT INTO `in_sysprvlg` VALUES ('100', 'System Data', '1', 'System Data', null, 'systemSettings.png', '-', '0');
INSERT INTO `in_sysprvlg` VALUES ('101', 'Staff Details', '1', 'Staff Details', null, '-', '-', '0');
INSERT INTO `in_sysprvlg` VALUES ('103', 'Subjects Details', '1', 'Subjects Details', null, '-', '-', '0');
INSERT INTO `in_sysprvlg` VALUES ('104', 'Resturent Details', '1', 'Resturent Details', null, '-', '-', '0');
INSERT INTO `in_sysprvlg` VALUES ('105', 'Create Room', '1', 'Create Room', null, 'systemSettings.png', 'create_room.php', '101');
INSERT INTO `in_sysprvlg` VALUES ('106', 'Exatra Features of room', '1', 'Exatra Features of room', null, 'systemSettings.png', 'extra_room_features.php', '101');
INSERT INTO `in_sysprvlg` VALUES ('109', 'Add Mediam', '1', 'Add Mediam', null, 'systemSettings.png', 'Add_mediam.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('110', 'Sundry/Laundry', '1', 'Sundry/Laundry', null, '', '', '0');
INSERT INTO `in_sysprvlg` VALUES ('113', 'Add Currency', '1', 'Add Currency', null, '-', 'add_currency.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('114', 'System Settings', '1', 'System Settings', null, 'systemSettings.png', 'settings_dashboard.php', '120');
INSERT INTO `in_sysprvlg` VALUES ('115', 'User Management', '1', 'User Management', null, 'usermanege.png', 'userManegement.php', '120');
INSERT INTO `in_sysprvlg` VALUES ('116', 'Bar Main Item', '1', 'Bar Main Item', null, 'systemSettings.png', 'bar_main_items.php', '103');
INSERT INTO `in_sysprvlg` VALUES ('117', 'Bar Sub Item', '1', 'Bar Sub Item', null, 'systemSettings.png', 'bar_sub_items.php', '103');
INSERT INTO `in_sysprvlg` VALUES ('118', 'Reservation Details', '1', 'Reservation Details', null, '-', '-', '0');
INSERT INTO `in_sysprvlg` VALUES ('120', 'Settings', '1', 'Settings', null, '-', '-', '0');
INSERT INTO `in_sysprvlg` VALUES ('121', 'School Grade', '1', 'School Grade', null, '-', 'add_grades.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('122', 'Currency Rate', '1', 'Currency Rates', '', '', 'currency_rate.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('123', 'Taxes Rates', '1', 'Taxes Rates', null, '', 'taxesrates.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('124', 'Agent Registration', '1', 'Agent Registration', null, 'systemSettings.png', 'agent_registration.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('125', 'Resturant  Main Item', '1', 'Resturant  Main Item', null, '-', 'rest_main_cat.php', '104');
INSERT INTO `in_sysprvlg` VALUES ('126', 'Main Laundry Types', '1', 'Main Laundry Types', null, '', 'laundry_main_category.php', '110');
INSERT INTO `in_sysprvlg` VALUES ('127', 'Laundry Types', '1', 'Laundry Types', null, '', 'add_laundry_types.php', '110');
INSERT INTO `in_sysprvlg` VALUES ('128', 'Bar Item Registration', '1', 'Bar Item Registration', null, '-', 'bar_item_registration.php', '103');
INSERT INTO `in_sysprvlg` VALUES ('129', 'Restaurent Sub Category', '1', 'Restaurent Sub Category', null, '', 'rest_sub_items.php', '104');
INSERT INTO `in_sysprvlg` VALUES ('130', 'Laundries         ', '1', 'Laundries', null, '-', 'Laundries.php', '118');
INSERT INTO `in_sysprvlg` VALUES ('131', 'Create Menu\'s', '1', 'Create Menu\'s', null, '', 'ala_carte_menu.php', '104');
INSERT INTO `in_sysprvlg` VALUES ('132', 'Special Guest Meal Price', '1', 'Special Guest Meal Price', null, '', 'SpecialMeal_rate.php', '118');
INSERT INTO `in_sysprvlg` VALUES ('133', 'School Class', '1', 'School Class', null, '', 'syscode_main_categories.php', '100');
INSERT INTO `in_sysprvlg` VALUES ('134', 'Guest Selected Sundry', '1', 'Guest Selected Sundry', null, '', 'Sundry_change.php', '118');
INSERT INTO `in_sysprvlg` VALUES ('135', 'Main Reservation Details', '1', 'Main Reservation Details', null, '', 'guest_registration.php', '118');

-- ----------------------------
-- Table structure for in_usr
-- ----------------------------
DROP TABLE IF EXISTS `in_usr`;
CREATE TABLE `in_usr` (
  `usrID` int(11) NOT NULL AUTO_INCREMENT,
  `usrName` varchar(50) NOT NULL DEFAULT '',
  `usrFName` varchar(100) DEFAULT NULL,
  `usrLName` varchar(100) DEFAULT NULL,
  `usrLevel` int(11) NOT NULL DEFAULT '1',
  `usrPwd` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `usrRegDate` date NOT NULL DEFAULT '0000-00-00',
  `usrStatus` int(1) NOT NULL DEFAULT '1',
  `usrAddress` varchar(200) DEFAULT NULL,
  `usrEmail` varchar(150) DEFAULT NULL,
  `lstLgDate` date NOT NULL,
  `lstLgTime` time NOT NULL,
  `usrEmpNo` varchar(100) DEFAULT NULL,
  `usrNIC` varchar(20) DEFAULT NULL,
  `usrMobileNo` varchar(20) DEFAULT NULL,
  `usrWorkTelNo` varchar(20) DEFAULT NULL,
  `usrHomeTelNo` varchar(20) DEFAULT NULL,
  `userBranchID` int(11) NOT NULL,
  PRIMARY KEY (`usrID`,`usrName`),
  UNIQUE KEY `usrEmpNo` (`usrEmpNo`),
  UNIQUE KEY `usrNIC` (`usrNIC`),
  UNIQUE KEY `usrEmpNo_2` (`usrEmpNo`,`usrNIC`),
  KEY `id` (`usrID`),
  KEY `user_level` (`usrLevel`),
  KEY `user_name` (`usrName`) USING BTREE,
  CONSTRAINT `in_usr_ibfk_1` FOREIGN KEY (`usrLevel`) REFERENCES `in_usrlevel` (`lvID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_usr
-- ----------------------------
INSERT INTO `in_usr` VALUES ('81', 'admin', '', '', '188', '56e2636af1fedd1c6f89df1ea09bf1ba120f52e7', '2014-07-07', '1', '', '', '2014-07-07', '10:37:22', '99999', '999999999V', '', '', '', '76');
INSERT INTO `in_usr` VALUES ('82', 'Wasantha', 'wasantha', 'KUMARA', '194', '1983e83fc9b7b572c58ba13eeff430df85ba5e64', '2019-11-15', '1', 'kurunegala', 'wasantha@gmail.com', '2019-11-15', '01:09:39', '123443', '872033068v', '0716541816', '', '', '1');

-- ----------------------------
-- Table structure for in_usrlevel
-- ----------------------------
DROP TABLE IF EXISTS `in_usrlevel`;
CREATE TABLE `in_usrlevel` (
  `lvID` int(11) NOT NULL AUTO_INCREMENT,
  `lvName` varchar(100) DEFAULT NULL,
  `usrLvlPrvSeq` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lvID`),
  UNIQUE KEY `usrLvlPrvSeq` (`usrLvlPrvSeq`),
  UNIQUE KEY `admin_level_name` (`lvName`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_usrlevel
-- ----------------------------
INSERT INTO `in_usrlevel` VALUES ('18', 'Super User', '20');
INSERT INTO `in_usrlevel` VALUES ('188', 'admin', '1');
INSERT INTO `in_usrlevel` VALUES ('194', 'User', '2');

-- ----------------------------
-- Table structure for in_usrlvlpriv
-- ----------------------------
DROP TABLE IF EXISTS `in_usrlvlpriv`;
CREATE TABLE `in_usrlvlpriv` (
  `usrLvl` int(11) NOT NULL,
  `usrPrivilage` int(11) NOT NULL,
  PRIMARY KEY (`usrLvl`,`usrPrivilage`),
  UNIQUE KEY `usrLvl` (`usrLvl`,`usrPrivilage`),
  KEY `usrPrivilage` (`usrPrivilage`),
  CONSTRAINT `in_usrlvlpriv_ibfk_1` FOREIGN KEY (`usrLvl`) REFERENCES `in_usrlevel` (`lvID`) ON UPDATE CASCADE,
  CONSTRAINT `in_usrlvlpriv_ibfk_2` FOREIGN KEY (`usrPrivilage`) REFERENCES `in_sysprvlg` (`prvCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_usrlvlpriv
-- ----------------------------

-- ----------------------------
-- Table structure for in_usrprvlg
-- ----------------------------
DROP TABLE IF EXISTS `in_usrprvlg`;
CREATE TABLE `in_usrprvlg` (
  `usrID` int(11) NOT NULL,
  `usrPrvCode` int(11) NOT NULL,
  PRIMARY KEY (`usrID`,`usrPrvCode`),
  UNIQUE KEY `usrID` (`usrID`,`usrPrvCode`),
  KEY `usrPrvCode` (`usrPrvCode`),
  CONSTRAINT `in_usrprvlg_ibfk_1` FOREIGN KEY (`usrID`) REFERENCES `in_usr` (`usrID`) ON UPDATE CASCADE,
  CONSTRAINT `in_usrprvlg_ibfk_2` FOREIGN KEY (`usrPrvCode`) REFERENCES `in_sysprvlg` (`prvCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_usrprvlg
-- ----------------------------
INSERT INTO `in_usrprvlg` VALUES ('81', '100');
INSERT INTO `in_usrprvlg` VALUES ('82', '100');
INSERT INTO `in_usrprvlg` VALUES ('81', '101');
INSERT INTO `in_usrprvlg` VALUES ('81', '103');
INSERT INTO `in_usrprvlg` VALUES ('82', '103');
INSERT INTO `in_usrprvlg` VALUES ('81', '104');
INSERT INTO `in_usrprvlg` VALUES ('81', '105');
INSERT INTO `in_usrprvlg` VALUES ('81', '106');
INSERT INTO `in_usrprvlg` VALUES ('81', '109');
INSERT INTO `in_usrprvlg` VALUES ('82', '109');
INSERT INTO `in_usrprvlg` VALUES ('81', '110');
INSERT INTO `in_usrprvlg` VALUES ('81', '114');
INSERT INTO `in_usrprvlg` VALUES ('81', '115');
INSERT INTO `in_usrprvlg` VALUES ('81', '116');
INSERT INTO `in_usrprvlg` VALUES ('81', '117');
INSERT INTO `in_usrprvlg` VALUES ('81', '118');
INSERT INTO `in_usrprvlg` VALUES ('81', '120');
INSERT INTO `in_usrprvlg` VALUES ('81', '121');
INSERT INTO `in_usrprvlg` VALUES ('81', '125');
INSERT INTO `in_usrprvlg` VALUES ('81', '126');
INSERT INTO `in_usrprvlg` VALUES ('81', '127');
INSERT INTO `in_usrprvlg` VALUES ('81', '128');
INSERT INTO `in_usrprvlg` VALUES ('81', '129');
INSERT INTO `in_usrprvlg` VALUES ('81', '130');
INSERT INTO `in_usrprvlg` VALUES ('81', '131');
INSERT INTO `in_usrprvlg` VALUES ('81', '132');
INSERT INTO `in_usrprvlg` VALUES ('81', '133');
INSERT INTO `in_usrprvlg` VALUES ('81', '134');
INSERT INTO `in_usrprvlg` VALUES ('81', '135');

-- ----------------------------
-- Table structure for tbl_class
-- ----------------------------
DROP TABLE IF EXISTS `tbl_class`;
CREATE TABLE `tbl_class` (
  `class_aid` int(100) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `class_st` int(10) NOT NULL DEFAULT '1' COMMENT '1-active, 0-inactive',
  PRIMARY KEY (`class_aid`),
  UNIQUE KEY `class_name` (`class_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_class
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_classassinging
-- ----------------------------
DROP TABLE IF EXISTS `tbl_classassinging`;
CREATE TABLE `tbl_classassinging` (
  `class_assing_aid` int(100) NOT NULL AUTO_INCREMENT,
  `grade_id` int(100) NOT NULL,
  `class_name_id` int(100) NOT NULL,
  `class_mediam_id` int(100) NOT NULL,
  `class_st` int(10) NOT NULL DEFAULT '1' COMMENT '1-active, 2-inactive',
  PRIMARY KEY (`class_assing_aid`),
  UNIQUE KEY `grade_id` (`grade_id`,`class_name_id`,`class_mediam_id`) USING BTREE,
  KEY `class_name_id` (`class_name_id`),
  KEY `class_mediam_id` (`class_mediam_id`),
  CONSTRAINT `tbl_classassinging_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `tbl_grade` (`grd_aid`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_classassinging_ibfk_2` FOREIGN KEY (`class_name_id`) REFERENCES `tbl_class` (`class_aid`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_classassinging_ibfk_3` FOREIGN KEY (`class_mediam_id`) REFERENCES `tbl_medieam` (`scl_medi_aid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_classassinging
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_clsswise_subject
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clsswise_subject`;
CREATE TABLE `tbl_clsswise_subject` (
  `cls_subj_aid` int(100) NOT NULL AUTO_INCREMENT,
  `class_id` int(100) NOT NULL,
  `subj_id` int(100) NOT NULL,
  PRIMARY KEY (`cls_subj_aid`),
  UNIQUE KEY `class_id` (`class_id`,`subj_id`) USING BTREE,
  KEY `subj_id` (`subj_id`),
  CONSTRAINT `tbl_clsswise_subject_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `tbl_classassinging` (`class_assing_aid`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_clsswise_subject_ibfk_2` FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subject_aid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_clsswise_subject
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_grade
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grade`;
CREATE TABLE `tbl_grade` (
  `grd_aid` int(100) NOT NULL AUTO_INCREMENT,
  `grade_no` int(100) NOT NULL,
  PRIMARY KEY (`grd_aid`),
  UNIQUE KEY `grade_no` (`grade_no`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_grade
-- ----------------------------
INSERT INTO `tbl_grade` VALUES ('1', '1');
INSERT INTO `tbl_grade` VALUES ('2', '2');
INSERT INTO `tbl_grade` VALUES ('3', '3');
INSERT INTO `tbl_grade` VALUES ('5', '4');

-- ----------------------------
-- Table structure for tbl_medieam
-- ----------------------------
DROP TABLE IF EXISTS `tbl_medieam`;
CREATE TABLE `tbl_medieam` (
  `scl_medi_aid` int(100) NOT NULL AUTO_INCREMENT,
  `scl_mediam` varchar(255) NOT NULL,
  `scl_mediam_sh` varchar(255) NOT NULL,
  PRIMARY KEY (`scl_medi_aid`),
  UNIQUE KEY `scl_mediam` (`scl_mediam`) USING BTREE,
  UNIQUE KEY `scl_mediam_sh` (`scl_mediam_sh`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_medieam
-- ----------------------------
INSERT INTO `tbl_medieam` VALUES ('1', 'ENGLISH', 'EN');

-- ----------------------------
-- Table structure for tbl_scldetails
-- ----------------------------
DROP TABLE IF EXISTS `tbl_scldetails`;
CREATE TABLE `tbl_scldetails` (
  `scl_aid` int(100) NOT NULL AUTO_INCREMENT,
  `scl_name` varchar(255) NOT NULL,
  `scl_add_1` varchar(255) NOT NULL,
  `scl_add_2` varchar(255) DEFAULT NULL,
  `scl_distric` varchar(255) NOT NULL,
  `scl_pw` varchar(255) NOT NULL,
  `scl_tel` varchar(255) NOT NULL,
  `scl_st` int(10) NOT NULL DEFAULT '1' COMMENT '1-active, 0-inactive',
  PRIMARY KEY (`scl_aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_scldetails
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_semester
-- ----------------------------
DROP TABLE IF EXISTS `tbl_semester`;
CREATE TABLE `tbl_semester` (
  `sem_aid` int(100) NOT NULL AUTO_INCREMENT,
  `semester_name` varchar(255) NOT NULL,
  PRIMARY KEY (`sem_aid`),
  UNIQUE KEY `semester_name` (`semester_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_semester
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_staffdetaild
-- ----------------------------
DROP TABLE IF EXISTS `tbl_staffdetaild`;
CREATE TABLE `tbl_staffdetaild` (
  `staff_aid` int(100) NOT NULL AUTO_INCREMENT,
  `staff_poid` int(100) NOT NULL,
  `staff_fullName` varchar(255) NOT NULL,
  `staff_nameIntil` varchar(255) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `staff_contactno` int(10) NOT NULL,
  `staff_add1` varchar(255) NOT NULL,
  `staff_add2` varchar(255) DEFAULT NULL,
  `staff_distric` varchar(255) NOT NULL,
  `staff_pv` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_staffdetaild
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_staff_position
-- ----------------------------
DROP TABLE IF EXISTS `tbl_staff_position`;
CREATE TABLE `tbl_staff_position` (
  `staff_staid` int(100) NOT NULL AUTO_INCREMENT,
  `stff_position` varchar(255) NOT NULL,
  `stff_sh` varchar(255) NOT NULL,
  `stff_st` int(100) NOT NULL DEFAULT '1' COMMENT '1-Active, 2-Tempory, ',
  PRIMARY KEY (`staff_staid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_staff_position
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_staff_subject
-- ----------------------------
DROP TABLE IF EXISTS `tbl_staff_subject`;
CREATE TABLE `tbl_staff_subject` (
  `staff_subj_aid` int(100) NOT NULL AUTO_INCREMENT,
  `staff_id` int(100) NOT NULL,
  `subject_id` int(100) NOT NULL,
  PRIMARY KEY (`staff_subj_aid`),
  KEY `staff_id` (`staff_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `tbl_staff_subject_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staffdetaild` (`staff_aid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tbl_staff_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`subject_aid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_staff_subject
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_stuassingclass
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stuassingclass`;
CREATE TABLE `tbl_stuassingclass` (
  `stu_assClass_aid` int(100) NOT NULL COMMENT 'every year Starting change for student classes new record',
  `stu_id` int(100) NOT NULL,
  `class_ass_id` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  `stus` int(10) NOT NULL DEFAULT '1' COMMENT '1-Assining completed, 2-Tempory desable, 3-Leave',
  PRIMARY KEY (`stu_assClass_aid`),
  UNIQUE KEY `stu_id` (`stu_id`,`class_ass_id`) USING BTREE,
  KEY `class_ass_id` (`class_ass_id`),
  CONSTRAINT `tbl_stuassingclass_ibfk_1` FOREIGN KEY (`stu_id`) REFERENCES `tbl_studentdetail` (`stu_aid`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_stuassingclass_ibfk_2` FOREIGN KEY (`class_ass_id`) REFERENCES `tbl_classassinging` (`class_assing_aid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_stuassingclass
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_studentdetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_studentdetail`;
CREATE TABLE `tbl_studentdetail` (
  `stu_aid` int(100) NOT NULL AUTO_INCREMENT,
  `stu_fullName` varchar(255) NOT NULL,
  `stu_nameInitial` varchar(255) NOT NULL,
  `stu_add_1` varchar(255) NOT NULL,
  `stu_add_2` varchar(255) DEFAULT NULL,
  `stu_distric` varchar(255) NOT NULL,
  `stu_gnDivision` varchar(255) NOT NULL,
  `stu_districSectore` varchar(255) NOT NULL,
  `stu_province` varchar(255) NOT NULL,
  `stu_Fname` varchar(255) NOT NULL,
  `stu_Mname` varchar(255) DEFAULT NULL,
  `stu_homecontactNo` varchar(255) DEFAULT NULL,
  `stu_contactNo` varchar(255) NOT NULL,
  `stu_sclDistance` double NOT NULL,
  `stu_birthDay` date NOT NULL,
  `stu_birthCerNo` varchar(255) NOT NULL,
  `stu_st` int(10) NOT NULL DEFAULT '1' COMMENT '1-Temporyregistory, 2-RegCompleted, 3-Transfer, 4-Leave scl',
  `stu_currentYear` int(100) NOT NULL COMMENT 'current year-upadate for year starting',
  PRIMARY KEY (`stu_aid`),
  UNIQUE KEY `stu_aid` (`stu_aid`,`stu_birthCerNo`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_studentdetail
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_stumarks
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stumarks`;
CREATE TABLE `tbl_stumarks` (
  `stmark_aid` int(100) NOT NULL AUTO_INCREMENT,
  `stu_id` int(100) NOT NULL,
  `classwis_subid` int(100) NOT NULL,
  `sub_marks` double(100,2) NOT NULL,
  `year` int(100) NOT NULL,
  `sem_id` int(100) NOT NULL,
  `current_year` int(100) NOT NULL,
  PRIMARY KEY (`stmark_aid`),
  UNIQUE KEY `stu_id` (`stu_id`,`classwis_subid`,`sub_marks`,`year`,`sem_id`) USING BTREE,
  KEY `classwis_subid` (`classwis_subid`),
  KEY `sem_id` (`sem_id`),
  CONSTRAINT `tbl_stumarks_ibfk_1` FOREIGN KEY (`stu_id`) REFERENCES `tbl_studentdetail` (`stu_aid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tbl_stumarks_ibfk_2` FOREIGN KEY (`classwis_subid`) REFERENCES `tbl_clsswise_subject` (`cls_subj_aid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tbl_stumarks_ibfk_3` FOREIGN KEY (`sem_id`) REFERENCES `tbl_semester` (`sem_aid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_stumarks
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_subject
-- ----------------------------
DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE `tbl_subject` (
  `subject_aid` int(100) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `subj_shc` varchar(255) NOT NULL,
  `subjec_catid` int(100) NOT NULL DEFAULT '1' COMMENT '1-main subject, 2-1st section, 3-2nd selection, 4-3rd selection',
  PRIMARY KEY (`subject_aid`),
  UNIQUE KEY `subject_name` (`subject_name`) USING BTREE,
  UNIQUE KEY `subj_shc` (`subj_shc`) USING BTREE,
  KEY `subjec_catid` (`subjec_catid`),
  CONSTRAINT `tbl_subject_ibfk_1` FOREIGN KEY (`subjec_catid`) REFERENCES `tbl_subject_cat` (`subcat_aid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_subject
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_subject_cat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_subject_cat`;
CREATE TABLE `tbl_subject_cat` (
  `subcat_aid` int(100) NOT NULL,
  `subcat_type` varchar(255) NOT NULL,
  PRIMARY KEY (`subcat_aid`),
  UNIQUE KEY `subcat_type` (`subcat_type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_subject_cat
-- ----------------------------
