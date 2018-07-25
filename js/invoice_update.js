$(document).ready(function() {
	//mascara de cifra con puntos(.) y comas(,)
	$("#dinero_us").maskMoney();
	$("#dinero_cad").maskMoney();
    //campo de actualizar
    $("#pago_supplier").maskMoney();
	//busca los servicios
	var tipo = $('#tipo').val();
	var settings = {
        "async": true,
        "crossDomain": true,
        "url": "../controllers/serviciosControllers.php",
        "metdod": "GET",
        "dataType" : "json",
        "data" : {
        	"tipo": tipo
        } 
    }
    $.ajax(settings).done(function (response) {
        var lista = response;
        lista.forEach( function(data, indice, array) {
          $("#lista_servicios").append("<option value="+data.id+">"+data.descripcion+"</option> ")
          //$("#Actualizar_benf_tipo_articulo").append("<option value="+data.id+">"+data.business_name+"</option> ")
        });
    });

    mostarLista();
    listaSupplier();

    //seleccion del tipo de moneda, como se va pagar
    $("#us_dolar").click(function(){
    	$("#campo_us").removeClass("ocultar");
    	$("#campo_cad").addClass("ocultar");
    	$("#dinero_us").focus();
    	$("#dinero_cad").val("");
    });
	$("#cad_dolar").click(function(){
    	$("#campo_cad").removeClass("ocultar");
    	$("#campo_us").addClass("ocultar");
    	$("#dinero_cad").focus();
    	$("#dinero_us").val("");
    });

	$("#guardar_servicio").click(function(){
		//borrar los tr de la tabla menos la primera fila 
		
		//$('#seleccion_servicios_tabla').append('tr').not(':first').remove();
		//validar campos del pequeño fomulario
		var servicio = $("#lista_servicios").val();	
		var dinero_us = $("#dinero_us").val();	
		var dinero_cad = $("#dinero_cad").val();	
		var nota = $("#nota").val();	
		var codigo_factura = $("#codigo_invoice").val();
		var usuario_documento = $("#usuario_documento").val();
		
		
		if (servicio==0) {
    		$("#lista_servicios").css({"border":"2px solid #ff3333"});
	       event.preventDefault();
    	}else{
    		$("#lista_servicios").css({"border":"1px solid #c7c7cc"});
    	}
		
		if ($('input[name="bill_to"]').is(':checked')) {
	     	$("#radio1").css({"border":"0"});
	    	$("#radio2").css({"border":"0"});
	    } else {
	        $("#radio1").css({"border":"2px solid #ff3333"});
	        $("#radio2").css({"border":"2px solid #ff3333"});
	        event.preventDefault();
	    }

	    if((servicio!=0) && (dinero_us.length>0) || (dinero_cad.length>0)){
        	$("#seleccion_servicios_tabla > tbody:last").children().remove();
	    	$.ajax({
                type: "POST",
                dataType: "json",
                url: "../controllers/invoiceControllers.php",
                data: {'servicio_update' : servicio,
                	   'dinero_us' : dinero_us,
                	   'dinero_cad': dinero_cad,
                	   'nota' : nota,
                	   'codigo_factura' : codigo_factura,
                	   'usuario_documento' : usuario_documento },
                success: function(data){
                	var lista = data;

                	if(lista==0){
                		$("#seleccion_servicios_tabla").append(
                  		'<tr>'+
                    	'<td colspan="5" class="text-center">tdere are no services available</td>'+
                    	'</tr>');
                    	$('#enviar_update_invoice').attr("disabled", true);
                	}else{
	                	lista.forEach( function(data, indice, array) {
				        	$("#seleccion_servicios_tabla").append(
	                  		'<tr>'+
	                    	'<td>'+data.codigo_ser+'</td>'+
	                    	'<td>'+data.descripcion+'</td>'+
	                    	'<td>'+data.nota+'</td>'+
	                    	'<td>'+data.precio_us+'</td>'+
	                    	'<td>'+data.precio_ca+'</td>'+
	                    	'<td><button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminar('+data.id+')"><i class="fa fa-minus" aria-hidden="true"></i></td>'+
	                  		'</tr>');
	                  		$('#enviar_update_invoice').attr("disabled", false);
				        });
                	}
                    limpiar_campos(); 
				}
	    	})
	    }else{
            $("#mensaje_actulaizacion_servicios").addClass("alert alert-block alert-danger fade in text-center").html("<strong>Disculpa!</strong> Debe llenar el campo");
            setTimeout(function() {
            $("#mensaje_actulaizacion_servicios").removeClass().empty();
        },3000);
        }
	});


    //mostrar el campo otro caundo selecciona el 6 
    $('input[type=checkbox]').on('change', function() {
        var valor = $(this).val();

        if ($(this).is(':checked') && valor==6) {
            $("#campo_otro").removeClass("ocultar");
        } else {
            $("#campo_otro").addClass("ocultar");
        }
    });

    //enviar el formulario para que actualize eñ registro del invoice
    $("#update_invoice").submit(function(event) {
        
        var quien_paga = $("#quien_paga").val();

        if (quien_paga=='') {
            $("#quien_paga").css({"border":"2px solid #ff3333"});
            event.preventDefault();
        }else{
            $("#quien_paga").css({"border":"1px solid #c7c7cc"});
        }
        
        //validare que el envio este seleccionado
        var check = $("input[type='checkbox']:checked").length;
        if(check == ""){
            $("#mensaje_create_invoice").addClass("alert alert-block alert-danger fade in text-center").html("<strong>Disculpa!</strong> Debe seleccionar un tipo de envio");
            setTimeout(function() {
                $("#mensaje_create_invoice").removeClass().empty();
            },3000);
            $("#via_envio").css({"border":"2px solid #ff3333"});
           event.preventDefault();
        }else{
            $("#via_envio").css({"border":"0"});
        }
    });
	  
});

function mostarLista(){
	var codigo_invoice = $("#codigo_invoice").val();
	//borrar los tr de la tabla menos la primera fila 
	$("#seleccion_servicios_tabla > tbody:last").children().remove();
	//llenar la tabla si existen servicios por este documento
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "../controllers/invoiceControllers.php",
        data: {'tabla' : 4,
        	   'codigo_invoice' : codigo_invoice 
              },
        success: function(data){
        	var lista = data;
        	if(lista==0){
        		$("#seleccion_servicios_tabla").append(
          		'<tr>'+
            	'<td colspan="5" class="text-center">tdere are no services available</td>'+
            	'</tr>');
            	$('#enviar_update_invoice').attr("disabled", true);
        	}else{
            	lista.forEach( function(data, indice, array) {
		        	$("#seleccion_servicios_tabla").append(
              		'<tr>'+
                	'<td>'+data.codigo_ser+'</td>'+
                	'<td>'+data.descripcion+'</td>'+
                	'<td>'+data.nota+'</td>'+
                	'<td>'+data.precio_us+'</td>'+
                	'<td>'+data.precio_ca+'</td>'+
                	'<td><button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminar('+data.id+')"><i class="fa fa-minus" aria-hidden="true"></i></td>'+
              		'</tr>');
		        	$('#enviar_update_invoice').attr("disabled", false);
            	});
        	}
		}
	})
} 

function eliminar(id){
	console.log(id);
	$("#seleccion_servicios_tabla > tbody:last").children().remove();
	//llenar la tabla si existen servicios por este documento
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controllers/invoiceControllers.php",
        data: {'id_eliminar' : id},
        success: function(data){
        	var lista = data;
        	if(lista==3){
        		mostarLista()
        	}else{
            	console.log(id)
        	}
		}
	})
}

//actualizar supplier
function registrarSupplier(){
    var supplier = $("#supplierActualizar").val().trim();
    var codigo_invoice = $("#codigo_invoice").val();
    var usuario_documento = $("#usuario_documento").val();
    var pago_supplier = $("#pago_supplier").val();

    if (supplier.length==0) {
        $("#supplierActualizar").css({"border":"2px solid #ff3333"});
        event.preventDefault();
    }else{
        $("#supplierActualizar").css({"border":"1px solid #c7c7cc"});
    }

    if (pago_supplier.length==0) {
        $("#pago_supplier").css({"border":"2px solid #ff3333"});
        event.preventDefault();
    }else{
        $("#pago_supplier").css({"border":"1px solid #c7c7cc"});
    }

    if(supplier.length > 0 && pago_supplier.length > 0){
        //console.log(supplier,codigo_invoice,usuario_documento,pago_supplier);
        //return false;
        //borrar los tr de la tabla menos la primera fila 
        $("#seleccion_supplier > tbody:last").children().remove();
        //llenar la tabla si existen servicios por este documento
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "../controllers/invoiceControllers.php",
            data: {'tabla' : 2,
                   'supplier' : supplier,
                   'codigo_invoice' : codigo_invoice,
                   'usuario_documento' : usuario_documento,
                   'pago_supplier' : pago_supplier },
            success: function(data){
                var lista = data;
                if(lista==0){
                    $("#seleccion_supplier").append(
                    '<tr>'+
                    '<td colspan="3" class="text-center">tdere are no services available</td>'+
                    '</tr>');
                    $('#enviar_update_invoice').attr("disabled", true);
                }else{
                    lista.forEach( function(data, indice, array) {
                        $("#seleccion_supplier").append(
                        '<tr>'+
                        '<td>'+data.supplier+'</td>'+
                        '<td>'+data.dinero+'</td>'+
                        '<td><button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminarSupplier('+data.id+')"><i class="fa fa-minus" aria-hidden="true"></i></td>'+
                        '</tr>');
                        $('#enviar_update_invoice').attr("disabled", false);
                    });
                }
                //limpiar_campo
                limpiar_campos();
            }
        })
    }else{
        $("#mensaje_actulaizacion_invoice_supplier").addClass("alert alert-block alert-danger fade in text-center").html("<strong>Disculpa!</strong> Debe llenar el campo");
        setTimeout(function() {
            $("#mensaje_actulaizacion_invoice_supplier").removeClass().empty();
        },3000);
    }
    
} 

//mostrar lista de supplier ya exitente

function listaSupplier(){
  
    var codigo_invoice = $("#codigo_invoice").val();
    //borrar los tr de la tabla menos la primera fila 
    $("#seleccion_supplier > tbody:last").children().remove();
    //llenar la tabla si existen servicios por este documento
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "../controllers/invoiceControllers.php",
        data: {'tabla' : 3,
               'codigo_invoice' : codigo_invoice
               },
        success: function(data){
            var lista = data;
            if(lista==0){
                $("#seleccion_supplier").append(
                '<tr>'+
                '<td colspan="3" class="text-center">tdere are no services available</td>'+
                '</tr>');
                $('#enviar_update_invoice').attr("disabled", true);
            }else{
                lista.forEach( function(data, indice, array) {
                    $("#seleccion_supplier").append(
                    '<tr>'+
                    '<td>'+data.supplier+'</td>'+
                    '<td>'+data.dinero+'</td>'+
                    '<td><button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminarSupplier('+data.id+')"><i class="fa fa-minus" aria-hidden="true"></i></td>'+
                    '</tr>');
                    $('#enviar_update_invoice').attr("disabled", false);
                });
            }
        }
    })
} 
//eliminar supplier de un invoice

function eliminarSupplier(id){
    $("#seleccion_supplier > tbody:last").children().remove();
    //llenar la tabla si existen servicios por este documento
    console.log(id);
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "../controllers/invoiceControllers.php",
        data: {'id_supplier' : id},
        success: function(data){
            var lista = data;
            if(lista==4){
                listaSupplier()
            }else{
                console.log(id)
            }
        }
    })
}

function limpiar_campos(){

    $(".limpiar").val("");
}

