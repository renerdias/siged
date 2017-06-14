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
        $validate->set('"ID Usuário"', $credencial['id'], 'id_usuario')->is_integer()->is_required();
        $validate->set('"Nome do Norma"', $norma->no_norma, 'no_norma')->is_string()->is_required();
        $validate->set('"Nome do Norma Fonético"', TUtil::fonetizar($norma->no_norma), 'no_norma_fn')->is_string()->is_required();
        $validate->set('"Municipio"', $norma->id_municipio, 'id_municipio')->is_integer()->is_required();
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
