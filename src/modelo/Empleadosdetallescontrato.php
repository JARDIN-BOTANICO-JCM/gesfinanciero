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
     * Obtiene la fecha de inicio del contrato.
     * @return string
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Establece la fecha de inicio del contrato.
     * @param string $fechainicio
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;
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
     * Obtiene el identificador del tipo de documento.
     * @return number
     */
    public function getTipodoc_id()
    {
        return $this->tipodoc_id;
    }

    /**
     * Obtiene el número de documento.
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
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
     * Obtiene el contrato.
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * Obtiene los meses.
     * @return number
     */
    public function getMeses()
    {
        return $this->meses;
    }

    /**
     * Obtiene los días.
     * @return number
     */
    public function getDias()
    {
        return $this->dias;
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
     * Obtiene el usuario.
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Obtiene la fecha de modificación.
     * @return string
     */
    public function getFechamodifica()
    {
        return $this->fechamodifica;
    }

    /**
     * Obtiene el identificador del año lectivo.
     * @return number
     */
    public function getAnyolectivo_id()
    {
        return $this->anyolectivo_id;
    }

    /**
     * Obtiene el archivo del acta de inicio.
     * @return string
     */
    public function getFileactaini()
    {
        return $this->fileactaini;
    }

    /**
     * Obtiene el archivo del acta de inicio con valor gestor.
     * @return string
     */
    public function getFileactainivalorgestor()
    {
        return $this->fileactainivalorgestor;
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
     * Establece el identificador del tipo de documento.
     * @param number $tipodoc_id
     */
    public function setTipodoc_id($tipodoc_id)
    {
        $this->tipodoc_id = $tipodoc_id;
    }

    /**
     * Establece el número de documento.
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
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
     * Establece el contrato.
     * @param string $contrato
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
    }

    /**
     * Establece los meses.
     * @param number $meses
     */
    public function setMeses($meses)
    {
        $this->meses = $meses;
    }

    /**
     * Establece los días.
     * @param number $dias
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
    }

    /**
     * 
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece el usuario.
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Establece la fecha de modificación.
     * @param string $fechamodifica
     */
    public function setFechamodifica($fechamodifica)
    {
        $this->fechamodifica = $fechamodifica;
    }

    /**
     * Establece el identificador del año lectivo.
     * @param number $anyolectivo_id
     */
    public function setAnyolectivo_id($anyolectivo_id)
    {
        $this->anyolectivo_id = $anyolectivo_id;
    }

    /**
     * Establece el archivo del acta de inicio.
     * @param string $fileactaini
     */
    public function setFileactaini($fileactaini)
    {
        $this->fileactaini = $fileactaini;
    }

    /**
     * Establece el archivo del acta de inicio con valor gestor.
     * @param string $fileactainivalorgestor
     */
    public function setFileactainivalorgestor($fileactainivalorgestor)
    {
        $this->fileactainivalorgestor = $fileactainivalorgestor;
    }
	
} 
?>