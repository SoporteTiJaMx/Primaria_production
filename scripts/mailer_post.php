<?php
	$to = $_SESSION["to_mail"];
	$name = $_SESSION["nombre_mail"];
	$subject = $_SESSION["subject"];
	$html_title = $_SESSION["html_title"];
	$html_parr1 = $_SESSION["html_parr1"];
	$html_parr2 = $_SESSION["html_parr2"];
	$html_parr3 = $_SESSION["html_parr3"];

	use \mailjet\Resources;

	$mj = new \mailjet\Client('a4031c903e0facf0f656ec8b277bcd78','8a4693eaf06a495c058c3f320e6342c3',true,['version' => 'v3.1']);

	echo $body = [
	'Messages' => [
		[
		'From' => [
			'Email' => "eye@jamexico.org.mx",
			'Name' => "Emprendedores y Empresarios"
		],
		'To' => [
			[
			'Email' => $to,
			'Name' => $name
			]
		],
		'Subject' => $subject,
		'HTMLPart' => '
<style type="text/css">
	* {
	font-family: "Montserrat", sans-serif;
	font-size: 14px;
	}
</style>
<body style="background-color: #D5D7DD;">
	<div style="width:765px;" >

	<div>
		<img src="http://emprendedoresyempresarios.org.mx/images/mail_header.png">
	</div><br>

	<h3 style="margin-left:5%; margin-right:5%;">' . $name . '</h3>
	<h3 style="margin-left:5%; margin-right:5%; margin-bottom: 3%">' . $html_title . '</h3>


	<p style="margin-left:5%; margin-right:5%; margin-bottom: 3%">
	' . $html_parr1 . '
	</p>
	<p style="margin-left:5%; margin-right:5%; margin-bottom: 3%">
	' . $html_parr2 . '
	</p>
	<p style="margin-left:5%; margin-right:5%; margin-bottom: 3%">
	' . $html_parr3 . '
	</p>

	<br><div>
		<img src="http://emprendedoresyempresarios.org.mx/images/mail_footer.png">
	</div>

	</div>
</body>'
		]
	]
	];
	unset($_SESSION['to_mail']);
	unset($_SESSION['nombre_mail']);
	unset($_SESSION['subject']);
	unset($_SESSION['html_title']);
	unset($_SESSION['html_parr1']);
	unset($_SESSION['html_parr2']);
	unset($_SESSION['html_parr3']);
	$response = $mj->post(Resources::$Email, ['body' => $body]);
	$response->success(); // && var_dump($response->getData());
?>
