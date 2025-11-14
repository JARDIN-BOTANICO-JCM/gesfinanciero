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
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre.
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establece el identificador.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre.
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}