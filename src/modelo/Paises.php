<?php 
/**
 *
 * @author yalfonso
 *
 */
class Paises extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del país.
	 *
	 * @return int|null El id del país.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del país.
	 *
	 * @param int|null $vl El id del país.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del país.
	 *
	 * @return string|null El nombre del país.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del país.
	 *
	 * @param string|null $vl El nombre del país.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>