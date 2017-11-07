-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2015 at 03:34 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `seotitle` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `title`, `seotitle`, `active`) VALUES
(1, 'Karya', 'karya', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(5) NOT NULL,
  `title` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `seotitle` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `group` enum('1','2') COLLATE latin1_general_ci NOT NULL DEFAULT '2',
  `active` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `title`, `seotitle`, `group`, `active`) VALUES
(15, 'Article', 'article', '2', 'Y'),
(14, 'HTML', 'html', '2', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `id_user` int(5) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `comment` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `id_component` int(10) NOT NULL,
  `component` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `table_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id_component`, `component`, `date`, `table_name`) VALUES
(1, 'mycontact', '2014-08-11', 'contact'),
(3, 'mycomment', '2014-08-11', 'comment'),
(10, 'mytestimoni', '2015-06-03', 'testimoni'),
(12, 'myslide', '2015-06-03', 'slide'),
(13, 'myvideo', '2015-06-12', 'video'),
(15, 'mylokasi', '2015-06-18', 'lokasi');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(10) NOT NULL,
  `name_contact` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email_contact` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `subjek_contact` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `message_contact` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(10) NOT NULL,
  `id_album` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `seotitle` varchar(100) NOT NULL,
  `picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tgl_mulai` varchar(10) NOT NULL,
  `luas` varchar(10) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_album`, `title`, `seotitle`, `picture`, `lokasi`, `tgl_mulai`, `luas`, `harga`) VALUES
(1, 1, 'sdad', 'sdad', '', 'sadadsa', '26-07-2015', '231', '220000');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(2) NOT NULL,
  `id_album` int(2) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lat` double NOT NULL,
  `lon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id_media` int(10) NOT NULL,
  `file_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `file_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `file_size` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `class`, `position`, `group_id`) VALUES
(1, 0, '<i class="fa fa-home"></i> Home', './', '', 1, 1),
(23, 0, 'Login', 'login', '', 6, 1),
(24, 0, 'HTML', 'category/html', '', 2, 1),
(25, 0, 'CSS', 'category/css', '', 3, 1),
(26, 0, 'JavaScript', '#', '', 4, 1),
(27, 0, 'PHP', '#', '', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `title`) VALUES
(1, 'Main Menu');

-- --------------------------------------------------------

--
-- Table structure for table `oauth`
--

CREATE TABLE `oauth` (
  `id_oauth` int(10) NOT NULL,
  `oauth_type` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_key` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_secret` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_user` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_token1` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_token2` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `oauth_fbtype` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth`
--

INSERT INTO `oauth` (`id_oauth`, `oauth_type`, `oauth_key`, `oauth_secret`, `oauth_id`, `oauth_user`, `oauth_token1`, `oauth_token2`, `oauth_fbtype`) VALUES
(1, 'facebook', '', '', '', '', '', '', ''),
(2, 'twitter', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `onprogres`
--

CREATE TABLE `onprogres` (
  `id_onprogres` int(10) NOT NULL,
  `id_gallery` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tgl_ambil` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `onprojek`
--

CREATE TABLE `onprojek` (
  `id_onprojek` int(2) NOT NULL,
  `id_gallery` int(2) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(5) NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_kustomer` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `no` int(11) NOT NULL,
  `id_orders` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id_pages` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `content` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `seotitle` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(10) NOT NULL,
  `id_category` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `content` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `seotitle` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tag` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `editor` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `active` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `headline` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `id_category`, `title`, `content`, `seotitle`, `tag`, `date`, `time`, `editor`, `active`, `headline`, `picture`, `hits`) VALUES
(1, '14', 'HTML Fundamental', '&lt;p&gt;Dalam pemograman website, Bahasa HTML sering sekali di ibaratkan anak bawang. Dikarenakan dalam proses pembelajarannya, bahasa HTML sangat mudah untuk dipahami dibandingkan dengan bahasa lainnya seperti PHP, CSS maupun JQuery.&lt;/p&gt;', 'html-fundamental', 'html5,html', '2015-10-03', '02:05:39', '1', 'Y', 'Y', 'PIJWrEi.jpg', 184),
(2, '15', 'Ingin Belajar Web Programming, Harus Mulai dari mana', '&lt;p&gt;Pertannyaan diatas sangat sering diajukan programmer pemula atau kalangan awam yang ingin mulai belajar web proramming. Saya juga sering ditanya terkait masalah ini baik melalui email maupun tatap muka. Ini sangat bisa dimaklumi, karena saking beragammya materi terkait web programming, banyak programmer pemula bingung mesti memulai dari mana&lt;/p&gt;\r\n&lt;p&gt;Oleh karena itu saya memutuskan untuk membuat artikel khusus mengnai hal ini, dan semoga bisa menjadi panduan dasar untuk rekan-rekan semua.&lt;/p&gt;\r\n&lt;p&gt;&quot;Ingin belajar web programming, harus mulai dari mana?&quot; pertanyaan ini juga ada dipikiran saya sewaktu mulai belajar web programming. Apakah mesti belajar algoritma dulu? HTML? PHP? atau apa? juga berapa lama waktu yang dibutuhkan untuk menjadi programmer yang ahli?&lt;/p&gt;\r\n&lt;p&gt;Saya akan mencoba menjawab semua pertanyaan ini berdasarkan pengalaman pribadi. Bagi rekan-rekan yang sudah lama &lt;em&gt;&#039;makan asam garam&#039;&lt;/em&gt; web programming. silahkan tinggalkan komentar di akhir artikel...&lt;/p&gt;\r\n&lt;p&gt;Happy Coding...&lt;/p&gt;\r\n&lt;h1&gt;Saya ingin mempelajari web programming, harus memulai dari mana?&lt;/h1&gt;\r\n&lt;p&gt;Jawaban singkatnya: mulai dari &lt;strong&gt;HTML.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;HTML &lt;/strong&gt;adalah inti dari seluruh halaman web. Sangat mustahil untuk membuat website tanpa memiliki dasar pengetahuan tentang HTML. Untungnya, HTML juga sangat mudah dipelajari. Anda tidak perlu memiliki dasar programming atau pengetahuan tentang algoritma apapun.&lt;br /&gt;Satu-satunya kemampuan yang dibutuhkan adalah anda sudah cukup familiar dengan cara penggunaan web browser seperti &lt;strong&gt;Google Chrome&lt;/strong&gt; atau &lt;strong&gt;Mozilla Firefox.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;CyPro&lt;/strong&gt; akan mengulas tentang tutorial dasar dan tutorial lanjutan seputar HTML. Membawa rekan-rekan untuk berasama-sama memahami Fundamental HTML.&lt;/p&gt;\r\n&lt;h1&gt;Setelah HTML, lanjut kemana?&lt;/h1&gt;\r\n&lt;p&gt;Jika anda sudah menguasai &lt;strong&gt;HTML&lt;/strong&gt; (minimal dasar-dasar HTML), bisa memilih antara &lt;strong&gt;CSS&lt;/strong&gt; atau &lt;strong&gt;PHP&lt;/strong&gt;. Apabila berminat dengan web design, silahkan lanjut mempelajari CSS. Apabila anda ingin membuat aplikasi web seperti pemrosesan form, menyimpan data ke databases, membuat laporan, dll bisa lanjut ke PHP.&lt;/p&gt;\r\n&lt;p&gt;Saya pribadi lebih menyarankan untuk lanjut ke CSS. dengan demikian, anda memiliki dasar yang pas dan bisa memahami bagaimana cara membuat tampilan website dan mempercantik desain halaman web.&lt;/p&gt;\r\n&lt;p&gt;Sama seperti &lt;strong&gt;HTML, CSS&lt;/strong&gt; juga tidak membutuhkan pengetahuan, apapun terkait programming. Baik CSS maupun HTML sebenarnya bukanlah sebuah &lt;em&gt;&#039;bahasa pemrograman&#039;. &lt;/em&gt;Keduanya adalah &lt;strong&gt;struktur yang terdiri dari perintah-perintah sederhana&lt;/strong&gt; (walaupun CSS mungkin&amp;nbsp;&lt;em&gt;&#039;sed&lt;/em&gt;&lt;em&gt;ikit&#039;&lt;/em&gt; lebih rumit daripada HTML).&lt;/p&gt;\r\n&lt;p&gt;Selanjutnya, setelah mempelajari HTML dan CSS, anda bisa lanjut ke PHP. Berbeda dengan HTML dan CSS,&lt;strong&gt; PHP&lt;/strong&gt; &lt;em&gt;&#039;murni&#039;&lt;/em&gt; sebuah bahasa pemrograman komputer. untuk dapat mempelajari PHP. sebaiknya punya dasar-dasar programming.&lt;/p&gt;\r\n&lt;p&gt;Ketika membuat website dengan PHP. kadang kita perlu untuk menyimpan data seperti registrasi user, laporan penjualan, hasil perhitungan, dll. Media penyimpanan ini dikenal dengan &lt;strong&gt;database&lt;/strong&gt;. Terdapat beragam aplikasi database yang bisa digunakan, saat ini aplikasi database yang paling populer untuk web programming adalah &lt;strong&gt;MySQL&lt;/strong&gt;. Anda bisa mempelajari MySQL pada saat bersamaan dengan PHP atau fokus ke PHP. baru kemudian lanjut ke MySQL.&lt;/p&gt;\r\n&lt;p&gt;Materi terakhir yang perlu dikuasai adalah &lt;strong&gt;JavaScript&lt;/strong&gt;. Sama seperti PHP, JavaScript merupakan bahasa pemrograman murni, Anda bisa langsung mempelajari JavaScript setelah belajar HTML. tapi saya menyarankan untuk masuk ke JavaScript setelah paham PHP, terutama jika anda belum pernah mempelajari bahasa pemrograman komputer sebelumnya.&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;JavaScript&lt;/strong&gt; menggunakan konsep pemrograman berbasis objek (&lt;strong&gt;Objek Oriented Programming&lt;/strong&gt;). Konsep OOP cukup sulit untuk pemula (terutama jika anda belum perna belajar OOP). Walaupun begitu, dengan materi dan panduan yang sesuai, belajar JavaScript sangat menyenangkan, Fitur dan hasil akhir yang bisa didapat dengan JavaScript sangat menarik, seperti animasi, konten interaktif, dll.&lt;/p&gt;\r\n&lt;h1&gt;HTML + CSS + PHP + MySQL + JavaScript, berapa lama untuk menguasai semua ini?&lt;/h1&gt;\r\n&lt;p&gt;Jawabnya:&amp;nbsp;&lt;em&gt;tergantung .&lt;/em&gt;&lt;/p&gt;\r\n&lt;p&gt;Ada beberapa faktor yang harus dipertimbangkan. Pertama, kata-kata &lt;em&gt;&#039;&lt;/em&gt;&lt;strong&gt;&lt;em&gt;menguasai&#039;&lt;/em&gt;&amp;nbsp;&lt;/strong&gt;disini sangat relatif.&lt;/p&gt;\r\n&lt;p&gt;Untuk sekedar &lt;em&gt;&#039;tahu&#039;&lt;/em&gt; tentang fungsi masing-masing &lt;em&gt;&#039;bahasa&#039;&lt;/em&gt; ini, anda bisa meluangkan waktu sekitar 1 minggu (hari pertama belajar HTML, hari kedua belajar CSS, dst). Tapi sekali lagi, ini hanya sekedar&lt;em&gt; &#039;tahu&#039;&lt;/em&gt;. itupun jika anda tidak pusing dengan pembahasan masing2.a&lt;/p&gt;\r\n&lt;p&gt;Bahasan untuk setiap&amp;nbsp;&lt;em&gt;&#039;bahasa&#039;&amp;nbsp;&lt;/em&gt;ini sangat banyak. apabila anda melihat-lihat buku terbitan luar seperti di&amp;nbsp;&lt;em&gt;&lt;strong&gt;amazon.com&lt;/strong&gt;,&amp;nbsp;&lt;/em&gt;beberapa buku bahkan memiliki hingga 1000 halaman, dan itu hanya khusus membahas satu macam materi seperti HTML saja, PHP saja, atau JavaScript saja. Buku manual resmi PHP dan MySQL bahkan bisa menjadi 2000 halaman.&lt;/p&gt;\r\n&lt;p&gt;Jadi, mungkin pertanyannya bisa dibalik, yakni seberapa banyak yang ingin anda pahami? Dengan asumsi setiap hari meluangkan waktu 4-5 jam untuk belajar, dalam 1 bulan anda bisa dianggap sudah menguasai 1 materi (+ beberapa minggu untuk latihan kode program), sehingga total dalam 5 bulan sudah bisa menguasai&amp;nbsp;&lt;strong&gt;HTML, CSS, PHP, MySQL,&amp;nbsp;&lt;/strong&gt;dan&amp;nbsp;&lt;strong&gt;JavaScript.&amp;nbsp;&lt;/strong&gt;Ini dengan catatan anda sudah memiliki sumber bacaan yang mudah dipahami seperti buku, ebook, maupun tutorial online.&lt;/p&gt;\r\n&lt;h1&gt;Huff, baiklah saya sudah cukup paham tentang HTML, CSS, PHP, MySQL, dan JavaScript, jadi apakah sudah selesai?&lt;/h1&gt;\r\n&lt;p&gt;Sekali lagi, ini tergantung dari beberapa faktor. Jika anda berniat mempelajari web programming sebagai&lt;em&gt; &#039;hobi&#039;&lt;/em&gt; atau sekedar mengisi waktu luang, memahami kelima bahasa pemrograman web diatas dirasa cukup. Tapi bagi anda yang berniat&amp;nbsp;&lt;strong&gt;Serius&amp;nbsp;&lt;/strong&gt;terjun ke dunia web programming, atau bahkan ingin memiliki karir sebagai&amp;nbsp;&lt;strong&gt;web programming,&amp;nbsp;&lt;/strong&gt;ini baru sebagai&amp;nbsp;&lt;em&gt;&#039;gerbang awal&#039;.&lt;/em&gt;&lt;/p&gt;\r\n&lt;p&gt;Dunia Web Programming berkembang dengan sangat cepat. Setiap bulan lahir teknologi baru yang bisa digunakan untuk membuat website yang lebih &lt;strong&gt;&quot;wah&quot;&lt;/strong&gt; dari sebelumnya. Teknologi ini hadir dalam bentuk&amp;nbsp;&lt;strong&gt;library, plugin, framework, CMS&amp;nbsp;&lt;/strong&gt;atau bahkan sebuah bahasa pemrogramman baru.&lt;/p&gt;\r\n&lt;blockquote&gt;\r\n&lt;p&gt;Library, plugin, framework atau CMS adalah kumpulan kode program yang bisa digunakan untuk menghasilkan website dalam waktu singkat, atau menyediakan beragam fungsi &lt;em&gt;&#039;siap pakai&#039;&lt;/em&gt;. Hampir seluruh websit modern menggunakannya.&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n&lt;p&gt;Sebagai contoh, di dalam bahasa pemrograman PHP, anda juga akan dituntut untuk memahami Framework.&amp;nbsp;&lt;strong&gt;Framework&amp;nbsp;&lt;/strong&gt;adalah kumpulan kode program dengan aturan tertentu yang bisa digunakan untuk menghasilkan website dengan cepat. Beberapa framework PHP yang cukup terkenal adalah&amp;nbsp;&lt;strong&gt;Laravel, CodeIgniter, Yii Framework,&amp;nbsp;&lt;/strong&gt;dan &lt;strong&gt;Zend Framework.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Dari sisi desain web (&lt;strong&gt;CSS),&amp;nbsp;&lt;/strong&gt;terdapat framework seperti&amp;nbsp;&lt;strong&gt;Bootstrap&amp;nbsp;&lt;/strong&gt;dan&amp;nbsp;&lt;strong&gt;Zurb Fondation.&amp;nbsp;&lt;/strong&gt;Selain itu ada juga teknologi CSS&amp;nbsp;&lt;em&gt;preprocessor&amp;nbsp;&lt;/em&gt;seperti &lt;strong&gt;Less&amp;nbsp;&lt;/strong&gt;dan&amp;nbsp;&lt;strong&gt;Sass.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Untuk JavaScript tersedia berbagai teknologi library seperti&amp;nbsp;&lt;strong&gt;jQuery,&amp;nbsp;&lt;/strong&gt;framework&amp;nbsp;&lt;strong&gt;AngularJS,&amp;nbsp;&lt;/strong&gt;dan juga &lt;strong&gt;Node.js.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Untuk media penyimpanan saat ini memiliki teknology terbaru seperti&amp;nbsp;&lt;strong&gt;Mongo.DB&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Melihat banyaknya teknologi yang harus dikuasai, pada titik ini umumnya anda harus memilih akan fokus kemana. Jika fokus ke&amp;nbsp;&lt;strong&gt;web designer&amp;nbsp;&lt;/strong&gt;(dikenal juga sebagai&amp;nbsp;&lt;strong&gt;front-end developer&lt;/strong&gt;), kuasai secara mendalam HTML+CSS+JavaScript beserta frameworknya. Jika anda ingin fokus ke&amp;nbsp;&lt;strong&gt;web programmer&amp;nbsp;&lt;/strong&gt;(dikenal juga dengan &lt;strong&gt;back-end developer&lt;/strong&gt;), khususkan diri untuk mendalami PHP dan berbagai frameworknya.&lt;/p&gt;\r\n&lt;p&gt;Sebagai pembuktian untuk kebutuhan akan framework, silahkan anda lihat lowongan kerja web programer. Hampir semuannya membutuhkan syarat menguasai beberapa framework seperti&amp;nbsp;&lt;strong&gt;CodeIgniter, Laravel,&amp;nbsp;&lt;/strong&gt;atau&amp;nbsp;&lt;strong&gt;jQuery.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;h1&gt;Wah banyak banget yang harus dikuasai mas...&lt;/h1&gt;\r\n&lt;p&gt;Lagi-lagi, ini tergantung dengan tujuan anda mempelajari web programming. Jika anda butuh untuk keperluan edukasi seperti tugas sekolah/membuat skripsi, silahkan fokus untuk menyelesaikannya, gunakan web programming sebagai &lt;em&gt;&#039;media&#039;&lt;/em&gt; untuk mencapai tujuan ini.&lt;/p&gt;\r\n&lt;p&gt;Tetapi jika anda serius ingin berkarir sebagai programmer, mempelajari setiap teknologi ini akan terasa sangat menyanangkan. Istilahnya, tiada hari tanpa ngoding.&lt;/p&gt;\r\n&lt;blockquote&gt;\r\n&lt;p&gt;CyPro akan mencoba membantu anda dalam menguasai berbagai teknologi web programming, Walaupun masih jauh dari sempurna. Tutorial yang ada bisa dijadikan sebagai penuntun dasar dalam belajar web programming.&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n&lt;p&gt;Semoga tulisan singkat ini bisa memberikan gambaran apa yang akan anda hadapi dan apa yang harus anda kuasai untuk menjadi&amp;nbsp;&lt;strong&gt;web programmer.&amp;nbsp;&lt;/strong&gt;Mudah-mudahan bermanfaat, dan jika ada ide/saran/pertanyaan/berbagi pengalaman. Silahkan tinggalkan sepatah dua patah kata di kolom komentar.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Salam&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;www.CyPro.com&lt;/strong&gt;&lt;/p&gt;', 'ingin-belajar-web-programming-harus-mulai-dari-mana', 'web-programing,website', '2015-10-04', '02:21:01', '5', 'Y', 'N', 'PIJWrEi.jpg', 194);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `id_category` int(5) DEFAULT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `recomended` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_category`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`, `recomended`) VALUES
(49, 13, 'kelfjewlk', 'selkfjsl', 290000000, 232, 'girl3.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(5) NOT NULL,
  `website_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `website_url` varchar(100) CHARACTER SET latin1 NOT NULL,
  `website_email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(250) CHARACTER SET latin1 NOT NULL,
  `meta_keyword` varchar(250) CHARACTER SET latin1 NOT NULL,
  `favicon` varchar(50) CHARACTER SET latin1 NOT NULL,
  `timezone` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `website_maintenance` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `website_maintenance_tgl` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `website_cache` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `website_cache_time` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `member_register` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `website_name`, `website_url`, `website_email`, `meta_description`, `meta_keyword`, `favicon`, `timezone`, `website_maintenance`, `website_maintenance_tgl`, `website_cache`, `website_cache_time`, `member_register`) VALUES
(1, 'e', 'http://localhost/MySystem', 'system@localhost.com', 'InsyaAllah Berkah', 'InsyaAllah Berkah', 'favicon.png', 'Asia/Jakarta', 'N', '06-24-2015', 'N', '60', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id_slide` int(2) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id_slide`, `nama`, `picture`, `active`) VALUES
(67, 'Sweet', 'sweet-247924.jpg', 'Y'),
(68, 'Man Handsome', 'man-handsome-119598.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id_subscribe` int(10) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id_subscribe`, `email`) VALUES
(1, 'odyzwinangun@gmail.com'),
(2, 'vector.boedy'),
(3, 'maman@gmail.com'),
(4, 'budi@gmail.com'),
(5, 'mana@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(5) NOT NULL,
  `tag_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tag_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `count` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `tag_title`, `tag_seo`, `count`) VALUES
(49, 'HTML', 'html', 6),
(50, 'HTML5', 'html5', 5),
(51, 'XHTML', 'xhtml', 0),
(52, 'website', 'website', 9),
(53, 'web programing', 'web-programing', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbljamaah`
--

CREATE TABLE `tbljamaah` (
  `IDJamaah` int(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `NoPonsel` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `JenisKelamin` char(1) NOT NULL,
  `Status` char(1) NOT NULL,
  `DaftarSebagai` varchar(10) NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `TanggalDaftar` date NOT NULL,
  `IDRekanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljamaah`
--

INSERT INTO `tbljamaah` (`IDJamaah`, `Nama`, `Alamat`, `NoPonsel`, `Email`, `TanggalLahir`, `JenisKelamin`, `Status`, `DaftarSebagai`, `Keterangan`, `TanggalDaftar`, `IDRekanan`) VALUES
(1, 'LELE', 'RUMAH LELE', '09289282282', 'LELEpunyaEMAIL@yahoo.com', '1990-08-13', 'L', 'N', '2', 'asdfasd', '2015-11-29', '4AA65LG32J0I6JH'),
(2, 'Hamdani Piliang', 'Medan', '08134523124', 'aam.hamdan.92@gmail.com', '1988-02-18', 'P', 'Y', '2', '', '0000-00-00', ''),
(3, 'Hamdani Piliang', 'Medan', '08134523124', 'aam.hamdan.92@gmail.com', '1988-02-18', 'P', 'Y', '2', '1', '2015-11-29', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblkomisi`
--

CREATE TABLE `tblkomisi` (
  `KodeKomisi` int(11) NOT NULL,
  `IDJamaah` varchar(20) NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `Tanggal` date NOT NULL,
  `TanggalPencairan` date NOT NULL,
  `Status` char(1) NOT NULL,
  `Komisi` double NOT NULL,
  `IDRekanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkomisi`
--

INSERT INTO `tblkomisi` (`KodeKomisi`, `IDJamaah`, `Keterangan`, `Tanggal`, `TanggalPencairan`, `Status`, `Komisi`, `IDRekanan`) VALUES
(1, '1', '', '0000-00-00', '0000-00-00', 'N', 0, 'DA8GL9K09FFAA51'),
(2, '2', '', '0000-00-00', '0000-00-00', 'N', 0, ''),
(3, '3', '', '0000-00-00', '0000-00-00', 'N', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbllevel`
--

CREATE TABLE `tbllevel` (
  `NamaLevel` varchar(10) NOT NULL,
  `Komisi` double NOT NULL,
  `Keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllevel`
--

INSERT INTO `tbllevel` (`NamaLevel`, `Komisi`, `Keterangan`) VALUES
('Lavel 0', 1000000, 'Lavel Perwakilan'),
('Level1', 500000, 'asda');

-- --------------------------------------------------------

--
-- Table structure for table `tblmarketing`
--

CREATE TABLE `tblmarketing` (
  `KodeMarketing` int(11) NOT NULL,
  `IDMarketing` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `NoPonsel` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `JenisKelamin` varchar(10) NOT NULL,
  `Status` char(5) NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `TanggalDaftar` date NOT NULL,
  `Level` varchar(10) NOT NULL,
  `IDReferal` varchar(20) NOT NULL,
  `IDPerwakilan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmarketing`
--

INSERT INTO `tblmarketing` (`KodeMarketing`, `IDMarketing`, `Nama`, `Alamat`, `NoPonsel`, `Email`, `TanggalLahir`, `JenisKelamin`, `Status`, `Keterangan`, `TanggalDaftar`, `Level`, `IDReferal`, `IDPerwakilan`) VALUES
(1, '4AA65LG32J0I6JH', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(2, '81B9AJKJ795J03D', 'JJJ', 'JJJ', '09289282282', 'JJJ@gmail.com', '1973-04-04', 'P', 'N', '', '0000-00-00', '', '4AA65LG32J0I6JH', ''),
(3, '8JEDF1LAJKEFK5A', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(4, '4AA65LG32J0I6JN', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(5, '8JEDF1LAJKEFK5N', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(6, '4AA65LG32J0I6JM', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(7, '8JEDF1LAJKEFK5M', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(8, '4AA65LG32J0I6JZ', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(9, '8JEDF1LAJKEFK5Z', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(10, '4AA65LG32J0I6JH', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(11, '8JEDF1LAJKEFK5A', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(12, '4AA65LG32J0I6JN', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(13, '8JEDF1LAJKEFK5N', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(14, '4AA65LG32J0I6JM', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(15, '8JEDF1LAJKEFK5M', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(16, '4AA65LG32J0I6JZ', 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'N', 'asdasda', '2015-11-29', '1', '-', '2G7K385FG11K9JJ'),
(17, '8JEDF1LAJKEFK5Z', 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'N', 'aaa', '2015-11-30', '1', '-', '2G7K385FG11K9JJ'),
(18, '81B9AJKJ795J03N', 'JJJX', 'JJJX', '09289282282', 'JJJ@gmail.com', '1973-04-04', 'P', 'N', '', '0000-00-00', '', '8JEDF1LAJKEFK5A', ''),
(19, '81B9AJKJ795J03Z', 'SD', 'SD', '09289282282', 'JJJ@gmail.com', '1973-04-04', 'P', 'N', '', '0000-00-00', '', '8JEDF1LAJKEFK5M', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblpendaftaran`
--

CREATE TABLE `tblpendaftaran` (
  `KodeDaftar` int(20) NOT NULL,
  `Nama` varchar(35) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `NoPonsel` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `JenisKelamin` char(1) NOT NULL,
  `Status` char(1) NOT NULL,
  `DaftarSebagai` varchar(20) NOT NULL,
  `IDRekanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpendaftaran`
--

INSERT INTO `tblpendaftaran` (`KodeDaftar`, `Nama`, `Alamat`, `NoPonsel`, `Email`, `TanggalLahir`, `JenisKelamin`, `Status`, `DaftarSebagai`, `IDRekanan`) VALUES
(22, 'LELE', 'RUMAH LELE', '09289282282', 'LELEpunyaEMAIL@yahoo.com', '1990-08-13', 'P', 'Y', '2', 'DA8GL9K09FFAA51'),
(23, 'Budi', 'Rumah Budi', '08134523124', 'budipunyaemailbaru@gmail.com', '1992-03-11', 'L', 'Y', '1', 'DA8GL9K09FFAA51'),
(24, 'Hamdani Piliang', 'Medan', '08134523124', 'aam.hamdan.92@gmail.com', '1988-02-18', 'P', 'Y', '2', ''),
(25, 'JJJ', 'JJJ', '09289282282', 'JJJ@gmail.com', '1973-04-04', 'P', 'Y', '1', '4AA65LG32J0I6JH'),
(26, 'JUN', 'JUNS HOME', '08123213123', 'jun@gmail.com', '1992-05-07', 'L', 'Y', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblperwakilan`
--

CREATE TABLE `tblperwakilan` (
  `KodePerwakilan` int(11) NOT NULL,
  `IDPerwakilan` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `NoPonsel` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `JenisKelamin` varchar(20) NOT NULL,
  `Status` char(5) NOT NULL,
  `Keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblperwakilan`
--

INSERT INTO `tblperwakilan` (`KodePerwakilan`, `IDPerwakilan`, `Nama`, `Alamat`, `NoPonsel`, `Email`, `TanggalLahir`, `JenisKelamin`, `Status`, `Keterangan`) VALUES
(1, '2G7K385FG11K9JJ', 'JOHN', 'JOHNs HOME', '099887882', 'JOHNS@gmail.com', '1981-07-09', 'L', 'N', 'asasasas');

-- --------------------------------------------------------

--
-- Table structure for table `tblrekanan`
--

CREATE TABLE `tblrekanan` (
  `KodeRekanan` int(11) NOT NULL,
  `IDRekanan` varchar(20) NOT NULL,
  `StatusRekanan` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrekanan`
--

INSERT INTO `tblrekanan` (`KodeRekanan`, `IDRekanan`, `StatusRekanan`) VALUES
(15, '4AA65LG32J0I6JH', 'M'),
(17, '2G7K385FG11K9JJ', 'P'),
(18, '81B9AJKJ795J03D', 'M'),
(19, '8JEDF1LAJKEFK5A', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `tblrekankerja`
--

CREATE TABLE `tblrekankerja` (
  `IdRekanan` int(10) NOT NULL,
  `NamaLengkap` varchar(35) NOT NULL,
  `NamaPanggilan` varchar(35) NOT NULL,
  `JenisKelamin` char(1) NOT NULL,
  `Alamat` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `NoPonsel` varchar(30) NOT NULL,
  `TanggalLahir` datetime NOT NULL,
  `TempatLahir` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL,
  `Keterangan` text NOT NULL,
  `TanggalBergabung` datetime NOT NULL,
  `Foto` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `IDUser` int(10) NOT NULL,
  `Nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `HakAkses` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `IDRekanan` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`IDUser`, `Nama`, `username`, `password`, `HakAkses`, `IDRekanan`) VALUES
(5, 'Budi', 'marketing', '0192023a7bbd73250516f069df18b500', 'Marketing', '4AA65LG32J0I6JH'),
(4, 'Budi', 'operator', '086e1b7e1c12ba37cd473670b3a15214', 'Operator', ''),
(1, 'Johny', 'perwakilan', '0192023a7bbd73250516f069df18b500', 'Perwakilan', '2G7K385FG11K9JJ'),
(2, 'Budi', 'admin', '086e1b7e1c12ba37cd473670b3a15214', 'Admin', ''),
(3, 'editor super', 'editor', '50116a1a3b67657572a00ea8c6680cb9', '', ''),
(16600009, '', 'sdsadsad', '', '', ''),
(16600011, '', 'dsadadas', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `KodeDaftar` int(20) NOT NULL,
  `Nama` varchar(35) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `NoPonsel` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `JenisKelamin` char(1) NOT NULL,
  `Status` char(1) NOT NULL,
  `DaftarSebagai` varchar(20) NOT NULL,
  `IDRekanan` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int(10) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `testimoni` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id_theme` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `author` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id_theme`, `title`, `author`, `folder`, `active`) VALUES
(8, 'Warung', 'Budi Setiawan', 'warung', 'N'),
(12, 'event', 'Budi Setiawan', 'event', 'N'),
(17, 'softmed', 'softmed', 'softmed', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

CREATE TABLE `traffic` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`ip`, `tanggal`, `hits`, `online`) VALUES
('::1', '2015-05-30', 4, '1433001599'),
('::1', '2015-05-31', 6, '1433086829'),
('::1', '2015-06-01', 1, '1433139700'),
('::1', '2015-06-02', 4, '1433261250'),
('127.0.0.1', '2015-06-02', 6, '1433241462'),
('::1', '2015-06-03', 5, '1433348399'),
('::1', '2015-06-04', 173, '1433394567'),
('::1', '2015-06-05', 386, '1433520686'),
('::1', '2015-06-06', 225, '1433571297'),
('::1', '2015-06-07', 147, '1433667580'),
('::1', '2015-06-11', 12, '1434026402'),
('::1', '2015-06-12', 238, '1434106936'),
('::1', '2015-06-13', 9, '1434193031'),
('::1', '2015-06-14', 4, '1434283017'),
('::1', '2015-06-15', 49, '1434360765'),
('::1', '2015-06-17', 291, '1434560395'),
('::1', '2015-06-18', 515, '1434625901'),
('::1', '2015-06-19', 5, '1434728155'),
('::1', '2015-06-22', 12, '1434985050'),
('::1', '2015-06-23', 1, '1435016153'),
('::1', '2015-06-24', 34, '1435164463'),
('::1', '2015-06-25', 32, '1435240450'),
('::1', '2015-06-28', 12, '1435507388'),
('::1', '2015-06-29', 3, '1435532527'),
('::1', '2015-06-30', 2, '1435658375'),
('::1', '2015-07-02', 2, '1435770726'),
('::1', '2015-07-03', 2, '1435922932'),
('::1', '2015-07-04', 19, '1435986556'),
('::1', '2015-07-06', 15, '1436193029'),
('::1', '2015-07-09', 6, '1436456678'),
('::1', '2015-07-10', 1, '1436512212'),
('::1', '2015-07-11', 113, '1436627993'),
('::1', '2015-07-12', 16, '1436678432'),
('::1', '2015-07-13', 16, '1436806540'),
('::1', '2015-07-14', 15, '1436855065'),
('::1', '2015-07-15', 1, '1436901536'),
('::1', '2015-07-19', 6, '1437292179'),
('::1', '2015-07-20', 59, '1437404274'),
('::1', '2015-07-24', 1, '1437751914'),
('::1', '2015-07-27', 37, '1438006886'),
('::1', '2015-08-02', 8, '1438493944'),
('::1', '2015-08-03', 2, '1438614393'),
('::1', '2015-08-10', 1, '1439181817'),
('::1', '2015-08-11', 4, '1439242814'),
('::1', '2015-08-16', 4, '1439669561'),
('::1', '2015-08-20', 5, '1440069596'),
('::1', '2015-08-26', 1, '1440551394'),
('::1', '2015-08-28', 1, '1440769429'),
('::1', '2015-09-11', 5, '1441942346'),
('::1', '2015-09-12', 56, '1442021905'),
('::1', '2015-09-13', 7, '1442078944'),
('::1', '2015-09-15', 1, '1442258588'),
('::1', '2015-09-18', 3, '1442570670'),
('::1', '2015-10-02', 75, '1443803364'),
('::1', '2015-10-03', 138, '1443891455'),
('::1', '2015-10-04', 545, '1443961301'),
('::1', '2015-10-05', 15, '1444045013'),
('::1', '2015-10-06', 250, '1444113845'),
('::1', '2015-10-07', 167, '1444237171'),
('::1', '2015-10-08', 850, '1444297208'),
('::1', '2015-10-12', 2, '1444640643'),
('::1', '2015-10-13', 3, '1444741582'),
('::1', '2015-10-15', 1, '1444915307'),
('::1', '2015-10-20', 15, '1445357917'),
('::1', '2015-10-21', 86, '1445364594'),
('::1', '2015-11-07', 21, '1446839702'),
('::1', '2015-11-09', 4, '1447086454');

-- --------------------------------------------------------

--
-- Table structure for table `user_jabatan`
--

CREATE TABLE `user_jabatan` (
  `id_jabatan` int(2) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_jabatan`
--

INSERT INTO `user_jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Direktur Utama'),
(2, 'Direktur Teknik'),
(3, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_level` int(10) NOT NULL,
  `level` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level`) VALUES
(1, 'Super Adminitrator'),
(2, 'Admin'),
(3, 'Editor'),
(8, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(10) NOT NULL,
  `id_level` int(10) NOT NULL,
  `module` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `read_access` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `write_access` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `modify_access` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `delete_access` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `id_level`, `module`, `read_access`, `write_access`, `modify_access`, `delete_access`) VALUES
(1, 1, 'post', 'Y', 'Y', 'Y', 'Y'),
(2, 1, 'category', 'Y', 'Y', 'Y', 'Y'),
(3, 1, 'tag', 'Y', 'Y', 'Y', 'Y'),
(4, 1, 'pages', 'Y', 'Y', 'Y', 'Y'),
(5, 1, 'library', 'Y', 'Y', 'Y', 'Y'),
(6, 1, 'setting', 'Y', 'Y', 'Y', 'Y'),
(7, 1, 'theme', 'Y', 'Y', 'Y', 'Y'),
(8, 1, 'menumanager', 'Y', 'Y', 'Y', 'Y'),
(9, 1, 'component', 'Y', 'Y', 'Y', 'Y'),
(10, 1, 'user', 'Y', 'Y', 'Y', 'Y'),
(11, 1, 'comment', 'Y', 'Y', 'Y', 'Y'),
(12, 1, 'gallery', 'Y', 'Y', 'Y', 'Y'),
(13, 1, 'contact', 'Y', 'Y', 'Y', 'Y'),
(14, 1, 'cogen', 'Y', 'Y', 'Y', 'Y'),
(15, 2, 'post', 'Y', 'Y', 'Y', 'Y'),
(16, 2, 'category', 'Y', 'Y', 'Y', 'Y'),
(17, 2, 'tag', 'Y', 'Y', 'Y', 'Y'),
(18, 2, 'pages', 'Y', 'Y', 'Y', 'Y'),
(19, 2, 'library', 'Y', 'Y', 'Y', 'Y'),
(20, 2, 'setting', 'Y', 'Y', 'Y', 'Y'),
(21, 2, 'theme', 'N', 'N', 'N', 'N'),
(22, 2, 'menumanager', 'Y', 'Y', 'Y', 'Y'),
(24, 2, 'user', 'Y', 'Y', 'Y', 'Y'),
(25, 2, 'comment', 'Y', 'Y', 'Y', 'Y'),
(26, 2, 'gallery', 'Y', 'Y', 'Y', 'Y'),
(27, 2, 'contact', 'Y', 'Y', 'Y', 'Y'),
(29, 3, 'post', 'Y', 'Y', 'Y', 'Y'),
(30, 3, 'category', 'Y', 'Y', 'Y', 'Y'),
(31, 3, 'tag', 'Y', 'Y', 'Y', 'Y'),
(32, 3, 'pages', 'N', 'N', 'N', 'N'),
(33, 3, 'library', 'N', 'N', 'N', 'N'),
(34, 3, 'setting', 'N', 'N', 'N', 'N'),
(35, 3, 'theme', 'N', 'N', 'N', 'N'),
(36, 3, 'menumanager', 'N', 'N', 'N', 'N'),
(37, 3, 'component', 'N', 'N', 'N', 'N'),
(38, 3, 'user', 'Y', 'N', 'Y', 'N'),
(39, 3, 'comment', 'N', 'N', 'N', 'N'),
(40, 3, 'gallery', 'N', 'N', 'N', 'N'),
(41, 3, 'contact', 'N', 'N', 'N', 'N'),
(42, 3, 'cogen', 'N', 'N', 'N', 'N'),
(43, 8, 'user', 'Y', 'Y', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(10) NOT NULL,
  `id_album` int(2) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `headline` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `id_album`, `title`, `date`, `url`, `headline`) VALUES
(1, 1, 'sdsad', '2015-07-04', 'sdasdas', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id_component`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth`
--
ALTER TABLE `oauth`
  ADD PRIMARY KEY (`id_oauth`);

--
-- Indexes for table `onprogres`
--
ALTER TABLE `onprogres`
  ADD PRIMARY KEY (`id_onprogres`);

--
-- Indexes for table `onprojek`
--
ALTER TABLE `onprojek`
  ADD PRIMARY KEY (`id_onprojek`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_pages`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id_subscribe`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `tbljamaah`
--
ALTER TABLE `tbljamaah`
  ADD PRIMARY KEY (`IDJamaah`);

--
-- Indexes for table `tblkomisi`
--
ALTER TABLE `tblkomisi`
  ADD PRIMARY KEY (`KodeKomisi`);

--
-- Indexes for table `tbllevel`
--
ALTER TABLE `tbllevel`
  ADD PRIMARY KEY (`NamaLevel`);

--
-- Indexes for table `tblmarketing`
--
ALTER TABLE `tblmarketing`
  ADD PRIMARY KEY (`KodeMarketing`);

--
-- Indexes for table `tblpendaftaran`
--
ALTER TABLE `tblpendaftaran`
  ADD PRIMARY KEY (`KodeDaftar`);

--
-- Indexes for table `tblperwakilan`
--
ALTER TABLE `tblperwakilan`
  ADD PRIMARY KEY (`KodePerwakilan`);

--
-- Indexes for table `tblrekanan`
--
ALTER TABLE `tblrekanan`
  ADD PRIMARY KEY (`KodeRekanan`);

--
-- Indexes for table `tblrekankerja`
--
ALTER TABLE `tblrekankerja`
  ADD PRIMARY KEY (`IdRekanan`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`KodeDaftar`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`);

--
-- Indexes for table `user_jabatan`
--
ALTER TABLE `user_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `id_component` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `oauth`
--
ALTER TABLE `oauth`
  MODIFY `id_oauth` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `onprogres`
--
ALTER TABLE `onprogres`
  MODIFY `id_onprogres` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `onprojek`
--
ALTER TABLE `onprojek`
  MODIFY `id_onprojek` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id_pages` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id_slide` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id_subscribe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tbljamaah`
--
ALTER TABLE `tbljamaah`
  MODIFY `IDJamaah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblkomisi`
--
ALTER TABLE `tblkomisi`
  MODIFY `KodeKomisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblmarketing`
--
ALTER TABLE `tblmarketing`
  MODIFY `KodeMarketing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblpendaftaran`
--
ALTER TABLE `tblpendaftaran`
  MODIFY `KodeDaftar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tblperwakilan`
--
ALTER TABLE `tblperwakilan`
  MODIFY `KodePerwakilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblrekanan`
--
ALTER TABLE `tblrekanan`
  MODIFY `KodeRekanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblrekankerja`
--
ALTER TABLE `tblrekankerja`
  MODIFY `IdRekanan` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `KodeDaftar` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_theme` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user_jabatan`
--
ALTER TABLE `user_jabatan`
  MODIFY `id_jabatan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
