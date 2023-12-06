<?php

ini_set('display_errors', "On");
include('./antiXSS.php');

$name = $_POST['name'];
$sex = $_POST['sex'];
$birthPlace = $_POST['birthPlace'];
$favLanguage = $_POST['favLanguage'];

$time = date('Y-m-d');

// 書き込むデータの内容を整形する。
// "\n"は改行。HTMLの<br>と同じようにtext中で利用されるとtextは改行される。
$data = h($time) . '/' . h($name) . '/' .  h($sex) . '/' . h($birthPlace) . '/' . h($favLanguage) ."\n";

// 第３引数に、FILE_APPENDしないと上書きされちゃう
file_put_contents('./data/data.txt', $data, FILE_APPEND);

?>

<html>

<head>
    <meta charset="utf-8">
    <title>File書き込み</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h2>ご回答ありがとうございました。</h2>
    <h2>集計結果を確認しましょう！</h2>
    <button class = readSummary><a href="read.php">集計結果を確認する</a></button>
    <button  class = returnTop><a href="post.php">フォームに戻る</a></button>
</body>

</html>