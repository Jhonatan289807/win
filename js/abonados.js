window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
let tablaPed = $('#tabla-pedido').DataTable({
    'language':Idioma(),
    'columnDefs' : [
        {
        'targets' : [4],
        'visible' : false,
        'searchable' : false
        }
    ]
});
let tblontmesh = $('#tabla-ontmesh').DataTable({
    'language':Idioma(),
    pageLength: 4,
    "lengthChange": false,
    "searching" : false
});
let tblotros = $('#tabla-otros').DataTable({
    'language':Idioma(),
    pageLength: 4,
    "lengthChange": false,
    "searching" : false
});
$(document).on('click','.btn-detalles',function(){
    let data = tablaPed.row($(this).parents("tr")).data();
    let id = data[4];
    DataONTMESH(id).then(function(data){
        if(data != []){
            $('.contenedor-tablaontmesh').show();
            agregarTablaONTMESH(data);
        }else{
            $('.contenedor-tablaontmesh').hide();
        }
    },function(error){
        console.log(error);
    });
    DataOtros(id).then(function(data){
        if(data !=[]){
            $('.contenedor-tablaotros').show();
            agregarTablaOtros(data);
        }else{
            $('.contenedor-tablaotros').hide();

        }
    },function(error){
        console.log(error);
    });
    $('#modaldetalle').modal('toggle');
});
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
function DataONTMESH(id){
    return new Promise(function(devolver,error){
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':22,'id':id,'tipo':1},
            dataType: 'JSON',
            success:function(data){
                devolver(data)
            },
            error:function(rechazar){
                error("error");
            }
        });
    });
}
function DataOtros(id){
    return new Promise(function(devolver,error){
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':22,'id':id,'tipo':2},
            dataType: 'JSON',
            success:function(data){
                devolver(data)
            },
            error:function(rechazar){
                error(rechazar);
            }
        });
    });
}
function mostrarAbonados(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':21},
        dataType:'JSON',
        success:function(data){
            if(data != []){
                agregarTablaPed(data);
            }
        }, error:function(error){
            console.log(error);
        }
    });
}
function agregarTablaPed(data){
    limpiarTablaPed();
    let cont = 1;
    $.each(data,function(){
        tablaPed.row.add([
            cont,
            this['tecnico'],
            this['fecha'],
            "<button class='btn btn-warning btn-detalles'><i class='fas fa-clipboard-list'></i></button>",
            this['idped']
        ]).draw(false)
    });
}
function agregarTablaONTMESH(data){
    limpiarTablaONTMESH();
    let cont = 1;
    let fecha = "";
    $.each(data,function(){
        tblontmesh.row.add([
            cont,
            this['prod'],
            this['modelo'],
            this['serie01'],
            this['serie02'],
        ]).draw(false);
        cont++;
        fecha = this['fecha_ent'];
    });
    $('.span-fecha').html(fecha);
}
function agregarTablaOtros(data){
    limpiarTablaOtros();
    let cont = 1;
    let fecha = "";
    $.each(data,function(){
        tblotros.row.add([
            cont,
            this['prod'],
            this['cant']
        ]).draw(false);
        cont++;
        fecha = this['fecha_ent'];
    });
    $('.span-fecha').html(fecha);
}
function limpiarTablaONTMESH(){
    tblontmesh.clear().draw();
}
function limpiarTablaOtros(){
    tblotros.clear().draw();
}
function limpiarTablaPed(){
    tablaPed.clear().draw();
}
mostrarAbonados();