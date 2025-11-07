<?php 
/**
 *
 * @author yalfonso
 * TODO: Tarea 69 - Crear el modelo de la tabla apoyos
 */
class Apoyos extends Clsdatos { 

	private $id = 0; 
	private $supervisor_id = 0; 
	private $supervisor = "";
	private $asignado_id = 0; 
	private $asignado = "";
	private $usuarios_id = 0; 
	private $usuarios = "";
	private $fecha = "1900-01-01 00:00:00";
	private $usuariosmodifica = "";
	private $fechamodifica = "1900-01-01 00:00:00";
	private $apoyosestados_id = 1;
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return number
     */
    public function getSupervisor_id()
    {
        return $this->supervisor_id;
    }

    /**
     * @return string
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * @return number
     */
    public function getAsignado_id()
    {
        return $this->asignado_id;
    }

    /**
     * @return string
     */
    public function getAsignado()
    {
        return $this->asignado;
    }

    /**
     * @return number
     */
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
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
    public function getUsuariosmodifica()
    {
        return $this->usuariosmodifica;
    }

    /**
     * @return string
     */
    public function getFechamodifica()
    {
        return $this->fechamodifica;
    }

    /**
     * @return number
     */
    public function getApoyosestados_id()
    {
        return $this->apoyosestados_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $supervisor_id
     */
    public function setSupervisor_id($supervisor_id)
    {
        $this->supervisor_id = $supervisor_id;
    }

    /**
     * @param string $supervisor
     */
    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * @param number $asignado_id
     */
    public function setAsignado_id($asignado_id)
    {
        $this->asignado_id = $asignado_id;
    }

    /**
     * @param string $asignado
     */
    public function setAsignado($asignado)
    {
        $this->asignado = $asignado;
    }

    /**
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
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
     * @param string $usuariosmodifica
     */
    public function setUsuariosmodifica($usuariosmodifica)
    {
        $this->usuariosmodifica = $usuariosmodifica;
    }

    /**
     * @param string $fechamodifica
     */
    public function setFechamodifica($fechamodifica)
    {
        $this->fechamodifica = $fechamodifica;
    }

    /**
     * @param number $apoyosestados_id
     */
    public function setApoyosestados_id($apoyosestados_id)
    {
        $this->apoyosestados_id = $apoyosestados_id;
    }
 
	
} 
?>