<?php
require_once "conexion.php";
class ModeloFactura{


    
static public function mdlInfoFacturas(){
        $stmt=Conexion::conectar()->prepare("select * from factura");
        $stmt->execute();

        return $stmt->fetchAll();

  /*       $stmt->close();
        $stmt->null;  */
        
}

static public function mdlRegFactura($data){
        $loginFactura=$data["loginFactura"];
        $password=$data["password"];
        $perfil=$data["perfil"];

        $stmt=Conexion::conectar()->prepare("insert into factura(login_factura, password, perfil) values('$loginFactura', 
        '$password', '$perfil')");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }

        $stmt->close();
        $stmt->null();


}

static public function mdlInfoFactura($id){
        $stmt=Conexion::conectar()->prepare("select * from factura where id_factura=$id");
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
        $stmt->null; 
}

static public function mdlEditFactura($data){

        $password=$data["password"];
        $perfil=$data["perfil"];
        $estado=$data["estado"];
        $id=$data["id"]; 

        $stmt=Conexion::conectar()->prepare("update factura set password='$password', perfil='$perfil',
        estado='$estado' where id_factura=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
  /* 
        $stmt->close();
        $stmt->null();
  */
}

static public function mdlEliFactura($id){

    $stmt=Conexion::conectar()->prepare("delete from factura where id_factura=$id");

    if($stmt->execute()){
        return "ok";
    }
    else{
        return "error";
    }
    /* 
    $stmt->close();
    $stmt->null();
    */

}

static public function mdlNumFactura(){
    $stmt=Conexion::conectar()->prepare("select max(id_factura) from factura");
    $stmt->execute();

    return $stmt->fetch();

    /*   $stmt->close();
    $stmt->null; */ 


    
}

static public function mdlNuevoCufd($data){

    $cufd=$_data["cufd"];
    $fechaVigCufd=$_data["fechaVigCufd"];
    $codControlCufd=$_data["codControlCufd"];

    $stmt=Conexion::conectar()->prepare("insert into cufd(codigo_cufd, codigo_control,
     fecha_vigencia) values('$cufd', '$codControlCufd', '$fechaVigCufd')");

    if($stmt->execute()){
        return "ok";
    }
    else{
        return "error";
    }

    $stmt->close();
    $stmt->null();

}

static public function mdlUltimoCufd(){
    $stmt=Conexion::conectar()->prepare("SELECT * FROM cufd WHERE id_cufd=(select max(id_cufd) from cufd)");
    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();
    $stmt->null; 
}
}