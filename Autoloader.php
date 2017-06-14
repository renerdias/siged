<?php

 /**
  * Classe de autocarregamento de arquivos/classes para o sistema
  *
  * @package root
  * @version 0.1
  * @author Rener Dias
  * @copyright (c) 2017, R2 Informática
  */
class Autoloader {
    # Diretório base para o prefixo do namespace

    const DIR_BASE = __DIR__; //. '/';

    /**
     * @var null $instance Receberá uma instância de Autoloader
     * @access private
     */

    private static $instance;

    /**
     * @var null $prefix Receberá o Prefixo do namespace específico para o projeto
     * @access private
     */
    private static $prefix;

    /**
     * Método executado no momento de criação da classe
     * Não existirão instâncias de Autoloader, por isto estamos marcando-o como private
     *
     * @access private
     * @param string $_prefix Recebe o prefixo do projeto
     * @return void
     */
    private function __construct($_prefix) {
        self::$prefix = $_prefix;
        spl_autoload_register(array($this, "loader"));
    }

    /**
     * Método responsável por prepara o arquivo para ser carregado
     *
     * @access private
     * @param string $_class Nome do arquivo/classe a ser carregado
     * @return void
     */
    private function loader($_class) {
        # Verifica se a classe usa o prefixo do namespace
        $size = strlen(self::$prefix);
        if (strncmp(self::$prefix, $_class, $size) !== 0) {
            # Caso não, retorna e tenta carregar a próxima
            return;
        }
        # Obter nome da classe
        $className = substr($_class, $size);
        # Substitui o prefixo do namespace com o diretório base
        # Substitui os separadores do namespace com separadores de pastas no nome da classe relativa
        $file = self::DIR_BASE . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className);
        if ($this->load($file . '.class.php')) {
            //
        } else if ($this->load($file . '.php')) {
            //
        } else if ($this->load($file . '.trait.php')) {
            //
        }
    }

    /**
     * Método responsável por carregar os arquivos
     *
     * @access private
     * @return bool Retorna true caso consiga carregar o arquivo
     */
    private function load($_file) {
        if (file_exists($_file)) {
            require_once $_file;
            # Define o zona horária padrão
            date_default_timezone_set('America/Sao_Paulo');
            return true;
        }
        return false;
    }

    /**
     * Método responsável por retornar uma instância desta classe
     *
     * @access public
     * @static
     * @return self Retorna uma instancia de si mesma
     */
    public static function getInstance($_prefix) {
        if (empty(self::$instance)) {
            self::$instance = new Autoloader($_prefix);
        }
        return self::$instance;
    }

}
