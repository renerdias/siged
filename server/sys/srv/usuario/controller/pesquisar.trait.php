<?php

namespace root\server\sys\srv\usuario\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\usuario\model\Usuario;

/**
 * Trecho de código responsável por encontrar os dados na tabela tb_usuario e que
 * compõe o controller UsuarioCtrl.
 *
 * @package sys/srv/usuario
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait pesquisar {


#$usuario->login($user_name, $senha);
/**
 *
 * @param type $nome
 * @param type $senha
 * @return type
 */
public static function autenticar($nome, $senha) {
    DBTransaction::open('siged');
    $model = new Usuario();
    $resultado = $model->login($nome, $senha);
    if (count($resultado) > 0) {
        #Inicia sessao
        session_start();
        #Gera token
        //var_dump($model->obterPermissoesPorPerfil($resultado[0]->id_perfil));
        $permissoesPerfil = $model->obterPermissoesPorPerfil($resultado[0]->id_perfil);
        //TODO: Alterar no_funcionalidade para modulo
        #Agrupa permissões por módulo
        foreach ($permissoesPerfil as $key) {
          $permissoesPerfilAgrupadas[$key->no_funcionalidade][$key->no_acao] = $key->st_permitido;
        }
        #Cria array com dados do usuario como id perfil
        $_SESSION["credencial"] = array(
            'id' => $resultado[0]->id_usuario,
            'login' => $resultado[0]->lg_usuario,
            'nome' => current( str_word_count( $resultado[0]->no_usuario , 2 ) ),
            'autenticado' => true,
            'token' => md5($nome . $senha),
            'perfil' => array (
                'id' => $resultado[0]->id_perfil,
                'nome' => $resultado[0]->no_perfil
            ),
            'permissao' => $permissoesPerfilAgrupadas
        );
        session_write_close();
        DBTransaction::commit();
        return true;
    } else {
        DBTransaction::rollback();
        return;
    }
}
#$usuario->getCredentials(id_usuario);
/**
 *
 * @param type $user_token
 * @return type
 */
public static function obterCredencial() {
    return $_SESSION['credencial'];
}
#$usuario->getAlowed(id_perfil);
/**
 *
 * @param type $id_perfil
 * @return type
 */
public static function getAlowed($id_perfil) {
    DBTransaction::open('siged');
    $model = new Usuario();
    $features = $model->getFeatures();
    $featuresAllowed = [];
    foreach ($features as $key => $feature) {
        $i['title'] = $feature->ds_funcionalidade;
        $i['name'] = $feature->no_funcionalidade;
        $i['options'] = $model->getAllowedByProfile($id_perfil, $feature->no_funcionalidade);
        $featuresAllowed[] = $i;
    }
    DBTransaction::commit();
    return $featuresAllowed;
}
#$usuario->logout();
/**
 *
 * @return type
 */
public static function logout() {
    session_start();
    #Encerra sessão
    return session_destroy();
}
#$usuario->isAuthenticated($user_token);
/**
 *
 * @param type $user_token
 * @return type
 */
public static function isAuthenticated($user_token) {
    return;
}
#$usuario->isAllowed(id_perfil,id_funcionalidade);
/**
 *
 * @param type $id_perfil
 * @param type $no_funcionalidade
 * @param type $no_acao
 * @return type
 */
public static function isAllowed($id_perfil,$no_funcionalidade,$no_acao) {
    return;
}
#$usuario->allow(id_perfil,no_funcionalidade,no_acao);
/**
 *
 * @param type $id_perfil
 * @param type $no_funcionalidade
 * @param type $no_acao
 * @return type
 */
public static function allow($id_perfil,$no_funcionalidade,$no_acao) {
    return;
}
#$usuario->deny();
/**
 *
 * @param type $id_perfil
 * @param type $no_funcionalidade
 * @param type $no_acao
 * @return type
 */
public static function deny($id_perfil,$no_funcionalidade,$no_acao) {
    return;
}
#$usuario->cleanAlowed(id_perfil);
/**
 *
 * @param type $id_perfil
 * @return type
 */
public static function cleanAlowed($id_perfil) {
    return;
}



    /**
     * Método responsável por encontrar um registro na tabela tb_usuario
     *
     * @access public
     * @param int $_one ID do registro a ser encontrado
     * @return mixed Retorna um objeto com os dados do registro encontrado
     */
    public static function pesquisarPorId($_id) {
        DBTransaction::open('siged');
        $model = new Usuario();
        if ($result = $model->findOne($_id)) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por encontrar registros pelos nome
     *
     * @access public
     * @static
     * @return mixed Retorna os registros da tabela que satisfação o nome passado
     */
    public static function pesquisarPorNome($_name) {
        DBTransaction::open('siged');
        $result = Usuario::pesquisarPorNome();
        DBTransaction::commit();
        return $result;
    }
    /**
     * Método responsável por encontrar registros
     *
     * @access public
     * @static
     * @return mixed Retorna os registros da tabela
     */
    public static function pesquisar($termo) {
        DBTransaction::open('siged');
        $result = Usuario::pesquisar($termo);
        DBTransaction::commit();
        return $result;
    }
    public function findAll($_arrUsuario) {
    #findAll
    }
    public function findWhere($_arrUsuario) {
    #findWhere
    }

    /**
     * Método responsável retornar todos os registros da tabela
     *
     * @access public
     * @static
     * @return mixed Retorna todos os registros da tabela
     */
    public static function todos() {
        DBTransaction::open('siged');
        /*
        $result = UsuarioModel::all();
        DBTransaction::commit();
        return $result;
         *
         */
        $model = new Usuario();
        if ($result = $model->todos()) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
}
