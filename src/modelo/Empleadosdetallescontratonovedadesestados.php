<?php 
/**
 *
 * @author yalfonso
 *
 */
class Empleadosdetallescontratonovedadesestados extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del estado de la novedad.
	 *
	 * @return mixed El valor del identificador.
	 */
	public function getId (){ 
		return $this->id;
	} 

	/**
	 * Establece el identificador del estado de la novedad.
	 *
	 * @param mixed $vl Identificador a asignar.
	 * @return void
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 

	/**
	 * Obtiene el nombre del estado de la novedad.
	 *
	 * @return mixed El valor del nombre.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 

	/**
	 * Establece el nombre del estado de la novedad.
	 *
	 * @param mixed $vl Nombre a asignar.
	 * @return void
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 

} 
?>
