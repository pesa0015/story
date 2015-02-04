function loadContent() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            var results = document.getElementById('results');
            results.innerHTML = xmlhttp.responseText;

            if (results.innerHTML.length == 0) {
                document.getElementById('search').setAttribute('name', 'new_subject');
            }

            else {
                document.getElementById('search').setAttribute('name', 'subject');
            }
        }
    }

    var input = document.getElementById('search');
    input = input.value;

    xmlhttp.open('GET', 'functions/search_subjects.php?subject=' + input + '', true);
    xmlhttp.send();

}