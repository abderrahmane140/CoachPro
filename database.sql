USE coachpro;

CREATE TABLE users (
    id int AUTO_INCREMENT PRIMARY key,
    username varchar(50) not null,
    email varchar(60) not null UNIQUE,
    password varchar(255) not null,
    role ENUM('atlethe','coach') not null,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP
);

create TABLE coach_profiles (
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int not null,
    description text, 
    experience_years int not null,
    certifications varchar(255) DEFAULT null,
    photo text NOT null,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN key(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sport_name VARCHAR(50) NOT NULL
);

CREATE table coach_sports(
    coach_profile_id int not null,
    sport_id int not null,
    FOREIGN key(coach_profile_id) REFERENCES coach_profiles(id),
    FOREIGN key(sport_id) REFERENCES sports(id)
);

CREATE TABLE availabilities (
    id int AUTO_INCREMENT PRIMARY KEY,
    coach_id int not null,
    date_avb date not null,
    start_time time not null,
    end_time time not null,
    status ENUM('available','booked') DEFAULT 'available',
    FOREIGN key(coach_id) REFERENCES users(id) on DELETE CASCADE
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    athlete_id INT NOT NULL,
    coach_id INT NOT NULL,
    availability_id INT NOT NULL,
    status ENUM('pending','accepted','rejected','canceled') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(athlete_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(coach_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(availability_id) REFERENCES availabilities(id) ON DELETE CASCADE
);






--insert into users
INSERT INTO users (username, email, password, role) VALUES
('ali', 'ali@coachpro.com', 'password1234', 'atlethe') --id = 3






--inset into availabilities
INSERT INTO availabilities (coach_id, date_avb, start_time, end_time, status) VALUES
(2, '2025-01-10', '09:00:00', '10:00:00', 'available'),
(2, '2025-01-11', '14:00:00', '15:00:00', 'available'),
(2, '2025-01-10', '10:00:00', '11:00:00', 'available');


--insert into 

INSERT INTO bookings (athlete_id, coach_id, availability_id, status) VALUES
(3, 2, 1, 'pending'),  
(3, 2, 2, 'pending'),  
(3, 2, 3, 'pending'); 
