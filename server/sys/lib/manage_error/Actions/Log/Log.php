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
class Log 
{
    const XML = "Xml";
    const TXT = "Txt";

    private $method;

    public $markers = array("DATETIME", "ERRNO", "FILENAME", "LINE", "MESSAGE");
    public $dir;
    public $filename;

    public function __construct()
    {
        $this->method = \ManageError\Configs::getConfig(array("METHOD", "LOG"));
        $this->dir = \ManageError\Configs::getConfig(array("LOG", "DIR"));
        $this->filename = date(\ManageError\Configs::getConfig(array("LOG", "FILENAME")));
    }

    public function make()
    {
        switch ($this->method) {
            case self::XML:
                $log = new Xml($this);
                break;
            case self::TXT:
                $log = new Txt($this);
                break;
        }

        $log->make();
    }
}
?>