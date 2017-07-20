<?php
# Inclui a dependência do arquivo de carregamento automático Autoloader
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');

use root\server\sys\lib\exception\ManageException;
  $error = new ManageException(); // Instanciar o objeto.
  $error->register();
?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

use root\server\sys\srv\tipo_norma\controller\TipoNormaCtrl;
try {
    $pesquisarPor = $_GET['por'];
    try {
        switch ($pesquisarPor) {
            case "todos":
                $tipos_normas = TipoNormaCtrl::todos();
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $tipos_normas;
                break;
            default:
                break;
        }
    } catch (PDOException $ex) {
        $resultado['execucao'] = 'erro';
        $resultado['mensagem'] = 'ERROR: Erro desconhecido! Entre em contato com o administrador do sistema.';
        $resultado['log'] = $ex->getMessage() . ' - Código: ' . $ex->getCode();
    } catch (Exception $ex) {
        $resultado['execucao'] = 'erro';
        $resultado['mensagem'] = 'ERROR: Erro desconhecido! Entre em contato com o administrador do sistema.';
        $resultado['log'] = $ex->getTraceAsString();
    }
} finally {
    echo json_encode($resultado);
}
