<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem 3rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        input {
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            outline: none;
            width: 100%;
        }

        input:focus {
            border-color: #667eea;
        }

        input::placeholder {
            color: #9ca3af;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        button:active {
            transform: translateY(0);
        }

        p {
            text-align: center;
            margin-top: 1.5rem;
            color: #4b5563;
        }

        a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #764ba2;
        }

        @media (max-width: 480px) {
            .container {
                margin: 1rem;
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
