<?php
require_once 'header-require-models.php';
session_start();
session_destroy();
header('location:http://localhost/doan_cakenhom1/public/login/login.php');