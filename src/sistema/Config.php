<?php
class Config {
    
    // Config Sitio
    const NOMBRE_SITIO = "Nuevapp";
    const CHARSET = "text/html; charset=utf-8";
    const PAGINA_LOGIN = "Login.phtml";
    const PAGINA_PIE = "Pie.phtml";
    const PAGINA_WORKSPACE = "Workspace.phtml";
    const PAGINA_ERROR = "ErroresWeb.phtml";
    
    const URLBASE = "https://localhost:8011/";
    
    // Config Home
    const PAGINA_WORKSPACE_HOME = "Workspacehome.phtml";
    const PAGINA_LOGIN_HOME = "Loginhome.phtml";
    const PAGINA_PIE_HOME = "Piehome.phtml";
    const PAGINA_CARACTERES_DESC = 100;
    
    // Config Mail
    const MAIL_SMTPAUTHE	= true;								// enable SMTP authentication
    const MAIL_PORT			= 587;								// set the SMTP server port
    const MAIL_HOST			= "smtp.ipage.com";                   // SMTP server
    const MAIL_USERNAME		= "nuevapp@evolutool.com";             // SMTP server username
    const MAIL_PASSWORD		= "73cn0l0g1@New.";                   // SMTP server password
    const MAIL_SMTPSECURE	= "";                                 // Secure method
    
    const MAIL_REMITENTE = "nuevapp@evolutool.com";
    const MAIL_LABEL_REMITENTE = "Admin Nuevapp";
    const MAIL_SUBJECT = "";
    
    // Config admin
    const USU_ADM = "root";
    const PAS_ADM = "802c92bfd4ba6f827781806f6c882531";
    
    // Global Config
    const CARPETA_REPOSITORIOS = "repo";
    const NOMBRE_CAMPO_UPLOAD = "campo";
    
    const DOMINIO_DEF = 'nuevapp.com';
}
?>