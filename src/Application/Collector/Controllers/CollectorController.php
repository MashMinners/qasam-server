<?php

declare(strict_types=1);

namespace Application\Collector\Controllers;

use Application\Collector\Models\Collector;
use Application\Collector\Models\Vote;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CollectorController
{
    public function __construct(private Collector $collector){

    }

    #1. Сосканировать штрихкод отправить на сервер и проверить активен ли он.
    // Если он активен вернуть врача за которого нужно оставить голос
    // Если не активен вернуть сообщение о точ, что талон уже использован
    public function show(ServerRequestInterface $request) : ResponseInterface {
        $recordId = $request->getQueryParams()['ratingRecordId'];
        //$recordId = file_get_contents('php://input');
        $result = $this->collector->show($recordId);
        return new JsonResponse($result);
    }

    #2. Послать на сервер оценку и комментарий
    public function vote(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $this->collector->vote(new Vote($json));
        return new JsonResponse('Ok');
    }

}