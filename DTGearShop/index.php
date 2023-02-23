<?php 
	session_start();
	include('layout/head.php');
?>

<body>
<div class="main">
	<!-- Header -->
   	<?php 
		include('layout/header.php');
	?>
    <!-- Banner -->
    <?php 
		include('layout/banner.php');
	?>
    <!-- Content -->
    <div class="content">
    <!-- Content-Left -->
        <div class="content-left">
        <!-- Div Hang San Xuat -->
        <?php 
			include('layout/hangSanXuat.php');
		?>
        <!-- Div Loai San Pham -->
        <?php 
			include('layout/loaiSanPham.php');
		?>  
        </div>
        <!-- Content-right -->
        <div class="content-right">
            <?php
				$a = (isset($_GET['a'])) ? $_GET['a'] : 0;
				switch($a)
				{
					case 2:
						include("sanPhamTheoHang.php");
						break;
					case 3:
						include("sanPhamTheoLoai.php");
						break;
					case 4:
						include("chi_tiet_san_pham.php");
						break;
					case 5:
						include("search.php");
						break;
					case 6:
						include('Lich_Su_Dat_Hang.php');
						break;
					default:
						include("sanPhamMoi.php");
						include("sanPhamBanChay.php");
						break;	
				}			
			?>
        </div>

    </div>
    <div style="clear:both"></div>
    <!-- Footer -->
    <?php 
		include('layout/footer.php');
	?>
    
</div>
</body>
</html>