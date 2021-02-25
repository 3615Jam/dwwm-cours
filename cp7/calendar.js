// execute une requête AJAX pour lire la BDD

document.addEventListener("DOMContentLoaded", function () {
    let xhr = new XMLHttpRequest();
    xhr.open('get', 'calendar_data.php')
    xhr.send();
    xhr.addEventListener('readystatechange', function(){
        if ((xhr.status === 200 || xhr.status === 0) && xhr.readyState === 4) {
            let eCal = document.getElementById('calendar');
            let oCal = new FullCalendar.Calendar(eCal, {
                locale: "fr",
                events: JSON.parse(xhr.responseText) 
            });
            oCal.render();
        }
    });
});
