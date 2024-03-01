/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/pages/dashboard.init.js ***!
  \**********************************************/
/*
Template Name: Borex - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Dashboard Ecommerce
*/
function getChartColorsArray(chartId) {
  if (document.getElementById(chartId) !== null) {
    var colors = document.getElementById(chartId).getAttribute("data-colors");
    colors = JSON.parse(colors);
    return colors.map(function (value) {
      var newValue = value.replace(" ", "");

      if (newValue.indexOf("--") != -1) {
        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
        if (color) return color;
      } else {
        return newValue;
      }
    });
  }
} // bar chart


var barchartColors = getChartColorsArray("chart-column");
var options = {
  series: [{
    name: 'Net Profit',
    data: [18, 21, 17, 24, 21, 27, 25, 32, 26]
  }, {
    name: 'Revenue',
    data: [21, 24, 20, 27, 25, 29, 26, 34, 30]
  }],
  chart: {
    type: 'bar',
    height: 350,
    toolbar: {
      show: false
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '35%',
      borderRadius: 6,
      endingShape: 'rounded'
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  colors: ['#fff', '#fff'],
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
  },
  yaxis: {
    labels: {
      formatter: function formatter(value) {
        return value + "k";
      }
    },
    tickAmount: 4
  },
  legend: {
    show: false
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      type: "vertical",
      shadeIntensity: 1,
      inverseColors: true,
      gradientToColors: [barchartColors[0], barchartColors[1]],
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 38, 100, 38]
    }
  }
};
var chart = new ApexCharts(document.querySelector("#chart-column"), options);
chart.render(); // radialBar

var barchartColors = getChartColorsArray("chart-radialBar");
var options = {
  series: [76],
  chart: {
    type: 'radialBar',
    height: 162,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    radialBar: {
      startAngle: -90,
      endAngle: 90,
      track: {
        background: "#f3f2f9",
        strokeWidth: '97%',
        margin: 5,
        // margin is in pixels
        dropShadow: {
          enabled: false,
          top: 2,
          left: 0,
          color: '#999',
          opacity: 1,
          blur: 2
        }
      },
      hollow: {
        margin: 15,
        size: "65%"
      },
      dataLabels: {
        name: {
          show: false
        },
        value: {
          offsetY: -2,
          fontSize: '22px'
        }
      }
    }
  },
  stroke: {
    lineCap: "round"
  },
  grid: {
    padding: {
      top: -10
    }
  },
  colors: barchartColors,
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      shadeIntensity: 0.4,
      inverseColors: false,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 50, 53, 91]
    }
  },
  labels: ['Average Results']
};
var chart = new ApexCharts(document.querySelector("#chart-radialBar"), options);
chart.render();
/********** Area chart ********/

var barchartColors = getChartColorsArray("chart-area");
var options = {
  chart: {
    height: 270,
    type: 'area',
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 2
  },
  series: [{
    name: 'Current',
    data: [21, 54, 45, 84, 48, 56]
  }, {
    name: 'Previous',
    data: [40, 32, 60, 32, 55, 45]
  }],
  colors: barchartColors,
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'right'
  },
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      inverseColors: false,
      opacityFrom: 0.45,
      opacityTo: 0.05,
      stops: [20, 100, 100, 100]
    }
  },
  yaxis: {
    tickAmount: 4
  },
  xaxis: {
    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
  }
};
var chart = new ApexCharts(document.querySelector("#chart-area"), options);
chart.render(); // Donut chart

var barchartColors = getChartColorsArray("chart-donut");
var options = {
  chart: {
    height: 220,
    type: 'donut'
  },
  plotOptions: {
    pie: {
      donut: {
        size: '70%'
      }
    }
  },
  dataLabels: {
    enabled: false
  },
  series: [70, 25, 15],
  labels: ["Completed", "Pending", "Cancel"],
  colors: barchartColors,
  fill: {
    type: 'gradient'
  },
  legend: {
    show: false,
    position: 'bottom',
    horizontalAlign: 'center',
    verticalAlign: 'middle',
    floating: false,
    fontSize: '14px',
    offsetX: 0
  }
};
var chart = new ApexCharts(document.querySelector("#chart-donut"), options);
chart.render();
/******/ })()
;