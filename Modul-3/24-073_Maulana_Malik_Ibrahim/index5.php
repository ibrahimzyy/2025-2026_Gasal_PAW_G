<?php
// Deklarasi array multidimensi
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

// Tampilkan data awal dalam bentuk tabel
echo "<h3>Data awal array \$students:</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Tambahkan 5 data baru ke array $students
array_push($students,
    array("Daniel", "220404", "0812345699"),
    array("Ella", "220405", "0812345601"),
    array("Frank", "220406", "0812345622"),
    array("Grace", "220407", "0812345633"),
    array("Harry", "220408", "0812345644")
);

// Tampilkan kembali seluruh data setelah penambahan
echo "<h3>Setelah menambah 5 data baru:</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
