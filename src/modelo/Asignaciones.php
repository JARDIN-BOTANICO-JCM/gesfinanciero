<?php 
/**
 *
 * @author yalfonso
 * TODO: Tarea 116 - Crear el modelo de la tabla Asignaciones
 * TODO: Tarea 122 - Modificar la tabla asignaciones y agregar las columnas tipodoc y documento, borrar el indice de usuarios_id
 */
class Asignaciones extends Clsdatos { 

	private $id = 0;
	private $usuarios_id = 0;
	private $tipodoc_id = 0;
	private $documento = "";
	private $empleados_id = 0;
	private $asignador_id = 0;
	private $asignador = "";
	private $fecha = "1900-01-01 00:00:00";
	private $fechamodifica = "1900-01-01 00:00:00";
	
    /**
     * @return number
     */
    public function getTipodoc_id()
    {
        return $this->tipodoc_id;
    }

    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param number $tipodoc_id
     */
    public function setTipodoc_id($tipodoc_id)
    {
        $this->tipodoc_id = $tipodoc_id;
    }

    /**
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

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
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * @return number
     */
    public function getAsignador_id()
    {
        return $this->asignador_id;
    }

    /**
     * @return string
     */
    public function getAsignador()
    {
        return $this->asignador;
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
    public function getFechamodifica()
    {
        return $this->fechamodifica;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

    /**
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * @param number $asignador_id
     */
    public function setAsignador_id($asignador_id)
    {
        $this->asignador_id = $asignador_id;
    }

    /**
     * @param string $asignador
     */
    public function setAsignador($asignador)
    {
        $this->asignador = $asignador;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $fechamodifica
     */
    public function setFechamodifica($fechamodifica)
    {
        $this->fechamodifica = $fechamodifica;
    }

} 
?>