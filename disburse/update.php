<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; charset=UTF-8');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Header: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

    include_once '../config/dbclass.php';
	include_once '../config/setting.php';
	include_once 'disbursement.php';

    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();

	$helper = new Setting();

	$dbs = new Disbursement($connection);

	$data = json_decode(file_get_contents("php://input"));

	if(
		!empty($data->status) &&
		!empty($data->receipt)
	){

		$payload = array(
			"status"			=> $data->status,
			"receipt"			=> $data->receipt
		);

		$request = json_decode($helper->request('disburse', 'PATCH', $payload));

		$dbs->status 			= $request->status;
        $dbs->receipt 			= $request->receipt;
        $dbs->time_served	    = $request->time_served;
		$dbs->id             	= $request->id;


		$db_exec = $dbs->create()->fetch_assoc();

		$res_array = array(
			"id" 				=> $db_exec["id"],
			"amount" 			=> $db_exec["amount"],
			"status"			=> $db_exec["status"],
			"timestamp"			=> $db_exec["timestamp"],
			"bank_code"			=> $db_exec["bank_code"],
			"account_number"	=> $db_exec["account_number"],
			"beneficiary_name"	=> $db_exec["beneficiary_name"],
			"remark" 			=> $db_exec["remark"],
			"receipt"			=> $db_exec["receipt"],
			"time_served"		=> $db_exec["time_served"],
			"fee"				=> $db_exec["fee"]
		);

		$response = $helper->response("success", $res_array);

		echo json_encode($response);

	}
	else {
		http_response_code(400);

		$response = $helper->response("failed", $data);

		echo json_encode($response);
	}
?>