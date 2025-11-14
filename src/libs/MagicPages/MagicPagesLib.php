<?php
namespace src\libs\MagicPages;

include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "datos" . DIRECTORY_SEPARATOR . "Clsdatos.php";
include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "modelo" . DIRECTORY_SEPARATOR . "Magicpages.php";
include_once dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . "sistema" . DIRECTORY_SEPARATOR . "Utiles.php";

class MagicPagesLib {
    
    private static function NuevaFecha (){
        $horaReg = strtotime("+10 minutes", strtotime( date('Y-m-d H:i:s') ));
        return date("Y-m-d H:i:s", $horaReg);
    }
    
    /**
     * Crear nueva p&aacute;gina temporal
     * 
     * @param <b>String url</b> Direcci&oacute;n de la p&aacute;gina que debe mostrar
     * @throws \Exception
     * @return Array["id"=><String>, "codigo"=><Object>] 
     */
    public static function Crear ( $d ){
        date_default_timezone_set('America/Bogota');
        
        $url = $d['url'];
        $email = $d['email'];
        $params = "";
        if (isset( $d['params'] )) {
            $params = $d['params'];
        }
        
        $mknw = false;
        $codigo = null;
        do {
            $codigo = \Utiles::create_uuid();
            
            $rNwCo = self::ObtenerPorCodigo( array('codigo' => $codigo ) );
            
            if ( sizeof( $rNwCo ) > 0 ) {
                $mknw = true;
            }else {
                $mknw = false;
            }
            
        }while ( $mknw );
        
        $_o = new \Magicpages();
        $_o->setCodigo( $codigo );
        $_o->setUrl( $url );
        $_o->setExpira( self::NuevaFecha() );
        $_o->setParams( $params );
        $_o->setEmail( $email );
        
        $nId = $_o->saveData();
        if ( strlen( trim( $_o->obtenerError() ) ) > 0 ) {
            throw new \Exception( 'MagicPagesLib: ' . $_o->obtenerError() );
        }
        
        return array( 'id' => $nId , 'codigo' => $codigo ) ;
    }
    
    /**
     * Actualizar una p&aacute;gina temporal existente
     * 
     * @param <b>String codigo</b> C&oacute;digo de la p&aacute;gina a actualizar
     * @throws \Exception Eliminaci&oacute;n errada
     *                    Creaci&oacute;n errada
     * @return Array["id"=><String>, "codigo"=><Object>] 
     */
    public static function Actualizar ( $d ){
        $id = $d['id'];
        $email= $d['email'];
        $del = null;
        
        $obTmp = null;
        try {
            $_obTmp = self::ObtenerPorCodigo( array( "codigo" => $id ) );
            if ( sizeof( $_obTmp ) > 0 ) {
                $obTmp = $_obTmp[0];
                
                if ( !($obTmp['email'] == $email) ) {
                    throw new \Exception( 'MagicPagesLib: Debe confirmar el e-mail al que se est&aacute; enviando esta asignaci&oacute;n');
                }
            }
        } catch ( \Exception $e ) {
            throw new \Exception( 'MagicPagesLib.Actualizar->ObtenerPorCodigo: ' . $e->getMessage() );
        }
        
        try {
            $del = self::EliminarPorCodigo( array( 'id' => $id ) );
        } catch (\Exception $e) {
            throw new \Exception( 'MagicPagesLib.Actualizar->EliminarPorCodigo: ' . $e->getMessage() );
        }
        
        if ( $del ) {
            try {
                return self::Crear( array( 'url' => $obTmp['url'], 'email' => $obTmp['email'], 'params' => $obTmp['params'] ) );
            } catch ( \Exception $e ) {
                throw new \Exception( 'MagicPagesLib.Actualizar->Crear: ' . $e->getMessage() );
            }

        }
        
    }
    
    /**
     * Obtener datos de la p&aacute;gina temporal
     * 
     * @param <b>Int id</b> - valor del Id o del Codigo de la p&aacute;gina
     * @param <b>String campo</b> - nombre del campo "id" o "campo"
     * @throws \Exception Error en ejecuci&oacute;n consulta
     * @return Array[[String, String, String String]] - Informaci&oacute;n de las coincidencias 
     */
    private static function Obtener ( $d ) {
        date_default_timezone_set('America/Bogota');
        
        $campos = array("0" => 'codigo');
        
        $id = $d['id'];
        $campo = $campos[ $d['campo'] ];
        
        $tb = "magicpages ";
        $vr = "id,codigo,url,params,expira, email, ( NOW() > expira ) as expirado ";
        $xt = "where " . $campo . " = " . $id . " ";
        $existe = \Singleton::_readInfo( $tb, $vr, $xt );
        
        if( isset( $existe['err_info'] ) ){
            throw new \Exception( 'MagicPagesLib: ' . $existe['err_info'] );
        }
        
        return $existe;
    }
    
    /**
     * Obtener datos de la p&aacute;gina temporal
     * 
     * @param String codigo - C&oacute;digo de la p&aacute;gina
     * @throws \Exception Error al consultar la p&aacute;gina
     * @return Array[[String, String, String String]] - Informaci&oacute;n de las coincidencias 
     */
    public static function ObtenerPorCodigo ( $d ){
        if ( !isset ( $d['codigo'] ) ) throw new \Exception( 'MagicPagesLib.ObtenerPorCodigo: El codigo es obligatorio.');
        
        try {
            return self::Obtener( array('id' => "'" . $d['codigo'] . "'", "campo" => '0') );
        } catch ( \Exception $e ) {
            throw new \Exception( 'MagicPagesLib: ' . $e->getMessage() );
        }
    }
    
    /**
     * Elimina un registro de la tabla "magicpages" usando el campo y el id indicados.
     *
     * @param array $d Matriz con 'id' (valor del identificador) y 'campo' (nombre del campo).
     * @return bool True si la eliminación fue exitosa.
     * @throws \Exception En caso de error durante la operación de borrado.
     */
    private static function Eliminar ( $d ) {
        
        $id = $d['id'];
        $campo = $d['campo'];
        $tb = "magicpages ";
        $xt = 'where ' . $campo . ' = ' . $id . ' ';
        
        try {
            \Singleton::_classicDelete($tb, $xt);
            return true;
        } catch (\Exception $e) {
            throw new \Exception( 'MagicPagesLib: ' . $e->getMessage() );
        }
        
    }
    
    /**
     * Elimina un registro por su identificador.
     *
     * @param array $d Arreglo con la clave 'id' (obligatoria).
     * @return mixed Resultado de la operación Eliminar.
     * @throws \Exception Si no se proporciona 'id' o ocurre un error en la eliminación.
     */
    public static function EliminarPorId ( $d ){
        if ( !isset ( $d['id'] ) ) throw new \Exception( 'MagicPagesLib.EliminarPorId: El id es obligatorio.');  
        
        try {
            return self::Eliminar( array('id' => $d['id'], "campo" => 'id') );
        } catch ( \Exception $e ) {
            throw new \Exception( 'MagicPagesLib->Eliminar: ' . $e->getMessage() );
        }
    }
    
    /**
     * Elimina una entrada usando su código.
     *
     * Requiere que $d['id'] esté definido; invoca self::Eliminar con "campo" => 'codigo'.
     *
     * @param array $d Matriz que debe contener 'id' (código) a eliminar.
     * @return mixed Resultado devuelto por self::Eliminar.
     * @throws \Exception Si no se proporciona 'id' o si ocurre un error en la eliminación.
     */
    public static function EliminarPorCodigo ( $d ){
        if ( !isset ( $d['id'] ) ) throw new \Exception( 'MagicPagesLib.EliminarPorCodigo: El id es obligatorio.');
        
        try {
            return self::Eliminar( array('id' => '"' . $d['id'] . '"', "campo" => 'codigo') );
        } catch ( \Exception $e ) {
            throw new \Exception( 'MagicPagesLib->Eliminar: ' . $e->getMessage() );
        }
    }
    
    /**
     * Elimina todos los registros de la tabla "magicpages".
     *
     * Realiza un borrado masivo mediante Singleton::_classicDelete.
     *
     * @return bool True si la operación se completa correctamente.
     * @throws \Exception Si ocurre un error durante el proceso de eliminación.
     */
    public static function EliminarTodo () {
        
        $tb = "magicpages ";
        $xt = "where id > 0 ";
        
        try {
            \Singleton::_classicDelete($tb, $xt);
            return true;
        } catch (\Exception $e) {
            throw new \Exception( 'MagicPagesLib: ' . $e->getMessage() );
        }
        
    }
    
    /**
     * Carga la plantilla Magicpages.phtml para mostrar la vista.
     *
     * @param mixed $d Datos crudos a exponer en la plantilla.
     * @return void No devuelve valor; incluye el archivo en el scope actual.
     */
    public static function ObtenerVista( $d ) {
        $raw = $d;
        include_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . "Magicpages.phtml";
    }
    
    /**
     * Incluye y muestra la plantilla de vista de error.
     *
     * @param mixed $d Datos crudos de error que serán utilizados por la vista.
     * @return void
     */
    public static function ObtenerVistaError( $d ) {
        $raw = $d;
        include_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . "MagicpagesNoCode.phtml";
    }
    
}