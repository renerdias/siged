<?php
# Define o caminho até o diretório da aplicação
//defined('CORE') || define('CORE', realpath(__DIR__));
# Inclui a dependência do arquivo de carregamento automático Autoloader
//require_once CORE . "../../../Autoloader.php";
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');

use root\server\sys\lib\exception\ManageException;
  $error = new ManageException(); // Instanciar o objeto.
  $error->register();
?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

/**
 * @api {get} /user/:id Get User information and Date of Registration.
 * @apiVersion 0.4.0
 * @apiName GetUser
 * @apiGroup User
 *
 * @apiParam {Number} id Users unique ID.
 *
 * @apiSuccess {String} firstname  Firstname of the User.
 * @apiSuccess {String} lastname   Lastname of the User.
 * @apiSuccess {Date}   registered Date of Registration.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "firstname": "John",
 *       "lastname": "Doe"
 *     }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "erro": "UserNotFound"
 *     }
 */
use root\server\sys\srv\usuario\controller\UsuarioCtrl;
/*
try {
    $pesquisarPor = $_GET['por'];
    try {
        switch ($pesquisarPor) {
            case "nome":
                $nome = $_GET['nome'];
                $pessoas = PessoaCtrl::pesquisarPorNome($nome);
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $pessoas;
                break;
            case "id":
*/
try {
    //$dados = json_decode(file_get_contents("php://input"));
    $pesquisarPor = $_GET['por'];
    try {
        //switch ($dados->funcao) {
        switch ($pesquisarPor) {
            //case "autenticar":
            case "autenticacao":
                if (UsuarioCtrl::autenticar($_GET['nome'], $_GET['senha'])){
                    $usuario = UsuarioCtrl::obterCredencial();
                    //$user['features'] = UsuarioCtrl::getAlowed($user['id_perfil']);
                    //var_dump(UsuarioCtrl::getAlowed($user['id_perfil']));
                    $resultado['execucao'] = 'sucesso';
                    $resultado['dados'] = $usuario;
                } else {
                    $resultado['execucao'] = "erro";
                    $resultado['mensagem'] = "Usuário ou senha inválido!";
                }
                break;
                case "id":
                    $id = $_GET['id'];
                    $usuario = UsuarioCtrl::pesquisarPorId($id);
                    $resultado['execucao'] = 'sucesso';
                    $resultado['dados'] = $usuario;
                    break;
                case "geral":
                        $termo = $_GET['termo'];
                        $usuarios = UsuarioCtrl::pesquisar($termo);
                        $resultado['execucao'] = 'sucesso';
                        $resultado['dados'] = $usuarios;
                        break;
                case "todos":
                    $usuarios = UsuarioCtrl::todos();
                    //$user['features'] = UsuarioCtrl::getAlowed($user['id_perfil']);
                    //var_dump(UsuarioCtrl::getAlowed($user['id_perfil']));
                    $resultado['execucao'] = 'sucesso';
                    $resultado['dados'] = $usuarios;
                    break;
            default:
                break;
        }
    } catch (PDOException $ex) {
        $resultado['execucao'] = "erro";
        switch ($ex->getCode()) {
            //Violates Unique Constraint
            //Violação de chave única
            //Ex: Unique violation: 7 ERRO:  duplicate key value violates unique constraint "usuario_uk" DETAIL:  Key (no_usuario, id_municipio)=(rener, 4769) already exists."
            case '23505':
                $resultado['mensagem'] = 'ERRO: Registro duplicado! Este registro já existe em nossa base.';
                $resultado['log'] = $ex->erroInfo[2];
                break;
            case '23502':
                //Violates Not-Null Constraint
                //Violação de chave não nula
                //Ex: ERRO:  null value in column "id_municipio" violates not-null constraint DETAIL:  Failing row contains (28, adf, null, 1).
                $resultado['mensagem'] = 'ERRO: Valor não informado em campo obrigatório! Verifique seu cadastro.';
                $resultado['log'] = $ex->erroInfo[2];
                break;
            default:
                $resultado['mensagem'] = 'ERRO: Erro desconhecido! Entre em contato com o administrador do sistema.';
                $resultado['log'] = $ex->getMessage();
                break;
        }
    } catch (Exception $ex) {
        $resultado['execucao'] = "erro";
        $resultado['mensagem'] = 'ERRO: Erro desconhecido! Entre em contato com o administrador do sistema.';
        $resultado['log'] = $ex->getTraceAsString();
    }
} finally {
    echo json_encode($resultado);
}
