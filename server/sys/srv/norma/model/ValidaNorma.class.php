<?php

namespace root\server\sys\srv\norma\model;

use root\server\sys\lib\validate\Validate;
use root\server\sys\lib\util\TUtil;

class ValidaNorma {
  protected $erros;
  protected $operacao;
  protected $registro;

  public function eValido($norma){
        $validate = new Validate();
        if (isset($norma->id_norma)){
            if ($norma->id_norma >= 1) {
                $validate->set('"ID"', $norma->id_norma, 'id_norma')->is_integer()->is_required();
                $this->operacao = 'atualizar';
            }
        } else {
            $this->operacao = 'inserir';
        }
        $validate->set('"Status"', $norma->st_registro, 'st_registro')->is_string()->contains(array('A','I'))->is_required();
        $validate->set('"Data de Modificação"', date("d-m-Y H:i:s"), 'dt_modificacao')->is_required();
        #Inicia sessao
        session_start();
        #Obtém as credenciais do usuário
        $credencial = $_SESSION["credencial"];
        #$validate->set('"ID Usuário"', $credencial['id'], 'id_usuario')->is_integer()->is_required();
        //$validate->set('"ID Usuário"', 1, 'id_usuario')->is_integer()->is_required();
        $validate->set('"Ementa da Norma"', $norma->ds_ementa, 'ds_ementa')->is_string()->is_required();
        //$validate->set('"Ementa da Norma Fonético"', TUtil::fonetizar($norma->ds_ementa), 'ds_ementa_fn')->is_string()->is_required();
        $validate->set('"Tipo de Norma"', $norma->id_tipo_norma, 'id_tipo_norma')->is_integer()->is_required();
        $validate->set('"Nº da Norma"', $norma->nu_norma, 'nu_norma')->is_integer()->is_required();
        $validate->set('"Descrição da Norma"', $norma->ds_norma, 'ds_norma')->is_string()->is_required();
        $validate->set('"Data da Norma"', $norma->dt_norma, 'dt_norma');
        $validate->set('"Data de Aprovação"', $norma->dt_aprovacao, 'dt_aprovacao')->is_required();
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
