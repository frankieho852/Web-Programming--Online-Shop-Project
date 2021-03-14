


CREATE TABLE `tempcart1` (
  `id` int(99) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tempcart1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tempcart1`
  MODIFY id int(99) NOT NULL AUTO_INCREMENT;
