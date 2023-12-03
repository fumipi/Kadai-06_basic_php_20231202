<?php
ini_set('display_errors', "On");

?>

<html>

<head>
    <meta charset="utf-8">
    <title>課題テンプレート</title>
</head>

<body>
    <form action="write.php" method="post">
        お名前: <input type="text" name="name">
        性別: 女性 <input type="radio" name="sex" value="女性">
        男性<input type="radio" name="sex" value="男性">
        出身: <input type="text" name="birthPlace">
        <input type="submit" value="送信">
    </form>
</body>
</html>

