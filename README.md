# 🏋️ CoachPro

CoachPro is a PHP & MySQL web application that allows athletes to view coach availability and book training sessions securely.

---

## 🚀 Features

- Athlete authentication (session-based)
- View coach availability
- Book available time slots
- Prevent double booking
- Secure database access using PDO
- Transaction-safe booking process

---

## 🛠 Tech Stack

- PHP
- MySQL
- PDO
- HTML
- Tailwind CSS

---

## 🗄 Database Tables

- `users`
- `coach_profiles`
- `sports`
- `coach_sports`
- `availabilities`
- `bookings`

---

## 🔐 Booking Flow

1. Athlete logs in
2. Selects a coach
3. Views available time slots
4. Clicks **Book Now**
5. System checks availability
6. Booking is saved
7. Slot status changes to `booked`

---

## 🔒 Security

- Session validation
- Prepared statements (SQL injection protection)
- Database transactions for booking consistency

---

## ⚙️ Installation

1. Clone the repository
2. Import the database into MySQL
3. Configure database connection in:
