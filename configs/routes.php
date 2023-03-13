<?php
//Collector
$this->get('/', '\Application\Collector\Controllers\CollectorController::show');
$this->post('/', '\Application\Collector\Controllers\CollectorController::vote');
//Employees
$this->get('/employee', '\Application\ControlPanel\Controllers\EmployeeController::get');
$this->get('/employees', '\Application\ControlPanel\Controllers\EmployeeController::getAll');
$this->post('/employee', '\Application\ControlPanel\Controllers\EmployeeController::add');