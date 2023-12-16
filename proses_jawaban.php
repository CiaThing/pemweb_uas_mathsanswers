<?php
include("koneksi_database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jawaban = mysqli_real_escape_string($conn, $_POST['jawaban']);
    $id_soal = $_POST['id_soal'];
    $pertanyaan = $_POST['pertanyaan'];

    $update_Query = "UPDATE qna_table SET answers = '$jawaban', QnA_Answers_date = NOW() WHERE QnA_id = '$id_soal'";

    if (mysqli_query($conn, $update_Query)) {
        echo "Jawaban berhasil disimpan.";
    } else {
        echo "Error: " . $update_Query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Permintaan tidak valid.";
}

mysqli_close($conn);
?>
