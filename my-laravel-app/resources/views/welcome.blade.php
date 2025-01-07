<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zimou Group - Ticket System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background: #f9fafb;
                color: #333;
            }
            .container {
                text-align: center;
                max-width: 600px;
                background: #fff;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .logo {
                width: 100px;
                margin-bottom: 1rem;
            }
            h1 {
                font-size: 2rem;
                font-weight: 600;
                margin-bottom: 1rem;
                color: #1e293b;
            }
            p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
                color: #475569;
            }
            .btn {
                display: inline-block;
                margin: 0.5rem;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                font-weight: 500;
                color: #fff;
                background: #d9697d;
                border: none;
                border-radius: 6px;
                text-decoration: none;
                transition: background 0.3s ease;
            }
            .btn:hover {
                background: #ac5464;
            }
            .btn-secondary {
                background: #cb4252;
            }
            .btn-secondary:hover {
                background: #9f3642;
            }
            .btn-btn {
                background: #bf1e2e;
            }
            .btn-btn:hover {
                background: #82141f;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <img src="{{ asset('images/zimoulogo.png') }}" alt="Zimou Group Logo" class="logo">
            <h1>Welcome to Zimou Group Ticket System</h1>
            <p>
                Our system helps manage tickets and resolve issues efficiently. Whether you're a client, an employee, or an admin, log in to access your personalized panel.
            </p>
            <a href="http://localhost:8080/client/login" class="btn">Client Panel</a>
            <a href="http://localhost:8080/employee/login" class="btn btn-secondary">Employee Panel</a>
            <a href="http://localhost:8080/admin/login" class="btn btn-btn">Admin Panel</a>
        </div>
    </body>
</html>
