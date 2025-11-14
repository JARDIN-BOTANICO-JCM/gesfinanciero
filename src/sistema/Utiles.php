<?php
class Utiles{
    
    /**
     * Sube múltiples archivos desde $_FILES al directorio indicado.
     *
     * @param string $carpetadestino Ruta destino donde se guardarán los archivos.
     * @param array  $tipos          Array de tipos MIME permitidos. Si $tipos[0] == "*" permite todos.
     * @param string $nombrecampo    Nombre del campo en $_FILES (por defecto 'campo').
     * @param bool   $nmTmp          Si true genera nombres temporales únicos (md5(uniqid())) conservando la extensión.
     * @return array                 Array con rutas de los archivos guardados o false por cada archivo que falló.
     */
    public static function SubirArchivos( $carpetadestino, $tipos , $nombrecampo = 'campo', $nmTmp = false){
        $nombreFl = $nombrecampo;
        $target_path = $carpetadestino;
        $arrSalida = array();
        
        if ( isset( $_FILES[ $nombreFl ] ) ) {
            
            foreach ($_FILES[ $nombreFl ]['name'] as $id => $value) {
                
                if( isset( $tipos[ $_FILES[ $nombreFl ]['type'][ $id ] ] ) || $tipos[0] == "*" ){
                    $nombrearchivo = $_FILES[ $nombreFl ]['name'][ $id ];
                    $partsFile = pathinfo($nombrearchivo);
                    $strresulta = $target_path . ($nmTmp ? md5(uniqid()) . "." . $partsFile["extension"] : $nombrearchivo );
                    
                    if( copy( $_FILES[ $nombreFl ]['tmp_name'][ $id ], $strresulta ) ){
                        $arrSalida[] = $strresulta;
                    } else {
                        $arrSalida[] = false;
                    }
                }
                else{
                    $arrSalida[] = false;
                }
                
            }
        }
        
        return $arrSalida;
    }
    
    /**
     * Descomprime un archivo GZIP (.gz) y guarda el contenido en el mismo directorio
     * con el nombre del archivo sin la extensión .gz.
     *
     * @param string $file Ruta completa del archivo .gz a descomprimir.
     * @return string Ruta del archivo descomprimido generado.
     */
    public static function DescomprimirArchivos( $file ){
        
        $flFinal = pathinfo($file);
        $sfp = gzopen($file, "rb");
        $archivo = $flFinal["dirname"] . DIRECTORY_SEPARATOR . $flFinal["filename"];
        
        $fp = fopen( $archivo, "w");
        
        while (!gzeof($sfp)) {
            $string = gzread($sfp, 4096);
            fwrite($fp, $string, strlen($string));
        }
        gzclose($sfp);
        fclose($fp);
        return $archivo;
    }
    
    /**
     * Incluye archivos .php de un directorio o devuelve la lista de nombres encontrados.
     *
     * Escanea el directorio indicado, filtra archivos PHP (no directorios ni el propio archivo),
     * y realiza include_once de cada uno salvo que $recibirLista sea true, en cuyo caso sólo devuelve la lista.
     *
     * @param string $dir         Ruta del directorio a procesar.
     * @param bool   $recibirLista Si true no incluye los archivos y devuelve la lista (por defecto false).
     * @param bool   $conextension Si true los nombres devueltos incluyen la extensión (por defecto true).
     * @return array Lista de nombres de archivo encontrados (con o sin extensión según $conextension).
     */
    public static function IncluirArchivos( $dir, $recibirLista = false, $conextension = true ){
        $dh  = opendir($dir);
        $este = __FILE__;
        $files = array();
        while (false !== ($filename = readdir($dh))) {
            $tmpFn = pathinfo( $filename );
            $soloNombre = ($conextension) ? $tmpFn['basename'] : $tmpFn[ 'filename' ];
            $ext = $tmpFn['extension'];
            if( !is_dir( $dir . DIRECTORY_SEPARATOR . $soloNombre) && strtolower( $ext ) == "php" && $este != ($dir . DIRECTORY_SEPARATOR . $soloNombre) ){
                $files[] = $soloNombre;
            }
        }
        if( !$recibirLista ){
            foreach( $files as $idF => $archivo ){
                include_once ( $dir . DIRECTORY_SEPARATOR . $archivo );
            }
        }
        return $files;
    }
    
    /**
     * Comprueba si una cadena termina con otro sufijo.
     *
     * Devuelve true si $needle está vacío o si $haystack finaliza exactamente con $needle (búsqueda sensible a mayúsculas).
     *
     * @param string $haystack Cadena donde se busca el sufijo.
     * @param string $needle   Sufijo a comprobar.
     * @return bool True si $haystack termina con $needle, false en caso contrario.
     */
    public static function TerminaEn( $haystack, $needle ){
        $tieneForaneo = ( $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE));
        return $tieneForaneo;
    }
    
    /**
     * Comprueba si una cadena comienza con otra.
     *
     * @param string $haystack Cadena en la que se busca.
     * @param string $needle   Subcadena que se espera al inicio de $haystack.
     * @return bool True si $haystack comienza exactamente con $needle (sensible a mayúsculas), false en caso contrario.
     */
    public static function ComienzaEn( $haystack, $needle ){
        $tieneForaneo = ( substr($haystack, 0, strlen($needle)) === $needle );
        return $tieneForaneo;
    }
    
    /**
     * Obtiene la URL base del sitio (protocolo + host + directorio).
     *
     * Construye la URL a partir del host y el directorio actual, detectando
     * HTTPS cuando procede y asegurando que la URL resultante termine en "/".
     *
     * @return string URL base terminada en "/"
     */
    public static function getBaseUrl(){
        $currentPath = $_SERVER['PHP_SELF'];
        $pathInfo = pathinfo($currentPath);
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower( "http" );
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocol = "https";
        }
        $urlTmp = $protocol . "://" . $hostName . $pathInfo['dirname'];
        return $urlTmp . (self::TerminaEn($urlTmp, "/") ? "" : "/");
    }
    
    /**
     * Genera una barra de paginación en HTML con controles de anterior, siguiente y entrada de página.
     * Toma en cuenta $_POST['paginaV'] para calcular la página actual y añade campos ocultos pageid y jsmenuid.
     *
     * @param string|int $pi Identificador de la página/modelo que se incluirá en el campo hidden "pageid".
     * @param string|int $jsmi Identificador del menú JavaScript que se incluirá en el campo hidden "jsmenuid".
     * @return string HTML de la barra de paginación.
     */
    public static function BarraPaginacion($pi, $jsmi){
        $pvIni = (isset($_POST["paginaV"]) ? $_POST["paginaV"] : "0");
        $html  = "	<table class=\"barraNavTablas\"> \n";
        $html .= "		<tbody> \n";
        $html .= "			<tr> \n";
        $html .= "				<td align=\"left\"> \n";
        $html .= "					<form action=\"./index.php\" method=\"post\"> \n";
        $html .= "						<input type=\"submit\" name=\"pvLess\" value=\"&lt;\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"paginaV\" value=\"" . (($pvIni < 0) ? 0 : $pvIni - 1) ."\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"pageid\" value=\"modelos/" . $pi . "\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"jsmenuid\" value=\"" . $jsmi . "\" /> \n";
        $html .= "					</form> \n";
        $html .= "				</td> \n";
        $html .= "				<td align=\"center\"> \n";
        $html .= "					<form action=\"./index.php\" method=\"post\"> \n";
        $cPag = (($pvIni <= 0 ? 0 : $pvIni) + 1);
        $html .= "						P&aacute;gina \n";
        $html .= "						<input type=\"text\" name=\"paginaV\" style=\"width: 30px; text-align: right;\" value=\"" . $cPag ."\" />";
        $html .= "						<input type=\"submit\" class=\"ad-menuFiltros\" value=\"&nbsp;\"> \n";
        $html .= "						<input type=\"hidden\" name=\"pageid\" value=\"modelos/" . $pi . "\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"jsmenuid\" value=\"" . $jsmi . "\" /> \n";
        $html .= "					</form> \n";
        $html .= "				</td> \n";
        $html .= "				<td align=\"right\"> \n";
        $html .= "					<form action=\"./index.php\" method=\"post\"> \n";
        $html .= "						<input type=\"submit\" name=\"pvAdd\" value=\"&gt;\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"paginaV\" value=\"" . ($pvIni + 1) . "\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"pageid\" value=\"modelos/" . $pi . "\" /> \n";
        $html .= "						<input type=\"hidden\" name=\"jsmenuid\" value=\"" . $jsmi . "\" /> \n";
        $html .= "					</form> \n";
        $html .= "				</td> \n";
        $html .= "			</tr> \n";
        $html .= "		</tbody> \n";
        $html .= "	</table> \n";
        
        return $html;
    }
    
    /**
     * Determina si el cliente es un dispositivo móvil comprobando $_SERVER['HTTP_USER_AGENT'.
     *
     * Usa expresiones regulares para detectar una amplia gama de agentes móviles.
     *
     * @return bool True si se detecta un móvil, False en caso contrario.
     */
    public static function isMobile() {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        $mb = (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)));
        return $mb;
    }
    
    /**
     * Devuelve un arreglo con los comparadores válidos para construir filtros o consultas.
     *
     * @return array<string,string> Mapa de comparadores (clave => representación).
     */
    public static function obtenerComparadores(){
        $arr = array("=" =>"=",
            ">" => "&gt;",
            ">=" => "&gt;=",
            "<" => "&lt;",
            "<=" => "&lt;=",
            "!=" => "!=",
            "LIKE" => "LIKE",
            "NOT LIKE" => "NOT LIKE",
            "IS NULL" => "IS NULL",
            "IS NOT NULL" => "IS NOT NULL");
        return $arr;
    }
    
    /**
     * https://gist.github.com/tylerhall/521810
     *
     * @param number $length
     * @param boolean $add_dashes
     * @param string $available_sets
     * @return string
     */
    public static function nuevoCl($length = 9, $add_dashes = false, $available_sets = 'luds'){
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            if(strpos($available_sets, 'u') !== false)
                $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
                if(strpos($available_sets, 'd') !== false)
                    $sets[] = '23456789';
                    if(strpos($available_sets, 's') !== false)
                        $sets[] = '!@#$%&*?';
                        $all = '';
                        $password = '';
                        foreach($sets as $set)
                        {
                            $password .= $set[array_rand(str_split($set))];
                            $all .= $set;
                        }
                        $all = str_split($all);
                        for($i = 0; $i < $length - count($sets); $i++)
                            $password .= $all[array_rand($all)];
                            $password = str_shuffle($password);
                            if(!$add_dashes)
                                return $password;
                                $dash_len = floor(sqrt($length));
                                $dash_str = '';
                                while(strlen($password) > $dash_len)
                                {
                                    $dash_str .= substr($password, 0, $dash_len) . '-';
                                    $password = substr($password, $dash_len);
                                }
                                $dash_str .= $password;
                                return $dash_str;
                                
    }
    
    /**
     * Convierte un objeto a un array asociativo usando sus métodos getter (prefijo "get").
     * Las claves son el nombre del getter sin el prefijo "get" en minúsculas.
     * Si $encodcharset es true, convierte cada valor desde $acharset hacia $decharset.
     *
     * @param object $vl           Objeto a convertir.
     * @param bool   $encodcharset Indica si se debe convertir la codificación de caracteres.
     * @param string $decharset    Codificación destino (por defecto "UTF-8").
     * @param string $acharset     Codificación origen (por defecto "ISO-8859-1").
     * @return array               Array asociativo resultante.
     */
    public static function objToArray($vl, $encodcharset = false, $decharset = "UTF-8", $acharset = "ISO-8859-1"){
        $obt = "get";
        $metad = get_class_methods( $vl );
        
        $tmpArr = array();
        foreach ($metad as $idM => $vlM) {
            if(Utiles::ComienzaEn($vlM, $obt)){
                $nwId = strtolower( str_replace($obt, "", $vlM) );
                
                if( $encodcharset ){
                    $tmpArr[ $nwId ] = mb_convert_encoding($vl->$vlM(), $decharset, $acharset);
                }else{
                    $tmpArr[ $nwId ] = $vl->$vlM();
                }
            }
        }
        return $tmpArr;
    }
    
    /**
     * Elimina recursivamente un directorio y todo su contenido.
     *
     * @param string $dirname Ruta del directorio a eliminar.
     * @return bool Devuelve true si la eliminación fue exitosa, false en caso de error.
     */
    public static function delete_directory($dirname) {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
            if (!$dir_handle)
                return false;
                while($file = readdir($dir_handle)) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($dirname."/".$file))
                            unlink($dirname."/".$file);
                            else
                                self::delete_directory($dirname.'/'.$file);
                    }
                }
                closedir($dir_handle);
                rmdir($dirname);
                return true;
    }
    
    /**
     * Limpia una cadena: reemplaza espacios por guiones, normaliza caracteres acentuados
     * (á, é, í, ó, ú, ñ, ç, etc.) a sus equivalentes sin acento y elimina los caracteres
     * que no sean letras, números o guiones.
     *
     * @param string $string Cadena de entrada a normalizar.
     * @return string Cadena limpia y apta para URLs o identificadores.
     */
    public static function CleanSpecialChars($string) {
        $cadena = str_replace(' ', '-', utf8_decode( $string ) ); // Replaces all spaces with hyphens.
        
        //Reemplazamos la A y a
        $cadena = str_replace(
            array('�', '�', '�', '�', '�', '�', '�', '�', '�'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
        );
        
        //Reemplazamos la E y e
        $cadena = str_replace(
            array('�', '�', '�', '�', '�', '�', '�', '�'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );
        
        //Reemplazamos la I y i
        $cadena = str_replace(
            array('�', '�', '�', '�', '�', '�', '�', '�'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );
        
        //Reemplazamos la O y o
        $cadena = str_replace(
            array('�', '�', '�', '�', '�', '�', '�', '�'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );
        
        //Reemplazamos la U y u
        $cadena = str_replace(
            array('�', '�', '�', '�', '�', '�', '�', '�'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );
        
        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
            array('�', '�', '�', '�'),
            array('N', 'n', 'C', 'c'),
            $cadena
            );
        
        return preg_replace('/[^a-zA-Z0-9\-]/', '', $cadena); // Removes special chars.
    }
    
    /**
     * Get the IP address of the client accessing the website
     *
     * @author     Dotan Cohen
     * @version    2013-07-02
     *
     * @param null $return_type 'array', 'single'
     *
     * @return array|bool|mixed
     */
    public static function get_user_ip_address( $return_type = NULL)
    {
        // Consider: http://stackoverflow.com/questions/4581789/how-do-i-get-user-ip-address-in-django
        // Consider: http://networkengineering.stackexchange.com/questions/2283/how-to-to-determine-if-an-address-is-a-public-ip-address
        
        $ip_addresses = array();
        $ip_elements = array(
            'HTTP_X_FORWARDED_FOR', 'HTTP_FORWARDED_FOR',
            'HTTP_X_FORWARDED', 'HTTP_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_CLUSTER_CLIENT_IP',
            'HTTP_X_CLIENT_IP', 'HTTP_CLIENT_IP',
            'REMOTE_ADDR'
        );
        
        
        foreach ( $ip_elements as $element ) {
            if(isset($_SERVER[$element])) {
                if ( !is_string($_SERVER[$element]) ) {
                    // Log the value somehow, to improve the script!
                    continue;
                }
                $address_list = explode(',', $_SERVER[$element]);
                $address_list = array_map('trim', $address_list);
                // Not using array_merge in order to preserve order
                foreach ( $address_list as $x ) {
                    $ip_addresses[] = $x;
                }
            }
        }
        
        
        if ( count($ip_addresses)==0 ) {
            return FALSE;
            
        } elseif ( $return_type==='array' ) {
            return $ip_addresses;
            
        } elseif ( $return_type === 'single' || $return_type === NULL ) {
            return $ip_addresses[0];
        }
        
    }

    /**
     * Convierte una cadena a la codificación UTF-8 (o a la especificada).
     *
     * Detecta la codificación de entrada y realiza la conversión a la
     * codificación objetivo utilizando mb_detect_encoding e iconv,
     * omitiendo caracteres no convertibles.
     *
     * @param string $text Texto a convertir.
     * @param string $coding Codificación destino (por defecto "UTF-8").
     * @return string Texto convertido a la codificación indicada.
     */
    public static function ConvertToUTF8($text, $coding = "UTF-8"){
        
        $encoding = mb_detect_encoding($text, mb_detect_order(), false);
        
        if($encoding == $coding)
        {
            $text = mb_convert_encoding($text, $coding, $coding );
        }
        
        
        $out = iconv(mb_detect_encoding($text, mb_detect_order(), false), "{$coding}//IGNORE", $text);
        
        
        return $out;
    }
    
    /**
     * Convierte un fichero CSV a un array asociativo (similar a JSON).
     *
     * Lee el CSV indicado por $csv, utiliza la primera fila como cabeceras,
     * convierte los valores a UTF-8 y devuelve un array de filas como arrays asociativos.
     * $sepa indica el separador de campos. Si se pasan $idenc y $vl, devuelve
     * inmediatamente la fila que coincida con ese valor en la columna indicada.
     *
     * @param string $csv  Ruta al fichero CSV
     * @param string $sepa Separador de campos (por defecto ';')
     * @param string $idenc Nombre de columna para filtrar (opcional)
     * @param string $vl   Valor a buscar en la columna $idenc (opcional)
     * @return array Array de filas asociativas, o array con la fila coincidente
     */
    public static function Csv2Json( $csv, $sepa = ';', $idenc = '', $vl = '' ) {
        $json = array();
        $heads = array();
        $primero = true;
        $fila = 0;
        
        if (($gestor = fopen( $csv , "r")) !== FALSE) {            
            while (($datosf = fgetcsv( $gestor, 1000, $sepa )) !== FALSE) {
                
                $numero = count($datosf);
                
                $datos = array();
                for ( $c=0 ; $c < $numero; $c++ ) {
                    
                    if( $fila >= 1 ){
                        //$datos[ $heads[$c] ] = $datosf[$c];
                        
                        $datos[ $heads[$c] ] = self::ConvertToUTF8( $datosf[$c]); // iconv( mb_detect_encoding ( $datosf[$c] ), "UTF-8//IGNORE", $datosf[$c] );
                        $primero = false;
                    }
                    else{
                        $heads[] = $datosf[ $c ];
                    }
                }
                if(!$primero){
                    $json[] = $datos;
                }
                
                if( $idenc != '' && $vl != '' ){
                    if ( isset ( $datos[ $idenc ] ) ) {
                        if ( trim( strtolower( $datos[ $idenc ] ) ) == trim( strtolower( $vl ) ) ) {
                            return array( $datos );
                        }
                    }
                }
                
                $fila++;
            }
            fclose($gestor);
        }
        
        return $json;
    }
    
    /**
     * Genera un UUID versión 4 (aleatorio).
     *
     * @return string UUID en formato 8-4-4-4-12 (hexadecimal con guiones)
     */
    public static function create_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
            
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
            
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
            
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            );
    }
    
    /**
     * Convierte un tamaño en bytes a una representación legible (B, KB, MB, GB, TB).
     *
     * @param int|float $bytes     Tamaño en bytes (se normaliza a >= 0).
     * @param int       $precision Cantidad de decimales a mostrar (por defecto 2).
     * @return string              Cadena formateada con unidad apropiada.
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    
    /**
     * Enmascara un correo electrónico: conserva el primer y último carácter de la parte local,
     * sustituye el resto por '****' y mantiene el dominio intacto.
     *
     * @param string $d Correo electrónico a enmascarar.
     * @return string Correo enmascarado (p. ej. j****o@dominio.com).
     */
    public static function maskEmail( $d ){
        $p = explode("@", $d);
        $name = $p[ 0 ];
        $mskS = substr($name, 0, 1);
        $mskM = '****';
        $mskE = substr($name, strlen( $name )-1, 1);
        return $mskS . $mskM . $mskE . "@" . $p[1];
    }
    
    /**
     * Convierte un color hexadecimal a un arreglo RGB.
     *
     * Acepta cadenas con 3 o 6 dígitos hexadecimales, con o sin '#' inicial.
     *
     * @param string $colorHex Color en formato hexadecimal (p. ej. '#ff0000' o 'f00').
     * @return int[]|false Arreglo [r, g, b] con valores 0-255, o false si el formato no es válido.
     */
    public static function hexToRgb( $colorHex ) {
        $colorHex = str_replace('#', '', $colorHex);
        
        if (strlen( $colorHex) == 6) {
            list($r, $g, $b) = array($colorHex[0].$colorHex[1], $colorHex[2].$colorHex[3], $colorHex[4].$colorHex[5]);
        } elseif (strlen($colorHex) == 3) {
            list($r, $g, $b) = array($colorHex[0].$colorHex[0], $colorHex[1].$colorHex[1], $colorHex[2].$colorHex[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        
        // Retornar el color RGB
        return array($r, $g, $b);
    }
    
    /**
     * Convierte una imagen PNG a JPG rellenando la transparencia con fondo blanco.
     *
     * @param string $archivoOrigen    Ruta del archivo PNG de origen.
     * @param string $archivoDestino   Ruta donde se guardará el JPG resultante.
     * @return string|false            Devuelve la ruta del JPG creado o false si ocurre un error.
     */
    public static function pngTojpg($archivoOrigen, $archivoDestino) {
        $imagen = imagecreatefrompng($archivoOrigen);
        
        $fondoBlanco = imagecreatetruecolor(imagesx($imagen), imagesy($imagen));
        
        $colorBlanco = imagecolorallocate($fondoBlanco, 255, 255, 255);
        imagefill($fondoBlanco, 0, 0, $colorBlanco);
        
        imagecopy($fondoBlanco, $imagen, 0, 0, 0, 0, imagesx($imagen), imagesy($imagen));
        
        imagejpeg($fondoBlanco, $archivoDestino);
        
        imagedestroy($imagen);
        imagedestroy($fondoBlanco);
        
        if ( file_exists( $archivoDestino ) ) {
            return $archivoDestino;
        }
        else {
            return false;
        }
    }
    
    /**
     * Escapa comillas simples, comillas dobles y barras invertidas para su uso en consultas SQL.
     *
     * @param string $d Cadena a preparar/escapar.
     * @return string Cadena escapada lista para insertar en una consulta SQL.
     */
    public static function prepararTxtSQL ( $d ){
        $txtes = str_replace(array("'", "\\", "\""), array("\\'", "\\\\", "\\\""),  $d );
        return $txtes;
    }
    
    /**
     * Obtiene el sistema operativo detectado a partir del encabezado User-Agent.
     *
     * Retorna 'win', 'mac', 'unix' u 'otro' según el agente; devuelve false si no está disponible $_SERVER['HTTP_USER_AGENT'].
     *
     * @return string|false 'win'|'mac'|'unix'|'otro' o false si no hay User-Agent
     */
    public static function obtenerSistemaOperativo(){
        if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            $agenteUsuario = $_SERVER['HTTP_USER_AGENT'];
            
            if (strpos($agenteUsuario, 'Windows') !== false) {
                return 'win';
            } elseif (strpos($agenteUsuario, 'Macintosh') !== false) {
                return 'mac';
            } elseif (strpos($agenteUsuario, 'Unix') !== false || strpos($agenteUsuario, 'Linux') !== false) {
                return 'unix';
            } else {
                return 'otro';
            }
        }
        else {
            return false;
        }
    }
    
    /**
     * Devuelve el valor de la directiva `post_max_size` en megabytes.
     *
     * Lee la configuración de PHP (post_max_size), interpreta la unidad (K, M, G)
     * y la convierte a MB.
     *
     * @return float Tamaño máximo permitido para POST en megabytes.
     */
    public static function getPostMaxSizeMB() {
        $postMaxSize = ini_get('post_max_size');
        $unit = strtoupper(substr($postMaxSize, -1)); // Extrae la última letra (M, G, K)
        $size = (int) $postMaxSize; // Convierte el número a entero
        
        switch ($unit) {
            case 'G': // Gigabytes a MB
                $size *= 1024;
                break;
            case 'K': // Kilobytes a MB
                $size /= 1024;
                break;
            case 'M': // Megabytes (ya está en MB)
            default:
                break;
        }
        
        return $size; // Retorna el tamaño en MB como número
    }
    
}
?>