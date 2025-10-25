<form method="POST" action="formValidasi.php">
    <label for="surname">Nama Belakang:</label>
    <input type="text" name="surname" id="surname" value="<?php echo $surname; ?>">
    <br>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <br>
    <input type="submit" value="Kirim">
</form>