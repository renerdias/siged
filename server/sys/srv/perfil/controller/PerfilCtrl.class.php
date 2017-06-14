<?php

namespace root\server\sys\srv\perfil\controller;

/**
 * Classe de controle de acesso aos dados da tabela tb_perfil.
 *
 * @package sys/srv/perfil
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class PerfilCtrl {
    use find;
    use save;
    use delete;
}
