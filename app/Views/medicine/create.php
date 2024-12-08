<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            color: #ffffff;
            min-height: 100vh;
            padding: 2rem;
        }

        .form-container {
            background-color: #2d2d2d;
            padding: 2rem;
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-title {
            color: #dc3545;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background-color: #3d3d3d;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.3);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .btn-container {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #dc3545;
            color: #ffffff;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
            text-decoration: none;
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
    <div class="form-container">
        <h1 class="form-title">Add New Medicine</h1>
        <form id="medicineForm">
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
                <button type="submit" class="btn btn-primary">Add Medicine</button>
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
                    url: '/medicine/store',
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