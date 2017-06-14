<?php
  require_once "../../../../../Autoloader.php";
  # Obtém uma instância de Autoloader
  Autoloader::getInstance('root\\');
?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

  use root\server\sys\srv\usuario\controller\UsuarioCtrl;
  use root\server\sys\srv\usuario\model\ValidaUsuario;

  try {
    try {
      #Recebe os dados via POST
      $dados = json_decode(file_get_contents("php://input"));
      
      //$dados = TUtil::object_to_array($data);
      $usuario = new ValidaUsuario();
      #Verifica se os dados recebido são válidos
      if ($usuario->eValido($dados)) {
        #Retorna uma array dos dados, caso sejam válidos.
        $registro = $usuario->obterRegistroValido();
        if ($usuario->operacao() == 'inserir'){
          if ($resultID = UsuarioCtrl::inserir($registro)) {
            $result['execucao'] = 'sucesso';
            $result['mensagem'] = 'Registro incluído com sucesso!';
          }
        } else {
          if (UsuarioCtrl::atualizar($registro)) {
            $result['execucao'] = 'sucesso';
            $result['mensagem'] = 'Registro alterado com sucesso!';
          }
        }
      } else {
        $result['execucao'] = 'erro';
        $result['mensagem'] = 'Dados inválidos, verifique e corrija os erros encontrados!';
        $result['log'] = $usuario->obterErros();
      }
    } catch (PDOException $ex) {
      $result['execucao'] = 'erro';
      switch ($ex->getCode()) {
        //Violates Unique Constraint
        //Violação de chave única
        //Ex: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "usuario_uk" DETAIL:  Key (no_usuario, id_municipio)=(rener, 4769) already exists."
        case '23505':
          $result['mensagem'] = 'ERRO: Registro duplicado! Este registro já existe em nossa base.';
          $result['log'] = $ex->errorInfo[2];
          break;
        case '23502':
          //Violates Not-Null Constraint
          //Violação de chave não nula
          //Ex: ERROR:  null value in column "id_municipio" violates not-null constraint DETAIL:  Failing row contains (28, adf, null, 1).
          $result['mensagem'] = 'ERRO: Valor não informado em campo obrigatório! Verifique seu cadastro.';
          $result['log'] = $ex->errorInfo[2];
          break;
        default:
          $result['mensagem'] = 'ERRO: Erro desconhecido! Entre em contato com o administrador do sistema.';
          $result['log'] = $ex->getMessage();
          break;
      }
    } catch (Exception $ex) {
      $result['execucao'] = 'erro';
      $result['mensagem'] = 'ERRO: Erro desconhecido! Entre em contato com o administrador do sistema.';
      $result['log'] = $ex->getTraceAsString();
    }
  } finally {
    echo json_encode($result);
  }
?>
