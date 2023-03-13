<?php

declare(strict_types=1);

namespace Application\Collector\Models;

use Engine\DTO\BaseDTO;

class Employee extends BaseDTO implements \JsonSerializable
{
    protected string|null $employeeId;
    protected string|null $employeeSurname;
    protected string|null $employeeFirstName;
    protected string|null $employeeSecondName;
    protected string|null $employeePosition;
    protected string|null $employeePhoto;

    public function __construct(array|string $data){
        $this->init($data);
    }

    public function __get($name){
        return $this->$name;
    }

    public function jsonSerialize(): mixed
    {
        $properties = get_object_vars($this);
        return $properties;
    }

}