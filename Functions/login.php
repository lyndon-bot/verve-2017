<?php

include "conn.php";

$user = $_POST['username'];

$query = mysqli_query( $conn ,"select * from user_index where username = '$user'");
$store = mysqli_fetch_assoc($query);

if ($store['username'] == $user) {
	
	session_start();

	///login counter
	
				$_SESSION['user'] = $user; 
					$get_UID = mysqli_query($conn, "select id from user_index where username = '$user'");
				$store_UID = mysqli_fetch_assoc($get_UID);
				$U_ID = $store_UID['id'];

				$select_lc = mysqli_query($conn, "select login_count from user_index where id = '$U_ID'");

				$store_lc = mysqli_fetch_assoc($select_lc);

				$nlogin_c = ++$store_lc['login_count'];

				echo $nlogin_c;

				 $login_count = mysqli_query($conn, "update user_index set login_count = '$nlogin_c' where id = '$U_ID' ");

		if($store['Permission'] == 'U'){

			$_SESSION['Permission'] = $store['Permission'];
			header('location:../Pages/dash.php');
		}else if($store['Permission'] == 'A') {

			$_SESSION['Permission'] = $store['Permission'];
			header('location:../A_Pages/A_dash.php');

		}else if ($store['Permission'] == 'L') {

			$_SESSION['Permission'] = $store['Permission'];
			header('location:../index.php');
		}

		} else {


	include "../index.php";
	//header('location:../error.php');
}

?>