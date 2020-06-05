<?php

namespace Pantheion\Charon\Custom;

class Exception extends \Exception
{
    public function __construct($message, $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->setClassInfo();
        $this->setRequestInfo();
    }

    protected function setClassInfo()
    {
        $class = new \ReflectionClass(Exception::class);

        $this->name = $class->getName();
        $this->shortName = $class->getShortName();
        $this->namespace = $class->getNamespaceName();
    }

    protected function setRequestInfo()
    {
        $this->protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http';
        $this->host = $_SERVER['HTTP_HOST'];
        $this->url = $_SERVER['REQUEST_URI'];

        $this->directory = $_SERVER['DOCUMENT_ROOT'];
    }

    public function resolveUrl()
    {
        return $this->protocol . "://" . $this->host . $this->url;
    }
}
