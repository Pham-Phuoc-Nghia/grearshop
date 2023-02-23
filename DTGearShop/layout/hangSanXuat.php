<div class="hangsanxuat">
    <h2> Hãng sản xuất </h2>
    <ul>
    <?php
		//
		include_once('lib/DataProvider.php');
		$sql = "SELECT MaHangSanXuat,TenHangSanXuat FROM hangsanxuat where BiXoa = 0";
		
		$result = DataProvider::ExcuteQuery($sql);
		while($row = mysqli_fetch_array($result))
		{
			$tenhangsanxuat = $row['TenHangSanXuat'];
			$mahangsanxuat = $row['MaHangSanXuat'];
	?>
    	<li>
        	<a href="index.php?a=2&id=<?php echo $mahangsanxuat?>"> <?php echo $tenhangsanxuat?></a>
        </li>
    <?php
		}
	?>
    </ul>
</div>