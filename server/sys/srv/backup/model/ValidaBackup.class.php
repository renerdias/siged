<?php

namespace root\server\sys\srv\backup\model;

use root\server\sys\lib\validate\Validate;
use root\server\sys\lib\util\TUtil;
use root\server\sys\lib\session\Session;

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
        $validate->set('"Status"', 'A', 'st_registro')->is_string()->contains(array('A','I'))->is_required();
        $validate->set('"Data de Modificação"', TUtil::time__is_now('d-m-Y H:i:s'), 'dt_modificacao')->is_required();
        #Inicia sessao
        $session = new Session();
        #Obtém as credenciais do usuário
        $credencial = $session->init()->get("credencial");
        $validate->set('"ID Usuário"', $credencial['id'], 'id_usuario')->is_integer()->is_required();
        $validate->set('"Nome do Backup"', $backup->no_backup, 'no_backup')->is_string()->is_required();
        $validate->set('"Data de Inicio"', $backup->dt_inicio, 'dt_inicio')->is_required();
        $validate->set('"Data de Conclusão"', $backup->dt_conclusao, 'dt_conclusao')->is_required();
        $validate->set('"Duração"', $backup->tp_duracao, 'tp_duracao')->is_required();
        $validate->set('"Tamanho"', $backup->ds_tamanho, 'ds_tamanho')->is_required();
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
