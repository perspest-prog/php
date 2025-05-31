<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книга</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once 'menu.php';
require_once 'viewer.php';

$mysqli = new mysqli("localhost", "root", "", "notebook");

if ($mysqli->connect_errno) {
    die("<div style='color:red;'>Ошибка подключения к базе данных: $mysqli->connect_error</div>");
}

$page_param = $_GET['page'] ?? 'viewer';
$sort = $_GET['sort'] ?? 'default';
$view_page = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;

echo getMainMenu();

echo '<div class="content">';

switch ($page_param) {
    case 'viewer':
        echo renderViewer($mysqli, $sort, $view_page);
        break;
    case 'add':
        include 'add.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'delete':
        include 'delete.php';
        break;
    default:
        header("Location: index.php?page=viewer");
        exit;
}

echo '</div>';
?>
</body>
</html>