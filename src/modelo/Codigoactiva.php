<?php
/**
 *
 * @author yalfonso
 *
 */
class Codigoactiva extends Clsdatos {
    
    private $id = 0;
    private $nombre = "";
    private $fecha = "";
    private $activo = "";
    private $userselecto_id = 0;
    
    public function getId (){
        return $this->id;
    }
    public function setId ( $vl ){
        $this->id = $vl;
    }
    public function getNombre (){
        return $this->nombre;
    }
    public function setNombre ( $vl ){
        $this->nombre = $vl;
    }
    public function getFecha (){
        //return $this->fecha;
        return date("Y-m-d H:i:s");
    }
    public function setFecha ( $vl ){
        $this->fecha = $vl;
    }
    public function getActivo (){
        return $this->activo;
    }
    public function setActivo ( $vl ){
        $this->activo = $vl;
    }
    public function getUserselecto_id (){
        return $this->userselecto_id;
    }
    public function setUserselecto_id ( $vl ){
        $this->userselecto_id = $vl;
    }
}
?>