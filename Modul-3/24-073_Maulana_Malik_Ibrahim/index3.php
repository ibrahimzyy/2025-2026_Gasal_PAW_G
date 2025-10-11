<?php
// Deklarasi array asosiatif
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andy is " . $height['Andy'] . " cm tall.<br><br>";

// Tambahkan 5 data baru ke array $height
$height["David"] = "180";
$height["Evan"] = "172";
$height["Fiona"] = "168";
$height["Gina"] = "169";
$height["Henry"] = "175";

// Tampilkan seluruh data setelah penambahan
echo "<h3>Setelah menambah 5 data baru:</h3>";
foreach ($height as $name => $value) {
    echo "$name = $value cm<br>";
}

// Tampilkan nilai dengan indeks terakhir
echo "Nilai indeks terakhir dari array \$height adalah: " . end($height) . " cm<br><br>";

// Hapus 1 data tertentu dari array $height (misalnya Barry)
unset($height["Barry"]);

echo "<h3>Setelah menghapus 1 data (Barry):</h3>";
foreach ($height as $name => $value) {
    echo "$name = $value cm<br>";
}
echo "Nilai indeks terakhir sekarang adalah: " . end($height) . " cm<br><br>";

// Buat array baru $weight dengan 3 data
$weight = array("Andy"=>"60", "Barry"=>"55", "Charlie"=>"58");

echo "<h3>Data pada array \$weight:</h3>";
foreach ($weight as $name => $value) {
    echo "$name = $value kg<br>";
}

// Tampilkan data ke-2 dari array $weight
$values = array_values($weight);
echo "Data ke-2 dari array \$weight adalah: " . $values[1] . " kg";
?>
