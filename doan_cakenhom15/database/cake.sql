-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 15, 2021 at 08:15 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufactures`
--

DROP TABLE IF EXISTS `manufactures`;
CREATE TABLE IF NOT EXISTS `manufactures` (
  `manu_id` int(11) NOT NULL AUTO_INCREMENT,
  `manu_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`manu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `manufactures`
--

INSERT INTO `manufactures` (`manu_id`, `manu_name`) VALUES
(1, 'Bánh ngọt'),
(2, 'Bánh kem'),
(3, 'Kem plan'),
(4, 'Carament'),
(5, 'pudding'),
(6, 'Phô mai');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customerid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `customerid`) VALUES
(4, '2021-11-18 05:46:09', 22),
(5, '2021-11-18 10:39:51', 10),
(6, '2021-11-18 20:19:30', 23),
(7, '2021-11-18 20:41:28', 24),
(8, '2021-11-18 21:17:08', 25),
(9, '2021-11-18 22:05:07', 26),
(10, '2021-11-18 22:16:58', 27),
(11, '2021-11-26 00:00:00', 28),
(12, '2021-12-15 11:54:01', 29),
(13, '2021-12-15 11:57:45', 30),
(14, '2021-12-15 11:58:28', 31),
(15, '2021-12-15 14:26:45', 34);

-- --------------------------------------------------------

--
-- Table structure for table `ordersdetail`
--

DROP TABLE IF EXISTS `ordersdetail`;
CREATE TABLE IF NOT EXISTS `ordersdetail` (
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordersdetail`
--

INSERT INTO `ordersdetail` (`orderid`, `productid`, `quantity`, `price`) VALUES
(4, 115, 5, 325000),
(4, 123, 19, 2337),
(5, 92, 9, 1430000),
(5, 113, 2, 70000),
(5, 101, 1, 89000),
(6, 123, 3, 369),
(7, 92, 2, 260000),
(7, 115, 3, 195000),
(9, 92, 1, 38000),
(10, 92, 21, 798000),
(10, 91, 1, 122000),
(10, 81, 1, 26000),
(11, 82, 10, 675000),
(12, 81, 1, 26000),
(15, 78, 1, 65000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `manu_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `pro_image` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `feature` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `receipt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `manu_id`, `type_id`, `price`, `pro_image`, `description`, `feature`, `receipt`) VALUES
(82, 'Bánh dâu vị carament', 4, 1, 27000, 'c-feature-1.jpg', 'Bánh chứa hương vị đặc trưng từ lớp kem và tạo hình dễ thương', 0, 100),
(81, 'Bánh kem matcha', 4, 1, 26000, 'c-feature-2.jpg', 'Bánh vị ngon thanh mát, thơm mùi trà xanh được trang trí theo dạng Layer. Rất phù hợp với những bạn thích ăn nhiều bánh ít kem. Thơm ngon mà không ngán!', 0, 100),
(78, 'Bánh socola', 3, 1, 65000, 'c-feature-3.jpg', 'Bánh chứa hương vị đặc biệt của vị socola', 0, 100),
(76, 'Bánh gato nướng', 2, 1, 28000, 'banhgato.jpg', 'Cupcake còn có tên gọi khác là banh 1234 với thành phần nguyên liệu chính là 1 cup bơ, 2 cup đường, 3 cup bột mì, 4 quả trứng gà.', 0, 100),
(73, 'Bánh Socola mềm ', 2, 1, 88000, 'c-feature-5.jpg', 'Đặc trưng của loại bánh này là lớp nhân socola mềm và tươi mát.', 1, 100),
(71, 'Bánh kem dâu tươi', 2, 1, 269000, 'c-feature-6.jpg', 'Bánh được trang trí độc đáo, tạo hình các bông hoa bằng kem và có vị dâu thơm ngon', 1, 100),
(89, 'Bánh sừng bò', 1, 4, 22000, 'banhsungbo.jpg', 'Bánh sừng bò rất nổi tiếng ở Pháp, tuy nhiên nguồn gốc của nó là từ Áo. Loại bánh này còn có tên gọi khác là bánh con cua, với thành phần nguyên liệu làm từ bột mì, sữa, bơ, men và muối', 1, 100),
(90, 'Bánh Muffin', 1, 4, 58000, 'muffin.jpg', 'bánh thường được tạo hình trong những chiếc cốc giấy xinh xắn với nhân mặn hoặc ngọt', 1, 100),
(91, 'Bánh Coffee cake', 4, 2, 122000, 'coffee.jpg', 'bánh rất thích hợp để phục vụ trong các buổi tiệc trà… được tạo hình trong khuôn tròn, vuông hoặc hình chữ nhật.', 1, 100),
(92, 'Bánh Crepes', 5, 3, 38000, 'crepe.jpg', 'bánh crepes thơm ngon và ấn tượng với những hương vị đặc biệt thu hút.', 1, 100),
(100, 'Bánh flan', 5, 2, 25000, 'flan2.jpg', 'Loại bánh được chế biến từ việc hấp chín với các nguyên liệu chính là trứng và sữa, nước caramen được gọi là bánh flan', 1, 100),
(101, 'Bánh Donut', 1, 2, 89000, 'ngot1.png', 'Bánh Donut được làm bằng socola, đường, kẹo, hạt hạnh nhân...với nhiều màu sắc bắt mắt.', 0, 100),
(102, 'Bánh Cheesecake', 6, 2, 120000, 'ngot2.jpg', 'Cheesecake hay còn được gọi là bánh kem phô mai, dù được biến tấu với nhiều phiên bản khác nhau nhưng thành phần chính không thể thiếu cream cheese.', 1, 100),
(103, 'Bánh Mousse', 4, 4, 59000, 'ngot3.jpg', 'Mousse là loại bánh chuyên dùng để tráng miệng với phần bánh gato mỏng bên dưới, bên trên là lớp kem chanh leo – cam, chocolate, caramel… mềm mại, mát lạnh.', 1, 100),
(105, 'Bánh Tiramisu', 2, 3, 67000, 'ngot4.jpg', 'Tiramisu là loại bánh tráng miệng nổi tiếng của người Ý với vị bánh mềm ẩm, ngọt thanh nhẹ nhàng. Bánh quy Savoiardi, cà phê, phô mai Mascarpone, rượu Rhum, trứng, đường là những nguyên liệu thành phần làm nên bánh tiramisu.', 0, 100),
(106, 'Bánh Pound cake', 3, 2, 119000, 'ngot5.jpg', 'Pound cake có hàm lượng chất béo, độ ngọt và bông xốp cao – được tạo hình với khuôn loaf hoặc bundt.', 1, 100),
(107, 'Bánh Tart', 2, 3, 62000, 'kem1.jpg', 'Bánh Tart được xem là “anh em họ” của bánh Pie, nhưng khác nhau ở cách tạo hình. Bánh Tart không có phần vỏ trên – được trang trí bằng kem tươi hoặc trái cây.', 1, 100),
(108, 'Bánh Pancake', 4, 4, 129000, 'kem2.png', 'Bánh Pancake được làm chín bằng cách tráng một lớp dầu ăn mỏng hoặc quét một lớp bơ lên mặt chào, sau đó cho bột vào – tạo hình dẹt, tròn. Bánh được ăn kèm với mật ong – các loại trái cây tươi hoặc các loại mứt trái cây.', 1, 100),
(109, 'Bánh Strawberry', 2, 1, 112000, 'kem3.jpg', 'Bánh xếp xen kẽ giữa kem và dâu tạo nên hương thêm đặc trưng', 0, 100),
(110, 'Bánh Black Forest', 2, 1, 350000, 'kem4.jpg', 'Bánh Black Forest của Đức có phần chocolate ẩm và kem tươi xốp xen các lớp trái anh đào. Người Đức cũng thêm vào loại rượu từ quả anh đào tên là Kirsch Wasser, giúp vị ngọt của bánh dịu đi.', 0, 100),
(111, 'Bánh Cupcake', 2, 1, 78000, 'kem5.jpg\r\n', 'Bánh dạng nhỏ dùng như một khẩu phần, bánh thường được bao quanh bởi lớp giấy hình cốc xinh xắn, đẹp mắt', 0, 100),
(112, 'Bánh Chiffon', 4, 3, 169000, 'cara1.jpg', 'Bánh chiffon có sử dụng dầu ăn để làm thành phần chất béo trong bánh. Cả lòng trắng và lòng đỏ đều được sử dụng nhưng tách riêng trong quá trình làm.', 1, 100),
(113, 'Bánh Flan Dâu Tằm', 3, 4, 35000, 'flan2.jpg', 'bánh được hấp chín từ các nguyên liệu chính là trứng, sữa và hương thơm của dâu tằm', 1, 100),
(114, 'Bánh Makowiec', 4, 4, 180000, 'trangmieng1.jpg', 'Makowiec là một loại bánh cuộn men ngọt được làm bằng hạt hoa anh túc và có khi cũng được phủ bằng kem.', 0, 100),
(115, 'Bánh Brigadeiros', 4, 3, 65000, 'trangmieng2.jpg', 'Brigadeiros là món tráng miệng được chế biến bằng socola bột, sữa đặc và bơ. Bánh có thể được ăn như một khối hỗn hợp nấu chín hoặc có khi được đúc thành từng quả bóng tròn nhỏ bọc đường hạt bên ngoài.', 1, 100),
(125, 'bánh mật ong', 3, 2, 100000, '121711024_339544657131978_1282124594380599009_n.jpg', 'Ngon', 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `protypes`
--

DROP TABLE IF EXISTS `protypes`;
CREATE TABLE IF NOT EXISTS `protypes` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `protypes`
--

INSERT INTO `protypes` (`type_id`, `type_name`) VALUES
(1, 'Bánh sinh nhật'),
(2, 'Bánh kem mềm'),
(3, 'Bánh tự chọn'),
(4, 'Bánh có sẵn ');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `reviewer_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reviewer_email` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `reviewer_name`, `reviewer_email`, `content`, `created_at`) VALUES
(3, 102, 'khuong', 'khuong@gmail.com', 'bánh rất ngon và bổ rẻ', '2021-12-15 11:44:31'),
(2, 82, 'trieu', 'an@gmail.com', 'so great!', '2021-12-15 11:44:01'),
(1, 81, 'ngan', 'ngan@gmail.com', 'great!', '2021-12-15 11:43:07'),
(11, 91, 'haitrieu', 'haitrieu@gmail.com', 'bánh tuyệt vời !', '2021-12-15 14:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permission`) VALUES
(31, 'admin', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin'),
(32, 'khuong123', '8cf98e104884d57c510098a7901b96c9', 'User'),
(29, 'ngan26', '066fa3a206e9341bcec27649a2e9010b', 'Admin'),
(33, 'trieu123', '79a05176048cfa33e7fd67ac2bc463fb', 'User'),
(34, 'haitrieu', '79a05176048cfa33e7fd67ac2bc463fb', 'User');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
