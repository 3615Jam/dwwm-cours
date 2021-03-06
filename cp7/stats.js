// on branche un écouteur d'évènements de type 'change' sur 'year'
document.getElementById('year').addEventListener(
    'change',
    redrawChart
);

// pareil sur 'emp'
document.getElementById('emp').addEventListener(
    'change',
    redrawChart
);

// on change la source de 'chart.php' avec les paramètres dans URL
function redrawChart() {
    let eYear = document.getElementById('year');
    let eEmp = document.getElementById('emp');
    let eChart = document.getElementById('chart');
    eChart.src = 'chart.php?e=' + eEmp.value + '&a=' + eYear.value;
}