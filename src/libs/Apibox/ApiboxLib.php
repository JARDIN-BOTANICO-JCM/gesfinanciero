<?php
namespace src\libs\Apibox;

class ApiboxLib {
    
    const ERR_COD_ABL_SQLERRADO = 601;  // ApiBox - Error Sql
    const ERR_COD_ABL_RESPUESTA_VACIA = 602;  // ApiBox - Respuesta vacia
    
    public static function Crear ( $d ){ 
        date_default_timezone_set('America/Bogota');
        include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "datos" . DIRECTORY_SEPARATOR . "Clsdatos.php";
        include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "modelo" . DIRECTORY_SEPARATOR . "Apibox.php";
        
        $usuarios_id = $d['id'];
        $key = $d['key'];
        $fecha = $key['fecha'];
        
        //$pkey = str_replace("-----BEGIN PUBLIC KEY-----", "", trim( $key['pub'] ) );
        //$pkey = str_replace("-----END PUBLIC KEY-----", "", $pkey );
        //$pkey = preg_replace("/[^a-zA-Z0-9]+/", "", $pkey );
        $publica = trim( $key['pub'] ); //$pkey;
        
        //$rkey = str_replace( "-----BEGIN PRIVATE KEY-----", "", trim( $key['pri'] ) ) ;
        //$rkey = str_replace( "-----END PRIVATE KEY-----", "", $rkey );
        //$rkey = preg_replace( "/[^a-zA-Z0-9]+/", "", $rkey );
        $privada = trim( $key['pri'] ); //$rkey;
        
        $_o = new \Apibox();
        $_o->setUsuarios_id($usuarios_id);
        $_o->setPublica($publica);
        $_o->setPrivada( $privada );
        $_o->setActivo(1);
        $_o->setFecha( $fecha );
        
        $_o->saveData();
        if ( strlen( trim( $_o->obtenerError() ) ) > 0 ) {
            throw new \Exception( $_o->obtenerError() );
        }
        
        return $publica;
    }
    
    public static function Actualizar ( $d ){
        $id = $d['id'];
        $key = $d['key'];
        
        $del = null;
        
        try {
            $del = self::Eliminar( array( 'id' => $id ) );
        } catch (\Exception $e) {
            throw new \Exception( $e->getMessage() );
        }
        
        if ( $del ) {
            return self::Crear( array( 'id' => $id , 'key' => $key ) );
        }
        
    }
    
    public static function Obtener ( $d ) {
        include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "datos" . DIRECTORY_SEPARATOR . "Singleton.php";
        
        $id = $d['id'];
        
        $tb = "apibox ";
        $vr = "id,usuarios_id,publica,activo,fecha ";
        if ( isset( $d['privada'] ) ) {
            if( $d['privada'] ){
                $vr .= ",privada ";
            }
        }
        $xt = "where usuarios_id = " . $id . " ";
        $existe = \Singleton::_readInfo( $tb, $vr, $xt );
        
        if( isset( $existe['err_info'] ) ){
            http_response_code ( self::ERR_COD_ABL_SQLERRADO );
            throw new \Exception( '[' . self::ERR_COD_ABL_SQLERRADO . '] Obtener: ' . $existe['err_info'] );
        }
        
        return $existe;
    }
    
    public static function Comparar ( $d ){
        include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "datos" . DIRECTORY_SEPARATOR . "Singleton.php";
        
        $pkey = $d['pkey'];
        
        $tb = "apibox ";
        $vr = "id,usuarios_id,publica,activo,fecha ";
        $xt = "where publica = '" . trim( $pkey ) . "' ";
        $existe = \Singleton::_readInfo( $tb, $vr, $xt );
        
        if( isset( $existe['err_info'] ) ){
            throw new \Exception( $existe['err_info'] );
        }
        
        return $existe;
    }
    
    public static function Eliminar ( $d ) {
        include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "datos" . DIRECTORY_SEPARATOR . "Singleton.php";
        
        $id = $d['id'];
        $tb = "apibox ";
        $xt = "where usuarios_id = " . $id . " ";
        
        try {
            \Singleton::_classicDelete($tb, $xt);
            return true;
        } catch (\Exception $e) {
            throw new \Exception( $e->getMessage() );
        }
        
    }
    
    public static function EliminarTodo () {
        include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "datos" . DIRECTORY_SEPARATOR . "Singleton.php";
        
        $tb = "apibox ";
        $xt = "where id > 0 ";
        
        try {
            \Singleton::_classicDelete($tb, $xt);
            return true;
        } catch (\Exception $e) {
            throw new \Exception( $e->getMessage() );
        }
        
    }
    
}