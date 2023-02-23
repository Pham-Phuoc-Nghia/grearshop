<div style="width:100%;">
    <h1 align="center" style="color:#F00">Cập nhật sản phẩm</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');
	$sqlLoaiSP = "select MaLoaiSanPham, TenLoaiSanPham from loaisanpham";
	$sqlHangSX = "select MaHangSanXuat, TenHangSanXuat from hangsanxuat";
	
	$resultLoaiSP = DataProvider::ExcuteQuery($sqlLoaiSP);
	$resultHangSX = DataProvider::ExcuteQuery($sqlHangSX);

	$masp = $_GET['ids'];
	$sql = "select * from sanpham where MaSanPham=".$masp;
	$result = DataProvider::ExcuteQuery($sql);
	$row = mysqli_fetch_row($result);

	$MaSp = $row[0];
	$TenSp = $row[1];
	$Hinh = $row[2];
	$Gia = $row[3];
	$SLTon = $row[5];
	$MoTa = $row[8];
	$MaLoai = $row[10];
	$MaHang = $row[11];
	$err='';
	if(isset($_POST['btncapnhat']))
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
			$sql =  "Update sanpham set TenSanPham='".$tenSP."', HinhURL='".$hinh['name']."', GiaSanPham='".$gia."' 
			, NgayNhap=NOW() , SoLuongTon='".$slTon."' , MoTa='".$moTa."' , MaLoaiSanPham='".$maLoaiSP."' , MaHangSanXuat='".$maHangSX."' 
			WHERE MaSanPham='".$masp."'";
			
			$result = DataProvider::ExcuteQuery($sql);
			
			if($result == true)
			{
				$err = "<p style='color:red'>Cập nhật thành công.</p>";	
			}
			else
			{
				$err = "<p style='color:red'>Cập nhật thất bại.</p>";	
			}
		}
	}

?>

<div class="frmDangKy">
    <form method="post" enctype="multipart/form-data">
    	<div>
            <strong>Mã sản phẩm</strong>
            </br>
            <label>
                <input type="text" id="txtTenSP" name="txtMasp" placeholder="Mã sản phẩm" disabled="disabled" value="<?php echo $MaSp?>"  />
            </label>
        </div>
        <div>
            <strong>Tên sản phẩm</strong>
            </br>
            <label>
                <input type="text" id="txtTenSP" name="txtTenSP" placeholder="Tên sản phẩm" value="<?php echo $TenSp?>"  />
            </label>
        </div>
        
        <div>
            <strong>Hình</strong>
            </br>
            <label>
                <input type="file" id="hinh" name="hinh"/>
            </label>
        </div>
        
        <div>
            <strong>Giá</strong>
            </br>
            <label>
                <input type="number" id="txtGia" name="txtGia" placeholder="Gía sản phẩm" value="<?php echo $Gia?>"  />
            </label>
        </div>
        
        <div>
            <strong>Số lượng tồn</strong>
            </br>
            <label>
                <input type="text" id="txtSLTon" name="txtSLTon" placeholder="Số lượng tồn" value="<?php echo $SLTon?>"  />
            </label>
        </div>
        
        <div>
            <strong>Mô tả</strong>
            </br>
            <label>
                <textarea id="txtMoTa" name="txtMoTa"><?php echo $MoTa?></textarea>
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
                            
							if($MaLoai==$maLoai)
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
                            
                            if($MaHang==$maHang)
                            	echo '<option selected="selected" value="'.$maHang.'">'.$maHang.' - '.$tenHang.'</option>';
							else
								echo '<option value="'.$maHang.'">'.$maHang.' - '.$tenHang.'</option>';		
                        }
                    ?>		
                </select>
            </label>
        </div>

        <div align="center" style="margin-top:10px;" id="btn">
            <input type="submit" name="btncapnhat" value="Cập nhật" />
        </div>
    </form>
</div>
<div align="center">
    <?php
        echo $err;
    ?>
</div>



