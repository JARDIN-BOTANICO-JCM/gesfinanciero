<?php 
/**
 *
 * @author yalfonso
 * TODO: Tarea 18 - Crear el modelo de la tabla datosmes
 */
class Datosmes extends Clsdatos { 

	private $id = 0;
	
	private $mesaplica = "1900-01-01 00:00:00";
	private $valorccobro = 0;
	private $contrato = "";
	private $fecha = "1900-01-01 00:00:00";
	private $empleados_id = 0;
	private $usuariosmod = "";
	private $paquetes_id = 0;
	private $fechamod = "1900-01-01 00:00:00";
	
    /**
     * @return string
     */
    public function getFechamod()
    {
        return $this->fechamod;
    }

    /**
     * @param string $fechamod
     */
    public function setFechamod($fechamod)
    {
        $this->fechamod = $fechamod;
    }

    /**
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
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
    public function getMesaplica()
    {
        return $this->mesaplica;
    }

    /**
     * @return number
     */
    public function getValorccobro()
    {
        return $this->valorccobro;
    }

    /**
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
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
    public function getUsuariosmod()
    {
        return $this->usuariosmod;
    }

    /**
     * @return number
     */
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $mesaplica
     */
    public function setMesaplica($mesaplica)
    {
        $this->mesaplica = $mesaplica;
    }

    /**
     * @param number $valorccobro
     */
    public function setValorccobro($valorccobro)
    {
        $this->valorccobro = $valorccobro;
    }

    /**
     * @param string $contrato
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $usuariosmod
     */
    public function setUsuariosmod($usuariosmod)
    {
        $this->usuariosmod = $usuariosmod;
    }

    /**
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id)
    {
        $this->paquetes_id = $paquetes_id;
    }

	
} 
?>