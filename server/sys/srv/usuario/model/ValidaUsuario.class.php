<?php

namespace root\server\sys\srv\usuario\model;

use root\server\sys\lib\validate\Validate;
use root\server\sys\lib\util\TUtil;

class ValidaUsuario {
  protected $erros;
  protected $operacao;
  protected $registro;

  public function eValido($usuario){
    $validate = new Validate();
    if (isset($usuario->id_usuario)){
      if ($usuario->id_usuario >= 1) {
        $validate->set('"ID"', $usuario->id_usuario, 'id_usuario')->is_integer();
        $this->operacao = 'atualizar';
      }
    } else {
      $this->operacao = 'inserir';
    }
$validate->set('"ID2"', 1, 'id_usuario_id')->is_integer();
    $validate->set('"Status"', $usuario->st_registro, 'st_registro')->is_string()->contains(array('A','I'))->is_required();
    $validate->set('"Data de Modificação"', date("d-m-Y H:i:s"), 'dt_modificacao')->is_date()->is_required();+
/*
    #Inicia sessao
    session_start();
    #Obtém as credenciais do usuário
    $credencial = $_SESSION["credencial"];
    $validate->set('"ID Usuário"', $credencial['id'], 'id_usuario')->is_integer()->is_required();
*/
$validate->set('"Protegido"', $usuario->st_protegido, 'st_protegido')->is_string()->contains(array('S','N'))->is_required();
    $validate->set('"Nome do Usuario"', $usuario->no_usuario, 'no_usuario')->is_string()->is_required();

    $validate->set('"Login"', $usuario->lg_usuario, 'lg_usuario')->is_string()->is_required();
    $validate->set('"Senha"', $usuario->pw_usuario, 'pw_usuario')->is_string()->is_required();
    #
    $validate->set('"CPF"', TUtil::only_number($usuario->nu_cpf), 'nu_cpf')->is_cpf()->is_required();
    $validate->set('"Data de Ultimo Acesso"', date("d-m-Y H:i:s"), 'dt_ultimo_acesso')->is_date()->is_required();


                if ($validate->validate()) {
                  $this->registro = $validate->get_fields();
                  return true;
                } else {
                  $this->erros = $validate->get_errors();
                  return;
                }
              }
              public function obterErros(){
                if (count($this->erros) > 0){
                  $_erros = '';
                  foreach ($this->erros as $erro) {
                    $_erros .= $erro . '\n';
                  }
                  return $_erros;
                }
}
              public function operacao(){
                return $this->operacao;
              }
              public function obterRegistroValido(){
                return $this->registro;
              }
            }
            ?>
