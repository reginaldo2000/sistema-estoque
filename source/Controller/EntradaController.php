<?php


namespace Source\Controller;

use Exception;

/**
 * Description of EntradaController
 *
 * @author Reginaldo
 */
class EntradaController extends Controller {
    
    public function __construct() {
        parent::__construct(__DIR__."/../../public");
    }
    
    public function paginaEntrada(array $data): void {
        try {
            $this->responseView("entrada/pagina-entrada", [
                
            ]);
        } catch (Exception $e) {
            
        }
    }
}
