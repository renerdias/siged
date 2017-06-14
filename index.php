<?php

require_once "Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
use root\server\sys\lib\exception\ManageException;
  $error = new ManageException(); // Instanciar o objeto.
  $error->register();
  use root\server\sys\lib\config\Config;

  $conf = Config::load('server/sys/config/config.json');
  
      echo $conf->get('connection.siged.sgdb');

//throw new Exception("Value must be 1 or below");
# Obtém uma instância de Autoloader
//trigger_error("Value must be 1 or below");
