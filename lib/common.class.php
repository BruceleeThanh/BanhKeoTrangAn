<?php

function validateEmail($str) {
    $email = test_input($str);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    return $email;
}

function validateName($name) {
    $name = test_input($name);
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
    }
    return $name;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function sendMail($email_to, $name, $subject, $message) {
    $to = $email_to;
    $subject = $subject;
    $message = $message;
    $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            "Dear ," . $name;

    mail($to, $subject, $message, $headers);
}

// for testting
function checkData($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}
