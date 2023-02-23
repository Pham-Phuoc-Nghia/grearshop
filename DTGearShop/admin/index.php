<?php
	include("layout/head.php");
?>

<body>
    <div class="main">
        <?php
            include("layout/header.php");
        ?>

        <div class="content">
            <?php
                include("layout/content_left.php");
            ?>	
            <div class="cotent-right">
                <?php
                    $a = (isset($_GET['a'])) ? $_GET['a'] : 0;
                    
                    switch($a)
                    {
                        case 1:
                            include("DanhSachSanPham.php");
                            break;
                        case 2:
                            include("ThemSanPham.php");
                            break; 
						case 3:
                            include("DanhSachLoaiSanPham.php");
                            break;
                        case 4:
                            include("ThemLoaiSanPham.php");
                            break;
                        case 5:
                            include("DanhSachNhaSanXuat.php");
                            break;
                        case 6:
                            include("ThemNhaSanXuat.php");
                            break;
						case 7:
                            include("QL_TaiKhoan.php");
                            break;
						case 8:
                            include("QL_DonHang.php");
                            break;
                        case 9:
                            include("CapNhatSanPham.php");
                            break;
                        case 10:
                            include("CapNhatHangSanXuat.php");
                            break;
                        case 11:
                            include("CapNhatLoaiSanPham.php");
                            break;
                         case 12:
                            include("ThemTaiKhoan.php");
                            break;
                         case 13:
                            include("GiaoHang.php");
                            break;
                        default:
                            echo '<h1 align="center" style="color:red;">Chào mừng bạn đã đến với trang quản lý<br /><br /><span style="font-family:fontlogo; font-size:50px;">DT Gear Shop<br/>Shop Gaming Gear HCM</span></h1>';
                            break;	
                    }
                ?>
            </div>
        </div>
        <?php 
			include("layout/footer.php");
	 	?>
    </div>
</body>
</html>