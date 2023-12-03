<?php

ini_set('display_errors', "On");

// ファイルを開く。モードは'r' = 読み込みのみでオープン。
$openFile = fopen('./data/data.txt', 'r');

// ファイル内容を1行ずつ読み込んで出力
while ($str = fgets($openFile)) {
    echo nl2br($str);
};

fclose($openFile);

?>