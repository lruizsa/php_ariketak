<?php

namespace Controllers;

use Models\Post;

class PostController {
    public function index() {
        $postModel = new Post();
        $posts = $postModel->getAllPosts();

        // Cargar la vista
        require_once __DIR__ . '/../views/posts.php';
    }
}
