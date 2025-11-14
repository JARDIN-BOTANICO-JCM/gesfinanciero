<?php 
/**
 *
 * @author yalfonso
 *
 */
class Tipotele extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del tipo.
	 *
	 * @return mixed Identificador del objeto.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del tipo.
	 *
	 * @param mixed $vl Identificador del objeto.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del tipo.
	 *
	 * @return mixed Nombre del objeto.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del tipo.
	 *
	 * @param mixed $vl Nombre del objeto.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>