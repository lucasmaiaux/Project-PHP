<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'about':
        require 'about.php';
        break;
    default:
        require 'home.php';
}