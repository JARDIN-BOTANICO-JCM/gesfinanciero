<?php
/**
 *
 * @author yalfonso
 *
 */
class Empleadosobjetivoslog extends Clsdatos {
    
    private $id = 0;
    private $descripcion = "";
    private $fecha = "1900-01-01 00:00:00";
    private $empleados = "";
    private $empleadosobjetivos_id = 0;
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
    public function getDescripcion()
    {
        return $this->descripcion;
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
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * @return number
     */
    public function getEmpleadosobjetivos_id()
    {
        return $this->empleadosobjetivos_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $empleados
     */
    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;
    }

    /**
     * @param number $empleadosobjetivos_id
     */
    public function setEmpleadosobjetivos_id($empleadosobjetivos_id)
    {
        $this->empleadosobjetivos_id = $empleadosobjetivos_id;
    }

}
?>