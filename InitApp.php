<?php
/**
 * Script de definições a serem usados pela aplicação
 *
 * OBSERVAÇAO: Este script deve ser adicionado em todos os demais
 * scripts php EXCETO nas classes
 *
 */

 #Define o zona horária padrão
 date_default_timezone_set('America/Sao_Paulo');

 #Define a forma de separação de pastas de acordo com o sistema operacional (\ ou /)
 define('DS', DIRECTORY_SEPARATOR);

#Define o caminho absoluto para pasta da aplicação
define('BASE_PATH',realpath(dirname(__FILE__)).DS,true);



define('ROOT',$_SERVER['DOCUMENT_ROOT']);


define('SITE_ROOT',ROOT.DS.'meu_site');
# 2º alternativa
# define('SITE_ROOT',DS.'var'.DS.'www'.DS.'meu_site');
define('LIB_CLASS',SITE_ROOT.DS.'classes');
define('LIB_INCLUDES',SITE_ROOT.DS.'includes');

//echo $_SERVER['HOST'];

?>
