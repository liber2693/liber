$(document).ready(function() {

	listar_archivos_update($("#codigo_docu").val());


	$("#enviar_actualizacion").submit(function(event){
		//console.log("hola");

        $('#actualizar_documento').attr("disabled", true);

        var expedidor = $("#expedidor").val().trim();
        var fecha = $("#fecha").val().trim();
        var id_origen = $("#id_origen").val().trim();
        var id_destino = $("#id_destino").val().trim();


        if (expedidor.length=='') {
            $("#expedidor").css({"border":"2px solid #ff3333"});
            $('#actualizar_documento').attr("disabled", false);
            event.preventDefault();
        }else{
            $("#expedidor").css({"border":"1px solid #c7c7cc"});
        }

        if (fecha.length=='') {
            $("#fecha").css({"border":"2px solid #ff3333"});
            $('#actualizar_documento').attr("disabled", false);
            return false;
        }else{
            $("#fecha").css({"border":"1px solid #c7c7cc"});
        }


        if (id_origen==0) {
            $("#id_origen").css({"border":"2px solid #ff3333"});
            $('#actualizar_documento').attr("disabled", false);
            return false;
        }else{
            $("#id_origen").css({"border":"1px solid #c7c7cc"});
        }

        if (id_destino==0) {
            $("#id_destino").css({"border":"2px solid #ff3333"});
            $('#actualizar_documento').attr("disabled", false);
            return false;
        }else{
            $("#id_destino").css({"border":"1px solid #c7c7cc"});
        }

    });
})

function llenar_paises(idO,idD){
    var url_origen = '../controllers/paisesControllers.php?origen='+idO+'';
    var url_destino = '../controllers/paisesControllers.php?destino='+idD+'';

    $("#pais_origen_Actualizacion").load(url_origen);
    $("#pais_destino_Actualizacion").load(url_destino);

}
//*********ACTUALZIAR IMAGEN********//

function listar_archivos_update(codigo_d){
	$("#lista_archivo > tbody:last").children().remove();
	i=0;
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "../controllers/documentoControllers.php",
        data: { 'codigo_docket_lista' : codigo_d},
        success: function(data){
            var lista = data;
            if(lista==0){
                $("#lista_archivo").append(
                '<tr>'+
                '<td colspan="4" class="text-center"><b>Services are not available yet</b></td>'+
                '</tr>');
            }else{
                lista.forEach( function(data, indice, array) {
                	i++
                    $("#lista_archivo").append(
                    '<tr>'+
                    '<td><b>'+i+'</b></td>'+
                    '<td><a href="'+data.url_ubicacion+'" target="_blank"><b>'+data.nombre_archivo+'</b></a></td>'+
                    '<td><button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminar_archivo('+data.id+')"><i class="fa fa-minus" aria-hidden="true"></i></td>'+
                    '</tr>');
                });
            }
        }
    })
}

$("#nuevo_archivo").click(function(){
    console.log("nueva imagem");
    $("#codigo_documento").val($("#codigo_docu").val());
})

//confirmar para subir imagen
$("#boton_registrar").click(function(){
    console.log("subir iamgen");

    var codigo_d = $("#codigo_documento").val();
    var inputArchivo = document.getElementById('imagen');    
    var file = inputArchivo.files[0];
    
    var data = new FormData();
    data.append('archivo',file);
    data.append('codigo_docket',codigo_d);
    
    var archivo = $("#imagen").val();
    console.log(archivo);
    
   //variable para validar

    $("#imagen").css({"border":"1px solid #c7c7cc"});

    if (archivo == '') {
        $("#imagen").css({"border":"2px solid #ff3333"});
        event.preventDefault();
    }
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controllers/documentoControllers.php",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if(data==1){
                console.log("se subio y guardo con existo");
                $("#myModal").modal("hide");
                limpiar_campos();
                //$("#boton_registrar").attr("data-dismiss","modal");
                listar_archivos_update(codigo_d);
            }
        }
    })
})
//limpia los campos
function limpiar_campos(){

    $(".limpiar").val("");
    $("#imagen").val("");
}

function eliminar_archivo(id){
	console.log("este archivo se va a eliminar: "+id)
	var codigo_d = $("#codigo_docu").val()
	$.ajax({
        type: "POST",
        dataType: "json",
        url: "../controllers/documentoControllers.php",
        data: { 'id_archivo' : id},
        success: function(data){
        	if(data==1){
                console.log("elimino registro");
                listar_archivos_update(codigo_d);
            }
        }
    })

}