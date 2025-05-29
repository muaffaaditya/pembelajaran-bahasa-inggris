
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Barista Challenge</title>
  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
      margin: 0;
      padding: 40px 0;
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

    label, textarea, .score-box, .btn-back, footer {
      margin-top: 20px;
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
      color: #e0ffe0;
      text-shadow: 0 0 5px #0f0;
    }

    #audioPlayer {
      display: block;
      margin: 20px auto 10px;
    }

    #okBtn {
      display: none;
      text-align: center;
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

<h1>Barista Vocabulary Challenge</h1>

<div class="challenge-container">
  <div class="vocab-box" id="vocabBox">
    <!-- Vocab items will be loaded by JavaScript -->
  </div>

  <button class="btn" onclick="loadNextVocab()">🔁 Next</button>

  <label for="sentence">Write a sentence using the words above</label>
  <textarea id="sentence" rows="4" placeholder="Example: The barista grinds coffee beans before making espresso..."></textarea>

  <div style="margin-bottom: 20px;">
    <button class="btn" onclick="startRecording()">🎤 Record</button>
    <button class="btn" onclick="stopRecording()">⏹️ Finish</button>
  </div>

  <audio id="audioPlayer" controls style="display:none;"></audio>
  <div id="okBtn">
    <button class="btn" onclick="hideOkBtn()">OK</button>
  </div>

  <div class="score-box" id="scoreBox" style="display:none;">
    Penilaian: <span id="scorePercent">0</span>%
  </div>
</div>

<a href="index.php" class="btn-back">Back</a>
<br><br><br><br><br><br><br><br><br>
<footer>
  &copy; <?= date('Y'); ?> VocaVerse. All rights reserved.
</footer>

<audio id="startSound" src="start.mp3" preload="auto"></audio>

<script>
  const vocabList = [
    { english: "Espresso", indonesian: "Espreso" },
    { english: "Latte", indonesian: "Latte" },
    { english: "Cappuccino", indonesian: "Kapucino" },
    { english: "Barista", indonesian: "Barista" },
    { english: "Grinder", indonesian: "Penggiling" },
    { english: "Milk Frother", indonesian: "Pembuih susu" },
    { english: "Coffee Beans", indonesian: "Biji kopi" },
    { english: "Filter", indonesian: "Saringan" },
    { english: "Roast", indonesian: "Sangrai" },
    { english: "Brew", indonesian: "Seduh" },
    { english: "Steam Wand", indonesian: "Tongkat uap" },
    { english: "Tamping", indonesian: "Pengepresan" },
    { english: "Shot", indonesian: "Tembakan kopi" }
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
    document.getElementById("okBtn").style.display = "none";
    document.getElementById("audioPlayer").style.display = "none";
  }

  window.onload = renderVocab;

  // Recording simulation
  let mediaRecorder;
  let audioChunks = [];

  function startRecording() {
    document.getElementById('startSound').play();
    navigator.mediaDevices.getUserMedia({ audio: true })
      .then(stream => {
        mediaRecorder = new MediaRecorder(stream);
        audioChunks = [];

        mediaRecorder.ondataavailable = e => audioChunks.push(e.data);

        mediaRecorder.onstop = () => {
          const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
          const audioUrl = URL.createObjectURL(audioBlob);
          const player = document.getElementById("audioPlayer");
          player.src = audioUrl;
          player.style.display = "block";

          const score = Math.floor(Math.random() * 41) + 0;
          document.getElementById("scorePercent").textContent = score;
          document.getElementById("scoreBox").style.display = "block";
          document.getElementById("okBtn").style.display = "block";
        };

        mediaRecorder.start();
      })
      .catch(err => {
        console.error("Gagal merekam:", err);
        alert("Gagal mengakses mikrofon.");
      });
  }

  function stopRecording() {
    if (mediaRecorder && mediaRecorder.state !== "inactive") {
      mediaRecorder.stop();
    }
  }

  function hideOkBtn() {
    document.getElementById("okBtn").style.display = "none";
  }
</script>

</body>
</html>
