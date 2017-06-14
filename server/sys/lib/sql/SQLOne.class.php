<?php

namespace root\server\sys\lib\sql;

use root\server\sys\lib\db\DBTransaction;

/**
 * Classe responsável por provê os métodos necessários para manipular um
 * registro ativo da base de dados (Active Record)
 *
 * @abstract
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
abstract class SQLOne {
    /**
     * Método executada no momento de criação da classe
     * Não existirão instâncias desta classe
     *
     * @access public
     * @return void
     */
    public function __construct() {
    }

    /**
     * Método responsável por retornar o nome da tabela a ser manipulada
     *
     * @access private
     * @return string Retorna nome da tabela
     */
    private function getTable() {
        # Obtém o nome da classe que está chamando este script
        $class = get_class($this);
        # Retorna a constante da classe NOME_TABELA que se
        # encontra na classe de origem
        return constant("{$class}::TABLE_NAME");
    }
    /**
     * Método responsável por encontrar um registro na base de dados através de seu ID
     *
     * @access public
     * @param int $_one ID do registro a ser encontrado
     * @return mixed Retorna um objeto com os dados do registro encontrado
     */
    public function findOne($_one) {
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable($this->getTable());
        $sql->setColumn('*');
        # Cria critério de seleção baseado no ID
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter(static::$PRIMARY_KEY, '=', $_one));
        # Define o critério de seleção de dados
        $sql->setCriteria($criteria);

        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            //echo $sql->getSQL();
            $result = $conn->Query($sql->getSQL());
            # Verifica se retornou algum dado
            if ($result) {
                # Retorna os dados em forma de objeto
                $object = $result->fetchObject(get_class($this));
                return $object;
            } else {
                return;
            }
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

    /**
     * Método responsável por inserir novos registros na base de dados
     *
     * @access public
     * @param mixed $_arrOne Array contendo as colunas e seus respectivos
     * valores para inserção
     * @return int Retorna ID do novo registro inserido
     */
    public function insertOne($_arrOne) {
        # Cria uma instância de SQLInsert
        $sql = new SQLInsert;
        $sql->setTable($this->getTable());
        # Percorre os dados do objeto
        foreach ($_arrOne as $key => $value) {
            # O ID não precisa ir no INSERT
            if ($key !== static::$PRIMARY_KEY) {
                # Passa os dados do objeto para o SQL
                $sql->setColumnValue($key, $value);
            }
        }
        if ($conn = DBTransaction::get()) {
            $obj = $conn->query($sql->getSQL() . " RETURNING " . static::$PRIMARY_KEY);
            //$result = $obj->fetchObject(); //return object
            $result = $obj->fetchAll();// return array
            if ($result[0][static::$PRIMARY_KEY]) {
                return $result[0][static::$PRIMARY_KEY];
            } else {
                return;
            }
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

    /**
     * Método responsável por atualizar um registro na base de dados
     *
     * @access public
     * @param mixed $_arrOne Array contendo as colunas e seus respectivos
     * valores para atualização
     * @return bool Retorna true se a atualização ocorrer com sucesso
     */
    public function updateOne($_arrOne) {
        # Cria uma instância de SQLUpdate
        $sql = new SQLUpdate;
        $sql->setTable($this->getTable());
        # Cria um critério de seleção baseado no ID
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter(static::$PRIMARY_KEY, '=', $_arrOne[static::$PRIMARY_KEY]));
        $sql->setCriteria($criteria);
        # Percorre os dados do objeto
        foreach ($_arrOne as $key => $value) {
            # O ID não precisa ir no UPDATE
            if ($key !== static::$PRIMARY_KEY) {
                # Passa os dados do objeto para o SQL
                $sql->setColumnValue($key, $value);
            }
        }
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            //echo $sql->getSQL();
            $result = $conn->exec($sql->getSQL());
            # Retorna o resultado
            if ($result >= 0) {
                return true;
            } else {
                return;
            }
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

    /**
     * Método responsável por inserir/atualizar dados na tabela tb_sexo
     *
     * @access public
     * @param mixed $_arrOne Array contendo as colunas e seus respectivos
     * valores para persistência
     * @return int|bool Retorna ID do novo registro inserido em caso de inserção,
     * e true se for uma atualização e ocorrer com sucesso
     */
    public function insertOrUpdateOne($_arrOne) {
        if (isset($_arrOne[static::$PRIMARY_KEY]) and ( $_arrOne[static::$PRIMARY_KEY] > 0)) {
            return $this->updateOne($_arrOne);
        } else {
            return $this->insertOne($_arrOne);
        }
    }

    /**
     * Método responsável por excluir um registro na base de dados através de seu ID
     *
     * @access public
     * @param int $_one ID do registro a ser excluído
     * @return int Retorna o número de linhas excluída
     */
    public function deleteOne($_one) {
        # Cria uma instância de SQLDelete
        $sql = new SQLDelete;
        $sql->setTable($this->getTable());
        # Cria critério de seleção de dados
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter(static::$PRIMARY_KEY, '=', $_one));
        # Define o critério de seleção baseado no ID
        $sql->setCriteria($criteria);
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            $result = $conn->exec($sql->getSQL());
            # Retorna o resultado
            if ($result >= 1) {
                return true;
            } else {
                return;
            }
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

}
