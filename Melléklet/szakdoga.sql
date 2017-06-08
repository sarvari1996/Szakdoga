-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Gép: localhost
-- Létrehozás ideje: 2017. Már 31. 09:56
-- Kiszolgáló verziója: 5.5.53-0+deb8u1
-- PHP verzió: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `impquiz`
--
CREATE DATABASE IF NOT EXISTS `impquiz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `impquiz`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `text` varchar(200) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `bugs`
--

INSERT INTO `bugs` (`id`, `userid`, `text`) VALUES
(1, 6, 'Tetszik az oldal'),
(2, 7, 'Kevés a kérdés'),
(3, 11, 'asd<script>setTimer(function(){alert("Apu azért iszik mert te sírsz")},1000)</script>');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `text` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `rank` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `chat`
--

INSERT INTO `chat` (`id`, `user`, `text`, `date`, `color`, `rank`) VALUES
(10, 'admin', 'Asd', '11:27', 'black', '1'),
(11, 'admin ', '\'dsadsad', '21:27', 'black', '1'),
(12, 'Pite', 'Elég jó a chat', '01:06', 'black', '1'),
(13, 'Pite', 'Szin is működik', '01:07', 'orange', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `text` varchar(1000) COLLATE utf8_hungarian_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `news`
--

INSERT INTO `news` (`id`, `userid`, `title`, `text`, `date`) VALUES
(1, 1, 'Első Poszt', 'Ez itt a főoldal, ha van bármiféle tanácsod az oldallal kapcsolatban bal felül továbbíthatod bejelentkezés után .', '2017-03-28'),
(2, 1, 'Css használat is lehetséges a posztolásnál', 'Példák: \r\n<br /> <a href="http://impossiblequiz.hu/index.php?page=gameopt"> Oldalam </a> \r\n<br /> <p style="font-size:30px;"> sadasd </p>\r\n<br /> <p style="color:red"> sadasd </p>\r\n', '2017-03-29');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `difficulty` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `background` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `answer1` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `answer2` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `answer3` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `answer4` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `correct` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `difficulty`, `background`, `answer1`, `answer2`, `answer3`, `answer4`, `correct`) VALUES
(1, 'Háromszög területe?', 'Matek', '1', '', '(A * Ma) / 2', 'A + B + C', '(A * B) / 2', '(A + Ma) * 2', '1'),
(2, 'Kocka térfogat képlete?', 'Matek', '1', '', 'A * A * A', '(A + B) * 2', 'A * C * B', 'A * 4', '1'),
(3, 'Legkisebb 2 jegyű prímszám?', 'Matek', '2', '', '11', '13', '10', '12', '1'),
(4, '3*(3+1) ?', 'Matek', '1', '', '12', '10', '9', '11', '1'),
(5, 'Háromszög belső szögeinek összege?', 'Matek', '1', '', '180°', '360°', '90°', '120°', '1'),
(6, 'Oroszország fővárosa?', 'Földrajz', '2', '', 'Moszkva', 'Varsó', 'Voronyezs', 'Szaratov', '1'),
(7, 'Ausztria fővárosa?', 'Történelem', '1', '', 'Bécs', 'Pécs', 'Berlin', 'München', '1'),
(8, 'Szarvasmarha gyomra hány részből áll?', 'Biológia', '1', '', '4', '3', '1', '2', '1'),
(9, 'Hány pár bordája van egy embernek?', 'Biológia', '2', '', '12', '18', '14', '24', '1'),
(10, 'Hány csigojából épül fel a gerinc?', 'Biológia', '3', '', '32-34', '18-20', '26-28', '22-24', '1'),
(11, 'Hitler mikor lett kancellár?', 'Történelem', '3', '', '1933. január 30', '1932. január 30', '1933. február 25', '1934. január 30', '1'),
(12, 'Mi Japán fővárosa?', 'Földrajz', '1', '', 'Tokió', 'Budapest', 'Berlin', 'Hirosima', '1'),
(13, 'Hol hajóztak a vikingek?', 'Történelem', '1', '', 'Izland, Grönland', 'Róma', 'India', 'Izrael', '1'),
(14, 'Ha egy futóversenyen megelőzöd a másodikat, hányadik helyen végzel?', 'Logikai', '2', '', 'Második', 'Harmadik', 'Első', 'Negyedik', '1'),
(15, 'Ha egy fán ül 10 holló, és egyet közülük lelövünk, hány holló marad?', 'Logikai', '1', '', '0', '10', '9', '8', '1'),
(16, 'Melyikük nem a hét törpe egyike?', 'Alapok', '1', '', 'Hófehérke', 'Tudor', 'Hapci', 'Kuka', '1'),
(17, 'Melyik verset NEM Csokonai Vitéz Mihály írta?', 'Magyar', '2', '', 'A vén cigány', 'Szerelemdal a csikóbőrös kulacshoz', 'A Reményhez', 'Szegény Zsuzsi, a táborozáskor', '1'),
(18, 'Melyik verset NEM József Attial írta?', 'Magyar', '1', '', 'A merengőhöz', 'Óda', 'Favágó', 'Mama', '1'),
(19, 'Melyik verset NEM Arany János írta?', 'Magyar', '2', '', 'Loci óriás lesz', 'Toldi', 'Mátyás anyja', 'Vojtina ars poeticája', '1'),
(20, 'Melyik verset NEM Tóth Árpád írta?', 'Magyar', '2', '', 'Előre!', 'Körúti hajnal', 'Jó éjszakát!', 'Esti sugárkoszorú', '1'),
(21, 'Kinek a nevéhez köthető a Ratio Educationis?', 'Történelem', '1', '', 'Mária Terézia', 'Szapolyai János', 'II. József', 'I. Ferenc József', '1'),
(22, 'Hadjáratot indított Nápoly és Belz ellen is', 'Történelem', '3', '', 'Nagy Lajos', 'Hunyadi Mátyás', 'Luxemburgi Zsigmond', 'I. Ferdinánd', '1'),
(23, 'Ki volt az utolsó magyar király?', 'Történelem', '2', '', 'IV. Károly', 'V. Károly', 'VI. Károly', 'V. Ferdinánd', '1'),
(24, 'Létrehozta a Sárkány Lovagrendet.', 'Történelem', '3', '', 'Luxemburgi Zsigmond', 'Mária Terézia', 'Hunyadi Mátyás', 'Nagy Lajos', '1'),
(25, 'Mi Dánia fővárosa?', 'Földrajz', '2', '', 'Koppenhága', 'Dublin', 'Minszk', 'Athén', '1'),
(26, 'Mi Svájc fővárosa?', 'Földrajz', '1', '', 'Bern', 'Berlin', 'Bécs', 'Benf', '1'),
(27, 'Ki követte I. Andrást a trónon?', 'Történelem', '1', '', 'I. Béla', 'III. Béla', 'IV. Béla', 'V. Béla', '1'),
(28, 'Mikor volt a tatárjárás?', 'Történelem', '2', '', '1241-1242', '1242-1243', '1242-1244', '1241-1244', '1'),
(29, 'Mikor volt a honfoglalás?', 'Történelem', '1', '', '895-900', '890-895', '895-901', '890-894', '1'),
(30, 'Hány évig uralkodott III. András?', 'Történelem', '2', '', '11', '19', '20', '21', '1'),
(31, 'Melyik országban volt a legmagasabb a munkanélküliség 1933-ban?', 'Történelem', '2', '', 'Németország', 'USA', 'Franciaország', 'Olaszország', '1'),
(32, 'Az ókori Numidia melyik kontinensen volt?', 'Történelem', '1', '', 'Afrika', 'Európa', 'Ázsia', 'Ausztrália', '1'),
(33, 'Mikor volt a honfoglalás második szakasza?', 'Történelem', '2', '', '900 - 907', '901 - 906', '895 - 900', '900- 906', '1'),
(34, 'Mikor volt a mohácsi csata?', 'Történelem', '1', '', '1526', '1527', '1524', '1555', '1'),
(35, 'Mikor halt ki az Árpád - ház?', 'Történelem', '1', '', '1301', '1300', '1201', '1200', '1'),
(36, 'Mikor volt a Dózsa-féle parasztháború?', 'Történelem', '3', '', '1514', '1520', '1505', '1612', '1'),
(37, 'Mikor jött létre az Osztrák-Magyar Monarchia?', 'Történelem', '3', '', '1867', '1900', '1851', '1850', '1'),
(38, 'Az USA Függetlenségi Nyilatkozat kiadása.', 'Történelem', '3', '', '1776. július 4.', '1775. július 4.', '1776. június 4.', '1775. június 4.', '1'),
(39, 'Mikor volt a trianoni békeszerződés?', 'Történelem', '3', '', '1920. június 4.', '1921. június 5.', '1920. július 5.', '1921. július 4.', '1'),
(40, 'Aranybulla kiadása', 'Történelem', '3', '', '1222. április 24.', '1222. április 5.', '1333. április 23.', '1222. június 4.', '1'),
(41, 'Ki volt Ady Endre múzsája?', 'Magyar', '2', '', 'Csinszka', 'Judit', 'Mária', 'Flóra', '1'),
(42, 'Melyik megyénk megyeszékhelye Szekszárd?', 'Földrajz', '2', '', 'Tolna', 'Csongrád', 'Vas', 'Pest', '1'),
(43, 'Hol található a Notre Dame-székesegyház? ', 'Földrajz', '2', '', 'Franciaország', 'Németország', 'Szlovákia', 'Magyarország', '1'),
(98, 'Milyen állat a matamata?', 'Biológia', '2', '', 'teknős', 'rágcsáló', 'kenguru', 'antilop', '1'),
(99, 'Hány foga van a Galléros cápának?', 'Biológia', '3', 'uploadsq/94.jpg', '300, 27 sorban', '180, 6 sorban', '3000, 28 sorban', '260, 16 sorbanhttps://upload.wikimedia.org/wikipedia/commons/0/0e/Chlamydoselach', '1'),
(44, 'Melyik város fővárosa Dakka?', 'Földrajz', '3', '', 'Banglades', 'Irak', 'Mianmar', 'Fujime', '1'),
(45, 'Ki Arész megfelelője?', 'Alapok', '3', '', 'Mars', 'Jupiter', 'Neptunusz', 'Vénusz', '1'),
(46, 'Az alábbi állítások közül melyik nem igaz a pszichológiára?', 'Logikai', '3', '', 'Elméleti tudomány ', 'Híd a természet és társadalomtudományok között ', 'Megszületése Wundt nevéhez kötődik ', 'A filozófiából nőtt ki ', '1'),
(47, 'Mi nem jellemző az introspekcióra?', 'Logikai', '3', '', 'Az állatok vizsgálatánál is alkalmazható ', 'Szubjektív módszer ', 'Beszűkíti a pszichológia vizsgálati területeit ', 'Lehetővé teszi saját lelki történéseink közvetlen vizsgálatát ', '1'),
(48, ' Az alábbi állítások közül melyik nem igaz Descartes filozófiájára? ', 'Alapok', '3', '', 'Elveti az önmegfigyelés módszerét ', 'Az emberi lélek lényegi funkciója a gondolkodás ', 'Minden lelki történésünk tudatos ', 'Nem veti el a vele született ideák gondolatát ', '1'),
(49, ' Melyik nem befolyásolja közvetlenül az önismereti játékok hatását?', 'Alapok', '3', '', 'A vezető életkora ', ' A vezető személyisége ', 'A vezető csoportvezetési tapasztalatai ', 'A csoport dinamikája ', '1'),
(50, 'Melyik állítás igaz az indulatátételre?', 'Alapok', '3', '', 'A pszichoanalízisből származik a fogalom ', 'Oka a csoportvezető tapasztalatlansága ', 'Csak nőkre jellemző ', 'Mindig két ellenkező nemű csoporttag között alakul ki ', '1'),
(51, 'Melyik nem tartozik Bagdy és Telkes által felsorolt csoportdinamikai történések közé?', 'Alapok', '3', '', 'Bűnbakképzés ', 'A csoporttá alakulás folyamata', 'A csoportstrukturálódás ', 'A csoport rendszerré szerveződésének folyamata ', '1'),
(52, 'Ki kritizálja erkölcsi szempontból a gyermekeket és fiatalokat az antik görög filozófiában?', 'Történelem', '3', '', 'Szókratész', 'Szophoklész', 'Szolon', 'Platón', '1'),
(53, 'Hány nemzedéket hasonlít össze Hegel?', 'Történelem', '3', '', 'Hármat', '  Négyet', 'Kettőt', 'Ötöt', '1'),
(54, 'Mikor mondott le a Batthyány-kormány?', 'Történelem', '3', '', ' 1848. szeptember 10. ', ' 1848. szeptember 11. ', ' 1849. szeptember 10. ', ' 1848. szeptember 1. ', '1'),
(55, 'Melyik folyón kelt át Jellasics 1848. szeptember 11-én?', 'Történelem', '3', '', 'Dráva', 'Duna', 'Rába', 'TIsza', '1'),
(56, 'Melyik várost foglalta el Jellasics 1848. szeptember 26-án?', 'Történelem', '3', '', 'Székesfehérvár', 'Budapest', 'Győr', 'Pápa', '1'),
(57, 'Mikor volt a pákozdi csata?', 'Történelem', '3', '', '1848. szeptember 29. ', '1849. szeptember 29. ', '1858. szeptember 29. ', '1848. szeptember 28. ', '1'),
(58, 'Hány napos fegyverszünetet kötött a pákózdi csata után Jellasics és Móga?', 'Történelem', '3', '', '3', '4', '2', '5', '1'),
(59, ' Hányszor kelt át Móga a Lajtán, míg végül megütközött az osztrákokkal Schwechatnál?', 'Történelem', '3', '', '3', '30', '15', '5', '1'),
(60, 'Mikor volt a schwechati ütközet?', 'Történelem', '3', '', '1848. október 30. ', '1849. október 30. ', '1838. október 30. ', '1838. október 30. ', '1'),
(64, 'Mikor volt az államalapítás?', 'Történelem', '1', 'uploadsq/60.jpg', '1000', '2000', 'Kr.e. 1000', 'Még nem volt.', '1'),
(65, 'Mi Magyarország fővárosa?', 'Földrajz', '1', 'uploadsq/61.jpg', 'Budapest', 'Bécs', 'Bukarest', 'Berlin', '1'),
(66, 'Hogy nevezik a mai embert idegen nyelven?', 'Biológia', '1', 'uploadsq/62.jpg', 'Homo sapiens sapiens.', 'Hobo sapiens.', 'Homo habilis.', 'Hobo habilis habilis.', '1'),
(67, 'Az özvegyasszony férje megnősülhet-e?', 'Logikai', '1', 'uploadsq/63.jpg', 'A férj már meghalt, tehát nem.', 'Egyértelműen igen.', 'A férj nem nősülhet meg, mert már nős.', 'A feleség meghalt, tehát igen.', '1'),
(68, 'Egy köbméter víz =', 'Matek', '2', '', '10000 Deciliter', '100 000 Köbcenti', '1 Hektoliter', '100 Liter ', '1'),
(69, 'Az alábbiak közül, melyik Petőfi Sándor verse?', 'Magyar', '1', 'uploadsq/65.jpg', 'Szeptember végén', 'Nem én kiáltok', 'Himnusz', 'Egy gondolat bánt tégedet', '1'),
(70, 'Piacon az alma ára 310 forint/darab, hány almát tud venni pistike 1500 forintból?', 'Matek', '1', 'uploadsq/66.jpg', '4', '3', '5', '6', '1'),
(71, 'Melyik szám négyzetszám?', 'Matek', '1', 'uploadsq/67.png', '16', '26', '35', '6', '1'),
(72, 'Ki volt Jézus Krisztus?', 'Alapok', '1', '', 'A kereszténység központi személye', 'Amerika első elnöke', 'Spártai rabszolgakitörés vezetője', 'Egy felfedező', '1'),
(73, 'Hogy nevezik a föld legmagasabb csúcsát?', 'Földrajz', '1', 'uploadsq/69.jpg', 'Mount Everest', 'Kékes', 'Mount Blanck', 'Le Blanc', '1'),
(74, 'Miért nem képes az ember víz alatt lélegezni?', 'Biológia', '1', '', 'Víz nem tud távozni a tüdőből', 'Tüdő nem képes vízben leadni a szén-dioxidot', 'Víz oxigéntartalma alacsony', 'Nem képes az oldott oxigén felvételére', '1'),
(75, 'Melyik a világ leggyorsabb állata?', 'Biológia', '1', 'uploadsq/71.jpg', 'Gepárd', 'Elefánt', 'Csiga', 'Bálna', '1'),
(79, 'Mennyi ennek az egyenletnek az eredménye? (10*0,5+5)', 'Matek', '2', 'uploadsq/75.jpg', '10', '5', '7,5', '2', '1'),
(76, 'Hányadik vagy a futóversenyen ha megelőzöd a 2.-at?', 'Logikai', '1', 'uploadsq/72.jpg', '2', '5', '1', '8', '1'),
(77, 'Ki volt János Vitéz?', 'Magyar', '1', 'uploadsq/73.jpg', 'Kukorica Jancsi', 'Burgonya Károly', 'Répa János', 'Borsó Levente', '1'),
(78, 'Mikor volt az (első) Aranybulla?', 'Történelem', '2', 'uploadsq/74.jpg', '1222', '1444', '1333', '1111', '1'),
(80, 'Melyik a Föld legvastagabb folyója?', 'Földrajz', '2', 'uploadsq/76.jpg', 'Amazonas', 'Duna', 'Missisipi', 'Nílus', '1'),
(81, 'Mi a DNS?', 'Biológia', '2', 'uploadsq/77.jpg', 'dezoxiribonukleinsav', 'ribonukleinsav', 'deribonukleinsav', 'redezoxiribonukleinsav', '1'),
(82, 'Ki nem Disney mesehős?', 'Alapok', '1', '', 'Shrek', 'Dumbó', 'Aladdin', 'Ficánka', '1'),
(83, '7 szénarakás meg 5 szénarakás együt hány szénarakás?', 'Logikai', '2', 'uploadsq/79.jpg', '1 szénarakás', '12 szénarakás', '2 szénarakás', '10 szénarakás', '1'),
(84, 'Milyen névvel született Dsida Jenő?', 'Magyar', '2', 'uploadsq/80.jpg', 'Binder Jenő Emil', 'Kovács Jenő', 'Jenő Károly', 'Kiss Jeromos', '1'),
(85, 'Ki volt az utolsó Árpádházi király?', 'Történelem', '2', 'uploadsq/81.jpg', 'III. András', 'II. János', 'IV. Károly', 'I. István', '1'),
(86, 'Melyik a Pitagorasz tétel képlete?', 'Matek', '2', 'uploadsq/82.png', 'C*C = A*A + B*B', '2AC = A + B', 'B = 2C + 3A', '4A = 4B + 4C', '1'),
(87, 'Mi Afrika legdélebbi városa?', 'Földrajz', '3', '', 'Fokváros', 'Isztambul', 'Mozambik', 'Szingapur', '1'),
(88, 'Hát tagállama volt összesen a Szovjetuniónak fennállása során?', 'Történelem', '2', '', '17', '15', '19', '13', '1'),
(89, 'Mi a genetikai kód?', 'Biológia', '2', 'uploadsq/85.png', 'Egy jelrendszer', 'Egy hat számjegyű kód', 'A telefon feloldásához szükséges kód', 'Genetikai mutációk által létrejött kód', '1'),
(90, 'Hány csillag van az Amerikai Egyesült Államok zászlaján?', 'Alapok', '1', '', '50', '40', '51', '45', '1'),
(91, 'Ki volt Ceaușescu?', 'Történelem', '2', '', 'Román kommunista politikus diktátora', 'Csau-csau  kutyafaj névadója', 'Japán feltaláló', 'Lengyel pártvezető', '1'),
(92, 'Hogy mondjuk helyesen?', 'Logikai', '2', 'uploadsq/88.jpg', 'Sehogy', 'A egyenes kanyar', 'Az egyenes kanyar', 'Egy egyenes kanyar', '1'),
(93, 'Ki a legnagyobb magyar?', 'Magyar', '2', 'uploadsq/89.png', 'Széchenyi István', 'Petőfi Sándor', 'Arany János', 'Ady Endre', '1'),
(94, 'Kiről nevezték el Amerikát?', 'Történelem', '3', 'uploadsq/90.jpg', 'Amerigo Vespucci', 'Kolombusz Kristóf', 'Americano Ramirez', 'Barack Obama', '1'),
(95, 'Mi a 2x*x deriváltja?', 'Matek', '3', '', '2x', 'x', '2', '1', '1'),
(96, 'Fejezd be a közmondást! Egy fecske ...', 'Magyar', '1', '', 'nem csinál nyarat', 'ül a dróton', 'sokat hoz magával', 'hozza a tavaszt', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `questiontypes`
--

CREATE TABLE `questiontypes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `questiontypes`
--

INSERT INTO `questiontypes` (`id`, `name`) VALUES
(1, 'Történelem'),
(2, 'Matek'),
(3, 'Földrajz'),
(4, 'Biológia'),
(5, 'Logikai'),
(6, 'Alapok'),
(7, 'Magyar');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `gametype` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `records`
--

INSERT INTO `records` (`id`, `userid`, `gametype`, `points`) VALUES
(1, 1, 1, 31382),
(2, 1, 2, 1880),
(3, 1, 3, 0),
(4, 2, 1, 34650),
(5, 2, 2, 34300),
(6, 2, 3, 2210),
(7, 3, 1, 0),
(8, 3, 2, 0),
(9, 3, 3, 0),
(10, 4, 1, 14410),
(11, 4, 2, 12130),
(12, 4, 3, 3060),
(13, 5, 1, 15040),
(14, 5, 2, 1800),
(15, 5, 3, 3270),
(16, 6, 1, 13960),
(17, 6, 2, 3510),
(18, 6, 3, 0),
(19, 7, 1, 1880),
(20, 7, 2, 1690),
(21, 7, 3, 1930),
(22, 8, 1, 3020),
(23, 8, 2, 0),
(24, 8, 3, 0),
(25, 9, 1, 0),
(26, 9, 2, 0),
(27, 9, 3, 0),
(28, 10, 1, 37618),
(29, 10, 2, 16170),
(30, 10, 3, 16210),
(31, 11, 1, 7950),
(32, 11, 2, 3490),
(33, 11, 3, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `startedgame`
--

CREATE TABLE `startedgame` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `q1id` int(3) NOT NULL,
  `q2id` int(3) NOT NULL,
  `q3id` int(3) NOT NULL,
  `q4id` int(3) NOT NULL,
  `q5id` int(3) NOT NULL,
  `q6id` int(3) NOT NULL,
  `q7id` int(3) NOT NULL,
  `q8id` int(3) NOT NULL,
  `q9id` int(3) NOT NULL,
  `q10id` int(3) NOT NULL,
  `q11id` int(3) NOT NULL,
  `q12id` int(3) NOT NULL,
  `q13id` int(3) NOT NULL,
  `q14id` int(3) NOT NULL,
  `q15id` int(3) NOT NULL,
  `qnow` int(2) NOT NULL,
  `help1` tinyint(4) NOT NULL,
  `help2` tinyint(4) NOT NULL,
  `help3` tinyint(4) NOT NULL,
  `help4` tinyint(4) NOT NULL,
  `points` int(11) NOT NULL,
  `difficult` int(1) NOT NULL,
  `round` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `startedgame`
--

INSERT INTO `startedgame` (`id`, `userid`, `q1id`, `q2id`, `q3id`, `q4id`, `q5id`, `q6id`, `q7id`, `q8id`, `q9id`, `q10id`, `q11id`, `q12id`, `q13id`, `q14id`, `q15id`, `qnow`, `help1`, `help2`, `help3`, `help4`, `points`, `difficult`, `round`) VALUES
(54, '5', 42, 3, 89, 43, 9, 86, 28, 23, 91, 30, 88, 92, 68, 33, 19, 4, 1, 1, 1, 1, 5330, 2, 0),
(62, '6', 60, 56, 22, 10, 24, 51, 47, 45, 49, 57, 39, 38, 95, 48, 50, 3, 0, 1, 1, 1, 3690, 3, 1),
(71, '9', 66, 69, 35, 72, 96, 32, 13, 73, 67, 27, 7, 4, 12, 1, 90, 3, 1, 1, 1, 1, 2460, 1, 0),
(110, '2', 69, 8, 27, 29, 35, 71, 67, 2, 32, 15, 5, 64, 82, 18, 73, 3, 1, 1, 1, 1, 3200, 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `permission` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `points` int(11) NOT NULL,
  `icon` text COLLATE utf8_hungarian_ci NOT NULL,
  `chatcolor` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permission`, `points`, `icon`, `chatcolor`) VALUES
(1, 'admin', 'admin@admin.admin', 'cb320a6bcef939396896f4db21b0d3b5', 'admin', 314, 'kép', 'black'),
(2, 'Anya', 'verebandrusz@gmail.com', 'a9af98319dd191317e465e4386fd672e', 'admin', 343, 'kép', 'black'),
(3, 'Csogi', 'bonczibogi@gmail.com', 'cbfc964c71c26d1d6d7ce3848e09b0bf', 'user', 0, 'kép', 'black'),
(4, 'keriaki', 'keriaki98@gmail.com', '164b27d0a07c8f1f5b3bb57e098b743b', 'admin', 594, 'kép', 'black'),
(5, 'Valamirandom', 'Valamirandom@asd', '7e3996a5099dd084aa00030cc786bd8b', 'user', 371, 'kép', 'black'),
(6, 'Alma', 'Alma@sfd', 'df3c0fd25753a29b71130a19b3d296b8', 'user', 230, 'kép', 'black'),
(7, 'Pite', 'sadasf@fd', '1b466f7319ca85c86f94ac992b63f52d', 'user', 55, 'kép', 'orange'),
(8, 'BiRo', 'rolandbihary@gmail.com', 'a13c55d630e4e725dc3bfac84bacb630', 'user', 30, 'kép', 'black'),
(9, 'Pityo10000', 'Pityo10000@gmail.com', 'f0926631e5decb3f3981b73f9e149fdb', 'user', 0, 'kép', 'black'),
(10, 'Jigglypuff', 'catlover@citromail.hu', 'cd38bca986f257b71609f55115cf855d', 'admin', 619, 'kép', 'brown'),
(11, 'Kebab', 'kebalazs95@gmail.com', '668b64faec29ec6f3894a2a8d2731595', 'user', 115, 'kép', 'black');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `questiontypes`
--
ALTER TABLE `questiontypes`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `startedgame`
--
ALTER TABLE `startedgame`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT a táblához `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT a táblához `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT a táblához `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT a táblához `questiontypes`
--
ALTER TABLE `questiontypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT a táblához `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT a táblához `startedgame`
--
ALTER TABLE `startedgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
