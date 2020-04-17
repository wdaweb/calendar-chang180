<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>年曆樣式</title>
</head>
<style>
    body{
        display:flex;
        flex-direction: column;
        align-items:center;
        text-align: center;
        justify-content: center;
        margin:0;
        padding:0;
    }
    table {
        text-align: center;
        border-collapse: collapse;
        display:flex;
        align-items:flex-start;
    }

    table td {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: center;
    }

    table th{
        background:lightgrey;
        border:1px solid #aaa;
    }
    .month{
        background:yellow;
    }
    .day{
        color:white;
        background:limegreen;
    }
    .day:hover{
        background:red;
    }
</style>

<body>
<h1>老師示範月曆格式製作</h1>
<h4>月曆練習</h4>

<div>
    <form action="?" method='get'>
    年份:<input type="number" name="year">
    <input type="submit" value="產生年曆">

    </form>
</div>
<?php

// 利用表單輸入獲得年份值，若沒有則使用今年做為值
if(isset($_GET["year"])){
    $year=$_GET['year'];
}else{
    $year=date("Y");
}

echo "<h4 style='text-align:center'>西元",$year,"年曆</h4>";

// $year = "2022";
echo "<div>年份:", $year,"</div>";
echo "<table>";
$m=0;
for($y=0;$y<3;$y++){
    echo "<tr>";
    for($x=0;$x<4;$x++){
        echo "<td>";
                $m++
            
 
?>
    <table>
        <div class="month" colspan="7">月份:<?= $m; ?></div>
        <tr>
            <th>日</th>
            <th>一</th>
            <th>二</th>
            <th>三</th>
            <th>四</th>
            <th>五</th>
            <th>六</th>
        </tr>
        <?php
        // 先定出月份的第1天
        $firstDay = "$year-$m-01";
        // 第一天是該週的第幾天
        $firstDayWeek = date("w", strtotime($firstDay));
        // 當月份總共有幾天
        $days = date("t", strtotime($firstDay));
        // 當月份跨了幾週，這很重要
        $totalWeeks = ceil(($days + $firstDayWeek) / 7);
        // echo "第一天星期:", $firstDayWeek, "<br>";
        // echo "月天數:", $days, "天";

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
                        echo "<div class='day'>",$num,"</div>";
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
        echo "<hr>";

        ?>
    </table>
    <?php
            }
               echo "</td>";
            }
            echo "</tr>";
        
echo "</table>";
?>
</body>
</html>