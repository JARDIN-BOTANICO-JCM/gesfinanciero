<?php 
/**
 *
 * @author yalfonso
 *
 */
class Lugares extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 
	private $departamento_id = 0; 

	public function getId (){ 
		return $this->id;
	} 
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	public function getNombre (){ 
		return $this->nombre;
	} 
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	public function getDepartamento_id (){ 
		return $this->departamento_id;
	} 
	public function setDepartamento_id ( $vl ){ 
		$this->departamento_id = $vl;
	} 
} 
?>