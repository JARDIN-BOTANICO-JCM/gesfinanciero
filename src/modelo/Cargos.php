<?php 
/**
 *
 * @author yalfonso
 *
 */
class Cargos extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 
	private $descripcion = ""; 

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
	public function getDescripcion (){ 
		return $this->descripcion;
	} 
	public function setDescripcion ( $vl ){ 
		$this->descripcion = $vl;
	} 
} 
?>