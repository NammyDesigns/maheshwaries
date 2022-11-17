<?php
function GenCode($size=10){
	$code = '';
	$validchars = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789';
	mt_srand ((double) microtime() * 1000000);
	for ($i = 0; $i < $size; $i++) 
	{
		$index = mt_rand(0, strlen($validchars));
		$code .= $validchars[$index];
	}
	return $code;
}

?>