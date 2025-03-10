<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        input { width: 90%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background: blue; color: white; border: none; }
        .social-login a { display: block; margin: 10px 0; padding: 10px; background: #ddd; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        
        <div class="social-login">
            <a href="{{ url('/auth/redirect/google') }}">Login with Google</a>
            <a href="{{ url('/auth/redirect/facebook') }}">Login with Facebook</a>
        </div>
        
        <p><a href="{{ url('/register') }}">Don't have an account? Register</a></p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch('/login', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            });
        });
    </script>
</body>
</html>
