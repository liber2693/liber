$(document).ready(function() {
    var url_paise = '../controllers/paisesControllers.php';
    $("#pais_origen").load(url_paise);
    $("#pais_destino").load(url_paise);
    $("#pais_origenE").load(url_paise);
    $("#pais_destinoE").load(url_paise);
	//formulario de exportacion
    $("#importacion").submit(function(event) {
		//event.preventDefault();

        $('#enviar_documento_import').attr("disabled", true);

        var shipper = $('#shipper').val();
        var fecha = $('#fecha').val();
        var pais_origen = $("#pais_origen").val();
        var pais_destino = $("#pais_destino").val();

        if (shipper=='') {
    		$("#shipper").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_import').attr("disabled", false);
           event.preventDefault();
    	}else{
    		$("#shipper").css({"border":"0"});
    	}
    	if (fecha=='') {
    		$("#fecha").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_import').attr("disabled", false);
            event.preventDefault();
    	}else{
    		$("#fecha").css({"border":"0"});
    	}
        if (pais_origen==0) {
            $("#pais_origen").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_import').attr("disabled", false);
            event.preventDefault();
        }else{
            $("#pais_origen").css({"border":"0"});
        }
        if (pais_destino==0) {
            $("#pais_destino").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_import').attr("disabled", false);
            event.preventDefault();
        }else{
            $("#pais_destino").css({"border":"0"});
        }


    });

    $("#exportacion").submit(function(event) {
        //event.preventDefault();
        $('#enviar_documento_export').attr("disabled", true);

        var shipper = $('#shipperE').val();
        var fecha = $('#fechaE').val();
        var pais_origen = $("#pais_origenE").val();
        var pais_destino = $("#pais_destinoE").val();



        if (shipper=='') {
            $("#shipperE").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_export').attr("disabled", false);
           event.preventDefault();
        }else{
            $("#shipperE").css({"border":"0"});
        }
        if (fecha=='') {
            $("#fechaE").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_export').attr("disabled", false);
            event.preventDefault();
        }else{
            $("#fechaE").css({"border":"0"});
        }

        if (pais_origen==0) {
            $("#pais_origenE").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_export').attr("disabled", false);
            event.preventDefault();
        }else{
            $("#pais_origenE").css({"border":"0"});
        }
        if (pais_destino==0) {
            $("#pais_destinoE").css({"border":"2px solid #ff3333"});
            $('#enviar_documento_export').attr("disabled", false);
            event.preventDefault();
        }else{
            $("#pais_destinoE").css({"border":"0"});
        }

    });

    

    
});




function format(input)
{
    var num = input.value.replace(/\./g,'');
        if(!isNaN(num)){
              num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
              num = num.split('').reverse().join('').replace(/^[\.]/,'');
              input.value = num;
            }

        else{
          alert('Solo se permiten numeros');
          input.value = input.value.replace(/[^\d\.]*/g,'');
        }
//<input type="text" onkeyup="format(this)" onchange="format(this)">

}
