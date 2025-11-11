<?php
use src\libs\Apibox\ApiboxLib;
use src\libs\MagicPages\MagicPagesLib;

class OperacionesCtrl {
	const SQL_BIG_SELECTS = 'SET SQL_BIG_SELECTS=1';
	public static $GBL_DIAS = array(
        "monday" => "Lunes",
        "tuesday" => "Martes",
        "wednesday" => "Mi&eacute;rcoles",
        "thursday" => "Jueves",
        "friday" => "Viernes",
        "saturday" => "S&aacute;bado",
        "sunday" => "Domingo"
    );
    
	public static $GBL_MESES = array(
        "january" => "enero",
		"february" => "febrero",
		"march" => "marzo",
		"april" => "abril",
		"may" => "mayo",
		"june" => "junio",
		"july" => "julio",
		"august" => "agosto",
		"september" => "septiembre",
		"october" => "octubre",
		"november" => "noviembre",
		"december" => "diciembre"
    );
	
	public static $GBL_ARL_LIST = array(
	    array("vl" => "Sin ARS", "lbl" => "Sin ARS","sel" => ''),
	    array("vl" => "Colsanitas", "lbl" => "Colsanitas","sel" => ''),
	    array("vl" => "Compensar", "lbl" => "Compensar","sel" => ''),
	    array("vl" => "Coomeva", "lbl" => "Coomeva","sel" => ''),
	    array("vl" => "Nueva EPS", "lbl" => "Nueva EPS","sel" => ''),
	    array("vl" => "SaludCoop-Cafesalud", "lbl" => "SaludCoop-Cafesalud","sel" => ''),
	    array("vl" => "Sanidad Militar", "lbl" => "Sanidad Militar","sel" => ''),
	    array("vl" => "Sanitas", "lbl" => "Sanitas","sel" => ''),
	    array("vl" => "Servir", "lbl" => "Servir","sel" => ''),
	    array("vl" => "Solsalud", "lbl" => "Solsalud","sel" => ''),
	    array("vl" => "Sura", "lbl" => "Sura","sel" => '')
	);
	
	public static $GBL_EPS_LIST = array(
	    array("vl" => "Sin EPS", "lbl" => "Sin EPS","sel" => ''),
	    array("vl" => "Alianza Salud (Colmedica)", "lbl" => "Alianza Salud (Colmedica)","sel" => ''),
	    array("vl" => "Asmetsalud", "lbl" => "Asmetsalud","sel" => ''),
	    array("vl" => "Avanzar", "lbl" => "Avanzar","sel" => ''),
	    array("vl" => "Cafaba", "lbl" => "Cafaba","sel" => ''),
	    array("vl" => "Cajasalud", "lbl" => "Cajasalud","sel" => ''),
	    array("vl" => "Cajasan", "lbl" => "Cajasan","sel" => ''),
	    array("vl" => "Caprecom", "lbl" => "Caprecom","sel" => ''),
	    array("vl" => "Capruis", "lbl" => "Capruis","sel" => ''),
	    array("vl" => "Colmedica", "lbl" => "Colmedica","sel" => ''),
	    array("vl" => "Colsanitas", "lbl" => "Colsanitas","sel" => ''),
	    array("vl" => "Comfenalco", "lbl" => "Comfenalco","sel" => ''),
	    array("vl" => "Compensar", "lbl" => "Compensar","sel" => ''),
	    array("vl" => "Compensar", "lbl" => "Compensar","sel" => ''),
	    array("vl" => "Coomeva", "lbl" => "Coomeva","sel" => ''),
	    array("vl" => "Coosalud", "lbl" => "Coosalud","sel" => ''),
	    array("vl" => "Ecopetrol", "lbl" => "Ecopetrol","sel" => ''),
	    array("vl" => "Emdisalud", "lbl" => "Emdisalud","sel" => ''),
	    array("vl" => "Famisalud", "lbl" => "Famisalud","sel" => ''),
	    array("vl" => "Famisanar", "lbl" => "Famisanar","sel" => ''),
	    array("vl" => "Fuerzas Militares", "lbl" => "Fuerzas Militares","sel" => ''),
	    array("vl" => "Fundaci&oacute;n M&eacute;dico Preventiva", "lbl" => "Fundaci&oacute;n M&eacute;dico Preventiva","sel" => ''),
	    array("vl" => "Humana Vivir", "lbl" => "Humana Vivir","sel" => ''),
	    array("vl" => "Medicol", "lbl" => "Medicol","sel" => ''),
	    array("vl" => "MEDIMAS", "lbl" => "MEDIMAS","sel" => ''),
	    array("vl" => "Nueva EPS", "lbl" => "Nueva EPS","sel" => ''),
	    array("vl" => "Polic&iacute;a Nacional", "lbl" => "Polic&iacute;a Nacional","sel" => ''),
	    array("vl" => "Positiva de Seguros S.A.", "lbl" => "Positiva de Seguros S.A.","sel" => ''),
	    array("vl" => "Salud Colpatria", "lbl" => "Salud Colpatria","sel" => ''),
	    array("vl" => "Salud Total", "lbl" => "Salud Total","sel" => ''),
	    array("vl" => "Salud Vida", "lbl" => "Salud Vida","sel" => ''),
	    array("vl" => "SaludCoop-Cafesalud", "lbl" => "SaludCoop-Cafesalud","sel" => ''),
	    array("vl" => "Sanidad Militar", "lbl" => "Sanidad Militar","sel" => ''),
	    array("vl" => "Sanitas", "lbl" => "Sanitas","sel" => ''),
	    array("vl" => "Servir", "lbl" => "Servir","sel" => ''),
	    array("vl" => "Sisben", "lbl" => "Sisben","sel" => ''),
	    array("vl" => "Solsalud", "lbl" => "Solsalud","sel" => ''),
	    array("vl" => "Sura", "lbl" => "Sura","sel" => '')
	);
	
	public static $AUTO_LOG_OUT = true;
	
	public static function componenteHTML($d) {
	    $limpio = preg_replace_callback('/\[([^\]]+)\]/', function ($matches) {
	        $contenidoLimpio = str_replace('&nbsp;', ' ', $matches[1]);
	        return "[" . $contenidoLimpio . "]";
	    }, $d['html']);
	    
	        if (!empty($d['solohtml'])) {
	            if (preg_match('/\[(\w+)\s+([^\]]+)\]/', $limpio, $matches)) {
	                $atributos = ["type" => $matches[1]];
	                
	                preg_match_all('/(\w+)=([^\s]*)/', $matches[2], $atributosEncontrados, PREG_SET_ORDER);
	                foreach ($atributosEncontrados as $atributo) {
	                    $clave = $atributo[1];
	                    $valor = $atributo[2];
	                    
	                    if (is_numeric($valor)) {
	                        $valor = strpos($valor, '.') !== false ? floatval($valor) : intval($valor);
	                    } elseif (strtolower($valor) === "true") {
	                        $valor = true;
	                    } elseif (strtolower($valor) === "false") {
	                        $valor = false;
	                    }
	                    
	                    $atributos[$clave] = $valor;
	                }
	                unset($atributos['type']);
	                
	                return $atributos;
	            }
	            return [];
	        }
	        
	        return preg_replace_callback('/\[(\w+)\s+([^\]]+)\]/', function ($matches) {
	            $atributos = ["type" => $matches[1]];
	            
	            preg_match_all('/(\w+)=([^\s]*)/', $matches[2], $atributosEncontrados, PREG_SET_ORDER);
	            foreach ($atributosEncontrados as $atributo) {
	                $clave = $atributo[1];
	                $valor = $atributo[2];
	                
	                if (is_numeric($valor)) {
	                    $valor = strpos($valor, '.') !== false ? floatval($valor) : intval($valor);
	                } elseif (strtolower($valor) === "true") {
	                    $valor = true;
	                } elseif (strtolower($valor) === "false") {
	                    $valor = false;
	                }
	                
	                $atributos[$clave] = $valor;
	            }
	            
	            return self::editarPlantillas_CrearComponente($atributos);
	        }, $limpio);
	}
	
	const LABELS_EMAIL_DESCR = [
	    'corto' => 'URL Config',
	    'b' => 'URL Base',
	    'u' => 'URL Empleado',
	    'i' => 'URL Admin',
	    'f' => 'Id &uacute;nica',
	    'now_day' => 'D&iacute;a actual',
	    'now_month' => 'Mes actual',
	    'now_year' => 'A&ntilde;o actual',
	    'now_hour' => 'Horas actual',
	    'now_mins' => 'Minuto actual',
	    'now_secs' => 'Segudo actual',
	    'now_date' => 'Fecha actual',
	    'now_time' => 'La hora actual',
	    'now_datetime' => 'Fecha y hora actual'
	];
    public static function ObtenerEtiquetasEmail( $d = array() ){
        date_default_timezone_set('America/Bogota');
        $parsedUrl = parse_url( Utiles::getBaseUrl() );
        $b = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . ( isset( $parsedUrl['port'] ) ? (":" . $parsedUrl['port']) : "" ) . '/';
        
        $sht = "";
        if( defined ( "Config::URLBASE" ) ){
            $sht = Config::URLBASE;
        }
        
        $logo = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . "corp" . DIRECTORY_SEPARATOR . "corplogo.png";
        $img = "";
        if( file_exists($logo) ){
            $base64f = file_get_contents( $logo );
            $img = base64_encode( $base64f );
        }
        
        $tpl = array(
            'corto' => $sht,
            'b' => $b,
            'u' => $b . "home.php",
            'i' => $b . "index.php",
            'f' => date("YmdHis"),
            'logo64' => $img,
            'now_day' => date('d'),
            'now_month' => date('m'),
            'now_year' => date('Y'),
            'now_hour' => date('H'),
            'now_mins' => date('i'),
            'now_secs' => date('s'),
            'now_date' => date('Y-m-d'),
            'now_time' => date('H:i:s'),
            'now_datetime' => date('Y-m-d H:i:s')
        );
        foreach ($d as $k => $v ) {
            $tpl[ $k ] = $v; 
        }
        return $tpl;
    }
    
    public static function GET_BASE_MAIL(){
        return dirname(dirname( __FILE__ )) . DIRECTORY_SEPARATOR . 'sistema' . DIRECTORY_SEPARATOR . "email";
    }
    
	public static function enviarCustomEmail( $d ){
	    
	    $cfg = self::LeerConfigCorp();
	    $_CFG_SMTP_TFSERVICE = filter_var( isset( $cfg[ self::CFG_SMTP_TFSERVICE ]) ? $cfg[ self::CFG_SMTP_TFSERVICE ]["val"] : false , FILTER_VALIDATE_BOOLEAN);
	    $_CFG_SMTP_TFSERVICEURL = isset( $cfg[ self::CFG_SMTP_TFSERVICEURL ]) ? $cfg[ self::CFG_SMTP_TFSERVICEURL ]["val"] : "";
	    $_CFG_SMTP_TFSAPITOKEN = isset( $cfg[ self::CFG_SMTP_TFSAPITOKEN ]) ? base64_decode( $cfg[ self::CFG_SMTP_TFSAPITOKEN ]["val"] ) : "";
	    $_CFG_SMTP_TFSCLIID = isset( $cfg[ self::CFG_SMTP_TFSCLIID ]) ? $cfg[ self::CFG_SMTP_TFSCLIID ]["val"] : "";

	    $rSend = null;
	    
	    $dest1 = $d['para'];
	    $titulo = $d['titulo'];
	    $mensaje = $d['mensaje'];
	    $emailDesde = $d['desde'];
	    $emailRotulo = $d['rotulo'];
	    
	    if ( !$_CFG_SMTP_TFSERVICE ) {	        
	        $correo = new Correo();
	        $correo->setEsCalendario(false);
	        $correo->setEsHTML(true);
	        
	        $correo->setPara($dest1);
	        $correo->setTitulo($titulo);
	        $correo->setMensaje($mensaje);
	        $correo->setEmailRemitente($emailDesde);
	        $correo->setEtiquetaNombre($emailRotulo);
	        
	        if ( isset( $d['adjunto'] ) ) {
	            if (strlen(trim( $d['adjunto'] ) ) > 0) {
	                $correo->setAdjunto( $d['adjunto'] );
	            }
	        }
	        
	        try {
	            $rSend = $correo->enviar();
	        } catch (Exception $e) {
	            http_response_code(IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO);
	            throw new Exception('[' . IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO . ']enviarCustomEmail: ' . $e->getMessage() );
	        }
	    }
		
		else {
			$m = "POST";
			$url = rtrim($_CFG_SMTP_TFSERVICEURL, "/") . "/" . md5('Api/Servidor/NotificaByMail');
			
			$flRuta = '';
			if ( isset( $d['adjuntofull'] ) ) {
			    $flRuta = $d['adjuntofull'];
			}
			
			$_dominio = parse_url(Utiles::getBaseUrl());
			$idcli_prt = explode(".", $_dominio["host"]);
			
			/*
			$instancia_partes = explode( DIRECTORY_SEPARATOR , dirname( __FILE__ ) );
			$instancia = $instancia_partes[ count( $instancia_partes ) - 3 ];
			*/
			
			//$txtTit = mb_convert_encoding( $titulo , "utf8", "iso-8859-1");
			$jsonMail = '{"destino" : "' . $dest1 . '","titulo64" : "' . base64_encode( $titulo ) . '","mensaje" : "' . base64_encode( $mensaje ) . '","adjuntofull" : "' . $flRuta . '", "idserver":"' . $idcli_prt[0] . '","cliente" : "' . $_CFG_SMTP_TFSCLIID . '"}';
			//die( "jsonMail: " . $jsonMail );
			$data = array(
			    "u" => $_CFG_SMTP_TFSAPITOKEN
				,"data" => base64_encode( $jsonMail )
			);
			//die( "data: " . print_r( $data ) );
			
			$opts = array(
			    CURLOPT_HTTPHEADER => array(
			        'Content-Type: application/json',
			        'User-Agent: nuevapp/1.0'
			    )
			);
			
			try {
			    $rSend = json_decode( self::CallAPI($m, $url, $data, $opts ) , true );
			} catch (Exception $e2) {
				throw new Exception( "enviarCustomEmail: " . $e2->getMessage() );
			}
		}
		
		if ( isset( $rSend['err'] ) ){ 
		    http_response_code( IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA );
		    throw new Exception( "[" . IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA . "] enviarCustomEmail: " . $rSend['err'] );
		}
		
		return $rSend;
	    
	}
	
	
	private static function enviar_Notificacion ( $d ){
	    
	    $tpl = $d['tpl'];
	    $campos = $d['campos'];
	    $para = $d['para'];
	    
	    $titulo = "Nuevapp - #" . date('YmdHis');
	    if ( isset( $d['titulo'] ) ) {
	        $titulo = $d['titulo'];
	    }
	    $desde = "notificador@nuevapp.com";
	    if ( isset( $d['desde'] ) ) {
	        $desde = $d['desde'];
	    }
	    $tag = "Notification";
	    if ( isset( $d['rotulo'] ) ) {
	        $tag = $d['rotulo'];
	    }
	    
	    $pthTpl = self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . $tpl;
	    
	    $tplCode = file_get_contents( $pthTpl );
	    $replacement_array = self::ObtenerEtiquetasEmail( $campos );
	    
	    $mensaje = preg_replace_callback(
	        '~\{\$(.*?)\}~si',
	        function($match) use ($replacement_array) {
	            return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	        },
	        $tplCode);
	    
	    $emOpc = array(
	        "para" => $para,
	        "titulo" => $titulo,
	        "mensaje" => $mensaje,
	        "desde" => $desde,
	        "rotulo" => $tag
	    );
	    $rsend = null;
	    try {
	        $rsend = self::enviarCustomEmail( $emOpc );
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_CORREO_FAIL );
	        throw new Exception( 'enviar_Notificacion - enviarCustomEmail: ' . $e->getMessage() , IndexCtrl::ERR_COD_CORREO_FAIL );
	    }
	    
	    return $rsend;
	}
	
	public static function AutenticaUsuarioSisAjaxB64( $d ){
	    $p = base64_decode( $d['params'] );
	    $js = json_decode( $p, true );
	    $sesion = true;
	    
	    if ( isset( $js['qlgn_sesion'] ) ) {
	        $sesion = $js['qlgn_sesion'];
	        $sesion = filter_var( $js['qlgn_sesion'] , FILTER_VALIDATE_BOOLEAN );
	        if ( !$sesion ) {
	            $rAuth = null;
	            try {
	                $rAuth = self::AutenticaUsuarioSisAjax( array( "u" => $js['qlgn_usuario'], "c" => $js['qlgn_clave'] ) );
	            } catch (Exception $e) {
	                throw new Exception( $e->getMessage() );
	            }
	            return $rAuth;
	        }
	    }
	    
	    $res = Seguridad::loginAdmin( $js["u"], $js["c"] );
	    if ( $res ) {
	        return true;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA );
	        throw new Exception( 'Usuario o contrase&ntilde;a inv&aacute;lidos' );
	    }
	    
	    return false;
	}
	public static function AutenticaUsuarioSisAjax( $d, $md5Met = false ){
	    $u = $d["u"];
	    $c = isset($d["c"]) ? $d["c"] : "";
	    
	    // $u = md5(usuario . clave)
	    $extra = "where md5(concat(usuario, clave)) = '" . $u . "'";
	    if( !$md5Met ){
	        $extra = "where (mail = '" . $u . "' or usuario = '" . $u . "') and clave = md5('" . $c . "') ";
	    }
	    
	    $db_chkusr = Singleton::_readInfoChar("usuarios", "*", $extra);
	    
	    if( isset( $db_chkusr['err_info'] ) ){
	        throw new Exception("AutenticaUsuarioAjax: " . $db_chkusr['err_info']);
	    }
	    
	    $t_Resp = count( $db_chkusr );
	    if( $t_Resp > 0 ){
	        if( $t_Resp > 1){
	            http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	            throw new Exception("AutenticaUsuarioSisAjax: Usuario duplicado, revisar con el administrador de la app.");
	        }
	        /*
	        if( isset( $d["f2"] ) ){
	            return self::FactorDosAutentica( $db_chkusr[0] );
	        }
	        */
	        unset($db_chkusr[0]["clave"]);
	        return $db_chkusr[0];
	        
	    }
	    else{
	        http_response_code( IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA );
	        throw new Exception("AutenticaUsuarioSisAjax: Usuario o clave errada");
	    }
	}
	
	// APIS v2 Inicia
	
	// Llave INI
	/**
	 * 
	 * @param unknown <b>clave</b> Clave para crear la llave
	 */
	private static function GenerarLlavePublica( $d ){
	    date_default_timezone_set('America/Bogota');
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        
        $privkey = null;
        $fecha = date('Y-m-d H:i:s');
        
        $res=openssl_pkey_new( $config );
        //openssl_pkey_export($res, $privkey );
        //$pubkey=openssl_pkey_get_details($res);
        //$pubkey=$pubkey["key"];
        
        openssl_pkey_export( $res, $privkey , $d['mail'] . date('YmdHis', strtotime( $fecha )) );
        $pubkey=openssl_pkey_get_details($res);
        $pubkey=$pubkey["key"];
        
        $res = array( 'pub' => $pubkey , 'pri' => $privkey, 'fecha' => $fecha );
        return $res;
	}
	
	/**
	 * 
	 * @param <b>String u</b>  Usuario o correo inscrito en el sistema
	 * @param <b>String c</b>  Clave de usuario
	 * @return <b>object</b>   Id nuevo token
	 * @exception  <b>400</b>  Error Interno
	 *             <b>401</b>  Se requiere perfil autorizado
	 */
	public static function GenerarToken ( $d ){
	    date_default_timezone_set('America/Bogota');
	    include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "libs" . DIRECTORY_SEPARATOR . "Apibox" . DIRECTORY_SEPARATOR . "ApiboxLib.php";
	    
	    $r = null;
	    $md5 = false;
	    
	    if ( isset( $d['md5'] ) ) {
	        $md5 = $d['md5'];
	    }
	    
	    try {
	        $r = self::AutenticaUsuarioSisAjax( $d, $md5 );
	    } catch (Exception $e) {
	        http_response_code( 401 );
	        throw new Exception( $e->getMessage() );
	    }
	    
	    if ( isset( $r['ok']) ) {
	        
	        $okI = $r['ok'];
	        
	        if ( $okI['estado_id'] == 1 ) {
	            if ( $okI['perfil_id'] == 1 || $okI['perfil_id'] == 2 || $okI['perfil_id'] == 7 ) {
	                $idUsr = $okI['id'];
	                
	                $cfg = self::LeerConfigCorp();
	                //$time = ( isset( $cfg[ self::CFG_LGIN_APT ]) ? $cfg[ self::CFG_LGIN_APT ]["val"] : "60" );
	                
	                $existen = null;
	                try {
	                    $existen = ApiboxLib::Obtener( array( 'id' => $idUsr ) );
	                } catch (Exception $e) {
	                    http_response_code( 400 );
	                    throw new Exception( $e->getMessage() );
	                }
	                
	                if ( count( $existen ) > 0 ) {
	                    
	                    foreach ($existen as $vPKey) {
	                        http_response_code( 200 );
	                        
	                        /*
	                        $horaAct = date("Y-m-d H:i:s");
	                        $horaReg = strtotime("+{$time} minutes", strtotime( $vPKey["fecha"] ));
	                        if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
	                        
	                            $pkey = self::GenerarLlavePublica( array( 'mail' => $okI[ 'mail' ]) );
	                            $rP = null;
	                            try {
	                                $rP = ApiboxLib::Actualizar( array( 'id' => $idUsr, 'pkey' => $pkey ) );
	                            } catch (Exception $e) {
	                                http_response_code( 500 );
	                                throw new Exception( $e->getMessage() );
	                            }
	                            
	                            return $rP;
	                        }
	                        else {
	                            return $vPKey['publica'];
	                        }
	                        */
	                        
	                        if( isset( $d['forcenew'] ) ){
	                            
	                            if ( $d['forcenew'] ) {
	                                $pkey = self::GenerarLlavePublica( array( 'mail' => $okI[ 'mail' ]) );
	                                $rP = null;
	                                try {
	                                    $rP = ApiboxLib::Actualizar( array( 'id' => $idUsr, 'key' => $pkey ) );
	                                } catch (Exception $e) {
	                                    http_response_code( 500 );
	                                    throw new Exception( $e->getMessage() );
	                                }
	                                
	                                return $rP;
	                            }
	                            else {
	                                return $vPKey['publica'];
	                            }
	                        }
	                        else {
	                            return $vPKey['publica'];
	                        }
	                    }
	                     
	                }
	                else {
	                    
	                    $pkey = self::GenerarLlavePublica( array( 'mail' => $okI[ 'mail' ]) ); 
	                    $rP = null;
	                    try {
	                        $rP = ApiboxLib::Crear( array( 'id' => $idUsr, 'key' => $pkey ) );
	                    } catch (Exception $e) {
	                        http_response_code( 500 );
	                        throw new Exception( $e->getMessage() );
	                    }
	                    
	                    http_response_code( 200 );
	                    return $rP;
	                }
	            }
	            else {
	                http_response_code( 401 );
	                throw new Exception( 'Se requiere perfil con autorizado' );
	            }
	        }
	        else {
	            http_response_code( 500 );
	            throw new Exception( 'Usuario inhabilitado' );
	        }
	        
	    }
	}
	
	public static function CompararToken ( $d ){
	    date_default_timezone_set('America/Bogota');
	    include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "libs" . DIRECTORY_SEPARATOR . "Apibox" . DIRECTORY_SEPARATOR . "ApiboxLib.php";
	    
	    $pkey = $d['pkey'];
	    
	    try {
	        return ApiboxLib::Comparar( array( 'pkey' => $pkey ) );
	    } catch (Exception $e) {
	        http_response_code( 401 );
	        throw new Exception( $e->getMessage() );
	    }
	    
	    
	}
	
	private static function ObtenerToken ( $d ){
	    date_default_timezone_set('America/Bogota');
	    include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "libs" . DIRECTORY_SEPARATOR . "Apibox" . DIRECTORY_SEPARATOR . "ApiboxLib.php";
	    
	    $opc = array( 'id' => $d['id'] );
	    if ( isset( $d['privada'] ) ) {
	        $opc['privada'] = $d['privada'];
	    }
	    
	    $tk = null;
	    try {
	        $tk = ApiboxLib::Obtener( $opc );
	    } catch (Exception $e) {
	        http_response_code( 401 );
	        throw new Exception( $e->getMessage() );
	    }
	    
	    if ( count( $tk ) == 0 ) {
	        http_response_code ( IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA . '] ObtenerToken: Debe crear un API Token para realizar esta acci&oacute;n' );
	    }
	    
	    return $tk;
	}
	// Llave FIN
	
	// Mascaras URL INI
	public static function crearUrlMask( $d, $msk ){
	    $carpetas = array(
	        IndexCtrl::MASK_FLD_REPO_ANEXOS => "repo/anexos",
	        IndexCtrl::MASK_FLD_REPO_PROCESOS => "repo/proc"
	    );
	    
	    $bs = dirname(dirname(dirname( __FILE__ ))) ;
	    $fl = $carpetas[ $msk ];
	    $idMd5 = $d['id'];
	    $dc = $d['doc'];
	    
	    $id = "";
	    $fld_base = $bs . DIRECTORY_SEPARATOR . $fl;
	    if ( $msk == IndexCtrl::MASK_FLD_REPO_PROCESOS ) {
	        $fld_base .=  DIRECTORY_SEPARATOR . "" . $d['anyo'];
	    }
	    
	    foreach(scandir( $fld_base ) as $file ){
	        if( !is_dir($file) )
	        {
	            $fldt = pathinfo( $file );
	            $flParts = $fldt['filename'];
	            
	            if ( md5( $flParts ) == $idMd5 ) {
	                $id = $flParts;
	            }
	        }
	    }
	    
	    $def = $fld_base . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $dc;
	    
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $dc . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        
        // Read the file
        @readfile( $def ); 
	}
	// Mascaras URL FIN
	
	// APIS v2 Fin
	
	public static function RecuperarByEmailAjax( $d ){
	    if( isset( $d["emailactivar"] ) ){
	        $ea = $d["emailactivar"];
	        if( strlen( $ea ) > 0 ){
	            
	            if (!filter_var($ea, FILTER_VALIDATE_EMAIL)) {
	                throw new Exception("Correo inv&aacute;lido.");
	            }
	            
	            $tb_q = "usuarios";
	            $extr_q = "where (mail like '" . $ea . "') or (usuario like '" . $ea . "')";
	            if( isset( $d["gnrtk"] ) ){
	                $tb_q = "userselecto";
	                $extr_q = "where (mail like '" . $ea . "')";
	            }
	            $r = Singleton::_readInfo($tb_q, "*", $extr_q);
	            
	            if( count($r) > 0 ){
	                $i_ctrl = 0;
	                $usr = $r[0];

	                try {
	                    Singleton::_classicDelete("codigoactiva", "where userselecto_id = " . $usr["id"]);
	                } catch (Exception $e) {
	                    throw new Exception("RecuperarByEmailAjax: Error eliminando viejos tkns [" . $e->getMessage() . "]");
	                }
	                
	                $ca = new Codigoactiva();
	                $tmpCl = Utiles::nuevoCl(6);
	                
	                $nuevaClave = false;
	                do{ 
	                    $ca->setNombre($tmpCl);
	                    $ca->setActivo(0);
	                    $ca->setUserselecto_id($usr["id"]);
	                    $ca->setFecha(date("Y-m-d H:i:s"));
	                    
	                    $r = $ca->saveData();
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
	                
	                $tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "nuevaclave.html");
	                $_aed = array('CLAVE_TMP' => $tmpCl);
	                $replacement_array = self::ObtenerEtiquetasEmail($_aed);
	                
	                $mensaje = preg_replace_callback(
	                    '~\{\$(.*?)\}~si',
	                    function($match) use ($replacement_array) {
	                        return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	                    },
	                    $tplCode);
	                
	                try {
	                    $rsend = self::enviarCustomEmail($ea, "Nuevapp - C\xF3digo " . $tmpCl, $mensaje);
	                    
	                } catch (Exception $e) {
	                    throw new Exception("RecuperarByEmailAjax: " . $e->getMessage() . "");
	                }
	                error_log( "mail activa: " . print_r( $rsend, true )  . " cl: " . $tmpCl);
	                return array("ok" => md5($usr["id"]) );
	            }
	            else{
	                throw new Exception("Cuenta inexistente, comun&iacute;quese con el administrador de la herramienta.");
	            }
	            
	        }
	        else{
	            throw new Exception("Campo de Correo o tel sin diligenciar, vac&iacute;o.");
	        }
	    }
	    else{
	        throw new Exception("Campo de Correo o tel sin diligenciar.");
	    }
	}
	
	public static function RecuAsignarClaveAjax( $d ){
	    if( isset( $d["codActiva"] ) ){
	        if (!isset($d["key"])) throw new Exception("Sin datos del usuario.");
	        if (!isset($d["c"])) throw new Exception("Sin nueva clave.");
	        
	        $caa = trim($d["codActiva"]);
	        $key = trim($d["key"]);
	        $cla = trim($d["c"]);
	        
	        if( strlen( $caa ) ){
	            $r = Singleton::_readInfo("codigoactiva", "*", "where nombre = '" . $caa . "' and md5(userselecto_id) = '" . $key . "'");
	            if( count($r) > 0 ){
	                $aExist = $r[0];
	                
	                if ($aExist["activo"] > 0) throw new Exception("C&oacute;digo ya utilizado.");
	                
	                $horaAct = date("Y-m-d H:i:s");
	                $horaReg = strtotime('+10 minutes', strtotime( $aExist["fecha"] ));
	                
	                if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
	                    throw new Exception("C&oacute;digo inactivo por no usar en los &uacute;ltimos 10 minutos.");
	                }
	                else{
	                    $aa = new Codigoactiva();
	                    $aa->setId($aExist["id"]);
	                    $on = $aa->readInfoById();
	                    $on->setActivo(1);
	                    $r2 = $on->updateData();
	                    if( $r2 > 0 ){
	                        
	                        $cifl_1 = new Usuarios();
	                        $cifl = $cifl_1->readInfo("*", "where id = " . $aExist["userselecto_id"]);
	                        if( count($cifl) > 0 ){
	                            $cifl[0]->setClave( md5($cla) );
	                            $rUss = $cifl[0]->updateData();
	                            
	                            if ($rUss > 0) {
	                                return array( "ok" => true);
	                            }
	                            else{
	                                throw new Exception( "[activarCuenta] No es posible actualizar la clave");
	                            }
	                            
	                        }
	                        else{
	                            throw new Exception( "[activarCuenta] El usuario " . $key . " no existe");
	                        }
	                        
	                        return $key;
	                    }
	                    else{
	                        throw new Exception("Error actualizando la activaci&oacute;n, vuelva a intentarlo.");
	                    }
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
	
	// PDF Config
	const CFG_PDF_PAGECONFIG = 'cfgpdfpageconfig';
	
	// Config SMTP
	const CFG_SMTP_AUTHSMTP = 'cfgsmtpauthsmpt'; // Spmt authen
	const CFG_SMTP_PORT = 'cfgsmtpportnum'; // Port number
	const CFG_SMTP_HOST = 'cfgsmtphost'; // host
	const CFG_SMTP_USER = 'cfgsmtpuser'; // usuario
	const CFG_SMTP_PASS = 'cfgsmtppass'; // password
	const CFG_SMTP_SECURE = 'cfgsmtpsecure'; // secure
	const CFG_SMTP_TFSERVICE = 'cfgsmtptfservice'; // tipo de
	const CFG_SMTP_TFSERVICEURL = 'cfgsmtptfserviceurl'; // tf service url
	const CFG_SMTP_TFSAPITOKEN = 'cfgsmtptfsapitoken'; // tfs api token
	const CFG_SMTP_TFSCLIID = 'cfgsmtptfscliid';   // Id del cliente en el servicio TFServices
	
	// Espacio almacenamiento
	const CFG_ALMACENAMIENTO_TAMANO = 'cfgalmacenamientotamano';
	
	// Deducciones precargadas
	const CFG_DEDUCCIONES_DATA = 'cfgdeduccionesdata';
	
	// Configuracion para requerimientos
	const CFG_REQUERIMIENTOS_MEZCLA = 'cfgrequerimientosmezcla';
	
	public static function EscribirConfig( $d ) {
	    $r = $d[ 'id' ];
	    $v = $d[ 'vl' ];
	    $ufull = $d["ufull"];
	    
	    try {
	        $mo = self::ModificaConfigCorp( $r, $v, $ufull );
	    } catch (\Exception $e) {
	        throw new \Exception("ModificaConfigCorp (mod): " . $e->getMessage() );
	    }
	    
	    return array( "ok" => $mo );
	}
	
	public static function LeerConfigCorp(){
	    $tb = "adminconfig";
	    $ver = "*";
	    $extra = "";
	    $cfg = Singleton::_readInfo($tb, $ver, $extra);
	    
	    $_n = array();
	    foreach ($cfg as $v) {
	        $_n[ $v[ "nombre" ] ] = $v;
	    }
	    
	    return $_n;
	}
	
	private static function ModificaConfigCorp( $llave, $valor, $ufull ){
	    date_default_timezone_set('America/Bogota');
	    $fecha = date("Y-m-d H:i:s");
	    
	    $_n = self::LeerConfigCorp();
	    if( isset( $_n[ $llave ] ) ){ // Configuracion existente
	        $_o = $_n[ $llave ];
	        $tb = "adminconfig";
	        $set = ["val" => $valor, "usuario_full" => $ufull, "fecha" => $fecha];
	        $extra = "id = ?";
	        $pr = [ $_o["id"] ];
	        
	        try {
	            $r = Singleton::_safeUpdate(trim($tb), $set, $extra, $pr);
	            if( $r >= 0){
	                return array( "ok" => true, "cfg" => $llave );
	            }
	        } catch (Exception $e) {
	            throw new Exception("ModificaConfigCorp (mod): " . $e->getMessage() );
	        }
	        
	    }else{ // Configuracion nueva
	        $tb = "adminconfig";
	        $vls = "(null,'" . $llave . "','" . $valor . "', '" . $ufull . "', '" . $fecha . "')";
	        
	        try {
	            $idRes = Singleton::_classicInsertUniqQuery($tb, $vls);
	            if( $idRes > 0){
	                return array( "ok" => true, "cfg" => $llave );
	            }
	        } catch (Exception $e) {
	            throw new Exception("ModificaConfigCorp (add): " . $e->getMessage() );
	        }
	    }
	    
	    return array( "ok" => false, "cfg" => $llave );
	}
	
	public static function fuentes_Obtener( $d ){
	    $res = array();
	    $pathbase = $d['ruta'];
	    
	    foreach(scandir( $pathbase ) as $file ){
	        $fl_tmp = rtrim($pathbase, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
	        if( is_dir( $fl_tmp ) ){
	            if( !( $file == '.' || $file == '..' ) ){
	                $res [ $file ] = self::fuentes_Obtener( array( 'ruta' => $fl_tmp ) );
	            }
	        }
	        else{
	            $flPrt = pathinfo( $fl_tmp );
	            if ( strtolower( $flPrt['extension'] ) == 'ttf' ){
	                $pinfo = pathinfo( $file );
	                $tipo_prt = explode("-", $pinfo['filename']);
	                $loc = explode("fonts" . DIRECTORY_SEPARATOR, $fl_tmp);
	                
	                if ( isset( $tipo_prt[ 1 ] ) ) {
	                    $res[ $tipo_prt[ 1 ] ] = $loc[1];
	                }
	                else {
	                    $res[ 'VariableFont_wght' ] = $loc[1];
	                }
	                
	            }
	        }
	    }
	    return $res;
	}
	// config basics fin
	
	// Codigoactiva INI
	public static function codigoactiva_Add( $d ){
	    if( !isset( $d["id"] ) ) throw new Exception("El id es obligatorio");
	    
	    $i_ctrl = 0;
	    
	    $_d = array();
	    if( isset( $d['cdm'] ) ){  // codigo manual
	        $_d = array("id" => $d['id'],"cd" => $d['cdm']);
	        try {
	            $nuevaClave = !(self::codigoactivaHelper_Add( $_d ) > 0 ? true : false);
	        } catch (Exception $e) {
				http_response_code( 500 );
	            throw new Exception( $e->getMessage() );
	        }
	    }
	    
	    $nuevaClave = false;
	    $clv = Utiles::nuevoCl(6);
	    do{
	        $_d = array(
	            "id" => $d['id'],
	            "cd" => $clv
	        );
	        
	        try {
	            $nuevaClave = !(self::codigoactivaHelper_Add( $_d ) > 0 ? true : false);
	        } catch (Exception $e) {
	            $nuevaClave = true;
	            $clv = Utiles::nuevoCl(6);
	        }
	        
	        $i_ctrl++;
	        if( $i_ctrl >= 20 ){
				http_response_code( 500 );
	            return array("err" => "luego de 20 intentos no se pudo crear un nuevo token");
	        }
	    }while($nuevaClave);

	    // enviar cod
	    $tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "codigocheck.html");
	    $_aed = array(
	        'CLAVE_TMP' => $clv
	    );
	    $replacement_array = self::ObtenerEtiquetasEmail($_aed);
	    
	    $mensaje = preg_replace_callback(
	        '~\{\$(.*?)\}~si',
	        function($match) use ($replacement_array) {
	            return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	        },
	        $tplCode);
	    
	    try {
	        $emOpc = array(
	            "para" => $d['email'],
	            "titulo" => "Nuevapp - Codigo de activacion #" . date('YmdHis'),
	            "mensaje" => $mensaje,
	            "desde" => "notificador@nuevapp.com",
	            "rotulo" => 'Codigo de activacion'
	        );
	        $rsend = self::enviarCustomEmail( $emOpc );
	        return $rsend;
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO . '] codigoactiva_Add - Error enviando correo: ' . $e->getMessage() . '');
	    }
	    
	    return array("ok" => $_d);
	}
	public static function codigoactivaHelperJson64_Add( $d ){ 
	    self::authRequOff();
	    
	    try {
	        $acu = self::Empleadoacudiente_ObtenerPorDocumentoAcudiente_Helper( $d );
	    } catch (Exception $e) {
	        throw new Exception( 'codigoactivaHelperJson64_Add - acudientes_Obtener: ' . $e->getMessage() );
	    }
	    
	    $r = array();
	    if ( count( $acu ) > 0 ) {
	        
	        $acu_dt = array();
	        
	        $dt = json_decode( base64_decode( $d['data'] ) , true );
	        foreach ($acu as $kAcu ) {
	            if (isset( $kAcu['est_documento'] ) ) {
	                if ( trim( $kAcu['est_documento'] ) == trim( $dt['Empleado'] ) ) {
	                    $acu_dt = $kAcu;
	                }
	            }
	        }
	        //die( print_r( $acu_dt ) );
	        $dosc = array();
	        try {
	            $dosc = self::firmaslog_Obtener( array( 'w_acudientes_id' => $acu_dt['acudientes_id'], 'w_empleados_id' => $acu_dt['empleados_id'] ) );
	        } catch (Exception $e) {
	            throw new Exception( 'codigoactivaHelperJson64_Add - firmaslog_Obtener: ' . $e->getMessage() );
	        }
	        
	        try {
	            $r = self::codigoactiva_Add( array( 'id' => $acu_dt['acudientes_id'], 'email' => $acu_dt['mail'] ) );
	        } catch (Exception $e) {
	            throw new Exception( 'codigoactivaHelperJson64_Add - codigoactiva_Add: ' . $e->getMessage() );
	        }
	        
	        if ( isset( $r['ok'] ) ) {
	            return array( 'dt' => $acu_dt, 'res' => strtolower( $r['ok'] ), 'docs' => $dosc );
	        }
	    }
	    
	    return false;
	}
	public static function codigoactivaHelper_Add( $d ){
	    if( !isset( $d["id"] ) ) throw new Exception("El id es obligatorio");
	    if( !isset( $d["cd"] ) ) throw new Exception("El cod es obligatorio");
	    date_default_timezone_set('America/Bogota');
	    
	    $id = $d["id"];
	    $cd = $d["cd"];
	    
	    $okDel = 0;
	    try {
	        $okDel = Singleton::_classicDelete("codigoactiva", "where userselecto_id = " . $id );
	    } catch (Exception $e) {
			http_response_code( 500 );
	        throw new Exception( 'generarCodigo 1: ' . $e->getMessage() );
	    }
	    
	    $okDel = 0;
	    try {
	        $okDel = Singleton::_classicDelete("codigoactiva", "where nombre = '" . $cd . "'" );
	    } catch (Exception $e) {
			http_response_code( 500 );
	        throw new Exception( 'generarCodigo 2: ' . $e->getMessage() );
	    }
	    
	    if ( $okDel > 0 ) {
	        $tb = "codigoactiva";
	        $vls = "(null, '" .  $cd . "', '" . date('Y-m-d H:i:s') . "', 0, " . $id . ")";
	        try {
	            $rid = Singleton::_classicInsertUniqQuery($tb, $vls);
	            return $rid;
	        } catch (Exception $e) {
				http_response_code( 500 );
	            throw new Exception( 'generarCodigo 3: ' . $e->getMessage() );
	        }
	    }
	    return -1;
	}

	public static function codigoactiva_Get( $d ){ 
	    date_default_timezone_set('America/Bogota');
	    if( isset( $d["codActiva"] ) ){
	        if (!isset($d["key"])) { throw new Exception("Sin datos del usuario."); }

	        $caa = trim($d["codActiva"]);
	        $key = trim($d["key"]);
	        
	        if( strlen( $caa ) ){
	            $r = Singleton::_readInfo(
					"codigoactiva", 
					"*", 
					"where nombre = '" . $caa . "' and md5(userselecto_id) = '" . $key . "'"
				);
	            
	            if( count($r) > 0 ){
	                $aExist = $r[0];
	                
	                if ($aExist["activo"] > 0) { 
						http_response_code( 500 );
						throw new Exception("C&oacute;digo ya utilizado.");
					}
	                
	                $horaAct = date("Y-m-d H:i:s");
	                $horaReg = strtotime('+10 minutes', strtotime( $aExist["fecha"] ));
	                
	                if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
						http_response_code( 500 );
	                    throw new Exception("C&oacute;digo inactivo por no usar en los &uacute;ltimos 10 minutos.");
	                } else{
	                    return array("ok" => true);
	                }
	            } else {
					http_response_code( 500 );
	                throw new Exception("C&oacute;digo inexistente");
	            }
	        } else{
				http_response_code( 500 );
	            throw new Exception("C&oacute;digo sin datos");
	        }
	    } else {
			http_response_code( 500 );
	        throw new Exception("Campo codActiva inexistente");
	    }
	}
	
	public static function codigoactiva_Eliminar_limpiar() {
	    try {
	        return self::codigoactiva_Eliminar( array( 'clean' => true) );
	    } catch (Exception $e) {
	        http_response_code( $e->getCode() );
	        throw new \Exception( "[" . $e->getCode() . "]inasistencias_Eliminar_limpiar: " . $e->getMessage() );
	    }
	}
	
	public static function codigoactiva_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "]inasistencias_Eliminar: " . $e->getMessage() );
	    }
	    
	    $tb = "codigoactiva ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( isset( $d['clean'] ) ) {
	        if ( $d['clean'] ) {
	            $xt = "WHERE id > 0 ";
	        }
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( $th->getMessage() );
	    }
	}
	// Codigoactiva FIN

	private static function SubirArchivo($nm, $pth, $nombrecampo = 'file'){
	    $defname = "";
	    if( !isset( $_FILES[ $nombrecampo ] ) ){
	        $fl = print_r($_FILES, true);
	        throw new Exception( 'SubirArchivo, Error indice "file" no existe: ' . $fl );
	    }
	    if ( 0 < $_FILES[ $nombrecampo ]['error'] ) {
	        if ( $_FILES[ $nombrecampo ]['error'] === 1 ) {
	            throw new Exception( 'Error: El archivo es muy grande');
	        }
	        else{
	            throw new Exception( 'Error: ' . $_FILES[ $nombrecampo ]['error'] );
	        }
	    }
	    else {
	        $ext = pathinfo( $_FILES[ $nombrecampo ]['name'] );
	        $name = $nm;
	        $defname = $name . "." . $ext['extension'];
	        $firmas = $pth;
	        
	        if ( !file_exists($firmas) ){
	            mkdir($firmas);
	        }
	        
	        $permitidos = strtolower( $ext['extension'] );
	        
	        if( $permitidos == "png" || $permitidos == "jpg" || $permitidos == "jpeg" || $permitidos == "csv" || $permitidos == "pdf" || $permitidos == "doc" || $permitidos == "docx" || $permitidos == "xls" ||$permitidos == "xlsx" ||  $permitidos == "txt" || $permitidos == "ttf" ){
	            $to = rtrim( $firmas, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $defname;
	            $flTmp = $_FILES[ $nombrecampo ]['tmp_name'];
	            
	            if (file_exists( $flTmp ) ){
	                if ( !move_uploaded_file($flTmp, $to) ) {
	                    if ( !copy($flTmp, $to) ) {
	                        throw new Exception("No fue posible crear el archivo en '" . $to . "'");
	                    }
	                }
	            }
	            else{
	               throw new Exception( 'tmp, Error creando archivo temporal' );
	            }
	        }else {
	            throw new Exception( 'Error SubirArchivo: La extensi&oacute;n ' . $permitidos . ' no est&aacute; permitido' );
	        }
	    }
	    return $defname;
	}
	
	public static function LogNotify_Add( $d ){
	    date_default_timezone_set('America/Bogota');
	    if ( !isset( $_SESSION["usu"] ) ) session_start();
	    /*
	    $destino = strtolower( $d['destino'] );
	    $estado = $d['estado'];
	    $usuario = ( isset($_SESSION["usu"]) ) ? ( $_SESSION["usu"]->getNombres() . " " . $_SESSION["usu"]->getApellidos() ) : "-" ;
	    $fecha = date("Y-m-d H:i:s");
	    $flujos_id = $d['idm'];
	    
	    $ln = new Lognotify();
	    $ln->setDestino( trim( $destino ) );
	    
	    $txtEstado = "nulo";
	    if( isset( $estado['ok'] ) ){
	        $txtEstado = $estado['ok'];
	    }
	    
	    $ln->setEstado( trim( $txtEstado ) );
	    $ln->setUsuario( trim( $usuario ) );
	    $ln->setFecha( $fecha );
	    $ln->setFlujos_id( $flujos_id );
	    
	    $r = $ln->saveData();
	    if( strlen( $ln->obtenerError() ) > 0 ){
	        throw new Exception( $ln->obtenerError() );
	    }
	    
	    return $r;
	    */
	}
	
	public static function LogNotify_Get( $d ){
	    $flujos_id = $d['flujos_id'];
	    $grp = false;
	    if ( isset( $d['grupo'] ) ) {
	        $grp = true;
	    }
	    
	    $tb = "lognotify";
	    $vr = "id,destino,estado,usuario,fecha,flujos_id ";
	    $xt = "WHERE flujos_id = " . $flujos_id . " ";
	    
	    if ( $grp ) {
	        $vr = "id,destino,estado,usuario,fecha,flujos_id, COUNT(destino) as intentos ";
	        $xt  = "WHERE flujos_id = " . $flujos_id . " ";
	        $xt .= 'group by destino ';
	        $xt .= 'order by fecha DESC ';
	    }
	    
	    $r = Singleton::_readInfo($tb,$vr,$xt);
	    
	    return $r;
	}
		
	public static function EstablecerPlantillasEmail( $d ) {
	    if( !isset( $d["tplid"] ) ) throw new Exception("El Id de la plantilla es obligatoria");
	    if( !isset( $d["tplv"] ) ) throw new Exception("El Valor de la plantilla es obligatoria");
	    
	    $tpli = $d["tplid"];
	    $tplv = $d['tplv'];
	    $tpl = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "sistema" . DIRECTORY_SEPARATOR . "email" . DIRECTORY_SEPARATOR . $tpli . ".html";
	    if ( file_exists( $tpl ) ) {
	        $jsontxt = fopen($tpl, "w") or die('no se abre');
	        fwrite($jsontxt, $tplv );
	        fclose($jsontxt);
	        return true;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_PLANTILLA_NO_SALVADA );
	        throw new Exception( "No existe plantilla" );
	    }
	    
	}
	
	public static function CallAPI($method, $url, $data = false, $opt = array()) {
	    $curl = curl_init();
	    
	    switch ($method)
	    {
	        case "POST":
	            if ( is_array( $data )) {
	                curl_setopt($curl, CURLOPT_POST, count($data));
	                if ($data) {
	                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	                }
	            }
	            else {
	                curl_setopt($curl, CURLOPT_POST, 1);
	                curl_setopt($curl, CURLOPT_POSTFIELDS, $data );
	            }
	            
	            break;
	        case "PUT":
	            curl_setopt($curl, CURLOPT_PUT, 1);
	            break;
	        default:
	            if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
	    }
	    
	    foreach ($opt as $kOp => $vOp) {
	        curl_setopt($curl, $kOp, $vOp);
	    }
	    
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_FAILONERROR, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    
	    $result = curl_exec($curl);
	    
	    if (curl_errno($curl)) {
	        $error_msg = curl_error($curl);
	    }
	    
	    if (isset($error_msg)) {
	        throw new Exception($error_msg);
	    }
	    
	    curl_close($curl);
	    return $result;
	}
	
	public static function redimensionImg2($filePath, $newWidth, $newHeight) {
	    if (!function_exists("imagecreatetruecolor")) {
	        throw new Exception('imagecreatetruecolor does not exist');
	    }
	    
	    list($originalWidth, $originalHeight, $imageType) = getimagesize($filePath);
	    $mimeTypes = array(
	        IMAGETYPE_JPEG => 'image/jpeg',
	        IMAGETYPE_PNG => 'image/png',
	        IMAGETYPE_GIF => 'image/gif'
	    );
	    
	    if (!isset($mimeTypes[$imageType])) {
	        return;
	    }
	    
	    $ratio_orig = $originalWidth / $originalHeight;
	    
	    if ($newWidth === null && $newHeight === null) {
	        return;
	    }
	    
	    if ($newWidth === null) {
	        $newWidth = (int) ($newHeight * $ratio_orig);
	    } elseif ($newHeight === null) {
	        $newHeight = (int) ($newWidth / $ratio_orig);
	    }
	    
	    $newImage = imagecreatetruecolor($newWidth, $newHeight);
	    
	    switch ($mimeTypes[$imageType]) {
	        case 'image/jpeg':
	            $image = imagecreatefromjpeg($filePath);
	            break;
	        case 'image/png':
	            imagealphablending($newImage, false);
	            imagesavealpha($newImage, true);
	            $image = imagecreatefrompng($filePath);
	            break;
	        case 'image/gif':
	            $image = imagecreatefromgif($filePath);
	            break;
	        default:
	            return;
	    }
	    
	    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
	    
	    switch ($mimeTypes[$imageType]) {
	        case 'image/jpeg':
	            imagejpeg($newImage, $filePath);
	            break;
	        case 'image/png':
	            imagepng($newImage, $filePath);
	            break;
	        case 'image/gif':
	            imagegif($newImage, $filePath);
	            break;
	    }
	    
	    imagedestroy($image);
	    imagedestroy($newImage);
	}
	
	public static function processBase64Images($html, $outputDir, $maxwidth = 800, $newWidth = null, $newHeight = null) {
	    if (!is_dir($outputDir)) {
	        mkdir($outputDir, 0777, true);
	    }
	    
	    $images = array();
	    preg_match_all('/<img[^>]+src=["\']data:image\/([a-zA-Z]+);base64,([^"\']+)["\'][^>]*>/i', $html, $matches, PREG_SET_ORDER);
	    
	    foreach ($matches as $match) {
	        $extension = $match[1];
	        $base64Data = $match[2];
	        $imageData = base64_decode($base64Data);
	        
	        if ($imageData === false) {
	            continue;
	        }
	        
	        $filename = uniqid("img_", true) . "." . $extension;
	        $filepath = rtrim($outputDir, '/') . '/' . $filename;
	        file_put_contents($filepath, $imageData);
	        
	        list($originalWidth, $originalHeight) = getimagesize($filepath);
	        
	        if ($originalWidth > $maxwidth) {
	            self::redimensionImg2($filepath, $newWidth, null);
	        }
	        
	        $images[] = array(
	            'original' => $match[0],
	            'new_path' => $filepath
	        );
	    }
	    
	    return $images;
	}
	
	public static function replaceBase64ImagesInHtml($html, $processedImages, $dirimg ) {
	    foreach ($processedImages as $image) {
	        $partes = pathinfo( $image['new_path'] ) ;
	        $newImgTag = '<img src="' . $dirimg . '/' . $partes['basename'] . '" />';
	        $html = str_replace($image['original'], $newImgTag, $html);
	    }
	    return $html;
	}
	
	public static function EliminarRecursivo( $d ){
	    foreach(glob( $d ) as $file){
	        if(is_dir($file))
	        {
	            $pt = pathinfo($d);
	            self::EliminarRecursivo( $file . DIRECTORY_SEPARATOR . $pt['basename']);
	        }
	        else
	        {
	            if(is_file($file)){
	                if( !unlink( $file ) ){
	                    return false;
	                }
	            }
	        }
	    }
	    return true;
	}
	
	public static function CacheEliminarArchivos( $d ){
	    if( !isset( $d["ep"] ) ) throw new Exception("El Endpoint es obligatorio");
	    
	    $ep = $d["ep"];
	    
	    $base = dirname( dirname( dirname( __FILE__ ) ) );
	    
	    $pt = "";
	    $ext = "";
	    
	    if( $ep == self::FLD_INFO_FTP_LBL ){
	        $pt = $base . DIRECTORY_SEPARATOR . "galeria" . DIRECTORY_SEPARATOR . "prev";
	        $ext = "*";
	    }
	    elseif ( $ep == self::FLD_INFO_GLR_LBL ){
	        $pt = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . "galeria";
	        $ext = "*.zip";
	    }
	    else {
	        throw new Exception('La opci&oacute;n seleccionada no existe');
	    }
	    
	    if( self::EliminarRecursivo( $pt . DIRECTORY_SEPARATOR . $ext ) ){
	        return array('ok' => true);
	    }
	    
	    return false;
	    
	    
	}
	
	public static function GetDirectorySize( $d, $ext = "" ){
	    $bytestotal = 0;
	    $flstotal = 0;
	    $path = realpath( $d );
	    if( $path !== false && $path != '' && file_exists( $d ) ){
	        if( $ext == ""){
    	        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
                    $bytestotal += $object->getSize();
                    $flstotal++;
    	        }
	        }
	        else {
	            $iterator = new DirectoryIterator( $path );
	            foreach ($iterator as $fileinfo) {
	                if ($fileinfo->isFile()) {
	                    $tmpF = pathinfo( $fileinfo->getFilename() );
	                    if ( strtolower( trim( $tmpF['extension'] ) ) == strtolower( trim( $ext ) ) ) {
	                        $bytestotal += $fileinfo->getSize();
	                        $flstotal++;
	                    }
	                }
	            };
	        }
	    }
	    return array( "tamano" => $bytestotal, "cantidad" => $flstotal );
	}
	
	const FLD_INFO_FTP_LBL = "ftp";
	const FLD_INFO_GLR_LBL = "glr";
	const FLD_INFO_REPO = "repo";
	public static function ObtenerTamanosCarpetas( $d ){
	    if( !isset( $d["ep"] ) ) throw new Exception("El Endpoint es obligatorio");
	    
	    $ep = $d["ep"];
	    $pt = "";
	    $ext = "";
	    if( $ep == self::FLD_INFO_FTP_LBL ){
	        $pt = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . "galeria" . DIRECTORY_SEPARATOR . "prev";
	    }
	    elseif ( $ep == self::FLD_INFO_GLR_LBL ){
	        $pt = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . "galeria";
	        $ext = "zip";
	    }
	    elseif ( $ep == self::FLD_INFO_REPO ){
	        $pt = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . "repo";
	    }
	    
	    $resInfo = self::GetDirectorySize( $pt, $ext );
	    $tam = Utiles::formatBytes( $resInfo['tamano'] );
	    $num = $resInfo['cantidad'];
	    return array( "ok" => array( "tamano" => $tam, "cantidad" => ($num > 1 ? $num . " archivos" : $num . " archivo") ) );
	}
	
	const SUPERUSR_ACC_FULL = "full";
	public static function ObtenerSuperUsuario( $usu, $ac = 0 ){
	    $_gbl_super = self::LeerConfigCorp();
	    if( isset( $_gbl_super[ self::GLB_SUPER_PODER ] ) ) {
	        $gbl_super = json_decode( $_gbl_super[ self::GLB_SUPER_PODER ]["val"], true );
	        foreach ($gbl_super as $vS) {
	            if( $vS["id"] == $usu->getId()){
	                if( isset( $vS["ac"] ) ){
	                    if( $vS["ac"] == self::SUPERUSR_ACC_FULL ){
	                        return true;
	                    } else {
	                        if( $ac > 0 ){
	                            $acA = explode(",", $vS["ac"]);
	                            foreach ($acA as $vAc) {
	                                if( $vAc == $ac ){
	                                    return true;
	                                }
	                            }
	                        }
	                        
	                    }
	                }
	                return false;
	            }
	        }
	        return false;
	    }
	    return false;
	}

	private static $AUTH_ACTIVE = true;
	public static function authRequOff(){
	    self::$AUTH_ACTIVE = false;
	}
	// Servicios Globales INI
	public static function authRequ(){
	    $usu = null;
	    if( self::$AUTH_ACTIVE ){
	        if(!isset($_SESSION)){ session_start(); }
	        
	        if( isset( $_SESSION["usu"] ) ){
	            $usu = $_SESSION["usu"];
	        }
	        else{
	            if( !method_exists($usu, "getId") ){
	                throw new \Exception( "Su sesion expiro, vuelva a iniciar" );
	            }
	        }
	    }

		return $usu;
	}

	public static function lugares_Obtener( $d ){
		
		$vr = "lug.id, lug.nombre, lug.departamento_id, dep.nombre as departamento, pai.nombre as paises ";
		$tb = "lugares as lug ";
		
		$wh = '';
		if ( isset( $d['departamento_id'] ) ) {
		    $wh .= "where departamento_id = " . $d['departamento_id'] . " ";
		}
		
		$wh = '';
		if ( isset( $d['searchtext'] ) ) {
		    $wh .= "where lug.nombre like '%" . $d['searchtext'] . "%' OR dep.nombre like '%" . $d['searchtext'] . "%' OR pai.nombre like '%" . $d['searchtext'] . "%' ";
		}
		
		$ord = "Order by 2 ";
		if ( isset( $d['ord'] )) {
		    $ord = "order by " . intval( $d['ord'] ) . " ";
		}
		$limite = "";
		if ( isset( $d['limite'] )) {
		    $limite = "limit " . intval( $d['limite'] ) . " ";
		}
		
		$xt  = 'LEFT JOIN departamento as dep on lug.departamento_id = dep.id ';
		$xt .= 'LEFT JOIN paises as pai on dep.paises_id = pai.id ';
		
		$xt .= $wh . $ord . $limite;

		$r = Singleton::_readInfoChar( $tb, $vr, $xt );
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	
	public static function sistema_Tamano_Get( $d ) {
	    $data = self::ObtenerTamanosCarpetas( array( 'ep' => self::FLD_INFO_REPO ) );
	    
	    return $data['ok'];
	}
	
	public static function sistema_recuperarClave_Get( $d ) {
	    $data = base64_decode( $d['data'] );
	    $oD = json_decode( $data , true );
	    
	    self::authRequOff();
	    
	    $r = array();
	    try {
	        $r = self::usuarios_Obtener( array( 'w_email' => $oD['email'] ) );
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] sistema_recuperarClave_Get - usuarios_Obtener: ' . $e->getMessage() );
	    }
	    
	    if ( count( $r ) > 0 ) {
	        $mpg = new MagicPagesLib();
	        $mpg->Crear($d);
	    }
	    
	    return $r;
	}
	// Servicios Globales FIN
	
	// Anyolectivo INI
	public static function anyolectivo_Obtener ( ){
	    $r = self::anyolectivo_Listado_Obtener( array( 'limite' => 1 ) );
	    return $r;
	}
	public static function anyolectivo_Listado_Obtener ( $d ){
	    $vr = "id, nombre ";
	    $tb = "anyolectivo ";
	    
	    $wh = "";
	    if ( isset( $d['id'] ) ) {
	        $wh = "WHERE id = " . intval( $d['id'] ) . " ";
	    }
	    
	    if ( isset( $d['difid'] ) ) {
	        $wh = "WHERE id != " . intval( $d['difid'] ) . " ";
	    }
	    
	    $or  = "order by 1 desc ";
	    if ( isset( $d['orden'] ) ) {
	        $or = "limit " . intval( $d['limite'] ) . " ";
	    }
	    
	    $lt  = "";
	    if ( isset( $d['limite'] ) ) {
	        $lt = "limit " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt = $wh . " " . $or . " " . $lt ;
	    
	    $r = Singleton::_readInfoChar( $tb, $vr, $xt );
	    if ( isset( $r['err_info'] )) {
	        http_response_code( 500 );
	        throw new \Exception( $r['err_info'] );
	    }
	    
	    return $r;
	}
	
	public static function anyolectivo_Add ( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $nombre = $d['nombre'];
	    
	    $o = new Anyolectivo();
	    $o->setNombre( $nombre );
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( 500 );
	        throw new \Exception( $o->obtenerError() );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( 503 );
	        throw new \Exception( 'Respuesta no implementada' );
	    }
	}
	// Anyolectivo FIN
	
	// Institucion INI
	public static function institucion_Obtener( )
	{
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		$r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );

		$vr  = "inst.id, inst.nombre, inst.direccion, inst.telefono, inst.dane, inst.licencia, inst.nit, inst.resolucion, inst.lugares_id, depto.id as departamento_id, pais.id as paises_id, inst.anyolectivo_id, inst.usuarios_id, concat( usrs.nombres, ' ' , usrs.apellidos ) as fullname ";
		$tb  = "institucion  as inst ";
		$xt  = "LEFT JOIN lugares as lug on lug.id = inst.lugares_id ";
		$xt .= "LEFT JOIN departamento as depto on depto.id = lug.departamento_id ";
		$xt .= "LEFT JOIN paises as pais on pais.id = depto.paises_id ";
		$xt .= "LEFT JOIN usuarios as usrs on usrs.id = inst.usuarios_id ";
		
		$xt .= 'order by 1 ';
		$xt .= "limit 1";

		$r = Singleton::_readInfoChar($tb,$vr,$xt,IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
		
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	public static function institucion_Agregar( $d ){
		$usu = null;
		try {
			$usu = self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}

		$tmpanyo = self::anyolectivo_Obtener();

		$nombre = $d['nombre'];
		$direccion = $d['direccion'];
		$telefono = $d['telefono'];
		$dane = $d['dane'];
		$licencia = ( isset( $d['licencia'] )  ? $d['licencia'] : "" );
		$nit = $d['nit'];
		$resolucion = $d['resolucion'];
		$lugares_id = $d['lugares_id'];
		$anyolectivo_id= $tmpanyo[0]['id'];
		$usuarios_id = $d['director'];

		$o = new Institucion();

		$o->setNombre( $nombre );
		$o->setDireccion( $direccion );
		$o->setTelefono( $telefono );
		$o->setDane( $dane );
		$o->setLicencia( $licencia );
		$o->setNit( $nit );
		$o->setResolucion( $resolucion );
		$o->setLugares_id( $lugares_id );
		$o->setAnyolectivo_id( $anyolectivo_id );
		$o->setUsuarios_id( $usuarios_id );

		try {
			Singleton::_classicDelete('institucion', 'where id > 0');
		} catch (\Throwable $th) {
			throw new \Exception( $th->getMessage() );
		}

		$id = $o->saveData();
		if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
			http_response_code( 500 );
			throw new \Exception( $o->obtenerError() );
		}

		if( $id > 0){
			return $d;
		}
		else {
			http_response_code( 503 );
			throw new \Exception( 'Respuesta no implementada' );
		}
	}

	public static function institucion_AgregarLogo( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		$nm = 'logo_inst';
		$pth = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'temas' . DIRECTORY_SEPARATOR . 'img';

		try {
			return self::SubirArchivo($nm, $pth);
		} catch (\Throwable $th) {
			throw new \Exception( $th->getMessage() );
		}
	}
	
	public static function institucion_Modificar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb = "institucion ";
	    
	    $stA = array();
	    if ( isset( $d['nombre'] ) ) {
	        $stA['nombre'] = $d['nombre'] ;
	    }
	    if ( isset( $d['direccion'] ) ) {
	        $stA['direccion'] = $d['direccion'] ;
	    }
	    if ( isset( $d['telefono'] ) ) {
	        $stA['telefono'] = $d['telefono'];
	    }
	    if ( isset( $d['dane'] ) ) {
	        $stA['dane'] = $d['dane'] ;
	    }
	    if ( isset( $d['licencia'] ) ) {
	        $stA['licencia'] = $d['licencia'] ;
	    }
	    if ( isset( $d['nit'] ) ) {
	        $stA['nit'] = $d['nit'] ;
	    }
	    if ( isset( $d['resolucion'] ) ) {
	        $stA['resolucion'] = $d['resolucion'] ;
	    }
	    if ( isset( $d['lugares_id'] ) ) {
	        $stA['lugares_id'] = $d['lugares_id'] ;
	    }
	    if ( isset( $d['anyolectivo_id'] ) ) {
	        $stA['anyolectivo_id'] = $d['anyolectivo_id'] ;
	    }
	    if ( isset( $d['usuarios_id'] ) ) {
	        $stA['usuarios_id'] = $d['usuarios_id'] ;
	    }
	    
	    if ( !( count( $stA ) > 0 ) ) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_ACTUALIZACION_SQL . '] cursos_Modificar: Debe indicar valores a asignar' );
	    }
	    
	    $pr = array();
	    $xt  = '';
	    if ( isset( $d['id'] ) ) {
	        $xt  = 'id = ?';
	        $pr[] = $d['id'] ;
	    }
	    if ( isset( $d['wanyolectivo_id'] ) ) {
	        $xt  = 'anyolectivo_id = ?';
	        $pr[] = $d['wanyolectivo_id'] ;
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_ACTUALIZACION_SQL . '] cursos_Modificar: Filtro es obligatorio' );
	    }
	    
	    try {
	        return Singleton::_safeUpdate( trim($tb), $stA, $xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( 500 );
	        throw new \Exception( $th->getMessage() );
	    }
	}
	
	// Institucion FIN

	// Control usuarios INI
	const USUARIOS_PERFIL_SUPER_USUARIO = "1";
	const USUARIOS_PERFIL_ADMINISTRADOR = "2";
	const USUARIOS_PERFIL_SUPERVISOR = "3";
	const USUARIOS_PERFIL_EMPLEADOS = "4";
	const USUARIOS_PERFIL_ACUDIENTE = "5";
	const USUARIOS_PERFIL_FINANCIERO = "6";
	const USUARIOS_PERFIL_SUPERVISORADM = "7";
	const USUARIOS_PERFIL_PROVEEDOR = "8";
	const USUARIOS_PERFIL_RUTA = "9";
	
	// Uso de la funcion de agregar o modificar
	const USUARIOS_HELPER_AGREGAR = "1";
	const USUARIOS_HELPER_MODIFICAR = "2";
	
	const USUARIOS_FORM_ANEXO_ID = "formFile";
	
	public static function usuarios_Helper_AgregarMini( $d, $perfil ){
	    $r = null;
	    try {
	        $r = self::mnguserAdd_Helper($d, $perfil);
	    } catch (Exception $e) {
	        throw new Exception( 'usuarios_Helper_AgregarMini - mnguserAdd_Helper: ' . $e->getMessage() );
	    }
	    return $r;
	}
	
	public static function mnguserAdd_Helper( $d, $perfil ){
	    // Modificar por ref
		 
	    self::mnguserAdd_Prepare($d, $perfil);
	    
	    //die( "_lugares_id: \n" . print_r( $d , true ) );
	   
	    $_lugares_id = 927;
	    if( isset($d['lugares_id']) ) {
	        if ( intval( $d['lugares_id'] ) > 0 ) {
	            $_lugares_id = $d['lugares_id'];
	        }
	    }
	    
	    $_lugarescedula_id = 927;
	    if( isset($d['lugarescedula_id']) ) {
	        if ( intval( $d['lugarescedula_id'] ) > 0 ) {
	            $_lugarescedula_id = $d['lugarescedula_id'];
	        }
	    }
	    
	    $_loc_lugares_id = 927;
	    if( isset($d['loc_lugares_id']) ) {
	        if ( intval( $d['loc_lugares_id'] ) > 0 ) {
	            $_loc_lugares_id = $d['loc_lugares_id'];
	        }
	    }
	    
	    $_oficio = "";
	    if( isset($d['oficio']) ) {
	        if ( strlen( $d['oficio'] ) > 0 ) {
	            $_oficio = $d['oficio'];
	        }
	    }
	    $_salariomes = 0;
	    if( isset($d['salariomes']) ) {
	        if ( strlen( $d['salariomes'] ) > 0 ) {
	            $_salariomes = $d['salariomes'];
	        }
	    }
	    $_contratoini = "1900-01-01 00:00:00";
	    if( isset($d['contratoini']) ) {
	        if ( strlen( $d['contratoini'] ) > 0 ) {
	            $_contratoini = $d['contratoini'];
	        }
	    }
	    $_contratofin  = "1900-01-01 00:00:00";
	    if( isset($d['contratofin']) ) {
	        if ( strlen( $d['contratofin'] ) > 0 ) {
	            $_contratofin = $d['contratofin'];
	        }
	    }
	    
	    $apellidos = '';
	    if ( isset( $d['apellidos'] ) ) {
	        if (strlen( $d['apellidos'] ) > 0 ) {
	            $apellidos = $d['apellidos'];
	        }
	    }
	    
	    $clave = Utiles::nuevoCl();
	    if ( isset( $d['clave'] ) ) {
	        if (strlen( $d['clave'] ) > 0 ) {
	            $clave = $d['clave'];
	        }
	    }
	    
		$_d = array(
			'tipodoc_id' => $d['tipodoc_id'],
			'documento' => $d['documento'],
		    'lugarescedula_id' => $_lugarescedula_id,
			'nombres' => $d['nombres'],
		    'apellidos' => $apellidos,
			'mail' => $d['mail'],
			'nacimiento' => ( isset( $d['nacimiento'] ) ? $d['nacimiento'] : '1900-01-01 00:00:00'),
		    'generos_id' => ( isset( $d['generos_id'] ) ? $d['generos_id'] : '1'),
		    'lugares_id' => $_lugares_id,
			'gruposanguineo' => ( isset( $d['gruposanguineo'] ) ? $d['gruposanguineo'] : ''),
		    'codigo' => ( isset( $d['codigo'] ) ? $d['codigo'] : $d['documento']),
		    'usuario' => ( isset( $d['usuario'] ) ? $d['usuario'] : $d['documento']),
		    'clave' => $clave,
			'direccion' => ( isset( $d['direccion'] ) ? $d['direccion'] : ''),
			'barrio' => ( isset( $d['barrio'] ) ? $d['barrio'] : ''),
		    'loc_lugares_id' => $_loc_lugares_id,
			'cargos_id' => ( isset( $d['cargos_id'] ) ? $d['cargos_id'] : 1),
			'titulos_id' => ( isset( $d['titulos_id'] ) ? $d['titulos_id'] : 1),
			'perfil_id' => $perfil,
		    'eps' => ( isset( $d['eps'] ) ? $d['eps'] : ""),
		    'ars' => ( isset( $d['ars'] ) ? $d['ars'] : ""),
		    'oficio' => $_oficio,
		    'salariomes' => $_salariomes,
		    'contratoini' => $_contratoini,
		    'contratofin' => $_contratofin
		);

		$idUsr = null;
		
		$nuevousr = "1";
		if ( isset( $d['nuevousr'] ) ) {
		    $nuevousr = $d['nuevousr'];
		    $idUsr = array( 'id' => $d['nhid'] );
		}
		
		if ( $perfil == self::USUARIOS_PERFIL_EMPLEADOS ) {
			$_d['titulos_id'] = 1;
			$_d['cargos_id'] = 1;

			if( $nuevousr == "1" ){
			    try {
			        $idUsr = self::empleados_Agregar( $_d );
			    } catch (\Throwable $th) {
			        throw new \Exception ( 'mnguserAdd_Helper - empleados_Agregar: ' . $th->getMessage() );
			    }
			    
			    // mk p12
			    $reqP12 = $_d;
			    $reqP12['tipousuario'] = self::FIRMASPRO_TIPOUSUARIO_CONTRATISTA;
			    $reqP12['usuario_id'] = $idUsr['id'];
			    $reqP12['clave'] = md5( $_d['clave'] );
			    try {
			        self::firmaspro_Helper_MkCert_p12( $reqP12 );
			    } catch (Exception $e) {
			        $msjr = self::retorno([], $e->getCode(),'mnguserAdd_Helper - firmaspro_Helper_MkCert_p12: ' . $e->getMessage() );
			        throw new Exception( json_encode( $msjr ), $e->getCode() );
			    }
			    
			}
			else {
			    $modD = $_d;
			    $modD['id'] = $d['nhid'];
			    try {
			        self::empleados_Modificar( $modD );
			    } catch (\Throwable $th) {
			        throw new \Exception ( 'mnguserAdd_Helper - empleados_Modificar: ' . $th->getMessage() );
			    }
			}
			
			if ( isset( $d['tel'] ) ) {
				if ( strlen( trim( $d['tel'] ) ) > 0 ) {
				    
				    if( $nuevousr != "1" ){
				        try {
				            self::telefonosempleado_Eliminar( array( 'by_empleado_id' => $idUsr['id'] ) );
				        } catch (Exception $e) {
				            throw new Exception( 'mnguserAdd_Helper: ' . $e->getMessage() );
				        }
				    }
				    
				    $estv = array(
				        'tipotele_id' => 3,
				        'valor' => $d['tel'],
				        'empleado_id' => $idUsr['id']
				    );
					try {
						self::telefonosempleado_Agregar( $estv );
					} catch (\Throwable $th) {
						throw new \Exception ( $th->getMessage() );
					}
				}
			}
			
			if ( isset( $d['obligaciones' ] )) {
			    $obligaciones = $d['obligaciones'];
			    foreach ($obligaciones as $oBli) {
			        $nwObli = array(
			            'descripcion' => $oBli['obligacion'],
			            'empleados_id' => $idUsr['id'],
			            'empleadosobjetivosestados_id' => 1,
			            'vigencia' => $oBli['vigencia'],
			            'orden' => $oBli['orden']
			        );
			        self::empleadosobjetivos_Agregar( $nwObli );
			    }
			}
			
			/*
			 * @vnavarro
			 * TODO: Tarea 2 Listo
			 *   Vamos a controlar que el formulario de crear el empleado obtenga los datos
			 *   1. Valida que $d tiene empleadosdetallescontrato_meses, empleadosdetallescontrato_dias
			 *   2. Como esta funcion (mnguserAdd_Helper) solo es para creacion, entonces utiliza la funcion q creaste (empleadosdetallescontrato_agregar) para agregar los meses y los dias
			 *   3. Usa la variable $idUsr para el campo empleados_id  
			 */
			
				if (isset($d['empleadosdetallescontrato_meses']) && isset($d['empleadosdetallescontrato_dias']) || isset($d['fechainicio']) && isset($d['fileactaini'])) {
					$payload = array(
						'empleados_id' => $idUsr['id'],
						'meses' => intval($d['empleadosdetallescontrato_meses']),
						'dias'  => intval($d['empleadosdetallescontrato_dias']),
						'fechainicio' => $d['fechainicio'] ?? null,
						'fileactaini' => $d['fileactaini'] ?? null
					);

					try {
						self::empleadosdetallescontrato_Agregar($payload);
					} catch (\Throwable $th) {
						throw new \Exception('mnguserAdd_Helper - empleadosdetallescontrato_Agregar: ' . $th->getMessage());
					}
				}
			
			
			foreach ( $d as $anId => $anVl ) {
			    if( Utiles::ComienzaEn($anId, self::USUARIOS_FORM_ANEXO_ID) ){
			        $fld_base = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "anexos" . DIRECTORY_SEPARATOR;
			        $fld_alum = $fld_base . preg_replace('/\D/', '', $d['documento']) ;
			        
			        if ( !file_exists( $fld_alum ) ) {
			            mkdir($fld_alum);
			        }
			        
			        $_flId = "a" . $anId;
			        if ( file_exists($_FILES[ $_flId ]['tmp_name']) || is_uploaded_file($_FILES[  $_flId ]['tmp_name'] ) ) {
			            try {
			                self::SubirArchivo($_flId, $fld_alum, $_flId );
			            } catch (Exception $e) {
			                throw new Exception( $e );
			            }
			        }
			    }
			}
		}
		elseif ( $perfil == self::USUARIOS_PERFIL_ADMINISTRADOR || $perfil == self::USUARIOS_PERFIL_SUPERVISOR || $perfil == self::USUARIOS_PERFIL_SUPERVISORADM || $perfil == self::USUARIOS_PERFIL_PROVEEDOR || $perfil == self::USUARIOS_PERFIL_RUTA ) {
			try {
				$idUsr = self::usuarios_Agregar( $_d );
			} catch (\Throwable $th) {
				throw new \Exception ( $th->getMessage() );
			}

			if ( isset( $d['tel'] ) ) {
				if ( strlen( trim( $d['tel'] ) ) > 0 ) {
					try {
						$estv = array(
							'tipotele_id' => 3,
							'valor' => $d['tel'],
							'usuarios_id' => $idUsr['id']
						);
						self::telefonosusuarios_Agregar( $estv );
					} catch (\Throwable $th) {
						throw new \Exception ( $th->getMessage() );
					}
				}
			}
			
			if ( ! self::USUARIOS_PERFIL_PROVEEDOR ) {
			    $opcNotify = array(
			        'id' => $idUsr['id'],
			        'mail' => $d['mail'],
			        'setclave' => $idUsr['tmppws']
			    );
			    try {
			        self::usuarios_NuevaClaveAjax( $opcNotify , $perfil);
			    } catch (Exception $e) {
			        http_response_code( IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO );
			        throw new Exception ( '[' . IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO . ']mnguserAdd_Helper: ' . $e->getMessage() );
			    }
			}

		}
		else {
			http_response_code( 500 );
			throw new \Exception ( 'Agregar usuarios: Perfil indefinido' );
		}

		return $idUsr;
	}
	
	public static function mnguserAdd_Prepare( &$d, $perfil ){
	    if ( $perfil == self::USUARIOS_PERFIL_EMPLEADOS ) {
	        
	        $n_clean = strtolower( Utiles::CleanSpecialChars( $d['nombres'] ) );
	        
	        $a_clean = "";
	        if ( isset( $d['apellidos'] ) ) {
	            $a_clean = strtolower( Utiles::CleanSpecialChars( $d['apellidos'] ) );
	        }
	        
	        $nom = str_replace(" ", ".", strtolower( $n_clean ) );
	        $ape = explode(" ", strtolower( $a_clean ) );
	        $doc = preg_replace('/\D/', '', $d['documento']);
	        $def = $nom[0] . $ape[0] . $doc;
	        
	        if( ! isset( $d['mail'] ) ){
	            $d['mail'] = $def . "@empty.com";
	        }
	        
	        if( ! isset( $d['codigo'] ) ){
	            $d['codigo'] = $d['documento'];
	        }
	        
	        if( ! isset( $d['usuario'] ) ){
	            $d['usuario'] = $d['tipodoc_id'] . $d['documento'];
	        }
	        
	    }
	    if ( $perfil == self::USUARIOS_PERFIL_FINANCIERO || $perfil == self::USUARIOS_PERFIL_PROVEEDOR || $perfil == self::USUARIOS_PERFIL_RUTA ) {
	        $d['codigo'] = $d['documento'];
	        $d['usuario'] = $d['documento'];
	        $d['generos_id'] = 1;
	    }
	}
	// Control usuarios FIN

	// Empleados INI 
	public static function empleados_Agregar( $d ){
		date_default_timezone_set('America/Bogota');
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$tipodoc_id = (isset( $d['tipodoc_id'] ) ? $d['tipodoc_id'] : 1);
		$documento = $d['documento'];
		$lugarescedula_id = (isset( $d['lugarescedula_id'] ) ? $d['lugarescedula_id'] : "927");
		$nombres = $d['nombres'];
		$apellidos = (isset( $d['apellidos'] ) ? $d['apellidos'] : "");
		$mail = $d['mail'];
		$nacimiento = (isset( $d['nacimiento'] ) ? $d['nacimiento'] : "1900-01-01 00:00:00");
		$generos_id = (isset( $d['generos_id'] ) ? $d['generos_id'] : 1);
		$lugares_id = (isset( $d['lugares_id'] ) ? $d['lugares_id'] : "927");
		$gruposanguineo = (isset( $d['gruposanguineo'] ) ? $d['gruposanguineo'] : "");
		$codigo = (isset( $d['codigo'] ) ? $d['codigo'] : $d['documento'] );
		$usuario = (isset( $d['usuario'] ) ? $d['usuario'] : $d['documento'] );
		$clave = (isset( $d['clave'] ) ? $d['clave'] : Utiles::nuevoCl() );
		$direccion = (isset( $d['direccion'] ) ? $d['direccion'] : '' );
		$barrio = (isset( $d['barrio'] ) ? $d['barrio'] : '' );
		$loc_lugares_id = (isset( $d['loc_lugares_id'] ) ? $d['loc_lugares_id'] : "927" );
		$cargos_id = (isset( $d['cargos_id'] ) ? $d['cargos_id'] : 1 );
		$titulos_id = (isset( $d['cargos_id'] ) ? $d['cargos_id'] : 1 );

		$perfil_id = (isset( $d['perfil_id'] ) ? $d['perfil_id'] : 4 );
		$estado_id = 1;
		if ( isset( $d['$estado_id'] ) ) {
		    $estado_id = $d['$estado_id'];
		}
		
		$eps = (isset( $d['eps'] ) ? $d['eps'] : "");
		$ars = (isset( $d['ars'] ) ? $d['ars'] : "");
		
		$oficio = (isset( $d['oficio'] ) ? $d['oficio'] : "");
		$salariomes = (isset( $d['salariomes'] ) ? $d['salariomes'] : "");
		$contratoini = (isset( $d['contratoini'] ) ? $d['contratoini'] : "1900-01-01 00:00:00");
		$contratofin = (isset( $d['contratofin'] ) ? $d['contratofin'] : "1900-01-01 00:00:00");
		
		$dependencias_id = (isset( $d['dependencias_id'] ) ? $d['dependencias_id'] : 1 );

		$o = new Empleados();
		$o->setTipodoc_id( $tipodoc_id );
		$o->setDocumento( $documento );
		$o->setLugarescedula_id( $lugarescedula_id );
		$o->setNombres( $nombres );
		$o->setApellidos( $apellidos );
		$o->setMail( $mail );
		$o->setNacimiento( $nacimiento );
		$o->setGeneros_id( $generos_id );
		$o->setLugares_id( $lugares_id );
		$o->setGruposanguineo( $gruposanguineo );
		$o->setCodigo( $codigo );
		$o->setUsuario( $usuario );
		$o->setClave( md5( $clave ) );
		$o->setFoto( '' );
		$o->setDireccion( $direccion );
		$o->setBarrio( $barrio );
		$o->setLoc_lugares_id( $loc_lugares_id );
		$o->setCargos_id( $cargos_id );
		$o->setTitulos_id( $titulos_id );
		$o->setCreado( date('Y-m-d H:i:s') );
		$o->setPerfil_id( $perfil_id );
		$o->setEstado_id( $estado_id );
		
		$o->setEps($eps);
		$o->setArs($ars);
		
		$o->setOficio($oficio);
		$o->setSalariomes($salariomes);
		$o->setContratoini($contratoini);
		$o->setContratofin($contratofin);
		
		$o->setDependencias_id($dependencias_id);

		$id = $o->saveData();
		if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
			http_response_code( 500 );
			throw new \Exception( $o->obtenerError() );
		}

		if( $id > 0){
			return array( 'id' => $id );
		}
		else {
			http_response_code( 503 );
			throw new \Exception( 'Respuesta no implementada' );
		}
	}
	
	public static function empleados_Helper_Modificar( $d ){
	    $r = null;
	    try {
	        self::empleados_Modificar($d);
	    } catch (Exception $e) {
	        throw $e;
	    }
	
	    /*
	     * @vnavarro
	     * TODO: Tarea 3 Listo
	     *   Vamos a controlar que el formulario de modificar (el mismo de crear) el empleado obtenga los datos
	     *   1. Valida que $d tiene empleadosdetallescontrato_meses, empleadosdetallescontrato_dias
	     *   2. Utiliza la funcion q creaste (empleadosdetallescontrato_modificar) para actualizar los meses y los dias
	     *   3. Usa la variable $d['id'] para el campo empleados_id
	     *   4. Utiliza try/catch
	     */

			
		if ( isset($d['empleadosdetallescontrato_meses']) || isset($d['empleadosdetallescontrato_dias']) || isset($d['fechainicio']) || isset($d['fileactaini']) ) {
			try {
				$detalleContrato = array(
				'documento' => $d['documento'],
				'tipodoc_id' => $d['tipodoc_id'],
				'meses' => isset($d['empleadosdetallescontrato_meses']) ? intval($d['empleadosdetallescontrato_meses']) : 0,
				'dias' => isset($d['empleadosdetallescontrato_dias']) ? intval($d['empleadosdetallescontrato_dias']) : 0,
				'empleados_id' => $d['id'],
				'fechainicio' => $d['fechainicio'] ?? null,
				'fileactaini' => $d['fileactaini'] ?? null
			);

			$payload = [
				'data' => base64_encode(
					json_encode($detalleContrato, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE)
				)
			];

				self::empleadosdetallescontrato_Helper_Agregar($payload);
			} catch (\Throwable $th) {
				throw new \Exception('empleados_Helper_Modificar - empleadosdetallescontrato_modificar: ' . $th->getMessage());
			}
		}
	    
	    return $r;
	}
	public static function empleados_Modificar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}

		$nacimiento = ( isset( $d['nacimiento'] ) ? $d['nacimiento'] : '1900-01-01 00:00:00');
		$tb  = "empleados ";
		
		$aSt = array();
		if ( isset( $d['tipodoc_id'] ) ) {
		    $aSt['tipodoc_id'] = $d['tipodoc_id'];
		}
		if ( isset( $d['documento'] ) ) {
            $aSt['documento'] = $d['documento'] ;
		}
		if ( isset( $d['lugarescedula_id'] ) ) {
            $aSt['lugarescedula_id'] = $d['lugarescedula_id'];
		}
		if ( isset( $d['nombres'] ) ) {
            $aSt['nombres'] = trim( $d['nombres'] ) ;
		}
		if ( isset( $d['apellidos'] ) ) {
            $aSt['apellidos'] = trim( $d['apellidos'] ) ;
		}
		if ( isset( $d['mail'] ) ) {
            $aSt['mail'] = trim( strtolower( $d['mail'] ) ) ;
		}
		if ( isset( $d['nacimiento'] ) ) {
		    $aSt['nacimiento'] = trim( $nacimiento ) ;
		}
		if ( isset( $d['generos_id'] ) ) {
		    $aSt['generos_id'] = $d['generos_id'];
		}
		if ( isset( $d['lugares_id'] ) ) {
		    $aSt['lugares_id'] = $d['lugares_id'];
		}
		if ( isset( $d['gruposanguineo'] ) ) {
		    $aSt['gruposanguineo'] = strtolower( trim( $d['gruposanguineo'] ) ) ;
		}
		if ( isset( $d['codigo'] ) ) {
		    $aSt['codigo'] = strtolower( trim( $d['codigo'] ) ) ;
		}
		if ( isset( $d['usuario'] ) ) {
		    $aSt['usuario'] = strtolower( trim( $d['usuario'] ) ) ;
		}
		if ( isset( $d['direccion'] ) ) {
		    $aSt['direccion'] = trim( $d['direccion'] ) ;
		}
		if ( isset( $d['barrio'] ) ) {
		    $aSt['barrio'] = trim( $d['barrio'] ) ;
		}
		if ( isset( $d['loc_lugares_id'] ) ) {
		    $aSt['loc_lugares_id'] = $d['loc_lugares_id'];
		}
		if ( isset( $d['dependencias_id'] ) ) {
		    $aSt['dependencias_id'] = $d['dependencias_id'];
		}
		if ( isset( $d['nuevo_estado_id'] ) ) {
		    $aSt['nuevo_estado_id'] = $d['nuevo_estado_id'] ;
		}
		
		$id = 0;
		$wh  = '';
		if ( isset( $d['id'] ) ) {
		    $id = $d['id'];
		    $wh  = 'id = ?';
		}
		if ( $wh == '' ) {
		    http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
		    throw new Exception( '[' . IndexCtrl::ERR_COD_ACTUALIZACION_SQL . '] empleados_Modificar: Debe indicar un filtro para actualizar' );
		}
		
		$xt = $wh;
        $pr = [ $id ];
        
        //$sqlPart = implode(', ', array_map(function($k, $v) {return $k . " = '" . addslashes($v) . "'";}, array_keys($aSt), $aSt));
        //die('UPDATE ' . $tb . ' SET ' . $sqlPart . ' ' . $xt);
		
		$cu = null;
		try {
			$cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
		} catch (\Throwable $th) {
			http_response_code( 500 );
			throw new \Exception( 'empleados_Modificar: ' . $th->getMessage() );
		}

		if ( isset( $d['tel'] ) ) {
			if ( strlen( trim( $d['tel'] ) ) > 0 ) {
				try {
					$modTel = array(
						'id' => $id,
						'valor' => trim($d['tel']),
						'by_tipotele_id' => 3
					);
					self::telefonosempleado_Modificar( $modTel );
				} catch (\Throwable $th) {
					http_response_code( 500 );
					throw new \Exception( 'empleados_Modificar - telefonosempleado_Modificar: ' . $th->getMessage() );
				}
			}
		}

		return $cu;
	}
	private static function empleados_ModificarClave( $d ){ 
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }

	    $clave = $d['clave'];
	    
	    $tb  = 'empleados ';
	    $st  = ['clave' => md5( $clave ) ];
	    $xt  = '';
	    $pr  = [];
	    if ( isset( $d['id'] ) ) {
	        $xt  = 'id = ?';
	        $pr  = [ $d['id'] ];
	    }
	    
	    if ( isset( $d['idhash'] ) ) {
	        $xt  = 'md5( id ) = ?';
	        $pr  = [ $d['idhash'] ];
	    }
	    
	    if ( $xt == '') {
	        http_response_code( IndexCtrl::ERR_COD_EST_CLAVE_NO_MODIFICADA );
	        throw new Exception('[' . IndexCtrl::ERR_COD_EST_CLAVE_NO_MODIFICADA . '] empleados_ModificarClave: Debe indicar un filtro');
	    }
	    
	    //die('update ' . $tb . ' SET ' . $st . ' ' . $xt );
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$st,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_ACTUALIZACION_SQL . '] empleados_ModificarClave:' . $th->getMessage() );
	    }
	    
	    $alum = array();
	    if ( $cu ) {
	        if ( isset( $d['idhash'] ) ) {
	           $opcQry = array( 'w_id_md5' => $d['idhash'] );
	        }
	        elseif ( isset( $d['id'] ) ) {
	            $opcQry = array( 'id' => $d['id'] );
	        }
	        
	        try {
	            $uOk = self::empleados_Obtener( $opcQry );
	        } catch (Exception $e) {
	            throw new Exception( 'empleados_ModificarClave: ' . $e->getMessage() );
	        }
	        
	        foreach ( $uOk as $vAl ) {
	            $alum = array( 
	                'documento' => $vAl['documento'], 
	                'tipodoc' => $vAl['tipodoc']
	            );
	        }
	    }
	    
	    return $alum;
	}
	
	public static function empleados_NuevaClaveAjax( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( 'empleados_NuevaClaveAjax - authRequ : ' . $e->getMessage() );
	    }
	    if ( $usu->getPerfil_id() == self::USUARIOS_PERFIL_SUPER_USUARIO || $usu->getPerfil_id() == self::USUARIOS_PERFIL_ADMINISTRADOR || $usu->getPerfil_id() == self::USUARIOS_PERFIL_SUPERVISORADM ) {
	        
	        $usr = null;
	        $_id = $d['id'];
	        $_notificar = ( isset( $d['notificar'] ) ? $d['notificar'] : '1');
	        try {
	            $usr = self::empleados_Obtener( array( 'id' => $_id ) );
	        } catch (Exception $e) {
	            http_response_code( 500 );
	            throw new Exception("[500]usuarios_NuevaClaveAjax - empleados_Obtener: " . $e->getMessage() . "");
	        }
	        
	        if( !(count( $usr ) > 0) ){
	            http_response_code( IndexCtrl::ERR_COD_USUARIO_NO_EXISTE_BY_ID );
	            throw new Exception("usuarios_NuevaClaveAjax: El usuario no existe, verifique los datos.");
	        }
	        
	        $dt = $usr[0];
	        
	        $clv = Utiles::nuevoCl(8);
	        $ea = $dt["mail"];
	        
	        if ( isset( $d['setclave'] ) ) {
	            $clv = $d['setclave'];
	        }
	        
	        $addDt = array(
	            'id' => $_id,
	            'clave' => $clv
	        );

	        try {
	            self::empleados_ModificarClave( $addDt );
	        } catch (Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_CAMBIO_CLAVE_FALLIDO );
                throw new Exception( "empleados_NuevaClaveAjax - empleados_ModificarClave: " . $e->getMessage() );
	        }
	        
	        // mk p12
	        $reqP12 = $dt;
	        $reqP12['tipousuario'] = self::FIRMASPRO_TIPOUSUARIO_CONTRATISTA;
	        $reqP12['usuario_id'] = $_id;
	        $reqP12['clave'] = md5($clv);
	        try {
	            self::firmaspro_Helper_MkCert_p12( $reqP12 );
	        } catch (Exception $e) {
	            $msjr = self::retorno([], $e->getCode(),'empleados_NuevaClaveAjax - firmaspro_Helper_MkCert_p12: ' . $e->getMessage() );
	            throw new Exception( json_encode( $msjr ), $e->getCode() );
	        }
	        
	        if( $_notificar == 1 ){
	            $tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "nuevaclave.html");
	            $_aed = array( 'CLAVE_TMP' => $clv,'USUARIO_TMP' => $ea );
	            $replacement_array = self::ObtenerEtiquetasEmail($_aed);
	            
	            $mensaje = preg_replace_callback(
	                '~\{\$(.*?)\}~si',
	                function($match) use ($replacement_array) {
	                    return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	                },
	                $tplCode);
	            
	            $emOpc = array(
	                "para" => $ea,
	                "titulo" => "Nuevapp - servicio #" . date('YmdHis'),
	                "mensaje" => $mensaje,
	                "desde" => "notificador@nuevapp.com",
	                "rotulo" => 'Clave temporal'
	            );
	            try {
	                $rsend = self::enviarCustomEmail( $emOpc );
	            } catch (Exception $e) {
	                http_response_code( IndexCtrl::ERR_COD_CORREO_FAIL );
	                throw new Exception("[" . IndexCtrl::ERR_COD_CORREO_FAIL . "] empleados_NuevaClaveAjax: " . $e->getMessage() . "");
	            }
	            
	            error_log( "mail activa: " . print_r( $rsend, true )  . " cl: " . $clv);
	        }
	        
	    }
	    else{
	        http_response_code( IndexCtrl::ERR_COD_SIN_PRIVILEGIOS );
	        throw new Exception("empleados_NuevaClaveAjax: No tiene suficientes permisos para esta operaci&oacute;n");
	    }
	    
	    return true;
	    
	}
	
	// HomeCtrl -- Cambio de clave
	public static function home_AlumnoPass_Add ( $d ){
	    $dtB64Dec = base64_decode( $d['params'] );
	    $dt = json_decode( $dtB64Dec , true );
	    
	    $opc = array( 
	        "idhash" => $dt['idhash'] ,
	        "clave" =>  $dt['text']
	    );
	    
	    $r = null;
	    try {
	        $r = self::empleados_ModificarClave( $opc );
	    } catch (Exception $e) {
	        throw new Exception( 'home_AlumnoPass_Add: ' . $e->getMessage() );
	    }
	    
	    return $r;
	}
	
	public static function empleados_Home_Helper_Obtener( $d ){
	    self::authRequOff();
	    
	    $r = array();
	    try {
	        $r = self::empleados_Obtener($d);
	    } catch (Exception $e) {
	        throw new Exception( 'empleados_Home_Helper_Obtener - empleados_Obtener: ' . $e->getMessage() );
	    }
	    
	    if ( !($r > 1) ) {
	        $d['conmatridata'] = false;
	        $r = array();
	        try {
	            $r = self::empleados_Obtener($d);
	        } catch (Exception $e) {
	            throw new Exception( 'empleados_Home_Helper_Obtener - empleados_Obtener: ' . $e->getMessage() );
	        }
	    }
	    return $r;
	}
	
	public static function empleados_Eliminar( $d ){	    
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}

		$tb = "empleados ";
		$st = ['estado_id' => 3 ];
		$xt = 'id = ?';
		$pr = [ $d['id'] ];
		try {
			Singleton::_safeUpdate(trim($tb),$st,$xt,$pr);
		} catch (\Throwable $th) {
			http_response_code( 500 );
			throw new \Exception( 'empleados_Eliminar_1: ' . $th->getMessage() );
		}
		
		return true;
	}
	
	public static function empleados_Activar( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    $tb = "empleados ";
	    $st = ['estado_id' => 1 ];
	    $xt = 'id = ?';
	    $pr = [ $d['id'] ];
	    try {
	        Singleton::_safeUpdate(trim($tb),$st,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( 500 );
	        throw new \Exception( 'empleados_Activar: ' . $th->getMessage() );
	    }
	    
	    return true;
	}
	public static function empleados_Helper_Obtener( $d ){
	    $est_tmp = self::empleados_Obtener( $d );
	    return $est_tmp;
	}
	public static function empleados_Helper_ObtenerTodo( $d ){
	    
	    $est_tmp = self::empleados_Obtener( $d );
	    $filtrarPor = array();
	    if (isset( $d['filtrar'] ) ) {
	        $filtrarPor = $d;
	        $filtrarPor['filtrar'] = $d['filtrar'];
	    }
	    $cur_tmp = self::matriculas_Obtener( $filtrarPor );
	    
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ];
	    
	    $contact_complemento = array();
	    
	    $def = array();
	    foreach ( $est_tmp as $kEst => $vEst ) {
	        foreach ($cur_tmp as $kCur ) {
	            if ( $vEst['id'] == $kCur['empleados_id'] ) {
	                $nwd = $kCur;
	                
	                $def[ $kEst ] = $vEst;
	                
	                $def[ $kEst ]['cursos_id'] = $nwd['cursos_id'];
	                $def[ $kEst ]['cursos'] = $nwd['cursos'];
	                
	                $def[ $kEst ]['niveleducativo_id'] = $nwd['niveleducativo_id'];
	                $def[ $kEst ]['niveleducativo'] = $nwd['niveleducativo'];
	                
	                $def[ $kEst ]['contjornada_id'] = $nwd['contjornada_id'];
	                $def[ $kEst ]['contjornada'] = $nwd['contjornada'];
	                
	                $nf = $vEst['contact_nombres'];
	                $af = $vEst['contact_apellidos'];
	                
	                $nPrt = explode(" ", $nf);
	                $aPrt = explode(" ", $af);
	                
	                $def[ $kEst ]['contact_nombres_first'] = $nPrt[0];
	                $def[ $kEst ]['contact_apellidos_first'] = $aPrt[0];
	                
	                $tmp_contact_full = trim( $nf . " " . $af );
	                $def[ $kEst ]['contact_full'] = $tmp_contact_full;
	                
	                $def[ $kEst ]['anyolectivo'] = $c_anyo['nombre'];
	                
	                // creacion campos mama y otros acudiente mas
	                if ( $vEst['contact_favorito'] == 1 ) {
	                    $contact_complemento[ $vEst['id'] ]['contact_favorito_tipoacudiente'] = $vEst['contact_tipoacudiente'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_favorito_full'] = $tmp_contact_full ;
	                    $contact_complemento[ $vEst['id'] ]['contact_favorito_documento'] = $vEst['contact_documento'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_favorito_direccion'] = $vEst['contact_direccion'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_favorito_mail'] = $vEst['contact_mail'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_favorito_tipodoc'] = $vEst['contact_tipodoc'] ;
	                }
	                else{
	                    $contact_complemento[ $vEst['id'] ]['contact_otro_tipoacudiente'] = $vEst['contact_tipoacudiente'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_otro_full'] = $tmp_contact_full ;
	                    $contact_complemento[ $vEst['id'] ]['contact_otro_documento'] = $vEst['contact_documento'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_otro_direccion'] = $vEst['contact_direccion'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_otro_mail'] = $vEst['contact_mail'] ;
	                    $contact_complemento[ $vEst['id'] ]['contact_otro_tipodoc'] = $vEst['contact_tipodoc'] ;
	                }
	                
	            }
	        }
	    }
	    
	    foreach ( $def as $kCCom => $vCCom ) {
	        if ( isset( $contact_complemento[ $vCCom['id'] ] ) ) {
	            $def[ $kCCom ] = array_merge( $def[ $kCCom ] , $contact_complemento[ $vCCom['id'] ] );
	        }
	    }
	    
	    // se valida la existencia del otro contacto
	    foreach ( $def as $kCCom => $vCCom ) {
	        if ( !isset( $vCCom[ 'contact_otro_tipoacudiente' ] ) ) {
	            $def[ $kCCom ]['contact_otro_tipoacudiente'] = '';
	            $def[ $kCCom ]['contact_otro_full'] = '';
	            $def[ $kCCom ]['contact_otro_documento'] = '';
	            $def[ $kCCom ]['contact_otro_direccion'] = '';
	            $def[ $kCCom ]['contact_otro_mail'] = '';
	            $def[ $kCCom ]['contact_otro_tipodoc'] = '';
	        }
	    }
	    
	    //die( 'def: ' . print_r( $def ) );
	    return $def;
	}
	public static function empleados_Obtener( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$r = new Singleton();
		$r::$lnk->query( self::SQL_BIG_SELECTS );
		
		/*
		 * @vnavarro 
		 * TODO: tarea 1 Listo
		 * 1. en los JOIN ($jn), agrega la tabla empleadosdetallescontrato
		 * 2. en los campos ($vr), agrega:
		 *        - empleadosdetallescontrato.meses como 'empleadosdetallescontrato_meses'
		 *        - empleadosdetallescontrato.dias como 'empleadosdetallescontrato_dias'
		 *        - empleadosdetallescontrato.fileactaini como 'empleadosdetallescontrato_fileactaini'
		 */
		
		$vr  = "empl.`id`, empl.`tipodoc_id`, tpdc.nombre as tipodoc, empl.`documento`, empl.`lugarescedula_id`, ";
		$vr .= "lugced.nombre as lugarescedula, empl.`nombres`, empl.`apellidos`, empl.`mail`, empl.`nacimiento`, ";
		$vr .= "empl.`generos_id`, empl.`lugares_id`, lug.nombre as lugares, empl.`gruposanguineo`, empl.`codigo`, ";
		$vr .= "empl.`usuario`, empl.`clave`, empl.`foto`, empl.`direccion`, empl.`barrio`, empl.`loc_lugares_id`, ";
		$vr .= "loclug.nombre as loc_lugares, empl.`cargos_id`, carg.nombre as cargos, empl.`titulos_id`, empl.`creado`, empl.`perfil_id`, ";
		$vr .= "prf.nombre as perfil, empl.`estado_id`, est.nombre as estado, empl.`eps`, empl.`ars`, empl.`oficio`, ";
		$vr .= "empl.`salariomes`, empl.`contratoini`, empl.`contratofin`, empl.dependencias_id, depe.nombre as dependencias, ";
		$vr .= "edc.meses as empleadosdetallescontrato_meses, ";
		$vr .= "edc.dias as empleadosdetallescontrato_dias, ";
		$vr .= "edc.fileactaini as fileactaini,";
		$vr .= "edc.fechainicio as fechainicio ";

		$tb  = '`empleados` as empl ';
		
		$jn  = 'LEFT JOIN tipodoc as tpdc on tpdc.id = empl.tipodoc_id ';
		$jn .= 'LEFT JOIN lugares as lugced on lugced.id = empl.lugarescedula_id ';
		$jn .= 'LEFT JOIN lugares as loclug on loclug.id = empl.`loc_lugares_id` ';
		$jn .= 'LEFT JOIN generos as gene on gene.id = empl.generos_id ';
		$jn .= 'LEFT JOIN lugares as lug on lug.id = empl.lugares_id ';
		$jn .= 'LEFT JOIN lugares as luglc on luglc.id = empl.loc_lugares_id ';
		$jn .= 'LEFT JOIN cargos as carg on carg.id = empl.cargos_id ';
		$jn .= 'LEFT JOIN titulos as tit on tit.id = empl.titulos_id ';
		$jn .= 'LEFT JOIN perfilusuarios as prf on prf.id = empl.perfil_id ';
		$jn .= 'LEFT JOIN estado as est on est.id = empl.estado_id ';
		$jn .= 'LEFT JOIN dependencias as depe on depe.id = empl.dependencias_id ';
		$jn .= 'LEFT JOIN empleadosdetallescontrato as edc on edc.empleados_id = empl.id ';

		$pr = [];
		$wh  = array();
		if( isset( $d['id'] ) ){
		    $wh[] = "empl.`id` = ?";
		    $pr[] = $d['id'] ;
		}
		
		if( isset( $d['w_id_md5'] ) ){
		    $wh[] = "md5(empl.`id`) = ?";
		    $pr[] = $d['w_id_md5'];
		}
		
		if( isset( $d['w_documento'] ) ){
		    $wh[] = "empl.`documento` = ?";
		    $pr[] = $d['w_documento'];
		}
		if( isset( $d['w_tipodoc_id'] ) ){
		    $wh[] = "empl.`tipodoc_id` = ?";
		    $pr[] = $d['w_tipodoc_id'];
		}
		if( isset( $d['w_clave'] ) ){
		    $wh[] = "empl.`clave` = ?";
		    $pr[] = md5( $d['w_clave'] );
		}
		
		$defWh = "";
		if ( count( $wh ) > 0 ) {
		    $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
		}
		
		$orden = 'ORDER BY 1 desc ';
		if (isset( $d['ordendesc'] ) ) {
		    $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
		}
		if (isset( $d['ordenasc'] ) ) {
		    $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
		}
		
		$limite = "";
		if ( isset( $d['limite'] ) ) {
		    $limite = "LIMIT " . intval( $d['limite'] ) . " ";
		}
		
		$xt  = $jn . $defWh . $orden . $limite;
		
		$sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
		//die( $sql . "\n" . print_r( $pr, true ));
		$r = array();
		try {
		    $r = Singleton::_safeRawQuery($sql, $pr);
		} catch (Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
		    throw new \Exception( 'empleados_Obtener: ' . $e->getMessage() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
		}
		
		return $r;
	}
	public static function empleados_Download_Obtener( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $cfg = array( 'API_LNK_DESCARGAR_ALUMNOS' => true );
	    if ( isset( $d['activos'] ) ) {
	        if( filter_var( $d['activos'] , FILTER_VALIDATE_BOOLEAN ) == true ){ 
	            $cfg['estado_id'] = "1";
	        }
	    }
	    if ( isset( $d['conid'] ) ) {
	        if( $d['conid'] ){
	            $cfg['conid'] = filter_var( $d['conid'] , FILTER_VALIDATE_BOOLEAN ) ;
	        }
	    }
	    $dtRaw = self::empleados_Obtener( $cfg );
	    
	    $dt = array();
	    foreach ( $dtRaw as $vDt ) {
	        $dt[ $vDt['documento'] ] = $vDt;
	    }
	    
	    $_charset = "iso-8859-1";
	    if( Utiles::obtenerSistemaOperativo() == "mac" ){
	        $_charset = "UTF-8";
	    }
	    
	    $_nlinea = "\n";
	    $_separador = ";";
	    $_comilla = '"';
	    
	    $enc = array();
	    $data = array();
	    
	    if ( count( $dt ) > 0 ) {
	        reset( $dt );
	        $fEl = current($dt);
	        $enc = array_keys( $fEl );
	        
	        foreach ( $dt as $vE ) {
	            $vals = array_values( $vE );
	            $txt = $_comilla . implode( $_comilla . "" . $_separador . "" . $_comilla , $vals ) . $_comilla;
	            $data[] = mb_convert_encoding($txt, $_charset ) ;
	        }
	    }
	    $def_enc = $_comilla . implode( $_comilla . "" . $_separador . "" . $_comilla , $enc) . $_comilla;
	    
	    $csv = array();
	    $csv [] = $def_enc;
	    $csv [] = implode( $_nlinea, $data );
	    
	    return implode( $_nlinea, $csv );
	}
	public static function empleados_ObtenerAjax(){
		date_default_timezone_set('America/Bogota');
		return Singleton::_dataTable( array( 'tb' => 'empleados', 'codifica_a' => IndexCtrl::CHARS_TO, 'codifica_desde' => IndexCtrl::CHARS_FR ) );
	}
	
	public static function empleados_ObtenerFilesAjax( $d ){
	    $cfg = self::LeerConfigCorp();
	    $_CFG_MATRICULA_ANEXLS = isset( $cfg[ self::CFG_MATRICULA_ANEXLS ]) ? $cfg[ self::CFG_MATRICULA_ANEXLS ]["val"] : "[]";
	    
	    $fld_base = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "anexos" . DIRECTORY_SEPARATOR;
	    $fld_alum = $fld_base . preg_replace('/\D/', '', $d['dc'] ) ;

	    $r = array();
	    
	    if ( file_exists( $fld_alum ) ) {
	        
	        $usrdt = array();
	        if ( isset( $d['empleados'] ) ) {
	            $usrdt = $d['empleados'];
	        }
	        else {
	            $usrdt = self::matriculas_Obtener( array('empleados_id' => $d['id'] ) );
	        }
	        
	        $infodata = array();
	        if ( count( $usrdt ) > 0 ) {
	            //$alumno_dt = $usrdt[0];
	            $js_dt = json_decode( $_CFG_MATRICULA_ANEXLS, true );
	            foreach ($js_dt as $base) {
	                //if ( $base[ 'id' ] == $alumno_dt['cursos_id'] ) {
	                    foreach ($base[ 'vl' ] as $regs) {
	                        $infodata[ 'a' . self::USUARIOS_FORM_ANEXO_ID . $regs['id'] ] = $regs['vl']['label'] ;
	                    }
	                //}
	            }
	        }
	        //die( 'id: ' . print_r( $infodata , true ) );
	        foreach(scandir( $fld_alum ) as $file ){
	            $fl_tmp = rtrim($fld_alum, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
	            
	            if( !is_dir( $fl_tmp ) ){
	                if( file_exists( $fl_tmp ) ){
	                    $flparts = pathinfo( $file );
	                    
	                    if ( !( $flparts['extension'] == 'crt' || $flparts['extension'] == 'key' ) ) {
	                        
	                        $verTodosPdf = true;
	                        if ( strtolower( $flparts['extension'] ) == "pdf") {
	                           if (isset( $d['vertodospdf'] )) {
	                                if ( !$d['vertodospdf'] ) {
	                                    
	                                    if ( Utiles::ComienzaEn( strtolower( $flparts['filename'] ), "sig_" ) ){
	                                        $verTodosPdf = false;
	                                        if ( Utiles::TerminaEn( strtolower( $flparts['filename'] ), "_fir" ) ){
	                                            $verTodosPdf = true;
	                                        }
	                                    }
	                                }
	                            }
	                        }
	                        if ( strtolower( $flparts['extension'] ) == "png") {
	                            if ( Utiles::ComienzaEn( strtolower( $flparts['filename'] ), "sig_" ) ){
	                                $verTodosPdf = false;
	                            }
	                        }
	                        
	                        if ( isset( $infodata [ $flparts['filename'] ] )) {
	                            
	                            if ($verTodosPdf) {
	                                $r[] = array(
	                                    "lbl" => mb_convert_case( $infodata [ $flparts['filename'] ] , MB_CASE_TITLE, "UTF-8") ,
	                                    "fl" => $file
	                                );
	                            }
	                        }
	                        else{
	                            if ($verTodosPdf) {
	                                $r[] = array(
	                                    "lbl" => $flparts['filename'],
	                                    "fl" => $file
	                                );
	                            }
	                            
	                        }
	                    }
	                    
	                }
	            }
	        }
	        
	    }
	    
	    return $r;
	}
	
	public static function empleados_Home_Helper_Add ( $d ){
	    set_time_limit(300); 
	    include_once ( dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'phpspreadsheet_1_23_0' . DIRECTORY_SEPARATOR . 'PhpSpreadSheet.php');
	    
	    $dt = base64_decode( $d['data'] );
	    $js = json_decode($dt, true) ;
	    
	    $anyo = self::anyolectivo_Listado_Obtener( array('limite' => 1 ) );
	    $anyocur = 0;
	    foreach ( $anyo as $kAnyo ) {
	        $anyocur = $kAnyo['id'];
	    }
	    
	    $flXls = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . 'recursos' . DIRECTORY_SEPARATOR . 'cargadatos' . DIRECTORY_SEPARATOR . $anyocur ;
	    if ( !file_exists( $flXls ) ) {
	        $msjr = self::retorno( [], IndexCtrl::ERR_COD_MSJ_ERR_COMUN, 'empleados_Home_Helper_Add: La carpeta ' . $flXls . ' no existe' );
	        throw new Exception( json_encode( $msjr ), IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    $bogdatafl = '';
	    foreach(scandir( $flXls ) as $file ){
	        $fl_tmp = rtrim($flXls, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
	        if( !is_dir( $fl_tmp ) ){
	            if ( Utiles::ComienzaEn($file, 'bogdata')) {
	                $bogdatafl = $fl_tmp;
	            }
	        }
	    }
	    
	    $tipodoc_id = $js['reg_tipodoc_id'];
	    $tipodoc = trim( self::TIPODOC_DOS_LETRAS[ $tipodoc_id ] );
	    $identif = trim( $js['reg_documento'] );
	    $correoe = trim( $js['reg_mail'] );
	    $clave = trim( Utiles::nuevoCl() );
	    
	    $usrArr = self::empleados_Procesar_Archivos(
	        array(
	            'w_nombre' => 'bogdata',
	            'buscarpor' => [
	                array( 'campo' => 'Tipo Doc. BP Beneficiario', 'valor'=> trim( $tipodoc ) ),
	                array( 'campo' => 'Número Doc. BP Beneficiario', 'valor'=> trim( $identif ) )
	            ]
	        )
        );
	    
	    if ( count( $usrArr ) > 0 ) {
	        $idMngUsr = 0;
	        foreach ( $usrArr as $usr ) {
	            self::authRequOff();
	            $usrExiste = self::empleados_Obtener(array('w_documento' => $identif ) );
	            
	            if ( count( $usrExiste ) > 0 ) {
	                http_response_code( IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	                $msjr = self::retorno([], IndexCtrl::ERR_COD_REGISTRO_EXISTENTE,'Usuario ya existe');
	                throw new Exception( json_encode( $msjr ), IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	            }
	            else {
	                $obligaciones = self::empleados_Procesar_Archivos(
	                    array(
	                        'w_nombre' => 'obligaciones',
	                        'buscarpor' => [
	                            array( 'campo' => 'NRO_IDENTIFICACION', 'valor' => $js['reg_documento'] )
	                        ]
	                    )
	                    );
	                
	                $nwU = array(
	                    "nombres" => $usr['nombre_bp_beneficiario'],
	                    'tipodoc_id' => $tipodoc_id,
	                    'documento' => $identif,
	                    'mail' => $correoe,
	                    'clave' => $clave,
	                    'obligaciones' => $obligaciones
	                );
	                try {
	                    $idMngUsr = self::mnguserAdd_Helper( $nwU , self::USUARIOS_PERFIL_EMPLEADOS );
	                } catch (Exception $e) {
	                    $msjr = self::retorno([], $e->getCode(),'empleados_Home_Helper_Add - mnguserAdd_Helper: ' . $e->getMessage() );
	                    throw new Exception( json_encode( $msjr ), $e->getCode() );
	                }
	                
	                // mk p12
	                $reqP12 = $nwU;
	                $reqP12['tipousuario'] = self::FIRMASPRO_TIPOUSUARIO_CONTRATISTA;
	                $reqP12['usuario_id'] = $idMngUsr['id'];
	                $reqP12['clave'] = md5( $clave );
	                try {
	                    self::firmaspro_Helper_MkCert_p12( $reqP12 );
	                } catch (Exception $e) {
	                    $msjr = self::retorno([], $e->getCode(),'empleados_Home_Helper_Add - firmaspro_Helper_MkCert_p12: ' . $e->getMessage() );
	                    throw new Exception( json_encode( $msjr ), $e->getCode() );
	                }
	                
	            }
	        }
	        
	        if ($idMngUsr > 0 ) {
	            $d_notify = array(
	                'tpl' => 'nuevaclave.html',
	                'campos' => array( 'USUARIO_TMP' => $tipodoc_id . $identif, 'CLAVE_TMP' => $clave ),
	                'para' => $correoe
	            );
	            
	            self::enviar_Notificacion( $d_notify );
	        }
	        
	        return self::retorno( true, 0, 'El usuario se ha registrado exitosamente<br>Su usuario y contrase&ntilde;a se envi&oacute; a <strong>' . $correoe . '</strong>' );
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	        $msjr = self::retorno([], IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA,'Usuario no existe');
	        throw new Exception( json_encode( $msjr ), IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	    }
	}
	
	
	public static function empleados_Procesar_Archivos( $d ){
	    ini_set('memory_limit', '-1'); 
	    self::authRequOff();
	    include_once ( dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'phpspreadsheet_1_23_0' . DIRECTORY_SEPARATOR . 'PhpSpreadSheet.php');
	    $codfile = self::cargadatos_Obtener( array( 'w_nombre' => $d['w_nombre'] ) );
	    
	    $regfl = "";
	    if ( count( $codfile ) > 0 ) {
	        foreach ($codfile as $kCodFile ) {
	            $regfl = $kCodFile['nombre'];
	        }
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	        throw new Exception('empleados_Procesar_Archivos: Nombre de carga (' . $d['w_nombre'] .') no existe', IndexCtrl::ERR_COD_REGISTRO_EXISTENTE);
	    }
	    
	    $anyo = self::anyolectivo_Listado_Obtener( array('limite' => 1 ) );
	    $anyocur = 0;
	    foreach ( $anyo as $kAnyo ) {
	        $anyocur = $kAnyo['id'];
	    }
	    
	    $flXls = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . 'recursos' . DIRECTORY_SEPARATOR . 'cargadatos' . DIRECTORY_SEPARATOR . $anyocur ;
	    if ( !file_exists( $flXls ) ) {
	        $msjr = self::retorno( [], IndexCtrl::ERR_COD_MSJ_ERR_COMUN, 'empleados_Procesar_Archivos: La carpeta ' . $flXls . ' no existe' );
	        throw new Exception( json_encode( $msjr ), IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    $obligaciones = '';
	    foreach(scandir( $flXls ) as $file ){
	        $fl_tmp = rtrim($flXls, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
	        if( !is_dir( $fl_tmp ) ){
	            if ( Utiles::ComienzaEn( $file, $regfl ) ) {
	                $obligaciones = $fl_tmp;
	            }
	        }
	    }
	    
	    if ( isset ( $d['soloencabezados'] ) ) {
	        if ( $d['soloencabezados'] ) {
	            $resultados = PhpSpreadSheet::obtenerEncabezados( $obligaciones );
	            return $resultados;
	        }
	    }
	    
	    $resultados = PhpSpreadSheet::buscarPorCondiciones( $obligaciones, $d['buscarpor'] );
	    
	    return $resultados;
	}
	// Empleados FIN
	
	// empleadosobjetivos INI
	public static function empleadosobjetivos_Obtener( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "eobj.`id`, eobj.`descripcion`, eobj.`empleados_id`, concat( empl.nombres , ' ', empl.apellidos) as empleados_nombre, ";
	    $vr .= "eobj.`empleadosobjetivosestados_id`, eobjest.nombre as empleadosobjetivosestados_nombre, eobj.`vigencia`, eobj.`orden` ";
	    
	    $tb  = '`empleadosobjetivos` as eobj ';
	    
	    $jn  = 'LEFT JOIN empleados as empl on empl.id = eobj.empleados_id ';
	    $jn .= 'LEFT JOIN empleadosobjetivosestados as eobjest on eobjest.id = eobj.empleadosobjetivosestados_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "eobj.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_empleados_id_md5'] ) ){
	        $wh[] = "md5( eobj.`empleados_id` ) = ?";
	        $pr[] = $d['w_empleados_id_md5'];
	    }
	    if( isset( $d['w_empleados_id'] ) ){
	        $wh[] = "eobj.empleados_id = ?";
	        $pr[] = $d['w_empleados_id'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr); //Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'firmaslog_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	public static function empleadosobjetivos_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Empleadosobjetivos();
	    if (isset( $d['descripcion'] ) ) {
	        $o->setDescripcion( $d['descripcion'] );
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $o->setEmpleados_id( $d['empleados_id'] );
	    }
	    if (isset( $d['empleadosobjetivosestados_id'] ) ) {
	        $o->setEmpleadosobjetivosestados_id( $d['empleadosobjetivosestados_id'] );
	    }
	    if (isset( $d['vigencia'] ) ) {
	        $o->setVigencia( $d['vigencia'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'empleadosobjetivos_Agregar: ' . $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'empleadosobjetivos_Agregar: Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	}
	// empleadosobjetivos FIN
	
	// empleadosobjetivoslog INI
	public static function empleadosobjetivoslog_Obtener( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "eolog.`id`, eolog.`descripcion`, eolog.`archivos`, eolog.`archivosges`, eolog.paquetesrequ_id, ";
	    $vr .= "preq.ref as paquetesrequ_ref,  eolog.`fecha`, eolog.`empleados`, eolog.`empleadosobjetivos_id`, ";
	    $vr .= "empobj.descripcion as  empleadosobjetivos_descripcion, empobj.empleados_id,  eolog.`feedback`, ";
	    $vr .= "eolog.`usuariofeedback`, eolog.`fechafeedback`, eolog.`requerimientostplsitems_id`, ";
	    $vr .= "reqtplsitem.ref as requerimientostplsitems_ref ";
	    
	    $tb  = '`empleadosobjetivoslog` as eolog ';
	    
	    $jn  = 'LEFT JOIN empleadosobjetivos as empobj on empobj.id = eolog.empleadosobjetivos_id ';
	    $jn .= 'LEFT JOIN requerimientostplsitems as reqtplsitem on reqtplsitem.id = eolog.requerimientostplsitems_id ';
	    $jn .= 'LEFT JOIN paquetesrequ as preq on preq.id = eolog.paquetesrequ_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "eobj.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    
	    if( isset( $d['w_empleados_id'] ) ){
	        $wh[] = "empobj.empleados_id = ?";
	        $pr[] = $d['w_empleados_id'];
	    }
	    if( isset( $d['w_empleados_id_md5'] ) ){
	        $wh[] = "md5( empobj.empleados_id ) = ?";
	        $pr[] = $d['w_empleados_id_md5'];
	    }
	    if( isset( $d['w_empleadosobjetivos_id'] ) ){
	        $wh[] = "eolog.empleadosobjetivos_id = ?";
	        $pr[] = $d['w_empleadosobjetivos_id'];
	    }
	    if( isset( $d['w_requerimientostplsitems_id'] ) ){
	        $wh[] = "eolog.requerimientostplsitems_id = ?";
	        $pr[] = $d['w_requerimientostplsitems_id'];
	    }
	    if( isset( $d['w_paquetesrequ_id'] ) ){
	        $wh[] = "eolog.paquetesrequ_id = ?";
	        $pr[] = $d['w_paquetesrequ_id'];
	    }
	    if( isset( $d['w_paquetes_id'] ) ){
	        $wh[] = "preq.paquetes_id = ?";
	        $pr[] = $d['w_paquetes_id'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( print_r($pr,true) . "\n" . $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr); //Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'firmaslog_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	public static function empleadosobjetivoslog_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Empleadosobjetivoslog();
	    if (isset( $d['descripcion'] ) ) {
	        $o->setDescripcion( $d['descripcion'] );
	    }
	    if (isset( $d['archivos'] ) ) {
	        $o->setArchivos( $d['archivos'] );
	    }
	    if (isset( $d['archivosges'] ) ) {
	        $o->setArchivosges( $d['archivosges'] );
	    }
	    $o->setFecha( date("Y-m-d H:i:s") );
	    if (isset( $d['empleados'] ) ) {
	        $o->setEmpleados( $d['empleados'] );
	    }
	    if (isset( $d['empleadosobjetivos_id'] ) ) {
	        $o->setEmpleadosobjetivos_id( $d['empleadosobjetivos_id'] );
	    }
	    if (isset( $d['feedback'] ) ) {
	        $o->setFeedback( $d['feedback'] );
	    }
	    if (isset( $d['usuariofeedback'] ) ) {
	        $o->setUsuariofeedback( $d['usuariofeedback'] );
	    }
	    if (isset( $d['fechafeedback'] ) ) {
	        $o->setFechafeedback( $d['fechafeedback'] );
	    }
	    if (isset( $d['requerimientostplsitems_id'] ) ) {
	        $o->setRequerimientostplsitems_id( $d['requerimientostplsitems_id'] );
	    }
	    if (isset( $d['paquetesrequ_id'] ) ) {
	        $o->setPaquetesrequ_id( $d['paquetesrequ_id'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'empleadosobjetivos_Agregar: ' . $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'empleadosobjetivos_Agregar: Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	}
	public static function empleadosobjetivoslog_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $tb  = "empleadosobjetivoslog ";
	    
	    $aSt = array();
	    if ( isset( $d['descripcion'] ) ) {
	        $aSt['descripcion'] = $d['descripcion'] ;
	    }
	    if ( isset( $d['archivos'] ) ) {
	        $aSt['archivos'] = $d['archivos'] ;
	    }
	    if ( isset( $d['archivosges'] ) ) {
	        $aSt['archivosges'] = $d['archivosges'] ;
	    }
	    if ( isset( $d['feedback'] ) ) {
	        $aSt['requerido'] = $d['feedback'] ;
	    }
	    if ( isset( $d['usuariofeedback'] ) ) {
	        $aSt['usuariofeedback'] = $d['usuariofeedback'] ;
	        $aSt['fechafeedback'] = date( "Y-m-d H:i:s" );
	    }
	    
	    $pr = [];
	    $wh  = [];
	    if ( isset( $d['id'] ) ) {
	        $wh[]  = 'id = ?';
	        $pr[] = $d['id'];
	    }
	    if ( isset( $d['w_empleadosobjetivos_id'] ) ) {
	        $wh[] = 'empleadosobjetivos_id = ?';
	        $pr[] = $d['w_empleadosobjetivos_id'];
	    }
	    
	    if ( isset( $d['w_paquetesrequ_id'] ) ) {
	        $wh[] = 'paquetesrequ_id = ?';
	        $pr[] = $d['w_paquetesrequ_id'];
	    }
	    
	    if ( count( $wh ) == 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'empleadosobjetivoslog_Modificar: Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = implode(" AND ", $wh);
	    
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'empleadosobjetivoslog_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function empleadosobjetivoslog_Helper_Agregar( $d ){
	    $regQry = [
	        'w_empleadosobjetivos_id' => $d['empleadosobjetivos_id'],
	        //'w_requerimientostplsitems_id' => $d['requerimientostplsitems_id']
	        'w_paquetesrequ_id' => $d['paquetesrequ_id']
	    ];
	    $qryReg = self::empleadosobjetivoslog_Obtener( $regQry );
	    
	    $r = 0;
	    if ( count( $qryReg ) > 0 ){
	        $regUpd = [
	            'descripcion' => $d['descripcion'],
	            'w_empleadosobjetivos_id' => $d['empleadosobjetivos_id'],
	            //'w_requerimientostplsitems_id' => $d['requerimientostplsitems_id']
	            'w_paquetesrequ_id' => $d['paquetesrequ_id']
	        ];
	        
	        if ( !empty( $d['archivos'] ) ) {
	            $regUpd['archivos'] = $d['archivos'];
	        }
	        
	        $r = self::empleadosobjetivoslog_Modificar( $regUpd );
	    }
	    else {
	        $r = self::empleadosobjetivoslog_Agregar( $d );
	    }
	    
	    return self::retorno(['result' => $r], 0, "");
	}
	public static function empleadosobjetivoslog_Helper_Archivos( $d ){
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ]['id'];
	    
	    $idfileadjunto = $d['id'];
	    $documento = $d['documento'];
	    $archivos = "";
	    
	    $upfl = [
	        'usr' => $documento,
	        'carpeta' => 0,
	        'campo' => $idfileadjunto
	    ];
	    $bs = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR  . 'repo/anexos/' . $c_anyo . '/'  . $upfl['usr'] . '/' . self::PAQUETES_FLDS_NAME[ $upfl['carpeta'] ];
	    
	    if ( isset( $_FILES [$idfileadjunto]) && is_array( $_FILES [$idfileadjunto] ) && $_FILES [$idfileadjunto]['size'] > 0 ) {
	        foreach(scandir( $bs ) as $file ){
	            $pifl = pathinfo( $file );
	            if ( $pifl['filename'] == $idfileadjunto ) {
	                $oblifiledel = $bs . '/' . $pifl['basename'];
	                if ( file_exists( $oblifiledel ) ) {
	                    unlink( $oblifiledel );
	                }
	            }
	        }
	        
	        $flsRes = self::paquetesrequ_Helper_Files( $upfl );
	        $archivos = $flsRes['path'];
	    }
	    
	    return $archivos;
	}
	// empleadosobjetivoslog FIN
	
	// Tipodoc INI
	const TIPODOC_DOS_LETRAS = [
	    "1"  => "CC",
	    "2"  => "CE",
	    "3"  => "NIT",
	    "4"  => "TI",
	    "5"  => "PA",
	    "6"  => "TSE",
	    "7"  => "SE",
	    "8"  => "FID",
	    "9"  => "NITM",
	    "10" => "RIF",
	    "11" => "NITE",
	    "12" => "NITPN",
	    "13" => "RC",
	    "14" => "NUIP",
	    "15" => "PTP"
	];
	public static function tipodoc_Obtener( $d ){
		$vr  = "id, nombre ";
		$tb  = "tipodoc ";
		$xt  = "";

		if( isset( $d['id'] ) ){
			$xt .= 'where id = ' . $d['id'] . ' ';
		}
		$xt .= 'order by 1 ';

		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Tipodoc FIN
	// Generos INI
	public static function generos_Obtener( $d ){
		$vr  = "id, nombre ";
		$tb  = "generos ";
		$xt  = "";

		if( isset( $d['id'] ) ){
			$xt .= 'where id = ' . $d['id'] . ' ';
		}
		$xt .= 'order by 1 ';

		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Generos FIN
	// Cargos INI
	public static function cargos_Obtener( $d ){

		$vr  = "id, nombre ";
		$tb  = "cargos ";
		$xt  = "";

		if( isset( $d['id'] ) ){
			$xt .= 'where id = ' . $d['id'] . ' ';
		}
		$xt .= 'order by 2 ';

		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Cargos FIN
	// Titulos INI
	public static function titulos_Obtener( $d ){
		$vr  = "id, nombre ";
		$tb  = "titulos ";
		$xt  = "";

		if( isset( $d['id'] ) ){
			$xt .= 'where id = ' . $d['id'] . ' ';
		}
		$xt .= 'order by 2 ';

		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Titulos FIN
	// Estados INI
	public static function estado_Obtener( $d ){
		$vr  = "id, nombre ";
		$tb  = "estado ";
		$xt  = "";

		if( isset( $d['id'] ) ){
			$xt .= 'where id = ' . $d['id'] . ' ';
		}
		$xt .= 'order by 2 ';

		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Estados FIN
	// Perfil INI
	public static function perfil_Obtener( $d ){
	    $vr  = "id, nombre ";
	    $tb  = "perfilusuarios ";
	    $xt  = "";
	    
	    if( isset( $d['id'] ) ){
	        $xt .= 'where id = ' . $d['id'] . ' ';
	    }
	    if ( isset( $d['desdeadmin'] ) ) {
	        if ( $d['desdeadmin'] ) {
	            $xt .= 'where id = ' . self::USUARIOS_PERFIL_ADMINISTRADOR;
	            $xt .= ' OR id = ' . self::USUARIOS_PERFIL_SUPERVISOR;
	            $xt .= ' OR id = ' . self::USUARIOS_PERFIL_FINANCIERO;
	            $xt .= ' OR id = ' . self::USUARIOS_PERFIL_SUPERVISORADM;
	            $xt .= ' OR id = ' . self::USUARIOS_PERFIL_PROVEEDOR;
	            $xt .= ' OR id = ' . self::USUARIOS_PERFIL_RUTA . ' ';
	        } 
	        
	        if ( isset( $d['perfil_id'] ) ) {
	            if ( $d['perfil_id'] == self::USUARIOS_PERFIL_SUPER_USUARIO ) {
	                $xt .= 'OR id = 1 ';
	            }
	        }
	    }
	    $xt .= 'order by 1 ';
	    
	    //die( "SELECT " . $vr . " FROM " . $tb . " " . $xt );
	    $r = Singleton::_readInfo($tb,$vr,$xt);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( 500 );
	        throw new \Exception( $r['err_info'] );
	    }
	    return $r;
	}
	// Perfil FIN
	// Telefonos Empleado INI 
	public static function telefonosempleado_Agregar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$tipotele_id = $d['tipotele_id'];
		$valor = $d['valor'];
		$Empleado_id = $d['empleado_id'];

		$o = new Telefonosempleado();
		$o->setTipotele_id( $tipotele_id );
		$o->setValor( $valor );
		$o->setEmpleado_id( $Empleado_id );

		$id = $o->saveData();
		if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
			http_response_code( 500 );
			throw new \Exception( $o->obtenerError() );
		}

		if( $id > 0){
			return array( 'id' => $id );
		}
		else {
			http_response_code( 503 );
			throw new \Exception( 'Respuesta no implementada' );
		}
	}
	public static function telefonosempleado_Modificar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$pr = [];
		if ( !isset( $d['by_tipotele_id'] ) ) {
			$id = $d['id'];
			$tipotele_id = $d['tipotele_id'];
			$valor = $d['valor'];

			$tb = "telefonosempleado ";
			$st = [ "tipotele_id" => $tipotele_id , "valor" => $valor ];
			$xt = 'id = ?';
			$pr = [ $id ];
		}
		elseif ( isset( $d['by_tipotele_id'] ) ) {
			$id = $d['id'];
			$valor = $d['valor'];

			$_dbyTipo = array(
				'id' => $id,
				'by_tipotele_id' => $d['by_tipotele_id']
			);
			$_delOk = null;
			try {
				$_delOk = self::telefonosempleado_Eliminar( $_dbyTipo );
			} catch (\Throwable $th) {
				http_response_code( 500 );
				throw new \Exception( 'telefonosempleado_Modificar - telefonosempleado_Eliminar: ' . $th->getMessage() );
			}

			if ( $_delOk ) {
				try {
					$_dAdd = array(
						'tipotele_id' => $d['by_tipotele_id'],
						'valor' => $valor,
						'Empleado_id' => $id
					);
					self::telefonosempleado_Agregar( $_dAdd );
				} catch (\Throwable $th) {
					http_response_code( 500 );
					throw new \Exception( 'telefonosempleado_Modificar - telefonosempleado_Agregar: ' . $th->getMessage() );
				}
			}

			return true;
		}

		try {
		    return Singleton::_safeUpdate(trim($tb),$st,$xt,$pr);
		} catch (\Throwable $th) {
			http_response_code( 500 );
			throw new \Exception( 'telefonosempleado_Agregar: ' . $th->getMessage() );
		}
	}
	public static function telefonosempleado_Eliminar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}

		$tb = "telefonosempleado ";
		$wh = '';

		if ( isset( $d['by_tipotele_id'] )) {
		    $wh = 'where Empleado_id = ' . $d['by_tipotele_id'] . ' AND tipotele_id = ' . $d['by_tipotele_id'];
		}
		if ( isset( $d[ 'by_empleado_id' ] ) ) {
		    $wh = 'where Empleado_id = ' . $d[ 'by_empleado_id' ];
		}
		if ( isset( $d[ 'id' ] ) ) {
		    $wh = 'where id = ' . $d[ 'id' ];
		}
		
		if ( $wh == '' ) {
		    http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
		    throw new Exception( '[' . IndexCtrl::ERR_COD_ELIMINACION_SQL . '] telefonosempleado_Eliminar: Debe indicar un filtro' );
		}
		
		$xt = $wh;

		try {
			return Singleton::_classicDelete( $tb, $xt );
		} catch (\Throwable $th) {
			http_response_code( 500 );
			throw new \Exception( 'telefonosempleado_Eliminar: ' . $th->getMessage() );
		}
	}
	public static function telefonosempleado_Obtener( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );

		$vr  = "telest.id, telest.tipotele_id, ttele.nombre as tipotele, telest.valor, telest.empleado_id, concat( est.nombres ) as empleado ";
		$tb  = "telefonosempleado as telest ";
		$xt  = "LEFT JOIN tipotele as ttele on ttele.id = telest.tipotele_id ";
		$xt .= "LEFT JOIN empleados as est on est.id = telest.empleado_id ";

		if ( !isset( $d['by_empleado_id'] ) ) {
			if( isset( $d['id'] ) ){
				$xt .= 'where telest.id = ' . $d['id'] . ' ';
			}
		}else {
		    if( isset( $d['id'] ) ){
                $xt .= 'where telest.empleado_id = ' . $d['id'] . ' AND telest.tipotele_id = ' . $d['by_empleado_id'] . ' ' ;
		    }
		}

		$xt .= 'order by 1 ';

		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Telefonos Empleado FIN

	// Telefonos usuarios INI 
	public static function telefonosusuarios_Agregar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$tipotele_id = $d['tipotele_id'];
		$valor = $d['valor'];
		$usuarios_id = $d['usuarios_id'];

		$o = new Telefonosusuarios();
		$o->setTipotele_id( $tipotele_id );
		$o->setValor( $valor );
		$o->setUsuarios_id( $usuarios_id );

		$id = $o->saveData();
		if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
			http_response_code( 500 );
			throw new \Exception( $o->obtenerError() );
		}

		if( $id > 0){
			return array( 'id' => $id );
		}
		else {
			http_response_code( 503 );
			throw new \Exception( 'Respuesta no implementada' );
		}
	}
	public static function telefonosusuarios_Modificar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$pr = [];
		if ( !isset( $d['by_tipotele_id'] ) ) {
			$id = $d['id'];
			$tipotele_id = $d['tipotele_id'];
			$valor = $d['valor'];

			$tb = "telefonosusuarios ";
			$st = [ "tipotele_id" => $tipotele_id, "valor" => $valor ];
			$xt = 'id = ?';
			$pr = [ $id ];
		}
		elseif ( isset( $d['by_tipotele_id'] ) ) {
			$id = $d['id'];
			$valor = $d['valor'];

			$_dbyTipo = array(
				'id' => $id,
				'by_tipotele_id' => $d['by_tipotele_id']
			);
			$_delOk = null;
			try {
				$_delOk = self::telefonosusuarios_Eliminar( $_dbyTipo );
			} catch (\Throwable $th) {
				http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
				throw new \Exception( '[' . IndexCtrl::ERR_COD_ELIMINACION_SQL . '] telefonosusuarios_Modificar: ' . $th->getMessage() );
			}

			if ( $_delOk ) {
				try {
					$_dAdd = array(
						'tipotele_id' => $d['by_tipotele_id'],
						'valor' => $valor,
						'usuarios_id' => $id
					);
					self::telefonosusuarios_Agregar( $_dAdd );
				} catch (\Throwable $th) {
					http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
					throw new \Exception( '[' . IndexCtrl::ERR_COD_ACTUALIZACION_SQL . '] telefonosusuarios_Modificar: ' . $th->getMessage() );
				}
			}

			return true;
		}

		try {
			return Singleton::_safeUpdate(trim($tb),$st,$xt,$pr);
		} catch (\Throwable $th) {
			http_response_code( 500 );
			throw new \Exception( 'telefonosusuarios_Modificar - _safeUpdate: ' . $th->getMessage() );
		}
	}
	public static function telefonosusuarios_Eliminar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		$id = $d['id'];

		$tb = "telefonosusuarios ";
		$xt = 'where id = ' . $id;

		if ( isset( $d['by_tipotele_id'] )) {
			$xt = 'where usuarios_id = ' . $id . ' AND tipotele_id = ' . $d['by_tipotele_id'];
		}

		try {
			return Singleton::_classicDelete( $tb, $xt );
		} catch (\Throwable $th) {
			http_response_code( 500 );
			throw new \Exception( 'telefonosusuarios_Eliminar: ' . $th->getMessage() );
		}
	}
	public static function telefonosusuarios_Obtener( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$r = new Singleton();
		$r::$lnk->query( self::SQL_BIG_SELECTS );

		$vr  = "telest.id, telest.tipotele_id, ttele.nombre as tipotele, telest.valor, telest.usuarios_id, concat( est.nombres ) as usuarios ";
		$tb  = "telefonosusuarios as telest ";
		$xt  = "LEFT JOIN tipotele as ttele on ttele.id = telest.tipotele_id ";
		$xt .= "LEFT JOIN usuarios as est on est.id = telest.usuarios_id ";

		if ( !isset( $d['by_usuarios_id'] ) ) {
			if( isset( $d['id'] ) ){
				$xt .= 'where telest.id = ' . $d['id'] . ' ';
			}
		}else {
			$xt .= 'where telest.usuarios_id = ' . $d['id'] . ' AND telest.tipotele_id = ' . $d['by_usuarios_id'] . ' ' ;
		}

		$xt .= 'order by 1 ';
		$r = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r['err_info'] )) {
			http_response_code( 500 );
			throw new \Exception( $r['err_info'] );
		}

		return $r;
	}
	// Telefonos usuarios FIN

	// Usuarios INI 
	
	// Cargadatos.phtml INI
	public static function usuarios_CargaDatos_Upload ( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = NULL;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $dt = base64_decode( $d['data'] );
	    $js = json_decode($dt, true) ;
	    
	    
	    $flNames = self::cargadatos_Obtener( array( 'ordenasc' => 1, 'id' => $js['cargadatos_src_0'] ) );
	    foreach ( $flNames as $kCargaDt) {
	        $flnm = $kCargaDt['nombre'];
	        
	        $pth = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . 'recursos' . DIRECTORY_SEPARATOR;
	        $base = 'cargadatos';
	        $pth_cargadatos = $pth . $base;
	        
	        if ( !file_exists( $pth_cargadatos ) ) {
	            mkdir( $pth_cargadatos );
	        }
	        
	        $usadt = array();
	        if ( file_exists( $pth_cargadatos ) ) {
	            $anyoid = $js['cargadatos_anyo_0'];
	            $pth_con_anyo = $pth_cargadatos . DIRECTORY_SEPARATOR . $anyoid;
	            if ( !file_exists( $pth_con_anyo ) ) {
	                mkdir( $pth_con_anyo );
	            }
	            
	            if ( file_exists( $pth_con_anyo ) ) {
	                
	                foreach ( $_FILES as $kFls => $vFl ) {
	                    try {
	                        $usadt[] = self::SubirArchivo( $flnm, $pth_con_anyo, $kFls );
	                    } catch (\Throwable $th) {
	                        throw new \Exception( $th->getMessage() );
	                    }
	                }
	            }
	            else {
	                $msjr = self::retorno( [], IndexCtrl::ERR_COD_MSJ_ERR_COMUN, 'usuarios_CargaDatos_Upload: La carpeta ' . $pth_con_anyo . ' no existe' );
	                throw new Exception( json_encode( $msjr ), IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	            }
	            
	        }
	        else {
	            $msjr = self::retorno( [], IndexCtrl::ERR_COD_MSJ_ERR_COMUN, 'usuarios_CargaDatos_Upload: La carpeta ' . $pth_cargadatos . ' no existe' );
	            throw new Exception( json_encode( $msjr ), IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        }
	        
	        try { self::Usabilidad_agregar( array('refid' => IndexCtrl::WEB_USR_CARGA_ARCHIVOS, 'vl' => json_encode($usadt),  'usr' => $usu->getUsuario() ) ); } catch (Exception $e) { /*no*/ }
	        
	    }
	    
	    return self::retorno( true, 0, '' );
	}
	public static function cargadatos_Obtener( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] cargadatos_Obtener: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "cdatos.`id`, cdatos.`nombre`, cdatos.`label`, cdatos.`usuarios`, ";
	    $vr .= "cdatos.`fecha`, cdatos.`multiple`, cdatos.`tiposaceptados`, cdatos.llaveindice  ";
	    
	    $tb  = '`cargadatos` as cdatos ';
	    
	    $jn  = '';
	    
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "cdatos.`id` = " . $d['id'] . " ";
	    }
	    if( isset( $d['w_nombre'] ) ){
	        $wh[] = "cdatos.`nombre` = '" . $d['w_nombre'] . "' ";
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    //die( "SELECT " . $vr . "\nFROM " . $tb . "\n" . $xt );
	    $r = Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] cargadatos_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// Cargadatos.phtml FIN
	
	public static function usuarios_Agregar( $d ){
		date_default_timezone_set('America/Bogota');
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$tipodoc_id = $d['tipodoc_id'];
		$documento = $d['documento'];
		$lugarescedula_id = $d['lugarescedula_id'];
		$nombres = $d['nombres'];
		$apellidos = $d['apellidos'];
		$mail = $d['mail'];
		$nacimiento = $d['nacimiento'];
		$generos_id = $d['generos_id'];
		$lugares_id = $d['lugares_id'];
		$gruposanguineo = $d['gruposanguineo'];
		$codigo = $d['codigo'];
		$usuario = $d['usuario'];
		$direccion = $d['direccion'];
		$barrio = $d['barrio'];
		$loc_lugares_id = $d['loc_lugares_id'];
		$cargos_id = $d['cargos_id'];
		$titulos_id = $d['titulos_id'];

		$perfil_id = $d['perfil_id'];
		
		$oficio = $d['oficio'];
		$salariomes = $d['salariomes'];
		$contratoini = $d['contratoini'];
		$contratofin = $d['contratofin'];

		$tmpPass = Utiles::nuevoCl();
		
		$o = new Usuarios();
		$o->setTipodoc_id( $tipodoc_id );
		$o->setDocumento( $documento );
		$o->setLugarescedula_id( $lugarescedula_id );
		$o->setNombres( $nombres );
		$o->setApellidos( $apellidos );
		$o->setMail( $mail );
		$o->setNacimiento( $nacimiento );
		$o->setGeneros_id( $generos_id );
		$o->setLugares_id( $lugares_id );
		$o->setGruposanguineo( $gruposanguineo );
		$o->setCodigo( $codigo );
		$o->setUsuario( $usuario );
		$o->setClave( md5( $tmpPass ) );
		$o->setFoto( '' );
		$o->setDireccion( $direccion );
		$o->setBarrio( $barrio );
		$o->setLoc_lugares_id( $loc_lugares_id );
		$o->setCargos_id( $cargos_id );
		$o->setTitulos_id( $titulos_id );
		$o->setCreado( date('Y-m-d H:i:s') );
		$o->setPerfil_id( $perfil_id );
		$o->setEstado_id( 1 );
		
		$o->setOficio($oficio);
		$o->setSalariomes($salariomes);
		$o->setContratoini($contratoini);
		$o->setContratofin($contratofin);
		

		$id = $o->saveData();
		if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
			http_response_code( 500 );
			throw new \Exception( $o->obtenerError() );
		}

		if( $id > 0){
		    return array( 'id' => $id, 'tmppws' => $tmpPass );
		}
		else {
			http_response_code( 503 );
			throw new \Exception( 'Respuesta no implementada' );
		}
	}
	
	public static function usuarios_Helper_Modificar( $d, $tipom ){
	    $r = null;
	    
	    if ( $tipom == self::USUARIOS_HELPER_MODIFICAR ) {
	        try {
	            $r = self::usuarios_Modificar($d);
	        } catch (Exception $e) {
	            throw new Exception('usuarios_Helper_Modificar - usuarios_Modificar: ' . $e->getMessage());
	        }
	    }
	    elseif ( $tipom == self::USUARIOS_HELPER_AGREGAR ) {
	        try {
	            $r = OperacionesCtrl::mnguserAdd_Helper( $d, self::USUARIOS_PERFIL_SUPERVISOR );
	        } catch (Exception $e) {
	            throw new Exception('usuarios_Helper_Modificar - mnguserAdd_Helper: ' . $e->getMessage());
	        }
	        
	    }
	    
	    $idDef = 0;
	    if ( isset( $d[ "id" ] )) {
	        $idDef = $d[ "id" ];
	    }else {
	        if ( isset( $r['id'] )) { 
	            $idDef = $r[ "id" ];
	        }
	    }
	    
	    $precurs = "cursmats_cursos_id_tmp_";
        $premats = "cursmats_materias_id_tmp_";
	    
	    $materiascursos = array();
	    foreach ( $d as $kCm => $vCm ) {
	        if ( Utiles::ComienzaEn( $kCm , "cursmats" ) ) {
	            $id = intval( str_replace( $precurs, "", $kCm) );
	            
	            $regMatId = $premats . $id;
	            $regCurId = $precurs . $id;
	            
	            if ( isset( $d[ $regMatId ] ) && isset( $d[ $regCurId ] ) ) {
	                $materiascursos[ $id ] = array(
	                    "id" => $idDef,
	                    "materias_id" => $d[ $regMatId ],
	                    "cursos_id" => $d[ $regCurId ]
	                );
	            }
	        }
	    }
	    $materiascursos['multiple'] = true;
	    
	    try {
	        self::usuariosmaterias_Helper_Agregar( $materiascursos );
	    } catch (Exception $e) {
	        throw new Exception( 'usuarios_Helper_Modificar - usuariosmaterias_Helper_Agregar: ' . $e->getMessage() );
	    }
	    
	    return $r;
	}
	
	public static function usuarios_Modificar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}

		$id = $d['id'];

		$tb  = "usuarios ";

		$stA  = array();
		
		if( isset($d['tipodoc_id']) ){ $stA["tipodoc_id"] = $d['tipodoc_id'] ; }
		
		if( isset($d['documento']) ){ $stA["documento"] = trim($d['documento']) ; }
		if( isset($d['lugarescedula_id']) ){ $stA['lugarescedula_id'] = $d['lugarescedula_id'] ; }
		if( isset($d['nombres']) ){ $stA['nombres'] = trim($d['nombres']) ; }
		if( isset($d['apellidos']) ){ $stA['apellidos'] = trim($d['apellidos'])  ; }
		if( isset($d['mail']) ){ $stA['mail'] = trim($d['mail']) ; }
		
		if( isset($d['nacimiento']) ){ $stA['nacimiento'] = trim($d['nacimiento']) ; }
		if( isset($d['generos_id']) ){ $stA['generos_id'] = $d['generos_id'] ; }
		if( isset($d['lugares_id']) ){ $stA['lugares_id'] = $d['lugares_id'] ; }
		
		if( isset($d['gruposanguineo']) ){ $stA['gruposanguineo'] = trim($d['gruposanguineo'])  ; }
		if( isset($d['codigo']) ){ $stA['codigo'] = $d['codigo'] ; }
		if( isset($d['usuario']) ){ $stA['usuario'] = trim( strtolower( $d['usuario'] ) ) ; }
		
		if( isset($d['direccion']) ){ $stA['direccion'] = trim($d['direccion']) ; }
		if( isset($d['barrio']) ){ $stA['barrio'] = trim( $d['barrio'] ) ; }
		
		if( isset($d['loc_lugares_id']) ){ $stA['loc_lugares_id'] = $d['loc_lugares_id'] ; }
		
		if( isset($d['cargos_id']) ){ $stA['cargos_id'] = $d['cargos_id'] ; }
		if( isset($d['titulos_id']) ){ $stA['titulos_id'] = $d['titulos_id'] ; }
		
		if( isset($d['perfil_id']) ){ $stA['perfil_id'] = $d['perfil_id'] ; }
		
		if( isset($d['oficio']) ){ $stA['oficio'] = $d['oficio'] ; }
		if( isset($d['salariomes']) ){ $stA['salariomes'] = $d['salariomes'] ; }
		if( isset($d['contratoini']) ){ $stA['contratoini'] = $d['contratoini']; }
		if( isset($d['contratofin']) ){ $stA['contratofin'] = $d['contratofin'] ; }
		
		if( count( $stA ) < 1 ){
		    http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
		    throw new \Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] usuarios_Modificar: Sin datos para modificar' );
		}
		
		$wh = "id = ?";
		$pr = [$id];
		
		try {
		    $cu = Singleton::_safeUpdate( trim($tb), $stA, $wh, $pr );
		} catch (\Throwable $th) {
		    http_response_code( 500 );
		    throw new \Exception( 'usuarios_Modificar - _safeUpdate: ' . $th->getMessage() );
		}

		if ( isset( $d['tel'] ) ) {
			if ( strlen( trim( $d['tel'] ) ) > 0 ) {
				try {
					$modTel = array(
						'id' => $id,
						'valor' => trim($d['tel']),
						'by_tipotele_id' => 3
					);
					self::telefonosusuarios_Modificar( $modTel );
				} catch (\Throwable $th) {
					throw new \Exception( 'usuarios_Modificar: ' . $th->getMessage() );
				}
			}
		}

		return $cu;
	}
	public static function usuarios_Eliminar( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}
		
		$tb = "usuarios ";
		$st = ["estado_id" => "3"];
		$xt = 'id = ?';
		$pr = [ $d['id'] ];
		
		try {
		    return Singleton::_safeUpdate(trim($tb),$st,$xt,$pr);
		} catch (\Throwable $th) {
		    http_response_code( 500 );
		    throw new \Exception( $th->getMessage() );
		}
	}
	public static function usuarios_Helper_Obtener( $d ){
	    $r = null;
	    try {
	        $r = self::usuarios_Obtener( $d );
	    } catch (Exception $e) {
	        throw new Exception('usuarios_Helper_Obtener - usuarios_Obtener: ' . $e->getMessage() );
	    }
	    
	    $mc = null;
	    if ( count( $r ) > 0 ) {
	        try {
	            $mc = self::usuariosmaterias_Obtener( array( "w_usuarios_id" => $d['id'] ) );
	        } catch (Exception $e) {
	            throw new Exception("usuarios_Helper_Obtener - usuariosmaterias_Obtener: " . $e->getMessage() );
	        }
	        
	        for ($i = 0; $i < count( $r ); $i++) {
	            $r[ $i ]['matcur'] = $mc;
	        }
	    }
	    
	    return $r;
	}
	public static function usuarios_Obtener( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
		    throw new \Exception( '[' . IndexCtrl::ERR_COD_SESION_INACTIVA . '] usuarios_Obtener:' . $e->getMessage() );
		}
		
		$r = new Singleton();
		$r::$lnk->query( self::SQL_BIG_SELECTS );

		$telSql = "'' as tel,";
		if( isset( $d['id'] ) ){
			$_dTel = $d;
			$_dTel['by_usuarios_id'] = 3;
			$tel = self::telefonosusuarios_Obtener( $_dTel );
			
			if ( count( $tel ) > 0 ) {
				foreach ( $tel as $k ) {
					$telSql = '"' . $k['valor'] . '" as tel,';
					break;
				}
			}
		}

		$vr  = "estu.id, concat(estu.nombres, ' ', estu.apellidos) as fullname, " . $telSql . " estu.tipodoc_id, ";
		$vr .= "tipod.nombre as tipodoc, estu.documento, estu.lugarescedula_id, luced.nombre as lugarescedula, estu.nombres, ";
		$vr .= "estu.apellidos, estu.mail, estu.nacimiento, estu.generos_id, gener.nombre as genero, estu.lugares_id, ";
		$vr .= "lugna.nombre as lugares ,estu.gruposanguineo, estu.codigo, estu.usuario, estu.foto, estu.direccion, estu.barrio, ";
		$vr .= "estu.loc_lugares_id,luglo.nombre as loc_lugares, estu.cargos_id, carg.nombre as cargos, estu.titulos_id, titul.nombre as titulos, ";
		$vr .= "estu.creado, estu.perfil_id, perfi.nombre as perfil, estu.estado_id, estad.nombre as estado ";
		$vr .= ",estu.oficio,estu.salariomes,estu.contratoini,estu.contratofin ";
		
		if ( isset( $d['tokenid'] ) ) {
		    if( $d['tokenid'] ){
		      $vr .= ", md5( concat(estu.usuario, estu.clave) ) as tokenid ";
		    }
		}
		
		$tb  = "usuarios as estu ";
		$xt  = "LEFT JOIN tipodoc as tipod on tipod.id = estu.tipodoc_id ";
		$xt .= "LEFT JOIN lugares as luced on luced.id = estu.lugarescedula_id ";
		$xt .= "LEFT JOIN generos as gener on gener.id = estu.generos_id ";
		$xt .= "LEFT JOIN lugares as lugna on lugna.id = estu.lugares_id ";
		$xt .= "LEFT JOIN lugares as luglo on luglo.id = estu.loc_lugares_id ";
		$xt .= "LEFT JOIN cargos as carg on carg.id = estu.cargos_id ";
		$xt .= "LEFT JOIN titulos as titul on titul.id = estu.titulos_id ";
		$xt .= "LEFT JOIN perfilusuarios as perfi on perfi.id = estu.perfil_id ";
		$xt .= "LEFT JOIN estado as estad on estad.id = estu.estado_id ";

		$wh = "";
		if( isset( $d['id'] ) ){
			$wh = 'where estu.id = ' . $d['id'] . ' ';
		}

		if ( isset( $d['perfil_id']) ) {
			$wh = 'where ( estu.perfil_id = ' . implode( ' OR estu.perfil_id = ', $d['perfil_id'] ) . ') ';
		}
		
		if ( isset( $d['w_email'] ) ) {
		    $wh = 'where estu.perfil_id = 1 AND estu.mail like "' . $d['w_email'] . '" ';
		}

		if( isset( $d['id'] ) && isset( $d['perfil_id']) ){
			$wh = 'where estu.id = ' . $d['id'] . ' AND ( usu.perfil_id = ' . implode( ' OR usu.perfil_id = ', $d['perfil_id'] ) . ') ';
		}
		
		if( isset( $d['porids'] ) ){
		    $filtro = implode( " OR estu.id = ", $d['porids'] );
		    $wh = 'where ( estu.id = ' . $filtro . ' ) ';
		}
		
		if ( isset( $d['multicampo'] ) ) {
		    $q = trim( $d['multicampo'] );
		    $wh = 'where estu.nombres like "%' . $q . '%" OR estu.apellidos like "%' . $q . '%" OR estu.documento like "%' . $q . '%"';
		}
		if ( isset( $d['searchtext'] ) ) {
		    $q = trim( $d['searchtext'] );
		    $xt .= "where estu.nombres like '%" . $q . "%' OR estu.apellidos like '%" . $q . "%' ";
		}
		
		$xt .= $wh;
		$xt .= 'order by 2 ';

		if( isset( $d['limite'] ) ){
			$xt .= 'limit ' . $d['limite'] . ' ';
		}

		//die( "SELECT " . $vr . "\nFROM " . $tb . "\n" . $xt );
		$r2 = Singleton::_readInfo($tb,$vr,$xt);
		if ( isset( $r2['err_info'] )) {
			http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
			throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] usuarios_Obtener: ' . $r2['err_info'] );
		}

		return $r2;
	}
	public static function usuarios_ObtenerAjax(){
		date_default_timezone_set('America/Bogota');
		return Singleton::_dataTable( array( 'tb' => 'usuarios', 'codifica_a' => IndexCtrl::CHARS_TO, 'codifica_desde' => IndexCtrl::CHARS_FR ) );
	}
	
	public static function usuarios_NuevaClaveAjax( $d, $perfil ){
	    date_default_timezone_set('America/Bogota');
	    if ( $perfil == self::USUARIOS_PERFIL_ADMINISTRADOR || $perfil == self::USUARIOS_PERFIL_SUPERVISOR || $perfil == self::USUARIOS_PERFIL_PROVEEDOR ) {
	        
	        $usr = null;
	        $_id = $d['id'];
	        $_notificar = ( isset( $d['notificar'] ) ? $d['notificar'] : '1');
	        try {
	            $usr = self::usuarios_Obtener( array( 'id' => $_id ) );
	        } catch (Exception $e) {
	            http_response_code( 500 );
	            throw new Exception("[500]usuarios_NuevaClaveAjax: " . $e->getMessage() . "");
	        }
	        
	        if( !(count( $usr ) > 0) ){
	            http_response_code( IndexCtrl::ERR_COD_USUARIO_NO_EXISTE_BY_ID );
	            throw new Exception("usuarios_NuevaClaveAjax: El usuario no existe, verifique los datos.");
	        }
	        
	        $dt = $usr[0];
	        
	        $clv = Utiles::nuevoCl(8);
	        $ea = $dt["mail"];
	        
	        if ( isset( $d['setclave'] ) ) {
	            $clv = $d['setclave'];
	        }
	        $tb = "usuarios ";
	        $st = ["clave" => md5($clv)];
	        $xt = "id = ?";
	        $pr = [ $_id ];
	        //die( 'UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt );
	        try {
	            Singleton::_safeUpdate(trim($tb), $st, $xt, $pr);
	        } catch (Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_CAMBIO_CLAVE_FALLIDO );
	            throw new Exception( "usuarios_NuevaClaveAjax: " . $e->getMessage() );
	        }
	        
	        if( $_notificar == 1 ){
	            $tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "nuevaclave.html");
	            $_aed = array( 'CLAVE_TMP' => $clv,'USUARIO_TMP' => $ea );
	            $replacement_array = self::ObtenerEtiquetasEmail($_aed);
	            
	            $mensaje = preg_replace_callback(
	                '~\{\$(.*?)\}~si',
	                function($match) use ($replacement_array) {
	                    return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	                },
	                $tplCode);
	            
	            $emOpc = array(
	                "para" => $ea,
	                "titulo" => "Nuevapp - servicio #" . date('YmdHis'),
	                "mensaje" => $mensaje,
	                "desde" => "notificador@nuevapp.com",
	                "rotulo" => 'Clave temporal'
	            );
	            try {
	                $rsend = self::enviarCustomEmail( $emOpc );
	            } catch (Exception $e) {
	                http_response_code( IndexCtrl::ERR_COD_CORREO_FAIL );
	                throw new Exception("[" . IndexCtrl::ERR_COD_CORREO_FAIL . "]usuarios_NuevaClaveAjax: " . $e->getMessage() . "");
	            }
	            
	            error_log( "mail activa: " . print_r( $rsend, true )  . " cl: " . $clv);
	        }

	        
	    }
	    else{
	        http_response_code( IndexCtrl::ERR_COD_SIN_PRIVILEGIOS );
	        throw new Exception("usuarios_NuevaClaveAjax: No tiene suficientes permisos para esta operaci&oacute;n");
	    }
	    
	    return true;
	    
	}
	
	// Usuarios FIN
	
	// Nueva clave de usuarios INI
	private static function NuevaClave( $d ){
	    $c = $d["c"];
	    $n = $d["n"];
	    $u = $d["u"];
		$tp = $d['tp'];
	    
	    $tb = $tp;
	    $ver = "*";
	    $extra = "where id = " . $u . " and clave = '" . md5($c) . "'";
	    
	    $okUsr = Singleton::_readInfo($tb, $ver, $extra);
	    if( count($okUsr) > 0 ){
	        $set = ["clave" => md5($n)];
	        $extrau = "id = ?";
	        $pr = [$u];
	        try {
	            Singleton::_safeUpdate(trim($tb), $set, $extrau, $pr);
	            return array( "ok" => true );
	        } catch (Exception $e) {
	            throw new Exception( $e->getMessage() );
	        }
	    }else {
	        throw new Exception("La clave actual no coincide.");
	    }
	}
	public static function cambioClave_Add( $d ){
		$usu = null;
		try {
			$usu = self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( $e->getMessage() );
		}

		if( $usu->getPerfil_id() == self::USUARIOS_PERFIL_SUPER_USUARIO || $usu->getPerfil_id() == self::USUARIOS_PERFIL_ADMINISTRADOR || $usu->getPerfil_id() == self::USUARIOS_PERFIL_SUPERVISOR ){
			$tbCl = "usuarios";
		}
		else if( $usu->getPerfil_id() == self::USUARIOS_PERFIL_EMPLEADOS ){
			$tbCl = "empleados";
		}

		if ( trim( $d['newpassword'] ) !== trim( $d['confirmpassword'] ) ) {
			http_response_code( 406 );
			throw new \Exception( 'La clave nueva y confirmada no coincide' );
		}

		$opc = array(
			'c' => $d['currentpassword'],
			'n' => $d['newpassword'],
			'u' => $usu->getId(),
			'tp' => $tbCl
		);
		
		try{
			return self::NuevaClave( $opc );
		} catch (\Exception $e) {
			http_response_code( 500 );
			throw new \Exception( $e->getMessage() );
		}

	}
	public static function cambioClave_Home_Add( $d ){
	    self::authRequOff();
	    
	    $js = base64_decode( $d['key'] );
	    $opc = json_decode($js, true) ;
	    
	    $tipo = $opc['tipo'];
	    
	    if( $tipo == self::TIPO_TBQRY_CONTACTO ){
	        $tbCl = "acudientes";
	    }
	    else if( $tipo == self::TIPO_TBQRY_Empleado ){
	        $tbCl = "empleados";
	    }
	    
	    if ( trim( $opc['newpassword'] ) !== trim( $opc['confirmpassword'] ) ) {
	        http_response_code( 406 );
	        throw new \Exception( 'La clave nueva y confirmada no coincide' );
	    }
	    
	    $opc = array(
	        'c' => $opc['currentpassword'],
	        'n' => $opc['newpassword'],
	        'u' => $opc['id'],
	        'tp' => $tbCl
	    );
	    
	    try{
	        return self::NuevaClave( $opc );
	    } catch (\Exception $e) {
	        http_response_code( 500 );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	}
	// Nueva clave de usuarios FIN
	
	// Apibox INI
	public static function apibox_Agregar( $d ){
	    $uDt = null;
	    $u = self::usuarios_Obtener( array( 'id' => $d['id'], 'tokenid' => true ) ) ;
	    if ( count( $u ) > 0 ) {
	        $uDt = $u[0];
	    }
	    
	    $tk = self::GenerarToken( array( 'u' => $uDt['tokenid'], 'md5' => true, 'forcenew' => true ) );
	    
	    return $tk;
	}
	public static function apibox_Obtener( $d ){
	    $r = self::apibox_Agregar( $d );
	    
	    return $r;
	}
	// Apibox FIN
	
	// Datosmes INI
	/*
	 * @yalfonso
	 * TODO: Tarea 14 - Crear controlador tipo helper del modelo datos mes para Agregar
	 */
	public static function datosmes_Helper_Agregar ( $d ) {
	    $empleados_id = $d['empleados_id'];
	    
	    $qryem = self::empleados_Obtener( [ 'id' => $empleados_id ] );
	    $nombrefull = "";
	    foreach ( $qryem as $kEmpl ) {
	        $nombrefull = $kEmpl['nombres'] . " " .$kEmpl['apellidos'];
	    }
	    
	    $existe = [];
	    try {
	        $existe = self::datosmes_Obtener([ 'w_mesaplica' => $d['mesaplica'], 'w_empleados_id' => $empleados_id ]);
	    } catch (Exception $e) {
	        throw new Exception( 'datosmes_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    $dAdd = [
	        'contrato' => $d['contrato'],
	        'empleados_id' => $empleados_id,
	        'mesaplica' => $d['mesaplica'],
	        'valorccobro' => preg_replace('/\D/', '', $d['valorccobro'] ),
	        'usuariosmod' => $nombrefull
	    ];
	    
	    if ( count( $existe ) > 0 ) {
	        $datosmesDt = $existe[0];
	        $dAdd['id'] = $datosmesDt['id'];
	        
	        try {
	            self::datosmes_Modificar( $dAdd );
	        } catch (Exception $e) {
	            throw new Exception( 'datosmes_Modificar: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    else {
	        try {
	            self::datosmes_Agregar( $dAdd );
	        } catch (Exception $e) {
	            throw new Exception( 'datosmes_Agregar: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 15 - Crear controlador del modelo datos mes para Obtener
	 */
	public static function datosmes_Obtener( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "dtmes.`id`, dtmes.`mesaplica`, dtmes.`valorccobro`, dtmes.`contrato`, dtmes.`fecha`, ";
	    $vr .= "dtmes.empleados_id, concat( empl.nombres, ' ', empl.apellidos ) as empleados_fullname, ";
	    $vr .= "dtmes.`usuariosmod`, dtmes.fechamod, dtmes.`paquetes_id`, pkg.nombre as paquetes_nombres ";

	    $tb  = 'datosmes as dtmes ';
	    
	    $jn  = 'LEFT JOIN paquetes as pkg on pkg.id = dtmes.paquetes_id ';
	    $jn .= 'LEFT JOIN empleados as empl on empl.id = dtmes.empleados_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "dtmes.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_mesaplica'] ) ){
	        $wh[] = "dtmes.`mesaplica` = ?";
	        $pr[] = $d['w_mesaplica'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'datosmes_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    return $r;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 16 - Crear controlador del modelo datos mes para Agregar
	 */
	public static function datosmes_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "datosmes ";
	    $aSt = array();
	    if ( isset( $d['valorccobro'] ) ) {
	        $aSt['valorccobro'] = $d['valorccobro'] ;
	    }
	    if ( isset( $d['contrato'] ) ) {
	        $aSt['contrato'] = $d['contrato'] ;
	    }
	    if ( isset( $d['usuariosmod'] ) ) {
	        $aSt['usuariosmod'] = $d['usuariosmod'] ;
	    }
	    $aSt['fechamod'] = date('Y-m-d H:i:s');
	    
	    $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[]  = $d['id'];
	    }
	    if ( isset( $d['w_usuariosmod'] ) ) {
	        $wh  = 'id = ?';
	        $pr[]  = $d['w_usuariosmod'];
	    }
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'formularios_Modificar: Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = $wh;
	    
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'formularios_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 17 - Crear controlador del modelo datos mes para Agregar
	 */
	public static function datosmes_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Datosmes();
	    if (isset( $d['mesaplica'] ) ) {
	        $o->setMesaplica( $d['mesaplica'] );
	    }
	    if (isset( $d['titulo'] ) ) {
	        $o->setTitulo( $d['titulo'] );
	    }
	    if (isset( $d['valorccobro'] ) ) {
	        $o->setValorccobro( $d['valorccobro'] );
	    }
	    if (isset( $d['contrato'] ) ) {
	        $o->setContrato( $d['contrato'] );
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $o->setEmpleados_id( $d['empleados_id'] );
	    }
	    if (isset( $d['usuariosmod'] ) ) {
	        $o->setUsuariosmod( $d['usuariosmod'] );
	    }
	    if (isset( $d['paquetes_id'] ) ) {
	        $o->setPaquetes_id( $d['paquetes_id'] );
	    }
	    $o->setFecha( date("Y-m-d H:i:s") );
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	// Datosmes FIN
	
	// Deducciones INI
	/*
	 * @yalfonso
	 * TODO: Tarea 37 - Crear funci&oacute;n que ayude a agregar o modificar las deducciones
	 */
	public static function deducciones_Helper_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $regQry = [];
	    try {
	        $regQry = self::deducciones_Obtener( [ "w_paquetes_id" => $d['idMod'] ] );
	    } catch (Exception $e) {
	        http_response_code( $e->getCode() );
	        return self::retorno( [], $e->getCode(), 'deducciones_Helper_Agregar - deducciones_Obtener: ' . $e->getMessage() ) ;
	    }
	    
	    if ( count( $regQry ) > 0 ) {
	        $dedu = $regQry[ 0 ];
	        try {
	            self::deducciones_Modificar( [ "id" => $dedu['id'], "valor" => $data ] );
	        } catch (Exception $e) {
	            http_response_code( $e->getCode() );
	            return self::retorno( [], $e->getCode(), 'deducciones_Helper_Agregar - deducciones_Modificar: ' . $e->getMessage() ) ;
	        }
	    }
	    else {
	        try {
	            self::deducciones_Agregar( [ "paquetes_id" => $d['idMod'], "valor" => $data ] );
	        } catch (Exception $e) {
	            http_response_code( $e->getCode() );
	            return self::retorno( [], $e->getCode(), 'deducciones_Helper_Agregar - deducciones_Agregar: ' . $e->getMessage() ) ;
	        }
	    }
	    
	    return self::retorno( [ "data" => $json, "idMod" => $d['idMod'], "regQry" => $regQry ], 0, '') ;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 38 - Crear funci&oacute;n que agregue las deducciones
	 */
	public static function deducciones_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $o = new Deducciones();
	    if (isset( $d['paquetes_id'] ) ) {
	        $o->setPaquetes_id( $d['paquetes_id'] );
	    }
	    if (isset( $d['valor'] ) ) {
	        $o->setValor( $d['valor'] );
	    }
	    $o->setUsuarios( $usu->getNombres() . ' ' . $usu->getApellidos() );
	    $o->setFecha( date('Y-m-d H:i:s') );
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmaslog_Agregar: ' . $o->obtenerError() );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'firmaslog_Agregar: Respuesta no implementada' );
	    }
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 39 - Crear funci&oacute;n que obtenga las deducciones
	 */
	public static function deducciones_Obtener( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "deds.`id`, deds.`paquetes_id`, pks.nombre as paquetes_nombre, pks.empleados_id as paquetes_empleados_id, ";
	    $vr .= "pks.empleados as empleados_empleados, pks.mesaplica as paquetes_mesaplica, deds.`valor`, deds.`usuarios`, deds.`fecha` ";
	    
	    $tb  = '`deducciones` as deds ';
	    
	    $jn  = 'LEFT JOIN paquetes as pks on pks.id = deds.paquetes_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "deds.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_paquetes_id'] ) ){
	        $wh[] = "deds.paquetes_id = ?";
	        $pr[] = $d['w_paquetes_id'];
	    }
	    if( isset( $d['w_empleados_id'] ) ){
	        $wh[] = 'pks.empleados_id = ?' ;
	        $pr[] = $d['w_empleados_id'];
	    }
	    if( isset( $d['w_mesaplica'] ) ){
	        $wh[] = 'pks.mesaplica = ?' ;
	        $pr[] = $d['w_mesaplica'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr); //Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 40 - Crear funci&oacute;n que modifique las deducciones
	 */
	public static function deducciones_Modificar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb  = "deducciones ";
	    $aSt = array();
	    if (isset( $d['valor'] ) ) {
	        $aSt['valor'] = $d['valor'] ;
	    }
	    $aSt['usuarios'] = $usu->getNombres() . ' ' . $usu->getApellidos();
	    $aSt['fecha'] = date('Y-m-d H:i:s') ;
	    
	    $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[] = $d['id'];
	    }
	    if ( isset( $d['w_paquetes_id'] ) ) {
	        $wh  = 'paquetes_id = ?';
	        $pr[] = $d['w_paquetes_id'] ;
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = $wh;
	    
	    //$sqlPart = implode(', ', array_map(function($k, $v) {return $k . " = '" . addslashes($v) . "'";}, array_keys($aSt), $aSt));
	    //die('UPDATE ' . $tb . ' SET ' . $sqlPart . ' WHERE ' . $xt);
	    
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception($th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 41 - Crear funci&oacute;n que eliminar las deducciones
	 */
	public static function deducciones_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb = "deducciones ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	// Deducciones FIN
	
	// Deducciones (virtual) INI
	/*
	 * @yalfonso
	 * TODO: Tarea 23 - Crear funci&oacute;n que obtenga la configuraci&oacute;n de las posibles deducciones
	 */
	public static function deducciones_Config_Obtener( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        return self::retorno([], IndexCtrl::ERR_COD_SESION_INACTIVA, 'deducciones_Config_Obtener - Sesi&oacute;n finalizada, vuelve a iniciar sesi&oacute;n');
	    }
	    
	    $cfg = self::LeerConfigCorp();
	    $_CFG_DEDUCCIONES_DATA = isset( $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]) ? $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]["val"] : base64_encode( '{}' );
	    
	    $cfgDt = json_decode( base64_decode( $_CFG_DEDUCCIONES_DATA ) , true );
	    
	    if ( isset( $cfgDt[ $d['firma'] ] ) ) {
	        return $cfgDt[ $d['firma'] ];
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_USUARIO_NO_EXISTE_BY_ID );
	        return self::retorno([], IndexCtrl::ERR_COD_USUARIO_NO_EXISTE_BY_ID, 'deducciones_Config_Obtener - Registro ' . $d['firma'] . ' no existe');
	    }
	    
	    
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 24 - Crear funci&oacute;n que obtenga la configuraci&oacute;n de las posibles deducciones en formato legible para DataTable
	 */
	public static function deducciones_Config_Obtener_Ajax( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        return self::retorno([], IndexCtrl::ERR_COD_SESION_INACTIVA, 'deducciones_Config_Obtener_Ajax - Sesi&oacute;n finalizada, vuelve a iniciar sesi&oacute;n');
	    }
	    	    
	    $cfg = self::LeerConfigCorp();
	    $_CFG_DEDUCCIONES_DATA = isset( $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]) ? $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]["val"] : base64_encode( '{}' );
	    
	    $cfgDt = json_decode( base64_decode( $_CFG_DEDUCCIONES_DATA ) , true );
	    
	    $data = [];
	    foreach ( $cfgDt as $kDt ) {
	        $data[] = [
	            "firma" => $kDt['firma'],
	            "criterio" => base64_decode( $kDt['firma'] ),
	            "deducciones" => count($kDt['deducciones']),
	            "fecha" => $kDt['fecha'],
	            "usuario" => $kDt['usuario'],
	            "fechamod" => $kDt['fechamod'],
	            "registro" => $kDt //base64_encode( json_encode( $kDt ) )
	        ];
	    }
	    
	    return $data;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 25 - Crear funci&oacute;n que elimina la configuraci&oacute;n de las posibles deducciones
	 */
	public static function deducciones_Config_Eliminar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        return self::retorno([], IndexCtrl::ERR_COD_SESION_INACTIVA, 'deducciones_Config_Eliminar - Sesi&oacute;n finalizada, vuelve a iniciar sesi&oacute;n');
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $firma = str_replace("==","",$json['firma']);
	    $firma = str_replace("=","",$firma);
	    
	    $cfg = self::LeerConfigCorp();
	    $_CFG_DEDUCCIONES_DATA = isset( $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]) ? $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]["val"] : base64_encode( '{}' );
	    
	    $cfgDt = json_decode( base64_decode( $_CFG_DEDUCCIONES_DATA ) , true );
	    
	    if ( isset( $cfgDt[ $firma ] ) ) {
	        unset( $cfgDt[ $firma ] );
	    }
	    
	    $newCfg = [
	        "id" => OperacionesCtrl::CFG_DEDUCCIONES_DATA,
	        "vl" => base64_encode( json_encode( $cfgDt ) ),
	        "ufull" => trim( $usu->getNombres() . " " . $usu->getApellidos())
	    ];
	    try {
	        self::EscribirConfig( $newCfg );
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        return self::retorno([], IndexCtrl::ERR_COD_MSJ_ERR_COMUN, 'deducciones_Config_Eliminar - EscribirConfig: ' . $e->getMessage());
	    }
	    
	    return self::retorno(['return' => true], '', '') ;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 26 - Crear funci&oacute;n que agrege las deducciones que se aplicar&aacute;n a los usuarios
	 */
	public static function deducciones_Config_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        return self::retorno([], IndexCtrl::ERR_COD_SESION_INACTIVA, 'deducciones_Config_Agregar - Sesi&oacute;n finalizada, vuelve a iniciar sesi&oacute;n');
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    //die( 'json: ' . print_r( $json , true ) );
	    
	    $firma = str_replace("==","",$json['firma']);
	    $firma = str_replace("=","",$firma);
	    $modificar = filter_var( isset( $json['modificar'] ) ? $json['modificar'] : false , FILTER_VALIDATE_BOOLEAN);
	    
	    $cfg = self::LeerConfigCorp();
	    $_CFG_DEDUCCIONES_DATA = isset( $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]) ? $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]["val"] : base64_encode( '{}' );
	    
	    $cfgDt = json_decode( base64_decode( $_CFG_DEDUCCIONES_DATA ) , true );
	    
	    //echo ( "json: " . print_r( $json, true ) );
	    if ( $modificar ) {
	        if ( isset( $cfgDt[ $firma ] ) ) {
	            //$json['fechamod'] = date("Y-m-d H:i:s");
	            //$cfgDt[ $firma ] = $json;
	            foreach ( $cfgDt[ $firma ] as $kJsn => $vJsn ) {
	                if( isset( $json[ $kJsn ] ) ){
	                   $cfgDt[ $firma ][ $kJsn ] = $json[ $kJsn ];
	                }
	                else {
	                    $cfgDt[ $firma ][ $kJsn ] = $vJsn;
	                }
	            }
	            $cfgDt[ $firma ]['fechamod'] = date("Y-m-d H:i:s");
	        }
	        else {
	            http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	            return self::retorno([], IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO, 'Esta condici&oacute;n no existe');
	        }
	    }
	    else {
	        if ( isset( $cfgDt[ $firma ] ) ) {
	            http_response_code( IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	            return self::retorno([], IndexCtrl::ERR_COD_REGISTRO_EXISTENTE, 'Esta condici&oacute;n ya existe');
	        }
	        $json['fecha'] = date("Y-m-d H:i:s");
	        $json['usuario'] = trim( $usu->getNombres() . " " . $usu->getApellidos());
	        $json['fechamod'] = "";
	        $cfgDt[ $firma ] = $json;
	        
	    }
	    
	    //echo ( "cfgDt: " . print_r( $cfgDt, true ) );
	    //die();
	    
	    $newCfg = [
	        "id" => OperacionesCtrl::CFG_DEDUCCIONES_DATA,
	        "vl" => base64_encode( json_encode( $cfgDt ) ),
	        "ufull" => trim( $usu->getNombres() . " " . $usu->getApellidos())
	    ];
	    try {
	        self::EscribirConfig( $newCfg );
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        return self::retorno([], IndexCtrl::ERR_COD_MSJ_ERR_COMUN, 'deducciones_Config_Agregar - EscribirConfig: ' . $e->getMessage());
	    }
	    
	    return self::retorno(['return' => true], '', '') ;
	}
	// Deducciones (virtual) INI
	
	// Usabilidad INI
	public static function Usabilidad_Helper_Agregar( $d ){
	    $_olg = array(
	        "refid" => "" . trim($d['refid']),
	        "vl"=> "" . $d['vl'],
	        "usr" => $d['usr']
	    );
	    try {
	        self::Usabilidad_agregar( $_olg );
	    } catch (Exception $e) {
	        error_log( "Usabilidad_Helper_Agregar - Usabilidad_agregar: " . $e->getMessage() );
	    }
	}
	public static function Usabilidad_agregar( $d ) {
	    if( !isset( $d["refid"] ) ) throw new Exception("Usabilidad_agregar: El id de usabiliudad es obligatorio");
	    if( !isset( $d["vl"] ) ) throw new Exception("Usabilidad_agregar: El valor es obligatorio");
	    if( !isset( $d["usr"] ) ) throw new Exception("Usabilidad_agregar: El usuario es obligatorio");
	    
	    $usabilidadref_id = $d['refid'];
	    $valor = $d['vl'];
	    $usr = $d['usr'];
	    
	    $tb = "usabilidadref";
	    $vr = "id,nombre,descr";
	    $xt = 'WHERE nombre like "' . trim( $usabilidadref_id ) . '"';
	    $usor = Singleton::_readInfo( $tb, $vr, $xt );
	    if ( isset( $usor['err_info'] ) ) {
	        throw new Exception( $usor['err_info'] );
	    }
	    
	    $rId = '';
	    if ( count( $usor ) > 0 ) {
	        $tmpAr = $usor[0];
	        $rId = $tmpAr['id'];
	    }
	    
	    $ref = '' ;
	    if( isset( $_SERVER['HTTP_REFERER'] ) ) $ref = $_SERVER['HTTP_REFERER'];
	    $laIp = Utiles::get_user_ip_address();
	    
	    $_o = new Usabilidad();
	    $_o->setUsabilidadref_id( $rId );
	    $_o->setValor( $valor );
	    $_o->setUsuario( $usr );
	    $_o->setUrlref( $ref );
	    $_o->setIp( $laIp );
	    
	    $idr = $_o->saveData();
	    if( strlen(trim($_o->obtenerError())) > 0 ){
	        http_response_code(IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA);
	        throw new Exception( trim($_o->obtenerError()) );
	    }
	    return array( "ok" => $idr );
	}
	// Usabilidad FIN

	// Subir Foto Perfil
	public static function SubirFotoPerfil( $d ){
		try {
			self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
			throw new \Exception( 'SubirFotoPerfil: ' . $e->getMessage() );
		}

		$perfil_id = $d['perfil_id'];
		$id = $d['id'];

		$nm = $id . '_' . $perfil_id . '_' . Utiles::create_uuid();
		$pth = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'repo' . DIRECTORY_SEPARATOR . 'avatar';
		
		$nwfl = "";
		try {
		    $nwfl = self::SubirArchivo($nm, $pth);
		} catch (Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
		    throw new \Exception( 'SubirFotoPerfil - SubirArchivo: ' . $e->getMessage() );
		}

		$tb = "";
		if ( $perfil_id == self::USUARIOS_PERFIL_ADMINISTRADOR || $perfil_id == self::USUARIOS_PERFIL_SUPERVISOR || $perfil_id == self::USUARIOS_PERFIL_SUPERVISORADM || $perfil_id == self::USUARIOS_PERFIL_FINANCIERO || $perfil_id == self::USUARIOS_PERFIL_PROVEEDOR || $perfil_id == self::USUARIOS_PERFIL_RUTA  ) {
			$tb = 'usuarios';
		}
		elseif ( $perfil_id == self::USUARIOS_PERFIL_EMPLEADOS ) {
			$tb = 'empleados';
		}
		elseif ( $perfil_id == self::USUARIOS_PERFIL_ACUDIENTE ) {
		    $tb = 'acudientes';
		}
		
		$st = ['foto' => $nwfl];
		$xt = 'id = ?';
		$pr = [ $id ];
		
		try {
		    Singleton::_safeUpdate( trim($tb), $st, $xt, $pr );
		} catch (\Throwable $th) {
		    http_response_code( 500 );
		    throw new \Exception( $th->getMessage() );
		}

		return $nwfl;
	}
	
	public static function obtener_LogoCompany(){
	    $extPo = array('jpg','jpeg','png', 'apng');
	    $logoinst_path = dirname(dirname(dirname(__FILE__)));
	    $logoinsttmp = $logoinst_path . DIRECTORY_SEPARATOR . 'temas' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo_inst';
	    
	    $logoinst = '/temas/img/logo_no_institu_v2.png';
	    
	    $bfechaOk = date("Y-m-d H:i:s", strtotime( "1900-01-01 00:00:00" ) );
	    
	    foreach( $extPo as $_i ){
	        $fullfl = $logoinsttmp . "." . $_i;
	        if ( file_exists( $fullfl ) ) {
	            
	            $bfecha = date("Y-m-d H:i:s", filemtime( $fullfl ) );
	            if ( $bfecha > $bfechaOk ) {
	                $bfechaOk = $bfecha;
	                $logoinst = '/temas/img/logo_inst.' . $_i;
	            }
	        }
	    }
	    return $logoinst;
	}
	
	public static function registrarVisita_Agregar( $d ) {
	    $ref = "directo";
	    if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
	        $ref = $_SERVER['HTTP_REFERER'];
	    }
	    
	    $usr = "visita";
	    if (isset( $_SERVER['QUERY_STRING'] ) ) {
	        $usr = $_SERVER['QUERY_STRING'] ;
	    }
	    
	    $_olg = array(
	        "refid" => "WEB_LGN_VISITA_APP",
	        "vl"=> "" . $ref,
	        "usr" => $usr
	    );
	    try {
	        self::Usabilidad_agregar( $_olg );
	    } catch (Exception $e) {
	        error_log( "OperacionesCtrl.registrarVisita_Agregar: " . $e->getMessage() );
	    }
	}
	
	// EditorPlantillas INI
	//Templates.phtml
	public static function editarPlantillas_Obtener( $d ) {
	    $fld_base = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "sistema" . DIRECTORY_SEPARATOR . "email" . DIRECTORY_SEPARATOR;
	    
	    $r = array();
	    
	    if ( file_exists( $fld_base ) ) {
	        
	        foreach(scandir( $fld_base ) as $file ){
	            $fl_tmp = rtrim($fld_base, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
	            if( !is_dir( $fl_tmp ) ){
	                $r[] = array(
	                    "lbl" => mb_convert_case( $file , MB_CASE_TITLE, "UTF-8") ,
	                    "fl" => $file
	                );
	            }
	        }
	    }
	    
	    return $r;
	}
	
	public static function editarPlantillas_Documento( $d ) {
	    $fld_base = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "sistema" . DIRECTORY_SEPARATOR . "email" . DIRECTORY_SEPARATOR;
	    
	    $fl = $d['fl'];
	    
	    $html = "";
	    if ( file_exists( $fld_base ) ) {
	        $flnm = rtrim( $fld_base , DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR . $fl . ".html";
	        $html = file_get_contents( $flnm );
	    }
	    return $html;
	}
	
	public static function editarPlantillas_Agregar( $d ) {
	    $tpl = base64_decode( $d['tpl'] );
	    $fl = $d['fl'];
	    
	    try {
	        return self::EstablecerPlantillasEmail( array( "tplid" => $fl,"tplv" => $tpl ) );
	    } catch (Exception $e) {
	        throw new Exception ( 'editarPlantillas_Agregar: ' . $e->getMessage() );
	    }
	}
	
	const PLANTILLAS_TIPOS = array(
	    array( "id" => "doc", "nombre" => "Documento" ),
	    array( "id" => "sig", "nombre" => "Documento Contratistas" ),
	    array( "id" => "loc", "nombre" => "Documento para Administradores" ),
	    array( "id" => "mix", "nombre" => "Documento para generar" )
	);
	
	public static function editarPlantillas_Nuevo( $d ) {
	    $dt = base64_decode( $d['data'] );
	    $js = json_decode( $dt, true );
	    
	    $fld_base = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "sistema" . DIRECTORY_SEPARATOR . "email" . DIRECTORY_SEPARATOR;
	    
	    $fl = str_replace(" ", "_", trim( $js['tpl_nombre'] ) );
	    $fl = preg_replace('/[^a-zA-Z0-9_]/', '', $fl );
	    
	    foreach ( self::PLANTILLAS_TIPOS as $vPTpl ) {
	        if ( substr( $fl, 0, 4 ) == $vPTpl['id'] . "_" ) {
	            $fl = substr( $fl, 4 );
	        }
	    }
	    
	    $flPart = pathinfo( $fl );
	    $tp = $js['tpl_tipo'];
	    $sTp = "";
	    if ( $tp != "doc") {
	        $sTp = $tp . "_";
	    }
	    
	    $defnm = $sTp . "" . $flPart['filename'] ;
	    $flnm = $fld_base . $defnm . ".html";

	    if ( file_exists( $flnm ) ) {
	        http_response_code ( IndexCtrl::ERR_COD_PLANTILLA_NO_SALVADA );
	        throw new Exception('El archivo ya existe y no puede ser reemplazado');
	    }else{	        
	        $ini = "Hola mundo";
	        file_put_contents( $flnm, $ini);
	        
	        return $flnm;
	        
	    }
	    return false;
	    
	}
	
	public static function editarPlantillas_Eliminar( $d ) {
	    $dt = base64_decode( $d['data'] );
	    $js = json_decode( $dt, true );
	    
	    $tplnm = $js['template'];
	    $fld_base = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "sistema" . DIRECTORY_SEPARATOR . "email" . DIRECTORY_SEPARATOR;
	    $fl = $fld_base . $tplnm . ".html";
	    
	    if ( file_exists( $fl ) ) {
	        if ( unlink( $fl ) ){
	            return true;
	        }
	        else {
	            http_response_code(IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	            throw new Exception('[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] editarPlantillas_Eliminar: El archivo ' . $tplnm . ' no se elimino&oacute;.');
	        }
	    }
	    else{
	        http_response_code(IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	        throw new Exception('[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] editarPlantillas_Eliminar: El archivo ' . $tplnm . ' no existe.');
	    }
	    
	    return false;
	    
	}
	
	const EDITAR_PLANTILLAS_CFG_NAME = "config.json";
	public static function editarPlantillas_Mezclar_JS_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( 'SubirFotoPerfil: ' . $e->getMessage() );
	    }
	    
	    $rutaparts = pathinfo( $d['bs'] );
	    $carpetafull = $rutaparts['dirname'];
	    
	    $name_folder_parts = pathinfo( $carpetafull );
	    $rutaanyoparts = $name_folder_parts['dirname'];
	    $ruta = pathinfo( $rutaanyoparts );
	    
	    $basefolderjs = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . $rutaanyoparts;
	    $filejs = $basefolderjs . DIRECTORY_SEPARATOR . self::EDITAR_PLANTILLAS_CFG_NAME;
	    $name_folder = $name_folder_parts['filename'];
	    $archivo = $rutaparts['filename'];
	    
	    $configfl = array();
	    if ( file_exists( $filejs ) ) {
	        $flcon = file_get_contents($filejs);
	        $configfl = json_decode( $flcon , true );
	    }
	    
	    $hashid = $name_folder . $archivo . date("YmdHis") ;
	    
	    $configfl[ $name_folder ][ $archivo ] = array(
	        "hash" => md5( $hashid ),
	        "empleados" => trim($d['empleados']),
	        "tipodoc_id" => $d['tipodoc_id'],
	        "documento" => trim( $name_folder ),
	        "documentomd5" => md5( trim( $name_folder ) ),
	        "fecha" => date("Y-m-d H:i:s"),
	        "url" => $d[ 'bs' ],
	        "archivo" => $archivo,
	        "creador" => $usu->getNombres() . " " . $usu->getApellidos(),
	        "anyo" => $ruta['filename'],
	        "cursos" => trim($d['cursos'])
	    );
	    
	    $configrw = json_encode( $configfl );
	    file_put_contents( $filejs , $configrw);
	    
	    $arrDef = array(
	        "url" => $rutaanyoparts . DIRECTORY_SEPARATOR . "config.json"
	    );
	    
	    return $arrDef;
	}
	
	public static function editarPlantillas_Mezclar_Agregar( $d ) {
	    $dt = base64_decode( $d['data'] );
	    $js = json_decode( $dt, true );
	    
	    $estado_id = 1;
	    if (isset( $js[ 'w_estado_id' ] )) {
	        $estado_id = $js[ 'w_estado_id' ];
	    }
	    
	    $alum = array();
	    if ( count( $js['ids'] ) > 0 ) {
	        $cfg = array('estado_id' => $estado_id, "porids" => $js['ids'] ) ;
	        $alum = self::empleados_Helper_ObtenerTodo( $cfg );
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception('[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO .'] editarPlantillas_Mezclar_Agregar: Debe indicar los id de los usuarios');
	    }
	    
	    //die( print_r( $alum , true ) );
	    
	    $rlog = array();
	    foreach ( $alum as $kAlu ) {
	        
	        if ( !isset( $rlog[ $kAlu['documento'] ] ) ) {
	            $d['bind'] = $kAlu;
	            $d['firmar'] = false;
	            $d['modo'] = self::FIRMAS_CERT_MODO_MIX ;
	            
	            $rDt = array();
	            try {
	                $rDt = self::firmaspro_Obtener( $d, $dt );
	            } catch (Exception $e) {
	                throw new Exception( 'editarPlantillas_Mezclar - firmaspro_Obtener: ' . $e->getMessage() );
	            }
	            
	            $rlog[ $kAlu['documento'] ] = true;
	            
	            $rDt['empleados'] = $kAlu['empleados'];
	            $rDt['cursos'] = $kAlu['cursos'];
	            $rDt['tipodoc_id'] = $kAlu['tipodoc_id'];
	            
	            self::editarPlantillas_Mezclar_JS_Agregar( $rDt );
	        }
	        
	    }
	    
	    return self::editarPlantillas_Mezclar_Obtener($d);
	}
	
	public static function editarPlantillas_JBB_Variables_Helper_Obtener( $d ){
	    $params = [ 'soloencabezados' => true ];
	    
	    $prefijos = [
	        'empl' => ['k' =>'empl_'],
	        'vars' => ['k' =>'']
	    ];
	    
	    $js = array();
	    
	    $empl = OperacionesCtrl::empleados_Obtener(['limite' => 1]);
	    if ( count( $empl ) > 0 ) {
	        $js['empl'] = $empl[0];
	    }
	    $js['vars'] = self::editarPlantillas_JBB_Variables_Obtener( $params );
	    
	    $res = array();
	    foreach ($js as $kJs => $vJs ) {
	        
	        foreach ($vJs as $kLs => $vLs) {
	            
	            $label = $kLs;
	            if ( isset( self::LABELS_EMAIL_DESCR[$kLs] )) {
	                $label = self::LABELS_EMAIL_DESCR[$kLs];
	            }
	            if ( isset( $vLs['label'] ) )  {
	                $label = $vLs['label'];
	            }
	            
	            $arrdt = [ 'clave' => '{$' . $kLs . '}', 'label' => $label ];
	            
	            if ( isset( $prefijos[ $kJs ] ) ) {
	                $prex = $prefijos[ $kJs ];
	                $iddef = trim( $prex[ 'k' ] . $kLs );
	                $arrdt = [ 'clave' => '{$' . $iddef . '}', 'label' => $label ];
	            }
	            $res[] = $arrdt;
	        }
	        
	    }
	    
	    return $res;
	}
	
	public static function editarPlantillas_JBB_Variables_Obtener( $d ){
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ];
	    
	    $cargadatos = self::cargadatos_Obtener([]);
	    
	    $bind = self::ObtenerEtiquetasEmail();
	    unset( $bind['logo64'] );
	    
	    $cargasoloheads = false;
	    if ( isset( $d['soloencabezados'] )) {
	        $cargasoloheads = $d['soloencabezados'];
	    }
	    
	    $empleados = array();
	    if ( isset( $d['empleado'] ) ) {
	        $empleados = $d['empleado'];
	        
	        $prefixedKeys = array_map(function($key) { return 'empl_' . $key; }, array_keys($empleados));
	        $nwempl = array_combine($prefixedKeys, array_values($empleados));
	        $nwempl['empl_fullname'] = trim($empleados['nombres'] . ' ' . trim($empleados['apellidos']));
	        
	        $bind += $nwempl;
	        $bind['documento'] = $empleados['documento'];
	    }
	    
	    if ( isset( $d['paquetesrequ'] ) ) {
	        $paquetesrequ = $d['paquetesrequ'];
	        
	        foreach ( $paquetesrequ as $kPaquR ) {
	            $ref = str_replace(
	                ['[', ']'],
	                ['', ''],
	                $kPaquR['ref']
                ) ;
	            if( $kPaquR['paquetereqtipos_id'] == 6 ){
	                $jsonFrm = json_decode( $kPaquR['valor'] , true );
	                $refid = str_replace(
	                    ['[formulario id=', ']'], 
	                    ['',''], 
	                    $kPaquR['ref']
	                );
	                $r_frm = self::formularios_Obtener( ['id' => $refid ] );
	                
	                foreach ( $r_frm as $kFrmIDs ) {
	                    $newRefId = $kFrmIDs['id'];
	                    
	                    $jsfullfrm = array(); // aqui se almacenan las etiquetas y las respuestas del formulario
	                    foreach ( $jsonFrm as $kJsFrm ) {
	                        $tmpval = ( ($kJsFrm['value'] == null) ? "" : trim( $kJsFrm['value'] ) );
	                        if ( $tmpval == "on" ) {
	                            $tmpval = "Si";
	                        }
	                        $valor = $tmpval;
	                        
	                        $bind['frmlbl_' . $newRefId . '_' . $kJsFrm['field'] ] = $kJsFrm['label'];
	                        $bind['frmvlr_' . $newRefId . '_' . $kJsFrm['field'] ] = $valor;
	                        
	                        $jsfullfrm[] = [ 'label' => $kJsFrm['label'], "value" => $valor ];
	                    }
	                    
	                    $bind[ 'formulario_' . $newRefId ] = self::componenteHTML(['solohtml' => false, "html" => "[formulario id=" . $newRefId . " val=" . base64_encode( json_encode( $jsfullfrm ) ) . " ]" ] );
	                }
	            }
	            elseif ( $kPaquR['paquetereqtipos_id'] == 5 ) {
	                $bind['label_' . $ref ] = $kPaquR['ref_label'];
	                $bind['campo_' . $ref ] = $kPaquR['valor'];
	                $bind['campo_fecha_' . $ref ] = date("Y-m-d", strtotime( $kPaquR['valor'] ) );
	                $bind['campo_hora_' . $ref ] = date("H:i:s", strtotime( $kPaquR['valor'] ) );
	            }
	            elseif ( $kPaquR['paquetereqtipos_id'] == 2 ) {
	                $bind['label_' . $ref ] = $kPaquR['ref_label'];
	                $bind['campo_' . $ref ] = ($kPaquR['valor']== 1 ? "Si" : "No");
	            }
	            else {
	                
	                $bind['label_' . $ref ] = $kPaquR['ref_label'];
	                $bind['campo_' . $ref ] = $kPaquR['valor'];
	            }
	        }
	        
	        //die( "d: " . print_r( $bind , true ) );
	    }
	    
	    $res = array();
	    
	    $bs = dirname(dirname(dirname( __FILE__ ))) ;
	    $fld_base = $bs . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . "recursos/cargadatos" . DIRECTORY_SEPARATOR . $c_anyo['id'];
	    foreach(scandir( $fld_base ) as $file ){
	        if( !is_dir($file) )
	        {
	            $fldt = pathinfo( $file );
	            $flParts = trim( $fldt['filename'] );
	            
	            if ( strlen( $flParts ) > 0 && !Utiles::ComienzaEn( $flParts, '~$' ) ) {
	                $opc =['w_nombre' => $flParts,'soloencabezados' => true ];
	                $xls = array();
	                if ( $cargasoloheads ) {
	                    $xls = OperacionesCtrl::empleados_Procesar_Archivos( $opc );
	                    
	                    foreach ( $xls as $kJs ) {
	                        if ( strlen( trim( $kJs['raw'] ) ) > 0 ) {
	                            $res[ $flParts . '_' . $kJs['limpio'] ] = ['label' => "(" . $flParts . ") " . $kJs['raw'] ] ;
	                        }
	                    }
	                }
	                else {
	                    $porbuscar = self::editarPlantillas_Entregar_Parametros( [ 'archivo' => $flParts, 'campos' => $cargadatos, 'valores' => $empleados ] );
	                    $opc = [
	                        'w_nombre' => $flParts,
	                        'buscarpor' => $porbuscar
	                    ];
	                    
	                    $xls = OperacionesCtrl::empleados_Procesar_Archivos( $opc );
	                    if (count( $xls ) > 0 ) {
	                        $r_xls = $xls[ 0 ];
	                        foreach ( $r_xls as $kJs =>  $vJs ) {
	                            $res[ $flParts . '_' . $kJs ] = $vJs;
	                        }
	                    }
	                    
	                }
	                
	            }
	            
	        }
	    }
	    
	    if ( count( $res ) >  0 ) {
	        $bind += $res ;
	    }
	    
	    return $bind;
	}
	
	private static function editarPlantillas_Entregar_Parametros( $d ){
	    $archivo = $d['archivo'];
	    $campos = $d['campos'];
	    $valores = $d['valores'];
	    
	    $res = array();
	    foreach ( $campos as $kCampo ) {
	        if ( $kCampo['nombre'] == $archivo ) {
	            $llaves = json_decode( $kCampo['llaveindice'], true );
	            foreach ($llaves as $kLlave) {
	                $empl_id_nombre = $kLlave['valor'];
	                $valor = $valores[ $kLlave['valor'] ];

	                if ( $empl_id_nombre == 'tipodoc_id') {
	                    $valor = self::TIPODOC_DOS_LETRAS[ $valores[ $kLlave['valor'] ] ];
	                }
	                
	                $res[] = array('campo' => $kLlave['campo'], 'valor' => $valor );
	            }
	        }
	    }
	    
	    return $res;
	}
	
	public static function editarPlantillas_JBB_Mezclar_Crear( $d ){
	    $cfg = OperacionesCtrl::LeerConfigCorp();
	    $_CFG_REQUERIMIENTOS_MEZCLA = json_decode( (isset( $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]) ? $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]["val"] : '[]' ), true );
	    
	    $docs = $d['documentos'];
	    
	    $bind = self::editarPlantillas_JBB_Variables_Obtener( $d );
	    
	    $id_pack = 0;
	    $mesaplica = "1900-01-01 00:00:00";
	    
	    $r = array();
	    foreach ( $docs as $kFlujos ) {
	        if ( isset( $_CFG_REQUERIMIENTOS_MEZCLA[ $kFlujos['flujos_id'] ] ) ) {
	            $tmpMix = $_CFG_REQUERIMIENTOS_MEZCLA[ $kFlujos['flujos_id'] ];
	            
	            $r = array_filter($tmpMix, function($item) {
	                return isset($item['activo']) && $item['activo'] == 1;
	            });
	        }
	        $mesaplica = $kFlujos['mesaplica'];
	        $id_pack = $kFlujos['id'];
	    }
	    $bind['mesaplica'] = $mesaplica;
	    
	    if ( isset( $d['obligaciones'] ) ) {
	        $bind['obligaciones'] = $d['obligaciones'];
	    }
	    
	    $rDt = array();
	    foreach ( $r as $kFlId ) {
	        $flid = preg_replace('/^tpls_/', '', $kFlId['vl'] );
	        $flid_html = $flid . ".html";
	        $dtB64 = [ 
	            'flid' => $flid_html
	        ];
	        
	        $dt = array();
	        
	        $dN = array();
	        $dN['bind'] = $bind;
	        $dN['firmar'] = false;
	        $dN['modo'] = self::FIRMAS_CERT_MODO_MIX ;
	        $dN['data'] = base64_encode( json_encode( $dtB64 ) );
	        $dN['helperfilename'] = $id_pack;
	        
	        $genpdf = "";
	        try {
	            $genpdf = self::firmaspro_Obtener( $dN, $dt );
	        } catch (Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	            throw new Exception( 'editarPlantillas_JBB_Mezclar_Crear - firmaspro_Obtener: ' . $e->getMessage() , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO);
	        }
	        
	        if ( $genpdf !== "" ) {
	            $frmAdd = array();
	            $frmAdd['pdfid'] = $genpdf['bs'];
	            $frmAdd['perfilusuarios_id'] = $bind['empl_perfil_id'];
	            $frmAdd['firmante_id'] = $bind['empl_id'];
	            $frmAdd['nombrefull'] = trim( (string) $bind['empl_nombres'] . ' ' . $bind['empl_apellidos'] );
	            $frmAdd['documento'] = $bind['empl_documento'];
	            $frmAdd['tipodoc'] = $bind['empl_tipodoc_id'];
	            $frmAdd['fecha'] = date('Y-m-d H:i:s');
	            $frmAdd['mail'] = $bind['empl_mail'];
	            
	            $firmas_id = self::firmas_Helper_Agregar( $frmAdd );
	            $firmas_id_data = [
	                'firmas_id' => $firmas_id,
	                'firmasestados_id' => 1,
	                'firmaslog_id' => ''
	            ]; 
	            $genpdf['firmas_id'] = $firmas_id_data;
	        }
	        
	        $rDt[] = $genpdf;
	    }
	    
	    return $rDt;
	}
	
	public static function editarPlantillas_Mezclar_Obtener( $d ) {
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ];
	    
	    $pbase = dirname(dirname(dirname(__FILE__ ))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "certificados" . DIRECTORY_SEPARATOR . $c_anyo['id'] . DIRECTORY_SEPARATOR . self::EDITAR_PLANTILLAS_CFG_NAME ;
	    
	    $js_b64 = base64_encode( "[]" );
	    
	    if( file_exists( $pbase ) ){
	        $js_config = file_get_contents( $pbase );
	        $js_b64 = base64_encode( $js_config );
	    }
	    
	    return $js_b64;
	}
	
	public static function editarPlantillas_Mezclar_Enviar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( 'SubirFotoPerfil: ' . $e->getMessage() );
	    }
	    
	    $atodos = filter_var( isset( $d['atodos'] ) ? $d['atodos'] : false , FILTER_VALIDATE_BOOLEAN);
	    $dt = base64_decode( $d['data'] );
	    $js = json_decode( $dt, true );
	    
	    $estu = array();
	    foreach ($js as $kDt) {
	        $alum = array(
	            "tipodoc_id" => $kDt['tipodoc_id'],
	            "documento" => $kDt['documento']
	        );
	        $url_m = $kDt['url'];
	        
	        $estqry = array();
	        try {
	            $estqry = self::empleados_Obtener($alum);
	        } catch (Exception $e) {
	            $estu[] = array(
	                'res' => array(),
	                'error' => true,
	                'msj' => 'Error enviando a ' . $kDt['tipodoc_id'] . " " . $kDt['documento'] . ": " . $e->getMessage(),
	                'hash' => '',
	                'url' => ''
	            );
	        }
	        
	        if ( count( $estqry ) > 0 ) {
	            if ( $atodos ) {
	                $estu[] = array( 'res' => $estqry, 'error' => false, 'msj' => '', 'hash' => $kDt['hash'], 'url' => $url_m );
	            }
	            else {
	                $primero = true;
	                foreach ( $estqry as $vMain ) {
	                    if ( $primero ) {
	                        if ( $vMain['contact_favorito'] == 1 ) {
	                            $estu[] = array( 'res' => array( $vMain ), 'error' => false, 'msj' => '', 'hash' => $kDt['hash'], 'url' => $url_m );
	                            $primero = false;
	                        }
	                    }
	                }
	            }
	        }

	    }
	    
	    $tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "Certificados_tpl_v1.html");
	    
	    foreach ( $estu as $vEmailDt ) {
	        if ( $vEmailDt['error'] === false ) {
	            $psend = $vEmailDt['res'];
	            $hash = $vEmailDt['hash'];
	            $url = $vEmailDt['url'];
	            
	            foreach ($psend as $vByAcu ) {
	                $replacement_array = self::ObtenerEtiquetasEmail( $vByAcu );
	                $replacement_array['contact_fullname'] = trim( $vByAcu['contact_nombres'] . " " . $vByAcu['contact_apellidos'] );
	                
	                $mensaje = preg_replace_callback(
	                    '~\{\$(.*?)\}~si',
	                    function($match) use ($replacement_array) {
	                        return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	                    },
	                    $tplCode);
	                
	                $titulomsj = "Nuevapp - Certificado #" . $hash;
	                $emOpc = array(
	                    "para" => $vByAcu['contact_mail'],
	                    "titulo" => $titulomsj,
	                    "mensaje" => $mensaje,
	                    "desde" => "notificador@nuevapp.com",
	                    "rotulo" => 'Certificado'
	                );
	                
	                $envio = false;
	                try {
	                    $envio = self::enviarCustomEmail( $emOpc );
	                } catch (Exception $e) {
	                    throw new Exception("editarPlantillas_Mezclar_Enviar - enviarCustomEmail: " . $e->getMessage() . "");
	                }
	                
	                if ( $envio !== false ) {
	                    $cfgComDt = array(
	                        'desde' => $usu->getId(),
	                        'desde_perfil_id' => '3',
	                        'para_id' => $vByAcu['id'],
	                        'perfilusuarios_id' => 4,
	                        'tipomensaje_id' => 1,
	                        'titulo' => 'Certificado de ' . $vByAcu['empleados'],
	                        'mensaje' => $url,
	                        'publicardesde' => date('Y-m-d H:i:s'),
	                        'visible' => 1,
	                        'idmsj' => $hash,
	                        'comunicaciones_id' => 0,
	                        'comunicacionesestados_id' => 3
	                    );
	                    
                        try {
                            self::comunicaciones_Add_Helper( $cfgComDt );
                        } catch (Exception $e) {
                            throw new Exception("editarPlantillas_Mezclar_Enviar - comunicaciones_Add: " . $e->getMessage() . "");
                        }
	                }
	                
	                
	            }
	            
	        }
	    }
	    
	    return $estu;
	}
	
	const COMPONENTES_TAGS = [
	    'anexosqr' => 'anexosqr',
	    'anexosimg' => 'anexosimg',
	    'fecha' => 'fecha',
	    'fechaxls' => 'fechaxls',
	    'valorpordia' => 'valorpordia',
	    'nofactura' => 'nofactura',
	    'formulario' => 'formulario',
	    'fechacontratocompleto' => 'fechacontratocompleto',
	    'moneda' => 'moneda',
	    'flujofinanciero' => 'flujofinanciero',
	    'campofirma' => 'campofirma',
	    'obligaciones' => 'obligaciones',
	    'mesesletras' => 'mesesletras'
	];

	public static function editarPlantillas_CrearComponente( $d ){
	    include_once ( dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'phpspreadsheet_1_23_0' . DIRECTORY_SEPARATOR . '/vendor/autoload.php' );
	    
	    $html = array();
	    $tipo = trim( strtolower( $d['type'] ) );
	    
	    $d['vertodospdf'] = false;
	    
	    $bsanx = "repo/anexos/";
	    
	    $htmlTb = array();
	    $htmlTb[] = '<p>&nbsp;</p>';
	    $htmlTb[] = '<table border="1" cellpadding="1" cellspacing="1" style="border:solid 1px #000000; width:100%">';
	    $htmlTb[] = '    <tbody>';
	    $htmlTb[] = '        <tr>';
	    $htmlTb[] = '            <th style="background-color:#999999; text-align:center">__TITULO__</th>';
	    $htmlTb[] = '        </tr>';
	    $htmlTb[] = '    </tbody>';
	    $htmlTb[] = '</table>';
	    
	    if ( isset( self::COMPONENTES_TAGS[ $tipo ] ) ) {
	        
	        if ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['anexosqr'] ) {
	            include_once ( dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'phpqrcode' . DIRECTORY_SEPARATOR . 'qrlib.php');
	            
	            $ls = self::empleados_ObtenerFilesAjax( $d );
	            $url = Utiles::getBaseUrl() . $bsanx . $d['dc'] . "/";
	            
	            $cols = 3;
	            if ( isset( $d['cols'] ) ) {
	                $cols = $d['cols'];
	            }
	            
	            if ( count( $ls ) > 0 ) {
	                $tmpLbls = str_replace('<p>&nbsp;</p>', '<br pagebreak="true" />', implode( "", $htmlTb ) );
	                $tmpLbls = str_replace('__TITULO__', 'Documentos Adjuntos', $tmpLbls );
	                
	                $html[] = $tmpLbls;
	                $imgqrStr = array();
	                foreach ( $ls as $kAnx => $vAnx ) {
	                    $imgqr = array();

	                    ob_start();
	                    QRcode::png( $url . $vAnx['fl'], null, QR_ECLEVEL_H, 3, 0 );
	                    $qrImage = ob_get_contents();
	                    ob_end_clean();
	                    
	                    $qrBase64 = base64_encode($qrImage);
	                    
	                    $imgqr[]= '<img src="data:image/png;base64,' . $qrBase64 . '" /><br />';
	                    $imgqr[]= "<b>" . $vAnx['lbl'] . "</b>";
	                    
	                    
	                    $imgqrStr[] = implode("", $imgqr);
	                }
	                
	                $totalStrEl = count( $imgqrStr );
	                $filas = ceil( $totalStrEl / $cols );
	                
	                $htmlStr = '<table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">';
	                $index = 0;
	                for ($i = 0; $i < $filas; $i++) {
	                    $htmlStr .= '<tr>';
	                    for ($j = 0; $j < $cols; $j++) {
	                        if ($index < $totalStrEl ) {
	                            $htmlStr .= '<td style="padding: 8px;">' . $imgqrStr[$index] . '</td>';
	                        } else {
	                            $htmlStr .= '<td style="padding: 8px;">&nbsp;</td>';
	                        }
	                        $index++;
	                    }
	                    $htmlStr .= '</tr>';
	                }
	                $htmlStr .= '</table><br>';
	                
	                $html[] = $htmlStr ;
	            }
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['anexosimg'] ) {
	            
	            $ls = self::empleados_ObtenerFilesAjax( $d );
	            $rdt = dirname(dirname(dirname(__FILE__))) . "/" . $bsanx . $d['dc'] . "/";
	            $url = Utiles::getBaseUrl() . $bsanx . $d['dc'] . "/";
	            
	            if ( count( $ls ) > 0 ) {
	                
	                $tmpLbls = str_replace('<p>&nbsp;</p>', '<br pagebreak="true" />', implode( "", $htmlTb ) );
	                $tmpLbls = str_replace('__TITULO__', 'Documentos Adjuntos', $tmpLbls );
	                
	                $html[] = $tmpLbls;
	                $imgqr = array();
	                $segundo = false;
	                foreach ( $ls as $kAnx => $vAnx ) {
	                    
	                    $imagenBase64 = base64_encode( file_get_contents( $rdt . $vAnx['fl'] ) );
	                    
	                    if ( $segundo ) {
	                        $imgqr[]= '<br pagebreak="true" />';
	                    }
	                    
	                    $imgqr[]= "<b>" . $vAnx['lbl'] . "</b>";
	                    $imgqr[]= "<br>";
	                    $imgqr[]= '<img src="data:image/jpeg;base64,' . $imagenBase64 . '" width="800" />';
	                    $imgqr[]= "<br>";
	                    $imgqr[]= '<a href="' . $url . $vAnx['fl'] . '" target="pdfnewlink">' . $url . $vAnx['fl'] . '</a>';
	                    
	                    $segundo = true;
	                }
	                $html[] = implode('', $imgqr) ;
	            }
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['fechaxls'] ) {
	            $html[] = self::editarPlantillas_Componente_EsMesDeInicio( $d );
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['fecha'] ) {
	            $formato = 'Y-m-d';
	            $valor = $d['valor'];
	            if ( isset( $d['formato'] ) ) {
	                $formato = $d['formato'];
	            }
	            if (isset( $d['esexcel'] ) ) {
	                if( $d['esexcel'] ){
	                   $valor = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['valor'] )->format( $formato );
	                }
	            }
	            
	            $valor = date( $formato , strtotime( $valor ) );
	            
	            $html[] = trim($valor);
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['mesesletras'] ) {
	            $mes = intval( $d['mes'] );
	            $meses_es = [
	                1 => "enero",
	                2 => "febrero",
	                3 => "marzo",
	                4 => "abril",
	                5 => "mayo",
	                6 => "junio",
	                7 => "julio",
	                8 => "agosto",
	                9 => "septiembre",
	                10 => "octubre",
	                11 => "noviembre",
	                12 => "diciembre"
	            ];
	            return $meses_es[ $mes ];
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['fechacontratocompleto'] ) {
	            
	            $fechaInicio = $d['fechainibogdata'];
	            if ( isset( $d['esexcel'] ) ) {
	                if ( $d['esexcel']  ) {
	                    $fechaInicio = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechainibogdata'] )->format('Y-m-d');
	                }
	            }
	            try {
	                $fechafinal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechafinalbogdata'] )->format('Y-m-d');
	            } catch (Exception $e) {
	                throw new Exception('fechacontratocompleto: ' . $e->getMessage(), $e->getCode());
	            }
	            
	            
	            $fecha = new DateTime( $fechaInicio );
	            $primerDia = new DateTime($fecha->format("Y-m-01"));
	            
	            $diferencia = $primerDia->diff($fecha);
	            $dias = $diferencia->days;
	            
	            $fechaFinal = new DateTime( $fechafinal );
	            $fechaFinal->add(new DateInterval("P{$dias}D"));
	            
	            $html[] = $fechaFinal->format("Y-m-d");
	            
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['valorpordia'] ) {
	            //$fechaInicio = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechainibogdata'] )->format('Y-m-d');
	            try {
	                $fechafinal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechafinalbogdata'] )->format('Y-m-d');
	            } catch (Exception $e) {
	                throw new Exception('fechacontratocompleto: ' . $e->getMessage(), $e->getCode());
	            }
	            $fechaInicio = $d['fechainibogdata'];
	            
	            $dDt = [
	                'valorContrato' => $d['valortotal'],
	                'fechaInicio' => $fechaInicio,
	                'fechaFin' => $fechafinal,
	                'mesCobro' => date("Y-m", strtotime( $d['mesaplica'] ) ),
	                'meses' => $d['meses'],
	                'dias' => $d['dias']
	            ];
	            
	            if ( isset( $d['descuentos'] ) ) {
	                $dDt['descuentos'] = $d['descuentos'];
	            }
	            if ( isset( $d['salud'] ) || isset( $d['pension'] ) || isset( $d['totalaportes'] ) ) {
	                $dDt['raw'] = true;
	            }

	            $pago = self::editarPlantillas_CalcularPagoMensual( $dDt );
	            
	            $res = $pago['pago'];
	            
	            /*
	             * @yalfonso
	             * TODO: Tarea 13 - Agregar soporte para registrar el valor de la cuenta de cobro y el mes en que se solicita
	             */ 
	            if ( isset( $d['datosmes'] ) ) {
	                if ( $d['datosmes'] ) {
	                    if ( isset( $d['contrato'] ) && isset( $d['empleados_id'] ) ) {
	                        $dtmData = [
	                            'contrato' => $d['contrato'],
	                            'empleados_id' => $d['empleados_id'],
	                            'mesaplica' => $d['mesaplica'],
	                            'valorccobro' => $res
                            ];
	                        try {
	                            self::datosmes_Helper_Agregar( $dtmData );
	                        } catch (Exception $e) {
	                            throw new Exception( 'editarPlantillas_CrearComponente - valorpordia - datosmes_Helper_Agregar: ' . $e->getMessage(), $e->getCode() );
	                        }
	                    }
	                    else {
	                        throw new Exception( 'editarPlantillas_CrearComponente - valorpordia - datosmes_Helper_Agregar: Los campos mesaplica, contrato o empleados_id no est&aacute;n llenos', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	                    }
	                }
	            }
	            
	            if ( isset( $d['letras'] ) ) {
	                if( $d['letras'] ){
	                    $res = $pago['letras'];
	                }
	            }
	            if ( isset( $d['verdias'] ) ) {
	                if( $d['verdias'] ){
	                    $res = $pago['dias'];
	                }
	            }
	            if ( isset( $d['completo'] ) ) {
	                if( $d['completo'] ){
	                    $res = $pago['completo'];
	                }
	            }
	            if ( isset( $d['salud'] ) ) {
	                if( $d['salud'] ){
	                    $opcAportes = $d;
	                    $opcAportes['salario'] = $pago['pago'];
	                    $aportes = self::editarPlantillas_CalcularAportesIndependiente( $opcAportes );
	                    $res = $aportes[ 'salud' ];
	                }
	            }
	            if ( isset( $d['pension'] ) ) {
	                if( $d['pension'] ){
	                    $opcAportes = $d;
	                    $opcAportes['salario'] = $pago['pago'];
	                    $aportes = self::editarPlantillas_CalcularAportesIndependiente( $opcAportes );
	                    $res = $aportes[ 'pension' ];
	                }
	            }
	            if ( isset( $d['totalaportes'] ) ) {
	                if( $d['totalaportes'] ){
	                    $opcAportes = $d;
	                    $opcAportes['salario'] = $pago['pago'];
	                    $aportes = self::editarPlantillas_CalcularAportesIndependiente( $opcAportes );
	                    $res = $aportes[ 'total' ];
	                }
	            }
	            
	            $html[] = $res;
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['nofactura'] ) {
	            try {
	                $fechaInicioTmp = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechainibogdata'] )->format('Y-m-d');
	            } catch (Exception $e) {
	                throw new Exception('nofactura - fechaInicioTmp: ' . $e->getMessage(), $e->getCode());
	            }
	            try {
	                $fechafinal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechafinalbogdata'] )->format('Y-m-d');
	            } catch (Exception $e) {
	                throw new Exception('nofactura - fechafinal: ' . $e->getMessage(), $e->getCode());
	            }
	            
	            $dDt = [
	                'fechaInicio' => $fechaInicioTmp,
	                'fechaFin' => $fechafinal,
	                'mesCobro' => date("Y-m", strtotime( $d['mesaplica'] ) )
	            ];
	            
	            $fechaInicio = new DateTime($dDt['fechaInicio']);
	            $mesCobro = DateTime::createFromFormat('Y-m', $dDt['mesCobro']);
	            
	            $diff = ($mesCobro->format('Y') - $fechaInicio->format('Y')) * 12;
	            $diff += ($mesCobro->format('m') - $fechaInicio->format('m'));
	            
	            $html[] = $diff + 1;
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['formulario'] ) {
	            
	            $val = [];
	            foreach ( $d as $k => $v ) {
	                if ( $k == "val" ) {
	                    $val = json_decode( base64_decode( $v ) , true );
	                }
	            }
	            
	            $txt = [];
	            $txt[] = '<table border="1" cellpadding="1" cellspacing="1" style="width:100%"> ';
	            $txt[] = ' <tbody>';
	            foreach ( $val as $kDt ) {
	                $limpiar = trim($kDt['label']);
	                
	                $txt[] = ' <tr>';
	                $txt[] = '     <th style="width:50%"><strong>' . $limpiar . '</strong></th>';
	                $txt[] = '     <td style="width:50%">' . $kDt['value'] . '</td>';
	                $txt[] = ' </tr>';
	            }
	            $txt[] = ' </tbody>';
	            $txt[] = '</table > ';
                
	            $html[] = implode("", $txt);
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['moneda'] ) {
	            $html[] = self::editarPlantillas_Moneda($d);
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['flujofinanciero'] ) { 
	            $crp = $d['crp'];
	            $fondos = $d['fondos'];
	            $fondosdesc = $d['fondosdesc'];
	            $rubro = $d['rubro'];
	            $rubrodesc = $d['rubrodesc'];
	            $tiporegistro = $d['tiporegistro'];
	            $mesaplica = $d['mesaplica'];
	            $meses = $d['meses'];
	            $dias = $d['dias'];
	             
	            $valorContrato = $d['valortotal'];
	            //$inicioContrato = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechainibogdata'] )->format('Y-m-d');
	            $inicioContrato = $d['fechainibogdata'];
	            try {
	                $finContrato = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechafinalbogdata'] )->format('Y-m-d');
	            } catch (Exception $e) {
	                throw new Exception('flujofinanciero - finContrato: ' . $e->getMessage(), $e->getCode());
	            }
	            
	            $mesCobro = date("Y-m", strtotime( $inicioContrato ) ) ;
	            
	            $dDt = [
	                'valorContrato' => $valorContrato,
	                'fechaInicio' => $inicioContrato,
	                'fechaFin' => $finContrato,
	                'mesCobro' => $mesCobro,
	                'meses' => $meses,
	                'dias' => $dias,
	                'raw' => true,
	                'debug' => false
	            ];
	            $valini = self::editarPlantillas_CalcularPagoMensual( $dDt );
	            
	            $calc = array();
	            $calc[] = [ 'comprometido' => $valorContrato, 'pagar' => $valini['pago'], 'ejecutado' => $valini['pago'], 'porejecutado' => $valorContrato - $valini['pago'] ];
	            for ($i = 1; $i < $meses; $i++) {
	                $fechaac = new DateTime( $mesCobro . "-01" );
	                $fechaac->modify("+" . $i . " months");
	                
	                $dDt['mesCobro'] = $fechaac->format("Y-m") ;
	                $dDt['raw'] = true ;
	                
	                $val = self::editarPlantillas_CalcularPagoMensual( $dDt );
	                $valpago = $val['pago'];
	                
	                $_ejecutado = $calc[ $i - 1 ]['ejecutado'] + $valpago;
	                $_porejecutar = $calc[ $i - 1 ]['porejecutado'] - $valpago;
	                
	                $calc[] = [ 'comprometido' => $valorContrato, 'pagar' => $valpago, 'ejecutado' => $_ejecutado, 'porejecutado' => $_porejecutar ];
	            }
	            
	            $tbCont = array();
	            $sobrante = 0;
	            $vcomprometido = 0;
	            $vejecutado = 0;
	            $noInf = 0;
	            foreach ( $calc as $kCalc => $vCalc ) {
	                $tbCont[] = '      <tr>';
	                $tbCont[] = '          <td>' . $crp . '</td>';
	                $tbCont[] = '          <td>' . $fondos . " - " . $fondosdesc . '</td>';
	                $tbCont[] = '          <td>' . $tiporegistro . '</td>';
	                $tbCont[] = '          <td>' . $rubro . " - " . $rubrodesc . '</td>';
	                $tbCont[] = '          <td>' . ($kCalc + 1) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' => $vCalc['comprometido'] ]) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' =>$vCalc['pagar'] ]) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' =>$vCalc['ejecutado'] ]) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' =>$vCalc['porejecutado'] ]) . '</td>';
	                $tbCont[] = '      </tr>';
	                
	                $vcomprometido = $vCalc['comprometido'];
	                $vejecutado = $vCalc['ejecutado'];
	                $sobrante = $vCalc['porejecutado'];
	                $noInf = ($kCalc + 1);
	            }
	            if ( $sobrante > 0 ) {
	                $tbCont[] = '      <tr>';
	                $tbCont[] = '          <td>' . $crp . '</td>';
	                $tbCont[] = '          <td>' . $fondos . " - " . $fondosdesc . '</td>';
	                $tbCont[] = '          <td>' . $tiporegistro . '</td>';
	                $tbCont[] = '          <td>' . $rubro . " - " . $rubrodesc . '</td>';
	                $tbCont[] = '          <td>' . ($noInf + 1) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' => $vcomprometido ]) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' => $sobrante ]) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' => $vejecutado + $sobrante ]) . '</td>';
	                $tbCont[] = '          <td>$ ' . self::editarPlantillas_Moneda( [ 'valor' => 0 ]) . '</td>';
	                $tbCont[] = '      </tr>';
	            }
	            
	            $tbhtml = array();
	            $tbhtml[] = '<table border="1" cellpadding="1" cellspacing="1" style="width:100%; font-size: 11px;">';
	            $tbhtml[] = '  <thead>';
	            $tbhtml[] = '      <tr> ';
	            $tbhtml[] = '          <th>CRP</th>';
	            $tbhtml[] = '          <th>Fuente</th>';
	            $tbhtml[] = '          <th>Tipo de registro</th>';
	            $tbhtml[] = '          <th>RUBRO</th>';
	            $tbhtml[] = '          <th>Informe</th>';
	            $tbhtml[] = '          <th>Valor comprometido</th>';
	            $tbhtml[] = '          <th>Valor a pagar</th>';
	            $tbhtml[] = '          <th>Valor ejecutado</th>';
	            $tbhtml[] = '          <th>Saldo por ejecutar</th>';
	            $tbhtml[] = '      </tr> ';
	            $tbhtml[] = '  </thead> ';
	            $tbhtml[] = '  <tbody> ';
	            $tbhtml[] = implode("", $tbCont);
	            $tbhtml[] = '  </tbody> ';
	            $tbhtml[] = '</table>';
	            
	            $html[] = implode("", $tbhtml);
	        }
	        elseif ( self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['campofirma'] ) {
	            $txt = array();
	            $txt[] = '<span style="color: #FFFFFF; font-size: 12pt;">' . $d['valor'] . '</span><br />';
	            $txt[] = '<span style="font-size: 45pt;">&nbsp;</span>';
	            
	            $html[] = implode("", $txt);
	        }
	        elseif (self::COMPONENTES_TAGS[ $tipo ] == self::COMPONENTES_TAGS['obligaciones'] ) {
	            $tbhtml = [];
	            if ( isset( $d['data'] )) {
	                $b64 = base64_decode( $d['data'] );
	                $json = json_decode( $b64  , true );
	                //die( 'rev: ' . print_r( $json, true ) );
	                $tbCont = [];
	                $i = 1;
	                foreach ( $json as $kJs ) {
	                    $tbCont[] = '<tr>';
	                    $tbCont[] = '  <td style="width: 10%;">' . $i . '</td>';
	                    $tbCont[] = '  <td style="width: 45%;">' . $kJs['descripcion'] . '</td>';
	                    $tbCont[] = '  <td style="width: 45%;">' . $kJs['valor'] . '</td>';
	                    $tbCont[] = '</tr>';
	                    $i++;
	                }
	               
	                $tbhtml[] = '<table border="1" cellpadding="1" cellspacing="1" style="width:100%;">';
	                $tbhtml[] = '  <thead>';
	                $tbhtml[] = '      <tr> ';
	                $tbhtml[] = '          <th style="width: 10%;"><strong>Nro.</strong></th>';
	                $tbhtml[] = '          <th style="width: 45%;"><strong>Obligaci&oacute;n</strong></th>';
	                $tbhtml[] = '          <th style="width: 45%;"><strong>Informe</strong></th>';
	                $tbhtml[] = '      </tr> ';
	                $tbhtml[] = '  </thead> ';
	                $tbhtml[] = '  <tbody> ';
	                $tbhtml[] = implode("", $tbCont);
	                $tbhtml[] = '  </tbody> ';
	                $tbhtml[] = '</table>';
	            }
	            $html[] = implode("", $tbhtml);
	        }
	    }
	    
	    //return json_encode( $d , JSON_UNESCAPED_SLASHES);
	    return implode("", $html);
	}
	private static function editarPlantillas_Moneda( $d ) {
	    $valor = $d['valor'];
	    $decimalseparado = ",";
	    if (isset( $d['decimalseparado'] ) ) {
	        $decimalseparado = $d['decimalseparado'];
	    }
	    $centenseperador = ".";
	    if (isset( $d['centenseperador'] ) ) {
	        $centenseperador = $d['centenseperador'];
	    }
	    $decimales = 0;
	    if (isset( $d['decimales'] ) ) {
	        $decimales = $d['decimales'];
	    }
	    
	    $def = number_format( $valor, $decimales, $decimalseparado, $centenseperador);
	    
	    return $def;
	}
	private static function editarPlantillas_CalcularPagoMensual( $d ) {
	    $valorContrato = $d['valorContrato'];
	    $inicioContrato = $d['fechaInicio'];
	    $mesCobro = $d['mesCobro'];
	    
	    $inicio = new DateTime($inicioContrato);
	    $inicioMes = new DateTime($mesCobro . '-01');
	    
	    $meses = $d['meses'];
	    $dias = $d['dias'];
	    
	    $nw_totaldias = ($meses * 30) + $dias;
	    $nw_valordia = $valorContrato / $nw_totaldias;
	    
	    $diauno = intval( $inicio->format('d') );
	    $diasTrabajados = 30 ;
	    if ($inicioMes->format('Y-m') == $inicio->format('Y-m')) {
	        $diasTrabajados = 30 - ($diauno - 1);
	    }
	    
	    $pagoestemes = round( $diasTrabajados * $nw_valordia );
	    
	    if ( isset($d['descuentos']) ) {
	        if ( $d['descuentos'] == false  ) {
	            $diasTrabajados = 30;
            }
	    }
	    
	    $mesCompleto = ($diasTrabajados == 30);
	    $pagoround = round($pagoestemes, 0);
	    
	    $formatter = new Luecano\NumeroALetras\NumeroALetras();
	    
	    $dOpc = $d;
	    $dOpc['valor'] = $pagoround ;
	    
	    $defPago = self::editarPlantillas_Moneda($dOpc);
	    if (isset( $d['raw'] ) ) {
	        $defPago = $pagoround ;
	    }
	    
	    if ( isset( $d['debug'] ) ) {
	        if( $d['debug'] ) {
	           die( 'fin sss' );
	        }
	    }
	    
	    return [
	        'completo' => $mesCompleto,
	        'dias' => $diasTrabajados,
	        'pago' => $defPago,
	        'letras' => $formatter->toWords($pagoround, 0)
	    ];
	}
	private static function editarPlantillas_Componente_EsMesDeInicio( $d ) {
	    $mesaplica = date("Y-m-d", strtotime( $d['mesaplica'] ) );
	    $mesaplicam = date("m", strtotime( $mesaplica ) );
	    try {
	        $fechabogdata = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $d['fechainibogdata'] );
	    } catch (Exception $e) {
	        throw new Exception('editarPlantillas_Componente_EsMesDeInicio: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    $formato = 'Y-m-d';
	    if ( isset( $d['formato'] ) ) {
	        $formato = $d['formato'];
	    }
	    $xlsmes = date('m', strtotime( $fechabogdata->format( $formato ) ) );
	    
	    $def = $mesaplica;
	    if ( $mesaplicam == $xlsmes ) {
	        $def = $fechabogdata->format( $formato );
	    }
	    
	    return $def;
	}
	private static function editarPlantillas_Componente_EsMesCompleto($fechaInicio, $fechaFin) {
	    $inicio = new DateTime($fechaInicio);
	    $fin = new DateTime($fechaFin);
	    
	    $diasEntre = $inicio->diff($fin)->days + 1;
	    
	    $resultado = [
	        'completo' => false,
	        'dias' => $diasEntre
	    ];
	    
	    if ($inicio->format('Y-m') !== $fin->format('Y-m')) { return $resultado; }
	    if ($inicio->format('d') !== '01') { return $resultado; }
	    $ultimoDia = (clone $inicio)->modify('last day of this month');
	    if ($fin->format('Y-m-d') !== $ultimoDia->format('Y-m-d')) { return $resultado; }
	    
	    $resultado['completo'] = true;
	    $resultado['dias'] = (int) $ultimoDia->format('d');
	    
	    return $resultado;
	}
	private static function editarPlantillas_CalcularAportesIndependiente( $d ) {
	    
	        $salario = $d["salario"];
	        $tarifasARL = [
	            1 => 0.00522, // Clase I: 0.522%
	            2 => 0.01044, // Clase II: 1.044%
	            3 => 0.02436, // Clase III: 2.436%
	            4 => 0.04350, // Clase IV: 4.350%
	            5 => 0.06960  // Clase V: 6.960%
	        ];
	        
	        $claseARL = 0;
	        if ( isset($d["clasearl"]) ) {
	            $claseARL = $tarifasARL[ $d["clasearl"] ] ;
	        }
	        $porcentajeSalud = 0.125;
	        if ( isset($d["porcentajesalud"]) ) {
	            $porcentajeSalud = $d["porcentajesalud"];
	        }
	        $porcentajePension = 0.16;
	        if ( isset( $d["porcentajepension"] ) ) {
	            $porcentajePension = $d["porcentajepension"];
	        }
	        $porcentajeCCF = 0.0;
	        if ( isset( $d["porcentajeccf"] ) ) {
	            $porcentajeCCF = $d["porcentajeccf"];
	        }
	        $porcentajeSolidaridadBase = 0.01;
	        if ( isset( $d["porcentajesolidaridadbase"] ) ) {
	            $porcentajeSolidaridadBase = 0.01;
	        }
	        
	        $smmlv = 1423500;
	        
	        $ibcCalculado = $salario * 0.40;
	        $ibc = max($ibcCalculado, $smmlv);
	        
	        $aporteSalud = $ibc * $porcentajeSalud;
	        
	        $aportePension = $ibc * $porcentajePension;
	        
	        $porcentajeARL = $tarifasARL[$claseARL] ?? 0.0;
	        $aporteARL = $ibc * $porcentajeARL;
	        
	        $aporteCCF = $ibc * $porcentajeCCF;
	        
	        $aporteSolidaridad = 0.0;
	        if ($ibc > ($smmlv * 4)) {
	            $aporteSolidaridad = $ibc * $porcentajeSolidaridadBase;
	        }
	        
	        $total = $aporteSalud + $aportePension + $aporteARL + $aporteCCF + $aporteSolidaridad;
	        
	        return [
	            'ibc'         => round($ibc, 2),
	            'salud'       => round($aporteSalud, 2),
	            'pension'     => round($aportePension, 2),
	            'arl'         => round($aporteARL, 2),
	            'ccf'         => round($aporteCCF, 2),
	            'solidaridad' => round($aporteSolidaridad, 2),
	            'total'       => round($total, 2),
	        ];
	}
	
	// EditorPlantillas FIN
	
	// Firmaspro INI
	const FIRMASPRO_TXT_PREV = "Documento de previsualizaci&oacute;n";
	const FIRMASPRO_TXT_PEND = "Documento pendiente por firmar";
	const FIRMASPRO_TXT_FIRM = "Documento Firmado Exitosamente";
	public static function firmaspro_Helper_Obtener( $d ){
	    self::authRequOff();
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    /*
	    $proc = $json[ 'proc' ];
	    
	    $resFir = array();
	    
	    $acueQr = null;
	    try {
	        $acueQr = self::Empleadoacudiente_Obtener( array( 'empleados_id' => $json['estid'] ) );
	    } catch (Exception $e) {
	        throw new Exception('firmaspro_Helper_Obtener - Empleadoacudiente_Obtener: ' . $e->getMessage() );
	    }
	    
	    if ( count( $acueQr ) > 0 ) {
	        $acu = array();
	        foreach ( $acueQr as $vAcu ) {
	            if ( $json['acuid'] == $vAcu['acudientes_id'] ) {
	                $acu = $vAcu;
	            }
	        }
	        
	        $flog = array( 'w_empleados_id' => $acu[ 'empleados_id' ], 'w_acudientes_id' => $acu['acudientes_id'], 'w_pdfid' => trim( $json['flid'] ) );
	        $fir = array();
	        try {
	            $fir = self::firmaslog_Obtener( $flog );
	        } catch (Exception $e) {
	            throw new Exception('firmaspro_Helper_Obtener - firmaslog_Obtener: '  . $e->getMessage() );
	        }
	        
	        $urldt = array();
	        
	        $revC = false;
	        $firC = false;
	        if ( count( $fir ) > 0 ) {
	            foreach ( $fir as $vFir ) {
	                $flogID = $vFir['firmaid'];
	                if ( $vFir['firmasestados_id'] == 1 ) {
	                    $revC = true;
	                    $urldt['rev'] = $vFir;
	                }
	                if ( $vFir['firmasestados_id'] == 2 ) {
	                    $firC = true;
	                    $urldt['fir'] = $vFir;
	                }
	            }
	        }
	        
	        $estado_posible = 1;
	        if ( $proc == md5( self::FIRMAS_PROC_FIR ) ) {
	            if ( $revC ) {
	                if ( !$firC ) {
	                    $estado_posible = 2;
	                }
	                else{
	                    throw new Exception('firmaspro_Helper_Obtener: Documento ya ha sido firmado');
	                }
	            }
	            else{
	                throw new Exception('firmaspro_Helper_Obtener: El documento debe revisarse primero');
	            }
	        }
	        elseif ( $proc == md5( self::FIRMAS_PROC_REV ) ) {
	            if ( $firC ) {
	                $_f = $urldt['fir'];
	                return array('url' => $_f['pdfurl'], 'bs' => $_f['pdfruta']);
	            }
	            else {
	                if ( $revC ) {
	                    $_r = $urldt['rev'];
	                    return array('url' => $_r['pdfurl'], 'bs' => $_r['pdfruta']);
	                }
	            }
	        }
	        
	        $dt = array();
	        
	        $d['bind'] = $acu;
	        if ( $proc == md5( self::FIRMAS_PROC_FIR ) ) {
	            if ( !$firC ) {
	                $d['firmar'] = true;
	                $d['flogid'] = $flogID;
	                
	                $_cer = "";
	                try {
	                    $_cer = self::firmaspro_MkCert( $acu );
	                } catch (Exception $e) {
	                    throw new Exception( 'firmaspro_Helper_Obtener - firmaspro_MkCert: ' . $e->getMessage() );
	                }
	                
	                $d['cer'] = $_cer;
	            }
	        }
	        $resFir = self::firmaspro_Obtener( $d, $dt );
	        
	        $dt['pdf'] = $resFir;
	        $dt['estado_id'] = $estado_posible;
	        if ( $estado_posible == 2) {
	            $dt['flogid'] = $flogID;
	        }
	        
	        try {
	            self::firmas_Helper_Agregar( $dt );
	        } catch (Exception $e) {
	            throw new Exception( 'firmaspro_Helper_Obtener - firmas_Helper_Agregar: ' . $e->getMessage() );
	        }
	        
	    }
	    else{
	        http_response_code( IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	        throw new Exception( 'firmaspro_Helper_Obtener: no hay datos del firmante');
	    }
	    
	    return $resFir;
	    */
	}
	
	const FIRMASPRO_CARPETAS = array(
	    'proceso' => 'proc'
	);
	public static function firmaspro_Helper_FirmarDoc( $d ){
	    date_default_timezone_set('America/Bogota');
	    self::authRequOff();
	    
	    include_once dirname(dirname(__FILE__)) . "/libs/setasign/SetAsign_Manage.php";
	    include_once dirname(dirname(__FILE__)) . "/libs/setasign/PdfTextLocator.php";
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $udata = base64_decode( $d[ 'u' ] );
	    $u = json_decode( $udata, true );
	    
	    $tipousuario = $json['tipousuario'];
	    $fldcampo = $json['fldcampo'];
	    
	    $usr = array();
	    if ( $tipousuario == self::FIRMASPRO_TIPOUSUARIO_CONTRATISTA ) {
	        $dtUsr = self::empleados_Helper_Obtener(['w_id_md5' => $u['id'] ]);
	        $usr = $dtUsr[0];
	    }
	    elseif ( $tipousuario == self::FIRMASPRO_TIPOUSUARIO_ADMIN ) {
	        self::$AUTH_ACTIVE = true;
	        $usu = self::authRequ();
	        
	        $tipodoc_id = $usu->getTipodoc_id();
	        
	        $tps = self::tipodoc_Obtener( ['id' => $tipodoc_id ] );
	        
	        $usr['documento'] = $usu->getDocumento();
	        $usr['tipodoc_id'] = $tipodoc_id;
	        $usr['id'] = $usu->getId();
	        $usr['clave'] = $usu->getClave();
	        $usr['usuario'] = $usu->getUsuario();
	        $usr['nombres'] = $usu->getNombres();
	        $usr['apellidos'] = $usu->getApellidos();
	        $usr['tipodoc'] = $tps[0]['nombre'];
	        $usr['perfil_id'] = $usu->getPerfil_id();
	        
	        $u = [];
	        $u['fullname'] = trim((string)$usu->getNombres() . " " . $usu->getApellidos());

	    }
	    $documento = $usr['documento'];
	    $tipodoc_id = $usr['tipodoc_id'];
	    $usuario_id = $usr['id'];
	    $clave = $usr['clave'];
	    
	    $bs = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . "usuarios";
	    $bs_tipousr = $bs . DIRECTORY_SEPARATOR . $json['tipousuario'];
	    $bs_tipousr_usr = $bs_tipousr . DIRECTORY_SEPARATOR . $tipodoc_id . '_' . $documento;
	    $flp12 = $bs_tipousr_usr . DIRECTORY_SEPARATOR . self::FIRMASPRO_NOMBRE_P12;
	    
	    if ( file_exists( $flp12 ) ) {
	        $bs = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
	        
	        $fldtipo = self::FIRMASPRO_CARPETAS[ $json['fldtipo'] ];
	        $url = explode( $fldtipo, $json['documento'] );
	        
	        $pdfid = Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . $fldtipo . $url[ 1 ];
	        $flinput = $bs . $pdfid;
	        
	        $pfl = pathinfo($flinput);
	        $floutput = $pfl['dirname'] . DIRECTORY_SEPARATOR . rtrim( (string ) $pfl['filename'], "_fir.") . '_fir.' . $pfl['extension'];
	        
	        $firmas_id = 0;
	        $qryFirmas = self::firmaslog_Obtener( [ 'w_pdfid' => $pdfid ] );
	        foreach ( $qryFirmas as $kFirId ) {
	            $firmas_id = $kFirId['firmas_id'];
	        }
	        
	        $saliQr = $pfl['dirname'] . DIRECTORY_SEPARATOR . 'qr_' . $pfl['filename'] . '_fir.png';
	        $rQr = self::firmaspro_MkQR( array('qr' => $saliQr, 'data' => rtrim( Utiles::getBaseUrl(), "/" ) . "/index.php/Revisar/" . md5( $firmas_id ) . "" . '?_=' . date('YmdHis') , 'jpg' => false ) );
	        
	        $locator = new PdfTextLocator();
	        $locator->setSearchTerms( [ $fldcampo ] );
	        $firmaOpcs = $locator->findInPdf( $flinput );
	        
	        /*
	        echo "Busca: " . $fldcampo . "\n";
	        die( "firmaOpcs: " . print_r($firmaOpcs, true ) );
	        */
	        
	        $resFir = "";
	        $paginas = 0;
	        foreach ($firmaOpcs as $kFir ) {
	            $pass = md5( $tipousuario . '' . $documento . '' . $tipodoc_id . '' . $usuario_id . '' . $clave );
	            
	            // Si existe el archivo _fir
	            if ( file_exists( $floutput ) ) {
	                // Entonces se usa como input, por q se va a validar
	                // campos y todo lo que tenga para que no vuelve a ser firmado
	                // por la misma persona
	                $flinput = $floutput;
	            }
	            
	            $kFir['entrada'] = $flinput;
	            $kFir['salida'] = $floutput;
	            $kFir['clave'] = $pass;
	            $kFir['img'] = $rQr;
	            $kFir['nombrecampo'] = $usr['perfil_id'] . '_' . $usr['usuario'];
	            
	            if ( isset( $json['razon'] ) ) {
	                $kFir['razon'] = $json['razon'];
	            }
	            
	            $sam = new SetAsign_Manage();
	            $sam->setP12( $flp12 );
	            
	            $campos = $sam->obtenerCampos( $flinput );
	            $paginas = $sam->obtenerTotalPaginas( $kFir );
	            
	            $nuevafirma = true;
	            if ( count( $campos ) > 0 ) {
	                foreach ($campos as $kCampo ) {
	                    if ( $kFir['nombrecampo'] == $kCampo ) {
	                        $nuevafirma = false;
	                    }
	                }
	            }
	            
	            if( $nuevafirma ){
	                try {
	                    $resFir = $sam->firmarIncremental( $kFir );
	                } catch (Exception $e) {
	                    http_response_code( $e->getCode() );
	                    return self::retorno([], $e->getCode(), $e->getMessage() );
	                }
	                
	            }
	            else {
	                http_response_code( IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	                return self::retorno( [], IndexCtrl::ERR_COD_REGISTRO_EXISTENTE, 'El usuario ' . $u['fullname'] . ' ya firm&oacute; el documento' );
	            }
	            
	        }
	        
	        if ( $resFir !== "" ) {
	            $qryUni = [ 'w_pdfid' => $pdfid ];
	            
	            $pdfFir = self::firmaslog_Obtener( $qryUni );
	            
	            if ( count( $pdfFir ) > 0 ) {
	                $firId = $pdfFir[0];
	                $nwlog = [
	                    'flogid' => $firId['firmas_id'],
	                    'firmasestados_id' => 2,
	                    'pdf' => ['bs' => $pdfid, 'url' => rtrim( Utiles::getBaseUrl(), "/" ) . '/' . $pdfid ],
	                    'paginas' => $paginas,
	                    'fecha' => date('Y-m-d H:i:s'),
	                    'perfilusuarios_id' => $usr['perfil_id'],
	                    'nombrefull' => trim((string)$usr['nombres'] . ' ' . $usr['apellidos']),
	                    'tipodoc' => $usr['tipodoc'],
	                    'documento' => $usr['documento']
	                ];
	                self::firmas_Helper_Agregar( $nwlog );
	            }
	        }
	        
	        return self::retorno( [ 'bs' => $resFir ], 0, '' );
	    }
	    else {
	        http_response_code(IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA);
	        return self::retorno([], IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA, 'El certificado ' . $flp12 . ' no existe' );
	    }
	    
	    return self::retorno([], IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA, 'Null = ' . $json['documento'] );
	    
	}
	
	const FIRMASPRO_EVENTO_REVISION = "1";
	const FIRMASPRO_EVENTO_FIRMAR = "2";
	const FIRMASPRO_EVENTO_ANULAR = "3";
	public static function firmaspro_Helper_EventsObtener( $d ){
	    include_once dirname(dirname(__FILE__)) . "/libs/setasign/SetAsign_Manage.php";
	    $sam = new SetAsign_Manage();
	    $bs = dirname(dirname(dirname(__FILE__)));
	    
	    date_default_timezone_set('America/Bogota');
	    self::authRequOff();
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $udata = base64_decode( $d[ 'u' ] );
	    $ujson = json_decode( $udata, true );
	    
	    $docinfoB64 = base64_decode( $ujson['jslgn'] );
	    $docinfo = json_decode( $docinfoB64, true );
	    
	    $fldtipo = $json['fldtipo'];
	    $anyo = $json['anyo'];
	    $ide = $json['ide'];
	    $pdf = $json['pdf'];
	    
	    if ( $json['evento'] == self::FIRMASPRO_EVENTO_REVISION ) {
	        $tipo = IndexCtrl::PERFILES_CONTRATISTA;
	        $firmasestados_id = 1;
	        
	        $rutafl = Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . self::FIRMASPRO_CARPETAS[ $fldtipo ] . DIRECTORY_SEPARATOR . $anyo . DIRECTORY_SEPARATOR . $ide . DIRECTORY_SEPARATOR . $pdf;
	        $url = Utiles::getBaseUrl() . $rutafl;
	        $absfile = $bs . DIRECTORY_SEPARATOR . $rutafl;
	        // Consultar si el usuario ya creo un registro de Revision del archivo $rutafl
	        $qryExiste = [ 
	            'w_pdfid' => $rutafl
	        ];
            $qryr = self::firmaslog_Obtener( $qryExiste );
            
            $regLog = [];
            $adduniqLog = true;
            foreach ( $qryr as $kQry ) {
                $regLog = $kQry;
                
                if ( $kQry['firmasestados_id'] == $firmasestados_id 
                    && md5($kQry['firmante_id']) == $ujson['id'] 
                    && $kQry['perfilusuarios_id'] == $tipo ) {
                    $adduniqLog = false;
                }
            }
            
            if ( $adduniqLog ) {
                if ( isset( $regLog['firmas_id'] ) ) {
                    $tipodoc = self::tipodoc_Obtener(['id' => $docinfo['tipodoc_id']]);
                    $nwFirLog = array(
                        'fecha' => date('Y-m-d H:i:s'),
                        'firmas_id' => $regLog['firmas_id'],
                        'firmasestados_id' => $firmasestados_id,
                        'ip' => Utiles::get_user_ip_address(),
                        'pdfurl' => Utiles::getBaseUrl() . $rutafl,
                        'paginas' => $sam->obtenerTotalPaginas( ['entrada' => $absfile ] ),
                        'pdfhash' => md5_file( $absfile ),
                        'pdfruta' => $rutafl,
                        'perfilusuarios_id' => $tipo,
                        'nombrefull' => $ujson['fullname'],
                        'tipodoc' => $tipodoc[0]['nombre'],
                        'documento' => $docinfo['documento']
                    );
                    self::firmaslog_Agregar( $nwFirLog );
                }
                else {
                    http_response_code(IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
                    return self::retorno([], IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO, 'Genere nuevamente sus documentos');
                }
            }
            // validar si existe un archivo _fir para mostrar
            $piUrl = pathinfo( $absfile );
            $url_fir = $piUrl['dirname'] . '/' . $piUrl['filename'] . '_fir.' . $piUrl['extension'];
            
            if ( file_exists( $url_fir ) ) {
                $rutafl_fir = Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . self::FIRMASPRO_CARPETAS[ $fldtipo ] . DIRECTORY_SEPARATOR . $anyo . DIRECTORY_SEPARATOR . $ide . DIRECTORY_SEPARATOR . $piUrl['filename'] . '_fir.' . $piUrl['extension'];
                $url = Utiles::getBaseUrl() . $rutafl_fir;
            }
            
            return self::retorno([ 'url' => $url ], 0, '');
	    }
	}
	
	private static function firmaspro_MkQR( $d ){
	    include_once ( dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'phpqrcode' . DIRECTORY_SEPARATOR . 'qrlib.php');
	    $qrP = $d['qr'];
	    $qrD = $d['data'];
	    QRcode::png( $qrD, $qrP, QR_ECLEVEL_H, 4, 0 );
	    
	    if ( file_exists( $qrP ) ) {
	        
	        if ( isset( $d[ 'jpg' ] ) ) {
	            
	            if ( $d[ 'jpg' ] ) {
	                $info = pathinfo( $qrP );
	                $nuevoNombreArchivo = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '.jpg';
	                $rJpg = Utiles::pngTojpg($qrP, $nuevoNombreArchivo);
	                
	                if( $rJpg !== false){
	                    return $rJpg;
	                }
	            }
	        }
	        
	        return $qrP;
	    }
	    
	}
	
	const FIRMAS_CERT_MODO_DOCENTE = "docente";
	const FIRMAS_CERT_MODO_MIX = "certificados";
	private static function firmaspro_MkCert( $d ){
	    $acu = $d;
	    $fld_anexos = "anexos";
	    
	    $est_folder = "";
	    if ( isset( $d['modo'] ) ) {
	        if ( $d[ 'modo' ] == self::FIRMAS_CERT_MODO_DOCENTE ) {
	            $fld_anexos = "usuarios";
	            $est_folder = preg_replace("/\D/", "", $acu['documento']);
	        }
	        else {
	            $est_folder = preg_replace("/\D/", "", $acu['est_documento']);
	        }
	    }
	    else{
	        $est_folder = preg_replace("/\D/", "", $acu['est_documento']);
	    }
	    
	    $dn = array(
	        'countryName' => 'CO',
	        'stateOrProvinceName' => 'CUNDINAMARCA',
	        'localityName' => 'CHIA',
	        'organizationName' => 'PERSONA NATURAL',
	        'emailAddress' => strtoupper( $acu['mail'] ),
	        'organizationalUnitName' => 'FIRMA ELECTRONICA',
	        'commonName' => strtoupper( $acu['fullname'] )
	    );
	    $config = array(
	        "digest_alg" => "sh512",
	        "private_key_bits" => 2048,
	        "private_key_type" => OPENSSL_KEYTYPE_RSA,
	    );
	    
	    $crt = null;
	    $privateKey = openssl_pkey_new( $config );
	    
	    $csr = openssl_csr_new($dn, $privateKey);
	    
	    $cert = openssl_csr_sign($csr, null, $privateKey, 365000);
	    openssl_x509_export($cert, $crt);
	    
	    $crtName = 'mycer.crt';
	    $pkName = 'mypem.key';
	    
	    $salidabase = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR ;
	    $crtFl = $salidabase . 'repo' . DIRECTORY_SEPARATOR . $fld_anexos . DIRECTORY_SEPARATOR . $est_folder . DIRECTORY_SEPARATOR . $crtName;
	    $keyFl = $salidabase . 'repo' . DIRECTORY_SEPARATOR . $fld_anexos . DIRECTORY_SEPARATOR . $est_folder . DIRECTORY_SEPARATOR . $pkName;
	    
	    openssl_pkey_export_to_file( $privateKey, $keyFl );
	    file_put_contents( $crtFl , $crt);
	    
	    if ( !file_exists( $crtFl )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new Exception ( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmaspro_MkCert: No fue posible crear el certificado' );
	    }
	    
	    return array( 'crt' => $crtFl, 'key' => $keyFl );
	}
	private static function firmaspro_MkCert_p12 ( $d ) {
	    $nombre = $d['nombre'];
	    $email = $d['correo'];
	    $pais = 'CO';
	    $password = $d['clave'];
	    $outputFile = $d['archivop12'];
	    
	    $dn = [
	        "countryName" => $pais,
	        "stateOrProvinceName" => "N/A",
	        "localityName" => "N/A",
	        "organizationName" => "Firma Personal",
	        "organizationalUnitName" => "Usuarios",
	        "commonName" => $nombre,
	        "emailAddress" => $email
	    ];
	    
	    $config = [
	        "private_key_bits" => 2048,
	        "private_key_type" => OPENSSL_KEYTYPE_RSA,
	        "digest_alg" => "sha256"
	    ];
	    
	    $privateKey = openssl_pkey_new($config);
	    $csr = openssl_csr_new($dn, $privateKey, $config);
	    $cert = openssl_csr_sign($csr, null, $privateKey, 365, $config);
	    $p12 = null;
	    openssl_pkcs12_export($cert, $p12, $privateKey, $password);
	    
	    file_put_contents($outputFile, $p12);
	    
	    return $outputFile;
	}
	
	const FIRMASPRO_TIPOUSUARIO_ADMIN = 'admin';
	const FIRMASPRO_TIPOUSUARIO_CONTRATISTA = 'contra';
	const FIRMASPRO_NOMBRE_P12 = 'mep12.p12';
	public static function firmaspro_Helper_MkCert_p12( $d ) {
	    $bs = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . "usuarios";
	    
	    $tipousuario = $d['tipousuario'];
	    $bs_tipousr = $bs . DIRECTORY_SEPARATOR . $tipousuario;
	    if ( !file_exists( $bs_tipousr ) ) {
	        if( !mkdir( $bs_tipousr ) ){
	            http_response_code(IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	            throw new Exception('No fue posible crear ' . $bs_tipousr, IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	        }
	    }
	    
	    $tipodoc_id = $d['tipodoc_id'];
	    $documento = $d['documento'];
	    $bs_tipousr_usr = $bs_tipousr . DIRECTORY_SEPARATOR . $tipodoc_id . '_' . $documento;
	    if ( !file_exists( $bs_tipousr_usr ) ) {
	        if( !mkdir( $bs_tipousr_usr ) ){
	            http_response_code(IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	            throw new Exception('No fue posible crear ' . $bs_tipousr_usr, IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	        }
	    }
	    
	    $usuario_id = $d['usuario_id'];
	    $clave = $d['clave'];
	    
	    $p12clave = md5( $tipousuario . '' . $documento . '' . $tipodoc_id . '' . $usuario_id . '' . $clave );
	    $elp12 = array(
	        'nombre' => trim( (string) $d['nombres'] . ' ' . $d['apellidos'] ),
	        'correo' => $d['mail'],
	        'pais' => 'CO',
	        'clave' => $p12clave,
	        'archivop12' => $bs_tipousr_usr . '/' . self::FIRMASPRO_NOMBRE_P12
	    );
	    $p12 = self::firmaspro_MkCert_p12( $elp12 );
	    
	    return $p12;
	}
	
	public static function firmaspro_Helper_Admin_MkCert_p12( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    $cfg = [
	        'tipousuario' => self::FIRMASPRO_TIPOUSUARIO_ADMIN,
	        'tipodoc_id' => $usu->getTipodoc_id(),
	        'documento' => $usu->getDocumento(),
	        'usuario_id' => $usu->getId(),
	        'clave' => $usu->getClave(),
	        'nombres' => trim((string)$usu->getNombres()),
	        'apellidos' => trim((string)$usu->getApellidos()),
	        'mail' => $usu->getMail()
	    ];
	    $r = "";
	    try {
	        $r = self::firmaspro_Helper_MkCert_p12( $cfg );
	    } catch (Exception $e) {
	        self::retorno( [], $e->getCode(), $e->getMessage());
	    }
	    
	    return self::retorno([ 'result' => $r ], 0, 'Certificado creado correctamente');
	}
	
	public static function firmaspro_Obtener( $d, &$dt ) {
	    date_default_timezone_set('America/Bogota');
	    
	    require_once dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'libs/php-numero-a-letras_v3_0/vendor/autoload.php';
	    
	    $basetcpdf = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'libs/TCPDF-main/acapp/' ;
	    require_once( $basetcpdf . 'tcpdf_include_acapp.php' );
	    
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ];
	    
	    $fld_anexos = "anexos";
	    $para_qrview = "";
	    if ( isset( $d[ 'modo' ] ) ) {
	        if ( $d['modo'] == self::FIRMAS_CERT_MODO_DOCENTE ) {
	            $fld_anexos = "usuarios";
	            $para_qrview = "/" .  self::FIRMAS_CERT_MODO_DOCENTE;
	        }
	        
	        if ( $d['modo'] == self::FIRMAS_CERT_MODO_MIX ) {
	            $fld_anexos = "proc" . DIRECTORY_SEPARATOR . $c_anyo['id'];
	            $para_qrview = "";
	        }
	        
	    }
	    
	    $puntos = 0.352777778;
	    
	    
	    $cer = '';
	    if ( isset( $d['cer' ] ) ) {
	        $cer = $d['cer'] ;
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $flid = $json['flid'];
	    $repo = self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . $flid;
	    if ( !file_exists( $repo ) ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmaspro_Obtener: Plantilla no encontrada (' . $flid . ')' );
	    }
	    
	    // Obtener config por documento
	    $cfg = self::LeerConfigCorp();
	    $_CFG_PDF_PAGECONFIG = isset( $cfg[ OperacionesCtrl::CFG_PDF_PAGECONFIG ]) ? $cfg[ OperacionesCtrl::CFG_PDF_PAGECONFIG ]["val"] : base64_encode( '[]' );
	    
	    $flidParts = pathinfo( $flid );
	    $fiCfg = $flidParts['filename'];
	    $pdfName = $fiCfg . $c_anyo['id'];
	    if ( isset( $d['helperfilename'] )) {
	        $tmpHelper = "_" . $d['helperfilename'] . "_";
	        $pdfName = $fiCfg . $tmpHelper . $c_anyo['id'];
	    }
	    
	    $_CFG_PDF = array();
	    $pagecfg = json_decode( base64_decode( $_CFG_PDF_PAGECONFIG ) , true );
	    if ( isset( $pagecfg[ $fiCfg ] ) ) {
	        $_CFG_PDF = json_decode( base64_decode( $pagecfg[ $fiCfg ] ) , true );
	    }
	    
	    $_PDF_PAGE_ORIENTATION = isset( $_CFG_PDF[ 'pageorientation' ] ) ? $_CFG_PDF[ 'pageorientation' ] : PDF_PAGE_ORIENTATION;
	    $_PDF_PAGE_FORMAT = isset( $_CFG_PDF[ 'pageformat' ] ) ? $_CFG_PDF[ 'pageformat' ] : PDF_PAGE_FORMAT;
	    $_PDF_MARGIN_LEFT = isset( $_CFG_PDF[ 'marginleft' ] ) ? $_CFG_PDF[ 'marginleft' ] : PDF_MARGIN_LEFT;
	    $_PDF_MARGIN_TOP = isset( $_CFG_PDF[ 'margintop' ] ) ? $_CFG_PDF[ 'margintop' ] : PDF_MARGIN_TOP;
	    $_PDF_MARGIN_RIGHT = isset( $_CFG_PDF[ 'marginright' ] ) ? $_CFG_PDF[ 'marginright' ] : PDF_MARGIN_RIGHT;
	    $_PDF_MARGIN_BOTTOM = isset( $_CFG_PDF[ 'marginbottom' ] ) ? $_CFG_PDF[ 'marginbottom' ] : PDF_MARGIN_BOTTOM;
	    
	    $_PDF_HEADER_LOGO_WIDTH = isset( $_CFG_PDF[ 'headerimgwidth' ] ) ? $_CFG_PDF[ 'headerimgwidth' ] : PDF_HEADER_LOGO_WIDTH;
	    $_PDF_HEADER_LOGO_ALTO = isset( $_CFG_PDF[ 'imgalto' ] ) ? $_CFG_PDF[ 'imgalto' ] : 50;
	    
	    $_PDF_HEADER_LINEAHEADER = filter_var( isset( $_CFG_PDF[ 'lineaheader' ] ) ? $_CFG_PDF[ 'lineaheader' ] : true , FILTER_VALIDATE_BOOLEAN);
	    $_PDF_HEADER_LINEATAMANOHEADER = isset( $_CFG_PDF[ 'lineatamanoheader' ] ) ? $_CFG_PDF[ 'lineatamanoheader' ] : 0.5;
	    $_PDF_HEADER_LINEAHEADERCOLOR = isset( $_CFG_PDF[ 'lineaheadercolor' ] ) ? $_CFG_PDF[ 'lineaheadercolor' ] : "#000000";
	    $_PDF_HEADER_LINEAHEADERTOP = isset( $_CFG_PDF[ 'lineaheadertop' ] ) ? $_CFG_PDF[ 'lineaheadertop' ] : 23;
	    
	    $_PDF_HEADER_LINEAFOOTER = filter_var( isset( $_CFG_PDF[ 'lineafooter' ] ) ? $_CFG_PDF[ 'lineafooter' ] : true , FILTER_VALIDATE_BOOLEAN);
	    $_PDF_HEADER_LINEATAMANOFOOTER = isset( $_CFG_PDF[ 'lineatamanofooter' ] ) ? $_CFG_PDF[ 'lineatamanofooter' ] : 0.5;
	    $_PDF_HEADER_LINEAFOOTERCOLOR = isset( $_CFG_PDF[ 'lineafootercolor' ] ) ? $_CFG_PDF[ 'lineafootercolor' ] : "#000000";
	    $_PDF_HEADER_LINEAFOOTERTOP = isset( $_CFG_PDF[ 'lineafootertop' ] ) ? $_CFG_PDF[ 'lineafootertop' ] : 23;
	    
	    $_PDF_MARGIN_HEADER = isset( $_CFG_PDF[ 'headermargin' ] ) ? $_CFG_PDF[ 'headermargin' ] : PDF_MARGIN_HEADER;
	    $_PDF_MARGIN_FOOTER = isset( $_CFG_PDF[ 'footermargin' ] ) ? $_CFG_PDF[ 'footermargin' ] : PDF_MARGIN_FOOTER;
	    
	    $_CFG_USE_HEADER = filter_var( isset( $_CFG_PDF[ 'useheader' ] ) ? $_CFG_PDF[ 'useheader' ] : true , FILTER_VALIDATE_BOOLEAN);
	    $_CFG_USE_FOOTER = filter_var( isset( $_CFG_PDF[ 'usefooter' ] ) ? $_CFG_PDF[ 'usefooter' ] : true , FILTER_VALIDATE_BOOLEAN);
	    
	    $_CFG_PDF_TITLE = isset( $_CFG_PDF[ 'pdftitle' ] ) ? $_CFG_PDF[ 'pdftitle' ] : $fiCfg;
	    $_CFG_PDF_KEYWORDS = isset( $_CFG_PDF[ 'pdfkeywords' ] ) ? $_CFG_PDF[ 'pdfkeywords' ] : '';
	    
	    $_CFG_PDF_FIRMANEED = filter_var( isset( $_CFG_PDF[ 'firmaneed' ] ) ? $_CFG_PDF[ 'firmaneed' ] : true , FILTER_VALIDATE_BOOLEAN);
	    
	    $_CFG_PDF_FIRMAPOSX = ( isset( $_CFG_PDF[ 'firmaposx' ] ) ? $_CFG_PDF[ 'firmaposx' ] : 0 ) * $puntos;
	    $_CFG_PDF_FIRMAPOSY = ( isset( $_CFG_PDF[ 'firmaposy' ] ) ? $_CFG_PDF[ 'firmaposy' ] : 0 ) * $puntos;
	    $_CFG_PDF_FIRMADIMW = ( isset( $_CFG_PDF[ 'firmadimw' ] ) ? $_CFG_PDF[ 'firmadimw' ] : 500 ) * $puntos;
	    $_CFG_PDF_FIRMADIMH = ( isset( $_CFG_PDF[ 'firmadimh' ] ) ? $_CFG_PDF[ 'firmadimh' ] : 100 ) * $puntos;
	    $_CFG_PDF_FIRMAPAGE = (isset( $_CFG_PDF[ 'firmapage' ] ) ? $_CFG_PDF[ 'firmapage' ] : 1 );
	    
	    $pdf = new TCPDF_acappdemy( $_PDF_PAGE_ORIENTATION, PDF_UNIT, $_PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    
	    $pdf->imgalto = $_PDF_HEADER_LOGO_ALTO;
	    $pdf->imgcontent = $_PDF_HEADER_LOGO_WIDTH;
	    
	    $pdf->lineaheader = $_PDF_HEADER_LINEAHEADER;
	    $pdf->lineatamanoheader = $_PDF_HEADER_LINEATAMANOHEADER;
	    $pdf->lineaheadercolor = Utiles::hexToRgb( $_PDF_HEADER_LINEAHEADERCOLOR );
	    $pdf->lineaheadertop = $_PDF_HEADER_LINEAHEADERTOP;
	    
	    $pdf->lineafooter = $_PDF_HEADER_LINEAFOOTER;
	    $pdf->lineatamanofooter = $_PDF_HEADER_LINEATAMANOFOOTER;
	    $pdf->lineafootercolor = Utiles::hexToRgb( $_PDF_HEADER_LINEAFOOTERCOLOR );
	    $pdf->lineafootertop = $_PDF_HEADER_LINEAFOOTERTOP;
	    
	    $instDNombre = "";
	    $inst = OperacionesCtrl::institucion_Obtener();
	    $instD = array();
	    if ( count( $inst ) > 0 ) {
	        $instD = $inst[0];
	        
	        if ( isset( $instD['nombre'] ) ) {
	            $instDNombre = $instD['nombre'];
	        }
	    }
	    
	    $pdf->setCreator(PDF_CREATOR);
	    $pdf->setAuthor( $instDNombre );
	    $pdf->setTitle( $_CFG_PDF_TITLE );
	    $pdf->setSubject( $fiCfg );
	    $pdf->setKeywords( $_CFG_PDF_KEYWORDS );
	    
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    
	    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	    
	    $pdf->setMargins($_PDF_MARGIN_LEFT, $_PDF_MARGIN_TOP, $_PDF_MARGIN_RIGHT);
	    $pdf->setHeaderMargin( $_PDF_MARGIN_HEADER );
	    $pdf->setFooterMargin( $_PDF_MARGIN_FOOTER );
	    
	    $pdf->setPrintHeader( $_CFG_USE_HEADER );
	    $pdf->setPrintFooter( $_CFG_USE_FOOTER );
	    
	    $pdf->setAutoPageBreak(TRUE, $_PDF_MARGIN_BOTTOM);
	    
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	    
	    if ( file_exists( $basetcpdf .'/lang/eng.php' ) ) {
	        require_once ( $basetcpdf . '/lang/eng.php' );
	        if (isset( $l )) {
	            $pdf->setLanguageArray( $l );
	        }
	    }
	    
	    $pdf->setFont('helvetica', '', 10);
	    
	    $pdf->AddPage();
	    
	    $salidabase = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR ;
	    $salidacarpeta = 'repo' . DIRECTORY_SEPARATOR . 'recursos' . DIRECTORY_SEPARATOR;
	    $salida = 'vprevia.pdf';
	    
	    $html = file_get_contents($repo);
	    $hdHtml = $html;
	    
	    $fechayhora = date('Y-m-d H:m:s');
	    $replacement_array = array();
	    if ( isset( $d['bind'] ) ) {
	        $replacement_array = $d['bind'];
	        
	        $replacement_array['anyo'] = $c_anyo['nombre'];
	        
	        if ( isset( $replacement_array['salariomes'] ) ) {
	            $formatter = new Luecano\NumeroALetras\NumeroALetras();
	            $txtNum = $formatter->toWords($replacement_array['salariomes'], 0);
	            $replacement_array['salariomesletras'] = $txtNum;
	            
	            $replacement_array['salariomes'] = number_format( $replacement_array['salariomes'], 2, ',', '.');
	        }
	        if ( isset( $replacement_array['contratoini'] ) ) {
	            $replacement_array['contratoini'] = date("Y-m-d", strtotime( $replacement_array['contratoini'] ) );
	        }
	        
	        //die( print_r( $replacement_array, true ) );
	        $hdHtml = preg_replace_callback(
	            '~\{\$(.*?)\}~si',
	            function($match) use ($replacement_array) {
	                return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	            },
	            $html);
	        
	        $hdHtml = self::componenteHTML( array( 'html' => $hdHtml ) );
	        
	        $replacement_array['fecha'] = $fechayhora;
	        $replacement_array['ip'] = Utiles::get_user_ip_address();
	        $replacement_array['pdfid'] = $flid;
	        
	        $salidabase = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR ;
	        $dirnombre = '';
	        if ( isset( $replacement_array['est_documento'] ) ) {
	            $dirnombre = preg_replace('/\D/', '', $replacement_array['est_documento'] ) ;
	        }
	        else {
	            $dirnombre = preg_replace('/\D/', '', $replacement_array['documento'] ) ;
	        }
	        
	        $fld_base = $salidabase . Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . $fld_anexos . DIRECTORY_SEPARATOR;
	        if ( !file_exists( $fld_base ) ) {
	            mkdir($fld_base);
	        }
	        $fld_alum = $fld_base . $dirnombre;
	        if ( !file_exists( $fld_alum ) ) {
	            mkdir($fld_alum);
	        }
	        
	        $salidacarpeta = Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . $fld_anexos . DIRECTORY_SEPARATOR . $dirnombre . DIRECTORY_SEPARATOR;
	        $salida = $pdfName . '.pdf';
	    }
	    
	    $firmardoc = false;
	    
	    $agregarfrm = false;
	    if( isset( $d[ 'temp' ] ) ){
	        $agregarfrm = $d[ 'temp' ];
	        
	        if ( $agregarfrm ) {
	            if ( $_CFG_PDF_FIRMANEED ) {
	                $prev = array(
	                    'fullname' => 'Nombre del Firmante',
	                    'documento' => '123456789',
	                    'tipodoc' => 'C&eacute;dula',
	                    'mail' => 'correo@nuevapp.com',
	                    'fecha' => $fechayhora,
	                    'ip' => Utiles::get_user_ip_address(),
	                    'pdfid' => $flid,
	                    'estado' => self::FIRMASPRO_TXT_PREV,
	                    'qr' => array( 'bs' => '/repo/recursos/qrtemp.jpg' ),
	                    'anyo' => $c_anyo['nombre'],
	                    'now_day' => date('d'),
	                    'now_month' => date('m'),
	                    'now_year' => date('Y')
	                );
	                $hdHtml .= self::firmaspro_TplFirma( $prev );
	            }
	        }
	    }
	    elseif ( isset( $d['firmar'] ) ){
	        if ( $d['firmar' ] ) {
	            $firmardoc = true;
	            $replacement_array['estado'] = self::FIRMASPRO_TXT_FIRM;
	            $salida = $pdfName . '_fir.pdf';
	            
	            if ( isset( $d['flogid'] ) ) {
	                $saliQr = $salidabase . $salidacarpeta . $pdfName . '.png';
	                $rQr = self::firmaspro_MkQR( array('qr' => $saliQr, 'data' => rtrim( Utiles::getBaseUrl(), "/" ) . "/index.php/Revisar/" . md5( $d['flogid'] ) . "" . $para_qrview , 'jpg' => false ) );
	                $tmpF = pathinfo($rQr);
	                
	                if ( $rQr ) {
	                    $replacement_array['qr'] = array( 'fl' => $rQr , 'bs' => $salidacarpeta . $pdfName . '.' . $tmpF['extension']) ;
	                }
	            }

	            $hdHtml .= self::firmaspro_TplFirma( $replacement_array );
	        }
	    }
	    else {
	        $replacement_array['estado'] = self::FIRMASPRO_TXT_PEND;
	        $hdHtml .= self::firmaspro_TplFirma( $replacement_array );
	    }
	    
	    $pdf->writeHTML( $hdHtml , true, false, true, false, '');
	    
	    $pdf->SetXY(0, 0);
	    
	    if ( $_CFG_PDF_FIRMANEED ) {
	        
	        if( $agregarfrm ){
	            $pdf->addEmptySignatureAppearance($_PDF_MARGIN_LEFT + $_CFG_PDF_FIRMAPOSX, $_CFG_PDF_FIRMAPOSY, $_CFG_PDF_FIRMADIMW, $_CFG_PDF_FIRMADIMH, $_CFG_PDF_FIRMAPAGE );
	        }
	        
	        if ( $firmardoc ) {
	            
	            
	            $certificate = 'file://' . $cer['crt'] ;
	            $private = 'file://' . $cer['key'] ;
	            if ( !file_exists( $cer['crt'] ) ) {
	                http_response_code( IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	                throw new Exception('[' . IndexCtrl::ERR_COD_REGISTRO_EXISTENTE . '] El archivo "' . $d['cer'] . '" no existe');
	            }
	            
	            $info = array(
	                'Name' => $replacement_array['fullname'],
	                'Reason' => 'Firmado electronico de ' . $flid ,
	                'ContactInfo' => $replacement_array['mail'],
	            );
	            
	            // set document signature
	            $pdf->setSignature($certificate, $private, '', '', $_CFG_PDF_FIRMAPAGE, $info);
	            $pdf->setSignatureAppearance($_PDF_MARGIN_LEFT + $_CFG_PDF_FIRMAPOSX, $_CFG_PDF_FIRMAPOSY, $_CFG_PDF_FIRMADIMW, $_CFG_PDF_FIRMADIMH, $_CFG_PDF_FIRMAPAGE);
	        }
	        
	    }
	    
	    /*
	    $y = $pdf->GetY();
	    $pdf->addEmptySignatureAppearance($_PDF_MARGIN_LEFT, $y, 15, 15);
	    $pdf->writeHTML( 'test' , true, false, true, false, '');
	    $y = $pdf->GetY();
	    $pdf->addEmptySignatureAppearance($_PDF_MARGIN_LEFT, $y, 15, 15);
	    */
	    
	    $pdf->lastPage();
	    
	    $dt = $replacement_array;
	    $dt['paginas'] = $pdf->getNumPages();
	    
	    $salidadef = $salidabase . $salidacarpeta . $salida;
	    $pdf->Output( $salidadef , 'F' );

	    return array( 'url' => Utiles::getBaseUrl() . $salidacarpeta . $salida , 'bs' => $salidacarpeta . $salida );
	}
	
	private static function firmaspro_TplFirma( $d ){
	    $fechayhora = $d['fecha'];
	    $acuname = ucwords( $d['fullname'] );
	    $acudocu = number_format( preg_replace("/\D/","" ,$d['documento'] ) , 0, ',', '.');
	    $acutpdo = $d['tipodoc'];
	    $acumail = $d['mail'];
	    $acuipdt = $d['ip'];
	    $estado = $d['estado'];
	    
	    $qr = '<img src="/repo/recursos/blank.jpg" height="1" width="1" hspace="0" vspace="1" />';
	    if ( isset( $d['qr' ] ) ) {
	        $qrQ = $d['qr'];
	        $img = "/" . ltrim( $qrQ['bs'] , "/");
	        
	        $qr = '<img src="' . $img . '" height="100" hspace="0" vspace="3" />';
	    }
	    /*
	    $prevsign =<<<EOD
<table border="1" style="border:solid 1px #000000; width:500px;">
	<tbody>
		<tr>
			<td width="100" align="center" valign="center" style="vertical-align: center;">{$qr}</td>
			<td valign="top" style="vertical-align:top; line-height: 15px;"><span style="font-size: 1.3em;"><strong>{$acuname}</strong></span><br />
                <span>{$acutpdo} {$acudocu}</span><br />
                <span>{$acumail}</span><br />
                <span>Revisado el {$fechayhora}</span><br />
                <span>{$estado}</span><br />
                <span>Revisado desde {$acuipdt}</span><br />
            </td>
		</tr>
	</tbody>
</table>
<p style="font-size: 2px;line-height: 5px;" >&nbsp;</p>
<table style="border-top:solid 1px #000000; width:305px;">
	<tbody>
		<tr>
            <td valign="top" style="vertical-align:top;"><span style="">{$acuname}</span><br />
                <span>{$acutpdo} {$acudocu}</span><br />
            </td>
		</tr>
	</tbody>
</table>
EOD;
*/
	    $prevsign =<<<EOD
<table border="1" style="border:solid 1px #000000; width:500px;">
	<tbody>
		<tr>
			<td width="100" align="center" valign="center" style="vertical-align: center;">{$qr}</td>
			<td valign="top" style="vertical-align:top; line-height: 15px;"><span style="font-size: 1.3em;"><strong>{$acuname}</strong></span><br />
                <span>Firmado {$fechayhora}</span><br />
            </td>
		</tr>
	</tbody>
</table>
<p style="font-size: 2px;line-height: 5px;" >&nbsp;</p>
<table style="border-top:solid 1px #000000; width:305px;">
	<tbody>
		<tr>
            <td valign="top" style="vertical-align:top;"><span style="">{$acuname}</span><br />
                <span>{$acutpdo} {$acudocu}</span><br />
            </td>
		</tr>
	</tbody>
</table>
EOD;
	    
	    
	    return $prevsign;
	}
	
	public static function firmaspro_Preview_Obtener( $d ) {
	    $d['temp'] = true;
	    
	    try {
	        return self::firmaspro_Obtener( $d, $dt );
	    } catch (Exception $e) {
	        throw new Exception( 'firmaspro_Preview_Obtener - firmaspro_Obtener: ' . $e->getMessage());
	    }
	}
	
	public static function firmaspro_PageFormats_Obtener( $d ){
	    $basetcpdf = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'libs/TCPDF-main/acapp/' ;
	    require_once( $basetcpdf . 'tcpdf_include_acapp.php' );
	    
	    return TCPDF_STATIC::$page_formats;
	}
	public static function firmaspro_Config_Page_Agregar( $d ){
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $cfg = self::LeerConfigCorp();
	    $_CFG_PDF_PAGECONFIG = isset( $cfg[ OperacionesCtrl::CFG_PDF_PAGECONFIG ]) ? $cfg[ OperacionesCtrl::CFG_PDF_PAGECONFIG ]["val"] : base64_encode( '[]' );
	    
	    $pagecfg = json_decode( base64_decode( $_CFG_PDF_PAGECONFIG ) , true );
	    //die( print_r( $pagecfg ) );
	    if ( isset( $pagecfg[ $json['fileid'] ] ) ) { 
	        $pagecfg[ $json['fileid'] ] = $d[ 'data' ];
	        $vl = base64_encode( json_encode( $pagecfg ) );
	        try {
	            self::ModificaConfigCorp( $d['id'], $vl, $d['ufull'] );
	        } catch (Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	            throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmas_Config_Page - EscribirConfig: ' . $e->getMessage());
	        }
	    }
	    else {
	        //$jsTmp = array();
	        $pagecfg[ $json['fileid'] ] = $d[ 'data' ];
	        $dCfg = array(
	            'id' => $d['id'],
	            'vl' => base64_encode( json_encode( $pagecfg ) ) ,
	            'ufull' => $d['ufull']
	        );
	        try {
	            self::EscribirConfig( $dCfg );
	        } catch (Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	            throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmas_Config_Page - EscribirConfig: ' . $e->getMessage());
	        }
	    }
	    
	    return true;
	}
	public static function firmaspro_Config_Page_Obtener( $d ){
	    $cfg = self::LeerConfigCorp();
	    $_CFG_PDF_PAGECONFIG = isset( $cfg[ OperacionesCtrl::CFG_PDF_PAGECONFIG ]) ? $cfg[ OperacionesCtrl::CFG_PDF_PAGECONFIG ]["val"] : base64_encode( '[]' );
	    
	    $pagecfg = json_decode( base64_decode( $_CFG_PDF_PAGECONFIG ) , true );
	    if ( isset( $pagecfg[ $d['fileid'] ] ) ) {
	        $r = $pagecfg[ $d['fileid'] ];
	        return $r;
	    }
	    
	    return array();
	}
	public static function firmaspro_Revisar( $d ){
	    self::authRequOff();
	    
	    $data = [];
	    $cod = "";
	    if ( isset( $d[0] ) ) {
	        $cod = $d[0];
	        
	        try {
	            $data = self::firmaslog_Obtener( array( 'w_firmaid_md5' => $cod, 'ordenasc' => 9 ) );
	        } catch (Exception $e) {
	            throw new Exception( 'firmaspro_Revisar - firmaslog_Obtener: ' . $e->getMessage() );
	        }
	    }
	    
	    include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'tpls' . DIRECTORY_SEPARATOR . 'Revisar.phtml';
	    include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'tpls' . DIRECTORY_SEPARATOR . 'Pie.phtml';
	    echo "\n    </body>\n";
	    echo "</html>";
	}
	// Firmaspro FIN
	
	// Firmas INI
	const FIRMAS_PROC_REV = "firmasrev";
	const FIRMAS_PROC_FIR = "firmasfir";
	public static function firmas_Helper_Agregar ( $d ) {
	    date_default_timezone_set('America/Bogota');
	    
	    $fid = 0;
	    if ( isset( $d['flogid'] ) ) {
	        $fid = $d['flogid'];
	        
	        $salidabase = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR ;
	        $pdf = $d['pdf'];
	        $flog = array(
	            'firmas_id' => $fid,
	            'firmasestados_id' => $d['firmasestados_id'],
	            'ip' => Utiles::get_user_ip_address(),
	            'pdfurl' => $pdf['url'],
	            'pdfruta' => $pdf['bs'],
	            'pdfhash' => md5_file( $salidabase . '/' . $pdf['bs'] ),
	            'paginas' => $d['paginas'],
	            'fecha' => date('Y-m-d H:i:s'),
	            'perfilusuarios_id' => $d['perfilusuarios_id'],
	            'nombrefull' => $d['nombrefull'],
	            'tipodoc' => $d['tipodoc'],
	            'documento' => $d['documento']
	        );
	        
	        try {
	            self::firmaslog_Agregar( $flog );
	        } catch (Exception $e) {
	            throw new Exception ( 'firmas_Helper_Agregar - firmaslog_Agregar: ' . $e->getMessage() ) ;
	        }
	    }
	    else {
	        $qryUni = [ 'w_pdfid' => $d['pdfid'] ];
	        $pdfUnico = self::firmaslog_Obtener( $qryUni );
	        
	        $limpio = true;
	        if (count( $pdfUnico ) > 0 ) {
	            $limpio = self::firmaslog_Helper_Eliminar( $pdfUnico[0] ) ;
	        }
	        
	        if ( $limpio ) {
	            try {
	                $fid = self::firmas_Agregar( $d );
	            } catch (Exception $e) {
	                throw new Exception ( 'firmas_Helper_Agregar - firmas_Agregar: ' . $e->getMessage() ) ;
	            }
	        }

	    }
	    
	    return $fid;
	}
	public static function firmas_Agregar ( $d ) {
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Firmas();
	    
	    if (isset( $d['pdfid'] ) ) {
	        $o->setPdfid( $d['pdfid'] );
	    }
	    if (isset( $d['perfilusuarios_id'] ) ) {
	        $o->setPerfilusuarios_id($d['perfilusuarios_id']);
	    }
	    if (isset( $d['firmante_id'] ) ) {
	        $o->setFirmante_id( $d['firmante_id'] );
	    }
	    if (isset( $d['nombrefull'] ) ) {
	        $o->setNombrefull( $d['nombrefull'] );
	    }
	    if (isset( $d['documento'] ) ) {
	        $o->setDocumento( $d['documento'] );
	    }
	    if (isset( $d['tipodoc'] ) ) {
	        $o->setTipodoc( $d['tipodoc'] );
	    }
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    
	    if ( isset( $d['mail'] ) ) {
	        $o->setMail( $d['mail'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmas_Agregar: ' . $o->obtenerError() );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'firmas_Agregar: Respuesta no implementada' );
	    }
	}
	public static function firmas_Obtener( $d ) {
	    try {
	        self::firmaslog_Obtener($d);
	    } catch (Exception $e) {
	        throw new Exception( 'firmas_Obtener - firmaslog_Obtener: ' . $e->getMessage() );
	    }
	}
	public static function firmas_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "firmas_Eliminar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb = "firmas ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'firmas_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'firmas_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	// Firmas FIN
	
	// Firmaslog INI
	/**
	 * Obtener rergistro de firmas 
	 * 
	 * @example w_acudientes_id = id AND w_empleados_id = id AND w_pdfid = id
	 */
	public static function firmaslog_Obtener( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] firmaslog_Obtener: " . $e->getMessage() );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "flog.`id`, flog.`firmasestados_id`, fest.nombre as firmasestados  ";
	    $vr .= ", flog.`ip`, flog.pdfurl, flog.`pdfruta`, flog.`pdfhash`, flog.`paginas`, flog.`fecha` as fechahora ";
        $vr .= ",fir.id as firmas_id, fir.pdfid, fir.fecha, fir.mail ";
        $vr .= ", fir.firmante_id,flog.perfilusuarios_id, flog.nombrefull, flog.tipodoc, flog.documento ";
	    
	    $tb  = 'firmas as fir ';
	    
	    $jn  = 'LEFT JOIN firmaslog as flog on fir.id = flog.firmas_id ';
	    $jn .= 'LEFT JOIN firmasestados as fest on fest.id = flog.firmasestados_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "flog.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_pdfid'] ) ){
	        $wh[] = "fir.pdfid like ?";
	        $pr[] = $d['w_pdfid'];
	    }
	    if( isset( $d['w_firmaid_md5'] ) ){
	        $wh[] = 'md5( fir.id ) = ?' ;
	        $pr[] = $d['w_firmaid_md5'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr); //Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'firmaslog_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	public static function firmaslog_Agregar ( $d ) {
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Firmaslog();
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    if (isset( $d['firmas_id'] ) ) {
	        $o->setFirmas_id($d['firmas_id']);
	    }
	    if (isset( $d['firmasestados_id'] ) ) {
	        $o->setFirmasestados_id( $d['firmasestados_id'] );
	    }
	    if (isset( $d['ip'] ) ) {
	        $o->setIp( $d['ip'] );
	    }
	    if (isset( $d['pdfurl'] ) ) {
	        $o->setPdfurl( $d['pdfurl']);
	    }
	    if (isset( $d['paginas'] ) ) {
	        $o->setPaginas( $d['paginas'] );
	    }
	    if (isset( $d['pdfhash'] ) ) {
	        $o->setPdfhash( $d['pdfhash'] );
	    }
	    if (isset( $d['pdfruta'] ) ) {
	        $o->setPdfruta( $d['pdfruta'] );
	    }
	    if (isset( $d['perfilusuarios_id'] ) ) {
	        $o->setPerfilusuarios_id( $d['perfilusuarios_id'] );
	    }
	    if (isset( $d['nombrefull'] ) ) {
	        $o->setNombrefull( $d['nombrefull'] );
	    }
	    if (isset( $d['tipodoc'] ) ) {
	        $o->setTipodoc( $d['tipodoc'] );
	    }
	    if (isset( $d['documento'] ) ) {
	        $o->setDocumento( $d['documento'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] firmaslog_Agregar: ' . $o->obtenerError() );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'firmaslog_Agregar: Respuesta no implementada' );
	    }
	}
	public static function firmaslog_Helper_Eliminar ( $d ) {
	    self::authRequOff();
	    
	    $bs = dirname(dirname(dirname( __FILE__ )));
	    $pdf_fir_pi = pathinfo( $d['pdfid'] );
	    
	    $pdf_fir = $bs . '/' . $pdf_fir_pi['dirname'] . '/' . $pdf_fir_pi['filename'] . '_fir.' . $pdf_fir_pi['extension'];
	    
	    $delFirmar = false;
	    if ( !empty( $d['id'] ) ) {
	        try {
	            $delFirmar = self::firmaslog_Eliminar( [ 'w_firmas_id' => $d['firmas_id'] ] );
	        } catch (Exception $e) {
	            throw new Exception('firmaslog_Helper_Eliminar: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    else {
	        $delFirmar = true;
	    }
	    
	    $limpio = false;
	    if ( $delFirmar ) {
	        $limpio = self::firmas_Eliminar( [ 'id' => $d['firmas_id'] ] );
	    }
	    
	    if ( file_exists( $pdf_fir ) ) {
	        unlink( $pdf_fir );
	    }
	    
	    return $limpio;
	}
	public static function firmaslog_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "firmaslog_Eliminar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb = "firmaslog ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    if ( isset( $d['w_firmas_id'] ) ) {
	        $xt = "WHERE firmas_id = " . $d['w_firmas_id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'firmaslog_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'firmaslog_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	// Firmaslog FIN
	
	// Version 2 INI
	
	// Firmascomentarios INI
	/*
	 * @yalfonso
	 * TODO: Tarea 70 - Crear funci&oacute;n que ayude a agregar o modificar la tabla firmascomentarios
	 */
	public static function firmascomentarios_Helper_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $idreg = 0;
	    
	    $texto = trim($json['valor']);
	    if( !(strlen( $texto ) > 0)  ){
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        return self::retorno( [], IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO, 'firmascomentarios_Helper_Agregar: El campo valor no tiene datos' ) ;
	    }
	    $valor = strip_tags($texto);
	    $valor = htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
	    $valor = trim($valor);
	    
	    if ( isset( $json['id'] ) ) {
	        $idreg = $json['id'];
	        try {
	            self::firmascomentarios_Modificar( [ "id" => $json['id'], "valor" => $valor ] );
	        } catch (Exception $e) {
	            http_response_code( $e->getCode() );
	            return self::retorno( [], $e->getCode(), 'firmascomentarios_Helper_Agregar - firmascomentarios_Modificar: ' . $e->getMessage() ) ;
	        }
	    }
	    else {
	        $pdfid = ltrim( strtolower( $json['url'] ) , "/");
	        $pdfid = '%' . str_replace( "_fir.pdf", ".pdf", $pdfid );
	        
	        $firQry = [];
	        try {
	            $firQry = self::firmaslog_Obtener( [ "w_pdfid" => $pdfid, "limite" => 1 ] );
	        } catch (Exception $e) {
	            http_response_code( $e->getCode() );
	            return self::retorno( [], $e->getCode(), 'firmascomentarios_Helper_Agregar - firmaslog_Obtener: ' . $e->getMessage() ) ;
	        }
	        
	        if ( count( $firQry ) > 0 ) {
	            $firmasreg = $firQry[ 0 ];
	            try {
	                $idreg = self::firmascomentarios_Agregar( [ "firmas_id" => $firmasreg['firmas_id'], "paquetes_id" => $json['paquetes_id'], "valor" => $valor ] );
	            } catch (Exception $e) {
	                http_response_code( $e->getCode() );
	                return self::retorno( [], $e->getCode(), 'firmascomentarios_Helper_Agregar - paquetesreqcomentarios_Agregar: ' . $e->getMessage() ) ;
	            }
	        }
	        
	    }
	    
	    return self::retorno( [ "success" => true , 'idreg' => $idreg ], 0, '') ;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 71 - Crear funci&oacute;n que agregue datos a la tabla firmascomentarios
	 */
	public static function firmascomentarios_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $o = new Firmascomentarios();
	    if (isset( $d['valor'] ) ) {
	        $o->setValor( $d['valor'] );
	    }
	    if (isset( $d['paquetes_id'] ) ) {
	        $o->setPaquetes_id( $d['paquetes_id'] );
	    }
	    if (isset( $d['firmas_id'] ) ) {
	        $o->setFirmas_id( $d['firmas_id'] );
	    }
	    if (isset( $d['empleados'] ) ) {
	        $o->setEmpleados( $d['empleados'] );
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $o->setEmpleados_id( $d['empleados_id'] );
	    }
	    if (isset( $d['empleadosfecha'] ) ) {
	        $o->setEmpleadosfecha( $d['empleadosfecha'] );
	    }
	    if (isset( $d['firmascomentariosestados_id'] ) ) {
	        $o->setFirmascomentariosestados_id( $d['firmascomentariosestados_id'] );
	    }
	    $o->setUsuarios_id( $usu->getId() );
	    $o->setUsuarios( $usu->getNombres() . " " . $usu->getApellidos() );
	    $o->setFecha( date('Y-m-d H:i:s'));
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError(), IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	
	/*
	 * @yalfonso
	 * TODO: Tarea 72 - Crear funci&oacute;n maneje los parametros que se envian para obtener data de la tabla firmascomentarios
	 */
	public static function firmascomentarios_Helper_Obtener( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $pdfid = ltrim( strtolower( $json['url'] ) , "/");
	    $pdfid = '%' . str_replace( "_fir.pdf", ".pdf", $pdfid );
	    
	    $firQry = [];
	    try {
	        $firQry = self::firmaslog_Obtener( [ "w_pdfid" => $pdfid, "limite" => 1 ] );
	    } catch (Exception $e) {
	        http_response_code( $e->getCode() );
	        return self::retorno( [], $e->getCode(), 'firmascomentarios_Helper_Agregar - firmaslog_Obtener: ' . $e->getMessage() ) ;
	    }
	    
	    $qryPkcom = [];
	    if ( count( $firQry ) > 0 ) {
	        $firmasreg = $firQry[ 0 ];
	        try {
	            $qryPkcom = self::firmascomentarios_Obtener( [ 'w_firmas_id' => $firmasreg['firmas_id'], 'w_firmascomentariosestados_ids' => [1,2,3,4], 'ordenasc' => 6 ] );
	        } catch (Exception $e) {
	            throw new Exception('firmascomentarios_Helper_Obtener - firmascomentarios_Obtener: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    
	    return $qryPkcom;
	}
	
	/*
	 * @yalfonso
	 * TODO: Tarea 73 - Crear funci&oacute;n que obtenga los datos de la tabla firmascomentarios
	 */
	public static function firmascomentarios_Obtener( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "fircom.`id`, fircom.`usuarios_id`, fircom.`usuarios`, fircom.`valor`, ";
	    $vr .= "TO_BASE64(fircom.`valor`) as firma, fircom.`fecha`, fircom.`paquetes_id`, ";
	    $vr .= "pks.nombre as paquetes_nombre, fircom.firmas_id, firs.pdfid as firmas_pdfid, ";
	    $vr .= "fircom.`firmascomentariosestados_id`, fircomestados.nombre as firmascomentariosestados_nombre, ";
	    $vr .= "fircom.`empleados_id`, fircom.`empleados`, fircom.`empleadosfecha` ";
	    
	    $tb  = '`firmascomentarios` as fircom ';
	    
	    $jn  = 'LEFT JOIN `firmas` as firs on firs.id = fircom.firmas_id ';
	    $jn .= 'LEFT JOIN `paquetes` as pks on pks.id = fircom.paquetes_id ';
	    $jn .= 'LEFT JOIN `firmascomentariosestados` as fircomestados on fircomestados.id = fircom.firmascomentariosestados_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "fircom.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_paquetes_id'] ) ){
	        $wh[] = "fircom.`paquetes_id` = ?";
	        $pr[] = $d['w_paquetes_id'];
	    }
	    if( isset( $d['w_empleados_id'] ) ){
	        $wh[] = 'fircom.`empleados_id` = ?' ;
	        $pr[] = $d['w_empleados_id'];
	    }
	    if( isset( $d['w_firmascomentariosestados_ids'] ) ){
	        $ids = $d['w_firmascomentariosestados_ids'];
	        $placeholders = implode(',', array_fill(0, count($ids), '?'));
	        $wh[] = "fircom.`firmascomentariosestados_id` IN (" . $placeholders . ")";
	        
	        foreach ( $ids as $vPr ) {
	            $pr[] = $vPr;
	        }
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr); //Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 74 - Crear funci&oacute;n que modifique los datos de la tabla firmascomentarios
	 */
	public static function firmascomentarios_Modificar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb  = "firmascomentarios ";
	    $aSt = array();
	    if (isset( $d['valor'] ) ) {
	        $aSt['valor'] = $d['valor'] ;
	    }
	    if (isset( $d['firmascomentariosestados_id'] ) ) {
	        $aSt['firmascomentariosestados_id'] = $d['firmascomentariosestados_id'] ;
	    }
	    if (isset( $d['empleados'] ) ) {
	        $aSt['empleados'] = $d['empleados'] ;
	        $aSt['empleadosfecha'] = date('Y-m-d H:i:s') ;
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $aSt['empleados_id'] = $d['empleados_id'] ;
	    }
	    
	    $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[] = $d['id'];
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = $wh;
	    
	    //$sqlPart = implode(', ', array_map(function($k, $v) {return $k . " = '" . addslashes($v) . "'";}, array_keys($aSt), $aSt));
	    //die('UPDATE ' . $tb . ' SET ' . $sqlPart . ' WHERE ' . $xt);
	    
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception($th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 75 - Crear funci&oacute;n que eliminar los datos de la tabla la tabla firmascomentarios
	 */
	public static function firmascomentarios_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $xt = '';
	    if ( isset( $d['id'] ) ) {
	        $xt = "SIID";
	        try {
	            self::firmascomentarios_Modificar( ['id' => $d['id'], 'firmascomentariosestados_id' => 5 ] );
	        } catch (Exception $e) {
	            throw new \Exception( $e->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        }
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    return  true;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 76 - Crear funci&oacute;n maneje los comentarios eliminados de la tabla firmascomentarios
	 */
	public static function firmascomentarios_Helper_Eliminar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $qryPkcom = [];
	    try {
	        $qryPkcom = self::firmascomentarios_Eliminar( $json );
	    } catch (Exception $e) {
	        throw new Exception('firmascomentarios_Helper_Eliminar - firmascomentarios_Eliminar: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    return $qryPkcom;
	}
	
	// Firmascomentarios FIN
	
	// Paquetereqtipos INI
	public static function paquetereqtipos_Obtener( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA);
	    }
	    $d['tabla'] = 'paquetereqtipos';
	    //$d['debug'] = true;
	    $r = Singleton::_readEstado( $d );
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    return $r;
	}
	// Paquetereqtipos FIN
	
	// requerimientostpls INI
	public static function requerimientostpls_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "requerimientostpls ";
	    $aSt = array();
	    if ( isset( $d['nombre'] ) ) {
	        $aSt['nombre'] = $d['nombre'] ;
	    }
	    if ( isset( $d['requerimientostplsestados_id'] ) ) {
	        $aSt['requerimientostplsestados_id'] = $d['requerimientostplsestados_id'];
	    }
	    $aSt['usuariosmod'] = $usu->getNombres() . ' ' . $usu->getApellidos() ;
        $aSt['fechamod'] = date('Y-m-d H:i:s') ;
	    
	    $id = 0;
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $id = $d['id'];
	        $wh  = 'id = ?';
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] requerimientostpls_Modificar: Debe indicar un filtro para actualizar' );
	    }
	    
	    $xt = $wh;
	    $pr = [ $id ];
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'requerimientostpls_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	private static function requerimientostpls_Mezclar( $d ){
	    $cfg = OperacionesCtrl::LeerConfigCorp();
	    $_CFG_REQUERIMIENTOS_MEZCLA = json_decode( (isset( $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]) ? $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]["val"] : '[]' ), true );
	    
	    $nwJs = [];
	    $i = 0;
	    $ufull = "";
	    foreach ( $d as $kRq ) {
	        $i = $kRq['id'];
	        $activo = ($kRq['activo'] ? 1 : 0);
	        $nwJs[] = [ 'vl' => $kRq['vl'] , 'activo' => $activo ] ;
	        $ufull = $kRq['ufull'];
	    }
	    
	    $_CFG_REQUERIMIENTOS_MEZCLA[ $i ] = $nwJs;
	    
	    self::EscribirConfig( ['id' => OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA, 'vl' => json_encode( $_CFG_REQUERIMIENTOS_MEZCLA ), 'ufull' => $ufull ] );
	}
	public static function requerimientostpls_Helper_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] requerimientostpls_Helper_Agregar: " . $e->getMessage() );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $cfgTpls = array(
	        'nombre' => $json['name'],
	        'fecha' => date('Y-m-d H:i:s'),
	        'usuarios' => $usu->getNombres() . ' ' . $usu->getApellidos()
	    );
	    //die( print_r( $json , true ) );
	    $tpls_id = 0;
	    if ( isset( $json[ 'id' ] ) ) {
	        $tpls_id = $json[ 'id' ];
	        
	        try {
	            self::requerimientostpls_Modificar( array('id' => $tpls_id, 'nombre' => $json['name'] ) );
	        } catch (Exception $e) {
	            throw new Exception( 'requerimientostpls_Helper_Agregar - requerimientostpls_Modificar: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    else {
	        $tpls_id = self::requerimientostpls_Agregar( $cfgTpls );
	    }
	    
	    foreach ( $json as $kJson => $vJson ) {
	        $partes = explode( '_' , $kJson);
	        
	        if ( $partes[ 0 ] == 'ref' ) {
	            $modId = intval( $json[ 'id_' . end($partes) ] );
	            $reqbool = 0;
	            if ( $json[ 'requerido_' . end($partes) ] == 1 ) {
	                $reqbool = 1;
	            }
	            $newjson = array(
	                "ref" => $json[ 'ref_' . end($partes) ],
	                "paquetereqtipos_id" => $json[ 'paquetereqtipos_id_' . end($partes) ],
	                "descripcion" => $json[ 'descripcion_' . end($partes) ],
	                "requerimientostpls_id" => $tpls_id,
	                "id" => $modId,
	                "requerido" => $reqbool,
	                "acepta" => $json[ 'acepta_' . end($partes) ],
	            );
	            if ( $modId > 0 ) {
	                try {
	                    self::requerimientostplsitems_Modificar( $newjson );
	                } catch (Exception $e) {
	                    throw new Exception( 'requerimientostpls_Helper_Agregar - requerimientostplsitems_Agregar: ' . $e->getMessage(), $e->getCode() );
	                }
	            }
	            else {
	                try {
	                    self::requerimientostplsitems_Agregar( $newjson );
	                } catch (Exception $e) {
	                    throw new Exception( 'requerimientostpls_Helper_Agregar - requerimientostplsitems_Agregar: ' . $e->getMessage(), $e->getCode() );
	                }
	            }
	            
	        }
	        
	    }
	    
	    return $json;
	}
	public static function requerimientostpls_Obtener_Ajax( $d ) {
	    date_default_timezone_set('America/Bogota');
	    return Singleton::_dataTable( array( 'tb' => 'requerimientostpls', 'codifica_a' => IndexCtrl::CHARS_TO, 'codifica_desde' => IndexCtrl::CHARS_FR ) );
	}
	public static function requerimientostpls_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Requerimientostpls();
	    if (isset( $d['nombre'] ) ) {
	        $o->setNombre( $d['nombre'] );
	    }
	    if (isset( $d['usuarios'] ) ) {
	        $o->setUsuarios( $d['usuarios'] );
	    }
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    if (isset( $d['requerimientostplsestados_id'] ) ) {
	        $o->setRequerimientostplsestados_id( $d['requerimientostpl_Agregar'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function requerimientostpls_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "requerimientostpls_Eliminar: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb = "requerimientostpls ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'requerimientostpls_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'requerimientostpls_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	public static function requerimientostpls_Obtener( $d ) {
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] requerimientostpls_Obtener: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "req.`id`, req.`nombre`, req.`usuarios`, req.`fecha`, req.`requerimientostplsestados_id`,";
	    $vr .= "reqest.nombre as requerimientostplsestados, req.`usuariosmod`, req.`fechamod`  ";
	    
	    $tb  = '`requerimientostpls` as req ';
	    
	    $jn  = 'LEFT JOIN requerimientostplsestados as reqest on req.requerimientostplsestados_id = reqest.id ';
	    
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "reqs.`id` = " . $d['id'] . " ";
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    //die( "SELECT " . $vr . "\nFROM " . $tb . "\n" . $xt );
	    $r = Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] requerimientostpls_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// requerimientostpls FIN
	
	// requerimientostplsitems INI
	public static function requerimientostplsitems_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] requerimientostplsitems_Eliminar: " . $e->getMessage() );
	    }
	    
	    $tb = "requerimientostplsitems ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( isset( $d['w_requerimientostpls_id'] ) ) {
	        $xt = "WHERE requerimientostpls_id = " . $d['w_requerimientostpls_id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'requerimientostplsitems_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'requerimientostplsitems_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	public static function requerimientostplsitems_Modificar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "requerimientostplsitems ";
	    $aSt = array();
	    if ( isset( $d['ref'] ) ) {
	        $aSt['ref'] = $d['ref'] ;
	    }
	    if ( isset( $d['paquetereqtipos_id'] ) ) {
	        $aSt['paquetereqtipos_id'] = $d['paquetereqtipos_id'] ;
	    }
	    if ( isset( $d['descripcion'] ) ) {
	        $aSt['descripcion'] = $d['descripcion'] ;
	    }
	    if ( isset( $d['requerimientostpls_id'] ) ) {
	        $aSt['requerimientostpls_id'] = $d['requerimientostpls_id'] ;
	    }
	    if ( isset( $d['requerido'] ) ) {
	        $aSt['requerido'] = $d['requerido'] ;
	    }
	    if ( isset( $d['acepta'] ) ) {
	        $aSt['acepta'] = $d['acepta'] ;
	    }
	    
	    $id = 0;
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $id = $d['id'];
	        $wh  = 'id = ?';
	    }
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] requerimientostplsitems_Modificar: Debe indicar un filtro para actualizar' );
	    }
	    
	    $xt = $wh;
	    $pr = [ $id ];
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'requerimientostplsitems_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function requerimientostplsitems_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Requerimientostplsitems();
	    if (isset( $d['ref'] ) ) {
	        $o->setRef( $d['ref'] );
	    }
	    if (isset( $d['paquetereqtipos_id'] ) ) {
	        $o->setPaquetereqtipos_id( $d['paquetereqtipos_id'] );
	    }
	    if (isset( $d['descripcion'] ) ) {
	        $o->setDescripcion( $d['descripcion'] );
	    }
	    if (isset( $d['requerimientostpls_id'] ) ) {
	        $o->setRequerimientostpls_id( $d['requerimientostpls_id'] );
	    }
	    if (isset( $d['requerido'] ) ) {
	        $o->setRequerido( $d['requerido'] );
	    }
	    if (isset( $d['acepta'] ) ) {
	        $o->setAcepta( $d['acepta'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	
	public static function requerimientostplsitems_Helper_Obtener ( $d ){
	    $requerimientostplsitems = self::requerimientostplsitems_Obtener( $d );
	    return ['items' => $requerimientostplsitems];
	}
	
	public static function requerimientostplsitems_Obtener ( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] requerimientostplsitems_Obtener: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "reqs.`id`, reqs.`ref`, refl.label as ref_label, refl.nombre as ref_nombre, reqs.`descripcion`, reqs.`requerimientostpls_id`, reqs.`paquetereqtipos_id`, pcktp.nombre as paquetereqtipos, ";
	    $vr .= "tpls.nombre as requerimientostpls_nombre, tpls.usuarios as requerimientostpls_usuarios, tpls.fecha as requerimientostpls_fecha, ";
	    $vr .= "tpls.requerimientostplsestados_id , resta.nombre as requerimientostplsestados, reqs.requerido, reqs.acepta ";
	    
	    $tb  = '`requerimientostplsitems` reqs ';
	    
	    $jn  = 'LEFT JOIN requerimientostpls as tpls on tpls.id = reqs.requerimientostpls_id ';
	    $jn .= 'LEFT JOIN requerimientostplsestados as resta on tpls.requerimientostplsestados_id = resta.id ';
	    $jn .= 'LEFT JOIN paquetereqtipos as pcktp on pcktp.id = reqs.paquetereqtipos_id ';
	    $jn .= 'LEFT JOIN reflista as refl on refl.id = (reqs.ref+0) ';
	    
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "reqs.`id` = " . $d['id'] . " ";
	    }
	    if( isset( $d['w_requerimientostpls_id'] ) ){
	        $wh[] = "reqs.`requerimientostpls_id` = " . $d['w_requerimientostpls_id'] . " ";
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    //die( "SELECT " . $vr . "\nFROM " . $tb . "\n" . $xt );
	    $r = Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] requerimientostplsitems_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// requerimientostplsitems FIN
	
	// flujos INI
	const FLUJOS_ESTADO_DETENIDO = '0x001';
	const FLUJOS_ESTADO_CORRIENDO = '0x002';
	public static function flujos_Estados_Helper_Modificar( $d ){
	    $data = base64_decode( $d['data'] );
	    $json = json_decode($data, true) ;
	    
	    $val = 1;
	    if ( $json['value'] == md5( self::FLUJOS_ESTADO_CORRIENDO ) ) {
	        $val = 2;
	    }
	    try {
	        self::flujos_Modificar( array( 'id' => $json['id'], 'flujosestados_id' => $val ) );
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL);
	        throw new Exception( 'flujos_Estados_Helper_Modificar - flujos_Modificar: ' . $e->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL);
	    }
	    return $json;
	}
	public static function flujos_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "flujos ";
	    $aSt = array();
	    if ( isset( $d['descripcion'] ) ) {
	        $aSt['descripcion'] = $d['descripcion'] ;
	    }
	    if ( isset( $d['flujosestados_id'] ) ) {
	        $aSt['flujosestados_id'] = $d['flujosestados_id'] ;
	    }
	    if ( isset( $d['nombre'] ) ) {
	        $aSt['nombre'] = $d['nombre'] ;
	    }
	    if ( isset( $d['version'] ) ) {
	        $aSt['version'] = $d['version'] ;
	    }
	    
	    $id = 0;
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $id = $d['id'];
	        $wh  = 'id = ?';
	    }
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] flujos_Modificar: Debe indicar un filtro para actualizar' );
	    }
	    
	    $xt = $wh;
	    $pr = [ $id ];
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'flujos_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function flujos_Obtener_Ajax( $d ) {
	    date_default_timezone_set('America/Bogota');
	    return Singleton::_dataTable( array( 'tb' => 'flujos', 'codifica_a' => IndexCtrl::CHARS_TO, 'codifica_desde' => IndexCtrl::CHARS_FR ) );
	}
	public static function flujos_Helper_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] flujos_Helper_Agregar: " . $e->getMessage() );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $version = 0;
	    
	    $cfgTpls = array(
	        'nombre' => $json['flu_nombre'],
	        'descripcion' => $json['flu_descripcion'],
	        'version' => $version,
	        'fecha' => date('Y-m-d H:i:s'),
	        'usuarios' => $usu->getNombres() . ' ' . $usu->getApellidos(),
	        'flujosestados_id' => 1
	    );
	    //die( print_r( $json , true ) );
	    $tpls_id = 0;
	    if ( isset( $json[ 'id' ] ) ) {
	        $tpls_id = $json[ 'id' ];
	        
	        try {
	            self::flujos_Modificar( array('id' => $tpls_id, 'nombre' => $json['flu_nombre'], 'descripcion' => $json['flu_descripcion'] ) );
	        } catch (Exception $e) {
	            throw new Exception( 'flujos_Helper_Agregar - flujos_Modificar: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    else {
	        $tpls_id = self::flujos_Agregar( $cfgTpls );
	    }
	    
	    //echo( 'json:' . print_r( $json , true ) . "\n");
	    
	    $docuactivos = array();
	    $orden = 0;
	    foreach ( $json as $kJson => $vJson ) {
	        $partes = explode( '_' , $kJson);
	        
	        if ( $partes[ 0 ] == 'correo' ) {
	            $modId = intval( $json[ 'id_' . end($partes) ] );
	            
	            $ordenTmp = $orden;
	            if ( isset( $json[ 'orden_' . end($partes) ] ) ) {
	                if ( intval( $json[ 'orden_' . end($partes) ] ) > 0  ) {
	                    $ordenTmp = $json[ 'orden_' . end($partes) ];
	                }
	            }
	            
	            $newjson = array(
	                "correo" => $json[ 'correo_' . end($partes) ],
	                "flujos_id" => $tpls_id,
	                "flujosroles_id" => $json[ 'flujosroles_id_' . end($partes) ],
	                "nombre" => $json[ 'nombre_' . end($partes) ],
	                "orden" => $ordenTmp,
	                "requerimientos" => $json[ 'requerimientos_' . end($partes) ],
	                "tel" => $json[ 'tel_' . end($partes) ],
	                "usuarios_id" => $json[ 'usuarios_id_' . end($partes) ],
	                "id" => $modId
	            );
	            
	            if ( $modId > 0 ) {
	                try {
	                    self::flujositems_Modificar( $newjson );
	                } catch (Exception $e) {
	                    throw new Exception( 'flujos_Helper_Agregar - flujositems_Modificar: ' . $e->getMessage(), $e->getCode() );
	                }
	            }
	            else {
	                try {
	                    self::flujositems_Agregar( $newjson );
	                } catch (Exception $e) {
	                    throw new Exception( 'flujos_Helper_Agregar - flujositems_Agregar: ' . $e->getMessage(), $e->getCode() );
	                }
	            }
	            
	            $orden++;
	            
	        }
	        
	        if ( $partes[0] == 'tpls' ) {
	            $docuactivos[] = ['id' => $tpls_id , 'vl' => $kJson, 'activo' => ( strlen( $vJson ) > 0 ), 'ufull' => trim( $usu->getNombres() . ' ' . $usu->getApellidos() ) ];
	        }
	    }
	    self::requerimientostpls_Mezclar( $docuactivos );
	    
	    return $json;
	}
	public static function flujos_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $o = new Flujos();
	    if (isset( $d['descripcion'] ) ) {
	        $o->setDescripcion( $d['descripcion'] );
	    }
	    $o->setFecha( date("Y-m-d H:i:s") );
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    if (isset( $d['flujosestados_id'] ) ) {
	        $o->setFlujosestados_id( $d['flujosestados_id'] );
	    }
	    if (isset( $d['nombre'] ) ) {
	        $o->setNombre( $d['nombre'] );
	    }
	    $o->setUsuarios( $usu->getNombres() . ' ' . $usu->getApellidos() );
	    if (isset( $d['version'] ) ) {
	        $o->setVersion( $d['version'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function flujos_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] flujos_Eliminar: " . $e->getMessage() );
	    }
	    
	    $tb = "flujos ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'flujos_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'flujos_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	public static function flujos_Obtener ( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] flujos_Obtener: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "flu.`id`, flu.`nombre`, flu.`descripcion`, flu.`usuarios`, flu.`version`, flu.`fecha`, ";
	    $vr .= "flu.`flujosestados_id`, fluest.nombre as flujosestados ";
	    
	    $tb  = '`flujos` as flu';
	    
	    $jn  = 'LEFT JOIN flujosestados as fluest on fluest.id = flu.flujosestados_id ';
	    
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "flu.`id` = " . $d['id'] . " ";
	    }
	    if( isset( $d['w_flujosestados_id'] ) ){
	        $wh[] = "flu.`flujosestados_id` = " . $d['w_flujosestados_id'] . " ";
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    //die( "SELECT " . $vr . "\nFROM " . $tb . "\n" . $xt );
	    $r = Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . '] flujos_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// flujos FIN
	
	// flujositems INI
	public static function flujositems_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "flujositems ";
	    $aSt = array();
	    if ( isset( $d['correo'] ) ) {
	        $aSt['correo'] = $d['correo'] ;
	    }
	    if ( isset( $d['flujos_id'] ) ) {
	        $aSt['flujos_id'] = $d['flujos_id'] ;
	    }
	    if ( isset( $d['flujositemestados_id'] ) ) {
	        $aSt['flujositemestados_id'] = $d['flujositemestados_id'] ;
	    }
	    if ( isset( $d['flujosroles_id'] ) ) {
	        $aSt['flujosroles_id'] = $d['flujosroles_id'] ;
	    }
	    if ( isset( $d['nombre'] ) ) {
	        $aSt['nombre'] = $d['nombre'] ;
	    }
	    if ( isset( $d['orden'] ) ) {
	        $aSt['orden'] = $d['orden'] ;
	    }
	    if ( isset( $d['requerimientos'] ) ) {
	        $aSt['requerimientos'] = $d['requerimientos'] ;
	    }
	    if ( isset( $d['tel'] ) ) {
	        $aSt['tel'] = $d['tel'] ;
	    }
	    if ( isset( $d['usuarios_id'] ) ) {
	        $aSt['usuarios_id'] = $d['usuarios_id'] ;
	    }
	    
	    $id = 0;
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $id = $d['id'];
	        $wh  = 'id = ?';
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] flujositems_Modificar: Debe indicar un filtro para actualizar' );
	    }
	    
	    $xt = $wh;
	    $pr = [ $id ];
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt, $pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'flujositems_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function flujositems_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $o = new Flujositems();
	    if (isset( $d['correo'] ) ) { $o->setCorreo( $d['correo'] ); }
	    if (isset( $d['flujos_id'] ) ) { $o->setFlujos_id( $d['flujos_id'] ); }
	    if (isset( $d['flujositemestados_id'] ) ) { $o->setFlujositemestados_id( $d['flujositemestados_id'] ); }
	    if (isset( $d['flujosroles_id'] ) ) { $o->setFlujosroles_id( $d['flujosroles_id'] ); }
	    if (isset( $d['nombre'] ) ) { $o->setNombre( $d['nombre'] ); }
	    if (isset( $d['orden'] ) ) { $o->setOrden( $d['orden'] ); }
	    if (isset( $d['requerimientos'] ) ) { $o->setRequerimientos( $d['requerimientos'] ); }
	    if (isset( $d['tel'] ) ) { $o->setTel( $d['tel'] ); }
	    if (isset( $d['usuarios_id'] ) ) { $o->setUsuarios_id( $d['usuarios_id'] ); }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function flujositems_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] flujositems_Eliminar: " . $e->getMessage() );
	    }
	    
	    $tb = "flujositems ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'flujositems_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'flujositems_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	
	// Helper para obtener los documentos que se mezclan y se veran por todo el flujo
	public static function flujositems_Pricipal_Helper_Obtener( $d ){
	    $cfg = OperacionesCtrl::LeerConfigCorp();
	    $_CFG_REQUERIMIENTOS_MEZCLA = json_decode( (isset( $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]) ? $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]["val"] : '[]' ), true );
	    
	    $rFlujos = self::flujositems_Obtener( $d );
	    $docs = array();
	    if ( isset( $_CFG_REQUERIMIENTOS_MEZCLA[ $d['w_flujos_id'] ] ) ) {
	        $docs = $_CFG_REQUERIMIENTOS_MEZCLA[ $d['w_flujos_id'] ];
	    }
	    
	    return [ 'data' => $rFlujos, 'documentos' => $docs ];
	}
	public static function flujositems_Obtener ( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] flujositems_Obtener: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "flui.`id`, flui.`nombre`, flui.`correo`, flui.`tel`, flui.`requerimientos`, flui.`orden`, ";
	    $vr .= "flui.`flujositemestados_id`, flui.`flujosroles_id`, flurol.nombre as flujosroles, flui.`flujos_id`, ";
	    $vr .= "flu.nombre as flujos_nombre, flu.descripcion as flujos_descripcion, flui.`usuarios_id`, trim(concat(usr.nombres, ' ', usr.apellidos)) as usuarios ";
	    
	    $tb  = '`flujositems` as flui ';
	    
	    $jn  = 'LEFT JOIN flujos as flu on flui.flujos_id = flu.id ';
	    $jn .= 'LEFT JOIN flujosroles as flurol on flui.flujosroles_id = flurol.id ';
	    $jn .= 'LEFT JOIN flujositemestados as fluitemest on flui.flujositemestados_id = fluitemest.id ';
	    $jn .= 'LEFT JOIN usuarios as usr on usr.id = flui.usuarios_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "flui.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_flujos_id'] ) ){
	        $wh[] = "flui.`flujos_id` = ?";
	        $pr[] = $d['w_flujos_id'];
	    }
	    if ( isset( $d[ 'w_usuarios_id' ] ) ) {
	        $wh[] = "flui.`usuarios_id` = ?";
	        $pr[] = $d['w_usuarios_id'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    $r = array();
	    try {
	        $r = Singleton::_safeRawQuery($sql, $pr);
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'paquetes_Obtener: ' . $e->getMessage() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	public static function flujositems_Helper_Obtener ( $d ){
	    //die( 'd: ' . print_r( $d, true ) );
	    self::authRequOff();
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $uDt = json_decode( base64_decode( $d['u'] ) , true );
	    $jslgn = $uDt['jslgn'];
	    $usr = json_decode( base64_decode( $jslgn ) , true );
	    
	    //die( 'json: ' . print_r($json, true ) );
	    
	    $cfg = array(
	        'id' => $json['flujositems_id'],
	        'ordenasc' => 6
	    );
	    
	    $ladata = self::paquetesrequ_Obtener( [ 'w_paquetes_id' => $json['id'] ] );
	    
	    //die( 'ladata: ' . print_r( $ladata , true ) );
	    
	    $obligacionesres = [];
	    
	    $r = self::flujositems_Obtener( $cfg );
	    $requerimientostpls_id = 0;
	    $flujos_id = 0;
	    foreach ( $r as $kR ) {
	        $requerimientostpls_id = $kR['requerimientos'];
	        $flujos_id = $kR['flujos_id'];
	    }
	    $t = array();
	    if ( $requerimientostpls_id > 0 ) {
	        $t = self::requerimientostplsitems_Obtener( array( 'w_requerimientostpls_id' => $requerimientostpls_id, 'ordenasc' => 1 ) );
	    }
	    //die( "t: " . print_r( $t, true ) );
	    $todoelflujo = self::flujositems_Obtener( [ 'w_flujos_id' => $flujos_id, 'ordenasc' => 6 ] );
	    
	    $tDef = array();
	    foreach ( $t as $kT ) {
	        if ( $kT['paquetereqtipos_id'] == 6 ) {
	            $tempData = self::componenteHTML( array( 'html' => $kT['descripcion'], 'solohtml' => true ) );
	            
	            $jsonFrm = [];
	            if ( isset( $tempData['id'] ) ) {
	                $jsonFrm = self::formularios_Obtener( array( 'id' => $tempData['id'] ) );
	                
	                foreach ( $jsonFrm as $vJson ) {
	                    $kT['descripcion'] = [ 'titulo' => $vJson['titulo'], 'descripcion' => $vJson['descripcion'], 'json' => $vJson['json'] ];
	                    $kT['ref_label'] = $tempData['id'];
	                    $tDef[] = $kT;
	                }
	            
	            }
	            
	        }
	        else if ( $kT['paquetereqtipos_id'] == 7 ) {
	            $jsObj = self::empleadosobjetivos_Obtener( [ 'w_empleados_id_md5' => $uDt['id'] , 'ordenasc' => 1 ] );
	            
	            //die( "jsObj:\n" . print_r( $jsObj, true ) );
	            
	            $kT['descripcion'] = [ 'titulo' => 'Obligaciones', 'descripcion' => 'Carga la informaci&oacute;n y evidencias de tus avances', 'json' => $jsObj ];
	            $kT['ref_label'] = $tempData['id'];
	            
	            $tDef[] = $kT;
	            
	            $tempobl = self::empleadosobjetivoslog_Obtener([
	                "w_empleados_id_md5" => $uDt['id'],
	                "w_requerimientostplsitems_id" => $kT['id'],
	                'w_paquetes_id' => $json['id']
	            ]);
	            foreach ($tempobl as $kTmp) {
	                $obligacionesres[] = [
	                    'archivos' => $kTmp['archivos'],
	                    'archivosges' => $kTmp['archivosges'],
	                    'descripcion' => $kTmp['descripcion'],
	                    'empleadosobjetivos_id' => $kTmp['empleadosobjetivos_id'],
	                    'id' => $kTmp['id'],
	                    'requerimientostplsitems_id' => $kTmp['requerimientostplsitems_id']
	                ];
	            }
	        }
	        else{
	            $tDef[] = $kT;
	        }
	    }
	    
	    $docs = self::flujositems_Archivos_Helper_Obtener( [ 'paquetes_id' => $json['id'], 'documento' => $usr['documento'], 'id' => $d['flujos_id'] ] );
	    
	    $arRes = array(
	        'obli' => base64_encode( json_encode( $obligacionesres ) ),
	        'items' => $r,
	        'requs' => $tDef,
	        'res' => base64_encode( json_encode( $ladata ) ),
	        'docs' => $docs,
	        'flujoinfo' => $todoelflujo
	    );
	    
	    return $arRes;
	}
	
	public static function flujositems_Helper_ObtenerRevisorData ( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "flujositems_Helper_ObtenerRevisorData: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );

	    $userQry = self::empleados_Obtener( [ 'id' => $json['empleados_id'] ] );
	    $user = [];
	    if ( count( $userQry ) > 0 ) {
	        $user = $userQry[ 0 ];
	    }
	    $qry = [
	        'documento' => $user[ 'documento' ],
	        'id' => $json['flujos_id'],
	        'paquetes_id' => $json['id'],
	        'firmados' => true
	    ];
	    $docs = self::flujositems_Archivos_Helper_Obtener( $qry );
	    
	    $flujositems = self::flujositems_Obtener( ['w_flujos_id' => $json['flujos_id'], 'ordenasc' => 6 ] );
	    
	    $pkreq = self::paquetesrequ_Obtener([ 'w_paquetes_id' => $json['id'] ]);
	    
	    $usr_perfilactual = 0;
	    $usrs = [];
	    foreach ($flujositems as $kItem) {
	        $actual = false;
	        if ( $kItem['id']  == $json['flujositems_id'] ) {
	            $actual = true;
	            
	            $usr_perfilactual = $kItem['flujosroles_id'];
	        }
	        $usractual = [
                'nombre' => $kItem['nombre'],
                'usuarios_id' => $kItem['usuarios_id'],
                'id' => $kItem['id'],
                'firmante' => $kItem['orden'] + 1,
                'actual' => $actual,
	            'flujosroles' => $kItem['flujosroles'],
	            'flujosroles_id' => $kItem['flujosroles_id']
            ];
	        
	        $usrs[] = $usractual;
	    }
	    
	    $mesAplica = [];
	    if ( $usr_perfilactual == 4 ) {
	        
	        // obtener las deducciones del supervisor contabilidad
	        $deduccDt = [];
	        $qryDeducc = self::deducciones_Obtener( [ 'w_paquetes_id' => $json['id'] ] );
	        foreach ($qryDeducc as $kDeduc) {
	            $deduccDt = json_decode( $kDeduc['valor'], true );
	        }
	        
	        // obtener datos de config por defecto
	        $qryMesAplica = self::datosmes_Obtener( [ 'w_mesaplica' => $json['mesaplica'] ] );
	        foreach ( $qryMesAplica as $kMesA ) {
	            $mesAplica = $kMesA;
	        }
	        $rEval = self::flujositems_Helper_EvaluarCriterio( $mesAplica );
	        
	        // reemplazamos los datos por defecto y dejamos los que puso el supervisor contabilidad
	        $i_v = 0;
	        foreach ($deduccDt as $kDed => $vDed) {
	            if (Utiles::ComienzaEn( $kDed, "deduc_cod")) {
	                $parts = explode("_", $kDed);
	                $rEval[ $i_v ]['cod'] = $deduccDt[ 'deduc_cod_' . $parts[ 2 ] ];
	                $rEval[ $i_v ]['desc'] = $deduccDt[ 'deduc_desc_' . $parts[ 2 ] ];
	                $rEval[ $i_v ]['perc'] = $deduccDt[ 'deduc_perc_' . $parts[ 2 ] ];
	                $i_v++;
	            }
	        }
	        
	        $mesAplica['deducciones'] = $rEval;
	    }
	    
	    $result = [
	        'docs' => $docs,
	        'firmantes' => $usrs,
	        'solicitante' => $user,
	        'paquete' => $pkreq,
	        'datosmes' => $mesAplica
	    ];
	    
	    return self::retorno($result, 0, '');
	}
	
	public static function flujositems_Helper_EvaluarCriterio ( $d ){
	    $cfg = self::LeerConfigCorp();
	    $_CFG_DEDUCCIONES_DATA = isset( $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]) ? $cfg[ OperacionesCtrl::CFG_DEDUCCIONES_DATA ]["val"] : base64_encode( '{}' );
	    $cfgDt = json_decode( base64_decode( $_CFG_DEDUCCIONES_DATA ) , true );
	    
	    $valorccobro = $d['valorccobro'];
	    
	    foreach ( $cfgDt as $kCfg ) {
	        $criterio = $kCfg['criterio'];
	        if ( count( $criterio ) == 1 ) {
	            $comp1 = $criterio[0];
	            if( $comp1['comparador'] == "mayor" ){
	                if( $valorccobro > intval( $comp1['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            elseif( $comp1['comparador'] == "mayorigual" ){
	                if( $valorccobro >= intval( $comp1['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            elseif( $comp1['comparador'] == "menor" ){
	                if( $valorccobro < intval( $comp1['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            elseif( $comp1['comparador'] == "menorigual" ){
	                if( $valorccobro <= intval( $comp1['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	        }
	        elseif ( count( $criterio ) == 2 ) {
	            $comp1 = $criterio[0];
	            $comp2 = $criterio[1];
	            
	            //> <
	            if( $comp1['comparador'] == "mayor" && $comp2['comparador'] == "menor" ){
	                if( $valorccobro > intval( $comp1['valor'] ) && $valorccobro < intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // >= <
	            elseif( $comp1['comparador'] == "mayorigual" && $comp2['comparador'] == "menor" ){
	                if( $valorccobro >= intval( $comp1['valor'] ) && $valorccobro < intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // > >
	            elseif( $comp1['comparador'] == "mayor" && $comp2['comparador'] == "mayor" ){
	                if( $valorccobro > intval( $comp1['valor'] ) && $valorccobro > intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // >= <= 
	            elseif( $comp1['comparador'] == "mayorigual" && $comp2['comparador'] == "menorigual" ){
	                if( $valorccobro >= intval( $comp1['valor'] ) && $valorccobro <= intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // > <=
	            elseif( $comp1['comparador'] == "mayor" && $comp2['comparador'] == "menorigual" ){
	                if( $valorccobro > intval( $comp1['valor'] ) && $valorccobro <= intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // >= >=
	            elseif( $comp1['comparador'] == "mayorigual" && $comp2['comparador'] == "mayorigual" ){
	                if( $valorccobro >= intval( $comp1['valor'] ) && $valorccobro <= intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // < <
	            elseif( $comp1['comparador'] == "menor" && $comp2['comparador'] == "menor" ){
	                if( $valorccobro < intval( $comp1['valor'] ) && $valorccobro < intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	            // <= <=
	            elseif( $comp1['comparador'] == "menorigual" && $comp2['menorigual'] == "menor" ){
	                if( $valorccobro <= intval( $comp1['valor'] ) && $valorccobro <= intval( $comp2['valor'] ) ){
	                    return $kCfg['deducciones'];
	                }
	            }
	        }
	    }
	    
	    return [];
	}
	
	public static function flujositems_Archivos_Helper_Obtener ( $d ){
	    $cfg = OperacionesCtrl::LeerConfigCorp();
	    $_CFG_REQUERIMIENTOS_MEZCLA = json_decode( (isset( $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]) ? $cfg[ OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA ]["val"] : '[]' ), true );
	    
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ]['id'];
	    $documento = $d['documento'];
	    $id = $d['id'];
	    $paquetes_id = $d['paquetes_id'];
	    
	    $bs = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR;
	    $urlbs = Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . "proc";
	    $anyo_doc = DIRECTORY_SEPARATOR . $c_anyo . DIRECTORY_SEPARATOR . $documento;
	    $bs_urlbs_anyo = $bs . $urlbs . $anyo_doc;
	    $urllink = '/' . $urlbs . $anyo_doc;
	    
	    $r = [];
	    
	    if ( isset( $_CFG_REQUERIMIENTOS_MEZCLA[ $id ] ) ) {
	        $docs_activos = $_CFG_REQUERIMIENTOS_MEZCLA[ $id ];
	        foreach ( $docs_activos as $kDoc ) {
	            
	            if ( $kDoc['activo'] === 1 ) {
	                $flid = preg_replace('/^tpls_/', '', $kDoc['vl'] );
	                
	                $flName = $flid . "_" . $paquetes_id . "_" . $c_anyo . ".pdf";
	                $fl = $bs_urlbs_anyo . DIRECTORY_SEPARATOR . $flName;
	                $resBsUrl = $urllink . "/" . $flName;
	                
	                $firId = self::firmaslog_Obtener([ 'w_pdfid' => ltrim( $resBsUrl, '/') , 'ordendesc' => 9, 'limite' => 1 ]);
	                
	                if ( isset( $d[ 'firmados' ] ) ) {
	                    if ( $d[ 'firmados' ] ) {
	                        $oriflPi = pathinfo( $fl );
	                        $fl = $oriflPi['dirname'] . "/" . $oriflPi['filename'] . "_fir." . $oriflPi['extension'];
	                        
	                        $flName = $flid . "_" . $paquetes_id . "_" . $c_anyo . "_fir.pdf";
	                        $resBsUrl = $urllink . "/" . $flName;
	                    }
	                }
	                //echo $fl . "\n";
	                if ( file_exists( $fl ) ) {
	                    $fReg = $firId[0];
	                    $firmas_id_data = [ 
	                        'firmas_id' => $fReg['firmas_id'], 
	                        'firmasestados_id' => $fReg['firmasestados_id'], 
	                        'firmaslog_id' => $fReg['id'] 
	                    ];
	                    
	                    $r[] = [ 'bs' => $resBsUrl, 'url' => rtrim( Utiles::getBaseUrl() , "/") . $urllink . "/" . $flName, 'firmas_id' => $firmas_id_data, 'paquetes_id' => $paquetes_id ];
	                    
	                }
	            }
	            
	        }
	    }
	    
	    return $r;
	}
	public static function flujositems_Helper_Eliminar ( $d ){
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $_id = $json['id'];
	    
	    self::paquetesrequ_Modificar( array( 'w_flujositems_id' => $_id ) );
	    self::paquetes_Modificar( array( 'w_flujositems_id' => $_id ) );
	    self::flujositems_Eliminar( array( 'id' => $_id ) );
	    
	    return true;
	}
	// flujositems FIN
	
	// flujosroles INI
	public static function flujosroles_Obtener( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA);
	    }
	    $d['tabla'] = 'flujosroles';
	    //$d['debug'] = true;
	    $r = Singleton::_readEstado( $d );
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    return $r;
	}
	// flujosroles FIN
	
	// flujositemestados INI
	public static function flujositemestados_Obtener( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA);
	    }
	    $d['tabla'] = 'flujositemestados';
	    //$d['debug'] = true;
	    $r = Singleton::_readEstado( $d );
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    return $r;
	}
	// flujositemestados FIN
	
	// flujosestados INI
	public static function flujosestados_Obtener( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA);
	    }
	    $d['tabla'] = 'flujosestados';
	    //$d['debug'] = true;
	    $r = Singleton::_readEstado( $d );
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    return $r;
	}
	// flujosestados FIN
	
	// paquetesestados INI
	public static function paquetesestados_Obtener( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA);
	    }
	    $d['tabla'] = 'paquetesestados';
	    //$d['debug'] = true;
	    $r = Singleton::_readEstado( $d );
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    return $r;
	}
	// paquetesestados FIN
	
	// paquetes INI
	public static function paquetes_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb  = "paquetes "; 
	    $aSt = array();
	    if ( isset( $d['nombre'] ) ) {
	        $aSt['nombre'] = $d['nombre'] ;
	    }
	    if ( isset( $d['usuariosmod'] ) ) {
	        $aSt['usuariosmod'] = $d['usuariosmod'] ;
	    }
	    if ( isset( $d['mesaplica'] ) ) {
	        $aSt['mesaplica'] = $d['mesaplica'] ;
	    }
	    if ( isset( $d['fechamodificado'] ) ) {
	        $aSt['fechamodificado'] = $d['fechamodificado'] ;
	    }
	    if ( isset( $d['paquetesestados_id'] ) ) {
	        $aSt['paquetesestados_id'] = $d['paquetesestados_id'] ;
	    }
	    if ( isset( $d['flujositems_id'] ) ) {
	        $aSt['flujositems_id'] = $d['flujositems_id'] ;
	    }
	    
	    $pr = array();
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr = [ $d['id'] ];
	    }
	    
	    if ( isset( $d['w_flujositems_id'] ) ) {
	        $wh  = 'flujositems_id = ?';
	        $pr = [ $d['w_flujositems_id'] ];
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] flujos_Modificar: Debe indicar un filtro para actualizar' );
	    }
	    
	    $xt = $wh;
	    
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'flujos_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function paquetes_Helper_Obtener_Ajax( $d ) {
	    self::authRequOff();
	    $r = [];
	    try {
	        $r = self::empleados_Obtener( [ 'w_id_md5' => $d['columns'][2]['search']['value'][0] ] );
	    } catch (Exception $e) {
	        throw new Exception('paquetes_Helper_Obtener_Ajax: ' . $e->getMessage(), $e->getCode() );
	    }
	    foreach ( $r as $kP ) {
	        $_POST['columns'][2]['search']['value'][0] = $kP['id'];
	    }
	    $tb = self::paquetes_Obtener_Ajax( [] );
	    return $tb;
	}
	public static function paquetes_Obtener_Ajax( $d ) {
	    date_default_timezone_set('America/Bogota');
	    return Singleton::_dataTable( array( 'tb' => 'paquetes', 'codifica_a' => IndexCtrl::CHARS_TO, 'codifica_desde' => IndexCtrl::CHARS_FR ) );
	}
	public static function paquetes_Home_Helper_Agregar( $d ){
	    self::authRequOff();
	    try {
	        return self::paquetes_Helper_Agregar( $d );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetes_Home_Helper_Agregar - paquetes_Helper_Agregar:' . $e->getMessage(), $e->getCode() );
	    }
	}
	public static function paquetes_Helper_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $flujos_id = $json['flujos_id'];
	    $mesaplica = $json['mesaplica'] . '-01 00:00:00';
	    
	    $objFlujo = array();
	    try {
	        $objFlujo = self::flujos_Obtener( array( 'id' => $flujos_id ) );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetes_Helper_Agregar - flujos_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    $objEmpleados = array();
	    try {
	        $objEmpleados = self::empleados_Obtener( array( 'w_id_md5' => $json['empleados_id_cif'] ) );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetes_Helper_Agregar - empleados_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    $empleadosinfo = $objEmpleados[0];
	    
	    $objFlujositems = array();
	    try {
	        $objFlujositems = self::flujositems_Obtener( array( 'w_flujos_id' => $flujos_id, 'ordenasc' => 6, 'limite' => 1 ) );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetes_Helper_Agregar - flujositems_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    $qryPks = [ 'w_empleados_id' => $empleadosinfo['id'], 'w_mesaplica' => $mesaplica, 'w_flujos_id' => $flujos_id ];	    
	    $objPaquetesFechaUnica = array();
	    try {
	        $objPaquetesFechaUnica = self::paquetes_Obtener( $qryPks );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetes_Helper_Agregar - paquetes_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    if ( count( $objPaquetesFechaUnica ) > 0 ) { 
	        http_response_code( IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	        throw new Exception('No es posible radicar una solicitud en el mismo proceso y en el mismo mes', IndexCtrl::ERR_COD_REGISTRO_EXISTENTE );
	    }
	    
	    if ( count( $objFlujo ) > 0 ) {
	        $flujosinfo = $objFlujo[0];
	        $flujositemsinfo = $objFlujositems[0];
	        $cfgTpls = array(
	            'nombre' => $flujosinfo['nombre'] . '[' . $flujosinfo['version'] . '][' . $json['mesaplica'] . ']',
	            'empleados_id' => $empleadosinfo['id'],
	            'empleados' => trim( $empleadosinfo['nombres'] . ' ' . $empleadosinfo['apellidos'] ),
	            'mesaplica' => $mesaplica,
	            'fecha' => date('Y-m-d H:i:s'),
	            'flujositems_id' => $flujositemsinfo['id'],
	            'flujos_id' => $json['flujos_id'],
	            'paquetesestados_id' => 1
	        );
	        //die( print_r( $cfgTpls , true ) );
	        $tpls_id = 0;
	        if ( isset( $json[ 'id' ] ) ) {
	            $tpls_id = $json[ 'id' ];
	            
	            // consultamos si el paquete ya ha sido revisado
	            $objPaquetes = array();
	            try {
	                $objPaquetes = self::paquetes_Obtener( array( 'id' => $tpls_id ) ) ;
	            } catch (Exception $e) {
	                throw new Exception( 'paquetes_Helper_Agregar - paquetes_Obtener: ' . $e->getMessage(), $e->getCode() );
	            }
	            
	            if ( $objPaquetes[0]['paquetesestados_id'] == 1 ) {
	                try {
	                    self::paquetes_Modificar( array('id' => $tpls_id, 'nombre' => $json['nombre'], 'mesaplica' => $json['mesaplica'] ) );
	                } catch (Exception $e) {
	                    throw new Exception( 'flujos_Helper_Agregar - flujos_Modificar: ' . $e->getMessage(), $e->getCode() );
	                }
	            }
	            else {
	                http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	                throw new Exception('La solicituud ya ha cambiado de estado y no puede modificarse',IndexCtrl::ERR_COD_ACTUALIZACION_SQL);
	            }
	            
	        }
	        else {
	            try {
	                $tpls_id = self::paquetes_Agregar( $cfgTpls );
	            } catch (Exception $e) {
	                throw new Exception('paquetes_Helper_Agregar - paquetes_Agregar: ' . $e->getMessage(), $e->getCode() );
	            }
	        }
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	        throw new Exception('paquetes_Helper_Agregar: El flujo seleccionado no existe', IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA);
	    }
	    
	    return true;
	}
	
	public static function paquetes_Helper_MoverRevisar( $d ){
	    date_default_timezone_set('America/Bogota');
	    self::authRequOff();
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    /*
	    // Con estos datos llenar la tabla 'flujosseguimientos'
	    $udata = base64_decode( $d[ 'u' ] );
	    $u = json_decode( $udata, true );
	    */
	    
	    $idMod = $json['idMod'];
	    try {
	        self::paquetes_Modificar(['paquetesestados_id' => 2, 'id' => $idMod ]);
	    } catch (Exception $e) {
	        http_response_code( $e->getCode() );
	        return self::retorno([], $e->getCode(), $e->getMessage());
	    }
	    
	    return self::retorno([ 'data' => true ], 0, '');
	}
	public static function paquetes_Helper_MoverAdmin( $d ){
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "empleadosdetallescontrato_Agregar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    
	    $idMod = $json['idmod'];
	    $usuariosmod = trim( (string) $usu->getNombres() . " " . $usu->getApellidos() );
	    
	    $modCfg = [];
	    if ( isset( $json['fin'] ) ) {
	        if( $json['fin'] ) {
	            $modCfg = [];
	            $modCfg['paquetesestados_id'] = 4;
	            $modCfg['id'] = $idMod;
	            $modCfg['usuariosmod'] = $usuariosmod;
	            $modCfg['fechamodificado'] = date("Y-m-d H:i:s");
	        }
	    }
	    else {
	        $nid = $json['nid'];
	        $modCfg = [
	            'flujositems_id' => $nid,
	            'usuariosmod' => $usuariosmod,
	            'fechamodificado' => date("Y-m-d H:i:s"),
	            'id' => $idMod
	        ];
	    }
	    
	    try {
	        self::paquetes_Modificar( $modCfg );
	    } catch (Exception $e) {
	        http_response_code( $e->getCode() );
	        return self::retorno([], $e->getCode(), $e->getMessage());
	    }
	    
	    return self::retorno([ 'data' => $json ], 0, '');
	}
	public static function paquetes_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Paquetes();
	    if (isset( $d['nombre'] ) ) {
	        $o->setNombre( $d['nombre'] );
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $o->setEmpleados_id( $d['empleados_id'] );
	    }
	    if (isset( $d['empleados'] ) ) {
	        $o->setEmpleados( $d['empleados'] );
	    }
	    if (isset( $d['mesaplica'] ) ) {
	        $o->setMesaplica( $d['mesaplica'] );
	    }
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    if (isset( $d['flujositems_id'] ) ) {
	        $o->setFlujositems_id( $d['flujositems_id'] );
	    }
	    if (isset( $d['usuariosmod'] ) ) {
	        $o->setUsuariosmod( $d['usuariosmod'] );
	    }
	    if (isset( $d['fechamodificado'] ) ) {
	        $o->setFechamodificado( $d['fechamodificado'] );
	    }
	    if (isset( $d['paquetesestados_id'] ) ) {
	        $o->setPaquetesestados_id( $d['paquetesestados_id'] );
	    }
	    if (isset( $d['flujos_id'] ) ) {
	        $o->setFlujos_id( $d['flujos_id'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function paquetes_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] flujos_Eliminar: " . $e->getMessage() );
	    }
	    
	    $tb = "paquetes ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    if ( isset( $d['w_flujositems_id'] ) ) {
	        $xt = "WHERE flujositems_id = " . $d['w_flujositems_id'] . " ";
	    }
	    
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'flujos_Eliminar: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'flujos_Eliminar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	public static function paquetes_Obtener ( $d ){
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] paquetes_Obtener: " . $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "paqs.`id`, paqs.`nombre`, paqs.`empleados_id`, trim(concat(emple.nombres, ' ', emple.apellidos)) as empleados_nombre, ";
	    $vr .= "paqs.`empleados`, paqs.`mesaplica`, paqs.`fecha`, paqs.`flujositems_id`, ";
	    $vr .= "fluitems.nombre as flujositems, paqs.`usuariosmod`, paqs.`fechamodificado`, ";
	    $vr .= "paqs.`paquetesestados_id`, paqsest.nombre as paquetesestados, paqs.`flujos_id`, flu.nombre as flujos ";
	    
	    $tb  = '`paquetes` as paqs ';
	    
	    $jn  = 'LEFT JOIN empleados as emple on emple.id = paqs.empleados_id ';
	    $jn .= 'LEFT JOIN flujositems as fluitems on fluitems.id = paqs.flujositems_id ';
	    $jn .= 'LEFT JOIN paquetesestados as paqsest on paqsest.id = paqs.paquetesestados_id ';
	    $jn .= 'LEFT JOIN flujos as flu on flu.id = paqs.flujos_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "paqs.`id` = ?";
	        $pr[] = $d['id'] ;
	    }
	    if( isset( $d['w_empleados_id_md5'] ) ){
	        $wh[] = "md5(paqs.`empleados_id`) = ?";
	        $pr[] = $d['w_empleados_id_md5'] ;
	    }
	    if( isset( $d['w_empleados_id'] ) ){
	        $wh[] = "paqs.`empleados_id` = ?";
	        $pr[] = $d['w_empleados_id'] ;
	    }
	    if( isset( $d['w_mesaplica'] ) ){
	        $wh[] = "paqs.`mesaplica` = ?";
	        $pr[] = $d['w_mesaplica'];
	    }
	    if( isset( $d['w_flujos_id'] ) ){
	        $wh[] = "paqs.`flujos_id` = ?";
	        $pr[] = $d['w_flujos_id'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    $r = array();
	    try {
	        $r = Singleton::_safeRawQuery($sql, $pr);
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'paquetes_Obtener: ' . $e->getMessage() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// paquetes FIN
	
	// paquetesadminreg INI
	// TODO: Tarea 11 - ERP
	public static function paquetesadminreg_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Paquetesadminreg();
	    if (isset( $d['paquetes_id'] ) ) {
	        $o->setPaquetes_id( $d['paquetes_id'] );
	    }
	    if (isset( $d['razon'] ) ) {
	        $o->setRazon( $d['razon'] );
	    }
	    if (isset( $d['valor'] ) ) {
	        $o->setValor( $d['valor'] );
	    }
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    if (isset( $d['usuarios'] ) ) {
	        $o->setUsuarios( $d['usuarios'] );
	    }
	   
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function paquetesadminreg_Helper_Agregar( $d ){ 
		date_default_timezone_set('America/Bogota');

		$usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "paquetesadminreg_Helper_Agregar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );

		$valueForm = [
        "usuario_creado" => $json['usuario'] ?? null,
        "fecha_creacion" => $json['fecha'] ?? null,
		];
		$jsonValores = json_encode($valueForm);

		// Insertar en tabla de auditoria
		$dataAuditoria = [
			"paquetes_id" => $json['paquetes_id'], 
			"razon"       => Paquetesadminreg::CREACION_TERCERO,
			"valor"       => $jsonValores,
			"fecha"       => date("Y-m-d H:i:s"),
		    "usuarios"    => trim($usu->getNombres() . " " . $usu->getApellidos())
		];
	    try {
	        self::paquetesadminreg_Agregar( $dataAuditoria );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetesadminreg_Helper_Agregar - paquetesadminreg_Agregar: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    return true;
	    
	}

	public static function paquetesadminreg_Modificar( $d ){ 
		date_default_timezone_set('America/Bogota');
		try {
			self::authRequ();
		} catch (\Exception $e) {
			http_response_code(IndexCtrl::ERR_COD_SESION_INACTIVA);
			throw new \Exception('paquetesadminreg_Modificar: ' . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA);
		}
		$tb = 'paquetesadminreg';
		$aSt = array();
		if (isset($d['usuario'])) {
			$aSt['usuario_creado'] = $d['usuario'];
		}
		if (isset($d['fecha'])) {
			$aSt['fecha_creacion'] = $d['fecha'];
		}
		if (isset($d['valor'])) {
			$aSt['valor'] = $d['valor']; 
		}
		if (isset($d['usuariosmod'])) {
			$aSt['usuariosmod'] = $d['usuariosmod'];
		}
		if (isset($d['fechamodificado'])) {
			$aSt['fechamodificado'] = $d['fechamodificado'];
		}

		if (empty($aSt)) {
			http_response_code(IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO);
			throw new \Exception('[Error] paquetesadminreg_Modificar: No hay campos válidos para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO);
		}

		$wh = '';
		$pr = [];

		if (isset($d['id'])) {
			$wh = 'id = ?';
			$pr = [$d['id']];
		} 
		
		if ($wh == '') {
			http_response_code(IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO);
			throw new \Exception('[Error] paquetesadminreg_Modificar: Debe indicar un id o paquetes_id para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO);
		}
		try {
			$res = Singleton::_safeUpdate($tb, $aSt, $wh, $pr);
		} catch (\Throwable $th) {
			http_response_code(IndexCtrl::ERR_COD_ACTUALIZACION_SQL);
			throw new \Exception('paquetesadminreg_Modificar: ' . $th->getMessage(), IndexCtrl::ERR_COD_ACTUALIZACION_SQL);
		}

		return $res;
	}
	// paquetesadminreg FIN
	
	// paquetesrequ INI
	public static function paquetesrequ_Obtener( $d ){	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "pkreq.`id`, pkreq.`ref`, refl.id as ref_id, refl.label ref_label, pkreq.`valor`, pkreq.`descripcion`, pkreq.`paquetesreqestados_id`, ";
	    $vr .= "pkreqest.nombre as paquetesreqestados_nombre, pkreq.`paquetereqtipos_id`, pkreqtp.nombre as paquetereqtipos_nombre,";
	    $vr .= "pkreq.`paquetes_id`, pks.nombre as paquetes_nombre, pkreq.`flujositems_id`, flitems.nombre as flujositems_nombre, ";
	    $vr .= "pkreq.`valorgestor` ";
	    
	    $tb  = '`paquetesrequ` as pkreq ';
	    
	    $jn  = 'LEFT JOIN reflista as refl on refl.nombre = pkreq.ref ';
	    $jn .= 'LEFT JOIN paquetesreqestados as pkreqest on pkreqest.id = pkreq.paquetesreqestados_id ';
	    $jn .= 'LEFT JOIN paquetereqtipos as pkreqtp on pkreqtp.id = pkreq.paquetereqtipos_id ';
	    $jn .= 'LEFT JOIN paquetes as pks on pks.id = pkreq.paquetes_id ';
	    $jn .= 'LEFT JOIN flujositems as flitems on flitems.id = pkreq.flujositems_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "pkreq.`id` = ?";
	        $pr[] = $d['id'] ;
	    }
	    
	    if( isset( $d['w_paquetes_id'] ) ){
	        $wh[] = "pkreq.`paquetes_id` = ?";
	        $pr[] = $d['w_paquetes_id'];
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql . "\n" . print_r( $pr, true ));
	    $r = array();
	    try {
	        $r = Singleton::_safeRawQuery($sql, $pr);
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'empleados_Obtener: ' . $e->getMessage() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	
	const PAQUETES_FLDS_NAME = [ 0 => "packs" ];
	private static function paquetesrequ_Helper_Files( $d ) {
	    $anyo = OperacionesCtrl::anyolectivo_Obtener();
	    $c_anyo = $anyo[ 0 ]['id'];
	    
	    $base = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR ;
	    $anexos = Config::CARPETA_REPOSITORIOS . DIRECTORY_SEPARATOR . "anexos";
	    
	    $usr = $d['usr'];
	    $campo = $d[ 'campo' ];
	    $flname = str_replace(
	        [' ', '='],
	        ['_', '__'],
	        $campo
        );
	    $carpeta = self::PAQUETES_FLDS_NAME[ $d['carpeta'] ];
	    
	    $anexos = $base . $anexos ;
	    $anexos_anyo = $anexos . DIRECTORY_SEPARATOR. $c_anyo ;
	    $anexos_anyo_usr = $anexos_anyo . DIRECTORY_SEPARATOR . $usr;
	    $anexos_anyo_usr_frms = $anexos_anyo_usr . DIRECTORY_SEPARATOR . $carpeta;
	    
	    if ( !file_exists( $anexos_anyo ) ) mkdir( $anexos_anyo );
	    if ( !file_exists( $anexos_anyo_usr ) ) mkdir( $anexos_anyo_usr );
	    if ( !file_exists( $anexos_anyo_usr_frms ) ) mkdir( $anexos_anyo_usr_frms );
	    
	    $r = [ 
	        'isfile' => 0,
	        'path' => ''
	    ];
	    if ( isset( $_FILES[ $campo ] ) ) {
	        $fl = self::SubirArchivo( $flname, $anexos_anyo_usr_frms, $campo );
	        $r['isfile'] = 1;
	        $r['path'] = 'repo/anexos/' . $c_anyo . '/'  . $usr . '/' . $carpeta . '/' . $fl;
	    }
	    return $r;
	}
	
	private static function paquetesrequ_Helper_Forms( $d, $usr ){
	    $forms = array();
	    $requerimientostplsitems = array();
	    
	    foreach ( $d as $kJs => $vJs ) {
	        if ( Utiles::ComienzaEn($kJs, 'field')  ) {
	            
	            $frmParts = explode("_", $kJs);
	            $requerimientostplsitems_id = $frmParts[ 2 ];
	            
	            if ( !isset( $requerimientostplsitems[ $requerimientostplsitems_id ] ) ) {
	                $requerimientostplsitemsQry = self::requerimientostplsitems_Obtener( ['id' =>  $requerimientostplsitems_id ] );
	                $requerimientostplsitems[ $requerimientostplsitems_id ] = $requerimientostplsitemsQry[ 0 ]['descripcion'];
	            }
	            
	            $hldr_fl = self::paquetesrequ_Helper_Files( ['campo' => $kJs, 'carpeta' => 0, 'usr' => $usr ] );
	            $isfile = $hldr_fl['isfile'];
	            $valor = $vJs;
	            if ($isfile === 1) {
	                $valor = $hldr_fl['path'];
	            }
	            $hldr_fl['path'];
	            
	            $idlabel = 'ocul' . $kJs;
	            $forms[ $requerimientostplsitems_id ]['data'][] = [
	                'label' => $d[ $idlabel ],
	                'value' => $valor,
	                'field' => $kJs,
	                'file' => $isfile
	            ];
	            $forms[ $requerimientostplsitems_id ]['ref'] = $requerimientostplsitems[ $requerimientostplsitems_id ];
	        }
	    }
	    
	    return $forms;
	}
	
	public static function paquetesrequ_Helper_Agregar( $d ){
	    self::authRequOff();
	    
	    $data = base64_decode( $d['data'] );
	    $json = json_decode( $data , true );
	    
	    //die( 'json: ' . print_r( $json, true ) );
	    
	    $usr = [];
	    try {
	        $usr = self::home_Is_Login_Get( $json['token'] );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetesrequ_Helper_Agregar - home_Is_Login_Get: ' . $e->getMessage(), $e->getCode() );
	    }
	    //die( 'usr: ' . print_r( $usr, true ) );
	    $empleados = [];
	    try {
	        $empleados = self::empleados_Obtener( [ 'w_id_md5' => $usr['id'] ] );
	    } catch (Exception $e) {
	        throw new Exception( 'paquetesrequ_Helper_Agregar - empleados_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    //$empleadosContract = [];
	    if ( count( $empleados ) > 0 ) {
	        $empleado = $empleados[0];
	        //die( print_r( $empleado, true ) );
	        //die( print_r( $json, true ) );
	        
	        //$empleadosContract = self::empleadosdetallescontrato_Obtener( [ 'empleados_id' => $empleado['id'] ] );
	        
	        $requerimientostplsitems = self::requerimientostplsitems_Obtener( [] );
	        $paquetereqtipos_by_nombre = array();
	        foreach ( $requerimientostplsitems as $kItem ) {
	            $ref_nombre = str_replace( array("[", "]"), "", $kItem['ref_nombre'] );
	            $paquetereqtipos_by_nombre[ $ref_nombre ] = [ 'id'=> $kItem['id'], 'paquetereqtipos_id' => $kItem['paquetereqtipos_id'], 'requerimientostpls_id' => $kItem['requerimientostpls_id'] ];
	        }
	        $paquetes_id = $json[ 'paquetes_id' ];
	        
	        $paquetesrequ_exists = array();
	        try {
	            $paquetesrequ_exists = self::paquetesrequ_Obtener( [ 'w_paquetes_id' => $paquetes_id, 'w_paquetesreqestados_id' => 1 ] );
	        } catch (Exception $e) {
	            throw new Exception ( 'paquetesrequ_Helper_Agregar - v1: ' . $e->getMessage(), $e->getCode() );
	        }
	        
	        // Obtenemos el id del flujo que esta en la tabla flujositems para obtener los documentos que se pueden generar
	        $paquetes_flujos_id = array();
	        try {
	            $paquetes_flujos_id = self::paquetes_Obtener( ['id' => $paquetes_id] );
	        } catch (Exception $e) {
	            throw new Exception ( 'paquetesrequ_Helper_Agregar: ' . $e->getMessage(), $e->getCode() );
	        }
	        
	        //echo "json:\n" . print_r( $json, true );
	        //die( 'flujositems_flujos_id: ' . print_r( $flujositems_flujos_id , true ) );
	        
	        $addnuevo = true;
	        $msjReturn = "Datos guardados con \xE9xito";
	        if (count( $paquetesrequ_exists ) > 0 )
	        {
	            $addnuevo = false;
	            $msjReturn = 'Actualizaci\xF3n exitosa';
	        }
	        
	        //echo "paquetesrequ_exists: ";
	        //die( print_r( $paquetesrequ_exists , true ) );
	        $primero = true;
	        $paquetesrequ_id = 0;
	        foreach ( $json as $kJs => $vJs ) {
	            $partes = explode("_", $kJs);
	            
	            if ( isset ( $partes[1] ) ) {
	                $formid = $partes[0];
	                $idlog = $partes[1];
	                
	                if( Utiles::ComienzaEn($formid, 'oblicom') ){
	                    
	                    $requerimientostplsitems_id = $json[ 'obliregid_' . $idlog ];
	                    
	                    $idfileadjunto = 'oblifile_' . $idlog;
	                    $archivos = self::empleadosobjetivoslog_Helper_Archivos( [ 'id' => $idfileadjunto, 'documento' => $empleado['documento'] ] );
	                    
	                    if ($primero) {
	                        
	                        foreach ( $paquetesrequ_exists as $pkEx ) {
	                            if ($pkEx['ref'] == '[obligaciones]') {
	                                $paquetesrequ_id = $pkEx['id'];
	                            }
	                        };
	                        
	                        if ( $paquetesrequ_id == 0 ) {
	                            $regs = [
	                                'ref' => '[obligaciones]',
	                                'valor' => 'obligaciones',
	                                'paquetesreqestados_id' => 1,
	                                'paquetereqtipos_id' => 7,
	                                'paquetes_id' => $json[ 'paquetes_id' ],
	                                'flujositems_id' => $json['flujositems_id'],
	                                'usuariomodifica' => trim((string)$empleado['nombres'] . ' ' . $empleado['apellidos']),
	                                'perfilmodifica' => $empleado['perfil']
	                            ];
	                            try {
	                                $paquetesrequ_id = self::paquetesrequ_Agregar( $regs );
	                            } catch (Exception $e) {
	                                throw new Exception( 'paquetesrequ_Helper_Agregar - paquetesrequ_Agregar (Obli): ' . $e->getMessage(), $e->getCode() );
	                            }
	                        }
	                        $primero = false;
	                    }
	                    
	                    $regsOb = [
	                        'idlog' => $idlog,
	                        'descripcion' => $vJs,
	                        'archivos' => $archivos,
	                        'empleados' => trim((string)$empleado['nombres'] . ' ' . $empleado['apellidos']),
	                        'empleadosobjetivos_id' => $idlog,
	                        'requerimientostplsitems_id' => $requerimientostplsitems_id,
	                        'paquetesrequ_id' => $paquetesrequ_id
	                    ];
	                    self::empleadosobjetivoslog_Helper_Agregar( $regsOb );
	                }
	            }
	        }
	        
	        // Campos con funciones especificas
	        foreach ( $json as $kJs => $vJs ) {
	            $partes = explode("_", $kJs);
	            $formid = $partes[0];
	            
	            if( !( Utiles::ComienzaEn($formid, 'field') || Utiles::ComienzaEn($formid, 'oculfield') ) ){
	                // Campos con uso predefinido
	                if( isset( $paquetereqtipos_by_nombre[ $formid ] ) ){
	                    $paquetesrequ_id = 0;
	                    
	                    $tipocampo = $paquetereqtipos_by_nombre[ $formid ];
	                    $valor = $vJs;
	                    if ( $tipocampo['paquetereqtipos_id'] == 4 ) {
	                        $hldr_fl = self::paquetesrequ_Helper_Files( ['campo' => $kJs, 'carpeta' => 0, 'usr' => $empleado['documento'] ] );
	                        $valor = $hldr_fl['path'];
	                    }
	                    
	                    $regs = [
	                        'ref' => '[' . $formid . ']',
	                        'valor' => $valor,
	                        'paquetesreqestados_id' => 1,
	                        'paquetereqtipos_id' => $tipocampo['paquetereqtipos_id'],
	                        'paquetes_id' => $json[ 'paquetes_id' ],
	                        'flujositems_id' => $json['flujositems_id'],
	                        'usuariomodifica' => trim((string)$empleado['nombres'] . ' ' . $empleado['apellidos']),
	                        'perfilmodifica' => $empleado['perfil']
	                    ];
	                    if( $addnuevo ){
	                        try {
	                            self::paquetesrequ_Agregar( $regs );
	                        } catch (Exception $e) {
	                            throw new Exception( 'paquetesrequ_Helper_Agregar - paquetesrequ_Agregar (campos): ' . $e->getMessage(), $e->getCode() );
	                        }
	                    }
	                    else {
	                        if ( strlen( trim((string)$valor) ) > 1 ) {
	                            foreach ( $paquetesrequ_exists as $pkEx ) {
	                                if ($pkEx['ref'] == '[' . $formid . ']' ) {
	                                    $paquetesrequ_id = $pkEx['id'];
	                                }
	                            };
	                            
	                            $regs['id'] = $paquetesrequ_id;
	                            try {
	                                self::paquetesrequ_Modificar( $regs );
	                            } catch (Exception $e) {
	                                throw new Exception( 'paquetesrequ_Helper_Agregar - paquetesrequ_Modificar (campos): ' . $e->getMessage(), $e->getCode() );
	                            }
	                        }
	                    }
	                }
	                
	            }
	        }
	        
	        // Formularios
	        $frms = self::paquetesrequ_Helper_Forms( $json, $empleado['documento'] );
	        if ( count( $frms ) > 0 ) {
	            foreach ( $frms as $kFrm ) {
	                $data = $kFrm['data'];
	                $ref = $kFrm['ref'];
	                $regs = [
	                    'ref' => $ref,
	                    'valor' => json_encode( $data , JSON_UNESCAPED_UNICODE ),
	                    'paquetesreqestados_id' => 1,
	                    'paquetereqtipos_id' => 6,
	                    'paquetes_id' => $json[ 'paquetes_id' ],
	                    'flujositems_id' => $json['flujositems_id'],
	                    'usuariomodifica' => trim((string)$empleado['nombres'] . ' ' . $empleado['apellidos']),
	                    'perfilmodifica' => $empleado['perfil']
	                ];
	                $paquetesrequ_id = 0;
	                foreach ( $paquetesrequ_exists as $pkEx ) {
	                    if ($pkEx['ref'] == $ref ) {
	                        $paquetesrequ_id = $pkEx['id'];
	                    }
	                };
	                if ( $paquetesrequ_id == 0) {
	                    $addnuevo = true;
	                }
	                
	                if( $addnuevo ){
	                    try {
	                        self::paquetesrequ_Agregar( $regs );
	                    } catch (Exception $e) {
	                        throw new Exception( 'paquetesrequ_Helper_Agregar - paquetesrequ_Agregar (forms): ' . $e->getMessage(), $e->getCode() );
	                    }
	                }
	                else {
	                    $regs['id'] = $paquetesrequ_id;
	                    try {
	                        self::paquetesrequ_Modificar( $regs );
	                    } catch (Exception $e) {
	                        throw new Exception( 'paquetesrequ_Helper_Agregar - paquetesrequ_Modificar (forms): ' . $e->getMessage(), $e->getCode() );
	                    }
	                }
	            }
	        }
	        
	        $paquetesrequ_exists = array();
	        try {
	            $paquetesrequ_exists = self::paquetesrequ_Obtener( [ 'w_paquetes_id' => $paquetes_id, 'w_paquetesreqestados_id' => 1 ] );
	        } catch (Exception $e) {
	            throw new Exception ( 'paquetesrequ_Helper_Agregar - v2: ' . $e->getMessage(), $e->getCode() );
	        }
	        
	        $obligaciones = [];
	        foreach ($paquetesrequ_exists as $kPcks) {
	            if ( $kPcks['ref'] == '[obligaciones]' ) {
	                $objetivoslog = self::empleadosobjetivoslog_Obtener( [ 'w_paquetesrequ_id' => $kPcks['id'], 'ordenasc' => 1 ] );
	                foreach ( $objetivoslog as $vObjLog ) {
	                    $obligaciones[] = [
	                        'archivos' => $vObjLog['archivos'],
	                        'descripcion' => $vObjLog['empleadosobjetivos_descripcion'],
	                        'valor' => $vObjLog['descripcion']
	                    ];
	                }
	            };
	        }
	        
	        $docsgen = self::editarPlantillas_JBB_Mezclar_Crear( [
	            'documentos' => $paquetes_flujos_id, 
	            'empleado' => $empleado, 
	            //'emplcontract' => $empleadosContract,
	            'paquetesrequ' => $paquetesrequ_exists,
	            'obligaciones' => base64_encode( json_encode( $obligaciones ) )
	        ] );
	        
	        $retorno = [
	            "creado" => true,
	            "docs" => $docsgen
	        ];
	        
	        return self::retorno($retorno, 0, $msjReturn);
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	        throw new Exception( 'paquetesrequ_Helper_Agregar: Empleado no existe', IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	    }
	}
	
	public static function paquetesrequ_Agregar( $d ){
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Paquetesrequ();
	    if (isset( $d['ref'] ) ) {
	        $o->setRef( $d['ref'] );
	    }
	    if (isset( $d['valor'] ) ) {
	        $o->setValor( $d['valor'] );
	    }
	    if (isset( $d['descripcion'] ) ) {
	        $o->setDescripcion( $d['descripcion'] );
	    }
	    if (isset( $d['paquetesreqestados_id'] ) ) {
	        $o->setPaquetesreqestados_id( $d['paquetesreqestados_id'] );
	    }
	    if (isset( $d['paquetereqtipos_id'] ) ) {
	        $o->setPaquetereqtipos_id( $d['paquetereqtipos_id'] );
	    }
	    if (isset( $d['paquetes_id'] ) ) {
	        $o->setPaquetes_id( $d['paquetes_id'] );
	    }
	    if (isset( $d['flujositems_id'] ) ) {
	        $o->setFlujositems_id( $d['flujositems_id'] );
	    }
	    if (isset( $d['valor'] ) ) {
	        $o->setValor( $d['valor'] );
	    }
	    
	    $o->setFecha( date("Y-m-d H:i:s" ) );
	    $o->setFechamod( date("Y-m-d H:i:s" ) );
	    if (isset( $d['usuariomodifica'] ) ) {
	        $o->setUsuariomodifica( $d['usuariomodifica'] );
	    }
	    if (isset( $d['perfilmodifica'] ) ) {
	        $o->setPerfilmodifica( $d['perfilmodifica'] );
	    }
	    
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada' , IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function paquetesrequ_Modificar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "paquetesrequ ";
	    $aSt = array(); 
	    if ( isset( $d['ref'] ) ) {
	        $aSt['ref'] = $d['ref'] ;
	    }
	    if ( isset( $d['valor'] ) ) {
	        $aSt['valor'] = $d['valor'] ;
	    }
	    if ( isset( $d['descripcion'] ) ) {
	        $aSt['descripcion'] = $d['descripcion'];
	    }
	    if ( isset( $d['paquetesreqestados_id'] ) ) {
	        $aSt['paquetesreqestados_id'] = $d['paquetesreqestados_id'];
	    }
	    if ( isset( $d['paquetereqtipos_id'] ) ) {
	        $aSt['paquetereqtipos_id'] = $d['paquetereqtipos_id'] ;
	    }
	    if ( isset( $d['paquetes_id'] ) ) {
	        $aSt['paquetes_id'] = $d['paquetes_id'] ;
	    }
	    if ( isset( $d['flujositems_id'] ) ) {
	        $aSt['flujositems_id'] = $d['flujositems_id'] ;
	    }
	    $aSt['fechamod'] = date('Y-m-d H:i:s');
	    
	    $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[] = $d['id'];
	    }
	    if ( isset( $d['w_flujositems_id'] ) ) {
	        $wh  = 'flujositems_id = ?';
	        $pr[] = $d['w_flujositems_id'] ;
	    }
	    
	    if ( isset( $d['w_ref'] ) ) {
	        $wh  = 'ref = ?';
	        $pr[] = $d['w_ref'] ;
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . '] paquetesrequ_Modificar: Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = $wh;
	    
	    //die('UPDATE ' . $tb . ' SET ' . implode(',', $aSt) . ' WHERE ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'paquetesrequ_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function paquetesrequ_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "[" . IndexCtrl::ERR_COD_SESION_INACTIVA . "] paquetesrequ: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb = "paquetesrequ ";
	    $xt = '';
	    
	    if ( isset( $d['id'] ) ) {
	        $xt = "WHERE id = " . $d['id'] . " ";
	    }
	    if ( isset( $d['w_flujositems_id'] ) ) {
	        $xt = "WHERE flujositems_id = " . $d['w_flujositems_id'] . " ";
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'paquetesrequ: Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    try {
	        return Singleton::_classicDelete( $tb, $xt );
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'paquetesrequ: ' . $th->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	}
	// paquetesrequ FIN
	
	// paquetesreqcomentarios INI
	/*
	 * @yalfonso
	 * TODO: Tarea 46 - Crear funci&oacute;n que ayude a agregar o modificar la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Helper_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $idreg = 0;
	    
	    $texto = trim($json['valor']);
	    if( !(strlen( $texto ) > 0)  ){
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        return self::retorno( [], IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO, 'paquetesreqcomentarios_Helper_Agregar: El campo valor no tiene datos' ) ;
	    }
	    $valor = strip_tags($texto);
	    $valor = htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
	    $valor = trim($valor);
	    
	    if ( isset( $json['id'] ) ) {
	        $idreg = $json['id'];
	        try {
	            self::paquetesreqcomentarios_Modificar( [ "id" => $json['id'], "valor" => $valor ] );
	        } catch (Exception $e) {
	            http_response_code( $e->getCode() );
	            return self::retorno( [], $e->getCode(), 'paquetesreqcomentarios_Helper_Agregar - paquetesreqcomentarios_Modificar: ' . $e->getMessage() ) ;
	        }
	    }
	    else {
	        try {
	            $idreg = self::paquetesreqcomentarios_Agregar( [ "paquetesrequ_id" => $json['paquetesrequ_id'], "valor" => $valor ] );
	        } catch (Exception $e) {
	            http_response_code( $e->getCode() );
	            return self::retorno( [], $e->getCode(), 'paquetesreqcomentarios_Helper_Agregar - paquetesreqcomentarios_Agregar: ' . $e->getMessage() ) ;
	        }
	    }
	    
	    return self::retorno( [ "success" => true , 'idreg' => $idreg ], 0, '') ;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 47 - Crear funci&oacute;n que agregue datos a la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $o = new Paquetesreqcomentarios();
	    if (isset( $d['valor'] ) ) {
	        $o->setValor( $d['valor'] );
	    }
	    if (isset( $d['paquetesrequ_id'] ) ) {
	        $o->setPaquetesrequ_id( $d['paquetesrequ_id'] );
	    }
	    if (isset( $d['paquetesreqcomentariosestados_id'] ) ) {
	        $o->setPaquetesreqcomentariosestados_id( $d['paquetesreqcomentariosestados_id'] );
	    }
	    if (isset( $d['empleados'] ) ) {
	        $o->setEmpleados( $d['empleados'] );
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $o->setEmpleados_id( $d['empleados_id'] );
	    }
	    if (isset( $d['empleadosfecha'] ) ) {
	        $o->setEmpleadosfecha( $d['empleadosfecha'] );
	    }
	    // TODO: Tarea 56 agregar el campo usuarios_id en la funcion paquetesreqcomentarios_Agregar
	    $o->setUsuarios_id( $usu->getId() );
	    $o->setUsuarios( $usu->getNombres() . " " . $usu->getApellidos() );
	    $o->setFecha( date('Y-m-d H:i:s'));
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $o->obtenerError(), IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	
	/*
	 * @yalfonso
	 * TODO: Tarea 54 - Crear funci&oacute;n maneje los parametros que se envian para obtener data de la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Helper_Obtener( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $qryPkcom = [];
	    try {
	        $qryPkcom = self::paquetesreqcomentarios_Obtener( [ 'w_paquetesrequ_id' => $json['id'], 'w_paquetesreqcomentariosestados_ids' => [1,2,3,4], 'ordenasc' => 6 ] );
	    } catch (Exception $e) {
	        throw new Exception('paquetesreqcomentarios_Helper_Obtener - paquetesreqcomentarios_Obtener: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    return $qryPkcom;
	}
	
	/*
	 * @yalfonso
	 * TODO: Tarea 48 - Crear funci&oacute;n que obtenga los datos de la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Obtener( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "pkrequcom.`id`, pkrequcom.`usuarios_id`, pkrequcom.`usuarios`, pkrequcom.`valor`, TO_BASE64(pkrequcom.`valor`) as firma, pkrequcom.`fecha`, pkrequcom.`paquetesrequ_id` ";
	    $vr .= ", pkrequ.descripcion as paquetesrequ_descripcion, pkrequcom.`paquetesreqcomentariosestados_id`, ";
	    $vr .= "pkrcomestados.nombre as paquetesreqcomentariosestados_nombre, pkrequcom.`empleados_id`, ";
	    $vr .= "pkrequcom.`empleados`, pkrequcom.`empleadosfecha` ";
	    
	    $tb  = '`paquetesreqcomentarios` as pkrequcom ';
	    
	    $jn  = 'LEFT JOIN `paquetesrequ` as pkrequ on pkrequ.id = pkrequcom.paquetesrequ_id ';
	    $jn .= 'LEFT JOIN `paquetesreqcomentariosestados` as pkrcomestados on pkrcomestados.id = pkrequcom.paquetesreqcomentariosestados_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "pkrequcom.`id` = ?";
	        $pr[] = $d['id'];
	    }
	    if( isset( $d['w_paquetesrequ_id'] ) ){
	        $wh[] = "pkrequcom.`paquetesrequ_id` = ?";
	        $pr[] = $d['w_paquetesrequ_id'];
	    }
	    if( isset( $d['w_empleados_id'] ) ){
	        $wh[] = 'pkrequcom.`empleados_id` = ?' ;
	        $pr[] = $d['w_empleados_id'];
	    }
	    if( isset( $d['w_paquetesreqcomentariosestados_ids'] ) ){
	        $ids = $d['w_paquetesreqcomentariosestados_ids'];
	        $placeholders = implode(',', array_fill(0, count($ids), '?'));
	        $wh[] = "pkrequcom.`paquetesreqcomentariosestados_id` IN (" . $placeholders . ")";
	        
	        foreach ( $ids as $vPr ) {
	            $pr[] = $vPr;
	        }
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    
	    $r = Singleton::_safeRawQuery($sql, $pr); //Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 49 - Crear funci&oacute;n que modifique los datos de la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Modificar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $tb  = "paquetesreqcomentarios ";
	    $aSt = array();
	    if (isset( $d['valor'] ) ) {
	        $aSt['valor'] = $d['valor'] ;
	    }
	    if (isset( $d['paquetesreqcomentariosestados_id'] ) ) {
	        $aSt['paquetesreqcomentariosestados_id'] = $d['paquetesreqcomentariosestados_id'] ;
	    }
	    if (isset( $d['empleados'] ) ) {
	        $aSt['empleados'] = $d['empleados'] ;
	        $aSt['empleadosfecha'] = date('Y-m-d H:i:s') ;
	    }
	    if (isset( $d['empleados_id'] ) ) {
	        $aSt['empleados_id'] = $d['empleados_id'] ;
	    }
	    
	    $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[] = $d['id'];
	    }
	    if ( isset( $d['w_paquetesrequ_id'] ) ) {
	        $wh  = 'paquetesrequ_id = ?';
	        $pr[] = $d['w_paquetesrequ_id'] ;
	    }
	    
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = $wh;
	    
	    //$sqlPart = implode(', ', array_map(function($k, $v) {return $k . " = '" . addslashes($v) . "'";}, array_keys($aSt), $aSt));
	    //die('UPDATE ' . $tb . ' SET ' . $sqlPart . ' WHERE ' . $xt);
	    
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception($th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 50 - Crear funci&oacute;n que eliminar los datos de la tabla la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $xt = '';
	    if ( isset( $d['id'] ) ) {
	        $xt = "SIID";
	        try {
	            self::paquetesreqcomentarios_Modificar( ['id' => $d['id'], 'paquetesreqcomentariosestados_id' => 5 ] );
	        } catch (Exception $e) {
	            throw new \Exception( $e->getMessage(), IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        }
	    }
	    
	    if ( $xt == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_ELIMINACION_SQL );
	        throw new \Exception( 'Debe indicar filtros',IndexCtrl::ERR_COD_ELIMINACION_SQL );
	    }
	    
	    return  true;
	}
	/*
	 * @yalfonso
	 * TODO: Tarea 57 - Crear funci&oacute;n maneje los comentarios eliminados de la tabla paquetesreqcomentarios
	 */
	public static function paquetesreqcomentarios_Helper_Eliminar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d[ 'data' ] );
	    $json = json_decode( $data, true );
	    
	    $qryPkcom = [];
	    try {
	        $qryPkcom = self::paquetesreqcomentarios_Eliminar( $json );
	    } catch (Exception $e) {
	        throw new Exception('paquetesreqcomentarios_Helper_Eliminar - paquetesreqcomentarios_Eliminar: ' . $e->getMessage(), $e->getCode() );
	    }
	    
	    return $qryPkcom;
	}
	// paquetesreqcomentarios FIN
	
	// apoyos INI
	/*
	 * @vnavarro
	 * TODO: Tarea 62 - Crear funci&oacute;n que agregue datos a la tabla apoyos
	 */
	public static function apoyos_Agregar( $d ) {
	    // usa la Tarea 47 como ejemplo
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	}
	
	/*
	 * @vnavarro
	 * TODO: Tarea 63 - Crear funci&oacute;n que obtenga los datos de la tabla apoyos
	 */
	public static function apoyos_Obtener( $d ) {
	    // usa la Tarea 48 como ejemplo
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	}
	/*
	 * @vnavarro
	 * TODO: Tarea 64 - Crear funci&oacute;n que modifique los datos de la tabla apoyos
	 */
	public static function apoyos_Modificar( $d ) {
	    // usa la Tarea 49 como ejemplo
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	}
	/*
	 * @vnavarro
	 * TODO: Tarea 65 - Crear funci&oacute;n que eliminar los datos de la tabla la tabla apoyos
	 */
	public static function apoyos_Eliminar( $d ) {
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    //Usa esta funcion para eliminar
	    //Singleton::_safeDelete($table, $where);
	}
	/*
	 * @vnavarro
	 * TODO: Tarea 66 - Crear funci&oacute;n que ayude a agregar o modificar la tabla apoyos
	 */
	public static function apoyos_Helper_Agregar( $d ) {
	    // usa la Tarea 46 como ejemplo
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() , IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    //$data = base64_decode( $d[ 'data' ] );
	    //$json = json_decode( $data, true );
	    
	    // usa esta funcion para retornar los datos en esta funcion
	    //return self::retorno( [ "success" => true ], 0, '') ;
	}
	// apoyos FIN
	
	// reflista INI
	public static function reflista_Obtener ( $d ){
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "refls.id,refls.nombre,refls.label,refls.paquetereqtipos_id, pcktp.nombre as paquetereqtipos, ";
	    $vr .= "refls.descripcion,refls.requerido,refls.grupo ";
	    
	    $tb  = '`reflista` as refls ';
	    
	    $jn  = 'LEFT JOIN paquetereqtipos as pcktp on pcktp.id = refls.paquetereqtipos_id ';
	    
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "paqs.`id` = " . $d['id'] . " ";
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    //die( "SELECT " . $vr . "\nFROM " . $tb . "\n" . $xt );
	    $r = Singleton::_readInfoChar($tb,$vr,$xt, IndexCtrl::CHARS_TO, IndexCtrl::CHARS_FR);
	    if ( isset( $r['err_info'] )) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'paquetes_Obtener: ' . $r['err_info'] , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// reflista FIN
	
	// empleadosdetallescontrato INI
	public static function empleadosdetallescontrato_Helper_Agregar( $d ) {
	/*
	 * @vnavarro
	 * TODO: tarea 8
	 * Creamos controlador para agregar/modificar la tabla empleadosdetallescontrato
	 * 1. crea una funcion statica y publica de nombre empleadosdetallescontrato_Helper_Agregar( $d )
	 * 2. detecta si es una actualizacion o un nuevo registro
	 * 3. agrega los datos a la base de datos con las funciones que creaste para agregar o modificar
	 * 4. el retorno debe entrese con la funcion self::retorno
	 * 
	 */

	  	$data = base64_decode( $d['data'] );
	    $json = json_decode( $data , true );

		$items = (isset($json[0]) && is_array($json[0])) ? $json : [$json];

		foreach ($items as $it) {

			if (!is_numeric($it['tipodoc_id'] )) {
				$it['tipodoc_id'] = array_search(strtoupper(trim($it['tipodoc_id'])), self::TIPODOC_DOS_LETRAS, true);
			}

			$doc = trim((string)$it['documento']) ?? '';
			$it['meses'] = isset($it['meses']) ? (int)$it['meses'] : 0;
    		$it['dias']  = isset($it['dias'])  ? (int)$it['dias']  : 0;

			$usrExiste = self::empleados_Obtener(['w_documento' => $doc]);
			
			if (!empty($usrExiste) && isset($usrExiste[0]['id'])) {
				$it['empleados_id'] = $usrExiste[0]['id'];
    		}

			$contExiste = self::empleadosdetallescontrato_Obtener(['documento' => $doc ] );	
			try {
			if ( count( $contExiste ) > 0 ) {
				//Modificación
				$detalleContrato = array(
					'w_documento' => $it['documento'],
					'w_tipodoc_id' => $it['tipodoc_id'],
					'meses' => $it['meses'],
					'dias' => $it['dias'],
					'fechainicio' => $it['fechainicio'] ?? null,
					'fileactaini' => $it['fileactaini'] ?? null
				);
				 if (isset($it['empleados_id'])) {
					$detalleContrato['empleados_id'] = $it['empleados_id'];
				}
				if (isset($it['contrato']) && trim((string)$it['contrato']) !== '') {
					$detalleContrato['contrato'] = trim((string)$it['contrato']);
				}
				self::empleadosdetallescontrato_modificar($detalleContrato);
			} else {
				// Nuevo registro
				self::empleadosdetallescontrato_agregar($it);
			}
		} catch (\Throwable $th) {
			return self::retorno('error', 'Error en empleadosdetallescontrato_Helper_Agregar: ' . $th->getMessage(), null, false);
		}
		}
		return self::retorno('ok', 'Contratos procesados correctamente', null);
		
	}
	
	// @Valeria Agregar las funciones de agregar (formularios_Agregar), obtener (formularios_Obtener), modificar (formularios_Modificar)
	public static function empleadosdetallescontrato_Agregar($d) {
		date_default_timezone_set('America/Bogota');
		
		// Requiere un sesion para obtener el usuario
		$usu = null;
		try {
		    $usu = self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
		    throw new \Exception( "empleadosdetallescontrato_Agregar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
		}
		
		$tmpanyo = self::anyolectivo_Obtener();
		$anyolectivo_id= $tmpanyo[0]['id'];

		$o = new Empleadosdetallescontrato();
		if (isset( $d['tipodoc_id'] ) ) {
			$o->setTipodoc_id( $d['tipodoc_id'] );
		}
		if (isset( $d['documento'] ) ) {
			$o->setDocumento( $d['documento'] );
		}
		if (isset( $d['empleados_id'] ) ) {
			$o->setEmpleados_id( $d['empleados_id'] );
		}
		if (isset($d['contrato'])){
			$o->setContrato( $d['contrato'] );
		}
		if (isset($d['meses'])) {
			$o->setMeses($d['meses']);
		}
		if (isset($d['dias'])) {
			$o->setDias($d['dias']);
		}
		
		// la fecha debe ser la fecha de la insercion
		$o->setFecha( date("Y-m-d H:i:s") );
		
		// Los datos del usuario se obtienen de la sesion actual
		$o->setUsuario( trim($usu->getNombres() . " " . $usu->getApellidos()) );
		
		// la fechamodifica debe ser la fecha de la insercion
		$o->setFechamodifica( date("Y-m-d H:i:s") );
		
		// el anyolectivo es el que se tenga actualmente creado en la tabla anyolectivo
		$o->setAnyolectivo_id( $anyolectivo_id );
		
		if (isset( $d['fechainicio'] ) ) {
			$o->setFechainicio( $d['fechainicio'] );
		}
		if (isset( $d['fileactaini'] ) ) {
			$o->setFileactaini( $d['fileactaini'] );
		}
		if (isset( $d['fileactainivalorgestor'] ) ) {
			$o->setFileactainivalorgestor( $d['fileactainivalorgestor'] );
		}

		$id = $o->saveData();
		
		if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
			http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
			throw new \Exception('empleadosdetallescontrato_Agregar: ' . $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
		}

		if( $id > 0){
	        return $id;
	    }
	    else {
	       http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'empleadosdetallescontrato_Agregar: Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}

	public static function empleadosdetallescontrato_Modificar($d) {
		date_default_timezone_set('America/Bogota');
		
		// Requiere un sesion para obtener el usuario
		$usu = null;
		try {
		    $usu = self::authRequ();
		} catch (\Exception $e) {
		    http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
		    throw new \Exception( "empleadosdetallescontrato_Agregar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
		}
		
		$tb = 'empleadosdetallescontrato ';
		$aSt = array(); 

		if ( isset( $d['tipodoc_id'] ) ) {
			$aSt['tipodoc_id'] = $d['tipodoc_id'] ;
		}
		if ( isset( $d['documento'] ) ) {
			$aSt['documento'] = $d['documento'] ;
		}
		if ( isset( $d['empleados_id'] ) ) {
			$aSt['empleados_id'] = $d['empleados_id'] ;
		}
		if ( isset( $d['contrato'] ) ) {
			$aSt['contrato'] = $d['contrato'] ;
		}
		if ( isset( $d['meses'] ) ) {
			$aSt['meses'] = $d['meses'] ;
		}
		if ( isset( $d['dias'] ) ) {
			$aSt['dias'] = $d['dias'] ;
		}

		$aSt['usuario'] = trim( $usu->getNombres() . " " . $usu->getApellidos() );
		
		$aSt['fechamodifica'] = date("Y-m-d H:i:s") ;
		
		if ( isset( $d['fileactaini'] ) ) {
			$aSt['fileactaini'] = $d['fileactaini'] ;
		}
		if ( isset( $d['fechainicio'] ) ) {
			$aSt['fechainicio'] = $d['fechainicio'] ;
		}
		if ( isset( $d['fileactainivalorgestor'] ) ) {
			$aSt['fileactainivalorgestor'] = $d['fileactainivalorgestor'] ;
		}

		

        $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[]  = $d['id'];
	    }

	    if ( isset( $d['w_tipodoc_id'] ) && isset( $d['w_documento'] ) ) {
		    $pr[] = $d['w_tipodoc_id'];
			$pr[] = $d['w_documento'];
		    $wh  = 'tipodoc_id = ? AND documento = ?';
		}

		 if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'empleadosdetallescontrato_Modificar: Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }

		$xt = $wh;
	    $cu = null;

		 try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'empleadosdetallescontrato_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}

	public static function empleadosdetallescontrato_Obtener($d) {
		$r = new Singleton();
		$r::$lnk->query( self::SQL_BIG_SELECTS );

		$vr  = 'empdetcont.`id`, empdetcont.`tipodoc_id`, tipod.nombre as tipodoc_nombre, ';
		$vr .= 'empdetcont.`documento`, empdetcont.`empleados_id`, concat(emple.nombres, " ", emple.apellidos) as empleados_full, ';
		$vr .= 'empdetcont.`contrato`, empdetcont.`meses`, empdetcont.`dias`, empdetcont.`fecha`, empdetcont.`usuario`, ';
		$vr .= 'empdetcont.`fechamodifica`, empdetcont.`anyolectivo_id`, empdetcont.`fileactaini`, empdetcont.`fechainicio`, empdetcont.`fileactainivalorgestor` ';

		$tb  = '`empleadosdetallescontrato` as empdetcont ';

		$jn  = 'LEFT JOIN empleados as emple on emple.id = empdetcont.empleados_id ';
		$jn  .= "LEFT JOIN tipodoc as tipod on tipod.id = empdetcont.tipodoc_id ";
		
		$pr = [];
		$wh = [];
		if (isset($d['id'])) {
			$wh[] = "empdetcont.`id` = ?";
			$pr[] = $d['id'];
    	}
		if (isset($d['empleados_id'])) {
			$wh[] = "empdetcont.`empleados_id` = ?";
			$pr[] = $d['empleados_id'];
		}
		if (isset($d['documento'])) {
			$wh[] = "empdetcont.`documento` = ?";
			$pr[] = $d['documento'];
		}

		$defWh = "";
		if (count($wh) > 0) {
			$defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
		}

		$orden = "ORDER BY empdetcont.`id` DESC";
		if (isset($d['ordendesc'])) {
			$orden = "ORDER BY " . $d['ordendesc'] . " DESC";
		}
		if (isset($d['ordenasc'])) {
			$orden = "ORDER BY " . $d['ordenasc'] . " ASC";
		}

		

		$limite = "";
		if (isset($d['limite'])) {
			$limite = "LIMIT " . intval($d['limite']);
		}

		$xt = $jn . $defWh . $orden . $limite;

		$sql = "SELECT " . $vr . " FROM " . $tb . " " . $xt;

		$r = [];
		try {
			$r = Singleton::_safeRawQuery($sql, $pr);
		} catch (Exception $e) {
			http_response_code(IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
			throw new \Exception('empleadosdetallescontrato_Obtener: ' . $e->getMessage(), IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
		}

		return $r;
	}
	// empleadosdetallescontrato FIN
	
	// Formularios INI
	const FORMULARIOS_FIELD_TYPES = array( 
	    'text' => 'Caja de texto', 
	    'checkbox' => 'Falso o verdadero', 
	    'select' => 'Lista de opciones', 
	    'datetime' => 'Campo fecha', 
	    'file' => 'Archivo'
	);
	
	public static function formularios_Obtener_Ajax( $d ) {
	    date_default_timezone_set('America/Bogota');
	    return Singleton::_dataTable( array( 'tb' => 'formularios', 'codifica_a' => IndexCtrl::CHARS_TO, 'codifica_desde' => IndexCtrl::CHARS_FR ) );
	}
	public static function formularios_Helper_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "formularios_Helper_Agregar: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    
	    $data = base64_decode( $d['data'] );
	    $json = json_decode( $data , true );
	    
	    $json['fecha'] = date('Y-m-d H-i:s');
	    $json['usuarios'] = trim($usu->getNombres() . ' ' . $usu->getApellidos());
	    $json['formulariosestados_id'] = 1;
	    $json['json'] = json_encode( $json['json'] , JSON_UNESCAPED_UNICODE);
	    
	    $tpls_id = 0;
	    if ( isset( $json[ 'id' ] ) ) {
	        $tpls_id = $json[ 'id' ];
	        try {
	            self::formularios_Modificar( $json );
	        } catch (Exception $e) {
	            throw new Exception( 'flujos_Helper_Agregar - formularios_Modificar: ' . $e->getMessage(), $e->getCode() );
	        }
	    }
	    else {
	        $nwName = trim( Utiles::create_uuid() ); 
	        $buscarnuevo = false;
	        do {
	            $unicos = array();
	            try {
	                $unicos = self::formularios_Obtener( array( 'w_nombre' => $nwName ) );
	            } catch (Exception $e) {
	                throw new \Exception( "formularios_Helper_Agregar - formularios_Obtener: " . $e->getMessage(), IndexCtrl::ERR_COD_SESION_INACTIVA );
	            }
	            
	            $buscarnuevo = (count( $unicos ) > 0);
	            
	            if ( $buscarnuevo ) {
	                $nwName = trim( Utiles::create_uuid() );
	            }
	            
	        }while ( $buscarnuevo );
	        $json['nombre'] = $nwName;
	        $tpls_id = self::formularios_Agregar($json);
	    }
	    return self::retorno($tpls_id, 0, '');
	}
	public static function formularios_Agregar( $d ) {
	    date_default_timezone_set('America/Bogota');
	    
	    $o = new Formularios();
	    if (isset( $d['nombre'] ) ) {
	        $o->setNombre( $d['nombre'] );
	    }
	    if (isset( $d['titulo'] ) ) {
	        $o->setTitulo( $d['titulo'] );
	    }
	    if (isset( $d['descripcion'] ) ) {
	        $o->setDescripcion( $d['descripcion'] );
	    }
	    if (isset( $d['json'] ) ) {
	        $o->setJson( $d['json'] );
	    }
	    if (isset( $d['fecha'] ) ) {
	        $o->setFecha( $d['fecha'] );
	    }
	    if (isset( $d['usuarios'] ) ) {
	        $o->setUsuarios( $d['usuarios'] );
	    }
	    if (isset( $d['formulariosestados_id'] ) ) {
	        $o->setFormulariosestados_id( $d['formulariosestados_id'] );
	    }
	    
	    $id = $o->saveData();
	    if ( strlen( trim( $o->obtenerError() ) ) > 0 ) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'formularios_Agregar: ' . $o->obtenerError() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	    }
	    
	    if( $id > 0){
	        return $id;
	    }
	    else {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new \Exception( 'formularios_Agregar: Respuesta no implementada', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	}
	public static function formularios_Modificar( $d ){
	    date_default_timezone_set('America/Bogota');
	    try {
	        self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $tb  = "formularios ";
	    $aSt = array();
	    if ( isset( $d['nombre'] ) ) {
	        $aSt['nombre'] = $d['nombre'] ;
	    }
	    if ( isset( $d['titulo'] ) ) {
	        $aSt['titulo'] = $d['titulo'] ;
	    }
	    if ( isset( $d['descripcion'] ) ) {
	        $aSt['descripcion'] = $d['descripcion'] ;
	    }
	    if ( isset( $d['json'] ) ) {
	        $aSt['json'] = $d['json'] ;
	    }
	    if ( isset( $d['fecha'] ) ) {
	        $aSt['fecha'] = $d['fecha'] ;
	    }
	    if ( isset( $d['usuarios'] ) ) {
	        $aSt['usuarios'] = $d['usuarios'] ;
	    }
	    if ( isset( $d['formulariosestados_id'] ) ) {
	        $aSt['formulariosestados_id'] = $d['formulariosestados_id'] ;
	    }
	    
	    $pr = [];
	    $wh  = '';
	    if ( isset( $d['id'] ) ) {
	        $wh  = 'id = ?';
	        $pr[]  = $d['id'];
	    }
	    if ( $wh == '' ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception( 'formularios_Modificar: Debe indicar un filtro para actualizar', IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	    }
	    
	    $xt = $wh;
	    
	    //die('UPDATE ' . $tb . ' SET ' . $st . ' ' . $xt);
	    $cu = null;
	    try {
	        $cu = Singleton::_safeUpdate(trim($tb),$aSt,$xt,$pr);
	    } catch (\Throwable $th) {
	        http_response_code( IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	        throw new \Exception( 'formularios_Modificar: ' . $th->getMessage() , IndexCtrl::ERR_COD_ACTUALIZACION_SQL );
	    }
	    
	    return $cu;
	}
	public static function formularios_Obtener ( $d ){
	    $r = new Singleton();
	    $r::$lnk->query( self::SQL_BIG_SELECTS );
	    
	    $vr  = "frm.`id`, frm.`nombre`, frm.`titulo`, frm.`descripcion`, frm.`json`, ";
	    $vr .= "frm.`fecha`, frm.`usuarios`, frm.`formulariosestados_id`, frmEst.nombre as formulariosestados ";
	    
	    $tb  = '`formularios` as frm ';
	    
	    $jn  = 'LEFT JOIN formulariosestados as frmEst on frmEst.id = frm.formulariosestados_id ';
	    
	    $pr = [];
	    $wh  = array();
	    if( isset( $d['id'] ) ){
	        $wh[] = "frm.`id` = ? OR frm.`nombre` = ?";
	        $pr[] = $d['id'] ;
	        $pr[] = $d['id'] ;
	    }
	    if( isset( $d['w_nombre'] ) ){
	        $wh[] = "frm.`nombre` = ? ";
	        $pr[] = $d['w_nombre'] ;
	    }
	    
	    $defWh = "";
	    if ( count( $wh ) > 0 ) {
	        $defWh = "WHERE (" . implode(") AND (", $wh) . ") ";
	    }
	    
	    $orden = 'ORDER BY 1 desc ';
	    if (isset( $d['ordendesc'] ) ) {
	        $orden = "ORDER BY " . $d['ordendesc'] . " desc ";
	    }
	    if (isset( $d['ordenasc'] ) ) {
	        $orden = "ORDER BY " . $d['ordenasc'] . " asc ";
	    }
	    
	    $limite = "";
	    if ( isset( $d['limite'] ) ) {
	        $limite = "LIMIT " . intval( $d['limite'] ) . " ";
	    }
	    
	    $xt  = $jn . $defWh . $orden . $limite;
	    
	    $sql = "SELECT " . $vr . "FROM " . $tb . " " . $xt;
	    //die( $sql );
	    $r = array();
	    try {
	        $r = Singleton::_safeRawQuery($sql, $pr);
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new \Exception( 'formularios_Obtener: ' . $e->getMessage() , IndexCtrl::ERR_COD_MSJ_ERR_COMUN);
	    }
	    
	    return $r;
	}
	// Formularios FIN
	
	// Version 2 FIN
	
	// --HomeCtrls INI
	
	const TIPO_TBQRY_Empleado = "TIP_E_1";
	const TIPO_TBQRY_CONTACTO = "TIP_C_1";
	
	// login INI
	public static function home_Is_Login_Get ( $d ){
	    $usrb64 = base64_decode( $d );
	    $usr = json_decode($usrb64, true );
	    if ( !isset(  $usr['id'] ) ) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( "Sesi&oacute;n inactiva", IndexCtrl::ERR_COD_SESION_INACTIVA );
	    }
	    return $usr;
	}
	
	public static function home_Login_Get( $d ) {
	    self::authRequOff(); 
	    
	    $opcionesemail = array();
	    
	    $nocontacto = false;
	    $encontro = false;
	    
	    $r = null;
	    
	    try { 
	        $r = self::empleados_Obtener($d);
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . ']home_Login_Get-Empleados: ' . $e->getMessage() );
	    }
	    //die( print_r( $r ) );
	    if ( count( $r ) > 0 ) {
	        
	        foreach ( $r as $v ) {
	            $yoacudiente = $v[ 'yoacudiente' ];
	            $mail = $v['mail'];
	            $contact_mail = $v['contact_mail'];
	            
	            if ( $yoacudiente == 1) {
	                $opcionesemail[] = array( 'id' => $v['id'], 'mail' => Utiles::maskEmail( $mail ) , 'tipo' => self::TIPO_TBQRY_Empleado, 'estado_id' => $v['estado_id'] );
	                $encontro = true;
	            }else{
	                
	                if ( strlen( $contact_mail ) > 0 ) {
	                    $opcionesemail[] = array( 'id' => $v['id'], 'mail' => Utiles::maskEmail( $contact_mail ) , 'tipo' => self::TIPO_TBQRY_CONTACTO, 'estado_id' => $v['estado_id'] );
	                    $encontro = true;
	                }
	                else {
	                    $nocontacto = true;
	                }
	                
	            }
	        }
	    }
	    
	    if ( $nocontacto ){
	        http_response_code( IndexCtrl::ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS . ']home_Login_Get-usr-sin-datos: El usuario existe pero sin datos, contacte el administrador de la plataforma.' );
	    }
	    
	    if ( !$encontro ){
	        http_response_code( IndexCtrl::ERR_COD_USUARIO_NO_EXISTE_BY_ID );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_USUARIO_NO_EXISTE_BY_ID . ']home_Login_Get-no_encontr&oacute;: El usuario no existe' );
	    }

	    $defemail = array();
	    foreach ($opcionesemail as $vOpE ) {
	        if ( $vOpE['estado_id'] == 1 ) {
	            $defemail[ $v['mail'] ] = $vOpE;
	        }
	    }
	    
	    if ( !( count( $defemail ) > 0 ) ){
	        http_response_code( IndexCtrl::ERR_COD_ACUDIENTE_HIJOS_ACTIVOS );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_ACUDIENTE_HIJOS_ACTIVOS . ']home_Login_Get-no-hijos-activos: No tiene dependientes activos, contacte el administrador de la plataforma' );
	    }
	    
	    return array_values($defemail);
	}
	
	public static function home_RecuToken_Get( $d ) {
	    self::authRequOff();
	    
	    $r = null;
	    try {
	        $r = self::empleados_Obtener($d);
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . ']home_RecuToken_Get-obtener: ' . $e->getMessage() );
	    }
	    
	    $tipoId = self::TIPO_TBQRY_Empleado;
	    $emailto = "";
	    $idto = "";
	    $docto = "";
	    foreach ( $r as $v ) {
	        $mail = 'mail';
	        $id = 'id';
	        $doc = 'documento';
	        if ( $d['tipo'] == self::TIPO_TBQRY_CONTACTO ) {
	            $mail = 'contact_mail';
	            $id = 'contact_id';
	            $doc = 'contact_documento';
	            $tipoId = self::TIPO_TBQRY_CONTACTO;
	        }
	        
	        $emailto = $v[ $mail ];
	        $idto = $v[ $id ];
	        $docto = $v[ $doc ];
	    }
	    
	    $tmpCl = Utiles::nuevoCl(6);
	    $mdR = false;
	    $opcD = array(
            'id' => $idto,
	        'clave' => $tmpCl
	    );
	    try {
	        if ( $tipoId == self::TIPO_TBQRY_Empleado ) {
	            $mdR = self::empleados_ModificarClave( $opcD );
	        }
	        elseif ( $tipoId == self::TIPO_TBQRY_CONTACTO ){
	            $mdR = self::acudientes_ModificarClave ( $opcD );
	        }
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_EST_CLAVE_NO_MODIFICADA );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_EST_CLAVE_NO_MODIFICADA . '] home_RecuToken_Get-modificar: ' . $e->getMessage() );
	    }
	    
	    if ( $mdR ){
	        $tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "homerecuperar.html");
	        $_aed = array(
	            'CLAVE_TMP' => $tmpCl,
	            'USUARIO_TMP' => $docto
	        );
	        $replacement_array = self::ObtenerEtiquetasEmail($_aed);
	        
	        $mensaje = preg_replace_callback(
	            '~\{\$(.*?)\}~si',
	            function($match) use ($replacement_array) {
	                return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
	            },
	            $tplCode);
	        
	        try {
	            $emOpc = array(
	                "para" => $emailto,
	                "titulo" => "Nuevapp - clave temporal #" . date('YmdHis'),
	                "mensaje" => $mensaje,
	                "desde" => "notificador@nuevapp.com",
	                "rotulo" => 'Clave temporal'
	            );
	            $rsend = self::enviarCustomEmail( $emOpc );
	            return $rsend;
	        } catch (Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO );
	            throw new Exception( '[' . IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO . '] home_RecuToken_Get: ' . $e->getMessage() . '');
	        }
	    }
	    else{
	        http_response_code( IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO . '] No se pudo asignar la clave');
	    }
	    return false;
	    
	}
	public static function home_Start_Get( $d ){ 
	    $dMem = $d;
	    $usu = null;
	    $decrypted = null;
	    //die( 'ver alu: ' . print_r( $d , true ));
	    
	    if ( isset( $dMem['loginas'] ) ) {
	        try {
	            $usu = self::authRequ();
	        } catch (\Exception $e) {
	            http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	            throw new \Exception( $e->getMessage() );
	        }
	        
	        $tk_g = null;
	        try {
	            $tk_g = self::ObtenerToken( array( 'id' => $usu->getId(), 'privada' => true ) ) ;
	        } catch (Exception $e) {
	            throw new Exception( 'home_Start_Get - ObtenerToken: ' . $e->getMessage() );
	        }
	        
	        //die( 'tk_g: ' . print_r( $tk_g , true ) );
	        foreach ($tk_g as $vK ) {
	            $rk = $vK['privada'];
	            $fc = $vK['fecha'];
	            
	            $llavepri = openssl_pkey_get_private($rk, $usu->getMail() . date('YmdHis', strtotime( $fc )) );
	            openssl_private_decrypt( base64_decode( $dMem['loginas'] ), $decrypted, $llavepri );
	        }
	        //die( 'tk_g: ' . print_r( base64_decode( $dMem['loginas'] ), true ) );
	        
	        $filldt = array();
	        $las = json_decode( $decrypted, true );
	        if ( $las['tipo'] == 4 ) {
	            //$xt .= 'AND estu.id = ' . $las['Empleados_id'] . ' ';
	            try {
	                $filldt = self::empleados_Obtener( array('id' => $las['empleados_id'], 'campoclave' => true ) );
	            } catch (Exception $e) {
	                throw new Exception( 'home_Start_Get - empleados_Obtener - loginas: ' . $e->getMessage() );
	            }
	        }
	        elseif ( $las['tipo'] == 5 ) {
	            //$xt .= 'AND acu.id = ' . $las['acudientes_id'] . ' ';
	            try {
	                $filldt = self::acudientes_Obtener( array('id' => $las['acudientes_id'] ) );
	            } catch (Exception $e) {
	                throw new Exception( 'home_Start_Get - acudientes_Obtener - loginas: ' . $e->getMessage() );
	            }
	        }
	        
	        foreach ( $filldt as $vFill ) {
	            $dMem['w_tipodoc_id'] = $vFill['tipodoc_id'];
	            $dMem['w_documento'] = $vFill['documento'];
	            $dMem['w_clave'] = $vFill['clave'];
	        }
	        $dMem['clvdirecta'] = true;
	    }
	    else {
	        self::authRequOff();
	    }
	    
	    if ( !isset( $dMem['tipodoc_id'] ) ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception("[" . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . "]home_Start_Get: tipodoc_id es obligatorio");
	    }
	    if ( !isset( $dMem['documento'] ) ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception("[" . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . "]home_Start_Get: documento es obligatorio");
	    }
	    if ( !isset( $dMem['clave'] ) ) {
	        http_response_code( IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO );
	        throw new Exception("[" . IndexCtrl::ERR_COD_CAMPO_OBLIGATORIO . "]home_Start_Get: clave es obligatorio");
	    }
	    
	    $dMem_w = array(
	        'w_tipodoc_id' => $dMem['tipodoc_id'],
	        'w_documento' => $dMem['documento'],
	        'w_clave' => $dMem['clave']
	    );
	    
	    $r = null;
	    try {
	        $r = self::empleados_Obtener( $dMem_w );
	    } catch (Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_MSJ_ERR_COMUN );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_MSJ_ERR_COMUN . ']home_Start_Get-obtener: ' . $e->getMessage() );
	    }
	    //die( print_r( $r ) );
	    
	    $rDt = array();
	    if ( count( $r ) > 0 ) {
	        
	        $jsonlgn = array(
	            'tipodoc_id' => $dMem['tipodoc_id'],
	            'documento' => $dMem['documento']
	        );
	        
	        $ramas = array();
	        foreach ($r as $v ) {
	            
	            if( $v['estado_id'] == 1 ){
	                
	                $ramas[] = $v[ 'id' ];
	                $rDt = array(
	                    'id' => md5( $v['id'] ),
	                    'fullname' => $v['nombres'] . " " . $v['apellidos'],
	                    'email' => $v['mail'],
	                    'tipo' => self::TIPO_TBQRY_Empleado,
	                    'ramas' => $ramas,
	                    'jslgn' => base64_encode( json_encode( $jsonlgn ) )
	                );
	            }
	        }
	        
	        if ( !isset( $dMem['loginas'] ) ) {
	           self::Usabilidad_Helper_Agregar( array( "refid" => "WEB_USR_ACU_LGN_OK", "vl"=> IndexCtrl::USABILIDAD_MSJ_LOGINOK, "usr" => $dMem['documento'] ) );
	        }
	    }else {
	        http_response_code( IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA );
	        throw new Exception( '[' . IndexCtrl::ERR_COD_USUARIO_O_CLAVE_INVALIDA . ']home_Start_Get-obtener: Usuario o clave inv&aacute;lida' );
	    }
	    
	    
	    return $rDt;
	}
	public static function home_LoginAs_Get( $d ){
	    $usu = null;
	    try {
	        $usu = self::authRequ();
	    } catch (\Exception $e) {
	        http_response_code( IndexCtrl::ERR_COD_SESION_INACTIVA );
	        throw new \Exception( $e->getMessage() );
	    }
	    
	    $json = json_decode( $d['params'] , true );
	    $tipo = $json['tipo'];
	    
	    $arDt = array();
	    $arDt['paraeditar'] = true;
	    if ( $tipo == 4 ) {
	        $arDt['id'] = $json['id'];
	    }
	    elseif ( $tipo == 5 ){
	        $arDt['contact_id'] = $json['id'];
	    }
	    
	    try {
	        $r = self::empleados_Obtener( $arDt );
	    } catch (Exception $e) {
	        throw new Exception( 'home_LoginAs_Get: ' . $e->getMessage() );
	    }
	    
	    $crypttext = "";
	    if ( count( $r ) > 0 ) {
	        $usrlg = $r[ 0 ];
	        
	        if ( trim( $usrlg['contact_id'] ) == '' ) {
	            http_response_code( IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA );
	            throw new Exception( '[' . IndexCtrl::ERR_COD_RESPUESTA_SQL_VACIA . '] home_LoginAs_Get - empleados_Obtener: El alumno no tiene relacionado un acudiente' );
	        }
	        
	        $tk_g = null;
	        try {
	            $tk_g = self::ObtenerToken( array( 'id' => $usu->getId(), 'privada' => true ) ) ;
	        } catch (Exception $e) {
	            throw new Exception( 'home_LoginAs_Get - ObtenerToken: ' . $e->getMessage() );
	        }
	        
	        //die( print_r( $tk_g ) );

	        //$decrypted = "";
	        foreach ($tk_g as $vK ) {
	            $pk = $vK['publica'];
	            
	            $signDt = array();
	            $signDt['acudientes_id'] = $usrlg['contact_id'];
	            $signDt['empleados_id'] = $usrlg['id'];
	            $signDt['tipo'] = $tipo;
	            
	            $jsDt = json_encode( $signDt );
	            
	            openssl_public_encrypt( $jsDt, $crypttext, $pk );
	        }
	        
	        //die( $crypttext );
	    }
	    
	    $rDef = base64_encode( $crypttext );
	    return $rDef;
	}
	
	public static function home_Perfil_Get( $d ){
	    self::authRequOff();
	    
	    $js = base64_decode( $d['key'] );
	    $opc = json_decode($js, true) ;
	    //die( print_r( $opc , true ));
	    
	    $r = null;
	    try {
	        $r = self::empleados_Obtener( array( 'w_id_md5' => $opc['id'] , 'limite' => '1') );
	    } catch (Exception $e) {
	        http_response_code( $e->getCode() );
	        throw new Exception( $e->getMessage() );
	    }
	    //die( print_r( $r ) );
	    $perf = array();
	    foreach ( $r  as $v ) {
	        $perf[] = array(
	            "id" => $v["id"],
	            "tipodoc_id" => $v['tipodoc_id'],
	            "documento" => $v['documento'],
	            "nombres" => $v['nombres'],
	            "apellidos" => $v['apellidos'],
	            "tipoacudiente_id" => null,
	            "mail" => $v['mail'],
	            "direccion" => $v['direccion'],
	            "idhash" => md5( $v["id"] )
	        );
	    }
	    
	    return $perf;
	}
	// login FIN
	
	// --HomeCtrls FIN
	
	// Version 2

	/**
	 * Genera una respuesta estructurada en forma de array asociativo.
	 *
	 * Esta funcion esta disenada para estandarizar el formato de retorno en metodos
	 * que requieren comunicar el resultado de una operacion, posibles errores y mensajes
	 * informativos. Es especialmente util en APIs o controladores donde se necesita
	 * mantener consistencia en las respuestas.
	 *
	 * @param mixed  $result Valor que representa el resultado de la operacion (puede ser booleano, array, objeto, etc.).
	 * @param bool   $error  Indica si ocurrio un error (codigo de error)
	 * @param string $msj    Mensaje descriptivo del estado o resultado de la operacion.
	 *
	 * @return array Retorna un array con las claves 'result', 'error' y 'msj'.
	 */
	public static function retorno( $result, $error, $msj){
	    $msjr = array(
	        'result' => $result,
	        'error' => $error,
	        'msj' => $msj,
	    );
	    return $msjr;
	}	
}
?>