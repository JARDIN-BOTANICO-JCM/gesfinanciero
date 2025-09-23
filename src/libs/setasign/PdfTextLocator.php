<?php

class PdfTextLocator
{
    private array $searchTerms = [];
    private array $results = [];
    
    public function setSearchTerms(array $terms): void
    {
        $this->searchTerms = array_map('strtolower', $terms);
    }
    
    public function findInPdf(string $filename): array
    {
        if (!file_exists($filename)) {
            throw new Exception("El archivo no existe: $filename");
        }
        
        $content = @file_get_contents($filename);
        if (!$content) {
            throw new Exception("No se pudo leer el archivo PDF.");
        }
        
        $this->results = [];
        $page = 0;
        
        preg_match_all('/obj(.*?)endobj/s', $content, $objects);
        
        foreach ($objects[1] as $object) {
            
            // Identificar streams con contenido de texto
            if (preg_match('/stream(.*?)endstream/s', $object, $streamMatch)) {
                $streamData = trim($streamMatch[1]);
                $options = $this->getObjectOptions($object);
                $decoded = $this->decodeStream($streamData, $options);
                
                // Cada página tiene BT ... ET para texto
                if (preg_match_all('/BT(.*?)ET/s', $decoded, $textBlocks)) {
                    $page++;
                    foreach ($textBlocks[1] as $block) {
                        $this->processTextBlock($block, $page);
                    }
                }
            }
        }
        
        return $this->results;
    }
    
    private function processTextBlock(string $block, int $page): void
    {
        $lines = explode("\n", $block);
        $currentX = 0;
        $currentY = 0;
        
        foreach ($lines as $line) {
            
            // Detectar Tm (posición absoluta)
            if (preg_match('/(-?\d+\.?\d*)\s+(-?\d+\.?\d*)\s+(-?\d+\.?\d*)\s+(-?\d+\.?\d*)\s+(-?\d+\.?\d*)\s+(-?\d+\.?\d*)\s+Tm/i', $line, $m)) {
                $currentX = floatval($m[5]);
                $currentY = floatval($m[6]);
            }
            
            $currentFontSize = 12; // valor por defecto
            
            if (preg_match('/\/F\d+\s+(-?\d+\.?\d*)\s+Tf/i', $line, $m)) {
                $currentFontSize = floatval($m[1]);
            }
            
            // Detectar Td (posición relativa, pero en muchos casos la usan como absoluta)
            if (preg_match('/(-?\d+\.?\d*)\s+(-?\d+\.?\d*)\s+Td/i', $line, $m)) {
                $currentX = floatval($m[1]);
                $currentY = floatval($m[2]);
            }
            
            // Detectar Tj
            if (preg_match_all('/\((.*?)\)\s*Tj/i', $line, $matches)) {
                foreach ($matches[1] as $text) {
                    $this->checkTextMatch($text, $page, $currentX, $currentY, $currentFontSize);
                }
            }
            
            // Detectar TJ
            if (preg_match_all('/\[\s*(.*?)\s*\]\s*TJ/i', $line, $arrayMatches)) {
                if (preg_match_all('/\((.*?)\)/', $arrayMatches[1][0], $texts)) {
                    foreach ($texts[1] as $text) {
                        $this->checkTextMatch($text, $page, $currentX, $currentY, $currentFontSize);
                    }
                }
            }
        }
    }
    
    
    private function checkTextMatch(string $text, int $page, float $currentX, float $currentY, float $currentFontSize): void
    {
        $cleanText = strtolower($this->cleanText($text));
        if (in_array($cleanText, $this->searchTerms)) {
            $this->results[] = [
                'text' => $cleanText,
                'page' => $page,
                'x' => $currentX,
                'y' => $currentY,
                'fontSize' =>$currentFontSize
            ];
        }
    }
    
    
    private function cleanText(string $text): string
    {
        return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', trim($text));
    }
    
    private function getObjectOptions(string $object): array
    {
        $options = [];
        if (preg_match('#<<(.*)>>#s', $object, $match)) {
            $parts = preg_split('/\/([A-Za-z0-9]+)\s*/', $match[1], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            for ($i = 0; $i < count($parts) - 1; $i += 2) {
                $options[$parts[$i]] = $parts[$i + 1];
            }
        }
        return $options;
    }
    
    private function decodeStream(string $data, array $options): string
    {
        if (isset($options['Filter']) && strpos($options['Filter'], 'FlateDecode') !== false) {
            return @gzuncompress($data) ?: '';
        }
        return $data;
    }
}
