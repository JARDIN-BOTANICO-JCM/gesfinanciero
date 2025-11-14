<?php 
/**
 *
 * @author yalfonso
 *
 * version 1.6.1.100:
 * Se agrega un nuevo perfil que permite controlar usuarios t&eacute;cnicos pero con vistas agregadas
 * 
 * UPDATE `perfilusuarios` SET `nombre`='T&eacute;cnico' WHERE `id`='3'; INSERT INTO `perfilusuarios` (`id`, `nombre`, `privilegios`) VALUES ('4', 'T&eacute;cnico avanzado', '');
 * 
 */
class Perfilusuarios extends Clsdatos { 

	private $id = 0; 
	private $nombre = ""; 

	/**
	 * Obtiene el identificador del perfil de usuario.
	 *
	 * @return int|null Identificador del perfil o null si no está establecido.
	 */
	public function getId (){ 
		return $this->id;
	} 
	/**
	 * Establece el identificador del perfil de usuario.
	 *
	 * @param int $vl Identificador del perfil.
	 */
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	/**
	 * Obtiene el nombre del perfil de usuario.
	 *
	 * @return string Nombre del perfil.
	 */
	public function getNombre (){ 
		return $this->nombre;
	} 
	/**
	 * Establece el nombre del perfil de usuario.
	 *
	 * @param string $vl Nombre del perfil.
	 */
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>