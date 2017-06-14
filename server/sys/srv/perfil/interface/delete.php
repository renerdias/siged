<?php

# Define o caminho até o diretório da aplicação
//defined('CORE') || define('CORE', realpath(__DIR__));
# Inclui a dependência do arquivo de carregamento automático Autoloader
//require_once CORE . "../../../Autoloader.php";
require_once "../../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
?>
<?php

use root\server\sys\srv\perfil\controller\PerfilCtrl;

try {
    try {
        $data = json_decode(file_get_contents("php://input"));
        switch ($data->function) {
            case "deletar":
                if (PerfilCtrl::deletar($data->id) > 0) {
                    $result['exec'] = true;
                    $result['message'] = 'Exclusão realizada com sucesso!';
                } else {
                    $result['exec'] = false;
                    $result['message'] = 'Não foi possível excluir este registro!';
                    $result['log'] = '';
                }
                break;
            default:
                break;
        }
    } catch (PDOException $ex) {
        $result['exec'] = false;
        switch ($ex->getCode()) {
            //Violates Unique Constraint
            //Violação de chave única
            //Ex: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "perfil_uk" DETAIL:  Key (no_perfil, id_municipio)=(rener, 4769) already exists."
            case '23505':
                $result['message'] = 'ERROR: Registro duplicado! Este registro já existe em nossa base.';
                $result['log'] = $ex->errorInfo[2];
                break;
            case '23502':
                //Violates Not-Null Constraint
                //Violação de chave não nula
                //Ex: ERROR:  null value in column "id_municipio" violates not-null constraint DETAIL:  Failing row contains (28, adf, null, 1).
                $result['message'] = 'ERROR: Valor não informado em campo obrigatório! Verifique seu cadastro.';
                $result['log'] = $ex->errorInfo[2];
                break;
            default:
                $result['message'] = 'ERROR: Erro desconhecido! Entre em contato com o administrador do sistema.';
                $result['log'] = $ex->getMessage();
                break;
        }
    } catch (Exception $ex) {
        $result['exec'] = false;
        $result['message'] = 'ERROR: Erro desconhecido! Entre em contato com o administrador do sistema.';
        $result['log'] = $ex->getTraceAsString();
    }
} finally {
    echo json_encode($result);
}