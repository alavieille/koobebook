<?php 

return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'kookebook',
 
    'preload'=>array('log'),
 
    'import'=>array(
        'application.components.*',
        'application.models.*',
        'application.components.sepa.*',
        'application.components.Sepa.DomBuilder.*',
        'application.components.Sepa.Exception.*',
        'application.components.Sepa.TransferFile.*',
        'application.components.Sepa.TransferInformation.*',
        'application.components.Sepa.Util.*',
    ),
    // We'll log cron messages to the separate files
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),
 
        // Your DB connection
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=libebook',
			'emulatePrepare' => true,
			'username' => '',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling' => true,
            'enableParamLogging' => true,
		),
    ),
     'params'=>array(
        "sepa"=> array(
            "name"=>"kookebook",
            "iban"=>"FR7030002005500000157845Z02",
            "bic"=>"CRLYFRPP",
        )
    ),
);