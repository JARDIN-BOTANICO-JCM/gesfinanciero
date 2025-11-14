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
     * Obtiene el valor aceptado para el requisito del template.
     * @return string
     */
    public function getAcepta()
    {
        return $this->acepta;
    }

    /**
     * Establece el valor aceptado para el requisito del template.
     * @param string $acepta
     */
    public function setAcepta($acepta)
    {
        $this->acepta = $acepta;
    }

    /**
     * Obtiene si el requisito del template es requerido.
     * @return number
     */
    public function getRequerido()
    {
        return $this->requerido;
    }

    /**
     * Establece si el requisito del template es requerido.
     * @param number $requerido
     */
    public function setRequerido($requerido)
    {
        $this->requerido = $requerido;
    }

    /**
     * Obtiene el identificador del tipo de requisito del paquete.
     * @return number
     */
    public function getPaquetereqtipos_id()
    {
        return $this->paquetereqtipos_id;
    }

    /**
     * Establece el identificador del tipo de requisito del paquete.
     * @param number $paquetereqtipos_id
     */
    public function setPaquetereqtipos_id($paquetereqtipos_id)
    {
        $this->paquetereqtipos_id = $paquetereqtipos_id;
    }

    /**
     * Obtiene el identificador del requisito del template.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene la referencia del requisito del template.
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Obtiene la descripción del requisito del template.
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene el identificador del requisito del template.
     * @return number
     */
    public function getRequerimientostpls_id()
    {
        return $this->requerimientostpls_id;
    }

    /**
     * Establece el identificador del requisito del template.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece la referencia del requisito del template.
     * @param string $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * Establece la descripción del requisito del template.
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece el identificador del requisito del template.
     * @param number $requerimientostpls_id
     */
    public function setRequerimientostpls_id($requerimientostpls_id)
    {
        $this->requerimientostpls_id = $requerimientostpls_id;
    }

}

?>