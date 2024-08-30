function MNuevoUsuario(){
    $("#modal-default").modal("show");
   
    var obj="";
    $.ajax({
   
       type:"POST",
       url:"vista/usuario/FNuevoUsuario.php",
       data: obj,
       success: function(data) {
           $("#content-default").html(data);
       }
    })
   }

function regUsuario(){
 
    var formData=new FormData($("#FRegUsuario")[0])
    if(formData.get("password")==formData.get("vrPassword")){

        $.ajax({
       
           type:"POST",
           url:"controlador/usuarioControlador.php?ctrRegUsuario",
           data: formData,
           cache:false,
           contentType:false,
           processData:false,
           success: function(data) {
               
            if(data="ok"){

                Swal.fire({
                    icon: 'success',
                    title: "Registro Exitoso",
                    showConfirmButton: false,
                    timer: 1000
                    
                });

                setTimeout(function(){
                    location.reload()
                },1200)

            }
            else{
                Swal.fire({
                    title: "Error",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                    
                });
            }

           }
        })

    }

}

function MEditUsuario(id){

    $("#modal-default").modal("show");
   
    var obj="";
    $.ajax({
   
       type:"POST",
       url:"vista/usuario/FEditUsuario.php?id="+id,
       data: obj,
       success: function(data) {
           $("#content-default").html(data);
       }
    })



    
} //final
function editUsuario(){

    var formData=new FormData($("#FEditUsuario")[0])
    if(formData.get("password")==formData.get("vrPassword")){

        $.ajax({
       
           type:"POST",
           url:"controlador/usuarioControlador.php?ctrEditUsuario",
           data: formData,
           cache:false,
           contentType:false,
           processData:false,
           success: function(data) {

            if(data="ok"){

                Swal.fire({
                    icon: 'success',
                    showConfirmButton: false,
                    title: "Usuario Actualizado",
                    timer: 1000
                    
                });

                setTimeout(function(){
                    location.reload()
                },1200)

            }
            else{
                Swal.fire({
                    title: "Error",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000
                    
                });
            }

           }
        })

    }


}


function MEliUsuario(id){

    var obj={
        id:id
    }

Swal.fire({
    title:"¿Estás seguro de eliminar este usuario?",
    showDenyButton:true,
    showCancelButton:false,
    confirmButtonText:'Confirmar',
    denyButtonText:'Cancelar'
}).then((result)=>{
    if(result.isConfirmed){
        $.ajax({
            type:"POST",
            url:"controlador/usuarioControlador.php?ctrEliUsuario",
            data:obj,
            success: function(data) {
              if(data=="ok"){
                location.reload()
              }
              else{
                Swal.fire({
                    icon: 'error',
                    showConfirmButton: false,
                    title: 'Error',
                    text:'El usuario no puede ser eliminado',
                    timer: 1000
                    
                });
              }
            }
        })
    }
})
}

/*=================
variables globales
===================*/
var host="http://localhost:5000/"

function verificarComunicacion(){
    var obj=""

    $.ajax({
        type:"POST",
        url:host+"api/CompraVenta/comunicacion",
        data:obj,
        cache:false,
        contentType:"apllication/json",
        processData:false,
        success:function(data){
            if(data["transaccion"]==true){
                document.getElementById("comunSiat").innerHTML="Conectado"
                document.getElementById("comunSiat").className="badge badge-success"
            }
        }
    }).fail(function(jqXHR, textStatus, errorThrown){
        if(jqXHR.status==0){
            document.getElementById("comunSiat").innerHTML="Desconectado"
            document.getElementById("comunSiat").className="badge badge-danger"
        }
    })
}

setInterval(verificarComunicacion,3000)