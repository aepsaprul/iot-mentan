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
    <div style="display: flex; justify-content: center;">
      <div style="display: flex; justify-content: space-between; width: 300px;">
        <a href="{{ route('login') }}" style="text-decoration: none; background-color: #ffffff; padding: 10px 20px; text-align: center; flex: 1; margin: 5px; border-radius: 5px 5px 0 0; border-bottom: 4px solid #eeff00;">Login</a>
        <a href="{{ route('register') }}" style="text-decoration: none; background-color: #ffffff; padding: 10px 20px; text-align: center; flex: 1; margin: 5px; border-radius: 5px 5px 0 0; border-bottom: 4px solid #00ff37;">Register</a>
      </div>
    </div>
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
