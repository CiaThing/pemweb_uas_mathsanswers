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

        button[type=button] {
        background-color: #9C92A1;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
        }

        /* When moving the mouse over the submit button, add a darker green color */
        input[type=submit]:hover {
        background-color: #CFA7E1;
        }
        button[type=button]:hover {
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
    <?php
        include("koneksi_database.php");

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT QnA_Questions_date, Questions FROM qna_table WHERE QnA_id = $id";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<h3>' . $row['Questions'] . '</h3>';
                echo '<p>' . $row['QnA_Questions_date'] . '</p>';

                // Formulir untuk mengisi jawaban
                echo '<form action="proses_jawaban.php" method="POST">';
                echo '<label for="jawaban">Jawaban Anda:</label>';
                echo '<textarea id="jawaban" name="jawaban" placeholder="Ketik jawaban Anda di sini" style="height:300px"></textarea>';
                echo '<input type="hidden" name="id_soal" value="' . $id . '">';
                echo '<input type="hidden" name="pertanyaan" value="' . htmlspecialchars($row['Questions']) . '">';
                echo '<input type="submit" value="Submit Jawaban">';
                echo '<button type="button" class="button" onclick="location.href=\'pertanyaan.php\'">Home</button>';
                echo '</form>';
            } else {
                echo '<p>Soal tidak ditemukan.</p>';
            }

            // Tutup koneksi
            mysqli_close($conn);
        } else {
            echo '<p>Permintaan tidak valid.</p>';
        }
        ?>
    </div>
</body>
</html>
