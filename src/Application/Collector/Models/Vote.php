<?php

declare(strict_types=1);

namespace Application\Collector\Models;

use Engine\DTO\BaseDTO;

class Vote extends BaseDTO implements \JsonSerializable
{
    protected string $ratingRecordId;
    protected int $ratingRecordValue;
    protected string $ratingRecordComment;

    public function __construct(string $json){
        $this->init($json);
    }

    public function __get(string $name){
        return $this->$name;
    }

    public function jsonSerialize(): mixed
    {
        $properties = get_object_vars($this);
        return $properties;
    }
}