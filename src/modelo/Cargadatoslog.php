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
     * Obtiene el ID del registro de carga de datos.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene los usuarios asociados al registro de carga de datos.
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Obtiene la fecha del registro de carga de datos.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene los datos de carga asociados al registro.
     * @return string
     */
    public function getCargadatos()
    {
        return $this->cargadatos;
    }

    /**
     * Establece el ID del registro de carga de datos.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece los usuarios asociados al registro de carga de datos.
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     *  Establece la fecha del registro de carga de datos.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece los datos de carga asociados al registro.
     * @param string $cargadatos
     */
    public function setCargadatos($cargadatos)
    {
        $this->cargadatos = $cargadatos;
    }
	
}