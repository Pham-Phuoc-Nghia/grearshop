<?php 
	session_start();
	include_once('lib/DataProvider.php');
	
	$tenHienThi = "";
	$diaChi = "";
	$dienThoai = "";
	$maBaoMat = "";
	$err = "";

	if(isset($_SESSION['tenDN']) && isset($_SESSION['matKhau']) && isset($_SESSION['tenHT']))
	{
		$sql = "SELECT TenHienThi, DiaChi, DienThoai FROM taikhoan WHERE BiXoa=0 AND TenDangNhap='".$_SESSION['tenDN']."'";
		$result = DataProvider::ExcuteQuery($sql);
		
		$row = mysqli_fetch_row($result);
		
		$tenHienThi = $row[0];
		$diaChi = $row[1];
		$dienThoai = $row[2];
		
		if(isset($_POST['btnCapNhat']))
		{
			$tenHienThi = $_POST['txtTenHienThi'];
			$diaChi = $_POST['txtDiaChi'];
			$dienThoai = $_POST['txtDienThoai'];
			$maBaoMat = $_POST['txtMaBaoMat'];
			if(empty($tenHienThi) || empty($diaChi) || empty($dienThoai))
			{
				$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
			}
			
			
			else if(empty($maBaoMat))
			{
				$err = "<p style='color:red'>Vui lòng nhập mã bảo mật.</p>";
			}

			else if($maBaoMat != $_SESSION['code'])
			{
				$err = "<p style='color:red'>Mã bảo mật không đúng.</p>";
			}
			
			
			else
			{
				$sql = "Update taikhoan set TenHienThi='".$tenHienThi."', DiaChi='".$diaChi."', DienThoai='".$dienThoai."' WHERE TenDangNhap='".$_SESSION['tenDN']."'";
				
				DataProvider::ExcuteQuery($sql);
				$err = "<p style='color:red'>Cập nhật thành công.</p>";	
			}
		}
	}
	else
	{
		header('location:index.php');
	}
	
	include("layout/head.php");	
?>
<body>
<div class="main">
	<!-- Header -->
   	<?php 
		include('layout/header.php');
	?>
    <!-- Content -->
    <div class="content">
    	<div class="frmDangKy">
            <h1 align="center">Cập nhật thông tin</h1>
            <form method="post" action="cap_Nhat_Thong_Tin_TK.php">
                <div>
                	<strong>Tên hiển thị</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtTenHienThi" name="txtTenHienThi" placeholder="Tên hiển thị" value="<?php echo $tenHienThi ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Địa chỉ</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtDiaChi" name="txtDiaChi" placeholder="Địa chỉ" value="<?php echo $diaChi ?>" size="32" />
                    </label>
                </div>
                
                <div>
                	<strong>Điện thoại</strong>
                    </br>
                	<label>
                    	<input type="text" id="txtDienThoai" name="txtDienThoai" placeholder="0123456789" value="<?php echo $dienThoai ?>" size="32" />
                    </label>
                </div>
                
                <div>
                    <strong>Mã bảo mật</strong>
                    <div id="div-capcha">
                    	<?php
                    		$text = rand(1000,100000);
                    		$_SESSION['code'] = $text;
                    		echo $_SESSION['code'];
                    	?>
                    </div>
                	<label>
                    	<input type="text" id="txtMaBaoMat" name="txtMaBaoMat" placeholder="Nhập mã bảo mật" value="<?php $maBaoMat ?>"  />
                    </label>
                </div>

                <div align="center" style="margin-top:10px;" id="btn">
                	<label>
                    	<input type="submit" id="btnCapNhat" name="btnCapNhat" value="Cập nhật" />
                    </label>
                    <label>
                    	<?php
							if($_SESSION['maLoai'] != 1)
							{
						?>
                    			<a href="index.php"><input type="button" value="Quay về" /></a>
                        <?php
							}
							else
							{
						?>
                        		<a href="admin/index.php"><input type="button" value="Quay về" /></a>
                        <?php
							}
						?>
                    </label>
                </div>
            </form>
        </div>
        
        <div align="center">
        	<?php
				echo $err;
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