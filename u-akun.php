<?php
session_start();
	if(!isset($_SESSION['id_member']) && !isset($_SESSION['username'])){ // Jika Session Kosong Maka Harus Login
		header('location:index.php');
	}
	
if(isset($_POST['simpan'])){
	$sql_a=mysql_query("select password from t_member where id_member=".$id_member."") or die(mysql_error()); // Memanggil Data Sesuai ID Member
	$row_a=mysql_fetch_assoc($sql_a);
	if($_POST['password_lama']!='' || $_POST['password_baru']!=''){ // Check Password Lama dan Baru
		if(md5(htmlentities($_POST['password_lama'].$salt_pass))==$row_a['password']){ // Check Password Lama
			if($aksi=='update'){
				$sql_update=mysql_query("update t_member SET username='".htmlentities($_POST['username'])."',password='".md5(htmlentities($_POST['password_baru'].$salt_pass))."',nama_lengkap='".htmlentities($_POST['nama_lengkap'])."',no_telp='".htmlentities($_POST['no_hp'])."',alamat='".htmlentities($_POST['alamat'])."',provinsi='".htmlentities($_POST['provinsi'])."',kota='".htmlentities($_POST['kota'])."',kode_pos='".htmlentities($_POST['kode_pos'])."' where id_member=".$id_member."") or die(mysql_error());
				echo "<script>alert('Akun Berhasil Diperbarui!');window.location=('index.php?module=akun');</script>";
			}
		}else{
			echo "<script>alert('Password Salah!');window.location=('index.php?module=akun');</script>";
		}
	}else{
		$sql_update=mysql_query("update t_member SET username='".htmlentities($_POST['username'])."',nama_lengkap='".htmlentities($_POST['nama_lengkap'])."',no_telp='".htmlentities($_POST['no_hp'])."',alamat='".htmlentities($_POST['alamat'])."',provinsi='".htmlentities($_POST['provinsi'])."',kota='".htmlentities($_POST['kota'])."',kode_pos='".htmlentities($_POST['kode_pos'])."' where id_member=".$id_member."") or die(mysql_error());
		echo "<script>alert('Akun Berhasil Diperbarui!');window.location=('index.php?module=akun');</script>";
	}
}

$sql_edit=mysql_query("select *from t_member where id_member=".$id_member."") or die(mysql_error()); // Memanggil Data Sesuai ID Member
$row_edit=mysql_fetch_assoc($sql_edit);
{
	$username=$row_edit['username'];
	$nama_lengkap=$row_edit['nama_lengkap'];
	$email=$row_edit['email'];
	$no_telp=$row_edit['no_telp'];
	$alamat=$row_edit['alamat'];
	$provinsi=$row_edit['provinsi'];
	$kota=$row_edit['kota'];
	$kode_pos=$row_edit['kode_pos'];
}

?>