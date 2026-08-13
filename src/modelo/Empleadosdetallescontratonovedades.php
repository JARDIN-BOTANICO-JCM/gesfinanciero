<?php 
/**
 *
 * @author yalfonso
 *
 */
class Empleadosdetallescontratonovedades extends Clsdatos { 

	private $id = 0; 
	private $contrato = "";
	private $meses = 0;
	private $dias = 0;
	private $fechainicio = "1900-01-01 00:00:00";
	private $fecha = "1900-01-01 00:00:00";
	private $usuario = "";
	private $fechamodifica = "1900-01-01 00:00:00";
	private $honorarios = 0;
	private $crp = "";
	private $empleadosdetallescontrato_id = 0;
	private $empleadosdetallescontratonovedadesestados_id = 0;
	private $totalcontrato = 0;

	/**
     * @return number
     */
    public function getTotalcontrato()
    {
        return $this->totalcontrato;
    }

    /**
     * @param number $totalcontrato
     */
    public function setTotalcontrato($totalcontrato): self
    {
        $this->totalcontrato = $totalcontrato;
        
        return $this;
    }

    /**
	 * Obtiene el identificador de la novedad.
	 *
	 * @return mixed El valor del identificador.
	 */
	public function getId() { 
		return $this->id;
	} 

	/**
	 * Establece el identificador de la novedad.
	 *
	 * @param mixed $vl Identificador a asignar.
	 * @return self
	 */
	public function setId($vl) { 
		$this->id = $vl;
		return $this;
	} 

	/**
	 * Obtiene el contrato de la novedad.
	 *
	 * @return string El valor del contrato.
	 */
	public function getContrato() { 
		return $this->contrato;
	} 

	/**
	 * Establece el contrato de la novedad.
	 *
	 * @param string $vl Contrato a asignar.
	 * @return self
	 */
	public function setContrato($vl) { 
		$this->contrato = $vl;
		return $this;
	} 

	/**
	 * Obtiene los meses de la novedad.
	 *
	 * @return integer El valor de meses.
	 */
	public function getMeses() { 
		return $this->meses;
	} 

	/**
	 * Establece los meses de la novedad.
	 *
	 * @param integer $vl Meses a asignar.
	 * @return self
	 */
	public function setMeses($vl) { 
		$this->meses = $vl;
		return $this;
	} 

	/**
	 * Obtiene los días de la novedad.
	 *
	 * @return integer El valor de días.
	 */
	public function getDias() { 
		return $this->dias;
	} 

	/**
	 * Establece los días de la novedad.
	 *
	 * @param integer $vl Días a asignar.
	 * @return self
	 */
	public function setDias($vl) { 
		$this->dias = $vl;
		return $this;
	} 

	/**
	 * Obtiene la fecha de inicio de la novedad.
	 *
	 * @return string El valor de la fecha de inicio.
	 */
	public function getFechainicio() { 
		return $this->fechainicio;
	} 

	/**
	 * Establece la fecha de inicio de la novedad.
	 *
	 * @param string $vl Fecha de inicio a asignar.
	 * @return self
	 */
	public function setFechainicio($vl) { 
		$this->fechainicio = $vl;
		return $this;
	} 

	/**
	 * Obtiene la fecha de la novedad.
	 *
	 * @return string El valor de la fecha.
	 */
	public function getFecha() { 
		return $this->fecha;
	} 

	/**
	 * Establece la fecha de la novedad.
	 *
	 * @param string $vl Fecha a asignar.
	 * @return self
	 */
	public function setFecha($vl) { 
		$this->fecha = $vl;
		return $this;
	} 

	/**
	 * Obtiene el usuario que registró la novedad.
	 *
	 * @return string El valor del usuario.
	 */
	public function getUsuario() { 
		return $this->usuario;
	} 

	/**
	 * Establece el usuario que registró la novedad.
	 *
	 * @param string $vl Usuario a asignar.
	 * @return self
	 */
	public function setUsuario($vl) { 
		$this->usuario = $vl;
		return $this;
	} 

	/**
	 * Obtiene la fecha de modificación de la novedad.
	 *
	 * @return string El valor de la fecha de modificación.
	 */
	public function getFechamodifica() { 
		return $this->fechamodifica;
	} 

	/**
	 * Establece la fecha de modificación de la novedad.
	 *
	 * @param string $vl Fecha de modificación a asignar.
	 * @return self
	 */
	public function setFechamodifica($vl) { 
		$this->fechamodifica = $vl;
		return $this;
	} 

	/**
	 * Obtiene los honorarios de la novedad.
	 *
	 * @return string El valor de honorarios.
	 */
	public function getHonorarios() { 
		return $this->honorarios;
	} 

	/**
	 * Establece los honorarios de la novedad.
	 *
	 * @param string $vl Honorarios a asignar.
	 * @return self
	 */
	public function setHonorarios($vl) { 
		$this->honorarios = $vl;
		return $this;
	} 

	/**
	 * Obtiene el CRP de la novedad.
	 *
	 * @return string El valor del CRP.
	 */
	public function getCrp() { 
		return $this->crp;
	} 

	/**
	 * Establece el CRP de la novedad.
	 *
	 * @param string $vl CRP a asignar.
	 * @return self
	 */
	public function setCrp($vl) { 
		$this->crp = $vl;
		return $this;
	} 

	/**
	 * Obtiene el identificador del detalle del contrato del empleado.
	 *
	 * @return integer El valor del identificador del contrato.
	 */
	public function getEmpleadosdetallescontrato_id() { 
		return $this->empleadosdetallescontrato_id;
	} 

	/**
	 * Establece el identificador del detalle del contrato del empleado.
	 *
	 * @param integer $vl Identificador del contrato a asignar.
	 * @return self
	 */
	public function setEmpleadosdetallescontrato_id($vl) { 
		$this->empleadosdetallescontrato_id = $vl;
		return $this;
	} 

	/**
	 * Obtiene el identificador del estado de la novedad.
	 *
	 * @return integer El valor del identificador del estado.
	 */
	public function getEmpleadosdetallescontratonovedadesestados_id() { 
		return $this->empleadosdetallescontratonovedadesestados_id;
	} 

	/**
	 * Establece el identificador del estado de la novedad.
	 *
	 * @param integer $vl Identificador del estado a asignar.
	 * @return self
	 */
	public function setEmpleadosdetallescontratonovedadesestados_id($vl) { 
		$this->empleadosdetallescontratonovedadesestados_id = $vl;
		return $this;
	} 

} 
?>
