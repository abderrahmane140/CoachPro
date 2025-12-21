<?php
session_start();



if (!isset($_SESSION['user_id'])) {
    header('Location: /CoachPro/pages/login.php');
    exit();
}


if ($_SESSION['role'] === 'coach') {
    header('Location: /CoachPro/pages/coach/dashboard.php');
    exit();
}

if ($_SESSION['role'] === 'atlethe') {
    header('Location: /CoachPro/pages/athlete/index.php');
    exit();
}


// session_destroy();
// header('Location: /CoachPro/pages/login.php');
// exit();
