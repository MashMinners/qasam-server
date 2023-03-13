<?php

declare(strict_types=1);

namespace Application\ControlPanel\Models;

use Application\Collector\Models\Employee;
use Engine\Database\IConnector;
use Ramsey\Uuid\Uuid;

class EmployeeManager
{
    public function __construct(IConnector $connector) {
        $this->pdo = $connector::connect();
    }

    public function getEmployee(string $id) : Employee {
        $employeeId = json_decode($id)->employeeId;
        $query = ("SELECT * FROM employees WHERE employee_id = :employeeId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['employeeId' => $employeeId]);
        $result = $stmt->fetch();
        return new Employee($result);
    }

    public function getEmployees() : array {
        $query = ("SELECT * FROM employees");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //Находит дубликаты врачей
    public function getEmployeeDuplicates(){

    }

    public function insert(Employee $employee) {
        $query = ("INSERT INTO employees (employee_id, employee_surname, employee_first_name, employee_second_name, employee_position) 
                    VALUES (:employeeId, :employeeSurname, :employeeFirstName, :employeeSecondName, :employeePosition)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'employeeId'=>$employeeId = Uuid::uuid4()->toString(),
            'employeeSurname'=>$employee->employeeSurname,
            'employeeFirstName'=>$employee->employeeFirstName,
            'employeeSecondName'=>$employee->employeeSecondName,
            'employeePosition'=>$employee->employeePosition
        ]);
        return $employeeId;
    }

    public function update() {

    }

    public function delete() {

    }

}