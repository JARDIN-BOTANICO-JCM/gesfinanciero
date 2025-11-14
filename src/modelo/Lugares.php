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

	/**
	 * Devuelve el identificador del lugar.
	 *
	 * @return int|null Id del registro o null si no está definido.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del lugar.
	 *
	 * @param int|null $vl Id del registro o null si no está definido.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 

	/**
	 * Obtiene el nombre del lugar.
	 *
	 * @return string|null Nombre del lugar.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del lugar.
	 *
	 * @param string|null $vl Nombre del lugar.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	/**
	 * Obtiene el identificador del departamento asociado al lugar.
	 *
	 * @return int|null ID del departamento.
	 */
	public function getDepartamento_id (){ 
		return $this->departamento_id;
	} 
	/**
	 * Establece el identificador del departamento asociado al lugar.
	 *
	 * @param int|null $vl ID del departamento.
	 */
	public function setDepartamento_id ( $vl ){ 
		$this->departamento_id = $vl;
	} 
} 
?>