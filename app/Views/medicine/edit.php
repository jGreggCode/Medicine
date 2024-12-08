<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Use the same CSS as create.php */
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Edit Medicine</h1>
        <form id="medicineForm">
            <div class="form-group">
                <label for="name">Medicine Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $medicine['name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= $medicine['description'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?= $medicine['brand'] ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $medicine['price'] ?>" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?= $medicine['stock'] ?>" required>
            </div>

            <div class="form-group">
                <label for="expirationDate">Expiration Date</label>
                <input type="date" class="form-control" id="expirationDate" name="expirationDate" 
                    value="<?= date('Y-m-d', strtotime($medicine['expirationDate'])) ?>" required>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Update Medicine</button>
                <a href="/medicine" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <div id="toast" class="toast"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#medicineForm').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '/medicine/update/<?= $medicine['id'] ?>',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            setTimeout(() => window.location.href = '/medicine', 1000);
                        } else {
                            showToast(response.message, 'error');
                        }
                    },
                    error: function() {
                        showToast('An error occurred', 'error');
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
        });
    </script>
</body>
</html> 