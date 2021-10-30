// window.onload = function(){
//     var contenedor = document.getElementById("contenedor_carga");
//     contenedor.style.visibility = 'hidden';
//     contenedor.style.opacity='0';
// }
function mostrarInventario(){
    $.ajax({
        url:'../inc/control.php',
        method: 'POST',
        data:{'op':23},
        dataType : 'JSON',
        success: function(data){
            console.log(data);
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
            console.log(data)
        }
    });
}
$('.btn-filtrar').click(function(e){
    // let user = $('.slt-user').val();
    // let tipo = $('.slt-tipo').val();
    let json = JSON.stringify([2,1]);
    FiltrarEquipos(json);
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
let json = JSON.stringify([2,1])
FiltrarEquipos(json);