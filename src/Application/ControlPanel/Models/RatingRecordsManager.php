<?php

declare(strict_types=1);

namespace Application\ControlPanel\Models;

use Engine\Database\IConnector;
use Ramsey\Uuid\Uuid;

class RatingRecordsManager
{
    public function __construct(IConnector $connector) {
        $this->pdo = $connector::connect();
    }

    public function getAll(){
        $query = ("SELECT * FROM rating_records");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getByEmployee(string $id) : array {
        $employeeId = json_decode($id)->employeeId;
        $query = ("SELECT * FROM rating_records
                   WHERE rating_record_employee_id = :employeeId AND rating_record_status = 1
                   LIMIT 50");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['employeeId' => $employeeId]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function insert(string $employeeId, int $limit = 10) : bool {
        $employeeId = json_decode($employeeId)->employeeId;
        $query = ("INSERT INTO rating_records (rating_record_id, rating_record_employee_id) VALUES");
        for ($i = 0; $i < $limit; $i++){
            $recordId = Uuid::uuid4()->toString();
            $query .= (" ('$recordId', '$employeeId'),");
        };
        $query = substr($query,0,-1);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return true;
    }

}