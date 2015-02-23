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