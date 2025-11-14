<?php 
/**
 *
 * @author yalfonso
 *
 */
class Tipodoc extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Devuelve el identificador del tipo de documento.
	 *
	 * @return int|null Identificador (o null si no está definido).
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del tipo de documento.
	 *
	 * @param int $vl Identificador del tipo de documento.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Devuelve el nombre del tipo de documento.
	 *
	 * @return string|null Nombre del tipo de documento (o null si no está definido).
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del tipo de documento.
	 *
	 * @param string $vl Nombre del tipo de documento.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>