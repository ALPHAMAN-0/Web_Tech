<?php


require_once __DIR__ . '/../models/BookModel.php';

function handleRequest($action, $data) {

    switch ($action) {

        case 'getAll':
            $books = getAllBooks();
            echo json_encode([
                "success" => true,
                "books"   => $books
            ]);
            break;

        case 'getOne':
            $id   = (int)($data['id'] ?? 0);
            $book = getBookById($id);

            if ($book) {
                echo json_encode(["success" => true, "book" => $book]);
            } else {
                echo json_encode(["success" => false, "message" => "Book not found."]);
            }
            break;

        case 'add':
            $title    = trim($data['title']    ?? '');
            $author   = trim($data['author']   ?? '');
            $category = trim($data['category'] ?? '');
            $status   = $data['status'] ?? 'available';

            // Validate
            if (empty($title) || empty($author) || empty($category)) {
                echo json_encode([
                    "success" => false,
                    "message" => "Title, Author, and Category are required."
                ]);
                break;
            }

            $result = addBook($title, $author, $category, $status);

            if ($result) {
                echo json_encode(["success" => true,  "message" => "Book added successfully!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to add book."]);
            }
            break;

        case 'update':
            $id       = (int)($data['id']       ?? 0);
            $title    = trim($data['title']    ?? '');
            $author   = trim($data['author']   ?? '');
            $category = trim($data['category'] ?? '');
            $status   = $data['status'] ?? 'available';

            // Validate
            if ($id === 0 || empty($title) || empty($author) || empty($category)) {
                echo json_encode([
                    "success" => false,
                    "message" => "All fields are required."
                ]);
                break;
            }

            $result = updateBook($id, $title, $author, $category, $status);

            if ($result) {
                echo json_encode(["success" => true,  "message" => "Book updated successfully!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update book."]);
            }
            break;


        case 'delete':
            $id = (int)($data['id'] ?? 0);

            if ($id === 0) {
                echo json_encode(["success" => false, "message" => "Invalid book ID."]);
                break;
            }

            $result = deleteBook($id);

            if ($result) {
                echo json_encode(["success" => true,  "message" => "Book deleted successfully!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to delete book."]);
            }
            break;

        default:
            echo json_encode(["success" => false, "message" => "Unknown action: $action"]);
    }
}
