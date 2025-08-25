<?php
class Campos {
    
    const GENERAL_CAMPOS_VISIBLE = 0;
    const GENERAL_CAMPOS_OCULTO = 1;
    const GENERAL_CAMPOS_INACTIVO = 2;
    
    private $id = "";
    private $label = "";
    private $visible = true;
    private $campo = self::GENERAL_CAMPOS_VISIBLE;
    private $defecto = "";
    private $extra = "";
    private $tipo = "text";
    private $data = null;
    private $esfecha = false;
    
    private $nombrecampo = "nombre";
    
    private $registros = array();
    
    public function __construct( $d = null ){
        if ( isset( $d['objeto'] ) ) {
            if ( isset( $d['id'] ) ) {
                $this->id = $d['id'];
            }
            else {
                http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
                throw new Exception('[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . ']Constructor: Campo id obligatorio');
            }
            if ( isset( $d['label'] ) ) {
                $this->label = $d['label'];
            }
            else {
                http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
                throw new Exception('[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . ']Constructor: Campo label obligatorio');
            }
            if ( isset( $d['visible'] ) ) {
                $this->visible = $d['visible'];
            }
            else {
                $this->visible = true;
            }
            if ( isset( $d['campo'] ) ) {
                $this->campo = $d['campo'];
            }
            else {
                $this->campo = self::GENERAL_CAMPOS_VISIBLE;
            }
            if ( isset( $d['defecto'] ) ) {
                $this->defecto = $d['defecto'];
            }
            else {
                $this->defecto = "";
            }
            if ( isset( $d['extra'] ) ) {
                $this->extra = $d['extra'];
            }
            else {
                $this->extra = "";
            }
            if ( isset( $d['tipo'] ) ) {
                $this->tipo = $d['tipo'];
            }
            else {
                $this->tipo = "text";
            }
            if ( isset( $d['data'] ) ) {
                $this->data = $d['data'];
            }
            else {
                $this->data = null;
            }
            if ( isset( $d['esfecha'] ) ) {
                $this->esfecha = $d['esfecha'];
            }
            else {
                $this->esfecha = false;
            }
            if ( isset( $d['nombrecampo'] ) ) {
                $this->nombrecampo = $d['nombrecampo'];
            }
            else {
                $this->nombrecampo = "nombre";
            }
        }
    }
    
    public function agregar( $d ){
        $d['objeto'] = true;
        $c = new Campos( $d );
        $this->registros[ $c->getId() ] = $c;
    }
    
    public function obtener(){
        return $this->registros;
    }
    
    public function obtenerHTML( ) {
        $html = array();
        
        foreach ($this->registros as $iO => $vO) {
            
            if( $vO->getCampo() == IndexCtrl::GENERAL_CAMPOS_VISIBLE ) {
                $html[] = '<div class="mb-3 col-md-6"> ';
                if ( !is_null( $vO->getData() ) ) {
                    $html[] = '<label class="form-label" for="' . $iO . '">' . $vO->getLabel() . '</label> ';
                    $html[] = '<select class="form-select" aria-label="' . $vO->getLabel() . '" id="' . $iO . '" name="' . $iO . '" ' . $vO->getExtra() . ' > ';
                    $html[] = ' <option selected disabled value="">Seleccione ' . strtolower( $vO->getLabel() ) . '</option> ';
                    foreach ($vO->getData() as $v ) {
                        $html[] = '<option value="' . $v['id'] . '" >' . $v[ $vO->getNombrecampo() ] . '</option> ';
                    }
                    $html[] = '</select> ';
                }
                else{
                    if ( $vO->getTipo() == 'text' || $vO->getTipo() == 'email' || $vO->getTipo() == 'number' ) {
                        
                        $html[] = '<label class="form-label" for="' . $iO . '">' . $vO->getLabel() . '</label> ';
                        
                        $capafechaINI = "";
                        $capafechaFIN = "";
                        if ( $vO->getEsfecha() ) {
                            $capafechaINI = '<div class="row">';
                            $capafechaFIN = '</div> ';
                        }
                        
                        $html[] = $capafechaINI;
                        $html[] = '<input type="' . $vO->getTipo() . '" class="form-control" placeholder="' . $vO->getLabel() . '" id="' . $iO . '" name="' . $iO . '" value="' . $vO->getDefecto() . '" ' . $vO->getExtra() . ' >';
                        $html[] = $capafechaFIN;
                        
                    }
                    elseif ( $vO->getTipo() == 'file' ) {
                        $html[] = " <label class=\"form-label\" for=\"" . $iO . "\">" . $vO->getLabel() . "</label><br /> ";
                        $html[] = " <div class=\"icon-shape icon-xxl border rounded position-relative\"> ";
                        $html[] = "     <span class=\"position-absolute\" id=\"pre" . $iO . "\"> <i class=\"bi bi-image fs-3  text-muted\"></i></span> ";
                        $html[] = "     <input id=\"" . $iO . "\" name=\"" . $iO . "\" class=\"form-control border-0 opacity-0\" type=\"" . $vO->getTipo() . "\" onchange=\"\"> ";
                        $html[] = " </div> ";
                    }
                    elseif ($vO->getTipo() == 'checkbox') {
                        $html[] = " <label class=\"form-label\" for=\"" . $iO . "\">" . $vO->getLabel() . "</label> ";
                        $html[] = " <div class=\"form-check form-switch\"> ";
                        $html[] = "     <input class=\"form-check-input\" type=\"checkbox\" id=\"" . $iO . "\" name=\"" . $iO . "\" value=\"1\" > ";
                        $html[] = " </div> ";
                    }
                    else {
                        if ( $vO->getTipo() == 'textarea' ) {
                            $html[] = '<label class="form-label" for="' . $iO . '">' . $vO->getLabel() . '</label>';
                            $html[] = '<textarea class="form-control" placeholder="' . $vO->getLabel() . ' " id="' . $iO . '" name="' . $iO . '" ' . $vO->getExtra() . ' >' . $vO->getDefecto() . '</textarea> ';
                        }
                    }
                }
                $html[] = '</div> ';
            }
            elseif ( $vO->getCampo() == self::GENERAL_CAMPOS_OCULTO) {
                $html[] = '<input type="hidden" id="' . $iO . '" name="' . $iO . '" value="' . $vO->getDefecto() . '" >';
            }
            
        }
        return implode("", $html);
    }
    
    /**
     *
     * @return string
     */
    public function getNombrecampo(){
        return $this->nombrecampo;
    }
    
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }
    
    /**
     * @return number
     */
    public function getCampo()
    {
        return $this->campo;
    }
    
    /**
     * @return string
     */
    public function getDefecto()
    {
        return $this->defecto;
    }
    
    /**
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }
    
    /**
     * @return string
     */
    public function getTipo()
    {
        return strtolower( $this->tipo ) ;
    }
    
    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * @return boolean
     */
    public function getEsfecha()
    {
        return $this->esfecha;
    }
    
    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    /**
     * @param boolean $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    
    /**
     * @param number $campo
     */
    public function setCampo($campo)
    {
        $this->campo = $campo;
    }
    
    /**
     * @param string $defecto
     */
    public function setDefecto($defecto)
    {
        $this->defecto = $defecto;
    }
    
    /**
     * @param string $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }
    
    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    
    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
    
    /**
     * @param boolean $esfecha
     */
    public function setEsfecha($esfecha)
    {
        $this->esfecha = $esfecha;
    }
    
    /**
     *
     * @param string $nombrecampo
     */
    public function setNombrecampo( $nombrecampo ) {
        $this->nombrecampo = $nombrecampo;
    }
    
}
?>