<?php

$conn = new mysqli("localhost", "Wstd23", "ob9cfwLd");

if ($conn) {
	mysqli_select_db($conn, "sec1_23");
	mysqli_query($conn, "SET NAMES utf8");
} else {
	echo mysqli_errno($conn);
}

$sql = "SELECT username FROM member";
$objQuery = mysqli_query($conn, $sql);

$username = [];

while ($row = mysqli_fetch_assoc($objQuery)) {
	$username[] = $row["username"];
}


sleep(1);


if (!in_array( $_GET["username"], $username )) {
		echo "okay";
	
} else {
	echo "denied";
}
