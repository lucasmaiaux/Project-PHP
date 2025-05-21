<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'about':
        require 'about.php';
        break;
    case 'contact':
        require 'contact.php';
        break;
    default:
        require 'home.php';
}