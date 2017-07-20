<?php

namespace root\server\sys\srv\documento\model;

use root\server\sys\lib\validate\Validate;
use root\server\sys\lib\util\TUtil;
use root\server\sys\lib\session\Session;

class ValidaDocumento {
  protected $erros;
  protected $operacao;
  protected $registro;

  public function eValido($documento){
        $validate = new Validate();
        if (isset($documento->id_documento)){
            if ($documento->id_documento >= 1) {
                $validate->set('"ID"', $documento->id_documento, 'id_documento')->is_integer()->is_required();
                $this->operacao = 'atualizar';
            }
        } else {
            $this->operacao = 'inserir';
        }
        $validate->set('"Status"', $documento->st_registro, 'st_registro')->is_string()->contains(array('A','I'))->is_required();
        $validate->set('"Data de Modificação"', date("d-m-Y H:i:s"), 'dt_modificacao')->is_required();
        #Inicia sessao
        $session = new Session();
        #Obtém as credenciais do usuário
        $credencial = $session->init()->get("credencial");
        $validate->set('"ID Usuário"', $credencial['id'], 'id_usuario')->is_integer()->is_required();
        //$validate->set('"ID Usuário"', 1, 'id_usuario')->is_integer()->is_required();
        $validate->set('"Ementa da Documento"', $documento->ds_ementa, 'ds_ementa')->is_string()->is_required();
        $validate->set('"Ementa da Documento Fonético"', TUtil::fonetizar($documento->ds_ementa), 'ds_ementa_fn')->is_string()->is_required();
        $validate->set('"Tipo de Documento"', $documento->id_tipo_documento, 'id_tipo_documento')->is_integer()->is_required();
        $validate->set('"Nº da Documento"', $documento->nu_documento, 'nu_documento')->is_integer()->is_required();
        $validate->set('"Descrição da Documento"', $documento->ds_documento, 'ds_documento')->is_string()->is_required();
        $validate->set('"Data da Documento"', $documento->dt_documento, 'dt_documento');
        $validate->set('"Data de Aprovação"', $documento->dt_aprovacao, 'dt_aprovacao')->is_required();
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
  public function operacaoAExecutar(){
    return $this->operacao;
  }
  public function obterRegistroValido(){
    return $this->registro;
  }
}
?>
