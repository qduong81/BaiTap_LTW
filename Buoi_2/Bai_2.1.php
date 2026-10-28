<?php
declare(strict_types=1);
//bắt buộc PHP tuân thủ kiểm tra kiểu dữ liệu một cách nghiêm ngặt khi truyền 
//tham số hoặc trả về giá trị trong các hàm (function).

$x = "9";//Đây là kiểu chuỗi (string).
$y = 10;//Đây là kiểu số nguyên (integer).

echo "\$x = \"$x\";<br>";
echo "\$y = $y;<br><hr>";

//trong PHP nhận vào một biến và trả về tên 
//kiểu dữ liệu hiện tại của biến đó dưới dạng chuỗi (string).
echo "Kiểu dữ liệu của \$x là: " . gettype($x) . "<br>";
echo "Kiểu dữ liệu của \$y là: " . gettype($y) . "<br>";

$tong = $x + $y;
echo "Kết quả của \$x + \$y là: " . $tong . "<br>";
echo "Kiểu dữ liệu của kết quả: " . gettype($tong);