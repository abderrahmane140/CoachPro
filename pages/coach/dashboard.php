<?php include '../../template/coach_header.php' ?>
  
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


<?php include '../../template/coach_footer.php' ?>
