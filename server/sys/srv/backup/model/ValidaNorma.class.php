<?php

namespace root\server\sys\srv\backup\model;

use root\server\sys\lib\validate\Validate;
use root\server\sys\lib\util\TUtil;

class ValidaBackup {
  protected $erros;
  protected $operacao;
  protected $registro;

  public function eValido($backup){
        $validate = new Validate();
        if (isset($backup->id_backup)){
            if ($backup->id_backup >= 1) {
                $validate->set('"ID"', $backup->id_backup, 'id_backup')->is_integer()->is_required();
                $this->operacao = 'atualizar';
            }
        } else {
            $this->operacao = 'inserir';
        }
        $validate->set('"Status"', $backup->st_registro, 'st_registro')->is_string()->contains(array('A','I'))->is_required();
        $validate->set('"Data de Modificação"', date("d-m-Y H:i:s"), 'dt_modificacao')->is_required();
        #Inicia sessao
        session_start();
        #Obtém as credenciais do usuário
        $credencial = $_SESSION["credencial"];
        $validate->set('"ID Usuário"', $credencial['id'], 'id_usuario')->is_integer()->is_required();
        $validate->set('"Nome do Backup"', $backup->no_backup, 'no_backup')->is_string()->is_required();
        $validate->set('"Nome do Backup Fonético"', TUtil::fonetizar($backup->no_backup), 'no_backup_fn')->is_string()->is_required();
        $validate->set('"Municipio"', $backup->id_municipio, 'id_municipio')->is_integer()->is_required();
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
