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

function inputPassword() {
    var b = document.getElementById('password');

    if (b.value.length < 4) {
      b.style.borderLeft = '3px solid red';
    }

    else {
      b.style.borderLeft = '3px solid green';
    }
}

function inputPasswordRepeat() {
    var b = document.getElementById('password');
    var b2 = document.getElementById('password_repeat');

    if (b2.value != b.value) {
      b2.style.borderLeft = '3px solid red';
    }

    else {
      b2.style.borderLeft = '3px solid green';
    }
}

function inputEmail() {
    var xmlhttp = new XMLHttpRequest();

    var c = document.getElementById('email');

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            var results = document.getElementById('email_exists');
            if (xmlhttp.responseText == c.value) {
                results.innerHTML = 'E-postadressen är upptagen';
                c.style.borderLeft = '3px solid red';
            }
            if (xmlhttp.responseText != c.value) {
                results.innerHTML = 'E-postadressen är ledig';
                c.style.borderLeft = '3px solid green';
            }
            if (c.value.length == 0) {
              results.innerHTML = 'Fyll i e-postadress';
                c.style.borderLeft = '3px solid red';
            }
        }
    }

    xmlhttp.open('GET', 'functions/check_if_email_exists.php?email=' + c.value + '', true);
    xmlhttp.send();

}

function checkAllInputs() {
    var a = document.getElementById('user').value;
    var b = document.getElementById('password').value;
    var b2 = document.getElementById('password_repeat').value;
    var c = document.getElementById('email').value;
    var d = document.getElementById('submit');

    if (a.length == 0) {
      d.disabled = true;
      d.style.cursor = 'not-allowed';
    }

    if (b.length == 0) {
      d.disabled = true;
      d.style.cursor = 'not-allowed';
    }

    if (b2 !== b) {
      d.disabled = true;
      d.style.cursor = 'not-allowed';
    }

    if (c.length == 0) {
      d.disabled = true;
      d.style.cursor = 'not-allowed';
    }

    else {
      d.disabled = false;
      d.style.cursor = 'pointer';
    }
}