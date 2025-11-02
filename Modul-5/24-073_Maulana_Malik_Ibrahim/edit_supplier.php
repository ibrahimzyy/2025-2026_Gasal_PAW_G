    <?php
    include 'koneksi.php';

    // Pastikan ada parameter ID
    if (!isset($_GET['id'])) {
        echo "<script>alert('ID Supplier tidak ditemukan'); window.location='supplier.php';</script>";
        exit;
    }

    $id = $_GET['id'];

    // Ambil data lama supplier
    $query = mysqli_query($conn, "SELECT * FROM supplier WHERE id = '$id'");
    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('Data supplier tidak ditemukan'); window.location='supplier.php';</script>";
        exit;
    }

    $data = mysqli_fetch_assoc($query);

    // Variabel nilai awal dan error
    $nama = $data['nama'];
    $telp = $data['telp'];
    $alamat = $data['alamat'];
    $errors = [];

    // Jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama   = trim($_POST['nama']);
        $telp   = trim($_POST['telp']);
        $alamat = trim($_POST['alamat']);

        //  Validasi nama
        if (empty($nama)) {
            $errors['nama'] = "Nama tidak boleh kosong.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
            $errors['nama'] = "Nama hanya boleh berisi huruf dan spasi.";
        }

        //  Validasi telp
        if (empty($telp)) {
            $errors['telp'] = "Nomor telepon tidak boleh kosong.";
        } elseif (!preg_match("/^[0-9]+$/", $telp)) {
            $errors['telp'] = "Nomor telepon hanya boleh angka.";
        }

            //  Validasi alamat
        if (empty($alamat)) {
            $errors['alamat'] = "Alamat tidak boleh kosong.";
        } elseif (!preg_match("/^[a-zA-Z0-9\s.,-]+$/", $alamat)) {
            $errors['alamat'] = "Alamat hanya boleh mengandung huruf, angka, spasi, titik, koma, dan tanda hubung.";
        }


        // Jika tidak ada error → update ke database
        if (empty($errors)) {
            $update = "UPDATE supplier 
                    SET nama='$nama', telp='$telp', alamat='$alamat' 
                    WHERE id='$id'";
            $result = mysqli_query($conn, $update);

            if ($result) {
                echo "<script>
                        alert('Data supplier berhasil diperbarui!');
                        window.location='supplier.php';
                    </script>";
                exit;
            } else {
                echo "<div class='alert alert-danger text-center'>Gagal memperbarui data: " . mysqli_error($conn) . "</div>";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data Supplier</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

    <div class="container py-4">
        <div class="card shadow mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h3 class="mb-4 text-center">Edit Data Supplier</h3>

                <form action="" method="POST" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Nama Supplier</label>
                        <input type="text" name="nama" class="form-control <?php echo isset($errors['nama']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($nama); ?>">
                        <div class="invalid-feedback">
                            <?php echo $errors['nama'] ?? ''; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="telp" class="form-control <?php echo isset($errors['telp']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($telp); ?>">
                        <div class="invalid-feedback">
                            <?php echo $errors['telp'] ?? ''; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control <?php echo isset($errors['alamat']) ? 'is-invalid' : ''; ?>"><?php echo htmlspecialchars($alamat); ?></textarea>
                        <div class="invalid-feedback">
                            <?php echo $errors['alamat'] ?? ''; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="supplier.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    </body>
    </html>
