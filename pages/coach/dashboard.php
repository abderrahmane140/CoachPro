<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
      <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium bg-gray-950/50 text-white">Dashboard</a>
      <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Availability</a>
      <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Bookings</a>
      <!-- <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
      <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Reports</a> -->
    </div>

    <!-- Footer (Optional, can add more links here) -->
    <div class="mt-auto px-4 py-6">
      <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Profile</a>
      <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Sign Out</a>
    </div>
  </div>

  
  <!-- Main Content -->
  <div class="flex-1 bg-gray-900 px-6 py-8">
    <h1 class="text-3xl font-bold text-white">Coach Dashboard</h1>
    <p class="mt-4 text-gray-400">This is the main content area where your dashboard widgets, charts, or other content can go.</p>

    <!-- Dashboard Cards or Content Section (Grid layout) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
      <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white">Overview</h2>
        <p class="mt-2 text-gray-400">This is an overview of the latest activity on the dashboard.</p>
      </div>

      <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white">Team Performance</h2>
        <p class="mt-2 text-gray-400">Track your team's performance and metrics here.</p>
      </div>

      <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white">Upcoming Events</h2>
        <p class="mt-2 text-gray-400">Here you can see all your upcoming events and deadlines.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>