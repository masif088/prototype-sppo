"use strict";

var statistics_chart = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'line',
  data: {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [{
      label: 'Statistics',
      data: [640, 387, 530, 302, 430, 270, 488],
      borderWidth: 5,
      borderColor: '#6777ef',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#6777ef',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 150
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});

$('#visitorMap').vectorMap(
{
  map: 'world_en',
  backgroundColor: '#ffffff',
  borderColor: '#f2f2f2',
  borderOpacity: .8,
  borderWidth: 1,
  hoverColor: '#000',
  hoverOpacity: .8,
  color: '#ddd',
  normalizeFunction: 'linear',
  selectedRegions: false,
  showTooltip: true,
  pins: {
    id: '<div manager-class="jqvmap-circle"></div>',
    my: '<div manager-class="jqvmap-circle"></div>',
    th: '<div manager-class="jqvmap-circle"></div>',
    sy: '<div manager-class="jqvmap-circle"></div>',
    eg: '<div manager-class="jqvmap-circle"></div>',
    ae: '<div manager-class="jqvmap-circle"></div>',
    nz: '<div manager-class="jqvmap-circle"></div>',
    tl: '<div manager-class="jqvmap-circle"></div>',
    ng: '<div manager-class="jqvmap-circle"></div>',
    si: '<div manager-class="jqvmap-circle"></div>',
    pa: '<div manager-class="jqvmap-circle"></div>',
    au: '<div manager-class="jqvmap-circle"></div>',
    ca: '<div manager-class="jqvmap-circle"></div>',
    tr: '<div manager-class="jqvmap-circle"></div>',
  },
});

// weather
getWeather();
setInterval(getWeather, 600000);

function getWeather() {
  $.simpleWeather({
  location: 'Bogor, Indonesia',
  unit: 'c',
  success: function(weather) {
    var html = '';
    html += '<div manager-class="weather">';
    html += '<div manager-class="weather-icon text-primary"><span manager-class="wi wi-yahoo-' + weather.code + '"></span></div>';
    html += '<div manager-class="weather-desc">';
    html += '<h4>' + weather.temp + '&deg;' + weather.units.temp + '</h4>';
    html += '<div manager-class="weather-text">' + weather.currently + '</div>';
    html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
    html += '<li> <i manager-class="wi wi-strong-wind"></i> ' + weather.wind.speed+' '+weather.units.speed + '</li></ul>';
    html += '</div>';
    html += '</div>';

    $("#myWeather").html(html);
  },
  error: function(error) {
    $("#myWeather").html('<div manager-class="alert alert-danger">'+error+'</div>');
  }
  });
}
