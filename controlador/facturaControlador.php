<?php

$ruta=parse_url($_SERVER["REQUEST_URI"]);

if(isset($ruta["query"])){

if($ruta["query"]=="ctrNumFactura"||
   $ruta["query"]=="ctrUltimoCufd"||
   $ruta["query"]=="ctrNuevoCufd"||
   $ruta["query"]=="ctrLeyenda"||
   $ruta["query"]=="ctrRegistrarFactura"||
   $ruta["query"]=="ctrAnularFactura"){
    $metodo=$ruta["query"];
    $factura=new ControladorFactura();
    $factura->$metodo();
}

}

class ControladorFactura{
   

    static public function ctrInfoFacturas(){
        $respuesta=ModeloFactura::mdlInfoFacturas();
        return $respuesta;
    }

    static public function ctrInfoFactura($id){

        $respuesta=ModeloFactura::mdlInfoFactura($id);
        return $respuesta;
    }


    static public function ctrEditFactura(){
        require "../modelo/facturaModelo.php";

        if($_POST["password"]==$_POST["passActual"]){
        $password=$_POST["password"];
        }
        else{
        $password=password_hash($_POST["password"], PASSWORD_DEFAULT);
        }

        


        $data=array(
            "password"=>$password,
            "id"=>$_POST["idFactura"],
            "perfil"=>$_POST["perfil"],
            "estado"=>$_POST["estado"]
        );

        ModeloFactura::mdlEditFactura($data);
    }




    static public function ctrAnularFactura(){
        require "../modelo/facturaModelo.php";
        $cuf=$_POST["cuf"];

        $respuesta= ModeloFactura::mdlAnularFactura($cuf);
        echo $respuesta;
    }
            
    static public function ctrNumFactura(){
        require "../modelo/facturaModelo.php";
        $respuesta= ModeloFactura::mdlNumFactura();
        if($respuesta["max(id_factura)"]==null){
        echo "1";
        }else{
        echo $respuesta["max(id_factura)"]+1;
        }
        }




    static public function ctrNuevoCufd(){
        require "../modelo/facturaModelo.php";
        $data=array(
        "cufd"=>$_POST["cufd"],
        "fechaVigCufd"=>$_POST["fechaVigCufd"],
        "codControlCufd"=>$_POST["codControlCufd"]
        );
        echo ModeloFactura::mdlNuevoCufd($data);
    }

    static public function ctrUltimoCufd(){
        require "../modelo/facturaModelo.php";

        $respuesta=ModeloFactura::mdlUltimoCufd();
        echo json_encode($respuesta);

    }

    static public function ctrLeyenda(){
        require "../modelo/facturaModelo.php";

        $respuesta=ModeloFactura::mdlLeyenda();
        echo json_encode($respuesta);

    }

    static public function ctrRegistrarFactura(){
        require "../modelo/facturaModelo.php";

        $data=array(
            "codFactura"=>$_POST["codFactura"],
            "idCliente"=>$_POST["idCliente"],
            "detalle"=>$_POST["detalle"],
            "neto"=>$_POST["neto"],
            "descuento"=>$_POST["descuento"],
            "total"=>$_POST["total"],
            "fechaEmision"=>$_POST["fechaEmision"],
            "cufd"=>$_POST["cufd"],
            "cuf"=>$_POST["cuf"],
            "xml"=>$_POST["xml"],
            "idUsuario"=>$_POST["idUsuario"],
            "usuario"=>$_POST["usuario"],
            "leyenda"=>$_POST["leyenda"]

        );

        $respuesta=ModeloFactura::mdlRegistrarFactura($data);
        echo $respuesta;
    }
}
  