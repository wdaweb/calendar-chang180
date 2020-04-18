<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <link rel="stylesheet" href="style.css">

</head>

<?php

// 利用表單輸入獲得年份值，若沒有則使用今年做為值
if (isset($_GET["year"])) {
    $year = $_GET['year'];
} else {
    $year = date("Y");
}
// 利用表單輸入獲得月份值，若沒有則使用本月做為值
if (isset($_GET["month"])) {
    $month = $_GET['month'];
} else {
    $month = date("m");
}
?>

<body>
    <div>
        <form action="?" method='get'>
            年份:<input type="number" name="year" min="-9999" max="9999" title="請輸入年份" value="<?= $year; ?>">
            月份:<input type="number" name="month" min="1" max="12" title="請輸入1-12" value="<?= $month; ?>">
            <input type="submit" value="查詢">

        </form>
    </div>

    <?php

    echo "<h4 style='text-align:center'>西元", $year, "年", $month, "月</h4>";
    ?>

    <table class="container">
        <tr>
            <td class="date">
                <a href="calendar.php?month=<?= date("m", strtotime("first day of -1 month", strtotime($month))); ?>">上月(<?= date("m", strtotime("first day of -1 month", strtotime($month))); ?>)</a>
                <span>本月(<?= $month; ?>)</span>
                <a href="calendar.php?month=<?= date("m", strtotime("first day of +1 month", strtotime($month))); ?>">下月(<?= date("m", strtotime("first day of +1 month", strtotime($month))); ?>)</a>
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
                    // 開工用php填日期了
                    $today = date("d-m-Y");
                    
                    // 先定出本月份的第1天
                    $firstDay = date("1-m-Y");

                    // 第一天是該週的第幾天
                    $firstDayWeek = date("w", strtotime($firstDay));

                    // 當月份總共有幾天
                    $days = date("t", strtotime($firstDay));
                    // 當月份跨了幾週，這很重要
                    $totalWeeks = ceil(($days + $firstDayWeek) / 7);


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