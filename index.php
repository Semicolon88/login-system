<?php
    require_once "vendor/autoload.php";

    use App\Database;
    use App\User ;

    $con = new Database;
    $conn = $con->connect();
    $user = new User($conn);
    $userData = [
        'email' => 'example4@example.com',
        'name' => 'Habeeb',
        'password' => '12345678'
    ];

    $user->loginUser($userData);