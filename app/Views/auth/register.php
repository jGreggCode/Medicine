<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #2d2d2d;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #dc3545;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 12px 40px;
            border: none;
            background-color: #3d3d3d;
            color: #ffffff;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #4d4d4d;
            box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.3);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #c82333;
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .form-footer a {
            color: #dc3545;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #333;
            color: white;
            padding: 1rem 2rem;
            border-radius: 5px;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast.error {
            background-color: #dc3545;
        }

        .toast.success {
            background-color: #28a745;
        }
    </style>    
</head>
<body>
    <div class="container">
        <h1 class="form-title">Register</h1>
        <form id="registerForm">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" placeholder="Full Name" name="name" required>
            </div>
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Register</button>
            <div class="form-footer">
                Already have an account? <a href="/login">Login</a>
            </div>
        </form>
    </div>
    <div id="toast" class="toast"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/auth/processRegister',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            setTimeout(() => window.location.href = '/login', 1000);
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
                    .removeClass('error success')
                    .addClass(type)
                    .fadeIn();
                
                setTimeout(() => toast.fadeOut(), 3000);
            }
        });
    </script>
</body>
</html> 