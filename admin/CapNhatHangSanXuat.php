<div style="width:100%;">
    <h1 align="center" style="color:#F00">Cập nhật hãng sản xuất</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');

	$maHangSX = $_GET['ids'];
	$sql = "select * from hangsanxuat where MaHangSanXuat=".$maHangSX;
	$result = DataProvider::ExcuteQuery($sql);
	$row = mysqli_fetch_row($result);

	$tenhangsanxuat = $row[1];

	$err='';
	if(isset($_POST['btncapnhat']))
	{
		$tenhsx = $_POST['txtTenHSX'];
		$logo = $_FILES['logo'];
		move_uploaded_file($logo['tmp_name'],'../img/Hang_San_Xuat/'.$logo['name']);

		
		if(empty($tenhsx))
		{
			$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
		}
		else
		{
			$sql =  "Update hangsanxuat set TenHangSanXuat='".$tenhsx."', LogoURL='".$logo['name']."'
			WHERE MaHangSanXuat='".$maHangSX."'";
			
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
            <strong>Mã Hãng sản xuất</strong>
            </br>
            <label>
                <input type="text" id="txtmahsx" name="txtmahsx" disabled="disabled" value="<?php echo $maHangSX?>"  />
            </label>
        </div>
       <div>
            <strong>Tên Hãng sản xuất</strong>
            </br>
            <label>
                <input type="text" id="txtTenHSX" name="txtTenHSX" placeholder="Tên hãng sản xuất" value="<?php echo $tenhangsanxuat ?>"  />
            </label>
        </div>
        
        <div>
            <strong>Logo</strong>
            </br>
            <label>
                <input type="file" id="logo" name="logo" />
            </label>
        </div>

        <div align="center" style="margin-top:10px;" id="btn">
            <input type="submit" name="btncapnhat" value="Cập nhật" class="btn" style="background-color:#000" />
        </div>
    </form>
</div>
<div align="center">
    <?php
        echo $err;
    ?>
</div>



