<?php
namespace src\sistema\Menubar;

class MenubarGrupo {
    private $nombre = "";
    private $codigo = "";
    private $icono = "";

    public function __construct($codigo, $nombre, $icono = ''){
        $this->nombre = $nombre;
        $this->codigo = strtolower( trim( $codigo ) );
        $this->icono = $icono;
    }

    /**
     * Get the value of nombre
     * @return string
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of codigo
     * @return string
     */ 
    public function getCodigo()
    {
        return strtolower( trim( $this->codigo ) );
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of icono
     * @return string
     */ 
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Set the value of icono
     *
     * @return  self
     */ 
    public function setIcono($icono)
    {
        $this->icono = $icono;

        return $this;
    }
}

?>