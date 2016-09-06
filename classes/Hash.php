<?php 

class Hash {

	public static function make($string, $salt = '')
	{
		return hash('sha256', $string . $salt);
	}

	public static function salt($length)
	{
		 
		$salt = mcrypt_create_iv($length);
		return mb_convert_encoding($salt, "UTF-8", mb_detect_encoding($salt, "UTF-8, ISO-8859-1, ISO-8859-15", true));
	}

	public static function unique()
	{
		return self::make(uniqid());
	}

}

?>