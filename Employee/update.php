<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Method: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,
        Authorization, X-Requested-With");

    include_once 'database.php';
    include_once 'employees.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new Employee($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->id=$data->id;

    $item->name = $data->name;

    $item->email = $data->email;

    $item->age = $data->age;

    $item->designation = $data->designation;

    $item->created = date('Y-m-d H:i:s');

    if ($item->updateEmp()){
        echo 'Employee updated successfully.';
    } else{
        echo 'Employee could not be updated.';
    }
?>