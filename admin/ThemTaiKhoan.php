<div style="width:100%;">
    <h1 align="center" style="color:#F00">Thêm Tài Khoản Mới</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');

	$sqlloaitaikhoan = "select MaLoaiTaiKhoan, TenLoaiTaiKhoan from loaitaikhoan where BiXoa = 0";
	
	$resultloaitaikhoan = DataProvider::ExcuteQuery($sqlloaitaikhoan);

	
	$tendn = '';
	$matkhau = '';
	$tenhienthi = '';
	$diachi = '';
	$dienthoai = '';
	$email = '';
	$maloaitaikhoan = '';
	$err = '';
	
	if(isset($_POST['btnThem']))
	{
		$tendn = $_POST['txttendn'];
		$matkhau = $_POST['txtmatkhau'];
		$tenhienthi = $_POST['txttenhienthi'];
		$diachi = $_POST['txtdiachi'];
		$dienthoai = $_POST['txtdienthoai'];
		$email = $_POST['txtemail'];	
        $maloaitaikhoan = $_POST['slloaitaikhoan'];    
		
		if(empty($tendn) || empty($matkhau) || empty($tenhienthi) || empty($email))
		{
			$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
		}
		else
		{
			$sql = "INSERT INTO taikhoan (TenDangNhap, MatKhau, TenHienThi, DiaChi, DienThoai, Email, BiXoa, MaLoaiTaiKhoan) 	              
			VALUES ('".$tendn."','".$matkhau."','".$tenhienthi."','".$diachi."','".$dienthoai."','".$email."',0,'".$maloaitaikhoan."')";
			
			$result = DataProvider::ExcuteQuery($sql);
			
			if($result == true)
			{
				$err = "<p style='color:red'>Thêm thành công.</p>";	
			}
			else
			{
				$err = "<p style='color:red'>Thêm thất bại.</p>";	
			}
		}
	}
?>

<div class="frmDangKy">
    <form method="post" enctype="multipart/form-data">
        <div>
            <strong>Tên đăng nhập</strong>
            </br>
            <label>
                <input type="text" id="txttendn" name="txttendn" placeholder="Nhập Tên đăng nhập" value="<?php echo $tendn ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Mật khẩu</strong>
            </br>
            <label>
                <input type="text" id="txtmatkhau" name="txtmatkhau" placeholder="Nhập Mật khẩu" value="<?php echo $matkhau ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Tên hiển thị</strong>
            </br>
            <label>
                <input type="text" id="txttenhienthi" name="txttenhienthi" placeholder="Nhập Tên hiển thị" value="<?php echo $tenhienthi ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Địa chỉ</strong>
            </br>
            <label>
                <input type="text" id="txtdiachi" name="txtdiachi" placeholder="Nhập Địa chỉ" value="<?php echo $diachi ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Điện thoại</strong>
            </br>
            <label>
                 <input type="text" id="txtdienthoai" name="txtdienthoai" placeholder="Nhập Điện thoại" value="<?php echo $dienthoai ?>"  />
            </label>
        </div>

        <div>
            <strong>Email</strong>
            </br>
            <label>
                 <input type="email" id="txtemail" name="txtemail" placeholder="Nhập Email" value="<?php echo $email ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Loại Tài khoản</strong>
            </br>
            <label>
                <select name="slloaitaikhoan"> 
                    <?php
                        while($row = mysqli_fetch_array($resultloaitaikhoan))
                        {
                            $maLoaitk = $row['MaLoaiTaiKhoan'];
                            $tenLoaitk = $row['TenLoaiTaiKhoan'];
                            
							if($maLoaitk==$maloaitaikhoan)
                            	echo '<option selected="selected" value="'.$maLoaitk.'">'.$maLoaitk.' - '.$tenLoaitk.'</option>';
							else
								echo '<option value="'.$maLoaitk.'">'.$maLoaitk.' - '.$tenLoaitk.'</option>';	
                        }
                    ?>	
                </select>
            </label>
        </div>

        <div align="center" style="margin-top:10px;" id="btn">
            <input type="submit" id="btnThem" name="btnThem" value="Thêm" style="background-color: black" class="btn" />
        </div>
    </form>
</div>

<div align="center">
    <?php
        echo $err;
    ?>
</div>

