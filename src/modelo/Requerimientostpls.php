<?php
/**
 *
 * @author yalfonso
 *
 */
class Requerimientostpls extends Clsdatos { 
    private $id = 0;
    private $nombre = '';
    private $usuarios = '';
    private $fecha = '1900-01-01 00:00:00';
    private $requerimientostplsestados_id = 1;
    private $usuariosmod = '';
    private $fechamod = '1900-01-01 00:00:00';
    
    /**
     * @return string
     */
    public function getUsuariosmod()
    {
        return $this->usuariosmod;
    }

    /**
     * @return string
     */
    public function getFechamod()
    {
        return $this->fechamod;
    }

    /**
     * @param string $usuariosmod
     */
    public function setUsuariosmod($usuariosmod)
    {
        $this->usuariosmod = $usuariosmod;
    }

    /**
     * @param string $fechamod
     */
    public function setFechamod($fechamod)
    {
        $this->fechamod = $fechamod;
    }

    /**
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
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
    public function getRequerimientostplsestados_id()
    {
        return $this->requerimientostplsestados_id;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param number $requerimientostplsestados_id
     */
    public function setRequerimientostplsestados_id($requerimientostplsestados_id)
    {
        $this->requerimientostplsestados_id = $requerimientostplsestados_id;
    }

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

?>