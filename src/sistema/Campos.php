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
    
    /**
     * Constructor de la clase Campos.
     *
     * Inicializa las propiedades a partir del array asociativo $d. Requiere que $d['objeto'] esté presente;
     * si además faltan 'id' o 'label' lanza una excepción con código IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO.
     *
     * @param array|null $d Array con claves posibles: objeto, id, label, visible, campo, defecto, extra, tipo, data, esfecha, nombrecampo.
     * @throws Exception Si falta 'id' o 'label' cuando 'objeto' está presente.
     */
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
    
    /**
     * Agrega un nuevo objeto Campos al conjunto de registros.
     *
     * Establece 'objeto' = true en los datos, crea la instancia y la guarda
     * en $this->registros usando su id como clave.
     *
     * @param array $d Datos para crear el objeto Campos.
     * @return void
     */
    public function agregar( $d ){
        $d['objeto'] = true;
        $c = new Campos( $d );
        $this->registros[ $c->getId() ] = $c;
    }
    
    /**
     * Devuelve los registros almacenados en la instancia.
     *
     * @return mixed Los registros (por ejemplo, un array).
     */
    public function obtener(){
        return $this->registros;
    }

   
    /**
     * Genera el HTML de los campos registrados y lo devuelve como una cadena.
     *
     * Recorre los registros configurados y construye los elementos HTML
     * correspondientes según su tipo (visible, oculto, select, input, file,
     * checkbox, textarea), incluyendo etiquetas, valores por defecto y atributos.
     *
     * @return string HTML generado concatenado.
     */
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
     * Obtiene el nombre del campo.
     * @return string
     */
    public function getNombrecampo(){
        return $this->nombrecampo;
    }
    
    /**
     * Obtiene el identificador.
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Obtiene la etiqueta.
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * Obtiene la visibilidad.
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }
    
    /**
     * Obtiene el identificador del campo.
     * @return number
     */
    public function getCampo()
    {
        return $this->campo;
    }
    
    /**
     * Obtiene el valor por defecto.
     * @return string
     */
    public function getDefecto()
    {
        return $this->defecto;
    }
    
    /**
     * Obtiene información extra.
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }
    
    /**
     * Obtiene el tipo de campo.
     * @return string tipo
     */
    public function getTipo()
    {
        return strtolower( $this->tipo ) ;
    }
    
    /**
     * Obtiene los datos.
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Obtiene si es fecha.
     * @return boolean
     */
    public function getEsfecha()
    {
        return $this->esfecha;
    }
    
    /**
     * Establece el identificador.
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Establece la etiqueta.
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    /**
     * Establece la visibilidad.
     * @param boolean $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    
    /**
     * Establece el identificador del campo.
     * @param number $campo
     */
    public function setCampo($campo)
    {
        $this->campo = $campo;
    }
    
    /**
     * Establece el valor por defecto.
     * @param string $defecto
     */
    public function setDefecto($defecto)
    {
        $this->defecto = $defecto;
    }
    
    /**
     * Establece información extra.
     * @param string $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }
    
    /**
     * Establece el tipo de campo.
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    
    /**
     * Establece los datos.
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
    
    /**
     * Establece si es fecha.
     * @param boolean $esfecha
     */
    public function setEsfecha($esfecha)
    {
        $this->esfecha = $esfecha;
    }
    
    /**
     * Establece el nombre del campo.
     * @param string $nombrecampo
     */
    public function setNombrecampo( $nombrecampo ) {
        $this->nombrecampo = $nombrecampo;
    }
    
}
?>