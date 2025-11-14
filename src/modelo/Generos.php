<?php 
/**
 *
 * @author yalfonso
 *
 */
class Generos extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del género.
	 *
	 * @return mixed Identificador del género.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del género.
	 *
	 * @param mixed $vl Identificador del género.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del género.
	 *
	 * @return mixed Nombre del género.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del género.
	 *
	 * @param mixed $vl Nombre del género.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>