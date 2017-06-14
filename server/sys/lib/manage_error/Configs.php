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
 * Here haves all the configurations of the project
 *
 * @author tiagobutzke
 */
class Configs
{
    private static $labels = array(
        "ACTIONS" => array(
            "COMPILE_ERROR" => array("Email", "Log"),
            "COMPILE_WARNING" => array("Email", "Log"),
            "CORE_ERROR" => array("Email", "Log"),
            "CORE_WORNING" => array("Email", "Log"),
            "ERROR" => array("Email", "Log"),
            "NOTICE" => array("Log", "Email"),
            "PARSE" => array("Email", "Log"),
            "STRICT" => array("Email", "Log"),
            "USER_ERROR" => array("Email", "Log"),
            "USER_NOTICE" => array("Email", "Log"),
            "USER_WARNING" => array("Email", "Log"),
            "WARNING" => array("Email", "Log")
        ),
        "METHOD" => array(
            "EMAIL" => "Mail", // "EMAIL" => "Smtp"
            "LOG" => "Txt", // "LOG" => "Xml"
        ),
        "EMAIL" => array(
            "TO" => "tiago.butzke@gmail.com",
            "FROM" => "error@bigerror.com",
            "TITLE" => "A new error in the system.",
        ),
        "LOG" => array(
            "DIR" => "../../../var/log/", // Directory where the logs will be
            "FILENAME" => "d-m-Y"
        ),
        "DATETIME" => array(
            "FORMAT" => "d/m/Y H:i:s"
        )
    );

    public static function getConfig(array $whats)
    {
        $value = self::$labels;
        foreach ($whats as $what)
            $value = $value[$what];

        return $value;
    }
}
?>
