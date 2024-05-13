<?php
namespace CodeWithEdison\ErrorLogger;

class ErrorLogger {
    protected $logFilePath;

    public function __construct($logFilePath) {
        if (!file_exists($logFilePath)) {
            $file = fopen($logFilePath, "w");
            fclose($file);
        }
        $this->logFilePath = $logFilePath;
    }

    public function handleError($errno, $errorstr, $errorfile, $errorline) {
        $message = "ERROR: [$errno] $errorstr - $errorfile : $errorline";
        error_log($message . PHP_EOL, 3, $this->logFilePath);
    }

    public function setErrorHandler() {
        set_error_handler(array($this, "handleError"));
    }
}
