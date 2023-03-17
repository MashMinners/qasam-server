<?php
//Collector
$this->get('/', '\Application\Collector\Controllers\CollectorController::show');
$this->post('/', '\Application\Collector\Controllers\CollectorController::vote');
//Employees
$this->get('/employee', '\Application\ControlPanel\Controllers\EmployeeController::get');
$this->post('/employee', '\Application\ControlPanel\Controllers\EmployeeController::add');
$this->get('/employees', '\Application\ControlPanel\Controllers\EmployeeController::getAll');
$this->get('/employees/byFullName', '\Application\ControlPanel\Controllers\EmployeeController::getByFullName');
$this->put('/employees', '\Application\ControlPanel\Controllers\EmployeeController::save');
$this->delete('/employees', '\Application\ControlPanel\Controllers\EmployeeController::remove');
//Rating records
$this->get('/records/byEmployee', '\Application\ControlPanel\Controllers\RatingRecordsController::getByEmployee');
$this->post('/records', '\Application\ControlPanel\Controllers\RatingRecordsController::add');
//QR code generator
$this->get('/qr', '\Application\ControlPanel\Controllers\QRCodeGeneratorController::index');