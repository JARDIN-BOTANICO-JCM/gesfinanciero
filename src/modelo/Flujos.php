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
     * Obtiene la descripción.
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene los usuarios.
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Obtiene la versión.
     * @return number
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Obtiene la fecha.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene el identificador del estado del flujo.
     * @return number
     */
    public function getFlujosestados_id()
    {
        return $this->flujosestados_id;
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

    /**
     * Establece la descripción.
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece los usuarios.
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Establece la versión.
     * @param number $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Establece la fecha.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece el identificador del estado del flujo.
     * @param number $flujosestados_id
     */
    public function setFlujosestados_id($flujosestados_id)
    {
        $this->flujosestados_id = $flujosestados_id;
    }

}

?>