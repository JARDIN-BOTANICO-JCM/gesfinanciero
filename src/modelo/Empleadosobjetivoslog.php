<?php
/**
 *
 * @author yalfonso
 *
 */
class Empleadosobjetivoslog extends Clsdatos {
    
    private $id = 0;
    private $descripcion = "";
    private $archivos = "";
    private $archivosges = "";
    private $fecha = "1900-01-01 00:00:00";
    private $empleados = "";
    private $empleadosobjetivos_id = 0;
    private $feedback = "";
    private $usuariofeedback = "";
    private $fechafeedback = "1900-01-01 00:00:00";
    private $requerimientostplsitems_id = 0;
    private $paquetesrequ_id = 0;
    
    /**
     * @return number
     */
    public function getPaquetesrequ_id()
    {
        return $this->paquetesrequ_id;
    }

    /**
     * @param number $paquetesrequ_id
     */
    public function setPaquetesrequ_id($paquetesrequ_id)
    {
        $this->paquetesrequ_id = $paquetesrequ_id;
    }

    /**
     * @return number
     */
    public function getRequerimientostplsitems_id()
    {
        return $this->requerimientostplsitems_id;
    }

    /**
     * @param number $requerimientostplsitems_id
     */
    public function setRequerimientostplsitems_id($requerimientostplsitems_id)
    {
        $this->requerimientostplsitems_id = $requerimientostplsitems_id;
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
     * @return string
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * @return string
     */
    public function getArchivosges()
    {
        return $this->archivosges;
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
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @return string
     */
    public function getUsuariofeedback()
    {
        return $this->usuariofeedback;
    }

    /**
     * @return string
     */
    public function getFechafeedback()
    {
        return $this->fechafeedback;
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
     * @param string $archivos
     */
    public function setArchivos($archivos)
    {
        $this->archivos = $archivos;
    }

    /**
     * @param string $archivosges
     */
    public function setArchivosges($archivosges)
    {
        $this->archivosges = $archivosges;
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

    /**
     * @param string $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @param string $usuariofeedback
     */
    public function setUsuariofeedback($usuariofeedback)
    {
        $this->usuariofeedback = $usuariofeedback;
    }

    /**
     * @param string $fechafeedback
     */
    public function setFechafeedback($fechafeedback)
    {
        $this->fechafeedback = $fechafeedback;
    }

}
?>