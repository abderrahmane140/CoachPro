<?php
include '../../template/athlete_header.php';
require '../../func/auth_middleware.php';

checkAuth();
checkRole(['atlethe']); 

?>

<main>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-sky-100 to-sky-200 py-24">
    <div class="container mx-auto text-center px-6">
        <h1 class="text-5xl md:text-6xl font-bold text-sky-500 leading-tight">Reach Your Full Potential</h1>
        <p class="mt-6 text-xl text-gray-700 max-w-2xl mx-auto leading-relaxed">Our platform connects athletes with professional coaches to help you achieve your goals.</p>
        <a href="../athlete/coachs.php" class="mt-10 inline-block px-8 py-4 rounded-full text-lg font-semibold hover:bg-sky-600 transition-colors shadow-lg hover:shadow-xl">discover our Coach Now</a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="container mx-auto text-center px-6">
        <h2 class="text-4xl font-bold text-gray-900">About the Platform</h2>
        <p class="mt-8 text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">Our platform is designed to connect athletes with experienced coaches in various sports. Whether you're looking to improve your skills, get personalized training, or take your game to the next level, we have the right coach for you!</p>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-sky-50">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-gray-900 text-center">Features</h2>
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-sky-100">
                <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Personalized Coaching</h3>
                <p class="mt-4 text-gray-600 leading-relaxed">Get a personalized training plan that's tailored to your needs, strengths, and weaknesses.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-sky-100">
                <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Professional Coaches</h3>
                <p class="mt-4 text-gray-600 leading-relaxed">We work with top-tier coaches across a variety of sports who have proven experience helping athletes succeed.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-sky-100">
                <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Easy Booking System</h3>
                <p class="mt-4 text-gray-600 leading-relaxed">With our easy-to-use booking system, you can find a coach, schedule sessions, and track your progress all in one place.</p>
            </div>
        </div>
    </div>
</section>

<!-- Booking Section -->
<section id="booking" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900">Book a Coach</h2>
            <p class="mt-4 text-xl text-gray-600">Ready to take your training to the next level? Book a session with one of our professional coaches today!</p>

            <div class="mt-12">
                <form action="#" method="POST" class="bg-sky-50 p-8 rounded-2xl border border-sky-100">
                    <input type="text" name="name" placeholder="Your Name" class="w-full px-4 py-3 mt-4 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white" required>
                    <input type="email" name="email" placeholder="Your Email" class="w-full px-4 py-3 mt-4 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white" required>
                    <input type="text" name="sport" placeholder="Sport You Are Interested In" class="w-full px-4 py-3 mt-4 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white" required>
                    
                    <select name="coach" class="w-full px-4 py-3 mt-4 rounded-lg border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white text-gray-700" required>
                        <option value="">Select Coach</option>
                        <option value="coach1">Coach 1</option>
                        <option value="coach2">Coach 2</option>
                        <option value="coach3">Coach 3</option>
                    </select>
                    
                    <button type="submit" class="mt-8 w-full bg-sky-500 py-4 text-white text-lg font-semibold rounded-full hover:bg-sky-600 transition-colors shadow-lg hover:shadow-xl">Book My Coach</button>
                </form>
            </div>
        </div>
    </div>
</section>
</main>

<?php include '../../template/athlete_footer.php' ?>

