
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Travel Guider Challenge</title>
  <style>
  body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #fff;
    margin: 0;
    padding: 0;
  }

    h1 {
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 30px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .challenge-container {
      width: 90%;
      max-width: 850px;
      margin: auto;
      background: rgba(255,255,255,0.08);
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      backdrop-filter: blur(6px);
    }

    .vocab-box {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .vocab-item {
      background: rgba(255,255,255,0.15);
      padding: 20px;
      border-radius: 16px;
      text-align: center;
      font-size: 1.1rem;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .vocab-item:hover {
      transform: scale(1.05);
      background-color: rgba(255,255,255,0.2);
    }

    .vocab-item small {
      display: block;
      font-size: 0.9rem;
      font-weight: normal;
      color: #ddd;
      margin-top: 5px;
    }

    .btn {
      padding: 12px 24px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-right: 10px;
      margin-top: 10px;
    }

    .btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.05);
    }

    textarea {
      width: 100%;
      padding: 15px;
      font-size: 1rem;
      border-radius: 10px;
      border: none;
      resize: none;
      margin-top: 10px;
    }

    .score-box {
      font-size: 1.3rem;
      text-align: center;
      font-weight: bold;
      color: #ffeec0;
      text-shadow: 0 0 5px #ffb400;
      margin-top: 20px;
    }

    .btn-back {
      display: block;
      width: max-content;
      margin: 40px auto 0;
      padding: 12px 24px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    footer {
      text-align: center;
      padding: 24px;
      font-size: 0.95rem;
      color: #ddd;
    }
  </style>
</head>
<body>
<br>
<br>
<h1>Travel Guider Challenge</h1>

<div class="challenge-container">
  <div class="vocab-box" id="vocabBox">
    <!-- Vocab items akan ditampilkan di sini -->
  </div>

  <button class="btn" onclick="loadNextVocab()">🔁 Next</button>

  <label for="sentence">Tulis sebuah kalimat menggunakan kata-kata di atas</label>
  <textarea id="sentence" rows="4" placeholder="Contoh: The travel guide led the group through a scenic mountain trail..."></textarea>

  <div style="margin-top: 20px;">
    <button class="btn" onclick="checkGrammar()">✅ Finish</button>
  </div>

  <div class="score-box" id="scoreBox" style="display:none;">
    Grammar Score: <span id="scorePercent">0</span>%
  </div>
</div>

<a href="index.php" class="btn-back">Back</a>
<br><br><br><br><br><br><br><br><br><br><br>
<footer>
  &copy; <?= date('Y'); ?> VocaVerse. All rights reserved.
</footer>

<script>
  const vocabList = [
    { english: "Tourist Attraction", indonesian: "Objek wisata" },
    { english: "Local Cuisine", indonesian: "Masakan lokal" },
    { english: "Itinerary", indonesian: "Rencana perjalanan" },
    { english: "Travel Guide", indonesian: "Pemandu wisata" },
    { english: "Cultural Heritage", indonesian: "Warisan budaya" },
    { english: "Scenic View", indonesian: "Pemandangan indah" },
    { english: "Backpacking", indonesian: "Mendaki dengan ransel" },
    { english: "Travel Insurance", indonesian: "Asuransi perjalanan" },
    { english: "Souvenir", indonesian: "Cenderamata" },
    { english: "Flight Booking", indonesian: "Pemesanan penerbangan" },
    { english: "Local Guide", indonesian: "Pemandu lokal" },
    { english: "Adventure Trip", indonesian: "Perjalanan petualangan" },
    { english: "Accommodation", indonesian: "Akomodasi" }
  ];

  function getRandomVocab(count) {
    const shuffled = vocabList.sort(() => 0.5 - Math.random());
    return shuffled.slice(0, count);
  }

  function renderVocab() {
    const vocabBox = document.getElementById("vocabBox");
    vocabBox.innerHTML = "";
    const vocabSet = getRandomVocab(4);
    vocabSet.forEach(v => {
      const item = document.createElement("div");
      item.className = "vocab-item";
      item.innerHTML = `${v.english}<small>${v.indonesian}</small>`;
      vocabBox.appendChild(item);
    });
  }

  function loadNextVocab() {
    renderVocab();
    document.getElementById("scoreBox").style.display = "none";
  }

  function checkGrammar() {
    const sentence = document.getElementById("sentence").value.trim();
    if (!sentence) {
      alert("Tulislah kalimat terlebih dahulu.");
      return;
    }

    const score = Math.floor(Math.random() * 41) + 0;
    document.getElementById("scorePercent").textContent = score;
    document.getElementById("scoreBox").style.display = "block";
  }

  window.onload = renderVocab;
</script>

</body>
</html>
