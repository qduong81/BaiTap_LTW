<?php
declare(strict_types=1);

$x = "9";
$y = 10;

echo "\$x = \"$x\";<br>";
echo "\$y = $y;<br><hr>";

echo "Kiểu dữ liệu của \$x là: " . gettype($x) . "<br>";
echo "Kiểu dữ liệu của \$y là: " . gettype($y) . "<br>";

$tong = $x + $y;
echo "Kết quả của \$x + \$y là: " . $tong . "<br>";
echo "Kiểu dữ liệu của kết quả: " . gettype($tong);