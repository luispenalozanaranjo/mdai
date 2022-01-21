<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		.btn{
			text-decoration: none;
			padding:12px 15px;
			font-size: 14px;
			color: #fff !important;
			background-color: #D94F5C;
			border-radius: 4px;
			text-transform:uppercase;
		}
		.small{
			font-size:12px;
		}
		h3{line-height:normal;margin:0;}
	</style>
</head>
<body>
	<br>
	<h3>Se le ha asignado una actividad pendiente:</h3>
	<h2 style="margin:0;">{{ $nodo }}</h2>

	<br><br>

	<a href="{{ $url }}" class="btn">Ver actividad</a>
	
	<br><br><br>
	<p class="small">Este es un correo automático del sistema, por favor no responder.</p>
</body>
</html>