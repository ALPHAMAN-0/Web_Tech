-- ============================================================
-- database.sql  —  Run this ONCE to set up the database
-- Open phpMyAdmin or MySQL terminal and run these commands
-- ============================================================

-- Step 1: Create the database
CREATE DATABASE IF NOT EXISTS library_db;

-- Step 2: Use it
USE library_db;

-- Step 3: Create the books table
CREATE TABLE IF NOT EXISTS books (
    id         INT          AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(200) NOT NULL,
    author     VARCHAR(150) NOT NULL,
    category   VARCHAR(100) NOT NULL,
    status     ENUM('available', 'unavailable') DEFAULT 'available',
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- Step 4 (Optional): Insert some sample data
INSERT INTO books (title, author, category, status) VALUES
('Introduction to Algorithms',       'Thomas H. Cormen',   'Computer Science', 'available'),
('Clean Code',                       'Robert C. Martin',   'Software Engineering', 'available'),
('The Great Gatsby',                 'F. Scott Fitzgerald','Literature',        'unavailable'),
('Calculus: Early Transcendentals',  'James Stewart',      'Mathematics',       'available'),
('Principles of Economics',          'N. Gregory Mankiw',  'Economics',         'unavailable');
