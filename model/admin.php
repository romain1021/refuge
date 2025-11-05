<?php

require_once __DIR__ . '/user.php';

class Admin extends User {
    public function getRole() {
        return "Administrateur";
    }
}