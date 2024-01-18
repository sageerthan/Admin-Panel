-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 01:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pink_pearl`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `image`) VALUES
(1, 'office wear', 'officewear.webp'),
(2, 'casual wear', 'casual wear.jpg'),
(3, 'party wear', 'partywear_3.jpg'),
(4, 'foot wear', 'footwear.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `name`, `email`, `message`, `date`) VALUES
(1, 'Thivya', 'Thivya@gmail.com', 'I completely love this site.I am always complemented on my outfits I will be back for more...Thank you for having cute trendy clothes that fit and look good.', '2023-12-20 16:12:32'),
(2, 'Samyuktha', 'Samyu3@gmail.com', 'I just wanted to let you know my opinion of your company. I normally have a rule that I never buy any clothes online... Ever. When I came across your store I really loved the styles that you offer.', '2023-12-26 11:56:16'),
(3, 'Aagash', 'Aagash@gmail.com', 'Great service, Great clothes and FAST delivery!! Loved the dress, now buying more for my wife.She really like your dresses. Happy! Happy!\r\n', '2024-01-03 09:19:16'),
(4, 'Sowmiya', 'sowmiya@gmail.com', 'Just received my order & am thrilled with everything I purchased! and the shipping was awesome it took 3 days best yet! i will shop again thanks you.\r\n', '2024-01-07 15:33:10'),
(5, 'Aarav', 'Aarav@gmail.com', 'This is my very first order through site, and I am totally and completely satisfied! The fit is great and so are the prices to my sister. I will definitely return again and again...\r\n', '2024-01-12 14:36:31'),
(6, 'Vaishali', 'vaishali@gmail.com', 'I love the clothes from this website!! I am so glad I found them.....everything has been spot on, fits wonderfully, styles are trendy and lots to choose from!!', '2024-01-12 18:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `product_image` varchar(255) NOT NULL,
  `colour` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `product_image`, `colour`, `qty`, `amount`, `status`) VALUES
(1, '2023-12-28 19:13:14', 'lehanga_4.webp', 'maroon', 1, 22000, 'Delivered'),
(2, '2024-01-02 10:24:56', 'saree_1.webp', 'light pink', 1, 25000, 'Pending'),
(3, '2024-01-03 13:09:45', 'slipper_2.jpg', 'grey', 2, 5000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(350) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `category_id`, `product_image`, `price`, `qty`) VALUES
(1, 'Blazer', 'Fashion Korean Women Blazer 3 Pcs Elegant Long Sleeve Suit Jackets Vest and Straight Pants Suit Female Chic Business Outfits New', 1, 'blazer_1.webp', '5200.00', 0),
(2, 'Blazer', 'Heydress Summer Notched Blazers Jackets With Trouser Two Pieces Set Light Gray Women Short Crop Blazer Suits Wide Leg Pants Suit\r\n', 1, 'blazer_2.jpg', '4500.00', 0),
(3, 'Blazer', 'Women Autumn Satin Blazer Two Piece Sets Long Sleeve Lace Up Tops And Pants Matching Sets Fashion Solid Color Tracksuit Sets', 1, 'blazer_3.webp', '2800.00', 0),
(4, 'Office frock', 'Spring Autumn New Vintage Solid All-match Ladies Dresses V Neck Long Sleeve Plus Size Midi Dress Fashion Elegant Women Clothing', 1, 'officefrock_1.webp', '2000.00', 0),
(5, 'Office frock', ' Butterfly Sleeve Wine Pleated Dresses For Women', 1, 'officefrock_2.webp', '2300.00', 0),
(6, 'Office frock', 'WSFEC S-2XL 2023 Summer New Fashion Long Dress Women Clothing Short Sleeve Bandage Solid Pleated Elegant Casual Party Dresses', 1, 'officefrock_3.webp', '2500.00', 0),
(7, 'Pencil skirt', 'Autumn Winter Formal Uniform Designs Women Business Suits with Tops and Skirt  Professional Interview Pencil Skirt Set', 1, 'pencilskirt_1.webp', '2800.00', 0),
(8, 'Pencil skirt', '3/4 Sleeve Ruffle Tunic White Pencil Skirt Office Lady Lapel Button Knee-length Bodycon Dress Patchwork OL Womens Party Clothes', 1, 'pencilskirt_2.webp', '2900.00', 0),
(9, 'Pencil skirt', 'This elegant slim-cut skirt with its cut and decorative elements will emphasize your feminine side in a special way. Complete with a blazer from the same line, it makes a perfect clothing combination that will not leave anyone indifferent.', 1, 'pencilskirt_3.jpeg', '2800.00', 0),
(10, 'Frock', 'Embroidered Cotton Rayon A Line Kurta in Blue', 2, 'frock_1.webp', '2800.00', 0),
(11, 'Frock', ' Womens Frock Gold Print Rayon Pink. Appear stunningly pretty in this hot pink rayon party wear kurti. The print work appears to be like chic and best for festival. (Slight variation in color, fabric & work is possible. Model images are only representative.', 2, 'frock_2.jpg', '3300.00', 0),
(12, 'Frock', 'Women Printed Pure Cotton Gown Kurta ', 2, 'frock_3.webp', '3300.00', 0),
(13, 'Skirt', 'Long Knitted Skirt Women Autumn Winter Warm Skirts Female Korean Fashion Pleated Skirt Ladies Elegant Chic High Waist Maxi Skirt', 2, 'skirt_1.jpg', '4000.00', 0),
(14, 'Skirt', 'Office Lady Elegant A-line Skirts New Arrival 2023 Spring Fashion Korean Style Solid Color High Waist Women Long Skirt ', 2, 'skirt_2.jpg', '4300.00', 0),
(15, 'Skirt', 'Summer Women Green Elegant High Waisted Zipper Pleated Skirts Black Vintage Belt A-line Midi Party Skirt For Ladies Fashion Boho', 2, 'skirt_3.jpg', '3600.00', 0),
(16, 'Tops', 'An amazing range of women Tops in soft and solid colors that looks perfect for regular wear. With beautiful designs and patterns', 2, 'top_1.webp', '2500.00', 0),
(17, 'Tops', 'Bawriattire offers this Printed Western Top, Exibhit Bell sleeves & Round Neck .Tailored from Top -Rayon Fabric. These apparels are very Stylish and comfortable too.', 2, 'top_2.jpeg', '2800.00', 0),
(18, 'Tops', 'Red regular peplum top, Solid, Sweetheart neck, short, puff sleeve, Gathered or pleated detail, Knitted and woven This top is great for anyone who wants to make a fashion statement.', 2, 'top_3.webp', '3900.00', 0),
(19, 'Kurtis', 'Ft Diva Offers You To This Beautiful Embroidered Anarkali Dress With Front Slit In Red Color, Made With Premium Rayon, Well Finished And Perfect Stitched.', 3, 'kurtis_1.webp', '5000.00', 0),
(20, 'Kurtis', ' Women Embellished Silk Blend Anarkali Kurta  (Blue).', 3, 'kurtis_2.webp', '4800.00', 0),
(21, 'Kurtis', 'The designer Kurtis is most preferred by the fashion lovers. These designer cotton Kurtis presented in exclusive range will definitely add elegance to your beauty. Dress for traditional, Casual, Wedding Party, Dating, Banquet, and Formal Occasion.', 3, 'kurtis_3.jpg', '4400.00', 0),
(22, 'Lehanga', 'Consisting of handmade traditional Indian clothes, Red Lehanga  richness of Jaipur royal heritage.', 3, 'lehanga_1.webp', '20000.00', 0),
(23, 'Lehanga', 'Rich look attire to give your a right choice for any party or function. This pink net and satin silk trendy a line lehenga choli is adding the interesting glamorous showing the feel of cute and graceful. The incredible dress creates a dramatic canvas with extraordinary embroidered work. Comes with matching choli and dupatta. (Slight variation in co', 3, 'lehanga_2.jpg', '18000.00', 0),
(24, 'Lehanga', 'Seema Gujral designs this understated ivory lehenga ensemble in tissue raw silk enriched with gota patti embroidery, complementing the look with a tissue organza dupatta. Style the look with a diamond necklace set for a soiree', 3, 'lehanga_3.jpeg', '20000.00', 0),
(25, 'Saree', 'Net Classic Saree For Festival.Look ethnic in this affluent pink net classic saree. Beautified and stylized with embroidered, resham and stone work to give you an attractive look. Comes with matching blouse.', 3, 'saree_1.webp', '25000.00', 0),
(26, 'Saree', 'Purple Art Silk Embroidered Designer Saree.We unfurl our the intricacy and exclusivity of our creations highlighted with this stunning purple art silk saree. The ethnic embroidered work with the dress adds a sign of splendor statement for the look. Comes with matching blouse.', 3, 'saree_2.jpg', '30000.00', 0),
(27, 'Saree', 'Red Weaving Party Designer Saree. Fashion and trend will be at the peak of your magnificence the moment you dresses this red silk designer saree. The appealing weaving work a considerable characteristic of this attire. Comes with matching blouse. ', 3, 'saree_3.webp', '18000.00', 0),
(28, 'Boots', ' Shoes for Girls and Womens High Heels Stylish Sneakers Ankle Boots | Casual | Party wear | New Model Boots For Women (Grey)', 4, 'boots_1.jpg', '5500.00', 0),
(29, 'Boots', 'voguish women boots .Trendy Fashionable And Comfortable Footwear Boots.\r\n', 4, 'boots_3.webp', '5700.00', 0),
(30, 'Boots', 'Shoes for Women 2023 Brand Belt Buckle Womens Boots Fashion Back Zip Office and Career High Quality Square Toe Ankle Boots.', 4, 'boots_5.jpeg', '5600.00', 0),
(31, 'Shoes', 'Flat Sneakers Pumps White Shoes.Made of high quality materials, lightweight and flexible\r\n', 4, 'shoes_5.jpeg', '4500.00', 0),
(32, 'Shoes', 'fashion zipper wedge women sneakers.Made of high quality materials, lightweight and flexible, abrasion-resistant  and anti-slip rubber outsole.\r\n', 4, 'shoes_2.jpg', '4800.00', 0),
(33, 'Shoes', 'Maximum durability: Canvas shoes are made of high-quality canvas, which is a light-weight and durable shoe. they can be used for a long time.', 4, 'shoes_3.webp', '4400.00', 0),
(34, 'Slippers', 'Typo Gold White Brown Beige Strap.  Stylish and Trendy, Premium Quality, Beautiful Work\r\n\r\n', 4, 'slipper_2.jpg', '1900.00', 0),
(35, 'Slippers', 'Slip into effortless style with our braided wide width sandals for women, crafted from premium leather that wicks away sweat, leaving your feet fresh and dry on warm weather days.', 4, 'slipper_3.webp', '2500.00', 0),
(36, 'Slippers', 'New Fashion Ladies slippers. High quality, Durable product, Comfortable to wear and Stylish look\r\n', 4, 'slipper_4.jpg', '1950.00', 0),
(38, 'Lehanga', 'A stunning beautiful bridal wear lehenga choli designed especially for Party and wedding season. Girls who love light weight lehenga will love this dress. It’s airy and glamorous at a time. ', 3, 'lehanga_4.webp', '22000.00', 100),
(39, 'Saree', 'Designed with simplicity with a touch of soberness in its work makes a masterpiece. Add richer looks to your persona in this majestic yellow silk classic designer saree. This beautiful attire is showing some amazing embroidery done with embroidered and patch border work. Comes with matching blouse. (Slight variation in color, fabric & work is possi', 3, 'saree_4.webp', '13000.00', 200),
(40, 'Lehanga', 'Lavender Traditional Embroidered Wedding Lehenga Choli Shop Eid Outfits & Dress. Free International Shipping. best pick as an indian wear for festivals or wedding event. This elegant set has a very pretty thread embroidery detailed with zari and pearl work on canned net lehenga with satin lining paired with equally embellished matching net and sati', 3, 'lehanga_5.webp', '24000.00', 100),
(41, 'Saree', 'Elite blue georgette and satin saree. Look ravishing clad in this attire which is enhanced lace and stones work all synchronized very well with all the trend and design of the attire. Comes with matching blouse.(Slight color variation is possible.)\r\nLength: 6.3 meters (including 85 cms blouse fabric) Blouse Fabric attached with saree', 3, 'saree_5.jpg', '28290.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_colour`
--

CREATE TABLE `product_colour` (
  `colour_id` int(255) NOT NULL,
  `colour_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_colour`
--

INSERT INTO `product_colour` (`colour_id`, `colour_name`) VALUES
(1, 'navy blue'),
(2, 'sky blue'),
(3, 'light blue'),
(4, 'light green'),
(5, 'yellowish green'),
(6, 'red'),
(7, 'crimson red'),
(8, 'maroon'),
(9, 'violet'),
(10, 'dark pink'),
(11, 'light pink'),
(12, 'yellow'),
(13, 'black'),
(14, 'grey'),
(15, 'brown'),
(16, 'white'),
(17, 'orange');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `size_id` int(255) NOT NULL,
  `size_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`size_id`, `size_name`) VALUES
(1, 'one size'),
(2, '2XL'),
(3, 'XL'),
(4, 'L'),
(5, 'M'),
(6, 'S'),
(7, '6'),
(8, '7'),
(9, '9'),
(10, '10'),
(11, '26'),
(12, '28'),
(13, '30'),
(14, '32'),
(15, '33'),
(16, '36'),
(17, '38'),
(18, '40');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `stock_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `colour_id` int(255) NOT NULL,
  `size_id` int(255) NOT NULL,
  `stock_qty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`stock_id`, `product_id`, `colour_id`, `size_id`, `stock_qty`) VALUES
(200, 1, 1, 4, '200'),
(201, 1, 3, 3, '200'),
(203, 2, 12, 16, '200'),
(204, 2, 5, 5, '200'),
(205, 2, 9, 13, '200'),
(206, 3, 12, 16, '150'),
(207, 3, 7, 13, '180'),
(208, 3, 11, 16, '250'),
(209, 4, 7, 13, '230'),
(210, 4, 9, 17, '150'),
(211, 4, 2, 4, '200'),
(212, 5, 16, 12, '200'),
(213, 5, 10, 14, '200'),
(214, 5, 8, 16, '160'),
(215, 6, 4, 13, '180'),
(216, 6, 6, 15, '200'),
(217, 6, 7, 14, '170'),
(218, 7, 9, 3, '200'),
(219, 7, 12, 4, '200'),
(220, 7, 15, 6, '200'),
(221, 8, 9, 3, '200'),
(222, 8, 11, 4, '180'),
(223, 8, 13, 6, '140'),
(224, 9, 9, 3, '200'),
(225, 9, 12, 4, '200'),
(226, 9, 15, 6, '200'),
(227, 10, 9, 3, '200'),
(228, 10, 12, 4, '200'),
(229, 10, 15, 6, '200'),
(230, 11, 9, 3, '200'),
(231, 11, 12, 4, '200'),
(232, 11, 15, 6, '200'),
(233, 12, 9, 3, '200'),
(234, 12, 12, 4, '200'),
(235, 12, 15, 6, '200'),
(236, 13, 9, 3, '200'),
(237, 13, 11, 4, '180'),
(238, 13, 13, 6, '140'),
(239, 14, 9, 3, '200'),
(240, 14, 11, 4, '180'),
(241, 14, 13, 6, '140'),
(242, 15, 9, 3, '200'),
(243, 15, 11, 4, '180'),
(244, 15, 13, 6, '140'),
(245, 16, 9, 3, '200'),
(246, 16, 12, 4, '200'),
(247, 16, 15, 6, '200'),
(248, 17, 9, 3, '200'),
(249, 17, 11, 4, '180'),
(250, 17, 13, 6, '140'),
(251, 18, 9, 3, '200'),
(252, 18, 12, 4, '200'),
(253, 18, 15, 6, '200'),
(254, 19, 9, 3, '200'),
(255, 19, 11, 4, '180'),
(256, 19, 13, 6, '140'),
(257, 20, 9, 3, '200'),
(258, 20, 12, 4, '200'),
(259, 20, 15, 6, '200'),
(260, 21, 9, 3, '200'),
(261, 21, 11, 4, '180'),
(262, 21, 13, 6, '140'),
(263, 22, 9, 3, '200'),
(264, 22, 12, 4, '200'),
(265, 22, 15, 6, '200'),
(266, 23, 9, 3, '200'),
(267, 23, 11, 4, '180'),
(268, 23, 13, 6, '140'),
(269, 24, 9, 3, '200'),
(270, 24, 12, 4, '200'),
(271, 24, 15, 6, '200'),
(272, 25, 9, 3, '200'),
(273, 25, 11, 4, '180'),
(274, 25, 13, 6, '140'),
(275, 26, 9, 3, '200'),
(276, 26, 12, 4, '200'),
(277, 26, 15, 6, '200'),
(278, 27, 9, 3, '200'),
(279, 27, 11, 4, '180'),
(280, 27, 13, 6, '140'),
(281, 28, 12, 7, '200'),
(282, 28, 11, 9, '200'),
(283, 28, 13, 8, '150'),
(284, 29, 14, 8, '200'),
(285, 29, 15, 10, '180'),
(286, 29, 16, 9, '200'),
(287, 30, 3, 10, '150'),
(288, 30, 15, 9, '200'),
(289, 30, 12, 8, '180'),
(290, 31, 12, 7, '200'),
(291, 31, 11, 9, '200'),
(292, 31, 13, 8, '150'),
(293, 32, 14, 8, '200'),
(294, 32, 15, 10, '180'),
(295, 32, 16, 9, '200'),
(296, 33, 3, 10, '150'),
(297, 33, 15, 9, '200'),
(298, 33, 12, 8, '180'),
(299, 34, 12, 7, '200'),
(300, 34, 11, 9, '200'),
(301, 34, 13, 8, '150'),
(302, 35, 14, 8, '200'),
(303, 35, 15, 10, '180'),
(304, 35, 16, 9, '200'),
(305, 36, 3, 10, '150'),
(306, 36, 15, 9, '200'),
(307, 36, 12, 8, '180'),
(308, 1, 14, 4, '150'),
(309, 1, 13, 16, '200'),
(311, 38, 8, 4, '100');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(255) NOT NULL,
  `main_category_id` int(255) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `main_category_id`, `sub_category_name`) VALUES
(30, 1, 'Blazer'),
(31, 1, 'Office frock'),
(32, 1, 'Pencil skirt'),
(33, 2, 'Frock'),
(34, 2, 'Skirt'),
(35, 2, 'Tops'),
(36, 3, 'Kurtis'),
(37, 3, 'Lehanga'),
(38, 3, 'Saree'),
(39, 4, 'Boots'),
(40, 4, 'Shoes'),
(41, 4, 'Slippers');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `password`, `date`) VALUES
(1, 'Sayisha', 'sayisha@gmail.com', '074-321-2567', 'Admin', 'sayisha27', '2024-01-18 16:10:43'),
(2, 'Thivya', 'Thivya@gmail.com', '074-321-2568', 'User', 'thivya30#', '2024-01-18 16:13:23'),
(3, 'Samyuktha', 'Samyu3@gmail.com', '075-087-2670', 'User', '075samyu2670', '2024-01-18 16:15:38'),
(4, 'Aagash', 'Aagash@gmail.com', '077-234-9900', 'User', '234aagash9900', '2024-01-18 16:18:02'),
(5, 'Sowmiya', 'sowmiya@gmail.com', '077-330-9900', 'User', 'sowmy9900', '2024-01-18 16:25:21'),
(6, 'Aarav', 'Aarav@gmail.com', '077-130-9623', 'User', 'aaravresh110', '2024-01-18 16:29:08'),
(7, 'Vaishali', 'vaishali@gmail.com', '076-980-1111', 'User', 'vaisha$#@', '2024-01-18 16:31:10'),
(8, 'Janani', 'Janani@gmail.com', '077-3308-230', 'User', 'jananileo', '2024-01-18 16:31:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_colour`
--
ALTER TABLE `product_colour`
  ADD PRIMARY KEY (`colour_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_colour`
--
ALTER TABLE `product_colour`
  MODIFY `colour_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `size_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `stock_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
