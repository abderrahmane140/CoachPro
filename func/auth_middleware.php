<?php

function checkAuth() {
    if (!isset($_SESSION['user_id'])){
        header('Location: /CoachPro/pages/login.php');
        exit();
    }
}


function checkRole($allowedRoles) {
    if(!isset($_SESSION['role'])){
        header('Location: /CoachPro/pages/login.php');
        exit();
    }


    if(!in_array($_SESSION['role'], $allowedRoles)){
        if($_SESSION['role'] === 'coach'){
            header('Location: /CoachPro/pages/coach/dashboard.php');
        }else{
            header('Location: /CoachPro/pages/athlete/index.php');
        }
        exit();
    }
}

