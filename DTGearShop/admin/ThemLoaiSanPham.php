<div style="width:100%;">
    <h1 align="center" style="color:#F00">Thêm loại sản phẩm</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');
	
	$tenloaisp = '';
	$err='';
	
	if(isset($_POST['btnThem']))
	{
		$tenloaisp = $_POST['txttenloaisp'];

		
		if(empty($tenloaisp))
		{
			$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
		}
		else
		{
			$sql = "INSERT INTO loaisanpham (TenLoaiSanPham, BiXoa) 	              
			VALUES ('".$tenloaisp."',0)";
			
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
            <strong>Tên Loại sản phẩm</strong>
            </br>
            <label>
                <input type="text" id="txttenloaisp" name="txttenloaisp" placeholder="Tên loại sản phẩm" value="<?php echo $tenloaisp ?>"  />
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

