--
-- Table structure for table  tblproduct 
--

CREATE TABLE tblproduct1 (
 id int(8) NOT NULL,
  name varchar(255) NOT NULL,
  code varchar(255) NOT NULL,
  image text NOT NULL,
  price double(10,2) NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE oview (
customer varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  phone int(8) NOT NULL,
  address  varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE hkorder (
 lastname varchar(255) NOT NULL,
firstname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  phone int(8) NOT NULL,
  regions_hk  varchar(255) NOT NULL,
  hkaddress  varchar(255) NOT NULL,
   hkaddress1  varchar(255) NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE inorder (
 lastname varchar(255) NOT NULL,
firstname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  phone int(8) NOT NULL,
  inaddress  varchar(255) NOT NULL,
  inaddress1  varchar(255) NOT NULL,
  city  varchar(255) NOT NULL,
  state  varchar(255) NOT NULL,
  zip  varchar(255) NOT NULL,
  county  varchar(255) NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table  tblproduct 
--

INSERT INTO tblproduct1 ( id ,  name ,  code ,  image ,  price ) VALUES
(1, 'FinePix Pro2 3D Camera', '3DcAM01', 'product-images/camera.jpg', 1500.00),
(2, 'EXP Portable Hard Drive', 'USB02', 'product-images/external-hard-drive.jpg', 800.00),
(3, 'Luxury Ultra thin Wrist Watch', 'wristWear03', 'product-images/watch.jpg', 300.00),
(4, 'XP 1155 Intel Core Laptop', 'LPN45', 'product-images/laptop.jpg', 800.00);


INSERT INTO  oview  ( customer ,  email ,  phone ,  address ) VALUES
('Chan tai', 'abcd@gmail.com', '8465-1234', 'sha tin'),
('Big Ben', 'qqq@gmail.com', '8888-9999', 'HKUST'),
('fan wing', 'thu@gmail.com', '1234-5678', 'Mong Kok'),
('tracy lau', 'hjk@gmail.com', '7412-8963', 'Wan chai');

--
-- Indexes for table  tblproduct 
--
ALTER TABLE tblproduct1
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY product_code (code);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table  tblproduct 
--
ALTER TABLE tblproduct1
  MODIFY id int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;