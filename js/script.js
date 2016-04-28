var tempChartEl = document.getElementById("temp").getContext("2d");
var humidityChartEl = document.getElementById("humidity").getContext("2d");
var tempChart = new Chart(tempChartEl, {
    type: 'line',
    data: {
        labels: data.time,
        datasets: [{
            label: 'Temperatur',
            data: data.temp
        }]
    }
});
var humidityChart = new Chart(humidityChartEl, {
    type: 'line',
    data: {
        labels: data.time,
        datasets: [{
            label: 'Luftfeuchtigkeit',
            data: data.humidity
        }]
    }
});
