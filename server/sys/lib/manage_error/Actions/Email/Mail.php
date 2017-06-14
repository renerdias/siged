<?php
namespace root\server\sys\lib\manage_error\Actions\Email;
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
class Mail
{
    private $email;
    private $headers;

    public function __construct(Email $email)
    {
        $this->email = $email;
        $from = \ManageError\Configs::getConfig(array("EMAIL", "FROM"));
        $this->headers = "From: {$from}\r\n" . "Reply-To: {$from}\r\n" . "X-Mailer: PHP/" . phpversion();
    }

    public function make()
    {
        $error = \ManageError\Actions\AbstractActionManager::$error;
        mail($this->email->to, $this->email->title, str_replace($this->email->markers, array($error->datetime, $error->errno, $error->message, $error->filename, $error->line), $this->email->body), $this->headers);
    }
}
?>