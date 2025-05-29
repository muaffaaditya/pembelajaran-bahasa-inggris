
<style>
  /* [CSS: desain kuis interaktif] */
  body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #fff;
    margin: 0;
    padding: 0;
    min-height: 100vh;
  }

  .container {
    max-width: 700px;
    width: 90%;
    margin: 60px auto 100px;
    background: linear-gradient(145deg, rgba(255 255 255 / 0.1), rgba(255 255 255 / 0.05));
    border-radius: 20px;
    padding: 30px 40px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    user-select: none;
  }

  h1 {
    text-align: center;
    margin-bottom: 28px;
    font-weight: 900;
    font-size: 2.2rem;
    text-shadow: 0 2px 5px rgba(0,0,0,0.5);
  }

  .question {
    font-weight: 700;
    font-size: 1.6rem;
    margin-bottom: 20px;
    text-align: center;
  }

  .options {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 24px;
  }

  .option-btn {
    background: linear-gradient(135deg, #4a90e2cc, #3a75c4cc);
    border: none;
    border-radius: 12px;
    padding: 14px 20px;
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(74,144,226,0.6);
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .option-btn:hover:not(.disabled), .option-btn:focus:not(.disabled) {
    background-color: #2e56a4;
    outline: none;
    transform: scale(1.05);
  }

  .option-btn.correct {
    background-color: #28a745 !important;
    box-shadow: 0 0 15px #28a745;
    cursor: default;
  }

  .option-btn.wrong {
    background-color: #dc3545 !important;
    box-shadow: 0 0 15px #dc3545;
    cursor: default;
  }

  .next-btn, .score-btn {
    display: block;
    margin: 0 auto;
    background: linear-gradient(135deg, #6f42c1cc, #4b2a8dcc);
    border: none;
    border-radius: 16px;
    padding: 14px 40px;
    font-size: 1.1rem;
    font-weight: 900;
    color: white;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(75, 42, 141, 0.7);
    transition: background-color 0.3s ease, transform 0.2s ease;
    user-select: none;
  }

  .next-btn:hover, .score-btn:hover {
    background-color: #3e1f72;
    transform: scale(1.05);
    outline: none;
  }

  .next-btn:disabled {
    background-color: #aaa6ffaa;
    cursor: default;
    box-shadow: none;
    transform: none;
  }

  .timer {
    text-align: center;
    font-weight: 900;
    font-size: 1.3rem;
    margin-bottom: 20px;
    color: #ffd700;
    text-shadow: 0 0 5px #ffd700aa;
  }

  .image-options {
    display: flex;
    justify-content: center;
    gap: 24px;
    flex-wrap: wrap;
  }

  .image-option {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 0 8px rgba(255,255,255,0.2);
    cursor: pointer;
    border: 4px solid transparent;
    transition: border-color 0.3s ease;
  }

  .image-option.correct {
    border-color: #28a745;
    box-shadow: 0 0 15px #28a745;
    cursor: default;
  }

  .image-option.wrong {
    border-color: #dc3545;
    box-shadow: 0 0 15px #dc3545;
    cursor: default;
  }

  .image-option img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .score-display {
    font-size: 2rem;
    font-weight: 900;
    text-align: center;
    margin-top: 40px;
    color: #fff;
    text-shadow: 0 0 8px #4b2a8d;
  }
</style>
<br><br>
<div class="container" role="main" aria-live="polite" aria-atomic="true">
  <h1>Barista Quiz</h1>

  <div class="timer" aria-label="Time remaining" role="timer" id="timer">Time: 15s</div>

  <div id="quiz-content">
    <!-- Question will be injected here -->
  </div>
<br><br>
  <button class="next-btn" id="next-btn" disabled aria-disabled="true">Next</button>
  <button class="score-btn" id="score-btn" style="display:none;">View Score</button>

  <div id="score-display" class="score-display" style="display:none;"></div>
</div>

<script>
  const vocabQuestions = [
    { word: "A person who makes coffee professionally is called a...", options: ["Barista", "Mechanic", "Pilot"], answerIndex: 0 },
    { word: "A barista usually works at a...", options: ["Hospital", "Coffee shop", "Garage"], answerIndex: 1 },
    { word: "Espresso, Latte, and Cappuccino are types of...", options: ["Cars", "Coffee drinks", "Cities"], answerIndex: 1 }
  ];


  const imageQuestions = [
    {
      question: "Choose the picture that shows a barista at work",
      images: [
        { src: "https://cdn-icons-png.flaticon.com/512/2920/2920256.png", isAnswer: true, alt: "Barista making coffee" },
        { src: "https://cdn-icons-png.flaticon.com/512/1053/1053361.png", isAnswer: false, alt: "Doctor" },
        { src: "https://cdn-icons-png.flaticon.com/512/1995/1995574.png", isAnswer: false, alt: "Chef" }
      ]
    }
  ];

  const totalSteps = vocabQuestions.length + imageQuestions.length;
  let currentStep = 0;
  let score = 0;
  let timerInterval;
  let timeLeft = 15;

  const quizContent = document.getElementById('quiz-content');
  const nextBtn = document.getElementById('next-btn');
  const scoreBtn = document.getElementById('score-btn');
  const timerDisplay = document.getElementById('timer');
  const scoreDisplay = document.getElementById('score-display');

  function startTimer() {
    timeLeft = 15;
    timerDisplay.textContent = `Time: ${timeLeft}s`;
    timerInterval = setInterval(() => {
      timeLeft--;
      timerDisplay.textContent = `Time: ${timeLeft}s`;
      if (timeLeft <= 0) {
        clearInterval(timerInterval);
        disableOptions();
        nextBtn.disabled = false;
        nextBtn.setAttribute('aria-disabled', 'false');
      }
    }, 1000);
  }

  function disableOptions() {
    const allOptions = quizContent.querySelectorAll('.option-btn, .image-option');
    allOptions.forEach(opt => {
      opt.style.pointerEvents = 'none';
    });
  }

  function resetState() {
    clearInterval(timerInterval);
    nextBtn.disabled = true;
    nextBtn.setAttribute('aria-disabled', 'true');
    quizContent.innerHTML = '';
  }

  function showVocabQuestion(index) {
    const q = vocabQuestions[index];
    let html = `<div class="question"> <strong>${q.word}</strong></div><div class="options">`;
    q.options.forEach((opt, i) => {
      html += `<button class="option-btn" data-index="${i}">${opt}</button>`;
    });
    html += '</div>';
    quizContent.innerHTML = html;

    const buttons = document.querySelectorAll('.option-btn');
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const selected = parseInt(btn.getAttribute('data-index'));
        if (selected === q.answerIndex) {
          btn.classList.add('correct');
          score++;
        } else {
          btn.classList.add('wrong');
          buttons[q.answerIndex].classList.add('correct');
        }
        disableOptions();
        clearInterval(timerInterval);
        nextBtn.disabled = false;
        nextBtn.setAttribute('aria-disabled', 'false');
      });
    });

    startTimer();
  }

  function showImageQuestion(index) {
    const q = imageQuestions[index];
    let html = `<div class="question">${q.question}</div><div class="image-options">`;
    q.images.forEach((img, i) => {
      html += `<div class="image-option" data-index="${i}" aria-label="${img.alt}"><img src="${img.src}" alt="${img.alt}"/></div>`;
    });
    html += '</div>';
    quizContent.innerHTML = html;

    const imgOptions = document.querySelectorAll('.image-option');
    imgOptions.forEach((div, i) => {
      div.addEventListener('click', () => {
        if (q.images[i].isAnswer) {
          div.classList.add('correct');
          score++;
        } else {
          div.classList.add('wrong');
          const correctIndex = q.images.findIndex(img => img.isAnswer);
          imgOptions[correctIndex].classList.add('correct');
        }
        disableOptions();
        clearInterval(timerInterval);
        nextBtn.disabled = false;
        nextBtn.setAttribute('aria-disabled', 'false');
      });
    });

    startTimer();
  }

  function showQuestion() {
    resetState();
    if (currentStep < vocabQuestions.length) {
      showVocabQuestion(currentStep);
    } else {
      showImageQuestion(currentStep - vocabQuestions.length);
    }
  }

  function showScore() {
    quizContent.style.display = 'none';
    timerDisplay.style.display = 'none';
    nextBtn.style.display = 'none';
    scoreBtn.style.display = 'none';
    scoreDisplay.style.display = 'block';
    scoreDisplay.textContent = `Your Score is: ${score} / ${totalSteps}`;
  }

  nextBtn.addEventListener('click', () => {
    currentStep++;
    if (currentStep < totalSteps) {
      showQuestion();
    } else {
      nextBtn.style.display = 'none';
      scoreBtn.style.display = 'block';
    }
  });

  scoreBtn.addEventListener('click', showScore);

  // Start
  showQuestion();
</script>
