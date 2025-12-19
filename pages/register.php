<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Register</title>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

  <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-md">
    <?php
    session_start();
    if(!empty($_SESSION['errors'])) :
    ?>
    <div class="mb-4 rounded-md bg-red-100 border border-red-400 p-3 text-sm text-red-700">
      <ul class="list-disc pl-5">
        <?php foreach ($_SESSION['errors'] as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php unset($_SESSION['errors']); endif;?>
    <h2 class="text-center text-2xl font-bold mb-8 text-gray-800">
      Create an account
    </h2>

    <form action="../func/auth.php" method="POST" class="space-y-6">

      <!-- Username -->
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">
          Username
        </label>
        <div class="mt-2">
          <input
            id="username"
            type="text"
            name="username"
            required
            maxlength="50"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                   focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
          />
        </div>
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">
          Email address
        </label>
        <div class="mt-2">
          <input
            id="email"
            type="email"
            name="email"
            required
            maxlength="60"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                   focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
          />
        </div>
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">
          Password
        </label>
        <div class="mt-2">
          <input
            id="password"
            type="password"
            name="password"
            required
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                   focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
          />
        </div>
      </div>

      <!-- Role -->
      <div>
        <label for="role" class="block text-sm font-medium text-gray-700">
          Role
        </label>
        <div class="mt-2">
          <select
            id="role"
            name="role"
            required
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm
                   focus:border-gray-500 focus:ring-1 focus:ring-gray-500"
          >
            <option value="">Select role</option>
            <option value="atlethe">Athlete</option>
            <option value="coach">Coach</option>
          </select>
        </div>
      </div>

      <!-- Submit -->
      <div>
        <button
          type="submit"
          name="register"
          class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2
                 text-sm font-semibold text-white hover:bg-indigo-400
                 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
          Register
        </button>
      </div>
    </form>
    <div class="mt-3 text-center text-gray-600 hover:text-gray-400">
      <a class="" href="/CoachPro/pages/login.php">Alreay have acount</a>
    </div>
  </div>

</body>
</html>
