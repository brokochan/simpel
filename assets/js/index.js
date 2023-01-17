$(function() {

      // chart1
      var ctx = document.getElementById('chart1').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
              labels: ['NIB'],
              datasets: [{
                  data: [1283],
                  backgroundColor: [
                      '#32bfff',
                  ],
                  borderWidth: 1
              }]
          },
          options: {
             maintainAspectRatio: false,
             cutout: 125,
             plugins: {
                legend: {
                    display: false,
                }
            }
             
          }
      });
    

      // chart2
      var ctx = document.getElementById('chart2').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
              labels: ['Trayek', 'SIPP', 'SIPB', 'SIPA'],
              datasets: [{
                  data: [200, 150, 100, 80],
                  backgroundColor: [
                      '#923eb9',
                      '#f73757',
                      '#18bb6b',
                      '#32bfff'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
             maintainAspectRatio: false,
             cutout: 125,
             plugins: {
                legend: {
                    display: false,
                }
            }
             
          }
      });


  
    
});