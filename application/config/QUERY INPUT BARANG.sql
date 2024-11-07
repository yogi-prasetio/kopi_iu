-- DATA BAHAN MINUMAN
INSERT INTO `tbl_bahan`(`nama_bahan`, `satuan`, `stok`, `harga`, `LT`) VALUES 
('Espresso','gram',25000,65,2),
('Creamer','gram',20000,33.500,2),
('SKM','ml',30000,13,2),
('Es Cream','ml',20000,23.125,3),
('Fresh Milk','ml',35000,8.350,7),
('Sirup Vanilla','ml',15000,104,4),
('Sirup Caramel','ml',15000,104,4),
('Sirup Strawberry','ml',15000,104,4),
('Sirup Mojito','ml',15000,104,4),
('Sirup Melon','ml',15000,104,4),
('Sunquick','ml',15000,104,1),
('Sirup Jenisa','ml',15000,104,1),
('Soda','ml',15000,140,3),
('Sirup Blue Curacao','ml',15000,104,2),
('Coklat','gram',21000,160,2),
('Mango','ml',15000,104,3),
('Hazelnut','ml',15000,104,3),
('Taro','gram',15000,230,3),
('Green Tea','gram',17000,230,3),
('Thai Tea','gram',15000,185,3),
('Butterscotch','ml',15000,104,3),
('Es Batu','gram',40000,8,2);



-- NEW INPUT
INSERT INTO `tbl_bahan`(`nama_bahan`, `satuan`, `jumlah`, `LT`) VALUES 
('Espresso', "Liter", 20, 2),
('Robusta', "Liter", 25, 2),
('Creamer', "Liter", 25, 2),
('SKM', "Liter", 25, 2),
('Es Cream', "Liter", 20, 2),
('Fresh Milk', "Liter", 15, 2),
('Sirup Vanilla', "Liter", 8, 2),
('Sirup Strawberry', "Liter", 13, 2),
('Sirup Mojito', "Liter", 13, 2),
('Sirup Caramel', "Liter", 11, 2),
('Sirup Melon', "Liter", 11, 2),
('Sunquick', "Liter", 7, 2),
('Sirup Jenisa', "Liter", 10, 2),
('Soda', "Liter", 30, 2),
('Sirup Blue Curacao', "Liter", 20, 2),
('Coklat', "Liter", 25, 2),
('Lemon Tea', "Liter", 20, 2),
('Jeruk Lemon', "Kg", 30, 2),
('Jeruk Nipis', "Kg", 28, 2),
('Buah Strawberry', "Kg", 30, 2),
('Apple Tea', "Kg", 20, 2),
('Strawberry Tea', "Kg", 22, 2),
('Taro', "Liter", 20, 2),
('Green Tea', "Liter", 12, 2),
('Thai Tea', "Liter", 20, 2),
('Red Velvet', "Liter", 18, 2),
('Amidis Botol', "Liter", 20, 2),
('Galon Amidis', "Liter", 70, 2),
('Galon Isi Ulang', "Liter", 50, 1);


-- SELECT AVERAGE BY MONTH
SELECT SUM(jumlah_bahan) FROM `tbl_pengeluaran` WHERE id_bahan=5 AND MID(tgl_pengeluaran, 1, 7) = '2023-08'

        $query = "SELECT `tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `tgl_pengeluaran`, `LT`, SUM(CASE WHEN MID(`tbl_pengeluaran`.`tgl_pengeluaran`, 1,7)='".$bulan."' THEN `tbl_pengeluaran`.`jumlah_bahan` ELSE 0 END) AS 'jumlah' FROM `tbl_bahan` JOIN `tbl_pengeluaran` ON `tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan` GROUP BY `nama_bahan`";

SELECT `tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `tgl_pengeluaran`, `LT`, SUM(CASE WHEN tgl_pengeluaran BETWEEN (NOW() - INTERVAL '1' YEAR) AND NOW() THEN `tbl_pengeluaran`.`jumlah_bahan` ELSE 0 END) AS 'jumlah' FROM `tbl_bahan` JOIN `tbl_pengeluaran` ON `tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan` GROUP BY `nama_bahan`


SELECT `tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `LT`, 
	SUM(`tbl_pengeluaran`.`jumlah_bahan`) AS 'jumlah' 
FROM `tbl_bahan` 
	JOIN `tbl_pengeluaran` ON `tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan` 
    WHERE (tgl_pengeluaran BETWEEN (DATE_FORMAT(CURDATE(), "Y-m") - INTERVAL '1' YEAR) AND NOW()) 
    GROUP BY `nama_bahan`;

   SELECT PERIOD_ADD(DATE_FORMAT(NOW(), "%Y%m"),-12)


-- SELECT JML TAHUN TERAKHIR
SELECT `tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `LT`, 
	SUM(`tbl_pengeluaran`.`jumlah_bahan`) AS 'jumlah' 
FROM `tbl_bahan` 
	JOIN `tbl_pengeluaran` ON `tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan` 
    WHERE (DATE_FORMAT(tgl_pengeluaran, "%Y-%m") BETWEEN "2022-09" AND "2023-09") 
    GROUP BY `nama_bahan`;

SELECT `tbl_pengeluaran`.`id_bahan`, `nama_bahan`, `satuan`, `LT`, 
	SUM(`tbl_pengeluaran`.`jumlah_bahan`) AS jumlah 
FROM (`tbl_bahan`, `tbl_mrp`) JOIN `tbl_pengeluaran` ON `tbl_bahan`.`id_bahan`=`tbl_pengeluaran`.`id_bahan` WHERE DATE_FORMAT(`tgl_pengeluaran`, '%Y-%m') BETWEEN '2022-09' AND '2023-09' GROUP BY `nama_bahan`