<?php

	include_once 'config.php';

	class Setting {

		private $config;

		public function __construct(){
			$this->config = new Config();
		}
		
		public function response(String $status, String $message, $data = array()) {
			return array(
				"status" => $status,
				"message" => $message,
				"data" => $data
			);
		}
		
		public function request(String $endpoint, String $method, $data = array()) {
			$url = $this->config->API_URI . $endpoint;
			$auth = base64_encode($this->config->SECRET_KEY . ':');

			$options = array(
				"http" => array(
					"method" => $method,
					"content" => http_build_query($data),
					"header" => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Basic $auth\r\n"
				)
			);

			$context = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			return $result;
		}
	}

?>