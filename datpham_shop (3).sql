-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 04:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datpham_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `user_id`, `money`, `created_at`) VALUES
(165, 21, 21000, '2021-10-20 10:41:24'),
(166, 26, 153000, '2021-10-22 07:22:28'),
(230, 26, 99000, '2021-10-23 08:30:13'),
(231, 26, 87000, '2021-10-23 08:31:35'),
(232, 26, 550000, '2021-10-28 09:01:48'),
(233, 18, 1026000, '2021-11-03 10:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `bills_products`
--

CREATE TABLE `bills_products` (
  `bill_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `bill_product_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills_products`
--

INSERT INTO `bills_products` (`bill_product_id`, `product_id`, `user_id`, `bill_id`, `bill_product_amount`) VALUES
(255, 1, 21, 165, 1),
(256, 1, 26, 166, 5),
(257, 13, 26, 166, 4),
(311, 12, 26, 230, 3),
(312, 13, 26, 230, 5),
(313, 1, 26, 231, 3),
(314, 13, 26, 231, 2),
(315, 14, 26, 232, 2),
(316, 12, 18, 233, 2),
(317, 15, 18, 233, 5);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catedory_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catedory_id`, `category_name`) VALUES
(2, 'hoa quả'),
(3, 'thịt'),
(4, 'hải sản');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL,
  `new_title` varchar(255) NOT NULL,
  `new_image` varchar(255) NOT NULL,
  `new_description` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `new_short_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`new_id`, `new_title`, `new_image`, `new_description`, `created_at`, `updated_at`, `new_short_description`) VALUES
(1, 'Sản phẩm bò Kobe thăn lưng', '1634296488_7.jpg', '<p><strong>Kobe thăn lưng đầu A5 -&nbsp; Ribeye</strong></p><p>Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.</p><p>Thăn lưng đầu A5 - Ribeye là phần thịt rất dày, có các mắt mỡ và phần mỡ dắt nhiều hơn các phần thịt khác.&nbsp;</p><p><strong>Cách dùng:&nbsp;</strong></p><p>Phần thịt này lý tưởng cho các món ăn như áp chảo, steak, nướng yakiniku</p><p>Bảo quản ngăn đông tủ lạnh khi chưa dùng đến</p><p>&nbsp;</p><p><strong>Nguồn gốc, xuất xứ:</strong></p><p>Thịt bò Kobe nhập khẩu trực tiếp từ nhà cung cấp S-Foods, Nhật Bản; S-Foods&nbsp;là tập đoàn hoạt động trong lĩnh vực xuất khẩu thịt bò Nhật, chiếm 99% thị phần thịt bò Kobe, xuất khẩu trên khắp thế giới.</p><p>&nbsp;</p><p>BioFarm nhập loại thịt bò Kobe có điểm vân mỡ mức 8-9 để phù hợp với sở thích và thói quen của người tiêu dùng Việt Nam và xin khẳng định rằng là loại thịt bò Kobe cao cấp nhất theo tiêu chuẩn đánh giá mà Chính phủ Nhật Bản đưa ra.</p><p>&nbsp;</p><p>Thịt bò Kobe được cho là một trong những loại thịt đắt đỏ nhất thế giới bởi nguồn cung ít ỏi, chi phí chăm sóc cao cũng như chất lượng thơm ngon hiếm có.&nbsp;</p><p>&nbsp;</p><p><strong>Cách tra mã ID của miếng thịt bò Kobe:</strong></p><p>&nbsp;</p><p>Trên mỗi miếng thịt bò Kobe đều có 1 tem dán thể hiện thông tin nguồn gốc xuất xứ của miếng thịt đó như: loại thịt gì, nhà máy cắt mổ, sơ chế, trọng lượng… và đặc biệt là có số ID của con bò được giết mổ. Số ID này rất quan trọng vì toàn bộ thông tin về nguồn gốc xuất xứ của con bò có ID này sẽ được thể hiện một cách rõ ràng, minh bạch.</p><p>&nbsp;</p><p>Chúng ta truy cập vào địa chỉ website của Hiệp hội bò Kobe:&nbsp;<a href=\"http://www.kobe-niku.jp/en/contents/certification/index.html\">http://www.kobe-niku.jp/en/contents/certification/index.html</a></p><p>Sau đó click vào nút System bên dưới. Nhập dãy số ID trên tem xuất xứ của miếng thịt vào ô trắng, sau đó ấn Search.</p><p>&nbsp;</p><p>Nếu số ID đó là của thịt bò Kobe chuẩn nguồn gốc sẽ hiện ra bảng thông tin chi tiết về con bò được giết mổ như: thời gian sinh, thời gian giết mổ, tên người nông dân nuôi dưỡng, người nông dân chăm sóc hàng ngày, và đặc biệt là có thể truy xuất nguồn gốc 3 đời của con bò được giết mổ.</p><p>&nbsp;</p><p><img src=\"https://bioplanet.vn/wp-content/uploads/2020/08/A%CC%89nh-chu%CC%A3p-Ma%CC%80n-hi%CC%80nh-2020-08-04-lu%CC%81c-17.03.36-725x400.png\" alt=\"\" srcset=\"https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-725x400.png 725w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1400x773.png 1400w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-768x424.png 768w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1536x848.png 1536w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-2048x1130.png 2048w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-24x13.png 24w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-36x20.png 36w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-48x26.png 48w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-600x331.png 600w\" sizes=\"100vw\"></p><p><strong>Dấu “Bông cúc Nhật Bản” chỉ được đóng lên những con bò được chính thức công nhận là bò Kobe.&nbsp;</strong></p><p>&nbsp; &nbsp; &nbsp; Mỗi lát cắt bò Kobe với những đường vân mỡ tuyệt đẹp như một<strong>&nbsp;</strong>miếng đá cẩm thạch, hương thơm quyến rũ, vị béo quyện cùng với những thớ thịt mượt mà như<strong>&nbsp;</strong>bơ tan dần trong miệng đã làm cho thịt bò Kobe được xếp vào hàng “cực phẩm”. Những ai từng thưởng thức loại thịt này đều xác nhận: Đó không chỉ là một loại thực phẩm, mà là trải nghiệm ẩm thực không thể nào quên!</p>', '2021-10-15', '2021-10-15', 'Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.'),
(4, 'Sản phẩm bò Kobe thăn lưng', '1634296488_7.jpg', '<p><strong>Kobe thăn lưng đầu A5 -&nbsp; Ribeye</strong></p><p>Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.</p><p>Thăn lưng đầu A5 - Ribeye là phần thịt rất dày, có các mắt mỡ và phần mỡ dắt nhiều hơn các phần thịt khác.&nbsp;</p><p><strong>Cách dùng:&nbsp;</strong></p><p>Phần thịt này lý tưởng cho các món ăn như áp chảo, steak, nướng yakiniku</p><p>Bảo quản ngăn đông tủ lạnh khi chưa dùng đến</p><p>&nbsp;</p><p><strong>Nguồn gốc, xuất xứ:</strong></p><p>Thịt bò Kobe nhập khẩu trực tiếp từ nhà cung cấp S-Foods, Nhật Bản; S-Foods&nbsp;là tập đoàn hoạt động trong lĩnh vực xuất khẩu thịt bò Nhật, chiếm 99% thị phần thịt bò Kobe, xuất khẩu trên khắp thế giới.</p><p>&nbsp;</p><p>BioFarm nhập loại thịt bò Kobe có điểm vân mỡ mức 8-9 để phù hợp với sở thích và thói quen của người tiêu dùng Việt Nam và xin khẳng định rằng là loại thịt bò Kobe cao cấp nhất theo tiêu chuẩn đánh giá mà Chính phủ Nhật Bản đưa ra.</p><p>&nbsp;</p><p>Thịt bò Kobe được cho là một trong những loại thịt đắt đỏ nhất thế giới bởi nguồn cung ít ỏi, chi phí chăm sóc cao cũng như chất lượng thơm ngon hiếm có.&nbsp;</p><p>&nbsp;</p><p><strong>Cách tra mã ID của miếng thịt bò Kobe:</strong></p><p>&nbsp;</p><p>Trên mỗi miếng thịt bò Kobe đều có 1 tem dán thể hiện thông tin nguồn gốc xuất xứ của miếng thịt đó như: loại thịt gì, nhà máy cắt mổ, sơ chế, trọng lượng… và đặc biệt là có số ID của con bò được giết mổ. Số ID này rất quan trọng vì toàn bộ thông tin về nguồn gốc xuất xứ của con bò có ID này sẽ được thể hiện một cách rõ ràng, minh bạch.</p><p>&nbsp;</p><p>Chúng ta truy cập vào địa chỉ website của Hiệp hội bò Kobe:&nbsp;<a href=\"http://www.kobe-niku.jp/en/contents/certification/index.html\">http://www.kobe-niku.jp/en/contents/certification/index.html</a></p><p>Sau đó click vào nút System bên dưới. Nhập dãy số ID trên tem xuất xứ của miếng thịt vào ô trắng, sau đó ấn Search.</p><p>&nbsp;</p><p>Nếu số ID đó là của thịt bò Kobe chuẩn nguồn gốc sẽ hiện ra bảng thông tin chi tiết về con bò được giết mổ như: thời gian sinh, thời gian giết mổ, tên người nông dân nuôi dưỡng, người nông dân chăm sóc hàng ngày, và đặc biệt là có thể truy xuất nguồn gốc 3 đời của con bò được giết mổ.</p><p>&nbsp;</p><p><img src=\"https://bioplanet.vn/wp-content/uploads/2020/08/A%CC%89nh-chu%CC%A3p-Ma%CC%80n-hi%CC%80nh-2020-08-04-lu%CC%81c-17.03.36-725x400.png\" alt=\"\" srcset=\"https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-725x400.png 725w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1400x773.png 1400w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-768x424.png 768w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1536x848.png 1536w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-2048x1130.png 2048w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-24x13.png 24w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-36x20.png 36w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-48x26.png 48w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-600x331.png 600w\" sizes=\"100vw\"></p><p><strong>Dấu “Bông cúc Nhật Bản” chỉ được đóng lên những con bò được chính thức công nhận là bò Kobe.&nbsp;</strong></p><p>&nbsp; &nbsp; &nbsp; Mỗi lát cắt bò Kobe với những đường vân mỡ tuyệt đẹp như một<strong>&nbsp;</strong>miếng đá cẩm thạch, hương thơm quyến rũ, vị béo quyện cùng với những thớ thịt mượt mà như<strong>&nbsp;</strong>bơ tan dần trong miệng đã làm cho thịt bò Kobe được xếp vào hàng “cực phẩm”. Những ai từng thưởng thức loại thịt này đều xác nhận: Đó không chỉ là một loại thực phẩm, mà là trải nghiệm ẩm thực không thể nào quên!</p>', '2021-10-15', '2021-10-15', 'Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.'),
(5, 'Sản phẩm bò Kobe thăn lưng', '1634296488_7.jpg', '<p><strong>Kobe thăn lưng đầu A5 -&nbsp; Ribeye</strong></p><p>Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.</p><p>Thăn lưng đầu A5 - Ribeye là phần thịt rất dày, có các mắt mỡ và phần mỡ dắt nhiều hơn các phần thịt khác.&nbsp;</p><p><strong>Cách dùng:&nbsp;</strong></p><p>Phần thịt này lý tưởng cho các món ăn như áp chảo, steak, nướng yakiniku</p><p>Bảo quản ngăn đông tủ lạnh khi chưa dùng đến</p><p>&nbsp;</p><p><strong>Nguồn gốc, xuất xứ:</strong></p><p>Thịt bò Kobe nhập khẩu trực tiếp từ nhà cung cấp S-Foods, Nhật Bản; S-Foods&nbsp;là tập đoàn hoạt động trong lĩnh vực xuất khẩu thịt bò Nhật, chiếm 99% thị phần thịt bò Kobe, xuất khẩu trên khắp thế giới.</p><p>&nbsp;</p><p>BioFarm nhập loại thịt bò Kobe có điểm vân mỡ mức 8-9 để phù hợp với sở thích và thói quen của người tiêu dùng Việt Nam và xin khẳng định rằng là loại thịt bò Kobe cao cấp nhất theo tiêu chuẩn đánh giá mà Chính phủ Nhật Bản đưa ra.</p><p>&nbsp;</p><p>Thịt bò Kobe được cho là một trong những loại thịt đắt đỏ nhất thế giới bởi nguồn cung ít ỏi, chi phí chăm sóc cao cũng như chất lượng thơm ngon hiếm có.&nbsp;</p><p>&nbsp;</p><p><strong>Cách tra mã ID của miếng thịt bò Kobe:</strong></p><p>&nbsp;</p><p>Trên mỗi miếng thịt bò Kobe đều có 1 tem dán thể hiện thông tin nguồn gốc xuất xứ của miếng thịt đó như: loại thịt gì, nhà máy cắt mổ, sơ chế, trọng lượng… và đặc biệt là có số ID của con bò được giết mổ. Số ID này rất quan trọng vì toàn bộ thông tin về nguồn gốc xuất xứ của con bò có ID này sẽ được thể hiện một cách rõ ràng, minh bạch.</p><p>&nbsp;</p><p>Chúng ta truy cập vào địa chỉ website của Hiệp hội bò Kobe:&nbsp;<a href=\"http://www.kobe-niku.jp/en/contents/certification/index.html\">http://www.kobe-niku.jp/en/contents/certification/index.html</a></p><p>Sau đó click vào nút System bên dưới. Nhập dãy số ID trên tem xuất xứ của miếng thịt vào ô trắng, sau đó ấn Search.</p><p>&nbsp;</p><p>Nếu số ID đó là của thịt bò Kobe chuẩn nguồn gốc sẽ hiện ra bảng thông tin chi tiết về con bò được giết mổ như: thời gian sinh, thời gian giết mổ, tên người nông dân nuôi dưỡng, người nông dân chăm sóc hàng ngày, và đặc biệt là có thể truy xuất nguồn gốc 3 đời của con bò được giết mổ.</p><p>&nbsp;</p><p><img src=\"https://bioplanet.vn/wp-content/uploads/2020/08/A%CC%89nh-chu%CC%A3p-Ma%CC%80n-hi%CC%80nh-2020-08-04-lu%CC%81c-17.03.36-725x400.png\" alt=\"\" srcset=\"https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-725x400.png 725w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1400x773.png 1400w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-768x424.png 768w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1536x848.png 1536w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-2048x1130.png 2048w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-24x13.png 24w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-36x20.png 36w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-48x26.png 48w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-600x331.png 600w\" sizes=\"100vw\"></p><p><strong>Dấu “Bông cúc Nhật Bản” chỉ được đóng lên những con bò được chính thức công nhận là bò Kobe.&nbsp;</strong></p><p>&nbsp; &nbsp; &nbsp; Mỗi lát cắt bò Kobe với những đường vân mỡ tuyệt đẹp như một<strong>&nbsp;</strong>miếng đá cẩm thạch, hương thơm quyến rũ, vị béo quyện cùng với những thớ thịt mượt mà như<strong>&nbsp;</strong>bơ tan dần trong miệng đã làm cho thịt bò Kobe được xếp vào hàng “cực phẩm”. Những ai từng thưởng thức loại thịt này đều xác nhận: Đó không chỉ là một loại thực phẩm, mà là trải nghiệm ẩm thực không thể nào quên!</p>', '2021-10-15', '2021-10-15', 'Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.'),
(6, 'Sản phẩm bò Kobe thăn lưng', '1634296488_7.jpg', '<p><strong>Kobe thăn lưng đầu A5 -&nbsp; Ribeye</strong></p><p>Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.</p><p>Thăn lưng đầu A5 - Ribeye là phần thịt rất dày, có các mắt mỡ và phần mỡ dắt nhiều hơn các phần thịt khác.&nbsp;</p><p><strong>Cách dùng:&nbsp;</strong></p><p>Phần thịt này lý tưởng cho các món ăn như áp chảo, steak, nướng yakiniku</p><p>Bảo quản ngăn đông tủ lạnh khi chưa dùng đến</p><p>&nbsp;</p><p><strong>Nguồn gốc, xuất xứ:</strong></p><p>Thịt bò Kobe nhập khẩu trực tiếp từ nhà cung cấp S-Foods, Nhật Bản; S-Foods&nbsp;là tập đoàn hoạt động trong lĩnh vực xuất khẩu thịt bò Nhật, chiếm 99% thị phần thịt bò Kobe, xuất khẩu trên khắp thế giới.</p><p>&nbsp;</p><p>BioFarm nhập loại thịt bò Kobe có điểm vân mỡ mức 8-9 để phù hợp với sở thích và thói quen của người tiêu dùng Việt Nam và xin khẳng định rằng là loại thịt bò Kobe cao cấp nhất theo tiêu chuẩn đánh giá mà Chính phủ Nhật Bản đưa ra.</p><p>&nbsp;</p><p>Thịt bò Kobe được cho là một trong những loại thịt đắt đỏ nhất thế giới bởi nguồn cung ít ỏi, chi phí chăm sóc cao cũng như chất lượng thơm ngon hiếm có.&nbsp;</p><p>&nbsp;</p><p><strong>Cách tra mã ID của miếng thịt bò Kobe:</strong></p><p>&nbsp;</p><p>Trên mỗi miếng thịt bò Kobe đều có 1 tem dán thể hiện thông tin nguồn gốc xuất xứ của miếng thịt đó như: loại thịt gì, nhà máy cắt mổ, sơ chế, trọng lượng… và đặc biệt là có số ID của con bò được giết mổ. Số ID này rất quan trọng vì toàn bộ thông tin về nguồn gốc xuất xứ của con bò có ID này sẽ được thể hiện một cách rõ ràng, minh bạch.</p><p>&nbsp;</p><p>Chúng ta truy cập vào địa chỉ website của Hiệp hội bò Kobe:&nbsp;<a href=\"http://www.kobe-niku.jp/en/contents/certification/index.html\">http://www.kobe-niku.jp/en/contents/certification/index.html</a></p><p>Sau đó click vào nút System bên dưới. Nhập dãy số ID trên tem xuất xứ của miếng thịt vào ô trắng, sau đó ấn Search.</p><p>&nbsp;</p><p>Nếu số ID đó là của thịt bò Kobe chuẩn nguồn gốc sẽ hiện ra bảng thông tin chi tiết về con bò được giết mổ như: thời gian sinh, thời gian giết mổ, tên người nông dân nuôi dưỡng, người nông dân chăm sóc hàng ngày, và đặc biệt là có thể truy xuất nguồn gốc 3 đời của con bò được giết mổ.</p><p>&nbsp;</p><p><img src=\"https://bioplanet.vn/wp-content/uploads/2020/08/A%CC%89nh-chu%CC%A3p-Ma%CC%80n-hi%CC%80nh-2020-08-04-lu%CC%81c-17.03.36-725x400.png\" alt=\"\" srcset=\"https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-725x400.png 725w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1400x773.png 1400w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-768x424.png 768w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1536x848.png 1536w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-2048x1130.png 2048w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-24x13.png 24w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-36x20.png 36w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-48x26.png 48w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-600x331.png 600w\" sizes=\"100vw\"></p><p><strong>Dấu “Bông cúc Nhật Bản” chỉ được đóng lên những con bò được chính thức công nhận là bò Kobe.&nbsp;</strong></p><p>&nbsp; &nbsp; &nbsp; Mỗi lát cắt bò Kobe với những đường vân mỡ tuyệt đẹp như một<strong>&nbsp;</strong>miếng đá cẩm thạch, hương thơm quyến rũ, vị béo quyện cùng với những thớ thịt mượt mà như<strong>&nbsp;</strong>bơ tan dần trong miệng đã làm cho thịt bò Kobe được xếp vào hàng “cực phẩm”. Những ai từng thưởng thức loại thịt này đều xác nhận: Đó không chỉ là một loại thực phẩm, mà là trải nghiệm ẩm thực không thể nào quên!</p>', '2021-10-15', '2021-10-15', 'Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.'),
(7, 'Sản phẩm bò Kobe thăn lưng', '1634296488_7.jpg', '<p><strong>Kobe thăn lưng đầu A5 -&nbsp; Ribeye</strong></p><p>Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.</p><p>Thăn lưng đầu A5 - Ribeye là phần thịt rất dày, có các mắt mỡ và phần mỡ dắt nhiều hơn các phần thịt khác.&nbsp;</p><p><strong>Cách dùng:&nbsp;</strong></p><p>Phần thịt này lý tưởng cho các món ăn như áp chảo, steak, nướng yakiniku</p><p>Bảo quản ngăn đông tủ lạnh khi chưa dùng đến</p><p>&nbsp;</p><p><strong>Nguồn gốc, xuất xứ:</strong></p><p>Thịt bò Kobe nhập khẩu trực tiếp từ nhà cung cấp S-Foods, Nhật Bản; S-Foods&nbsp;là tập đoàn hoạt động trong lĩnh vực xuất khẩu thịt bò Nhật, chiếm 99% thị phần thịt bò Kobe, xuất khẩu trên khắp thế giới.</p><p>&nbsp;</p><p>BioFarm nhập loại thịt bò Kobe có điểm vân mỡ mức 8-9 để phù hợp với sở thích và thói quen của người tiêu dùng Việt Nam và xin khẳng định rằng là loại thịt bò Kobe cao cấp nhất theo tiêu chuẩn đánh giá mà Chính phủ Nhật Bản đưa ra.</p><p>&nbsp;</p><p>Thịt bò Kobe được cho là một trong những loại thịt đắt đỏ nhất thế giới bởi nguồn cung ít ỏi, chi phí chăm sóc cao cũng như chất lượng thơm ngon hiếm có.&nbsp;</p><p>&nbsp;</p><p><strong>Cách tra mã ID của miếng thịt bò Kobe:</strong></p><p>&nbsp;</p><p>Trên mỗi miếng thịt bò Kobe đều có 1 tem dán thể hiện thông tin nguồn gốc xuất xứ của miếng thịt đó như: loại thịt gì, nhà máy cắt mổ, sơ chế, trọng lượng… và đặc biệt là có số ID của con bò được giết mổ. Số ID này rất quan trọng vì toàn bộ thông tin về nguồn gốc xuất xứ của con bò có ID này sẽ được thể hiện một cách rõ ràng, minh bạch.</p><p>&nbsp;</p><p>Chúng ta truy cập vào địa chỉ website của Hiệp hội bò Kobe:&nbsp;<a href=\"http://www.kobe-niku.jp/en/contents/certification/index.html\">http://www.kobe-niku.jp/en/contents/certification/index.html</a></p><p>Sau đó click vào nút System bên dưới. Nhập dãy số ID trên tem xuất xứ của miếng thịt vào ô trắng, sau đó ấn Search.</p><p>&nbsp;</p><p>Nếu số ID đó là của thịt bò Kobe chuẩn nguồn gốc sẽ hiện ra bảng thông tin chi tiết về con bò được giết mổ như: thời gian sinh, thời gian giết mổ, tên người nông dân nuôi dưỡng, người nông dân chăm sóc hàng ngày, và đặc biệt là có thể truy xuất nguồn gốc 3 đời của con bò được giết mổ.</p><p>&nbsp;</p><p><img src=\"https://bioplanet.vn/wp-content/uploads/2020/08/A%CC%89nh-chu%CC%A3p-Ma%CC%80n-hi%CC%80nh-2020-08-04-lu%CC%81c-17.03.36-725x400.png\" alt=\"\" srcset=\"https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-725x400.png 725w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1400x773.png 1400w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-768x424.png 768w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1536x848.png 1536w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-2048x1130.png 2048w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-24x13.png 24w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-36x20.png 36w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-48x26.png 48w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-600x331.png 600w\" sizes=\"100vw\"></p><p><strong>Dấu “Bông cúc Nhật Bản” chỉ được đóng lên những con bò được chính thức công nhận là bò Kobe.&nbsp;</strong></p><p>&nbsp; &nbsp; &nbsp; Mỗi lát cắt bò Kobe với những đường vân mỡ tuyệt đẹp như một<strong>&nbsp;</strong>miếng đá cẩm thạch, hương thơm quyến rũ, vị béo quyện cùng với những thớ thịt mượt mà như<strong>&nbsp;</strong>bơ tan dần trong miệng đã làm cho thịt bò Kobe được xếp vào hàng “cực phẩm”. Những ai từng thưởng thức loại thịt này đều xác nhận: Đó không chỉ là một loại thực phẩm, mà là trải nghiệm ẩm thực không thể nào quên!</p>', '2021-10-15', '2021-10-15', 'Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.'),
(8, 'Sản phẩm bò Kobe thăn lưng \' \"', '1635907741_xu-ly-anh-2.jpg', '<p><strong>Kobe thăn lưng đầu A5 -&nbsp; Ribeye</strong></p><p>Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.</p><p>Thăn lưng đầu A5 - Ribeye là phần thịt rất dày, có các mắt mỡ và phần mỡ dắt nhiều hơn các phần thịt khác.&nbsp;</p><p><strong>Cách dùng:&nbsp;</strong></p><p>Phần thịt này lý tưởng cho các món ăn như áp chảo, steak, nướng yakiniku</p><p>Bảo quản ngăn đông tủ lạnh khi chưa dùng đến</p><p>&nbsp;</p><p><strong>Nguồn gốc, xuất xứ:</strong></p><p>Thịt bò Kobe nhập khẩu trực tiếp từ nhà cung cấp S-Foods, Nhật Bản; S-Foods&nbsp;là tập đoàn hoạt động trong lĩnh vực xuất khẩu thịt bò Nhật, chiếm 99% thị phần thịt bò Kobe, xuất khẩu trên khắp thế giới.</p><p>&nbsp;</p><p>BioFarm nhập loại thịt bò Kobe có điểm vân mỡ mức 8-9 để phù hợp với sở thích và thói quen của người tiêu dùng Việt Nam và xin khẳng định rằng là loại thịt bò Kobe cao cấp nhất theo tiêu chuẩn đánh giá mà Chính phủ Nhật Bản đưa ra.</p><p>&nbsp;</p><p>Thịt bò Kobe được cho là một trong những loại thịt đắt đỏ nhất thế giới bởi nguồn cung ít ỏi, chi phí chăm sóc cao cũng như chất lượng thơm ngon hiếm có.&nbsp;</p><p>&nbsp;</p><p><strong>Cách tra mã ID của miếng thịt bò Kobe:</strong></p><p>&nbsp;</p><p>Trên mỗi miếng thịt bò Kobe đều có 1 tem dán thể hiện thông tin nguồn gốc xuất xứ của miếng thịt đó như: loại thịt gì, nhà máy cắt mổ, sơ chế, trọng lượng… và đặc biệt là có số ID của con bò được giết mổ. Số ID này rất quan trọng vì toàn bộ thông tin về nguồn gốc xuất xứ của con bò có ID này sẽ được thể hiện một cách rõ ràng, minh bạch.</p><p>&nbsp;</p><p>Chúng ta truy cập vào địa chỉ website của Hiệp hội bò Kobe:&nbsp;<a href=\"http://www.kobe-niku.jp/en/contents/certification/index.html\">http://www.kobe-niku.jp/en/contents/certification/index.html</a></p><p>Sau đó click vào nút System bên dưới. Nhập dãy số ID trên tem xuất xứ của miếng thịt vào ô trắng, sau đó ấn Search.</p><p>&nbsp;</p><p>Nếu số ID đó là của thịt bò Kobe chuẩn nguồn gốc sẽ hiện ra bảng thông tin chi tiết về con bò được giết mổ như: thời gian sinh, thời gian giết mổ, tên người nông dân nuôi dưỡng, người nông dân chăm sóc hàng ngày, và đặc biệt là có thể truy xuất nguồn gốc 3 đời của con bò được giết mổ.</p><p>&nbsp;</p><p><img src=\"https://bioplanet.vn/wp-content/uploads/2020/08/A%CC%89nh-chu%CC%A3p-Ma%CC%80n-hi%CC%80nh-2020-08-04-lu%CC%81c-17.03.36-725x400.png\" alt=\"\" srcset=\"https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-725x400.png 725w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1400x773.png 1400w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-768x424.png 768w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-1536x848.png 1536w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-2048x1130.png 2048w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-24x13.png 24w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-36x20.png 36w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-48x26.png 48w, https://bioplanet.vn/wp-content/uploads/2020/08/Ảnh-chụp-Màn-hình-2020-08-04-lúc-17.03.36-600x331.png 600w\" sizes=\"100vw\"></p><p><strong>Dấu “Bông cúc Nhật Bản” chỉ được đóng lên những con bò được chính thức công nhận là bò Kobe.&nbsp;</strong></p><p>&nbsp; &nbsp; &nbsp; Mỗi lát cắt bò Kobe với những đường vân mỡ tuyệt đẹp như một<strong>&nbsp;</strong>miếng đá cẩm thạch, hương thơm quyến rũ, vị béo quyện cùng với những thớ thịt mượt mà như<strong>&nbsp;</strong>bơ tan dần trong miệng đã làm cho thịt bò Kobe được xếp vào hàng “cực phẩm”. Những ai từng thưởng thức loại thịt này đều xác nhận: Đó không chỉ là một loại thực phẩm, mà là trải nghiệm ẩm thực không thể nào quên!</p>', '2021-10-15', '2021-11-03', 'Thăn lưng đầu A5 - Ribeye là phần thịt cao cấp với hương vị tuyệt vời, mềm và mỡ ngon, nằm giữa phần vai và thăn lưng cuối, dọc theo sống lưng.');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_trademark` char(255) NOT NULL,
  `product_cost_price` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `product_detail` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_trademark`, `product_cost_price`, `product_price`, `product_amount`, `product_detail`, `product_image`, `category_id`, `product_code`, `created_at`, `updated_at`) VALUES
(1, 'Quả Kiwi xanh', 'Đạt', 21000, 7000, 17, 'thông tin quả kiwi xanh', '1633747172_kiwi.png', 3, 'Q01', '0000-00-00 00:00:00', '2021-10-22 19:24:31'),
(12, 'Quả cà chua 2', 'Đạt', 13000, 5000, 18, 'Đây là thông tin quả cà chua 2', '1634128547_p.png', 2, 'Q02', '2021-10-13 19:35:47', '2021-10-13 19:35:47'),
(13, 'thịt hóa đơn', 'Đạt', 12000, 50000, 13, 'Đây là thông tin quả hóa đơn', '1634290996_1633748149_228bcef12fe5e6bbbff4.jpg', 3, 'M01', '2021-10-15 16:43:16', '2021-10-23 13:12:02'),
(14, 'Quả website hải sản', 'Đạt', 275000, 150000, 13, 'Thông tin về quả website', '1634291048_1633747087_244384181_294033425586222_9159267479035534980_n.png', 4, 'W01', '2021-10-15 16:44:08', '2021-10-15 16:44:08'),
(15, 'Quả website hải sản new', 'Đạt', 200000, 150000, 10, 'Thông tin về quả website', '1634291048_1633747087_244384181_294033425586222_9159267479035534980_n.png', 4, 'W01', '2021-10-15 16:44:08', '2021-10-15 16:44:08'),
(16, 'Quả Kiwi xanh', 'Đạt', 21000, 7000, 15, 'thông tin quả kiwi xanh', '1633747172_kiwi.png', 2, 'Q01', '0000-00-00 00:00:00', '2021-10-09 16:03:15'),
(17, 'Quả hóa đơn', 'Đạt', 100000, 50000, 0, 'Đây là quả hóa đơn', '1634128498_1633748149_228bcef12fe5e6bbbff4.jpg', 2, 'H01', '2021-10-13 19:34:58', '2021-10-13 19:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `phone_user` char(15) NOT NULL,
  `date_birth_user` date NOT NULL,
  `address_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `nickname` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `phone_user`, `date_birth_user`, `address_user`, `email_user`, `nickname`, `password`, `role_id`) VALUES
(1, 'Phạm Văn Đạt', '0379459937', '2001-02-10', 'Quỳnh Lương, Quỳnh Lưu, Nghệ An', 'phamvandatx4ql@gmail.com', '0379459937', 'Anhdat=123', 1),
(14, 'khách 2', '0379459937', '2021-10-01', 'Quỳnh Lương \' \"', 'anh_hai@gmail.com', 'anhdatx4ql', '123123123', 2),
(18, 'khách 3', '0379459937', '2021-10-13', 'Quynh Luong,Quynh Luu,Nghe An', 'phamvandatx4ql@gmail.com', 'anhdat111', '123123', 2),
(19, 'khách 4', '0379459937', '2021-10-15', 'Quynh Luong,Quynh Luu,Nghe An', 'phamvandatx4ql@gmail.com', '0379459937', '1', 2),
(21, 'khách 5', '0379459937', '2021-10-15', 'Quynh Luong,Quynh Luu,Nghe An', 'phamvandatx4ql@gmail.com', '123', '1', 2),
(26, 'khách 6', '0379459937', '2001-10-02', 'Quynh Luong,Quynh Luu,Nghe An', '123@gmail.com', '123123123', 'Anhdat=123', 2),
(27, 'khách 7', '123', '2021-10-19', '123', '123@gmail.com', '123123', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `fk_b_u` (`user_id`);

--
-- Indexes for table `bills_products`
--
ALTER TABLE `bills_products`
  ADD PRIMARY KEY (`bill_product_id`),
  ADD KEY `fk_bp_u` (`user_id`),
  ADD KEY `fk_bp_p` (`product_id`),
  ADD KEY `fk_bp_b` (`bill_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_c_p` (`product_id`),
  ADD KEY `fk_c_u` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catedory_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_p_c` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `bills_products`
--
ALTER TABLE `bills_products`
  MODIFY `bill_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catedory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `fk_b_u` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `bills_products`
--
ALTER TABLE `bills_products`
  ADD CONSTRAINT `fk_bp_b` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`),
  ADD CONSTRAINT `fk_bp_p` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_bp_u` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_c_p` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_c_u` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_p_c` FOREIGN KEY (`category_id`) REFERENCES `categories` (`catedory_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
