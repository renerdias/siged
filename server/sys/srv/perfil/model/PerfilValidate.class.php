<?php

namespace root\server\sys\srv\perfil\model;

use  root\server\sys\lib\validate\Validate;



class PerfilValidate
{
    private  $errors;
    private  $fields;

    public function is_valid($data) {
        $validate = new Validate();
        if (isset($data->id_perfil)){
            if ($data->id_perfil >= 1) {
                $validate->set('Id Perfil', $data->id_perfil, 'id_perfil')->is_integer();
            }
        }
        $validate->set('"Nome"', $data->ds_perfil, 'ds_perfil')->is_string()->is_required();
        $validate->set('"Data de Modificação"', date("d-m-Y H:i:s"), 'dt_modificacao')->is_required();
        $validate->set('"Status"', $data->st_registro, 'st_registro')->is_string();

        if ($validate->validate()) {
            $this->fields = $validate->get_fields();
            return true;
        } else {
            $this->errors = $validate->get_errors();
            return;
        }
    }
    public function get_fields() {
        return $this->fields;
    }
    public function get_errors() {
        return $this->errors;
    }
}
?>
