<?php
// Deklarasi dan akses array terindeks
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".<br>";

// Tambahkan 5 data baru ke array $fruits
array_push($fruits, "Durian", "Mango", "Orange", "Papaya", "Strawberry");

// Tampilkan seluruh data dan indeks tertinggi
echo "<h3>Setelah menambah 5 data:</h3>";
foreach ($fruits as $index => $value) {
    echo "Indeks $index : $value<br>";
}
$maxIndex = array_key_last($fruits);
echo "Indeks tertinggi sekarang adalah: $maxIndex<br><br>";

// Hapus 1 data tertentu dari array $fruits
unset($fruits[2]); // menghapus data dengan indeks 2 ("Cherry")

echo "<h3>Setelah menghapus 1 data (Cherry):</h3>";
foreach ($fruits as $index => $value) {
    echo "Indeks $index : $value<br>";
}
$maxIndexAfterDelete = array_key_last($fruits);
echo "Indeks tertinggi setelah penghapusan adalah: $maxIndexAfterDelete<br><br>";

// Buat array baru $veggies dengan 3 data
$veggies = array("Carrot", "Broccoli", "Spinach");

echo "<h3>Data pada array \$veggies:</h3>";
foreach ($veggies as $index => $value) {
    echo "Indeks $index : $value<br>";
}
?>
