<?php
include_once dirname(__FILE__) . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class PhpSpreadSheet {
    
    private static function limpiarEncabezado($texto) {
        $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto); // elimina tildes
        $texto = preg_replace('/[^a-zA-Z0-9\s]/', '', $texto); // elimina caracteres raros
        $texto = preg_replace('/\s+/', '_', $texto); // reemplaza espacios por _
        return strtolower(trim($texto));
    }
    
    public static function procesarArchivoXLSXCompleto($rutaArchivo) {
        $spreadsheet = IOFactory::load($rutaArchivo);
        $hoja = $spreadsheet->getActiveSheet();
        $filas = $hoja->toArray(null, true, true, true);
        
        $encabezados = array_shift($filas);
        $encabezados = array_map(function ($campo) {
            return strtolower(trim($campo));
        }, $encabezados);
            
            $data = [];
            
            foreach ($filas as $fila) {
                $registro = [];
                foreach ($encabezados as $columna => $campo) {
                    $registro[self::limpiarEncabezado($campo)] = $fila[$columna] ?? null;
                }
                $data[] = $registro;
            }
            
            return $data;
    }
    
    public static function buscarPorCondiciones($rutaArchivo, $condiciones = []) {
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        
        $spreadsheet = $reader->load($rutaArchivo);
        $hoja = $spreadsheet->getActiveSheet();
        
        $datos = $hoja->toArray(null, true, true, true);
        $filaEncabezados = array_shift($datos);
        
        $encabezadosLimpios = [];
        foreach ($filaEncabezados as $letraCol => $valor) {
            $encabezadosLimpios[$letraCol] = self::limpiarEncabezado($valor);
        }
        
        $mapaColumnas = [];
        foreach ($condiciones as $cond) {
            $campoLimpio = self::limpiarEncabezado($cond['campo']);
            $columnaLetra = array_search($campoLimpio, $encabezadosLimpios);
            
            if (!$columnaLetra) {
                throw new \Exception("No se encuentra la columna '{$cond['campo']}' en el archivo.");
            }
            
            $mapaColumnas[$columnaLetra] = $cond['valor'];
        }
        
        $resultados = [];
        $indiceFila = 2;
        
        foreach ($datos as $fila) {
            $coincide = true;
            
            foreach ($mapaColumnas as $colLetra => $valorEsperado) {
                $valorCelda = trim((string)($fila[$colLetra] ?? ''));
                if (strtolower($valorCelda) !== strtolower((string)$valorEsperado)) {
                    $coincide = false;
                    break;
                }
            }
            
            if ($coincide) {
                $registro = [];
                foreach ($encabezadosLimpios as $letra => $campo) {
                    $valor = $fila[$letra] ?? null;
                    
                    $celda = $hoja->getCell($letra . $indiceFila);
                    if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($celda)) {
                        $valor = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($valor)->format('Y-m-d');
                    }
                    
                    $registro[$campo] = $valor;
                }
                
                $resultados[] = $registro;
            }
        }
        return $resultados;
    }
    
    public static function obtenerEncabezados($rutaArchivo) {
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        
        $reader->setReadFilter(new FilaEncabezadoFilter());
        
        $spreadsheet = $reader->load($rutaArchivo);
        $hoja = $spreadsheet->getActiveSheet();
        
        $ultimaColumna = $hoja->getHighestColumn();
        $rango = 'A1:' . $ultimaColumna . '1';
        
        $filaEncabezados = $hoja->rangeToArray($rango, null, true, true, true);
        $filaEncabezados = reset($filaEncabezados);
        
        $encabezadosLimpios = [];
        foreach ($filaEncabezados as $col => $valor) {
            $encabezadosLimpios[$col] = ['raw' => $valor, 'limpio' => self::limpiarEncabezado($valor)];
        }
        
        return $encabezadosLimpios;
    }
    
    
}

class FilaEncabezadoFilter implements IReadFilter {
    public function readCell($column, $row, $worksheetName = '') {
        return $row === 1; // solo fila 1
    }
}


?>