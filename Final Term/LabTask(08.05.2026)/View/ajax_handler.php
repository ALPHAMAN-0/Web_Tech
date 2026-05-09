<?php


header('Content-Type: application/json');  // always return JSON

require_once __DIR__ . '/../Controllers/BookController.php';

// Read action from GET or POST
$action = $_REQUEST['action'] ?? '';

// Pass all request data to the controller
handleRequest($action, $_REQUEST);
