var tempChartEl = document.getElementById("temp").getContext("2d");
var humidityChartEl = document.getElementById("humidity").getContext("2d");
var tempChart = new Chart(tempChartEl, {
    type: 'line',
    data: {
        labels: data.time,
        datasets: [{
            label: 'Temperatur',
            data: data.temp,
            backgroundColor: 'rgba(255,0,0,0.2)',
            borderColor: '#f00',
            pointBackgroundColor: '#f00'
        }]
    }
});
var humidityChart = new Chart(humidityChartEl, {
    type: 'line',
    data: {
        labels: data.time,
        datasets: [{
            label: 'Luftfeuchtigkeit',
            data: data.humidity,
            backgroundColor: 'rgba(0,0,255,0.2)',
            borderColor: '#35d',
            pointBackgroundColor: '#35d'
        }]
    }
});
