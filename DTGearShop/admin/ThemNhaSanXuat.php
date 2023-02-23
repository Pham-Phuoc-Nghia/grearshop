<div style="width:100%;">
    <h1 align="center" style="color:#F00">Thêm Nhà sản xuất</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');
	
	$tenhsx = '';
	$logo = '';
	$err='';
	
	if(isset($_POST['btnThem']))
	{
		$tenhsx = $_POST['txtTenHSX'];
		$logo = $_FILES['logo'];
		move_uploaded_file($logo['tmp_name'],'../img/Hang_San_Xuat/'.$logo['name']);
		
		if(empty($tenhsx) || empty($logo))
		{
			$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
		}
		else
		{
			$sql = "INSERT INTO hangsanxuat (TenHangSanXuat, LogoURL,BiXoa) 	              
			VALUES ('".$tenhsx."','".$logo['name']."',0)";
			
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
            <strong>Tên Hãng sản xuất</strong>
            </br>
            <label>
                <input type="text" id="txtTenHSX" name="txtTenHSX" placeholder="Tên hãng sản xuất" value="<?php echo $tenhsx ?>"  />
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
            <input type="submit" id="btnThem" name="btnThem" value="Thêm" class="btn" style="background-color:black" />
        </div>
    </form>
</div>

<div align="center">
    <?php
        echo $err;
    ?>
</div>

