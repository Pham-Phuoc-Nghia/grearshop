<?php 
	include('../lib/pdf/fpdf.php');
	include('../lib/DataProvider.php');

	
	class myPDF extends FPDF{
		function header(){
			$this->SetFont('Arial', 'B',14);
			$this->Cell(200,5,'HOA DON DAT HANG', 0, 0,'C');
			$this->Ln(10);

			$this->SetFont('Arial', '',12);
			$this->Cell(200,5,'Cua hang DT GEAR SHOP HCM', 0, 0,'C');
			$this->Ln(10);

			$this->SetFont('Arial', '',10);
			$this->Cell(200,5,'227 Nguyen Van Cu, P5,Q5,TPHCM', 0, 0,'C');
			$this->Ln(10);

			$this->SetFont('Arial', '',10);
			$this->Cell(200,5,'HotLine:0909987123', 0, 0,'C');
			$this->Ln(20);
		}

		function headerTable(){
			$this->SetFont('Arial', 'B', 12);
			$this->Cell(90,10,'Ten Hang',0,0,'C');
			$this->Cell(25,10,'Don Gia',0,0,'C');
			$this->Cell(25,10,'So Luong',0,0,'C');
			$this->Cell(40,10,'Thanh tien',0,0,'C');
			$this->Ln();
		}

		function viewTable(){
			$id = $_GET['ids'];//lấy  mã chi tiết đơn đặt hàng
			$this->SetFont('Arial','',11);
			$sql="SELECT sanpham.TenSanPham, chitietdondathang.SoLuong,chitietdondathang.GiaBan, chitietdondathang.SoLuong*chitietdondathang.GiaBan from chitietdondathang, sanpham where chitietdondathang.MaSanPham = sanpham.MaSanPham 
				and chitietdondathang.MaDonDatHang=".$id;
			$result = DataProvider::ExcuteQuery($sql);
			while($row = mysqli_fetch_array($result))
			{
				$row[0]=utf8_decode($row[0]);
				$this->Cell(90,10,$row[0],0,0,'C');
				$this->Cell(25,10,number_format($row[2]),0,0,'C');
				$this->Cell(25,10,$row[1],0,0,'C');
				$this->Cell(40,10,number_format($row[3]),0,0,'C');
				$this->Ln(10);
			}

			$sql2 = "select TongThanhTien from dondathang where MaDonDatHang=".$id;
			$result2 =  DataProvider::ExcuteQuery($sql2);
			$row2 = mysqli_fetch_row($result2);
			$this->SetFont('Arial', 'B', 12);
			$this->Cell(250,10,'Tong Thanh Tien: ',0,0,'C');
			$this->Cell(-170,10,number_format($row2[0]).'VND',0,0,'C');

			$this->Ln(15);

			$this->SetFont('Arial', 'B',12);
			$this->Cell(200,5,'CAM ON BAN DA MUA HANG TAI SHOP CHUNG TOI', 0, 0,'C');
			
		}
	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A5',0);
	$pdf->headerTable();
	$pdf->viewTable();
	$pdf->Output();

 ?>