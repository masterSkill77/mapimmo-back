<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>
    <style>
        h4 {
    margin: 0;
}
.w-full {
    width: 100%;
}
.w-half {
    width: 50%;
}
.margin-top {
    margin-top: 1.25rem;
}
.footer {
    font-size: 0.875rem;
    padding: 1rem;
    background-color: rgb(241 245 249);
}
table {
    width: 100%;
    borders-spacing: 0;
}
table.products {
    font-size: 0.875rem;
}
table.products tr {
    background-color: rgb(96 165 250);
}
table.products th {
    color: #ffffff;
    padding: 0.5rem;
}
table tr.items {
    background-color: rgb(241 245 249);
}
table tr.items td {
    padding: 0.5rem;
}
.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}
    </style>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <!-- <img src="{{ asset('logo-formation.png') }}" alt="logo mapimmo" width="200" /> -->
            </td>
            <td class="w-half">
                <h2>N° Facture: </h2>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
         
            <td class="w-half">
                    <div><h4>{{$orders->user->name}} {{$orders->user->lastname}}</h4></div>
                    <div>{{$orders->user->email}}</div>
                    <div>{{$orders->user->phone_number}}</div>
                </td>
                   
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Titre</th>
                <th>Durée</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
            <tr class="items">
                @foreach($orders->plans as $item) 
                    <td>
                        {{ $item['title'] }}
                    </td>
                    <td>
                        {{ $item['duration'] }}
                    </td>
                    <td>
                        {{ $item['quantity']}}
                    </td>
                    <td>
                        {{ $item['price'] }}
                    </td>
                @endforeach
            </tr>
           
           
        </table>
    </div>
    <div class="total">
    Durée Total: {{$orders->total_duration}} 
    </div>
    <div class="total">
       Prix Total: {{$orders->total_amount}} €
    </div>
 
    <div class="footer margin-top">
        <div>Merci beaucoup!</div>
        <div>&copy; Mapimmo</div>
    </div>
</body>
</html>