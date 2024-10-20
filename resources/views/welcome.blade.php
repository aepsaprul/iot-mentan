<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  <title>Coming Soon</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #4A90E2, #50E3C2);
      color: white;
      text-align: center;
    }
    .container {
      max-width: 800px;
      padding: 20px;
    }
    h1 {
      font-size: 4rem;
      margin-bottom: 20px;
    }
    p {
      font-size: 1.5rem;
      margin-bottom: 30px;
    }
    .timer {
      font-size: 2rem;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('login') }}" style="padding: 10px 30px 10px 30px; background-color: white; text-decoration: none; color: rgb(90, 90, 90); font-weight: bold; border: 1px solid rgb(17, 0, 255);">Login</a>
    <h1>Coming Soon!</h1>
    <p>We are working hard to give you a better experience. Stay tuned for something amazing!</p>
    <div class="timer" id="countdown">00:00:00:00</div>
  </div>

  <script>
    // Set the date for the launch
    const launchDate = new Date("Dec 31, 2024 00:00:00").getTime();

    const countdown = document.getElementById('countdown');

    const timer = setInterval(function() {
      const now = new Date().getTime();
      const distance = launchDate - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      countdown.innerHTML = `${days}h ${hours}j ${minutes}m ${seconds}d`;

      if (distance < 0) {
        clearInterval(timer);
        countdown.innerHTML = "We are live!";
      }
    }, 1000);
  </script>
</body>
</html>
