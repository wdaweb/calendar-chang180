<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作業說明</title>
</head>
<body>

<?php

// 如何跳頁的方式，給完全不會做的同學一個可以抄的東西
$month=date("m");
if(isset($_GET["month"])){
    $month=$_GET["month"];
}
?>

<a href="month.php?month=<?=$month-1;?>">上月(<?=$month-1;?>)</a>
<span>本月(<?=$month;?>)</span>
<a href="month.php?month=<?=$month+1;?>">下月(<?=$month+1;?>)</a>
    
</body>
</html>