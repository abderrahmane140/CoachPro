<?php 
session_start();
require '../../config/dbConnection.php';    

if(!isset($_SESSION['user_id'])) {
    header("Location: /CoachPro/pages/login.php");
    exit();
}

include '../../template/coach_header.php';  

$errors = [];
$user_id = $_SESSION['user_id'];


//check for the user 

$stmt = $pdo->prepare("SELECT * FROM coach_profiles WHERE user_id = :user_id LIMIT 1");
$stmt->execute(['user_id'=> $user_id]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $description = trim($_POST['description']);
    $experience_years = trim($_POST['experience_years']) ;
    $certifications = trim($_POST['certifications']);

    $photo = $profile['photo'] ?? null;

    if(empty($description) || empty($experience_years) || empty($certifications)) {
        $errors[] = "all fields are required!";
    }


    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

    $uploadDir = '../../uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }


    $fileName = time() . '_' . basename($_FILES['photo']['name']);


    $photoPath = $uploadDir . $fileName;

    $imageFileType = strtolower(pathinfo($photoPath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $allowedTypes)) {
        $errors[] = "Invalid file type.";
    } else {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $photo = $fileName; 
        } else {
            $errors[] = "Upload failed.";
        }
    }
}





    if(empty($errors)){

        if($profile === false){

            //create the profile
            $sql = "INSERT INTO coach_profiles 
            (user_id, description,experience_years,certifications,photo) 
            VALUES (:user_id,:description,:experience_years,:certifications,:photo)";

        }else{

            //update the profile
            $sql = "UPDATE coach_profiles SET 
            description = :description,
            experience_years = :experience_years,
            certifications = :certifications,
            photo = :photo
            WHERE user_id = :user_id
            ";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id'=> $user_id,
            'description'=> $description,
            'experience_years' => $experience_years,
            'certifications' => $certifications,
            'photo' => $photo
        ]);

        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    }
    



}
?>

<!-- Main Content -->
<div class="flex-1 bg-gray-900 px-6 py-8 text-white">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-white">Profile</h1>
            <h1 class="text-white flex item-center justify-center font-bold"><?=  $profile ?  "You can Update Profile" :  "Create Profile" ?></h1> 
    </div>

    
    <!-- Form Centered with Better Spacing -->
    
    <div class="flex items-center justify-center">

        <form action="" method="POST" class="space-y-6 w-full max-w-2xl p-8 bg-gray-800 rounded-lg shadow-lg" enctype="multipart/form-data">

        <div class="flex item-center justify-center">
            <img 
                src="<?= '../../uploads/' . ($profile['photo'] ?? 'https://thumbs.dreamstime.com/b/default-avatar-profile-flat-icon-social-media-user-vector-portrait-unknown-human-image-default-avatar-profile-flat-icon-184330869.jpg') ?>" 
                alt="Profile Photo" 
                class="rounded-full w-20 h-20"
    >
        </div>

            

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium">Description</label>
                <div class="mt-2">
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 text-black focus:ring-1 focus:ring-gray-500"
                        placeholder="Enter a brief description about yourself"
                    ><?= htmlspecialchars($profile['description']) ?? ''?>
                </textarea>
                </div>
            </div>

            <!-- Experience Years -->
            <div>
                <label for="experience_years" class="block text-sm font-medium">Experience Years</label>
                <div class="mt-2">
                    <input
                        id="experience_years"
                        type="number"
                        name="experience_years"
                        required
                        min="1"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-black  text-sm focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
                        value="<?= htmlspecialchars($profile['experience_years'] ?? '') ?>"
                        />
                </div>
            </div>

            <!-- Certifications -->
            <div>
                <label for="certifications" class="block text-sm font-medium">Certifications</label>
                <div class="mt-2">
                    <input
                        id="certifications"
                        type="text"
                        name="certifications"
                        class="block w-full rounded-md text-black  border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
                        placeholder="Enter any certifications you have"
                        value="<?= htmlspecialchars($profile['certifications'] ?? '') ?>"
                    />
                </div>
            </div>

            <!-- Photo Upload -->

            <div>
                <label for="photo" class="block text-sm font-medium">Upload Photo</label>
                <div class="mt-2">
                    <input
                        id="photo"
                        type="file"
                        name="photo"
                        class="block w-full rounded-md border border-gray-300 text-sm focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
                    />
                </div>
            </div>


            <!-- Submit Button -->
            <div>
                <button
                    type="submit"
                    name="login"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-4 py-2 text-white font-semibold"
                >
                    Create Profile
                </button>
            </div>
        </form>
    </div>
</div>

<?php include '../../template/coach_footer.php'; ?>
