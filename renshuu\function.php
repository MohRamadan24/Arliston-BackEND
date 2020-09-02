<?php 
	$conn =mysqli_connect("localhost", "root", "", "Arliston");


	function registrasi($data){
		global $conn;

		$id=strtolower(stripcslashes($data["id"]));
		$pass1=mysqli_real_escape_string($conn, $data['pass1']);
		$pass2=mysqli_real_escape_string($conn, $data['pass2']);

		$check_id=mysqli_query($conn, "SELECT id FROM  log_reg WHERE id='$id'");
		if(mysqli_fetch_assoc($check_id)){
			echo "<script>
					alert('User name telah digunakan!')
			</script>";
			return false;
		}
		
		if($pass1 !== $pass2){
			echo "<script>
					alert('Password tidak sesuai telah digunakan!')
			</script>";
			return false;
		}


		$password = password_hash($pass1, PASSWORD_DEFAULT);

		mysqli_query($conn, "INSERT INTO log_reg VAlues('$id', '$password')");
		return mysqli_affected_rows($conn);

	}

	function login($data){
		global $conn;
		$id=$data['id'];
		$pass=$data['pass'];
		$masuk_id=mysqli_query($conn,"SELECT id FROM log_reg WHERE id='$id");
		$masuk_pass=mysqli_query($conn, "SELECT pass FROM log_reg WHERE id='$id");
		$check_id=mysqli_fetch_assoc($masuk_id);
		$check_pass=mysqli_fetch_assoc($masuk_pass);

		if(null !== $check_id){
			echo "<script>
					alert('User name Salah!')
			</script>";

			return false;
		}

		if (null !== $check_pass){
			echo "<script>
					alert('Password Salah!')
			</script>";

			return false;
		}
		return 1;
	}

 ?>