<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <section class="py-20 bg-black">
        <div class="max-w-5xl mx-auto py-16 bg-white">
            <article class="overflow-hidden">
                <div class="bg-[white] rounded-b-md">
                    <div class="px-9">
                        <div class="space-y-6 text-slate-700">
                            <img class="object-cover h-60 w-100" src="{{asset('logo-formation.png')}}" />
                        </div>
                        <div class="w-full">
                            <div class="grid grid-cols-4 gap-12">
                                <div class="text-md col-span-2 w-full font-light text-slate-500">
                                    <p class="text-xl font-bold tracking-tight uppercase font-body"> MAPIM </p>
                                    <p class="text-xl font-bold">8 rue Pierre de Ronsard</p>
                                    <p class="text-xl font-bold">62119 DOURGES</p>
                                    <p class="text-xl font-bold">977772896 00014 / 6201Z</p>
                                </div>
                                <div class="text-md col-span-2 w-full justify-center font-light text-slate-500 -mr-10">
                                    <p class="text-xl font-bold tracking-tight uppercase font-body">{{$orders->user->name}} {{$orders->user->lastname}}</p>
                                    <p class="text-xl font-bold">Adresse</p>
                                    <p class="text-xl font-bold">CP VIlle</p>
                                    <p class="text-xl font-bold">Siren et N° TVA</p>
                               </div>
                            </div>
                           
                        </div>
                    </div>
                </div>

                <div class="px-9">
                    <div class=" w-full">
                        <div class="grid grid-cols-4 gap-12 ">
                            <div class="text-md col-span-2 w-full font-normal text-slate-500">
                                <p>RCS Arras</p>
                                <p>TVA Intracommunautaire : FR 94977772896</p>
                                <p>Tel/Mail : 09 88 19 47 62 / contact@mapim-immo.fr</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="px-9">
                    <div class="flex flex-col mx-0 mt-8">
                        <table class="min-w-full divide-y divide-slate-500 border-collapse border border-slate-400">
                            <thead class="table-auto">
                                <tr class="bg-gray-400">
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-md font-medium  text-white sm:pl-6 md:pl-0 border border-slate-400">
                                        Date
                                    </th>
                                    <th scope="col" class=" py-3.5 px-3 text-center text-md font-medium  text-white sm:table-cell border border-slate-400">
                                        Facture N°
                                    </th>
                                    <th scope="col" class=" py-3.5 px-3 text-center text-center text-md font-medium  text-white sm:table-cell border border-slate-400">
                                        Ref. Commande
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-md font-medium text-white sm:pr-6 md:pr-0 border border-slate-400">
                                        Echéance
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-md font-medium  text-white sm:pr-6 md:pr-0 border border-slate-400">
                                        Soit le
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-md font-medium  text-white sm:pr-6 md:pr-0 border border-slate-400">
                                        Mode de paiement
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-200">
                                    <td class="py-4 pl-4 pr-3 text-md sm:pl-6 md:pl-0">
                                        <div class="font-medium text-slate-700">
                                        {{$orders->created_at}}
                                        </div>
                                        <div class="mt-0.5 text-slate-500 sm:hidden">
                                        {{$orders->num_invoice}}
                                        </div>
                                    </td>
                                    <td class="hidden px-3 py-4 text-md text-center text-slate-500 sm:table-cell border border-slate-400">
                                        48
                                    </td>
                                    <td class="hidden px-3 py-4 text-md text-center text-slate-500 sm:table-cell border border-slate-400">
                                       
                                    </td>
                                    <td class="py-4 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400 border border-slate-400">
                                       
                                    </td>
                                    <td class="py-4 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400 border border-slate-400">
    
                                       </td>
                                </tr>
                        

                               
                            </tbody>
                           
                        </table>
                    </div>
                </div>

                <div class="px-9">
                    <div class="flex flex-col mx-0 mt-8">
                        <table class="min-w-full divide-y divide-slate-500">
                            <thead class=" border-collapse border border-slate-400">
                                <tr class="bg-gray-400">
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-md font-medium text-white sm:pl-6 md:pl-0  border border-slate-400">
                                        Designation
                                    </th>
                                    <th scope="col" class="hidden py-3.5 px-3 text-center text-md font-medium  text-white sm:table-cell border border-slate-400">
                                        Unité
                                    </th>
                                    <th scope="col" class="hidden py-3.5 px-3 text-center text-md font-medium  text-white sm:table-cell border border-slate-400">
                                        Quantité
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-md font-medium  text-white sm:pr-6 md:pr-0 border border-slate-400">
                                        PU HT
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-md font-medium  text-white sm:pr-6 md:pr-0 border border-slate-400">
                                        TVA
                                    </th>
                                    <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-md font-medium  text-white sm:pr-6 md:pr-0 border border-slate-400">
                                       TOTAL HT
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="border-collapse border border-slate-400">
                                <tr class="border-b border-slate-200">
                                @foreach($orders->plans as $item) 
                                    <td class="py-4 pl-4 pr-3 text-md sm:pl-6 md:pl-0">
                                        <div class="font-medium text-slate-700">{{ $item['title'] }}</div>
                                    </td>
                                    <td class="hidden px-3 py-4 text-md text-center text-slate-500 sm:table-cell border border-slate-400">
                                       
                                    </td>
                                    <td class="hidden px-3 py-4 text-md text-center text-slate-500 sm:table-cell border border-slate-400">
                                    {{ $item['quantity']}}  
                                    </td>
                                    <td class="py-4 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400">
                                    {{ $item['price'] }} 
                                    </td>
                                    <td class="hidden px-3 py-4 text-md text-center text-slate-500 sm:table-cell border border-slate-400">
                                       
                                    </td>
                                    <td class="py-4 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400">
                                       
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tfoot >

                                <tr class="">
                                    <th scope="row" colspan="5"  class="uppercase  pt-6 pl-6 pr-3 text-md font-light text-right text-slate-500 sm:table-cell md:pl-0 border col-span-3 border-slate-500">
                                        Sous total
                                    </th>
                               
                                    <td class="pt-6 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400">
                                    {{$orders->total_amount}} €
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="hidden pt-6 pl-6 pr-3 text-md font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                        TVA
                                    </th>
                           
                                    <td class="pt-6 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400">
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="hidden pt-4 pl-6 pr-3 text-md font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                        TOTAL TTC
                                    </th>
                                   
                                    <td class="pt-4 pl-3 pr-4 text-md text-center text-slate-500 sm:pr-6 md:pr-0 border border-slate-400 border border-slate-400">
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="hidden pt-4 pl-6 pr-3 text-md font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                        ACOMPTE
                                    </th>
                                   
                                    <td class="pt-4 pl-3 pr-4 text-md font-normal text-center text-slate-700 sm:pr-6 md:pr-0 border border-slate-400">
                                    {{$orders->total_amount}} €
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="hidden pt-4 pl-6 pr-3 text-md font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                        A PAYER
                                    </th>
                                   
                                    <td class="pt-4 pl-3 pr-4 text-md font-normal text-center text-slate-700 sm:pr-6 md:pr-0 border border-slate-400">
                                    {{$orders->total_amount}} €
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="mt-18 px-9">
                    <div class="border-t pt-9 border-slate-200">
                        <div class="text-md font-no text-slate-700">
                           <p>Taux des pénalités de retard : XX% (ex. 4% en l'absence de paiement) <br>
                           Taux d'escompte : XX% (ou pas d’escompte pour règlement anticipé) <br>
                        <span class=" italic">En cas de retard de paiement, application d’une indemnité forfaitaire pour frais de recouvrement de 40€ selon l'article D. 441-5 du code du
commerce</span></p>
                        </div>
                    </div>
                </div>
        </div>
        </article>
        </div>
    </section>

</body>

</html>