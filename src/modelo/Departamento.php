<?php 
/**
 *
 * @author yalfonso
 *
 */
class Departamento extends Clsdatos { 

	private $id = 0; 
	private $codigo = ""; 
	private $nombre = ""; 
	private $paises_id = 0; 

	/**
	 * Retorna el identificador del departamento.
	 *
	 * @return int|null ID del departamento.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del departamento.
	 *
	 * @param int $vl ID del departamento.
	 * @return void
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 

	/**
	 * Obtiene el código del departamento.
	 *
	 * @return mixed Código del departamento.
	 */
	public function getCodigo (){ 
		return $this->codigo;
	} 
	/**
	 * Establece el código del departamento.
	 *
	 * @param mixed $vl Código del departamento.
	 * @return void
	 */
	public function setCodigo ( $vl ){ 
		$this->codigo = $vl;
	} 
	/**
	 * Obtiene el nombre del departamento.
	 *
	 * @return mixed Nombre del departamento.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del departamento.
	 *
	 * @param mixed $vl Nombre del departamento.
	 * @return void
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	/**
	 * Obtiene el ID del país asociado al departamento.
	 *
	 * @return mixed ID del país.
	 */
	public function getPaises_id (){ 
		return $this->paises_id;
	} 
	/**
	 * Establece el ID del país asociado al departamento.
	 *
	 * @param mixed $vl ID del país.
	 * @return void
	 */
	public function setPaises_id ( $vl ){ 
		$this->paises_id = $vl;
	} 
} 
?>