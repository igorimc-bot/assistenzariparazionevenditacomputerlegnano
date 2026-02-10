<?php
class SimpleSMTP
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $timeout = 30;
    private $debug = false;

    public function __construct($host, $port, $username, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function send($to, $subject, $message, $fromName = 'Admin', $replyTo = null)
    {
        $socket = fsockopen("ssl://{$this->host}", $this->port, $errno, $errstr, $this->timeout);
        if (!$socket) {
            return "Connection failed: $errno $errstr";
        }

        // Read initial server greeting
        $this->read($socket);

        // EHLO
        $this->write($socket, "EHLO " . $_SERVER['SERVER_NAME']);
        $this->read($socket);

        // AUTH LOGIN
        $this->write($socket, "AUTH LOGIN");
        $this->read($socket);

        $this->write($socket, base64_encode($this->username));
        $this->read($socket);

        $this->write($socket, base64_encode($this->password));
        $this->read($socket);

        // MAIL FROM
        $this->write($socket, "MAIL FROM: <{$this->username}>");
        $this->read($socket);

        // RCPT TO (Handle multiple recipients if array, but for this simple class loop external or simple string)
        // Here we handle comma separated string or array
        $recipients = is_array($to) ? $to : explode(',', $to);
        foreach ($recipients as $recipient) {
            $recipient = trim($recipient);
            $this->write($socket, "RCPT TO: <$recipient>");
            $this->read($socket);
        }

        // DATA
        $this->write($socket, "DATA");
        $this->read($socket);

        // Headers
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: $fromName <{$this->username}>\r\n";
        $headers .= "To: " . implode(', ', $recipients) . "\r\n";
        if ($replyTo) {
            $headers .= "Reply-To: $replyTo\r\n";
        }
        $headers .= "Subject: $subject\r\n";

        $this->write($socket, $headers . "\r\n" . $message . "\r\n.");
        $response = $this->read($socket);

        // QUIT
        $this->write($socket, "QUIT");
        fclose($socket);

        if (strpos($response, '250') !== false) {
            return true;
        } else {
            return "Error sending mail: $response";
        }
    }

    private function write($socket, $data)
    {
        fputs($socket, $data . "\r\n");
        if ($this->debug)
            echo "CLIENT: $data<br>";
    }

    private function read($socket)
    {
        $response = "";
        while ($str = fgets($socket, 515)) {
            $response .= $str;
            if (substr($str, 3, 1) == " ")
                break;
        }
        if ($this->debug)
            echo "SERVER: $response<br>";
        return $response;
    }
}
?>