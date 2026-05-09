<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Library Management System</title>


    <style>
        /* ── Reset & Base ─────────────────────────────────── */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f8;
            color: #333;
        }

        /* ── Header ──────────────────────────────────────── */
        header {
            background: #1a3c5e;
            color: white;
            padding: 18px 30px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        header h1 { font-size: 22px; font-weight: 600; }
        header p  { font-size: 13px; opacity: 0.75; margin-top: 2px; }

        /* ── Layout ───────────────────────────────────────── */
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }

        /* ── Toast Notification ───────────────────────────── */
        #toast {
            display: none;
            position: fixed;
            top: 20px; right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            z-index: 9999;
            min-width: 260px;
            animation: fadeIn .3s ease;
        }
        #toast.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        #toast.error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; } }

        /* ── Card ─────────────────────────────────────────── */
        .card {
            background: white;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            margin-bottom: 24px;
        }
        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a3c5e;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e8f0f7;
        }

        /* ── Form ─────────────────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 13px; font-weight: 500; color: #555; }
        .form-group input,
        .form-group select {
            padding: 9px 12px;
            border: 1px solid #d0d9e3;
            border-radius: 6px;
            font-size: 14px;
            transition: border .2s;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #1a3c5e;
        }
        .form-actions {
            margin-top: 16px;
            display: flex;
            gap: 10px;
        }

        /* ── Buttons ──────────────────────────────────────── */
        .btn {
            padding: 9px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity .2s;
        }
        .btn:hover  { opacity: .85; }
        .btn-primary { background: #1a3c5e; color: white; }
        .btn-warning { background: #e67e22; color: white; }
        .btn-danger  { background: #e74c3c; color: white; }
        .btn-cancel  { background: #ecf0f1; color: #555; }
        .btn-sm { padding: 5px 12px; font-size: 12px; }

        /* ── Table ────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            background: #1a3c5e;
            color: white;
            padding: 11px 14px;
            text-align: left;
            font-weight: 500;
        }
        tbody tr { border-bottom: 1px solid #ecf0f1; }
        tbody tr:hover { background: #f7fafd; }
        tbody td { padding: 10px 14px; }

        /* ── Status Badge ─────────────────────────────────── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-available   { background: #d4edda; color: #155724; }
        .badge-unavailable { background: #f8d7da; color: #721c24; }

        /* ── Loading ─────────────────────────────────────── */
        #loading {
            text-align: center;
            padding: 30px;
            color: #888;
            font-size: 14px;
        }

        /* ── Stats bar ───────────────────────────────────── */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 18px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            text-align: center;
        }
        .stat-card .num  { font-size: 28px; font-weight: 700; color: #1a3c5e; }
        .stat-card .lbl  { font-size: 12px; color: #888; margin-top: 2px; }

        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .stats { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ── Header ──────────────────────────────────────────────── -->
<header>
    <div>
        <h1>University Library Management System</h1>
        <p>Manage book records — Add, Edit, Delete with live updates</p>
    </div>
</header>

<!-- ── Toast Notification ──────────────────────────────────── -->
<div id="toast"></div>

<div class="container">

    <!-- ── Stats Row ─────────────────────────────────────── -->
    <div class="stats">
        <div class="stat-card">
            <div class="num" id="stat-total">0</div>
            <div class="lbl">Total Books</div>
        </div>
        <div class="stat-card">
            <div class="num" id="stat-available" style="color:#155724">0</div>
            <div class="lbl">Available</div>
        </div>
        <div class="stat-card">
            <div class="num" id="stat-unavailable" style="color:#721c24">0</div>
            <div class="lbl">Unavailable</div>
        </div>
    </div>

    <!-- ── Add / Edit Form ───────────────────────────────── -->
    <div class="card">
        <div class="card-title" id="form-title">Add New Book</div>

        <!-- Hidden field to track edit mode -->
        <input type="hidden" id="edit-id" value="">

        <div class="form-grid">
            <div class="form-group">
                <label for="title">Book Title *</label>
                <input type="text" id="title" placeholder="e.g. Introduction to Algorithms">
            </div>
            <div class="form-group">
                <label for="author">Author Name *</label>
                <input type="text" id="author" placeholder="e.g. Thomas H. Cormen">
            </div>
            <div class="form-group">
                <label for="category">Category *</label>
                <input type="text" id="category" placeholder="e.g. Computer Science">
            </div>
            <div class="form-group">
                <label for="status">Availability Status</label>
                <select id="status">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" id="submit-btn" onclick="submitForm()">
                Add Book
            </button>
            <button class="btn btn-cancel" id="cancel-btn"
                    onclick="cancelEdit()" style="display:none">
                Cancel
            </button>
        </div>
    </div>

    <!-- ── Books Table ───────────────────────────────────── -->
    <div class="card">
        <div class="card-title">All Books</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="book-table-body">
                    <tr><td colspan="6" id="loading">Loading books...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /container -->


<!-- =====================================================
     AJAX JAVASCRIPT  —  All server communication is here
     fetch() sends requests to ajax_handler.php
     and updates the page without refreshing.
====================================================== -->
<script>

// ── Utility: Show toast message ────────────────────────────
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className   = type;
    toast.style.display = 'block';
    setTimeout(() => { toast.style.display = 'none'; }, 3000);
}

// ── Utility: Reset form to "Add" mode ─────────────────────
function resetForm() {
    document.getElementById('edit-id').value = '';
    document.getElementById('title').value   = '';
    document.getElementById('author').value  = '';
    document.getElementById('category').value = '';
    document.getElementById('status').value  = 'available';
    document.getElementById('form-title').textContent   = 'Add New Book';
    document.getElementById('submit-btn').textContent   = 'Add Book';
    document.getElementById('submit-btn').className     = 'btn btn-primary';
    document.getElementById('cancel-btn').style.display = 'none';
}

function cancelEdit() {
    resetForm();
}

// ──────────────────────────────────────────────────────────
// READ — Load all books via AJAX (GET)
// ──────────────────────────────────────────────────────────
function loadBooks() {
    fetch('ajax_handler.php?action=getAll')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('book-table-body');

            if (!data.success) {
                tbody.innerHTML = `<tr><td colspan="6" style="color:red;text-align:center">
                    Error: ${data.message}</td></tr>`;
                return;
            }

            const books = data.books;
            document.getElementById('stat-total').textContent =
                books.length;
            document.getElementById('stat-available').textContent =
                books.filter(b => b.status === 'available').length;
            document.getElementById('stat-unavailable').textContent =
                books.filter(b => b.status === 'unavailable').length;

            if (books.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6"
                    style="text-align:center;color:#888;padding:30px">
                    No books found. Add one above!</td></tr>`;
                return;
            }

            tbody.innerHTML = books.map((book, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${escHtml(book.title)}</strong></td>
                    <td>${escHtml(book.author)}</td>
                    <td>${escHtml(book.category)}</td>
                    <td>
                        <span class="badge badge-${book.status}">
                            ${book.status}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="loadEditForm(${book.id})">Edit</button>
                        <button class="btn btn-danger btn-sm"
                            onclick="deleteBook(${book.id}, '${escHtml(book.title)}')">
                            Delete</button>
                    </td>
                </tr>
            `).join('');
        })
        .catch(err => {
            showToast('Network error loading books.', 'error');
        });
}

// ──────────────────────────────────────────────────────────
// CREATE or UPDATE — Submit form via AJAX (POST)
// ──────────────────────────────────────────────────────────
function submitForm() {
    const id       = document.getElementById('edit-id').value;
    const title    = document.getElementById('title').value.trim();
    const author   = document.getElementById('author').value.trim();
    const category = document.getElementById('category').value.trim();
    const status   = document.getElementById('status').value;

    // Basic front-end validation
    if (!title || !author || !category) {
        showToast('Please fill in Title, Author, and Category.', 'error');
        return;
    }

    // Decide action based on edit mode
    const action = id ? 'update' : 'add';

    // Build form data to POST
    const formData = new URLSearchParams();
    formData.append('action',   action);
    formData.append('title',    title);
    formData.append('author',   author);
    formData.append('category', category);
    formData.append('status',   status);
    if (id) formData.append('id', id);

    // AJAX POST request
    fetch('ajax_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData.toString()
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            resetForm();    // clear the form
            loadBooks();    // refresh the table
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => {
        showToast('Network error. Please try again.', 'error');
    });
}

// ──────────────────────────────────────────────────────────
// READ (single) — Load book data into form for editing
// ──────────────────────────────────────────────────────────
function loadEditForm(id) {
    fetch(`ajax_handler.php?action=getOne&id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                showToast(data.message, 'error');
                return;
            }

            const book = data.book;

            // Populate form fields
            document.getElementById('edit-id').value    = book.id;
            document.getElementById('title').value      = book.title;
            document.getElementById('author').value     = book.author;
            document.getElementById('category').value   = book.category;
            document.getElementById('status').value     = book.status;

            // Switch form to "Edit" mode
            document.getElementById('form-title').textContent   = 'Edit Book';
            document.getElementById('submit-btn').textContent   = 'Update Book';
            document.getElementById('submit-btn').className     = 'btn btn-warning';
            document.getElementById('cancel-btn').style.display = 'inline-block';

            // Scroll to form
            window.scrollTo({ top: 0, behavior: 'smooth' });
        })
        .catch(err => {
            showToast('Failed to load book data.', 'error');
        });
}

// ──────────────────────────────────────────────────────────
// DELETE — Remove a book via AJAX (POST)
// ──────────────────────────────────────────────────────────
function deleteBook(id, title) {
    if (!confirm(`Delete "${title}"?\nThis cannot be undone.`)) return;

    const formData = new URLSearchParams();
    formData.append('action', 'delete');
    formData.append('id',     id);

    fetch('ajax_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData.toString()
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            loadBooks();    // refresh the table
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => {
        showToast('Network error deleting book.', 'error');
    });
}

// ── Escape HTML to prevent XSS ────────────────────────────
function escHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// ── Load books when page opens ─────────────────────────────
loadBooks();

</script>
</body>
</html>
