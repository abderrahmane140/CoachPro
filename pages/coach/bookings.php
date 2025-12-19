<?php 
session_start();

require '../../config/dbConnection.php';
require_once '../../func/auth_middleware.php';


checkAuth();
checkRole(['coach']);

if(!isset($_SESSION['user_id'])){
    header('Location: /CoachPro/pages/login.php');
    exit();
}

include '../../template/coach_header.php'; 
$coach_id = $_SESSION['user_id'];

//get all the booking

$stmt  = $pdo->prepare('SELECT * FROM bookings WHERE coach_id = :coach_id');
$stmt->bindParam(':coach_id',$coach_id);
$stmt->execute();
$bookings= $stmt->fetchAll();


//update the status 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $booking_id = $_POST['booking_id'] ?? null;
    $status = $_POST['status'] ?? null;

    if($booking_id && in_array($status, ['accepted', 'rejected'])){
        
        $stmt = $pdo->prepare("
        UPDATE bookings 
        SET status = :status
        WHERE id = :id AND coach_id = :coach_id
        ");
        
        $stmt->execute([
            ':status' => $status,
            ':id' => $booking_id,
            ':coach_id' => $coach_id
        ]);



        if($status === 'accepted'){
            $stmt = $pdo->prepare("
            UPDATE availabilities 
            SET status = 'booked'
            WHERE id = (
            SELECT availability_id FROM bookings WHERE id = :id
            )
            ");
            $stmt->execute([':id' => $booking_id]);
        }


        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

}


?>

  <!-- Main Content -->
  <div class="flex-1 bg-gray-900 px-6 py-8">
    <h1 class="text-3xl font-bold text-white">Booking</h1>
<div class="overflow-x-auto mt-6">
    <table class="min-w-full border border-gray-700 bg-gray-800 rounded-lg">
        <thead class="bg-gray-700 text-gray-200">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Athlete ID</th>
                <th class="px-4 py-3 text-left">Coach ID</th>
                <th class="px-4 py-3 text-left">Availability ID</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Created At</th>
                <th class="px-4 py-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody class="text-gray-300">
            <?php if (!empty($bookings)) : ?>
                <?php foreach ($bookings as $index => $booking) : ?>
                    <tr class="border-t border-gray-700 hover:bg-gray-700/50 transition">
                        <td class="px-4 py-3"><?= $index + 1 ?></td>
                        <td class="px-4 py-3"><?= $booking['athlete_id'] ?></td>
                        <td class="px-4 py-3"><?= $booking['coach_id'] ?></td>
                        <td class="px-4 py-3"><?= $booking['availability_id'] ?></td>

                        <td class="px-4 py-3">
                            <span class="
                                px-2 py-1 rounded text-sm font-semibold
                                <?= $booking['status'] === 'pending' ? 'bg-yellow-500 text-black' : '' ?>
                                <?= $booking['status'] === 'accepted' ? 'bg-green-500 text-white' : '' ?>
                                <?= $booking['status'] === 'rejected' ? 'bg-red-500 text-white' : '' ?>
                                <?= $booking['status'] === 'canceled' ? 'bg-gray-500 text-white' : '' ?>
                            ">
                                <?= ucfirst($booking['status']) ?>
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            <?= date('Y-m-d H:i', strtotime($booking['created_at'])) ?>
                        </td>
                        <td class="px-4 py-3 flex gap-3">

                        <?php if ($booking['status'] === 'pending') : ?>

                            <!-- accept -->
                            <form action="" method="POST">
                                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                <input type="hidden" name="status" value="accepted">
                                <button class="text-green-400 hover:text-green-600">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>

                            <!-- reject -->
                            <form action="" method="POST">
                                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                <input type="hidden" name="status" value="rejected">
                                <button class="text-red-400 hover:text-red-600">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>


                        <?php else :?>
                            <span class="text-gray">no action </span>
                        <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                        No bookings found
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

  </div>


<?php include '../../template/coach_footer.php' ?>
