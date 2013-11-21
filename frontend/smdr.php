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
$rows[] = 'RingTime';
$rows[] = 'Caller';
$rows[] = 'CalledNumber';
$rows[] = 'Party1Name';
$rows[] = 'Party2Name';
$rows[] = 'Direction';
$rows[] = 'IsInternal';
$rows[] = 'DialledNumber';
//$rows[] = 'ExternalTargeterId';


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

        }
};


if( !is_null($WHERE) ){
        $qr_result = mysql_query("select * from $db_table_to_show where $WHERE") or die(mysql_error());
      //  print 'select * from $db_table_to_show where '.$WHERE;
}else{
        $qr_result = mysql_query("select * from $db_table_to_show where Callstart like '".date("Y-m-d H")."%'" ) or die(mysql_error());
      // отображает sql запрос  print 'select * from $db_table_to_show where Callstart like '.date("Y-m-d H").'%';
};

// выводим на страницу сайта заголовки HTML-таблицы
echo '<table  id="tabletoexport" class="table table-border table-hover">';
echo '<thead>';

echo '<tr><form action="index.php" name="query" method="post">';
echo '<td id="input"></td>';

foreach ($rows as $row_name){
        #print '<h1>'.$_POST[$value].'</h1>';
        echo '<td id="input">
<select name="action'.$row_name.'" >
<option value="like" '.$selected[$row_name]['like'].'>like</option>
<option value="eq" '.$selected[$row_name]['eq'].'>=</option><option value="ne" '.$selected[$row_name]['ne'].'>!=</option>
<option value="gt" '.$selected[$row_name]['gt'].'>></option><option value="ge" '.$selected[$row_name]['ge'].'>>=</option>
<option value="lt" '.$selected[$row_name]['lt'].'><</option><option value="le" '.$selected[$row_name]['le'].'><=</option>
</select>
<input class="form-control" placeholder="'.$row_name.'"   name="'.$row_name.'" value="'.$_POST[$row_name].'"></td>';
}

        echo '<input type="submit" style="visibility: hidden;"></td>';
        echo '</form></tr>';
echo '</thead>';
echo '<tbody>';


$INDEX=1;
while($data = mysql_fetch_array($qr_result)){
        echo '<tr>';
        echo '<td>'.$INDEX.'</th>';
        echo '<td>' . $data['CallStart'] . '</td>';
        echo '<td>' . $data['ConnectedTime'] . '</td>';
        echo '<td>' . $data['RingTime'] . '</td>';
        echo '<td>' . $data['Caller'] . '</td>';
        echo '<td>' . $data['CalledNumber'] . '</td>';
        echo '<td>' . $data['Party1Name'] . '</td>';
        echo '<td>' . $data['Party2Name'] . '</td>';
        echo '<td>' . $data['Direction'] . '</td>';
        echo '<td>' . $data['IsInternal'] . '</td>';
        echo '<td>' . $data['DialledNumber'] . '</td>';
       // echo '<td>' . $data['ExternalTargeterId'] . '</td>';
        echo '</tr>';
        $INDEX=$INDEX+1;
}


echo '</tbody>';
echo '</table>';

// закрываем соединение с сервером  базы данных
mysql_close($connect_to_db);
?>

