<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 400px; margin: 100px auto; }
        .input-field { width: 100%; padding: 10px; margin-bottom: 10px; }
        .btn { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="register-form">
            <input type="text" id="first_name" class="input-field" placeholder="First Name">
            <input type="text" id="middle_name" class="input-field" placeholder="Middle Name">
            <input type="text" id="last_name" class="input-field" placeholder="Last Name">
            <input type="email" id="email" class="input-field" placeholder="Email">
            <input type="password" id="password" class="input-field" placeholder="Password">
            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="/login">Login</a></p>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let first_name = document.getElementById('first_name').value;
            let middle_name = document.getElementById('middle_name').value;
            let last_name = document.getElementById('last_name').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    first_name: first_name,
                    middle_name: middle_name,
                    last_name: last_name,
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert('Registration failed. Please check your input.');
                }
            });
        });
    </script>
</body>
</html>