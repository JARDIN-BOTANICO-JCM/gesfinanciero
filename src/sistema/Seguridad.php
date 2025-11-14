<?php
class Seguridad{
		
	private static $YALE =  "PUFzJSYvKCkhsEdoX2Zqa2RoZmxvQH5eey8qLTI0QCM=";
	private static $ROKIE = "OWFqQVNqa2o9a2slIyFAZH19YGRAZC8qLWAnPz1hvyY=";
	
	/**
	 * Autentica un usuario/administrador del sistema.
	 *
	 * - Si $creasesion es false valida credenciales sin crear sesión (espera $usr como md5(usuario) o md5(mail) y $pwd como la clave almacenada).
	 * - Si coincide con las credenciales especiales (Config::USU_ADM y Config::PAS_ADM) crea una sesión de administrador root.
	 * - En el flujo normal valida usuario o mail con md5($pwd), y al autenticar guarda el objeto usuario en $_SESSION["usu"] y la URL base en $_SESSION["url"].
	 *
	 * @param string $usr Nombre de usuario, correo o su hash (según $creasesion).
	 * @param string $pwd Contraseña en texto claro o según el modo de validación.
	 * @param bool $creasesion Indica si debe crearse la sesión al autenticar (true por defecto).
	 * @return bool True si la autenticación fue exitosa, false en caso contrario.
	 */
	public static function loginAdmin($usr, $pwd, $creasesion = true){
		
		if( !$creasesion ){
			$usuarios = new Usuarios();
			$u = $usr;
			$p = $pwd;
			$strf = "where (md5(usuario) = '" . $u . "' and clave = '" . $p . "') or (md5(mail) = '" . $u . "' and clave = '" . $p . "')";
			$objRes = $usuarios->readInfo("*",$strf);
			if(sizeof($objRes) > 0 ){
				return true;
			}
			return false;
		}
		
		if( $usr == Config::USU_ADM && md5( $pwd ) == Config::PAS_ADM ){
			
			if ( !$_SESSION ){ @session_start(); }
			$usuario = new Usuarios();
			
			$usuario->setId( 0 );
			$usuario->setNombres("Usuario");
			$usuario->setApellidos("Root");
			$usuario->setMail("admin@" . $_SERVER["SERVER_NAME"] );
			$usuario->setPerfilusuarios_id(0);
			$usuario->setEstado_id(0);
			$usuario->setUsuario( $usr );
			$usuario->setClave( md5( $pwd ) );
			$usuario->setCreado( date("Y-m-d H:i:s") );
			$usuario->setDemanda( false );
				
			$_SESSION["usu"] = $usuario;
			
			return true;
		}else{
			
			$usuarios = new Usuarios();
			$strf = "where (usuario = '" . $usr . "' and clave = '" . md5($pwd) . "') or (mail = '" . $usr . "' and clave = '" . md5($pwd) . "')";
			$objRes = $usuarios->readInfo( "*", $strf );
			
			if(sizeof($objRes) > 0 ){
			    $_SESSION["usu"] = $objRes[0];
			    $_SESSION["url"] = Utiles::getBaseUrl();
				return true;
			}
			
			return false;
		}
	}
	
	/**
	 * Cierra la sesión del usuario actual.
	 *
	 * @return void
	 */
	public static function logout(){
		unset( $_SESSION["usu"] );
		unset( $_SESSION["url"] );
		session_destroy();
	}
	
	/**
	 * Verifica si hay un usuario autenticado en la sesión.
	 *
	 * @return bool True si hay un usuario autenticado, false en caso contrario.
	 */
	public static function isLogin(){
		if( isset( $_SESSION[ "usu" ] ) ) {
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Añade relleno a una cadena para que su longitud sea múltiplo de un tamaño de bloque.
	 *
	 * @param string $string Cadena a la que se le añadirá relleno.
	 * @param int $blocksize Tamaño del bloque para el relleno (por defecto 32).
	 * @return string Cadena con relleno añadido.
	 */
	private static function addpadding($string, $blocksize = 32)
	{
	    $len = strlen($string);
	    $pad = $blocksize - ($len % $blocksize);
	    $string .= str_repeat(chr($pad), $pad);
	    return $string;
	}
	
	/**
	 * Elimina el relleno de una cadena.
	 *
	 * @param string $string Cadena de la que se eliminará el relleno.
	 * @return string|false Cadena sin relleno o false si el relleno es inválido.
	 */
	private static function strippadding($string)
	{
	    $slast = ord(substr($string, -1));
	    $slastc = chr($slast);
	    $pcheck = substr($string, -$slast);
	    if(preg_match("/$slastc{".$slast."}/", $string)){
	        $string = substr($string, 0, strlen($string)-$slast);
	        return $string;
	    } else {
	        return false;
	    }
	}
	
	/**
	 * Cifra una cadena y devuelve el resultado en base64.
	 *
	 * Usa mcrypt (Rijndael-256, modo CBC) con la clave y el IV obtenidos de self::$YALE y self::$ROKIE.
	 *
	 * @param string $string Texto a cifrar (por defecto cadena vacía).
	 * @return string Cadena cifrada codificada en base64.
	 */
	public static function Establece($string = "")
	{   
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, base64_decode( self::$YALE ), Seguridad::addpadding($string), MCRYPT_MODE_CBC, base64_decode( self::$ROKIE)));
	}
	
	/**
	 * Desencripta una cadena codificada en base64 usando Rijndael-256 (modo CBC) y elimina el padding.
	 *
	 * @param string $string Cadena en base64 que contiene los datos cifrados.
	 * @return string Texto plano resultante de la desencriptación.
	 */
	public static function Obtiene($string = "")
	{
		$string = base64_decode($string);
		return Seguridad::strippadding(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, base64_decode( self::$YALE ), $string, MCRYPT_MODE_CBC, base64_decode( self::$ROKIE )));
	}
	
	/**
	 * Recupera el valor de un campo de una entidad buscando por el MD5 del id.
	 *
	 * @param string $cl Nombre de la clase/entidad
	 * @param string $id MD5 del id del registro
	 * @param string $nombre Nombre del campo a obtener (por defecto "nombre")
	 * @return string Valor del campo solicitado o cadena vacía si no existe o la clase no se encuentra
	 */
	public static function ElHash($cl, $id, $nombre = "nombre"){
		$clase = Singleton::toCap($cl);
		if(class_exists( $clase )){
			$c = new $clase();
			$vl = $c->readInfo("*", "where md5(id) = '" . $id . "'"); 
			return $vl[0]->{"get" . Singleton::toCap( $nombre ) }();
		}
		return "";
	}
	
}
?>