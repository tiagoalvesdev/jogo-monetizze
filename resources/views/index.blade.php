<h1>Sorteio</h1>
<hr>
@if($mensagem)
	{{ $mensagem }}
@endif

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jogos - Monetizze</title>
</head>
<body>
	<br><br>
	<table>
		<tr>
	        <td>Resultado</td>
	        <td>Dezenas</td>
    	</tr>
    	@foreach ($resultado as $key => $res)
    	<tr>
			<th>{{ ($res) }}</th>
			<th>{{ ($qtdDezenas) }}</th>
    	</tr>
    	@endforeach
	</table>

</body>
</html>
