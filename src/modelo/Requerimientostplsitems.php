<?php
/**
 *
 * @author yalfonso
 *
 */
class Requerimientostplsitems extends Clsdatos {
    private $id = 0;
    private $ref = '';
    private $descripcion = '';
    private $requerimientostpls_id = 1;
    private $paquetereqtipos_id = 1;
    private $requerido = 0;
    private $acepta = "";
    
    /**
     * @return string
     */
    public function getAcepta()
    {
        return $this->acepta;
    }

    /**
     * @param string $acepta
     */
    public function setAcepta($acepta)
    {
        $this->acepta = $acepta;
    }

    /**
     * @return number
     */
    public function getRequerido()
    {
        return $this->requerido;
    }

    /**
     * @param number $requerido
     */
    public function setRequerido($requerido)
    {
        $this->requerido = $requerido;
    }

    /**
     * @return number
     */
    public function getPaquetereqtipos_id()
    {
        return $this->paquetereqtipos_id;
    }

    /**
     * @param number $paquetereqtipos_id
     */
    public function setPaquetereqtipos_id($paquetereqtipos_id)
    {
        $this->paquetereqtipos_id = $paquetereqtipos_id;
    }

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
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return number
     */
    public function getRequerimientostpls_id()
    {
        return $this->requerimientostpls_id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param number $requerimientostpls_id
     */
    public function setRequerimientostpls_id($requerimientostpls_id)
    {
        $this->requerimientostpls_id = $requerimientostpls_id;
    }

}

?>