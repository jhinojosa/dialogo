
$(document).ready(function() {
    
    /**
     *  Se valida el ingreso de un nuevo diálogo, el evento podría ser 
     * reemplazado y también los selectores
     */

    // Se obtiene el offset del elemento de alerta oculto
    var $alert = $('#nuevo-dialogo-alert');
    var top = ($alert.size() > 0)? ($alert.offset().top - 80) : 0;
    $('#publicar-dialogo').on('click', function(e) {
        // borrar la siguiente linea para implementar
        e.preventDefault();
        $('#nuevo-dialogo-pane input, #nuevo-dialogo-pane textarea').each(function(){
            if ( $(this).val().split(' ').join('') === '' ) {
                $alert.fadeIn(200, function() {
                    $('html,body').animate({scrollTop:top + 'px'}, 400, function() {
                        $alert.delay(7000).fadeOut(400);
                        return false;
                    });
                });
            }
        });
        return false;
    });
    $('#nuevo-dialogo-alert').fadeOut(0);

    $(document).keydown(function(event) {
        if (event.which == 17) {
            event.preventDefault();
            $('#menu-bar span').css({
                //'font-weight':'bolder',
                'border-bottom':'solid 1px #333'
            });
        }
    });
    $(document).keyup(function(event) {
        if (event.which == 17) {
            event.preventDefault();
            $('#menu-bar span').css({
                //'font-weight':'bolder',
                'border-bottom':'none'
            });
        }
    });
});


