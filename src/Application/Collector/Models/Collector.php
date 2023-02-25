<?php

declare(strict_types=1);

namespace Application\Collector\Models;

use Engine\Database\IConnector;

class Collector
{
    private \PDO $pdo;

    public function __construct(IConnector $connector) {
        $this->pdo = $connector::connect();
    }

    private function isVoted(string $id) : bool {
        $query = ("SELECT rating_record_status FROM rating_records WHERE rating_record_id = :id");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id' => $id
        ]);
        $result = $stmt->fetch();
        return $result['rating_record_status'] === 2 ? true : false;
    }

    public function show(string $recordId) : StructuredResponse {
        $recordId = json_decode($recordId)->recordId;
        $structuredResponse = new StructuredResponse();
        if ($this->isVoted($recordId)){
            $structuredResponse->status = 'voted';
            $structuredResponse->message = 'Вы уже поставили оценку данному врачу';
            return $structuredResponse;
        }
        $query = ("SELECT * FROM rating_records
                    INNER JOIN employees ON employees.employee_id = rating_records.rating_record_employee_id
                   WHERE rating_record_id = :recordId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'recordId' => $recordId
        ]);
        $result = $stmt->fetch();
        $structuredResponse->status = 'not voted';
        $structuredResponse->message = 'Поставьте свою оценку';
        $structuredResponse->body = $result;
        return $structuredResponse;
    }

    //По факту это когда он нажимает на желтую, зеленую, крансую кнопку
    public function vote(Vote $vote) : bool {
        $query = ("UPDATE rating_records 
                   SET rating_record_status = 2,
                   rating_record_value = :ratingRecordValue,
                   rating_record_comment = :ratingRecordComment,
                   rating_record_activation_date = :ratingActivationRecordDate
                   WHERE rating_record_id = :ratingRecordId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'ratingRecordId' => $vote->ratingRecordId,
            'ratingRecordValue' => $vote->ratingRecordValue,
            'ratingRecordComment' => $vote->ratingRecordComment,
            'ratingActivationRecordDate' => date('Y-m-d')
        ]);
        return true;
    }

}