<?php

namespace Src\Core\Logger;

use function Symfony\Component\Clock\now;

class Logger
{
    private string $storagePath;
    private string $logPath;
    private string $filePath;
    private string $logMessage;
    private string $filename;
    public function __construct(string $filename = "batcore.log")
    {
        $this->filename = $filename;
        $this->checkDirectory();
    }

    private function checkDirectory(): void
    {
        $storage = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "storage";
        $logPath = $storage . DIRECTORY_SEPARATOR . "logs";

        if (!is_dir($storage)) {
            mkdir($storage, 0777);
        }

        if (!is_dir($logPath)) {
            mkdir($logPath, 0777);
        }

        $filePath = $logPath . DIRECTORY_SEPARATOR . $this->filename;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, '');
        }

        $this->storagePath = $storage;
        $this->logPath = $logPath;
        $this->filePath = $filePath;
    }

    private function getLogTemp($type = "info", $msg)
    {
        $temp = "";
        $temp .= "[";
        $temp .= date('Y-m-d H:m:s');
        $temp .= "]";
        $temp .= " ";
        $temp .= $type;
        $temp .= ": ";
        $temp .= $msg;

        $this->logMessage = $temp;
        return $temp;
    }

    private function log($type, $msg)
    {
        $logMessage = $this->getLogTemp($type, $msg);
        file_put_contents($this->filePath, $logMessage . PHP_EOL, FILE_APPEND);
    }

    public function info($msg)
    {
        $this->log('info', $msg);
    }

    public function error($msg)
    {
        $this->log('error', $msg);
    }

    public function warning($msg)
    {
        $this->log('warning', $msg);
    }

    public function emergency($msg)
    {
        $this->log('emergency', $msg);
    }

    public function alert($msg)
    {
        $this->log("alert", $msg);
    }

    public function notice($msg)
    {
        $this->log("notice", $msg);
    }

    public function debug($msg)
    {
        $this->log("debug", $msg);
    }
}