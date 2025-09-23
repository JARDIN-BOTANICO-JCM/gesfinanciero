<?php 
/**
 *
 * @author yalfonso
 *
 */
class Empleadosdetallescontrato extends Clsdatos { 

	private $id = 0; 
	private $tipodoc_id = 0; 
	private $documento = "";
	private $empleados_id = 0;
	private $contrato = "";
	private $meses = 0; 
	private $dias = 0; 
	private $fecha = "1900-01-01 00:00:00";
	private $usuario = "";
	private $fechamodifica = "1900-01-01 00:00:00";
	private $anyolectivo_id = 0; 
	private $fechainicio = "1900-01-01 00:00:00";
	private $fileactaini = "";
	private $fileactainivalorgestor = "";
	
    /**
     * @return string
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * @param string $fechainicio
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;
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
     * @return number
     */
    public function getEmpleados_id()
    {
        return $this->empleados_id;
    }

    /**
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * @return number
     */
    public function getMeses()
    {
        return $this->meses;
    }

    /**
     * @return number
     */
    public function getDias()
    {
        return $this->dias;
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
    public function getUsuario()
    {
        return $this->usuario;
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
    public function getAnyolectivo_id()
    {
        return $this->anyolectivo_id;
    }

    /**
     * @return string
     */
    public function getFileactaini()
    {
        return $this->fileactaini;
    }

    /**
     * @return string
     */
    public function getFileactainivalorgestor()
    {
        return $this->fileactainivalorgestor;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @param number $empleados_id
     */
    public function setEmpleados_id($empleados_id)
    {
        $this->empleados_id = $empleados_id;
    }

    /**
     * @param string $contrato
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
    }

    /**
     * @param number $meses
     */
    public function setMeses($meses)
    {
        $this->meses = $meses;
    }

    /**
     * @param number $dias
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @param string $fechamodifica
     */
    public function setFechamodifica($fechamodifica)
    {
        $this->fechamodifica = $fechamodifica;
    }

    /**
     * @param number $anyolectivo_id
     */
    public function setAnyolectivo_id($anyolectivo_id)
    {
        $this->anyolectivo_id = $anyolectivo_id;
    }

    /**
     * @param string $fileactaini
     */
    public function setFileactaini($fileactaini)
    {
        $this->fileactaini = $fileactaini;
    }

    /**
     * @param string $fileactainivalorgestor
     */
    public function setFileactainivalorgestor($fileactainivalorgestor)
    {
        $this->fileactainivalorgestor = $fileactainivalorgestor;
    }
	
} 
?>