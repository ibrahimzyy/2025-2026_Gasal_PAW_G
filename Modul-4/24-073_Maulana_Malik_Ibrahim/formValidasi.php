<?php
// Fungsi untuk memvalidasi nama
function validateName($field_list, $field_name) {
    $result = ['valid' => true, 'error' => ''];

    // Pastikan field ada
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $result['valid'] = false;
        $result['error'] = "Field '$field_name' tidak boleh kosong.";
        return $result;
    }

    // Validasi hanya huruf
    $pattern = "/^[a-zA-Z]+$/";
    if (!preg_match($pattern, $field_list[$field_name])) {
        $result['valid'] = false;
        $result['error'] = "Field '$field_name' hanya boleh berisi huruf alfabet.";
    }

    return $result;
}

// Inisialisasi variabel
$surname = "";
$error = "";
$valid = false;

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validation = validateName($_POST, 'surname');
    $surname = htmlspecialchars($_POST['surname']); // menjaga agar input aman ditampilkan

    if ($validation['valid']) {
        $valid = true;
    } else {
        $error = $validation['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Nama (Self Submission)</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f7f7f7;
            padding: 30px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }
        input[type=text] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        .success {
            color: green;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Form Validasi Nama (Self-Submission)</h2>

<form method="POST" action="formValidasi.php">
    <label for="surname">Nama :</label>
    <input type="text" name="surname" id="surname" value="<?php echo $surname; ?>">
    <br>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <br>
    <input type="submit" value="Kirim">
</form>

<?php if ($valid): ?>
    <p class="success">Data valid! Nama anda: <strong><?php echo $surname; ?></strong></p>
<?php endif; ?>

</body>
</html>
