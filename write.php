<?php

ini_set('display_errors', "On");

// XSS対策
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

$name = $_POST['name'];
$sex = $_POST['sex'];
$birthPlace = $_POST['birthPlace'];

$time = date('Y-m-d H:i:s');

// 書き込むデータの内容を整形する。
// "\n"は改行。HTMLの<br>と同じようにtext中で利用されるとtextは改行される。
$data = h($time) . '/' . h($name) . '/' .  h($sex) . '/' . h($birthPlace) . "\n";

// 第３引数に、FILE_APPENDしないと上書きされちゃう
file_put_contents('./data/data.txt', $data, FILE_APPEND);

?>

<html>

<head>
    <meta charset="utf-8">
    <title>File書き込み</title>
</head>

<body>

    <h1>書き込みしました。</h1>
    <h2>./data/data.txt を確認しましょう！</h2>

    <ul>
        <li><a href="read.php">確認する</a></li>
        <li><a href="post.php">戻る</a></li>
    </ul>
</body>