<?php

// Data soal
$questions = [
    1 => ['word' => 'FOAM',  'scramble' => 'AOFM',      'level' => 'Beginner'],
    2 => ['word' => 'MEDICAL',     'scramble' => 'MEICLAD',    'level' => 'Easy'],
    3 => ['word' => 'QUIDE',   'scramble' => 'IEQUD',   'level' => 'Medium'],
    4 => ['word' => 'INJECTION', 'scramble' => 'ONCTIJINE', 'level' => 'Hard'],
    5 => ['word' => 'MARKETING', 'scramble' => 'GMRITNEKA', 'level' => 'Very Hard'],
];

// Reset quiz
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'])) {
    session_destroy();
    header('Location: quiz.php');
    exit;
}

// Mulai kuis jika belum ada sesi
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 1;
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

// Proses jawaban
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $current = $_SESSION['current_question'];
    $userAnswer = strtoupper(trim($_POST['answer']));
    $correctAnswer = strtoupper($questions[$current]['word']);

    if ($userAnswer === $correctAnswer) {
        $_SESSION['score']++;
        $_SESSION['answers'][$current] = ['result' => 'Benar', 'correct' => $correctAnswer];
    } else {
        $_SESSION['answers'][$current] = ['result' => 'Salah', 'correct' => $correctAnswer];
    }

    $_SESSION['current_question']++;
    if ($_SESSION['current_question'] > count($questions)) {
        header('Location: quiz.php?result=1');
        exit;
    } else {
        header('Location: quiz.php');
        exit;
    }
}

// Tampilkan hasil
if (isset($_GET['result']) && $_GET['result'] == 1) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Quiz</title>
  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0; padding: 0; min-height: 100vh;
      display: flex; justify-content: center; align-items: center;
      padding: 40px 15px;
    }
    .container {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px 40px;
      max-width: 600px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      user-select: none;
    }
    h2 {
      text-align: center;
      font-size: 2.4rem;
      margin-bottom: 20px;
      font-weight: 900;
      text-shadow: 0 0 8px #4b2a8d;
    }
    p {
      text-align: center;
      font-size: 1.3rem;
      margin-bottom: 30px;
      font-weight: 700;
    }
    ol {
      margin-left: 20px;
    }
    li {
      margin-bottom: 12px;
      font-size: 1.1rem;
      line-height: 1.4;
    }
    li strong {
      color: #ffd700;
    }
    form {
      text-align: center;
      margin-top: 30px;
    }
    button {
      background: linear-gradient(135deg, #6f42c1cc, #4b2a8dcc);
      border: none;
      border-radius: 16px;
      padding: 14px 40px;
      font-size: 1.2rem;
      font-weight: 900;
      color: white;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(75, 42, 141, 0.7);
      transition: background-color 0.3s ease, transform 0.2s ease;
      user-select: none;
    }
    button:hover {
      background-color: #3e1f72;
      transform: scale(1.05);
      outline: none;
    }
  </style>
</head>
<body>
  <div class="container" role="main" aria-live="polite" aria-atomic="true">
    <h2>Quiz Finished!</h2>
    <p>Your Score: <strong><?= $_SESSION['score'] ?></strong> from <?= count($questions) ?></p>

    <h3>Review answers:</h3>
    <ol>
      <?php foreach ($_SESSION['answers'] as $qNum => $ans): ?>
        <?php $level = $questions[$qNum]['level']; ?>
        <li>
           Excercise <?= $qNum ?> (Level: <strong><?= htmlspecialchars($level) ?></strong>): original word <strong><?= htmlspecialchars($ans['correct']) ?></strong> –
          <?= $ans['result'] === 'Benar' ? '<span style="color:#28a745;font-weight:bold;">true</span>' : '<span style="color:#dc3545;">false</span>' ?>
        </li>
      <?php endforeach; ?>
    </ol>

    <form method="post" action="index.php" aria-label="Ulang quiz">
      <button type="submit" name="reset" value="1">Back</button>
    </form>
  </div>
</body>
</html>
<?php
exit;
}

// Jika belum selesai, tampilkan soal saat ini
$current = $_SESSION['current_question'];
$question = $questions[$current];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Word building quiz  - Excercise <?= $current ?></title>
  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 15px;
      user-select: none;
    }
    .container {
      max-width: 700px;
      width: 100%;
      background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
      border-radius: 20px;
      padding: 40px 50px 80px 50px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      position: relative;
    }
    h1 {
      text-align: center;
      margin-bottom: 28px;
      font-weight: 900;
      font-size: 2.2rem;
      text-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }
    .level {
      font-weight: 700;
      font-size: 1.3rem;
      margin-bottom: 20px;
      text-align: center;
      letter-spacing: 0.05em;
      text-shadow: 0 0 8px #ffd700;
      color: #ffd700;
    }
    .scramble-word {
      font-family: monospace;
      font-size: 3rem;
      text-align: center;
      font-weight: 900;
      letter-spacing: 0.2em;
      margin-bottom: 40px;
      text-shadow: 0 0 15px #3b2a8d;
      user-select: all;
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 18px;
    }
    label {
      font-weight: 700;
      font-size: 1.2rem;
      user-select: none;
      margin-bottom: 6px;
    }
    input[type="text"] {
      width: 280px;
      font-size: 1.4rem;
      padding: 12px 16px;
      border-radius: 14px;
      border: none;
      outline: none;
      box-shadow: inset 0 0 8px rgba(255,255,255,0.3);
      text-align: center;
      font-weight: 700;
      letter-spacing: 0.1em;
      color: #222;
      transition: box-shadow 0.3s ease;
    }
    input[type="text"]:focus {
      box-shadow: 0 0 12px #ffd700;
    }
    button {
      padding: 16px 50px;
      font-size: 1.3rem;
      font-weight: 900;
      color: white;
      background: linear-gradient(135deg, #6f42c1cc, #4b2a8dcc);
      border: none;
      border-radius: 16px;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(75, 42, 141, 0.7);
      transition: background-color 0.3s ease, transform 0.2s ease;
      user-select: none;
      width: 100%;
      max-width: 320px;
      align-self: center;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }
    button:hover {
      background-color: #3e1f72;
      transform: scale(1.05);
    }
    .footer {
      position: absolute;
      bottom: 18px;
      width: 100%;
      text-align: center;
      font-weight: 700;
      color: #ddd;
      font-size: 0.9rem;
      user-select: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Excercise <?= $current ?></h1>
    <div class="level">Level: <?= htmlspecialchars($question['level']) ?></div>
    <div class="scramble-word"><?= htmlspecialchars($question['scramble']) ?></div>
    <form method="post">
      <label for="answer">Arrange words correctly:</label>
      <input type="text" name="answer" id="answer" required autocomplete="off" autofocus />
      <br>
      <button type="submit">submit</button>
    </form>
  </div>
</body>
</html>
