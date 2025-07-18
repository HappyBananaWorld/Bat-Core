<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 - Page Not Found | BatCore</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= assets("welcome.css") ?>">
  <style>
    body {
      margin: 0;
      font-family: 'Fredoka', sans-serif;
      background-color: #0e0e0e;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
      padding: 1rem;
    }

    .error-code {
      font-size: 8rem;
      font-weight: 700;
      color: #ff4c4c;
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% {
        text-shadow: 0 0 10px #ff4c4c, 0 0 20px rgba(255, 76, 76, 0.3);
      }
      50% {
        text-shadow: 0 0 25px #ff4c4c, 0 0 40px rgba(255, 76, 76, 0.6);
      }
    }

    .message {
      font-size: 1.8rem;
      margin: 0.5rem 0;
    }

    .description {
      max-width: 500px;
      margin-top: 1rem;
      font-size: 1rem;
      opacity: 0.85;
      line-height: 1.6;
    }

    .home-link {
      margin-top: 2rem;
      display: inline-block;
      background-color: #ff4c4c;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 10px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(255, 76, 76, 0.4);
      transition: background 0.3s, transform 0.2s ease;
    }

    .home-link:hover {
      background-color: #e03b3b;
      transform: translateY(-2px);
    }

    img.logo {
      width: 100px;
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>
  <div class="error-code">404</div>
  <div class="message">Oops! Page Not Found</div>
  <div class="description">
    The page you’re looking for doesn’t exist or has been moved.<br>
    Don’t worry, let’s get you back on track.
  </div>
  <a href="/" class="home-link">Back to Home</a>
</body>

</html>
