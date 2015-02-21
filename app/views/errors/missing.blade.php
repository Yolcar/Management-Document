<!DOCTYPE HTML>
<html>
	<head>
		<title>ERROR 404</title>
		{{HTML::style('css/style.css')}}
	</head>
	<body>
		<!--start-wrap--->
		<div class="wrap">
			<!---start-header---->
				<div class="header">
					<div class="logo">
						<h1><a href="#">Ohh</a></h1>
					</div>
				</div>
			<!---End-header---->
			<!--start-content------>
			<div class="content">
				{{HTML::image('images/error-img.png')}}
				<p><span><label>O</label>hh.....</span>Solicitaste una pagina una pagina que no esta disponible.</p>
				<a href="{{Route('home')}}">Regresar al inicio</a>
   			</div>
		</div>
	</body>
</html>

