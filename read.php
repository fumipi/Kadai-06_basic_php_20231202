<?php

ini_set('display_errors', "On");
include('./antiXSS.php');

// ファイルを開く。モードは'r' = 読み込みのみでオープン。
$openFile = fopen('./data/data.txt', 'r');

// ファイル内容を1行ずつ読み込んで表形式で出力
echo "<table border='1'>"; 

while ($str = fgets($openFile)) {
    // $str = str_replace("\n", "", $str);
    $str = explode("/", $str);
    echo "<tr>";
    for ($i = 0; $i < count($str); $i++) {
        echo "<td>" . $str[$i] . "</td>";
    }
    echo "</tr>";
}
echo "</table>"; 

fclose($openFile);

?>