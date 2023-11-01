<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		* {
			border: 0;
			box-sizing: content-box;
			color: inherit;
			font-family: inherit;
			font-size: inherit;
			font-style: inherit;
			font-weight: inherit;
			line-height: inherit;
			list-style: none;
			margin: 0;
			padding: 0;
			text-decoration: none;
			vertical-align: top;
		}

		/* content editable */

		*[contenteditable] {
			border-radius: 0.25em;
			min-width: 1em;
			outline: 0;
		}

		*[contenteditable] {
			cursor: pointer;
		}

		span[contenteditable] {
			display: inline-block;
		}

		/* heading */

		h1 {
			font: bold 100% sans-serif;
			letter-spacing: 0.5em;
			text-align: center;
			text-transform: uppercase;
		}

		/* table */

		table {
			font-size: 75%;
			table-layout: fixed;
			width: 100%;
		}

		table {
			border-collapse: collapse;
			border-spacing: 2px;
		}

		th,
		td {
			border-width: 1px;
			padding: 0.5em;
			position: relative;
			text-align: left;
		}

		th,
		td {
			border-radius: 0.25em;
			border-style: solid;
		}

		th {
			background: #EEE;
			border-color: #BBB;
		}

		td {
			border-color: #DDD;
		}

		/* page */

		html {
			font: 16px/1 'Open Sans', sans-serif;
			overflow: auto;
			padding: 0.5in;
		}

		html {
			background: #999;
			cursor: default;
		}

		body {
			box-sizing: border-box;
			height: 15in;
			overflow: hidden;
			padding: 0.5in;
			width: 7in;
		}

		body {
			background: #FFF;
			border-radius: 1px;
			box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
		}

		/* header */

		header:after {
			clear: both;
			content: "";
			display: table;
		}

		header h1 {
			background: #000;
			border-radius: 0.25em;
			color: #FFF;
			margin: 0 0 1em;
			padding: 0.5em 0;
		}

		header address {
			float: left;
			font-size: 75%;
			font-style: normal;
			line-height: 1.25;
			margin: 0 1em 1em 0;
			font-weight: bold;
			font-size: 100%;
		}

		/* article */

		article address {
			margin-top: -5em;
		}

		article,
		article address {
			margin: 0 0 3em;
		}

		article:after {
			clear: both;
			content: "";
			display: table;
		}

		article h1 {
			clip: rect(0 0 0 0);
			position: absolute;
		}

		article address {
			float: left;
			font-size: 80%;
			font-weight: normal;
		}

		article address p {
			margin: 0 0 0.5em;
		}

		article .customer {
			float: right;
			font-size: 100%;
			font-weight: bold;
			margin-top: -5em;
			margin-right: 10em;
		}

		table.balance {
			float: right;
			width: 36%;
		}

		table.balance:after {
			clear: both;
			content: "";
			display: table;
		}

		table.inventory {
			clear: both;
			width: 100%;
		}

		table.inventory th {
			font-weight: bold;
			text-align: center;
		}

		table.inventory td:nth-child(1) {
			width: 38%;
		}

		table.inventory td:nth-child(2) {
			width: 10%;
		}

		table.inventory td:nth-child(3) {
			width: 12%;
		}

		table.inventory td:nth-child(4) {
			width: 12%;
		}

		table.inventory td:nth-child(5) {
			width: 10%;
		}

		table.inventory td:nth-child(6) {
			width: 12%;
		}

		table.meta {
			clear: both;
			width: 100%;
			margin-bottom: 2%;
		}

		table.meta th {
			font-weight: bold;
			text-align: center;
		}

		table.meta td {
			text-align: center;
		}

		table.balance th,
		table.balance td {
			width: 50%;
		}

		table.balance td {
			text-align: right;
		}

		aside {
			position: relative;
			bottom: 0;
		}

		aside div {
			font-size: 75%;
			border: none;
			border-width: 0 0 1px;
			margin: 0 0 1em;
			flex-wrap: wrap;
		}

		@media print {
			html {
				background: none;
				padding: 0;
			}

			body {
				box-shadow: none;
				margin: 0;
			}

			table {
				width: 100%;
				border-collapse: collapse;
			}
		}

		@page {
			margin: 0;
		}
	</style>

</head>

<body>
	<!-- <img alt="" src="{{asset('logo-formation.png')}}" width="400px" height="200px"> -->
	<header>
		<address contenteditable>
			<h5 style="text-transform: uppercase; "><b>Mapim</b></h5>
			<p>8 rue Pierre de Ronsard<br>62119 DOURGES</p>
			<p>977772896 00014 / 6201Z</p>
		</address>
	</header>
	<article>
		<address contenteditable>
			<p>RCS Arras</p>
			<p> TVA Intracommunautaire :FR 94977772896</p>
			<p>Tel/Mail : 09 88 19 47 62 / contact@mapim-immo.fr</p>
		</address>
		<address class="customer">
			<p>{{$orders->user->name}} {{$orders->user->lastname}} </p>
			<p> Adresse</p>
			<p>CP Ville</p>
			<p>Siren et N° TVA</p>
		</address>
		<table class="meta">
			<thead>
				<tr>
					<th><span contenteditable>Date</span></th>
					<th><span contenteditable>Facture N°</span></th>
					<th><span contenteditable>Ref. Commande</span></th>
					<th><span contenteditable>Echéance</span></th>
					<th><span contenteditable>Soit le </span></th>
					<th><span contenteditable>Mode de règlement </span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span contenteditable> {{$orders->created_at}}</span></td>
					<td><span contenteditable> {{$orders->num_invoice}}</span></td>
					<td><span contenteditable></span></td>
					<td><span contenteditable></span></td>
					<td><span contenteditable></span></td>
					<td><span contenteditable>STRIPE</span></td>
				</tr>
			</tbody>
		</table>
		<table class="inventory">
			<thead>
				<tr>
					<th><span contenteditable>Designation</span></th>
					<th><span contenteditable>Unité</span></th>
					<th><span contenteditable>Quantité</span></th>
					<th><span contenteditable>PU HT</span></th>
					<th><span contenteditable>TVA</span></th>
					<th><span contenteditable>TOTAL HT</span></th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders->plans as $item)
				<tr>

					<td><span contenteditable>{{ $item['title'] }}</span></td>
					<td><span contenteditable></span></td>
					<td><span contenteditable>{{ $item['quantity']}} </span>€</td>
					<td><span contenteditable>{{ $item['price'] }} </span>€</td>
					<td><span contenteditable> €</span></td>
					<td><span contenteditable>€</span></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<table class="balance">
			<tr>
				<th><span contenteditable>SOUS TOTAL HT</span></th>
				<td><span> {{$orders->total_amount}} </span></td>
			</tr>
			<tr>
				<th><span contenteditable>TVA</span></th>
				<td><span contenteditable>0,00 €</span></td>
			</tr>
			<tr>
				<th><span contenteditable>TOTAL TTC</span></th>
				<td><span>{{$orders->total_amount}} € </span></td>
			</tr>
			<tr>
				<th><span contenteditable>ACOMPTE</span></th>
				<td><span></span>€</td>
			</tr>
			<tr>
				<th><span contenteditable>A PAYER</span></th>
				<td><span>{{$orders->total_amount}} €</span></td>
			</tr>
		</table>
	</article>
	<aside>

		<div contenteditable>
			<p>Taux des pénalités de retard : XX% (ex. 4% en l'absence de paiement) <br>
				Taux d'escompte : XX% (ou pas d’escompte pour règlement anticipé) <br>
				<span class=" italic">En cas de retard de paiement, application d’une indemnité forfaitaire pour frais de recouvrement de 40€ selon l'article D. 441-5 du code du
					commerce</span>
			</p>
		</div>
	</aside>
</body>

</html>