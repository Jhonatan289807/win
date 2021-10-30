window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
let tblped = $('#tbl-ped').DataTable({'language':Idioma()});
$('.btn-cerrar').click(function(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op' : 10},
        dataType:'JSON',
        success:function(reponse){
            $(location).attr('href','../index.php');
        }
    });
});
$('.btn-agregar').click(function(e){
    let tipo = $("#slt-equip").val();
    let equip = $("#slt-equip").find(":selected").text();
    let cant = $(".txt-cant").val();
    if(tipo != 0 && cant>0){
        e.preventDefault();
        let data = {
            'id'   : tipo,
            'prod' : equip,
            'cant' : cant
        }
        AgregarPed(data).then(function(response){
            if(response == true){
                CargarPed();
                alertify.success("AVISO: Se agregó el equipo");
            }
        },function(error){
            console.log(error);
            alertify.error("Ocurrio un error al agregar");
        });
        limpiarFormPed();
    }else if(tipo==0){
        e.preventDefault();
        $('.p-aviso').html("Por favor, seleccione el tipo de equipo");
        $('#modal-alert-car').modal('toggle');
    }else if(cant == 0){
        e.preventDefault();
        $('.p-aviso').html("AVISO: No se ha definido una cantidad");
        $('#modal-alert-car').modal('toggle');
    }
});
$(document).on('click','.btn-eliminar',function(){
    let id = $(this).data('id');
    EliminarPed(id);
});
$('.btn-enviar').click(function(){
    enviarPedido();
});
function CargarEquipos(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':23},
        dataType:'JSON',
        success:function(data){
            let slt = document.getElementById("slt-equip");
            let options = "<option value='0'>Seleccione una opción</option>"
            $.each(data,function(){
                options+="<option value='"+this['id']+"'>"+this['prod']+"</option>";
            });
            slt.insertAdjacentHTML('beforeend', options);
        }
    });
}
function AgregarPed(data){
    return new Promise(function(success,error){
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':24,'data':data},
            dataType:'JSON',
            success:function(response){
                success(response);
            },error:function(response){
                error(response);
            }
        });  
    })
}
function EliminarPed(id){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':26, 'id':id},
        dataType:'JSON',
        success:function(response){
            if(response){
                CargarPed();
            }
        },error:function(){
            alertify.error("Ocurrio un error al eliminar");
        }
    })
}
function CargarPed(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':25},
        dataType:'JSON',
        success:function(data){
            if(data == false){
                limpiarTablaPed();
                $('.span-cant').html("0");
                $('.btn-enviar').hide();
            }else{
                CargarTablaPed(data);
            }
        },error:function(){
            alertify.error("Ocurrio un al cargar los pedidos");
        }
    });
}
function CargarTablaPed(data){
    limpiarTablaPed();
    let cont = 1;
    let cant = 0;
    $.each(data,function(){
        tblped.row.add([
            cont,
            this['prod'],
            this['cant'],
            "<button class='btn btn-danger btn-eliminar' data-id='"+this['id']+"'>Eliminar</button>"
        ]).draw(false);
        cont++;
        cant = cant + parseInt(this['cant']);
    });
    $('.span-cant').html(cant);
    $('.btn-enviar').show();
}
function enviarPedido(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':27},
        dataType:'JSON',
        success:function(response){
            limpiarFormPed();
            limpiarTablaPed();
            $('.span-cant').html("0");
            $('.btn-enviar').hide();
            eliminarSesion();
            $('#modal-msj-ped').modal("toggle");
        },error:function(){
            alertify.error("Error al enviar el pedido");
        }
    });
}
function eliminarSesion(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':28},
        dataType:'JSON'
    });
}
function limpiarTablaPed(){
    tblped.clear().draw();
}
function limpiarFormPed(){
    $('.txt-cant').val("");
    $('#slt-equip').prop('selectedIndex',0);
}
CargarEquipos();
CargarPed();