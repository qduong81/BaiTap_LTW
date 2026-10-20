<?php
$students = [
    ['name' => 'Dương',   'score' => 9.0],
    ['name' => 'Giang', 'score' => 8.5],
    ['name' => 'An',  'score' => 9.5],
];

foreach ($students as $student) {
    echo 'Tên: ' . $student['name'];
    echo ' - Điểm: ' . $student['score'];
    echo '<br>';
}