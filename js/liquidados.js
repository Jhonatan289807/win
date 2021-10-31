window.onload = function(){
    var contenedor = document.getElementById("contenedor_carga");
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity='0';
}
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
function mostrarInventario(){
    $.ajax({
        url:'../inc/control.php',
        method: 'POST',
        data:{'op':23},
        dataType : 'JSON',
        success: function(data){
            let slt = document.getElementById("slt-tipo");
            let options = "<option value='0'>Seleccione un equipo</option>"
            $.each(data,function(){
                options+="<option value='"+this['id']+"'>"+this['prod']+"</option>";
            });
            slt.insertAdjacentHTML('beforeend', options);
        }   
    });
}
function mostrarTecnico(){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':29},
        dataType:'JSON',
        success:function(data){
            let slt = document.getElementById("slt-user");
            let options = "<option value='0'>Seleccione un técnico</option>"
            $.each(data,function(){
                options+="<option value='"+this['id']+"'>"+this['user']+"</option>";
            });
            slt.insertAdjacentHTML('beforeend', options);
        }
    });
}
$('.btn-filtrarcon').click(function(e){
    let user = $('#slt-user').val();
    let tipo = $('#slt-tipo').val();
    if(user != 0 && tipo != 0){
        e.preventDefault();
        let json = JSON.stringify([user,tipo]);
        FiltrarEquipos(json);
    }else{
        e.preventDefault();
    }
});

function FiltrarEquipos(equipos){
    $.ajax({
        url:'../inc/control.php',
        method:'POST',
        data:{'op':30 , 'equipos':equipos},
        dataType:'JSON',
        success:function(data){
            console.log(data);
        }
    })
}
mostrarInventario();
mostrarTecnico();