<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi de temps</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>

        body {
            background-color: #f0f4f8;
            font-family: 'Roboto', sans-serif;
        }
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #0056b3;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e0e0e0;
        }
        .btn-generate {
            margin: 20px auto;
            display: block;
            width: 200px;
            background-color: #28a745;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-generate:hover {
            background-color: #218838;
        }
        .form-group {
            margin-bottom: 20px; /* Espacement entre les groupes de formulaire */
        }
    </style>
</head>
<header class="p-4">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>
</header>
<body>
<h1><u>Emploi de temps</u></h1>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Filtrage par semestre -->
            <div class="form-group">
                <label for="semestreSelect">Choisir un semestre</label>
                <select id="semestreSelect" class="form-control">
                    <option value="">Sélectionnez un semestre</option>
                    @foreach ($semestres as $semestre)
                    <option value="{{ route('test.index', ['semestre' => $semestre->num]) }}">
                        Semestre {{ $semestre->num }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Filtrage par enseignant -->
            <div class="form-group">
                <label for="enseignantFilter">Filtrer par enseignant :</label>
                <select id="enseignantFilter" class="form-control">
                    <option value="">Tous les enseignants</option>
                    @foreach ($enseignants->sortBy('nom') as $enseignant)
                    <option value="{{ $enseignant->nom }}">{{ $enseignant->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <table id="timetable">
        <thead>
        <tr>
            <th>Libellé</th>
            <th>Volume Horaire</th>
            <th>Module</th>
            <th>Enseignant</th>
            <th>Groupe</th>
            <th>Salle</th>
            <th>Jour</th>
            <th>Période</th>
        </tr>
        </thead>
        <tbody id="timetable-body">
        @foreach ($elements->sortBy('module.libelle') as $element)
        <tr data-jour="{{ $element->jour }}">
            <td>{{ $element->libelle }}</td>
            <td>{{ $element->volumeHoraire }}</td>
            <td>{{ $element->module->libelle }}</td>
            <td>{{ $element->enseignant->nom }}</td>
            <td>{{ $element->module->classe->libelle }}</td>
            <td>{{ $element->salle->numSalle }}</td>
            <td>
                @switch($element->jour)
                @case(1) Lundi @break
                @case(2) Mardi @break
                @case(3) Mercredi @break
                @case(4) Jeudi @break
                @case(5) Vendredi @break
                @case(6) Samedi @break
                @case(7) Dimanche @break
                @default Inconnu
                @endswitch
            </td>
            <td>{{ $element->periode }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <button class="btn btn-success btn-generate" onclick="generatePDF()">Générer PDF</button>
</div>

<script>
    document.getElementById('enseignantFilter').addEventListener('change', function() {
        var selectedValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#timetable tbody tr');

        rows.forEach(function(row) {
            var enseignantCell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            if (selectedValue === "" || enseignantCell.includes(selectedValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    function sortTable() {
        const tableBody = document.getElementById('timetable-body');
        const rows = Array.from(tableBody.querySelectorAll('tr'));

        rows.sort((a, b) => {
            const dayA = parseInt(a.getAttribute('data-jour'));
            const dayB = parseInt(b.getAttribute('data-jour'));
            return dayA - dayB; // Sort by day (1 to 7)
        });

        // Append sorted rows back to the table body
        rows.forEach(row => tableBody.appendChild(row));
    }

    // Call sortTable to sort rows when the page loads
    window.onload = sortTable;

    async function generatePDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('landscape', 'pt', 'a4');
        doc.setFontSize(20);
        doc.text("Emploi de temps", 20, 60);

        doc.autoTable({
            html: '#timetable',
            startY: 80,
            styles: {
                cellPadding: 5,
                fontSize: 12,
                overflow: 'linebreak',
                columnWidth: 'auto',
            },
            headStyles: {
                fillColor: '#0056b3',
                textColor: '#ffffff',
            },
            alternateRowStyles: {
                fillColor: '#f2f2f2',
            },
        });

        doc.save('emploi_de_temps.pdf');
    }

    document.getElementById('semestreSelect').addEventListener('change', function() {
        var selectedUrl = this.value;
        if (selectedUrl) {
            window.location.href = selectedUrl;  // Rediriger vers l'URL sélectionnée
        }
    });
</script>

</body>
</html>
