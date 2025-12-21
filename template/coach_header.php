<?php 



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

    <title>athlete Dashboard</title>
</head>
<body>
<div class="min-h-screen flex">
  <!-- Sidebar -->
  <div class="flex-none w-64 bg-gray-800">
    <div class="space-y-4 px-4 py-6">
      <!-- Sidebar Logo -->
      <div class="shrink-0">
        <h1 class="font-bold text-xl text-white p-1">Coach Pro</h1>
      </div>

      <!-- Sidebar Links -->
      <a href="/CoachPro/pages/coach/dashboard.php" class="block px-3 py-2 rounded-md text-sm font-medium bg-gray-950/50 text-white">Dashboard</a>
      <a href="/CoachPro/pages/coach/availability.php" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Availability</a>
      <a href="/CoachPro/pages/coach/bookings.php" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Bookings</a>

    </div>

    <!-- Footer (Optional, can add more links here) -->
    <div class="mt-auto px-4 py-6">
      <a href="/CoachPro/pages/coach/profile.php" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Profile</a>
      <a href="/CoachPro/func/logout.php" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Sign Out</a>
    </div>
  </div>
