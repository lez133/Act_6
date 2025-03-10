<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 600px; margin: 100px auto; }
        .btn { padding: 10px; background-color: #f44336; color: white; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
        <p>Email: {{ Auth::user()->email }}</p>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</body>
</html>
