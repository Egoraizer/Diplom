<?php
session_start();
unset($_SESSION['user']['login']); unset($_SESSION['user']['email']);
header('Location: ../index.php');