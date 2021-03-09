<?php 
 	function connect_to_db() { 
 		global $conn;
 		if (empty($conn)) {
 			$conn = mysqli_connect('localhost','root','','bookhouse');
 		}
 	}