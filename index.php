<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/style.css?version=<?= filemtime("css/style.css")?>" >

</head>
<body>
<form method="POST" action="ceklogin.php">
 	<?php if (isset($_GET['msg'])) : ?>
						<div class="alert" role="alert">
							<small class="text-danger"><?= $_GET['msg'];  ?></small>
						</div>
					<?php endif ?>

          <div class="container" align="center">
          <h2 align="center" class="h2"> 𝒲𝒶𝓈𝒽 𝑀𝑒 𝐿𝒶𝓊𝓃𝒹𝓇𝓎</h2>
	<div class="logo">
	</div>
	<form class="form">
		<div class="form__group">
			<div class="form__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg></div>
        <input type="text" class="form__control" name="username" placeholder="username" tabindex="1" required />
		</div>
		<div class="form__group">
			<div class="form__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/></svg></div>
        <input type="password" class="form__control" name="password" placeholder="Password" tabindex="2" required />
		</div>
		<div>
			<button class="form__button" type="submit">
				LOGIN
			</button>
		</div>
	</form>
</div>
</body>
</html>