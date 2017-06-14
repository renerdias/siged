<?php
namespace root\server\sys\lib\manage_error;
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL.
 *
 * 
 * This class is a autoloader of other class
 *
 * @author tiagobutzke
 */
class Autoloader
{
    private $subNamespaces = array("Error", "Actions", "Actions\Log", "Actions\Email");
    private static $instance;

    private function __construct()
    {
        spl_autoload_register(array($this, "loader"));
    }

    private function loader($class)
    {
        if (FALSE !== strpos($class, __NAMESPACE__)) {
            $class =  str_replace("\\", "/", __DIR__ . "/" . substr($class, strpos($class, "\\") + 1) . ".php");
            $this->load($class);
        } else {
            foreach ($this->subNamespaces as $subNamespaces) {
                $class = __DIR__ . "/" . $subNamespaces . "/" . $class . ".php";
                if ($this->load(str_replace("\\", "/", $class)))
                    break;
            }
        }
    }

    private function load($file)
    {
        if (file_exists($file)) {
            require_once $file;
            return true;
        }

        return false;
    }

    public static function getInstance()
    {
        if (empty (self::$instance))
            self::$instance = new Autoloader();

        return self::$instance;
    }
}
?>
