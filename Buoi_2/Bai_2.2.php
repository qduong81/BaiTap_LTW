<?php
//"==" So sánh lỏng lẻo: Toán tử này chỉ so sánh giá trị sau khi đã tự động ép kiểu
//"===" So sánh nghiêm ngặt: Toán tử so sánh nhận dạng, yêu cầu cả giá trị lẫn kiểu dữ liệu của hai vế phải hoàn toàn giống nhau.

$res1 = (0 == "0") ? 'true' : 'false';
$res2 = (0 === "0") ? 'true' : 'false';

//Khi so sánh lỏng lẻo giữa kiểu boolean và kiểu integer, PHP sẽ ép kiểu boolean thành số:
//+false được chuyển đổi thành 0
//+true được chuyển đổi thành 1.
$res3 = (false == 0) ? 'true' : 'false';

// Xuất kết quả ngăn cách bởi dấu ';'
echo "0 == \"0\" $res1; 0 === \"0\" $res2; false == 0 $res3";

?>