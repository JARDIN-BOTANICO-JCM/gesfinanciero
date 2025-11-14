<?php 
/**
 *
 * @author yalfonso
 *
 */
class Telefonosusuarios extends Clsdatos { 

	private $id = 0; 
	private $valor = ""; 
	private $tipotele_id = 0; 
	private $usuarios_id = 0; 

	/**
	 * Devuelve el identificador del registro.
	 *
	 * @return mixed Identificador del registro.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del registro.
	 *
	 * @param mixed $vl Identificador del registro.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 

	/**
	 * Obtiene el valor de la propiedad $valor.
	 *
	 * @return mixed Valor almacenado en $this->valor.
	 */
	public function getValor (){ 
		return $this->valor;
	} 
	/**
	 * Establece el valor de la propiedad $valor.
	 *
	 * @param mixed $vl Nuevo valor para la propiedad $valor.
	 */
	public function setValor ( $vl ){ 
		$this->valor = $vl;
	} 
	/**
	 * Obtiene el tipo de teléfono.
	 *
	 * @return mixed Tipo de teléfono almacenado en $this->tipotele_id.
	 */
	public function getTipotele_id (){ 
		return $this->tipotele_id;
	} 
	/**
	 * Establece el tipo de teléfono.
	 *
	 * @param mixed $vl Nuevo tipo de teléfono para la propiedad $tipotele_id.
	 */
	public function setTipotele_id ( $vl ){ 
		$this->tipotele_id = $vl;
	} 
	/**
	 * Obtiene el identificador del usuario asociado al teléfono.
	 *
	 * @return mixed Identificador del usuario almacenado en $this->usuarios_id.
	 */
	public function getUsuarios_id (){ 
		return $this->usuarios_id;
	} 
	/**
	 * Establece el identificador del usuario asociado al teléfono.
	 *
	 * @param mixed $vl Nuevo identificador para la propiedad $usuarios_id.
	 */
	public function setUsuarios_id ( $vl ){ 
		$this->usuarios_id = $vl;
	} 
} 
?>