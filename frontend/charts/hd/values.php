<?php

$con = mysql_connect("localhost","root","smdr");

if (!$con) {
die('Could not connect: ' . mysql_error());
}

mysql_select_db("smdr", $con);

$result = mysql_query("SELECT DATE_FORMAT(`callstart`, '%Y-%m-%d') as date, count(*) as sum
FROM  `smdr` 
WHERE CallStart >= '".date("Y-m-"."%")."'
AND ( callednumber = '3020'  or callednumber = '4020'  or callednumber = '5225' )  and ConnectedTime > 2 group by day(date) ") or die ("Error");

while($row = mysql_fetch_array($result)) {
echo $row['date'] . "/" . $row['sum']. "/" ;
}

mysql_close($con);
?>

