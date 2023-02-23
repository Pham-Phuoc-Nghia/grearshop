<div style="width:100%;">
    <h1 align="center" style="color:#F00">Cập nhật loại sản phẩm</h1> 
    
</div>

<?php
	include_once('../lib/DataProvider.php');

	$maloaisp = $_GET['ids'];
	$sql = "select * from loaisanpham where MaLoaiSanPham=".$maloaisp;
	$result = DataProvider::ExcuteQuery($sql);
	$row = mysqli_fetch_row($result);

	$tenloaisp = $row[1];

	$err='';
	if(isset($_POST['btncapnhat']))
	{
		$tenloaisp = $_POST['txttenloaisp'];

		if(empty($tenloaisp))
		{
			$err = "<p style='color:red'>Vui lòng điền đầy đủ thông tin.</p>";
		}
		else
		{
			$sql =  "Update loaisanpham set TenLoaiSanPham='".$tenloaisp."'
			WHERE MaLoaiSanPham='".$maloaisp."'";
			
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
            <strong>Mã Loại Sản Phẩm</strong>
            </br>
            <label>
                <input type="text" id="txtmaloaisp" name="txtmaloaisp" disabled="disabled" value="<?php echo $maloaisp?>"  />
            </label>
        </div>
       <div>
            <strong>Tên Loại Sản Phẩm</strong>
            </br>
            <label>
                <input type="text" id="txttenloaisp" name="txttenloaisp" placeholder="Tên hãng sản xuất" value="<?php echo $tenloaisp ?>"  />
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



