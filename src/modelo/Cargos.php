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

	/**
	 * Obtiene el identificador del objeto.
	 *
	 * @return mixed El valor del id.
	 */
	public function getId (){ 
		return $this->id;
	} 

	/**
	 * Establece el identificador del cargo.
	 *
	 * @param mixed $vl Valor del identificador.
	 * @return void
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	
	/**
	 * Obtiene el nombre del cargo.
	 *
	 * @return mixed El valor del nombre.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del cargo.
	 *
	 * @param mixed $vl Valor del nombre.
	 * @return void
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	/**
	 * Obtiene la descripción del cargo.
	 *
	 * @return mixed El valor de la descripción.
	 */
	public function getDescripcion (){ 
		return $this->descripcion;
	} 
	/**
	 * Establece la descripción del cargo.
	 *
	 * @param mixed $vl Valor de la descripción.
	 * @return void
	 */
	public function setDescripcion ( $vl ){ 
		$this->descripcion = $vl;
	} 
} 
?>