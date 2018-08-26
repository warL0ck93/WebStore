/*
Navicat MySQL Data Transfer

Source Server         : Adi
Source Server Version : 50552
Source Host           : 149.156.136.151:3306
Source Database       : gkozlowski

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-03-08 08:33:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `Gatunek`
-- ----------------------------
DROP TABLE IF EXISTS `Gatunek`;
CREATE TABLE `Gatunek` (
  `id_gatunek` int(10) NOT NULL AUTO_INCREMENT,
  `nazwa_gatunek` text,
  PRIMARY KEY (`id_gatunek`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Gatunek
-- ----------------------------
INSERT INTO `Gatunek` VALUES ('1', '');
INSERT INTO `Gatunek` VALUES ('2', 'FPS');
INSERT INTO `Gatunek` VALUES ('3', 'RPG');
INSERT INTO `Gatunek` VALUES ('4', 'Strategia');
INSERT INTO `Gatunek` VALUES ('9', 'WyÅ›cigi');

-- ----------------------------
-- Table structure for `Gry`
-- ----------------------------
DROP TABLE IF EXISTS `Gry`;
CREATE TABLE `Gry` (
  `Id_gry` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_gry` varchar(255) NOT NULL,
  `Opis` varchar(5000) NOT NULL,
  `id_producent` int(11) NOT NULL,
  `Data_wydania` date NOT NULL,
  `id_gatunek` int(11) NOT NULL,
  `Cena` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_gry`),
  KEY `id_gatunek` (`id_gatunek`),
  KEY `id_producent` (`id_producent`),
  CONSTRAINT `id_gatunek` FOREIGN KEY (`id_gatunek`) REFERENCES `Gatunek` (`id_gatunek`) ON UPDATE CASCADE,
  CONSTRAINT `id_producent` FOREIGN KEY (`id_producent`) REFERENCES `Producenci` (`ID_Producent`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Gry
-- ----------------------------
INSERT INTO `Gry` VALUES ('12', 'The Elder Scrolls V: Skyrim', 'Zrealizowana z du?ym rozmachem gra action-RPG, b?d?ca pi?t? cz??ci? popularnego cyklu The Elder Scrolls. Produkcja studia Bethesda Softworks pozwala graczom ponownie przenie?? si? do fantastycznego ?wiata Nirn. Akcja The Elder Scrolls V: Skyrim osadzona zosta?a 200 lat po wydarzeniach przedstawionych w The Elder Scrolls IV: Oblivion. G?ówny bohater jest jednym z ostatnich ?owców smoków (dovahkiin). Tymczasem wype?nia si? proroctwo, zwiastuj?ce przybycie boga zniszczenia - Alduina, który przyjmie posta? jednego z tych mitycznych stworze?. Rozgrywka stanowi po??czenie elementów dynamicznej gry akcji oraz klasycznego cRPG z rozbudowanym systemem rozwoju postaci oraz rozleg?ym ?wiatem o otwartej strukturze. Wysokiej jako?ci oprawa wizualna w grze generowana jest przez zmodyfikowany silnik Creation Engine.', '1', '2010-10-31', '3', '120');
INSERT INTO `Gry` VALUES ('14', 'World of warcraft', 'Epicka gra z gatunku MMORPG, której akcj? osadzono w uniwersum znanym z kultowej serii RTS-ów fantasy firmy Blizzard. Kilka lat po wydarzeniach znanych WarCraft III: The Frozen Throne, kraina Azeroth wci?? targana jest nowymi konfliktami, których przyczyn? s? dwie wrogo do siebie nastawione frakcje. W sk?ad Sojuszu weszli Ludzie, Krasnoludy, Nocne Elfy i Gnomy. Na przeciwnym biegunie stan??a Horda, skupiaj?ca Orków, Taurenów, Nieumar?ych i Trolli. Opowiadaj?c si? po jednej ze stron, kreujemy swego bohatera spo?ród wielu dost?pnych ras oraz profesji i ??cz?c si?y z tysi?cami graczy z ca?ego ?wiata przemierzamy rozleg?y ?wiat gry, stawiaj?c czo?a zró?nicowanym przeciwnikom oraz rozmaitym wyzwaniom, nad których tworzeniem czuwa specjalnie dedykowana ekipa Blizzarda. W miar? post?pów w grze nasza posta? rozwija si? w my?l kanonów obowi?zuj?cych w sieciowych grach RPG. Zabawa z World of Warcraft oprócz zakupu samej gry, wymaga tak?e uiszczania miesi?cznych op?at abonamentowych.', '6', '2004-11-23', '3', '100');
INSERT INTO `Gry` VALUES ('15', 'Call of Duty: Infinite Warfare', 'Kolejna ods?ona jednej z najpopularniejszych serii strzelanin FPS w historii, kontynuuj?ca tematyk? futurystycznych konfliktów zbrojnych. Fabu?a Call of Duty: Infinite Warfare przenosi nas jednak w jeszcze odleglejsz? przysz?o??, opowiadaj?c o losach zupe?nie nowych bohaterów oraz fikcyjnym konflikcie sojuszu United Nations Space Alliance z przeciwn? mi?dzynarodowej wspó?pracy organizacj? Settlement Defense Front. Gracze wcielaj? si? w posta? kpt. Reyesa – pilota Tier 1 Special Operations, który z pok?adu statku wojennego Retribution wraz ze swoj? za?og? stara si? powstrzyma? si?y SDF. Wraz z wprowadzeniem nowego uniwersum, w grze pojawi?a si? spora liczba zmian – pocz?wszy od futurystycznego arsena?u broni i gad?etów, a? po niespotykane wcze?niej misje, w których gracze zasiadaj? za sterami my?liwców Jackal, uczestnicz?c w zaciek?ych podniebnych potyczkach. Kampani? fabularn? uzupe?nia oczywi?cie rozbudowany multiplayer oraz tradycyjny tryb Zombie.', '5', '2016-11-04', '2', '115');
INSERT INTO `Gry` VALUES ('16', 'Warcraft III: Reign of Chaos', 'Trzecia ods?ona kultowej serii osadzonych w realiach fantasy strategii czasu rzeczywistego, zapocz?tkowanej w 1994 roku przez studio Blizzard. Akcja gry przenosi nas ponownie do znanej z poprzednich cz??ci krainy Azeroth, gdzie si?y ludzi, orków i nocnych elfów stawiaj? czo?a inwazji nieumar?ych, zwanych Plag? albo Nocnym Legionem. Mechanika rozgrywki czerpie z klasycznych rozwi?za? cyklu, ale nie oby?o si? bez kilku nowo?ci. Najwa?niejsz? z nich jest wprowadzenie w?a?ciwych dla ka?dej rasy bohaterów, którzy w trakcie gry zyskuj? do?wiadczenie, a ich umiej?tno?ci specjalne s? przydatnym wsparciem podczas walki. W trzeciej cz??ci gry szczególny nacisk po?o?ono na fabu??, której szczegó?y poznajemy z licznych animowanych przerywników. Warcraft III posiada tak?e zaawansowany tryb multiplayer, pozwalaj?cy na zabaw? w kilku trybach rozgrywki poprzez sie? Battle.net. Dodatkow? atrakcj? stanowi rozbudowany edytor, pozwalaj?cy na zmian? niemal ka?dego elementu gry.', '6', '2002-07-02', '4', '55');
INSERT INTO `Gry` VALUES ('17', 'Need for Speed: Most Wanted ', 'Dziewi?ta ods?ona legendarnego cyklu samochodówek, wykreowanego przez koncern EA. Po dwóch cz??ciach gry obdarzonych podtytu?em Underground i po?wi?conych nielegalnym wy?cigom ulicznym, kolejna produkcja w serii stanowi cz??ciowy powrót do korzeni, ??cz?c rozwi?zania wykorzystane w swych obu poprzedniczkach z elementami starszych cz??ci cyklu. Celem zabawy jest wspi?cie si? na szczyt tytu?owej czarnej listy najbardziej poszukiwanych kierowców. Nadal wi?c poruszamy si? po terenie wielkiego wirtualnego miasta, podejmuj?c kolejne wyzwania w ramach kilku rodzajów wy?cigów. W?ród nich znajdziemy tor, sprint, drag, eliminacj?, prób? czasow?, prób? pr?dko?ci oraz ucieczk? przed policj?. Po zaliczeniu odpowiedniej ilo?ci wyzwa? mo?emy wyzwa? na pojedynek kolejnego kierowc? z listy. Obok typowych dla serii elementów, jak licencjonowane samochody oraz zró?nicowana ?cie?ka d?wi?kowa, w grze zachowano tak?e rozbudowane opcje mechanicznego i optycznego tuningu nabywanych samochodów.', '4', '2005-11-15', '9', '115');

-- ----------------------------
-- Table structure for `GryUzytkownikow`
-- ----------------------------
DROP TABLE IF EXISTS `GryUzytkownikow`;
CREATE TABLE `GryUzytkownikow` (
  `Id_gryU` int(11) NOT NULL AUTO_INCREMENT,
  `Id_gry` int(11) DEFAULT NULL,
  `Id_uzytkownika` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_gryU`),
  KEY `FK_GryUzytkownikow_Gry` (`Id_gry`),
  KEY `FK_GryUzytkownikow_Uzytkownicy` (`Id_uzytkownika`),
  CONSTRAINT `FK_GryUzytkownikow_Gry` FOREIGN KEY (`Id_gry`) REFERENCES `Gry` (`Id_gry`),
  CONSTRAINT `FK_GryUzytkownikow_Uzytkownicy` FOREIGN KEY (`Id_uzytkownika`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of GryUzytkownikow
-- ----------------------------
INSERT INTO `GryUzytkownikow` VALUES ('14', '12', '6');
INSERT INTO `GryUzytkownikow` VALUES ('23', '14', '6');
INSERT INTO `GryUzytkownikow` VALUES ('24', '14', '6');
INSERT INTO `GryUzytkownikow` VALUES ('27', '15', '6');
INSERT INTO `GryUzytkownikow` VALUES ('28', '12', '6');
INSERT INTO `GryUzytkownikow` VALUES ('36', '17', '6');
INSERT INTO `GryUzytkownikow` VALUES ('37', '16', '20');
INSERT INTO `GryUzytkownikow` VALUES ('38', '16', '20');

-- ----------------------------
-- Table structure for `Klucze`
-- ----------------------------
DROP TABLE IF EXISTS `Klucze`;
CREATE TABLE `Klucze` (
  `Id_klucz` int(11) NOT NULL AUTO_INCREMENT,
  `id_gry_klucz` int(11) NOT NULL,
  `id_uzytkownika_klucz` int(11) DEFAULT NULL,
  `Data_zakupu` datetime DEFAULT NULL,
  `Data_wyko` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_klucz`),
  KEY `id_game` (`id_gry_klucz`),
  KEY `id_user` (`id_uzytkownika_klucz`),
  CONSTRAINT `id_game` FOREIGN KEY (`id_gry_klucz`) REFERENCES `Gry` (`Id_gry`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_user` FOREIGN KEY (`id_uzytkownika_klucz`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Klucze
-- ----------------------------
INSERT INTO `Klucze` VALUES ('1', '12', '6', '2017-02-05 23:16:00', '2017-02-05 23:15:29');
INSERT INTO `Klucze` VALUES ('2', '12', '6', '2017-02-06 16:26:22', '2017-02-06 21:41:06');
INSERT INTO `Klucze` VALUES ('3', '17', '6', '2017-02-06 22:29:09', '2017-02-06 22:36:58');
INSERT INTO `Klucze` VALUES ('4', '16', '20', '2017-02-07 00:10:23', '2017-02-07 00:09:10');
INSERT INTO `Klucze` VALUES ('5', '16', '20', '2017-02-07 00:10:47', '2017-02-07 00:09:28');

-- ----------------------------
-- Table structure for `Kluczewolne`
-- ----------------------------
DROP TABLE IF EXISTS `Kluczewolne`;
CREATE TABLE `Kluczewolne` (
  `Id_klucz_wolny` int(11) NOT NULL AUTO_INCREMENT,
  `Data_zakupa` datetime NOT NULL,
  `Klucz` varchar(30) NOT NULL,
  `id_gry` int(11) NOT NULL,
  `id_gracz` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_klucz_wolny`),
  KEY `id_gry` (`id_gry`),
  KEY `Indeks 3` (`id_gracz`),
  CONSTRAINT `id_gracz` FOREIGN KEY (`id_gracz`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_gry` FOREIGN KEY (`id_gry`) REFERENCES `Gry` (`Id_gry`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Kluczewolne
-- ----------------------------
INSERT INTO `Kluczewolne` VALUES ('3', '2017-02-06 22:54:04', '5898f07cc7e47', '16', '6');
INSERT INTO `Kluczewolne` VALUES ('4', '2017-02-06 22:54:27', '5898f0932b421', '16', '6');
INSERT INTO `Kluczewolne` VALUES ('5', '2017-02-06 22:54:36', '5898f09c55a5d', '17', '6');
INSERT INTO `Kluczewolne` VALUES ('6', '2017-02-06 22:54:42', '5898f0a28d7c2', '17', '6');
INSERT INTO `Kluczewolne` VALUES ('7', '2017-02-06 22:54:50', '5898f0aab7f07', '15', '6');
INSERT INTO `Kluczewolne` VALUES ('8', '2017-02-06 22:58:50', '5898f19acc2d9', '14', '6');
INSERT INTO `Kluczewolne` VALUES ('9', '2017-02-06 23:08:20', '5898f3d4d96c7', '15', '6');
INSERT INTO `Kluczewolne` VALUES ('10', '2017-02-06 23:11:23', '5898f48b66c9f', '15', '6');
INSERT INTO `Kluczewolne` VALUES ('11', '2017-02-06 23:13:10', '5898f4f6d65d5', '14', '6');
INSERT INTO `Kluczewolne` VALUES ('12', '2017-02-06 23:30:46', '5898f91688777', '15', '6');
INSERT INTO `Kluczewolne` VALUES ('15', '2017-02-07 00:44:04', '58990a44bff47', '12', '6');
INSERT INTO `Kluczewolne` VALUES ('16', '2017-02-07 00:46:09', '58990ac186dc4', '16', '6');
INSERT INTO `Kluczewolne` VALUES ('17', '2017-02-07 10:05:46', '58998deabc237', '16', '43');
INSERT INTO `Kluczewolne` VALUES ('18', '2017-02-07 10:28:39', '589993479973f', '12', '44');

-- ----------------------------
-- Table structure for `Komentarze`
-- ----------------------------
DROP TABLE IF EXISTS `Komentarze`;
CREATE TABLE `Komentarze` (
  `Id_kom` int(11) NOT NULL AUTO_INCREMENT,
  `id_kgry` int(11) DEFAULT NULL,
  `id_kuzyt` int(11) DEFAULT NULL,
  `Komentarz` varchar(500) DEFAULT NULL,
  `Data` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_kom`),
  KEY `FK__Gry` (`id_kgry`),
  KEY `FK__Uzytkownicy` (`id_kuzyt`),
  CONSTRAINT `FK__Gry` FOREIGN KEY (`id_kgry`) REFERENCES `Gry` (`Id_gry`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__Uzytkownicy` FOREIGN KEY (`id_kuzyt`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Komentarze
-- ----------------------------
INSERT INTO `Komentarze` VALUES ('34', '12', '44', 'j,hv kljhgvkj, <noscript>', '2017-02-07 10:27:29');
INSERT INTO `Komentarze` VALUES ('35', '12', '44', 'kj; b', '2017-02-07 10:27:32');

-- ----------------------------
-- Table structure for `Kraj`
-- ----------------------------
DROP TABLE IF EXISTS `Kraj`;
CREATE TABLE `Kraj` (
  `ID_Kraj` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_kraj` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_Kraj`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Kraj
-- ----------------------------
INSERT INTO `Kraj` VALUES ('1', 'PL');
INSERT INTO `Kraj` VALUES ('2', 'Eng');
INSERT INTO `Kraj` VALUES ('3', 'Polandia');
INSERT INTO `Kraj` VALUES ('4', 'Zimbabwe');
INSERT INTO `Kraj` VALUES ('5', 'Ukraina');
INSERT INTO `Kraj` VALUES ('6', 'Nibylandia');

-- ----------------------------
-- Table structure for `Login_history`
-- ----------------------------
DROP TABLE IF EXISTS `Login_history`;
CREATE TABLE `Login_history` (
  `Id_history` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id_history`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Login_history
-- ----------------------------
INSERT INTO `Login_history` VALUES ('1', 'adi1231', '195.150.82.73', '2017-02-04 22:14:12');
INSERT INTO `Login_history` VALUES ('2', 'adi1231', '195.150.82.73', '2017-02-04 22:20:48');
INSERT INTO `Login_history` VALUES ('3', 'adi1231', '195.150.82.73', '2017-02-04 22:23:20');
INSERT INTO `Login_history` VALUES ('4', 'adi1231', '195.150.82.73', '2017-02-04 22:26:00');
INSERT INTO `Login_history` VALUES ('5', 'adi1231', '195.150.82.73', '2017-02-04 22:27:53');
INSERT INTO `Login_history` VALUES ('6', 'adi1231', '195.150.82.73', '2017-02-04 22:30:59');
INSERT INTO `Login_history` VALUES ('7', 'adi1231', '195.150.82.73', '2017-02-04 22:31:05');
INSERT INTO `Login_history` VALUES ('8', 'adi1231', '195.150.82.73', '2017-02-04 22:31:09');
INSERT INTO `Login_history` VALUES ('9', 'adi1231', '195.150.82.73', '2017-02-04 22:31:12');
INSERT INTO `Login_history` VALUES ('10', 'adi1231', '195.150.82.73', '2017-02-04 22:31:16');
INSERT INTO `Login_history` VALUES ('11', 'adi1231', '195.150.82.73', '2017-02-04 22:47:25');
INSERT INTO `Login_history` VALUES ('12', 'adi1231', '195.150.82.73', '2017-02-04 22:47:28');
INSERT INTO `Login_history` VALUES ('13', 'adi1231', '195.150.82.73', '2017-02-04 22:47:31');
INSERT INTO `Login_history` VALUES ('14', 'adi1231', '195.150.82.73', '2017-02-04 22:47:36');
INSERT INTO `Login_history` VALUES ('15', 'adi1231', '195.150.82.73', '2017-02-04 22:47:39');
INSERT INTO `Login_history` VALUES ('16', 'adi1231', '195.150.82.73', '2017-02-04 22:47:42');
INSERT INTO `Login_history` VALUES ('17', 'adi1231', '195.150.82.73', '2017-02-04 22:47:49');
INSERT INTO `Login_history` VALUES ('18', 'adi1231', '195.150.82.73', '2017-02-04 22:47:53');
INSERT INTO `Login_history` VALUES ('19', 'adi1231', '195.150.82.73', '2017-02-04 22:47:56');
INSERT INTO `Login_history` VALUES ('20', 'adi1231', '195.150.82.73', '2017-02-04 22:57:32');
INSERT INTO `Login_history` VALUES ('21', 'adi1231', '195.150.82.73', '2017-02-04 22:57:35');
INSERT INTO `Login_history` VALUES ('22', 'adi1231', '195.150.82.73', '2017-02-04 22:57:38');
INSERT INTO `Login_history` VALUES ('23', 'adi1231', '195.150.82.73', '2017-02-04 22:57:41');
INSERT INTO `Login_history` VALUES ('24', 'adi1231', '195.150.82.73', '2017-02-04 22:57:44');
INSERT INTO `Login_history` VALUES ('25', 'adi1231', '195.150.82.73', '2017-02-04 22:57:48');
INSERT INTO `Login_history` VALUES ('26', 'adi1231', '195.150.82.73', '2017-02-04 22:57:52');
INSERT INTO `Login_history` VALUES ('27', 'adi1231', '195.150.82.73', '2017-02-04 22:59:29');
INSERT INTO `Login_history` VALUES ('28', 'adi1231', '195.150.82.73', '2017-02-04 23:07:08');
INSERT INTO `Login_history` VALUES ('29', 'adi1231', '195.150.80.17', '2017-02-06 21:42:02');
INSERT INTO `Login_history` VALUES ('30', 'maciek', '195.150.80.17', '2017-02-07 00:03:57');
INSERT INTO `Login_history` VALUES ('31', 'maciek', '195.150.80.17', '2017-02-07 00:05:26');
INSERT INTO `Login_history` VALUES ('32', 'maciek', '195.150.80.17', '2017-02-07 00:05:55');
INSERT INTO `Login_history` VALUES ('33', 'adi1231', '195.150.83.28', '2017-02-07 08:58:22');
INSERT INTO `Login_history` VALUES ('34', 'adi1231', '195.150.83.28', '2017-02-07 08:59:44');

-- ----------------------------
-- Table structure for `Logowanie`
-- ----------------------------
DROP TABLE IF EXISTS `Logowanie`;
CREATE TABLE `Logowanie` (
  `ID_Log` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `adres_ip` varchar(32) NOT NULL,
  `login` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_Log`,`data`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1
/*!50100 PARTITION BY RANGE (TO_DAYS(data))
(PARTITION styczen17 VALUES LESS THAN (736726) ENGINE = InnoDB,
 PARTITION luty17 VALUES LESS THAN (736754) ENGINE = InnoDB,
 PARTITION marzec17 VALUES LESS THAN (736785) ENGINE = InnoDB,
 PARTITION future VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */;

-- ----------------------------
-- Records of Logowanie
-- ----------------------------
INSERT INTO `Logowanie` VALUES ('1', '0000-00-00 00:00:00', '195.150.80.2', 'asd');
INSERT INTO `Logowanie` VALUES ('2', '0000-00-00 00:00:00', '195.150.80.2', 'asd');
INSERT INTO `Logowanie` VALUES ('3', '0000-00-00 00:00:00', '195.150.80.2', 'asd');
INSERT INTO `Logowanie` VALUES ('4', '0000-00-00 00:00:00', '195.150.80.2', 'asd');
INSERT INTO `Logowanie` VALUES ('5', '2017-01-14 20:21:29', '195.150.80.2', 'asd');
INSERT INTO `Logowanie` VALUES ('6', '2017-01-14 20:46:54', '195.150.80.2', 'asd');
INSERT INTO `Logowanie` VALUES ('7', '2017-01-15 19:19:09', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('8', '2017-01-15 19:20:53', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('9', '2017-01-15 19:27:13', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('10', '2017-01-15 19:40:01', '195.150.80.168', 'Kurwa');
INSERT INTO `Logowanie` VALUES ('11', '2017-01-15 19:41:56', '195.150.80.168', 'adiczek');
INSERT INTO `Logowanie` VALUES ('12', '2017-01-15 19:44:50', '195.150.80.168', 'adiczek');
INSERT INTO `Logowanie` VALUES ('13', '2017-01-15 20:05:45', '195.150.80.168', 'adiczek');
INSERT INTO `Logowanie` VALUES ('14', '2017-01-15 20:19:28', '195.150.80.168', 'adiczek');
INSERT INTO `Logowanie` VALUES ('15', '2017-01-15 21:10:00', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('16', '2017-01-15 21:11:06', '195.150.80.168', 'Kurwa');
INSERT INTO `Logowanie` VALUES ('17', '2017-01-15 21:59:29', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('18', '2017-01-15 22:13:30', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('19', '2017-01-15 22:38:59', '195.150.80.168', 'adi1231');
INSERT INTO `Logowanie` VALUES ('20', '2017-01-15 23:07:02', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('21', '2017-01-15 23:08:15', '195.150.80.168', 'adi1231');
INSERT INTO `Logowanie` VALUES ('22', '2017-01-15 23:17:50', '195.150.80.168', 'asd');
INSERT INTO `Logowanie` VALUES ('23', '2017-01-15 23:30:49', '195.150.80.168', 'adi1231');
INSERT INTO `Logowanie` VALUES ('24', '2017-01-15 23:56:26', '195.150.80.168', 'adi1231');
INSERT INTO `Logowanie` VALUES ('25', '2017-01-16 00:14:29', '195.150.80.168', 'adiczek');
INSERT INTO `Logowanie` VALUES ('26', '2017-01-16 00:15:36', '195.150.80.168', 'adi1231');
INSERT INTO `Logowanie` VALUES ('27', '2017-01-16 00:19:01', '195.150.80.168', 'maciek');
INSERT INTO `Logowanie` VALUES ('28', '2017-01-16 00:24:40', '195.150.80.168', 'adi1231');
INSERT INTO `Logowanie` VALUES ('29', '2017-01-16 01:01:33', '195.150.80.168', 'maciek');
INSERT INTO `Logowanie` VALUES ('30', '2017-01-16 01:02:46', '195.150.80.168', 'maciek');
INSERT INTO `Logowanie` VALUES ('31', '2017-01-16 18:53:09', '195.150.81.31', 'adi1231');
INSERT INTO `Logowanie` VALUES ('32', '2017-01-16 18:54:00', '195.150.81.31', 'adi1231');
INSERT INTO `Logowanie` VALUES ('33', '2017-01-16 19:37:52', '195.150.81.31', 'adi1231');
INSERT INTO `Logowanie` VALUES ('34', '2017-01-16 22:37:27', '195.150.81.31', 'adi1231');
INSERT INTO `Logowanie` VALUES ('35', '2017-01-23 16:56:31', '195.150.80.153', 'adi1231');
INSERT INTO `Logowanie` VALUES ('36', '2017-01-23 18:43:49', '195.150.80.153', 'adi1231');
INSERT INTO `Logowanie` VALUES ('37', '2017-01-23 19:00:32', '195.150.80.153', 'adamekasd');
INSERT INTO `Logowanie` VALUES ('38', '2017-01-23 19:14:28', '195.150.80.153', 'aniewiarowski.ew@gmail.co');
INSERT INTO `Logowanie` VALUES ('39', '2017-01-23 19:28:04', '195.150.80.153', 'adi1231');
INSERT INTO `Logowanie` VALUES ('40', '2017-01-23 20:29:51', '195.150.80.153', 'adi1231');
INSERT INTO `Logowanie` VALUES ('41', '2017-01-23 21:12:21', '195.150.80.153', 'adi1231');
INSERT INTO `Logowanie` VALUES ('42', '2017-01-23 22:43:58', '195.150.80.153', 'adi1231');
INSERT INTO `Logowanie` VALUES ('43', '2017-01-25 14:26:44', '195.150.80.134', 'Admin1');
INSERT INTO `Logowanie` VALUES ('44', '2017-01-25 14:33:54', '195.150.80.134', 'adi1231');
INSERT INTO `Logowanie` VALUES ('45', '2017-01-25 14:38:42', '195.150.80.134', 'adi1231');
INSERT INTO `Logowanie` VALUES ('46', '2017-01-25 17:10:30', '195.150.80.134', 'maciek');
INSERT INTO `Logowanie` VALUES ('47', '2017-01-25 22:17:19', '195.150.80.134', 'adi1231');
INSERT INTO `Logowanie` VALUES ('48', '2017-02-04 22:23:28', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('49', '2017-02-04 22:26:21', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('50', '2017-02-04 22:27:59', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('51', '2017-02-04 22:31:22', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('52', '2017-02-04 22:35:13', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('53', '2017-02-04 22:39:42', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('54', '2017-02-04 22:43:07', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('55', '2017-02-04 22:45:58', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('56', '2017-02-04 22:48:02', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('57', '2017-02-04 22:57:57', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('58', '2017-02-04 23:07:25', '195.150.82.73', 'adi1231');
INSERT INTO `Logowanie` VALUES ('59', '2017-02-05 15:33:04', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('60', '2017-02-05 15:33:31', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('61', '2017-02-05 15:36:17', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('62', '2017-02-05 17:26:04', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('63', '2017-02-05 17:34:37', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('64', '2017-02-05 17:34:49', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('65', '2017-02-05 18:02:20', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('66', '2017-02-05 18:02:46', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('67', '2017-02-05 18:06:43', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('68', '2017-02-05 18:08:38', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('69', '2017-02-05 18:09:59', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('70', '2017-02-05 18:18:09', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('71', '2017-02-05 18:21:03', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('72', '2017-02-05 18:25:42', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('73', '2017-02-05 19:42:36', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('74', '2017-02-05 20:02:03', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('75', '2017-02-05 22:31:37', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('76', '2017-02-05 23:09:20', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('77', '2017-02-05 23:36:05', '195.150.80.140', 'adi1231');
INSERT INTO `Logowanie` VALUES ('78', '2017-02-06 00:02:07', '195.150.80.140', 'asdqwe');
INSERT INTO `Logowanie` VALUES ('79', '2017-02-06 10:47:34', '37.47.84.155', 'test123');
INSERT INTO `Logowanie` VALUES ('80', '2017-02-06 16:01:17', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('81', '2017-02-06 21:42:12', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('82', '2017-02-06 22:53:17', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('83', '2017-02-06 23:28:09', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('84', '2017-02-06 23:29:57', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('85', '2017-02-06 23:30:33', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('86', '2017-02-07 00:01:25', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('87', '2017-02-07 00:04:14', '195.150.80.17', 'maciek');
INSERT INTO `Logowanie` VALUES ('88', '2017-02-07 00:05:02', '195.150.80.17', 'maciek');
INSERT INTO `Logowanie` VALUES ('89', '2017-02-07 00:05:18', '195.150.80.17', 'maciek');
INSERT INTO `Logowanie` VALUES ('90', '2017-02-07 00:05:37', '195.150.80.17', 'maciek');
INSERT INTO `Logowanie` VALUES ('91', '2017-02-07 00:06:01', '195.150.80.17', 'maciek');
INSERT INTO `Logowanie` VALUES ('92', '2017-02-07 00:14:44', '195.150.80.17', 'maciek');
INSERT INTO `Logowanie` VALUES ('93', '2017-02-07 00:17:40', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('94', '2017-02-07 00:21:51', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('95', '2017-02-07 00:30:03', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('96', '2017-02-07 00:32:49', '195.150.80.17', 'adi1231');
INSERT INTO `Logowanie` VALUES ('97', '2017-02-07 08:58:30', '195.150.83.28', 'adi1231');
INSERT INTO `Logowanie` VALUES ('98', '2017-02-07 08:58:40', '195.150.83.28', 'adi1231');
INSERT INTO `Logowanie` VALUES ('99', '2017-02-07 09:58:28', '94.254.145.186', 'matimac1994');
INSERT INTO `Logowanie` VALUES ('100', '2017-02-07 10:26:25', '149.156.136.127', 'artur');
INSERT INTO `Logowanie` VALUES ('101', '2017-02-07 10:28:32', '149.156.136.127', 'artur');

-- ----------------------------
-- Table structure for `Ocena`
-- ----------------------------
DROP TABLE IF EXISTS `Ocena`;
CREATE TABLE `Ocena` (
  `Id_ocena` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) DEFAULT NULL,
  `id_gry` int(11) DEFAULT NULL,
  `Ocena` int(1) DEFAULT NULL,
  PRIMARY KEY (`Id_ocena`),
  KEY `id_game_ocena` (`id_gry`),
  KEY `id_user_ocena` (`id_uzytkownika`),
  CONSTRAINT `id_user_ocena` FOREIGN KEY (`id_uzytkownika`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_game_ocena` FOREIGN KEY (`id_gry`) REFERENCES `Gry` (`Id_gry`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Ocena
-- ----------------------------
INSERT INTO `Ocena` VALUES ('14', '6', '14', '5');
INSERT INTO `Ocena` VALUES ('15', '6', '12', '4');
INSERT INTO `Ocena` VALUES ('16', '6', '15', '6');
INSERT INTO `Ocena` VALUES ('17', '6', '16', '3');
INSERT INTO `Ocena` VALUES ('18', '6', '17', '6');

-- ----------------------------
-- Table structure for `Producenci`
-- ----------------------------
DROP TABLE IF EXISTS `Producenci`;
CREATE TABLE `Producenci` (
  `ID_Producent` int(11) NOT NULL AUTO_INCREMENT,
  `Nazwa_producenta` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Producent`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Producenci
-- ----------------------------
INSERT INTO `Producenci` VALUES ('1', 'Kulawy Studio');
INSERT INTO `Producenci` VALUES ('2', 'Aezakmi Studio');
INSERT INTO `Producenci` VALUES ('3', 'Bethesda');
INSERT INTO `Producenci` VALUES ('4', 'Ubisoft');
INSERT INTO `Producenci` VALUES ('5', 'Activision');
INSERT INTO `Producenci` VALUES ('6', 'Blizzard');

-- ----------------------------
-- Table structure for `Sesja`
-- ----------------------------
DROP TABLE IF EXISTS `Sesja`;
CREATE TABLE `Sesja` (
  `id_sesji` varchar(50) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `adres_ip_sesji` varchar(255) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `godzina_zalogowania` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sesji`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Sesja
-- ----------------------------
INSERT INTO `Sesja` VALUES ('58998c34b29e0', 'matimac1994', '94.254.145.186', '58998def1995b', '2017-02-07 09:58:28');
INSERT INTO `Sesja` VALUES ('58999340d4819', 'artur', '149.156.136.127', '58999400c66df', '2017-02-07 10:28:32');

-- ----------------------------
-- Table structure for `Uzytkownicy`
-- ----------------------------
DROP TABLE IF EXISTS `Uzytkownicy`;
CREATE TABLE `Uzytkownicy` (
  `Id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_uzytkownika` varchar(25) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `adres_e_mail` varchar(50) DEFAULT NULL,
  `numer_tel` varchar(9) DEFAULT NULL,
  `id_kraj` int(11) DEFAULT NULL,
  `sol` varchar(13) DEFAULT NULL,
  `Stan_konta` int(11) DEFAULT NULL,
  `Stat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_uzytkownika`),
  UNIQUE KEY `Indeks 3` (`nazwa_uzytkownika`),
  KEY `id_kraj` (`id_kraj`),
  CONSTRAINT `id_kraj` FOREIGN KEY (`id_kraj`) REFERENCES `Kraj` (`ID_Kraj`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Uzytkownicy
-- ----------------------------
INSERT INTO `Uzytkownicy` VALUES ('6', 'adi1231', '10abdc11833e480d3802d67ff8a1853a908d11b0', 'Adrian@gmail.com', '784933467', '1', '586d2515a61e4', '586', 'Admin');
INSERT INTO `Uzytkownicy` VALUES ('8', 'Adrian', 'd7de9186cf970a6c8dc9d28c9846c03a71114058', null, null, null, '586fdf67c9244', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('9', 'adamek', 'b7c07b6df68c8e68c1d7fd89c9beda3f7bb8cb09', null, null, null, '5871072698e01', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('15', 'AKUZAKI', '295ed57611972f148f2572bf0aa8eecf7a3655ad', null, null, null, '58713a1ce66fb', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('16', 'damian', 'f67f0b2cbed02c232d9ca52db4cb941c66c7417f', null, null, null, '58713a88734a3', '0', 'Admin');
INSERT INTO `Uzytkownicy` VALUES ('17', 'asd', '5ddba2d4c5171ba4839a282421cbdf7e624cbf2c', 'adi@gmail.com', '784933467', '4', '58714577a7be0', '12', 'User');
INSERT INTO `Uzytkownicy` VALUES ('19', 'adiczek', '20d3481e39b9981bad027513e497a7ff61fb0484', null, null, null, '587bc26b4cbba', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('20', 'maciek', '59b1584a47aa5f9cdb663f10b1b6ccfd7841d218', 'asd@as.pl', '456654456', '1', '587c034d87be4', '40', 'User');
INSERT INTO `Uzytkownicy` VALUES ('22', 'asd123', 'a9e44a0107a7a4a02106f74d1822bd2c77e08141', null, null, null, '5886339b34d7c', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('23', 'asd123123', '420ca891c7560c31cb6c6e6c0cc67c1659da004a', null, null, null, '5886355c30d10', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('32', 'Admin1', 'a1dd99a6e0f0cb6fd971808c4bb7e56053644f17', 'Adrian@gmail.com', null, null, '5888a734c4b2e', '103', 'User');
INSERT INTO `Uzytkownicy` VALUES ('42', 'test123', '5c9dd52ab7ba102d4822a5f685d512f5355f4c96', 'adi@adi.pl', null, null, '58984624ca121', '0', 'User');
INSERT INTO `Uzytkownicy` VALUES ('43', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d21766b7d7ee', 'matiwsrh1994@gmail.com', null, '1', '58998c1e3b274', '945', 'User');
INSERT INTO `Uzytkownicy` VALUES ('44', 'artur', '2b702f5399d132199a48c19767b1cb5f9f8b2480', 'aniewiarowski@pk.edu.pl', '123123123', '1', '589992b699613', '19880', 'User');

-- ----------------------------
-- Table structure for `Uzytkownicyarch`
-- ----------------------------
DROP TABLE IF EXISTS `Uzytkownicyarch`;
CREATE TABLE `Uzytkownicyarch` (
  `Id_user_archive` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_uzytkownika_arch` varchar(25) NOT NULL,
  `haslo_arch` varchar(30) NOT NULL,
  `adres_email_arch` varchar(50) DEFAULT NULL,
  `numer_tel_arch` varchar(9) DEFAULT NULL,
  `id_kraj_arch` int(11) DEFAULT NULL,
  `Data_wprowadzenia` date DEFAULT NULL,
  PRIMARY KEY (`Id_user_archive`),
  KEY `id_kraj_archi` (`id_kraj_arch`),
  CONSTRAINT `id_kraj_archi` FOREIGN KEY (`id_kraj_arch`) REFERENCES `Kraj` (`ID_Kraj`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Uzytkownicyarch
-- ----------------------------
INSERT INTO `Uzytkownicyarch` VALUES ('1', 'asd', '5ddba2d4c5171ba4839a282421cbdf', 'Adi@gmai.com', '123123124', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('2', 'asd', '5ddba2d4c5171ba4839a282421cbdf', 'Adi@gmai.com', '123123124', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('3', 'asd', '5ddba2d4c5171ba4839a282421cbdf', '', '784933467', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('4', 'asd', '5ddba2d4c5171ba4839a282421cbdf', 'adi@gmail.com', '784933467', '4', null);
INSERT INTO `Uzytkownicyarch` VALUES ('5', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('6', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('7', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('8', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('9', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('10', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', null, null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('11', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('12', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('13', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('14', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('15', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('16', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('17', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('18', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('19', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('20', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('21', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('22', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('23', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('24', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '1231231', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('25', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '123124', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('26', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '123213', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('27', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian.krasowski94@gmail.com', '123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('28', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('29', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('30', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('31', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('32', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('33', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('34', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('35', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('36', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('37', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('38', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('39', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('40', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'adi@gmail.com', '123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('41', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'adi@gmail.com', '123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('42', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'adi@gmail.com', '123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('43', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'adi@gmail.com', '', '2', null);
INSERT INTO `Uzytkownicyarch` VALUES ('44', 'adi1231', '221946f7a22b556315c2fe19af98dd', '', '', '2', null);
INSERT INTO `Uzytkownicyarch` VALUES ('45', 'adi1231', '221946f7a22b556315c2fe19af98dd', '', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('46', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('47', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('48', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '5', null);
INSERT INTO `Uzytkownicyarch` VALUES ('49', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '5', null);
INSERT INTO `Uzytkownicyarch` VALUES ('50', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '4', null);
INSERT INTO `Uzytkownicyarch` VALUES ('51', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '4', null);
INSERT INTO `Uzytkownicyarch` VALUES ('52', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('53', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('54', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('55', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('56', 'Admin1', 'a1dd99a6e0f0cb6fd971808c4bb7e5', 'Adrian@gmail.com', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('57', 'Admin1', 'a1dd99a6e0f0cb6fd971808c4bb7e5', 'Adrian@gmail.com', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('58', 'Admin1', 'a1dd99a6e0f0cb6fd971808c4bb7e5', 'Adrian@gmail.com', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('59', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('60', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('61', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('62', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('63', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('64', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('65', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('66', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('67', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('68', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('69', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('70', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('71', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('72', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('73', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('74', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('75', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('76', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('77', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('78', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('79', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('80', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('81', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('82', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('83', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '', '3', null);
INSERT INTO `Uzytkownicyarch` VALUES ('84', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '411', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('85', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', '', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('86', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('87', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('88', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('89', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('90', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('91', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('92', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('93', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('94', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('95', 'maciek', '59b1584a47aa5f9cdb663f10b1b6cc', 'asd@as.pl', '456654456', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('96', 'adi1231', '221946f7a22b556315c2fe19af98dd', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('97', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('98', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('99', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('100', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('101', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('102', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('103', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('104', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('105', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('106', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('107', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('108', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('109', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '4', null);
INSERT INTO `Uzytkownicyarch` VALUES ('110', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '12314123', '4', null);
INSERT INTO `Uzytkownicyarch` VALUES ('111', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '784933467', '4', null);
INSERT INTO `Uzytkownicyarch` VALUES ('112', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('113', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('114', 'adi1231', '10abdc11833e480d3802d67ff8a185', 'Adrian@gmail.com', '784933467', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('115', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('116', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('117', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('118', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('119', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('120', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('121', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('122', 'matimac1994', '8e2f287fcdcd752056ff5b353a41d2', 'matiwsrh1994@gmail.com', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('123', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('124', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('125', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, null, null);
INSERT INTO `Uzytkownicyarch` VALUES ('126', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('127', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('128', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('129', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', null, '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('130', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', '123123123', '1', null);
INSERT INTO `Uzytkownicyarch` VALUES ('131', 'artur', '2b702f5399d132199a48c19767b1cb', 'aniewiarowski@pk.edu.pl', '123123123', '1', null);

-- ----------------------------
-- Table structure for `Wiadomosci`
-- ----------------------------
DROP TABLE IF EXISTS `Wiadomosci`;
CREATE TABLE `Wiadomosci` (
  `Id_msg` int(11) NOT NULL AUTO_INCREMENT,
  `data_wyslania` timestamp NULL DEFAULT NULL,
  `id_sender` int(11) DEFAULT NULL,
  `id_reciever` int(11) DEFAULT NULL,
  `Temat` varchar(50) DEFAULT NULL,
  `Tresc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_msg`),
  KEY `id_sender` (`id_sender`),
  KEY `id_reciever` (`id_reciever`),
  CONSTRAINT `id_sender` FOREIGN KEY (`id_sender`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_reciever` FOREIGN KEY (`id_reciever`) REFERENCES `Uzytkownicy` (`Id_uzytkownika`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Wiadomosci
-- ----------------------------

-- ----------------------------
-- View structure for `asd`
-- ----------------------------
DROP VIEW IF EXISTS `asd`;
CREATE ALGORITHM=UNDEFINED DEFINER=`gkozlowski`@`%` SQL SECURITY DEFINER VIEW `asd` AS select `Kluczewolne`.`Id_klucz_wolny` AS `idklucz`,`Kluczewolne`.`Klucz` AS `klucz`,`Gry`.`Id_gry` AS `id_gry`,`Gry`.`nazwa_gry` AS `Gra`,`Uzytkownicy`.`Id_uzytkownika` AS `Id_Uzyt` from ((`Kluczewolne` join `Gry` on((`Kluczewolne`.`id_gry` = `Gry`.`Id_gry`))) join `Uzytkownicy` on((`Kluczewolne`.`id_gracz` = `Uzytkownicy`.`Id_uzytkownika`))) where (`Uzytkownicy`.`Id_uzytkownika` = 6) ;

-- ----------------------------
-- View structure for `Gry uzytkownikow`
-- ----------------------------
DROP VIEW IF EXISTS `Gry uzytkownikow`;
CREATE ALGORITHM=UNDEFINED DEFINER=`gkozlowski`@`%` SQL SECURITY DEFINER VIEW `Gry uzytkownikow` uzytkownikow` AS select `GryUzytkownikow`.`Id_gry` AS `id_gry`,`GryUzytkownikow`.`Id_uzytkownika` AS `id_user`,`Uzytkownicy`.`nazwa_uzytkownika` AS `login`,`Gry`.`nazwa_gry` AS `gra`,`Gatunek`.`nazwa_gatunek` AS `gatune`,`Producenci`.`Nazwa_producenta` AS `Producent` from ((((`GryUzytkownikow` join `Gry` on((`GryUzytkownikow`.`Id_gry` = `Gry`.`Id_gry`))) join `Uzytkownicy` on((`GryUzytkownikow`.`Id_uzytkownika` = `Uzytkownicy`.`Id_uzytkownika`))) join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) ;

-- ----------------------------
-- View structure for `Średnia ocen`
-- ----------------------------
DROP VIEW IF EXISTS `Średnia ocen`;
CREATE ALGORITHM=UNDEFINED DEFINER=`gkozlowski`@`%` SQL SECURITY DEFINER VIEW `Średnia ocen` ocen` AS select `Gry`.`Id_gry` AS `Id_gry`,`Gry`.`nazwa_gry` AS `nazwa_gry`,avg(`Ocena`.`Ocena`) AS `Ocena` from (`Gry` join `Ocena` on((`Gry`.`Id_gry` = `Ocena`.`id_gry`))) group by `Gry`.`Id_gry`,`Gry`.`nazwa_gry` ;

-- ----------------------------
-- View structure for `Wyswietl gry`
-- ----------------------------
DROP VIEW IF EXISTS `Wyswietl gry`;
CREATE ALGORITHM=UNDEFINED DEFINER=`gkozlowski`@`%` SQL SECURITY DEFINER VIEW `Wyswietl gry` gry` AS select `Gry`.`nazwa_gry` AS `nazwa_gry`,`Gry`.`Data_wydania` AS `data_wydania`,`Producenci`.`Nazwa_producenta` AS `Nazwa_producenta`,`Gatunek`.`nazwa_gatunek` AS `nazwa_gatunek` from ((`Gry` join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) ;

-- ----------------------------
-- Procedure structure for `rejestracja`
-- ----------------------------
DROP PROCEDURE IF EXISTS `rejestracja`;
DELIMITER ;;
CREATE DEFINER=`gkozlowski`@`%` PROCEDURE `rejestracja`(
	IN `login` VARCHAR(50),
	IN `haslo` VARCHAR(50),
	IN `sol` VARCHAR(50),
	IN `Stan` INT,
	IN `Stat` VARCHAR(50),
	IN `mail` VARCHAR(50)
)
BEGIN

declare exit handler for sqlstate '23000'
begin
	signal sqlstate '45000' set message_text="Podany login już istnieje w bazie! Wybierz inny !", mysql_errno='1001';
end;

INSERT INTO Uzytkownicy (nazwa_uzytkownika, haslo, sol, Stan_konta, Stat,adres_e_mail) VALUES (login, haslo, sol,'0', 'User',mail);

END
;;
DELIMITER ;

-- ----------------------------
-- Event structure for `Czysc_sesje`
-- ----------------------------
DROP EVENT IF EXISTS `Czysc_sesje`;
DELIMITER ;;
CREATE DEFINER=`gkozlowski`@`%` EVENT `Czysc_sesje` ON SCHEDULE EVERY 1 HOUR STARTS '2017-02-06 23:22:54' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DELETE FROM Sesja WHERE godzina_zalogowania < DATE(DATE_SUB(NOW(), INTERVAL 1 HOUR));
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `Archiwizuj_klucz`;
DELIMITER ;;
CREATE TRIGGER `Archiwizuj_klucz` AFTER DELETE ON `Kluczewolne` FOR EACH ROW BEGIN

INSERT INTO Klucze
(Klucze.id_gry_klucz, Klucze.id_uzytkownika_klucz,Klucze.Data_zakupu, Klucze.Data_wyko)
Values
(old.id_gry, old.id_gracz, old.Data_zakupa, NOW());

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `Sesja_after_insert`;
DELIMITER ;;
CREATE TRIGGER `Sesja_after_insert` AFTER INSERT ON `Sesja` FOR EACH ROW BEGIN
INSERT INTO Logowanie
(Logowanie.data,Logowanie.adres_ip,Logowanie.login)
Values
(new.godzina_zalogowania, new.adres_ip_sesji, new.login);
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `Uzytkownicy_after_update`;
DELIMITER ;;
CREATE TRIGGER `Uzytkownicy_after_update` AFTER UPDATE ON `Uzytkownicy` FOR EACH ROW BEGIN
INSERT INTO Uzytkownicyarch
(Uzytkownicyarch.nazwa_uzytkownika_arch,Uzytkownicyarch.haslo_arch, Uzytkownicyarch.adres_email_arch,Uzytkownicyarch.numer_tel_arch,Uzytkownicyarch.id_kraj_arch)
Values
(old.nazwa_uzytkownika,old.haslo,old.adres_e_mail,old.numer_tel,old.id_kraj);
END
;;
DELIMITER ;
