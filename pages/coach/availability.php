<?php
session_start();

require '../../config/dbConnection.php';   

if(!isset($_SESSION['user_id'])){
    header('Location: /CoachPro/pages/login.php');
    exit();
}

include '../../template/coach_header.php';

$coach_id = $_SESSION['user_id'];

// Get all availabilities for this coach
$stmt  = $pdo->prepare('SELECT * FROM availabilities WHERE coach_id = :coach_id');
$stmt->bindParam(':coach_id',$coach_id);
$stmt->execute();
$availabilities= $stmt->fetchAll();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'] ?? 0;
    $date_avb = $_POST['date_avb'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $status = $_POST['status'];

    if($id == 0){
        
        $stmt = $pdo->prepare("INSERT INTO availabilities (coach_id, date_avb, start_time, end_time, status) 
                               VALUES (:coach_id, :date_avb, :start_time, :end_time, :status)");
        $stmt->execute([
            ':coach_id' => $coach_id,
            ':date_avb' => $date_avb,
            ':start_time' => $start_time,
            ':end_time'=> $end_time,
            ':status' => $status
        ]);
    } else {
        
        $stmt = $pdo->prepare("UPDATE availabilities 
                               SET date_avb = :date_avb, start_time = :start_time, end_time = :end_time, status = :status
                               WHERE id = :id AND coach_id = :coach_id");
        $stmt->execute([
            ':date_avb' => $date_avb,
            ':start_time' => $start_time,
            ':end_time'=> $end_time,
            ':status' => $status,
            ':id' => $id,
            ':coach_id' => $coach_id
        ]);
    }

    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>


<section class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50" id="modal">
    <div class="w-full sm:max-w-md modal-card bg-white rounded-2xl p-6 shadow-2xl mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-green-600" id="modal-title">Create Availability</h3>
            <button id="closeBtn" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
        </div>

        <form class="space-y-3" id="availability-form" method="POST">
            <input type="hidden" name="id" id="availability-id" value="0">
            <label for="date_avb">Date Availability</label>
            <input class="w-full rounded border px-3 py-2" type="date" name="date_avb" id="date_avb" required />
            <label for="start_time">Start Time</label>
            <input class="w-full rounded border px-3 py-2" type="time" name="start_time" id="start_time" required />
            <label for="end_time">End Time</label>
            <input class="w-full rounded border px-3 py-2" type="time" name="end_time" id="end_time" required />
            <select name="status" id="status" class="w-full rounded border px-3 py-2" required>
                <option value="available">Available</option>
                <option value="booked">Booked</option>
            </select>
            <button type="submit" class="w-full bg-blue-500 text-white rounded px-3 py-2">Save</button>
        </form>
    </div>
</section>


  <!-- Main Content -->
<!-- Main Content -->
<div class="flex-1 bg-gray-900 px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-white">Availability</h1>
        <button id="openBtn" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 rounded-lg shadow">
            New Availability
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-700 bg-gray-800 rounded-xl shadow-lg">
            <thead class="bg-gray-700 text-gray-200 uppercase text-sm tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Start Time</th>
                    <th class="px-4 py-3 text-left">End Time</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($availabilities as $index => $a): ?>
                    <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                        <td class="px-4 py-3 text-gray-200"><?= $index + 1 ?></td>
                        <td class="px-4 py-3 text-gray-200"><?= $a['date_avb'] ?></td>
                        <td class="px-4 py-3 text-gray-200"><?= $a['start_time'] ?></td>
                        <td class="px-4 py-3 text-gray-200"><?= $a['end_time'] ?></td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-sm font-semibold
                                <?= $a['status'] === 'available' ? 'bg-green-500 text-white' : 'bg-gray-500 text-black' ?>
                            ">
                                <?= ucfirst($a['status']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md shadow"
                                onclick='openModal(<?= json_encode($a) ?>)'>
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if(empty($availabilities)): ?>
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                            No availabilities found
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



    
</div>

<script>
  const modal = document.getElementById('modal');
  const closeBtn = document.getElementById('closeBtn');
  const openBtn = document.getElementById('openBtn');
  const avb_id = document.getElementById('availability-id');
  const form = document.getElementById('availability-form');
  const modal_title = document.getElementById('modal-title');
  const dateInput = document.getElementById('date_avb');
  const startInput = document.getElementById('start_time');
  const endInput = document.getElementById('end_time');
  const statusInput = document.getElementById('status');


  openBtn.addEventListener('click', () => {
      avb_id.value = 0;
      modal_title.innerText = "Create Availability";
      form.reset();
      modal.classList.remove('hidden');
      modal.classList.add('flex');
  });

  function openModal(availability) {
      avb_id.value = availability.id;
      dateInput.value = availability.date_avb;
      startInput.value = availability.start_time;
      endInput.value = availability.end_time;
      statusInput.value = availability.status;
      modal_title.innerText = "Update Availability";
      modal.classList.remove('hidden');
      modal.classList.add('flex');
  }


  closeBtn.addEventListener('click', () => {
      modal.classList.remove('flex');
      modal.classList.add('hidden');
  });


</script>

<?php include '../../template/coach_footer.php' ?>
