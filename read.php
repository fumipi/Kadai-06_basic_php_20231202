<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>結果表示</title>
        <link rel="stylesheet" href="./css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <?php
            ini_set('display_errors', "On");
            include('./antiXSS.php');

            $openFile = fopen('./data/data.txt', 'r');
            $lines = explode("\n", fread($openFile, filesize('./data/data.txt')));
            $raw_array = [];
            foreach ($lines as $line) {
                $raw_array[] = explode('/', $line);
            }
            fclose($openFile);

            echo "<script>const rawTable = " . json_encode($raw_array) . ";</script>";
        ?>
    </head>
    <body>
        <h1>アンケート結果</h1>
        <h2>プログラミング言語集計結果</h2>
        <canvas id="languageChart" width="400" height="400"></canvas>
        <h2>都道府県別集計結果</h2>
        <canvas id="prefectureChart" width="400" height="400"></canvas>
        <h2>データ一覧</h2>
        <table id="raw_table"></table>

        <script>
            window.onload = function() {
                const processedData = processFileData(rawTable);
                languageChart(processedData.languagePercentages);
                prefectureChart(processedData.prefectureCounts);
                displayRawTable(processedData.rawArray);
            };

            function processFileData(rawData) {
                const languageCounts = {};
                const prefectureCounts = {};
                const rawArray = [];

             rawData.forEach(line => {
                if (line.length > 4) {
                    const language = line[4].trim();
                    if (language) {
                        languageCounts[language] = (languageCounts[language] || 0) + 1;
                    }
                }
                if (line.length > 3) {
                    const prefecture = line[3].trim();
                if (prefecture) {
                    prefectureCounts[prefecture] = (prefectureCounts[prefecture] || 0) + 1;
                }
                }
                rawArray.push(line);
             });

            const totalEntries = Object.values(languageCounts).reduce((a, b) => a + b, 0);
            const languagePercentages = {};
                for (const language in languageCounts) {
                    languagePercentages[language] = (languageCounts[language] / totalEntries) * 100;
                }

                return { languagePercentages, prefectureCounts, rawArray };
            }

            function languageChart(languageData) {
                const ctx = document.getElementById('languageChart').getContext('2d');
                const chart = new Chart(ctx, {
                type: 'pie', 
                data: {
                    labels: Object.keys(languageData),
                    datasets: [{
                        label: '好きなプログラミング言語',
                        backgroundColor: [
                            '#a6cee3', // Soft blue
                            '#1f78b4', // Muted dark blue
                            '#b2df8a', // Light green
                            '#33a02c', // Forest green
                            '#fb9a99', // Soft red
                            '#e31a1c', // Muted red
                            '#fdbf6f', // Soft orange
                            '#ff7f00', // Burnt orange
                            '#cab2d6', // Light purple
                            '#6a3d9a', // Muted purple
                        ],
                        data: Object.values(languageData)
                    }]
                },
                options: {
                    responsive: false, 
                    maintainAspectRatio: false
                }
    });
}

            function prefectureChart(prefectureData){
                const ctx = document.getElementById('prefectureChart').getContext('2d');
                const chart = new Chart(ctx, {
                // グラフの種類を指定
                type: 'bar',

                //    データセット
                data: {
                    labels: Object.keys(prefectureData),
                    datasets: [{
                        label: '出身県',
                        backgroundColor: 'skyblue',
                        borderColor: 'lightblue',
                        data: Object.values(prefectureData)
                    }]
                },

                // 設定オプション
                options: {
                    responsive: false, 
                    maintainAspectRatio: false
                }
                });
            };
            
            function displayRawTable(data) {
                const table = document.getElementById('raw_table');
                data.forEach(row => {
                if (row.length === 1 && row[0] === '') return;
                const tr = document.createElement('tr');
                row.forEach(cell => {
                    const td = document.createElement('td');
                    td.textContent = cell;
                    tr.appendChild(td);
            });
            table.appendChild(tr);
    });
}
        </script>
    </body>
</html>



