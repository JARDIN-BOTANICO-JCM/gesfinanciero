<?php 
/**
 *
 * @author yalfonso
 *
 */
class Telefonosempleado extends Clsdatos { 

	private $id = 0; 
	private $tipotele_id = 0; 
	private $valor = ""; 
	private $empleados_id = 0; 

	/**
	 * Devuelve el identificador del teléfono del empleado.
	 *
	 * @return int|null Identificador del registro o null si no está definido.
	 */
	public function getId (){ 
		return $this->id;
	} 
	
	/**
	 * Establece el identificador del teléfono del empleado.
	 *
	 * @param int $vl Identificador del teléfono del empleado.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Devuelve el tipo de teléfono del empleado.
	 *
	 * @return int|null Tipo de teléfono o null si no está definido.
	 */
	public function getTipotele_id (){ 
		return $this->tipotele_id;
	} 
	/**
	 * Establece el tipo de teléfono del empleado.
	 *
	 * @param int $vl Tipo de teléfono.
	 */
	public function setTipotele_id ( $vl ){ 
		$this->tipotele_id = $vl;
	} 
	/**
	 * Devuelve el valor del teléfono del empleado.
	 *
	 * @return string|null Valor del teléfono o null si no está definido.
	 */
	public function getValor (){ 
		return $this->valor;
	} 
	/**
	 * Establece el valor del teléfono del empleado.
	 *
	 * @param string $vl Valor del teléfono.
	 */
	public function setValor ( $vl ){ 
		$this->valor = $vl;
	} 
	/**
	 * Devuelve el identificador del empleado asociado al teléfono.
	 *
	 * @return int|null Identificador del empleado o null si no está definido.
	 */
	public function getEstudiante_id (){ 
	    return $this->empleados_id;
	} 
	/**
	 * Establece el identificador del Estudiante asociado al teléfono.
	 *
	 * @param int $vl Identificador del empleado.
	 */
	public function setEstudiante_id ( $vl ){ 
	    $this->empleados_id = $vl;
	} 
} 
?>