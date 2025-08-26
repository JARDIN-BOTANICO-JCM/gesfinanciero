<?php
/**
 *
 * @author yalfonso
 *
 */
class Flujos extends Clsdatos { 
    private $id = 0;
    private $nombre = '';
    private $descripcion = '';
    private $usuarios = '';
    private $version = 0;
    private $fecha = '1900-01-01 00:00:00';
    private $flujosestados_id = 1;
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
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @return number
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return number
     */
    public function getFlujosestados_id()
    {
        return $this->flujosestados_id;
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

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @param number $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param number $flujosestados_id
     */
    public function setFlujosestados_id($flujosestados_id)
    {
        $this->flujosestados_id = $flujosestados_id;
    }

}

?>