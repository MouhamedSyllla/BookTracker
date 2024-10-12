<?php

// Check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}




function redirectTo($path) {
    header('Location: ' .BASE_URL. $path);
    exit;
}
