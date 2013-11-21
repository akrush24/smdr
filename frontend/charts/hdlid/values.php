<?php

$con = mysql_connect("localhost","root","smdr");

if (!$con) {
die('Could not connect: ' . mysql_error());
}

mysql_select_db("smdr", $con);
$mn = date("j");

$result = mysql_query("SELECT COUNT( * ) AS sum, Party1Name AS date
FROM  `smdr` 
WHERE CallStart >= '".date("Y-m-"."%")."'
AND ( callednumber =  '3020' OR callednumber =  '4020' OR callednumber =  '7020' )
AND Caller LIKE  '8%'
AND ConnectedTime >5
GROUP BY DATE ASC
ORDER BY  `sum` ASC") or die ("Error");

while($row = mysql_fetch_array($result)) {
echo $row['date'] . "/" . $row['sum']. "/" ;
}

mysql_close($con);
?>

