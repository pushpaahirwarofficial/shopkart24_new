<?php
session_start();
if (isset($_SESSION['id_admin'])) {
    session_destroy(); // This will clear all session variables
    // Perform other necessary actions after destroying the session
    header("Location: /back-pannel");
    exit; // Ensure to exit after using header to prevent further execution
}
