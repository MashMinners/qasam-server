<?php

declare(strict_types=1);

namespace Application\ControlPanel\Controllers;

use Application\ControlPanel\Models\ControlPanelManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ControlPanelController
{
    public function __construct(ControlPanelManager $manager){

    }

    public function index(ServerRequestInterface $request) : ResponseInterface {
        // В целом должен возвращать доступные сервисы админки
        /**
         *  На клиенте будет реализовано в виде Card с кнопкой в футере
         * Будет деление на логические разделы. Визуально эти разделы будут отделяться дивайдером
         * В каждом таком разделе будут свои Card для работы.
         * Карды будут показываться в зависимости от привелегий.
         * Пока все.
         *
         */
    }

}