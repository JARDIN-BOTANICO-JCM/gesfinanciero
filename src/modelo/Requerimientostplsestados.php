<?php
/**
 *
 * @author yalfonso
 *
 */
class Requerimientostplsestados extends Clsdatos { 
    private $id = 0;
    private $nombre = '';
    
    /**
     * Obtiene el identificador del estado del requisito del template.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre del estado del requisito del template.
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establece el identificador del estado del requisito del template.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece el nombre del estado del requisito del template.
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}

?>