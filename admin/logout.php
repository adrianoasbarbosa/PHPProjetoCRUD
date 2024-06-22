<?php

(!isset($_SESSION) ? session_start() : "");
$_SESSION = array();
session_destroy();
header('location:../admin/usuario/user.php');
