<?php

$con = mysql_connect("localhost","root","smdr");

if (!$con) {
die('Could not connect: ' . mysql_error());
}

mysql_select_db("smdr", $con);

$result = mysql_query("
SELECT SUM( ConnectedTime/60 ) AS  'sum', CONCAT(Party1Name,' ',caller) AS name
FROM  `smdr` 
WHERE Caller LIKE  '____'
AND callstart like '2015-10%'
AND CalledNumber LIKE  '89%'
OR CalledNumber LIKE  '98%'
GROUP BY name
ORDER BY  `sum` DESC 
LIMIT 0 , 30 ") or die ("Error");

while($row = mysql_fetch_array($result)) {
echo $row['name'] . "/" . $row['sum']. "/" ;
}

mysql_close($con);
?>

