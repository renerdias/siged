<?php
# Define o caminho até o diretório da aplicação
//defined('CORE') || define('CORE', realpath(__DIR__));
# Inclui a dependência do arquivo de carregamento automático Autoloader
//require_once CORE . "../../../Autoloader.php";
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
?>
<?php

use root\server\sys\srv\funcionalidade\controller\FuncionalidadeCtrl;
use root\server\sys\lib\util\TUtil;

/*
 // CRIAR VIEW
    SELECT
 *DESCRIMINAR OS CAMPOS DE CADA TABELA
        public.tb_perfil.*,
        sistema.ts_funcionalidade.*
    FROM public.tb_perfil
        cross join sistema.ts_funcionalidade
 * 
 SELECT 
    public.vw_perfil_funcionalidade.*,
    public.rl_funcionalidade_perfil.*,
    CASE rl_funcionalidade_perfil.st_protegido
    WHEN 'N' THEN false
    ELSE (true) END AS permissao
FROM public.vw_perfil_funcionalidade
LEFT JOIN public.rl_funcionalidade_perfil ON
public.rl_funcionalidade_perfil.id_funcionalidade = public.vw_perfil_funcionalidade.id_funcionalidade
 */



    /*public.rl_funcionalidade_perfil.*,*
SELECT
    func.*,
    CASE rl_funcionalidade_perfil.id_funcionalidade
        WHEN 1 THEN false
        WHEN null THEN true
        ELSE (true) END AS permissao
FROM
    public.rl_funcionalidade_perfil
    FULL JOIN
    (
        SELECT
            public.tb_perfil.*,
            sistema.ts_funcionalidade.*
        FROM public.tb_perfil
            CROSS JOIN sistema.ts_funcionalidade
    )
    func  ON public.rl_funcionalidade_perfil.id_funcionalidade = func.id_funcionalidade
    WHERE func.id_perfil = 1
    order by func.no_funcionalidade, func.id_funcionalidade
 */

/*
$acl->login($user_name, $password);
$acl->logout();
$acl->isAuthenticated($user_token);
$acl->isAuthorized(id_usuario);
$acl->getCredentials(id_usuario);
$acl->isAllowed(id_perfil,id_funcionalidade);
$acl->isAllowed(id_perfil,no_funcionalidade,no_acao);
$acl->allow(id_perfil,no_funcionalidade,no_acao);
$acl->deny();
$acl->getAlowedById(id_perfil);
$acl->cleanAlowedById(id_perfil);
$acl->getPermissions(id_perfil);
$acl->setPermission(id_perfil);
 */

try {
    $data = json_decode(file_get_contents("php://input"));
    try {
        switch ($data->function) {
            case "pesquisarPorNome":
                $result = FuncionalidadeCtrl::pesquisarPorNome($data->name);
                break;
            case "findOne":
                $result = FuncionalidadeCtrl::findOne($data->id);
                break;
            case "all":
$func = FuncionalidadeCtrl::getFuncionalidades();
$s = [];
foreach ($func as $key => $value) {
    $i['title'] = $value->ds_funcionalidade;
    $i['name'] = $value->no_funcionalidade;
    $i['options'] = FuncionalidadeCtrl::pesquisarPorNome($value->no_funcionalidade);
    $s[] = $i;
}
                
                $result['count'] = count($data);
                $result['data'] = $s;
                break;
            default:
                break;
        }
    } catch (PDOException $ex) {
        $result['exec'] = false;
        switch ($ex->getCode()) {
            //Violates Unique Constraint
            //Violação de chave única
            //Ex: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "funcionalidade_uk" DETAIL:  Key (no_funcionalidade, id_municipio)=(rener, 4769) already exists."
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