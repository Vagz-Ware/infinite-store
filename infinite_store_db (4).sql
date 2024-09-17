-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 08:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infinite_store_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins_tb`
--

CREATE TABLE `admins_tb` (
  `admin_id` int(255) NOT NULL,
  `admin_fullname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_address` varchar(255) NOT NULL,
  `admin_mobile_number` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` varchar(2555) NOT NULL DEFAULT 'images\\profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_tb`
--

INSERT INTO `admins_tb` (`admin_id`, `admin_fullname`, `admin_email`, `admin_address`, `admin_mobile_number`, `admin_password`, `admin_image`) VALUES
(1, 'Loyiso Ndlovu', 'Ndlovu@admin.com', 'Protea Glen ext 27 2342', '1223456789', '$2y$10$y3aMt3sxuCxKd6eCCZHIkO08TMvPHTV1risoM9bQ9AP7KPAe53vpW', 'uploads/profile_pictures/profile.jpg'),
(3, 'Sun El Musician', 'El@admin.com', 'Afro-Tech Sets Souls', '0123456789', '$2y$10$dn.p0lIAx6sFB5W8vccm/.dBt.Frj8WhKXZNU49wTAebhIfG.IpIy', 'images\\profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_tb`
--

CREATE TABLE `products_tb` (
  `product_barcode` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` mediumtext NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `product_arrival_status` varchar(255) NOT NULL DEFAULT 'old',
  `product_discount` varchar(255) NOT NULL DEFAULT 'False',
  `product_discount_percentage` int(255) DEFAULT NULL,
  `product_case` varchar(255) DEFAULT '40MM',
  `product_movement` varchar(255) DEFAULT 'TBA',
  `product_dial` varchar(255) DEFAULT 'TBA',
  `product_strap` varchar(255) DEFAULT 'TBA',
  `product_style_code` varchar(255) DEFAULT 'TBA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_tb`
--

INSERT INTO `products_tb` (`product_barcode`, `product_name`, `product_description`, `product_price`, `product_image`, `product_brand`, `product_link`, `product_arrival_status`, `product_discount`, `product_discount_percentage`, `product_case`, `product_movement`, `product_dial`, `product_strap`, `product_style_code`) VALUES
('063728', 'Rolex Daytona 116503 Gold Steel', 'Experience the pinnacle of luxury and precision with the Rolex Cosmograph Daytona 116503, a timeless chronograph that combines robust functionality with refined aesthetics. Released in 2021, this model features a striking black dial with a harmonious blend of gold and steel, showcasing Rolex\'s commitment to elegance and performance.', 15779.87, 'Rolex Daytona 116503 Gold_Steel Black 40mm 2021.jpg', 'Rolex', 'images\\Rolex Daytona 116503 Gold_Steel Black 40mm 2021.jpg', 'old', 'true', 22, '40mm', 'Automatic Rolex Caliber 4130', 'Black with Gold Sub-Dials', 'Stainless Steel and Gold Oyster Bracelet with Oysterlock clasp', 'Fixed Gold Tachymetric Bezel'),
('0654236', 'Louis Vuitton Tambour Street Diver', 'Louis Vuitton® Tambour Street Diver Chronograph, Automatic, 46MM, Steel Blue_ Size', 88900.56, 'LV-min.png', 'LV', 'images\\Louis Vuitton® Tambour Street Diver Chronograph, Automatic, 46MM, Steel Blue_ Size.jpg', 'new', 'True', 22, NULL, NULL, NULL, NULL, NULL),
('15280892', 'Rolex 116509 Cosmograph Daytona White Gold Blue Dial 40mm ', 'Discover the pinnacle of luxury and precision with the Rolex Cosmograph Daytona 40mm in White Gold with a striking Blue Dial (Ref. 116509). This iconic chronograph is a testament to Rolex\'s dedication to exceptional craftsmanship and timeless design, making it an essential addition to any distinguished collection.', 89000.93, 'Rolex Daytona 116509 White gold Blue 40mm 2023.jpg', 'Rolex', 'images\\Rolex 116509 Cosmograph Daytona White Gold Blue Dial 40mm for $52,388 for sale from a Trusted Seller on Chrono24.jpg', 'old', 'False', NULL, '18K White Gold', 'Automatic Caliber 4130', 'Blue with contrasting silver sub-dials', 'White Gold Oyster Bracelet with an Oysterlock clasp', 'Fixed White Gold Tachymetric Bezel'),
('1739499492', 'Audemars Piguet Royal Oak Perpetual Calendar Blue Ceramic ', 'The Audemars Piguet Royal Oak Offshore Smoke Dial stands as a striking fusion of bold design and luxury. This timepiece features a captivating smoke dial, characterized by a gradient effect that transitions from deep, rich tones to lighter shades, adding depth and intrigue to the watch\'s face. Housed in a robust stainless steel or ceramic case, the watch embodies the sporty elegance that the Royal Oak Offshore collection is renowned for. With an automatic chronograph movement and a design that commands attention, this watch is perfect for those who appreciate high performance wrapped in a modern, sophisticated package.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 90000.00, 'Audemars Piguet Royal Oak Perpetual Calendar Blue Ceramic 26579CS_OO.1225CS.jpg', 'AP', 'Audemars Piguet Royal Oak Perpetual Calendar Blue Ceramic 26579CS_OO.1225CS.jpg', 'old', 'True', 78, '40MM', 'Automatic with perpetual calendar functionality', 'Typically 42mm to 44mm\r\n', 'Blue ceramic', 'Innovative and luxurious'),
('230989', 'Louis XVI Luxusuhr', 'Louis XVI Luxusuhr', 12390.90, 'Louis Vuitton Classic Tambour Swiss Watch (1).jpg', 'LV', 'images\\Louis XVI Luxusuhr-min.png', 'old', 'True', 80, 'TBA', 'TBA', 'TBA', 'TBA', 'TBA'),
('304858', 'Audemars Piguet Royal Oak Offshore Smoke Dial 26420SO_OO.A600CA', 'The Audemars Piguet Royal Oak Offshore Smoke Dial stands as a striking fusion of bold design and luxury. This timepiece features a captivating smoke dial, characterized by a gradient effect that transitions from deep, rich tones to lighter shades, adding depth and intrigue to the watch\'s face. Housed in a robust stainless steel or ceramic case, the watch embodies the sporty elegance that the Royal Oak Offshore collection is renowned for. With an automatic chronograph movement and a design that commands attention, this watch is perfect for those who appreciate high performance wrapped in a modern, sophisticated package.', 54900.89, 'Audemars Piguet Royal Oak Offshore Smoke Dial 26420SO_OO.A600CA.jpg', 'AP', 'images\\Audemars Piguet Royal Oak Offshore Smoke Dial 26420SO_OO.A600CA.jpg', 'old', 'False', NULL, '40MM', 'Automatic chronograph', 'Typically 42mm to 44mm\r\n', 'Stainless steel or ceramic case', 'Sporty and luxurious'),
('328263', 'Rolex NEW 2024 Day-Date 40 Chocolate Baguette Factory Diamond', 'The Rolex 2024 Day-Date 40 is a masterpiece of luxury and craftsmanship. Featuring a rich chocolate dial, this timepiece is elegantly adorned with factory-set baguette diamonds, offering a sophisticated sparkle that catches the eye. The iconic 40mm case is crafted with precision and attention to detail, embodying Rolex’s tradition of excellence. The Day-Date function, displayed at 12 o\'clock, is a signature feature, making this watch both practical and prestigious. Whether for a formal occasion or as an everyday statement piece, this Day-Date 40 is the epitome of timeless elegance and modern luxury.\r\n\r\n', 93939.90, 'Rolex NEW 2024 Day-Date 40 Chocolate Baguette Factory Diamond_.. for $64,999 for sale from a Trusted Seller on Chrono24.jpg', 'Rolex', 'images\\Rolex NEW 2024 Day-Date 40 Chocolate Baguette Factory Diamond_.. for $64,999 for sale from a Trusted Seller on Chrono24.jpg', 'old', 'False', NULL, '40mm', 'Day-Date display at 12 o’clock', 'Chocolate with Baguette Diamond Hour Markers', 'Factory-set diamonds for added elegance', 'Hour made'),
('329065', 'Tambour Blossom 35\r\n', 'Indulge in luxury with the Louis Vuitton Tambour Blossom 35 Rose Gold Diamond Watch. Crafted in radiant rose gold, this exquisite timepiece features a delicate floral design and is adorned with shimmering diamonds that enhance its sophistication. The 35mm dial provides a perfect balance of elegance and functionality, making it an ideal accessory for any occasion. The watch combines timeless beauty with modern precision, offering a refined and feminine touch to your collection.', 15600.78, 'Louis Vuitton Tambour Blossom 35 Rose Gold Diamond Watch.jpg', 'LV', 'images\\Louis Vuitton Tambour Blossom 35 Rose Gold Diamond Watch.jpg', 'new', 'True', 50, '40MM', 'Set with diamonds', '35mm', 'Rose gold', 'Luxurious and feminine'),
('3640030', 'Secret White Gold Diamond Women’s Watch', 'Discover the epitome of luxury with the Louis Vuitton Secret White Gold Diamond Women’s Watch. Exquisitely crafted in white gold, this watch is adorned with sparkling diamonds that enhance its elegance and allure. The innovative “secret” dial design adds a unique touch, revealing the time only when desired. Powered by a precise quartz movement, this timepiece combines functionality with high fashion. Perfect for any occasion, it’s an exquisite choice for those who appreciate both traditional craftsmanship and modern design.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 34500.90, 'Louis Vuitton Secret White Gold Diamond Womens Watch  _ eBay.jpg', 'LV', 'images\\Louis Vuitton Secret White Gold Diamond Womens Watch  _ eBay.jpg', 'old', 'False', NULL, '40MM', 'Quartz', 'Hidden or “secret” dial', 'Set with diamonds\r\n', 'Luxurious and unique'),
('428293', 'Audemars Piguet Royal Oak Frosted Rainbow Sapphire Bezel Skeleton', 'The Audemars Piguet Royal Oak Frosted Rainbow Sapphire Bezel Skeleton 37mm is a dazzling display of craftsmanship and creativity. Encased in white gold, this stunning timepiece features a frosted finish that adds a unique texture and shimmer, while the rainbow sapphire bezel offers a burst of vibrant color. The openworked (skeleton) design reveals the intricate mechanics within, showcasing the brand’s commitment to both beauty and precision. At 37mm, this watch is perfect for those seeking a statement piece that blends luxury with a bold, eye-catching aesthetic.', 43790.90, 'Audemars Piguet Royal Oak Frosted Rainbow Sapphire Bezel Skeleton 37mm (1).jpg', 'AP', 'images\\Audemars Piguet Royal Oak Frosted Rainbow Sapphire Bezel Skeleton 37mm (1).jpg', 'old', 'False', NULL, '40MM', 'Automatic with openworked mechanism\r\n', '37mm', 'Vibrant and intricate', 'Luxurious and eye-catching\r\n'),
('463902', 'Rolex Daytona 116523 18k Gold Steel Black Factory Diamond ', 'Discover the perfect blend of luxury and performance with the Rolex Cosmograph Daytona 116523. This prestigious timepiece, combining 18K gold and stainless steel with a striking black dial adorned with factory-set diamonds, exemplifies Rolex’s dedication to exquisite craftsmanship and sophisticated design.', 67890.98, 'Rolex Daytona 126503 Gold_Steel Black 40mm 2024.jpg', 'Rolex', 'images\\Rolex Daytona 116523 18k Gold Steel Black Factory Diamond Dial Men\'s Watch 40mm, Size_One size.jpg', 'old', 'False', NULL, '40mm', 'Automatic Rolex Caliber 4130', 'Black with Factory-Set Diamonds on hour markers', 'Stainless Steel and 18K Yellow Gold Oyster Bracelet with Oysterlock clasp', '18K Yellow Gold Tachymetric Bezel'),
('52739', 'Audemars Piguet Royal Oak Double Balance Wheel Openworked ', 'The Audemars Piguet Royal Oak Double Balance Wheel Openworked 41mm is a masterpiece of horological innovation and design. This timepiece showcases an openworked (skeleton) dial, revealing the intricate mechanics within, including the revolutionary double balance wheel mechanism that enhances stability and precision. Available in stainless steel or rose gold, the 41mm case perfectly complements the technical brilliance on display. Marrying luxury with cutting-edge technology, this watch is designed for those who appreciate both aesthetic beauty and mechanical excellence.', 43900.93, 'Audemars Piguet Royal Oak Double Balance Wheel Openworked 41mm 15416CE_OO.1225CE (1).jpg', 'AP', 'Audemars Piguet Royal Oak Double Balance Wheel Openworked 41mm 15416CE_OO.1225CE (1).jpg', 'old', 'False', NULL, '40MM', 'Automatic with enhanced precision', '41mm', 'Luxurious and technical', 'Intricate and innovative'),
('528193', 'Rolex Daytona 116515ln Black Dial 18k Rose Gold Mens Watch Box Papers', 'Elevate your watch collection with the Rolex Cosmograph Daytona 116515LN, a masterpiece of horological craftsmanship in 18K rose gold. This model, featuring a striking black dial, offers both luxury and precision, embodying the sophistication that Rolex is renowned for extravagance.', 890999.90, 'Rolex Daytona 16523 Gold_Steel Black 40mm 1998.jpg', 'Rolex', 'images\\Rolex Daytona 116515ln Black Dial 18k Rose Gold Mens Watch Box Papers.jpg', 'old', 'False', NULL, '40mm', 'Automatic Rolex Caliber 4130\r\n', 'Black with Rose Gold Sub-Dials', '18K Rose Gold Oyster Bracelet with Oysterlock clasp', 'Black Ceramic Tachymetric Bezel'),
('5383748', 'Rolex Submariner Black Dial Stainless Steel 126610LN', 'The Rolex Submariner 126610LN is a quintessential dive watch that blends rugged durability with classic elegance. Featuring a sleek black dial and a matching Cerachrom bezel insert, this timepiece is designed for both underwater adventures and everyday sophistication. The 41mm stainless steel case is crafted from Oystersteel, known for its exceptional corrosion resistance, making it as resilient as it is stylish. The iconic Submariner design is complemented by a robust Oyster bracelet, offering both comfort and security. Powered by the Rolex Calibre 3235 movement, the 126610LN delivers precise timekeeping and a power reserve of approximately 70 hours, ensuring reliability in any situation. Whether you\'re exploring the depths of the ocean or navigating the demands of daily life, the Rolex Submariner 126610LN is a timeless companion.', 73829.89, 'Rolex Submariner 40mm - 116613LN - Or 2 Tons.jpg', 'Rolex', 'images\\Rolex Submariner Black Dial Stainless Steel 126610LN.jpg', 'old', 'False', NULL, '41mm', 'Calibre 3235, automatic with a 70-hour power reserve', 'Black with luminescent hour markers', 'Oyster, secure and comfortable fit', 'Uptown upstanding'),
('566390', 'Bronze AP', 'Audemars Piguet Royal Oak Black Dial 15400st_oo.1220st (3).jpg', 78900.90, 'Audemars Piguet Royal Oak Black Dial 15400st_oo.1220st (3).jpg', 'AP', 'images\\ap in case.jpg', 'old', 'false', NULL, NULL, NULL, NULL, NULL, NULL),
('6283993', 'Rolex Daytona Ceramic Bezel White Panda Dial Steel ', 'The Rolex Daytona 116500 is a distinguished chronograph that combines elegance with top-notch functionality. Its 40mm Oyster case is crafted from durable 904L stainless steel, providing a robust yet refined appearance. The black Cerachrom ceramic bezel features an engraved tachymetric scale for precise speed measurement.\r\n\r\nThe striking white \"Panda\" dial contrasts with black subdials and features luminous hour markers for enhanced readability. The watch’s Oystersteel bracelet blends polished and brushed links, secured by an Oysterlock clasp with Easylink extension for a perfect fit.\r\n\r\n', 6839.54, 'Rolex Daytona Ceramic Bezel White Panda Dial Steel Mens Watch 116500 Box Card.jpg', 'Rolex ', 'images\\Rolex Daytona Ceramic Bezel White Panda Dial Steel Mens Watch 116500 Box Card.jpg', 'old', 'False', NULL, '40mm', 'Automatic Movement', 'White Panda (white with black sub-dials)', 'Stainless Steel', 'comes sround'),
('637383', 'Audemars Piguet Royal Oak Skeleton Black Watch Wrest', 'The Audemars Piguet Royal Oak Skeleton Black Watch is a striking fusion of technical mastery and modern design. Featuring an openworked dial, this timepiece allows you to view the intricate inner workings of the watch, showcasing the brand\'s renowned craftsmanship. The black ceramic or black-coated stainless steel case enhances the watch\'s bold aesthetic, while the 41mm dial offers a perfect balance of size and visibility. With its automatic movement and distinctive design, this watch is ideal for those who appreciate both cutting-edge style and horological excellence.', 55900.54, 'Audemars Piguet Royal Oak Skeleton Black Watch.jpg', 'AP', 'images\\Audemars Piguet Royal Oak Skeleton Black Watch.jpg', 'old', 'False', NULL, '40MM', 'Automatic with visible mechanics\r\n', 'Typically 41mm', 'Intricate and modern', 'Bold and luxurious'),
('638409', 'Rolex Daytona 126503 Gold/Steel Black', 'Elevate your timepiece collection with the Rolex Daytona 126503, a masterful blend of elegance and performance. This model combines the classic allure of gold with the robust durability of stainless steel, creating a striking contrast that is both luxurious and practical.\r\n\r\nThe watch features a striking black dial, adorned with contrasting gold subdials and luminous markers, ensuring optimal readability in any light. The chronograph function, with its three subdials, is housed in a 40mm case that seamlessly marries style and functionality.\r\n\r\nCrafted from Rolex\'s proprietary 18K Everose gold and Oystersteel, this Daytona is as durable as it is stunning. The Oyster case is waterproof up to 100 meters, while the gold and steel bracelet provides both comfort and a secure fit.', 63829.90, 'Rolex Daytona 126503 Gold_Steel Black 40mm 2024-min.png', 'Rolex', 'images\\Rolex Daytona 126503 Gold_Steel Black 40mm 2024-min.png', 'old', 'False', NULL, '40mm', 'Caliber 4130', 'The black dial serves as a bold backdrop for the three subdials, which are gold-accented for a high-contrast, sporty appearance', 'The Daytona comes with a bracelet that combines the robustness of Oystersteel with the elegance of Everose gold.', 'Frozen'),
('64890099', 'Rolex Women’s Oyster Datejust Watch\r\n\r\n', 'The Rolex Women’s Oyster Datejust is a timeless symbol of elegance and sophistication. Renowned for its classic design and unparalleled craftsmanship, this timepiece is tailored to meet the needs of modern women who appreciate both style and functionality. The Oyster case, available in various precious metals, provides exceptional durability and water resistance, ensuring the watch remains as resilient as it is beautiful. The dial, offered in a range of colors and finishes, features the iconic date display at 3 o’clock, magnified by the Cyclops lens for easy readability. Powered by a precise automatic movement, the Women’s Oyster Datejust is designed to keep perfect time, making it a reliable companion for every occasion. Whether you choose a model with diamond-set hour markers or a more understated version, the Rolex Women’s Oyster Datejust is a timeless piece that complements any wardrobe.\r\n\r\n', 46790.90, 'Rolex Womens Oyster Datejust Watch.jpg', 'Rolex', 'images\\Rolex Women\'s Oyster Datejust Watch.jpg', 'old', 'False', NULL, 'Oyster, available in various metals (e.g., stainless steel, gold)', 'Automatic, precise and reliable', 'Multiple options, with or without diamond hour markers', 'Oyster or Jubilee, designed for comfort and style', 'Halftime'),
('6520908', 'LV unknown', '14 Reasons to Wear a Watch-min.png', 45900.45, '14 Reasons to Wear a Watch-min.png', 'LV', 'images\\14 Reasons to Wear a Watch-min.png', 'old', 'true', 11, NULL, NULL, NULL, NULL, NULL),
('6542178', 'Audemars Piguet Moissanite Royal Oak ', 'Iced Out Audemars Piguet Watch Moissanite Royal Oak Black Dial Analogue with Date Indicator', 230890.99, 'Iced Out Audemars Piguet Watch Moissanite Royal Oak Black Dial Analogue with Date Indicator.jpg', 'AP', 'images\\Iced Out Audemars Piguet Watch Moissanite Royal Oak Black Dial Analogue with Date Indicator.jpg', 'new', 'False', NULL, NULL, NULL, NULL, NULL, NULL),
('6724709', 'Louis Vuitton Tambour Brown Chronograph', 'Experience the perfect blend of sporty elegance with the Louis Vuitton Tambour Brown Chronograph. Featuring a sleek 42mm steel case and a rich brown leather strap, this watch combines functionality with luxury. The chronograph functionality allows for precise timing, making it ideal for both everyday use and special occasions. The stylish brown dial complements the sophisticated design, making this timepiece a versatile addition to any wardrobe. With its robust features and refined aesthetic, the Tambour Brown Chronograph is a testament to Louis Vuitton’s commitment to quality and design excellence.', 51239.98, 'mens watches (1).jpg', 'LV', 'images\\Louis Vuitton Tambour Blue Chronograph-min.png', 'old', 'False', NULL, '40MM', 'Chronograph functionality', '42mm', 'Brown leather strap, steel case', 'Sophisticated and functional'),
('737567', 'Audemars Piguet Chrono', 'Audemars Piguet proudly unveils its latest collection of Royal Oak Offshores, a series that continues to push the boundaries of innovation and design. Known for their bold and distinctive aesthetic, these new models feature robust materials such as stainless steel, titanium, and ceramic, offering a blend of durability and luxury. With chronograph functionality and a choice of dial sizes ranging from 42mm to 44mm, the collection caters to those who demand both performance and style. Each timepiece in this collection embodies the brand’s commitment to excellence, making it a must-have for aficionados of sporty luxury watches.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 90000.98, 'Audemars Piguet Royal Oak Black Dial 15400st_oo.1220st (1).jpg', 'AP', 'images\\Audemars Piguet reveals its latest collection of Royal Oak Offshores.jpg', 'old', 'False', NULL, '40MM', 'Bold and distinctive', 'Typically 42mm to 44mm', 'Chronograph functionality, robust design\r\n', 'Sporty luxury'),
('7392929', 'Rolex Everose Rubber Daytona 126515ln-0004 Black Diamond', 'The Rolex Everose Rubber Daytona 126515LN-0004 is a striking fusion of elegance and performance. Crafted from Rolex’s exclusive Everose gold, this timepiece radiates warmth and luxury. The black dial is adorned with diamond hour markers, offering a refined touch that complements the watch\'s sporty aesthetic. Paired with a black Oysterflex rubber strap, the Daytona is as comfortable as it is stylish, ensuring a perfect fit for any wrist. Powered by Rolex’s advanced automatic movement, this model delivers precision and reliability, making it a timeless addition to any luxury collection.', 68289.99, 'Curved End Rubber Strap for Rolex Daytona Deployant - Blue Rubber _ 4 Links by 4 Links.jpg', 'Rolex', 'images\\Rolex Everose Rubber Daytona 126515ln-0004 Black Diamond.jpg', 'old', 'False', NULL, '40mm', 'Automatic, for reliable precision', 'Black with Diamond Hour Markers', 'Black Oysterflex Rubber', 'Crashed max out'),
('749393', '(eBay) Rolex Datejust 41MM Iced Out Rose Gold Arabic Dial ', 'Elevate your style with the Rolex Datejust 41MM Iced Out Rose Gold Arabic Dial (Ref. 126333), a stunning timepiece that blends luxury and functionality. This exquisite watch is a symbol of Rolex\'s renowned craftsmanship and attention to detail, featuring a bold and opulent design that is sure to turn heads.', 30600.00, '(eBay) Rolex Datejust 41MM Iced Out Rose Gold Arabic Dial Ref_ 126333 Full Set.jpg', 'Rolex', 'images\\(eBay) Rolex Datejust 41MM Iced Out Rose Gold Arabic Dial Ref_ 126333 Full Set.jpg', 'old', 'False', NULL, 'Rose Gold', 'Automatic Caliber 3235\r\n', 'Arabic Numerals with a distinctive iced-out design', 'Rose Gold Oyster Bracelet with a folding Oysterclasp', 'TBA'),
('838394', 'LV tambour classic pink stripe', 'Elevate your style with this stunning Louis Vuitton bag, crafted from high-quality brown canvas and enhanced with gleaming gold accents. The standout feature is the strap, proudly adorned with the iconic LV logo, which adds a touch of refined luxury. This versatile piece is designed to complement both formal and casual outfits, making it an essential addition to any wardrobe. With its blend of elegance and functionality, this bag is a perfect choice for those who appreciate the finer things in life.', 228000.23, 'Mens Luxury Watches - High End Designer Timepieces-min.png', 'LV', 'images\\Louis Vuitton Creates A Luxurious Smartwatch And It Looks Exactly As Youd Expect-min.png', 'old', 'False', NULL, '40MM', 'Premium canvas', 'LV logo on the strap\r\n', 'Brown with gold accents', 'Luxurious and sophisticated'),
('8965309', ' Louis Vuitton Tambour Carpe Diem', 'The Tambour Carpe Diem features a unique and bold design that stands out with its intricate details and exceptional quality. The watch\'s dial is a true work of art, showcasing the meticulous attention to detail Louis Vuitton is renowned for. The luxurious materials and exquisite finishes reflect the brand\'s commitment to excellence.\r\n\r\n', 67890.90, 'In-Depth_ The Louis Vuitton Tambour Carpe Diem Is Here To Remind You To Not Get Too Attached-min.png', 'LV', 'images\\In-Depth_ The Louis Vuitton Tambour Carpe Diem Is Here To Remind You To Not Get Too Attached-min.png', 'new', 'true', 23, 'TBA', 'TBA', 'TBA', 'TBA', 'TBA'),
('93840', 'imLouis Vuitton Tambour Steel Mens Bracelet Watch ', '', 32600.90, 'Louis Vuitton Tambour Automatic 4omm Steel Mens Bracelet Watch W1ST10  _ eBay.jpg', 'LV', 'images\\Louis Vuitton Tambour Automatic 4omm Steel Mens Bracelet Watch W1ST10  _ eBay.jpg', 'old', 'False', NULL, '40MM', 'None', 'Classic and robust', 'Steel bracelet', 'Sophisticated and versatile'),
('94003040', 'Audemars Piguet Royal Oak Perpetual Calendar ', 'Available now from a trusted seller on Chrono24, the 2022 Audemars Piguet Royal Oak Perpetual Calendar with a blue dial is a masterpiece of horological innovation and luxury. Priced at , this new timepiece features the iconic \"Grande Tapisserie\" patterned blue dial, encased in a 41mm body, typically in stainless steel or ceramic, depending on the specific model. The perpetual calendar functions are impeccably designed to track day, date, month, moon phase, and leap year, ensuring precision and sophistication. Perfect for collectors and enthusiasts, this watch is a striking combination of modern design and timeless craftsmanship.', 73900.38, 'Audemars Piguet Royal Oak Perpetual Calendar Blue DIal NEW 2022 for $122,586 for sale from a Trusted Seller on Chrono24.jpg', 'AP', 'images\\Audemars Piguet Royal Oak Perpetual Calendar Blue DIal NEW 2022 for $122,586 for sale from a Trusted Seller on Chrono24.jpg', 'old', 'False', NULL, '40MM', 'Perpetual calendar with day, date, month, moon phase, and leap year indication', '41mm', 'Stainless steel or ceramic (depending on model)', 'Blue with \"Grande Tapisserie\" pattern'),
('964882', 'Rolex Day-date 40mm Ice Blue Motif', 'Immerse yourself in the pinnacle of horological excellence with the Rolex Day-Date 40mm featuring the mesmerizing Ice Blue Motif dial. This prestigious model, renowned for its sophistication and elegance, embodies the essence of Rolex\'s masterful craftsmanship.', 62890.83, 'Rolex Watch .jpg', 'Rolex', 'images\\Rolex Day-date 40mm Ice Blue Motif Dial Platinum 228206 Pre-owned 2020.jpg', 'old', 'False', NULL, '40mm', 'Automatic Rolex Caliber 3255\r\n', 'Ice Blue Motif with a sunburst pattern', 'Platinum President Bracelet with concealed Crownclasp', '100 meters');

-- --------------------------------------------------------

--
-- Table structure for table `sales_tb`
--

CREATE TABLE `sales_tb` (
  `user_fullname` varchar(255) NOT NULL,
  `products_ordered` mediumtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_tb`
--

INSERT INTO `sales_tb` (`user_fullname`, `products_ordered`, `price`, `delivery_address`, `order_number`, `order_date`) VALUES
('Vusi Nova', 'Louis Vuitton Tambour Street Diver, Tambour Blossom 35\r\n, Louis XVI Luxusuhr', 99179.00, 'sci-bono', 129919, '2024-09-07 09:46:43'),
('Vusi Nova', 'Louis Vuitton Tambour Street Diver, Tambour Blossom 35\r\n, Louis XVI Luxusuhr', 99179.13, 'sci-bono', 60307, '2024-09-07 09:46:43'),
('Vusi Nova', 'Louis Vuitton Tambour Street Diver, Tambour Blossom 35\r\n, Louis XVI Luxusuhr', 99179.13, 'sci-bono', 361665, '2024-09-07 10:21:12'),
('Vusi Nova', 'Louis Vuitton Tambour Street Diver, Tambour Blossom 35\r\n, Louis XVI Luxusuhr', 99179.13, 'sci-bono', 332348, '2024-09-07 10:21:19'),
('Zama Nkomo', 'Louis Vuitton Tambour Street Diver, Tambour Blossom 35\r\n', 839909.63, 'sci-bono', 428848, '2024-09-17 14:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `user_id` int(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile_number` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT 'images\\profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`user_id`, `user_fullname`, `user_email`, `user_address`, `user_mobile_number`, `user_password`, `user_image`) VALUES
(1, 'Rick Ross', 'Ross@gmail.com', 'miami', '1234567890', '$2y$10$1xMOEk77wdpaX5ANZ4A8kuQA8Cr9cnWGF.ruOyzfg1eChtDzvrOUy', 'images\\profile.jpg'),
(3, 'Vusi Nova', 'Nova@gmail.com', 'west', '1234567890', '$2y$10$h.wvBiWpwznLKTFi8z5Aa.GVPlAhCjv/c9Sb3H3ho3omUzbhrXldq', 'images\\profile.jpg'),
(4, 'Zama Nkomo', 'nkomo@gmail.com', 'Protea Glen', '1234567890', '$2y$10$hCfEM8Sq27rRae1pPvsbtOWNcgYwJdapdo/WiXNG2SbggpGDONl6G', 'images\\profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tb`
--

CREATE TABLE `wishlist_tb` (
  `wish_id` int(255) NOT NULL,
  `product_barcode` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `user` varchar(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist_tb`
--

INSERT INTO `wishlist_tb` (`wish_id`, `product_barcode`, `product_name`, `product_price`, `user`, `timestamp`) VALUES
(5, '329065', 'Tambour Blossom 35\r\n', 15600.78, 'Vusi Nova', '2024-09-01 07:59:16.612941'),
(6, '0654236', 'Louis Vuitton Tambour Street Diver', 88900.56, 'Vusi Nova', '2024-09-01 07:59:20.835919');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_tb`
--
ALTER TABLE `admins_tb`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `products_tb`
--
ALTER TABLE `products_tb`
  ADD PRIMARY KEY (`product_barcode`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_tb`
--
ALTER TABLE `admins_tb`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  MODIFY `wish_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
