#!/usr/bin/python
import csv

print """
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
    var data = google.visualization.arrayToDataTable([
"""

print """
     ['DatastoreName', 'TotalSpaceGB', 'UsedSpaceGB', 'ProvisionedSpaceGB', 'FreeSpaceGB'],
"""

with open('csv', 'r') as f:
    reader = csv.reader(f, delimiter=';', )
    for row in reader:
        Datacenter = row[0]
        DatastoreName = row[1]
        TotalSpaceGB = row[2]
        AllTotalSpaceGB = AllTotalSpaceGB + TotalSpaceGB
        Type = row[3]
        UsedSpaceGB = row[4]
        AllUsedSpaceGB = AllUsedSpaceGB + UsedSpaceGB
        ProvisionedSpaceGB = row[5]
        AllProvisionedSpaceGB = AllProvisionedSpaceGB + ProvisionedSpaceGB
        FreeSpaceGB = row[6]
        AllFreeSpaceGB = AllFreeSpaceGB + FreeSpaceGB
        NumVM = row[7]
        NumVMHost = row[8]
        if int(NumVMHost) > 2:
            print "     ['"+DatastoreName+"',"+TotalSpaceGB+","+UsedSpaceGB+","+ProvisionedSpaceGB+","+FreeSpaceGB+"],"

print """

        var options = {
          legend: { position: 'top', alignment: 'start' },
          title: 'Storages',
          vAxis: {title: 'Name',  titleTextStyle: {color: 'green'}},
          chartArea:{}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>

  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 600px;"></div>
    <b>Total</b>: """+AllTotalSpaceGB+"""<br>
    <b>Used</b>: 234234<br>
    <b>Free</b>: 13213<br>
    <b>Provisioned</b>: wewe
  </body>
</html>
"""

