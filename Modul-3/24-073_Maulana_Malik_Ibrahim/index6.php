<?php
// 1. array_push() - menambahkan data baru ke akhir array
$fruits = array("Apple", "Banana", "Cherry");
array_push($fruits, "Durian", "Mango");
echo "<h3>1. Hasil array_push()</h3>";
print_r($fruits);


// 3. array_merge() - menggabungkan dua array
$veggies = array("Carrot", "Broccoli", "Spinach");
$merged = array_merge($fruits, $veggies);
echo "<h3>2. Hasil array_merge()</h3>";
print_r($merged);


// 3. array_values() - mengambil semua nilai (mengatur ulang indeks menjadi numerik)
$assoc = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$values = array_values($assoc);
echo "<h3>3. Hasil array_values()</h3>";
print_r($values);


// 4. array_search() - mencari posisi/value tertentu di dalam array
$searchKey = array_search("Mango", $fruits);
echo "<h3>4. Hasil array_search()</h3>";
echo "Nilai 'Mango' ditemukan pada indeks: $searchKey";

// 5. array_filter() - menyaring elemen sesuai kondisi tertentu
$numbers = array(2, 7, 10, 15, 20, 25);
$filtered = array_filter($numbers, function($num) {
    return $num > 10; // ambil hanya angka lebih dari 10
});
echo "<h3>5. Hasil array_filter() (angka > 10)</h3>";
print_r($filtered);


// 6. Fungsi Sorting (pengurutan array)
$sortArray = array("Orange", "Apple", "Mango", "Banana");
sort($sortArray); // ascending
echo "<h3>6. Fungsi Sorting (sort ascending)</h3>";
print_r($sortArray);


rsort($sortArray); // descending
echo "<h3>Fungsi Sorting (rsort descending)</h3>";
print_r($sortArray);


$assocSort = array("Andy"=>176, "Barry"=>165, "Charlie"=>170);
asort($assocSort); // sort berdasarkan nilai (ascending)
echo "<h3>Sorting asosiatif berdasarkan nilai (asort)</h3>";
print_r($assocSort);


ksort($assocSort); // sort berdasarkan key (ascending)
echo "<h3>Sorting asosiatif berdasarkan key (ksort)</h3>";
print_r($assocSort);
?>
