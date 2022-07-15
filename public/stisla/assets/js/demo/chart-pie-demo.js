// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
$.get('http://1805049.web.ti.polindra.ac.id/dashboard/chart/imunisasi',(imunisasiChart,colours) =>{
  var ctx = document.getElementById("imunisasiChart");

  var data = imunisasiChart.map(function(e) {
    return e.count;
 });;
 var nama = imunisasiChart.map(function(e) {
  return e.nama;
});;
 
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: nama,
      datasets: [{
        data: data,
        backgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        //hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
});