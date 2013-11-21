<html>
<head>
	<title>SMDR</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
	<script src="js/tableToExcel.js"></script>
	<script src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://yandex.st/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	<link href="http://yandex.st/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">

</head>
    
<body>

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#smdr" data-toggle="tab">SMDR</a>
  </li>
  <li><a href="#charts" data-toggle="tab">Charts</a></li>
  <li><a href="#">...</a></li>
</ul>
 <div class="tab-content">
   <div id="smdr" class="tab-pane active">
     
<button type="button" onclick="tableToExcel('tabletoexport', 'W3C Example Table')" class="btn btn-info btn-mini"><i class="icon-white icon-hdd"></i>Скачать отчёт</button> 

<?php include 'smdr.php'; ?>

   </div>
   <div id="charts" class="tab-pane">

<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">График соединений по компании</a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
        <iframe src="/charts/all/" width="1024" height="450" frameBorder="0" scrolling="0"></iframe>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">График соединений по HD</a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
         <iframe src="/charts/hdlid/" width="1024" height="450" frameBorder="0" scrolling="0"></iframe>
      </div>
    </div>
  </div>
</div>


   </div>
   </div>
	
</body>

