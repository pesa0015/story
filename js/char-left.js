$(document).ready(function() {
            $('#app').keyup(function() {
                var len = this.value.length;
                if (len >= 50) {
                    this.value = this.value.substring(0, 50);
                }
                $('#charLeft').text(50 - len);
            });
        });