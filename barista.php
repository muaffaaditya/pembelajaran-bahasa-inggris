<?php
include 'header.php';
include 'koneksi/koneksi.php';

$sql = "SELECT * FROM vocab_barista ORDER BY english ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kosa Kata Barista - English to Indonesian</title>
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
      margin-bottom: 40px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .vocab-container {
      width: 90%;
      max-width: 900px;
      margin: 0 auto;
      background: rgba(255,255,255,0.08);
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      overflow: hidden;
      backdrop-filter: blur(6px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      color: #fff;
    }

    thead {
      background: rgba(0,0,0,0.3);
    }

    th, td {
      padding: 16px 20px;
      text-align: left;
    }

    th {
      font-size: 1.2rem;
      font-weight: 700;
      text-transform: uppercase;
      border-bottom: 2px solid rgba(255,255,255,0.2);
    }

    td {
      font-size: 1.05rem;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    tr:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transition: background 0.3s ease;
    }

    caption {
      caption-side: top;
      padding: 18px;
      font-style: italic;
      color: #eee;
      font-size: 1rem;
    }

    .btn-back {
      display: block;
      width: max-content;
      margin: 30px auto 0;
      padding: 12px 24px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .btn-back:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.05);
    }

    footer {
      text-align: center;
      padding: 24px;
      font-size: 0.95rem;
      color: #ddd;
      text-shadow: 0 0 6px rgba(0,0,0,0.5);
    }
  </style>
</head>
<body>
<h1>Barista Vocabulary List</h1>
<div class="vocab-container">
  <table>
    <caption>Barista Vocabulary: English - Indonesian</caption>
    <thead>
      <tr>
        <th>English</th>
        <th>Indonesian</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= htmlspecialchars($row['english']) ?></td>
            <td><?= htmlspecialchars($row['indonesian']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="2" style="text-align:center;">Tidak ada data ditemukan.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<a href="index.php" class="btn-back">Back</a>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<footer>&copy; <?= date("Y") ?> VocaVerse | Barista Vocabulary</footer>
</body>
</html>
