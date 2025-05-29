<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>VocaVerse Intro</title>
<style>
  body, html {
    margin: 0; padding: 0; height: 100%;
    background: linear-gradient(135deg, #007BFF, #8E2DE2);
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 4rem;
    user-select: none;
    text-align: center;
  }

  #text {
    white-space: nowrap;
  }

  /* Khusus tampilan HP (layar max 767px) */
  @media (max-width: 767px) {
    body {
      font-size: 10vw; /* Ukuran huruf fleksibel untuk HP */
      padding: 0 10px; /* Tambahan padding agar tidak kepotong */
    }

    #text {
      white-space: normal; /* Agar teks bisa wrap jika perlu */
    }
  }
</style>
</head>
<body>
  <div id="text"></div>

  <script>
    const text = "VocaVerse";
    const textContainer = document.getElementById('text');
    let index = 0;

    function showNextLetter() {
      if(index < text.length) {
        textContainer.textContent += text[index];
        index++;
        setTimeout(showNextLetter, 300); // delay 300ms tiap huruf
      } else {
        setTimeout(() => {
          window.location.href = 'login.php';
        }, 800);
      }
    }

    showNextLetter();
  </script>
</body>
</html>
