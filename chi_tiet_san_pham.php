<?php
	include_once('lib/DataProvider.php');
	$masp = $_GET['id'];
	
	$tenSP ='';
	$hinh = '';
	$gia = '';
	$soLuongBan = '';
	$soLuotXem = '';
	$moTa = '';
	$tenHangSX = '';
	$tenLoaiSP = '';
	$maLoaiSP = '';
	$maHangSX = '';
	$soLuongTon = '';
	
	$sql = "SELECT TenSanPham, HinhURL, GiaSanPham, SoLuongBan, SoLuocXem, MoTa, hangsanxuat.TenHangSanXuat, loaisanpham.TenLoaiSanPham, loaisanpham.MaLoaiSanPham, hangsanxuat.MaHangSanXuat,sanpham.MaSanPham, sanpham.SoLuongTon FROM `sanpham`, hangsanxuat, loaisanpham WHERE sanpham.MaLoaiSanPham = loaisanpham.MaLoaiSanPham and sanpham.MaHangSanXuat = hangsanxuat.MaHangSanXuat and sanpham.MaSanPham=".$masp;
	$result = DataProvider::ExcuteQuery($sql);
	$row = mysqli_fetch_row($result);
	
	$tenSP = $row[0];
	$hinh = $row[1];
	$gia = $row[2];
	$soLuongBan = $row[3];
	$soLuotXem = $row[4];
	$moTa = $row[5];
	$tenHangSX = $row[6];
	$tenLoaiSP = $row[7];
	$maLoaiSP = $row[8];
	$maHangSX = $row[9];
	$soLuongTon = $row[11];
?>
<div>
    <div style="float:left">
        <img src="img/San_Pham/<?php echo $hinh?>" width="500px" id="zoom"/>
    </div>
    <div style="width:316px; float:left; margin-left: 20px;">
        <h1><?php echo $tenSP ?></h1>
        <hr/>
        <h2 style="color:#F00">Giá:&nbsp;<?php echo number_format($gia)?> VNĐ</h2>
        <h3 style="color:#F00">Tình trạng: <?php echo ($soLuongTon>0)?"Còn hàng":"Không kinh doanh" ?> </h3>
        <h3>Số lượng bán: <?php echo $soLuongBan ?> </h3>
        <h3>Số lượt xem: <?php echo $soLuotXem ?> </h3>
        <h2>Nhà Sản Xuất: <?php echo $tenHangSX ?> </h2>
        <h2>Loại sản phẩm: <?php echo $tenLoaiSP ?> </h2>
    </div>
</div>
<div style="clear:both"></div>
        
<div>
    <?php
        if(isset($_SESSION['tenDN']))
        {
    ?>	
            <a href="them_SanPham_VaoGio.php?id=<?php echo $row[10]?>">
                <input type="button" value="Thêm vào giỏ" name="btnmua"
                         style="color:#FFF; background-color:#F30; width:520px; height:50px; font-size:20px"/>
            </a>
    <?php
        }
        else
        {
	?>
    		<a href="login.php">
                <input type="button" value="Bạn phải đăng nhập để mua hàng"
                         style="color:#FFF; background-color:#F30; width:520px; height:50px; font-size:20px"/>
            </a>
    <?php   
        }
    ?>
</div>    
        
<div>
     <hr/>
     <h2>Mô Tả Sản Phẩm</h2>
     <hr/>
     <h1><?php echo $tenSP ?></h1>
     <h3> <?php echo $moTa ?></h3>
</div>
       


<div class="div-sp-cungloai">
    <hr/>
    <h4 class="fm-h4">Sản phẩm cùng loại</h4>
    <?php
        $sql = "SELECT MaSanPham,TenSanPham, HinhURL, GiaSanPham FROM sanpham WHERE BiXoa=0 AND MaSanPham<>$masp AND MaLoaiSanPham=$maLoaiSP ORDER by NgayNhap DESC LIMIT 0,4";
        $result = DataProvider::ExcuteQuery($sql);
        
        while($row = mysqli_fetch_array($result))
        {
            $MaSanPham = $row['MaSanPham'];
            $TenSanPham = $row['TenSanPham'];
            $HinhURL = $row['HinhURL'];
            $Gia = $row['GiaSanPham'];
    ?>
            <div class="sp sp-cungloai">
                <?php
                    include('layout/thumpsanpham.php');
                ?>
            </div>
	<?php
        } 
    ?>
</div>
  

<div class="div-sp-cungloai">
    <h4 class="fm-h4">Sản phẩm cùng hãng</h4>
    <?php
        $sql = "SELECT MaSanPham,TenSanPham, HinhURL, GiaSanPham FROM sanpham WHERE BiXoa=0 AND MaSanPham<>$masp AND MaHangSanXuat=$maHangSX ORDER by NgayNhap DESC LIMIT 0,4";
        $result = DataProvider::ExcuteQuery($sql);
        
        while($row = mysqli_fetch_array($result))
        { 
            $MaSanPham = $row['MaSanPham'];
            $TenSanPham = $row['TenSanPham'];
            $HinhURL = $row['HinhURL'];
            $Gia = $row['GiaSanPham'];
    ?>
            <div class="sp sp-cungloai">
                <?php
                    include('layout/thumpsanpham.php');
                ?>
            </div>
    <?php
        }
    ?>  
</div>


<?php
    $sqlupdate = "update sanpham set SoLuocXem = SoLuocXem + 1 where MaSanPham =".$masp;
    DataProvider::ExcuteQuery($sqlupdate);
?>


<script>
$('#zoom').elevateZoom({
    zoomType: "inner",
    cursor: "crosshair",
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 750
}); 
</script>
