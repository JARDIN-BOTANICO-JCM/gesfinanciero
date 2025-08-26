<?php 
/**
 *
 * @author yalfonso
 *
 */
class Departamento extends Clsdatos { 

	private $id = 0; 
	private $codigo = ""; 
	private $nombre = ""; 
	private $paises_id = 0; 

	public function getId (){ 
		return $this->id;
	} 
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	public function getCodigo (){ 
		return $this->codigo;
	} 
	public function setCodigo ( $vl ){ 
		$this->codigo = $vl;
	} 
	public function getNombre (){ 
		return $this->nombre;
	} 
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	public function getPaises_id (){ 
		return $this->paises_id;
	} 
	public function setPaises_id ( $vl ){ 
		$this->paises_id = $vl;
	} 
} 
?>