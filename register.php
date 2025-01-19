<!DOCTYPE html>
<html>
<head>
    <?php include('header.php'); ?>
    <title>User Registration | Bus Management System</title>
    <style>
        body {
            background-image: url(./assets/img/bus.png);
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body id='register-body' class="bg-light">
    <div class="card col-sm-6 col-md-4 offset-md-4 mt-4">
        <div class="card-header text-white">
            <strong>Register</strong>
        </div>
        <div class="card-body">
            <form id="register-frm">
                <p><b>User Registration Panel</b></p>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>User Type</label>
                    <select name="user_type" class="form-control" required>
                        <option value="1">Admin</option>
                        <option value="2">Staff</option> <!-- Added Staff option -->
                    </select>
                </div>
                <div class="form-group">
                    <label>Username/Email</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm-password" required>
                    <small id="password-error" style="color: red; display: none;">Passwords do not match!</small>
                </div>
                               <!-- Register Button -->
                               <div class="form-group text-right">
                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                </div> 
                <!-- Buttons: Back to Home and Login on same line -->
                <div class="form-group d-flex justify-content-between">
                    <a href="./index.php" class="btn btn-link">Back to Home</a>
                    <a href="./admin.php" class="btn btn-link">Login</a>
                </div>


            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to check if password and confirm password match
            function checkPasswordMatch() {
                let password = $('#password').val();
                let confirmPassword = $('#confirm-password').val();
                if (password !== confirmPassword) {
                    $('#password-error').show(); // Display password mismatch message
                    return false;
                } else {
                    $('#password-error').hide(); // Hide message when passwords match
                    return true;
                }
            }

            // Form submission with AJAX
            $('#register-frm').submit(function (e) {
                e.preventDefault();
                let form = $(this);
                let button = form.find('button');

                // Check if passwords match before proceeding
                if (!checkPasswordMatch()) {
                    return; // Do not proceed with AJAX if passwords don't match
                }

                button.attr('disabled', true);
                button.html('Processing...');

                $.ajax({
                    url: './register_auth.php',
                    method: 'POST',
                    data: form.serialize(),
                    error: err => {
                        console.log(err);
                        alert('An error occurred');
                        button.attr('disabled', false);
                        button.html('Register');
                    },
                    success: resp => {
                        if (resp == 1) {
                            alert("Registration successful!");
                            location.replace('./admin.php');
                        } else if (resp == 2) {
                            alert("Username already exists!");
                        } else {
                            alert("Registration failed!");
                        }
                        button.attr('disabled', false);
                        button.html('Register');
                    }
                });
            });
        });
    </script>
</body>
</html>
