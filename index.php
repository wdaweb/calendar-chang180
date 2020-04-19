<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆 Perpetual Calendar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .rCol {
            /* 必須把背景圖片拿回來放，不然不會跟著月份輪換 */
            background: url("https://picsum.photos/400/640/?random=1");
        }
    </style>

</head>

<body>
    <?php
    // 將預設時區設定到臺灣，沒設定在時間顯示上有時會出問題。
    date_default_timezone_set("Asia/Taipei");

    // 設定基準日，若都沒有設定就是今天
    // if (!isset($_GET["year"]) && !isset($_GET["month"])) $thisDay = getdate();


    // 利用表單輸入獲得年份及月份值，若沒有則使用本月1日做為值
    // strtotime()裏面不能直接丟 $_GET 變數進去，會出錯

    //如果年份和月份不為空值，則使用該年月的第1天：
    if (!empty($_GET["year"]) && !empty($_GET["month"])) {
        $year = $_GET["year"];
        $month = $_GET["month"];

        // 判斷年份是否為負數
        if ($year < 0) {
            $negYear = abs($year);
            echo $year, "<br>", $negYear, "<br>";
            $thisDay = getdate(strtotime('-2 * $negYear, strtotime("$negYear-$month-1")'));
        } else {
            $thisDay = getdate(strtotime("$year-$month-1"));
        }

        //年月沒設定時，再看基準日有沒有設定get
    } elseif (isset($_GET["thisDay"])) {
        $thisDay = getdate($_GET["thisDay"]);
        // print_r($thisDay);
    }
    // 全都沒設定時，基準日設定為今日
    else $thisDay = getdate();
    // 看一下結果
    // print_r($thisDay);


    //設定月份，這個月和前後兩個月
    $thisMonth = $thisDay["mon"];
    $lastMonth = strtotime("first day of - 1 month", $thisDay[0]);
    $nextMonth = strtotime("first day of + 1 month", $thisDay[0]);

    ?>
    <div>
        <form action="?" method='get'>
            年份:<input type="number" name="year" min="0000" max="9999" value="/\d{4}/" title="請輸入年份">
            月份:<input type="number" name="month" min="1" max="12" title="請輸入1-12">
            <input type="submit" value="查詢">
        </form>
    </div>
    <?php
    //顯示月曆目前的年份的月份
    echo "<h4 style='text-align:center'>西元", $thisDay["year"], "年", $thisDay["mon"], "月</h4>";
    ?>

    <table class="container">
        <tr>
            <td class="date">
                <!-- 螢幕會顯示本月份以及上下個月的選項 -->
                <a href="index.php?thisDay=<?= $lastMonth; ?>">上月(<?= date("n", $lastMonth); ?>)</a>
                <a href="index.php?thisDay=<?= time(); ?>">回本月</a>
                <!-- <span>本月(<?= $thisMonth; ?>)</span> -->
                <a href="index.php?thisDay=<?= $nextMonth; ?>">下月(<?= date("n", $nextMonth); ?>)</a>
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
                        <th>週日</th>
                        <th>週一</th>
                        <th>週二</th>
                        <th>週三</th>
                        <th>週四</th>
                        <th>週五</th>
                        <th>週六</th>
                    </tr>

                    <?php

                    //為何只印了第1次，沒有跟著月份重新填？
                    //因為變數設定問題，逐個變數印出來看看就會知道發生什麼事。
                    //現在的問題變成印第1次和回本月的時候只會從1日開始印，不會從該月第1天開始。
                    // 應該是最前面的判斷式有問題。
                    // 最後發現仍然是變數設定問題，之後使用函式時，沒必要的話不要混用，很容易出錯

                    // 先定出本月份的第1天
                    $firstDay = strtotime("first day of", $thisDay[0]);
                    //    echo $firstDay;

                    // 第一天是該週的第幾天
                    $firstDayWeek = date("w", $firstDay);

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