<?php
/**
 *
 * @author yalfonso
 *
 */
class Paquetes extends Clsdatos { 
    private $id = 0;
    private $nombre = "";
    private $empleados_id = 0;
    private $empleados = "";
    private $mesaplica = "1900-01-01 00:00:00";
    private $fecha = "1900-01-01 00:00:00";
    private $flujositems_id = 0;
    private $paquetesestados_id = 0;
    private $usuariosmod = "";
    private $fechamodificado = "1900-01-01 00:00:00";
    private $flujos_id = 0;
    
    /**
     * Obtiene el identificador del paquete.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre del paquete.
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtiene el identificador del empleado asociado al paquete.
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * Obtiene el nombre del empleado asociado al paquete.
     * @return string
     */
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * Obtiene el mes al que aplica el paquete.
     * @return string
     */
    public function getMesaplica()
    {
        return $this->mesaplica;
    }

    /**
     * Obtiene la fecha del paquete.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene el identificador del ítem de flujo asociado al paquete.
     * @return number
     */
    public function getFlujositems_id()
    {
        return $this->flujositems_id;
    }

    /**
     * Obtiene el identificador del estado del paquete.
     * @return number
     */
    public function getPaquetesestados_id()
    {
        return $this->paquetesestados_id;
    }

    /**
     * Obtiene el usuario que modificó el paquete.
     * @return string
     */
    public function getUsuariosmod()
    {
        return $this->usuariosmod;
    }

    /**
     * Obtiene la fecha de la última modificación del paquete.
     * @return string
     */
    public function getFechamodificado()
    {
        return $this->fechamodificado;
    }

    /**
     * Obtiene el identificador del flujo asociado al paquete.
     * @return number
     */
    public function getFlujos_id()
    {
        return $this->flujos_id;
    }

    /**
     * Establece el identificador del paquete.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre del paquete.
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Establece el identificador del empleado asociado al paquete.
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * Establece el nombre del empleado asociado al paquete.
     * @param string $empleados
     */
    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;
    }

    /**
     * Establece el mes al que aplica el paquete.
     * @param string $mesaplica
     */
    public function setMesaplica($mesaplica)
    {
        $this->mesaplica = $mesaplica;
    }

    /**
     * Establece la fecha del paquete.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece el identificador del ítem de flujo asociado al paquete.
     * @param number $flujositems_id
     */
    public function setFlujositems_id($flujositems_id)
    {
        $this->flujositems_id = $flujositems_id;
    }

    /**
     * Establece el identificador del estado del paquete.
     * @param number $paquetesestados_id
     */
    public function setPaquetesestados_id($paquetesestados_id)
    {
        $this->paquetesestados_id = $paquetesestados_id;
    }

    /**
     * Establece el usuario que modificó el paquete.
     * @param string $usuariosmod
     */
    public function setUsuariosmod($usuariosmod)
    {
        $this->usuariosmod = $usuariosmod;
    }

    /**
     * Establece la fecha de la última modificación del paquete.
     * @param string $fechamodificado
     */
    public function setFechamodificado($fechamodificado)
    {
        $this->fechamodificado = $fechamodificado;
    }

    /**
     * Establece el identificador del flujo asociado al paquete.
     * @param number $flujos_id
     */
    public function setFlujos_id($flujos_id)
    {
        $this->flujos_id = $flujos_id;
    }

}

?>