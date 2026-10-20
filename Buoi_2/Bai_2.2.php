<?php

$res1 = (0 == "0") ? 'true' : 'false';
$res2 = (0 === "0") ? 'true' : 'false';
$res3 = (false == 0) ? 'true' : 'false';

// Xuất kết quả ngăn cách bởi dấu ';'
echo "0 == \"0\" $res1; 0 === \"0\" $res2; false == 0 $res3";

?>