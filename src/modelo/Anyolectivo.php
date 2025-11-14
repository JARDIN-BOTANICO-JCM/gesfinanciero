<?php 
/**
 *
 * @author yalfonso
 *
 */


/**
 * Clase que representa un año lectivo.
 *
 * Contiene identificador y nombre, con getters y setters básicos.
 */
class Anyolectivo extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	
	/**
	 * Obtiene el identificador del año lectivo.
	 *
	 * @returnmixed Identificador del registro
	 */
	public function getId (){ 
		return $this->id;
	} 

	/**
	 * Establece el ID del registro de año lectivo.
	 *
	 * @param mixed $vl Valor del identificador.
	 * @return void
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del año lectivo.
	 *
	 * @returnmixed Nombre del año lectivo
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del año lectivo.
	 *
	 * @param mixed $vl Nombre a asignar.
	 * @return void
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>