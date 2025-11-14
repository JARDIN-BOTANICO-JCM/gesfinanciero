<?php 
/**
 *
 * @author yalfonso
 *
 */
class Firmasestados extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Devuelve el identificador del registro.
	 *
	 * @return int|null Identificador (ID) o null si no está definido.
	 */
	public function getId (){ 
		return $this->id;
	} 

	/**
	 * Establece el identificador del objeto.
	 *
	 * @param mixed $vl Valor del identificador.
	 * @return void
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 

	/**
	 * Devuelve el nombre asociado al registro.
	 *
	 * @return string|null Nombre (o null si no está definido).
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 

	/**
	 * Establece el nombre.
	 *
	 * @param string $vl Nombre a asignar.
	 * @return void
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>