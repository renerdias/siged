<?php

namespace root\server\sys\srv\tipo_documento\model;

use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;
use root\server\sys\lib\util\TUtil;

/**
 * Classe responsável pela manipulação de registros da tabela tipo_documento
 *
 * @package sys/srv/tipo_documento
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class TipoDocumento extends SQLOne
{
     const TABLE_NAME = 'sistema.ts_tipo_documento';
     protected static $PRIMARY_KEY = 'id_tipo_documento';


    public function todos(){
      # Cria uma instância de um repositório
      $sql = new SQLAll(self::TABLE_NAME);
      # Carrega lista de registros
      $criteria = new SQLCriteria;
      $criteria->setProperty('order', 'ds_tipo_documento asc');
      # Carrega lista de registros
      $resultado = $sql->findAll($criteria);
      # Retorno
      return $resultado;
    }
}
?>
