<?php
class HomeCtrl extends Pagina {
    
    const REPO_ARCHIVOS = "repo";
    const API_RegEventos = 'Api/RegEventos';
    const API_LoginAjaxUsr = 'Api/LoginAjaxUsr';
    
    public function __construct(){
        // Aquí se centralizan todas las operaciones de envío de datos: POST, GET ó REQUEST
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        $this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
        
        // Api REST
        if ( isset( $_SERVER['PATH_INFO'] ) ){
            $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
            $this->renderCtrl($url_baseCtrls . "Rest.php");
            Rest::handler();            
            die("");
        }
        
        if( isset( $_POST ) ){
            
            if( isset( $_POST["ajax"] ) ){
                if( $_POST["ajax"] == md5( "Api/IntegraAutentica" ) ){
                    try{
                        $ok = OperacionesHomeCtrl::LoginFromExterno( $_POST );
                        echo json_encode($ok);
                    }catch (Exception $ex){
                        $er = array("err" => $ex->getMessage());
                        echo json_encode($er);
                    }
                    die("");
                }
            }
        }
        
    }
    
    public static function JS_Name_get(){
        $array=parse_url( Utiles::getBaseUrl() );
        $n = 'acpp_' . str_replace( ".", "", $array['host'] ) ;
        return $n;
    }
    
    private function renderCtrl( $rutaVista ){
        $vista = pathinfo( $rutaVista );
        $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
        $rutaCtrl = $url_baseCtrls . $vista[ 'filename' ] . "Ctrl.php";
        if( file_exists( $rutaCtrl ) ){
            include_once $rutaCtrl;
            $tmpNombreClase = $vista[ 'filename' ] . "Ctrl";
            $rutaCtrl = new $tmpNombreClase();
            $rutaCtrl->render();
        }else{
            include_once $rutaVista;
        }
    }
    
    public function render(){
        if(!isset($_SESSION)){
            session_start();
        }
        
        $url_base = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "tpls" . DIRECTORY_SEPARATOR ;
        $url_home = $url_base . "home" . DIRECTORY_SEPARATOR;
        include_once $url_home . "Encabezadohome.phtml" ;
        
        if( isset( $_REQUEST["pageid"] ) ){
            $urlp = $_REQUEST["pageid"];
            
            $rutaVista = $url_base . $urlp;
            if( $_REQUEST["pageid"] != Config::PAGINA_WORKSPACE_HOME ){
                
                if( file_exists($url_base . "modelos/" . $urlp)){
                    $this->setMensaje("P&aacute;gina no existente!");
                    $this->renderCtrl( $url_home . Config::PAGINA_ERROR );
                }
                else{
                    if( file_exists($rutaVista) ){
                        $this->renderCtrl( $rutaVista );
                    }else{
                        $this->setMensaje("P&aacute;gina no existente!");
                        $this->renderCtrl( $url_home . Config::PAGINA_ERROR );
                    }
                }
                
            }else{
                $rutaVista = $url_home . Config::PAGINA_WORKSPACE_HOME;
                $this->renderCtrl( $rutaVista );
            }
            
        }else{
            $rutaVista = $url_home . Config::PAGINA_WORKSPACE_HOME;
            $this->renderCtrl( $rutaVista );
        }
        
        $this->renderCtrl( $url_home . Config::PAGINA_PIE_HOME );
        
        echo "	\n";
        echo "	</body>\n";
        echo "</html>";
    }
    
}
?>