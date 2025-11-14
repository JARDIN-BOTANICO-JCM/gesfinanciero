<?php 
/**
 *
 * @author yalfonso
 *
 */
class Firmas extends Clsdatos { 

	private $id = 0;
	private $pdfid = "";
	private $perfilusuarios_id = 0;
	private $firmante_id = 0;
	private $nombrefull = "";
	private $documento = "";
	private $tipodoc = "";
	private $fecha = "1900-01-01 00:00:00";
	private $mail = "";
	
    /**
     * Obtiene el identificador.
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el identificador del PDF.
     * @return string
     */
    public function getPdfid()
    {
        return $this->pdfid;
    }

    /**
     * Obtiene el identificador del usuario del perfil.
     * @return number
     */
    public function getPerfilusuarios_id()
    {
        return $this->perfilusuarios_id;
    }

    /**
     * Obtiene el identificador del firmante.
     * @return number
     */
    public function getFirmante_id()
    {
        return $this->firmante_id;
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
     * Obtiene el documento.
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
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
     * Obtiene la fecha.
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Obtiene el correo electrónico.
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
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
     * Establece el identificador del PDF.
     * @param string $pdfid
     */
    public function setPdfid($pdfid)
    {
        $this->pdfid = $pdfid;
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
     * Establece el identificador del firmante.
     * @param number $firmante_id
     */
    public function setFirmante_id($firmante_id)
    {
        $this->firmante_id = $firmante_id;
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
     * Establece el documento.
     * @param string $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
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
     * Establece la fecha.
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Establece el correo electrónico.
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
	
} 
?>