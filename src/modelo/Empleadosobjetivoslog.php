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
     * Obtiene el identificador del paquete requerido.
     * @return number
     */
    public function getPaquetesrequ_id()
    {
        return $this->paquetesrequ_id;
    }

    /**
     * Establece el identificador del paquete requerido.
     * @param number $paquetesrequ_id
     */
    public function setPaquetesrequ_id($paquetesrequ_id)
    {
        $this->paquetesrequ_id = $paquetesrequ_id;
    }

    /**
     * Obtiene el identificador del ítem de requerimientos TPLS.
     * @return number
     */
    public function getRequerimientostplsitems_id()
    {
        return $this->requerimientostplsitems_id;
    }

    /**
     * Establece el identificador del ítem de requerimientos TPLS.
     * @param number $requerimientostplsitems_id
     */
    public function setRequerimientostplsitems_id($requerimientostplsitems_id)
    {
        $this->requerimientostplsitems_id = $requerimientostplsitems_id;
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
     * Obtiene los archivos.
     * @return string
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * Obtiene los archivos GES.
     * @return string
     */
    public function getArchivosges()
    {
        return $this->archivosges;
    }

    /**
     * Obtiene la fecha.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene el empleado.
     * @return string
     */
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * Obtiene el identificador del objetivo del empleado.
     * @return number
     */
    public function getEmpleadosobjetivos_id()
    {
        return $this->empleadosobjetivos_id;
    }

    /**
     * Obtiene el feedback.
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Obtiene el usuario que proporcionó el feedback.
     * @return string
     */
    public function getUsuariofeedback()
    {
        return $this->usuariofeedback;
    }

    /**
     * Obtiene la fecha del feedback.
     * @return string
     */
    public function getFechafeedback()
    {
        return $this->fechafeedback;
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
     * Establece los archivos.
     * @param string $archivos
     */
    public function setArchivos($archivos)
    {
        $this->archivos = $archivos;
    }

    /**
     *  Establece los archivos GES.
     * @param string $archivosges
     */
    public function setArchivosges($archivosges)
    {
        $this->archivosges = $archivosges;
    }

    /**
     * Establece la fecha.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     *  Establece el empleado.
     * @param string $empleados
     */
    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;
    }

    /**
     * Establece el identificador del objetivo del empleado.
     * @param number $empleadosobjetivos_id
     */
    public function setEmpleadosobjetivos_id($empleadosobjetivos_id)
    {
        $this->empleadosobjetivos_id = $empleadosobjetivos_id;
    }

    /**
     * Establece el feedback.
     * @param string $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Establece el usuario que proporcionó el feedback.
     * @param string $usuariofeedback
     */
    public function setUsuariofeedback($usuariofeedback)
    {
        $this->usuariofeedback = $usuariofeedback;
    }

    /**
     * Establece la fecha del feedback.
     * @param string $fechafeedback
     */
    public function setFechafeedback($fechafeedback)
    {
        $this->fechafeedback = $fechafeedback;
    }

}
?>