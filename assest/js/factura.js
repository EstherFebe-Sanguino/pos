var host="http://localhost:5000/"
function verificarComunicacion(){
    var obj=""

    $.ajax({
        type:"POST",
        url:host+"api/CompraVenta/comunicacion",
        data:obj,
        cache:false,
        contentType:"application/json",
        processData:false,
        success:function(data){
            if(data["transaccion"]==true){
                document.getElementById("comunicacionSiat").innerHTML="Conectado"
                document.getElementById("comunicacionSiat").className="badge badge-success"
            }
        }
    }).fail(function(jqXHR, textStatus, errorThrown){
        if(jqXHR.status==0){
            document.getElementById("comunicacionSiat").innerHTML="Desconectado"
            document.getElementById("comunicacionSiat").className="badge badge-danger"
        }
    })
}

setInterval(verificarComunicacion,3000)

function busCliente(){
    let nitCliente=document.getElementById("nitCliente").value

    var obj={
        nitCliente:nitCliente
    }
    $.ajax({
        type:"POST",
        url:"controlador/clienteControlador.php?ctrBusCliente",
        data:obj,
        dataType:"json",
        success:function(data){
            if(data["email_cliente"]==""){
                document.getElementById("emailCliente").value="null"
            }else{
                document.getElementById("emailCliente").value=data["email_cliente"]
            }
            document.getElementById("rsCliente").value=data["razon_social_cliente"]
            numFactura()
        }

    })
}

function numFactura(){
    let obj=""
    
    $.ajax({
        type:"POST",
        url:"controlador/facturaControlador.php?ctrNumFactura",
        data:obj,
        success:function(data){
            console.log(data)
            document.getElementById("numFactura").value=data
        }
    })
}

function busProducto(){
    let codProducto = document.getElementById("codProducto").value

    var obj = {
      codProducto: codProducto
    }
  
    $.ajax({
      type: "POST",
      url: "controlador/productoControlador.php?ctrBusProducto",
      data: obj,
      dataType: "json",
      success: function (data) {
  
        document.getElementById("conceptoPro").value=data["nombre_producto"];
        document.getElementById("uniMedida").value=data["unidad_medida"];
        document.getElementById("preUnitario").value=data["precio_producto"];
  
        document.getElementById("uniMedidaSin").value=data["unidad_medida_sin"];
        document.getElementById("codProductoSin").value=data["cod_producto_sin"];
        
  
      }
    })
}

function calcularPreProd(){
    let cantPro=parseInt(document.getElementById("cantProducto").value)
    let descProducto=parseFloat(document.getElementById("descProducto").value)
    let preUnitario=parseFloat(document.getElementById("preUnitario").value)
    
    let preProducto=preUnitario-descProducto
    document.getElementById("preTotal").value=preProducto*cantPro
  } 
var arregloCarrito=[]
var listaDetalle=document.getElementById("listaDetalle")
function agregarCarrito(){
    let actEconomica=document.getElementById("actEconomica").value
    let codProducto=document.getElementById("codProducto").value
    let codProductoSin=parseInt(document.getElementById("codProductoSin").value)
    let conceptoPro=document.getElementById("conceptoPro").value
    let cantProducto=parseInt(document.getElementById("cantProducto").value)
    let uniMedida=document.getElementById("uniMedida").value
    let uniMedidaSin=parseInt(document.getElementById("uniMedidaSin").value)
    let preUnitario=parseFloat(document.getElementById("preUnitario").value)
    let descProducto=parseFloat(document.getElementById("descProducto").value)
    let preTotal=parseFloat(document.getElementById("preTotal").value)

    let objDetalle={
    actividadEconomica:actEconomica,
    codigoProductoSin:codProductoSin,
    codigoProducto:codProducto,
    descripcion:conceptoPro,
    cantidad:cantProducto,
    unidadMedida:uniMedidaSin,
    precioUnitario:preUnitario,
    montoDescuento:descProducto,
    subTotal:preTotal
}
    arregloCarrito.push(objDetalle)
    dibujarTablaCarrito()

} 
function dibujarTablaCarrito(){
    listaDetalle.innerHTML=""

    arregloCarrito.forEach((detalle)=>{
        let fila=document.createElement("tr")

        fila.innerHTML='<td>'+detalle.descripcion+'</td>'+
        '<td>'+detalle.cantidad+'</td>'+
        '<td>'+detalle.precioUnitario+'</td>'+
        '<td>'+detalle.montoDescuento+'</td>'+
        '<td>'+detalle.subTotal+'</td>'

        let tdElimimar=document.createElement("td")
        let botonElimimar=document.createElement("button")

        botonElimimar.classList.add("btn", "btn-danger")
        botonElimimar.innerText="Eliminar"
        botonElimimar.onclick=()=>{  
            eliminarCarrito(detalle.codigoProducto)
        }       
        tdElimimar.appendChild(botonElimimar)
        fila.appendChild(tdElimimar)

 
        listaDetalle.appendChild(fila)

    })
}   