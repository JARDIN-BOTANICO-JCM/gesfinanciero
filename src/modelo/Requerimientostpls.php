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
     * Obtiene el usuario que modificó el requisito del template.
     * @return string
     */
    public function getUsuariosmod()
    {
        return $this->usuariosmod;
    }

    /**
     * Obtiene la fecha de modificación del requisito del template.
     * @return string
     */
    public function getFechamod()
    {
        return $this->fechamod;
    }

    /**
     * Establece el usuario que modificó el requisito del template.
     * @param string $usuariosmod
     */
    public function setUsuariosmod($usuariosmod)
    {
        $this->usuariosmod = $usuariosmod;
    }

    /**
     * Establece la fecha de modificación del requisito del template.
     * @param string $fechamod
     */
    public function setFechamod($fechamod)
    {
        $this->fechamod = $fechamod;
    }

    /**
     * Obtiene el usuario que creó el requisito del template.
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Obtiene la fecha de creación del requisito del template.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene el estado del requisito del template.
     * @return number
     */
    public function getRequerimientostplsestados_id()
    {
        return $this->requerimientostplsestados_id;
    }

    /**
     * Establece el usuario que creó el requisito del template.
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Establece la fecha de creación del requisito del template.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece el estado del requisito del template.
     * @param number $requerimientostplsestados_id
     */
    public function setRequerimientostplsestados_id($requerimientostplsestados_id)
    {
        $this->requerimientostplsestados_id = $requerimientostplsestados_id;
    }

    /**
     * Obtiene el identificador del requisito del template.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre del requisito del template.
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establece el identificador del requisito del template.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre del requisito del template.
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}

?>