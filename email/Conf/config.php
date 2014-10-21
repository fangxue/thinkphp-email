<?php
$config = array(
		'URL_MODEL'	=>	2,
		'URL_CASE_INSENSITIVE' =>true,
		'DB_TYPE'	=>	'mysql',
		'DB_HOST'	=>	'127.0.0.1',
		'DB_NAME'	=>	'email',
		'DB_USER'	=>	'root',
		'DB_PWD'	=>	'',
		'DB_PORT'	=>	'3306',
		'DB_PREFIX'	=>	'',
		'WEB_HOST' =>'lc.email.com',
		'LOAD_EXT_CONFIG' => array(
				'ERROR_MSG' => 'config_errormsg',
		),
		'LOG_RECORD' =>	true,
		'URL_404_REDIRECT' => '/Public/404',
		'URL_HTML_SUFFIX'=>'',//伪静态URL设置
		'URL_CASE_INSENSITIVE' => true,
		'TMPL_ACTION_ERROR' => 'Public:error',
		'TMPL_ACTION_SUCCESS' => 'Public:success',
);
return $config;
?>