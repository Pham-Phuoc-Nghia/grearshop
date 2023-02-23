<div style="width:100%;">
    <h1 align="center" style="color:#F00"> DANH SÁCH SẢN PHẨM</h1> 
  	<div class="search" style="" align="center">
	    <form method="post" action="">
	        <input type="text" name="txtsearch" placeholder="Tìm sản phẩm..." size="35" class="txt"/>
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
		$sql = "select * from sanpham where TenSanPham like '%".$search."%'";
	}
	else
	{
		$sql = "select * from sanpham limit $page1,5";
	}

	$result = DataProvider::ExcuteQuery($sql);
?>
<div style="width:100%">
    <form method="post" action="index.php?a=1">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
            <tr id="tr-list">
                <td>Mã</td>
                <td>Tên</td>
                <td>Hình</td>
                <td>Giá</td>
                <td>Ngày nhập</td>
                <td>SL tồn</td>
                <td>SL bán</td>
                <td>View</td>
                <td>Bị xóa</td>
                <td>Mã Loại</td>
                <td>Mã Hãng</td>
                <td></td>
                <td></td>
            </tr>
            <?php
              while($row = mysqli_fetch_array($result))
              {
                  $masp = $row['MaSanPham'];
                  $tensp = $row['TenSanPham'];
                  $hinh = $row['HinhURL'];
                  $gia = $row['GiaSanPham'];
                  $ngaynhap = $row['NgayNhap'];
                  $slton = $row['SoLuongTon'];
                  $slban = $row['SoLuongBan'];
                  $luocxem = $row['SoLuocXem'];
                  $mota = $row['MoTa'];
                  $bixoa = $row['BiXoa'];
                  $maloaisp = $row['MaLoaiSanPham'];
                  $mahsx = $row['MaHangSanXuat'];
				  

				  
                  $mau ='';
                  if($bixoa == 1)
                  {
                      $mau = 'style="background-color:#999999"';
                  }
            ?>
            <tr <?php echo $mau ?> >
                <td><?php echo $masp ?></td>
                <td><?php echo $tensp?></td>
                <td><img src="../img/San_Pham/<?php echo $hinh?>" width="80" height="60" title="<?php echo $hinh?>" /></td>
                <td><?php echo number_format($gia) ?></td>
                <td><?php echo $ngaynhap?></td>
                <td><?php echo $slton?></td>
                <td><?php echo $slban?></td>
                <td><?php echo $luocxem?></td>
                <td><?php echo $bixoa?></td>
                <td><?php echo $maloaisp ?></td>
                <td><?php echo $mahsx?></td> &nbsp;
                <?php
                if($bixoa == 0)
                {
                ?>

                <td><strong><a href="index.php?a=9&ids=<?php echo $masp ?>">Sửa</a></strong></td>
                <td><strong><a onclick="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')" href="index.php?a=1&idd=<?php echo $masp?>">Xóa</a></strong></td>
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
        $sql2 = "select MaSanPham from sanpham";
        $result2 = DataProvider::ExcuteQuery($sql2);//viết câu truy vấn lấy ra tất cả các dòng
        
        $numrow = mysqli_num_rows($result2); //đếm số lượng dòng
        
        $rowperpage = $numrow/5; //lấy ra số lượng trang để mỗi trang có 5sp
        
        for($i = 1; $i <= CEIL($rowperpage) ;$i++) //cho vòng lặp đi từ 1 đến tổng trang
        //hàm CEIL có nhiệm vụ vd có 22 sản phẩm thì 22/5 = 4.4 nếu không làm tròn thì chỉ sẽ lấy 4 trang nên hàm ceil có tác dụng làm tròn 4.4 thành 5 trang
        {
            echo '<a href="index.php?a=1&page='.$i.'" style="text-decoration:none">'.$i.'&nbsp;&nbsp;</a>';	//tạo phân trang để click vào
        }
    ?>
    
    </div> 
</div>

<?php
	if(isset($_GET['idd']))
	{
		$idd = $_GET['idd'];
		$sqldl = "update sanpham set BiXoa = 1 where MaSanPham ='".$idd."'";
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