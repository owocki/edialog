<?

/**
 * a test request for e-dialog
 * @package cron/Test
 */

$eDialog = new eDialog();
$response = $eDialog->request('listAudiences',array(
	'filterType' => 'Membership',
	'filterNameExpression' => null,
	'filterStartCreateDate' => date(DateTime::ATOM,strtotime('-3years')),
	'filterEndCreateDate' => date(DateTime::ATOM,strtotime('+1days')),
	'sortBy' => null,
	'pageSize' => 10,
	'pageNumber' => 1,
	));
var_dump($response);


?>




