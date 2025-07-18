<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Selamat Datang di CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Selamat Datang di CodeIgniter!</h1>

	<div id="body">
		<p>Halaman yang Anda lihat sedang dibuat secara dinamis oleh CodeIgniter.</p>

		<p>Jika Anda ingin mengedit halaman ini, Anda akan menemukannya di:</p>
		<code>application/views/welcome_message.php</code>

		<p>Controller yang sesuai untuk halaman ini ditemukan di:</p>
		<code>application/controllers/Welcome.php</code>

		<p>Jika Anda sedang menjelajahi CodeIgniter untuk pertama kalinya, Anda harus mulai dengan membaca <a href="user_guide/">Panduan Pengguna</a>.</p>
	</div>

	<p class="footer">Halaman dirender dalam <strong>{elapsed_time}</strong> detik. <?php echo  (ENVIRONMENT === 'development') ?  'Versi CodeIgniter <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>