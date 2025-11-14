<?php
class Rest
{   
    // a30004055c915a3c7bc971256074374e

    /**
     * Procesa la petición de recuperación/asignación de clave.
     *
     * Toma los datos de entrada, invoca la lógica de negocio para reasignar la clave,
     * envía la respuesta en formato JSON (resultado o error) y termina la ejecución.
     *
     * @param mixed $data Datos recibidos para la operación (por ejemplo, arreglo o objeto).
     * @return void Emite JSON y finaliza el script.
     */
    private static function RecuAsignarClave($data){
        // "Api/Servidor/RecuAsignarClave"
        try{
            $ok = OperacionesCtrl::RecuAsignarClaveAjax( $data );
            echo json_encode($ok);
        }catch (Exception $ex){
            $er = array("err" => $ex->getMessage());
            echo json_encode($er);
        }
        die("");
    }
      
    // 7cdf28cdb306941ec39675734b000b60
    
    /**
     * Recupera datos por email y responde en formato JSON.
     *
     * Llama a OperacionesCtrl::RecuperarByEmailAjax con los datos proporcionados,
     * imprime el resultado codificado en JSON o, en caso de excepción, un objeto
     * JSON con la clave "err". Finaliza la ejecución.
     *
     * @param mixed $data Datos de entrada (por ejemplo, email u otros parámetros).
     * @return void Imprime la respuesta JSON directamente y termina el script.
     */
    private static function RecuperarByEmail($data){
      // "Api/Servidor/RecuperarPorEmail"
        try{
            $ok = OperacionesCtrl::RecuperarByEmailAjax( $data );
            echo json_encode($ok);
        }catch (Exception $ex){
            $er = array("err" => $ex->getMessage());
            echo json_encode($er);
        }
        die("");
}
     
    // 88400f0088a755f38f2d3a8d6f3a39fd
    /**
     * Autentica un usuario mediante una petición (AJAX) y responde inmediatamente en JSON.
     * Captura excepciones y devuelve un objeto JSON con el resultado o el error, luego finaliza la ejecución.
     *
     * @param mixed $data Datos de autenticación (por ejemplo usuario/clave).
     * @return void Envía la respuesta JSON y termina el script.
     */
    private static function AutenticaUsuarioSis( $data ){
        // "Api/Servidor/AutenticaUsuarioSis"
        try{
            $ok = OperacionesCtrl::AutenticaUsuarioSisAjax( $data );
            echo json_encode($ok);
        }catch (Exception $ex){
            $er = array("err" => $ex->getMessage());
            echo json_encode($er);
        }
        die("");
    }

    
    // VERSION 2

    /**
     * Verifica comunicaciones para envío sin requerir autenticación.
     *
     * Desactiva temporalmente la verificación de autenticación, ejecuta la
     * comprobación de comunicaciones con los datos proporcionados y, si ocurre
     * una excepción, devuelve un JSON con el error y termina la ejecución.
     *
     * @param mixed $data Datos a validar para la comprobación de comunicaciones.
     * @return void
     */
    public static function handler()
    {
        ini_set("allow_url_fopen", true);
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Autorizacion basica
        $ab = null;
        
        $auten = false;
        $keytk = self::getBearerToken();
        if( $keytk !== null ){
            
            $cpT = OperacionesCtrl::CompararToken( array( 'pkey' => $keytk ) );
            if ( sizeof( $cpT ) > 0 ) {
                
                $cfg = OperacionesCtrl::LeerConfigCorp();
                $time = ( isset( $cfg[ OperacionesCtrl::CFG_LGIN_APT ]) ? $cfg[ OperacionesCtrl::CFG_LGIN_APT ]["val"] : "60" );
                
                foreach ($cpT as $cptO) {
                    if ( $cptO['activo'] == 1 ) { 
                        $horaAct = date("Y-m-d H:i:s");
                        $horaReg = strtotime("+{$time} minutes", strtotime( $cptO["fecha"] ));
                        if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
                            header('WWW-Authenticate: Basic realm="My Realm"');
                            header('HTTP/1.0 401 Unauthorized');
                            header('Content-Type: application/json');
                            echo '{"err":"Expired token"}';
                            exit;
                        }
                        else {
                            $auten = true;
                        }
                    }
                    else {
                        header('WWW-Authenticate: Basic realm="My Realm"');
                        header('HTTP/1.0 401 Unauthorized');
                        header('Content-Type: application/json');
                        echo '{"err":"Disabled token"}';
                        exit;
                    }
                }
            }
            else {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                header('Content-Type: application/json');
                echo '{"err":"Invalid token"}';
                exit;
            }
        }
        else {
            $ab = self::getAuthBasic();
        }
        
        //$getparams = explode('/', trim($_SERVER['PATH_INFO'], '/'));
        $request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
        $fgc = file_get_contents('php://input');
        $input = json_decode($fgc, true);
        
        $jsErr = json_last_error();
        if( $jsErr ){
            if( $jsErr == 5 ){ 
                $input = json_decode(utf8_encode( $fgc ), true);
                error_log("rest.hander, id: " . json_last_error() . ", msj: " .json_last_error_msg() . ", json: " . $fgc);
            }else{
                $er = array();
                //if( $jsErr == 4 ){
                    //$er = array("err" => "id: " . json_last_error() . ", msj: Invalid JSON RFC 8259.");
                if( $jsErr <> 4 ){
                    $er = array("err" => "id: " . json_last_error() . ", msj: " .json_last_error_msg());
                    echo json_encode($er);
                    die();
                }
            }
            
        }
        
        $ajax = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
        //$key = array_shift($request) + 0;
        // escape the columns and values from the input object
        if( isset($_POST) ){
            // hacer algo
        }
        else{
            //$columns = preg_replace('/[^a-z0-9_]+/i', '', array_keys($input));
        }
        
        // create SQL based on HTTP method
        switch ($method) {
            case 'GET':
                header('Content-Type: text/html; charset=utf-8');
                $metodos_clase = get_class_methods( 'Rest' );
                
                $notkn = 'notkn_' . $ajax;
                
                foreach ($metodos_clase as $nombre_metodo) {
                    if( $ajax == md5("Api/Servidor/Get/" . $nombre_metodo) ){
                        self::{$nombre_metodo}( $request );
                    }
                    elseif ( method_exists( 'Rest', $notkn ) ){
                        self::{ $notkn }( $request );
                    }
                }
                
                break;
            case 'PUT':
                // - 
                break;
            case 'POST':
                header("Access-Control-Allow-Origin: *");
                header("Access-Control-Allow-Headers: access");
                header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
                header("Access-Control-Allow-Credentials: true");
                header('Content-Type: application/json');
                
                // dd3bda2f13f14aef6cc0ede06064e75d
                if( $ajax == md5('wsdl') ){
                    $metodos_clase = get_class_methods( 'Rest' );
                    foreach ($metodos_clase as $nombre_metodo) {
                        if( __FUNCTION__ !=  $nombre_metodo){
                            echo $nombre_metodo . " = " . md5("Api/Servidor/" . $nombre_metodo) . "\n";
                        }
                    }
                }
                
                // Autenticacion basica
                if ( !is_null( $ab ) ) {
                    if( $ajax == 'GenerarToken' ){
                        self::tkn_GenerarToken( array( 'u' => $ab['u'] , 'c' => $ab['c'] ) );
                    }
                }
                
                if( $auten ){ 
                    $tknN = 'tkn_' . $ajax;
                    if( method_exists( 'Rest', $tknN ) ){
                        self::{ $tknN }( $input );
                    }
                    //elseif( method_exists('Rest', '_' . $ajax) ){
                        // Nodes v2
                    //}
                    else{
                        http_response_code( 400 );
                        $er = array("err" => 'Endpoint no existe');
                        echo json_encode($er);
                        die();
                    }
                }else{
                    $metodos_clase = get_class_methods( 'Rest' );
                    foreach ($metodos_clase as $nombre_metodo) {
                        if( $ajax == md5("Api/Servidor/" . $nombre_metodo) ){
                            self::{$nombre_metodo}( $input );
                        }
                    }
                }

                
                break;
            case 'DELETE':
                
                break;
        }
    }
}
?>