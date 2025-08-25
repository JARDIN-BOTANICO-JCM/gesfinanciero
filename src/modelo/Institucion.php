<?php 
/**
 *
 * @author yalfonso
 *
 */
class Institucion extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 
	private $direccion = ""; 
	private $telefono = ""; 
	private $dane = ""; 
	private $licencia = ""; 
	private $nit = ""; 
	private $resolucion = ""; 
	private $lugares_id = 0; 
	private $anyolectivo_id = 0; 
	private $usuarios_id = 0; 

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
	public function getDireccion (){ 
		return $this->direccion;
	} 
	public function setDireccion ( $vl ){ 
		$this->direccion = $vl;
	} 
	public function getTelefono (){ 
		return $this->telefono;
	} 
	public function setTelefono ( $vl ){ 
		$this->telefono = $vl;
	} 
	public function getDane (){ 
		return $this->dane;
	} 
	public function setDane ( $vl ){ 
		$this->dane = $vl;
	} 
	public function getLicencia (){ 
		return $this->licencia;
	} 
	public function setLicencia ( $vl ){ 
		$this->licencia = $vl;
	} 
	public function getNit (){ 
		return $this->nit;
	} 
	public function setNit ( $vl ){ 
		$this->nit = $vl;
	} 
	public function getResolucion (){ 
		return $this->resolucion;
	} 
	public function setResolucion ( $vl ){ 
		$this->resolucion = $vl;
	} 
	public function getLugares_id (){ 
		return $this->lugares_id;
	} 
	public function setLugares_id ( $vl ){ 
		$this->lugares_id = $vl;
	} 
	public function getAnyolectivo_id (){ 
		return $this->anyolectivo_id;
	} 
	public function setAnyolectivo_id ( $vl ){ 
		$this->anyolectivo_id = $vl;
	} 
	public function getUsuarios_id (){ 
		return $this->usuarios_id;
	} 
	public function setUsuarios_id ( $vl ){ 
		$this->usuarios_id = $vl;
	} 
} 
?>