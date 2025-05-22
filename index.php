<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require 'home.php';
        break;
    case 'about':
        require 'about.php';
        break;
    case 'contact':
        require 'contact.php';
        break;
    default:
        http_response_code(404);
        echo "<h1>404 - Page introuvabke</h1>";
        break;
}