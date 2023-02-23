<div style="width:100%;">
    <h1 align="center" style="color:#F00"> DANH SÁCH TÀI KHOẢN</h1> 
  	<div class="search" style="" align="center">
	    <form method="post" action="">
	        <input type="text" name="txtsearch" placeholder="Tìm tài khoản(theo email)..." size="35" class="txt"/>
	        <input type="submit" name="btnsearch" value="search" class="btn"/>
	    </form>
	</div>
</div>
<?php
	include('../lib/DataProvider.php');
	
	$page = isset($_GET['page']) ? $_GET['page'] : ''; //lấy ra tham số page trên đường url
	
	if($page =="" || $page =='1') //nếu page là rỗng hay page là 1
	{
		$page1 = 0;//thì set page1 = 0 ý là limit 0,5 là trang đầu tiên
	}
	else
	{
		$page1=($page * 5)- 5;	// ngược lại ví dụ ta bấm vào page 2 thì 2*5 -5 = 5 là sẽ lấy kể từ vị trí 5 5 sp
	}

	
	if(isset($_POST['btnsearch']))
	{
		$search = $_POST['txtsearch'];
		$sql = "select * from taikhoan where Email like '%".$search."%'";
	}
	else
	{
		$sql = "select * from taikhoan limit $page1,5";
	}

	$result = DataProvider::ExcuteQuery($sql);
?>
<div style="width:100%">
    <form method="post" action="index.php?a=1">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
            <tr id="tr-list">
                <td>Mã tài khoản</td>
                <td>Tên đăng nhập</td>
                <td>Mật khẩu</td>
                <td>Tên hiển thị</td>
                <td>Địa chỉ</td>
                <td>Điện thoại</td>
                <td>Email</td>
                <td>Bi Xóa</td>
                <td>Mã loại tài khoản</td>
                <td></td>
            </tr>
            <?php
              while($row = mysqli_fetch_array($result))
              {
                  $mataikhoan = $row['MaTaiKhoan'];
                  $tendn = $row['TenDangNhap'];
                  $matkhau = $row['MatKhau'];
                  $tenhienthi = $row['TenHienThi'];
                  $diachi = $row['DiaChi'];
                  $dienthoai = $row['DienThoai'];
                  $email = $row['Email'];
                  $bixoa = $row['BiXoa'];
                  $maloaitaikhoan = $row['MaLoaiTaiKhoan'];
				  				  
                  $mau ='';
                  if($bixoa == 1)
                  {
                      $mau = 'style="background-color:#999999"';
                  }
            ?>
            <tr <?php echo $mau ?> >
                <td><?php echo $mataikhoan ?></td>
                <td><?php echo $tendn?></td>
                <td><?php echo $matkhau ?></td>
                <td><?php echo $tenhienthi ?></td>
                <td><?php echo $diachi?></td>
                <td><?php echo $dienthoai ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $bixoa==1?"Có":"Không" ?></td>
                <td><?php echo $maloaitaikhoan==1?"Admin":"user" ?></td>

                 <?php
                if($bixoa == 0)
                {
                ?>
                
                <td><strong><a onclick="return confirm('Bạn có chắc chắn muốn tài khoản này?')" href="index.php?a=7&idd=<?php echo $mataikhoan?>">Xóa</a></strong></td>

                 <?php 
                }
                else
                {
                 ?>
                 <td> </td>
                 <td> </td>
                 <?php
                }
                 ?>
            </tr>
                <?php
                  }
				                    
                ?>
        </table>
    </form>
    <div class="page" align="center">
    <?php
        $sql2 = "select * from taikhoan";
        $result2 = DataProvider::ExcuteQuery($sql2);//viết câu truy vấn lấy ra tất cả các dòng
        
        $numrow = mysqli_num_rows($result2); //đếm số lượng dòng
        
        $rowperpage = $numrow/5; //lấy ra số lượng trang để mỗi trang có 5sp
        
        for($i = 1; $i <= CEIL($rowperpage) ;$i++) //cho vòng lặp đi từ 1 đến tổng trang
        //hàm CEIL có nhiệm vụ vd có 22 sản phẩm thì 22/5 = 4.4 nếu không làm tròn thì chỉ sẽ lấy 4 trang nên hàm ceil có tác dụng làm tròn 4.4 thành 5 trang
        {
            echo '<a href="index.php?a=7&page='.$i.'" style="text-decoration:none">'.$i.'&nbsp;&nbsp;</a>';	
        }
    ?>
    
    </div> 
</div>

<?php
	if(isset($_GET['idd']))
	{
		$idd = $_GET['idd'];
		$sqldl = "update taikhoan set BiXoa = 1 where MaTaiKhoan ='".$idd."'";
		$resultdl = DataProvider::ExcuteQuery($sqldl);
		if($resultdl == true)
		{
		?>
        	<script type="text/javascript">
				alert("Xóa thành công");
			</script>
        <?php	
		}
		else
		{
		?>
        	<script type="text/javascript">
				alert("Xóa không thành công");
			</script>
        <?php	
		}
	}
?>