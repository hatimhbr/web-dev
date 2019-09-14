<?php
$email = $_POST['email'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$message = $_POST['message'];
if (!empty($email) || !empty($name) || !empty($subject) || !empty($message)) {
	 $host = "localhost";
	 $dbUsername = "root";
	 $dbPassword = "Openit";
	 $dbname = "industry";
	     //create connection
	 $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	 if (mysqli_connect_error()) {
	 die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	 } else {
	 $SELECT = "SELECT email From contact_form Where email = ? Limit 1";
	 $INSERT = "INSERT Into contact_form (email, name, subject, message) values(?, ?, ?, ?)";
	 ////Prepare statement
	 $stmt = $conn->prepare($SELECT);
	 $stmt->bind_param("s", $email);
	 $stmt->execute();
	 $stmt->bind_result($email);
	 $stmt->store_result();
	 $rnum = $stmt->num_rows;
	 if ($rnum==0) {
	 $stmt->close();
	 $stmt = $conn->prepare($INSERT);
	 $stmt->bind_param("ssss", $email, $name, $subject, $message);
	 $stmt->execute();
	 echo "New record inserted sucessfully";
	 } else {
	 echo "Someone already register using this email";
	 }
	 $stmt->close();
	 $conn->close();
	     }
	     } else {
	     echo "All field are required";
	      die();
	      }
	      ?>
