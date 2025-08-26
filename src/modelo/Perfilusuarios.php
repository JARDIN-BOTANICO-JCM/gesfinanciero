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

	public function getId (){ 
		return $this->id;
	} 
	public function setId ( $vl ){ 
		$this->id = $vl;
	} 
	public function getNombre (){ 
		return $this->nombre;
	} 
	public function setNombre ( $vl ){ 
		$this->nombre = $vl;
	} 
} 
?>