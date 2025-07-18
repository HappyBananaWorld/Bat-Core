<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to BatCore</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= assets("welcome.css") ?>">
   <!-- <link rel="stylesheet" href="/assets/welcome.css"> -->
</head>
<body>
  <img src="<?= images('logo.jpg')?>" alt="BatCore Logo">
  <div class="title">Welcome to BatCore</div>
  <div class="slogan">Speed is Everything</div>
  <div class="description">
    BatCore is a revolutionary PHP micro-framework crafted for developers who crave speed, security, and simplicity. With a sleek, lightweight core, it empowers you to build APIs, tools, and backends with unmatched efficiency and elegance.
  </div>
  <div class="features">
    <div class="feature"><span>🔒</span><p>Encryption of all data for maximum security</p></div>
    <div class="feature"><span>🛠️</span><p>Infinite helpers for front-end, back-end, and developer convenience</p></div>
    <div class="feature"><span>⚡</span><p>Ultra-high performance for lightning-fast execution</p></div>
    <div class="feature"><span>📦</span><p>Custom and simple ORM for easy database handling</p></div>
    <div class="feature"><span>💾</span><p>Exclusive BatBin database system</p></div>
    <div class="feature"><span>🛡️</span><p>Advanced security with validation, CSRF, SQLi prevention, and full OWASP compliance</p></div>
  </div>
</body>
</html>