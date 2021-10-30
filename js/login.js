$('.btnIngresar').click(function(e){
    let user = $('#inputEmail').val();
    let pass = $('#inputPassword').val();
    if(user != "" && pass != ""){
        e.preventDefault();
        datos = JSON.stringify([user,pass]);
        ValidarLogin(datos);
    }
});
function ValidarLogin(datos){
    $.ajax({
        url:'inc/control.php',
        method: 'POST',
        data:{'op':1,'user':datos},
        dataType: 'JSON',
        beforeSend:function(){
            console.log("cargando...")
        },
        success: function(response){
            if(response == "TU001"){
                window.location.href="admin/home_admin.php";
            }else if(response == "TU002"){
                window.location.href="tecnico/home_tecnico.php";
            }
        }
    });
}