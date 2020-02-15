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
		!empty($data->bank_code) &&
		!empty($data->account_number) &&
		!empty($data->amount) &&
		!empty($data->remark)
	){

		$payload = array(
			"bank_code" 		=> $data->bank_code,
			"account_number"	=> $data->account_number,
			"amount"			=> $data->amount,
			"remark"			=> $data->remark
		);

		$request = json_decode($helper->request('disburse', 'POST', $payload));

		$dbs->amount			= $request->amount;
		$dbs->status 			= $request->status;
		$dbs->bank_code			= $request->bank_code;
		$dbs->account_number	= $request->account_number;
		$dbs->beneficiary_name	= $request->beneficiary_name;
		$dbs->remark			= $request->remark;
		$dbs->fee 				= $request->fee;
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