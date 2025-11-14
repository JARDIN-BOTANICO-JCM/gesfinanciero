<?php 
/**
 *
 * @author yalfonso
 *
 */
class Titulos extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del título.
	 *
	 * @return mixed Identificador del título (int|string|null).
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del título.
	 *
	 * @param mixed $vl Identificador del título (int|string|null).
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del título.
	 *
	 * @return mixed Nombre del título (string|null).
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del título.
	 *
	 * @param mixed $vl Nombre del título (string|null).
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>