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
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre.
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtiene el título.
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Obtiene la descripción.
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene el JSON.
     * @return string
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * Obtiene la fecha.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene los usuarios.
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Obtiene el identificador del estado del formulario.
     * @return number
     */
    public function getFormulariosestados_id()
    {
        return $this->formulariosestados_id;
    }

    /**
     * Establece el identificador.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre.
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Establece el título.
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Establece la descripción.
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece el JSON.
     * @param string $json
     */
    public function setJson($json)
    {
        $this->json = $json;
    }

    /**
     * Establece la fecha.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece los usuarios.
     * @param string $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Establece el identificador del estado del formulario.
     * @param number $formulariosestados_id
     */
    public function setFormulariosestados_id($formulariosestados_id)
    {
        $this->formulariosestados_id = $formulariosestados_id;
    }

} 
?>