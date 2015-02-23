function inputPassword() {
    var b = document.getElementById('password');

    if (b.value.length < 4) {
      b.style.borderLeft = '3px solid red';
    }

    else {
      b.style.borderLeft = '3px solid green';
    }
  }