<?php
/**
 *
 * @author yalfonso
 *
 */
class Paquetesrequ extends Clsdatos { 
    private $id = 0;
    private $ref = "";
    private $valor = "";
    private $descripcion = "";
    private $paquetesreqestados_id = 0;
    private $paquetereqtipos_id = 0;
    private $paquetes_id = 0;
    private $flujositems_id = 0;
    private $valorgestor = ""; // aqui actualiza la ruta del documento que entrega el gestor documental
    
    private $fecha = '1900-01-01 00:00:00';
    private $fechamod = '1900-01-01 00:00:00';
    private $usuariomodifica = '';
    private $perfilmodifica = '';
    
    /**
     * Obtiene la fecha del requisito del paquete.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene la fecha de modificación del requisito del paquete.
     * @return string
     */
    public function getFechamod()
    {
        return $this->fechamod;
    }

    /**
     * Obtiene el usuario que modificó el requisito del paquete.
     * @return string
     */
    public function getUsuariomodifica()
    {
        return $this->usuariomodifica;
    }

    /**
     * Obtiene el perfil que modificó el requisito del paquete.
     * @return string
     */
    public function getPerfilmodifica()
    {
        return $this->perfilmodifica;
    }

    /**
     * Establece la fecha del requisito del paquete.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece la fecha de modificación del requisito del paquete.
     * @param string $fechamod
     */
    public function setFechamod($fechamod)
    {
        $this->fechamod = $fechamod;
    }

    /**
     * Establece el usuario que modificó el requisito del paquete.
     * @param string $usuariomodifica
     */
    public function setUsuariomodifica($usuariomodifica)
    {
        $this->usuariomodifica = $usuariomodifica;
    }

    /**
     * Establece el perfil que modificó el requisito del paquete.
     * @param string $perfilmodifica
     */
    public function setPerfilmodifica($perfilmodifica)
    {
        $this->perfilmodifica = $perfilmodifica;
    }

    /**
     * Obtiene el valor del gestor documental asociado al requisito del paquete.
     * @return string
     */
    public function getValorgestor()
    {
        return $this->valorgestor;
    }

    /**
     * Establece el valor del gestor documental asociado al requisito del paquete.
     * @param string $valorgestor
     */
    public function setValorgestor($valorgestor)
    {
        $this->valorgestor = $valorgestor;
    }

    /**
     * Obtiene el identificador del requisito del paquete.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene la referencia del requisito del paquete.
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Obtiene el valor del requisito del paquete.
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Obtiene la descripción del requisito del paquete.
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene el identificador del estado del requisito del paquete.
     * @return number
     */
    public function getPaquetesreqestados_id()
    {
        return $this->paquetesreqestados_id;
    }

    /**
     * Obtiene el identificador del tipo del requisito del paquete.
     * @return number
     */
    public function getPaquetereqtipos_id()
    {
        return $this->paquetereqtipos_id;
    }

    /**
     * Obtiene el identificador del paquete asociado al requisito.
     * @return number
     */
    public function getPaquetes_id()
    {
        return $this->paquetes_id;
    }

    /**
     * Obtiene el identificador del ítem de flujo asociado al requisito del paquete.
     * @return number
     */
    public function getFlujositems_id()
    {
        return $this->flujositems_id;
    }

    /**
     * Establece el identificador del requisito del paquete.
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Establece la referencia del requisito del paquete.
     * @param string $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * Establece el valor del requisito del paquete.
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * Establece la descripción del requisito del paquete.
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece el identificador del estado del requisito del paquete.
     * @param number $paquetesreqestados_id
     */
    public function setPaquetesreqestados_id($paquetesreqestados_id)
    {
        $this->paquetesreqestados_id = $paquetesreqestados_id;
    }

    /**
     * Establece el identificador del tipo del requisito del paquete.
     * @param number $paquetereqtipos_id
     */
    public function setPaquetereqtipos_id($paquetereqtipos_id)
    {
        $this->paquetereqtipos_id = $paquetereqtipos_id;
    }

    /**
     * Establece el identificador del paquete asociado al requisito.
     * @param number $paquetes_id
     */
    public function setPaquetes_id($paquetes_id)
    {
        $this->paquetes_id = $paquetes_id;
    }

    /**
     * Establece el identificador del ítem de flujo asociado al requisito del paquete.
     * @param number $flujositems_id
     */
    public function setFlujositems_id($flujositems_id)
    {
        $this->flujositems_id = $flujositems_id;
    }

}

?>