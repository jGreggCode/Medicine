<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Use same base styles as dashboard */
        .medicine-container {
            padding: 2rem;
            background-color: #2d2d2d;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .search-bar {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
        }

        .search-bar input {
            flex: 1;
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

        .toast {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 1rem 2rem;
            border-radius: 5px;
            color: white;
            display: none;
        }
    </style>
</head>
<body>
    <div class="medicine-container">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search medicines...">
            <a href="/medicine/create" class="btn-add">Add Medicine</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Expiration Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicines as $medicine): ?>
                <tr>
                    <td><?= $medicine['name'] ?></td>
                    <td><?= $medicine['brand'] ?></td>
                    <td>$<?= number_format($medicine['price'], 2) ?></td>
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

    <div id="toast" class="toast"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const searchTerm = $(this).val();
            window.location.href = `/medicine?search=${searchTerm}`;
        });

        function editMedicine(id) {
            window.location.href = `/medicine/edit/${id}`;
        }

        function deleteMedicine(id) {
            if (confirm('Are you sure you want to delete this medicine?')) {
                $.ajax({
                    url: `/medicine/delete/${id}`,
                    method: 'POST',
                    success: function(response) {
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showToast(response.message, 'error');
                        }
                    }
                });
            }
        }

        function showToast(message, type) {
            const toast = $('#toast');
            toast.text(message)
                .css('background-color', type === 'success' ? '#28a745' : '#dc3545')
                .fadeIn();
            
            setTimeout(() => toast.fadeOut(), 3000);
        }
    </script>
</body>
</html> 