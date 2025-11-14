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
     * Obtiene el identificador del objeto.
     *
     * @return number Identificador del registro.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre asociado al objeto.
     *
     * @return string Nombre almacenado en la propiedad $nombre.
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * Devuelve la etiqueta asociada al objeto.
     *
     * @return string La etiqueta actual o null si no está definida.
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Devuelve la colección de usuarios asociados.
     *
     * @return string usuarios, o null si no existen.
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Devuelve la fecha asociada al objeto.
     *
     * @return string Fecha almacenada.
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Devuelve el valor de la propiedad "multiple".
     *
     * @return number Valor almacenado en $this->multiple.
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * @return string
     */

    /**
     * Devuelve los tipos aceptados.
     *
     * @return string tipos aceptados o null si no hay ninguno.
     */
    public function getTiposaceptados()
    {
        return $this->tiposaceptados;
    }

    /**
     * Establece el identificador del objeto.
     *
     * @param mixed $id Identificador a asignar.
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre del elemento.
     *
     * @param string $nombre Nombre a asignar.
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Establece la etiqueta del objeto.
     *
     * @param string $label Etiqueta a asignar.
     * @return void
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Asigna la colección de usuarios al objeto.
     *
     * @param string $usuarios Usuarios .
     * @return void
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Establece la fecha del objeto.
     *
     * @param string $fecha Fecha a asignar (por ejemplo, cadena o \DateTime).
     * @return void
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece si el elemento permite múltiples valores.
     *
     * @param number $multiple Valor lógico que activa o desactiva la multiplicidad.
     * @return void
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * Establece los tipos aceptados para este objeto.
     *
     * @param string $tiposaceptados Tipos aceptados (por ejemplo, array de extensiones o cadena).
     * @return void
     */
    public function setTiposaceptados($tiposaceptados)
    {
        $this->tiposaceptados = $tiposaceptados;
    }

} 
?>