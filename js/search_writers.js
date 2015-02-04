function loadContent() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            var results = document.getElementById('results');
            results.innerHTML = xmlhttp.responseText;
        }
    }

    var input = document.getElementById('search');
    input = input.value;

    xmlhttp.open('GET', 'functions/search_writers.php?username=' + input + '', true);
    xmlhttp.send();

    results.innerHTML = 'Laddar..';
}