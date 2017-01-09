<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>home</title>
</head>
<body>

	<header>
		<div>j'aime +1</div>
		<div>connectez-vous</div>
		<div>[F] [T]</div>
	</header>
	<div id="wrapper">
		<nav>
		<ul>
			<li>Home</li>
			<li>Actus</li>
			<li>Le Lycée</li>
			<li>Rechercher</li>
		</ul>
	</nav>
		<div id="content">
			@yield('content')
		</div>
		<aside>
			@yield('sidebar')
		</aside>
	</div>
	<footer>
		<p>mentions légales | contact</p>
	</footer>
	
</body>
</html>