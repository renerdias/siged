<?php

namespace root\server\sys\srv\tipo_norma\model;

use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;
use root\server\sys\lib\util\TUtil;

/**
 * Classe responsável pela manipulação de registros da tabela tipo_norma
 *
 * @package sys/srv/tipo_norma
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class TipoNorma extends SQLOne
{
     const TABLE_NAME = 'public.ts_tipo_norma';
     protected static $PRIMARY_KEY = 'id_tipo_norma';


    public function todos(){
        # Cria uma instância de SQLSelect
        $criteria = new SQLCriteria;
        $criteria->setProperty('order', 'ds_tipo_norma asc');
        return SQLAll::findAll($criteria);
    }
}
?>
