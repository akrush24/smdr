$(function() {
//Highcharts with mySQL and PHP - Ajax101.com

var months = [];
var days = [];
var switch1 = true;
$.get('values.php', function(data) {

data = data.split('/');
for (var i in data) {
if (switch1 == true) {
months.push(data[i]);
switch1 = false;
} else {
days.push(parseFloat(data[i]));
switch1 = true;
}

}
months.pop();

$('#chart').highcharts({
chart : {
type : 'spline'
},
title : {
text : 'Telephone Call Traffic'
},
subtitle : {
text : 'Top callers'
},
xAxis : {
title : {
text : 'Caller'
},
categories : months
},
yAxis : {
title : {
text : 'Minute'
},
labels : {
formatter : function() {
return this.value + ' minutes'
}
}
},
tooltip : {
crosshairs : true,
shared : true,
valueSuffix : ''
},
plotOptions : {
spline : {
marker : {
radius : 4,
lineColor : '#666666',
lineWidth : 1
}
}
},
series : [{

name : 'Calls',
data : days
}]
});
});
});
