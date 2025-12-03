<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perpustakaan Digital - Laravel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #667eea;
            font-size: 32px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: #ed8936;
            color: white;
        }

        .btn-danger {
            background: #f56565;
            color: white;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        .search-box {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 18px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: #f7fafc;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #e6f2ff;
            color: #667eea;
        }

        .pagination {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f7fafc;
        }

        .pagination-info {
            color: #4a5568;
            font-size: 14px;
        }

        .pagination-buttons button {
            margin: 0 5px;
            padding: 8px 16px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .pagination-buttons button:hover:not(:disabled) {
            border-color: #667eea;
            color: #667eea;
        }

        .pagination-buttons button.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .pagination-buttons button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .modal-header h2 {
            color: #2d3748;
            font-size: 24px;
        }

        .close {
            font-size: 28px;
            cursor: pointer;
            color: #a0aec0;
            transition: all 0.3s;
        }

        .close:hover {
            color: #f56565;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3748;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .form-actions button {
            flex: 1;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #a0aec0;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 20px;
            color: #667eea;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background: #48bb78;
            color: white;
        }

        .alert-error {
            background: #f56565;
            color: white;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Perpustakaan Digital - Laravel</h1>
            <button class="btn btn-primary" onclick="openModal()">Tambah Buku</button>
        </div>

        <div id="alertBox"></div>

        <div class="search-box">
            <input
                type="text"
                class="search-input"
                id="searchInput"
                placeholder="Cari berdasarkan judul, penulis, atau kategori..."
            >
        </div>

        <div class="loading" id="loading">Memuat data...</div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>ISBN</th>
                        <th>Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="bookTable">
                </tbody>
            </table>

            <div class="pagination">
                <div class="pagination-info" id="paginationInfo"></div>
                <div class="pagination-buttons" id="paginationButtons"></div>
            </div>
        </div>
    </div>

    <div class="modal" id="bookModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Buku Baru</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" id="title" required>
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" id="author" required>
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" id="year" required>
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" id="isbn" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" id="category" required>
            </div>
            <div class="form-actions">
                <button class="btn" onclick="closeModal()" style="background: #e2e8f0; color: #2d3748;">Batal</button>
                <button class="btn btn-primary" onclick="saveBook()">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        let currentPage = 1;
        let totalData = 0;
        let itemsPerPage = 5;
        let editingId = null;
        let searchTimeout = null;

        document.addEventListener('DOMContentLoaded', function() {
            loadBooks();

            document.getElementById('searchInput').addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                document.getElementById('loading').style.display = 'block';

                searchTimeout = setTimeout(function() {
                    currentPage = 1;
                    loadBooks(e.target.value);
                }, 300);
            });
        });

        function loadBooks(search = '') {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `/api/books?page=${currentPage}&search=${encodeURIComponent(search)}`, true);

            xhr.onload = function() {
                document.getElementById('loading').style.display = 'none';

                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        totalData = response.total;
                        renderTable(response.data);
                        renderPagination();
                    } else {
                        showAlert('error', 'Gagal memuat data');
                    }
                }
            };

            xhr.onerror = function() {
                document.getElementById('loading').style.display = 'none';
                showAlert('error', 'Terjadi kesalahan koneksi');
            };

            xhr.send();
        }

        function renderTable(books) {
            const tableBody = document.getElementById('bookTable');
            const start = (currentPage - 1) * itemsPerPage;

            if (books.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="empty-state">
                            <div style="font-size: 48px;">📭</div>
                            <div style="margin-top: 10px;">Tidak ada data ditemukan</div>
                        </td>
                    </tr>
                `;
            } else {
                tableBody.innerHTML = books.map((book, index) => `
                    <tr>
                        <td>${start + index + 1}</td>
                        <td><strong>${book.title}</strong></td>
                        <td>${book.author}</td>
                        <td>${book.year}</td>
                        <td>${book.isbn}</td>
                        <td><span class="badge">${book.category}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-warning btn-sm" onclick='editBook(${JSON.stringify(book)})'>Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteBook(${book.id})">Hapus</button>
                            </div>
                        </td>
                    </tr>
                `).join('');
            }
        }

        function renderPagination() {
            const totalPages = Math.ceil(totalData / itemsPerPage);
            const start = (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, totalData);

            document.getElementById('paginationInfo').innerHTML =
                `Menampilkan ${start} - ${end} dari ${totalData} data`;

            let paginationHTML = '';

            paginationHTML += `<button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>Previous</button>`;

            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `<button onclick="changePage(${i})" class="${i === currentPage ? 'active' : ''}">${i}</button>`;
            }

            paginationHTML += `<button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>`;

            document.getElementById('paginationButtons').innerHTML = paginationHTML;
        }

        function changePage(page) {
            const totalPages = Math.ceil(totalData / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                const search = document.getElementById('searchInput').value;
                loadBooks(search);
            }
        }

        function openModal(book = null) {
            const modal = document.getElementById('bookModal');

            if (book) {
                editingId = book.id;
                document.getElementById('modalTitle').textContent = 'Edit Buku';
                document.getElementById('title').value = book.title;
                document.getElementById('author').value = book.author;
                document.getElementById('year').value = book.year;
                document.getElementById('isbn').value = book.isbn;
                document.getElementById('category').value = book.category;
            } else {
                editingId = null;
                document.getElementById('modalTitle').textContent = 'Tambah Buku Baru';
                document.getElementById('title').value = '';
                document.getElementById('author').value = '';
                document.getElementById('year').value = '';
                document.getElementById('isbn').value = '';
                document.getElementById('category').value = '';
            }

            modal.classList.add('active');
        }

        function closeModal() {
            document.getElementById('bookModal').classList.remove('active');
            editingId = null;
        }

        function editBook(book) {
            openModal(book);
        }

        function saveBook() {
            const title = document.getElementById('title').value.trim();
            const author = document.getElementById('author').value.trim();
            const year = document.getElementById('year').value.trim();
            const isbn = document.getElementById('isbn').value.trim();
            const category = document.getElementById('category').value.trim();

            if (!title || !author || !year || !isbn || !category) {
                showAlert('error', 'Semua field harus diisi!');
                return;
            }

            const data = {
                title: title,
                author: author,
                year: parseInt(year),
                isbn: isbn,
                category: category
            };

            const xhr = new XMLHttpRequest();

            if (editingId) {
                xhr.open('PUT', `/api/books/${editingId}`, true);
            } else {
                xhr.open('POST', '/api/books', true);
            }

            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        showAlert('success', response.message);
                        closeModal();
                        loadBooks(document.getElementById('searchInput').value);
                    } else {
                        showAlert('error', response.message || 'Terjadi kesalahan');
                    }
                }
            };

            xhr.send(JSON.stringify(data));
        }

        function deleteBook(id) {
            if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('DELETE', `/api/books/${id}`, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            showAlert('success', response.message);
                            loadBooks(document.getElementById('searchInput').value);
                        } else {
                            showAlert('error', response.message);
                        }
                    }
                };

                xhr.send();
            }
        }

        function showAlert(type, message) {
            const alertBox = document.getElementById('alertBox');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';

            alertBox.innerHTML = `<div class="alert ${alertClass}">${message}</div>`;

            setTimeout(function() {
                alertBox.innerHTML = '';
            }, 3000);
        }

        window.onclick = function(event) {
            const modal = document.getElementById('bookModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
