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

    public function getEmployeeByFullName(string $search){
        $search = json_decode($search)->search;
        $query = ("SELECT * FROM employees WHERE CONCAT(employee_surname, ' ', employee_first_name) LIKE '%$search%'");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function insert(Employee $employee) {
        $query = ("INSERT INTO employees (employee_id, employee_surname, employee_first_name, employee_second_name, employee_position, employee_photo) 
                    VALUES (:employeeId, :employeeSurname, :employeeFirstName, :employeeSecondName, :employeePosition, :employeePhoto)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'employeeId'=>$employeeId = Uuid::uuid4()->toString(),
            'employeeSurname'=>$employee->employeeSurname,
            'employeeFirstName'=>$employee->employeeFirstName,
            'employeeSecondName'=>$employee->employeeSecondName,
            'employeePosition'=>$employee->employeePosition,
            'employeePhoto'=>$employee->employeePhoto
        ]);
        return $employeeId;
    }

    public function update(Employee $employee) : bool {
        $query = ("UPDATE employees 
                   SET employee_surname= :employeeSurname,
                       employee_first_name= :employeeFirstName,
                       employee_second_name= :employeeSecondName,
                       employee_position= :employeePosition,
                       employee_photo = :employeePhoto
                   WHERE employee_id = :employeeId
                  ");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'employeeId'=>$employee->employeeId,
            'employeeSurname'=>$employee->employeeSurname,
            'employeeFirstName'=>$employee->employeeFirstName,
            'employeeSecondName'=>$employee->employeeSecondName,
            'employeePosition'=>$employee->employeePosition,
            'employeePhoto'=>$employee->employeePhoto
        ]);
        return true;
    }

    public function delete(string $json) : bool {
        $std = json_decode($json);
        $query = ("DELETE FROM employees WHERE employee_id = :employeeId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['employeeId'=>$std->employeeId]);
        return true;
    }

}