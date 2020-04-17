<style>
    table {
        border-collapse: collapse;
    }

    table td {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: center;
    }
</style>
<h1>老師示範月曆格式製作</h1>
<h4>月曆練習</h4>

<?php
for($m=1;$m<=12;$m++){
echo "<div>月份:",$m,"</div>";
echo "<table>";
    echo "<tr>";
        echo "<th>日</th>";
        echo "<th>一</th>";
        echo "<th>二</th>";
        echo "<th>三</th>";
        echo "<th>四</th>";
        echo "<th>五</th>";
        echo "<th>六</th>";
    echo "</tr>";
    // 先定出月份的第1天
    $firstDay = "2020-$m-01";
    // 第一天是該週的第幾天
    $firstDayWeek = date("w", strtotime($firstDay));
    // 當月份總共有幾天
    $days = date("t", strtotime($firstDay));
    // 當月份跨了幾週，這很重要
    $totalWeeks = ceil(($days + $firstDayWeek) / 7);
echo "第一天星期:",$firstDayWeek,"<br>";
echo "月天數:",$days,"天";

    for ($i = 0; $i < $totalWeeks; $i++) {

        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {

            if ($i == 0 && $j < $firstDayWeek) {
                echo "<td>";
                echo "</td>";
            } else {
                echo "<td>";
                $num = $i * 7 + $j + 1 - $firstDayWeek;
                if ($num <= $days) {
                    echo $num;
                }
                echo "</td>";
            }
            // if ($i * 7 + $j + 1 - $firstDayWeek <= $days) {
            //     echo "<td>";
            //     echo $i * 7 + $j + 1 - $firstDayWeek;
            //     echo "</td>";
            // } else {
            //     echo "<td>";
            //     echo "</td>";
            // }
            // }
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<hr>";
}
    ?>
