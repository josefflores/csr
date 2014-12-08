-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2014 at 08:35 PM
-- Server version: 5.5.36
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csr`
--

-- --------------------------------------------------------

--
-- Table structure for table `csr_mfa_account`
--

CREATE TABLE IF NOT EXISTS `csr_mfa_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mfa_device_id` text COLLATE utf8_unicode_ci NOT NULL,
  `mfa_device_date` int(11) NOT NULL,
  `mfa_device_pin` text COLLATE utf8_unicode_ci NOT NULL,
  `mfa_device_salt` text COLLATE utf8_unicode_ci NOT NULL,
  `mfa_device_pepper` text COLLATE utf8_unicode_ci NOT NULL,
  `mfa_device_owner_id` int(11) NOT NULL,
  `mfa_device_attempt` int(11) NOT NULL,
  `mfa_device_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `csr_mfa_account`
--

INSERT INTO `csr_mfa_account` (`id`, `mfa_device_id`, `mfa_device_date`, `mfa_device_pin`, `mfa_device_salt`, `mfa_device_pepper`, `mfa_device_owner_id`, `mfa_device_attempt`, `mfa_device_active`) VALUES
(1, '5082457496', 123456789, '294669', 'ABC123', 'THEHALL', 0, 0, 1),
(3, '508245749655', 123456789, '982091', 'ABC123kk', 'THEHALL2', 30, 0, 1),
(6, '00:01:02:03:04:05', 1405226684, '448360', 'e407ea1543913742153de53f0620a8a2', '8ca522c894ef1fbbf4b0654e27e24c1c', 36, 0, 0),
(7, '00:01:03:03:04:05', 1405230236, '946172', 'd8fd303c356174ac1ccdd3af38878bcb', '2063e52983b37a2a0ca0b5a4ad7e1847', 36, 0, 0),
(8, '00:01:23:03:04:05', 1405230276, '199286', 'e30efc3051bc40059947b145664405ce', '773011ac19ca2d7dc7b8cc74afe1287e', 36, 0, 0),
(9, '01:01:23:03:04:05', 1405236276, '563667', '5a94c94f778d1ecb05209a8188f2b191', '1eacaa97973a8055d9f3d9e16b1454a2', 36, 0, 0),
(10, '11:11:23:03:04:05', 1405236613, '925725', '20d8151f7073638692f163c36e582367', 'ddcf62e9d753d3aa7092fb5eac6efb8e', 36, 0, 1),
(11, '00:01:02:03:04:45', 1405296332, '631631', 'af569316b6390f618530134612f8bde1', 'c18c27e16cbe910201099956aff0444e', 36, 0, 0),
(12, '00:01:02:03:04:55', 1405296359, '980542', 'a231be57136662ccba882acd50244058', '30bb7ec2ca1259feab1f96684010a82f', 36, 0, 0),
(13, '00:01:02:03:44:55', 1405296498, '718064', 'c8cf28e68a0880bf7e56fec9d6845d61', 'ea5bb91cc00fba492ef16f9914c4befb', 36, 0, 0),
(14, '00:01:02:03:54:55', 1405296516, '544609', 'd6b50f70f6935901a4127fa93fa553a8', '2cc27eca6ec1c79b5f4ff4108ab065d2', 36, 0, 0),
(15, '00:01:02:03:55:55', 1405296585, '598926', '8a0f7a06bea8223c09de6048ac3da4c2', '34f135167b5bda961fadbf57899ac3bd', 36, 0, 0),
(16, '00:01:02:03:56:55', 1405296698, '180553', 'a9ae3a23cd0e580a8d841ee6c9271c2a', '4d9012ad193895c55329316680754bab', 36, 0, 0),
(17, '00:01:02:03:57:55', 1405296734, '978270', '0110e2ab97b1c1e71f76fc2dc768cf45', 'c8ed10a9fdd8e09aed8771986458b175', 36, 0, 0),
(18, '00:01:02:13:57:55', 1405296762, '331129', '6657d5e919aa6c3aafcd0a2c622d1b5d', 'fe02ef876ce8ef6fe33671b3b483f8da', 36, 0, 0),
(19, '00:01:02:14:57:55', 1405296794, '833416', 'b64f3791d536ad513b4a1b5ed9c99fa9', '526b3f2e2c3a3b86364ce9e377606783', 36, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `csr_usr_account`
--

CREATE TABLE IF NOT EXISTS `csr_usr_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name_first` text COLLATE utf8_unicode_ci,
  `usr_name_middle` text COLLATE utf8_unicode_ci,
  `usr_name_last` text COLLATE utf8_unicode_ci,
  `usr_email` text COLLATE utf8_unicode_ci,
  `usr_pwd_salt` text COLLATE utf8_unicode_ci,
  `usr_pwd_hash` text COLLATE utf8_unicode_ci,
  `usr_phone_country` text COLLATE utf8_unicode_ci,
  `usr_phone_area` text COLLATE utf8_unicode_ci,
  `usr_phone_number` text COLLATE utf8_unicode_ci,
  `usr_phone_ext` text COLLATE utf8_unicode_ci,
  `usr_dob_epoch` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usr_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `csr_usr_account`
--

INSERT INTO `csr_usr_account` (`id`, `usr_name_first`, `usr_name_middle`, `usr_name_last`, `usr_email`, `usr_pwd_salt`, `usr_pwd_hash`, `usr_phone_country`, `usr_phone_area`, `usr_phone_number`, `usr_phone_ext`, `usr_dob_epoch`) VALUES
(1, 'amanda', 'francisco', 'flores', 'amanda.flores.152@gmail.com', 'ab68ad2f5be0d1742bd1a1303eb1f627', 'e65e1f9ad01e43c690d4d23c2cf81cce15a2c0b99a0f344ef2066b18b8873c60', '1', '508', '2457496', NULL, '472194000'),
(32, 'p', NULL, 'h', 'peng_hou@studentuml.edu', '3f69d79290bd8508a497796b89637b8f', '92754351aec277a3a6e50f63fdb3f9f0e13dd2af81765fc272b8ac544131a6b4', '1', '999', '9999999', NULL, '1199077200'),
(33, 'jose', NULL, 'flores', 'jose.f.lores.152@gmail.com', '8c9632dfbfb702dcd12d0127cec1282d', '2d7e5758dc0cccfd62bffa4a908ede89dc6c80a8f24006f226880a91e943d065', '1', '508', '2457496', NULL, '472194000'),
(34, 'jose', NULL, 'flores', 'jose.f.l.ores.152@gmail.com', '9dbe6e5be2e4c4269157b1c07454041b', '68ab9de22e052ffbc70969425e5c5ae5ba3ec431d7e8b001eb7e164b0fbb83fa', '1', '508', '2457496', NULL, '472194000'),
(35, 'jose', NULL, 'flores', 'jos.e.flores.152@gmail.com', '5efe6dc9f1697428c60dd179c1c3cd4a', 'edfaabe4e326c678646e7dd28f1e6d475e31f0c8726be6d661969da594fde84b', '1', '508', '2457496', NULL, '472194000'),
(36, 'jose', 'f', 'flores', 'joseflores152@gmail.com', '753ccff77f10bd6d8357f5a2e3090f41', '9b5089e494b9bd18044e914b0575b605e19c7a7a77d575aee589f9f633b86f50', '1', '508', '2457496', NULL, '472194000'),
(37, 'john', 'fedrick', 'doe', 'josefl.ores@gmail.com', 'fe0456cf65c5b80de367787b261fdeb7', '47b38e6259ea09e3dba9a98533da928a97366365c2d537fad98cd4ca2c46e0d3', '1', '234', '5556666', '4444', '1199077200'),
(38, 'john', 'fedrick', 'doe', 'josefl.o.res@gmail.com', 'c74831fc13432540dc590bd9cfe8bd1e', 'cdae41ddcbb13e0042f05cbd8a13f99caa4d2ce88bf59273f3ecff2b437717dd', '1', '234', '5556666', '4444', '1199077200'),
(39, 'john', 'fedrick', 'doe', 'jos.ef.l.o.res@gmail.com', 'b7be828d0d038810eec53cb3b2fd38cc', 'cbe2796edec96689d60391b600c8e2cddb2c99b354fa2e556512b2f3c57a5ce3', '1', '234', '5556666', '4444', '1199077200'),
(40, 'donald', 'd', 'buhl-brown', 'dbuhlbrown@my.apsu.edu', 'cce8b2334da6029569829434d46b524b', '751658035b886ba947a4d077a75d34b72f6286e344bdfe5d7850f19cb9bdd4d5', '1', '931', '5618780', NULL, '720162000'),
(41, 'jose', NULL, 'flores', 'jose.flores.152@gmail.com', '0c5853286a3bdeabfa5362fe550841a7', '9422d0cabc8cf3c05cd34b8c0ed9bb03694f374d1f5d74407f5f9831786d6cca', '1', '508', '2457496', NULL, '472194000');

-- --------------------------------------------------------

--
-- Table structure for table `csr_usr_permission`
--

CREATE TABLE IF NOT EXISTS `csr_usr_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `per_id_self` int(11) NOT NULL,
  `per_id_target` int(11) NOT NULL,
  `per_access_read` tinyint(1) NOT NULL,
  `per_access_write` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `csr_usr_permission`
--

INSERT INTO `csr_usr_permission` (`id`, `per_id_self`, `per_id_target`, `per_access_read`, `per_access_write`) VALUES
(1, 1, 2, 0, 1),
(2, 1, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `csr_usr_token`
--

CREATE TABLE IF NOT EXISTS `csr_usr_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tok_usr_id` int(11) NOT NULL,
  `tok_usr_ip` text COLLATE utf8_unicode_ci NOT NULL,
  `tok_epoch` int(11) NOT NULL,
  `tok_string` text COLLATE utf8_unicode_ci NOT NULL,
  `tok_valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Dumping data for table `csr_usr_token`
--

INSERT INTO `csr_usr_token` (`id`, `tok_usr_id`, `tok_usr_ip`, `tok_epoch`, `tok_string`, `tok_valid`) VALUES
(1, 36, '192.168.1.1', 1404919087, 'fb9b4c2df5ea278d07834be51e3131163d21093ebb2a6aeffe2127a3b3caf8cd', 0),
(2, 36, '192.168.1.1', 1404919146, '8cf1bbb41aa47df8001ce9f4fbeaf9662300ac4a751731323697e3009afac57c', 0),
(3, 36, '192.168.1.1', 1404919250, 'eebccd50e40f47a7901eaddaca8449420b560dbf572f637aa9d28cc5977d5b08', 0),
(4, 36, '192.168.1.1', 1404919403, 'c736f8a26712311b0a8245336185eaab117efdad709cab08f98e52e4717b2339', 0),
(5, 36, '192.168.1.1', 1404919526, 'f1208e74e4f3269b116084d7a5003cf732dc29dd7c2ca112894d1b3e94786826', 0),
(6, 36, '192.168.1.1', 1404921277, 'a8a7db9748a305dc69a4fc9da9a62bfa5ce7c1fe35d47e5a5f7e8b3a9a8682a3', 0),
(7, 36, '192.168.1.1', 1405199259, '23086f874af3d1a3f86935a5569a6beab33bc8cac241454ca5f89cfde0ee3006', 0),
(8, 36, '192.168.1.1', 1405321211, 'a8880fd3f2a07fffcde04f27a7730df1707d420eb1f8b2cae2c0ee12b272fb8d', 0),
(9, 36, '192.168.1.1', 1405322243, 'd2c3615a153b0538a65803ffe356b5536ea53a5a6bd740d9d2ecba66923697eb', 0),
(10, 36, '192.168.1.1', 1405322452, '9d3926c542809007025031e6c4152342b16915a0bdd88935e56421b1ef9af1c5', 0),
(11, 36, '192.168.1.1', 1405323475, '1681de270772263ec9862231e838882e62f9671f58ea6760514cb3b499418b9d', 0),
(12, 36, '192.168.1.1', 1405323900, '261c8bfa38fde8a59d186c2668fcb855d1008a4b244663df7f46f50488336bf0', 0),
(13, 36, '192.168.1.1', 1405324573, '9859e8e659f3d6a755d1be603ab0b880e53c3096f2d1d084ee9851c7446e69e6', 0),
(14, 36, '192.168.1.1', 1405325427, '9cc14450e78ca1d0edead9599fb64f5c234fba1b6fce4fddc777799def1e544f', 0),
(15, 36, '192.168.1.1', 1405325498, '285cd390b52d6a901f6075a44411296b274dd125f7d02756796426a1ff0f241a', 0),
(16, 36, '192.168.1.1', 1405329738, '2d04cc11af38fadc130d34224d4c0eb955f6190b7beed83989919cc9418a62f7', 0),
(17, 36, '192.168.1.1', 1405386665, 'a216e14d6626d5d763948bfdea7dcc438d732744a068e8feb6050fb993f8b73b', 0),
(18, 36, '192.100.106.9', 1405459455, 'dfb5a30d330bfe31f611ebc88fd1ff833870115afcd9488dce24de088da88428', 0),
(19, 36, '192.168.1.1', 1405473684, 'f01ebfee1052aed3b988c45a9adf976448f81539c32ed22df6f58588d28cef96', 0),
(20, 36, '192.168.1.1', 1405481719, 'cc5b584717461effcc3a57710ccec2e705b3a4e94755bfce03571bb43a30180a', 0),
(21, 36, '192.168.1.1', 1405486968, '74ff3eeef4964ce0bf0f4fd5d067648f70170fe47b68e94814556d9b2aff37c5', 0),
(22, 36, '192.100.106.9', 1405520134, '3136eec5ef752ebacd2d9148c0984605bca86b20948127e81ab87712f92d5060', 0),
(23, 36, '129.63.17.135', 1405522307, '778558da293d4bd40fe2b5fe57d767bc26556d83b25059aabee36aef1baf09ea', 0),
(24, 36, '129.63.17.135', 1405524921, 'c4fced8305d9f66099244382a9fafcdcefe18e8acef67ce6587ec1b3ba1269f9', 0),
(25, 36, '129.63.253.78', 1405525032, 'a0c5ae045a198803e781950ff1173ae5827a4fae5d8c70827e6bdfcaaf628ff1', 0),
(26, 36, '192.168.1.1', 1405553291, 'f4a1ac23ae067dc22cc2cc24f4625d0cb16824e4169ee498593b8e215a7b0510', 0),
(27, 36, '192.168.1.1', 1407281543, 'bc3a482c44a6ee831a511d9bc796af7a0229ff38304d8e9928cc3b697cc17b5d', 0),
(28, 41, '50.189.162.96', 1411464494, 'b1cda18c7933e09f1885b3e5300aa3ed5f51b58bbaac91a9a022525b0cd259fa', 0),
(29, 41, '129.63.253.96', 1414624606, '5aa7aff73618e277b2fa50ab55c9addc21af981fdf0ef4c405b31dd03a5ecbdf', 0),
(30, 41, '192.168.1.1', 1414633537, '8df0751c73b4a5b581868f7864876b38f6446342ea54897774937c7e5c131415', 0),
(31, 41, '129.63.153.44', 1414685000, '28807cd806f5253ef59858af47290d17f881ba0fa156ddd4e9af811128daf1d5', 0),
(32, 41, '192.168.1.1', 1417209471, 'd7ab22838eb81b182314baee395b7a084cd13d4f7cf99f369578cd4511e8bed8', 0),
(33, 41, '192.168.1.1', 1417227693, '931477a08ffb20ae366a5b4d31a872f7554997e4f06f066b890c6b83acb17d3e', 0),
(34, 41, '192.168.1.1', 1417232205, '7f19c3beb7dae82190938fa92756ef72d8c222c869419abb80b4d54b3801c3e4', 0),
(35, 41, '192.168.1.1', 1417246073, '4e330ecc8648fb267c8bfd8f42f1e9590a6198ba84f9c954025c22ffb1875ded', 0),
(36, 41, '192.168.1.1', 1417311950, 'a11b68a3cbc41d5220b0e0e65c1b4cf6bf41658c6052d47a762e5b7d2373d577', 0),
(37, 41, '192.168.1.1', 1417315797, '058e67d63d04dd8c80f03efe9abb19d51b5e40821c863c487546af135c580f13', 0),
(38, 41, '192.168.1.1', 1417327487, 'b66a0cc0bff7b914f9b5679acef93710974fbf15903109567e1ca87d395570de', 0),
(39, 41, '192.168.1.1', 1417330255, 'a76cf956e3dd39bd000464cc793274b29b54aabf409ed86c129c6fb1f197e4c5', 0),
(40, 41, '192.168.1.1', 1417333160, 'dcac639fc7b0e51a54bd48a9ceb03a86f7989ed2a529fd02ff13254b06548b04', 0),
(41, 41, '192.168.1.1', 1417334695, '5b68cca5a6bc75e10a4e91323f66624ebf2f08c32365cf5ad0520f5f17022001', 0),
(42, 41, '192.168.1.1', 1417335977, 'fa2e576851f0005e112509924f353c359c582eb92eda3f2011d7ddb7382b5aa1', 0),
(43, 41, '192.168.1.1', 1417347390, '83f145c09940f4a8f44e9db4909e9680ae7f59a9bd5a044fc5d4eb86b8603751', 0),
(44, 41, '192.168.1.1', 1417350424, '7610aeae040f1f8371e7d6c6613822c747114513385a73958424a55c0101da2c', 0),
(45, 36, '192.168.1.1', 1417955507, 'e5935eafc684dcc59643dc220ab213af51c06feeee02ab420d39a15130b80ef5', 0),
(46, 36, '192.168.1.1', 1417957169, 'd84bc3cf85f61972e6e2a4961f5fa299ec81c2445cf8ce44fd57c70c39035445', 0),
(47, 41, '192.168.1.1', 1417961062, 'd80b725ffb76760583fbd9cb0a2a6db2453a9c1f2780e9231c13d4097454fdde', 0),
(48, 36, '192.168.1.1', 1417963416, '9a2bbb3b7a74bdbc3be0807297a6c94b1db537ec6fd9805cb6a07550b22c97a2', 0),
(49, 41, '192.168.1.1', 1417969211, 'd92e750963c2c098ef60600782e171c180c85b702a0a52802e3c1fd8ad5e9b7d', 0),
(50, 36, '192.168.1.1', 1417972181, '7977a032ceca7b380827c59bbb9c0abaf8fa43b4d48f2d2ba270fe3977d7c2f6', 0),
(51, 41, '192.168.1.1', 1417980279, 'fc8c24a510ba6d6ec777e48624422f1f3b2a9425e3711439d67414a1fa6e6211', 0),
(52, 41, '192.168.1.1', 1418000681, 'a3366eea01d14b18ad2504a85e9d4ea8e7d2c84bdd30dff136ede880f59cd544', 0),
(53, 41, '192.168.1.1', 1418002359, '7bf3aa128c8a748744ea38a1f59d327fc58a49ec9c3e7311442b3549e9b222fd', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
