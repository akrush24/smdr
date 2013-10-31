<html>

<head>
<title>SMDR</title>
<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
<script type="text/javascript" src="js/sort.js"></script>

<style>
html{padding: 0px; margin: 0px;  font-size: 13px; background-color: #F4F4F4; color: #000; font-family: 'Times New Roman'; width:100%;}
body{padding: 0px; margin: 0px; width:100%; }
table, td, tr, th {
	vertical-align:top;
	padding:0px;
	padding-left:4px;
	padding-right:3px;
	margin:0px;
	border-width:1px;
	border-style:solid;
	border-spacing:0px;
	border-collapse:collapse;
	border-color: #C0C0C0;
	white-space: nowrap;
	font-family:monospace; 
}

tr {background-color:#F8F8F8; }
tr:hover { BACKGROUND: #D8D8D8; }
#head { background-color: #D8D8D8; text-align: center; font-weight: bold; }

table.sort td{
	border:1px solid #CCCCCC;
}

table.sort thead td{
	cursor:pointer;
	cursor:hand;
	font-weight:bold;
	text-align:center;
	vertical-align:middle
}

table.sort thead td.curcol{ color:#210B61; }

input,select,option,textarea,form {
  padding:0px;
  margin:0px;
  color:#000;
  border-width:0px;
  border-color:#E6E6E6;
  border-style:solid;
  padding-left:1px;
  padding-right:1px;
  font-family:monospace;
  width:100%;
  background-color:#E0FFFF;
}

#input {padding:0px; margin:0px;}
</style>

</head>

<body>

<?php 
// определяем начальные данные
$db_host = 'localhost';
$db_name = 'smdr';
$db_username = 'root';
$db_password = 'smdr';
$db_table_to_show = 'smdr';

// соединяемся с сервером базы данных
$connect_to_db = mysql_connect($db_host, $db_username, $db_password)
	or die("Could not connect: " . mysql_error());

// подключаемся к базе данных
mysql_select_db($db_name, $connect_to_db)
	or die("Could not select DB: " . mysql_error());

$rows[] = 'CallStart';
$rows[] = 'ConnectedTime';
$rows[] = 'Caller';
$rows[] = 'CalledNumber';
$rows[] = 'Party1Name';
$rows[] = 'Party2Name';
$rows[] = 'Direction';
$rows[] = 'IsInternal';
$rows[] = 'DialledNumber';
$rows[] = 'ExternalTargeterId';

foreach ($rows as $row_name){
	if( $_POST[$row_name] != '' ){
		switch ($_POST['action'.$row_name]){
			case 'eq':
				$action[$row_name]='='; $selected[$row_name]['eq'] = 'selected';
			break;
			case 'ne':
				$action[$row_name]='!='; $selected[$row_name]['ne'] = 'selected';
			break;
			case 'gt':
				$action[$row_name]='>'; $selected[$row_name]['qt'] = 'selected';
			break;
			case 'ge':
				$action[$row_name]='>='; $selected[$row_name]['ge'] = 'selected';
			break;
			case 'lt':
				$action[$row_name]='>'; $selected[$row_name]['lt'] = 'selected';
			break;
			case 'le':
				$action[$row_name]='>='; $selected[$row_name]['le'] = 'selected';
			break;
			case 'like':
				$action[$row_name]='like'; $selected[$row_name]['like'] = 'selected';
			break;	
		}
		
			if ($WHERE != ''){ $AND="and "; };
			$WHERE=$WHERE." ".$AND." ".$row_name." ".$action[$row_name]." '".$_POST[$row_name]."' ";
			#print '<h1>'.WHERE.'</h1><br>';
			
	}
};


if( !is_null($WHERE) ){
	#print "<br><b> select * from $db_table_to_show where $WHERE</b><br>";
	$qr_result = mysql_query("select * from $db_table_to_show where $WHERE") or die(mysql_error());	
}else{
	#print "select * from $db_table_to_show where Callstart like '".date("Y-m-d H")."%'";
	$qr_result = mysql_query("select * from $db_table_to_show where Callstart like '".date("Y-m-d H")."%'" ) or die(mysql_error());
};

//$qr_result = mysql_query("select * from $db_table_to_show where caller = '3010' " )
//                or die(mysql_error());

// выводим на страницу сайта заголовки HTML-таблицы
echo '<table class="sort">';
echo '<thead>';
echo '<tr>';
echo '<td id="head">#</th>';
echo '<td id="head">Дата</th>';
echo '<td id="head">Длительность</th>';
echo '<td id="head">Номер1</th>';
echo '<td id="head">Номер2</th>';
echo '<td id="head">Кто</th>';
echo '<td id="head">Кому</th>';
echo '<td id="head">Направление</th>';
echo '<td id="head">Внутренний звонок?</th>';
echo '<td id="head">Dialled</th>';
echo '<td id="head">ExternalTargeterid</th>';	
echo '</tr>';

echo '<tr><form action="index.php" name="query" method="post">';
echo '<td id="input"></td>';

foreach ($rows as $row_name){
	#print '<h1>'.$_POST[$value].'</h1>';
	echo '<td id="input">
<select name="action'.$row_name.'" style="width:30%;">
<option value="like" '.$selected[$row_name]['like'].'>like</option>
<option value="eq" '.$selected[$row_name]['eq'].'>=</option><option value="ne" '.$selected[$row_name]['ne'].'>!=</option>
<option value="gt" '.$selected[$row_name]['gt'].'>></option><option value="ge" '.$selected[$row_name]['ge'].'>>=</option>
<option value="lt" '.$selected[$row_name]['lt'].'><</option><option value="le" '.$selected[$row_name]['le'].'><=</option>
</select>
<input style="width:70%;margin-left:-8px;" name="'.$row_name.'" value="'.$_POST[$row_name].'"></td>';
}

	echo '<input type="submit" style="width:0px;height:0px;" type="hidden"></td>';
	echo '</form></tr>';
echo '</thead>';
echo '<tbody>';

$INDEX=1;
while($data = mysql_fetch_array($qr_result)){ 
	echo '<tr>';
	echo '<td>'.$INDEX.'</th>';
	echo '<td>' . $data['CallStart'] . '</td>';
	echo '<td>' . $data['ConnectedTime'] . '</td>';
	echo '<td>' . $data['Caller'] . '</td>';
	echo '<td>' . $data['CalledNumber'] . '</td>';
	echo '<td>' . $data['Party1Name'] . '</td>';
	echo '<td>' . $data['Party2Name'] . '</td>';
	echo '<td>' . $data['Direction'] . '</td>';
	echo '<td>' . $data['IsInternal'] . '</td>';
	echo '<td>' . $data['DialledNumber'] . '</td>';
	echo '<td>' . $data['ExternalTargeterId'] . '</td>';
	echo '</tr>';
	$INDEX=$INDEX+1;
}

echo '</tbody>';
echo '</table>';

// закрываем соединение с сервером  базы данных
mysql_close($connect_to_db);
?>

</body>
</html>
