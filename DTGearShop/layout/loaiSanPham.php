<div class="loaisanpham">
    <h2> Loại Sản Phẩm </h2>
    <ul>
    <?php
		include_once('lib/DataProvider.php');
		$sql = "SELECT MaLoaiSanPham,TenLoaiSanPham FROM loaisanpham where BiXoa = 0";
		
		$result = DataProvider::ExcuteQuery($sql);

		while($row = mysqli_fetch_array($result))
		{
			$tenloaisp = $row['TenLoaiSanPham'];
			$maloaisp = $row['MaLoaiSanPham'];
	?>
    	<li>
        	<a href="index.php?a=3&id=<?php echo $maloaisp?>"> <?php echo $tenloaisp?></a>
        </li>
    <?php
		}
	?>
    </ul>
</div>