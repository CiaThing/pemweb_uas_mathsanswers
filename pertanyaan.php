<?php
include("koneksi_database.php");

$sql = "SELECT QnA_id, QnA_Questions_date, Questions FROM qna_table ORDER BY QnA_Questions_date DESC";
$result = mysqli_query($conn, $sql);
?>

<html>
<head>
<style>
.all-questions {
  margin: 0;
  padding: 5px;
  background-color: #CFA7E1;
}

.all-questions > h1, h2, .question {
  margin: 10px;
  padding: 5px;
}

.question {
  background: white;
}

.question > h2, p {
  margin: 4px;
  font-size: 90%;
}

.question a {
  text-decoration: none;
  color: black;
  cursor: pointer;
}

.upload-button {
  float: right;
  margin-right: 10px;
  margin-top: -35px;
}

</style>
</head>
<body>

<section class="all-questions">
  <h1>Soal Matematika</h1>
  <h2>Silahkan mencari soal yang anda ingin cari</h2>

  <a href="ajukan_pertanyaan.php" class="upload-button">
    <button>Unggah Soal</button>
  </a>
  <?php
  // Tampilkan data soal
  if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          echo '<section class="question">';
          echo '<h5>' . $row['QnA_Questions_date'] . '</h5>';
          echo '<p><a href="soal_matematika.php?id=' . $row['QnA_id'] . '">' . $row['Questions'] . '</a></p>';
          echo '</section>';
      }
  } else {
      echo '<p>No questions available.</p>';
  }

  // Tutup koneksi
  mysqli_close($conn);
  ?>

</section>

</body>
</html>
