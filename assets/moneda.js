// require jQuery normally
const $ = require('jquery');
// create global $ and jQuery variables
global.$ = global.jQuery = $;
import 'jquery-confirm';

$('#convertir').click(function(){
    $("#consultando").show();
    var url = $("#api").data('url');
    $.ajax({
        method:'GET',
        url: "http://data.fixer.io/api/convert?access_key=b8149ed19d6c71e0549820b9156058fb&from="+$("#moneda").val()+"&to="+$("#destino").val()+"&amount="+$("#importe_original").val()+"&date="+$("#fecha").val(),
        dataType: 'jsonp',
        success: function(monedas) {
            $("#consultando").hide();
            console.info(monedas);
        }
    });
});
