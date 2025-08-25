<?php
namespace src\sistema\Menubar;
use src\sistema\Menubar\MenubarGrupo;

class MenubarEntity {
    private $id = 0;
    private $slug = '';
    private $orden = 0;
    private $nombre = '';
    private $icono = '';
    private $url = '';
    private $grupo = '';
    private $visible = true;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of orden
     */ 
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set the value of orden
     *
     * @return  self
     */ 
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get the value of nombre
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
     * Get the value of icono
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

    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    public function getUrlPageId()
    {
        $url = parse_url($this->url, PHP_URL_QUERY);
        parse_str( $url, $salida );

        if ( isset( $salida['pageid'] ) ) {
            return $salida['pageid'];
        }
        else {
            return "";
        }
        
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of grupo
     */ 
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set the value of grupo
     *
     * @return  self
     */ 
    public function setGrupo( MenubarGrupo $grupo)
    {
        $this->grupo = $grupo;
        return $this;
    }

    /**
     * Get the value of visible
     */ 
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set the value of visible
     *
     * @return  self
     */ 
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }
}

?>