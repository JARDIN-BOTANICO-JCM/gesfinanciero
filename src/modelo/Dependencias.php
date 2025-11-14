<?php
/**
 *
 * @author yalfonso
 *
 */
class Dependencias extends Clsdatos {
    
    private $id = 0;
    private $nombre = "";
    private $usuarios_id = 0;
    /**
     * Obtiene el identificador de la dependencia.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre de la dependencia.
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     *  Obtiene el ID del usuario asociado a la dependencia.
     * @return number
     */
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * Establece el identificador de la dependencia.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre de la dependencia.
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Establece el ID del usuario asociado a la dependencia.
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

}
?>