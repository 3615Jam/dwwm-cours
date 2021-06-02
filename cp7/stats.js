// on branche un écouteur d'évènements de type 'change' sur 'emp'
document.getElementById('emp').addEventListener('change', redrawChart);
    
// pareil sur 'year'
document.getElementById('year').addEventListener('change', redrawChart);

// on change la source de 'chart.php' avec les paramètres dans URL
function redrawChart() {
    document.getElementById('chart').src = 'chart.php?e=' + document.getElementById('emp').value + '&a=' + document.getElementById('year').value;
}
