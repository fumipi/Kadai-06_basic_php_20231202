<?php
ini_set('display_errors', "On");

?>

<html>

<head>
    <meta charset="utf-8">
    <title>アンケートフォーム</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h1>アンケートフォーム</h1>
    <form action="write.php" method="post">
        お名前: <input type="text" name="name" required><br>
        メール: <input type="email" name="mail" required><br>
        性別を教えてください<br><input type="radio" name="sex" value="女性" required >女性
       <input type="radio" name="sex" value="男性"> 男性<br>
        出身県はどこですか? <input type="text" name="birthPlace" required ><br>
        一番好きなプログラミング言語はなんですか？ <br>
        <input type="radio" name="favLanguage" value = "Javascript" required>Javascript<br>
        <input type="radio" name="favLanguage" value = "PHP">PHP<br>
        <input type="radio" name="favLanguage" value = "Python">Python<br>
        <input type="radio" name="favLanguage" value = "Ruby">Ruby<br>
        <input type="radio" name="favLanguage" value = "Java">Java<br>
        <input type="submit" value="送信">
    </form>
</body>
</html>

