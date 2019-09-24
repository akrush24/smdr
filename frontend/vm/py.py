#!/usr/bin/python
import csv
"""
with open('csv', 'r') as f:
    reader = csv.reader(f, delimiter=';', )
    for row in reader:
	Datacenter = row[0]
	DatastoreName = row[1]
	TotalSpaceGB = row[2]
	Type = row[3]
	UsedSpaceGB = row[4]
	ProvisionedSpaceGB = row[5]
	FreeSpaceGB = row[6]
	NumVM = row[7]
	NumVMHost = row[8]
        if int(NumVMHost) > 2:
            print DatastoreName
"""


print """
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Datastore</title>
  <script src="https://www.google.com/jsapi"></script>
  <script>
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
    var data = google.visualization.arrayToDataTable([
     ['DatastoreName', 'TotalSpaceGB', 'UsedSpaceGB', 'ProvisionedSpaceGB', 'FreeSpaceGB'], """

with open('csv', 'r') as f:
    reader = csv.reader(f, delimiter=';', )
    for row in reader:
        Datacenter = row[0]
        DatastoreName = row[1]
        TotalSpaceGB = row[2]
        Type = row[3]
        UsedSpaceGB = row[4]
        ProvisionedSpaceGB = row[5]
        FreeSpaceGB = row[6]
        NumVM = row[7]
        NumVMHost = row[8]
        if int(NumVMHost) > 2:
            print "     ['"+DatastoreName+"',"+TotalSpaceGB+","+UsedSpaceGB+","+ProvisionedSpaceGB+","+FreeSpaceGB+"],"

print """    ]);
    var options = {
     legend: { position: 'top', alignment: 'start' },
     title: 'Share Storage',
     hAxis: {title: 'Storages'},
     vAxis: {title: 'GB'}
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('oil'));
    chart.draw(data, options);
   }
  </script>
 </head>
 <body>
  <div id="oil" style="width: 100%; height: 600px;"></div>
 </body>
 </html>
"""
