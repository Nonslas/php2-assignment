<?php
define('BASE_URL', 'http://localhost/minhhtph08444/public');
define('ASSET_URL', BASE_URL . '/assets');

function baseUrl($uri)
{
	if ($uri[0] !== '/') $uri = '/' . $uri;
	return BASE_URL . $uri;
}

function hasUpload($name)
{
	return isset($_FILES[$name]) && $_FILES[$name]['size'] > 0;
}

function getUpload($name)
{
	$file = $_FILES[$name];
	$extension = @end(explode('.', $file['name']));
	if (!in_array($extension, ['jpg', 'jpeg', 'png'])) throw new Exception('File extension not allowed', 101);
	$filename = time().uniqid();
	$filepath = 'uploads/images/'.$filename.'.'.$extension;
	return move_uploaded_file($file['tmp_name'], $filepath) ? $filepath : null;
}