$(function() {

   
// chart1
var ctx = document.getElementById('chart1').getContext('2d');

var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#005bea');
    gradientStroke1.addColorStop(1, '#00c6fb');

var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#ff6a00');  
    gradientStroke2.addColorStop(1, '#ee0979'); 

var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke3.addColorStop(0, '#17ad37');  
    gradientStroke3.addColorStop(1, '#98ec2d'); 

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['NIB'],
        datasets: [{
            data: [1283],
            backgroundColor: [
                gradientStroke1,
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        cutout: 110,
        plugins: {
        legend: {
            display: false,
        }
    }
        
    }
});
   
// chart2
var ctx = document.getElementById('chart2').getContext('2d');

var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#005bea');
    gradientStroke1.addColorStop(1, '#00c6fb');

var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#FC2F8C'); 
    gradientStroke2.addColorStop(1, '#FC2F2F');  

var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke3.addColorStop(0, '#17ad37');  
    gradientStroke3.addColorStop(1, '#98ec2d'); 

var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke4.addColorStop(0, '#FF5733');  
    gradientStroke4.addColorStop(1, '#FFB447'); 

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Trayek', 'SIPP', 'SIPB', 'SIPA'],
        datasets: [{
            data: [155, 120, 110, 100],
            backgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
                gradientStroke4,
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        cutout: 110,
        plugins: {
        legend: {
            display: false,
        }
    }
        
    }
});




  
    
});