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
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * @return string
     */
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * @return string
     */
    public function getMesaplica()
    {
        return $this->mesaplica;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return number
     */
    public function getFlujositems_id()
    {
        return $this->flujositems_id;
    }

    /**
     * @return number
     */
    public function getPaquetesestados_id()
    {
        return $this->paquetesestados_id;
    }

    /**
     * @return string
     */
    public function getUsuariosmod()
    {
        return $this->usuariosmod;
    }

    /**
     * @return string
     */
    public function getFechamodificado()
    {
        return $this->fechamodificado;
    }

    /**
     * @return number
     */
    public function getFlujos_id()
    {
        return $this->flujos_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * @param string $empleados
     */
    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;
    }

    /**
     * @param string $mesaplica
     */
    public function setMesaplica($mesaplica)
    {
        $this->mesaplica = $mesaplica;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param number $flujositems_id
     */
    public function setFlujositems_id($flujositems_id)
    {
        $this->flujositems_id = $flujositems_id;
    }

    /**
     * @param number $paquetesestados_id
     */
    public function setPaquetesestados_id($paquetesestados_id)
    {
        $this->paquetesestados_id = $paquetesestados_id;
    }

    /**
     * @param string $usuariosmod
     */
    public function setUsuariosmod($usuariosmod)
    {
        $this->usuariosmod = $usuariosmod;
    }

    /**
     * @param string $fechamodificado
     */
    public function setFechamodificado($fechamodificado)
    {
        $this->fechamodificado = $fechamodificado;
    }

    /**
     * @param number $flujos_id
     */
    public function setFlujos_id($flujos_id)
    {
        $this->flujos_id = $flujos_id;
    }

}

?>