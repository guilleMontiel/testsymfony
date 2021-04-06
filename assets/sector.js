// require jQuery normally
const $ = require('jquery');
// create global $ and jQuery variables
global.$ = global.jQuery = $;
import 'jquery-confirm';

$('.deleteLink').click(function(){
    
    var nombre = $(this).data('nombreSector');
    var url = $(this).data('url');
    $.confirm({
        title: '¡Atencion!',
        type: 'red',
        content: '¿Eliminar el sector '+nombre+'?',
        theme:'material',
        buttons: {
            confirmar: {
                text: 'Confirmar',
                btnClass: 'btn btn-success',
                action: function () {
                    window.location.href =  url;
                },
            },
            cancelar:{
                text: 'Cancelar',
                btnClass: 'btn btn-danger',
                action: function () {
                    
                },
            }        
        }
    });
});

$("#sector_Cancelar").click(function(){
     window.location.href =  '/sector';
});

$("#cliente_sector_Cancelar").click(function(){
     window.location.href =  '/sector';
});
