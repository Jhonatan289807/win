window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
let tablaMesh = $('#tabla-mesh').DataTable({
    'language' : Idioma(),
    'columnDefs' : [
        {
        'targets' : [6],
        'visible' : false,
        'searchable' : false
        }
    ]
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
$('.btn-agregar').click(function(e){
    let serie01 = $('#txt-s01').val();
    let serie02 = $('#txt-s02').val();
    let modelo = $('#txt-modelo').val();
    if(serie01 != "" && serie02 != "" && modelo != ""){
        e.preventDefault();
        let data = JSON.stringify([2,serie01,serie02,modelo]);
        registrarProd(data);
        limpiar();
    }
})
$(document).on('click','.btn-formedit',function(){
    let data = tablaMesh.row($(this).parents("tr")).data();
    $('#txt-modelo-edit').val(data[1]);
    $('#txt-s01-edit').val(data[2]);
    $('#txt-s02-edit').val(data[3]);
    $('.btn-edit').data('id',data[6]);
});
$('.btn-edit').click(function(e){
    let id = $(this).data('id');
    let mod = $('#txt-modelo-edit').val();
    let s01 = $('#txt-s01-edit').val();
    let s02 = $('#txt-s02-edit').val();
    if(mod != "" && s01 != "" && s02 != ""){
        e.preventDefault();
        let data = {
            'id' : id,
            'mod' : mod,
            's01' : s01,
            's02' : s02
        }
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':20,'data':data},
            dataType:'JSON',
            success:function(response){
                $('#editModal').modal('toggle');
                mostrarMesh();
                alertify.success("Los datos fueron actualizados");         
            },
            error:function(){
                alertify.error('Ocurrio un error');
            }
        });
    }
});
function registrarProd(data,tipo){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':17,'data':data,'tipo':2},
        dataType:'JSON',
        success:function(response){
            if(response){
                $('#prodModal').modal('toggle');
                mostrarMesh();
                $('#modal-agregar').modal('show');
            }
        }
    })
}
function mostrarMesh(){
    $.ajax({
        url:'../inc/control.php',
        method: 'POST',
        data:{'op':19, 'tipo' : 2},
        dataType:'JSON',
        success:function(data){
            agregarTabla(data);
        }
    });
}
function agregarTabla(data){
    limpiarTabla();
    let cont = 1;
    $.each(data,function(){
        tablaMesh.row.add([
            cont,
            this['modelo'],
            this['s01'],
            this['s02'],
            this['estado'],
            "<button class='btn btn-warning btn-formedit' data-toggle='modal' data-target='#editModal' ><i class='far fa-edit'></i></button>",
            this['id']
        ]).draw(false);
        cont++;
    });
}
function limpiar(){
    $('#txt-modelo').val("");
    $('#txt-s01').val("");
    $('#txt-s02').val("");
}
function limpiarTabla(){
    tablaMesh.clear().draw()
}
mostrarMesh();