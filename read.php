<?php

ini_set('display_errors', "On");
include('./antiXSS.php');

// ファイルを開く。モードは'r' = 読み込みのみでオープン。
$openFile = fopen('./data/data.txt', 'r');

// プログラミング言語ごとの回答数をカウント
$language_counts = [];
while ($str = fgets($openFile)) {
    $str = explode("/", $str);
    $language = trim($str[4]);
    if (!array_key_exists($language, $language_counts)) {
        $language_counts[$language] = 0;
    }
    $language_counts[$language]++;
}

// パーセンテージ計算
$total_entries = array_sum($language_counts);
$language_percentages = [];
foreach ($language_counts as $language => $count) {
    $language_percentages[$language] = ($count / $total_entries) * 100;
}

fclose($openFile);

// Javascriptに渡すためにJSON形式に変換
echo "<script>var languageData = " . json_encode($language_percentages) . ";</script>";
?>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.onload = function() {
        var ctx = document.getElementById('languageChart').getContext('2d');
        var chart = new Chart(ctx, {
            // グラフの種類を指定
            type: 'bar',

            //    データセット
            data: {
                labels: Object.keys(languageData),
                datasets: [{
                    label: '好きなプログラミング言語',
                    backgroundColor: 'skyblue',
                    borderColor: 'lightblue',
                    data: Object.values(languageData)
                }]
            },

            // 設定オプション
            options: {
                responsive: false, 
                maintainAspectRatio: false
            }
        });
    };
</script>

<?php
// ファイル内容を1行ずつ読み込んで表形式で出力
$openFile = fopen('./data/data.txt', 'r');
echo "<table class = 'raw_table', border='1'>"; 

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

<html>

<head>
    <meta charset="utf-8">
    <title>結果表示</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h2>アンケート集計結果</h2>
    <canvas id="languageChart" width="400" height="400"></canvas>
    <div></div>
    <div></div>
</body>

</html>
