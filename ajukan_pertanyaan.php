<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         /* Style inputs with type="text", select elements and textareas */
        input[type=text], select, textarea {
        width: 100%; /* Full width */
        padding: 12px; /* Some padding */ 
        border: 1px solid #ccc; /* Gray border */
        border-radius: 4px; /* Rounded borders */
        box-sizing: border-box; /* Make sure that padding and width stays in place */
        margin-top: 6px; /* Add a top margin */
        margin-bottom: 16px; /* Bottom margin */
        resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
        }

        /* Style the submit button with a specific background color etc */
        input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        /* When moving the mouse over the submit button, add a darker green color */
        input[type=submit]:hover {
        background-color: #CFA7E1;
        }

        /* Add a background color and some padding around the form */
        .container {
        border-radius: 5px;
        background-color: #CFA7E1;
        padding: 20px;
} 
    </style>
</head>
<body>
    <div class="container">
    <form action="ajukan_pertanyaan.php" method = "POST">

        <label for="upload_soal">Silahkan Anda Mengunggah soal yang ingin anda coba tanyakan</label>
        <textarea id="upload_soal" name="upload_soal" placeholder="Silahkan ketik soal yang ingin anda unggah" style="height:200px"></textarea>

        <input type="submit" value="Submit">

    </form>
    </div> 
</body>
</html>

<?php
include("koneksi_database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["upload_soal"])) {
        $pertanyaan = $_POST["upload_soal"];
        
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');

        // Persiapkan statement SQL
        $sql = "INSERT INTO qna_table (questions) VALUES (?)";
        $statementSQL = $conn->prepare($sql);

        // Periksa apakah persiapan statement SQL berhasil
        if ($statementSQL === false) {
            die('Error in preparing the statement: ' . $conn->error);
        }

        // Ikat parameter
        $statementSQL->bind_param("s", $pertanyaan);

        // Eksekusi statement
        $result = $statementSQL->execute();

        // Periksa apakah eksekusi berhasil
        if ($result === false) {
            die('Error in executing the statement: ' . $statementSQL->error);
        }

        // Tutup statement
        $statementSQL->close();

        header("Location: pertanyaan.php");
        exit();
    }
}

// Tutup koneksi database
$conn->close();
?>
