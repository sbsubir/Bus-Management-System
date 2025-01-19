<!DOCTYPE html>
<html>
<head>
    <?php include('header.php'); ?>
    <title>Admin Login | Bus Management System</title>
    <style>
        body {
            background-image: url(./assets/img/bus.png);
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
        }
        .login-links {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .login-links a {
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body id='login-body' class="bg-light">
    <div class="card col-md-4 offset-md-4 mt-4">
        <div class="card-header text-white">
            <strong>Login</strong>
        </div>
        <div class="card-body">
            <form id="login-frm">
                <p><b>Admin Login Panel</b></p>
                <div class="form-group">
                    <label>Username/Email</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-success btn-block" type="submit">Login as Admin</button>
                </div>
                <div class="login-links">
                    <a href="./index.php">Back to Home</a>
                    <a href="./register.php" class="text-right">Register as Admin</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#login-frm').submit(function(e){
                e.preventDefault();
                let button = $('#login-frm button');
                button.attr('disabled', true);
                button.html('Checking details...');

                $.ajax({
                    url: './login_auth.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    error: err => {
                        console.log(err);
                        alert('An error occurred. Please try again.');
                        button.removeAttr('disabled');
                        button.html('Login');
                    },
                    success: function(resp) {
                        if (resp == 1) {
                            location.replace('index.php?page=home'); // Redirect to home if login is successful
                        } else {
                            alert("Incorrect username or password.");
                            button.removeAttr('disabled');
                            button.html('Login');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
