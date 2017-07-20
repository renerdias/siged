<?php

namespace root\server\sys\srv\documento\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\documento\model\Documento;

/**
 * Trecho de código responsável por persistir os dados na tabela documento e que
 * compõe o controller DocumentoCtrl.
 *
 * @package sys/srv/documento
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait salvar {

    /**
     * Método responsável por inserir novos registros na tabela documento
     *
     * @access public
     * @param mixed $_arr Array contendo as colunas e seus respectivos
     * valores para inserção
     * @return int Retorna ID do novo registro inserido
     */
    public static function inserir($_arr) {
        DBTransaction::open('siged');
        $documento = new Documento();
        $resultado = $documento->insertOne($_arr);
        if ($resultado) {
            DBTransaction::commit();
            return $resultado;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por atualizar um registro na tabela documento
     *
     * @access public
     * @param mixed $_arr Array contendo as colunas e seus respectivos
     * valores para atualização
     * @return bool Retorna true se a atualização ocorrer com sucesso
     */
    public static function atualizar($_arr) {
        DBTransaction::open('siged');
        $documento = new Documento();
        if ($documento->updateOne($_arr)) {
            DBTransaction::commit();
            return true;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por inserir/atualizar dados na tabela documento
     *
     * @access public
     * @param mixed $_arr Array contendo as colunas e seus respectivos
     * valores para persistência
     * @return int|bool Retorna ID do novo registro inserido em caso de inserção,
     * e true se for uma atualização e ocorrer com sucesso
     */
    public static function inserirOuAtualizar($_arr) {
        DBTransaction::open('siged');
        $documento = new Documento();
        $resultado = $documento->insertOrUpdate($_arr);
        if ($resultado == true or $resultado > 0) {
            DBTransaction::commit();
            return $resultado;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
}
