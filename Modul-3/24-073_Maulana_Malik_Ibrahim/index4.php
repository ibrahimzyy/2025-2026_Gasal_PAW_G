<?php
// Deklarasi array asosiatif
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Menampilkan data awal menggunakan perulangan foreach
echo "<h3>Data awal array \$height:</h3>";
foreach($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value . "<br>";
}

// Tambahkan 5 data baru ke array $height
$height["David"] = "180";
$height["Evan"] = "172";
$height["Fiona"] = "168";
$height["Gina"] = "169";
$height["Henry"] = "175";

// Tampilkan seluruh data setelah penambahan
echo "<h3>Setelah menambah 5 data baru:</h3>";
foreach($height as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value . "<br>";
}

// Buat array baru bernama $weight dengan 3 data
$weight = array("Andy"=>"60", "Barry"=>"55", "Charlie"=>"58");

// Tampilkan seluruh data array $weight dengan loop foreach
echo "<h3>Data pada array \$weight:</h3>";
foreach($weight as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value . " kg<br>";
}
?>
