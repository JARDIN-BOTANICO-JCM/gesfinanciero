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
     * Obtiene el orden.
     * @return number
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Establece el orden.
     * @param number $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
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
     * Obtiene el identificador del empleado.
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * Obtiene el identificador del estado del objetivo.
     * @return number
     */
    public function getEmpleadosobjetivosestados_id()
    {
        return $this->empleadosobjetivosestados_id;
    }

    /**
     * Obtiene la vigencia.
     * @return string
     */
    public function getVigencia()
    {
        return $this->vigencia;
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
     * Establece la descripción.
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece el identificador del empleado.
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * Establece el identificador del estado del objetivo.
     * @param number $empleadosobjetivosestados_id
     */
    public function setEmpleadosobjetivosestados_id($empleadosobjetivosestados_id)
    {
        $this->empleadosobjetivosestados_id = $empleadosobjetivosestados_id;
    }

    /**
     * Establece la vigencia.
     * @param string $vigencia
     */
    public function setVigencia($vigencia)
    {
        $this->vigencia = $vigencia;
    }

}
?>