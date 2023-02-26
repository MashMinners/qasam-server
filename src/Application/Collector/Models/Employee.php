<?php

declare(strict_types=1);

namespace Application\Collector\Models;

use Engine\DTO\BaseDTO;

class Employee extends BaseDTO implements \JsonSerializable
{
    protected string $employeeSurname;
    protected string $employeeFirstName;
    protected string $employeeSecondName;
    protected string $employeePosition;
    protected string $employeePhoto;

    public function __construct(array $data){
        $this->init($data);
    }

    public function jsonSerialize(): mixed
    {
        $properties = get_object_vars($this);
        return $properties;
    }

}