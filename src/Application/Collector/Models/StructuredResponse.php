<?php

declare(strict_types=1);

namespace Application\Collector\Models;

class StructuredResponse implements \JsonSerializable
{
    private string $status;
    private string $message;
    private array $body;


    public function __set($name, $value){
        $this->$name = $value;
    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }

}