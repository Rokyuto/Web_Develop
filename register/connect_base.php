<?php
	$username = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$phoneCode = $_POST['phoneCode'];
	$phone = $_POST['phone'];

	if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) || !empty($phoneCode) || !empty($phone) ) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPasswoord = "";
	$dbname = "my_database";

	//connection
	$conn = new mysqli($host, $dbUsername, $dbPasswoord, $dbname);

	if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}else{
$sql = "INSERT INTO register (username, password, gender, email, phoneCode, phone) values ('$username','$password', '$gender', '$email', '$phoneCode', '$phone')";
if ($conn->query($sql)){
echo "New profile is created sucessfully";
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}