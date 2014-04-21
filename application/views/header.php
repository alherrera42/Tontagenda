<html>
	<head>
		<title>Tontagenda</title>
		<link href="http://fonts.googleapis.com/css?family=Ubuntu:300,300italic,400,400italic,500,500italic,700,700italic&amp;subset=latin,greek,cyrillic" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed:400&amp;subset=latin,greek,cyrillic" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,400italic,700,700italic&amp;subset=latin,greek,cyrillic" rel="stylesheet" type="text/css" />
		<!--link rel="stylesheet" href="<?=base_url()?>application/third_party/jquery-ui-smoothness.css"></link-->
		<script src="<?=base_url()?>application/third_party/jquery-1.9.1.js"></script>
		<script src="<?=base_url()?>application/third_party/jquery-ui.js"></script>
		<style type='text/css'>
			body{font-family:'Ubuntu','Ubuntu Mono','Verdana';padding:0px 0px 0px 0px; border:0px;}
			header{width:100%;background-color:#8C2B2F;color:#FFFFFF;}
			table{width:100%;}
		</style>
	</head>
	<body>
	<header>
			<table>
			<tr>
				<td>
					<a href='<?=base_url()?>'>
						<h1>Tontagenda</h1>
					</a>
				</td>
				<td class='accordion'>
				<?php if(!count($usuario)) { ?>
					<p>Iniciar sesion</p>
					<form>
						<input type='text' name='nss' placeholder='Cuenta' required />
						<input type='password' name='password' placeholder='Contraseña' required />
						<input type='submit' value='Entrar' />
					</form>
				<?php } else { ?>
					<h3>Hola, <?=$usuario['nombre']?></h3>
					<p>Detalles de cuenta</p>
				<?php } ?>
				</td>
			</tr>
		</table>
	</header>
