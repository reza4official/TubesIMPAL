<?php
session_start();

if(!isset($_SESSION['id_member']) && !isset($_SESSION['username'])){ // Jika Session Kosong Maka Harus Login
		header('location:index.php');
	}

// Memanggil File" Penting
	include "../includes/koneksi.php";
	include "../includes/lib.php"; 


if(!isset($id_member)){ // Jika SESSION ID Member Kosong Maka Harus Login
	echo "<script>alert('Silahkan Login Terlebih Dahulu!');window.location=('index.php?module=login');</script>";
}else{
		$isi=$_POST['polling'];
		if(isset($_POST['kpolling'])){ 
			if(isset($_COOKIE['polling'])){ // Jika Sudah Pernah Mengikuti Polling Maka Gagal
		
				echo "<script>alert('Maaf, Anda Sudah Pernah Mengikuti Polling');window.location='index.php';</script>";
				
			}else{
			
				setcookie("polling", "sudah polling", time() + 3600 * 24); // Mengatur Cookie Agar Tidak Mengikuti Polling Lagi
				
				$sql_poll=mysql_query("update t_polling SET rating=rating+1 where isi='".$isi."' and status='Jawab'") or die(mysql_error());
				echo "<script>alert('Terima Kasih Telah Mengikuti Polling Kami!');window.location='index.php';</script>";
				
			}
		}else{
			echo "<script>window.location='index.php';</script>";
		}
	}
	
?>
