<?php include 'header.php'; ?>

<style>
  body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #fff;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 1200px;
    width: 90%;
    margin: 60px auto 100px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    padding: 0 12px;
  }

  .box {
    border-radius: 20px;
    padding: 32px 36px;
    background: linear-gradient(145deg, rgba(255 255 255 / 0.15), rgba(255 255 255 / 0.05));
    box-shadow:
      0 8px 16px rgba(0,0,0,0.3),
      inset 0 0 10px rgba(255 255 255 / 0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    cursor: pointer;
    user-select: none;
    transition:
      transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
      box-shadow 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  .box:hover {
    transform: translateY(-18px) scale(1.05);
    box-shadow:
      0 20px 40px rgba(0,0,0,0.5),
      inset 0 0 25px rgba(255 255 255 / 0.3);
  }

  .box::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 20px;
    padding: 2px;
    background: linear-gradient(270deg, #ff00cc, #3333ff, #00ffff, #ff00cc);
    background-size: 600% 600%;
    animation: glowing 15s linear infinite;
    -webkit-mask:
      linear-gradient(#fff 0 0) content-box, 
      linear-gradient(#fff 0 0);
    -webkit-mask-composite: destination-out;
    mask-composite: exclude;
    pointer-events: none;
  }

  @keyframes glowing {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .box img.logo {
    width: 90px;
    height: 90px;
    object-fit: contain;
    margin-bottom: 20px;
    filter: drop-shadow(0 0 6px rgba(0,0,0,0.3));
  }

  .box h2 {
    margin: 0 0 20px 0;
    font-weight: 900;
    font-size: 1.8rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
  }

  .btn-group {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
  }

  .btn {
    padding: 14px 26px;
    font-weight: 700;
    font-size: 1rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    color: #fff;
    background: #4a90e2;
    box-shadow: 0 4px 12px rgba(74,144,226,0.6);
    transition: background-color 0.3s ease, transform 0.2s ease;
    user-select: none;
  }

  .btn:hover, .btn:focus {
    background-color: #3a75c4;
    outline: none;
    transform: scale(1.1);
  }

  .blue {
    background: linear-gradient(135deg, #007bffcc, #0056b3cc);
  }

  .purple {
    background: linear-gradient(135deg, #6f42c1cc, #4b2a8dcc);
  }

  .orange {
    background: linear-gradient(135deg, #ff7f50cc, #cc5a3dcc);
  }

  .navy {
    background: linear-gradient(135deg, #001f3fcc, #001337cc);
  }

  @media (max-width: 600px) {
    .btn {
      padding: 12px 20px;
      font-size: 0.95rem;
    }
  }

  @media (max-width: 400px) {
    .container {
      grid-template-columns: 1fr;
      width: 95%;
    }
    .btn-group {
      flex-direction: column;
      gap: 12px;
    }
  }

  footer {
    text-align: center;
    padding: 22px 0;
    font-size: 1rem;
    color: #ddd;
    user-select: none;
    text-shadow: 0 0 6px rgba(0,0,0,0.5);
  }
</style>

<br><br>

<div class="container">

  <div class="box blue" data-url="doctor_challenge.php" tabindex="0" role="button" aria-label="Doctor Vocabulary">
    <img class="logo" src="https://cdn-icons-png.flaticon.com/512/2921/2921826.png" alt="Doctor Icon" />
    <h2>Doctor</h2>
  </div>

  <div class="box purple" data-url="barista_challenge.php" tabindex="0" role="button" aria-label="Barista Vocabulary">
    <img class="logo" src="https://cdn-icons-png.flaticon.com/512/2913/2913469.png" alt="Barista Icon" />
    <h2>Barista</h2>
  </div>

  <div class="box orange" data-url="marketing_manager_challenge.php" tabindex="0" role="button" aria-label="Marketing Manager Vocabulary">
    <img class="logo" src="https://cdn-icons-png.flaticon.com/512/2921/2921826.png" alt="Marketing Manager Icon" />
    <h2>Marketing Manager</h2>
  </div>

  <div class="box navy" data-url="travel_guider_challenge.php" tabindex="0" role="button" aria-label="Travel Guider Vocabulary">
    <img class="logo" src="https://cdn-icons-png.flaticon.com/512/4274/4274422.png" alt="Travel Guider Icon" />
    <h2>Travel Guider</h2>
  </div>

</div>

<br><br><br><br><br><br>
<br><br>
<br>
<br>

<footer>
  &copy; <?= date('Y'); ?> VocaVerse. All rights reserved.
</footer>

<script>
  // Navigate when box clicked or "Enter" pressed on focused box
  document.querySelectorAll('.box').forEach(box => {
    box.addEventListener('click', () => {
      const url = box.getAttribute('data-url');
      if(url) window.location.href = url;
    });
    box.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        const url = box.getAttribute('data-url');
        if(url) window.location.href = url;
      }
    });
  });
</script>
