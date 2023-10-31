<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

    .container  {
    padding: 20px;
    /* height: 1500px; */
}
.outer-1 {
    border: 5px solid blue;
    width : 100%;
    height:auto;
    padding: 10px;
}

.outer-2 {
    border: 5px solid green;
    width : 97%;
    padding: 10px;
}

.outer-3 {
    border: 5px solid cyan;
    width : 99%;
    display: flex;
    justify-content: center;
}

.flex {
    display: flex;
    justify-content: center;
    align-items: center;
}

.img-logo {
    width: 200px;
    height: auto;
}
.img-container {
    position: absolute;
    left: 40%;
    top : 0;
    background-color: white;
}
.attestation-content {
    padding-top : 15%;
    width: 100%;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
}
.attestation-content
small {
    display: inline-block;
    font-weight: lighter;
    /* line-height: 0.3px; */
    font-style: italic;
}
* {
}
ul {
    list-style-type: none;
}
div {
    /* line-height: 10px; */
}
.signature-container {
    display: flex;
    width: 100%;
    flex-direction: column;
    justify-content: space-between;
}

td > div {
    margin : 20px;
}

    </style>
</head>

<body>
    <div class="img-container">
        <img class="img-logo" src="{{ public_path() . ('/logo-formation.png')}}" />
    </div>
<div class="container flex">
    <div class="outer-1 flex">
        <div class="outer-2 flex">
            <div class="outer-3">
                <div class="attestation-content">
                        <small>Centre de formation spécialisé Loi Alur</small><br>
                            <small>98 rue Pierre de Roussard - 62119 DOURGES</small><br>
                            <small>09 77 89 33 27</small><br>
                            <small>formation@mapim-immo.fr</small><br>
                            <small>www.mapim-formation.com</small><br>
                            <div style="width:80%;margin:auto">
                            Déclarartion d'activité enregistrée sous le numéro de déclaration 00 00 00000 00
                            au près du Préfet des Hauts de France.</div>
                            <h1 style="color: rgb(5, 91, 106);font-weight: bold;font-size:35px"><b>ATTESTATION DE FORMATION IMMOBILIER</b></h1>
                            <small>Pour satisfaire aux obligations prévues par le décret n°2016-173 du 18 Février 2013 relatif à la formation des professionnels de l'immobilier, M Thomas MARECHAL, représentant de l'organisme de formation ci-dessus désigné, atteste que : </small><br>
                            <h2><b>M/Mme {{ $attestation->user->name }} {{ $attestation->user->lastname }}</b></h2>
                            <small>a suivi via notre plateforme de formation e-learning, la formation intitulé : </small><br>
                            <h3><b>Formation Loi Alur,</b></h3>
                            <small>soit une durrée totale de {{ $attestation->done }} heures effectuées du {{$attestation->start}} au {{$attestation->end}}</small><br>
                            <small>Cette formation comprenant les modules suivants :</small><br>
                            <ul>
                                @foreach($attestation->allFormations as $formation)
                                <li>Module <b>{{ $formation->title }}</b> : {{ ($formation->duration) }}</li>
                                @endforeach
                            </ul>
                            <small>Cette formation ayant pour objectifs</small><br>
                            <div><b>La validation et l'approfondissement des connaissances et des compétences en matière d'immobilier</b><br>
                            M/Mme {{ $attestation->user->name }} {{ $attestation->user->lastname }} a satisfait avec succès aux épreuves d'évaluation organisées à l'issue de la formation.
                            </div>
                            <div class="signature-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <h3>L'organisme MAPIM formation</h3>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="padding-top : 100px;">
                                                    <p>Fait pour valoir de ce droit, à Dourges,</p>
                                                    <p>Le {{ $attestation->end }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <h3>Le stagiaire</h3>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>



                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<!--

Centre de formation spécialisé Loi Alur
98 rue Pierre de Roussard - 62119 DOURGES
09 77 89 33 27
formation@mapim-immo.fr
www.mapim-formation.com

Déclarartion d'activité enregistrée sous le numéro de céclaration 00 00 00000 00
au près du Préfet des Hauts de France.

ATTESTATION DE FORMATION IMMOBILIER
has earned PD175: 1.0 Credit Hours
while completing the training course entitled
BPS PGS Initial PLO for Principals at Cluster Meetings
Buffalo City School District Crystal Benton Instructional Specialist II, Staff Development
Date Completed DOB: Social Security # (last 4 digits)
-->
</html>
