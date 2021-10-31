window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
let tablaped = $('#tabla-pedido').DataTable({'language' : Idioma()});
let tabladet = $('#tabla-detalles').DataTable({'language' : Idioma()});
let tablaontmesh = $('#tabla-ontmesh').DataTable({
    'language' : Idioma(),
    pageLength : 3,
    lengthMenu: [[3, 5], [3, 5]],
    sInfo: 'none'
});
let tablacar = $('#tabla-car').DataTable({
    'language' : Idioma(),
    pageLength: 3,
    lengthMenu: [[3, 5], [3, 5]],
    "lengthChange": false,
    "searching" : false
});
let cantOnt = 0;
let cantMesh = 0;
let valOntMesh = false;
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
$('.btn-enviarped').click(function(){
    let id = $(this).data('ped');
    if(valOntMesh == true){
        validarCarro().then(function(data){
            if(data == false){
                $('#modal-alert-car').modal('toggle');
                $('.p-aviso').html("Todavía no ha seleccionado ningún equipo");
            }else if(cantOnt != 0 && cantMesh != 0){
                if(cantOnt == data['ont'] && cantMesh == data['mesh']){
                    enviarPedido(id);
                }else if(cantOnt != data['ont'] && cantMesh != data['mesh']){
                    $('#modal-alert-car').modal('toggle');
                    $('.p-aviso').html("Todavía faltan equipos por seleccionar"); 
                }else if(cantOnt != data['ont'] && cantMesh == data['mesh']){
                    $('#modal-alert-car').modal('toggle');
                    $('.p-aviso').html("Todavía faltan equipos de ONT por seleccionar"); 
                }else if(cantOnt == data['ont'] && cantMesh != data['mesh']){
                    $('#modal-alert-car').modal('toggle');
                    $('.p-aviso').html("Todavía faltan equipos de MESH por seleccionar"); 
                }
            }else if(cantOnt != 0){
                if(cantOnt == data['ont']){
                    enviarPedido(id);
                }else{
                    $('#modal-alert-car').modal('toggle');
                    $('.p-aviso').html("Todavía faltan equipos de ONT por seleccionar"); 
                }
            }else if(cantMesh != 0){
                if(cantMesh == data['mesh']){
                    enviarPedido(id);
                }else{
                    $('#modal-alert-car').modal('toggle');
                    $('.p-aviso').html("Todavía faltan equipos de MESH por seleccionar");

                }
            }
        },function(error){
            console.log(error);
        });
    }else{
        enviarPedido(id);
    }
});
function enviarPedido(id){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op' : 14,'id':id},
        dataType:'JSON',
        success:function(response){
            if(response == true){
                $('#modal-msj-ped').modal('toggle');
                mostrarPed();
                vaciarCarro();
                cantOnt = 0;
                cantMesh = 0;
            }
        }
    });
}
$(document).on('click','.btn-detalles',function(){
    let numero = $(this).data('num');
    let user = $(this).data('user');
    let fecha = $(this).data('fecha');
    let idped = $(this).data('id');
    $('.btn-enviarped').data('ped', idped);
    detallePedido(idped);
    $('.span-pedido').html(numero);
    $('.span-tecnico').html(user.toUpperCase());
    $('.span-fecha').html(fecha);
    vaciarCarro();
    $('.contenedor-tablaped').hide();
    $('.info-titu').hide();
    $('.titulo-detalles').css("visibility", "visible");
    $('.cont-detalles').show();
    $('.mostrar-ped').show();

});
$(document).on('click','.btn-select',function(){
    limpiarTablaCar();
    let tipo = $(this).data('tipo');
    let comp = $(this).data('prod');
    let cant = $(this).data('cant');
    let iddet =$(this).data('id');
    $('#ontmsh-label').html("Inventario de "+comp.toUpperCase()+"  |   Cantidad solicitada: "+cant);
    if(tipo == 1){
        mostrarOnt(iddet);
    }else if(tipo == 2){
        mostrarMesh(iddet);
    }
    mostrarONToMESH(tipo)
});
$(document).on('click','.btn-addcar',function(){
    let iddet = $(this).data('iddet');
    let id = $(this).data('id');
    let tipo = $(this).data('tipo');
    let serie01 = $(this).data('serie01');
    let serie02 = $(this).data('serie02');
    let modelo = $(this).data('modelo');
    let ontmesh=JSON.stringify([iddet,id,tipo,serie01,serie02,modelo]);
    validarCantCarro(tipo).then(function(data){
        if(data == false){
            agregarCarro(ontmesh,tipo);
        }else{
            if(tipo == 1){
                if(cantOnt == data){
                    $('.span-aviso').css('visibility','visible');
                    $('.span-aviso').fadeIn()
                    setTimeout(function(){
                        $('.span-aviso').fadeOut(1500)
                    },4000);
                }else{
                    agregarCarro(ontmesh,tipo);
                }
            }else if(tipo == 2){
                if(cantMesh == data){
                    $('.span-aviso').css('visibility','visible');
                    $('.span-aviso').fadeIn()
                    setTimeout(function(){
                        $('.span-aviso').fadeOut(1500)
                    },4000);
                }else{
                    agregarCarro(ontmesh,tipo);
                }
            }
        }
    },function(error){
        console.log(error);
    });
});
$('.mostrar-ped').click(function(){
    cantOnt = 0;
    cantMesh = 0;
    valOntMesh = false;
    mostrarPed();
});
$(document).on('click','.btn-eliminar',function(){
    let id = $(this).data('id');
    let tipo = $(this).data('tipo');
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':7, 'id':id},
        dataType:'JSON',
        success:function(data){
            if(data == true){
                mostrarONToMESH(tipo);
            }
        }
    });
});
function validarCantCarro(tipo){
    return new Promise(function(devolver,rechazar){
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':13,'tipo':tipo,'validar':1 },
            dataType:'JSON',
            success:function(response){
                devolver(response);
            },
            error:function(response){
                rechazar(response);
            }
        });
    });
}
function validarCarro(){
    return new Promise(function(respuesta,rechazar){
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':13, 'validar':2 },
            dataType:'JSON',
            success:function(response){
                respuesta(response);
            },
            error:function(response){
                rechazar(response);
            }
        });
    });
}
function mostrarPed(){
    $('.cont-detalles').hide();
    $('.titulo-detalles').css('visibility','hidden');
    $('.contenedor-tablaped').show();
    $('.info-titu').show();
    $('.mostrar-ped').hide()
    pedidos();
}
function mostrarMesh(iddet){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':4},
        dataType:'JSON',
        success:function(data){
            agregarTablaOntMesh(data,iddet);
        }
    });
}
function mostrarOnt(iddet){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':5},
        dataType:'JSON',
        success:function(data){
            agregarTablaOntMesh(data,iddet);
        }
    });
}
function mostrarONToMESH(tipo){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':12,'tipo':tipo},
        dataType:'JSON',
        success:function(data){
            if(data == false){
                limpiarTablaCar();
            }else{
                agregarTablaCar(data);
            }
        }
    });
}
function usuario(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op' : 11},
        dataType:'JSON',
        success:function(data){
        }
    });
}
function pedidos(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op' : 2},
        dataType:'JSON',
        success:function(data){
            agregarTablaPed(data);
        }
    });
}
function detallePedido(id){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op' : 3,'idped':id},
        dataType:'JSON',
        success:function(data){
            agregarTablaDet(data);
        }
    });
}
function agregarCarro(ontmesh,tipo){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':6,'datos':ontmesh},
        dataType:'JSON',
        success:function(data){
            mostrarONToMESH(tipo);
        }
    });
}
function mostrarCarro(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':8},
        dataType:'JSON',
        success:function(data){
            
        }
    });
}
function vaciarCarro(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':9},
        dataType:'JSON'
    });
}
function agregarTablaPed(data){
    limpiarTablaPed();
    let boton= '';
    cont = 1;
    $.each(data,function(){
        if(this['idest'] == 1){
            boton = '<button class="btn btn-info btn-detalles" data-num="'+cont+'" data-user="'+this['user']+'" data-id="'+this['idped']+'" data-fecha="'+this['fecha']+'">Ver equipos</button>'
        }else{
            boton ='<button class="btn btn-danger btn-indisponible" disabled>Finalizado</button>'
        }
        tablaped.row.add([
            cont,
            this['user'],
            this['fecha'],
            this['hora'],
            this['est'],
            boton
        ]).draw(false);
        cont++;
    });
}
function agregarTablaDet(data){
    limpiarTablaDetalle();
    let cont = 1;
    let boton = '';
    $.each(data,function(){
        if(this['tipo'] == 1 || this['tipo'] == 2){
            valOntMesh = true;
            boton = '<button class="btn btn-success btn-select" data-id ="'+this['iddet']+'" data-tipo="'+this['tipo']+'" data-prod="'+this['prod']+'" data-cant="'+this['cantidad']+'" data-toggle="modal" data-target="#modal-ontmesh">Seleccionar</button>';
        }else{
            boton = '<button class="btn btn-secondary btn-indisponible" disabled>No disponible</button>';
        }
        if(this['tipo'] == 1){
            cantOnt = this['cantidad'];
        }else if(this['tipo'] == 2){
            cantMesh = this['cantidad'];
        }
        tabladet.row.add([
            cont,
            this['prod'],
            this['cantidad'],
            boton
        ]).draw(false);
        cont++;
    });
}
function agregarTablaOntMesh(data,id){
    limpiarTablaOntMesh();
    let cont =1;
    $.each(data,function(){
        tablaontmesh.row.add([
            cont,
            this['serie01'],
            this['serie02'],
            this['modelo'],
            '<button class="btn btn-success btn-addcar" data-iddet="'+id+'" data-id="'+this['id']+'" data-tipo="'+this["tipo"]+'" data-serie01="'+this['serie01']+'" data-serie02="'+this['serie02']+'" data-modelo="'+this['modelo']+'" >Seleccionar</button>'
        ]).draw(false);
        cont++;
    });
}
function agregarTablaCar(data){
    limpiarTablaCar();
    let cont = 1;
    $.each(data,function(){
        tablacar.row.add([
            cont,
            this['serie01'],
            this['serie02'],
            this['modelo'],
            "<button class='btn btn-danger btn-eliminar' data-id='"+this['id']+"' data-tipo='"+this['tipo']+"'>Eliminar</button>" 
        ]).draw(false);
    });
}
function borrarTablaPed(){
    tablaped.rows().remove().draw();
}
function limpiarTablaPed(){
    tablaped.clear().draw();
}
function borrarTablaDetalle(){
    tabladet.rows().remove().draw();
}
function limpiarTablaDetalle(){
    tabladet.clear().draw();
}
function limpiarTablaOntMesh(){
    tablaontmesh.clear().draw();
}
function limpiarTablaCar(){
    tablacar.clear().draw();
}
pedidos();