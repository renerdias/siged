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
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

use root\server\sys\srv\backup\controller\BackupCtrl;
use root\server\sys\srv\backup\model\ValidaBackup;
use root\server\sys\lib\util\TUtil;


#Pega o caminho atual
$caminho = getcwd();
#Pega o caminho da pasta root do servidor web (www)
$root = $_SERVER["DOCUMENT_ROOT"];
//TODO: Resolver path
#Muda o contexto para a pasta onde sera salvo o backup, a partir do root
chdir($root . "/r2/siged/server/var/bkp");

try {
  //$retorno['tamanho'] = TUtil::byte_to_size(filesize($filename));
  $execucao = TUtil::backup_postgreSQL('siged');
  //if (TUtil::backup_postgreSQL('siged')) {
  if ($execucao['sucesso'] == true) {
        try {
          $dados['no_backup'] = $execucao['nome'];
          $dados['dt_inicio'] = $execucao['data_inicio'];
          $dados['dt_conclusao'] = $execucao['data_conclusão'];
          $dados['ds_tamanho'] = $execucao['tamanho'];
          $dados['tp_duracao'] = $execucao['duracao'];
          //$dados = TUtil::object_to_array($data);
          $backup = new ValidaBackup();
          #Converte uma array para um objeto
          $dados = TUtil::array_to_object($dados);
          #Verifica se os dados recebido são válidos
          if ($backup->eValido($dados)) {
            #Retorna uma array dos dados, caso sejam válidos.
            $registro = $backup->obterRegistroValido();
            if ($backup->operacaoAExecutar() == 'inserir'){
              if ($resultadoID = BackupCtrl::inserir($registro)) {
                $resultado['execucao'] = 'sucesso';
                $resultado['mensagem'] = 'Backup realizado com sucesso!';
              }
            } else {
              if (BackupCtrl::atualizar($registro)) {
                $resultado['execucao'] = 'sucesso';
                $resultado['mensagem'] = 'Registro alterado com sucesso!';
              }
            }
          } else {
            $resultado['execucao'] = 'erro';
            $resultado['mensagem'] = 'Dados inválidos, verifique e corrija os erros encontrados!';
            $resultado['log'] = $backup->obterErros();
          }
        } catch (PDOException $ex) {
          $result['execucao'] = 'erro';
          switch ($ex->getCode()) {
            //Violates Unique Constraint
            //Violação de chave única
            //Ex: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "backup_uk" DETAIL:  Key (no_backup, id_municipio)=(rener, 4769) already exists."
            case '23505':
              $resultado['mensagem'] = 'ERRO: Registro duplicado! Este registro já existe em nossa base.';
              $resultado['log'] = $ex->errorInfo[2];
              break;
            case '23502':
              //Violates Not-Null Constraint
              //Violação de chave não nula
              //Ex: ERROR:  null value in column "id_municipio" violates not-null constraint DETAIL:  Failing row contains (28, adf, null, 1).
              $resultado['mensagem'] = 'ERRO: Valor não informado em campo obrigatório! Verifique seu cadastro.';
              $resultado['log'] = $ex->errorInfo[2];
              break;
            default:
              $resultado['mensagem'] = 'ERRO: Erro desconhecido! Entre em contato com o administrador do sistema.';
              $resultado['log'] = $ex->getMessage();
              break;
          }
        } catch (Exception $ex) {
          $resultado['execucao'] = 'erro';
          $resultado['mensagem'] = 'ERRO: Erro desconhecido! Entre em contato com o administrador do sistema.';
          $resultado['log'] = $ex->getTraceAsString();
        }


  } else {
      $resultado['execucao'] = 'erro';
      $resultado['mensagem'] = 'Falha ao realizar o backup!';
  }
} catch (Exception $ex) {
    $resultado['execucao'] = 'erro';
    $resultado['mensagem'] = 'Erro desconhecido! Entre em contato com o administrador do sistema.';
    $resultado['log'] = $ex->getTraceAsString();
}finally {
  #Retorna contexto ao caminho original
  chdir($caminho);
  echo json_encode($resultado);
}
