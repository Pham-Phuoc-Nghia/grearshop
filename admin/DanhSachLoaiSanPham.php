<div style="width:100%;">
    <h1 align="center" style="color:#F00"> DANH SÁCH LOẠI SẢN PHẨM</h1> 
    <div class="search" style="" align="center">
      <form method="post" action="">
          <input type="text" name="txtsearch" placeholder="Tìm loại sản phẩm..." size="35" class="txt"/>
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
    $page1=($page * 5)- 5;  // ngược lại ví dụ ta bấm vào page 2 thì 2*5 -5 = 5 là sẽ lấy kể từ vị trí 5 5 sp
  }

  
  if(isset($_POST['btnsearch']))
  {
    $search = $_POST['txtsearch'];
    $sql = "select * from loaisanpham where TenLoaiSanPham like '%".$search."%'";
  }
  else
  {
    $sql = "select * from loaisanpham limit $page1,5";
  }

  $result = DataProvider::ExcuteQuery($sql);
?>
<div style="width:100%">
    <form method="post" action="index.php?a=1">
        <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
            <tr id="tr-list">
                <td>Mã Loại Sản Phẩm</td>
                <td>Tên Loại Sản Phẩm</td>
                <td>Bị xóa</td>
                <td></td>
                <td></td>
            </tr>
            <?php
              while($row = mysqli_fetch_array($result))
              {
                  $maloaisp = $row['MaLoaiSanPham'];
                  $tenloaisp = $row['TenLoaiSanPham'];
                  $bixoa = $row['BiXoa'];

                  $mau ='';
                  if($bixoa == 1)
                  {
                      $mau = 'style="background-color:#999999"';
                  }
            ?>
            <tr <?php echo $mau ?> >
                <td><?php echo $maloaisp ?></td>
                <td><?php echo $tenloaisp?></td>
                <td><?php echo $bixoa ?></td>
              
              <?php
                if($bixoa == 0)
                {
                ?>

                <td><strong><a href="index.php?a=11&ids=<?php echo $maloaisp ?>">Sửa</a></strong></td>
                <td><strong><a onclick="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')" href="index.php?a=3&idd=<?php echo $maloaisp?>">Xóa</a></strong></td>

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
        $sql2 = "select * from loaisanpham";
        $result2 = DataProvider::ExcuteQuery($sql2);//viết câu truy vấn lấy ra tất cả các dòng
        
        $numrow = mysqli_num_rows($result2); //đếm số lượng dòng
        
        $rowperpage = $numrow/5; //lấy ra số lượng trang để mỗi trang có 5sp
        
        for($i = 1; $i <= CEIL($rowperpage) ;$i++) //cho vòng lặp đi từ 1 đến tổng trang
        //hàm CEIL có nhiệm vụ vd có 22 sản phẩm thì 22/5 = 4.4 nếu không làm tròn thì chỉ sẽ lấy 4 trang nên hàm ceil có tác dụng làm tròn 4.4 thành 5 trang
        {
            echo '<a href="index.php?a=3&page='.$i.'" style="text-decoration:none">'.$i.'&nbsp;&nbsp;</a>'; 
        }
    ?>
    
    </div> 
</div>

<?php
  if(isset($_GET['idd']))
  {
    $idd = $_GET['idd'];
    $sqldl = "update loaisanpham set BiXoa = 1 where MaLoaiSanPham ='".$idd."'";
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