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
class Email
{
    const MAIL = "Mail";
    const SMTP = "Smtp";

    private $method;

    public $markers = array("CRDT", "CRERRNO", "CRERRMSG", "CRFILENAME", "CRLINENUM");
    public $body;
    public $title;
    public $to;

    public function __construct() {
        $this->method = \ManageError\Configs::getConfig(array("METHOD", "EMAIL"));
        $this->to = \ManageError\Configs::getConfig(array("EMAIL", "TO"));
        $this->title = \ManageError\Configs::getConfig(array("EMAIL", "TITLE"));
        $this->body = \ManageError\Util::loadTemplate(CORE . "/Actions/email_template.html");
    }

    public function make()
    {
        switch ($this->method) {
            case self::MAIL:
                $email = new Mail($this);
                break;
            case self::SMTP:
                $email = new Smtp($this);
                break;
        }

        $email->make();
    }
}
?>