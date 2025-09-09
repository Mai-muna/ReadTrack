<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function current_user() {
    return $_SESSION['user'] ?? null;
}
function require_login() {
    if (!current_user()) {
        header('Location: /ReadTrack/login.php');
        exit;
    }
}
function require_role($role) {
    $u = current_user();
    if (!$u || $u['role'] !== $role) {
        http_response_code(403);
        die("Forbidden");
    }
}
function is_admin()  { return current_user() && current_user()['role'] === 'admin'; }
function is_author() { return current_user() && current_user()['role'] === 'author'; }
