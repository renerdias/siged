<?php
namespace root\server\sys\lib\manage_error\Error;
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
 * This class is a interface for Errors
 *
 * @author tiagobutzke
 */
abstract class AbstractError
{
    public $errno;
    public $message;
    public $filename;
    public $line;
    public $datetime;

    protected function __construct($errno, $errmsg, $filename, $line)
    {
        $datetime = new \DateTime();

        $this->datetime = $datetime->format(\ManageError\Configs::getConfig(array("DATETIME", "FORMAT")));
        $this->errno = $errno;
        $this->message = $errmsg;
        $this->filename = $filename;
        $this->line = $line;
    }

    public static function getInstance($errno, $errmsg, $filename, $line)
    {
        switch ($errno) {
            case E_ERROR:
                return new ERROR($errno, $errmsg, $filename, $line);
                break;
            case E_WARNING:
                return new WARNING($errno, $errmsg, $filename, $line);
                break;
            case E_PARSE:
                return new PARSE($errno, $errmsg, $filename, $line);
                break;
            case E_NOTICE:
                return new NOTICE($errno, $errmsg, $filename, $line);
                break;
            case E_CORE_ERROR:
                return new CORE_ERROR($errno, $errmsg, $filename, $line);
                break;
            case E_CORE_WARNING:
                return new COMPILE_WARNING($errno, $errmsg, $filename, $line);
                break;
            case E_COMPILE_ERROR:
                return new COMPILE_ERROR($errno, $errmsg, $filename, $line);
                break;
            case E_COMPILE_WARNING:
                return new COMPILE_WARNING($errno, $errmsg, $filename, $line);
                break;
            case E_USER_ERROR:
                return new USER_ERROR($errno, $errmsg, $filename, $line);
                break;
            case E_USER_WARNING:
                return new USER_WARNING($errno, $errmsg, $filename, $line);
                break;
            case E_USER_NOTICE:
                return new USER_NOTICE($errno, $errmsg, $filename, $line);
                break;
            case E_STRICT:
                return new STRICT($errno, $errmsg, $filename, $line);
                break;
            default:
                return NULL;
                break;
        }
    }
}
?>