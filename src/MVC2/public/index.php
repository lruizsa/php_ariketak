<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/models/Post.php';
require_once __DIR__ . '/../app/controllers/PostController.php';

use Controllers\PostController;

// Instanciar el controlador y ejecutar la acción
$controller = new PostController();
$controller->index();
