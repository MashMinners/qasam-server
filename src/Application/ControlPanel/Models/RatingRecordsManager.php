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

    public function delete(string $json) : bool {
        //$std = json_decode($json);
        $records = ['0a339786-0b7e-422a-9656-0e7579280a9b', '31aa57bb-f867-421a-8ebc-43c8304dff35',
            '393757bb-d584-48af-9509-f7a3353b97ce'];
        $string = '';
        foreach ($records as $single){
            $string .= "'".$single."'".' ,';
        }
        $string = substr($string,0,-1);
        $query = ("DELETE from rating_records WHERE rating_record_id IN ($string)");//" (1,2,3,...,254);");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return true;
    }

}