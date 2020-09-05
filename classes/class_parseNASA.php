<?php
class parseNASA {
	private $APIKey;
	private $todayDate;
	function __construct() {
		$config = parse_ini_file(dirname(__FILE__,2) . "/config/NASAAPI_config.ini");
		$this->APIKey = $config['NASAAPI_Key'];
		$this->todayDate = date("Y-m-d");
	}
	private function getURL() {
		$today = $this->todayDate;
		$APIKey = $this->APIKey;
		$returned = sprintf("%s?start_date=%s&end_date=%s&api_key=%s","https://api.nasa.gov/neo/rest/v1/feed",$today,$today,$APIKey);
		return $returned;
	}
	public function getResponse() {
		$APIUrl = $this->getURL();
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $APIUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		if (curl_errno($curl)) {
			curl_close($curl);
			return [];
		}
		curl_close($curl);
		$responseJSON = json_decode($result);
		$currentDate = $this->todayDate;
		$result = array();
		$responseJSONCurrent = $responseJSON->near_earth_objects->$currentDate;
		foreach ($responseJSONCurrent as $nasaItem) {
			$returnedItem = array();
			$returnedItem["name"] = strval($nasaItem->name);
			$returnedItem["fromDate"] = strval($currentDate);
			$returnedItem["diameterEstMin"] = strval($nasaItem->estimated_diameter->kilometers->estimated_diameter_min) ?: 0;
			$returnedItem["diameterEstMax"] = strval($nasaItem->estimated_diameter->kilometers->estimated_diameter_max) ?: 0;
			$returnedItem["hazardous"] = strval($nasaItem->is_potentially_hazardous_asteroid) ? "Yes" : "No";
			$returnedItem["cameCloser"] = strval($nasaItem->close_approach_data[0]->close_approach_date);
			$returnedItem["details"] = strval($nasaItem->nasa_jpl_url);
			array_push($result,$returnedItem);
		}
		return $result;
	}
	public function getOneAsteroid() {
		$APIResponse = $this->getResponse();
		$returned = array();
		// If NASA returned more than one object - then get random one
		if (count($APIResponse) > 1) {			
			$maxNum = count($APIResponse) - 1;
			$APICount = rand(0,$maxNum);
			$returned = $APIResponse[$APICount];
		} else { //Otherwise use the single one returned - potentially impossible			
			$returned = $APIResponse[0];
		}
		return $returned;
	}
	
	public function getDescription() {
		$returnedText = "";
		$APIResponse = $this->getOneAsteroid();
		if (count($APIResponse) > 0) {
			$returnedText .= sprintf("Asteroid Name: %s \n", $APIResponse["name"]);
			$returnedText .= sprintf("Report Date: %s \n", $APIResponse["fromDate"]);
			$returnedText .= sprintf("Diameter Min (Km): %s \n", $APIResponse["diameterEstMin"]);
			$returnedText .= sprintf("Diameter Max (Km): %s \n", $APIResponse["diameterEstMax"]);
			$returnedText .= sprintf("Hazardous?: %s \n", $APIResponse["hazardous"]);
			$returnedText .= sprintf("Close Encounter Date: %s \n", $APIResponse["cameCloser"]);
			$returnedText .= sprintf("Details: %s \n", $APIResponse["details"]);
		} else {
			$returnedText = "Nothing returned from NASA API \n";
		}
		return $returnedText;
	}
}
?>
