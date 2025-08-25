<?php
/**
 *
 * @author yalfonso
 *
 */
class Empleadosobjetivosestados extends Clsdatos {
    
    private $id = 0;
    private $nombre = "";
    
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}