<?php 
/**
 *
 * @author yalfonso
 *
 */
class Cargadatos extends Clsdatos { 
    
	private $id = 0; 
	private $nombre = "";
	private $label = "";
	private $usuarios = "";
	private $fecha = "1900-01-01 00:00:00";
	private $multiple = 0;
	private $tiposaceptados = "";
	
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return number
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * @return string
     */
    public function getTiposaceptados()
    {
        return $this->tiposaceptados;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param number $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @param string $tiposaceptados
     */
    public function setTiposaceptados($tiposaceptados)
    {
        $this->tiposaceptados = $tiposaceptados;
    }

} 
?>