function inputUser() {
    var xmlhttp = new XMLHttpRequest();

    var input = document.getElementById('user');

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            var results = document.getElementById('user_exists');
            if (xmlhttp.responseText == input.value) {
                results.innerHTML = xmlhttp.responseText + ' är upptaget';
                input.style.borderLeft = '3px solid red';
            }
            if (xmlhttp.responseText != input.value) {
                results.innerHTML = 'Användarnamnet är ledigt';
                input.style.borderLeft = '3px solid green';
            }
            if (input.value.length == 0) {
                results.innerHTML = 'Fyll i användarnamn';
                input.style.borderLeft = '3px solid red';
            }
        }
    }

    xmlhttp.open('GET', 'functions/check_if_user_exists.php?username=' + input.value + '', true);
    xmlhttp.send();

}