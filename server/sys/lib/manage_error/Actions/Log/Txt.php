<?php 
namespace root\server\sys\lib\manage_error\Actions\Log;
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
 * @author tiagobutzke
 */
class Txt
{
    const FORMAT = ".txt";

    private $log;
    private $message;

    public function __construct(Log $log)
    {
        $this->log = $log;
        $this->message = \ManageError\Util::loadTemplate(CORE . "/Actions/txt_template.txt");
    }

    public function make()
    {
        $error = \ManageError\Actions\AbstractActionManager::$error;
        \ManageError\Util::writeTxtLog($this->log->dir . $this->log->filename . self::FORMAT, str_replace($this->log->markers, array($error->datetime, $error->errno, $error->filename, $error->line, $error->message), $this->message));
    }
}
?>
