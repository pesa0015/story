function generate(type) {
        var n = noty({
            text        : 'Ny story har påbörjats',
            type        : 'success',
            dismissQueue: false,
            layout      : 'topCenter',
            theme       : 'defaultTheme'
        });
        console.log(type + ' - ' + n.options.id);
        return n;
    }

    $(document).ready(function () {

        var success = generate('');
        
        setTimeout(function () {
            $.noty.close(success.options.id);
        }, 2500);

    });