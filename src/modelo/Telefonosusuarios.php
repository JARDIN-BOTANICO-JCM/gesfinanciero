<?php 
/**
 *
 * @author yalfonso
 *
 */
class Telefonosusuarios extends Clsdatos { 

	private $id = 0; 
	private $valor = ""; 
	private $tipotele_id = 0; 
	private $usuarios_id = 0; 

	public function getId (){ 
		return $this->id;
	} 
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	public function getValor (){ 
		return $this->valor;
	} 
	public function setValor ( $vl ){ 
		$this->valor = $vl;
	} 
	public function getTipotele_id (){ 
		return $this->tipotele_id;
	} 
	public function setTipotele_id ( $vl ){ 
		$this->tipotele_id = $vl;
	} 
	public function getUsuarios_id (){ 
		return $this->usuarios_id;
	} 
	public function setUsuarios_id ( $vl ){ 
		$this->usuarios_id = $vl;
	} 
} 
?>