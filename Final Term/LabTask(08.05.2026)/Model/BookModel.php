<?php
// ============================================================
// models/BookModel.php  —  All Database Functions (Model Layer)
// ============================================================

require_once __DIR__ . '/../config/db.php';

// ── READ: Get all books ──────────────────────────────────────
function getAllBooks() {
    $conn   = getConnection();
    $result = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
    $books  = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    mysqli_close($conn);
    return $books;
}

// ── READ: Get single book by ID ──────────────────────────────
function getBookById($id) {
    $conn = getConnection();
    $id   = (int)$id;

    $result = mysqli_query($conn, "SELECT * FROM books WHERE id = $id LIMIT 1");
    $book   = mysqli_fetch_assoc($result);

    mysqli_close($conn);
    return $book;  // returns array or null
}

// ── CREATE: Add a new book ───────────────────────────────────
function addBook($title, $author, $category, $status) {
    $conn = getConnection();

    // Escape to prevent SQL injection
    $title    = mysqli_real_escape_string($conn, $title);
    $author   = mysqli_real_escape_string($conn, $author);
    $category = mysqli_real_escape_string($conn, $category);
    $status   = mysqli_real_escape_string($conn, $status);

    $sql    = "INSERT INTO books (title, author, category, status)
               VALUES ('$title', '$author', '$category', '$status')";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return $result;  // true on success, false on failure
}

// ── UPDATE: Update book details ──────────────────────────────
function updateBook($id, $title, $author, $category, $status) {
    $conn = getConnection();
    $id   = (int)$id;

    $title    = mysqli_real_escape_string($conn, $title);
    $author   = mysqli_real_escape_string($conn, $author);
    $category = mysqli_real_escape_string($conn, $category);
    $status   = mysqli_real_escape_string($conn, $status);

    $sql    = "UPDATE books
               SET title='$title', author='$author',
                   category='$category', status='$status'
               WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return $result;
}

// ── DELETE: Remove a book ────────────────────────────────────
function deleteBook($id) {
    $conn = getConnection();
    $id   = (int)$id;

    $result = mysqli_query($conn, "DELETE FROM books WHERE id = $id");

    mysqli_close($conn);
    return $result;
}
