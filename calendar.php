<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆 Perpetual Calendar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .rCol{
            /* 必須把背景圖片拿回來放，不然不會跟著月份輪換 */
            background: url("https://picsum.photos/400/640/?random=1");
        }
    </style>

</head>


<body>
    <?php
    // 設定基準日，若沒有就是今天
    if (!isset($_GET["thisDay"])) $thisDay = getdate();
    else $thisDay = getdate($_GET["thisDay"]);

    //設定月份，這個月和前後兩個月
    $thisMonth = $thisDay["mon"];
    $lastMonth = strtotime("first day of - 1 month", $thisDay[0]);
    $nextMonth = strtotime("first day of + 1 month", $thisDay[0]);
    ?>

    <?php

    echo "<h4 style='text-align:center'>西元", $thisDay["year"], "年", $thisDay["mon"], "月</h4>";
    ?>

    <table class="container">
        <tr>
            <td class="date">
                <!-- 螢幕會顯示本月份以及上下個月的選項 -->
                <a href="calendar.php?thisDay=<?= $lastMonth; ?>">上月(<?= date("n", $lastMonth); ?>)</a>
                <a href="calendar.php?thisDay=<?= time(); ?>">回本月</a>
                <!-- <span>本月(<?= $thisMonth; ?>)</span> -->
                <a href="calendar.php?thisDay=<?= $nextMonth; ?>">下月(<?= date("n", $nextMonth); ?>)</a>
            </td>
        </tr>
        <tr>
            <td>
                <table class="month">
                    <tr>
                        <td>1月</td>
                        <td>2月</td>
                        <td>3月</td>
                        <td>4月</td>
                        <td>5月</td>
                        <td>6月</td>
                        <td>7月</td>
                        <td>8月</td>
                        <td>9月</td>
                        <td>10月</td>
                        <td>11月</td>
                        <td>12月</td>
                    </tr>
                </table>
                <table class="calendar">
                    <tr>
                        <th>一</th>
                        <th>二</th>
                        <th>三</th>
                        <th>四</th>
                        <th>五</th>
                        <th>六</th>
                        <th>日</th>
                    </tr>

                    <?php

                    //為何只印了第1次，沒有跟著月份重新填？
                    //因為變數設定問題，逐個變數印出來看看就會知道發生什麼事。

                    // 開工用php填日期了，先設定一個以後可能用得著的今天
                    $today = $thisDay[0];

                    // 先定出本月份的第1天
                    $firstDay = date("first day of", $thisDay[0]);
                //    echo $firstDay;

                    // 第一天是該週的第幾天
                    $firstDayWeek = date("w", $thisDay[0]);

                    // 當月份總共有幾天
                    $days = date("t", $thisDay[0]);

                    // 當月份跨了幾週，這很重要
                    $totalWeeks = ceil(($days + $firstDayWeek) / 7);

                    // 依照上列資料印出該月份的表格
                    for ($i = 0; $i < $totalWeeks; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 7; $j++) {
                            if ($i == 0 && $j < $firstDayWeek) {
                                echo "<td>";
                                echo "</td>";
                            } else {
                                if ($i * 7 + $j + 1 - $firstDayWeek <= $days) {
                                    echo "<td>";
                                    echo $i * 7 + $j + 1 - $firstDayWeek;
                                    echo "</td>";
                                } else {
                                    echo "<td>";
                                    echo "</td>";
                                }
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
            <td class="rCol">
            </td>
        </tr>
    </table>
</body>