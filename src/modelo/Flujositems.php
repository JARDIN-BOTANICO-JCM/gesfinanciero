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
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return number
     */
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * @param number $usuarios_id
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
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
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return number
     */
    public function getRequerimientos()
    {
        return $this->requerimientos;
    }

    /**
     * @return number
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @return number
     */
    public function getFlujositemestados_id()
    {
        return $this->flujositemestados_id;
    }

    /**
     * @return number
     */
    public function getFlujosroles_id()
    {
        return $this->flujosroles_id;
    }

    /**
     * @return number
     */
    public function getFlujos_id()
    {
        return $this->flujos_id;
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
     * @param string $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @param number $requerimientos
     */
    public function setRequerimientos($requerimientos)
    {
        $this->requerimientos = $requerimientos;
    }

    /**
     * @param number $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * @param number $flujositemestados_id
     */
    public function setFlujositemestados_id($flujositemestados_id)
    {
        $this->flujositemestados_id = $flujositemestados_id;
    }

    /**
     * @param number $flujosroles_id
     */
    public function setFlujosroles_id($flujosroles_id)
    {
        $this->flujosroles_id = $flujosroles_id;
    }

    /**
     * @param number $flujos_id
     */
    public function setFlujos_id($flujos_id)
    {
        $this->flujos_id = $flujos_id;
    }

}

?>