<?php

class Request
{
	protected $keys = [];

	function validate()
	{
		$_SESSION["inputs"] = $_SESSION["errors"] = [];

		foreach ($this->keys as $key => $data) {
			$request = $_POST[$key];

			foreach (explode("|", $data["rules"] ?? []) as $function) {
				$result = $this->$function($request);
				if ($result) {
					$_SESSION['errors'][$key][] = $result;
				}
			}

			if ($rule["use_old_input"] ?? true) {
				$_SESSION["inputs"][$key] = $request;
			} else {
				$_SESSION["inputs"][$key] = "";
			}
		}
		if (count($_SESSION["errors"]) > 0) static::redirectBack();
	}

	public function __construct($keys, $method = null)
	{
		if ($method && $_SERVER['REQUEST_METHOD'] != $method) return;
		$this->keys = $keys;
		session_start();
		self::validate();
	}

	static function redirectBack()
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	function required($data)
	{
		return empty($data) ? "Bu alan zorunludur." : false;
	}

	static function error($key)
	{
		return $_SESSION['errors'][$key] ?? false;
	}

}
