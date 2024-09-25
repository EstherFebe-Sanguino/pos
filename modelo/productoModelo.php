<?php
require_once "conexion.php";

class Modeloproducto{

   
    static public function mdlInfoProductos(){
        $stmt=Conexion::conectar()->prepare("select * from producto");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    static public function mdlRegProducto($data){
        $codProducto = $data["cod_producto"];
        $codProductoSin = $data["cod_producto_sin"];
        $descripcion = $data["descripcion"];
        $precioProducto = $data["precio_producto"];
        $unidadMedida = $data["unidad_medida"];
        $unidadMedidaSin = $data["unidad_medida_sin"];
        $imagenProducto = $data["imagen_producto"];
        
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO producto (cod_producto, cod_producto_sin, descripcion, precio_producto, unidad_medida, unidad_medida_sin, imagen_producto) 
        VALUES ('$codProducto', '$codProductoSin', '$descripcion', '$precioProducto', '$unidadMedida', '$unidadMedidaSin', '$imagenProducto')");
        
        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

    }
    static public function mdlActualizarAcceso($fechaHora, $id){
        $stmt=Conexion::conectar()->prepare("update producto set ultimo_login='$fechaHora' where id_producto='$id'");
        
        if($stmt->execute()){
          return "ok";
        }else{
          return "error";
        }
    }
     static public function mdlInfoProducto($id){
        $stmt=Conexion::conectar()->prepare("select * from producto where id_producto=$id");
            $stmt->execute();

            return $stmt->fetch();
    }
    static public function mdlEditProducto($data){

        $id=$data["idProducto"];
        $codProductoSIN=$data["codProductoSIN"];
        $descripcion=$data["descripcion"];
        $preProducto=$data["preProducto"];
        $unidadMedidad=$data["unidadMedidad"];
        $unidadMedidadSIN=$data["unidadMedidadSIN"];
        $estado=$data["estado"];
        $imgProducto=$data["imgProducto"];
    
    
         $stmt=Conexion::conectar()->prepare("update producto set cod_producto_sin='$codProductoSIN',
        descripcion='$descripcion', precio_producto='$preProducto', unidad_medida='$unidadMedidad', unidad_medida_sin='$unidadMedidadSIN', imagen_producto='$imgProducto', disponible='$estado'
        where id_producto=$id");
    
            if($stmt->execute()){
                return "ok";
            }
            else{
                return "error";
            }
  
    }
    static public function mdlEliProducto($id){
        $stmt=Conexion::conectar()->prepare("delete from producto where id_producto=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }

    static public function mdlBusProducto($cod){
        $stmt = Conexion::conectar()->prepare("select * from producto where cod_producto='$cod'");
        $stmt->execute();

        return $stmt->fetch();


        $stmt->close();
        $stmt->null;

    }

   

}