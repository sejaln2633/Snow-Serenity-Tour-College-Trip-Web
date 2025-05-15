-- Create the database
CREATE DATABASE IF NOT EXISTS college_trip;
USE college_trip;

-- Table: students
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contact_number VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: faculty
CREATE TABLE IF NOT EXISTS faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: trip_details
CREATE TABLE IF NOT EXISTS trip_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_date DATE,
    end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: applications
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    emergency_contact_name VARCHAR(100),
    emergency_contact_number VARCHAR(15),
    health_info TEXT,
    food_preference VARCHAR(100),
    transportation_preference VARCHAR(100),
    other_preferences TEXT,
    application_status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    faculty_feedback TEXT,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    decision_at TIMESTAMP NULL,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- Table: application_updates
CREATE TABLE IF NOT EXISTS application_updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    updated_fields TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE
);
