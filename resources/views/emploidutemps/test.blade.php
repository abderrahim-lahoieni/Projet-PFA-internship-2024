<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du Temps</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
    <style>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ac2828;
        }
        .session {
            border-left: 2px solid #000;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #8e3535;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        td[rowspan] {
            background-color: #e2e2e2;
            font-weight: bold;
            text-align: center;
        }
        td {
            background-color: #ffffff;
            height: 60px;
            width: 70px;
        }
        table caption {
            font-size: 1.5em;
            margin: 10px 0;
            font-weight: bold;
        }
        @if (!$IsPdf)
        .containeer {
    width: 100%;
    height: 110vw;
     /* Évite le dépassement de la largeur de l'écran */
    overflow: hidden;
    transform: rotate(0deg);
}
@else
.containeer {
    width: 100%;
    height: 100vw; /* Évite le dépassement de la largeur de l'écran */
    overflow: hidden;
    transform: rotate(0deg);
}
td{
    font-size: 30px;
}
th{
    font-size: 50px;
}
@endif
.salle {
    text-align: center;
}
.seance {
    margin-left: 5px;
}
tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:nth-child(7n) {
            border-bottom: 4px solid #000; /* Séparation après chaque deux lignes */
        }
        .fin {
    border-right: 4px solid #05972c; /* Définit une bordure droite épaisse noire */
}

    span {
        font-size: 3em;           /* Taille de la police */
    text-align: center;       /* Centrer le titre */
    font-weight: bold;        /* Mettre en gras */
    color: #2c3e50;           /* Couleur du texte */
    margin-top: 1px;         /* Marge en haut */
    text-transform: uppercase;/* Transformer en majuscule */
    display: flex;
    justify-content: center;
    }
    @if (!$IsPdf)
    .logo{
        height:100px;
        weight : 60px;
    }
    @endif
    </style>
</head>
<body>
    <header>
        <div class="align-items-center">

            @if (!$IsPdf)
            <img src="{{ asset('logo-web.png') }}" alt="Logo" class="logo">
            @foreach (range(1, 5) as $j)
            @if($semestre == $j*2 || $semestre == $j*2-1)
                @if($j ==1)
                    <span>1ère année - Semestre {{$semestre}}</span>
                    @break
                @else
                    <span> {{$j}}ème année - Semestre {{$semestre}}</span>
                    @break
                @endif
            @endif
            @endforeach
            <a href="javascript:history.back()" class="btn btn-secondary ">
    <i class=" fas fa-arrow-left"></i> Retour
</a>
            @else
            <img src="{{ public_path('logo-web.png') }}" alt="Logo" class="logo">
            @foreach (range(1, 5) as $j)
            @if($semestre == $j*2 || $semestre == $j*2-1)
                @if($j ==1)
                    <span> 1ère année - Semestre {{$semestre}}</span>
                    @break
                @else
                    <span>{{$j}}ème année - Semestre {{$semestre}}</span>
                    @break
                @endif
            @endif
            @endforeach
            @endif

        </div>
    </header>

    <div  class="containeer">
    <table id="emploi-du-temps" >
        <thead>
            <tr>
                <th rowspan="2">Jour</th>
                <th rowspan="2">Gr</th>
                <th colspan="4" class="seance">Séance 1</th>
                <th colspan="4" class="seance">Séance 2</th>
                <th colspan="4" class="seance">Séance 3</th>
                <th colspan="4" class="seance">Séance 4</th>
            </tr>
            <tr>
                <th>Début</th>
                <th>Module</th>
                <th>Salle</th>
                <th class="fin">Fin</th>
                <th>Début</th>
                <th>Module</th>
                <th>Salle</th>
                <th class="fin">Fin</th>
                <th>Début</th>
                <th>Module</th>
                <th>Salle</th>
                <th class="fin">Fin</th>
                <th>Début</th>
                <th>Module</th>
                <th>Salle</th>
                <th>Fin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
    <td rowspan="7">Lundi</td>
    @foreach (range(1, 6) as $i)
<tr>
    @if ($semestre ==8 ||$semestre ==9)
                    <td >{{ $gr[$i-1] }}</td>
                    @else
                    <td >Gr{{ $i }}</td>
                    @endif
@foreach ($emploiDuTemps as $jour => $groupes)

    @foreach ($groupes as $groupe => $heures)
        @if ($jour == 'Lundi' && $groupe == $gr[$i-1])
            @foreach ($heures as $heure => $module)
            @if (!$pr[$jour][$groupe][$heure] =='')
                <td>{{  explode('-', $pr[$jour][$groupe][$heure])[0] }}</td>
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]>1 && (($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="{{$compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]}}"> {{$module}} <br>{{$profs[$jour][$groupe][$heure]}}</td>
                @php
                    $compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour] ='1';
                @endphp
                @else
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]===1 || !(($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="">{{ $module}}<br>{{$profs[$jour][$groupe][$heure]}}</td>
                @endif
                @endif
                <td class="salle">{{ $salles[$jour][$groupe][$heure]}}</td>
                <td class="fin">{{  explode('-', $pr[$jour][$groupe][$heure])[1] }}</td>

                @else
                <td>{{$heure}}h30</td>
                <td> </td>
                <td> </td>
                <td class="fin"> {{(float) $heure+2}}h </td>
                @endif
            @endforeach
        @endif
    @endforeach

@endforeach
</tr>
@endforeach
</tr>
<tr>
    <td rowspan="7">Mardi</td>
    @foreach (range(1, 6) as $i)
<tr>
    @if ($semestre ==8 ||$semestre ==9)
                    <td >{{ $gr[$i-1] }}</td>
                    @else
                    <td >Gr{{ $i }}</td>
                    @endif
@foreach ($emploiDuTemps as $jour => $groupes)

    @foreach ($groupes as $groupe => $heures)
        @if ($jour == 'Mardi' && $groupe == $gr[$i-1])
            @foreach ($heures as $heure => $module)
            @if (!$pr[$jour][$groupe][$heure] =='')
                <td>{{  explode('-', $pr[$jour][$groupe][$heure])[0] }}</td>
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]>1 && (($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="{{$compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]}}"> {{$module}} <br>{{$profs[$jour][$groupe][$heure]}}</td>
                @php
                    $compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour] ='1';
                @endphp
                @else
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]===1 || !(($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="">{{ $module}}<br>{{$profs[$jour][$groupe][$heure]}}</td>
                @endif
                @endif
                <td class="salle">{{ $salles[$jour][$groupe][$heure]}}</td>
                <td class="fin">{{  explode('-', $pr[$jour][$groupe][$heure])[1] }}</td>

                @else
                <td>{{$heure}}h30</td>
                <td> </td>
                <td> </td>
                <td class="fin"> {{(float) $heure+2}}h </td>
                @endif
            @endforeach
        @endif
    @endforeach

@endforeach
</tr>
@endforeach
</tr>
<tr>
    <td rowspan="7">Mercredi</td>
    @foreach (range(1, 6) as $i)
<tr>
    @if ($semestre ==8 ||$semestre ==9)
                    <td >{{ $gr[$i-1] }}</td>
                    @else
                    <td >Gr{{ $i }}</td>
                    @endif
@foreach ($emploiDuTemps as $jour => $groupes)

    @foreach ($groupes as $groupe => $heures)
        @if ($jour == 'Mercredi' && $groupe == $gr[$i-1])
            @foreach ($heures as $heure => $module)
            @if (!$pr[$jour][$groupe][$heure] =='')
                <td>{{  explode('-', $pr[$jour][$groupe][$heure])[0] }}</td>
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]>1 && (($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="{{$compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]}}"> {{$module}} <br>{{$profs[$jour][$groupe][$heure]}}</td>
                @php
                    $compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour] ='1';
                @endphp
                @else
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]===1 || !(($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="">{{ $module}}<br>{{$profs[$jour][$groupe][$heure]}}</td>
                @endif
                @endif
                <td class="salle">{{ $salles[$jour][$groupe][$heure]}}</td>
                <td class="fin">{{  explode('-', $pr[$jour][$groupe][$heure])[1] }}</td>

                @else
                <td>{{$heure}}h30</td>
                <td> </td>
                <td> </td>
                <td class="fin"> {{(float) $heure+2}}h </td>
                @endif
            @endforeach
        @endif
    @endforeach

@endforeach
</tr>
@endforeach
</tr>
<tr>
    <td rowspan="7">Jeudi</td>
    @foreach (range(1, 6) as $i)
<tr>
    @if ($semestre ==8 ||$semestre ==9)
                    <td >{{ $gr[$i-1] }}</td>
                    @else
                    <td >Gr{{ $i }}</td>
                    @endif
@foreach ($emploiDuTemps as $jour => $groupes)

    @foreach ($groupes as $groupe => $heures)
        @if ($jour == 'Jeudi' && $groupe == $gr[$i-1])
            @foreach ($heures as $heure => $module)
            @if (!$pr[$jour][$groupe][$heure] =='')
                <td>{{  explode('-', $pr[$jour][$groupe][$heure])[0] }}</td>
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]>1 && (($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="{{$compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]}}"> {{$module}} <br>{{$profs[$jour][$groupe][$heure]}}</td>
                @php
                    $compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour] ='1';
                @endphp
                @else
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]===1 || !(($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="">{{ $module}}<br>{{$profs[$jour][$groupe][$heure]}}</td>
                @endif
                @endif
                <td class="salle">{{ $salles[$jour][$groupe][$heure]}}</td>
                <td class="fin">{{  explode('-', $pr[$jour][$groupe][$heure])[1] }}</td>

                @else
                <td>{{$heure}}h30</td>
                <td> </td>
                <td> </td>
                <td class="fin"> {{(float) $heure+2}}h </td>
                @endif
            @endforeach
        @endif
    @endforeach

@endforeach
</tr>
@endforeach
</tr>
<tr>
    <td rowspan="7">Vendredi</td>
    @foreach (range(1, 6) as $i)
<tr>
    @if ($semestre ==8 ||$semestre ==9)
                    <td >{{ $gr[$i-1] }}</td>
                    @else
                    <td >Gr{{ $i }}</td>
                    @endif
@foreach ($emploiDuTemps as $jour => $groupes)

    @foreach ($groupes as $groupe => $heures)
        @if ($jour == 'Vendredi' && $groupe == $gr[$i-1])
            @foreach ($heures as $heure => $module)
            @if (!$pr[$jour][$groupe][$heure] =='')
                <td>{{  explode('-', $pr[$jour][$groupe][$heure])[0] }}</td>
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]>1 && (($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="{{$compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]}}"> {{$module}} <br>{{$profs[$jour][$groupe][$heure]}}</td>
                @php
                    $compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour] ='1';
                @endphp
                @else
                @if ($compteur[$module.'+'.$profs[$jour][$groupe][$heure].'+'.$pr[$jour][$groupe][$heure].'+'.$jour]===1 || !(($i!=6 && $module == $emploiDuTemps[$jour][$gr[$i]][$heure])||($i!=1 && $module == $emploiDuTemps[$jour][$gr[$i-2]][$heure]) ))
                <td rowspan="">{{ $module}}<br>{{$profs[$jour][$groupe][$heure]}}</td>
                @endif
                @endif
                <td class="salle">{{ $salles[$jour][$groupe][$heure]}}</td>
                <td class="fin">{{  explode('-', $pr[$jour][$groupe][$heure])[1] }}</td>

                @else
                <td>{{$heure}}h30</td>
                <td> </td>
                <td> </td>
                <td class="fin"> {{(float) $heure+2}}h </td>
                @endif
            @endforeach
        @endif
    @endforeach

@endforeach
</tr>
@endforeach
</tr>
        </tbody>
    </table>
    </div>
    @if (!$IsPdf)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Bouton avec icône de téléchargement -->
<a href="/pdf?semestre={{ $semestre }}" class="btn btn-primary">
    <i class="fas fa-download"></i> Télécharger
</a>
    @endif

</body>
</html>
