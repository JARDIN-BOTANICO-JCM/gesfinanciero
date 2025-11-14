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
    
    /**
     * Obtiene el identificador del objeto.
     *
     * @return mixed El ID del registro.
     */
    public function getId (){
        return $this->id;
    }
    /**
     * Establece el identificador del objeto.
     *
     * @param mixed $vl El ID del registro.
     * @return void
     */
    public function setId ( $vl ){
        $this->id = $vl;
    }

    /**
     * Devuelve el nombre asociado a este código activo.
     *
     * @return string Nombre
     */
    public function getNombre (){
        return $this->nombre;
    }
    /**
     * Establece el nombre asociado a este código activo.
     *
     * @param string $vl Nombre
     * @return void
     */
    public function setNombre ( $vl ){
        $this->nombre = $vl;
    }
    /**
     * Devuelve la fecha asociada a este código activo.
     *
     * @return string Fecha
     */
    public function getFecha (){
        //return $this->fecha;
        return date("Y-m-d H:i:s");
    }
    /**
     * Establece la fecha asociada a este código activo.
     *
     * @param string $vl Fecha
     * @return void
     */
    public function setFecha ( $vl ){
        $this->fecha = $vl;
    }
    /**
     * Devuelve el estado activo asociado a este código activo.
     *
     * @return string Estado activo
     */
    public function getActivo (){
        return $this->activo;
    }
    /**
     * Establece el estado activo asociado a este código activo.
     *
     * @param string $vl Estado activo
     * @return void
     */
    public function setActivo ( $vl ){
        $this->activo = $vl;
    }
    /**
     * Devuelve el identificador del usuario seleccionado asociado a este código activo.
     *
     * @return mixed Identificador del usuario seleccionado
     */
    public function getUserselecto_id (){
        return $this->userselecto_id;
    }
    /**
     * Establece el identificador del usuario seleccionado asociado a este código activo.
     *
     * @param mixed $vl Identificador del usuario seleccionado
     * @return void
     */
    public function setUserselecto_id ( $vl ){
        $this->userselecto_id = $vl;
    }
}
?>