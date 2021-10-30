window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
let tablaInv = $('#tabla-inventario').DataTable({
    'language' : Idioma(),
    'columnDefs' : [
        {
        'targets' : [3],
        'visible' : false,
        'searchable' : false
        }
    ]
});
$('#slt-tipo-prod').change(function(){
    window.onload = function(){
        var contenedor = document.getElementById("contenedor_carga");
        contenedor.style.visibility = 'hidden';
        contenedor.style.opacity='0';
    }
    let tipo=$(this).val();
    limpiar();
    if(tipo == 1 || tipo ==2){
        $('.form-otros').hide();
        $('.form-ontmesh').show();
    }else if(tipo == 3){
        $('.form-ontmesh').hide();
        $('.form-otros').show();
    }
});
$('.btn-nuevo-prod').click(function(){
    limpiar();
    $('.form-ontmesh').hide();
    $('.form-otros').hide();
})
$('.btn-agregar').click(function(e){
    let tipo =parseInt($('#slt-tipo-prod').val())
    if(tipo == 1 || tipo == 2){
        let serie01 = $('#txt-s01').val();
        let serie02 = $('#txt-s02').val();
        let modelo = $('#txt-modelo').val();
        if(serie01 != "" && serie02 != "" && modelo != ""){
            e.preventDefault()
            let data = JSON.stringify([tipo,serie01,serie02,modelo]);
            registrarProd(data,tipo);
        }
    }else if(tipo == 3){
        let prod = $('#txt-prod').val();
        let cant = $('#txt-cant').val();
        if(prod !="" && cant != ""){
            e.preventDefault();
            let data = JSON.stringify([prod,cant]);
            registrarProd(data,tipo)
            
        }
    }
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
$(document).on('click','.btn-formedit',function(){
    let data = tablaInv.row($(this).parents("tr")).data();
    $('#txt-prod-edit').val(data[1]);
    $('#txt-cant-edit').val(data[2]);
    $('.btn-edit').data('id',data[3])
});
$('.btn-edit').click(function(e){
    let id = $(this).data('id');
    let prod = $('#txt-prod-edit').val();
    let cant = $('#txt-cant-edit').val();
    if(prod != "" && cant != ""){
        e.preventDefault();
        let data = {
            'id' : id,
            'prod' : prod,
            'cant' : parseInt(cant)
        }
        $.ajax({
            url:'../inc/control.php',
            method:'POST',
            data:{'op':18,'data':data},
            dataType:'JSON',
            success:function(response){
                $('#editModal').modal('toggle');
                mostrarInventario();
                alertify.success("Los datos fueron actualizados");

                
            },
            error:function(){
                alertify.error('Ocurrio un error');
            }
        });
    }
});
function limpiar(){
    $('#txt-prod').val("");
    $('#txt-cant').val("");
    $('#txt-modelo').val("");
    $('#txt-s01').val("");
    $('#txt-s02').val("");
}
function mostrarInventario(){
    $.ajax({
        url:'../inc/control.php',
        method: 'POST',
        data:{'op':15},
        dataType : 'JSON',
        success: function(data){
            agregarTabla(data);
        }   
    });
}
function registrarProd(data,tipo){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':17,'data':data,'tipo':tipo},
        dataType:'JSON',
        success:function(response){
            if(response){
                mostrarInventario();
            }
        }
    })
}
function agregarTabla(data){
    limpiarTablaInv();
    let cont = 1;
    $.each(data,function(){
        tablaInv.row.add([
            cont,
            this['prod'],
            this['cant'],
            this['idprod'],
            "<button class='btn btn-warning btn-formedit' data-toggle='modal' data-target='#editModal' ><i class='far fa-edit'></i></button>",
        ]).draw(false);
        cont++;
    });
}
function limpiarTablaInv(){
    tablaInv.clear().draw();
}
mostrarInventario();