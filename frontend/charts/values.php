<?php

$con = mysql_connect("localhost","root","smdr");

if (!$con) {
die('Could not connect: ' . mysql_error());
}

mysql_select_db("smdr", $con);

$result = mysql_query("SELECT DATE_FORMAT(`callstart`, '%Y-%m-%d') as date, count(*) as sum
FROM  `smdr` 
WHERE CallStart >=  '2013-11-1'
AND CallStart <=  '2013-11-20' group by day(date) ") or die ("Error");

while($row = mysql_fetch_array($result)) {
echo $row['date'] . "/" . $row['sum']. "/" ;
}

mysql_close($con);
?>

