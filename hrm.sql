/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : hrm

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 18/12/2020 16:08:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contract
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract`  (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `decision_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `employee_id` int(11) NULL DEFAULT NULL,
  `type_contract` tinyint(1) NULL DEFAULT NULL COMMENT '1. dài hạn  2. ngắn hạn  3. thời vụ  4. thực tập',
  `effective_date` date NULL DEFAULT NULL,
  `expiration_date` date NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`contract_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contract
-- ----------------------------
INSERT INTO `contract` VALUES (1, 'HD_DH/0001', 1, 1, '2013-10-08', NULL, 'Hợp đồng dài hạn NV001', NULL, '2020-10-08 08:57:02', NULL, NULL);
INSERT INTO `contract` VALUES (2, 'HD_DH/0002', 2, 1, NULL, NULL, 'Hợp đồng dài hạn NV002', NULL, '2020-10-08 07:49:07', NULL, NULL);
INSERT INTO `contract` VALUES (3, 'HD_DH/0003', 3, 1, NULL, NULL, 'Hợp đồng dài hạn NV003', NULL, '2020-10-08 07:49:07', NULL, NULL);
INSERT INTO `contract` VALUES (4, 'HD_DH/0004', 4, 1, NULL, NULL, 'Hợp đồng dài hạn NV004', NULL, '2020-10-08 07:49:07', NULL, NULL);

-- ----------------------------
-- Table structure for data_type
-- ----------------------------
DROP TABLE IF EXISTS `data_type`;
CREATE TABLE `data_type`  (
  `data_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_code` char(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `data_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `data_type` char(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `sort_order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`data_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 371 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_type
-- ----------------------------
INSERT INTO `data_type` VALUES (1, 'AG', 'An Giang', 'province', 1);
INSERT INTO `data_type` VALUES (2, 'BR_VT', 'Bà Rịa - Vũng Tàu', 'province', 2);
INSERT INTO `data_type` VALUES (3, 'BG', 'Bắc Giang', 'province', 3);
INSERT INTO `data_type` VALUES (4, 'BK', 'Bắc Kạn', 'province', 4);
INSERT INTO `data_type` VALUES (5, 'BL', 'Bạc Liêu', 'province', 5);
INSERT INTO `data_type` VALUES (6, 'BN', 'Bắc Ninh', 'province', 6);
INSERT INTO `data_type` VALUES (7, 'BT', 'Bến Tre', 'province', 7);
INSERT INTO `data_type` VALUES (8, 'BD1', 'Bình Định', 'province', 8);
INSERT INTO `data_type` VALUES (9, 'BD2', 'Bình Dương', 'province', 9);
INSERT INTO `data_type` VALUES (10, 'BP', 'Bình Phước', 'province', 10);
INSERT INTO `data_type` VALUES (11, 'BT', 'Bình Thuận', 'province', 11);
INSERT INTO `data_type` VALUES (12, 'CM', 'Cà Mau', 'province', 12);
INSERT INTO `data_type` VALUES (13, 'CB', 'Cao Bằng', 'province', 13);
INSERT INTO `data_type` VALUES (14, 'DL', 'Đắk Lắk', 'province', 14);
INSERT INTO `data_type` VALUES (15, 'DN1', 'Đắk Nông', 'province', 15);
INSERT INTO `data_type` VALUES (16, 'DB', 'Điện Biên', 'province', 16);
INSERT INTO `data_type` VALUES (17, 'DN2', 'Đồng Nai', 'province', 17);
INSERT INTO `data_type` VALUES (18, 'DT', 'Đồng Tháp', 'province', 18);
INSERT INTO `data_type` VALUES (19, 'GL', 'Gia Lai', 'province', 19);
INSERT INTO `data_type` VALUES (20, 'HG1', 'Hà Giang', 'province', 20);
INSERT INTO `data_type` VALUES (21, 'HN', 'Hà Nam', 'province', 21);
INSERT INTO `data_type` VALUES (22, 'HT', 'Hà Tĩnh', 'province', 22);
INSERT INTO `data_type` VALUES (23, 'HD', 'Hải Dương', 'province', 23);
INSERT INTO `data_type` VALUES (24, 'HG2', 'Hậu Giang', 'province', 24);
INSERT INTO `data_type` VALUES (25, 'HB', 'Hòa Bình', 'province', 25);
INSERT INTO `data_type` VALUES (26, 'HY', 'Hưng Yên', 'province', 26);
INSERT INTO `data_type` VALUES (27, 'KH', 'Khánh Hòa', 'province', 27);
INSERT INTO `data_type` VALUES (28, 'KG', 'Kiên Giang', 'province', 28);
INSERT INTO `data_type` VALUES (29, 'KT', 'Kon Tum', 'province', 29);
INSERT INTO `data_type` VALUES (30, 'LC', 'Lai Châu', 'province', 30);
INSERT INTO `data_type` VALUES (31, 'LD', 'Lâm Đồng', 'province', 31);
INSERT INTO `data_type` VALUES (32, 'LS', 'Lạng Sơn', 'province', 32);
INSERT INTO `data_type` VALUES (33, 'LC', 'Lào Cai', 'province', 33);
INSERT INTO `data_type` VALUES (34, 'LA', 'Long An', 'province', 34);
INSERT INTO `data_type` VALUES (35, 'ND', 'Nam Định', 'province', 35);
INSERT INTO `data_type` VALUES (36, 'NA', 'Nghệ An', 'province', 36);
INSERT INTO `data_type` VALUES (37, 'NB', 'Ninh Bình', 'province', 37);
INSERT INTO `data_type` VALUES (38, 'NT', 'Ninh Thuận', 'province', 38);
INSERT INTO `data_type` VALUES (39, 'PT', 'Phú Thọ', 'province', 39);
INSERT INTO `data_type` VALUES (40, 'QB', 'Quảng Bình', 'province', 40);
INSERT INTO `data_type` VALUES (41, 'QN1', 'Quảng Nam', 'province', 41);
INSERT INTO `data_type` VALUES (42, 'QN2', 'Quảng Ngãi', 'province', 42);
INSERT INTO `data_type` VALUES (43, 'QN3', 'Quảng Ninh', 'province', 43);
INSERT INTO `data_type` VALUES (44, 'QT', 'Quảng Trị', 'province', 44);
INSERT INTO `data_type` VALUES (45, 'ST', 'Sóc Trăng', 'province', 45);
INSERT INTO `data_type` VALUES (46, 'SL', 'Sơn La', 'province', 46);
INSERT INTO `data_type` VALUES (47, 'TN', 'Tây  Ninh', 'province', 47);
INSERT INTO `data_type` VALUES (48, 'TB', 'Thái Bình', 'province', 48);
INSERT INTO `data_type` VALUES (49, 'TN', 'Thái Nguyên', 'province', 49);
INSERT INTO `data_type` VALUES (50, 'TH', 'Thanh Hóa', 'province', 50);
INSERT INTO `data_type` VALUES (51, 'TTH', 'Thừa Thiên Huế', 'province', 51);
INSERT INTO `data_type` VALUES (52, 'TG', 'Tiền Giang', 'province', 52);
INSERT INTO `data_type` VALUES (53, 'TV', 'Trà Vinh', 'province', 53);
INSERT INTO `data_type` VALUES (54, 'TQ', 'Tuyên Quang', 'province', 54);
INSERT INTO `data_type` VALUES (55, 'VL', 'Vĩnh Long', 'province', 55);
INSERT INTO `data_type` VALUES (56, 'VP', 'Vĩnh Phúc', 'province', 56);
INSERT INTO `data_type` VALUES (57, 'YB', 'Yên Bái', 'province', 57);
INSERT INTO `data_type` VALUES (58, 'PY', 'Phú Yên', 'province', 58);
INSERT INTO `data_type` VALUES (59, 'CT', 'TP. Cần Thơ', 'province', 59);
INSERT INTO `data_type` VALUES (60, 'DN', 'TP. Đà Nẵng', 'province', 60);
INSERT INTO `data_type` VALUES (61, 'HP', 'TP. Hải Phòng', 'province', 61);
INSERT INTO `data_type` VALUES (62, 'HN', 'TP. Hà Nội', 'province', 62);
INSERT INTO `data_type` VALUES (63, 'HCM', 'TP. Hồ Chí Minh', 'province', 63);
INSERT INTO `data_type` VALUES (64, 'AF', 'AFGHANISTAN', 'nationality', 1);
INSERT INTO `data_type` VALUES (65, 'AX', 'ÅLAND ISLANDS', 'nationality', 2);
INSERT INTO `data_type` VALUES (66, 'AL', 'ALBANIA', 'nationality', 3);
INSERT INTO `data_type` VALUES (67, 'DZ', 'ALGERIA', 'nationality', 4);
INSERT INTO `data_type` VALUES (68, 'AS', 'AMERICAN SAMOA', 'nationality', 5);
INSERT INTO `data_type` VALUES (69, 'AD', 'ANDORRA', 'nationality', 6);
INSERT INTO `data_type` VALUES (70, 'AO', 'ANGOLA', 'nationality', 7);
INSERT INTO `data_type` VALUES (71, 'AI', 'ANGUILLA', 'nationality', 8);
INSERT INTO `data_type` VALUES (72, 'AQ', 'ANTARCTICA', 'nationality', 9);
INSERT INTO `data_type` VALUES (73, 'AG', 'ANTIGUA AND BARBUDA', 'nationality', 10);
INSERT INTO `data_type` VALUES (74, 'AR', 'ARGENTINA', 'nationality', 11);
INSERT INTO `data_type` VALUES (75, 'AM', 'ARMENIA', 'nationality', 12);
INSERT INTO `data_type` VALUES (76, 'AW', 'ARUBA', 'nationality', 13);
INSERT INTO `data_type` VALUES (77, 'AU', 'AUSTRALIA', 'nationality', 14);
INSERT INTO `data_type` VALUES (78, 'AT', 'AUSTRIA', 'nationality', 15);
INSERT INTO `data_type` VALUES (79, 'AZ', 'AZERBAIJAN', 'nationality', 16);
INSERT INTO `data_type` VALUES (80, 'BS', 'BAHAMAS', 'nationality', 17);
INSERT INTO `data_type` VALUES (81, 'BH', 'BAHRAIN', 'nationality', 18);
INSERT INTO `data_type` VALUES (82, 'BD', 'BANGLADESH', 'nationality', 19);
INSERT INTO `data_type` VALUES (83, 'BB', 'BARBADOS', 'nationality', 20);
INSERT INTO `data_type` VALUES (84, 'BY', 'BELARUS', 'nationality', 21);
INSERT INTO `data_type` VALUES (85, 'BE', 'BELGIUM', 'nationality', 22);
INSERT INTO `data_type` VALUES (86, 'BZ', 'BELIZE', 'nationality', 23);
INSERT INTO `data_type` VALUES (87, 'BJ', 'BENIN', 'nationality', 24);
INSERT INTO `data_type` VALUES (88, 'BM', 'BERMUDA', 'nationality', 25);
INSERT INTO `data_type` VALUES (89, 'BT', 'BHUTAN', 'nationality', 26);
INSERT INTO `data_type` VALUES (90, 'BO', 'BOLIVIA', 'nationality', 27);
INSERT INTO `data_type` VALUES (91, 'BA', '	\r\nBOSNIA AND HERZEGOVINA', 'nationality', 28);
INSERT INTO `data_type` VALUES (92, 'BW', '	\r\nBOTSWANA', 'nationality', 29);
INSERT INTO `data_type` VALUES (93, 'BV', 'BOUVET ISLAND', 'nationality', 30);
INSERT INTO `data_type` VALUES (94, 'BR', 'BRAZIL', 'nationality', 31);
INSERT INTO `data_type` VALUES (95, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'nationality', 32);
INSERT INTO `data_type` VALUES (96, 'BN', 'BRUNEI DARUSSALAM', 'nationality', 33);
INSERT INTO `data_type` VALUES (97, 'BG', 'BULGARIA', 'nationality', 34);
INSERT INTO `data_type` VALUES (98, 'BF', 'BURKINA FASO', 'nationality', 35);
INSERT INTO `data_type` VALUES (99, 'BI', 'BURUNDI', 'nationality', 36);
INSERT INTO `data_type` VALUES (100, 'KH', 'CAMBODIA', 'nationality', 37);
INSERT INTO `data_type` VALUES (101, 'CM', 'CAMEROON', 'nationality', 38);
INSERT INTO `data_type` VALUES (102, 'CA', 'CANADA', 'nationality', 39);
INSERT INTO `data_type` VALUES (103, 'CV', 'CAPE VERDE', 'nationality', 40);
INSERT INTO `data_type` VALUES (104, 'KY', 'CAYMAN ISLANDS', 'nationality', 41);
INSERT INTO `data_type` VALUES (105, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'nationality', 42);
INSERT INTO `data_type` VALUES (106, 'TD', 'CHAD', 'nationality', 43);
INSERT INTO `data_type` VALUES (107, 'CL', 'CHILE', 'nationality', 44);
INSERT INTO `data_type` VALUES (108, 'CN', 'CHINA', 'nationality', 45);
INSERT INTO `data_type` VALUES (109, 'CX', 'CHRISTMAS ISLAND', 'nationality', 46);
INSERT INTO `data_type` VALUES (110, 'CC', 'COCOS (KEELING) ISLANDS', 'nationality', 47);
INSERT INTO `data_type` VALUES (111, 'CO', 'COLOMBIA', 'nationality', 48);
INSERT INTO `data_type` VALUES (112, 'KM', 'COMOROS', 'nationality', 49);
INSERT INTO `data_type` VALUES (113, 'CG', 'CONGO', 'nationality', 59);
INSERT INTO `data_type` VALUES (114, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'nationality', 51);
INSERT INTO `data_type` VALUES (115, 'CK', 'COOK ISLANDS', 'nationality', 52);
INSERT INTO `data_type` VALUES (116, 'CR', 'COSTA RICA', 'nationality', 53);
INSERT INTO `data_type` VALUES (117, 'CI', 'CÔTE D\'IVOIRE', 'nationality', 54);
INSERT INTO `data_type` VALUES (118, 'HR', 'CROATIA', 'nationality', 55);
INSERT INTO `data_type` VALUES (119, 'CU', 'CUBA', 'nationality', 56);
INSERT INTO `data_type` VALUES (120, 'CY', 'CYPRUS', 'nationality', 57);
INSERT INTO `data_type` VALUES (121, 'CZ', 'CZECH REPUBLIC', 'nationality', 58);
INSERT INTO `data_type` VALUES (122, 'DK', 'DENMARK', 'nationality', 59);
INSERT INTO `data_type` VALUES (123, 'DJ', 'DJIBOUTI', 'nationality', 60);
INSERT INTO `data_type` VALUES (124, 'DM', 'DOMINICA', 'nationality', 61);
INSERT INTO `data_type` VALUES (125, 'DO', 'DOMINICAN REPUBLIC', 'nationality', 62);
INSERT INTO `data_type` VALUES (126, 'EC', '	\r\nECUADOR', 'nationality', 63);
INSERT INTO `data_type` VALUES (127, 'EG', 'EGYPT', 'nationality', 64);
INSERT INTO `data_type` VALUES (128, 'SV', '	\r\nEL SALVADOR', 'nationality', 65);
INSERT INTO `data_type` VALUES (129, 'GQ', 'EQUATORIAL GUINEA', 'nationality', 66);
INSERT INTO `data_type` VALUES (130, 'ER', 'ERITREA', 'nationality', 67);
INSERT INTO `data_type` VALUES (131, 'EE', 'ESTONIA', 'nationality', 68);
INSERT INTO `data_type` VALUES (132, 'ET', 'ETHIOPIA', 'nationality', 69);
INSERT INTO `data_type` VALUES (133, 'FK', '	\r\nFALKLAND ISLANDS (MALVINAS)', 'nationality', 70);
INSERT INTO `data_type` VALUES (134, 'FO', 'FAROE ISLANDS', 'nationality', 71);
INSERT INTO `data_type` VALUES (135, 'FJ', 'FIJI', 'nationality', 72);
INSERT INTO `data_type` VALUES (136, 'FI', 'FINLAND', 'nationality', 73);
INSERT INTO `data_type` VALUES (137, 'FR', 'FRANCE', 'nationality', 74);
INSERT INTO `data_type` VALUES (138, 'GF', 'FRENCH GUIANA', 'nationality', 75);
INSERT INTO `data_type` VALUES (139, 'PF', 'FRENCH POLYNESIA', 'nationality', 76);
INSERT INTO `data_type` VALUES (140, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'nationality', 77);
INSERT INTO `data_type` VALUES (141, 'GA', 'GABON', 'nationality', 78);
INSERT INTO `data_type` VALUES (142, 'GM', 'GAMBIA', 'nationality', 79);
INSERT INTO `data_type` VALUES (143, 'GE', 'GEORGIA', 'nationality', 80);
INSERT INTO `data_type` VALUES (144, 'DE', 'GERMANY', 'nationality', 81);
INSERT INTO `data_type` VALUES (145, 'GH', 'GHANA', 'nationality', 82);
INSERT INTO `data_type` VALUES (146, 'GI', 'GIBRALTAR', 'nationality', 83);
INSERT INTO `data_type` VALUES (147, 'GR', 'GREECE', 'nationality', 84);
INSERT INTO `data_type` VALUES (148, 'GL', 'GREENLAND', 'nationality', 85);
INSERT INTO `data_type` VALUES (149, 'GD', 'GRENADA', 'nationality', 86);
INSERT INTO `data_type` VALUES (150, 'GP', '	\r\nGUADELOUPE', 'nationality', 87);
INSERT INTO `data_type` VALUES (151, 'GU', 'GUAM', 'nationality', 88);
INSERT INTO `data_type` VALUES (152, 'GT', 'GUATEMALA', 'nationality', 89);
INSERT INTO `data_type` VALUES (153, 'GN', 'GUINEA', 'nationality', 90);
INSERT INTO `data_type` VALUES (154, 'GW', 'GUINEA-BISSAU', 'nationality', 91);
INSERT INTO `data_type` VALUES (155, 'GY', 'GUYANA', 'nationality', 92);
INSERT INTO `data_type` VALUES (156, 'HT', 'HAITI', 'nationality', 93);
INSERT INTO `data_type` VALUES (157, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'nationality', 94);
INSERT INTO `data_type` VALUES (158, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'nationality', 95);
INSERT INTO `data_type` VALUES (159, 'HN', 'HONDURAS', 'nationality', 96);
INSERT INTO `data_type` VALUES (160, 'HK', 'HONG KONG', 'nationality', 97);
INSERT INTO `data_type` VALUES (161, 'HU', 'HUNGARY', 'nationality', 98);
INSERT INTO `data_type` VALUES (162, 'IS', 'ICELAND', 'nationality', 99);
INSERT INTO `data_type` VALUES (163, 'IN', 'INDIA', 'nationality', 100);
INSERT INTO `data_type` VALUES (164, 'ID', 'INDONESIA', 'nationality', 101);
INSERT INTO `data_type` VALUES (165, 'IR', '	\r\nIRAN, ISLAMIC REPUBLIC OF', 'nationality', 102);
INSERT INTO `data_type` VALUES (166, 'IQ', '	\r\nIRAQ', 'nationality', 103);
INSERT INTO `data_type` VALUES (167, 'IE', 'IRELAND', 'nationality', 104);
INSERT INTO `data_type` VALUES (168, 'IL', 'ISRAEL', 'nationality', 105);
INSERT INTO `data_type` VALUES (169, 'IT', 'ITALY', 'nationality', 106);
INSERT INTO `data_type` VALUES (170, 'JM', 'JAMAICA', 'nationality', 107);
INSERT INTO `data_type` VALUES (171, 'JP', 'JAPAN', 'nationality', 108);
INSERT INTO `data_type` VALUES (172, 'JO', 'JORDAN', 'nationality', 109);
INSERT INTO `data_type` VALUES (173, 'KZ', 'KAZAKHSTAN', 'nationality', 110);
INSERT INTO `data_type` VALUES (174, 'KE', 'KENYA', 'nationality', 111);
INSERT INTO `data_type` VALUES (175, 'KI', 'KIRIBATI', 'nationality', 112);
INSERT INTO `data_type` VALUES (176, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'nationality', 113);
INSERT INTO `data_type` VALUES (177, 'KR', 'KOREA, REPUBLIC OF', 'nationality', 114);
INSERT INTO `data_type` VALUES (178, 'KW', 'KUWAIT', 'nationality', 115);
INSERT INTO `data_type` VALUES (179, 'KG', 'KYRGYZSTAN', 'nationality', 116);
INSERT INTO `data_type` VALUES (180, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'nationality', 117);
INSERT INTO `data_type` VALUES (181, 'LV', 'LATVIA', 'nationality', 118);
INSERT INTO `data_type` VALUES (182, 'LB', 'LEBANON', 'nationality', 119);
INSERT INTO `data_type` VALUES (183, 'LS', 'LESOTHO', 'nationality', 120);
INSERT INTO `data_type` VALUES (184, 'LR', 'LIBERIA', 'nationality', 121);
INSERT INTO `data_type` VALUES (185, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'nationality', 122);
INSERT INTO `data_type` VALUES (186, 'LI', 'LIECHTENSTEIN', 'nationality', 123);
INSERT INTO `data_type` VALUES (187, 'LT', 'LITHUANIA', 'nationality', 124);
INSERT INTO `data_type` VALUES (188, 'LU', 'LUXEMBOURG', 'nationality', 125);
INSERT INTO `data_type` VALUES (189, 'MO', '	\r\nMACAO', 'nationality', 126);
INSERT INTO `data_type` VALUES (190, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'nationality', 127);
INSERT INTO `data_type` VALUES (191, 'MG', 'MADAGASCAR', 'nationality', 128);
INSERT INTO `data_type` VALUES (192, 'MW', 'MALAWI', 'nationality', 129);
INSERT INTO `data_type` VALUES (193, 'MY', 'MALAYSIA', 'nationality', 130);
INSERT INTO `data_type` VALUES (194, 'MV', 'MALDIVES', 'nationality', 131);
INSERT INTO `data_type` VALUES (195, 'ML', 'MALI', 'nationality', 132);
INSERT INTO `data_type` VALUES (196, 'MT', 'MALTA', 'nationality', 133);
INSERT INTO `data_type` VALUES (197, 'MH', '	\r\nMARSHALL ISLANDS', 'nationality', 134);
INSERT INTO `data_type` VALUES (198, 'MQ', 'MARTINIQUE', 'nationality', 135);
INSERT INTO `data_type` VALUES (199, 'MR', 'MAURITANIA', 'nationality', 136);
INSERT INTO `data_type` VALUES (200, 'MU', 'MAURITIUS', 'nationality', 137);
INSERT INTO `data_type` VALUES (201, 'YT', 'MAYOTTE', 'nationality', 138);
INSERT INTO `data_type` VALUES (202, 'MX', 'MEXICO', 'nationality', 139);
INSERT INTO `data_type` VALUES (203, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'nationality', 140);
INSERT INTO `data_type` VALUES (204, 'MD', 'MOLDOVA, REPUBLIC OF', 'nationality', 141);
INSERT INTO `data_type` VALUES (205, 'MC', 'MONACO', 'nationality', 142);
INSERT INTO `data_type` VALUES (206, 'MN', 'MONGOLIA', 'nationality', 143);
INSERT INTO `data_type` VALUES (207, 'MS', 'MONTSERRAT', 'nationality', 144);
INSERT INTO `data_type` VALUES (208, 'MA', 'MOROCCO', 'nationality', 145);
INSERT INTO `data_type` VALUES (209, 'MZ', 'MOZAMBIQUE', 'nationality', 146);
INSERT INTO `data_type` VALUES (210, 'MM', 'MYANMAR', 'nationality', 147);
INSERT INTO `data_type` VALUES (211, 'NA', 'NAMIBIA', 'nationality', 148);
INSERT INTO `data_type` VALUES (212, 'NR', 'NAURU', 'nationality', 149);
INSERT INTO `data_type` VALUES (213, 'NP', 'NEPAL', 'nationality', 150);
INSERT INTO `data_type` VALUES (214, 'NL', 'NETHERLANDS', 'nationality', 151);
INSERT INTO `data_type` VALUES (215, 'AN', 'NETHERLANDS ANTILLES', 'nationality', 152);
INSERT INTO `data_type` VALUES (216, 'NC', 'NEW CALEDONIA', 'nationality', 153);
INSERT INTO `data_type` VALUES (217, 'NZ', 'NEW ZEALAND', 'nationality', 154);
INSERT INTO `data_type` VALUES (218, 'NI', 'NICARAGUA', 'nationality', 155);
INSERT INTO `data_type` VALUES (219, 'NE', 'NIGER', 'nationality', 156);
INSERT INTO `data_type` VALUES (220, 'NG', 'NIGERIA', 'nationality', 157);
INSERT INTO `data_type` VALUES (221, 'NU', 'NIUE', 'nationality', 158);
INSERT INTO `data_type` VALUES (222, 'NF', 'NORFOLK ISLAND', 'nationality', 159);
INSERT INTO `data_type` VALUES (223, 'MP', '	\r\nNORTHERN MARIANA ISLANDS', 'nationality', 160);
INSERT INTO `data_type` VALUES (224, 'NO', 'NORWAY', 'nationality', 161);
INSERT INTO `data_type` VALUES (225, 'OM', 'OMAN', 'nationality', 162);
INSERT INTO `data_type` VALUES (226, 'PK', 'PAKISTAN', 'nationality', 163);
INSERT INTO `data_type` VALUES (227, 'PW', 'PALAU', 'nationality', 164);
INSERT INTO `data_type` VALUES (228, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'nationality', 165);
INSERT INTO `data_type` VALUES (229, 'PA', 'PANAMA', 'nationality', 166);
INSERT INTO `data_type` VALUES (230, 'PG', '	\r\nPAPUA NEW GUINEA', 'nationality', 167);
INSERT INTO `data_type` VALUES (231, 'PY', 'PARAGUAY', 'nationality', 168);
INSERT INTO `data_type` VALUES (232, 'PE', 'PERU', 'nationality', 169);
INSERT INTO `data_type` VALUES (233, 'PH', 'PHILIPPINES', 'nationality', 170);
INSERT INTO `data_type` VALUES (234, 'PN', 'PITCAIRN', 'nationality', 171);
INSERT INTO `data_type` VALUES (235, 'PL', 'POLAND', 'nationality', 172);
INSERT INTO `data_type` VALUES (236, 'PT', 'PORTUGAL', 'nationality', 173);
INSERT INTO `data_type` VALUES (237, 'PR', 'PUERTO RICO', 'nationality', 174);
INSERT INTO `data_type` VALUES (238, 'QA', 'QATAR', 'nationality', 175);
INSERT INTO `data_type` VALUES (239, 'RE', 'RÉUNION', 'nationality', 176);
INSERT INTO `data_type` VALUES (240, 'RO', 'ROMANIA', 'nationality', 177);
INSERT INTO `data_type` VALUES (241, 'RU', 'RUSSIAN FEDERATION', 'nationality', 178);
INSERT INTO `data_type` VALUES (242, 'RW', 'RWANDA', 'nationality', 179);
INSERT INTO `data_type` VALUES (243, 'SH', 'SAINT HELENA', 'nationality', 180);
INSERT INTO `data_type` VALUES (244, 'KN', 'SAINT KITTS AND NEVIS', 'nationality', 181);
INSERT INTO `data_type` VALUES (245, 'LC', 'SAINT LUCIA', 'nationality', 182);
INSERT INTO `data_type` VALUES (246, 'PM', 'SAINT PIERRE AND MIQUELON', 'nationality', 183);
INSERT INTO `data_type` VALUES (247, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'nationality', 184);
INSERT INTO `data_type` VALUES (248, 'WS', 'SAMOA', 'nationality', 185);
INSERT INTO `data_type` VALUES (249, 'SM', '	\r\nSAN MARINO', 'nationality', 186);
INSERT INTO `data_type` VALUES (250, 'ST', 'SAO TOME AND PRINCIPE', 'nationality', 187);
INSERT INTO `data_type` VALUES (251, 'SA', 'SAUDI ARABIA', 'nationality', 188);
INSERT INTO `data_type` VALUES (252, 'SN', 'SENEGAL', 'nationality', 189);
INSERT INTO `data_type` VALUES (253, 'CS', '	\r\nSERBIA AND MONTENEGRO', 'nationality', 190);
INSERT INTO `data_type` VALUES (254, 'SC', 'SEYCHELLES', 'nationality', 191);
INSERT INTO `data_type` VALUES (255, 'SL', 'SIERRA LEONE', 'nationality', 192);
INSERT INTO `data_type` VALUES (256, 'SG', 'SINGAPORE', 'nationality', 193);
INSERT INTO `data_type` VALUES (257, 'SK', 'SLOVAKIA', 'nationality', 194);
INSERT INTO `data_type` VALUES (258, 'SI', 'SLOVENIA', 'nationality', 195);
INSERT INTO `data_type` VALUES (259, 'SB', 'SOLOMON ISLANDS', 'nationality', 196);
INSERT INTO `data_type` VALUES (260, 'SO', 'SOMALIA', 'nationality', 197);
INSERT INTO `data_type` VALUES (261, 'ZA', 'SOUTH AFRICA', 'nationality', 198);
INSERT INTO `data_type` VALUES (262, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'nationality', 199);
INSERT INTO `data_type` VALUES (263, 'ES', 'SPAIN', 'nationality', 200);
INSERT INTO `data_type` VALUES (264, 'LK', 'SRI LANKA', 'nationality', 201);
INSERT INTO `data_type` VALUES (265, 'SD', 'SUDAN', 'nationality', 202);
INSERT INTO `data_type` VALUES (266, 'SR', 'SURINAME', 'nationality', 203);
INSERT INTO `data_type` VALUES (267, 'SJ', 'SVALBARD AND JAN MAYEN', 'nationality', 204);
INSERT INTO `data_type` VALUES (268, 'SZ', 'SWAZILAND', 'nationality', 205);
INSERT INTO `data_type` VALUES (269, 'SE', 'SWEDEN', 'nationality', 206);
INSERT INTO `data_type` VALUES (270, 'CH', 'SWITZERLAND', 'nationality', 207);
INSERT INTO `data_type` VALUES (271, 'SY', 'SYRIAN ARAB REPUBLIC', 'nationality', 208);
INSERT INTO `data_type` VALUES (272, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'nationality', 209);
INSERT INTO `data_type` VALUES (273, 'TJ', 'TAJIKISTAN', 'nationality', 210);
INSERT INTO `data_type` VALUES (274, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'nationality', 211);
INSERT INTO `data_type` VALUES (275, 'TH', 'THAILAND', 'nationality', 212);
INSERT INTO `data_type` VALUES (276, 'TL', 'TIMOR-LESTE', 'nationality', 213);
INSERT INTO `data_type` VALUES (277, 'TG', 'TOGO', 'nationality', 214);
INSERT INTO `data_type` VALUES (278, 'TK', 'TOKELAU', 'nationality', 215);
INSERT INTO `data_type` VALUES (279, 'TO', 'TONGA', 'nationality', 216);
INSERT INTO `data_type` VALUES (280, 'TT', '	\r\nTRINIDAD AND TOBAGO', 'nationality', 217);
INSERT INTO `data_type` VALUES (281, 'TN', 'TUNISIA', 'nationality', 218);
INSERT INTO `data_type` VALUES (282, 'TR', 'TURKEY', 'nationality', 219);
INSERT INTO `data_type` VALUES (283, 'TM', 'TURKMENISTAN', 'nationality', 220);
INSERT INTO `data_type` VALUES (284, 'TC', 'TURKS AND CAICOS ISLANDS', 'nationality', 221);
INSERT INTO `data_type` VALUES (285, 'TV', 'TUVALU', 'nationality', 222);
INSERT INTO `data_type` VALUES (286, 'UG', 'UGANDA', 'nationality', 223);
INSERT INTO `data_type` VALUES (287, 'UA', 'UKRAINE', 'nationality', 224);
INSERT INTO `data_type` VALUES (288, 'AE', 'UNITED ARAB EMIRATES', 'nationality', 225);
INSERT INTO `data_type` VALUES (289, 'GB', 'UNITED KINGDOM', 'nationality', 226);
INSERT INTO `data_type` VALUES (290, 'US', 'UNITED STATES', 'nationality', 227);
INSERT INTO `data_type` VALUES (291, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'nationality', 228);
INSERT INTO `data_type` VALUES (292, 'UY', 'URUGUAY', 'nationality', 229);
INSERT INTO `data_type` VALUES (293, 'UZ', 'UZBEKISTAN', 'nationality', 230);
INSERT INTO `data_type` VALUES (294, 'VU', 'VANUATU', 'nationality', 231);
INSERT INTO `data_type` VALUES (295, 'VA', '	\r\nVatican City State see HOLY SEE', 'nationality', 232);
INSERT INTO `data_type` VALUES (296, 'VE', 'VENEZUELA', 'nationality', 233);
INSERT INTO `data_type` VALUES (297, 'VN', 'VIET NAM', 'nationality', 234);
INSERT INTO `data_type` VALUES (298, 'VG', 'VIRGIN ISLANDS, BRITISH', 'nationality', 235);
INSERT INTO `data_type` VALUES (299, 'VI', 'VIRGIN ISLANDS, U.S.', 'nationality', 236);
INSERT INTO `data_type` VALUES (300, 'WF', 'WALLIS AND FUTUNA', 'nationality', 237);
INSERT INTO `data_type` VALUES (301, 'EH', 'WESTERN SAHARA', 'nationality', 238);
INSERT INTO `data_type` VALUES (302, 'YE', 'YEMEN', 'nationality', 239);
INSERT INTO `data_type` VALUES (303, 'ZM', 'ZAMBIA', 'nationality', 240);
INSERT INTO `data_type` VALUES (304, 'ZW', 'ZIMBABWE', 'nationality', 241);
INSERT INTO `data_type` VALUES (305, 'K', 'Kinh', 'nation', 1);
INSERT INTO `data_type` VALUES (306, 'T', 'Tày', 'nation', 2);
INSERT INTO `data_type` VALUES (307, NULL, 'Thái', 'nation', 3);
INSERT INTO `data_type` VALUES (308, NULL, 'Hoa', 'nation', 4);
INSERT INTO `data_type` VALUES (309, NULL, 'Khơ-me', 'nation', 5);
INSERT INTO `data_type` VALUES (310, NULL, 'Mường', 'nation', 6);
INSERT INTO `data_type` VALUES (311, NULL, 'Nùng', 'nation', 7);
INSERT INTO `data_type` VALUES (312, NULL, 'HMông', 'nation', 8);
INSERT INTO `data_type` VALUES (313, NULL, 'Dao', 'nation', 9);
INSERT INTO `data_type` VALUES (314, NULL, 'Gia-rai', 'nation', 10);
INSERT INTO `data_type` VALUES (315, NULL, 'Ngái', 'nation', 11);
INSERT INTO `data_type` VALUES (316, NULL, 'Ê-đê', 'nation', 12);
INSERT INTO `data_type` VALUES (317, NULL, 'Ba na', 'nation', 13);
INSERT INTO `data_type` VALUES (318, NULL, 'Xơ-Đăng', 'nation', 14);
INSERT INTO `data_type` VALUES (319, NULL, 'Sán Chay', 'nation', 15);
INSERT INTO `data_type` VALUES (320, NULL, 'Cơ-ho', 'nation', 16);
INSERT INTO `data_type` VALUES (321, NULL, 'Chăm', 'nation', 17);
INSERT INTO `data_type` VALUES (322, NULL, 'Sán Dìu', 'nation', 18);
INSERT INTO `data_type` VALUES (323, NULL, 'Hrê', 'nation', 19);
INSERT INTO `data_type` VALUES (324, NULL, 'Mnông', 'nation', 20);
INSERT INTO `data_type` VALUES (325, NULL, 'Ra-glai', 'nation', 21);
INSERT INTO `data_type` VALUES (326, NULL, 'Xtiêng', 'nation', 22);
INSERT INTO `data_type` VALUES (327, NULL, 'Bru-Vân Kiều', 'nation', 23);
INSERT INTO `data_type` VALUES (328, NULL, 'Thổ', 'nation', 24);
INSERT INTO `data_type` VALUES (329, NULL, 'Giáy', 'nation', 25);
INSERT INTO `data_type` VALUES (330, NULL, 'Cơ-tu', 'nation', 26);
INSERT INTO `data_type` VALUES (331, NULL, 'Gié Triêng', 'nation', 27);
INSERT INTO `data_type` VALUES (332, NULL, 'Mạ', 'nation', 28);
INSERT INTO `data_type` VALUES (333, NULL, 'Khơ-mú', 'nation', 29);
INSERT INTO `data_type` VALUES (334, NULL, 'Co', 'nation', 30);
INSERT INTO `data_type` VALUES (335, NULL, 'Tà-ôi', 'nation', 31);
INSERT INTO `data_type` VALUES (336, NULL, 'Chơ-ro', 'nation', 32);
INSERT INTO `data_type` VALUES (337, NULL, 'Kháng', 'nation', 33);
INSERT INTO `data_type` VALUES (338, NULL, 'Xinh-mun', 'nation', 34);
INSERT INTO `data_type` VALUES (339, NULL, 'Hà Nhì', 'nation', 35);
INSERT INTO `data_type` VALUES (340, NULL, 'Chu ru', 'nation', 36);
INSERT INTO `data_type` VALUES (341, NULL, 'Lào', 'nation', 37);
INSERT INTO `data_type` VALUES (342, NULL, 'La Chí', 'nation', 38);
INSERT INTO `data_type` VALUES (343, NULL, 'La Ha', 'nation', 39);
INSERT INTO `data_type` VALUES (344, NULL, 'Phù Lá', 'nation', 40);
INSERT INTO `data_type` VALUES (345, NULL, 'La Hủ', 'nation', 41);
INSERT INTO `data_type` VALUES (346, NULL, 'Lự', 'nation', 42);
INSERT INTO `data_type` VALUES (347, NULL, 'Lô Lô', 'nation', 43);
INSERT INTO `data_type` VALUES (348, NULL, 'Chứt', 'nation', 44);
INSERT INTO `data_type` VALUES (349, NULL, 'Mảng', 'nation', 45);
INSERT INTO `data_type` VALUES (350, NULL, 'Pà Thẻn', 'nation', 46);
INSERT INTO `data_type` VALUES (351, NULL, 'Co Lao', 'nation', 47);
INSERT INTO `data_type` VALUES (352, NULL, 'Cống', 'nation', 48);
INSERT INTO `data_type` VALUES (353, NULL, 'Bố Y', 'nation', 49);
INSERT INTO `data_type` VALUES (354, NULL, 'Si La', 'nation', 50);
INSERT INTO `data_type` VALUES (355, NULL, 'Pu Péo', 'nation', 51);
INSERT INTO `data_type` VALUES (356, NULL, 'Brâu', 'nation', 52);
INSERT INTO `data_type` VALUES (357, NULL, 'Ơ Đu', 'nation', 53);
INSERT INTO `data_type` VALUES (358, NULL, 'Rơ măm', 'nation', 54);
INSERT INTO `data_type` VALUES (359, NULL, 'Người nước ngoài', 'nation', 55);
INSERT INTO `data_type` VALUES (360, NULL, 'Bố', 'family_relationship', 1);
INSERT INTO `data_type` VALUES (361, NULL, 'Mẹ', 'family_relationship', 2);
INSERT INTO `data_type` VALUES (362, NULL, 'Bố nuôi', 'family_relationship', 3);
INSERT INTO `data_type` VALUES (363, NULL, 'Mẹ nuôi', 'family_relationship', 4);
INSERT INTO `data_type` VALUES (364, NULL, 'Bố vợ/chồng', 'family_relationship', 5);
INSERT INTO `data_type` VALUES (365, NULL, 'Mẹ vợ/chồng', 'family_relationship', 6);
INSERT INTO `data_type` VALUES (366, NULL, 'Anh trai', 'family_relationship', 7);
INSERT INTO `data_type` VALUES (367, NULL, 'Em trai', 'family_relationship', 8);
INSERT INTO `data_type` VALUES (368, NULL, 'Chị gái', 'family_relationship', 9);
INSERT INTO `data_type` VALUES (369, NULL, 'Em gái', 'family_relationship', 10);
INSERT INTO `data_type` VALUES (370, NULL, 'Vợ/Chồng', 'family_relationship', 11);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_code` char(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `department_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '1: Hiệu lực  2: Hết hiệu lực',
  PRIMARY KEY (`department_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (0, 'KT', 'Phòng kỹ thuật', NULL, '2020-09-02 12:51:27', NULL, NULL, NULL);
INSERT INTO `department` VALUES (1, 'HC', 'Phòng Hành chính', '2020-09-02 12:43:57', '2020-09-02 12:53:54', NULL, NULL, NULL);
INSERT INTO `department` VALUES (3, 'KD', 'Phòng Kinh doanh', '2020-09-02 12:43:57', '2020-09-02 12:54:03', NULL, NULL, NULL);
INSERT INTO `department` VALUES (4, 'TCKT', 'Phòng Tài chính Kế toán', '2020-09-02 12:43:57', '2020-09-02 12:53:42', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `gender` enum('male','female','other') CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `phone_number` char(12) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `place_of_birth` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'địa chỉ thường trú',
  `current_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'địa chỉ hiện tại',
  `home_town` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'Quê quán',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `academic_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'trinh do hoc van ',
  `foreign_language` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'ngoai ngu',
  `province_id` int(11) NULL DEFAULT NULL COMMENT 'tỉnh thành ',
  `nationality_id` int(11) NULL DEFAULT NULL COMMENT 'quốc tịch',
  `nation_id` int(11) NULL DEFAULT NULL COMMENT 'dân tộc',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '1: Làm  0: nghỉ việc ',
  `identity_card_number` char(15) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `get_married` tinyint(1) NULL DEFAULT NULL COMMENT '1: đã kết hôn   0: chưa kết hôn ',
  `img` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `date_of_issue` date NULL DEFAULT NULL COMMENT 'ngày cấp cmnd',
  `place_of_issue` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'nơi cấp',
  `date_union` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày vào Đoàn',
  `place_union` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `date_party` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày vào Đảng',
  `place_party` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `religion` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'Tôn giáo',
  PRIMARY KEY (`employee_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (1, 'NV001', 'Nguyễn Văn Minh', 'male', '1990-08-29', '016698756445', 'Hà Nội', 'ngõ 68 Phú Diễn - quận Bắc Từ Liêm - Hà Nội', 'ngõ 68 Phú Diễn - quận Bắc Từ Liêm - Hà Nội', 'xã Hồng Minh - huyện Hưng Hà - tỉnh Thái Bình', 'vanminh@gmail.com', 'Đại học Giao Thông Vận Tải', 'Tiếng Anh ', 62, 297, 305, 1, '001199000674', 0, NULL, '2020-09-02 11:08:30', '2020-11-08 16:22:52', NULL, NULL, '2013-08-31', 'CA Hà Nội', '2020-09-12 12:13:50', 'THCS Cầu Diễn', '2015-09-03 12:14:38', 'THPT Thượng Cát', 'Không');
INSERT INTO `employees` VALUES (2, 'NV002', 'Nguyễn Văn Nam', 'male', '1997-01-05', '016369879986', 'Hà Nội', 'Hà Nội ', 'Hà Nội', 'Thái Bình', 'vannamgmail.com', 'Đại học Quốc Gia Hà Nội', 'Tiếng Anh ', 62, 297, 305, 1, '001199000674', 0, NULL, '2020-09-02 11:08:30', '2020-11-08 16:22:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không');
INSERT INTO `employees` VALUES (3, 'NV003', 'Trần Huyền Trang', 'female', '1997-08-02', '092147483647', 'Hà Nội', 'Hà Nội ', 'Hà Nội', 'Thái Bình', 'huyentrang@gmail.com', 'Đại học Thương Mại Hà Nội', 'Tiếng Anh ', 62, 297, 305, 1, '001199000674', 0, NULL, '2020-09-02 11:08:30', '2020-11-08 16:23:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không');
INSERT INTO `employees` VALUES (4, 'NV004', 'Đặng Quang Dũng', 'male', '1997-08-02', '091369423345', 'Hà Nội', 'Hà Nội ', 'Hà Nội', 'Thái Bình', 'dungquang@gmail.com', 'Đại học Bách Khoa Hà Nội', 'Tiếng Anh ', 62, 297, 305, 1, '001199000674', 1, NULL, '2020-09-02 11:08:30', '2020-11-08 16:23:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không');
INSERT INTO `employees` VALUES (6, 'NV005', 'Nguyen Duong', 'female', '2020-11-01', '0379659846', 'Hà Nội', 'Hà Nội', 'Hà Nội', 'hanoi', 'duongnguyen5199@gmail.com', 'Đại học', NULL, NULL, 297, 305, 1, '001199000647', 1, 'nu4.jpg', '2020-11-08 09:20:08', '2020-11-08 16:31:27', NULL, NULL, NULL, 'Hà Nội', '2020-11-01 00:00:00', 'HN', '2020-11-01 00:00:00', 'HN', 'Không có');
INSERT INTO `employees` VALUES (7, 'NV006', 'Đinh Mai Thanh', 'female', '2020-11-01', '1699384', 'Thượng Cát', 'Hà Nội', 'Hà Nội', 'hanoi', 'duongnguyen5199@gmail.com', 'Đại học', NULL, NULL, 297, 305, 1, '001199009632', 1, 'nu1.jpg', '2020-11-08 09:49:01', '2020-11-08 16:49:21', NULL, NULL, NULL, 'Hà Nội', '2020-11-01 00:00:00', 'HN', '2020-11-01 00:00:00', 'HN', 'Không có');
INSERT INTO `employees` VALUES (8, 'NV007', 'Nguyễn Châu Giang', 'female', '2020-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, 64, 305, 1, NULL, 0, NULL, '2020-11-08 09:58:49', '2020-12-18 12:02:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `employees` VALUES (9, 'NV008', 'Hoàng Minh Quân', 'male', '2009-03-30', NULL, 'Hà Nội', NULL, NULL, NULL, 'MinhQuan2009@gmail.com', NULL, NULL, NULL, 297, 305, 1, NULL, 0, 'nu4.jpg', '2020-11-08 10:00:45', '2020-11-08 20:08:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `employees` VALUES (10, 'NV009', 'test', 'female', '2020-11-01', '0123456789', 'HN', 'HN', 'HN', 'HN', 'test123@gmail.com', 'Đại học ', 'Tiếng Anh', 62, 297, 305, 1, NULL, 0, 'nu4.jpg', '2020-11-08 10:47:46', '2020-12-18 12:01:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `employees` VALUES (11, 'NV0010', 'Nguyen Duong', 'female', '2020-12-17', '1699384', 'Hà Nội', 'Hà Nội', 'Hà Nội', 'hanoi', 'duongnguyen5199@gmail.com', 'Đại học Bách Khoa Hà Nội', 'Tiếng Anh ', 62, 297, 305, 1, '001199000689', 0, NULL, '2020-12-17 15:18:43', '2020-12-18 11:51:48', NULL, NULL, '2013-08-31', 'CA Hà Nội', '2020-09-12 12:13:50', 'THCS Cầu Diễn', '2015-09-03 12:14:38', 'THPT Thượng Cát', 'Không');
INSERT INTO `employees` VALUES (12, 'NV0011', 'Phan Thu Huyền', 'female', '1999-12-02', NULL, 'Hà Nội', 'Hà Nội', 'Hà Nội', 'Nghệ An', NULL, NULL, NULL, 62, 297, 305, 1, NULL, 0, NULL, '2020-12-18 05:19:25', '2020-12-18 12:21:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không');

-- ----------------------------
-- Table structure for family_relationship
-- ----------------------------
DROP TABLE IF EXISTS `family_relationship`;
CREATE TABLE `family_relationship`  (
  `family_relationship_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` int(11) NULL DEFAULT NULL,
  `employee_id` int(11) NULL DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `dob` int(4) NULL DEFAULT NULL,
  `job` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `work_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `phone_number` char(12) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `place_of_birth` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'Nơi sinh',
  `permanent_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'địa chỉ thường trú',
  `current_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'địa chỉ hiện tại',
  `work_phone_number` char(12) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'sdt cơ quan',
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'ghi chú',
  PRIMARY KEY (`family_relationship_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of family_relationship
-- ----------------------------
INSERT INTO `family_relationship` VALUES (1, 360, 1, 'Nguyễn Văn Quang', 1960, 'Tự do', 'Không có', '0976634985', '2020-09-08 08:50:17', '2020-09-12 17:12:22', NULL, NULL, 'Thái Bình', 'Phú Diễn-Bắc Từ Liêm-Hà Nội', 'Phú Diễn-Bắc Từ Liêm-Hà Nội', '064322121499', NULL);
INSERT INTO `family_relationship` VALUES (2, 361, 1, 'Hoàng Thị Hồng 1', 1965, 'Tự do', 'Không có', '0972234682', '2020-09-08 08:50:17', '2020-09-12 17:12:26', NULL, NULL, 'Nam Định', 'Phú Diễn-Bắc Từ Liêm-Hà Nội', 'Phú Diễn-Bắc Từ Liêm-Hà Nội', '097864855627', NULL);
INSERT INTO `family_relationship` VALUES (3, 366, 1, 'Nguyễn Văn Khang', 1993, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-09-08 08:50:17', '2020-09-12 17:12:28', NULL, NULL, 'Hải Phòng', 'Phú Diễn-Bắc Từ Liêm-Hà Nội', 'Phú Diễn-Bắc Từ Liêm-Hà Nội', '031364987547', NULL);
INSERT INTO `family_relationship` VALUES (4, 360, 3, 'Trần Văn Quang', 1960, 'Tự do', 'Không có', '0976634985', '2020-09-08 08:50:17', '2020-09-12 17:12:31', NULL, NULL, 'Thanh Hóa', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '097864855627', NULL);
INSERT INTO `family_relationship` VALUES (5, 361, 3, 'Hoàng Thị Hồng 3', 1965, 'Tự do', 'Không có', '0972234682', '2020-09-08 08:50:17', '2020-09-12 17:12:36', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322121499', NULL);
INSERT INTO `family_relationship` VALUES (6, 366, 3, 'Trần Văn Khang', 1993, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-09-08 08:50:17', '2020-09-12 17:12:39', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322165875', NULL);
INSERT INTO `family_relationship` VALUES (7, 360, 10, 'tên thân nhân', 1234, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-11-08 12:43:32', '2020-11-08 21:30:10', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322165875', NULL);
INSERT INTO `family_relationship` VALUES (8, 368, 11, 'Nguyen Duong', 1999, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-12-17 15:19:23', '2020-12-18 11:50:09', NULL, NULL, 'Hà Nội', 'Hà Nội', 'Hà Nội', '016446633264', NULL);
INSERT INTO `family_relationship` VALUES (9, 366, 6, 'Trần Văn Khang', 1993, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-09-08 08:50:17', '2020-09-12 17:12:39', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322165875', NULL);
INSERT INTO `family_relationship` VALUES (10, 366, 7, 'Trần Văn Khang', 1993, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-09-08 08:50:17', '2020-09-12 17:12:39', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322165875', NULL);
INSERT INTO `family_relationship` VALUES (11, 360, 8, 'tên thân nhân', 1234, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-11-08 12:43:32', '2020-11-08 21:30:10', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322165875', NULL);
INSERT INTO `family_relationship` VALUES (12, 360, 9, 'tên thân nhân', 1234, 'Kỹ sư', 'Hà Nội', '01639876646', '2020-11-08 12:43:32', '2020-11-08 21:30:10', NULL, NULL, 'Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', 'Cầu Giấy-Nam Từ Liêm-Hà Nội', '064322165875', NULL);
INSERT INTO `family_relationship` VALUES (13, 368, 12, 'Nguyen Duong', 1999, 'Sinh viên', NULL, '1699384', '2020-12-18 05:20:07', '2020-12-18 05:20:07', NULL, NULL, 'Hà Nội', 'Hà Nội', 'Hà Nội', NULL, NULL);

-- ----------------------------
-- Table structure for insurrance
-- ----------------------------
DROP TABLE IF EXISTS `insurrance`;
CREATE TABLE `insurrance`  (
  `insurrance_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `social_insurance_number` char(11) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `date_of_issue_soc` date NULL DEFAULT NULL,
  `place_of_issue_soc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `health_insurance_number` char(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `date_of_issue_health` date NULL DEFAULT NULL,
  `place_of_issue_health` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`insurrance_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of insurrance
-- ----------------------------
INSERT INTO `insurrance` VALUES (1, 1, '', '0000-00-00', '', 'DN4010000000001', '2013-10-08', 'Bệnh viện y học cổ truyền', '2013-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (2, 2, '', '0000-00-00', '', 'DN4010000000002', '2013-10-08', 'Bệnh viện y học cổ truyền', '2013-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (3, 3, '', '0000-00-00', '', 'DN4010000000003', '2013-10-08', 'Bệnh viện y học cổ truyền', '2013-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (4, 4, '', '0000-00-00', '', 'DN4010000000004', '2013-10-08', 'Bệnh viện y học cổ truyền', '2013-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (5, 1, '', '0000-00-00', '', 'DN4010000000001', '2014-10-08', 'Bệnh viện y học cổ truyền', '2014-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (6, 1, '', '0000-00-00', '', 'DN4010000000001', '2015-10-08', 'Bệnh viện y học cổ truyền', '2015-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (7, 1, '', '0000-00-00', '', 'DN4010000000001', '2016-10-08', 'Bệnh viện y học cổ truyền', '2016-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (8, 1, '', '0000-00-00', '', 'DN4010000000001', '2017-10-08', 'Bệnh viện y học cổ truyền', '2017-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (9, 1, '', '0000-00-00', '', 'DN4010000000001', '2018-10-08', 'Bệnh viện y học cổ truyền', '2018-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (10, 1, '', '0000-00-00', '', 'DN4010000000001', '2019-10-08', 'Bệnh viện y học cổ truyền', '2019-10-08 09:27:49', '2020-10-08 09:29:18', NULL, NULL);
INSERT INTO `insurrance` VALUES (11, 1, '', '0000-00-00', '', 'DN4010000000001', '2020-10-08', 'Bệnh viện y học cổ truyền', '2020-10-08 09:27:49', '2020-12-18 11:48:35', NULL, NULL);

-- ----------------------------
-- Table structure for payroll
-- ----------------------------
DROP TABLE IF EXISTS `payroll`;
CREATE TABLE `payroll`  (
  `payroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_code` char(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `employee_id` int(11) NULL DEFAULT NULL,
  `salary_process_id` int(11) NULL DEFAULT NULL,
  `workdays` int(5) NULL DEFAULT NULL COMMENT 'so ngay cong',
  `paid_holidays` int(2) NULL DEFAULT NULL COMMENT 'so ngay nghi co luong',
  `unpaid_days_off` int(2) NULL DEFAULT NULL COMMENT 'so ngay nghi khong luong',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `allowance` int(11) NULL DEFAULT NULL COMMENT 'trợ cấp',
  `advance` int(11) NULL DEFAULT NULL COMMENT 'tạm ứng',
  PRIMARY KEY (`payroll_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for position
-- ----------------------------
DROP TABLE IF EXISTS `position`;
CREATE TABLE `position`  (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_code` char(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `position_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`position_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of position
-- ----------------------------
INSERT INTO `position` VALUES (1, 'TP', 'Trưởng phòng', '2020-09-02 12:57:56', '2020-09-02 12:58:02', NULL, NULL);
INSERT INTO `position` VALUES (2, 'PP', 'Phó phòng', '2020-09-02 12:57:56', '2020-09-02 12:58:02', NULL, NULL);
INSERT INTO `position` VALUES (3, 'QL', 'Quản lý', '2020-09-02 12:57:56', '2020-09-02 12:58:02', NULL, NULL);
INSERT INTO `position` VALUES (4, 'NV', 'Nhân viên', '2020-09-02 12:57:56', '2020-09-02 12:58:02', NULL, NULL);
INSERT INTO `position` VALUES (5, 'GD', 'Giám đốc', '2020-09-02 12:57:56', '2020-09-02 12:58:02', NULL, NULL);
INSERT INTO `position` VALUES (6, 'PGD', 'Phó giám đốc', '2020-09-02 12:57:56', '2020-09-02 12:58:02', NULL, NULL);
INSERT INTO `position` VALUES (7, 'TK', 'Thư ký', '2020-09-02 12:57:56', '2020-09-02 13:01:31', NULL, NULL);
INSERT INTO `position` VALUES (8, 'LT', 'Lễ tân', '2020-09-02 12:57:56', '2020-09-02 13:01:32', NULL, NULL);

-- ----------------------------
-- Table structure for praise_discipline
-- ----------------------------
DROP TABLE IF EXISTS `praise_discipline`;
CREATE TABLE `praise_discipline`  (
  `praise_discipline_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `praise_discipline_code` char(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `praise_discipline_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `praise_discipline_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '0: khen thưởng   1: kỷ luật',
  PRIMARY KEY (`praise_discipline_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of praise_discipline
-- ----------------------------
INSERT INTO `praise_discipline` VALUES (1, 1, 'KH_T2_2020', 'Khen thưởng tháng 2', 'Khen thưởng vượt chỉ tiêu tháng 2 năm 2020', '2020-02-08 09:39:54', '2020-10-08 09:48:33', NULL, NULL, 0);
INSERT INTO `praise_discipline` VALUES (2, 1, 'KH_T8_2020', 'Khen thưởng tháng 8', 'Khen thưởng vượt chỉ tiêu tháng 8 năm 2020', '2020-08-08 09:39:54', '2020-10-08 09:48:36', NULL, NULL, 0);
INSERT INTO `praise_discipline` VALUES (3, 1, 'KL_T5_2019', 'Kỷ luật tháng 5/2019', 'Kỷ luật đi làm muộn tháng 5 năm 2019', '2019-10-08 09:49:46', '2020-10-08 09:49:56', NULL, NULL, 1);

-- ----------------------------
-- Table structure for salary_process
-- ----------------------------
DROP TABLE IF EXISTS `salary_process`;
CREATE TABLE `salary_process`  (
  `salary_process_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `basic_salary` int(11) NULL DEFAULT NULL,
  `decision_number` char(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`salary_process_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of salary_process
-- ----------------------------
INSERT INTO `salary_process` VALUES (1, 1, 10000000, 'QD0001/20130901', '2013-09-12 18:32:43', '2020-09-12 18:32:56', NULL, NULL, 'Nâng lương lần 1 ');
INSERT INTO `salary_process` VALUES (2, 1, 13000000, 'QD0002/20140907', '2014-09-12 18:32:43', '2020-09-12 18:33:27', NULL, NULL, 'Nâng lương lần 2');
INSERT INTO `salary_process` VALUES (3, 1, 16000000, 'QD0003/20151001', '2015-09-12 18:32:43', '2020-09-12 18:33:33', NULL, NULL, 'Nâng lương lần 3');
INSERT INTO `salary_process` VALUES (4, 1, 18000000, 'QD0004/20160901', '2016-09-12 18:32:43', '2020-09-12 18:33:23', NULL, NULL, 'Nâng lương lần 4');
INSERT INTO `salary_process` VALUES (5, 1, 20000000, 'QD0005/20200901', '2020-09-12 18:32:43', '2020-09-12 18:33:23', NULL, NULL, 'Nâng lương lần 5');

-- ----------------------------
-- Table structure for timekeeping_detail
-- ----------------------------
DROP TABLE IF EXISTS `timekeeping_detail`;
CREATE TABLE `timekeeping_detail`  (
  `timekeeping_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `time_checkin` time(0) NULL DEFAULT NULL,
  `time_checkout` time(0) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '1: di lam  0: ko di lam',
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT 'ly do nghi',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '1: fulltime   2: parttime',
  PRIMARY KEY (`timekeeping_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `password` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `role` enum('admin','member') CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL COMMENT '1: admin   2: member ',
  `is_active` enum('active','inactive') CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `type` enum('fulltime','parttime') CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 1, 'admin', '12345', 'admin', 'active', 'fulltime', '2020-09-02 11:08:30', '2020-11-08 12:11:23', NULL, NULL);
INSERT INTO `user` VALUES (2, 2, 'member1', '12345', 'member', 'active', 'fulltime', '2020-09-02 11:08:30', '2020-11-08 12:11:25', NULL, NULL);
INSERT INTO `user` VALUES (3, 3, 'member2', '12345', 'member', 'active', 'fulltime', '2020-09-02 11:08:30', '2020-11-08 12:11:28', NULL, NULL);
INSERT INTO `user` VALUES (4, 4, 'member3', '12345', 'member', 'inactive', 'fulltime', '2020-09-02 11:08:30', '2020-12-18 14:01:39', NULL, NULL);

-- ----------------------------
-- Table structure for work_process
-- ----------------------------
DROP TABLE IF EXISTS `work_process`;
CREATE TABLE `work_process`  (
  `work_process_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `position_id` int(11) NULL DEFAULT NULL,
  `department_id` int(11) NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `company_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0: còn hiệu lực  1: hết hiệu lực',
  PRIMARY KEY (`work_process_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of work_process
-- ----------------------------
INSERT INTO `work_process` VALUES (1, 1, 1, 1, '2020-09-01', '2023-09-01', NULL, '2020-10-07 23:54:29', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', 'Đảm nhận chức vụ mới', 0);
INSERT INTO `work_process` VALUES (2, 2, 4, 1, '2017-09-01', '2025-09-01', NULL, '2020-10-07 23:54:30', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 0);
INSERT INTO `work_process` VALUES (3, 3, 1, 4, '2017-09-01', '2025-09-01', NULL, '2020-10-07 23:54:32', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 0);
INSERT INTO `work_process` VALUES (4, 4, 4, 4, '2017-09-01', '2025-09-01', NULL, '2020-10-07 23:54:34', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 0);
INSERT INTO `work_process` VALUES (5, 1, 2, 1, '2016-09-01', '2020-09-01', NULL, '2020-11-08 19:58:38', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 1);
INSERT INTO `work_process` VALUES (6, 1, 3, 1, '2013-09-01', '2016-09-01', NULL, '2020-11-08 21:54:28', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 1);
INSERT INTO `work_process` VALUES (7, 10, 1, 0, '2020-11-01', NULL, '2020-11-08 15:15:03', '2020-11-08 15:15:03', NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `work_process` VALUES (8, 11, 1, 0, '2020-12-17', NULL, '2020-12-17 15:48:09', '2020-12-17 15:48:09', NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `work_process` VALUES (9, 6, 4, 1, '2020-09-01', '2023-09-01', NULL, '2020-10-07 23:54:29', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', 'Đảm nhận chức vụ mới', 0);
INSERT INTO `work_process` VALUES (10, 7, 4, 1, '2017-09-01', '2025-09-01', NULL, '2020-10-07 23:54:30', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 0);
INSERT INTO `work_process` VALUES (11, 8, 4, 4, '2017-09-01', '2025-09-01', NULL, '2020-10-07 23:54:32', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 0);
INSERT INTO `work_process` VALUES (12, 9, 4, 4, '2017-09-01', '2025-09-01', NULL, '2020-10-07 23:54:34', NULL, NULL, 'Asia Technology', 'Demo Street 123, Demo City 04312, NJ', NULL, 0);
INSERT INTO `work_process` VALUES (13, 12, 7, 1, '2020-12-10', '2020-12-12', '2020-12-18 05:22:01', '2020-12-18 12:31:08', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `work_process` VALUES (14, 12, 4, 3, '2020-12-19', NULL, '2020-12-18 05:29:34', '2020-12-18 05:29:34', NULL, NULL, NULL, NULL, NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;
