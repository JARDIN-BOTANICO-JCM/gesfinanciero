<?php
/**
 *
 * @author yalfonso
 *
 */
class Cargadatoslog extends Clsdatos {
    
	private $id = 0;
	private $usuarios = "";
	private $fecha = "1900-01-01 00:00:00";
	private $cargadatos = "";
	
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
     * @return string
     */
    public function getCargadatos()
    {
        return $this->cargadatos;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @param string $cargadatos
     */
    public function setCargadatos($cargadatos)
    {
        $this->cargadatos = $cargadatos;
    }
	
}