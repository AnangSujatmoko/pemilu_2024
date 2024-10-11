/* global Chart:false */

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI','JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [2,4,7,11,10, 20, 30, 25, 27, 25, 30,12]
        }

      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  //-------------
  // - PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
      'Injury',
      'Infrastruktur',
      'Suprastruktur',
      'Fatality',
      'Pencemaran Lingkungan'
    ],
    datasets: [
      {
        data: [700, 500, 400, 600, 300],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  //-----------------
  // - END PIE CHART -
  //-----------------

  //-------------
  // - PIE CHART2 -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
  var pieData2 = {
    labels: [
      'Ringan',
      'Sedang',
      'Berat',
      'Fatality'
    ],
    datasets: [
      {
        data: [70, 20, 40, 60],
        backgroundColor: ['#3c8dbc', '#00a65a', '#f56954', '#f39c12']
      }
    ]
  }
  var pieOptions2 = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart2 = new Chart(pieChartCanvas2, {
    type: 'pie',
    data: pieData2,
    options: pieOptions2
  })

  //-----------------
  // - END PIE CHART -
  //-----------------

  //-------------
  // - PIE CHART3 -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas3 = $('#pieChart3').get(0).getContext('2d')
  var pieData3 = {
    labels: [
      'Shift 1',
      'Shift 2',
      'Shift 3'
    ],
    datasets: [
      {
        data: [11, 9, 3],
        backgroundColor: ['#3c8dbc', '#00a65a', '#f56954']
      }
    ]
  }
  var pieOptions3 = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart3 = new Chart(pieChartCanvas3, {
    type: 'doughnut',
    data: pieData3,
    options: pieOptions3
  })

  //-----------------
  // - END PIE CHART 3 -
  //-----------------


 //-------------
  // - PIE CHART 4 -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas4 = $('#pieChart4').get(0).getContext('2d')
  var pieData4 = {
    labels: [
      'unSafe Action',
      'unSafe Condition'
    ],
    datasets: [
      {
        data: [74, 26],
        backgroundColor: ['#3c8dbc', '#00a65a']
      }
    ]
  }
  var pieOptions4 = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart4 = new Chart(pieChartCanvas4, {
    type: 'pie',
    data: pieData4,
    options: pieOptions4
  })

  //-----------------
  // - END PIE CHART 4 -
  //-----------------  



//kegiatan

var $kegiatanchart = $('#kegiatan-chart')
  // eslint-disable-next-line no-unused-vars
  var kegiatanchart = new Chart($kegiatanchart, {
    type: 'bar',
    data: {
      labels: ['Curah Cair', 'Maintenance', 'Curah Kering', 'General Cargo', 'Receiving/Delivery'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [2, 3, 5, 7, 4]
        }

      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })



//kegiatan

//-------------
  // - PIE CHART30 -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas30 = $('#pieChart30').get(0).getContext('2d')
  var pieData30 = {
    labels: [
      'SPMT Group',
      'non SPMT',
      'Regional'
    ],
    datasets: [
      {
        data: [24, 7, 1],
        backgroundColor: ['#3c8dbc', '#00a65a', '#f56954']
      }
    ]
  }
  var pieOptions30 = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart3 = new Chart(pieChartCanvas30, {
    type: 'doughnut',
    data: pieData30,
    options: pieOptions30
  })

  //-----------------
  // - END PIE CHART 3 -
  //-----------------


 //-------------
  // - PIE CHART 4 -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas40 = $('#pieChart40').get(0).getContext('2d')
  var pieData40 = {
    labels: [
      'Open',
      'Closed'
    ],
    datasets: [
      {
        data: [85, 15],
        backgroundColor: ['#3c8dbc', '#00a65a']
      }
    ]
  }
  var pieOptions40 = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart40 = new Chart(pieChartCanvas40, {
    type: 'pie',
    data: pieData40,
    options: pieOptions40
  })

  //-----------------
  // - END PIE CHART 4 -
  //-----------------  

})

// lgtm [js/unused-local-variable]
