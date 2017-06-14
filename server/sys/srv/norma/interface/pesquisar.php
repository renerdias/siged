<?php
# Inclui a dependência do arquivo de carregamento automático Autoloader
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

use root\server\sys\srv\norma\controller\NormaCtrl;
try {
    $pesquisarPor = $_GET['por'];
    try {
        switch ($pesquisarPor) {
            case "nome":
                $nome = $_GET['nome'];
                $normas = NormaCtrl::pesquisarPorNome($nome);
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $normas;
                break;
            case "id":
                $id = $_GET['id'];
                $norma = NormaCtrl::pesquisarPorId($id);
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $norma;
                break;
            case "todos":
                $normas = NormaCtrl::todos();
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $normas;
                break;
            case "municipio":
                $id = $_GET['id'];
                $normas = NormaCtrl::pesquisarPorMunicipio($id);
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $normas;
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
