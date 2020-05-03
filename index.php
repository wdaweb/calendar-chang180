<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆 Perpetual Calendar</title>
    <link rel="stylesheet" type="text/css" href="./plugins/css/bootstrap.css">
    <style>
        body {
            margin: 0;
            font-family: "Microsoft JhengHei", Arial, Helvetica, sans-serif;
            text-align: center;
            background: lightgoldenrodyellow;
            height: 100%;
        }

        .calendar td:first-child {
            background: rgb(255, 35, 46);
        }

        .calendar td:last-child {
            background: rgb(110, 245, 128);
        }

        .calendar th:first-child {
            background: rgb(255, 35, 146);
        }

        .calendar th:last-child {
            background: rgb(110, 245, 228);
        }
    </style>

</head>

<body class="container-fluid bg-dark text-light table-responsive w-auto vh-100">
    <?php
    // 將預設時區設定到臺灣，沒設定在時間顯示上有時會出問題。
    date_default_timezone_set("Asia/Taipei");

    // 加入2020年節慶資料庫，須先在MySQL建立holiday資料庫並匯入./Db/holiday.sql
    $dsn = "mysql:host=localhost;dbname=holiday;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    $sql = "SELECT * FROM 2020_holiday";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // 二維陣列鬼打牆很久，感謝估狗大神保佑……
    $holiday = array_column($rows, 'date', 'day');
    // echo "<pre>";print_r($holiday);echo "</pre>";

    //如果年份和月份不為空值，則使用該年月的第1天：
    if (!empty($_GET["year"]) && !empty($_GET["month"])) {
        $year = $_GET["year"];
        $month = $_GET["month"];

        // 判斷年份是否為負數，目前沒有作用
        // if ($year < 0) {
        //     $negYear = abs($year);
        //     echo $year, "<br>", $negYear, "<br>";
        //     $thisDay = getdate(strtotime('-2 * $negYear, strtotime("$negYear-$month-1")'));
        // } else {
        $thisDay = getdate(strtotime("$year-$month-1"));
        // }

        //年月沒設定時，再看基準日有沒有設定get
    } elseif (isset($_GET["thisDay"])) {
        $thisDay = getdate($_GET["thisDay"]);
        // print_r($thisDay);
    }
    // 全都沒設定時，基準日設定為今日
    else $thisDay = getdate();


    //設定月份，這個月和前後兩個月
    $thisMonth = $thisDay["mon"];
    $lastMonth = strtotime("first day of - 1 month", $thisDay[0]);
    $nextMonth = strtotime("first day of + 1 month", $thisDay[0]);

    //由於現行西曆為格里曆，從儒略曆1582年10月5日直接跳到格里曆10月15日，故此之前的程式換算有待調整
    // 顯示月曆目前的年份和月份，西元沒有0年，所以小於西元1年要再減1
    if ($thisDay["year"] < 1) $thisDay["year"] -= 1;


    echo "<h3 style='text-align:center'>西元", $thisDay["year"], "年", $thisDay["mon"], "月</h3>";
    ?>

    <form action="?" method='get' class="row justify-content-center h4">年份:<input type="number" name="year" min="0" max="9999" oninput="/\d{4}/" title="請輸入年份">月份:<input type="number" name="month" min="1" max="12" title="請輸入1-12">
        <input type="submit" value="查詢">
    </form>

    <table class="container-fluid row-12 justify-content-center table ">
        <tr>
            <td class="date row justify-content-center h3">
                <!-- 螢幕會顯示本月份以及上下個月的選項 -->
                <a href="index.php?thisDay=<?= $lastMonth; ?>">上月(<?= date("n", $lastMonth); ?>)</a>
                <a href="index.php?thisDay=<?= time(); ?>">回本月</a>
                <!-- <span>本月(<?= $thisMonth; ?>)</span> -->
                <a href="index.php?thisDay=<?= $nextMonth; ?>">下月(<?= date("n", $nextMonth); ?>)</a>
            </td>
        </tr>
        <tr>
            <td>
                <table class="month h5 table text-light">
                    <tr>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of January', ($thisDay[0])); ?>">1月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of February', ($thisDay[0])); ?>">2月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of March', ($thisDay[0])); ?>">3月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of April', ($thisDay[0])); ?>">4月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of May', ($thisDay[0])); ?>">5月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of June', ($thisDay[0])); ?>">6月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of July', ($thisDay[0])); ?>">7月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of August', ($thisDay[0])); ?>">8月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of September', ($thisDay[0])); ?>">9月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of October', ($thisDay[0])); ?>">10月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of November', ($thisDay[0])); ?>">11月</a></td>
                        <td><a href="index.php?thisDay=<?= strtotime('first day of December', ($thisDay[0])); ?>">12月</a></td>
                    </tr>
                </table>
                <table style="table-layout:fixed" class="calendar bg table text-light">
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

                    // 先定出本月份的第1天
                    $firstDay = strtotime("first day of", $thisDay[0]);

                    // 第一天是該週的第幾天
                    $firstDayWeek = date("w", $firstDay);

                    // 當月份總共有幾天
                    $days = date("t", $thisDay[0]);

                    // 當月份跨了幾週，這很重要
                    $totalWeeks = ceil(($days + $firstDayWeek) / 7);

                    // 依照上列資料印出該月份的表格

                    // 設定當月日期
                    $mDay = $firstDay;

                    for ($i = 0; $i < $totalWeeks; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 7; $j++) {
                            // 當月第1天之前印空格
                            if ($i == 0 && $j < $firstDayWeek) {
                                echo "<td>";
                                echo "</td>";
                            } else {
                                // 印出當月份的日期與節日名稱

                                //算出該月份天數
                                $m = $i * 7 + $j + 1 - $firstDayWeek;
                                if ($m <= $days) {
                                    // 將每日的日期在新視窗連結維基百科：歷史上的今天

                                    // 如果當天遇上假日，則將當日日期及假日名稱印出
                                    if (in_array(date("Y-m-d", $mDay), $holiday)) {
                                        echo "<td class='bg-warning'>";
                                        $m1=date('n',$mDay);
                                        echo "<a href='https://zh.wikipedia.org/wiki/",$m1,"月",$m,"日' target='_blank'>",$m,"</a>";
                                        echo "<br>", '<span class="bg-dark badge text-light">', array_search(date("Y-m-d", $mDay), $holiday), '</span>';
                                        echo "</td>";
                                    }
                                    //否則只印出當日日期
                                    else {
                                        echo "<td>";
                                        $m1=date('n',$mDay);
                                        echo "<a href='https://zh.wikipedia.org/wiki/",$m1,"月",$m,"日' target='_blank'>",$m,"</a>";
                                        echo "<br>";
                                        echo "</td>";
                                    }
                                } else {
                                    // 印完當月剩下的空格
                                    echo "<td>";
                                    echo "</td>";
                                }
                                $mDay = strtotime("+1 day", $mDay);
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
            <!-- <td class="rCol col-auto"><img src="https://picsum.photos/400/320/?random=1" class="img-fluid img-thumbnail">
            </td> -->
        </tr>
        <!-- <caption>CSS重新修改中</caption> -->
    </table>
    <!-- <script src="./plugins/js/jquery-3.5.0.js"></script>
    <script src="./plugins/js/bootstrap.bundle.min.js"></script> -->
</body>