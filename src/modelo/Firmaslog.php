<?php 
/**
 *
 * @author yalfonso
 *
 */
class Firmaslog extends Clsdatos { 

	private $id = 0; 
	private $firmas_id = 0;
	private $firmasestados_id = 0;
	private $ip = "";
	private $pdfurl = "";
	private $pdfruta = "";
	private $pdfhash = "";
	private $paginas = 0;
	private $fecha = "1900-01-01 00:00:00";
	private $perfilusuarios_id = 0;
	private $nombrefull = "";
	private $tipodoc = "";
	private $documento = "";
	
    /**
     * Obtiene el identificador del usuario del perfil.
     * @return number
     */
    public function getPerfilusuarios_id()
    {
        return $this->perfilusuarios_id;
    }

    /**
     * Obtiene el nombre completo.
     * @return string
     */
    public function getNombrefull()
    {
        return $this->nombrefull;
    }

    /**
     * Obtiene el tipo de documento.
     * @return string
     */
    public function getTipodoc()
    {
        return $this->tipodoc;
    }

    /**
     * Obtiene el documento.
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Establece el identificador del usuario del perfil.
     * @param number $perfilusuarios_id
     */
    public function setPerfilusuarios_id($perfilusuarios_id)
    {
        $this->perfilusuarios_id = $perfilusuarios_id;
    }

    /**
     * Establece el nombre completo.
     * @param string $nombrefull
     */
    public function setNombrefull($nombrefull)
    {
        $this->nombrefull = $nombrefull;
    }

    /**
     * Establece el tipo de documento.
     * @param string $tipodoc
     */
    public function setTipodoc($tipodoc)
    {
        $this->tipodoc = $tipodoc;
    }

    /**
     * Establece el documento.
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * Obtiene la URL del PDF.
     * @return string
     */
    public function getPdfurl()
    {
        return $this->pdfurl;
    }

    /**
     * Establece la URL del PDF.
     * @param string $pdfurl
     */
    public function setPdfurl($pdfurl)
    {
        $this->pdfurl = $pdfurl;
    }

    /**
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el identificador de las firmas.
     * @return number
     */
    public function getFirmas_id()
    {
        return $this->firmas_id;
    }

    /**
     * Obtiene el identificador del estado de la firma.
     * @return number
     */
    public function getFirmasestados_id()
    {
        return $this->firmasestados_id;
    }

    /**
     * Obtiene la dirección IP.
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Obtiene la ruta del PDF.
     * @return string
     */
    public function getPdfruta()
    {
        return $this->pdfruta;
    }

    /**
     * Obtiene el hash del PDF.
     * @return string
     */
    public function getPdfhash()
    {
        return $this->pdfhash;
    }

    /**
     * Obtiene el número de páginas.
     * @return number
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Obtiene la fecha.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
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
     * Establece el identificador de las firmas.
     * @param number $firmas_id
     */
    public function setFirmas_id($firmas_id)
    {
        $this->firmas_id = $firmas_id;
    }

    /**
     * Establece el identificador del estado de la firma.
     * @param number $firmasestados_id
     */
    public function setFirmasestados_id($firmasestados_id)
    {
        $this->firmasestados_id = $firmasestados_id;
    }

    /**
     * Establece la dirección IP.
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Establece la ruta del PDF.
     * @param string $pdfruta
     */
    public function setPdfruta($pdfruta)
    {
        $this->pdfruta = $pdfruta;
    }

    /**
     * Establece el hash del PDF.
     * @param string $pdfhash
     */
    public function setPdfhash($pdfhash)
    {
        $this->pdfhash = $pdfhash;
    }

    /**
     * Establece el número de páginas.
     * @param number $paginas
     */
    public function setPaginas($paginas)
    {
        $this->paginas = $paginas;
    }

    /**
     * Establece la fecha.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

} 
?>