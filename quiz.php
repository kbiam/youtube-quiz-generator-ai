<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Quiz Generator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f9fafb;
            background-image: 
                radial-gradient(at 47% 33%, hsl(348.92, 100%, 94%) 0, transparent 59%), 
                radial-gradient(at 82% 65%, hsl(0.00, 0%, 98%) 0, transparent 55%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .logo {
            width: 64px;
            height: 64px;
            background: #FF0000;
            border-radius: 16px;
            margin: 0 auto 1.5rem;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo::before {
            content: '';
            border-style: solid;
            border-width: 15px 0 15px 25px;
            border-color: transparent transparent transparent white;
            margin-left: 5px;
        }

        h1 {
            color: #1f2937;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .input-container {
            position: relative;
            width: 100%;
        }

        input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #1f2937;
        }

        input:focus {
            outline: none;
            border-color: #FF0000;
            box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        button {
            background: #FF0000;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        button:hover {
            background: #e50000;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 0, 0, 0.15);
        }

        button:active {
            transform: translateY(0);
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .feature {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .feature-icon {
            background: #f3f4f6;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 640px) {
            .container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.75rem;
            }

            .features {
                flex-direction: column;
                gap: 1rem;
            }

            .feature {
                flex-direction: row;
                text-align: left;
            }
        }

        /* Loading animation */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid #ffffff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Form submitting state */
        form.submitting button {
            background: #cccccc;
            cursor: not-allowed;
        }

        form.submitting .loading {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo"></div>
        <h1>YouTube Quiz Generator</h1>
        <p class="subtitle">Create engaging quizzes from any YouTube video in seconds</p>
        
        <form action="process.php" method="POST" id="quiz-form">
            <div class="input-container">
                <svg class="input-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.8333 17.5H4.16667C3.24619 17.5 2.5 16.7538 2.5 15.8333V4.16667C2.5 3.24619 3.24619 2.5 4.16667 2.5H15.8333C16.7538 2.5 17.5 3.24619 17.5 4.16667V15.8333C17.5 16.7538 16.7538 17.5 15.8333 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.33334 7.5L12.5 10L8.33334 12.5V7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="text" name="youtube_link" placeholder="Paste YouTube video URL here" required>
            </div>
            <button type="submit">
                Generate Quiz
                <div class="loading"></div>
            </button>
        </form>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">🎯</div>
                <span>AI-Powered Questions</span>
            </div>
            <div class="feature">
                <div class="feature-icon">⚡</div>
                <span>Instant Generation</span>
            </div>
            <div class="feature">
                <div class="feature-icon">📱</div>
                <span>Mobile Friendly</span>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('quiz-form');
        
        form.addEventListener('submit', (e) => {
            form.classList.add('submitting');
        });
    </script>
</body>
</html>