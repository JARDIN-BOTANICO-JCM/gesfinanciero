<?php 
/**
 *
 * @author yalfonso
 *
 */

/**
 * Establece la fecha del registro.
 *
 * @param string $fecha Fecha en formato 'YYYY-MM-DD HH:MM:SS'.
 * @return void
 */
class Apibox extends Clsdatos { 

	private $id = 0; 
	private $usuarios_id = 0;
	private $publica = "";
	private $privada = "";
	private $activo = 0;
	private $fecha = "1900-01-01 00:00:00";
	
    /**
     * @return 
     */
    /**
     * Devuelve el valor de la propiedad privada.
     *
     * @return string El valor almacenado en $privada.
     */
    public function getPrivada()
    {
        return $this->privada;
    }

    /**
     * Establece el valor de la propiedad privada.
     *
     * @param string $privada Nuevo valor para la propiedad privada.
     */
    public function setPrivada($privada)
    {
        $this->privada = $privada;
    }

    /**
     * Obtiene el identificador del objeto.
     *
     * @return int|null El ID del objeto.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Devuelve el ID del usuario asociado.
     *
     * @return int|null ID del usuario
     */
    public function getUsuarios_id()
    {
        return $this->usuarios_id;
    }

    /**
     * Devuelve el valor de la propiedad 'publica'.
     *
     * @return mixed Valor de la propiedad pública.
     */
    public function getPublica()
    {
        return $this->publica;
    }

    /**
     * @return number
     */

    /**
     * Obtiene el estado de activo del registro.
     *
     * @return number 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Obtiene la fecha almacenada.
     *
     * @return string Fecha almacenada.
     */
    public function getFecha()
    {
        return $this->fecha;
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
     * Establece el identificador del usuario.
     *
     * @param int|string $usuarios_id Identificador del usuario.
     * @return void
     */
    public function setUsuarios_id($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

    /**
     * Establece si el elemento es público.
     *
     * @param string $publica True si es pública, false en caso contrario.
     * @return void
     */
    public function setPublica($publica)
    {
        $this->publica = $publica;
    }

    /**
     * Establece si el elemento está activo.
     *
     * @param number $activo Estado activo (1 para activo, 0 para inactivo).
     * @return void
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }
    
    /**
     * Establece la fecha asociada al objeto.
     *
     * @param string $fecha Fecha a asignar (cadena, objeto DateTime u otro formato aceptado).
     * @return void
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
	
} 
?>