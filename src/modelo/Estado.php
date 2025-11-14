<?php 
/**
 *
 * @author yalfonso
 *
 */
class Estado extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del estado.
	 *
	 * @return mixed El valor del identificador.
	 */
	public function getId (){ 
		return $this->id;
	} 

	/**
	 * Establece el identificador del estado.
	 *
	 * @param mixed $vl Identificador a asignar.
	 * @return void
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del estado.
	 *
	 * @return mixed El valor del nombre.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del estado.
	 *
	 * @param mixed $vl Nombre a asignar.
	 * @return void
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>