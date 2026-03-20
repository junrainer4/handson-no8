<?php
require_once 'db.php';
require_once 'controllers/FacultyController.php';

$controller = new FacultyController($conn);

$action = $_GET['action'] ?? 'index';
$id     = (int)($_GET['id'] ?? 0);

if ($action === 'create') {
    $controller->create();
} elseif ($action === 'edit') {
    $controller->edit($id);
} elseif ($action === 'delete') {
    $controller->delete($id);
} else {
    $controller->index();
}