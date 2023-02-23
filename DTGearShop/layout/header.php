
<?php
	$check = 0;
	$tong='';
	if(isset($_SESSION['giohang'])) // nếu có tồn tại sản phẩm trong giỏ hàng
	{
		foreach($_SESSION['giohang'] as $id) //duyệt các sản phẩm trong giỏ hàng
		{
			if(isset($id))
			{
				$check = 1; //nếu tồn tại sản phẩn thì bật check lên 1
			}
		}
	}
	if($check != 1) //nếu check khác 1 có nghĩa là không có sản phẩm trong giỏ
	{
		$tong = '0'; //thì gán biến tổng sp bằng 0
	}
	else
	{
		$item = $_SESSION['giohang'];
		$tong = count($item); //ngược lại điếm số lượng sp trong giỏ	
	}
?>
<div class="header">
        <!-- Logo -->
        <div class="logo">
        	<h1><a href="./index.php"> DT Gear Shop </a></h1>
        </div>
        <!-- Logo -->
        <?php
			if(!isset($_SESSION['tenHT']))
			{
		?>
                <div class="formdn" style="margin-top:50px; float:right">
                    <ul>
                        <li><a href="login.php"><img src="img/layout/dangnhap.png" width="20px"/>Đăng nhập</a></li> &nbsp;
                        <li><a href="register.php"><img src="img/layout/dangky.png" width="20px"/>Đăng Ký</a></li>
                    </ul>
                </div>
         <?php
			}
			else
			{
		 ?>
         		<div class="formdn" style="margin-top:50px; float:right">
                    <ul>
                        <li><a href="thongTinCaNhan.php"><img src="img/layout/dangky.png" width="20px"/><strong><?php echo $_SESSION['tenHT'] ?></a></strong></li> &nbsp;
                        
                        <li><a href="logout.php"><img src="img/layout/dangnhap.png" width="20px"/>Đăng xuất</a></li>
                        </br>
                        
                    </ul>
                    
                    <?php
						if(isset($_SESSION['maLoai']) && $_SESSION['maLoai']==1)
						{
					?>
                    		<div align="center" id="div-ico-giohang">
                                <a href="admin/index.php">
                                    <h3>
                                        <img src="img/layout/admin.png" width="20" id="ico-giohang" />Vào Trang Admin
                                    </h3>
                                </a>
                            </div>
                    <?php
						}
						else
						{
					?>
                            <div align="center" id="div-ico-giohang">
                                <a href="gio_hang.php">
                                    <h3>
                                        <img src="img/layout/cart.png" width="20" id="ico-giohang" />GH(<?php echo $tong?>)
                                    </h3>
                                </a>
                            </div>
                    <?php
						}
					?>
                </div>
         <?php
			}
		 ?>
        
        <!--Login-Register-->
        
        <!--Tìm kiếm-->
        <div class="search" style="float:left; margin-top:50px; margin-left:30px">
        	<form method="post" action="index.php?a=5">
                <input type="text" name="txtSearch" placeholder="Tìm sản phẩm..." size="25" id="txt-search"/>
                <input type="submit" name="btnSearch" value="search" id="btn-search"/>
            </form>
        </div>
</div>
















