window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
let tablaUser = $('#tabla-usuarios').DataTable({'language':Idioma()});
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
$('.btn-new-user').click(function(e){
    let nombre = $('#txt-name').val();
    let apellido = $('#txt-apell').val();
    let cel = $('#txt-cel').val();
    let pass =$('#txt-pass').val();
    if(nombre,apellido,cel,pass != ""){
        e.preventDefault();
        let data = {
            'user' : nombre+" "+apellido,
            'cel'  : cel,
            'pass' : pass
        }
        AgregarUsuario(data);
    }
});
$('.btn-new-pass').click(function(e){
    let newpass = $('#txt-new-pass').val();
    let repitpass = $('#txt-repit-pass').val();
    if(newpass && repitpass != ""){
        e.preventDefault();
        if(newpass == repitpass){
            CambiarPass(newpass);
        }else{
            $('.span-aviso').css('visibility','visible');
            $('.span-aviso').fadeIn()
            setTimeout(function(){
                $('.span-aviso').fadeOut(1500)
            },4000);
        }
    }
});
function AgregarUsuario(data){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':31,'data':data},
        dataType:'JSON',
        success:function(response){
            $('#modal-new-user').modal('hide');
            alertify.success("Usuario registrado");
            MostrarUsuarios();
        },error:function(error){
            console.log(error);
        }
    });
}
function MostrarUsuarios(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':32},
        dataType:'JSON',
        success:function(data){
            if(data['error']){
                console.log(data);
            }else{
                AgregarTablaUser(data);
            }
         }
    });
}
function CambiarPass(pass){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':33,'pass':pass},
        dataType:'JSON',
        success:function(response){
            $('#modal-edit-pass').modal('toggle');
            limpiarText();
            alertify.success("Contraseña actualizada con éxito");
        }
    })
}
function AgregarTablaUser(data){
    let cont = 1;
    limpiarTablaUser();
    $.each(data,function(){
        tablaUser.row.add([
            cont,
            this['user'],
            this['cod'],
            this['cel'],
            "<button class='btn btn-warning'>Editar</button>"
        ]).draw(false);
    })
}
function limpiarTablaUser(){
    tablaUser.clear().draw();
}
function limpiarText(){
    $('#txt-name').val("");
    $('#txt-apell').val("");
    $('#txt-cell').val("");
    $('#txt-pass').val("");
    $('#txt-new-pass').val("");
    $('#txt-repit-pass').val("");
}
MostrarUsuarios();