<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        header("Location: ../../Public/index.html");
        exit();
    }
}
