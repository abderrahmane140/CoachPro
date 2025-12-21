<?php
session_start();

require '../../config/dbConnection.php';

require_once '../../func/auth_middleware.php';

include '../../template/coach_header.php';

//check the authntification 

checkAuth();
checkRole(['coach']);

//get pending booking

$coach_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE coach_id = :coach_id AND status ='pending'");
$stmt->execute([
  ':coach_id' => $coach_id,
]);
$pendingCount = $stmt->fetchColumn();


//get toay sessions

$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM bookings b
    JOIN  availabilities a ON  b.availability_id = a.id 
    WHERE b.coach_id = :coach_id
     AND b.status = 'accepted' 
     AND a.date_avb = CURDATE();
  ");

  $stmt->execute([':coach_id'=>$coach_id]);
  $todaysession = $stmt->fetchColumn();


//get tomorrow sessions
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM bookings b
    JOIN  availabilities a ON  b.availability_id = a.id 
    WHERE b.coach_id = :coach_id
     AND b.status = 'accepted' 
     AND a.date_avb = CURDATE() + INTERVAL 1 DAY;
  ");

  $stmt->execute([':coach_id'=>$coach_id]);
  $tomorowsession = $stmt->fetchColumn();


  //get data of coming booking
$stmt = $pdo->prepare("
    SELECT 
        u.username AS athlete_name,
        u.email AS athlete_email,
        a.date_avb,
        a.start_time,
        a.end_time
    FROM bookings b
    JOIN users u ON b.athlete_id = u.id
    JOIN availabilities a ON b.availability_id = a.id
    WHERE b.coach_id = :coach_id
      AND b.status = 'accepted'
      AND a.date_avb >= CURDATE()
    ORDER BY a.date_avb ASC, a.start_time ASC
    LIMIT 1
");

$stmt->execute([':coach_id' => $coach_id]);
$nextSession = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  
  <!-- Main Content -->
  <div class="flex-1 bg-gray-900 px-6 py-8">
    <h1 class="text-3xl font-bold text-white">Coach Dashboard</h1>


    <!-- Dashboard Cards or Content Section (Grid layout) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
      <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white">Pending Booking</h2>
        <p class="mt-2 text-3xl text-gray-400"><?php echo $pendingCount ?></p>
      </div>

      <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white">Today Sessions</h2>
        <p class="mt-2 text-3xl text-gray-400"><?= $todaysession ?></p>
      </div>

      <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white">Tomorrow Sessions</h2>
        <p class="mt-2 text-3xl text-gray-400"><?= $tomorowsession  ?></p>
      </div>
    </div>


    
  <?php if ($nextSession): ?>
    <div class="bg-gray-800  p-6 rounded-xl shadow-lg text-white space-y-4 mt-4">
      <!-- Athlete Info -->
      <div>
        <p class="text-lg font-bold"><?= htmlspecialchars($nextSession['athlete_name']) ?></p>
        <p class="text-sm opacity-80"><?= htmlspecialchars($nextSession['athlete_email']) ?></p>
      </div>

      <!-- Date & Time -->
      <div class="flex flex-wrap gap-2 text-sm">
        <span class="px-3 py-1 bg-blue-800 bg-opacity-30 rounded-full">
          <?= $nextSession['date_avb'] ?>
        </span>
        <span class="px-3 py-1 bg-blue-800 bg-opacity-30 rounded-full">
          <?= $nextSession['start_time'] ?> – <?= $nextSession['end_time'] ?>
        </span>
      </div>

      <!-- View Details Button -->
      <a href="/CoachPro/pages/coach/bookings.php"
        class="inline-block mt-2 px-3 py-1 bg-gray-600 text-white font-semibold rounded hover:bg-gray-100 transition">
        View Details →
      </a>
    </div>
  <?php else: ?>
    <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-gray-400 text-center">
      No upcoming sessions
    </div>
  <?php endif; ?>

  </div>





<?php include '../../template/coach_footer.php' ?>
