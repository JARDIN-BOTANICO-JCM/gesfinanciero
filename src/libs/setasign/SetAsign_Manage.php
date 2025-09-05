<?php
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php');
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor/library/SetaPDF/Autoload.php');
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TextField.php');

use SetaPDF_Signer_X509_Certificate as Certificate;

class SetAsign_Manage {
    const ERR_COD_NOACCESIBLE_P12 = '5001';
    const ERR_COD_IMAGEN_NODEFINIDA = '5002';
    
    private $p12 = "";

    /**
     * @param string $p12
     */
    public function setP12($p12)
    {
        $this->p12 = $p12;
    }
    
    public function firmarIncremental($d)
    {
        $p12Content = file_get_contents($this->p12);
        $pkcs12Password = $d['clave'];
        $p12 = [];
        
        if (!openssl_pkcs12_read($p12Content, $p12, $pkcs12Password)) {
            http_response_code(self::ERR_COD_NOACCESIBLE_P12);
            throw new Exception('No se pudo leer el archivo .p12', self::ERR_COD_NOACCESIBLE_P12);
        }
        
        $inputFile  = $d['entrada'];
        $outputFile = $d['salida'];
        
        if (!isset($d['img'])) {
            http_response_code(self::ERR_COD_IMAGEN_NODEFINIDA);
            throw new Exception('Debe definir una imagen', self::ERR_COD_IMAGEN_NODEFINIDA);
        }
        $rutaImagenFirma = $d['img'];
        
        $reader   = new SetaPDF_Core_Reader_File($inputFile);
        $writer   = new SetaPDF_Core_Writer_File($outputFile);
        $document = SetaPDF_Core_Document::load($reader, $writer);
        
        // Crear el firmador
        $signer = new SetaPDF_Signer($document);
        
        // Módulo PAdES para firma avanzada
        $module = new SetaPDF_Signer_Signature_Module_Pades();
        $module->setCertificate($p12['cert']);
        $module->setPrivateKey($p12['pkey']);
        
        // (Opcional) agregar toda la cadena de certificados si está disponible
        if (isset($p12['extracerts']) && is_array($p12['extracerts'])) {
            $module->setExtraCertificates($p12['extracerts']);
        }
        
        // Definir la página y coordenadas
        $pages  = $document->getCatalog()->getPages();
        $pageNo = isset($d['page']) ? $d['page'] : $pages->count();
        $page   = $pages->getPage($pageNo);
        
        $fontSize   = isset($d['fontSize']) ? $d['fontSize'] : 12;
        $pageWidth  = $page->getWidth();
        $rectWidth  = 150;
        $rectHeight = 60;
        $x = isset($d['x']) ? $d['x'] : ($pageWidth - $rectWidth - 50);
        $y = isset($d['y']) ? ($d['y'] - ($rectHeight - $fontSize)) : 50;
        
        $nombrecampo = isset($d['nombrecampo']) ? $d['nombrecampo'] : 'Firma_' . uniqid();
        
        // Crear el campo de firma
        $field = SetaPDF_Signer_SignatureField::add(
            $document,
            $nombrecampo,
            $pageNo,
            $x, $y, $rectWidth, $rectHeight
            );
        $signer->setSignatureFieldName($field->getQualifiedName());
        
        // Insertar imagen de la firma
        $image    = SetaPDF_Core_Image::getByPath($rutaImagenFirma);
        $xObject  = $image->toXObject($document);
        
        // Configuración de la apariencia
        $appearance = new SetaPDF_Signer_Signature_Appearance_Dynamic($module);
        $appearance->setGraphic($xObject);
        $appearance->setShow(SetaPDF_Signer_Signature_Appearance_Dynamic::CONFIG_SHOW_NAME, false);
        $appearance->setShow(SetaPDF_Signer_Signature_Appearance_Dynamic::CONFIG_SHOW_DATE, false);
        $appearance->setShow(SetaPDF_Signer_Signature_Appearance_Dynamic::CONFIG_SHOW_REASON, false);
        $appearance->setShow(SetaPDF_Signer_Signature_Appearance_Dynamic::CONFIG_SHOW_LOCATION, false);
        $appearance->setShow(SetaPDF_Signer_Signature_Appearance_Dynamic::CONFIG_DISTINGUISHED_NAME, false);
        
        $signer->setAppearance($appearance);
        
        $razon = isset($d['razon']) ? $d['razon'] : 'Aprobado';
        $signer->setReason($razon);
        
        try {
            $collector = new SetaPDF_Signer_ValidationRelatedInfo_Collector();
            $certificate = new SetaPDF_Signer_X509_Certificate($p12['cert']);
            $vriData = $collector->getByCertificate($certificate);
            
            $module->setExtraCertificates($vriData->getCertificates());
            foreach ($vriData->getOcspResponses() as $ocspResponse) {
                $module->addOcspResponse($ocspResponse);
            }
            foreach ($vriData->getCrls() as $crl) {
                $module->addCrl($crl);
            }
        } catch (Exception $e) {
            // Si no se puede obtener VRI, continuar sin LTV
        }
        
        if (isset($d['bloquear']) && $d['bloquear'] === true) {
            $signer->setCertificationLevel(SetaPDF_Signer::CERTIFICATION_LEVEL_NO_CHANGES_ALLOWED);
        }
        
        $signer->sign($module);
        
        return $outputFile;
    }
    
    
    public function obtenerCampos ( $inputFile ){
        $file = $inputFile;
        
        $signatureFieldNames =  null;
        $document = null;
        try {
            $document = SetaPDF_Core_Document::loadByFilename($file);
        }
        catch (Exception $e) {
            throw new Exception( 'Error: ' . $e->getMessage() );
        }
        
        try {
            $signatureFieldNames = SetaPDF_Signer_ValidationRelatedInfo_Collector::getSignatureFieldNames($document);
        } catch (Exception $e) {
            throw new Exception( 'Error: ' . $e->getMessage() );
        }
        
        return $signatureFieldNames;
        
    }
    
    public function obtenerTotalPaginas( $d ) {
                
        $inputFile  = $d['entrada'];
        
        $reader   = new SetaPDF_Core_Reader_File($inputFile);
        $document = SetaPDF_Core_Document::load( $reader );
        
        $pages   = $document->getCatalog()->getPages();
        $pageNo  = $pages->count();
        
        return $pageNo;
        
    }
}
?>