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

	public function getId (){ 
		return $this->id;
	} 
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	public function getTipotele_id (){ 
		return $this->tipotele_id;
	} 
	public function setTipotele_id ( $vl ){ 
		$this->tipotele_id = $vl;
	} 
	public function getValor (){ 
		return $this->valor;
	} 
	public function setValor ( $vl ){ 
		$this->valor = $vl;
	} 
	public function getEstudiante_id (){ 
	    return $this->empleados_id;
	} 
	public function setEstudiante_id ( $vl ){ 
	    $this->empleados_id = $vl;
	} 
} 
?>