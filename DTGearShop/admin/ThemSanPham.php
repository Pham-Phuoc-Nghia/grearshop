<div style="width:100%;">
    <h1 align="center" style="color:#F00">Thêm Sản Phẩm Mới</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');

	$sqlLoaiSP = "select MaLoaiSanPham, TenLoaiSanPham from loaisanpham where BiXoa = 0";
	$sqlHangSX = "select MaHangSanXuat, TenHangSanXuat from hangsanxuat where BiXoa = 0";
	
	$resultLoaiSP = DataProvider::ExcuteQuery($sqlLoaiSP);
	$resultHangSX = DataProvider::ExcuteQuery($sqlHangSX);
	
	
	$tenSP = '';
	$hinh = '';
	$gia = '';
	$slTon = '';
	$moTa = '';
	$maLoaiSP = '';
	$maHangSX = '';
	$err = '';
	
	if(isset($_POST['btnThem']))
	{
		$tenSP = $_POST['txtTenSP'];
		$hinh = $_FILES['hinh'];
		move_uploaded_file($hinh['tmp_name'],'../img/San_Pham/'.$hinh['name']);
		$gia = $_POST['txtGia'];
		$slTon = $_POST['txtSLTon'];
		$moTa = $_POST['txtMoTa'];
		$maLoaiSP = $_POST['slLoaiSP'];
		$maHangSX = $_POST['slHangSX'];	
		
		if(empty($tenSP) || empty($hinh) || empty($gia) || empty($slTon) || empty($moTa) || empty($maLoaiSP) || empty($maHangSX))
		{
			$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
		}
		else
		{
			$sql = "INSERT INTO sanpham (TenSanPham, HinhURL, GiaSanPham, NgayNhap, SoLuongTon, SoLuongBan, SoLuocXem, MoTa, BiXoa, MaLoaiSanPham, MaHangSanXuat) 	              
			VALUES ('".$tenSP."','".$hinh['name']."','".$gia."',NOW(),'".$slTon."',0,0,'".$moTa."',0,'".$maLoaiSP."','".$maHangSX."')";
			
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
            <strong>Tên sản phẩm</strong>
            </br>
            <label>
                <input type="text" id="txtTenSP" name="txtTenSP" placeholder="Tên sản phẩm" value="<?php echo $tenSP ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Hình</strong>
            </br>
            <label>
                <input type="file" id="hinh" name="hinh" />
            </label>
        </div>
        
        <div>
            <strong>Giá</strong>
            </br>
            <label>
                <input type="number" id="txtGia" name="txtGia" placeholder="Gía sản phẩm" value="<?php echo $gia ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Số lượng tồn</strong>
            </br>
            <label>
                <input type="text" id="txtSLTon" name="txtSLTon" placeholder="Số lượng tồn" value="<?php echo $slTon ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Mô tả</strong>
            </br>
            <label>
                <textarea id="txtMoTa" name="txtMoTa"><?php $moTa ?></textarea>
            </label>
        </div>
        
        <div>
            <strong>Loại sản phẩm</strong>
            </br>
            <label>
                <select name="slLoaiSP"> 
                    <?php
                        while($row = mysqli_fetch_array($resultLoaiSP))
                        {
                            $maLoai = $row['MaLoaiSanPham'];
                            $tenLoai = $row['TenLoaiSanPham'];
                            
							if($maLoaiSP==$maLoai)
                            	echo '<option selected="selected" value="'.$maLoai.'">'.$maLoai.' - '.$tenLoai.'</option>';
							else
								echo '<option value="'.$maLoai.'">'.$maLoai.' - '.$tenLoai.'</option>';	
                        }
                    ?>	
                </select>
            </label>
        </div>
        
        <div>
            <strong>Hãng sản xuất</strong>
            </br>
            <label>
                <select name="slHangSX"> 
                    <?php
                        while($row = mysqli_fetch_array($resultHangSX))
                        {
                            $maHang = $row['MaHangSanXuat'];
                            $tenHang = $row['TenHangSanXuat'];
                            
                            if($maHangSX==$maHang)
                            	echo '<option selected="selected" value="'.$maHang.'">'.$maHang.' - '.$tenHang.'</option>';
							else
								echo '<option value="'.$maHang.'">'.$maHang.' - '.$tenHang.'</option>';		
                        }
                    ?>		
                </select>
            </label>
        </div>

        <div align="center" style="margin-top:10px;" id="btn">
            <input type="submit" id="btnThem" name="btnThem" value="Thêm" style="background-color:#000; color:#FFF" />
        </div>
    </form>
</div>

<div align="center">
    <?php
        echo $err;
    ?>
</div>

