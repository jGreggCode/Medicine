<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background-color: #2d2d2d;
            padding: 2rem;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        .user-info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background-color: #dc3545;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .nav-links {
            list-style: none;
        }

        .nav-links li {
            margin-bottom: 1rem;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #dc3545;
        }

        .nav-links i {
            margin-right: 10px;
            width: 20px;
        }

        .welcome-card {
            background-color: #2d2d2d;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background-color: #2d2d2d;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }

        .stat-card i {
            font-size: 2rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .logout-btn {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            right: 2rem;
            padding: 0.8rem;
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        /* Add table styles */
        .table-container {
            background-color: #2d2d2d;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .search-bar {
            flex: 1;
            margin-right: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background-color: #3d3d3d;
            color: white;
        }

        .btn-add {
            padding: 0.8rem 1.5rem;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #3d3d3d;
        }

        th {
            background-color: #3d3d3d;
            color: white;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit, .btn-delete {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: #2d2d2d;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background-color: #3d3d3d;
            color: white;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 1rem 2rem;
            border-radius: 5px;
            color: white;
            display: none;
            z-index: 1001;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h3><?= session()->get('name') ?></h3>
            <p><?= session()->get('email') ?></p>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
        <a href="/auth/logout" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="content">
        <div class="welcome-card">
            <h1>Welcome back, <?= session()->get('name') ?>!</h1>
            <p>Here's the medicine system.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-pills"></i>
                <h3>Total Medicines</h3>
                <p><?= $totalMedicines ?></p>
            </div>
            <div class="stat-card">
                <i class="fas fa-boxes"></i>
                <h3>Total Stock</h3>
                <p><?= $totalStock ?></p>
            </div>
            <div class="stat-card">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Expired Medicines</h3>
                <p><?= $expiredMedicines ?></p>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="search-bar">
                    <input type="text" id="searchInput" class="search-input" placeholder="Search medicines...">
                </div>
                <button class="btn-add" onclick="openAddModal()">Add Medicine</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Expiration Date</th>
                        <th>Expired</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="medicineTable">
                    <?php foreach ($medicines as $medicine): ?>
                    <tr>
                        <td><?= $medicine['name'] ?></td>
                        <td><?= $medicine['brand'] ?></td>
                        <td><?= $medicine['description'] ?></td>
                        <td>PHP <?= number_format($medicine['price'], 2) ?></td>
                        <td><?= $medicine['stock'] ?></td>
                        <td><?= date('Y-m-d', strtotime($medicine['expirationDate'])) ?></td>
                        <td><?= $medicine['isExpired'] ?></td>
                        <td class="actions">
                            <button class="btn-edit" onclick="editMedicine(<?= $medicine['id'] ?>)">Edit</button>
                            <button class="btn-delete" onclick="deleteMedicine(<?= $medicine['id'] ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="medicineModal" class="modal">
        <div class="modal-content">
            <h2 id="modalTitle">Add Medicine</h2>
            <form id="medicineForm">
                <input type="hidden" id="medicineId">
                <div class="form-group">
                    <label for="name">Medicine Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="expirationDate">Expiration Date</label>
                    <input type="date" class="form-control" id="expirationDate" name="expirationDate" required>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast" class="toast"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('#medicineTable tr').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(searchTerm) > -1);
            });
        });

        function openAddModal() {
            $('#modalTitle').text('Add Medicine');
            $('#medicineId').val('');
            $('#medicineForm')[0].reset();
            $('#medicineModal').show();
        }

        function closeModal() {
            $('#medicineModal').hide();
        }

        function editMedicine(id) {
            $.get(`/medicine/get/${id}`, function(medicine) {
                $('#modalTitle').text('Edit Medicine');
                $('#medicineId').val(medicine.id);
                $('#name').val(medicine.name);
                $('#description').val(medicine.description);
                $('#brand').val(medicine.brand);
                $('#price').val(medicine.price);
                $('#stock').val(medicine.stock);
                $('#expirationDate').val(medicine.expirationDate.split(' ')[0]);
                $('#medicineModal').show();
            });
        }

        function deleteMedicine(id) {
            if (confirm('Are you sure you want to delete this medicine?')) {
                $.post(`/medicine/delete/${id}`, function(response) {
                    if (response.status === 'success') {
                        showToast(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showToast(response.message, 'error');
                    }
                });
            }
        }

        $('#medicineForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#medicineId').val();
            const url = id ? `/medicine/update/${id}` : '/medicine/store';
            
            $.ajax({
                url: url,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        showToast(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showToast(response.message, 'error');
                    }
                }
            });
        });

        function showToast(message, type) {
            const toast = $('#toast');
            toast.text(message)
                .css('background-color', type === 'success' ? '#28a745' : '#dc3545')
                .fadeIn();
            
            setTimeout(() => toast.fadeOut(), 3000);
        }

        // Close modal when clicking outside
        $(window).click(function(e) {
            if ($(e.target).is('.modal')) {
                closeModal();
            }
        });
    </script>
</body>
</html> 