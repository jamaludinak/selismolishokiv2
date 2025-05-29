-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2025 at 11:04 AM
-- Server version: 10.11.11-MariaDB-cll-lve
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sele2143_selis_molis_hoki`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggans`
--

CREATE TABLE `data_pelanggans` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noHP` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluhan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_pelanggans`
--

INSERT INTO `data_pelanggans` (`id`, `kode`, `nama`, `noHP`, `alamat`, `keluhan`, `created_at`, `updated_at`) VALUES
(1, 'P1', 'Didi', '085811737583', 'Cinangka, Sawangan, Depok, Jawa barat', 'Servis ban Sepeda listrik Mandalika', NULL, '2024-10-29 10:28:14'),
(2, 'P2', 'Buang', '082125539900', 'Saphire residence Karangwangkal, Purwokerto, Jawa Tengah', 'Servis Aki Sepeda listrik Trike Butterfly', NULL, NULL),
(3, 'P3', 'Akhmad Nur Irfan', '089529960776', 'Cilacap, Jawa tengah', 'Ganti Kontroler Sepeda listrik Uwinfly Butterfly', NULL, NULL),
(4, 'P4', 'Taufik', '081212808293', 'Jl. Me Wira Gg. Kp. Jati No.RT 01, RW05, Kec. Parung, Kabupaten Bogor, Jawa Barat 16330', 'Servis Panggilan Langganan', NULL, NULL),
(5, 'P5', 'Mama Daffa', '081318828887', 'Jl. Me Wira Gg. Kp. Jati No.RT 01, RW05, Kec. Parung, Kabupaten Bogor, Jawa Barat 16330', 'Servis Panggilan Langganan', NULL, NULL),
(6, 'P6', 'fii Nur', '081339209388', 'Purbalingga, Jawa tengah', 'Servis kelistrikan sekunder MOLIS Uwinfly Bluewhale', NULL, NULL),
(7, 'P7', 'bagas', '08990569025', 'Pasar Cerme, Purwokerto', 'Servis ban Skuter 365', NULL, NULL),
(8, 'P8', 'Juki', '085747000088', 'Pasar Cerme, Purwokerto', 'Servis ban Skuter 365', NULL, NULL),
(9, 'P9', 'Wawan Satya', '087820080208', 'Grand Depok City, Depok, Jawa barat', 'Pasang Standar Skuter 365 Clone', NULL, NULL),
(10, 'P10', 'Wahyu Hukama', '087870189706', 'Depok, Jawa barat', 'Konsultasi Motor listrik', NULL, NULL),
(11, 'P11', 'Anton', '08111984800', 'Menteng, Jakarta Pusat', 'Ganti Aki Motoran Aki 6v 4 biji', NULL, NULL),
(12, 'P12', 'Akhmad baidawi (Wiwit)', '085731088123', 'Sumenep, Jawa Timur', 'Custom baterai 36v 7,8Ah untuk Sepeda DYU VIP', NULL, NULL),
(13, 'P13', 'Rico ferdian', '081273363361', 'Lampung ', 'Custom baterai 24v 10Ah untuk Skuter Mobot', NULL, NULL),
(14, 'P14', 'Mentari Toys', '081540000900', 'Ajibarang, Purwokerto, Jawa Tengah', 'Custom baterai Li-ion untuk Mobilan Aki 12v 6Ah', NULL, NULL),
(15, 'P15', 'Abay', '085771276293', 'Pamulang, Tanggerang Selatan', 'Beli throttle gas-gasan standar Universal bekas Trike Ici', NULL, NULL),
(16, 'P16', 'Eni', '081905325268', 'Teluk, Purwokerto', 'Reseller dan Marketing', NULL, NULL),
(17, 'P17', 'Taufik Hidayat', '08129485809', 'Beji, Kota Depok Jawa barat', 'Beli Kokntroler brushed 24v 250watt', NULL, NULL),
(18, 'P18', 'Sri Mulyani mung', '085832109267', 'Curug, Sawangan Depok, Jawa barat', 'Servis Panggilan Langganan', NULL, NULL),
(19, 'P19', '', '082249017871', 'Perumahan Brandweer Parung, Bogor', 'Servis Panggilan Langganan', NULL, NULL),
(20, 'P20', 'Mufqi', '0881024989279', 'Gunung Sindur, Bogor', 'Servis Selis kendala Tidak bisa menyala walau batre full', NULL, NULL),
(21, 'P21', 'Rizki ayu', '081298686354', 'Pondok Cabe ilir, Tanggerang Selatan', 'Servis ban ganti pentil Tubless Sepeda listrik Murai', NULL, NULL),
(22, 'P22', 'Karsito', '08159374297', 'Jln, Masjid jami Nurul huda kp.sawah rt.02/rw.03 Desa Pamegarsari parung Bogor Jawa barat 16330', 'Servis Sepeda listrik rental', NULL, NULL),
(23, 'P23', 'Rian Sopian', '081574922439', 'Perumahan Griya Sasmita Serua, Depok Jawa barat', 'Servis panggilan Selis Betrix rusak kontroler dan saklar kontak', NULL, NULL),
(24, 'P24', 'Nasir', '081218001235', 'Perumahan Alam Pesona Wanajaya Blok P1 No 9, Cibitung jawa barat', 'Servis baterai Lithium dan pesan baterai Lifepo4', NULL, NULL),
(25, 'P25', 'Nardi', '08122786685', 'Jln Sampar angin RT 2 RW 1 teluk, Purwokerto Jawa Tengah', 'Servis charger dan ganti Aki Sepeda listrik United dan Motor listrik Sunrace ', NULL, NULL),
(26, 'P26', 'reza Gunawan', '089675635002', 'Sumpiuh Purwokerto Jawa tengah', 'Servis baterai Lithium 36v 10Ah Skuter listirk', NULL, NULL),
(27, 'P27', 'Chamid/Ridho', '085867832590', 'blakang sdn 1 banjaranyar, Dusun I, Banjaranyar, Kec. Sokaraja, Kabupaten Banyumas, Jawa Tengah', 'Servis sepeda listrik Mati kalo digas full', NULL, NULL),
(28, 'P28', 'Sri haryani ', '082134771602', 'Dusun I, Banjaranyar, Kec. Sokaraja, Kabupaten Banyumas, Jawa Tengah', 'Servis sepeda listrik Aki drop dan rem macet', NULL, NULL),
(29, 'P29', 'Dedi hidayat', '085659755711', 'jl. kabandungan no 90 Cikole, Kota Sukabumi, Jawa Barat', 'Baterai Lithium 24v 10Ah untuk skuter listrik', NULL, NULL),
(30, 'P30', 'mujiah', '085643373617', 'Sokaraja Banjaranyar, kabupaten Banyumas, Jawa tengah', 'Restorasi sepeda listrik VITA-t Rusak sebagian', NULL, NULL),
(31, 'P31', 'Sinta', '085890357094', 'Jl. Pertiwi XI 898, Kedaung, Kec. Sawangan, Kota Depok, Jawa Barat 16516', 'Servis kelistrikan Selis Mandalika + Ganti ban', NULL, NULL),
(32, 'P32', 'Aska', '081386464647', 'rumah bajedong, RT.02/RW.re 05Depok, Bojongsari Baru, Kec. Bojongsari, Kota Depok, Jawa Barat 16516', 'Ganti Aki Sepeda listrik SELIS Butterfly', NULL, NULL),
(33, 'P33', 'Joko Hartono', '081563873485', 'Rumah baJoko Jl. Rw. Pule 5, Kukusan, Kecamatan Beji, Kota Depok, Jawa Barat 16425', 'Ganti Aki Sepeda listrik Selis Go green', NULL, NULL),
(34, 'P34', 'Tri Muryanto', '081271463246', 'Jl H Usa CIseeng  panorama bali residence blok i 15 no 3 an Tri Muryanto', 'Cek kelistrikan Molis Uwinfly Bluewhale ', NULL, NULL),
(35, 'P35', 'Andri', '08117776556', 'Kepulauan Riau Bintan Utara tg.Uban', 'Servis baterai Li-ion sepeda listrik DYU', NULL, NULL),
(36, 'P36', 'Iyan', '081383578726', '', 'Custom Baterai Li-ion 48v 20Ah', NULL, NULL),
(37, 'P37', 'Eka Harisanjaya', '087808737830', 'jl kubis 4. Rt04/05. Pondok cabe ilir 5. Patokannya deket samping rumah baamil basri. Rumah mamah arkan.', 'Ganti Aki sepeda listrik Goda', NULL, NULL),
(38, 'P38', 'Syaiful', '083879133313', 'Jalan raya curg rt003 rw 08 bgkel las berkah mandiri, Bojongsari Depok ', 'Servis Aki sepeda listrik kabel putus', NULL, NULL),
(39, 'P39', 'Santi', '08997781071', 'Depok, Curug, Kec. Bojongsari, Kota Depok, Jawa Barat 16517', 'Servis Sepeda listrik Aku rusak', NULL, NULL),
(40, 'P40', 'Abdul Basit', '085348280592', 'Jl. Pinang Raya, RT.2/RW.14, Pamulang Tim., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417', 'Servis sepeda listrik kontroler rusak', NULL, NULL),
(41, 'P41', 'Faris', '081911188259', 'Jl.Mahoni Blok A2 no.9 Perumahan Griya Jakarta Tanggerang ', 'Modifikasi Molis Volta 301 tambah bagasi belakang dan servis lampu', NULL, NULL),
(42, 'P42', 'Ipul', '085782920707', 'Jl. Pinang Raya, RT.2/RW.14, Pamulang Tim., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417', 'Servis sepeda listrik Aki soak', NULL, NULL),
(43, 'P43', 'Tofik', '087780232134', 'Jl. Me Wira Gg. Kp. Jati No.RT 01, RW05, Kec. Parung, Kabupaten Bogor, Jawa Barat 16330', 'Servis Sepeda listrik Stang oblak', NULL, NULL),
(44, 'P44', 'Ferry', '082135661100', 'Jl.martadireja 2 gg.sitinggil 3 4/7 mersi, Purwokerto jawa tengah', 'Servis Sepeda listrik dan Custom baterai li-ion untuk Mobilan anak', NULL, NULL),
(45, 'P45', 'Wildhan anorraga', '081239239241', 'Persada Kemala Blok 21 no. 11, Jaka sampurna, bekasi barat Bekasi Barat, Kota Bekasi, Jawa Barat 17145', 'Custom Baterai Li-ion 24v 8Ah', NULL, NULL),
(46, 'P46', 'Yudi Aryanto', '081310111611', 'Jl. Manunggal IV No. 165 RT. 002 RW.008, Kel. Pondok Aren, Kec. Pondok Aren, Kota Tangerang Selatan, Banten. 15424', 'Servis Sepeda listrik Konslet Soket kendor', NULL, NULL),
(47, 'P47', 'Iis Nafisah', '081393161526', 'Perum Safire Village Blok U 12 Rempoah Pandak Baturaden, Purwokerto', 'Servis Sepeda listrik Speedometer rusak', NULL, NULL),
(48, 'P48', 'Farid', '085600006064', 'Jl. Ksatrian, Karangkobar, Sokanegara, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53115', 'Servis baterai Li-ion 36v 6Ah', NULL, NULL),
(49, 'P49', 'Armin', '081326757240', '', 'Reseller Sepeda listrik dan Sparepart', NULL, NULL),
(50, 'P50', 'Eko', '081315556776', 'Jl. Kp. Kb. Kopi, Kec. Gn. Sindur, Bogor, Jawa Barat, 16340 [Tokopedia Note: Perumahan Sanur Valley uluwatu 1 no 2]\nGunung Sindur, Kab. Bogor, Jawa Barat 16340', 'Servis baterai Li-ion 36v Selis EOI', NULL, NULL),
(51, 'P51', 'Fariz RZ', '081384899940', '', 'Project Pengembangan Sound booster v2.1', NULL, NULL),
(52, 'P52', 'Rudi', '085227360240', 'Purbalingga', 'Servis sepeda listrik Richey Sekring sering putus', NULL, NULL),
(53, 'P53', 'Supriatin', '082325672820', 'Sumpiuh rt 01 rw 03,kec sumpiuh,kab banyumasan 53195', 'Servis Charger Sepeda litrik Edison tidak bisa ngecas', NULL, NULL),
(54, 'P54', 'Afif Teknisi', '085869631551', 'Jl. Jend. Sudirman No.745, Pertabatan, Purwokerto Kidul, Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53147', 'Ganti Aki sepeda listrik', NULL, NULL),
(55, 'P55', 'Babeh Obor', '087776449634', 'Jl. Jend. Sudirman No.745, Pertabatan, Purwokerto Kidul, Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53147', 'Servis Aki Sepeda lisrtrik', NULL, NULL),
(56, 'P56', 'Reno', '085649915665', 'Jl. Taruna VIIIc kav 290c (masuk gang samping SD Muhammadiyah Ikrom,rumah tingkat tembok keramik merah)\nTaman, Kab. Sidoarjo, Jawa Timur 61257', 'Pesan kontroler VOTOL em-50s 14 Unit', NULL, NULL),
(57, 'P57', 'Fiqry', '081295435170', '', 'Servis baterai hoverboard', NULL, NULL),
(58, 'P58', 'Eka', '087778550270', 'jl kubis 4. Rt04/05. Pondok cabe ilir 5. Patokannya deket samping rumah baamil basri. Rumah mamah arkan.', 'Ganti Aki Sepeda listrik GODA ', NULL, NULL),
(59, 'P59', 'Nanda', '088213462873', 'Curug bulak, Depok Jawa barat', 'Modifikasi Motor listrik Tangkas P6', NULL, NULL),
(60, 'P60', 'Edy', '085642349981', 'kanalsari barat gang 4 nomer 38 semarang 50125', 'Beli kontroler Sepeda listrik 36-48v 350watt Sensorless', NULL, NULL),
(61, 'P61', 'Taufiq', '089677726708', 'Bojonegoro', 'Tanya Bagaimana Ganti kontroler Selis 250watt', NULL, NULL),
(62, 'P62', 'Iwan Meilana', '087884425225', 'Jakarta Barat', 'Pesan Alat penggabung Charger Sepeda listrik 2 in 1', NULL, NULL),
(63, 'P63', 'Opik', '085715439645', 'Depan Mesjid As-Syekh Parung ME. Wira', 'Servis sepeda listrik Viar U1 Velg belakang panas', NULL, NULL),
(64, 'P64', 'Kiss Nur', '088291880683', 'Sawangan Depok Jawa barat', 'Servis Selis LCD Error', NULL, NULL),
(65, 'P65', 'Azzam', '081287881186', 'Tjitra residen blok b2 no10 kalisuren, Tajur halang kabupaten Bogor Kode pos 16320', 'Servis Dinamo Selis IOI Kabel putus', NULL, NULL),
(66, 'P66', 'Saiful', '082234408876', 'Surabaya, Jawa timur ', 'Modif Kontroler Sepeda listrik 48v 500w menaikkan Torsi', NULL, NULL),
(67, 'P67', 'Toni', '085725676529', 'Baturraden Purwokerto, Jawa tengah', 'Beli Throttle gas 1 pasang untuk Skuter listrik', NULL, NULL),
(68, 'P68', 'Ripto Bazur', '085227446448', 'Karangnanas Purwokerto Selatan', 'Pembelian Uni Tricycle Uwinfly Romeo Plus', NULL, NULL),
(69, 'P69', 'Aji', '085290893537', 'Jl Gn Srandil No 16 ,Karangwangkal, RT.3/RW.3, Karangwangkal, UNSOED, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53122', 'Servis Sepeda listrik Sunrace Shockbreaker Depan oblak', NULL, NULL),
(70, 'P70', 'Oji', '088806629128', 'Karangbawang Purwokerto selatan', 'Servis Sepeda listrik tidak bisa dipake', NULL, NULL),
(71, 'P71', 'Anto', '085385023211', 'Berkoh, KebontePurwokerto Selatan', 'Ganti Aki dan Restorasi Selis Butterfly', NULL, NULL),
(72, 'P72', 'Abdul', '082225001224', 'Karangnanas Purwokerto Selatan', 'Cas Aki motor Satria FU 5Ah', NULL, NULL),
(73, 'P73', 'TK SPD obor', '085741252044', 'Perintis kemerdekaan', 'TDK bs cas', NULL, '2025-01-02 20:21:26'),
(74, 'P74', 'Jefry', '085747180993', 'Sokawera, BanyuJawa Tengah', 'bantuin step Molina', NULL, NULL),
(75, 'P75', 'Eko Husna Sanum', '089666755420', 'Jln Hosnotosuwiryo Teluk, Purwokerto Selatan', 'Restorasi Servis sepeda listrik', NULL, NULL),
(76, 'P76', 'Anam', '081215883455', 'Jl.kali bener pabrik es wiriako utama rt 2 RW 2 Penisian, Kec. Purwokerto Sel. 53141 belangkang masjid Nurul Jannah', 'Servis Sepeda listrik Volta Gas tidak respon', NULL, NULL),
(77, 'P77', 'Indra', '085227053571', 'Jlkaliputih, Purwokerto Wetan, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53111', 'Servis Sepeda listrik Lankeleisei', NULL, NULL),
(78, 'P78', 'Rouf', '0811-776644', 'Baturraden Purwokerto Jaw jawa tengah ', 'Servis Skuter listrik Mr.Jackie gas putus-putus', NULL, NULL),
(79, 'P79', 'Cruz', '082225696798', 'Perumahan Pondok Indah desa Suka damai Blok O.32', 'Servis Sepeda listrik United Throttle patah', NULL, NULL),
(80, 'P80', 'Ahmad Mukorobin', '085877062072', 'Griya Satria Mandalatama Blok 37/15, Karanglewas ,Purwokerto Barat Jawa Tengah 53161', 'Servis Motor listrik Uwinfly T3 tidak bisa dicas', NULL, NULL),
(81, 'P81', 'Warung Sate Min', '082261134594', 'Jl. Sumbang-Limpakuwus, Dusun II, Kebanggan, Kec. Sumbang, Kabupaten Banyumas, Jawa Tengah 53183', 'Servis Sepeda Listrik Uwinfly Komstir Oblak dan Lemah', NULL, NULL),
(82, 'P82', 'Nur Rofiah', '087887615383', 'Jl. Rotan No.84, RT.01/RW.06, Bojongsari Baru, Kec. Bojongsari, Kota Depok, Jawa Barat 16516', 'Servis Sepeda listrik Freewhel jebol', NULL, NULL),
(83, 'P83', 'Ghufron Zain', '082112033778', 'Desa Ciberung rt01/rw02 kecamatan Ajibarang', 'Servis Sepeda Listrik Selis Sport 24v ganti Aki', NULL, NULL),
(84, 'P84', 'Zaenal', '081296213121', 'Ciseeng, Bogor Jawa barat', 'Restorasi Selis Rusak', NULL, NULL),
(85, 'P85', 'Ahmad Saefudin', '082313867203', '', 'Servis Sepeda Listrik Dinamo Gancet', NULL, NULL),
(86, 'P86', 'Mirza Ardy', '081229721037', 'Sokaraja, BanyuJawa tengah -7,4560920, 109,2929620', 'Cek kelistrikan sepeda listrik Selis Mandalika', NULL, NULL),
(87, 'P87', 'Yunia', '081818105152', 'Perumahan permata harmoni blok f2 nomer 1 Ledug, Purwokerto ', 'Servis sepeda listrik pedal asis error', NULL, NULL),
(88, 'P88', 'Azis', '088216156587', 'Purbalingga, Jawa tengah', 'Restorasi sepeda listrik 3 ekor', NULL, NULL),
(89, 'P89', 'Eni mahmudah', '085526315171', 'Purbalingga, Jawa tengah', 'Restorasi sepeda listrik 3 ekor', NULL, NULL),
(90, 'P90', 'Andy', '087823518368', 'Jl.Hos Notosuwiryo Karang bawang Purwokerto Selatan Jawa Tengah', 'Servis motor listrik tidak bisa nyala', NULL, NULL),
(91, 'P91', 'Nurhayatun', '081215005217', 'Belakang masjid nurul jannah Kalibener gang pabrik es Wiriaco', 'Servis sepeda listrik soket cas kobong', NULL, NULL),
(92, 'P92', 'Iksan', '081328061927', 'Jl. Kenanga 157. SUMAMPIR KULON, Depan perumahan cendana residen. Samping Rumah Sehat Aminah', 'Servis Sepeda Listrik Himo baterai soak', NULL, NULL),
(93, 'P93', 'Dani', '082334044677', 'Dusun V, Kaliori, Kec. Kalibagor, Kabupaten Banyumas, Jawa Tengah 53193', 'Customer Sepeda Listrik Mini Hokibikes Quatzer', NULL, NULL),
(94, 'P94', 'Azis Kucir', '081805807384', 'Purwokerto', 'Servis kontroler Sepeda listrik custom', NULL, NULL),
(95, 'P95', 'Muslim', '08129451665', 'Perumahan Firdaus Estate blok C-4, Kec. Sokaraja, Kabupaten Banyumas, Jawa Tengah 53181', 'Servis Sepeda Listrik Ofero pecah body', NULL, NULL),
(96, 'P96', 'Teguh Wonogiri', '085702479333', 'Wonogiri, Jawa timur', 'Konsultasi pilih merk sepeda listrik', NULL, NULL),
(97, 'P97', 'Darseno', '083128415501', 'Karanggintung, Kec. Sumbang, Kabupaten Banyumas, Jawa Tengah, Indonesia', 'Servis Hoverboard Ganti baterai', NULL, NULL),
(98, 'P98', 'Haping', '081327652579', 'pertabatan 1/25, Purwokerto, Jawa Tengah', 'Servis Sepeda Listrik ganti baterai', NULL, NULL),
(99, 'P99', 'Surya', '088980898117', 'Purwosari, Kec. Baturaden, Kabupaten Banyumas, Jawa Tengah', 'Servis sepeda listrik Selis EOI Ganti Ban', NULL, NULL),
(100, 'P100', 'Iskandar', '081273568064', 'Jl. Puring No..07, Purbalingga, Purbalingga Kidul, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53313', 'Servis sepeda Listrik Lankeleisei XT750 Kabel terbakar', NULL, NULL),
(101, 'P101', 'Indra Jaya', '085227577176', 'Karangklesem, Purwokerto ', 'Servis Sepeda listrik', NULL, NULL),
(102, 'P102', 'Aan', '085878184423', 'RT 01/03, Gombongan, Bantarwuni, Kec. Kembaran, Kabupaten Banyumas, Jawa Tengah 53182', 'Pasang Indikator baterai + Sound Booster Uwinfly T3 Super', NULL, NULL),
(103, 'P103', 'Agus Ciki', '085291625530', '', 'Pembelian Unit Scooter listrik Exotic Tiny Scoot', NULL, NULL),
(104, 'P104', 'Agustin', '083116268970', '', 'Servis Sepeda gunung ganti ban 1 set', NULL, NULL),
(105, 'P105', 'indraYani', '085860425605', 'Kali Bagor Purwokerto Jawa tengah', 'Beli Sepeda Listrik bekas Selis Butterfly Pink gress', NULL, NULL),
(106, 'P106', 'Andri', '085728499606', '', 'Servis Sepeda listrik Viar UNO Celaka', NULL, NULL),
(107, 'P107', '', '085711683214', '', 'Servis Sepeda listrik Exotic Groza x3.5 ganti Kontroler ', NULL, NULL),
(108, 'P108', 'Dias', '081225214448', 'Perumahan Sogra Pu*ri Indah Purwokerto Timur', 'Servis Sepeda listrik Exotic Groza x3.5 ganti Kontroler ', NULL, NULL),
(109, 'P109', 'Dias Ambariani', '081229379566', 'Perumahan Sogra Pu*ri Indah Purwokerto Timur', 'Servis Sepeda listrik Exotic Groza x3.5 ganti Kontroler ', NULL, NULL),
(110, 'P110', 'Sari', '085648254444', 'Grand tanjung elok jl. Beringin raya no 63 Purwokerto ', 'Jual Sepeda listrik Uwinfly DF2 bekas', NULL, NULL),
(111, 'P111', 'Bu Enny', '085101657250', 'Toko 123 Jl.DI Panjaitan dekat lampu merah', 'Tiba-tiba mati pas Hujan-hujanan', NULL, '2025-05-09 17:03:50'),
(112, 'P112', 'Mukti Agung', '085640790500', 'Jl.Sunan Kalijaga', 'Servis Sepeda listrik Uwinfly DF7 Aki soak', NULL, NULL),
(113, 'P113', 'Dina', '087774812906', 'Kos SBM Jl.Cendrawasih GG.Beo Grendeng Purwokerto', 'Servis Sepeda listrik Exotic Revolve ganti sekring', NULL, NULL),
(114, 'P114', 'Agus Priyanto ', '081228309499', 'Kroya, Cilacap Jawa tengah', 'Beli Sepeda Listrik Uwinfly RF8 Baru warna Biru muda', NULL, NULL),
(115, 'P115', 'Kanto', '085642151225', '', 'Restorasi sepeda Listrik Tiger TEC 1 Jadul', NULL, NULL),
(116, 'P116', 'Tri Nuryanto', '08122663425', '', NULL, NULL, NULL),
(117, 'P117', 'Selis Purwokerto GOR Satria', '085728513200', 'GOR Satria Purwokerto, Kabupaten Banyumas, Jawa Tengah ', 'Pengelola Dealer Selis Purwokerto ', NULL, NULL),
(118, 'P118', 'Afif', '087888678555', 'Jl.Mandor Tadjir Serua, Bojongsari Depok Jawa Barat ', 'Servis Timbangan digital Ganti baterai', NULL, NULL),
(119, 'P119', 'Aji', '081227808091', 'Tambaksari kidul, Purwokerto Selatan', 'Servis Baterai Lithium Selis SOI', NULL, NULL),
(120, 'P120', 'Aditya Wiratama ', '082160566458', '', 'Servis Baterai Skuter listrik ', NULL, NULL),
(121, 'P121', 'Shomad', '085641118862', '', 'Ganti Aki Sepeda listrik Viar', NULL, NULL),
(122, 'P122', 'Eros Torina', '082243380686', 'Perumahan Permata Harmoni Blok A1 no.9 Ledug', 'Servis Sepeda listrik Celcius Tomax ganti Sekring ', NULL, NULL),
(123, 'P123', 'Rohani', '082325843411', '', 'Beli Sepeda listrik Selis EOI bekas kondisi normal', NULL, NULL),
(124, 'P124', 'Sutrisno ', '087838630379', 'Bukateja Purbalingga ', 'Jual Sepeda listrik Selis Go Green', NULL, NULL),
(125, 'P125', 'Arif ', '0816414354', '', 'Beli Kontroler Seken Sunrace Richey', NULL, NULL),
(126, 'P126', 'Ibrohim', '085693105010', '', 'Beli Alat Fast charger v2 dan Kontroler Modifikasi SL + High torque', NULL, NULL),
(127, 'P127', 'Komar', '081229509058', '', 'Beli Sepeda listrik Uwinfly DF2 seken Baterai baru', NULL, NULL),
(128, 'P128', 'Adi', '085262865134', 'Desa_karangsentul, Karangsentul, Kec. Padamara, Kabupaten Purbalingga, Jawa Tengah 53372', 'Servis Baterai Sepeda Listrik Qicycle', NULL, NULL),
(129, 'P129', 'Watumas', '089665776141', 'Jalan Letjend. Pol. R. Sumarto No.100, Karangjambu, Purwanegara, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53126', 'Servis Sepeda Listrik Exotic Revolve Ganti Aki', NULL, NULL),
(130, 'P130', 'Adit', '0811262600', 'Menara teratai', 'Jalan sebentar udah mati', NULL, '2024-11-01 01:57:36'),
(131, 'P131', 'api', '085842123520', 'depan bank mandiri', 'tidak bisa dicas', NULL, '2025-04-29 22:12:24'),
(132, 'P132', 'Fajar', '089637444617', '', 'Jual Sepeda listrik Turanza Flux 2.0 kuning', NULL, NULL),
(133, 'P133', 'Rizki Tipan', '089675794452', '', 'Beli Modul Sound booster v2.1 tanpa Speaker', NULL, NULL),
(134, 'P134', 'Sanuri', '081572749088', 'Depan toko EPutera Sokaraja Banyumas', 'Beli Sepeda listrik Turanza Flux kuning Seken', NULL, NULL),
(135, 'P135', 'Riyan', '081276066060', '', 'Beli Sepeda listrik Uwinfly DF2 seken Baterai baru', NULL, NULL),
(136, 'P136', 'Siti Rohmah', '0881023052094', 'jLn.karapitan timur 1 nomor 336/36B RT:01 RW:06 keLurahan Burangrang kecamatan Lengkong kotamadya Bandung Jawa barat', 'Beli Smart Charger v2', NULL, NULL),
(137, 'P137', 'Toko Melati', '088802977572', '', 'Servis Hoverboard ganti baterai dan tombol', NULL, NULL),
(138, 'P138', 'Ardian ', '0895384023743', '', 'Servis Sepeda listrik Ganti Kontroler ', NULL, NULL),
(139, 'P139', 'MX', '082140767912', 'Sumpiuh Banyumas', 'Beli Aki seken 6-DZF-12 paket 36v', NULL, NULL),
(140, 'P140', 'Ghozy', '085712680776', 'perumahan Griya Karang Indah 3 blok N  nomor 5 Gang mesjid', 'Servis Sepeda Listrik gas gruduk', NULL, NULL),
(141, 'P141', 'Bayu', '088986196623', '', 'Servis Sepatu roda dan skuter listrik', NULL, NULL),
(142, 'P142', '', '085867573073', '', 'Beli Sepeda Listrik Tiger Seken', NULL, NULL),
(143, 'P143', 'Sifa', '085712415068', '', 'Beli Sepeda Listrik Tiger Seken', NULL, NULL),
(144, 'P144', 'Sudarti', '085726012498', 'perum karen blok f nomor 6 Purwokerto ', 'Servis Sepeda listrik gamau nyala', NULL, NULL),
(145, 'P145', 'Obor Bahagia Posis', '081393905867', 'Obor bahagia Posis Purwokerto ', 'Toko sepeda Rekanan', NULL, NULL),
(146, 'P146', 'Mistofik Hidayah', '087823934911', '', 'Jual Selis Seken kondisi baru KY Rapid Plus Biru', NULL, NULL),
(147, 'P147', 'Marcel', '087721906997', '', 'Joki Tugas Buat database SQL', NULL, NULL),
(148, 'P148', 'Asiyah', '081882830787', '', 'Servis Sepeda listrik Richey Ganti ban dan Aki', NULL, NULL),
(149, 'P149', 'Ichda', '081293447169', 'Depok Jawa Barat ', 'Servis Sepeda listrik Polygon Gili Velo Hall sensor mati', NULL, NULL),
(150, 'P150', 'Ine', '087779771371', '', 'Jual Sepeda listrik seken Goda Blue Tiger Kondisi mulus seperti baru ', NULL, NULL),
(151, 'P151', 'Surya alamsyah', '087829070277', 'Wahana menara teratai', 'Rusak', NULL, '2024-11-01 01:03:04'),
(152, 'P152', 'Anis', '085779689520', '', 'Servis Sepeda listrik Cek Aki', NULL, NULL),
(153, 'P153', 'Tuti', '085227049050', 'Perumahan Purwosari indah Jl.Gunung Slamet raya no.14 Purwosari', 'Servis Klakson dan Alarm tidak nyala', NULL, NULL),
(154, 'P154', 'Hengki', '085784982798', '', 'Modifikasi Sepeda listrik Tambah Riting dan Kelistrikan sekunder ', NULL, NULL),
(155, 'P155', 'Arul', '08818677011', '', 'Servis Sepeda listrik Selis Ganti ECU dan sekring', NULL, NULL),
(156, 'P156', 'Vandi', '08562634533', '', NULL, NULL, NULL),
(157, 'P157', 'Handy', '082227292999', '', 'Penjual Sepeda listrik all merk', NULL, NULL),
(158, 'P158', 'Iis', '0895606498012', '', 'Servis Sepeda listrik Volta Aki Soak', NULL, NULL),
(159, 'P159', 'Alfi', '081225364600', 'Bale Maskemambang Purwokerto Jawa Tengah ', 'Servis Mobilan Aki', NULL, NULL),
(160, 'P160', 'Riyanto', '085800381886', 'Jipang, Karanglewas Purwokerto Jawa Tengah ', 'Servis Skuter Mr Jackie Aki rusak dan Soket charger putus', NULL, NULL),
(161, 'P161', 'Endang', '085802484328', 'Sokaraja Tengah Belakang Getuk goreng Asli 1 depan TK Masyitoh', 'Servis panggilan Sepeda listrik aki soak', NULL, NULL),
(162, 'P162', 'Arul', '085938365921', '', 'Servis Sepeda listrik butterfly ', NULL, NULL),
(163, 'P163', 'Zenny Widagdo', '0811262905', '', 'Beli UPS mini 2pcs untuk Mesin absen', NULL, NULL),
(164, 'P164', 'Ugi', '085726432345', '', 'Servis Aki Uwinfly lama tidak dipakai', NULL, NULL),
(165, 'P165', 'Poernowo', '085649376755', 'Dosen ITTP Lab Kendali', 'Servis UPS APC 1400VA ganti Aki', NULL, NULL),
(166, 'P166', 'Andri', '081575588454', 'Baturraden Purwokerto', 'Servis rutin Sepeda listrik sewa', NULL, NULL),
(167, 'P167', 'Murtini', '081324253254', 'Gg.Sudagaran Belakang ITTP Purwokerto Selatan ', 'Jual sepeda listrik seken Exotic Cooltech', NULL, NULL),
(168, 'P168', 'Rita Indrawati ', '08172812465', 'Depan Lapangan Pangripta Kranji Purwokerto ', 'Cek Baterai Sepeda listrik Selis EOI rusak', NULL, NULL),
(169, 'P169', 'Indra Syahputra ', '085210664051', '', 'Servis Baterai Skuter listrik drop', NULL, NULL),
(170, 'P170', 'Ahmad dimyati', '085801227550', 'Sumbang Rt 2/1 kecamatan sumbang.... Patokan BRI sumbang ke barat sampe ada mushola kiri jalan masuk... Tanya aja', 'Di gas ndredek ndredek g mau lari', NULL, '2024-12-15 16:52:58'),
(171, 'P171', 'Sri Mino', '081327079659', '', 'Servis Sepeda listrik Sunrace Winner tidak bisa dicas', NULL, NULL),
(172, 'P172', 'Mino ', '088225203502', 'Belakang Masjid 17 RSUD Margono Purwokerto ', 'Servis sepeda listrik Sunrace Winner Ganti Aki', NULL, NULL),
(173, 'P173', 'Harsono', '081229243424', '', 'Servis Sepeda listrik Lankeleisi Ganti Charger ', NULL, NULL),
(174, 'P174', 'Adhi', '082123074703', '', 'Servis Sepeda listrik custom konversi', NULL, NULL),
(175, 'P175', 'Canggih', '085642809356', '', 'Servis Sepeda listrik Lankeleisi Speedometer rusak', NULL, NULL),
(176, 'P176', 'Dini', '085717865079', 'Pertigaan kelapa Jl.Wira Parung', 'Servis Sepeda listrik Butterfly ganti Aki', NULL, NULL),
(177, 'P177', 'Ratih', '082243563244', '', 'Servis Sepeda listrik footstep rusak', NULL, NULL),
(178, 'P178', 'Paini', '085879344775', '', 'Servis Sepeda listrik Sunrace Eco pro ganti ECU', NULL, NULL),
(179, 'P179', 'Uun Haris', '081804886455', 'Sumampir deket pasar Cerme Purwokerto Utara', 'Servis Sepeda listrik roda 3 ', NULL, NULL),
(180, 'P180', 'Rusmi', '082324881235', '', 'Servis ban Sepeda listrik ', NULL, NULL),
(181, 'P181', 'Faqih', '081214850633', '', 'Servis Skuter G30 Max ganti Ban dalam', NULL, NULL),
(182, 'P182', 'Halim', '08122989656', '', 'Servis Sepeda listrik Lankeleisi XT-650', NULL, NULL),
(183, 'P183', 'Budi', '081804858450', '', 'Servis Sepeda listrik Sunrace Mati total ', NULL, NULL),
(184, 'P184', 'Oki', '089665865029', '', 'Servis Aki Sepeda listrik soak', NULL, NULL),
(185, 'P185', 'Pringgo ', '08129364997', '', 'Servis Baterai Viar Orion gampang habis', NULL, NULL),
(186, 'P186', 'Nico', '08122675082', '', 'Servis Sepeda listrik Lankeleisi XT-650', NULL, NULL),
(187, 'P187', 'Singgih Yogi', '082112343031', '', 'Custom Baterai Lifepo4 48v 12Ah untuk Sepeda listrik Volta 302', NULL, NULL),
(188, 'P188', 'Sekar Jati', '082135492686', '', 'Servis Skuter rental 16unit', NULL, NULL),
(189, 'P189', 'Aji', '085789176740', '', 'Servis Aki mobil carry 12v 55Ah', NULL, NULL),
(190, 'P190', 'Fauziah', '087764277850', 'Perumahan Permata Harmoni blok F12 no.4', 'Servis Sepeda listrik panggilan', NULL, NULL),
(191, 'P191', 'Iin', '082243928499', '', 'Konsultasi Sepeda listrik Uwinfly Bunyi tek', NULL, NULL),
(192, 'P192', 'Sutikno', '085101625208', '', 'Servis Sepeda listrik United Minion Ganti Handle gas dan lampu', NULL, NULL),
(193, 'P193', 'Nurokhim', '081903242844', '', 'Beli Sepeda listrik Goda 140 Oren', NULL, NULL),
(194, 'P194', 'Maria', '089676974787', '', 'Servis Sepeda listrik Exotic stang berat ', NULL, NULL),
(195, 'P195', 'RS', '087728790068', '', 'Servis Skuter Listrik ganti kelistrikan', NULL, NULL),
(196, 'P196', 'Arif Kunsat', '085640777304', '', 'Jual sepeda listrik Selis Anyer kondisi mulus', NULL, NULL),
(197, 'P197', 'Amir', '081326156608', '', 'Servis skuter listrik driver P188', NULL, NULL),
(198, 'P198', 'Debi', '081387054730', '', 'Servis Sepeda listrik Uwinfly DF2 Roda belakang macet dan bocor+ Aki soak', NULL, NULL),
(199, 'P199', 'Iskandar', '082216254399', '', 'Custom sepeda ke listrik ', NULL, NULL),
(200, 'P200', 'Taufik', '088233798552', '', 'Tukar tambah Motor listrik Uwinfly T3 ke Selis IOI', NULL, NULL),
(201, 'P201', 'Erza', '087837774937', 'Karanglewas Purwokerto ', 'Servis Sepeda listrik Indobike ganti Aki', NULL, NULL),
(202, 'P202', 'Chamid', '081469872094', '', 'Servis Sepeda listrik Volta aki rusak', NULL, NULL),
(203, 'P203', 'Budi Destiawan', '087746058112', '', 'beli Ban Tubeless 16x2.50 sepeda listrik Selis Butterfly trike', NULL, NULL),
(204, 'P204', 'Aziz Kebumen', '083874774541', '', 'Servis Hoverboard mati kehujanan', NULL, NULL),
(205, 'P205', 'Kus', '082314101661', '', 'Restorasi Sepeda listrik jadul dan skuter listrik ', NULL, NULL),
(206, 'P206', 'Budi', '085876021914', '', 'Beli Sepeda listrik Cicil 4x', NULL, NULL),
(207, 'P207', 'Adhi Jambi', '085266370165', '', 'Pesan Sound booster untuk Motor listrik ', NULL, NULL),
(208, 'P208', 'Ipung', '083862221203', '', 'Servis Mobilan aki tidak bisa menyala ', NULL, NULL),
(209, 'P209', 'Siti', '0895384928349', '', 'Servis Sepeda listrik Ganti Aki separo', NULL, NULL),
(210, 'P210', 'Mega Nanda', '085876940933', '', 'Servis Sepeda Selis EOI rusak total ', NULL, NULL),
(211, 'P211', 'Ady Wisnu', '085640219837', '', 'Servis Sepeda listrik Uwinfly DF7 Aki soak', NULL, NULL),
(212, 'P212', 'BBL', '081327133262', '', 'Servis Selis Butterfly Aki Soak ', NULL, NULL),
(213, 'P213', 'Cipto', '081326823888', '', 'Servis Motor listrik Aki soak', NULL, NULL),
(214, 'P214', 'Oktavia', '087839112101', '', 'Tukar Tambah Sepeda listrik UOU hitam dengan Goda Coffee ', NULL, NULL),
(215, 'P215', 'Soimah yulianti', '088980310448', 'RT4,Rw2 ,Kaliencit desa pajerukan Kalibagor (sebelah pabrik triplek pak pandi,rumah cat warna kuning) KALIBAGOR ,KAB BANYUMAS JAWA TENGAH', 'Digas tidak mau jalan', NULL, '2024-11-02 19:18:29'),
(216, 'P216', 'Tri Setya', '085643473409', '', 'Servis Selis D7 tidak bisa dicas', NULL, NULL),
(217, 'P217', 'Suhadi', '085100787021', '', 'Servis Motor listrik T3', NULL, NULL),
(218, 'P218', 'Rasiti', '085725079897', 'Linggasari RT 05 RW 04 kec kembaran banyumas', 'Tidak bisa dicas,ganti aki', NULL, '2025-01-19 19:08:51'),
(219, 'P219', 'Afifah', '085712750427', '', 'Servis Sepeda listrik Aki soak', NULL, NULL),
(220, 'P220', 'Basuki', '081327073419', '', 'Restorasi Sepeda listrik Betrix Ice', NULL, NULL),
(221, 'P221', 'Agustinus Susanto', '081326082444', '', 'Servis Motor listrik jadul tidak bisa gerak', NULL, NULL),
(222, 'P222', 'Puji', '085727478739', 'gunung Tugel Purwokerto', 'Nanya dan konsultasi Sepeda listrik', NULL, NULL),
(223, 'P223', 'Serly', '081318302669', 'BanyuJawa tengah', 'Nanya dan konsultasi Sepeda listrik', NULL, NULL),
(224, 'P224', 'Aji', '085726482058', 'Sokaraja kabupaten BanyuJawa tengah', 'Nanya dan konsultasi Sepeda listrik', NULL, NULL),
(225, 'P225', 'Sarir', '085942107601', 'Rawalo, Kebasen, Kabupaten Banyumas', 'Nanya dan konsultasi Sepeda listrik', NULL, NULL),
(226, 'P226', 'Delty', '082126709626', '', 'Restorasi Sepeda listrik Super Rider', NULL, NULL),
(227, 'P227', 'Wihan', '082129136892', '', 'Beli BMS Lifepo4 20s 40A', NULL, NULL),
(228, 'P228', 'Arif', '082243861306', 'Bobotsari Purbalingga Jawa Tengah ', 'Servis panggilan Selis Ban bocor velg bengkok dan Charger mati', NULL, NULL),
(229, 'P229', 'Ardiyanto ', '087711632826', '', 'Beli Charger Skuter 36v', NULL, NULL),
(230, 'P230', 'Wiwit', '081329990399', '', 'Servis panggilan Sepeda listrik Genio Kontroler rusak', NULL, NULL),
(231, 'P231', 'Dian', '082221002729', '', 'Restorasi Selis Super Rider jadul', NULL, NULL),
(232, 'P232', 'Heri', '085647767574', '', 'Modifikasi Kursi Roda Listrik ', NULL, NULL),
(233, 'P233', 'Asim', '081575487211', '', 'Konsultasi Servis Sepeda listrik ', NULL, NULL),
(234, 'P234', 'Kirman', '081548035510', '', 'Servis Baterai Lithium-ion Lankeleisi', NULL, NULL),
(235, 'P235', 'Dika', '083130082000', 'Sitapen Kranji, Purwokerto', 'Servis Baterai Lithium Sepeda listrik Polygon', NULL, NULL),
(236, 'P236', 'Sigit', '085726314680', '', 'Konsultasi kredit Selis', NULL, NULL),
(237, 'P237', 'Siti Komariyah', '082323188988', '', 'Tukar Tambah Sepeda listrik DF2 merah dengan SUnrace', NULL, NULL),
(238, 'P238', 'Riris', '082225325528', '', 'Servis Aki Sepeda listrik Uwinfly DF7 soak', NULL, NULL),
(239, 'P239', 'E-bike PWT', '085742375477', '', 'Servis ringan Sepeda listrik', NULL, NULL),
(240, 'P240', 'Siti', '081374391690', '', 'Servis Aki sepeda listrik Selis Mandalika meledak', NULL, NULL),
(241, 'P241', 'Han', '081327999090', '', 'Servis Riting mati dan Switch kecepatan tidak hidup', NULL, NULL),
(242, 'P242', 'Kiki', '083863817799', 'GG.Gendhis Teluk Purwokerto Selatan ', 'Servis Aki Selis Sunrace Soak 1', NULL, NULL),
(243, 'P243', 'Fauzan', '085647666995', '', 'Ganti Aki baru Selis United Amalfi', NULL, NULL),
(244, 'P244', 'Bintang', '082242655957', '', 'Servis Skuter Mijia Clone Ganti kelistrikan', NULL, NULL),
(245, 'P245', 'budi', '0895701621818', '', 'Custom Lithium 48v 11Ah untuk Selis rental', NULL, NULL),
(246, 'P246', 'Untung', '08122663950', 'Perumahan Berkoh Purwokerto Selatan ', 'Restorasi Selis Tiger TEC-1 Full', NULL, NULL),
(247, 'P247', 'Dayat', '085726710686', 'dusun kedondong Sokaraja Banyumas', 'Servis Panggilan sepeda listrik sekring putus', NULL, NULL),
(248, 'P248', 'Nurul', '08164857160', 'Jl.Polri depan Polres Banyumas', 'Servis Panggilan Ganti Aki Selis Super rider', NULL, NULL),
(249, 'P249', 'Alfa Raharjo', '0895363184535', '', 'Modif Skuter Mr.Jackie', NULL, NULL),
(250, 'P250', 'Aldo', '085263013923', '', 'Projek Pemasangan panel Surya perkebunan', NULL, NULL),
(251, 'P251', 'Erwin', '082114899000', '', 'Servis Baterai Lenkeleisi 36v 10Ah', NULL, NULL),
(252, 'P252', 'Nosa', '083869319112', '', 'Servis Sepeda listrik Gili Velo', NULL, NULL),
(253, 'P253', 'Tommy', '088211655802', '', 'Modif Starter pro upgrade speed', NULL, NULL),
(254, 'P254', 'Dhe Fara', '085799239966', '', 'Servis Skuter mini Scoot Kabel cas copot', NULL, NULL),
(255, 'P255', 'Arif', '085227840051', '', 'Servis Sepeda listrik Mati', NULL, NULL),
(256, 'P256', 'Yono ', '088221341377', '', 'Servis Selis Exotic Valero tidak bisa dicas', NULL, NULL),
(257, 'P257', 'Narto', '088802957779', '', 'Servis Sepeda listrik ION error E1', NULL, NULL),
(258, 'P258', 'Saiful Bahri', '08975909153', '', 'Servis Charger Ecgo2 ganti Mosfet', NULL, NULL),
(259, 'P259', 'Daniel', '08985180894', '', 'Proyek Otomasi Ternak ayam rumahan', NULL, NULL),
(260, 'P260', 'Donni', '082133390006', '', 'Servis mobilan Aki Ganti aki dan servis ringan', NULL, NULL),
(261, 'P261', 'Uwinfly Victory', '081268868125', '', 'Servis Motor Listrik Dinamo gredek', NULL, NULL),
(262, 'P262', 'SARIPAH', '081229090367', 'Jalan Kauman Lama Gg 2 Rt 04/ Rw 05 Purwokerto Lor , Purwokerto Timur Banyumas', 'sepeda listriknya tiba tiba ga bisa maju atau mundur trus mati gamau nyala', NULL, '2025-02-06 00:30:00'),
(263, 'P263', 'Silvia', '081229201919', '', 'Servis Sepeda listrik Aki soak', NULL, NULL),
(264, 'P264', 'Anggita', '085715176443', '', 'Jual Sepeda listrik Mr Jackie Sporty', NULL, NULL),
(265, 'P265', 'Ita ', '081327577770', '', 'Servis Skuter Mijia cline Ganti Ban depan Airless', NULL, NULL),
(266, 'P266', 'Nanda Ramadhan', '087709790692', '', 'Servis Sepeda listrik Selis EOI baterai soak', NULL, NULL),
(267, 'P267', 'Rudi', '081327062006', '', 'Servis Sepeda listrik Selis EOI baterai soak', NULL, NULL),
(268, 'P268', 'Sigit', '085100644445', '', 'Servis sepeda listrik Aki drop', NULL, NULL),
(269, 'P269', 'Arfan', '082137734323', '', 'Servis Sepeda listrik Ganti kabel body', NULL, NULL),
(270, 'P270', 'Tri Harsono', '081320526963', '', 'Servis Baterai Selis EOI ganti cell', NULL, NULL),
(271, 'P271', 'Ali Supangat', '081326695019', '', 'Jual Roda tiga listrik Viar', NULL, NULL),
(272, 'P272', 'Yusuf', '085747890105', '', 'Servis Skuter Mijia Ban seret kandang ', NULL, NULL),
(273, 'P273', 'Fikri', '081511124677', '', 'Ganti ban tubles 2 unit sepeda listrik Agathos', NULL, NULL),
(274, 'P274', 'Bambang', '082226389219', '', 'Restorasi Selis Concord', NULL, NULL),
(275, 'P275', 'Mono', '082335802139', '', 'Servis Sepeda listrik Solos Aki soak', NULL, NULL),
(276, 'P276', 'Parno', '085640084005', 'RT5/3 GG.Mulyo Karangnanas Purwokerto ', 'Servis Sepeda listrik Ganti lobang charger dan charger nya', NULL, NULL),
(277, 'P277', 'Amin', '081542688875', '', 'Modifikasi Sepeda listrik Aviator Pasang sein', NULL, NULL),
(278, 'P278', 'Agus', '085842848207', '', 'Tukar Tambah Sepeda listrik Goda dengan Roda tiga listrik ', NULL, NULL),
(279, 'P279', 'Wawan', '08122997395', '', 'Servis Aki sepeda listrik Uwinfly soak', NULL, NULL),
(280, 'P280', 'Imam Supeno', '081901231516', '', 'Restorasi Sepeda listrik Goda 140', NULL, NULL),
(281, 'P281', 'Yogi', '081325143978', '', 'Jual Sepeda listrik Sunrace Winner Pak Yogi', NULL, NULL),
(282, 'P282', 'Beni', '085227515444', '', 'Servis Sepeda lipat listrik baterai soak', NULL, NULL),
(283, 'P283', 'Ono', '085786328723', '', 'Beli Sepeda listrik Turanza Flux 2.0 kuning NEW', NULL, NULL),
(284, 'P284', 'Warno', '082138189034', '', 'Beli Sepeda listrik Exotic TX-150Beli Sepeda listrik Exotic TX-150', NULL, NULL),
(285, 'P285', '', '08895695335', '', 'Servis Sepeda listrik Uwinfly Rf8 Aki Soak 20Ah', NULL, NULL),
(286, 'P286', 'Susi', '0895703605733', '', 'Servis panggilan Ganti Aki sepeda listrik ', NULL, NULL),
(287, 'P287', 'Tin', '085600719941', 'Bakul Mie Ayam pojok Pasar burung', 'Servis panggilan sepeda listrik tidak bisa kencang', NULL, NULL),
(288, 'P288', 'Taufik', '088233798552', 'Pasirmuncang Tanjung Purwokerto Selatan ', 'Servis Baterai Selis IOI ', NULL, NULL),
(289, 'P289', 'Sardo', '0873866187', '', 'Servis sepeda listrik Exotic Groza tidak bisa digas', NULL, NULL),
(290, 'P290', 'Pak Rahman', '085600560774', 'SPBU Arcawinangun Purwokerto', 'Motor listrik Tangkas P6 di showroom SPBU', NULL, '2025-01-14 18:08:03'),
(291, 'P291', 'Sri Hartini', '089697364810', '', 'Servis Sepeda listrik Selis Mandalika Ganti sensor gas ', NULL, NULL),
(292, 'P292', 'Amin', '08816779869', '', 'Servis sepeda listrik Ganti ban dalam', NULL, NULL),
(293, 'P293', 'Paryanto', '087728543859', '', 'Servis sepeda listrik Selis Ganti Gas dan kontroler', NULL, NULL),
(294, 'P294', 'Soewarjotto', '081391418131', 'Perumahan Ketapang Indah B2/31 Sokaraja Kulon', 'Ada bunyi \"krekk krekk krekk\" di roda belakang', NULL, '2025-04-18 22:32:46'),
(295, 'P295', 'De Ziro', '082226369495', '', 'Servis sepeda listrik Gas nyendat ', NULL, NULL),
(296, 'P296', 'Rianto silas', '082265197250', 'Garasi BAG Kober jl KS Tubun purwokerto', 'Sekring putus...tolong di gantikan cadangan ada di box batere', NULL, '2025-02-13 22:14:06'),
(297, 'P297', 'Queen', '085712645117', '', 'Servis Sepeda listrik Ganti Ban Tubeless ke ban dalam Selis Element', NULL, NULL),
(298, 'P298', 'bonda', '085747999471', 'Perum griya satria mandalatama blok 37 no 15 Karanglewas ', 'Beli Sepeda listrik Exotic TX-150Servis panggilan Molis T3 old Cabut Sensor rem', NULL, NULL),
(299, 'P299', 'Bu Linda', '081215507704', 'Perumahan Griya Indah Saphire', 'Rem depan Kiri Grobak Mlaku patah', '2024-11-01 02:28:26', '2025-04-13 00:02:03'),
(300, 'P300', 'Rofiu', '088226917271', 'Markas Mlaku Coffee Karangkober', 'ECU udah diganti yang besar tapi nggak bisa digas', NULL, '2024-12-24 20:42:54'),
(301, 'P301', 'Kartikawati', '085869946535', 'Kemutug kidul RT 4 RW 3', 'Rantai lepas. Saat di tanjakan selalu lepas', NULL, NULL),
(302, 'P302', 'Sigit Pramono', '081578011820', 'Kantin Padang IT Telkom Jl DI Panjaitan 128 Purwokerto', 'Jika sudah semalam di charge dan dipake 4km muncul suara minta di charge + kecepatan maximal menurun.  Padahal tegangan Aki masih 48V', NULL, NULL),
(303, 'P303', 'Dicky', '081393444439', 'pangebatan 3/1 karanglewas, banyumas', 'baterai lemah', NULL, NULL),
(304, 'P304', 'Akhmad Iwan Fauzi', '081228257205', 'Jln. Lor Sawah Desa Wlahar Wetan RT 10/2 Kec. Kalibagor (Rumah Bpk Iwan/Iis, depan gang Mushola Nurul Falah)\n', 'Lampu ces hijau tidak menyala, ketika ces tertanam bisa menyala..', NULL, NULL),
(305, 'P305', 'Urip Yoga', '085861466287', 'Karang Nanas rt02/02 no.22', 'Ngetes Doang Si', '2024-10-29 10:43:05', '2024-11-01 02:35:52'),
(306, 'P306', 'Pak Anton', '085227377738', 'H9X8+2C5 Penambongan, Kabupaten Purbalingga, Jawa Tengah', 'Tiba-tiba nggak bisa cas, nggak ada tanda-tanda', '2024-10-31 01:07:01', '2024-12-30 21:15:24'),
(307, 'P307', 'Arief', '085878657199', 'Jalan Rasamala Raya no 64 RT 5 RW 6 Perum Teluk Purwokerto Selatan', 'Nyala Tidak bisa di gas, habis di cuci', '2024-10-31 01:15:03', '2024-10-31 01:15:03'),
(308, 'P308', 'Susanto', '08118801737', 'Ledug, Purwokerto', 'Hoverboard rusak di baterai', '2024-10-31 01:26:36', '2024-10-31 01:26:36'),
(310, 'P309', 'Bu Rahayu', '082322333222', 'Pasir wetan RT02/02 GG.Galur 1 Karanglewas', 'Tukar tambah sepeda listrik', '2024-11-03 05:12:48', '2024-11-03 05:12:48'),
(311, 'P311', 'Pak Ferry', '06967013150', 'Taiwan', 'Beli charger SLA 60v 20Ah', '2024-11-04 01:06:48', '2024-11-04 01:06:48'),
(312, 'P312', 'Zulfikar', '085781552592', 'Rs margono, depan alfamart', 'Tidak bisa di gas', '2024-11-04 20:56:45', '2025-04-16 03:05:22'),
(313, 'P313', 'Arief Kusumo', '085878657199', 'Purwokerto Selatan', 'Selis Pujasera Sensor dinamo rusak', '2024-11-05 06:34:30', '2024-11-05 06:34:30'),
(314, 'P314', 'Sri Haryani', '0881027784056', 'Banjaranyar RT 02/RW 05 sokaraja, Banyumas', 'Roda belakang seret banget muternya sama bunyi krok krok', '2024-11-07 02:08:04', '2024-11-07 02:08:04'),
(315, 'P315', 'MUKLIS KURNIAWAN', '082219092575', 'Desa Sokaraja kulon RT 1 Rw 9 kec. Sokaraja', 'Dop ban rusak', '2024-11-07 21:34:12', '2024-11-15 05:08:13'),
(316, 'P316', 'Bu Siti Rohani', '085600153301', 'Kedondong RT1/RW3 Sokaraja', 'Selis EOI handle gas pecah', '2024-11-07 21:47:42', '2024-11-07 21:47:42'),
(317, 'P317', 'Ibnu', '083827638655', 'Depan Balai Julianus Kranji Purwokerto', 'Kadang bisa kadang error gasjya', '2024-11-07 22:46:59', '2024-11-07 22:46:59'),
(318, 'P318', 'Kopi Gowes', '08983567788', 'Jl Raya Pangebatan RT 3 RW 1, kec Karanglewas, kab Banyumas', 'Baterai indikator full, tapi belum ada 10km sudah habis, boros', '2024-11-11 20:27:01', '2024-11-11 20:27:01'),
(319, 'P319', 'Devina Yunita', '085701852909', 'Karangkobar Purwokerto Timur Belakang Masjid Hijau Mas kemambang', 'Bisa digas nggak bisa jalan', '2024-11-13 04:21:56', '2024-11-13 04:21:56'),
(320, 'P320', 'VELYNMIRO LANFELIX', '085713121604', 'JLN. RIYANTO GG. CEMPAKA NO 24 RT05/03 KEL. SUMAMPIR KEC. PURWOKERTO UTARA', 'Bagian tombol lampu sen/riting, dan pasang footstep', '2024-11-14 20:31:31', '2024-12-29 21:55:06'),
(321, 'P321', 'Yunan', '085227494930', 'Perum bukit kalibagir indah blok h4 no.12', 'Habis dipakai tiba-tiba mati', '2024-11-15 19:00:26', '2024-11-15 19:00:26'),
(322, 'P322', 'Kitchen mlaku coffe', '081327595266', 'Jl balai kelurahan 3 Arcawinangun Purwokerto timur', 'Tidak bisa di gas maju mundur , ada kabel putus', '2024-11-17 18:31:22', '2024-11-17 18:31:22'),
(323, 'P323', 'Triadi YUS', '085291302891', 'Belakang UMP', 'Custom Baterai Lifepo4 48v 30Ah Selis Robin', '2024-11-19 07:15:51', '2024-11-19 07:15:51'),
(324, 'P324', 'Eva fitriani', '085727365079', 'Jl. Balai Desa No.23, Dusun I Kalicupak Lor, Kalicupak Lor, Kec. Kalibagor, Kabupaten Banyumas, Jawa Tengah 53191,, rt 04/ rw 01\r\n( depan balai desa kalicupak lor yang jualan teh Realitea)', 'Kalo di gas bisa tapi kalo jalan cepet banget kaya gabisa ditemukan terus kalo mundur kaya di rem agak berat', '2024-11-22 03:02:29', '2024-11-22 03:02:29'),
(325, 'P325', 'Paryanto', '081322686258', 'Jl.teuku Umar, sokaraja wetan,depan bengkel pres pelk HERRY JBB', 'Bisa digas ketika stang dibelokan ke kiri', '2024-11-25 21:13:52', '2024-11-25 21:13:52'),
(326, 'P326', 'Karmini kartika', '0895414104388', 'Purbalingga lor jln kiswadi rt 02 rw 02 desa sayangan\r\nDeket patung knalpot', 'Bila di gas jlnnya lambat ga bisa kencang', '2024-11-27 02:20:17', '2024-11-27 02:20:17'),
(327, 'P327', 'Pak Supono', '08122750000', 'Mas kemambang', 'Kadang nyala kadang mati', '2024-11-29 02:58:33', '2024-11-29 04:27:19'),
(328, 'P328', 'mlaku kopi', '082138862788', 'Jl. Kelurahan III No 27a, Arcawinangun, Purwokerto Timur\r\nMarkas Pusat Mlaku Kopi', 'Pada saat jalan tiba2 tidak bisa di gas dan bagian baterai atau aki keluar asap', '2024-11-30 03:23:38', '2024-12-27 01:11:00'),
(329, 'P329', 'Rahma', '082325973864', 'Randudongkal rt 27 rw03', 'Jok motor bagian belakang tidak ada merek super rider', '2024-12-01 03:58:13', '2025-05-18 00:10:55'),
(330, 'P330', 'Jaja', '080808', 'jajajaj', 'ajjaja', '2024-12-02 02:21:51', '2024-12-02 02:21:51'),
(331, 'P331', 'wjjwjw', '0909090', 'dkdkdjd', 'djhdihddd', '2024-12-02 02:41:59', '2024-12-02 02:41:59'),
(332, 'P332', 'JJSJJSS', '0828282', 'dhdhdhd', 'dijdjdojdo', '2024-12-02 02:51:14', '2024-12-02 02:51:14'),
(333, 'P333', 'Ummu Kultsum', '0882007491805', 'jalan arjuna no.1(depan lapangan karawangkal', 'tiba² suka mati di tengah jalan padahal udh penuh', '2024-12-02 19:22:48', '2024-12-02 19:22:48'),
(334, 'P334', 'Becak Meruyung', '08816613758', 'Jl raya tambaksogra sumbang Banyumas', 'Ada 3 ban boco', '2024-12-04 18:22:43', '2025-04-09 19:33:04'),
(335, 'P335', 'Aries munandar', '082145786985', 'Jl.ketuhu no.16 rt.3 rw.3 kel: wirasana kec:purbalingga', 'Jalanya gasnya ngga lancar kya mau mati trs jalan lagi', '2024-12-08 19:28:49', '2024-12-08 19:28:49'),
(336, 'P336', 'Izul', '085781552592', 'Markas Pahala Coffee Teluk', 'Kabel Terbakar', '2024-12-08 20:47:12', '2024-12-08 20:47:12'),
(337, 'P337', 'Barid Bashofi', '081287672229', 'Perum mega asri Regency, blok c 14 karang benda berkoh purwokerto selatan', 'Tidak bisa kencang,, lambat,, nggak seperti biasanya', '2024-12-08 20:50:03', '2024-12-08 20:50:03'),
(338, 'P338', 'Saiful', '085336265415', 'Desa Kalibagor RT 11,RW.4 GANG 3, KALIBAGOR, BANYUMAS.(DEPAN MIE AYAM MBURI PABRIK)', 'Nyala gk mau di gas', '2024-12-09 17:38:27', '2024-12-09 17:38:27'),
(339, 'P339', 'Keysha Nindi', '085727095352', 'Sumbang Desa Rongsok', 'Speedometer kadang mati, Dinamo juga bunyi bising', '2024-12-10 02:25:02', '2024-12-10 02:25:02'),
(340, 'P340', 'Puri dwi purnomo', '085869394677', 'Jl. Kelurahan III No. 27a, Arcawinangun. Purwokerto', 'Rem blong,aki pecah', '2024-12-11 18:49:20', '2024-12-11 18:49:20'),
(341, 'P341', 'Sito Waluyo', '085743829979', 'Purwanega rt 3 rw 4 purwokerto utara', 'Sepede listrik mati ..ban bocor.riting mati', '2024-12-12 00:06:28', '2024-12-12 00:06:28'),
(342, 'P342', 'Bu Nani', '081327022306', 'Karangnanas Sokaraja', 'Mau Pasang Riting', '2024-12-15 17:03:09', '2024-12-15 17:04:46'),
(343, 'P343', 'Bu Aprilian Adit', '08112662600', 'Mas Kemambang Purwokerto', 'Restorasi Skuter 6 unit', '2024-12-19 00:09:14', '2024-12-22 00:15:03'),
(344, 'P344', 'Hesti dwijayanti', '083137425838', 'Pasir lor rt 05 04 kec. Karanglewas kab banyumas', 'Ban bocor gembes', '2024-12-23 06:32:14', '2024-12-23 06:32:14'),
(345, 'P345', 'Husen', '0813-8770-0338', 'Sokawera patik raja', 'Sepeda hidup tp Tdk bisa d gas', '2024-12-24 16:21:20', '2024-12-24 16:21:20'),
(346, 'P346', 'heni hera', '0882005001038', 'BAG travel and rental JL Ks tubun rejasari purwokerto barat', 'Aki gampang drop', '2024-12-29 20:53:43', '2025-04-14 00:36:57'),
(347, 'P347', 'Ari Pratomo', '081342185756', 'Jatilawang', 'Tiba2 mati. \r\nMau servis ke bengkel', '2024-12-30 18:32:52', '2024-12-30 18:32:52'),
(348, 'P348', 'Pak Edi', '085870961653', 'Berkoh, Purwokerto Selatan', 'Sepeda listrik mati-matian', '2025-01-03 18:10:15', '2025-01-03 18:10:15'),
(349, 'P349', 'Pak Arif', '081393157888', 'Kaliandar', 'Servis Motoran Aki Yukita Tiba-tiba mati', '2025-01-03 22:53:10', '2025-01-03 22:53:10'),
(350, 'P350', 'Haryono', '085221885353', 'Griya Satria II Jl Merak Blok V No 16 Kalisari Sumampir Purwokerto Utara Banyumas Jawa Tengah', 'Sudah dicek charger bagus. Sudah dicek sikring juga bagus', '2025-01-04 07:37:24', '2025-01-04 07:37:24'),
(351, 'P351', 'Fanny Julia', '088227932584', 'Berkoh', 'Skuter tidak bisa digas', '2025-01-07 20:58:30', '2025-01-07 20:58:30'),
(352, 'P352', 'Mustofa', '085829289848', 'GG.Kedongdong Sokaraja Kulon, Kabupaten Banyumas', 'Servis sepeda listrik Agathos Tidak bisa digas', '2025-01-08 10:35:33', '2025-01-08 10:35:33'),
(353, 'P353', 'Dimas Tri', '081919660188', 'Desa Banjaranyar Purbalingga', 'Tukar tambah Sepeda listrik', '2025-01-08 10:40:46', '2025-01-08 10:40:46'),
(354, 'P354', 'Pak Kuat', '087810170419', 'Dukuhwuluh Tambaksari Sokaraja', 'Beli Sepeda listrik seken', '2025-01-08 22:25:56', '2025-01-08 22:25:56'),
(355, 'P355', 'Annisa', '081215717985', 'Griya satria bukit permata Q11 karangpucung bersole', 'Ban', '2025-01-09 23:06:48', '2025-05-22 05:13:13'),
(356, 'P356', 'Bpk Budi', '085824599336', 'BERKOH', 'Servis Dinamo Sepeda listrik', '2025-01-14 18:48:18', '2025-01-14 18:48:18'),
(357, 'P357', 'Pak Aviv', '0882006013005', 'Depan Klinik Teluk', 'Selis Pujasera Mati', '2025-01-14 21:30:39', '2025-01-14 21:30:39'),
(358, 'P358', 'Nur Penny', '082123192451', 'Perumahan Teluk Purwokerto Selatan', 'Ganti Aki sepeda listrik mati total', '2025-01-15 06:46:27', '2025-01-15 06:46:27'),
(359, 'P359', 'ANANG T', '085386575758', 'Pageraji rt.01/07.kec.cilongok-bms', 'Kondisi nyala,bisa jalan tapi lemah/ga bisa kenceng,nanjak dikit ga kuat', '2025-01-17 07:55:00', '2025-01-17 07:55:00'),
(360, 'P360', 'Roy baladewa', '082113556879', 'Jl komplek perumahan duren sawit baru blok B6 no 4 RT 09 RW 11 Duren sawit jakarta timur', 'Sudah ganti aki/baterai baru tapi ga bisa ngecash, kondisi charger lampu hijau', '2025-01-18 05:58:56', '2025-01-18 05:58:56'),
(361, 'P361', 'Dhaniar', '082226565714', 'perum pondok indah no H30 jalan suka damai purwokerto lor', 'gas nya tidak bisa turun', '2025-01-20 01:17:37', '2025-01-20 01:17:37'),
(362, 'P362', 'Sugeng Riyadi', '087730947273', 'Perumahan kalimasada wiradadi 1, rawasalak Kelurahan wiradadi kecamatan Sokaraja', 'Saat Tuas gas ditarik, indikator lampu langsung merah dan daya gas turun', '2025-01-28 19:33:06', '2025-01-28 19:33:06'),
(363, 'P363', 'Pak Bayu', '082221071827', 'KOREM Sokaraja', 'Sepeda listrik nggak bisa digas merk Sunrace', '2025-01-29 18:43:20', '2025-01-29 18:43:20'),
(364, 'P364', 'Dibyo', '08567250789', 'Karanggude Purwokerto Timur', 'Aki soak', '2025-02-01 08:38:56', '2025-02-01 08:38:56'),
(365, 'P365', 'Hari sulaiman', '085745173428', 'depan masjid an nur ponpes alfaruq assalafy kalibagor,jl csm songgong,rt 11/04 kalibagor', 'belum tahu', '2025-02-02 02:25:39', '2025-02-02 02:25:39'),
(366, 'P366', 'Roti mruyung', '085225000025', 'Jl pungkuran,sudagaran,banyumas', 'Di cas gak masuk & tidak bisa di matikan', '2025-02-03 00:07:27', '2025-04-09 19:08:14'),
(367, 'P367', 'Pak Fahrudin', '085727351116', 'Jl.Jend Sudirman no 32 Berkoh Purwokerto Selatan', 'Ganti Aki 1 set', '2025-02-04 01:46:59', '2025-04-09 23:36:06'),
(368, 'P368', 'Riska wulandari', '0895415443603', 'Ledug RT 05 RW 02 , tempat bapak RT', 'Nyala, tp ga bisa digas lampu rem tidak bisa mati / membalik jadi nyala terus', '2025-02-05 19:53:28', '2025-02-05 19:53:28'),
(369, 'P369', 'MITRA SMH Djoko motor Tanjung', '081391000909', 'Tanjung Delat Lampu merah', 'Servis Aki Molis dan Selis Lama tidak dipakai', '2025-02-05 22:05:06', '2025-03-12 22:45:04');
INSERT INTO `data_pelanggans` (`id`, `kode`, `nama`, `noHP`, `alamat`, `keluhan`, `created_at`, `updated_at`) VALUES
(370, 'P370', 'Pak Sugeng', '081911142277', 'Jl.Jend Sudirman no 32 Berkoh', 'Molis T3 mati tiba-tiba', '2025-02-05 22:07:32', '2025-02-05 22:07:32'),
(371, 'P371', 'Soim suprianto', '+62 822-4113-2162', 'Karanggude kulon rt 1/3 gang depan  sd n 3 karanggude kulon', 'Di cas tidak bisa masuk', '2025-02-07 07:57:47', '2025-02-07 07:57:47'),
(372, 'P372', 'Pak Iid', '082226841760', 'Sokaraja Lor bakul Gentong bekas', 'Sepeda listrik kabel terbakar', '2025-02-10 00:07:47', '2025-02-10 00:07:47'),
(373, 'P373', 'TIARA ADNANDA AD', '082135152644', 'Perumahan ketapang indah blok c4 no55A sokaraja, sokaraja kulon', 'Ban ketika dipompa anginnya seperti merembes ke luar dan tidak masuk', '2025-02-16 00:08:34', '2025-02-16 00:08:34'),
(374, 'P374', 'Prioritas', '089692081992', 'Karangpucung, Selatan Samsat Purwokerto, Barat Garasi Damri', 'Tidak bisa buat gas', '2025-02-17 22:39:18', '2025-04-05 18:34:05'),
(375, 'P375', 'heni herawati', '08112986201', 'jl ks tubun rejasari purwokerto barat', 'minta dicek unit', '2025-02-17 22:42:42', '2025-04-22 20:57:50'),
(376, 'P376', 'Pak Yono', '082134894005', 'RT 01/07 Pliken Kembaran', 'Servis sepeda listrik', '2025-02-18 04:34:00', '2025-02-18 04:34:00'),
(377, 'P377', 'Mlaku Coffee Karangkober', '08112986201', 'BAG rent Karangkober', 'Servis Selis Pujasera', '2025-02-18 19:30:06', '2025-02-18 19:30:06'),
(378, 'P378', 'SIDIQ', '0895325898900', 'Karangkobar gang 7 no. 99', 'Sepeda kode B sudah dicek hanya belum bisa jalan', '2025-02-18 23:03:28', '2025-05-28 18:38:39'),
(379, 'P379', 'Yoyon', '085717473725', 'Perum Gsp blok i3 no 36 Sampang cilacap', 'Gak mau di cas', '2025-02-19 01:30:00', '2025-02-19 01:30:00'),
(380, 'P380', 'Irham Akbar', '085712125600', 'Servis di bengkal', 'Servis Molis T3 switch sped Rusak', '2025-02-21 02:40:24', '2025-02-21 02:40:24'),
(381, 'P381', 'Imam Priyono / Sri K.', '085867629729', 'Kalisalak 01/02 Kalisalak, Kebasen', 'Batrey naik turun saat dipakai dan tidak ada tenaganya saat digas', '2025-02-24 20:55:59', '2025-02-24 20:55:59'),
(382, 'P382', 'Danti', '085129393535', 'Perum. Bukit Kalibagor indah blok g3 nomor 10', 'Lambat dr sebelum nya', '2025-02-26 17:32:46', '2025-04-07 16:25:04'),
(383, 'P383', 'Pak Riyan', '081280276027', 'Jl.Gatot Subroto no.113 BAG Cilacap depan Jl.Sulawesi', 'Servis Selis Pujasera', '2025-02-27 21:34:29', '2025-02-27 21:34:29'),
(384, 'P384', 'Pak Suwanto Tonjong', '085869618405', 'Tonjong Purwokerto Selatan', 'Servis Aki sepeda listrik Soak', '2025-02-28 02:38:47', '2025-02-28 02:38:47'),
(385, 'P385', 'Bu Ita Susanti', '088221723642', 'Kedungwuluh kidul Patikraja Banyumas', 'Servis Sepeda listrik Aki soak', '2025-03-02 03:00:39', '2025-03-02 03:00:39'),
(386, 'P386', 'Ajeng Ristiani', '089611240799', 'Sokaraja Wetan RT 5 RW 2', 'Bisa nyala tdk bisa jalan gas nya', '2025-03-03 20:33:16', '2025-05-06 01:41:45'),
(387, 'P387', 'Pak Barka', '0882008839798', 'Desa Kalisube Banyumas', 'Jual Sepeda listrik bekas Super Rider', '2025-03-04 05:59:42', '2025-03-04 05:59:42'),
(388, 'P388', 'Nurhadi Kurniawan', '08156989669', 'Kedondong RT002 RW002 Kedondong sokaraja. Depan Lapangan Kedondong cat pagar warna Hitam. sebelah barat Apotek Kdd Farma', 'Bateran sudah di ganti,  charger tetap hijau. Tidak bisa mengisi ke baterainya', '2025-03-09 19:57:40', '2025-03-09 19:57:40'),
(389, 'P389', 'MITRA SMH Toko Sepeda MM Purbalingga Pak Hendry', '081527079999', 'Toko Sepeda MM Purbalingga perempatan lampu merah besar', 'Mitra Servis Toko Sepeda MM Purbalingga', '2025-03-10 23:35:44', '2025-03-10 23:35:44'),
(390, 'P390', 'MITRA SMH Toko sepeda Obor Purbalingga pak Laudi Aris', '081267890840', 'Toko sepeda Obor Bahagia Purbalingga', 'Mitra Servis Selis Molis Hoki', '2025-03-10 23:38:59', '2025-03-10 23:38:59'),
(391, 'P391', 'MITRA SMH Toko Roxy Cell Purbalingga pak Hendry', '085201015758', 'Roxy Cell Purbalingga Jl.kolonel Sugiono', 'Mitra Servis Sepeda listrik', '2025-03-10 23:49:37', '2025-03-10 23:49:37'),
(392, 'P392', 'Pak Wiwit Agus Wicaksono', '08562644145', 'Servis di bengkel', 'Servis Aki Sepeda listrik', '2025-03-11 04:44:11', '2025-03-11 04:44:11'),
(393, 'P393', 'Cecep uliyana', '085369341302', 'Mesuji, Ogan Kumering Ilir, Sumatra Selatan', 'Custom Sound booster', '2025-03-12 16:10:18', '2025-03-12 16:10:18'),
(394, 'P394', 'Pak Udin', '082137562951', 'Servis di bengkel', 'Servis Charger Molis Volta', '2025-03-12 23:48:01', '2025-03-12 23:48:01'),
(395, 'P395', 'Effendi', '085251752303', 'Jl.Serayu 1 samping Pom.bensin Rawalo', 'Beli sepeda listrik Selis IOI', '2025-03-14 01:33:39', '2025-03-14 01:33:39'),
(396, 'P396', 'Bu Iis Suparno', '085747195211', 'Kalibagor Sokaraja, RT6/RW1 depan Perumahan Kalibagor', 'Sepeda listrik Sunrace B', '2025-03-14 21:21:29', '2025-03-14 21:21:29'),
(397, 'P397', 'Dwi Wulansari', '081226918081', 'Perum griya Tegal Sari indah (timur UMP)jl.pepaya blok I4, no.1 RT 4/6 Bojongsari Kembaran', 'Sudah di cek di bengkel terdekat ternyata dop nya rusak,,ukuran ban tubles,60/100-10, bila perlu bawa ban baru,,blm dicek bocor/tidaknya', '2025-03-15 17:34:31', '2025-03-15 17:34:31'),
(398, 'P398', 'Fendi Rismawan', '085385153511', 'milano village Blok17 No.09. Gading serpong', 'lama tidak dipakai batrai tidak bisa dicas dan tidak bisa menyala', '2025-03-15 20:20:40', '2025-03-15 20:20:40'),
(399, 'P399', 'Mahdy Faraj ITTP Industri', '085162596002', 'Klien Vendor ITTP teknik Industri Angkatan 2022', 'Membuat projek Otomasi pertanian', '2025-03-20 09:11:44', '2025-03-20 09:11:44'),
(400, 'P400', 'Pak Wahidin Sudiro', '085717678912', 'Embung Kemutug Baturaden', 'Beli ban tubeless sepeda listrik', '2025-04-06 22:56:57', '2025-04-06 22:56:57'),
(401, 'P401', 'Wasilah', '085773911995', 'Rt4/rw5 grumbul kaligebang, desa kaliori, kecamatan kalibagor, kabupaten banyumas, (sebelah rumah pak rt)', 'Gak bisa jalan/digas', '2025-04-07 02:31:26', '2025-04-19 05:40:50'),
(402, 'P402', 'ENY ENDARWATY', '0816694127', 'Jl P kemerdekaan gg 1/39 rt 04rw05/blkng SMP muhammadiyah moro', 'Batt habis bis mau dchass lampu hijau terus tidak mau nyala merah', '2025-04-09 18:02:35', '2025-04-09 18:02:35'),
(403, 'P403', 'Embung Kemutug Jelita', '085717678912', 'Embung Kemutug Lor Jelitaa Baturraden', 'Beli Ban tubeless', '2025-04-09 21:06:56', '2025-04-09 21:06:56'),
(404, 'P404', 'Bu Sustiyah', '087811765946', 'Servis di bengkel', 'Ganti Aki Selis Butterfly', '2025-04-09 22:38:14', '2025-04-09 22:38:14'),
(405, 'P405', 'Pak Sekha Nur Kholis', '0882008690191', 'Servis di bengkel', 'Servis Aki sepeda listrik soak', '2025-04-12 00:59:07', '2025-04-12 00:59:07'),
(406, 'P406', 'Nanang Riyanto', '081392683414', 'Asramah wijaya Kusuma Rt6 RW 01 Desa kejawar kab Banyumas Jawa tengah', 'Di cas tidak masuk', '2025-04-12 01:43:47', '2025-04-12 01:43:47'),
(407, 'P407', 'candra shakira', '089518549693', 'Jl. Turmudi sokaraja lor rt 01/01', 'rem nya rusak tidak bisa di rem dan di gas', '2025-04-14 20:29:05', '2025-04-14 20:29:05'),
(408, 'P408', 'Hank', '085727041502', 'Martadireja 2 GG merpati no 8 purwokerto', 'Perlu balancing batrey 72v 38 ah', '2025-04-14 22:59:50', '2025-04-14 22:59:50'),
(409, 'P409', 'Catur indah erawati', '081804875455', 'Jl kyai mursyid rt 4 rw 3 sokaraja lor\r\nDEPAN SMA MAARIF SOKARAJA', 'Sepeda listrik merk u win fly  tidak bisa mundur \r\nKl dipaksa bunyi', '2025-04-15 01:00:58', '2025-04-15 01:00:58'),
(410, 'P410', 'Lehan', '085774107641', 'Desa kebanggan rt5 rw4 kec sumbang kab banyumas', 'Tidak bisa digas', '2025-04-15 01:12:28', '2025-04-15 01:12:28'),
(411, 'P411', 'api', '0882007095175', 'aima purwokerto, depan bank mandiri pwt', 'aki rusak perlu terapi', '2025-04-15 04:57:33', '2025-04-15 04:57:33'),
(412, 'P412', 'Nindra Oktras vns', '081398574545', 'Dusun dua rawalo rt02/06 kec. Rawalo kab. Banyumas', 'Nek dicas indikator adaptore ora brubah oren wis smingguan terus siki malah indikator adaptore ora murub blas', '2025-04-16 01:55:13', '2025-04-16 01:55:13'),
(413, 'P413', 'Pak Andi', '082226472141', 'Servis di bengkel', 'Sepeda listrik ION speedo patah dan Aki Soak karena tidak pernah digunakan', '2025-04-16 17:29:37', '2025-04-16 21:28:47'),
(414, 'P414', 'SESAR', '082243042323', 'Desa Mandirancan RT 2 RW 1 kecamatan Kebasen kabupaten banyumas, selatan masjid an nur', 'Digas tidak jalan', '2025-04-18 16:46:29', '2025-04-18 16:46:29'),
(415, 'P415', 'Winarti', '085311199810', 'Jln masjid RT 03/02 no 33 Kedung randu, Patikraja, Banyumas, jateng', 'Ban mudah kempes, sm pedal rusak 1', '2025-04-20 06:25:54', '2025-04-20 06:25:54'),
(416, 'P416', 'Wisnu Dian Nugroho', '081906522270', 'Karanglewas RT.002/RW.001 Kec.Jatilawang Kan.Banyumas', 'Dinamo konslet dan bukaan gas harus penuh baru bisa jalan', '2025-04-21 03:40:39', '2025-04-21 03:40:39'),
(417, 'P417', 'Pak Kasidi Saesar', '081229520254', 'Depan Masjid An nur Kebasen Banyumas', 'Servis Aki Molis T3 Soak 1', '2025-04-21 17:28:05', '2025-04-21 17:28:05'),
(418, 'P418', 'Pak Karsito', '088980853385', 'Graha Timur Blok 12 3B', 'Beli sepeda listrik bekas Exotic X-track warna Merah', '2025-04-21 21:50:35', '2025-04-21 21:50:35'),
(419, 'P419', 'Karsono', '0812 25136657', 'Jl Kober Gg Klengkeng Rt 6 Rw 1 Kober, Purwokerto Barat 53132', 'Stater kadang nyala kadang engga.\r\nSaat sepeda listrik digunakan ditanjakan, tiba2 mati sendiri', '2025-04-22 20:41:17', '2025-04-22 20:41:17'),
(420, 'P420', 'Pak Fuad', '081229466167', 'GG.Klengkeng Kober', 'Servis sepeda listrik kabel lepas', '2025-04-24 00:28:34', '2025-04-24 00:28:34'),
(421, 'P421', 'Antony asliady', '085385771048', 'Jl.puteran', 'Pertama ngga bisa mati, terus tiba² Mati', '2025-04-24 17:52:57', '2025-05-17 22:27:50'),
(422, 'P422', 'api', '08542123520', 'aima purwokerto', 'lobet', '2025-04-25 00:49:24', '2025-04-25 00:49:24'),
(423, 'P423', 'Karya Desa', '085173104949', 'Unsoed depan rsgp', 'Tidak bisa di gas', '2025-04-26 22:22:01', '2025-05-05 20:30:08'),
(424, 'P424', 'Pak Seno', '0895383240122', 'Servis di bengkel', 'Sepeda listrik tidak bisa digas', '2025-04-29 02:46:59', '2025-04-29 02:46:59'),
(425, 'P425', 'Pak Budi', '082324271239', 'Servis sei bengkel', 'Servis rem dan kelistrikan Selis Sniper', '2025-05-01 01:59:13', '2025-05-01 01:59:13'),
(426, 'P426', 'Pak Sugeng Depo', '081380075759', 'Depan Depo Pelita Sokaraja', 'Servis sepeda listrik', '2025-05-05 00:35:07', '2025-05-05 00:35:07'),
(427, 'P427', 'Nur Cahyono', '081225774752', 'Samping Warung makan Neni Karangkober', 'Servis Kontak Motor Listrik', '2025-05-08 21:03:15', '2025-05-08 21:03:15'),
(428, 'P428', 'Vivi', '081235225938', 'Perumahan berkoh \r\nJl. Beringin K 91A \r\nPurwokerto', 'Servis motor listrik aki soak', '2025-05-08 23:21:15', '2025-05-08 23:21:15'),
(429, 'P429', 'Haris Haryanto', '08977444425', 'perum pemda - jl sokajati Bantarsoka no 79', 'ban bocor', '2025-05-15 18:29:55', '2025-05-15 18:29:55'),
(430, 'P430', 'Jamaludin Abdul Karim', '087761198115', 'Blok Jagawana RT 03 RW 01 Desa Danamulya Kec. Plumbon Kab. Cirebon', 'Aki kayaknya rusak', '2025-05-16 01:01:35', '2025-05-16 01:01:35'),
(431, 'P431', 'Trias Adi Pramono', '083869294004', 'Karangtengah RT:008 RW:004, Kemangkon, Purbalingga', 'Baterai tidak bisa di cas', '2025-05-17 01:59:10', '2025-05-17 01:59:10'),
(432, 'P432', 'Pak Adi Plered', '083830061080', 'Jl.Pertamina Jalan Nyai ronggeng Plered Cirebon', 'Jual sepeda listrik bekas Uwinfly D8', '2025-05-17 06:29:15', '2025-05-17 06:29:15'),
(433, 'P433', 'Embung Kemutug Lor', '085237411123', 'Embung Kemutug Lor\r\nDs Kemutug lor - Baturraden', '- ada 3 selis\r\n- Posisi on di gas gak jalan.\r\n- Roda belakang seret, macet.\r\n- Alarm eror suka bunyi sendiri.\r\n- Cek kampas rem, bila habis ganti\r\n- cas rusak gak bisa ngecas\r\n- bawa ban belakang', '2025-05-18 18:22:06', '2025-05-18 18:22:06'),
(434, 'P434', 'Sri rahayu', '089685204266', 'LPP LPBA AL-HIKMAH purwokerto \r\nJln Tipar Baru I Nomor 23\r\nKranji Purwokerto Timur \r\nDepan Masjid Al-Muslimun', 'Minta servis ganti semua kabel sekalian', '2025-05-18 20:49:17', '2025-05-18 20:49:17'),
(435, 'P435', 'Tiara Fara', '081585641350', 'Kost Wisma Kenanga 2, Jl. Perintis, Rt 04 Rw 01 Kel. Grendeng, Kec. Purwokerto Utara, (Komplek Perumahan Oase Residence)\r\n+ Ada warung dan cat rumah berwarna merah putih', 'Speedometer tiba-tiba berkedip dan langsung mati pada saat perjalanan', '2025-05-18 23:50:20', '2025-05-18 23:50:20'),
(436, 'P436', 'Samudera', '082135281313', 'Perum mutiara pratama blok c 16', 'velg peang dan kelistrikan ada sedikit masalah', '2025-05-20 04:16:49', '2025-05-20 08:53:26'),
(437, 'P437', 'Totok Budiyanto', '081325813862', 'Pr. Sangkal Putung 16/38 rt02 rw01 bareng lor klaten utara klaten jawa tengah 57431', 'Pemesanan baterai 36 v 10ah untuk DYU VIP  panjang 20.5 cm lebar 7 cm tinggi 8 cm', '2025-05-21 22:58:26', '2025-05-21 23:34:34'),
(438, 'P438', 'Michael', '081390025073', 'Jl suranenggala mo1\r\nRt 4 rw 6\r\nRejasari', 'Selis tidak bisa dinyalakan, bisa dicas nyala sebentar mati lagi', '2025-05-22 20:34:54', '2025-05-22 20:34:54'),
(439, 'P439', 'Aditya', '085640913191', 'Sudirman Village C20 tugu gewok ke Utara, Karanggintung, Sumbang', 'sudah ganti controller tapi tidak bisa di gas', '2025-05-23 22:04:23', '2025-05-23 22:04:23'),
(440, 'P440', 'Marwah', '085781399858', 'Perum duta bandara blok J2 no 4', 'Ganti ban', '2025-05-24 20:26:16', '2025-05-24 20:26:16'),
(441, 'P441', 'Pak Sohidin', '083863960535', 'Ledug ujung', 'Servis sepeda listrik Aki soak', '2025-05-26 07:28:18', '2025-05-26 07:28:18'),
(442, 'P442', 'Candra Shakira (echa)', '0895384921819', 'Jalan Turmudi rt01 rw01, sokaraja, Banyumas (dari titan cell masih lurus sedikit sampe ketemu rumah cat putih di sebelahnya ada gang kecil masuk gang saja)', 'Ban bocor, pentil hilang', '2025-05-28 01:53:56', '2025-05-28 01:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idReservasi` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `waktuMulai` time NOT NULL,
  `waktuSelesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `idReservasi`, `tanggal`, `waktuMulai`, `waktuSelesai`, `created_at`, `updated_at`) VALUES
(131, 215, '2025-05-29', '17:00:00', '17:59:00', '2025-05-28 19:27:13', '2025-05-28 19:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kerusakans`
--

CREATE TABLE `jenis_kerusakans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kerusakans`
--

INSERT INTO `jenis_kerusakans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Ban Kempes/Bocor', '2024-10-16 04:25:25', '2024-10-16 04:25:25'),
(2, 'Bisa Nyala tidak bisa digas', '2024-10-16 04:25:50', '2024-10-16 04:25:50'),
(3, 'Konslet/salah sambung', '2024-10-16 04:26:20', '2024-10-16 04:26:20'),
(4, 'Lemah saat dipakai, hanya mampu jarak pendek', '2024-10-16 04:26:59', '2024-10-16 04:26:59'),
(5, 'Tidak bisa kencang, lebih lambat dari biasanya', '2024-10-16 04:27:21', '2024-10-16 04:27:21'),
(6, 'Tidak bisa di cas, Lampu cas langsung hijau', '2024-10-16 04:28:04', '2024-10-16 04:28:04'),
(7, 'Lama tidak dipakai', '2024-10-16 04:28:13', '2024-10-16 04:28:13'),
(8, 'Riting nggak nyala', '2024-10-16 04:28:49', '2024-10-16 04:28:49'),
(9, 'Klakson Mati', '2024-10-16 04:29:02', '2024-10-16 04:29:02'),
(10, 'Lampu utama mati', '2024-10-16 04:29:14', '2024-10-16 04:29:14'),
(11, 'Lampu belakang mati', '2024-10-16 04:29:23', '2024-10-16 04:29:23'),
(12, 'Remot tidak berfungsi', '2024-10-16 04:29:45', '2024-10-16 04:29:45'),
(13, 'Tiba-tiba Mati', '2024-10-16 04:30:32', '2024-10-16 04:30:32'),
(14, 'Charger tidak berfungsi', '2024-10-16 04:30:55', '2024-10-16 04:30:55'),
(15, 'Kunci Kontak Hilang atau Rusak', '2024-10-16 04:31:42', '2024-10-16 04:31:42'),
(16, 'Kode Error', '2024-10-16 04:32:00', '2024-10-16 04:32:00'),
(17, 'Di gas Mblandang atau tidak bisa dikendalikan', '2024-10-16 04:32:25', '2024-10-16 04:32:25'),
(18, 'Susah berbelok', '2024-10-16 04:32:38', '2024-10-16 04:32:38'),
(19, 'Body Pecah atau Retak', '2024-10-16 04:37:17', '2024-10-16 04:37:17'),
(20, 'Aksesoris rusak', '2024-10-16 04:37:43', '2024-10-16 04:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_03_221415_create_jenis_kerusakans_table', 2),
(5, '2024_10_03_221350_create_reservasis_table', 3),
(6, '2024_10_04_015539_create_jadwals_table', 3),
(7, '2024_10_04_015546_create_riwayats_table', 3),
(8, '2024_10_04_042710_create_ulasans_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_jadwals`
--

CREATE TABLE `req_jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idReservasi` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktuMulai` time NOT NULL,
  `waktuSelesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `req_jadwals`
--

INSERT INTO `req_jadwals` (`id`, `idReservasi`, `tanggal`, `waktuMulai`, `waktuSelesai`, `created_at`, `updated_at`) VALUES
(133, 214, '2025-05-30', '15:00:00', '16:00:00', '2025-05-28 01:53:56', '2025-05-28 01:53:56'),
(134, 215, '2025-05-28', '17:00:00', '18:00:00', '2025-05-28 03:55:53', '2025-05-28 03:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `reservasis`
--

CREATE TABLE `reservasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `servis` varchar(255) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `alamatLengkap` text DEFAULT NULL,
  `noTelp` varchar(255) NOT NULL,
  `idJenisKerusakan` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `noResi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasis`
--

INSERT INTO `reservasis` (`id`, `servis`, `namaLengkap`, `alamatLengkap`, `noTelp`, `idJenisKerusakan`, `deskripsi`, `gambar`, `video`, `noResi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Service', 'Nuryanto', 'Surya Kencana, Bojongsari, Depok Jawa Barat', '082116785776', 20, 'Spion Pecah, Perlu ganti baru keknya', 'images/damage/KF2k37JRoVKVvsgY81p1laaaJV4o4QvtRnUUkHLJ.jpg', NULL, 'HM-24101653', 'completed', '2024-10-16 04:42:05', '2024-10-16 04:46:05'),
(6, 'Home Service', 'Bu Linda', 'Blok F2 Perumahan Grand Safira Purwosari Purwokerto Utara', '081215507704', 5, 'Bar baterai turun jadi 3 saat digas dan naik ke 4 kalo didemin', 'images/damage/VoGf4QCcGbbKMjOKqnQEDGBzRsvv9lMPRPJ2SKeV.jpg', NULL, 'HM-241022BC', 'completed', '2024-10-22 02:14:33', '2024-10-23 01:53:08'),
(18, 'Home Service', 'Rofiu', 'Jln greja depan balai julianus', '088226917271', 4, 'Batrai full hanya mampu berjln 200 meter dan kadang lambat jlannya', 'images/damage/Is94wOIZ3VY20IJXVZzSgCFR6vnWRGGKkuFtHzne.jpg', 'videos/damage/DJGwz2SWcgGIel8yjkyb3k14nx1HkDM6kxxPBFe9.mov', 'HM-24102337', 'completed', '2024-10-22 21:46:28', '2024-10-23 04:59:02'),
(19, 'Home Service', 'Kartikawati', 'Kemutug kidul RT 4 RW 3', '085869946535', 20, 'Rantai lepas. Saat di tanjakan selalu lepas', 'images/damage/pbDGWKdGWLOZeBjAyXXMgm0tgfnOhEYWmllqojz9.jpg', NULL, 'HM-241024AE', 'completed', '2024-10-23 21:08:25', '2024-10-26 06:25:33'),
(21, 'Home Service', 'Dicky julindra', 'pangebatan 3/1 karanglewas, banyumas', '081393444439', 4, 'baterai lemah', 'images/damage/dpRTKUqNEGEFjNUCLrzSkmatvJg5yfRUukG5nMFJ.jpg', NULL, 'HM-241026AD', 'completed', '2024-10-26 05:52:56', '2024-10-29 05:59:16'),
(22, 'Home Service', 'Akhmad Iwan Fauzi', 'Jln. Lor Sawah Desa Wlahar Wetan RT 10/2 Kec. Kalibagor (Rumah Bpk Iwan/Bu Iis, depan gang Mushola Nurul Falah)', '081228257205', 6, 'Lampu ces hijau tidak menyala, ketika ces tertanam bisa menyala..', 'images/damage/FYQRLM9CmGsK88cTB67cwE0G38QtsUU0bPmBRcJO.jpg', 'videos/damage/mgWd0HlMhYxXdvOwFboROMqrnaSIUGoc4WrPe60h.mp4', 'HM-241026ED', 'completed', '2024-10-26 07:03:43', '2024-10-31 18:20:41'),
(24, 'Home Service', 'Sigit', 'Kantin Padang IT Telkom Jl DI Panjaitan 128 Purwokerto', '081578011820', 4, 'Jika sudah semalam di charge dan dipake 4km muncul suara minta di charge + kecepatan maximal menurun.  Padahal tegangan Aki masih 48V', 'images/damage/wJStBarIiiK8KI6m5ipfSNEgI4N0FCQZnKEt8tYu.jpg', NULL, 'HM-24102840', 'completed', '2024-10-27 18:42:09', '2024-10-28 04:28:06'),
(41, 'Home Service', 'Arief', 'Jalan Rasamala Raya no 64 RT 5 RW 6 Perum Teluk Purwokerto Selatan', '085878657199', 2, 'Nyala Tidak bisa di gas, habis di cuci', 'images/damage/adBWE46T9Sf4sY8A7jKYH8AD9GUE81VIseji3BUe.jpg', NULL, 'HM-241031E9', 'completed', '2024-10-31 01:15:03', '2024-10-31 02:29:38'),
(42, 'Garage Service', 'Susanto', 'Ledug, Purwokerto', '08118801737', 6, 'Hoverboard rusak di baterai', 'images/damage/yk2k7klyCmzMtXEkT15ALKn2YQNgFqGnpONEryAY.jpg', NULL, 'GR-241031DC', 'completed', '2024-10-31 01:26:36', '2024-11-03 22:39:28'),
(43, 'Home Service', 'Surya alamsyah', 'Wahana menara teratai', '087829070277', 2, 'Rusak', 'images/damage/SkbyQNtnIbI8GEDuA5sgPN40dWz2NMOpAjKpjCBt.jpg', NULL, 'HM-2411010D', 'completed', '2024-11-01 01:03:04', '2024-11-02 02:45:23'),
(44, 'Home Service', 'Pak adit', 'Menara teratai', '0811262600', 6, 'Komstor rusak', 'images/damage/yoKl1H6VfcNGiHorrb5KN1rVfpL02d9xHz38uOoM.jpg', NULL, 'HM-2411018F', 'completed', '2024-11-01 01:29:15', '2024-11-02 02:45:26'),
(45, 'Home Service', 'Adit', 'Menara teratai', '0811262600', 3, 'Jalan sebentar udah mati', 'images/damage/TaO4qXN9URyvFlWguKby4hI0nUGkWhwW3fs6dnTL.jpg', NULL, 'HM-24110105', 'completed', '2024-11-01 01:57:36', '2024-11-02 02:45:16'),
(46, 'Home Service', 'Soimah yulianti', 'RT4,Rw2 ,Kaliencit desa pajerukan Kalibagor (sebelah pabrik triplek pak pandi,rumah cat warna kuning) KALIBAGOR ,KAB BANYUMAS JAWA TENGAH', '088980310448', 2, 'Digas tidak mau jalan', 'images/damage/2d354u3K6hh566qYMMkl2MZ0QH9KCosN86nTvORj.jpg', NULL, 'HM-2411038F', 'completed', '2024-11-02 19:18:29', '2024-11-03 05:10:05'),
(47, 'Garage Service', 'Zulfikar', 'Purwokerto selatan, teluk. Jl rasamala raya no 64', '085781552592', 3, 'Gas tidak mau nyanbung', 'images/damage/K7eEI7Lblr30ZuieAEem6xoDMhFmi3fbhHptMnz9.jpg', NULL, 'GR-241105BF', 'completed', '2024-11-04 20:56:45', '2024-11-11 22:34:44'),
(48, 'Home Service', 'Toko obor', 'Jl perintis kemerdekaan', '085741252044', 2, 'Tdk bs di gas', 'images/damage/yTWdLRSRiHWlC9UzekwYdvf0nTihugcev0tAhF2B.jpg', NULL, 'HM-241106DA', 'completed', '2024-11-05 23:15:22', '2024-11-06 01:57:39'),
(49, 'Home Service', 'dina', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak \r\nnggada foto nya🙏🏼', 'images/damage/o3eCGhXsuc1aSkhmQrovvsSv6mPyFUohohQDaKQX.jpg', NULL, 'HM-241106D3', 'completed', '2024-11-05 23:41:03', '2024-11-07 19:41:57'),
(50, 'Home Service', 'dina', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak \r\nnggada foto nya🙏🏼', 'images/damage/chsAnBRo4rwBxxPVchKRewyN1N6Oed7ChaIRSKY5.jpg', NULL, 'HM-241106D4', 'completed', '2024-11-05 23:41:12', '2024-11-05 23:59:39'),
(51, 'Home Service', 'dina', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak', 'images/damage/LBzgCKmcYrnupnC4d2KhXcJTgziMvMxfE0p3S5Un.jpg', NULL, 'HM-24110687', 'completed', '2024-11-05 23:41:29', '2024-11-05 23:59:31'),
(52, 'Home Service', 'dina', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak', 'images/damage/DZvNvr3ITdjyWb0gdN7AVgvZGAKj2QdR7uqO5jC4.jpg', NULL, 'HM-241106F2', 'completed', '2024-11-05 23:42:04', '2024-11-05 23:59:27'),
(53, 'Home Service', 'dina', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak', 'images/damage/xsUXkM25677TWd1mmZHCuLfeHh6LYidxr5dQo2Fl.jpg', NULL, 'HM-241106CF', 'completed', '2024-11-05 23:42:09', '2024-11-05 23:59:23'),
(54, 'Home Service', 'dina', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak', 'images/damage/vNNUe0VsEI8FLJx1ZmIowaGsVxLCxkGFeCo7Kw5a.jpg', NULL, 'HM-241106F4', 'completed', '2024-11-05 23:42:14', '2024-11-05 23:59:18'),
(55, 'Home Service', 'dina sbm kost', 'Kost SBM Jalan Cendrawasih Gang Beo, RT.4/RW.7 PURWOKERTO UTARA', '+62 877-7481-2906', 6, 'ngga bisa di cas kak', 'images/damage/T328RmZ11tRXgFtZ03Pzm1sVzmzrIZqeghfWFqs5.jpg', NULL, 'HM-2411064D', 'completed', '2024-11-05 23:42:27', '2024-11-05 23:59:11'),
(56, 'Home Service', 'Sri Haryani', 'Banjaranyar RT 02/RW 05 sokaraja, Banyumas', '0881027784056', 5, 'Roda belakang seret banget muternya sama bunyi krok krok', 'images/damage/NOnUGi0wvx4Ax3eQPqxS5xH8K9SjsxEvtnRqQbM0.jpg', 'videos/damage/DZS5xFDxCzdawqQHZtTn2x6zQGi58gtjn5nHjY86.mp4', 'HM-24110700', 'completed', '2024-11-07 02:08:04', '2024-11-12 20:12:20'),
(57, 'Home Service', 'MUKLIS KURNIAWAN', 'Desa sokaraja kulon rt 1 rw 9', '082219092575', 2, 'Awal kadang kalau jalan tiba2 mati terus bisa nyala tidak bisa di gas', 'images/damage/tPlJ8iuWsyyw2qvv7bycfk6OvVmyfmPLNImRb88Y.jpg', NULL, 'HM-24110825', 'completed', '2024-11-07 21:34:12', '2024-11-07 21:44:15'),
(58, 'Home Service', 'MUKLIS KURNIAWAN', 'Desa sokaraja kulon rt 1 rw 9', '082219092575', 2, 'Awal kadang kalau jalan tiba2 mati terus bisa nyala tidak bisa di gas', 'images/damage/p7JvEtbUd9fjiRaIhdww7iRGdGMxzMShW6DmaKjD.jpg', NULL, 'HM-2411087F', 'completed', '2024-11-07 21:34:17', '2024-11-10 08:43:03'),
(59, 'Garage Service', 'Bu Siti Rohani', 'Kedondong RT1/RW3 Sokaraja', '085600153301', 15, 'Selis EOI handle gas pecah', 'images/damage/4FxyKbQ7M6BewukQyv2p2t6cmvqLZETG2XBH8p1z.jpg', NULL, 'GR-2411080D', 'completed', '2024-11-07 21:47:42', '2024-11-10 08:42:53'),
(60, 'Home Service', 'Ibnu', 'Depan Balai Julianus Kranji Purwokerto', '083827638655', 2, 'Kadang bisa kadang error gasjya', 'images/damage/NmkvCYYGRv9MmonVTf7tbzQQ5aDFVPi9eIW96XJC.jpg', NULL, 'HM-241108D8', 'completed', '2024-11-07 22:46:59', '2024-11-07 22:52:34'),
(61, 'Garage Service', 'Kopi Gowes', 'Jl Raya Pangebatan RT 3 RW 1, kec Karanglewas, kab Banyumas', '08983567788', 4, 'Baterai indikator full, tapi belum ada 10km sudah habis, boros', 'images/damage/Imm19odL0TJ4AmOxQM7HGZ2TSQwKeTP9YJ2Xs9Ux.jpg', NULL, 'GR-241112F1', 'completed', '2024-11-11 20:27:01', '2024-11-24 10:24:41'),
(62, 'Home Service', 'Devani', 'H6PP+GPR, Karangkobar, Sokanegara, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53115', '+62 857-0185-2909', 2, 'Kontak On tapi ketika di gas tidak bisa jalan , di kayuh terasa berat', 'images/damage/UIkAakbOYHleDSl7ecc6zQ6Ue7WdSobaHM5TI29h.jpg', NULL, 'HM-24111322', 'completed', '2024-11-12 20:05:07', '2024-11-13 00:36:35'),
(64, 'Home Service', 'Devani', 'H6PP+GPR, Karangkobar, Sokanegara, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53115', '+62 857-0185-2909', 2, 'Kontak On tapi ketika di gas ga bisa jalan', 'images/damage/f6XtfcBUAwwCdCYVv0q0OBQHvfckdyuhjLnEmz46.jpg', NULL, 'HM-24111382', 'completed', '2024-11-12 20:06:46', '2024-11-12 20:08:28'),
(65, 'Home Service', 'Devani', 'H6PP+GPR, Karangkobar, Sokanegara, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53115', '+62 857-0185-2909', 2, 'Kontak On tapi ketika di gas ga bisa jalan', 'images/damage/JsguUhYWNMmcSqHZOlTcBzpDQPmqSxW9A20M8P86.jpg', NULL, 'HM-241113C0', 'completed', '2024-11-12 20:06:59', '2024-11-12 20:08:24'),
(66, 'Garage Service', 'Velynmiro Lanfelix Putra', 'Jln. Riyanto gg. Cempaka no 24 rt 05/03 Kel. Sumampir Kec. Purwokerto Utara 53125', '085713121604', 20, 'Jok motor, roda depan, voltmeter', 'images/damage/84W3w4kp02V3xAppdaeBH1VsrumesOCmq7uw2uP3.jpg', NULL, 'GR-241115FB', 'completed', '2024-11-14 20:31:31', '2024-11-15 20:24:08'),
(67, 'Home Service', 'MUKLIS KURNIAWAN', 'Desa Sokaraja kulon RT 1 Rw 9 kec. Sokaraja', '082219092575', 1, 'Dop ban rusak', 'images/damage/1WU1A0YEAo5H365WITerEjvlqxiWkJLoLI0ughv0.jpg', NULL, 'HM-24111519', 'completed', '2024-11-15 05:08:13', '2024-11-17 18:46:59'),
(68, 'Garage Service', 'Yunan', 'Perum bukit kalibagir indah blok h4 no.12', '085227494930', 13, 'Habis dipakai tiba-tiba mati', 'images/damage/fdGGejoXXEEA39HZQ86vHJ9PxpCDaTjJfsUWNHf6.jpg', NULL, 'HM-24111671', 'completed', '2024-11-15 19:00:26', '2024-11-19 07:34:42'),
(69, 'Home Service', 'Kitchen mlaku coffe', 'Jl balai kelurahan 3 Arcawinangun Purwokerto timur', '081327595266', 6, 'Tidak bisa di gas maju mundur , ada kabel putus', 'images/damage/YyB43BDJvEaqJfIriDmiaa3IYnZzEdJPjnjoK72A.jpg', 'videos/damage/yVqJH3ZDY9WwcfQ2vknP2dEyCYKNeHVHYoZ2sB6X.mov', 'HM-24111888', 'completed', '2024-11-17 18:31:22', '2024-11-19 07:34:31'),
(70, 'Home Service', 'Rofi', 'Jln karangkobar gang 7', '088226917271', 2, 'Gak bisa di gas dan bau gosong', 'images/damage/WT2d7UoQMvhmBBPUebziuZ312JJKTh6XkkTj3E7z.jpg', NULL, 'HM-2411181F', 'completed', '2024-11-17 20:24:32', '2024-11-17 22:57:28'),
(71, 'Home Service', 'Linda', 'Blok F2 Perumahan Grand Safira Purwosari Purwokerto Utara', '081215507704', 2, 'Unit Selis Pujasera tidak respon gasnya', 'images/damage/lqMsr6cMiFiMTagcSkeXz7j1Rf9VRIhEEszyyp0F.jpg', NULL, 'HM-24112066', 'completed', '2024-11-19 21:00:51', '2024-11-20 08:10:16'),
(72, 'Home Service', 'Eva fitriani', 'Jl. Balai Desa No.23, Dusun I Kalicupak Lor, Kalicupak Lor, Kec. Kalibagor, Kabupaten Banyumas, Jawa Tengah 53191,, rt 04/ rw 01\r\n( depan balai desa kalicupak lor yang jualan teh Realitea)', '085727365079', 2, 'Kalo di gas bisa tapi kalo jalan cepet banget kaya gabisa ditemukan terus kalo mundur kaya di rem agak berat', 'images/damage/yiyKilvXs9hWWpRPtig58xnZlRCldgE9a6Nc06XW.jpg', 'videos/damage/jb2XviqH4fG8ucvzJOp5WFf9dSRTK01ctuTH3qDK.mp4', 'HM-24112240', 'completed', '2024-11-22 03:02:29', '2024-11-22 04:45:27'),
(73, 'Home Service', 'Eva fitriani', 'Jl. Balai Desa No.23, Dusun I Kalicupak Lor, Kalicupak Lor, Kec. Kalibagor, Kabupaten Banyumas, Jawa Tengah 53191,, rt 04/ rw 01\r\n( depan balai desa kalicupak lor yang jualan teh Realitea)', '085727365079', 2, 'Kalo di gas bisa tapi kalo jalan cepet banget kaya gabisa ditemukan terus kalo mundur kaya di rem agak berat', 'images/damage/VhCLOPY3Hq9gMzsxPwi2WnLJW7SLxRJ94jbQ6iVN.jpg', NULL, 'HM-241122F5', 'completed', '2024-11-22 03:05:05', '2024-11-23 00:07:08'),
(74, 'Home Service', 'Paryanto', 'Jl.teuku Umar, sokaraja wetan,depan bengkel pres pelk HERRY JBB', '081322686258', 2, 'Bisa digas ketika stang dibelokan ke kiri', 'images/damage/fXFp3Xduqte04xY6eNXIqYb3ZN7Ji2gRE26cFnDD.jpg', NULL, 'HM-24112655', 'completed', '2024-11-25 21:13:52', '2024-11-27 20:58:41'),
(75, 'Home Service', 'Pak Rahman', 'Jalan Raya Tambaksogra Sumbang Purwokerto', '085600560774', 2, 'Konslet', 'images/damage/BzxQ8TYp6yKhfwXNd1tNu1SLSk8xsvUZwpaGby57.jpg', NULL, 'HM-2411265E', 'completed', '2024-11-25 23:48:54', '2024-11-25 23:50:59'),
(76, 'Home Service', 'Karmini kartika', 'Purbalingga lor jln kiswadi rt 02 rw 02 desa sayangan\r\nDeket patung knalpot', '0895414104388', 5, 'Bila di gas jlnnya lambat ga bisa kencang', 'images/damage/Ys89wJZ2DXDlkE6c1AOvKgC4yX314fZDvkJaENOq.jpg', NULL, 'HM-241127B1', 'completed', '2024-11-27 02:20:17', '2024-11-28 00:28:04'),
(77, 'Home Service', 'Supono widodo', 'Mas kumambang', '08122750000', 12, 'Mohon dilihat dilokasi', 'images/damage/NlaZoLyzpcu0cZJ3Jh7nAtYnSVp3oDgJ7cajDTcN.jpg', NULL, 'HM-241129A8', 'completed', '2024-11-29 02:58:33', '2024-11-30 01:56:40'),
(78, 'Home Service', 'Pak Supono', 'Mas kemambang', '08122750000', 3, 'Kadang nyala kadang mati', 'images/damage/vkZcUFm8Pew8G0sCB6eTiONScITVd8MIymM3Tnh0.jpg', NULL, 'HM-24112910', 'completed', '2024-11-29 04:27:19', '2024-11-30 01:56:42'),
(79, 'Home Service', 'Mlaku Coffee', 'GOR Satria Purwokerto', '082138862788', 2, 'Tidak bisa di gas, kalo mundur bisa', 'images/damage/OU9vL4pBvEkfRXrRVcByLiQrUwh9RxZetXSmSMzK.jpg', NULL, 'HM-24113056', 'completed', '2024-11-30 03:23:38', '2024-11-30 04:14:12'),
(80, 'Home Service', 'Adila rahma', 'Randudkngkal \r\nBelakang masjid baitul hikmah', '082325973864', 7, 'Tidak bisa nyala karna lama tidak dipakai.\r\nTidak bsa dices\r\nCesan hilang', 'images/damage/zSF0Lsk90ZRObFPIqi9LF16uYXERrGmblpzLNzhf.jpg', NULL, 'HM-241201B1', 'completed', '2024-12-01 03:58:13', '2024-12-03 04:20:19'),
(84, 'Home Service', 'Tata', 'Grendeng depan Queen campus', '082138862788', 2, 'Mau servis Selis Pujasera Mogok', 'images/damage/2HvdIyIiSMtKcFlwT53G257CGQtujexplNeo7Mov.jpg', NULL, 'HM-241202AF', 'completed', '2024-12-02 03:06:17', '2024-12-02 22:07:08'),
(85, 'Home Service', 'Ummu Kultsum', 'jalan arjuna no.1(depan lapangan karawangkal', '0882007491805', 2, 'tiba² suka mati di tengah jalan padahal udh penuh', 'images/damage/8haQTj09l6wOt2HbtoONYJ3fJvDwFysd9LffJtvu.jpg', NULL, 'HM-24120315', 'completed', '2024-12-02 19:22:48', '2024-12-03 04:16:36'),
(86, 'Home Service', 'Becak mruyung', 'Jl Raya tambaksogra sumbang, samping oemah tahu sumedang, purwokerto', '08816613758', 2, 'Gas tidak berfungsi untuk jalankan becak kopi', 'images/damage/m43W2fsQV4fPovz9H45q4674qOeFlngyK1dqoLx8.jpg', NULL, 'HM-2412054A', 'completed', '2024-12-04 18:22:43', '2024-12-04 18:36:47'),
(87, 'Home Service', 'Susanto', 'Markas Kopi Mruyung', '08816613758', 2, 'Mogok Tidak bisa digas', 'images/damage/dDxpg1kxHqDPoTlHtRtd4yFKdnMQDpDBOZva4Wxu.jpg', NULL, 'HM-241205CE', 'completed', '2024-12-04 18:33:48', '2024-12-05 01:33:36'),
(88, 'Home Service', 'Zulfikar', 'Jl. Wadas kelir, karangpucung (Gesit  Cell di g maps)', '085781552592', 2, 'Kemungkinan besar konslet', 'images/damage/3Xrb3V6frBiPCF9Azxf2zvwJJjYZz2BlJnltaefh.jpg', NULL, 'HM-2412089E', 'completed', '2024-12-07 18:51:09', '2024-12-08 19:36:15'),
(89, 'Home Service', 'Aries munandar', 'Jl.ketuhu no.16 rt.3 rw.3 kel: wirasana kec:purbalingga', '082145786985', 4, 'Jalanya gasnya ngga lancar kya mau mati trs jalan lagi', 'images/damage/ywC1aKpxYpPLQCH5SS0DanzjXrxZL9KKnnwSbwBA.jpg', NULL, 'HM-241209A4', 'completed', '2024-12-08 19:28:48', '2024-12-10 02:46:55'),
(90, 'Servis ke Bengkel', 'Barid Bashofi', 'Perum mega asri Regency, blok c 14 karang benda berkoh purwokerto selatan', '081287672229', 5, 'Tidak bisa kencang,, lambat,, nggak seperti biasanya', 'images/damage/2z3hKMjBgAiwAns8dNrVushF7sQUUbZZx65mxdQs.jpg', NULL, 'HM-241209F8', 'completed', '2024-12-08 20:50:03', '2024-12-10 02:05:42'),
(91, 'Home Service', 'Saiful', 'Desa Kalibagor RT 11,RW.4 GANG 3, KALIBAGOR, BANYUMAS.(DEPAN MIE AYAM MBURI PABRIK)', '+62 853-3626-5415', 2, 'Nyala gk mau di gas', 'images/damage/eB1S0xTDkPvVQRq0HhmWsMTJGTP2R38EeYKaQyBQ.jpg', NULL, 'HM-24121043', 'completed', '2024-12-09 17:38:06', '2024-12-09 19:22:31'),
(92, 'Home Service', 'Saiful', 'Desa Kalibagor RT 11,RW.4 GANG 3, KALIBAGOR, BANYUMAS.(DEPAN MIE AYAM MBURI PABRIK)', '085336265415', 2, 'Nyala gk mau di gas', 'images/damage/UXuitXqGDLVvo01Q2jBvPkwoQw6rca445oXM0gJB.jpg', NULL, 'HM-24121076', 'completed', '2024-12-09 17:38:27', '2024-12-09 19:22:24'),
(93, 'Home Service', 'Saiful', 'Desa Kalibagor RT 11,RW.4 GANG 3, KALIBAGOR, BANYUMAS.(DEPAN MIE AYAM MBURI PABRIK)', '085336265415', 2, 'Nyala gk mau di gas', 'images/damage/xES9PjuwQcx1NYMnNd7USKCvGtG1WfqjhChAxatF.jpg', NULL, 'HM-2412101D', 'completed', '2024-12-09 17:40:45', '2024-12-11 23:33:06'),
(94, 'Home Service', 'SUSANTO', 'Jln raya tambaksogra - sumbang banyumas, samping Rumah makan oemah tahu sumedang', '08816613758', 1, 'perlu ganti ban belakang', 'images/damage/LmXwUw20PrQFge7d6dIkGelRoMb5kYk9QhH7XFee.jpg', NULL, 'HM-241211C9', 'completed', '2024-12-11 00:24:23', '2024-12-12 01:16:27'),
(95, 'Home Service', 'Puri dwi purnomo', 'Jl. Kelurahan III No. 27a, Arcawinangun. Purwokerto', '085869394677', 17, 'Rem blong,aki pecah', 'images/damage/fuzj357qF1Q707UCCnK7oI695XvSL60GTD1H8bty.jpg', NULL, 'HM-24121223', 'completed', '2024-12-11 18:49:20', '2024-12-12 20:24:45'),
(96, 'Home Service', 'Zulfikar', 'Depan lawson dekat mts', '085781552592', 2, 'Tidak mau di gas', 'images/damage/vc0aZjVsBGbXC4367au2C3n45AJhEhiQX5d4JwOw.jpg', NULL, 'HM-241212A9', 'completed', '2024-12-11 20:12:52', '2024-12-11 23:33:10'),
(97, 'Home Service', 'Sito Waluyo', 'Purwanega rt 3 rw 4 purwokerto utara', '085743829979', 7, 'Sepede listrik mati ..ban bocor.riting mati', 'images/damage/LfnBYLzvNHSk6z7h6tFjnlMZLGBQN4iQEWhxvwxU.jpg', NULL, 'HM-241212DC', 'completed', '2024-12-12 00:06:28', '2024-12-13 17:32:18'),
(98, 'Home Service', 'Ahmad dimyati', 'Sumbang Rt 2/1 kecamatan sumbang.... Patokan BRI sumbang ke barat sampe ada mushola kiri jalan masuk... Tanya aja', '085801227550', 5, 'Di gas ndredek ndredek g mau lari', 'images/damage/PSJdA3YLpnhKIixQcHtoTPmXtAIHfP7SIe6tbEED.jpg', NULL, 'HM-24121554', 'completed', '2024-12-15 16:52:58', '2024-12-15 21:08:53'),
(99, 'Home Service', 'Bu Nani', 'Karangnanas Sokaraja', '081327022306', 8, 'Mau Pasang Riting', 'images/damage/KcskQpivgyp69rNLhfLPefWsIIbFJnB81ziba12m.jpg', NULL, 'HM-2412164C', 'completed', '2024-12-15 17:04:46', '2024-12-15 20:03:00'),
(100, 'Home Service', 'TK SPD obor', 'Perintis kemerdekaan', '085741252044', 2, 'Nyala tp TDK BS gas', 'images/damage/vBqupBYOARGSrWRhyZSAaW8UxIDT0zjmW6TiocFx.jpg', NULL, 'HM-24121908', 'completed', '2024-12-18 19:33:04', '2024-12-22 00:14:00'),
(101, 'Home Service', 'Toko obor', 'Jl perintis kemerdekaan', '085741252044', 4, 'Lemah', 'images/damage/l9ergno44Lp7Ja2fynJTWkz0esL8xY79KulOkQl9.jpg', NULL, 'HM-24121917', 'completed', '2024-12-18 23:55:36', '2024-12-18 23:59:02'),
(102, 'Home Service', 'Bu Adit', 'Mas Kemambang Purwokerto', '08112662600', 13, 'Restorasi Skuter 6 unit', 'images/damage/H844A7OwXfj5aRosusyQmyBlnSKptIbBe6XSpME7.jpg', NULL, 'HM-241219D1', 'completed', '2024-12-19 00:09:14', '2025-01-18 05:14:24'),
(103, 'Home Service', 'Hesti dwijayanti', 'Pasir lor rt 05 04 kec. Karanglewas kab banyumas', '083137425838', 1, 'Ban bocor gembes', 'images/damage/L9nsiqfoVSMjNJlCxD4KBAfRHSSlaP4cDeylAl7E.jpg', NULL, 'HM-24122323', 'completed', '2024-12-23 06:32:14', '2024-12-24 02:47:21'),
(104, 'Home Service', 'Husen', 'Sokawera patik raja', '0813-8770-0338', 2, 'Sepeda hidup tp Tdk bisa d gas', 'images/damage/W1J1cWZn301lrklYdkl2fheL5fTVETdtuIMMzWhr.jpg', NULL, 'HM-2412240C', 'completed', '2024-12-24 16:21:20', '2024-12-25 19:11:27'),
(105, 'Home Service', 'Rofiu', 'Depan Java Heritage Dr.Angka', '088226917271', 5, 'Gas pol nggak bisa kenceng kabel Indikator baterai panas\r\n\r\nKadang Nyala sendiri', 'images/damage/GYt2KwEz9S1MTl2G6aUBpHUQuoBTHfqQ89jz1jtG.jpg', NULL, 'HM-24122508', 'completed', '2024-12-24 19:39:08', '2024-12-24 21:34:02'),
(106, 'Home Service', 'Rofiu', 'Markas Mlaku Coffee Karangkober', '088226917271', 2, 'ECU udah diganti yang besar tapi nggak bisa digas', 'images/damage/Vb7yKvvRHNGsMXJlPT2DEis9DWdXVpZU40XBZpc7.jpg', NULL, 'HM-24122588', 'completed', '2024-12-24 20:42:54', '2024-12-25 02:13:02'),
(107, 'Home Service', 'Kopi mruyung', 'Jl raya Tambaksogra sumbang, kantor oemah tahu Sumedang, purwokerto', '08816613758', 1, 'Ban bocor', 'images/damage/Li52Ne7eHjoEK1ZcI4aIJ27TlAhjfsHvsPb4m2Zs.jpg', NULL, 'HM-24122552', 'completed', '2024-12-25 02:57:12', '2024-12-25 22:20:43'),
(108, 'Home Service', 'Mlaku Kopi', 'Jalan Raya Dukuwaluh (Depan Fakultas UMP) sebelah florist', '082138862788', 2, 'Gerobag jika di ces bisa tetapi langsung warna hijau, di nyalakan bisa tetapi tidak bisa di gas maju dan mundur', 'images/damage/2rpUmEE3pTQyrSGSMnGCKD0H3siVycVbuUHb5ia7.jpg', NULL, 'HM-2412259C', 'completed', '2024-12-25 04:22:42', '2024-12-25 23:25:49'),
(109, 'Home Service', 'mlaku kopi', 'Jl. Kelurahan III No 27a, Arcawinangun, Purwokerto Timur\r\nMarkas Pusat Mlaku Kopi', '082138862788', 2, 'Pada saat jalan tiba2 tidak bisa di gas dan bagian baterai atau aki keluar asap', 'images/damage/TUoIrN9PpHUnwIpacieylzAdPc78EqNsmyB9nV4b.png', NULL, 'HM-24122757', 'completed', '2024-12-27 01:11:00', '2024-12-27 21:34:06'),
(110, 'Home Service', 'Heni Herawati', 'Jl Ks Tubun rejasari BAG Travel & rent Purwokerto barat', '0882005001038', 2, 'Unit kami punya aki yg drop jarak tempuhnya tidak bisa jauh, aki dicas bunyi & ada suara bising, lalu ada unit yg nyala namun tidak bisa digas', 'images/damage/yIe4UxOAWxrGq8AxntaOydqYTH0MHv9HeZ1QapH6.png', 'videos/damage/lJtvonzqIBerUMMwAK6aHq79PXqbvJV1OOTjHQgJ.mov', 'HM-24123043', 'completed', '2024-12-29 20:53:43', '2024-12-30 20:07:11'),
(111, 'Garage Service', 'VELYNMIRO LANFELIX', 'JLN. RIYANTO GG. CEMPAKA NO 24 RT05/03 KEL. SUMAMPIR KEC. PURWOKERTO UTARA', '085713121604', 8, 'Bagian tombol lampu sen/riting, dan pasang footstep', 'images/damage/pjLSgRPGnPsRZpBgltKtkh1Wv3bXQEwsFn8RYdmL.jpg', NULL, 'GR-24123053', 'completed', '2024-12-29 21:55:06', '2024-12-29 23:47:48'),
(112, 'Home Service', 'Ari Pratomo', 'Jatilawang', '081342185756', 13, 'Tiba2 mati. \r\nMau servis ke bengkel', 'images/damage/aWCnqpSlBTOdEnzIpSsVhd6Tp0VRBIDuTL3HPAaQ.jpg', NULL, 'HM-241231C1', 'completed', '2024-12-30 18:32:52', '2025-01-03 18:08:07'),
(113, 'Home Service', 'Toko obor', 'Perintis kemerdekaan no 38', '085741252044', 13, 'TDK bs digas', 'images/damage/gB6xtl39bXiczPkShFhS56SVqS7bPFZ4ZdMAfH8K.jpg', NULL, 'HM-24123197', 'completed', '2024-12-30 19:53:05', '2024-12-30 20:13:42'),
(114, 'Home Service', 'Toko obor', 'Perintis kemerdekaan no 38', '085741252044', 13, 'TDK bs digas', 'images/damage/gmW7xZljvL22hNEGVEXuqRU2ywRq32wigDLFGljH.jpg', NULL, 'HM-241231A8', 'completed', '2024-12-30 19:53:05', '2024-12-31 00:26:21'),
(115, 'Home Service', 'Pak Anton', 'H9X8+2C5 Penambongan, Kabupaten Purbalingga, Jawa Tengah', '085227377738', 6, 'Tiba-tiba nggak bisa cas, nggak ada tanda-tanda', 'images/damage/1gZybMU9sVctEnjDKWMQZN5UNyh7DYLr7HqzZADN.jpg', NULL, 'HM-2412316A', 'completed', '2024-12-30 21:15:24', '2025-01-01 21:52:49'),
(116, 'Home Service', 'TK SPD obor', 'Perintis kemerdekaan', '085741252044', 6, 'TDK bs cas', 'images/damage/XEmvKvcyLfZsXudnE4T6WJphEYbmy2iWoYfW4Wwi.jpg', NULL, 'HM-250103D0', 'completed', '2025-01-02 20:21:26', '2025-01-04 17:36:04'),
(117, 'Home Service', 'Haryono', 'Griya Satria II Jl Merak Blok V No 16 Kalisari Sumampir Purwokerto Utara Banyumas Jawa Tengah', '085221885353', 6, 'Sudah dicek charger bagus. Sudah dicek sikring juga bagus', 'images/damage/ydiKQQLZEbH4j9dUI25XbMLa0zsURf5TWNXhTACL.jpg', NULL, 'HM-250104B0', 'completed', '2025-01-04 07:37:24', '2025-01-05 19:36:04'),
(118, 'Home Service', 'Becak Meruyung', 'Jl raya tambak sogra sumbang banyumas', '08816613758', 1, 'Ban depan bagian samping kiri', 'images/damage/pYw1HDg9PMNsyVKsNOikWB75iw71DxINkm6HAHQs.jpg', NULL, 'HM-2501067F', 'completed', '2025-01-05 19:32:25', '2025-01-06 20:52:23'),
(119, 'Home Service', 'Heni hera', 'BAG travel \r\nJl ks tubun Rejasari purwokerto barat', '0882005001038', 2, 'Gerobak mlaku coffe kami tiba-tiba mogok dan tidak bisa digas \r\nbaterai akinya juga cepat boros', 'images/damage/ZKaS6pvT3WEdZlOTn9lCCvXjTkx5eHFQHNCgBfAM.jpg', NULL, 'HM-25010718', 'completed', '2025-01-06 22:04:21', '2025-01-08 22:20:00'),
(120, 'Home Service', 'Susanto/ becak mruyung', 'Jl raya tambak sogra sumbang purwokerto ( kopi mruyung )', '08816613758', 1, 'Ban bocor', 'images/damage/DkDfo3Tpp08EiZnXksZtia1ezbjW5aq6PZyvFF4X.jpg', NULL, 'HM-25010847', 'completed', '2025-01-08 03:50:47', '2025-01-09 20:18:17'),
(121, 'Home Service', 'Zulfikar', 'Jl rasamala raya no 64 teluk', '085781552592', 2, 'Nyala tidak bisa di gas', 'images/damage/NvEmAXLFXAJuiTiLkkth1DpqyP2k4oLwpvDZRO2y.jpg', NULL, 'HM-2501102F', 'completed', '2025-01-09 20:16:31', '2025-01-09 23:17:30'),
(122, 'Home Service', 'Annisa', 'Perum griya satria bukit permata karangpucung bersole.. Patung bawor naik keatas ketemu perumnya blok Q 11', '081215717985', 1, 'Ban bocor,, ban halus', 'images/damage/a4JQy5bu0ctHcuGprT8iZ8fS1TTMgzqq7jHY2FtB.jpg', NULL, 'HM-2501103A', 'completed', '2025-01-09 23:06:48', '2025-01-10 21:23:51'),
(123, 'Garage Service', 'Susanto', 'Jl raya tambak sogra sumbang purwokerto', '08816613758', 7, 'Becak tidak jalan, perlu service mesin ke bengkel dan bisa di anter jemput ke bengkel, lokasi saat ini di SPBU arcawinangun purwokerto,', 'images/damage/NBG5Wq2trXToF7hUFZj7KXT7qO2SeHUKtCU7YLkw.jpg', NULL, 'GR-250111FE', 'completed', '2025-01-10 23:27:20', '2025-01-14 18:04:37'),
(124, 'Home Service', 'Zulfikar', 'Jl rasamala raya no 64 teluk', '085781552592', 14, 'Tidak mau nge carge', 'images/damage/xhNK6igk8p4jZa2rtpvb1QoIODZyiBFLwd5pKYAg.jpg', NULL, 'HM-250113E3', 'completed', '2025-01-12 18:14:20', '2025-01-12 22:18:12'),
(125, 'Home Service', 'Zulfikar', 'Jl rasamala raya no 64 teluk', '085781552592', 14, 'Tidak mau nge carge', 'images/damage/3BZUOywYcxbO98c3TatR34PKMPrhiWqy6gkUV576.jpg', NULL, 'HM-25011316', 'completed', '2025-01-12 18:14:21', '2025-01-12 18:19:43'),
(126, 'Home Service', 'Pak Rahman', 'SPBU Arcawinangun Purwokerto', '085600560774', 7, 'Motor listrik Tangkas P6 di showroom SPBU', 'images/damage/l6z3mEExD7oji1mP1nHUFEpl7g9MKDG0qunpnqgX.jpg', NULL, 'HM-250115C3', 'completed', '2025-01-14 18:08:03', '2025-01-16 09:28:50'),
(127, 'Garage Service', 'ANANG T', 'Pageraji rt.01/07.kec.cilongok-bms', '085386575758', 5, 'Kondisi nyala,bisa jalan tapi lemah/ga bisa kenceng,nanjak dikit ga kuat', 'images/damage/fQj9kADnEX0GuzjwMiKNlhAoTJquaBmcQvLCMa7M.jpg', 'videos/damage/XTPuhedKtmzbHiHe3cp2t14i1QVGvgjEf2jQREue.mp4', 'GR-250117A0', 'completed', '2025-01-17 07:55:00', '2025-01-17 22:38:14'),
(128, 'Home Service', 'Annisa', 'Griya satria bukit permata Q 11 karangpucung', '081215717985', 1, 'Ban kempes', 'images/damage/jj1v5dmI3GHCipaLgbI4J5OgmBwJqt4Kh3iIMvpa.jpg', NULL, 'HM-25011853', 'completed', '2025-01-18 04:08:04', '2025-01-19 19:06:20'),
(129, 'Home Service', 'Roy baladewa', 'Jl komplek perumahan duren sawit baru blok B6 no 4 RT 09 RW 11 Duren sawit jakarta timur', '082113556879', 6, 'Sudah ganti aki/baterai baru tapi ga bisa ngecash, kondisi charger lampu hijau', 'images/damage/zCpruZXatWLEtu5qpzghONwS5BYakOSBEFEeM2gi.jpg', NULL, 'HM-25011875', 'completed', '2025-01-18 05:58:56', '2025-01-20 03:28:11'),
(130, 'Home Service', 'Rasiti', 'Linggasari RT 05 RW 04 kec kembaran banyumas', '085725079897', 6, 'Tidak bisa dicas,ganti aki', 'images/damage/V2zpXlHcFED2s5y1gj9rQlnFJ49GuOnyuxgyv8MK.jpg', NULL, 'HM-250120D1', 'completed', '2025-01-19 19:08:51', '2025-01-20 01:45:17'),
(131, 'Home Service', 'Dhaniar', 'perum pondok indah no H30 jalan suka damai purwokerto lor', '082226565714', 17, 'gas nya tidak bisa turun', 'images/damage/jtBNla8ZHB2x5FQoxIbrYpfrUdsLPTHSMMCSZ6yg.jpg', NULL, 'HM-2501205F', 'completed', '2025-01-20 01:17:37', '2025-01-21 04:43:14'),
(132, 'Home Service', 'Enny', 'Di panjaitan 88\r\nToko ABC\r\nPURWOKERTO', '085101657250', 20, 'Spion ganti, cek rutin', 'images/damage/Fjvy3qGLqqP47hyvVIGhENJmkKka2ws8rSBgJKjF.jpg', NULL, 'HM-250122D7', 'completed', '2025-01-21 18:47:16', '2025-01-22 00:10:30'),
(133, 'Home Service', 'Sugeng Riyadi', 'Perumahan kalimasada wiradadi 1, rawasalak Kelurahan wiradadi kecamatan Sokaraja', '087730947273', 5, 'Saat Tuas gas ditarik, indikator lampu langsung merah dan daya gas turun', 'images/damage/sz2gR3oUpByzqaDaxatBK2AvnDt5hWplXd0nVCnw.jpg', NULL, 'HM-25012977', 'completed', '2025-01-28 19:33:06', '2025-01-29 18:08:50'),
(134, 'Home Service', 'Pak Bayu', 'KOREM Sokaraja', '082221071827', 17, 'Sepeda listrik nggak bisa digas merk Sunrace', 'images/damage/Saz5624oHA5LtU6i9b7lmtHdDABh6DXbOv7h2anF.jpg', NULL, 'HM-250130B6', 'completed', '2025-01-29 18:43:20', '2025-01-30 23:18:50'),
(135, 'Home Service', 'Hari sulaiman', 'depan masjid an nur ponpes alfaruq assalafy kalibagor,jl csm songgong,rt 11/04 kalibagor', '085745173428', 3, 'belum tahu', 'images/damage/SBIjLWZfVko8iuUU6iVIFAAxO51nXje9UofqdIPq.jpg', NULL, 'HM-2502023E', 'completed', '2025-02-02 02:25:39', '2025-02-03 00:28:06'),
(136, 'Home Service', 'Roti mruyung', 'Jl pungkuran, sudagaran, banyumas\r\nKomplek kota lama banyumas', '085225000025', 13, 'Tiba2 mati,ridak ada arus listrik sama sekali', 'images/damage/BYVbwlGvWjwW7IKdUBP2CAtu4pIwqzYW1vFFFhg9.jpg', NULL, 'HM-25020345', 'completed', '2025-02-03 00:07:27', '2025-02-04 01:45:06'),
(137, 'Garage Service', 'Pak Fahrudin', 'Jl.Jend Sudirman no 32', '085727351116', 5, 'Baterai sepeda listrik mulai bermasalah', 'images/damage/1q8zjbljUNjMFO2RhkHbdtPjPAqZVinmUhhW9CDP.jpg', NULL, 'GR-25020472', 'completed', '2025-02-04 01:46:59', '2025-02-05 19:42:03'),
(138, 'Home Service', 'Riska wulandari', 'Ledug RT 05 RW 02 , tempat bapak RT', '0895415443603', 2, 'Nyala, tp ga bisa digas lampu rem tidak bisa mati / membalik jadi nyala terus', 'images/damage/Fvzbw1sr58K6JjMTRlycJfQTOOut1A73h5Wt7bnr.jpg', NULL, 'HM-250206D6', 'completed', '2025-02-05 19:53:28', '2025-02-05 22:07:52'),
(139, 'Garage Service', 'Pak Sugeng', 'Jl.Jend Sudirman no 32 Berkoh', '081911142277', 13, 'Molis T3 mati tiba-tiba', 'images/damage/GVzAd0SS6ZwQfhcfFNFh9NfFD8FAmP2M0tS3Rl7v.jpg', NULL, 'GR-25020606', 'completed', '2025-02-05 22:07:32', '2025-02-09 23:16:39'),
(140, 'Home Service', 'SARIPAH', 'Jalan Kauman Lama Gg 2 Rt 04/ Rw 05 Purwokerto Lor , Purwokerto Timur Banyumas', '081229090367', 13, 'sepeda listriknya tiba tiba ga bisa maju atau mundur trus mati gamau nyala', 'images/damage/p9loSBaAsxWK43JaZKEgW6viLqWR93UMNxLYrEU2.jpg', NULL, 'HM-25020618', 'completed', '2025-02-06 00:30:00', '2025-02-06 21:15:21'),
(141, 'Home Service', 'Susanto / becak mruyung', 'Jl Raya tambaksogra sumbang, banyumas', '08816613758', 2, 'Ada 2 becak kopling, yang ngadat di sistem gasnya, sama rem blong,', 'images/damage/hTWcCocNUy8op7D0W5tFXh8aP24YOESWTH84yacO.jpg', NULL, 'HM-2502075A', 'completed', '2025-02-06 20:27:50', '2025-02-07 00:53:04'),
(142, 'Home Service', 'Soim suprianto', 'Karanggude kulon rt 1/3 gang depan  sd n 3 karanggude kulon', '082241132162', 7, 'Di cas tidak bisa masuk', 'images/damage/XuzYDypcOLlJ9hnDqetA0SsCE1aIIq8HO3CCEOUT.jpg', 'videos/damage/ot0eHXo0J6q9Q6vZYl23FHz5q5PldHbVf52dxlT0.mov', 'HM-25020774', 'completed', '2025-02-07 07:57:47', '2025-02-11 02:46:17'),
(143, 'Home Service', 'Rianto silas', 'Garasi BAG Kober jl KS Tubun purwokerto', '082265197250', 13, 'Sekring putus...tolong di gantikan cadangan ada di box batere', 'images/damage/KfL72zScC3MphmQ1SwWDjSVLly57EXOgo7od506B.jpg', NULL, 'HM-250214B8', 'completed', '2025-02-13 22:14:06', '2025-02-15 00:31:23'),
(144, 'Home Service', 'TIARA ADNANDA AD', 'Perumahan ketapang indah blok c4 no55A sokaraja, sokaraja kulon', '082135152644', 1, 'Ban ketika dipompa anginnya seperti merembes ke luar dan tidak masuk', 'images/damage/j71IA2vqliQWJusPXrEEt1tgd7hlEWlKRmnCaOj0.jpg', NULL, 'HM-2502168D', 'completed', '2025-02-16 00:08:34', '2025-02-16 02:24:33'),
(145, 'Home Service', 'Kopi mruyung', 'Jl raya tambaksogra sumbang banyumas', '08816613758', 2, 'Ada 2 armada yang tidak bisa jalan gasnya, sama ada 1 rem kurang berfungsi', 'images/damage/FYzX7rJCCDmKeGoOewtyLYF8oh2PqpG18gUz5cQZ.jpg', NULL, 'HM-2502187A', 'completed', '2025-02-17 19:13:50', '2025-02-18 20:07:42'),
(146, 'Home Service', 'heni hera', 'BAG travel ( mlaku coffe ) \r\nJl Ks tubun Rejasari depan sd putra harapan', '08112986201', 2, 'gas eror lagi, nyala tapi tidak bs digas rem blong depan belakang', 'images/damage/Z9YdezRkILRcYNr0HFVB7UavbUFv4wkhrKRG4i1g.jpg', NULL, 'HM-25021827', 'completed', '2025-02-17 22:42:42', '2025-02-18 04:32:55'),
(147, 'Home Service', 'Yoyon', 'Perum Gsp blok i3 no 36 Sampang cilacap', '085717473725', 14, 'Gak mau di cas', 'images/damage/s7w2gwRllF9bKz4ZoFnmIwXDfzKCPJ3OkPqyTjj4.jpg', NULL, 'HM-25021982', 'completed', '2025-02-19 01:30:00', '2025-03-12 14:35:12'),
(148, 'Home Service', 'heni hera', 'jalan ahmad yani, depan kampus uin.', '08112986201', 13, 'mati, tibak bisa di gas', 'images/damage/3qaWYxJVUtR8CVhTk9mBoJ3NGnIT9L5xWi53oJFI.jpg', NULL, 'HM-25022059', 'completed', '2025-02-19 20:50:51', '2025-02-21 21:36:46'),
(149, 'Home Service', 'Imam Priyono / Sri K.', 'Kalisalak 01/02 Kalisalak, Kebasen', '085867629729', 4, 'Batrey naik turun saat dipakai dan tidak ada tenaganya saat digas', 'images/damage/snZeAye4EiffcTeTlQcCycGzYy91y2IteEKJmgrN.jpg', NULL, 'HM-25022583', 'completed', '2025-02-24 20:55:59', '2025-02-25 03:19:49'),
(150, 'Home Service', 'Danti', 'Perumahan Bukit Kalibagor Indah Blok g3 nomer 10', '085129393535', 1, 'Ban bocor dari 3hari yang lalu', 'images/damage/FU7zVNUGWYp7GsiOsAK96ldkAZKR13lCrrW1K86o.jpg', NULL, 'HM-2502272C', 'completed', '2025-02-26 17:32:46', '2025-02-26 22:48:10'),
(151, 'Home Service', 'Mlaku coffee Karangkober', 'BAG Cilacap', '08112986201', 13, 'Unit rusak tidak bisa digas 1 unit', 'images/damage/fNf32cLThCX8Wiaebp8wCgHI4LM9wtX750fnS4ev.jpg', NULL, 'HM-250228DF', 'completed', '2025-02-27 17:26:38', '2025-02-27 21:44:37'),
(152, 'Home Service', 'heni hera', 'jl ks tubun ( BAG TREVEL)', '08112986201', 17, 'ganti bantalan rem 2 unit, \r\n sensor gas dan dinamo sensor', 'images/damage/tVMyKzfrLu4yX8FAMNuhJ9oz2g0dB05Wm6gZdSg8.jpg', NULL, 'HM-250228D7', 'completed', '2025-02-28 01:59:58', '2025-03-02 01:23:01'),
(153, 'Home Service', 'Ajeng Ristiani', 'Sokarajan Wetan RT 05 RW 02, gang depan SD N 2 Sokaraja Wetan. Rumah yg pagar besi banyak tanaman', '089611240799', 8, 'Rem blong/tdk berfungsi, riting dan klakson tidak bunyi', 'images/damage/ZneCA4Bb0V8gSU5PXllp2RVr4C5OOa6p7JsZyUiO.jpg', NULL, 'HM-2503047B', 'completed', '2025-03-03 20:33:16', '2025-03-04 05:58:27'),
(154, 'Home Service', 'heni', 'Jl KS tubun BAG travel', '08112986201', 2, 'Sudah servis  tgl 1-2 maret gerobak belum dipakai sudah rusak lagi', 'images/damage/e6jPln6zQOY1wxThOuiTgBBv1ocUBrIqWG7lEq0P.jpg', NULL, 'HM-250307CF', 'completed', '2025-03-07 06:41:35', '2025-03-12 14:35:05'),
(155, 'Home Service', 'Nurhadi Kurniawan', 'Kedondong RT002 RW002 Kedondong sokaraja. Depan Lapangan Kedondong cat pagar warna Hitam. sebelah barat Apotek Kdd Farma', '08156989669', 6, 'Bateran sudah di ganti,  charger tetap hijau. Tidak bisa mengisi ke baterainya', 'images/damage/EJcarigCkv27E3XNVhZTY30lGbUGxOI1lMJV9GVe.jpg', NULL, 'HM-2503101D', 'completed', '2025-03-09 19:57:40', '2025-03-10 23:33:33'),
(156, 'Home Service', 'Bu Iis Suparno', 'Kalibagor Sokaraja, RT6/RW1 depan Perumahan Kalibagor', '085747195211', 7, 'Sepeda listrik Sunrace B', 'images/damage/ll5xoj1UumPW3x1PnLMEUrJsfhNORN98nSaWUnkV.jpg', NULL, 'HM-2503153B', 'completed', '2025-03-14 21:21:29', '2025-03-17 01:51:11'),
(157, 'Home Service', 'Dwi Wulansari', 'Perum griya Tegal Sari indah (timur UMP)jl.pepaya blok I4, no.1 RT 4/6 Bojongsari Kembaran', '081226918081', 1, 'Sudah di cek di bengkel terdekat ternyata dop nya rusak,,ukuran ban tubles,60/100-10, bila perlu bawa ban baru,,blm dicek bocor/tidaknya', 'images/damage/80imtzmZWVTR6bbGApECus56DPmV39HO4YoCqAvx.jpg', NULL, 'HM-2503161E', 'completed', '2025-03-15 17:34:31', '2025-03-15 22:55:38'),
(158, 'Home Service', 'Fendi Rismawan', 'milano village Blok17 No.09. Gading serpong', '085385153511', 7, 'lama tidak dipakai batrai tidak bisa dicas dan tidak bisa menyala', 'images/damage/93S6rnx4c6ustkgJpIPCdfCXQxJxEHF8IkoPVpFP.jpg', 'videos/damage/Nzr4Hbu33MmS5gbiEMJ6M74SVfLBxnRRzQbFeaFt.mp4', 'HM-25031676', 'completed', '2025-03-15 20:20:40', '2025-03-15 21:24:11'),
(159, 'Home Service', 'Roti mruyung', 'Sudagaran, kota.lama banyumas', '085225000025', 2, 'Lampu on nyala, tapi di gas gak jalan', 'images/damage/Uptx4k5hCY6yHbRhhARpSqouxxRFvLjnWsbqTR1b.jpg', NULL, 'HM-25031713', 'completed', '2025-03-17 02:18:18', '2025-04-11 03:13:19'),
(160, 'Garage Service', 'Prioritas', 'Karangpucung, Selatan Samsat Purwokerto, Barat Garasi Damri', '089692081992', 2, 'Tidak bisa buat gas', 'images/damage/ZMZreAR08PzX5WMWwDQLEMfEdBTtEvzRVtlUxmqT.jpg', NULL, 'GR-250406E9', 'completed', '2025-04-05 18:34:05', '2025-04-07 23:58:46'),
(161, 'Home Service', 'Danti', 'Perum. Bukit Kalibagor indah blok g3 nomor 10', '085129393535', 5, 'Lambat dr sebelum nya', 'images/damage/iDPUIltbug48u2Uq4HyaBmVGl9j7ujsCyBCAlrUL.jpg', NULL, 'HM-2504073B', 'completed', '2025-04-07 16:25:04', '2025-04-08 22:38:03'),
(162, 'Home Service', 'Zulfikar', 'Jl Rasamala Raya No. 64 Teluk', '085781552592', 3, 'Dinamo grobaknya kena kayanya mas, seperti dulu', 'images/damage/BN1qCslBNeHbjch0XWFZTCo2oF7VnX4vUwEnJEbA.jpg', NULL, 'HM-250408BD', 'completed', '2025-04-07 20:19:38', '2025-04-07 21:52:55'),
(163, 'Home Service', 'ENY ENDARWATY', 'Jl P kemerdekaan gg 1/39 rt 04rw05/blkng SMP muhammadiyah moro', '0816694127', 14, 'Batt habis bis mau dchass lampu hijau terus tidak mau nyala merah', 'images/damage/qPrpUufgIJGobBZ0NuPOz2yfGPOdPuDYIrv6ikIN.jpg', NULL, 'HM-250410BA', 'completed', '2025-04-09 18:02:35', '2025-04-09 23:04:36'),
(164, 'Home Service', 'Roti mruyung', 'Jl pungkuran,sudagaran,banyumas', '085225000025', 6, 'Di cas gak masuk & tidak bisa di matikan', 'images/damage/qzej4M3UZRiLtDIOmhlqgoNblgLFwjkVAUz96FTu.jpg', NULL, 'HM-250410CA', 'completed', '2025-04-09 19:08:14', '2025-04-11 03:13:23'),
(165, 'Home Service', 'Becak Meruyung', 'Jl raya tambaksogra sumbang Banyumas', '08816613758', 1, 'Ada 3 ban boco', 'images/damage/CmDkQYa1qcjXXeVbcBgY5mGr8iV99YbjjnQNZpYD.jpg', 'videos/damage/S6fWY8ZLHcoRyKblPzQMTmskRDUeJFz5Jxn9IxLz.mp4', 'HM-2504100D', 'completed', '2025-04-09 19:33:04', '2025-04-14 23:27:44'),
(166, 'Garage Service', 'Pak Fahrudin', 'Jl.Jend Sudirman no 32 Berkoh Purwokerto Selatan', '085727351116', 6, 'Ganti Aki 1 set', 'images/damage/ON7Xhu59t7KHLKJuauU6qzLF2kdmmJUMv3uu5XqO.jpg', NULL, 'GR-250410CA', 'completed', '2025-04-09 23:36:06', '2025-04-11 03:13:15'),
(167, 'Home Service', 'Nanang Riyanto', 'Asramah wijaya Kusuma Rt6 RW 01 Desa kejawar kab Banyumas Jawa tengah', '081392683414', 6, 'Di cas tidak masuk', 'images/damage/5DHa18ZGWEiCXgww9LKUydth3ENFayvZlCjs0LRM.jpg', NULL, 'HM-2504127A', 'completed', '2025-04-12 01:43:47', '2025-04-13 20:05:24'),
(168, 'Home Service', 'Bu Linda', 'Perumahan Griya Indah Saphire', '081215507704', 20, 'Rem depan Kiri Grobak Mlaku patah', 'images/damage/M2bynX8LOGn8tKn6frk9P9QOmvhfMiY1eQxBvXLL.jpg', NULL, 'HM-25041367', 'completed', '2025-04-13 00:02:03', '2025-04-13 23:35:45'),
(169, 'Home Service', 'heni hera', 'BAG travel and rental JL Ks tubun rejasari purwokerto barat', '0882005001038', 20, 'Aki gampang drop', 'images/damage/2GYbiTCfXIqarg2jX2HVA7i36U93QftqmiMs8o28.png', NULL, 'HM-2504147D', 'completed', '2025-04-14 00:36:57', '2025-04-15 20:01:11'),
(170, 'Home Service', 'candra shakira', 'Jl. Turmudi sokaraja lor rt 01/01', '089518549693', 2, 'rem nya rusak tidak bisa di rem dan di gas', 'images/damage/gGKitfWMAKSywLHcwAVTBU6fuWgVtQ0epfSZxVjT.jpg', NULL, 'HM-2504152F', 'completed', '2025-04-14 20:29:05', '2025-04-15 04:02:58'),
(171, 'Home Service', 'Hank', 'Martadireja 2 GG merpati no 8 purwokerto', '085727041502', 5, 'Perlu balancing batrey 72v 38 ah', 'images/damage/Eutzz3GjXNLL77a8QLXMZjlofC60fLontOiIBfV9.jpg', NULL, 'HM-25041575', 'completed', '2025-04-14 22:59:50', '2025-04-15 20:01:16'),
(172, 'Home Service', 'Catur indah erawati', 'Jl kyai mursyid rt 4 rw 3 sokaraja lor\r\nDEPAN SMA MAARIF SOKARAJA', '081804875455', 3, 'Sepeda listrik merk u win fly  tidak bisa mundur \r\nKl dipaksa bunyi', 'images/damage/bV6fChxIp2Jk6vO2AqT7FG91c2x8hPTraRkOe4TJ.jpg', NULL, 'HM-2504153F', 'completed', '2025-04-15 01:00:57', '2025-04-15 23:03:26'),
(173, 'Home Service', 'Lehan', 'Desa kebanggan rt5 rw4 kec sumbang kab banyumas', '085774107641', 2, 'Tidak bisa digas', 'images/damage/VOtwa4L0UZiXX30ycCuCIaEUZ2mzD5TrBOQ1He3u.jpg', NULL, 'HM-250415C3', 'completed', '2025-04-15 01:12:28', '2025-04-15 21:57:23'),
(174, 'Home Service', 'api', 'aima purwokerto, depan bank mandiri pwt', '0882007095175', 7, 'aki rusak perlu terapi', 'images/damage/oxbxBs9BQABM57tJQFFKCBDLOHbD1OqbVE7RSsE7.jpg', NULL, 'HM-25041548', 'completed', '2025-04-15 04:57:33', '2025-04-17 04:38:05'),
(175, 'Home Service', 'Nindra Oktras vns', 'Dusun dua rawalo rt02/06 kec. Rawalo kab. Banyumas', '081398574545', 6, 'Nek dicas indikator adaptore ora brubah oren wis smingguan terus siki malah indikator adaptore ora murub blas', 'images/damage/x3Uie1c4zgevd0xTGtY9imuBqQQNkqyERopEr94u.jpg', NULL, 'HM-250416AB', 'completed', '2025-04-16 01:55:13', '2025-04-17 01:08:50'),
(176, 'Home Service', 'Zulfikar', 'Rs margono, depan alfamart', '085781552592', 2, 'Tidak bisa di gas', 'images/damage/doMBi0rOSXAyYbbgfZbNsNuam56uBo640P9K487X.jpg', NULL, 'HM-25041655', 'completed', '2025-04-16 03:05:22', '2025-04-17 04:07:40'),
(177, 'Home Service', 'SESAR', 'Desa Mandirancan RT 2 RW 1 kecamatan Kebasen kabupaten banyumas, selatan masjid an nur', '082243042323', 2, 'Digas tidak jalan', 'images/damage/s9CG3TTwHpWrB7CEs25pmvS8fdJ0n9xSj0BcvuUR.jpg', NULL, 'HM-25041840', 'completed', '2025-04-18 16:46:29', '2025-04-21 17:26:45'),
(178, 'Home Service', 'Soewarjotto', 'Perumahan Ketapang Indah B2/31 Sokaraja Kulon', '081391418131', 4, 'Ada bunyi \"krekk krekk krekk\" di roda belakang', 'images/damage/cJNrhnM66kZu23VPeqlfa4ynZWR2JvHPpzy6Zkd3.jpg', NULL, 'HM-250419DD', 'completed', '2025-04-18 22:32:46', '2025-04-20 19:52:30'),
(179, 'Home Service', 'Wasilah', 'Rt4/rw5 grumbul kaligebang, desa kaliori, kecamatan kalibagor, kabupaten banyumas, (sebelah rumah pak rt)', '085773911995', 2, 'Gak bisa jalan/digas', 'images/damage/425rEEv8R5ZxRL9dx7lSNXBTOn3PCqhwpNTRTArr.jpg', NULL, 'HM-2504192F', 'completed', '2025-04-19 05:40:50', '2025-04-20 20:17:59'),
(180, 'Home Service', 'Winarti', 'Jln masjid RT 03/02 no 33 Kedung randu, Patikraja, Banyumas, jateng', '085311199810', 1, 'Ban mudah kempes, sm pedal rusak 1', 'images/damage/ax3MiSNTlYBdken13buOt8elrcfIF5W9qtsDYBlx.jpg', NULL, 'HM-25042033', 'completed', '2025-04-20 06:25:54', '2025-04-25 22:42:33'),
(181, 'Garage Service', 'Wisnu Dian Nugroho', 'Karanglewas RT.002/RW.001 Kec.Jatilawang Kan.Banyumas', '081906522270', 3, 'Dinamo konslet dan bukaan gas harus penuh baru bisa jalan', 'images/damage/Vu4Dd1nT0z5g2pBSRKYJ040U5EjNb5ID0Zvm9mPt.jpg', NULL, 'GR-250421A8', 'completed', '2025-04-21 03:40:39', '2025-04-21 17:29:59'),
(182, 'Garage Service', 'Wisnu Dian Nugroho', 'Karanglewas RT.002/RW.001 Kec.Jatilawang Kan.Banyumas', '081906522270', 3, 'Dinamo konslet dan bukaan gas harus penuh baru bisa jalan', 'images/damage/0HVW8rRbSPmC24dNOAvsY9citBeZ4wVZ13Bmj5V7.jpg', NULL, 'GR-25042161', 'completed', '2025-04-21 03:42:04', '2025-04-21 17:30:03'),
(183, 'Garage Service', 'Wisnu Dian Nugroho', 'Karanglewas RT.002/RW.001 Kec.Jatilawang Kan.Banyumas', '081906522270', 3, 'Dinamo konslet dan bukaan gas harus penuh baru bisa jalan', 'images/damage/DWogHa6SW4lGW3g7Rej1KPmImnObgMosv3ubpBm4.jpg', NULL, 'GR-2504211D', 'completed', '2025-04-21 03:42:22', '2025-04-29 02:46:07'),
(184, 'Home Service', 'Karsono', 'Jl Kober Gg Klengkeng Rt 6 Rw 1 Kober, Purwokerto Barat 53132', '0812 25136657', 13, 'Stater kadang nyala kadang engga.\r\nSaat sepeda listrik digunakan ditanjakan, tiba2 mati sendiri', 'images/damage/kkkkDyHn2UBPzV3lVZbmEoEGhWlhKytZYK3Lb4FW.jpg', NULL, 'HM-250423AB', 'completed', '2025-04-22 20:41:17', '2025-04-24 00:21:27'),
(185, 'Home Service', 'heni herawati', 'jl ks tubun rejasari purwokerto barat', '08112986201', 7, 'minta dicek unit', 'images/damage/N3Eo2bcyeabSbeXmOmd3sQP95EKZws62B7CjFWNp.jpg', NULL, 'HM-250423A9', 'completed', '2025-04-22 20:57:50', '2025-04-23 01:55:36'),
(186, 'Home Service', 'api', 'aima purwokerto', '08542123520', 7, 'lobet', 'images/damage/z0ndnRGFfHIpPf9oICXsImJ1AH9CkSr2QpFq3NLb.jpg', NULL, 'HM-250425F8', 'completed', '2025-04-25 00:49:24', '2025-04-26 19:13:33'),
(187, 'Home Service', 'Karya Desa', 'Gg. Arca I, Arcawinangun, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53113', '085173104949', 20, 'Rem tidak berfungsi', 'images/damage/S7b9QfS9NscCIK5x0SbNntkjaK5amS93A9ti70vO.jpg', NULL, 'HM-250427FA', 'completed', '2025-04-26 22:22:01', '2025-04-27 22:05:03'),
(188, 'Home Service', 'api', 'depan bank mandiri', '085842123520', 7, 'tidak bisa dicas', 'images/damage/vDuBowPkf5KVqXL5D9Akzo3mmMyGRPPwzT73D7KQ.jpg', NULL, 'HM-250430B5', 'completed', '2025-04-29 22:12:24', '2025-05-01 01:58:38'),
(189, 'Home Service', 'api', 'depan bank mandiri', '085842123520', 7, 'tidak bisa dicas', 'images/damage/dQHcKjW7rSlmRiivWgvdnGwll1i39kxIxjAg719D.jpg', NULL, 'HM-250430AC', 'completed', '2025-04-29 22:12:25', '2025-05-01 01:58:41'),
(190, 'Home Service', 'Karya Desa', 'Unsoed depan rsgp', '085173104949', 3, 'Tidak bisa di gas', 'images/damage/GKKVxQo7ch4wp4OdueJ8s944vBF9KZoqQq15FSzs.jpg', NULL, 'HM-250506AA', 'completed', '2025-05-05 20:30:08', '2025-05-05 23:13:08'),
(191, 'Home Service', 'Ajeng Ristiani', 'Sokaraja Wetan RT 5 RW 2', '089611240799', 2, 'Bisa nyala tdk bisa jalan gas nya', 'images/damage/PWz9NWbtN4TlOIAqJvz3h7pHPSeh3jI1PIfwABpQ.jpg', NULL, 'HM-2505069C', 'completed', '2025-05-06 01:41:45', '2025-05-06 04:37:22'),
(192, 'Garage Service', 'Vivi', 'Perumahan berkoh \r\nJl. Beringin K 91A \r\nPurwokerto', '081235225938', 5, 'Servis motor listrik aki soak', 'images/damage/cWi6XHtMqe2KizqeSelfB4ZnvOYKf6p6RFzmyxQE.jpg', NULL, 'GR-25050910', 'completed', '2025-05-08 23:21:15', '2025-05-25 23:20:50'),
(193, 'Home Service', 'Bu Enny', 'Toko 123 Jl.DI Panjaitan dekat lampu merah', '085101657250', 2, 'Tiba-tiba mati pas Hujan-hujanan', 'images/damage/ZVugZMNtKHofEGgxKGaYt13yeeDEXTNhyBgWBUR7.jpg', NULL, 'HM-25051049', 'completed', '2025-05-09 17:03:50', '2025-05-10 21:27:02'),
(194, 'Home Service', 'Mas Shiddiq', 'GG.Mlaku Karangkober Purwokerto barat', '0895325898900', 1, 'Ban belakang Selis Pujasera Bocor', 'images/damage/6RSlCJiDOjFdXuprGUjqaL6DoHcpsMCmKMcQByg1.jpg', NULL, 'HM-25051008', 'completed', '2025-05-09 17:08:19', '2025-05-15 01:19:43'),
(195, 'Home Service', 'Haris Haryanto', 'perum pemda - jl sokajati Bantarsoka no 79', '08977444425', 1, 'ban bocor', 'images/damage/QzwFtXoNg0vhRKlCGEve5dYhwB1iwSTvjlFZqoeq.jpg', 'videos/damage/8w4VcOOAKXExkGP6aApjuuj1ajNh6ZUYxmViSjYf.mp4', 'HM-2505161C', 'completed', '2025-05-15 18:29:55', '2025-05-15 21:34:32'),
(196, 'Home Service', 'Jamaludin Abdul Karim', 'Blok Jagawana RT 03 RW 01 Desa Danamulya Kec. Plumbon Kab. Cirebon', '087761198115', 4, 'Aki kayaknya rusak', 'images/damage/IOD9FXlYDJAtAmO60IyahF5F7BfLy7DzzR1DtR1R.jpg', 'videos/damage/jrkbrknJUKlnQ5lDXWXQmu5FAenEbLzu949k9xcK.mp4', 'HM-250516B5', 'completed', '2025-05-16 01:01:35', '2025-05-17 01:48:02'),
(197, 'Garage Service', 'Trias Adi Pramono', 'Karangtengah RT:008 RW:004, Kemangkon, Purbalingga', '083869294004', 6, 'Baterai tidak bisa di cas', 'images/damage/FVbzJ6VVoamdWSl6EMRt1anNxDKggkMshVr2GoHj.jpg', NULL, 'GR-250517F6', 'completed', '2025-05-17 01:59:10', '2025-05-20 00:18:47'),
(198, 'Garage Service', 'Antony asliady', 'Jl.puteran', '085385771048', 13, 'Pertama ngga bisa mati, terus tiba² Mati', 'images/damage/31CKoYFinjzo0OmyuLe5MmtbQUFJcChpB7rAJalB.jpg', NULL, 'GR-250518FA', 'completed', '2025-05-17 22:27:50', '2025-05-20 00:18:01'),
(199, 'Home Service', 'Rahma', 'Randudongkal rt 27 rw03', '082325973864', 20, 'Jok motor bagian belakang tidak ada merek super rider', 'images/damage/NCqWJjyXwkQeEEkmExixK8tRQyRxGOQuDULYk1mY.jpg', NULL, 'HM-25051818', 'completed', '2025-05-18 00:10:55', '2025-05-20 04:57:04'),
(200, 'Home Service', 'Embung Kemutug Lor', 'Embung Kemutug Lor\r\nDs Kemutug lor - Baturraden', '085237411123', 2, '- ada 3 selis\r\n- Posisi on di gas gak jalan.\r\n- Roda belakang seret, macet.\r\n- Alarm eror suka bunyi sendiri.\r\n- Cek kampas rem, bila habis ganti\r\n- cas rusak gak bisa ngecas\r\n- bawa ban belakang', 'images/damage/OS7DuCiKU6KDTL9BkJiOKPEAW4GFiauXNqGzklka.jpg', NULL, 'HM-2505194B', 'completed', '2025-05-18 18:22:06', '2025-05-18 21:55:00'),
(201, 'Home Service', 'Sri rahayu', 'LPP LPBA AL-HIKMAH purwokerto \r\nJln Tipar Baru I Nomor 23\r\nKranji Purwokerto Timur \r\nDepan Masjid Al-Muslimun', '089685204266', 2, 'Minta servis ganti semua kabel sekalian', 'images/damage/BBKmzQB0p1mRbU1r3H646PyxTwAqPmsSjPegm1TV.jpg', NULL, 'HM-250519A2', 'completed', '2025-05-18 20:49:17', '2025-05-24 04:24:34'),
(202, 'Home Service', 'Tiara Fara', 'Kost Wisma Kenanga 2, Jl. Perintis, Rt 04 Rw 01 Kel. Grendeng, Kec. Purwokerto Utara, (Komplek Perumahan Oase Residence)\r\n+ Ada warung dan cat rumah berwarna merah putih', '081585641350', 13, 'Speedometer tiba-tiba berkedip dan langsung mati pada saat perjalanan', 'images/damage/ZqODoKKSDJlOxeLOATUqIPNFHoB6v9P3ENtzo4Q8.jpg', NULL, 'HM-25051985', 'completed', '2025-05-18 23:50:20', '2025-05-20 04:56:52');
INSERT INTO `reservasis` (`id`, `servis`, `namaLengkap`, `alamatLengkap`, `noTelp`, `idJenisKerusakan`, `deskripsi`, `gambar`, `video`, `noResi`, `status`, `created_at`, `updated_at`) VALUES
(203, 'Home Service', 'Samudera', 'Perum mutiara pratama blok c 16', '082135281313', 1, 'velg peang dan kelistrikan ada sedikit masalah', 'images/damage/mdpQ4cVegS2V7GnabNAVMyox2rJw1Sb3NGRRuTIQ.jpg', NULL, 'HM-250520F5', 'completed', '2025-05-20 04:16:49', '2025-05-20 22:16:22'),
(204, 'Garage Service', 'Totok Budiyanto', 'Pr.sangkal putung 16/38 rt02 rw 01 Bareng Lor Klaten Utara Klaten Jawa Tengah 57431', '081325813862', 4, 'Pemesana baterai pack 36 v 10 ah dengan ukuran panjang 20.5 cm lebar 7 cm tinggi 8 cm , baterai untuk sepeda listrik DYU VIP', 'images/damage/mn5tYOdT6bqIE1LJ2otIP89oTFv24hbs6CEV4t9u.jpg', NULL, 'GR-25052286', 'completed', '2025-05-21 22:58:26', '2025-05-22 02:09:13'),
(205, 'Garage Service', 'Totok Budiyanto', 'Pr. Sangkal Putung 16/38 rt02 rw01 bareng lor klaten utara klaten jawa tengah 57431', '081325813862', 6, 'Pemesanan baterai 36 v 10ah untuk DYU VIP  panjang 20.5 cm lebar 7 cm tinggi 8 cm', 'images/damage/VdKnvDqMmATzD1FV8Ng92ymJIHZb8gM6Om3rhZda.jpg', NULL, 'GR-25052249', 'completed', '2025-05-21 23:34:34', '2025-05-24 04:27:09'),
(206, 'Home Service', 'Annisa', 'Griya satria bukit permata Q11 karangpucung bersole', '081215717985', 1, 'Ban', 'images/damage/tBs6puVizwJxgbZNpeVG2FuusNwW6MqCUj4saVO0.jpg', NULL, 'HM-25052208', 'completed', '2025-05-22 05:13:13', '2025-05-22 05:20:22'),
(207, 'Home Service', 'Michael', 'Jl suranenggala mo1\r\nRt 4 rw 6\r\nRejasari', '081390025073', 13, 'Selis tidak bisa dinyalakan, bisa dicas nyala sebentar mati lagi', 'images/damage/qMJlr2ZAbVRu1GKD7fIfQJM0bb8ui9qvc0CzfuWX.jpg', NULL, 'HM-2505233C', 'completed', '2025-05-22 20:34:54', '2025-05-25 02:29:17'),
(208, 'Home Service', 'Sidiq', 'Jln.karangkobar GG.07 no 99 (kantor PK bagus)', '0895325898900', 2, 'Tidak bisa digas', 'images/damage/dwC7AiGSR9qUAuTMpA5m8LQl6ExWTg2cAtQOiEKv.jpg', NULL, 'HM-25052377', 'completed', '2025-05-22 20:59:07', '2025-05-23 04:56:19'),
(209, 'Home Service', 'SIDIQ', 'Karangkobar GG.07 no.99 (kantor PK bagus)', '0895325898900', 2, 'Kerusakan sepeda KODE( D)', 'images/damage/GgCd29XQrMugsn4fjwSiP1tlq5g7lHjiF4XPgwCG.jpg', NULL, 'HM-250523B5', 'completed', '2025-05-22 21:02:29', '2025-05-23 04:56:23'),
(210, 'Home Service', 'SIDIQ', 'Karakobar gang 07', '0895325898900', 2, 'Sepeda kode F', 'images/damage/UzvUivKOoczBKtVEAjQ1waqlOmebmcTS5mFJGXqc.jpg', NULL, 'HM-25052416', 'completed', '2025-05-23 19:36:37', '2025-05-24 04:24:12'),
(211, 'Home Service', 'Aditya', 'Sudirman Village C20 tugu gewok ke Utara, Karanggintung, Sumbang', '085640913191', 2, 'sudah ganti controller tapi tidak bisa di gas', 'images/damage/HGrt7nrTwmsMpuPjwuGXPtTMCLXC25Kl8JOSmW9h.jpg', NULL, 'HM-2505241F', 'completed', '2025-05-23 22:04:23', '2025-05-24 03:23:35'),
(212, 'Home Service', 'SIDIQ', 'Karang kobar', '0895325898900', 2, 'Kendala unit sepeda B  lokasi di Java heritage', 'images/damage/FDKlFf9h9rudPHpSR7ujf8BW1ji2qirIIYcEexKF.jpg', NULL, 'HM-25052562', 'completed', '2025-05-24 20:13:25', '2025-05-26 04:53:28'),
(213, 'Home Service', 'Marwah', 'Perum duta bandara blok J2 no 4', '085781399858', 1, 'Ganti ban', 'images/damage/owzRydczr1cTHpYLe4RpKA5oiqQGopXiLkWdDLI5.jpg', NULL, 'HM-25052584', 'completed', '2025-05-24 20:26:16', '2025-05-25 02:29:21'),
(214, 'Home Service', 'Candra Shakira (echa)', 'Jalan Turmudi rt01 rw01, sokaraja, Banyumas (dari titan cell masih lurus sedikit sampe ketemu rumah cat putih di sebelahnya ada gang kecil masuk gang saja)', '0895384921819', 1, 'Ban bocor, pentil hilang', 'images/damage/zR1qtSyZWzkvEMmMkvoJ9UmsU3HcKqM2R4II4z4l.jpg', NULL, 'HM-25052888', 'pending', '2025-05-28 01:53:56', '2025-05-28 01:53:56'),
(215, 'Home Service', 'SIDIQ', 'Karang kobar gang 7', '0895325898900', 2, 'Sepeda nkode B', 'images/damage/pKSfncrXB60K1eiJvszP5Z0W69ny4nPYfqI6sQT5.jpg', NULL, 'HM-2505281C', 'confirmed', '2025-05-28 03:55:53', '2025-05-28 19:27:13'),
(216, 'Home Service', 'SIDIQ', 'Karangkobar gang 7 no. 99', '0895325898900', 2, 'Sepeda kode B sudah dicek hanya belum bisa jalan', 'images/damage/oKFOibOJypKpeTsF4ElV1GtenpaihiUq7hLji9Au.jpg', NULL, 'HM-250529A6', 'completed', '2025-05-28 18:38:39', '2025-05-28 19:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `riwayats`
--

CREATE TABLE `riwayats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idReservasi` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayats`
--

INSERT INTO `riwayats` (`id`, `idReservasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'pending', '2024-10-16 04:42:05', '2024-10-16 04:42:05'),
(2, 1, 'confirmed', '2024-10-16 04:43:49', '2024-10-16 04:43:49'),
(3, 1, 'process', '2024-10-16 04:45:35', '2024-10-16 04:45:35'),
(4, 1, 'completed', '2024-10-16 04:46:05', '2024-10-16 04:46:05'),
(14, 6, 'pending', '2024-10-22 02:14:33', '2024-10-22 02:14:33'),
(15, 6, 'pending', '2024-10-22 02:15:14', '2024-10-22 02:15:14'),
(27, 18, 'pending', '2024-10-22 21:46:28', '2024-10-22 21:46:28'),
(28, 6, 'completed', '2024-10-23 01:53:08', '2024-10-23 01:53:08'),
(41, 18, 'completed', '2024-10-23 04:59:02', '2024-10-23 04:59:02'),
(42, 19, 'pending', '2024-10-23 21:08:25', '2024-10-23 21:08:25'),
(43, 19, 'confirmed', '2024-10-23 22:17:26', '2024-10-23 22:17:26'),
(46, 21, 'pending', '2024-10-26 05:52:56', '2024-10-26 05:52:56'),
(47, 19, 'completed', '2024-10-26 06:25:33', '2024-10-26 06:25:33'),
(48, 22, 'pending', '2024-10-26 07:03:43', '2024-10-26 07:03:43'),
(49, 21, 'confirmed', '2024-10-26 07:12:40', '2024-10-26 07:12:40'),
(50, 22, 'confirmed', '2024-10-26 07:15:07', '2024-10-26 07:15:07'),
(52, 24, 'pending', '2024-10-27 18:42:09', '2024-10-27 18:42:09'),
(76, 24, 'completed', '2024-10-28 04:28:06', '2024-10-28 04:28:06'),
(77, 21, 'process', '2024-10-28 04:28:18', '2024-10-28 04:28:18'),
(79, 21, 'completed', '2024-10-29 05:59:16', '2024-10-29 05:59:16'),
(83, 41, 'pending', '2024-10-31 01:15:03', '2024-10-31 01:15:03'),
(84, 42, 'pending', '2024-10-31 01:26:36', '2024-10-31 01:26:36'),
(85, 41, 'cancelled', '2024-10-31 02:29:33', '2024-10-31 02:29:33'),
(86, 41, 'completed', '2024-10-31 02:29:38', '2024-10-31 02:29:38'),
(87, 42, 'process', '2024-10-31 02:30:04', '2024-10-31 02:30:04'),
(88, 22, 'completed', '2024-10-31 18:20:41', '2024-10-31 18:20:41'),
(89, 43, 'pending', '2024-11-01 01:03:04', '2024-11-01 01:03:04'),
(90, 44, 'pending', '2024-11-01 01:29:16', '2024-11-01 01:29:16'),
(91, 45, 'pending', '2024-11-01 01:57:36', '2024-11-01 01:57:36'),
(92, 43, 'confirmed', '2024-11-02 02:03:17', '2024-11-02 02:03:17'),
(93, 43, 'process', '2024-11-02 02:03:25', '2024-11-02 02:03:25'),
(94, 44, 'process', '2024-11-02 02:03:33', '2024-11-02 02:03:33'),
(95, 45, 'completed', '2024-11-02 02:45:16', '2024-11-02 02:45:16'),
(96, 43, 'completed', '2024-11-02 02:45:23', '2024-11-02 02:45:23'),
(97, 44, 'completed', '2024-11-02 02:45:26', '2024-11-02 02:45:26'),
(98, 46, 'pending', '2024-11-02 19:18:29', '2024-11-02 19:18:29'),
(99, 46, 'confirmed', '2024-11-03 01:00:58', '2024-11-03 01:00:58'),
(100, 46, 'completed', '2024-11-03 05:10:05', '2024-11-03 05:10:05'),
(101, 42, 'completed', '2024-11-03 22:39:28', '2024-11-03 22:39:28'),
(102, 47, 'pending', '2024-11-04 20:56:45', '2024-11-04 20:56:45'),
(103, 47, 'process', '2024-11-04 20:58:33', '2024-11-04 20:58:33'),
(104, 48, 'pending', '2024-11-05 23:15:22', '2024-11-05 23:15:22'),
(105, 48, 'confirmed', '2024-11-05 23:56:44', '2024-11-05 23:56:44'),
(106, 49, 'confirmed', '2024-11-05 23:57:42', '2024-11-05 23:57:42'),
(107, 52, 'confirmed', '2024-11-05 23:58:57', '2024-11-05 23:58:57'),
(108, 55, 'completed', '2024-11-05 23:59:11', '2024-11-05 23:59:11'),
(109, 54, 'completed', '2024-11-05 23:59:18', '2024-11-05 23:59:18'),
(110, 53, 'completed', '2024-11-05 23:59:23', '2024-11-05 23:59:23'),
(111, 52, 'completed', '2024-11-05 23:59:27', '2024-11-05 23:59:27'),
(112, 51, 'completed', '2024-11-05 23:59:31', '2024-11-05 23:59:31'),
(113, 50, 'completed', '2024-11-05 23:59:39', '2024-11-05 23:59:39'),
(114, 48, 'completed', '2024-11-06 01:57:39', '2024-11-06 01:57:39'),
(115, 56, 'pending', '2024-11-07 02:08:04', '2024-11-07 02:08:04'),
(116, 56, 'confirmed', '2024-11-07 02:45:24', '2024-11-07 02:45:24'),
(117, 49, 'completed', '2024-11-07 19:41:57', '2024-11-07 19:41:57'),
(118, 56, 'process', '2024-11-07 21:31:43', '2024-11-07 21:31:43'),
(119, 57, 'pending', '2024-11-07 21:34:12', '2024-11-07 21:34:12'),
(120, 58, 'pending', '2024-11-07 21:34:17', '2024-11-07 21:34:17'),
(121, 57, 'completed', '2024-11-07 21:44:15', '2024-11-07 21:44:15'),
(122, 58, 'confirmed', '2024-11-07 21:44:33', '2024-11-07 21:44:33'),
(123, 59, 'pending', '2024-11-07 21:47:42', '2024-11-07 21:47:42'),
(124, 59, 'confirmed', '2024-11-07 22:28:12', '2024-11-07 22:28:12'),
(125, 60, 'pending', '2024-11-07 22:46:59', '2024-11-07 22:46:59'),
(126, 60, 'confirmed', '2024-11-07 22:47:38', '2024-11-07 22:47:38'),
(127, 60, 'process', '2024-11-07 22:48:09', '2024-11-07 22:48:09'),
(128, 59, 'process', '2024-11-07 22:48:21', '2024-11-07 22:48:21'),
(129, 60, 'completed', '2024-11-07 22:52:34', '2024-11-07 22:52:34'),
(130, 59, 'completed', '2024-11-10 08:42:53', '2024-11-10 08:42:53'),
(131, 58, 'completed', '2024-11-10 08:43:03', '2024-11-10 08:43:03'),
(132, 61, 'pending', '2024-11-11 20:27:01', '2024-11-11 20:27:01'),
(133, 61, 'confirmed', '2024-11-11 21:57:49', '2024-11-11 21:57:49'),
(134, 47, 'completed', '2024-11-11 22:34:44', '2024-11-11 22:34:44'),
(135, 56, 'confirmed', '2024-11-11 22:35:16', '2024-11-11 22:35:16'),
(136, 56, 'process', '2024-11-11 22:35:31', '2024-11-11 22:35:31'),
(137, 61, 'process', '2024-11-11 23:58:13', '2024-11-11 23:58:13'),
(138, 65, 'completed', '2024-11-12 20:08:24', '2024-11-12 20:08:24'),
(139, 64, 'completed', '2024-11-12 20:08:28', '2024-11-12 20:08:28'),
(140, 62, 'confirmed', '2024-11-12 20:12:09', '2024-11-12 20:12:09'),
(141, 56, 'completed', '2024-11-12 20:12:20', '2024-11-12 20:12:20'),
(142, 62, 'process', '2024-11-12 21:42:17', '2024-11-12 21:42:17'),
(143, 62, 'completed', '2024-11-13 00:36:35', '2024-11-13 00:36:35'),
(144, 66, 'pending', '2024-11-14 20:31:31', '2024-11-14 20:31:31'),
(145, 66, 'process', '2024-11-14 22:15:23', '2024-11-14 22:15:23'),
(146, 67, 'pending', '2024-11-15 05:08:13', '2024-11-15 05:08:13'),
(147, 68, 'pending', '2024-11-15 19:00:26', '2024-11-15 19:00:26'),
(148, 67, 'confirmed', '2024-11-15 20:23:57', '2024-11-15 20:23:57'),
(149, 66, 'completed', '2024-11-15 20:24:08', '2024-11-15 20:24:08'),
(150, 68, 'confirmed', '2024-11-15 20:33:34', '2024-11-15 20:33:34'),
(151, 67, 'process', '2024-11-15 22:59:53', '2024-11-15 22:59:53'),
(152, 69, 'pending', '2024-11-17 18:31:22', '2024-11-17 18:31:22'),
(153, 67, 'completed', '2024-11-17 18:46:59', '2024-11-17 18:46:59'),
(154, 69, 'confirmed', '2024-11-17 18:48:38', '2024-11-17 18:48:38'),
(155, 68, 'cancelled', '2024-11-17 18:58:07', '2024-11-17 18:58:07'),
(156, 68, 'cancelled', '2024-11-17 19:37:48', '2024-11-17 19:37:48'),
(157, 70, 'pending', '2024-11-17 20:24:32', '2024-11-17 20:24:32'),
(158, 70, 'confirmed', '2024-11-17 22:05:31', '2024-11-17 22:05:31'),
(159, 70, 'completed', '2024-11-17 22:57:28', '2024-11-17 22:57:28'),
(160, 68, 'process', '2024-11-18 22:05:23', '2024-11-18 22:05:23'),
(161, 69, 'completed', '2024-11-19 07:34:31', '2024-11-19 07:34:31'),
(162, 68, 'completed', '2024-11-19 07:34:42', '2024-11-19 07:34:42'),
(163, 71, 'pending', '2024-11-19 21:00:51', '2024-11-19 21:00:51'),
(164, 71, 'confirmed', '2024-11-19 21:01:59', '2024-11-19 21:01:59'),
(165, 71, 'completed', '2024-11-20 08:10:16', '2024-11-20 08:10:16'),
(166, 72, 'pending', '2024-11-22 03:02:29', '2024-11-22 03:02:29'),
(167, 73, 'pending', '2024-11-22 03:05:05', '2024-11-22 03:05:05'),
(168, 72, 'completed', '2024-11-22 04:45:27', '2024-11-22 04:45:27'),
(169, 73, 'confirmed', '2024-11-22 04:46:22', '2024-11-22 04:46:22'),
(170, 73, 'process', '2024-11-22 20:09:12', '2024-11-22 20:09:12'),
(171, 73, 'completed', '2024-11-23 00:07:08', '2024-11-23 00:07:08'),
(172, 61, 'completed', '2024-11-24 10:24:41', '2024-11-24 10:24:41'),
(173, 74, 'pending', '2024-11-25 21:13:52', '2024-11-25 21:13:52'),
(174, 75, 'pending', '2024-11-25 23:48:54', '2024-11-25 23:48:54'),
(175, 74, 'confirmed', '2024-11-25 23:50:33', '2024-11-25 23:50:33'),
(176, 75, 'confirmed', '2024-11-25 23:50:50', '2024-11-25 23:50:50'),
(177, 75, 'completed', '2024-11-25 23:50:59', '2024-11-25 23:50:59'),
(178, 76, 'pending', '2024-11-27 02:20:17', '2024-11-27 02:20:17'),
(179, 76, 'confirmed', '2024-11-27 02:44:54', '2024-11-27 02:44:54'),
(180, 74, 'completed', '2024-11-27 20:58:41', '2024-11-27 20:58:41'),
(181, 76, 'process', '2024-11-27 21:19:10', '2024-11-27 21:19:10'),
(182, 76, 'completed', '2024-11-28 00:28:04', '2024-11-28 00:28:04'),
(183, 77, 'pending', '2024-11-29 02:58:33', '2024-11-29 02:58:33'),
(184, 78, 'pending', '2024-11-29 04:27:19', '2024-11-29 04:27:19'),
(185, 77, 'completed', '2024-11-30 01:56:40', '2024-11-30 01:56:40'),
(186, 78, 'completed', '2024-11-30 01:56:42', '2024-11-30 01:56:42'),
(187, 79, 'pending', '2024-11-30 03:23:38', '2024-11-30 03:23:38'),
(188, 79, 'completed', '2024-11-30 04:14:12', '2024-11-30 04:14:12'),
(189, 80, 'pending', '2024-12-01 03:58:13', '2024-12-01 03:58:13'),
(190, 80, 'confirmed', '2024-12-01 04:31:15', '2024-12-01 04:31:15'),
(200, 84, 'pending', '2024-12-02 03:06:17', '2024-12-02 03:06:17'),
(201, 84, 'confirmed', '2024-12-02 03:12:57', '2024-12-02 03:12:57'),
(202, 85, 'pending', '2024-12-02 19:22:48', '2024-12-02 19:22:48'),
(203, 84, 'process', '2024-12-02 20:48:51', '2024-12-02 20:48:51'),
(204, 84, 'completed', '2024-12-02 22:07:08', '2024-12-02 22:07:08'),
(205, 85, 'process', '2024-12-03 02:52:15', '2024-12-03 02:52:15'),
(206, 85, 'completed', '2024-12-03 04:16:36', '2024-12-03 04:16:36'),
(207, 80, 'completed', '2024-12-03 04:20:19', '2024-12-03 04:20:19'),
(208, 86, 'pending', '2024-12-04 18:22:43', '2024-12-04 18:22:43'),
(209, 87, 'pending', '2024-12-04 18:33:48', '2024-12-04 18:33:48'),
(210, 86, 'completed', '2024-12-04 18:36:47', '2024-12-04 18:36:47'),
(211, 87, 'confirmed', '2024-12-04 18:36:59', '2024-12-04 18:36:59'),
(212, 87, 'completed', '2024-12-05 01:33:36', '2024-12-05 01:33:36'),
(213, 88, 'pending', '2024-12-07 18:51:09', '2024-12-07 18:51:09'),
(214, 88, 'confirmed', '2024-12-07 20:00:37', '2024-12-07 20:00:37'),
(215, 88, 'process', '2024-12-08 19:24:43', '2024-12-08 19:24:43'),
(216, 89, 'pending', '2024-12-08 19:28:49', '2024-12-08 19:28:49'),
(217, 88, 'completed', '2024-12-08 19:36:15', '2024-12-08 19:36:15'),
(218, 90, 'pending', '2024-12-08 20:50:03', '2024-12-08 20:50:03'),
(219, 89, 'confirmed', '2024-12-08 20:50:07', '2024-12-08 20:50:07'),
(220, 90, 'confirmed', '2024-12-08 21:10:37', '2024-12-08 21:10:37'),
(221, 90, 'confirmed', '2024-12-08 21:11:13', '2024-12-08 21:11:13'),
(222, 90, 'process', '2024-12-09 01:54:59', '2024-12-09 01:54:59'),
(223, 89, 'process', '2024-12-09 01:55:06', '2024-12-09 01:55:06'),
(224, 92, 'pending', '2024-12-09 17:38:27', '2024-12-09 17:38:27'),
(225, 93, 'pending', '2024-12-09 17:40:45', '2024-12-09 17:40:45'),
(226, 92, 'completed', '2024-12-09 19:22:24', '2024-12-09 19:22:24'),
(227, 91, 'completed', '2024-12-09 19:22:31', '2024-12-09 19:22:31'),
(228, 93, 'confirmed', '2024-12-09 19:22:47', '2024-12-09 19:22:47'),
(229, 90, 'completed', '2024-12-10 02:05:42', '2024-12-10 02:05:42'),
(230, 89, 'completed', '2024-12-10 02:46:55', '2024-12-10 02:46:55'),
(231, 93, 'process', '2024-12-10 05:52:14', '2024-12-10 05:52:14'),
(232, 94, 'pending', '2024-12-11 00:24:23', '2024-12-11 00:24:23'),
(233, 94, 'confirmed', '2024-12-11 00:57:16', '2024-12-11 00:57:16'),
(234, 94, 'process', '2024-12-11 17:58:34', '2024-12-11 17:58:34'),
(235, 95, 'pending', '2024-12-11 18:49:20', '2024-12-11 18:49:20'),
(236, 96, 'pending', '2024-12-11 20:12:52', '2024-12-11 20:12:52'),
(237, 95, 'confirmed', '2024-12-11 20:14:44', '2024-12-11 20:14:44'),
(238, 96, 'confirmed', '2024-12-11 20:14:58', '2024-12-11 20:14:58'),
(239, 93, 'completed', '2024-12-11 23:33:06', '2024-12-11 23:33:06'),
(240, 96, 'completed', '2024-12-11 23:33:10', '2024-12-11 23:33:10'),
(241, 97, 'pending', '2024-12-12 00:06:28', '2024-12-12 00:06:28'),
(242, 94, 'completed', '2024-12-12 01:16:27', '2024-12-12 01:16:27'),
(243, 95, 'process', '2024-12-12 01:16:33', '2024-12-12 01:16:33'),
(244, 97, 'confirmed', '2024-12-12 01:18:05', '2024-12-12 01:18:05'),
(245, 97, 'process', '2024-12-12 05:19:44', '2024-12-12 05:19:44'),
(246, 95, 'completed', '2024-12-12 20:24:45', '2024-12-12 20:24:45'),
(247, 97, 'completed', '2024-12-13 17:32:18', '2024-12-13 17:32:18'),
(248, 98, 'pending', '2024-12-15 16:52:58', '2024-12-15 16:52:58'),
(249, 98, 'confirmed', '2024-12-15 16:59:56', '2024-12-15 16:59:56'),
(250, 99, 'pending', '2024-12-15 17:04:46', '2024-12-15 17:04:46'),
(251, 99, 'confirmed', '2024-12-15 17:05:03', '2024-12-15 17:05:03'),
(252, 99, 'completed', '2024-12-15 20:03:00', '2024-12-15 20:03:00'),
(253, 98, 'process', '2024-12-15 20:03:14', '2024-12-15 20:03:14'),
(254, 98, 'completed', '2024-12-15 21:08:53', '2024-12-15 21:08:53'),
(255, 100, 'pending', '2024-12-18 19:33:04', '2024-12-18 19:33:04'),
(256, 101, 'pending', '2024-12-18 23:55:36', '2024-12-18 23:55:36'),
(257, 101, 'completed', '2024-12-18 23:59:02', '2024-12-18 23:59:02'),
(258, 100, 'confirmed', '2024-12-18 23:59:20', '2024-12-18 23:59:20'),
(259, 102, 'pending', '2024-12-19 00:09:14', '2024-12-19 00:09:14'),
(260, 100, 'completed', '2024-12-22 00:14:00', '2024-12-22 00:14:00'),
(261, 103, 'pending', '2024-12-23 06:32:14', '2024-12-23 06:32:14'),
(262, 103, 'confirmed', '2024-12-23 22:30:37', '2024-12-23 22:30:37'),
(263, 103, 'process', '2024-12-24 01:36:00', '2024-12-24 01:36:00'),
(264, 103, 'completed', '2024-12-24 02:47:21', '2024-12-24 02:47:21'),
(265, 104, 'pending', '2024-12-24 16:21:20', '2024-12-24 16:21:20'),
(266, 104, 'confirmed', '2024-12-24 19:34:47', '2024-12-24 19:34:47'),
(267, 105, 'pending', '2024-12-24 19:39:08', '2024-12-24 19:39:08'),
(268, 105, 'confirmed', '2024-12-24 19:39:46', '2024-12-24 19:39:46'),
(269, 106, 'pending', '2024-12-24 20:42:54', '2024-12-24 20:42:54'),
(270, 106, 'confirmed', '2024-12-24 20:44:46', '2024-12-24 20:44:46'),
(271, 105, 'completed', '2024-12-24 21:34:02', '2024-12-24 21:34:02'),
(272, 106, 'process', '2024-12-24 21:34:13', '2024-12-24 21:34:13'),
(273, 102, 'process', '2024-12-24 21:34:18', '2024-12-24 21:34:18'),
(274, 106, 'completed', '2024-12-25 02:13:02', '2024-12-25 02:13:02'),
(275, 107, 'pending', '2024-12-25 02:57:12', '2024-12-25 02:57:12'),
(276, 108, 'pending', '2024-12-25 04:22:42', '2024-12-25 04:22:42'),
(277, 104, 'process', '2024-12-25 07:47:29', '2024-12-25 07:47:29'),
(278, 107, 'confirmed', '2024-12-25 07:48:12', '2024-12-25 07:48:12'),
(279, 108, 'confirmed', '2024-12-25 07:48:36', '2024-12-25 07:48:36'),
(280, 104, 'completed', '2024-12-25 19:11:27', '2024-12-25 19:11:27'),
(281, 107, 'completed', '2024-12-25 22:20:43', '2024-12-25 22:20:43'),
(282, 108, 'process', '2024-12-25 22:20:47', '2024-12-25 22:20:47'),
(283, 108, 'completed', '2024-12-25 23:25:49', '2024-12-25 23:25:49'),
(284, 109, 'pending', '2024-12-27 01:11:00', '2024-12-27 01:11:00'),
(285, 109, 'confirmed', '2024-12-27 17:00:51', '2024-12-27 17:00:51'),
(286, 109, 'completed', '2024-12-27 21:34:06', '2024-12-27 21:34:06'),
(287, 110, 'pending', '2024-12-29 20:53:43', '2024-12-29 20:53:43'),
(288, 110, 'confirmed', '2024-12-29 21:29:22', '2024-12-29 21:29:22'),
(289, 111, 'pending', '2024-12-29 21:55:06', '2024-12-29 21:55:06'),
(290, 111, 'confirmed', '2024-12-29 22:11:27', '2024-12-29 22:11:27'),
(291, 111, 'completed', '2024-12-29 23:47:48', '2024-12-29 23:47:48'),
(292, 110, 'process', '2024-12-30 00:32:07', '2024-12-30 00:32:07'),
(293, 112, 'pending', '2024-12-30 18:32:52', '2024-12-30 18:32:52'),
(294, 113, 'pending', '2024-12-30 19:53:05', '2024-12-30 19:53:05'),
(295, 114, 'pending', '2024-12-30 19:53:05', '2024-12-30 19:53:05'),
(296, 110, 'completed', '2024-12-30 20:07:11', '2024-12-30 20:07:11'),
(297, 112, 'confirmed', '2024-12-30 20:12:59', '2024-12-30 20:12:59'),
(298, 113, 'completed', '2024-12-30 20:13:42', '2024-12-30 20:13:42'),
(299, 114, 'confirmed', '2024-12-30 20:20:48', '2024-12-30 20:20:48'),
(300, 114, 'process', '2024-12-30 20:28:15', '2024-12-30 20:28:15'),
(301, 115, 'pending', '2024-12-30 21:15:24', '2024-12-30 21:15:24'),
(302, 115, 'confirmed', '2024-12-30 21:16:23', '2024-12-30 21:16:23'),
(303, 114, 'completed', '2024-12-31 00:26:21', '2024-12-31 00:26:21'),
(304, 115, 'process', '2024-12-31 00:26:25', '2024-12-31 00:26:25'),
(305, 115, 'completed', '2025-01-01 21:52:49', '2025-01-01 21:52:49'),
(306, 116, 'pending', '2025-01-02 20:21:26', '2025-01-02 20:21:26'),
(307, 112, 'process', '2025-01-02 20:35:00', '2025-01-02 20:35:00'),
(308, 116, 'confirmed', '2025-01-02 20:35:57', '2025-01-02 20:35:57'),
(309, 112, 'completed', '2025-01-03 18:08:07', '2025-01-03 18:08:07'),
(310, 116, 'process', '2025-01-03 18:08:11', '2025-01-03 18:08:11'),
(311, 117, 'pending', '2025-01-04 07:37:24', '2025-01-04 07:37:24'),
(312, 116, 'completed', '2025-01-04 17:36:04', '2025-01-04 17:36:04'),
(313, 117, 'confirmed', '2025-01-04 17:36:42', '2025-01-04 17:36:42'),
(314, 118, 'pending', '2025-01-05 19:32:25', '2025-01-05 19:32:25'),
(315, 117, 'completed', '2025-01-05 19:36:04', '2025-01-05 19:36:04'),
(316, 118, 'confirmed', '2025-01-05 19:37:30', '2025-01-05 19:37:30'),
(317, 118, 'completed', '2025-01-06 20:52:23', '2025-01-06 20:52:23'),
(318, 119, 'pending', '2025-01-06 22:04:21', '2025-01-06 22:04:21'),
(319, 119, 'confirmed', '2025-01-07 19:12:39', '2025-01-07 19:12:39'),
(320, 119, 'process', '2025-01-08 00:01:31', '2025-01-08 00:01:31'),
(321, 120, 'pending', '2025-01-08 03:50:47', '2025-01-08 03:50:47'),
(322, 120, 'confirmed', '2025-01-08 03:57:39', '2025-01-08 03:57:39'),
(323, 119, 'completed', '2025-01-08 22:20:00', '2025-01-08 22:20:00'),
(324, 120, 'process', '2025-01-08 22:20:04', '2025-01-08 22:20:04'),
(325, 121, 'pending', '2025-01-09 20:16:31', '2025-01-09 20:16:31'),
(326, 120, 'completed', '2025-01-09 20:18:17', '2025-01-09 20:18:17'),
(327, 121, 'confirmed', '2025-01-09 20:18:43', '2025-01-09 20:18:43'),
(328, 121, 'process', '2025-01-09 20:18:50', '2025-01-09 20:18:50'),
(329, 122, 'pending', '2025-01-09 23:06:48', '2025-01-09 23:06:48'),
(330, 121, 'completed', '2025-01-09 23:17:30', '2025-01-09 23:17:30'),
(331, 122, 'confirmed', '2025-01-09 23:26:16', '2025-01-09 23:26:16'),
(332, 122, 'process', '2025-01-10 02:29:09', '2025-01-10 02:29:09'),
(333, 122, 'completed', '2025-01-10 21:23:51', '2025-01-10 21:23:51'),
(334, 123, 'pending', '2025-01-10 23:27:20', '2025-01-10 23:27:20'),
(335, 123, 'process', '2025-01-12 15:52:06', '2025-01-12 15:52:06'),
(336, 124, 'pending', '2025-01-12 18:14:20', '2025-01-12 18:14:20'),
(337, 125, 'pending', '2025-01-12 18:14:21', '2025-01-12 18:14:21'),
(338, 125, 'completed', '2025-01-12 18:19:43', '2025-01-12 18:19:43'),
(339, 124, 'confirmed', '2025-01-12 18:19:58', '2025-01-12 18:19:58'),
(340, 124, 'completed', '2025-01-12 22:18:12', '2025-01-12 22:18:12'),
(341, 123, 'completed', '2025-01-14 18:04:37', '2025-01-14 18:04:37'),
(342, 126, 'pending', '2025-01-14 18:08:03', '2025-01-14 18:08:03'),
(343, 126, 'confirmed', '2025-01-14 18:09:17', '2025-01-14 18:09:17'),
(344, 126, 'process', '2025-01-14 21:16:40', '2025-01-14 21:16:40'),
(345, 126, 'completed', '2025-01-16 09:28:50', '2025-01-16 09:28:50'),
(346, 127, 'pending', '2025-01-17 07:55:00', '2025-01-17 07:55:00'),
(347, 127, 'confirmed', '2025-01-17 18:37:23', '2025-01-17 18:37:23'),
(348, 127, 'completed', '2025-01-17 22:38:14', '2025-01-17 22:38:14'),
(349, 128, 'pending', '2025-01-18 04:08:04', '2025-01-18 04:08:04'),
(350, 128, 'confirmed', '2025-01-18 04:09:36', '2025-01-18 04:09:36'),
(351, 102, 'completed', '2025-01-18 05:14:24', '2025-01-18 05:14:24'),
(352, 129, 'pending', '2025-01-18 05:58:57', '2025-01-18 05:58:57'),
(353, 128, 'process', '2025-01-19 01:34:38', '2025-01-19 01:34:38'),
(354, 128, 'completed', '2025-01-19 19:06:20', '2025-01-19 19:06:20'),
(355, 130, 'pending', '2025-01-19 19:08:51', '2025-01-19 19:08:51'),
(356, 130, 'process', '2025-01-19 23:20:50', '2025-01-19 23:20:50'),
(357, 131, 'pending', '2025-01-20 01:17:37', '2025-01-20 01:17:37'),
(358, 130, 'completed', '2025-01-20 01:45:17', '2025-01-20 01:45:17'),
(359, 129, 'completed', '2025-01-20 03:28:11', '2025-01-20 03:28:11'),
(360, 131, 'confirmed', '2025-01-20 03:28:24', '2025-01-20 03:28:24'),
(361, 131, 'process', '2025-01-20 19:27:46', '2025-01-20 19:27:46'),
(362, 131, 'completed', '2025-01-21 04:43:14', '2025-01-21 04:43:14'),
(363, 132, 'pending', '2025-01-21 18:47:16', '2025-01-21 18:47:16'),
(364, 132, 'confirmed', '2025-01-21 21:17:32', '2025-01-21 21:17:32'),
(365, 132, 'completed', '2025-01-22 00:10:30', '2025-01-22 00:10:30'),
(366, 133, 'pending', '2025-01-28 19:33:06', '2025-01-28 19:33:06'),
(367, 133, 'confirmed', '2025-01-28 20:35:02', '2025-01-28 20:35:02'),
(368, 133, 'completed', '2025-01-29 18:08:50', '2025-01-29 18:08:50'),
(369, 134, 'pending', '2025-01-29 18:43:20', '2025-01-29 18:43:20'),
(370, 134, 'process', '2025-01-29 19:30:55', '2025-01-29 19:30:55'),
(371, 134, 'completed', '2025-01-30 23:18:50', '2025-01-30 23:18:50'),
(372, 135, 'pending', '2025-02-02 02:25:39', '2025-02-02 02:25:39'),
(373, 135, 'confirmed', '2025-02-02 02:40:58', '2025-02-02 02:40:58'),
(374, 136, 'pending', '2025-02-03 00:07:27', '2025-02-03 00:07:27'),
(375, 135, 'completed', '2025-02-03 00:28:06', '2025-02-03 00:28:06'),
(376, 136, 'process', '2025-02-03 02:01:10', '2025-02-03 02:01:10'),
(377, 136, 'completed', '2025-02-04 01:45:06', '2025-02-04 01:45:06'),
(378, 137, 'pending', '2025-02-04 01:46:59', '2025-02-04 01:46:59'),
(379, 137, 'process', '2025-02-04 01:47:13', '2025-02-04 01:47:13'),
(380, 137, 'completed', '2025-02-05 19:42:03', '2025-02-05 19:42:03'),
(381, 138, 'pending', '2025-02-05 19:53:28', '2025-02-05 19:53:28'),
(382, 138, 'confirmed', '2025-02-05 19:56:16', '2025-02-05 19:56:16'),
(383, 139, 'pending', '2025-02-05 22:07:32', '2025-02-05 22:07:32'),
(384, 138, 'completed', '2025-02-05 22:07:52', '2025-02-05 22:07:52'),
(385, 139, 'process', '2025-02-05 22:07:55', '2025-02-05 22:07:55'),
(386, 140, 'pending', '2025-02-06 00:30:00', '2025-02-06 00:30:00'),
(387, 140, 'process', '2025-02-06 02:34:05', '2025-02-06 02:34:05'),
(388, 141, 'pending', '2025-02-06 20:27:50', '2025-02-06 20:27:50'),
(389, 140, 'completed', '2025-02-06 21:15:21', '2025-02-06 21:15:21'),
(390, 141, 'confirmed', '2025-02-06 21:15:49', '2025-02-06 21:15:49'),
(391, 141, 'completed', '2025-02-07 00:53:04', '2025-02-07 00:53:04'),
(392, 142, 'pending', '2025-02-07 07:57:47', '2025-02-07 07:57:47'),
(393, 139, 'completed', '2025-02-09 23:16:39', '2025-02-09 23:16:39'),
(394, 142, 'confirmed', '2025-02-09 23:17:03', '2025-02-09 23:17:03'),
(395, 142, 'confirmed', '2025-02-09 23:17:58', '2025-02-09 23:17:58'),
(396, 142, 'completed', '2025-02-11 02:46:17', '2025-02-11 02:46:17'),
(397, 143, 'pending', '2025-02-13 22:14:06', '2025-02-13 22:14:06'),
(398, 143, 'confirmed', '2025-02-13 23:23:33', '2025-02-13 23:23:33'),
(399, 143, 'process', '2025-02-14 18:22:26', '2025-02-14 18:22:26'),
(400, 143, 'completed', '2025-02-15 00:31:23', '2025-02-15 00:31:23'),
(401, 144, 'pending', '2025-02-16 00:08:34', '2025-02-16 00:08:34'),
(402, 144, 'completed', '2025-02-16 02:24:33', '2025-02-16 02:24:33'),
(403, 145, 'pending', '2025-02-17 19:13:50', '2025-02-17 19:13:50'),
(404, 145, 'confirmed', '2025-02-17 20:36:55', '2025-02-17 20:36:55'),
(405, 146, 'pending', '2025-02-17 22:42:42', '2025-02-17 22:42:42'),
(406, 146, 'confirmed', '2025-02-17 22:45:22', '2025-02-17 22:45:22'),
(407, 146, 'completed', '2025-02-18 04:32:55', '2025-02-18 04:32:55'),
(408, 145, 'process', '2025-02-18 04:32:58', '2025-02-18 04:32:58'),
(409, 145, 'completed', '2025-02-18 20:07:42', '2025-02-18 20:07:42'),
(410, 147, 'pending', '2025-02-19 01:30:00', '2025-02-19 01:30:00'),
(411, 148, 'pending', '2025-02-19 20:50:51', '2025-02-19 20:50:51'),
(412, 147, 'cancelled', '2025-02-21 02:16:38', '2025-02-21 02:16:38'),
(413, 148, 'process', '2025-02-21 21:36:42', '2025-02-21 21:36:42'),
(414, 148, 'completed', '2025-02-21 21:36:46', '2025-02-21 21:36:46'),
(415, 149, 'pending', '2025-02-24 20:55:59', '2025-02-24 20:55:59'),
(416, 149, 'confirmed', '2025-02-24 22:45:08', '2025-02-24 22:45:08'),
(417, 149, 'completed', '2025-02-25 03:19:49', '2025-02-25 03:19:49'),
(418, 150, 'pending', '2025-02-26 17:32:46', '2025-02-26 17:32:46'),
(419, 150, 'confirmed', '2025-02-26 18:04:29', '2025-02-26 18:04:29'),
(420, 150, 'completed', '2025-02-26 22:48:10', '2025-02-26 22:48:10'),
(421, 151, 'pending', '2025-02-27 17:26:38', '2025-02-27 17:26:38'),
(422, 151, 'process', '2025-02-27 17:29:01', '2025-02-27 17:29:01'),
(423, 151, 'completed', '2025-02-27 21:44:37', '2025-02-27 21:44:37'),
(424, 152, 'pending', '2025-02-28 01:59:58', '2025-02-28 01:59:58'),
(425, 152, 'confirmed', '2025-03-01 01:34:39', '2025-03-01 01:34:39'),
(426, 152, 'completed', '2025-03-02 01:23:01', '2025-03-02 01:23:01'),
(427, 153, 'pending', '2025-03-03 20:33:16', '2025-03-03 20:33:16'),
(428, 153, 'confirmed', '2025-03-03 20:35:26', '2025-03-03 20:35:26'),
(429, 153, 'process', '2025-03-03 21:20:25', '2025-03-03 21:20:25'),
(430, 153, 'completed', '2025-03-04 05:58:27', '2025-03-04 05:58:27'),
(431, 154, 'pending', '2025-03-07 06:41:35', '2025-03-07 06:41:35'),
(432, 154, 'confirmed', '2025-03-09 18:17:56', '2025-03-09 18:17:56'),
(433, 155, 'pending', '2025-03-09 19:57:40', '2025-03-09 19:57:40'),
(434, 154, 'process', '2025-03-09 20:12:57', '2025-03-09 20:12:57'),
(435, 155, 'confirmed', '2025-03-09 20:13:39', '2025-03-09 20:13:39'),
(436, 155, 'process', '2025-03-09 22:06:58', '2025-03-09 22:06:58'),
(437, 155, 'completed', '2025-03-10 23:33:33', '2025-03-10 23:33:33'),
(438, 154, 'completed', '2025-03-12 14:35:05', '2025-03-12 14:35:05'),
(439, 147, 'completed', '2025-03-12 14:35:12', '2025-03-12 14:35:12'),
(440, 156, 'pending', '2025-03-14 21:21:29', '2025-03-14 21:21:29'),
(441, 156, 'process', '2025-03-14 23:14:32', '2025-03-14 23:14:32'),
(442, 157, 'pending', '2025-03-15 17:34:31', '2025-03-15 17:34:31'),
(443, 157, 'confirmed', '2025-03-15 18:14:04', '2025-03-15 18:14:04'),
(444, 158, 'pending', '2025-03-15 20:20:40', '2025-03-15 20:20:40'),
(445, 158, 'cancelled', '2025-03-15 21:24:06', '2025-03-15 21:24:06'),
(446, 158, 'completed', '2025-03-15 21:24:11', '2025-03-15 21:24:11'),
(447, 157, 'process', '2025-03-15 21:49:12', '2025-03-15 21:49:12'),
(448, 157, 'completed', '2025-03-15 22:55:38', '2025-03-15 22:55:38'),
(449, 156, 'completed', '2025-03-17 01:51:11', '2025-03-17 01:51:11'),
(450, 159, 'pending', '2025-03-17 02:18:18', '2025-03-17 02:18:18'),
(451, 159, 'confirmed', '2025-03-17 02:26:42', '2025-03-17 02:26:42'),
(452, 159, 'process', '2025-03-18 00:58:19', '2025-03-18 00:58:19'),
(453, 160, 'pending', '2025-04-05 18:34:05', '2025-04-05 18:34:05'),
(454, 160, 'confirmed', '2025-04-06 22:56:12', '2025-04-06 22:56:12'),
(455, 161, 'pending', '2025-04-07 16:25:04', '2025-04-07 16:25:04'),
(456, 162, 'pending', '2025-04-07 20:19:38', '2025-04-07 20:19:38'),
(457, 161, 'confirmed', '2025-04-07 20:50:03', '2025-04-07 20:50:03'),
(458, 162, 'confirmed', '2025-04-07 20:51:06', '2025-04-07 20:51:06'),
(459, 162, 'completed', '2025-04-07 21:52:55', '2025-04-07 21:52:55'),
(460, 160, 'completed', '2025-04-07 23:58:46', '2025-04-07 23:58:46'),
(461, 161, 'process', '2025-04-08 20:22:24', '2025-04-08 20:22:24'),
(462, 161, 'completed', '2025-04-08 22:38:03', '2025-04-08 22:38:03'),
(463, 163, 'pending', '2025-04-09 18:02:35', '2025-04-09 18:02:35'),
(464, 164, 'pending', '2025-04-09 19:08:14', '2025-04-09 19:08:14'),
(465, 165, 'pending', '2025-04-09 19:33:04', '2025-04-09 19:33:04'),
(466, 164, 'confirmed', '2025-04-09 21:14:42', '2025-04-09 21:14:42'),
(467, 163, 'confirmed', '2025-04-09 21:15:19', '2025-04-09 21:15:19'),
(468, 163, 'process', '2025-04-09 21:15:54', '2025-04-09 21:15:54'),
(469, 165, 'confirmed', '2025-04-09 21:16:28', '2025-04-09 21:16:28'),
(470, 163, 'completed', '2025-04-09 23:04:36', '2025-04-09 23:04:36'),
(471, 166, 'pending', '2025-04-09 23:36:06', '2025-04-09 23:36:06'),
(472, 166, 'process', '2025-04-10 01:34:33', '2025-04-10 01:34:33'),
(473, 164, 'process', '2025-04-10 01:46:56', '2025-04-10 01:46:56'),
(474, 166, 'completed', '2025-04-11 03:13:15', '2025-04-11 03:13:15'),
(475, 159, 'completed', '2025-04-11 03:13:19', '2025-04-11 03:13:19'),
(476, 164, 'completed', '2025-04-11 03:13:23', '2025-04-11 03:13:23'),
(477, 167, 'pending', '2025-04-12 01:43:47', '2025-04-12 01:43:47'),
(478, 167, 'confirmed', '2025-04-12 01:59:11', '2025-04-12 01:59:11'),
(479, 167, 'process', '2025-04-12 23:11:51', '2025-04-12 23:11:51'),
(480, 168, 'pending', '2025-04-13 00:02:03', '2025-04-13 00:02:03'),
(481, 168, 'process', '2025-04-13 00:02:46', '2025-04-13 00:02:46'),
(482, 167, 'confirmed', '2025-04-13 00:03:30', '2025-04-13 00:03:30'),
(483, 165, 'process', '2025-04-13 00:55:51', '2025-04-13 00:55:51'),
(484, 167, 'completed', '2025-04-13 20:05:24', '2025-04-13 20:05:24'),
(485, 168, 'completed', '2025-04-13 23:35:45', '2025-04-13 23:35:45'),
(486, 169, 'pending', '2025-04-14 00:36:57', '2025-04-14 00:36:57'),
(487, 169, 'confirmed', '2025-04-14 18:34:33', '2025-04-14 18:34:33'),
(488, 170, 'pending', '2025-04-14 20:29:05', '2025-04-14 20:29:05'),
(489, 171, 'pending', '2025-04-14 22:59:50', '2025-04-14 22:59:50'),
(490, 165, 'completed', '2025-04-14 23:27:44', '2025-04-14 23:27:44'),
(491, 169, 'process', '2025-04-14 23:27:48', '2025-04-14 23:27:48'),
(492, 170, 'confirmed', '2025-04-14 23:28:17', '2025-04-14 23:28:17'),
(493, 171, 'confirmed', '2025-04-14 23:38:20', '2025-04-14 23:38:20'),
(494, 171, 'process', '2025-04-14 23:41:09', '2025-04-14 23:41:09'),
(495, 172, 'pending', '2025-04-15 01:00:58', '2025-04-15 01:00:58'),
(496, 173, 'pending', '2025-04-15 01:12:28', '2025-04-15 01:12:28'),
(497, 170, 'process', '2025-04-15 03:06:02', '2025-04-15 03:06:02'),
(498, 172, 'confirmed', '2025-04-15 03:10:04', '2025-04-15 03:10:04'),
(499, 173, 'confirmed', '2025-04-15 03:11:15', '2025-04-15 03:11:15'),
(500, 170, 'completed', '2025-04-15 04:02:58', '2025-04-15 04:02:58'),
(501, 174, 'pending', '2025-04-15 04:57:33', '2025-04-15 04:57:33'),
(502, 174, 'confirmed', '2025-04-15 05:18:47', '2025-04-15 05:18:47'),
(503, 169, 'completed', '2025-04-15 20:01:11', '2025-04-15 20:01:11'),
(504, 171, 'completed', '2025-04-15 20:01:16', '2025-04-15 20:01:16'),
(505, 173, 'process', '2025-04-15 20:01:48', '2025-04-15 20:01:48'),
(506, 173, 'completed', '2025-04-15 21:57:23', '2025-04-15 21:57:23'),
(507, 172, 'process', '2025-04-15 21:57:30', '2025-04-15 21:57:30'),
(508, 172, 'completed', '2025-04-15 23:03:26', '2025-04-15 23:03:26'),
(509, 174, 'process', '2025-04-15 23:34:22', '2025-04-15 23:34:22'),
(510, 175, 'pending', '2025-04-16 01:55:13', '2025-04-16 01:55:13'),
(511, 175, 'process', '2025-04-16 03:03:59', '2025-04-16 03:03:59'),
(512, 175, 'confirmed', '2025-04-16 03:04:10', '2025-04-16 03:04:10'),
(513, 176, 'pending', '2025-04-16 03:05:22', '2025-04-16 03:05:22'),
(514, 176, 'confirmed', '2025-04-16 04:49:16', '2025-04-16 04:49:16'),
(515, 175, 'process', '2025-04-16 21:28:54', '2025-04-16 21:28:54'),
(516, 175, 'completed', '2025-04-17 01:08:50', '2025-04-17 01:08:50'),
(517, 176, 'completed', '2025-04-17 04:07:40', '2025-04-17 04:07:40'),
(518, 174, 'completed', '2025-04-17 04:38:05', '2025-04-17 04:38:05'),
(519, 177, 'pending', '2025-04-18 16:46:29', '2025-04-18 16:46:29'),
(520, 177, 'confirmed', '2025-04-18 17:50:35', '2025-04-18 17:50:35'),
(521, 178, 'pending', '2025-04-18 22:32:46', '2025-04-18 22:32:46'),
(522, 179, 'pending', '2025-04-19 05:40:50', '2025-04-19 05:40:50'),
(523, 178, 'confirmed', '2025-04-20 06:05:00', '2025-04-20 06:05:00'),
(524, 179, 'confirmed', '2025-04-20 06:06:00', '2025-04-20 06:06:00'),
(525, 180, 'pending', '2025-04-20 06:25:54', '2025-04-20 06:25:54'),
(526, 178, 'completed', '2025-04-20 19:52:30', '2025-04-20 19:52:30'),
(527, 179, 'process', '2025-04-20 19:52:35', '2025-04-20 19:52:35'),
(528, 179, 'completed', '2025-04-20 20:17:59', '2025-04-20 20:17:59'),
(529, 177, 'process', '2025-04-20 22:55:23', '2025-04-20 22:55:23'),
(530, 180, 'confirmed', '2025-04-21 02:47:54', '2025-04-21 02:47:54'),
(531, 181, 'pending', '2025-04-21 03:40:39', '2025-04-21 03:40:39'),
(532, 182, 'pending', '2025-04-21 03:42:04', '2025-04-21 03:42:04'),
(533, 183, 'pending', '2025-04-21 03:42:22', '2025-04-21 03:42:22'),
(534, 177, 'completed', '2025-04-21 17:26:45', '2025-04-21 17:26:45'),
(535, 181, 'completed', '2025-04-21 17:29:59', '2025-04-21 17:29:59'),
(536, 182, 'completed', '2025-04-21 17:30:03', '2025-04-21 17:30:03'),
(537, 183, 'confirmed', '2025-04-21 17:30:21', '2025-04-21 17:30:21'),
(538, 183, 'process', '2025-04-21 17:30:27', '2025-04-21 17:30:27'),
(539, 184, 'pending', '2025-04-22 20:41:17', '2025-04-22 20:41:17'),
(540, 185, 'pending', '2025-04-22 20:57:50', '2025-04-22 20:57:50'),
(541, 184, 'confirmed', '2025-04-22 21:42:13', '2025-04-22 21:42:13'),
(542, 185, 'confirmed', '2025-04-22 21:42:50', '2025-04-22 21:42:50'),
(543, 185, 'process', '2025-04-22 21:43:05', '2025-04-22 21:43:05'),
(544, 185, 'completed', '2025-04-23 01:55:36', '2025-04-23 01:55:36'),
(545, 184, 'process', '2025-04-23 22:52:57', '2025-04-23 22:52:57'),
(546, 184, 'completed', '2025-04-24 00:21:27', '2025-04-24 00:21:27'),
(547, 186, 'pending', '2025-04-25 00:49:24', '2025-04-25 00:49:24'),
(548, 186, 'confirmed', '2025-04-25 00:51:11', '2025-04-25 00:51:11'),
(549, 186, 'process', '2025-04-25 17:40:14', '2025-04-25 17:40:14'),
(550, 180, 'process', '2025-04-25 17:40:32', '2025-04-25 17:40:32'),
(551, 180, 'completed', '2025-04-25 22:42:33', '2025-04-25 22:42:33'),
(552, 186, 'completed', '2025-04-26 19:13:33', '2025-04-26 19:13:33'),
(553, 187, 'pending', '2025-04-26 22:22:01', '2025-04-26 22:22:01'),
(554, 187, 'process', '2025-04-27 21:18:32', '2025-04-27 21:18:32'),
(555, 187, 'completed', '2025-04-27 22:05:03', '2025-04-27 22:05:03'),
(556, 183, 'completed', '2025-04-29 02:46:07', '2025-04-29 02:46:07'),
(557, 188, 'pending', '2025-04-29 22:12:24', '2025-04-29 22:12:24'),
(558, 189, 'pending', '2025-04-29 22:12:25', '2025-04-29 22:12:25'),
(559, 188, 'process', '2025-04-29 23:15:35', '2025-04-29 23:15:35'),
(560, 189, 'process', '2025-04-29 23:15:47', '2025-04-29 23:15:47'),
(561, 188, 'completed', '2025-05-01 01:58:38', '2025-05-01 01:58:38'),
(562, 189, 'completed', '2025-05-01 01:58:41', '2025-05-01 01:58:41'),
(563, 190, 'pending', '2025-05-05 20:30:08', '2025-05-05 20:30:08'),
(564, 190, 'confirmed', '2025-05-05 21:00:35', '2025-05-05 21:00:35'),
(565, 190, 'completed', '2025-05-05 23:13:08', '2025-05-05 23:13:08'),
(566, 191, 'pending', '2025-05-06 01:41:45', '2025-05-06 01:41:45'),
(567, 191, 'confirmed', '2025-05-06 01:42:29', '2025-05-06 01:42:29'),
(568, 191, 'process', '2025-05-06 02:14:09', '2025-05-06 02:14:09'),
(569, 191, 'completed', '2025-05-06 04:37:22', '2025-05-06 04:37:22'),
(570, 192, 'pending', '2025-05-08 23:21:15', '2025-05-08 23:21:15'),
(571, 192, 'process', '2025-05-08 23:21:40', '2025-05-08 23:21:40'),
(572, 193, 'pending', '2025-05-09 17:03:50', '2025-05-09 17:03:50'),
(573, 193, 'confirmed', '2025-05-09 17:04:36', '2025-05-09 17:04:36'),
(574, 194, 'pending', '2025-05-09 17:08:19', '2025-05-09 17:08:19'),
(575, 194, 'confirmed', '2025-05-09 17:08:47', '2025-05-09 17:08:47'),
(576, 193, 'completed', '2025-05-10 21:27:02', '2025-05-10 21:27:02'),
(577, 194, 'completed', '2025-05-15 01:19:43', '2025-05-15 01:19:43'),
(578, 195, 'pending', '2025-05-15 18:29:55', '2025-05-15 18:29:55'),
(579, 195, 'confirmed', '2025-05-15 18:55:09', '2025-05-15 18:55:09'),
(580, 195, 'process', '2025-05-15 21:09:07', '2025-05-15 21:09:07'),
(581, 195, 'completed', '2025-05-15 21:34:32', '2025-05-15 21:34:32'),
(582, 196, 'pending', '2025-05-16 01:01:35', '2025-05-16 01:01:35'),
(583, 196, 'confirmed', '2025-05-16 01:03:34', '2025-05-16 01:03:34'),
(584, 196, 'process', '2025-05-16 18:39:15', '2025-05-16 18:39:15'),
(585, 196, 'completed', '2025-05-17 01:48:02', '2025-05-17 01:48:02'),
(586, 197, 'pending', '2025-05-17 01:59:10', '2025-05-17 01:59:10'),
(587, 197, 'confirmed', '2025-05-17 02:04:07', '2025-05-17 02:04:07'),
(588, 198, 'pending', '2025-05-17 22:27:50', '2025-05-17 22:27:50'),
(589, 198, 'confirmed', '2025-05-17 23:14:28', '2025-05-17 23:14:28'),
(590, 199, 'pending', '2025-05-18 00:10:55', '2025-05-18 00:10:55'),
(591, 199, 'confirmed', '2025-05-18 00:35:19', '2025-05-18 00:35:19'),
(592, 197, 'process', '2025-05-18 18:13:34', '2025-05-18 18:13:34'),
(593, 199, 'process', '2025-05-18 18:13:51', '2025-05-18 18:13:51'),
(594, 200, 'pending', '2025-05-18 18:22:06', '2025-05-18 18:22:06'),
(595, 201, 'pending', '2025-05-18 20:49:17', '2025-05-18 20:49:17'),
(596, 200, 'completed', '2025-05-18 21:55:00', '2025-05-18 21:55:00'),
(597, 201, 'confirmed', '2025-05-18 21:57:27', '2025-05-18 21:57:27'),
(598, 201, 'process', '2025-05-18 22:29:49', '2025-05-18 22:29:49'),
(599, 202, 'pending', '2025-05-18 23:50:20', '2025-05-18 23:50:20'),
(600, 202, 'confirmed', '2025-05-19 02:34:46', '2025-05-19 02:34:46'),
(601, 198, 'process', '2025-05-19 02:36:32', '2025-05-19 02:36:32'),
(602, 198, 'completed', '2025-05-20 00:18:01', '2025-05-20 00:18:01'),
(603, 197, 'completed', '2025-05-20 00:18:47', '2025-05-20 00:18:47'),
(604, 202, 'process', '2025-05-20 03:11:39', '2025-05-20 03:11:39'),
(605, 203, 'pending', '2025-05-20 04:16:49', '2025-05-20 04:16:49'),
(606, 202, 'completed', '2025-05-20 04:56:52', '2025-05-20 04:56:52'),
(607, 199, 'completed', '2025-05-20 04:57:04', '2025-05-20 04:57:04'),
(608, 203, 'pending', '2025-05-20 08:38:57', '2025-05-20 08:38:57'),
(609, 203, 'confirmed', '2025-05-20 08:49:25', '2025-05-20 08:49:25'),
(610, 203, 'process', '2025-05-20 20:19:55', '2025-05-20 20:19:55'),
(611, 203, 'completed', '2025-05-20 22:16:22', '2025-05-20 22:16:22'),
(612, 204, 'pending', '2025-05-21 22:58:26', '2025-05-21 22:58:26'),
(613, 205, 'pending', '2025-05-21 23:34:34', '2025-05-21 23:34:34'),
(614, 204, 'completed', '2025-05-22 02:09:13', '2025-05-22 02:09:13'),
(615, 205, 'process', '2025-05-22 03:23:22', '2025-05-22 03:23:22'),
(616, 206, 'pending', '2025-05-22 05:13:13', '2025-05-22 05:13:13'),
(617, 206, 'completed', '2025-05-22 05:20:22', '2025-05-22 05:20:22'),
(618, 207, 'pending', '2025-05-22 20:34:54', '2025-05-22 20:34:54'),
(619, 208, 'pending', '2025-05-22 20:59:07', '2025-05-22 20:59:07'),
(620, 209, 'pending', '2025-05-22 21:02:29', '2025-05-22 21:02:29'),
(621, 207, 'confirmed', '2025-05-23 00:44:57', '2025-05-23 00:44:57'),
(622, 208, 'confirmed', '2025-05-23 00:48:32', '2025-05-23 00:48:32'),
(623, 209, 'confirmed', '2025-05-23 00:49:14', '2025-05-23 00:49:14'),
(624, 208, 'completed', '2025-05-23 04:56:19', '2025-05-23 04:56:19'),
(625, 209, 'completed', '2025-05-23 04:56:23', '2025-05-23 04:56:23'),
(626, 210, 'pending', '2025-05-23 19:36:37', '2025-05-23 19:36:37'),
(627, 211, 'pending', '2025-05-23 22:04:23', '2025-05-23 22:04:23'),
(628, 207, 'process', '2025-05-24 01:20:17', '2025-05-24 01:20:17'),
(629, 211, 'confirmed', '2025-05-24 01:21:26', '2025-05-24 01:21:26'),
(630, 210, 'confirmed', '2025-05-24 01:21:52', '2025-05-24 01:21:52'),
(631, 211, 'completed', '2025-05-24 03:23:35', '2025-05-24 03:23:35'),
(632, 210, 'process', '2025-05-24 03:35:29', '2025-05-24 03:35:29'),
(633, 210, 'completed', '2025-05-24 04:24:12', '2025-05-24 04:24:12'),
(634, 201, 'completed', '2025-05-24 04:24:34', '2025-05-24 04:24:34'),
(635, 205, 'completed', '2025-05-24 04:27:09', '2025-05-24 04:27:09'),
(636, 212, 'pending', '2025-05-24 20:13:25', '2025-05-24 20:13:25'),
(637, 213, 'pending', '2025-05-24 20:26:16', '2025-05-24 20:26:16'),
(638, 212, 'confirmed', '2025-05-24 22:16:13', '2025-05-24 22:16:13'),
(639, 213, 'cancelled', '2025-05-24 22:19:13', '2025-05-24 22:19:13'),
(640, 207, 'completed', '2025-05-25 02:29:17', '2025-05-25 02:29:17'),
(641, 213, 'completed', '2025-05-25 02:29:21', '2025-05-25 02:29:21'),
(642, 192, 'completed', '2025-05-25 23:20:50', '2025-05-25 23:20:50'),
(643, 212, 'completed', '2025-05-26 04:53:28', '2025-05-26 04:53:28'),
(644, 214, 'pending', '2025-05-28 01:53:56', '2025-05-28 01:53:56'),
(645, 215, 'pending', '2025-05-28 03:55:53', '2025-05-28 03:55:53'),
(646, 216, 'pending', '2025-05-28 18:38:39', '2025-05-28 18:38:39'),
(647, 215, 'confirmed', '2025-05-28 19:27:13', '2025-05-28 19:27:13'),
(648, 216, 'completed', '2025-05-28 19:27:28', '2025-05-28 19:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0wIGH3PIvViWMvbCA0NvGqOp5vPDCQcN4RBZgsVL', NULL, '45.14.195.16', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0poVDM1bzhHZFRtSXlLRHlJWW1yaEpTQ2R6SjdTZzR3emhKcmtjcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748476790),
('5no00YcvpXoYaSNWhGTXY5dP2c09eIoIAXi5JyEz', NULL, '112.78.156.238', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0tXNUJyU3B0cjFXcjRtZ2JNckx6UUk5VFZrdm1tVmtPbDQzNXRpciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vd3d3LnNlbGlzbW9saXNob2tpLmNvbS9zZXJ2aXMiO319', 1748429753),
('6qBPTmtMtM3z2sAXQYktmGJfeU8laIa38pzeTz4m', NULL, '121.4.97.180', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzh0ZmdwZUVxdW1LdmdMZ0kxaDVkU3R1Zml0TzVmWkt0SDlUb0QzSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748473548),
('7OKXoQajHjsriy6847j1gGSh1yMBhID9j7S52DY2', NULL, '43.128.149.102', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHk3YzNOT2hFbXJwMm1qem5nZW1Qc3hFNWN1REpBNmJLUG13bmNsZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748473965),
('8n1bLqsiuZfls1nM81BAjMxECkcJDph4wnBG9Z7J', NULL, '43.156.228.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTkxT1ZoYTFITUJyWkxhUUNNQmpsN1RqbGZ5bUxtc0kwbklHRTdhciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748478758),
('9IhZaXx2BvAG05eT84g0gA6YXuo229g5U8f26vzh', NULL, '43.166.255.122', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlVERXVJR2prUFAwWXdXbkhVUmhybGd3OVZiYVhMaTVZcDRwWTNWUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748476396),
('aEfM4deUh77eZ6Qa2OeQ9I09QCO4v1ST294qIE3k', NULL, '140.213.141.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGhNemU1b2NBUjBWNlpkQzdwVHFNS2tMTEtPc2dxbHNQdEV4VklERyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vd3d3LnNlbGlzbW9saXNob2tpLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748488499),
('apwV5AaVUWSzPk12Sy69Am6su4OVZJXdBC6JQCHT', NULL, '43.153.67.21', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXJlbFJ0WGpKeG5ld1hBanU5enVxemZVZnJDM1pTMGJMUDBkR29vNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748440860),
('ba9Sl2brJ1EB8zXQCoQrenpBIRh6ROct0a8EBJoZ', NULL, '49.51.243.95', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXhkamxGNkFqamVTRDBDRnhyRjV3SnpQT2ZsbHpXTVdHOTJNRTlUeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748476940),
('CHPz69kLubcnTcTTMJVMMaPYRLjrJzj9hwlRzYUy', NULL, '112.78.156.238', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejQxYzBicmhTVjB2aDdyQlVpMjlrM2FLaWlUclNzY1QzdGVKMVZCeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vd3d3LnNlbGlzbW9saXNob2tpLmNvbS9zZXJ2aXMiO319', 1748482719),
('clAXG5ncFlvPejusXJuvlJ6yd89nEFtkY7UrOf5r', NULL, '175.158.55.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTNscDA1WTc3cWxraWdlakc1aTFjN0k4bmVVdjlJM3UxbmtYZ0VPaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vd3d3LnNlbGlzbW9saXNob2tpLmNvbS9zZXJ2aXMiO319', 1748431933),
('FdIEX9qUuSlMtBx7XBnQoUun6bVqte2des45IEaY', NULL, '45.14.195.16', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN29tNGltbExEanliNGUxMTBQMlBlbXVvZGVxNGF4UTF5cWxlY1cydCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748476788),
('FEkiIbWi1LNBG9S3avaXgSP4yoaTNnaIEPHgPNlL', 1, '36.73.34.6', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid0lacU1KRFZtemNlc1B3TzhCcmJqaUV3QWRZektrNHRZWFE3cm9sTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHBzOi8vc2VsaXNtb2xpc2hva2kuY29tL3BlbGFuZ2dhbj9zZWFyY2hLb2RlPSZzZWFyY2hOYW1hPUNhbmRyYSZzZWFyY2hOb0hQPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1748486489),
('FJGcNzkJj1W46WtkqO6oYjhupiLkaxCXaQQfgIPX', NULL, '175.158.55.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlI3dE1tMzlxckExVWc3c056MUtleWFTUzNHbE9EMENJQU1nNHVidCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vd3d3LnNlbGlzbW9saXNob2tpLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748431222),
('gLzvZ1m6B98c7qtbJJ0Ht4nop5u9Ts0Re7Y3uKAi', NULL, '157.230.92.253', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkFuRjFSVW9Dd3J6S251MFdFM2JscDdUbXV3QzdSNTF0TzlIUVYxeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748435789),
('H44KJgAf6cax0mciIKMzOCAHGoNvwtMIPu42wlAb', NULL, '43.157.170.126', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFJxWTJvVVNNSnhvSDRXREhwOThiOWRBaWZTZThlTXNsU0JLUGhiUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20vaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748479921),
('HntDnETAwNjPa3xh6Zf9UvmZX8Nnx5zmzXlLoYYL', NULL, '51.222.253.9', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUJ3WGZpanRTaHFROWxoTVFIY3BRbGhuaG54VjFTTzFrU21LRjlpMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748455622),
('iOVLyjROOC2ZKDP9LikeNOe2ehg6COlW6XGwGexq', NULL, '170.106.110.146', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXlXS2V6cWtBcFlNTGNUWTJNUEI5dXF6ZUI5SGxIcmFFSGl0aFJZdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tL3NlcnZpcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748438546),
('K8ubmZH5Rka1wQ1hPuzVGvAwqQihJtDJjLajQ2zG', NULL, '43.159.145.149', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczdkZVpOakZQTWprRHdCQmR2Vno3bFJVOVgzYW14azRSZjNKZzJHcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748437337),
('Kjb6UoAwcfksYtnR1y55SkKVd3gLPEwM8XTnx7RJ', NULL, '43.135.133.194', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1BBN0VpcGFjQVpVdGE1YmpjYUxtbkJVRVdRWFo0c3J2MmFXTUtCaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20vaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748479464),
('ks3g3kLWAzUtq9QUnX8M8vLSnkDDHJEOUG76bQtK', NULL, '43.173.1.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFhMVzhZTGRoSDFHd20wQmdDSnRqb0NEbXJXQ0NhUk5SaE1wT3NqciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20vYWJvdXR1cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748474411),
('LiZYPALNAbheU4So8P3yEB4QPGPDIF395Gwh0SU6', NULL, '103.247.9.9', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkx4SllLeHpUeGNPQnRWWEFrWUVmMWg3cGh3YWFacTJsRTlLV0JrUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748487203),
('Lx5iky9LOoS11ocEh35OijkFc1WVvw51Dd6Dc5qc', NULL, '43.135.185.59', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFB2TkQzaDUzYTNvN2swOUk3ejV6Sk5OTE4xQ1hKRUU5VkJWZXNpZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748473137),
('lZ7DJohlg5jgLl7MBFKoFAD8AdRB2rxB9jmFCHOf', NULL, '43.130.15.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlo3Vk5RTzhUNmtaa1BUa0tWSzJqS0VYQ0V3RzFNbm5adG9VU1owMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20vc2VydmlzZ2FyYWdlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748477745),
('mIod8GxcHTWgkWYBCTh1IHB2hC3tWQsjrIKRZy7l', NULL, '43.153.119.119', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS25XWDFScUs3SDF5REZmZUVNclJQOUxWOVpuMXJlRVhqaWhvNVNhSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748441554),
('NSMZqWaUUvKaCEGoKWxpAjWySk6zXpmOEZGnHyq5', NULL, '49.51.50.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1hXVGJISmE1OWhsb2NmT1dPanI2MjhqMTJmbWhOUWJDeXJFekx0ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748437979),
('oSLuTcevQNaYViZmwRY0DWZ6UsksVZkNDFW27jSO', NULL, '45.14.195.16', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0Z1OGdKUDFqMlZHTVNqUk5IcHZ6eGNqQzZlbk1aQUNNYnU4bUNZbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748476787),
('POKOn5Ha5K0KMAVkSBuPOURcuhg8nDcC1BlbDSBS', NULL, '43.166.253.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDdJOHlRd1dnTGpnZUhRQ2JPY1UwMDFsZUloSXRYM2dzNFhqQmdmaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748439051),
('q76TDlZ5UE20mgCHboaTxEfQh3chGlacTQZCWxyv', NULL, '49.51.50.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTU3aVBFN1h5QXNJRDB3QTRiVUFFSXFHSGVwSWczMnRhMVNpUXc4RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748475154),
('rnclB3phTVlBo8XSoq5OekwgEmaiecquD0mvAJ7b', NULL, '43.130.72.177', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2U2YTVBaERsZmVYUmJReTB3WFRneWM1VmNUTmFNbW82RnZQeVBFUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748466038),
('ss9hB0Vv5xuAsgKdqcGaHUDMIIM8zYUus8lENoh5', NULL, '43.130.150.80', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEhvekU2SFlqYVVSTTRlRDBkR1hydTRBQm5XU0FhaTd5cmVySzFBTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748435328),
('tEkQ1JJEkW6f69wWgfZ6fKPclREUTJ82eid4okhC', NULL, '110.40.186.63', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGh5NkZ5TUl6QmlXb2U2dkRyUkZ4RGlFNHBLc1U4aW04dWo3ZGs5ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748484891),
('UFbtugtImP5TQaunYjfiokbcCwli1jDIU90frlbg', NULL, '57.141.2.26', 'meta-externalagent/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnpOdUtidEM4VERIdmxtN2lQTHBFVDNVUFRDbWIyczBIRFRkRTg2NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vd3d3LnNlbGlzbW9saXNob2tpLmNvbS9zZXJ2aXNnYXJhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748456174),
('wpNx9BYTGNDR2B4kCooT5FRIqb0NWxgpgNJTuWf9', NULL, '170.106.163.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNW13NG1DcVJaa1pTWWlsZ2Myd2RhREJoeWxRMms1aHlxRVNXZHBwUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tL3NlcnZpc2dhcmFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748436883),
('XqBZrGzwQMZiR2Rho7H35J3NVwspXXhaHh5lCqae', NULL, '43.167.157.80', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkg5WTRWS3NZYXpyRzhVVVFFNWs0Yjg1ZUVORzlMdXNSTkRZcmVQWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748442120),
('YJdLt2ofUr0l6jofI0uKzNxREJvuwDgOxt7ztVzv', NULL, '45.14.195.16', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVFmUVFNMldLU1hvNEpSVVAyT1JwZkNiVUxTbUpXbVBWR0Qzb21lNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20vYWJvdXR1cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748476791),
('yNIH42lq5TurkbCax1wFG9DSOLWm1l4qxzIvSknV', NULL, '182.44.9.147', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXp5OUE1YnRWU2VDanRKeUNIVjFIT3FPSFpRSlAxY0JTb0toeVdtZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuc2VsaXNtb2xpc2hva2kuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748438383),
('Z00j08GXw0hmdkHaJ0Dxs1gBHogAsZ2O0x4TPgtG', NULL, '157.230.92.253', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWZRNW1BdEhpeGJVT0NlbWptMDlGNUxZSGlPN0xiZlpLbG81VVZZQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748435787),
('zBr4ANZ7NZdJbXiZ0MPzM5GVepts4gp9ivoCNyY2', NULL, '45.14.195.16', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmxGT1U3U2VscUtNQVFxTHpWNktwU0ZLUmNORFA1UG5IYngzazd2dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9zZWxpc21vbGlzaG9raS5jb20vY29udGFjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748476791);

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `nama`, `ulasan`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'EDRICK FIRJATULLAH', 'Bukan Cuma Toko, Tapi bengkel Spesialis Sepeda dan motor listrik\r\nAne bawa sepeda listrik Rongsok juga dibenerin sampe jadi baru lagi', 5, '2024-10-16 01:53:31', '2024-10-16 01:53:31'),
(2, 'DIMAS FAKHRU', 'Bisa memperbaikin sepeda listrik yang rusak', 5, '2024-10-16 01:54:01', '2024-10-16 01:54:01'),
(3, 'PANEN MAS', 'Bisa Custom Motor Listrik Juga\r\nKreatif !', 5, '2024-10-16 01:54:20', '2024-10-16 01:54:20'),
(4, 'ILMANZA HARDIAN', 'masnya ramah banget, best deh pokonya', 5, '2024-10-16 02:08:44', '2024-10-16 02:08:44'),
(5, 'N1RX', 'sangat inovatif untuk masa depan yang lebih cerah', 5, '2024-10-16 02:09:37', '2024-10-16 02:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hoki', 'hoki@hoki.com', NULL, '$2y$12$VddwLwoiJFpnZtUG2ybhSOUp/RPEnMVuooUI7YUsCGNCuNqJ1ysHW', NULL, '2024-10-16 01:46:01', '2024-10-16 01:46:01'),
(2, 'Jamaludin', 'jamal@jamal.com', NULL, '$2y$12$cekK15.N6KHwDOG3JPE0meM4SpJmbY4lDKdsSBrjw6LW8FWEWwzlW', NULL, '2024-10-16 01:47:17', '2024-10-16 01:47:17'),
(3, 'Urip', 'Urip@yoga.com', NULL, '$2y$12$3vO9h7hM1sgK0wDdOG4uNelS.oiiKbx2zPo6g0SQMqOp7NVLwcup.', NULL, '2024-10-16 01:47:57', '2024-10-16 01:47:57'),
(4, 'dennisetiadi99', 'dennisetiadi99@hoki.com', NULL, '$2y$12$NDbIXhYGyAjvACpuy6YR1e/CVPITqD37eL25BY37uCRHYtSNblS/2', NULL, '2025-05-25 10:42:37', '2025-05-25 10:42:37'),
(5, 'Wakhun', 'wakhun99@hoki.com', NULL, '$2y$12$nZkBVNImuAeUfdjyjQnfLe/XSffYDuGaK8dbaX62Zcsh92qVeJxBS', NULL, '2025-05-27 20:55:06', '2025-05-27 20:55:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `data_pelanggans`
--
ALTER TABLE `data_pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwals_idreservasi_foreign` (`idReservasi`);

--
-- Indexes for table `jenis_kerusakans`
--
ALTER TABLE `jenis_kerusakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `req_jadwals`
--
ALTER TABLE `req_jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idReservasi` (`idReservasi`);

--
-- Indexes for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservasis_noresi_unique` (`noResi`),
  ADD KEY `reservasis_idjeniskerusakan_foreign` (`idJenisKerusakan`);

--
-- Indexes for table `riwayats`
--
ALTER TABLE `riwayats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayats_idreservasi_foreign` (`idReservasi`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pelanggans`
--
ALTER TABLE `data_pelanggans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `jenis_kerusakans`
--
ALTER TABLE `jenis_kerusakans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `req_jadwals`
--
ALTER TABLE `req_jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `reservasis`
--
ALTER TABLE `reservasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `riwayats`
--
ALTER TABLE `riwayats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwals_idreservasi_foreign` FOREIGN KEY (`idReservasi`) REFERENCES `reservasis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `req_jadwals`
--
ALTER TABLE `req_jadwals`
  ADD CONSTRAINT `req_jadwals_ibfk_1` FOREIGN KEY (`idReservasi`) REFERENCES `reservasis` (`id`);

--
-- Constraints for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD CONSTRAINT `reservasis_idjeniskerusakan_foreign` FOREIGN KEY (`idJenisKerusakan`) REFERENCES `jenis_kerusakans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayats`
--
ALTER TABLE `riwayats`
  ADD CONSTRAINT `riwayats_idreservasi_foreign` FOREIGN KEY (`idReservasi`) REFERENCES `reservasis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
