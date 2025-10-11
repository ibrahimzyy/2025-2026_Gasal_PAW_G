<?php
// Panjang array dan akses array terindeks menggunakan looping
$fruits = array("Avocado", "Blueberry", "Cherry");
$arraylength = count($fruits);

for($x = 0; $x < $arraylength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}

// Tambahkan 5 data baru menggunakan perulangan FOR
for($i = 0; $i < 5; $i++) {
    $fruits[] = "Buah ke-" . ($i + 4);
}

echo "<br><h3>Setelah menambah 5 data baru:</h3>";
$arraylength = count($fruits); // hitung ulang panjang array

for($x = 0; $x < $arraylength; $x++) {
    echo "Indeks $x : " . $fruits[$x] . "<br>";
}
echo "Jumlah data dalam array \$fruits sekarang: " . $arraylength . "<br><br>";

// Buat array baru bernama $veggies dengan 3 data
$veggies = array("Carrot", "Broccoli", "Spinach");

echo "<h3>Data pada array \$veggies:</h3>";
for($i = 0; $i < count($veggies); $i++) {
    echo "Indeks $i : " . $veggies[$i] . "<br>";
}
?>
