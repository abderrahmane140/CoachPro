<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

    <title>Athlete</title>
</head>
<body class="">
<!-- Navbar -->
<nav class="bg-white shadow-sm">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <a href="/CoachPro/pages/athlete/index.php" class="text-sky-600 text-2xl font-bold">
            Athlete Coach
        </a>

        <div class="space-x-6">
            <a href="/CoachPro/pages/athlete/index.php#about"
               class="text-gray-700 hover:text-sky-500 transition-colors">
               About
            </a>

            <a href="/CoachPro/pages/athlete/index.php#features"
               class="text-gray-700 hover:text-sky-500 transition-colors">
               Features
            </a>

            <a href="/CoachPro/pages/athlete/my_reservation.php"
               class="text-gray-700 hover:text-sky-500 transition-colors">
               Booking
            </a>

            <a href="/CoachPro/pages/athlete/coachs.php"
               class="text-gray-700 hover:text-sky-500 transition-colors">
               Coaches
            </a>
              <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/CoachPro/func/logout.php" class="text-gray-700 hover:text-sky-500 transition-colors">
                    Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
