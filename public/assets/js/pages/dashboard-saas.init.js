/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/pages/dashboard-saas.init.js ***!
  \***************************************************/
/*
Template Name: Borex - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Dashboard Saas
*/
// chart sparkline1
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
}

var barchartColors = getChartColorsArray("chart-sparkline1");
var sparklineoptions1 = {
  series: [{
    data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14]
  }],
  chart: {
    type: 'area',
    width: 85,
    height: 30,
    sparkline: {
      enabled: true
    }
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
  stroke: {
    curve: 'smooth',
    width: 2
  },
  colors: barchartColors,
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(seriesName) {
          return '';
        }
      }
    },
    marker: {
      show: false
    }
  }
};
var sparklinechart1 = new ApexCharts(document.querySelector("#chart-sparkline1"), sparklineoptions1);
sparklinechart1.render(); // chart sparkline2

var barchartColors = getChartColorsArray("chart-sparkline2");
var sparklineoptions2 = {
  series: [{
    data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
  }],
  chart: {
    type: 'area',
    width: 85,
    height: 30,
    sparkline: {
      enabled: true
    }
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
  stroke: {
    curve: 'smooth',
    width: 2
  },
  colors: barchartColors,
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(seriesName) {
          return '';
        }
      }
    },
    marker: {
      show: false
    }
  }
};
var sparklinechart2 = new ApexCharts(document.querySelector("#chart-sparkline2"), sparklineoptions2);
sparklinechart2.render(); // chart sparkline3

var barchartColors = getChartColorsArray("chart-sparkline3");
var sparklineoptions3 = {
  series: [{
    data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
  }],
  chart: {
    type: 'area',
    width: 85,
    height: 30,
    sparkline: {
      enabled: true
    }
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
  stroke: {
    curve: 'smooth',
    width: 2
  },
  colors: barchartColors,
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(seriesName) {
          return '';
        }
      }
    },
    marker: {
      show: false
    }
  }
};
var sparklinechart3 = new ApexCharts(document.querySelector("#chart-sparkline3"), sparklineoptions3);
sparklinechart3.render(); // chart sparkline4

var barchartColors = getChartColorsArray("chart-sparkline4");
var sparklineoptions4 = {
  series: [{
    data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14]
  }],
  chart: {
    type: 'area',
    width: 85,
    height: 30,
    sparkline: {
      enabled: true
    }
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
  stroke: {
    curve: 'smooth',
    width: 2
  },
  colors: barchartColors,
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function formatter(seriesName) {
          return '';
        }
      }
    },
    marker: {
      show: false
    }
  }
};
var sparklinechart4 = new ApexCharts(document.querySelector("#chart-sparkline4"), sparklineoptions4);
sparklinechart4.render(); // world-map-markers

var map = new jsVectorMap({
  map: "world_merc",
  selector: "#world-map-markers",
  zoomOnScroll: false,
  zoomButtons: false,
  regionStyle: {
    initial: {
      fill: '#fff',
      fillOpacity: 0.1
    },
    hover: {
      fillOpacity: 0.2
    }
  },
  markerStyle: {
    initial: {
      fill: '#f56e6e',
      fillOpacity: 1
    },
    hover: {
      fill: '#f56e6e',
      fillOpacity: 0.8
    }
  },
  markers: [{
    name: "Greenland",
    coords: [72, -42]
  }, {
    name: "Canada",
    coords: [56.1304, -106.3468]
  }, {
    name: "Brazil",
    coords: [-14.2350, -51.9253]
  }, {
    name: "Egypt",
    coords: [26.8206, 30.8025]
  }, {
    name: "Russia",
    coords: [61, 105]
  }, {
    name: "China",
    coords: [35.8617, 104.1954]
  }, {
    name: "United States",
    coords: [37.0902, -95.7129]
  }, {
    name: "Norway",
    coords: [60.472024, 8.468946]
  }, {
    name: "Ukraine",
    coords: [48.379433, 31.16558]
  }],
  lines: [{
    from: "Canada",
    to: "Egypt"
  }, {
    from: "Russia",
    to: "Egypt"
  }, {
    from: "Greenland",
    to: "Egypt"
  }, {
    from: "Brazil",
    to: "Egypt"
  }, {
    from: "United States",
    to: "Egypt"
  }, {
    from: "China",
    to: "Egypt"
  }, {
    from: "Norway",
    to: "Egypt"
  }, {
    from: "Ukraine",
    to: "Egypt"
  }],
  lineStyle: {
    stroke: "#fff",
    animation: true,
    strokeDasharray: "6 3 6"
  }
});
var swiper = new Swiper(".swiper-location-widget", {
  direction: "vertical",
  spaceBetween: 24,
  slidesPerView: 3,
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false
  }
}); // bar chart

var barchartColors = getChartColorsArray("chart-area");
var options = {
  series: [{
    name: 'Website Blog',
    type: 'area',
    data: [24, 21, 26, 24, 27, 27, 25, 28, 26]
  }, {
    name: 'Social Media',
    data: [21, 24, 20, 27, 25, 29, 26, 34, 30],
    type: 'line'
  }],
  chart: {
    type: 'line',
    height: 350,
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    curve: 'smooth',
    width: [0, 4]
  },
  forecastDataPoints: {
    count: 7
  },
  colors: barchartColors,
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
      gradientToColors: [barchartColors[2], barchartColors[3]],
      shadeIntensity: 1,
      type: 'horizontal',
      opacityFrom: [0.75, 1],
      opacityTo: [0.75, 1],
      stops: [0, 100, 100, 100]
    }
  },
  markers: {
    size: 3,
    strokeWidth: 3,
    hover: {
      size: 6
    }
  },
  grid: {
    show: true,
    xaxis: {
      lines: {
        show: true
      }
    },
    yaxis: {
      lines: {
        show: false
      }
    }
  }
};
var chart = new ApexCharts(document.querySelector("#chart-area"), options);
chart.render();
var barchartColors = getChartColorsArray("chart-radialBar");
var options = {
  series: [44, 55, 67],
  chart: {
    height: 323,
    type: 'radialBar'
  },
  plotOptions: {
    radialBar: {
      offsetY: 0,
      startAngle: 0,
      endAngle: 270,
      dataLabels: {
        name: {
          show: false
        },
        value: {
          show: false
        }
      },
      hollow: {
        margin: 7,
        size: '20%'
      },
      track: {
        strokeWidth: '60%',
        opacity: 1,
        margin: 16
      }
    }
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      type: 'horizontal',
      shadeIntensity: 0.5,
      inverseColors: true,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 100]
    }
  },
  stroke: {
    lineCap: 'round'
  },
  colors: barchartColors,
  labels: ['Product A', 'Product B', 'Product C'],
  legend: {
    show: true,
    floating: true,
    fontSize: '16px',
    position: 'left',
    offsetX: -24,
    offsetY: 15,
    labels: {
      useSeriesColors: true
    },
    markers: {
      size: 0
    },
    formatter: function formatter(seriesName, opts) {
      return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
    },
    itemMargin: {
      vertical: 3
    }
  },
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        show: false
      }
    }
  }]
};
var chart = new ApexCharts(document.querySelector("#chart-radialBar"), options);
chart.render();
/******/ })()
;