<?php
/**
 *
 * @author yalfonso
 *
 */
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Correo {
    
    private $to = "";
    private $subject = "";
    private $message = "";
    
    private $isCal = false;
    private $start = "20000101T160000";
    private $end = "20010101T180000";
    private $summary = "Resumen";
    private $location = "Lugar";
    private $esHTML = false;
    
    private $etiquetaNombre = "";
    private $emailRemitente = "";
    
    private $adjunto = "";
    
    public function setPara($vl){
        $this->to = $vl;
    }
    
    public function setTitulo($vl){
        $this->subject = $vl;
    }
    
    public function setMensaje($vl){
        $this->message = $vl;
    }
    
    public function setEsCalendario($vl){
        $this->isCal = $vl;
    }
    
    public function setFechaInicio($vl){
        $this->start = $vl;
    }
    
    public function setFechaFin($vl){
        $this->end = $vl;
    }
    
    public function setResumen($vl){
        $this->summary = $vl;
    }
    
    public function setLugar($vl){
        $this->location = $vl;
    }
    
    public function setEsHTML($vl){
        $this->esHTML = $vl;
    }
    
    public function dateToCal($timestamp) {
        return date('Ymd\THis\Z', $timestamp);
    }
    
    public function setAdjunto( $d ){
        $this->adjunto = $d;
    }
    
    public function setEtiquetaNombre( $d ){
        $this->etiquetaNombre = $d;
    }
    
    public function setEmailRemitente( $d ){
        $this->emailRemitente = $d;
    }
    
    private function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
    
    public function enviar()
    {
        include_once ( dirname(dirname( __FILE__ )) . DIRECTORY_SEPARATOR . "libs" . DIRECTORY_SEPARATOR . "PHPMailer-61" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php");
        include_once ( dirname(dirname( __FILE__ )) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR . "OperacionesCtrl.php");
        
        $cfg = OperacionesCtrl::LeerConfigCorp();
        
        $_CFG_SMTP_AUTHSMTP = filter_var( isset( $cfg[ OperacionesCtrl::CFG_SMTP_AUTHSMTP ]) ? $cfg[ OperacionesCtrl::CFG_SMTP_AUTHSMTP ]["val"] : true , FILTER_VALIDATE_BOOLEAN);
        $_CFG_SMTP_HOST = isset( $cfg[ OperacionesCtrl::CFG_SMTP_HOST ]) ? $cfg[ OperacionesCtrl::CFG_SMTP_HOST ]["val"] : "";
        $_CFG_SMTP_PORT = isset( $cfg[ OperacionesCtrl::CFG_SMTP_PORT ]) ? $cfg[ OperacionesCtrl::CFG_SMTP_PORT ]["val"] : "";
        $_CFG_SMTP_USER = isset( $cfg[ OperacionesCtrl::CFG_SMTP_USER ]) ? $cfg[ OperacionesCtrl::CFG_SMTP_USER ]["val"] : "";
        $_CFG_SMTP_PASS = isset( $cfg[ OperacionesCtrl::CFG_SMTP_PASS ]) ? base64_decode( $cfg[ OperacionesCtrl::CFG_SMTP_PASS ]["val"] ) : "";
        $_CFG_SMTP_SECURE = isset( $cfg[ OperacionesCtrl::CFG_SMTP_SECURE ]) ? $cfg[ OperacionesCtrl::CFG_SMTP_SECURE ]["val"] : "";
        
        
        try{
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth   = $_CFG_SMTP_AUTHSMTP;
            $mail->Port       = $_CFG_SMTP_PORT;
            $mail->Host       = $_CFG_SMTP_HOST;
            $mail->Username   = $_CFG_SMTP_USER;
            $mail->Password   = $_CFG_SMTP_PASS;
            $mail->SMTPSecure = $_CFG_SMTP_SECURE;
            //die(print_r( $mail, true));
            
            if ( strlen( trim( $this->emailRemitente ) ) > 0 ) {
                $mail->From = $this->emailRemitente;
            }
            $mail->FromName   = $this->etiquetaNombre;
            
            if( defined( 'Config::MAIL_PRIORIDAD' ) ){
                $mail->Priority   = Config::MAIL_PRIORIDAD;
                $mail->addCustomHeader("X-MSMail-Priority: High");
                $mail->addCustomHeader("X-Priority: 1 (Highest)");
                $mail->AddCustomHeader("Importance: High");
            }
            
            $corpbs = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "repo" . DIRECTORY_SEPARATOR . "corp" . DIRECTORY_SEPARATOR . "Corporation.php";
            if( file_exists( $corpbs ) ){
                include_once( $corpbs );
                if( Corporation::CONFIG ){
                    $mail->SMTPAuth   = Corporation::MAIL_SMTPAUTHE;
                    $mail->Port       = Corporation::MAIL_PORT;
                    $mail->Host       = Corporation::MAIL_HOST;
                    $mail->Username   = Corporation::MAIL_USERNAME;
                    $mail->Password   = Corporation::MAIL_PASSWORD;
                    $mail->SMTPSecure = Corporation::MAIL_SMTPSECURE;
                    
                    $mail->From       = Corporation::MAIL_REMITENTE;
                    $mail->FromName   = Corporation::MAIL_LABEL_REMITENTE;
                    
                    if( defined( 'SubCorporation::MAIL_PRIORIDAD' ) ){
                        $mail->priority = SubCorporation::MAIL_PRIORIDAD;
                        $mail->addCustomHeader("X-MSMail-Priority: High");
                        $mail->addCustomHeader("X-Priority: 1 (Highest)");
                        $mail->AddCustomHeader("Importance: High");
                    }
                }
            }
            $mail->IsHTML( $this->esHTML );
            $mail->ContentType = 'text/html';
            
            if( strlen( trim( $this->etiquetaNombre ) ) > 0 ){
                $mail->FromName = $this->etiquetaNombre;
            }
            if( strlen( trim( $this->adjunto ) ) > 0 ){
                $fl = $this->adjunto;
                if( !file_exists($fl) ){
                    if( $this->get_http_response_code ( $fl ) == "200" ){
                        $binFl = file_get_contents ( $fl );
                        $datfl = pathinfo($fl);
                        $mail->addStringAttachment($binFl, $datfl["basename"]);
                    }
                    else{
                        throw new Exception('Correo: El archivo "' . $fl . '" no existe');
                    }
                }else {
                    $mail->addAttachment($fl);
                }
            }
            
            $mailerror="Mailer Error: " . $mail->ErrorInfo;
            $mailsuccess="Sent!";
            $body = preg_replace("[\\\\]",'',$this->message);
            $mail->AddAddress($this->to);
            $mail->Subject = $this->subject;
            
            if ( $this->isCal === true ){
                $mail->ContentType = 'text/calendar';
                
                $mail->addCustomHeader('MIME-version',"1.0");
                $mail->addCustomHeader('Content-type',"text/calendar; method=REQUEST; charset=UTF-8");
                $mail->addCustomHeader('Content-Transfer-Encoding',"8bit");
                $mail->addCustomHeader("Content-class: urn:content-classes:calendarmessage");
                
                
                $event_id = date('Ymdhis');
                $sequence = 0;
                $status = 'CONFIRMED';
                
                $icalTxt  = "BEGIN:VCALENDAR\r\n";
                $icalTxt .= "PRODID:-//YourCassavaLtd//EateriesDept//EN\r\n";
                $icalTxt .= "VERSION:2.0\r\n";
                $icalTxt .= "METHOD:REQUEST\r\n";
                $icalTxt .= "BEGIN:VEVENT\r\n";
                $icalTxt .= "DTSTART:". $this->start . "\r\n";
                $icalTxt .= "DTEND:". $this->end . "\r\n";
                
                //$icalTxt .= "DTSTAMP:" . $this->dateToCal(time()) . "\r\n";
                $icalTxt .= "DTSTAMP:" . gmdate("Ymd\THis\Z", time()) . "\r\n";
                //$icalTxt .= "DTSTAMP;TZID=" . date_default_timezone_get() . ":" . date('Ymd').'T'.date('His')."\r\n";
                $icalTxt .= "ORGANIZER;SENT-BY=\"MAILTO:" . $mail->From . "\":MAILTO:" . $mail->From ."\r\n";
                $icalTxt .= "UID:".strtoupper(md5($event_id))."-fonevent.com\r\n";
                $icalTxt .= "ATTENDEE;CN=" . $mail->From . ";ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;RSVP=TRUE:" . $mail->From . "\r\n";
                $icalTxt .= "SEQUENCE:".$sequence."\r\n";
                $icalTxt .= "STATUS:".$status."\r\n";
                $icalTxt .= "DESCRIPTION:". $this->summary ."\r\n";
                $icalTxt .= "LOCATION:". $this->location . "\r\n";
                $icalTxt .= "SUMMARY:". $this->subject ."\r\n";
                $icalTxt .= "BEGIN:VALARM\r\n";
                $icalTxt .= "TRIGGER:-PT15M\r\n";
                $icalTxt .= "ACTION:DISPLAY\r\n";
                $icalTxt .= "END:VALARM\r\n";
                $icalTxt .= "END:VEVENT\r\n";
                $icalTxt .= "END:VCALENDAR\r\n";
                
                $mail->Body = $icalTxt . $body;
                
                if(!$mail->Send()){
                    $mailerror = "Mailer Error: " . $mail->ErrorInfo;
                    error_log("[calendar] error sent mail to " . $this->to . "(" . $mailerror . ")");
                    throw new Exception( $mailerror );
                }else{
                    error_log("[calendar] ok sent mail to " . $this->to);
                    return $mailsuccess;
                }
            }
            else
            {
                $mail->MsgHTML($body);
                if(!$mail->Send()){
                    $mailerror = "Mailer Error: " . $mail->ErrorInfo;
                    error_log("[email] error sent mail to " . $this->to . "(" . $mailerror . ")");
                    throw new Exception( $mailerror );
                }else{
                    error_log("[email] ok sent mail to " . $this->to);
                    return $mailsuccess;
                }
            }
        }
        catch (PHPMailer $e) {
            error_log("[phpmailerException]: " . $e->errorMessage());
            throw new Exception( $e->errorMessage() ); //Pretty error messages from PHPMailer
        }
        catch (Exception $e) {
            error_log("[Exception]: " . $e->errorMessage());
            throw new Exception( $e->getMessage() . "<br />" . $e->getTraceAsString() ); //Boring error messages from anything else!
        }
    }
    
}
?>