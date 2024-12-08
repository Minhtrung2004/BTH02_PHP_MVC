<?php
// routes.php

require_once 'controllers/LoginController.php';

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/login') {
    $controller = new LoginController();
    $controller->showLoginForm();
} elseif ($uri === '/login.php' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new LoginController();
    $controller->handleLogin();
}
