<?php 
/**
 *
 * @author yalfonso
 *
 */
class Formularios extends Clsdatos { 

	private $id = 0;
	private $nombre = "";
	private $titulo = "";
	private $descripcion = "";
	private $json = "[]";
	private $fecha = "1900-01-01 00:00:00";
	private $usuarios = "";
	private $formulariosestados_id = 0;
	
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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return string
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @return number
     */
    public function getFormulariosestados_id()
    {
        return $this->formulariosestados_id;
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
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param string $json
     */
    public function setJson($json)
    {
        $this->json = $json;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @param number $formulariosestados_id
     */
    public function setFormulariosestados_id($formulariosestados_id)
    {
        $this->formulariosestados_id = $formulariosestados_id;
    }

} 
?>