<?php
class OperacionesHomeCtrl {

    /**
     * Obtiene un array de etiquetas para plantillas de email.
     *
     * Genera etiquetas por defecto (b: URL base, u: home, i: index, f: timestamp)
     * y fusiona los pares clave=>valor proporcionados en $d.
     *
     * @param array $d Valores adicionales a incluir en las etiquetas (opcional).
     * @return array Array asociativo con las etiquetas para la plantilla de correo.
     */
    public static function ObtenerEtiquetasEmail( $d = array() ){
        $b = Utiles::getBaseUrl();
        $tpl = array(
            'b' => $b,
            'u' => $b . "home.php",
            'i' => $b . "index.php",
            'f' => date("YmdHis")
        );
        foreach ($d as $k => $v ) {
            $tpl[ $k ] = $v;
        }
        return $tpl;
    }
    
    /**
     * Valida y activa una cuenta usando un código de activación.
     *
     * Verifica que $d contenga 'c' (código) y 'u' (usuario), comprueba que el código exista
     * y que no haya expirado (fecha registrada + 1 año). Devuelve true si es válido.
     *
     * @param array $d Datos con índices 'c' (código) y 'u' (user key).
     * @return bool True si el código es válido y la cuenta puede activarse.
     * @throws Exception Si falta el campo, el código no existe o está inactivo/expirado.
     */
    public static function activarCuenta( $d ){
        date_default_timezone_set('America/Bogota');
        if( isset( $d["c"] ) ){
            $caa = trim($d["c"]);
            $key = trim($d["u"]);
            
            if( strlen( $caa ) ){
                
                $r = Singleton::_readInfo("codigoactiva", "*", "where nombre = '" . $caa . "' and userselecto_id = '" . $key . "'");
                if( sizeof($r) > 0 ){
                    $aExist = $r[0];
                    
                    $horaAct = date("Y-m-d H:i:s");
                    $horaReg = strtotime('+1 year', strtotime( $aExist["fecha"] ));
                    
                    if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
                        throw new Exception("C&oacute;digo inactivo por no usar en los &uacute;ltimos 10 minutos.");
                    }
                    else{
                        return true;
                    }
                    
                }
                else{
                    throw new Exception("C&oacute;digo inexistente.");
                }
            }
        }
        else {
            throw new Exception("Campo codActiva inexistente");
        }
    }
    
    /**
     * Envía un correo personalizado delegando en OperacionesCtrl.
     *
     * @param string $dest1   Dirección o lista de destinatarios.
     * @param string $titulo  Asunto del correo.
     * @param string $mensaje Cuerpo del mensaje (puede ser HTML).
     * @param string $adjuntar (Opcional) Ruta o nombre del archivo a adjuntar.
     * @return bool Devuelve true si el envío fue exitoso, false en caso contrario.
     */
    private static function enviarCustomEmail($dest1, $titulo, $mensaje, $adjuntar = ''){
        /*
        try{
            $correo = new Correo();
            $correo->setEsCalendario(false);
            $correo->setEsHTML(true);
            
            $correo->setPara($dest1);
            $correo->setTitulo($titulo);
            $correo->setMensaje($mensaje);
            
            return $correo->enviar();
            
        }catch (Exception $e){
            throw new Exception( $e->getMessage() );
        }
        
        return true;
        */
        return OperacionesCtrl::enviarCustomEmail($dest1, $titulo, $mensaje, $adjuntar);
    }
    
    /**
     * Envía un correo con un código de activación temporal al usuario.
     *
     * Requiere $d['emailactivar'] (correo destino) y $d['d'] (array del usuario con 'id').
     * Valida el correo, genera/guarda un código único, compone la plantilla y envía el email.
     *
     * @param array $d Datos de entrada: ['emailactivar' => string, 'd' => array('id' => int)]
     * @return string MD5 del id del usuario en caso de éxito.
     * @throws Exception Si falta o es inválido el correo, o ocurre un error al enviar el email.
     */
    public static function actviarSendMail( $d ){
        if( isset( $d["emailactivar"] ) ){
            $ea = $d["emailactivar"];
            if( strlen( $ea ) > 0 ){
                
                if (!filter_var($ea, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Correo inv&aacute;lido.");
                }
                
                $i_ctrl = 0;
                $usr = $d["d"];
                
                // revisar q no haya activado antes codigos
                Singleton::_readInfo("codigoactiva", "*", "where userselecto_id = " . $usr["id"] );
                
                /*
                if( sizeof( $rA ) > 0 ){
                    throw new Exception("Usted ya activo su cuenta.");
                }
                */
                
                $ca = new Codigoactiva();
                $tmpCl = Utiles::nuevoCl();
                
                $nuevaClave = false;
                do{
                    $ca->setNombre($tmpCl);
                    $ca->setActivo(0);
                    $ca->setUserselecto_id( $usr["id"] );
                    $ca->setFecha( date("Y-m-d H:i:s") );
                    
                    $ca->saveData();
                    if ( strlen( $ca->obtenerError() ) > 0 ){
                        error_log("Ya existe: " . $tmpCl . " (" . $ca->obtenerError() . ")");
                        $nuevaClave = true;
                    }
                    else{
                        $nuevaClave = false;
                    }
                    $i_ctrl++;
                    
                    if( $i_ctrl >= 20 )
                        break;
                }while($nuevaClave);
                
                $tplCode = file_get_contents( dirname(dirname( __FILE__ )) . DIRECTORY_SEPARATOR . 'sistema' . DIRECTORY_SEPARATOR . "email" . DIRECTORY_SEPARATOR . "nuevaclavehome.phtml");
                $_aed = array('CLAVE_TMP' => $tmpCl);
                $replacement_array = self::ObtenerEtiquetasEmail($_aed);
                
                $mensaje = preg_replace_callback(
                    '~\{\$(.*?)\}~si',
                    function($match) use ($replacement_array) {
                        return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
                    },
                    $tplCode);
                
                try {
                    
                    $rsend = self::enviarCustomEmail($ea, "Activador Evolusign", $mensaje);
                    
                } catch (Exception $e) {
                    throw new Exception("Error enviando correo [" . $e->getMessage() . "]");
                }
                error_log( "mail activa: " . print_r( $rsend , true )  . " cl: " . $tmpCl);
                return md5($usr["id"]);
                
            }
            else{
                throw new Exception("Campo de Correo sin diligenciar, vac&iacute;o.");
            }
        }
        else{
            throw new Exception("Campo de Correo sin diligenciar.");
        }
    }
    
    /**
     * Obtiene información extendida de un usuario según su correo.
     *
     * @param array $d Debe contener 'u' con el correo a buscar.
     * @return mixed Resultado de Singleton::_readInfo con los datos del usuario
     *               (incluye campos de estado y perfil).
     *
     * Nota: La búsqueda usa LIKE sobre eu.mail; validar/sanitizar la entrada para
     * evitar inyección SQL.
     */
    public static function LoginUsrsExtra ( $d ) {
        $vr  = "usel.id, usel.identificacion, usel.nombres, usel.clave, usel.apellidos, usel.mail, usel.tel, usel.creado, usel.estadoselecto_id, esel.nombre as estadoselecto, usel.perfilselecto_id, peel.nombre as perfilselecto ";
        $tb  = "userselecto as usel ";
        $xt  = "LEFT JOIN extusers as eu on eu.userselecto_id = usel.id ";
        $xt .= "left join estadoselecto as esel on esel.id = usel.estadoselecto_id ";
        $xt .= "left join perfilselecto as peel on peel.id = usel.perfilselecto_id ";
        $xt .= "WHERE eu.mail like '" . $d['u'] . "' ";
        
        $r = Singleton::_readInfo($tb, $vr, $xt );
        
        return $r;
    }
    
    /**
     * Envía un correo de activación para el usuario identificado por el correo proporcionado.
     *
     * @param array $d Arreglo que debe contener la clave 'u' con el correo electrónico del usuario.
     * @return array Devuelve un arreglo con la clave 'ok' que contiene 'estado' (bool) y 'datos' (array).
     * @throws Exception Si el correo está vacío o ocurre un error al enviar el correo de activación.
     */
    public static function LoginUsurCod( $d ){
        if( strlen( trim( $d["u"] ) ) > 0 ){
            $tb = "userselecto";
            $ver = "*";
            $extra  = "where mail like '" . trim($d["u"]) . "' ";
            $u_ok = Singleton::_readInfo($tb, $ver, $extra);
            
            $ok = array( "estado" => false, "datos" => array() );
            if (sizeof($u_ok) > 0) {
                try {
                    self::actviarSendMail( array( "emailactivar" => $d["u"], "d" => $u_ok[0] ) );
                    $ok = array( "estado" => true, "datos" => array() );
                } catch (Exception $e) {
                    throw new Exception( $e->getMessage() );
                }
            }
            
            return array( "ok" => $ok );
        }
        else{
            throw new Exception( "El correo no puede estar sin datos" );
        }
    }
    
    /**
     * Intenta autenticar y activar una cuenta de usuario por correo/alias.
     *
     * Busca el correo principal asociado, valida el token temporal opcional ("pase"),
     * activa la cuenta y devuelve los datos del usuario sin la clave.
     *
     * @param array $d Datos de entrada:
     *                 - 'u' (string) correo o identificador de búsqueda (requerido),
     *                 - 'c' (mixed) código requerido por la lógica interna,
     *                 - 'pase' (string) token temporal para validación (opcional).
     * @return array Devuelve ['ok' => ['estado' => bool, 'datos' => array]] indicando éxito y datos del usuario.
     * @throws Exception Si falta información, el token expira o ocurre un error interno.
     */
    public static function LoginUsur( $d ){
        include_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . "OperacionesCtrl.php" );
        
        if( isset( $d["u"] ) ){
            if( !(strlen( trim( $d["u"] ) ) > 0) ) throw new Exception( "campo correo no puede estar sin datos" );
        }
        
        $dtllave = $d["u"];
        
        // aqui obtenemos el correo principal de la cuenta asi el usuario haya puesto otro
        try {
            $rm = OperacionesCtrl::ObtenerCorreoPrincipal( array('dtLlave' => $dtllave ) );
            if( sizeof( $rm ) > 0 ){
                foreach ($rm as $_rm) {
                    $dtllave = $_rm['mmail'];
                }
            }
        } catch (Exception $e) {
            throw new Exception( 'Combinador.crear: ' . $e->getMessage() );
        }
        
        $tb = "userselecto as usel";
        $ver = "usel.id, usel.identificacion, usel.nombres, usel.clave, usel.apellidos, usel.mail, usel.tel, usel.creado, usel.estadoselecto_id, esel.nombre as estadoselecto, usel.perfilselecto_id, peel.nombre as perfilselecto ";
        
        $extra  = "left join estadoselecto as esel on esel.id = usel.estadoselecto_id ";
        $extra .= "left join perfilselecto as peel on peel.id = usel.perfilselecto_id ";
        $extra .= "where mail like '" . trim($dtllave) . "' ";
        
        $u_ok = Singleton::_readInfo($tb, $ver, $extra);
        
        if (!(sizeof($u_ok) > 0)) {
            $u_ok = self::LoginUsrsExtra( $d );
        }
        
        $ok = array("estado" => false, "datos" => array());
        if (sizeof($u_ok) > 0) {
            $_u = $u_ok[0];
            $_d = array(
                "c" => $d["c"],
                "u" => $_u["id"]
            );

            if( isset( $d["pase"] ) ){
                $endTime = strtotime("+1 minute", strtotime( $_u["clave"] ));
                
                if( strtotime($d["pase"]) <= $endTime ){
                    if( isset( $_u["clave"] ) ) unset( $_u["clave"] );
                    $ok = array("estado" => true, "datos" => $_u);
                }else{
                    include_once dirname(dirname( __FILE__ )) . DIRECTORY_SEPARATOR . 'sistema' . DIRECTORY_SEPARATOR . "Utiles.php";
                    
                    $msj = "Suspected impersonation ip: " . Utiles::get_user_ip_address();
                    throw new Exception( "LoginUsur: " . $msj );
                    error_log( $msj );
                }
            }

            try {
                self::activarCuenta($_d);
            } catch (Exception $e) {
                throw new Exception( $e->getMessage() );
            }

            if( isset( $_u["clave"] ) ) unset( $_u["clave"] );
            $ok = array("estado" => true, "datos" => $_u);
        }
        
        return array( "ok" => $ok );
    }
    
    /**
     * Autentica un usuario contra LDAP y verifica su existencia en la corporación.
     *
     * Lee la configuración LDAP, realiza bind con las credenciales proporcionadas y busca
     * al usuario por sAMAccountName. Lanza excepciones en caso de credenciales inválidas
     * o si el usuario está en LDAP pero no en Evolusign.
     *
     * @param array $d Arreglo con las claves 'u' => usuario, 'c' => contraseña.
     * @throws Exception Si el bind falla (credenciales inválidas) o si el usuario no existe en Evolusign.
     * @return void
     */
    public static function LoginLdapUsur( $d ){
        $cfg = self::LeerConfigCorp();
        
        $adServer = $cfg['ldapurl'];
        $ldapdomain = $cfg['ldapdmn'];
        $adBase = $cfg['ldap_bse'];
        
        $ldap = ldap_connect($adServer);
        $username = $d['u'];
        $password = $d['c'];
        
        $ldaprdn = $username . "@" . $ldapdomain;
        
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        
        if ($bind) {
            $filter="(sAMAccountName=$username)";
            $result = ldap_search($ldap,$adBase,$filter);
            @ldap_sort($ldap,$result,"sn");
            $info = ldap_get_entries($ldap, $result);
            
            for ( $i=0; $i < $info["count"]; $i++ )
            {
                if($info['count'] > 1)
                    break;
                
                /*
                echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
                echo '<pre>';
                //var_dump($info);
                $masterinfo = $info;
                echo '</pre>';
                $userDn = $info[$i]["distinguishedname"][0];
                */
                /*
                $ok = array("estado" => false, "datos" => $_u);
                return array("ok" => $ok);
                */
                throw new Exception( "Existe en el sistema de la corporaci&oacute;n pero no en Evolusign" );
            }
            @ldap_close($ldap);
        } else {
            $msg = "Invalid email address / password";
            throw new Exception( $msg );
        }
        
    }
    
    /**
     * Esta funcion asigna una fecha en el campo "clave" de la tabla "userselecto" y solo puede ser usado cuando se intenta autenticar por medio de integraciones de terceros (google, facebook, microsoft, etc)
     *  
     * @param array $d 
     *                  "us" => correo electronico del Usuario con clave temporal
     * @throws Exception
     * @return boolean[]
     */
    public static function LoginFromExterno( $d ) {
        date_default_timezone_set('America/Bogota');
        /*
        $extra = "WHERE mail LIKE '" . $d["us"] . "'";
        
        $usrEl = new Userselecto();
        $toUpdate = $usrEl->readInfo("*", $extra);
        
        if( strlen( $usrEl->obtenerError() ) > 0) throw new Exception( "LoginFromExterno: " . $usrEl->obtenerError() );
        
        if( sizeof( $toUpdate ) > 0 ){
            $_oUp = $toUpdate[ 0 ];
            $_oUp->setClave( date("Y-m-d H:i:s") );
            $up = $_oUp->updateData();
            
            if( strlen( $_oUp->obtenerError() ) > 0) throw new Exception( "LoginFromExterno: " . $_oUp->obtenerError() );
            return array("ok" => true, "afectados" => $up);
        }
        else{
            throw new Exception( "LoginFromExterno: Usuario no existe en evolusign" );
        }
        */
    }
    
    /**
     * Busca un usuario por correo (usa $d['u'] en una cláusula LIKE) y devuelve
     * una estructura con el estado y los datos del usuario seleccionado.
     *
     * @param array $d Arreglo de parámetros; debe incluir 'u' (correo o patrón a buscar).
     * @return array Devuelve ['ok' => ['estado' => bool, 'datos' => array]] donde
     *               'estado' es true si se encontró al menos un usuario y 'datos'
     *               contiene la primera fila encontrada, o está vacío si no hay resultados.
     */
    public static function LoginAsUsur( $d ){
        $tb = "userselecto as usel";
        $ver = "usel.id, usel.identificacion, usel.nombres, usel.apellidos, usel.mail, usel.tel, usel.creado, usel.estadoselecto_id, esel.nombre as estadoselecto, usel.perfilselecto_id, peel.nombre as perfilselecto";
        $extra  = "left join estadoselecto as esel on esel.id = usel.estadoselecto_id ";
        $extra .= "left join perfilselecto as peel on peel.id = usel.perfilselecto_id ";
        $extra .= "where mail like '" . $d["u"] . "' ";
        $u_ok = Singleton::_readInfo($tb, $ver, $extra);
        
        $ok = array("estado" => false, "datos" => array());
        if (sizeof($u_ok) > 0) {
            $_u = $u_ok[0];
            $ok = array("estado" => true, "datos" => $_u);
        }
        
        return array( "ok" => $ok );
    }
    
    /**
     * Delega la inserción/registro de usabilidad en el contexto "Home" al controlador OperacionesCtrl.
     *
     * @param mixed $d Datos de usabilidad a procesar.
     * @return mixed Resultado devuelto por OperacionesCtrl::Usabilidad_agregar.
     * @throws Exception Re-lanza cualquier excepción producida por el controlador.
     */
    public static function Usabilidad_AgregarHome( $d ){
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        include_once( $url_baseCtrls . "OperacionesCtrl.php" );
        
        try {
            return OperacionesCtrl::Usabilidad_agregar( $d );
        } catch (Exception $e) {
            throw new Exception( $e->getMessage() );
        }
    }
    
    /**
     * Lista las insignias del usuario según los datos proporcionados.
     *
     * @param mixed $d Datos necesarios para la consulta (p. ej. identificador de usuario).
     * @return mixed Arreglo o estructura con las insignias obtenidas.
     * @throws Exception Si ocurre un error al obtener las insignias.
     */
    public static function ListarMisInsignias( $d ){
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        include_once( $url_baseCtrls . "OperacionesCtrl.php" );

        try {
            return OperacionesCtrl::ObtenerMisInsignias($d);
        } catch (Exception $e) {
            throw new Exception( $e->getMessage() );
        }
    }
    
    /**
     * ListarPdfUrs
     *
     * Obtiene y devuelve los PDFs generados asociados a un usuario identificado por correo
     * (clave 'dm') junto con usuarios relacionados del operador (clave 'id').
     *
     * Parámetros:
     * @param array $d {
     *   @type string 'dm' Email del usuario principal.
     *   @type int    'id' Id del usuario para obtener usuarios relacionados (opcional).
     * }
     *
     * Retorno:
     * @return array ['ok' => array Lista de PDFs y metadatos, 'u_u' => array Datos del usuario]
     *
     * Comportamiento:
     * - Recupera emails relacionados, busca documentos aceptados en flujos,
     *   construye la respuesta con metadatos y registra un evento de usabilidad.
     */
    public static function ListarPdfUrs( $d ){
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        include_once( $url_baseCtrls . "OperacionesCtrl.php" );

        //$id = $d["id"];
        $dm = trim($d["dm"]);
        /*
        $tb = "packs as pk";
        $ver = "pk.id, pk.userselecto_id, usel.mail, pk.adjuntosflujos_id, adfl.nombre, adfl.url, pk.fecha ";
        $extra  = "left join userselecto as usel on usel.id = pk.userselecto_id ";
        $extra .= "left join adjuntosflujos as adfl on adfl.id = pk.adjuntosflujos_id ";
        $extra .= "where pk.userselecto_id = " . $id . " ";
        $extra .= "group by pk.adjuntosflujos_id";
        */

        $allEmails = array();
        $allEmails[] = $dm;
        try {
            $otros_email = OperacionesCtrl::ExtUsers_Obtener( array( 'u' => $d['id'], 'offline' => true ) );
            if ( isset( $otros_email[ 'ok' ] ) ) {
                $oeOk = $otros_email[ 'ok' ] ;
                foreach ( $oeOk as $oeOV ) {
                    $allEmails[] = $oeOV['mail'];
                }
            }
        } catch (Exception $e) {
            // hacer nada
        }
        
        
        $tb = "(SELECT docse.id, docse.nombre, docse.aceptado, docse.usuarios_id, docse.fecha, docse.flujos_id, SUBSTRING_INDEX(SUBSTRING_INDEX(docse.nombre,'/',-3),'/',1) as ver, SUBSTRING_INDEX(SUBSTRING_INDEX(docse.nombre,'/',-2),'/',1) as usr, SUBSTRING_INDEX(SUBSTRING_INDEX(docse.nombre,'/',-1),'/',1) as doc FROM docsestados as docse) as docse ";
        // docse.id, docse.nombre, docse.aceptado, docse.usuarios_id, docse.fecha, docse.ver, docse.usr
        $ver = "docse.ver as adjuntosflujos_id, docse.doc as url, docse.flujos_id, adfl.nombre as nicename , docse.usr ";
        $extra  = "LEFT join adjuntosflujos as adfl on docse.ver = adfl.id ";
        //$extra .= "WHERE (docse.usr LIKE '" . $dm . "') and aceptado = 1 and not adfl.estadosflujos_id is null ";
        $extra .= "WHERE ( docse.usr LIKE '" . implode("' OR docse.usr LIKE '", $allEmails ) . "' ) and aceptado = 1 and not adfl.estadosflujos_id is null ";
        $extra .= "order by flujos_id desc ";
        
        $u_ok = Singleton::_readInfo($tb, $ver, $extra);
        //$primero = true;
        //$tmpFlujo = 0;
        
        $rr = array();
        //foreach ($u_ok as $k_d => $v_d) {
        foreach ($u_ok as $v_d) {
            if( strlen( trim( $v_d["url"] ) ) > 0 ){
                //if($primero){
                //    $tmpFlujo = $v_d['flujos_id'];
                //    $primero = false;
                //}
                
                //if( $tmpFlujo == $v_d['flujos_id']){
                    
                    $d_i = array("v" => $v_d["adjuntosflujos_id"], "u" => $v_d['usr']);
                    $tmp = OperacionesCtrl::ListarPdfGenerados( $d_i );
                    $rr[] = array( "fl" => $tmp["ok"], "vcry" => md5( $v_d["adjuntosflujos_id"] ), "v" => $v_d["adjuntosflujos_id"], "fancy" => $v_d["nicename"], "u" => $v_d['usr'] );
                    
                //}else{
                //    break;
                //}
            }
        }
        
        // Usabilidad
        $tbUsr = "userselecto";
        $vrUsr = "nombres,apellidos,estadoselecto_id";
        $xtUsr = "where mail like '" . $dm . "'";
        $r2 = Singleton::_readInfo( $tbUsr, $vrUsr, $xtUsr );
        foreach ($r2 as $v) {
            $_olg = array(
                "refid" => "WEB_USR_LGN_OK",
                "vl"=> "Ingreso exitoso front usuario",
                "usr" => $v['nombres'] . ' ' . $v['apellidos']
            );
            try {
                OperacionesCtrl::Usabilidad_agregar( $_olg );
            } catch (Exception $e) {
                error_log( "ListarPdfUrs.Usabilidad: " . $e->getMessage() );
            }
            
        }
        
        return array( "ok" => $rr, "u_u" => $r2 );
    }
    
    /**
     * Lee la configuración corporativa delegando en OperacionesCtrl.
     *
     * Construye la ruta de los controladores, incluye OperacionesCtrl y obtiene
     * la configuración corporativa. Actualmente devuelve un array (posible placeholder).
     *
     * @return array Configuración corporativa.
     */
    public static function LeerConfigCorp(){
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        include_once( $url_baseCtrls . "OperacionesCtrl.php" );
        
        $cfg = OperacionesCtrl::LeerConfigCorp();
        
        //$btn_login = ( isset( $cfg[ OperacionesCtrl::CFG_LOGIN_BTN_STY ]) ? $cfg[ OperacionesCtrl::CFG_LOGIN_BTN_STY ]["val"] : "btn-outline-light" );        
        //$o365_act = filter_var( isset( $cfg[ OperacionesCtrl::CFG_O365_ACT ]) ? $cfg[ OperacionesCtrl::CFG_O365_ACT ]["val"] : false , FILTER_VALIDATE_BOOLEAN);
        
        return array();
    }
    
}
?>
