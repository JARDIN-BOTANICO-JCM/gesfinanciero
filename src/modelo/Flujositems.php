<?php
/**
 *
 * @author yalfonso
 *
 */
class Flujositems extends Clsdatos { 
    private $id = 0;
    private $nombre = '';
    private $correo = '';
    private $tel = '';
    private $requerimientos = 1;
    private $orden = 0;
    private $flujositemestados_id = 1;
    private $flujosroles_id = 1;
    private $flujos_id = 1;
    private $usuarios_id = 0;
    
    /**
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el identificador del usuario.
     * @return number
     */
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * Establece el identificador del usuario.
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
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
     * Obtiene el correo.
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Obtiene el teléfono.
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Obtiene los requerimientos.
     * @return number
     */
    public function getRequerimientos()
    {
        return $this->requerimientos;
    }

    /**
     * Obtiene el orden.
     * @return number
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Obtiene el identificador del estado del ítem del flujo.
     * @return number
     */
    public function getFlujositemestados_id()
    {
        return $this->flujositemestados_id;
    }

    /**
     * Obtiene el identificador del rol del flujo.
     * @return number
     */
    public function getFlujosroles_id()
    {
        return $this->flujosroles_id;
    }

    /**
     * Obtiene el identificador del flujo.
     * @return number
     */
    public function getFlujos_id()
    {
        return $this->flujos_id;
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
     * Establece el correo.
     * @param string $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * Establece el teléfono.
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * Establece los requerimientos.
     * @param number $requerimientos
     */
    public function setRequerimientos($requerimientos)
    {
        $this->requerimientos = $requerimientos;
    }

    /**
     * Establece el orden.
     * @param number $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * Establece el identificador del estado del ítem del flujo.
     * @param number $flujositemestados_id
     */
    public function setFlujositemestados_id($flujositemestados_id)
    {
        $this->flujositemestados_id = $flujositemestados_id;
    }

    /**
     * Establece el identificador del rol del flujo.
     * @param number $flujosroles_id
     */
    public function setFlujosroles_id($flujosroles_id)
    {
        $this->flujosroles_id = $flujosroles_id;
    }

    /**
     * Establece el identificador del flujo.
     * @param number $flujos_id
     */
    public function setFlujos_id($flujos_id)
    {
        $this->flujos_id = $flujos_id;
    }

}

?>