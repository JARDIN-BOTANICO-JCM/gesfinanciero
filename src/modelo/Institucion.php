<?php 
/**
 *
 * @author yalfonso
 *
 */
class Institucion extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 
	private $direccion = ""; 
	private $telefono = ""; 
	private $dane = ""; 
	private $licencia = ""; 
	private $nit = ""; 
	private $resolucion = ""; 
	private $lugares_id = 0; 
	private $anyolectivo_id = 0; 
	private $usuarios_id = 0; 

	/**
	 * Obtiene el identificador de la institución.
	 *
	 * @return mixed Identificador de la institución.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador de la institución.
	 *
	 * @param mixed $vl Identificador de la institución.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre de la institución.
	 *
	 * @return mixed Nombre de la institución.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre de la institución.
	 *
	 * @param mixed $vl Nombre de la institución.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
	/**
	 * Obtiene la dirección de la institución.
	 *
	 * @return mixed Dirección de la institución.
	 */
	public function getDireccion (){ 
		return $this->direccion;
	} 
	/**
	 * Establece la dirección de la institución.
	 *
	 * @param mixed $vl Dirección de la institución.
	 */
	public function setDireccion ( $vl ){ 
		$this->direccion = $vl;
	} 
	/**
	 * Obtiene el teléfono de la institución.
	 *
	 * @return mixed Teléfono de la institución.
	 */
	public function getTelefono (){ 
		return $this->telefono;
	} 
	/**
	 * Establece el teléfono de la institución.
	 *
	 * @param mixed $vl Teléfono de la institución.
	 */
	public function setTelefono ( $vl ){ 
		$this->telefono = $vl;
	} 
	/**
	 * Obtiene el DANE de la institución.
	 *
	 * @return mixed DANE de la institución.
	 */
	public function getDane (){ 
		return $this->dane;
	} 
	/**
	 * Establece el DANE de la institución.
	 *
	 * @param mixed $vl DANE de la institución.
	 */
	public function setDane ( $vl ){ 
		$this->dane = $vl;
	} 
	/**
	 * Obtiene la licencia de la institución.
	 *
	 * @return mixed Licencia de la institución.
	 */
	public function getLicencia (){ 
		return $this->licencia;
	} 
	/**
	 * Establece la licencia de la institución.
	 *
	 * @param mixed $vl Licencia de la institución.
	 */
	public function setLicencia ( $vl ){ 
		$this->licencia = $vl;
	} 

	/**
	 * Obtiene el NIT de la institución.
	 *
	 * @return string|null NIT (Número de Identificación Tributaria) o null si no está definido.
	 */
	public function getNit (){ 
		return $this->nit;
	} 
	/**
	 * Establece el NIT de la institución.
	 *
	 * @param string|null $vl NIT (Número de Identificación Tributaria) o null si no está definido.
	 */
	public function setNit ( $vl ){ 
		$this->nit = $vl;
	} 
	/**
	 * Obtiene la resolución de la institución.
	 *
	 * @return mixed Resolución de la institución.
	 */
	public function getResolucion (){ 
		return $this->resolucion;
	} 

	/**
	 * Establece la resolución de la institución.
	 *
	 * @param mixed $vl Valor de la resolución a asignar.
	 * @return void
	 */
	public function setResolucion ( $vl ){ 
		$this->resolucion = $vl;
	} 

	/**
	 * Obtiene el identificador del lugar asociado.
	 *
	 * @return int|null ID del lugar.
	 */
	public function getLugares_id (){ 
		return $this->lugares_id;
	}
	/**
	 * Establece el identificador del lugar asociado.
	 *
	 * @param int|null $vl ID del lugar.
	 */ 
	public function setLugares_id ( $vl ){ 
		$this->lugares_id = $vl;
	} 
	/**
	 * Obtiene el identificador del año lectivo asociado.
	 *
	 * @return int|null ID del año lectivo.
	 */
	public function getAnyolectivo_id (){ 
		return $this->anyolectivo_id;
	} 
	/**
	 * Establece el ID del año lectivo.
	 *
	 * @param int $vl ID del año lectivo.
	 * @return void
	 */
	public function setAnyolectivo_id ( $vl ){ 
		$this->anyolectivo_id = $vl;
	} 
	
	/**
	 * Obtiene el ID del usuario asociado.
	 *
	 * @return int|null ID del usuario.
	 */
	public function getUsuarios_id (){ 
		return $this->usuarios_id;
	} 
	/**
	 * Establece el ID del usuario asociado.
	 *
	 * @param int $vl ID del usuario.
	 * @return void
	 */
	public function setUsuarios_id ( $vl ){ 
		$this->usuarios_id = $vl;
	} 
} 
?>