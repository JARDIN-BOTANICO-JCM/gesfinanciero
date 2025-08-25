<?php
/**
 *
 * @author yalfonso
 *
 */
class Empleadosobjetivos extends Clsdatos {
    
    private $id = 0;
    private $descripcion = "";
    private $empleados_id = 0;
    private $empleadosobjetivosestados_id = 0;
    private $vigencia = "";
    private $orden = 0;
    
    /**
     * @return number
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @param number $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
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
    public function getDescripcion()
    {
        return $this->descripcion;
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
    public function getEmpleadosobjetivosestados_id()
    {
        return $this->empleadosobjetivosestados_id;
    }

    /**
     * @return string
     */
    public function getVigencia()
    {
        return $this->vigencia;
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
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * @param number $empleadosobjetivosestados_id
     */
    public function setEmpleadosobjetivosestados_id($empleadosobjetivosestados_id)
    {
        $this->empleadosobjetivosestados_id = $empleadosobjetivosestados_id;
    }

    /**
     * @param string $vigencia
     */
    public function setVigencia($vigencia)
    {
        $this->vigencia = $vigencia;
    }

}
?>