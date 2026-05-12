<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php'; // Asegúrate de instalar y cargar Guzzle con Composer

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MicrosoftGraphMail {
    private $clientId;
    private $clientSecret;
    private $tenantId;
    private $authority;
    private $scope;
    private $token;
    private $tokenExpires;
    private $httpClient;
    private $mailsender;
    
    public function __construct($clientId, $clientSecret, $tenantId, $mailsender) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->tenantId = $tenantId;
        $this->mailsender = $mailsender;
        $this->authority = "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token";
        $this->scope = "https://graph.microsoft.com/.default";
        $this->httpClient = new Client();
        $this->token = null;
        $this->tokenExpires = 0;
    }
    
    private function authenticate() {
        if ($this->token && time() < $this->tokenExpires) {
            return true;
        }
        
        try {
            $response = $this->httpClient->post($this->authority, [
                'form_params' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => $this->scope,
                    'grant_type' => 'client_credentials',
                ],
            ]);
            
            $data = json_decode($response->getBody(), true);
            
            if (isset($data['access_token'])) {
                $this->token = $data['access_token'];
                $this->tokenExpires = time() + $data['expires_in']; // Guardar el tiempo de expiración
                return true;
            }
        } catch (RequestException $e) {
            echo "Error al obtener el token: " . $e->getMessage();
        }
        return false;
    }
    
    public function sendMail($recipientEmail, $subject, $bodyHtml, $ccEmails = [], $bccEmails = [], $attachments = []) {
        if (!$this->authenticate()) {
            echo "Autenticación fallida. No se puede enviar el correo.";
            return false;
        }
        
        $sendMailUrl = "https://graph.microsoft.com/v1.0/users/{$this->mailsender}/sendMail";
        $headers = [
            'Authorization' => "Bearer {$this->token}",
            'Content-Type' => 'application/json; charset=UTF-8'
                ];
        
        $mailData = [
            'message' => [
                'subject' => $subject,
                'body' => [
                    'contentType' => 'HTML',
                    'content' => $bodyHtml
                ],
                'toRecipients' => [[
                    'emailAddress' => ['address' => $recipientEmail]
                ]]
            ],
            'saveToSentItems' => true
        ];
        
        if (!empty($ccEmails)) {
            foreach ($ccEmails as $cc) {
                $mailData['message']['ccRecipients'][] = ['emailAddress' => ['address' => $cc]];
            }
        }
        
        if (!empty($bccEmails)) {
            foreach ($bccEmails as $bcc) {
                $mailData['message']['bccRecipients'][] = ['emailAddress' => ['address' => $bcc]];
            }
        }
        
        if (!empty($attachments)) {
            $mailData['message']['attachments'] = [];
            foreach ($attachments as $attachmentPath) {
                if (file_exists($attachmentPath)) {
                    $fileContent = file_get_contents($attachmentPath);
                    $mailData['message']['attachments'][] = [
                        '@odata.type' => '#microsoft.graph.fileAttachment',
                        'name' => basename($attachmentPath),
                        'contentBytes' => base64_encode($fileContent)
                    ];
                } else {
                    throw new Exception( "Advertencia: No se encontr&oacute; el archivo adjunto {$attachmentPath}\n" );
                }
            }
        }
        
        try {
            $response = $this->httpClient->post($sendMailUrl, [
                'headers' => $headers,
                'json' => $mailData
            ]);
            
            if ($response->getStatusCode() === 202) {
                return true;
            }
        } catch (RequestException $e) {
            throw new Exception( "Error al enviar el correo: " . $e->getMessage() );
        }
        return false;
    }
    
    public function imageGet( $d ) {
        if (!$this->authenticate()) {
            echo "Autenticación fallida. No se puede enviar el correo.";
            return false;
        }
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        
        $sendMailUrl ='https://graph.microsoft.com/v1.0/users/{$this->mailsender}//photo/$value';
        $headers = [
            'Authorization' => "Bearer {$this->token}",
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        
        try {
            $response = $this->httpClient->get($sendMailUrl, [
                'headers' => $headers
            ]);
            
            if ($response->getStatusCode() === 202) {
                return true;
            }
        } catch (RequestException $e) {
            throw new Exception( "Error obteniendo foto: " . $e->getMessage() );
        }
        return false;
    }
    
}
?>