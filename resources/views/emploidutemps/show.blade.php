<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edt de Mr/Mme {{ $enseignant->nom }} </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
    <link rel="icon" href="https://zbakhinfo.odoo.com/web/image/446-9257b9e4/logo_encgt.JPG" type="image/jpeg">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        /* Updated Header Style */
        .header {
            background-color: #2c3e50; /* Darker, more professional background */
            color: white;
            padding: 15px 30px; /* Adjusted padding for better balance */
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        /* Updated h1 Style */
        h1 {
            margin: 0;
            font-weight: 600; /* Bolder, for a stronger heading presence */
            font-size: 26px;  /* Slightly larger for clarity */
            letter-spacing: 1px; /* Adds spacing between letters for a sleek look */
        }

        /* Navbar styling for potential future use */
        .navbar {
            display: flex;
            align-items: center;
            gap: 15px; /* Adds spacing between potential nav items */
        }

        /* Updated Logout Button Style */
        .logout-btn {
            background-color: #e74c3c; /* Red for prominence (logout action) */
            color: white;
            padding: 10px 20px; /* More padding for a comfortable, clickable area */
            border-radius: 30px; /* Rounded for modern look */
            font-weight: 500; /* Slightly bolder font for better visibility */
            border: none;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s; /* Smooth hover effect */
        }

        /* Hover Effect for Logout Button */
        .logout-btn:hover {
            background-color: #c0392b; /* Darker red on hover */
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
            transform: translateY(-2px); /* Slight upward movement on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e0e0e0;
        }
        .pdf-icon {
            margin-left: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>
<header>
    <div class="header">
        <h1 class="fas fa-chalkboard-teacher">{{ $enseignant->nom }} {{ $enseignant->prenom }}</h1>
        <nav class="navbar">
            <button onclick="window.location.href='/admin/logout'" class="logout-btn">Logout</button>
        </nav>
    </div>
</header>

<div class="container">
    <!-- Emploi du temps table -->
    <table id="timetable" class="table table-bordered">
        <thead>
        <tr>
            <th>Module</th>
            <th>Groupe</th>
            <th>Salle</th>
            <th>Jour</th>
            <th>Période</th>
        </tr>
        </thead>
        <tbody id="timetable-body">
        @foreach ($elements as $element)
        <tr>
            <td>{{ $element->module->libelle }}</td>
            <td>{{ $element->module->classe->libelle }}</td>
            <td>{{ $element->salle->numSalle }}</td>
            <td>{{ $element->jour }}</td>
            <td>{{ $element->periode }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Include Bootstrap and Font Awesome for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="container mt-5">
        <h3 class="mb-4">Liste des étudiants par classe :</h3>
        @foreach($enseignant->classes as $classe)
        <!-- Class label and icons -->
        <div class="class-header d-flex justify-content-between align-items-center mb-2">
            <div>
                <i class="fas fa-users"></i> <!-- Class icon -->
                <span class="class-name" onclick="toggleStudentList('classe-{{ $classe->id }}')" style="cursor:pointer;">
                    {{ $classe->libelle }}
                </span>
            </div>
            <div>
            <i class="fas fa-file-import text-success" style="cursor:pointer;"
               onclick="importCSV('classe-{{ $classe->id }}')" title="Importer CSV"></i>
            <!-- Download icon for PDF -->
            <i class="fas fa-download text-primary" style="cursor:pointer;"
               onclick="generateClassPDF('table-classe-{{ $classe->id }}', '{{ $classe->libelle }}')" title="Télécharger PDF"></i>
            </div>
        </div>

        <!-- Liste des étudiants, hidden initially -->
        <div id="classe-{{ $classe->id }}" class="student-list" style="display:none;">
            <table id="table-classe-{{ $classe->id }}" class="table table-striped table-hover">
                <thead class="thead-blue">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @if($classe->etudiants->isNotEmpty())
                @foreach($classe->etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->email }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3" class="text-center text-muted">Aucun étudiant trouvé pour cette classe.</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
        @endforeach
    </div>

    <script>
        // Function to toggle the visibility of student lists
        function toggleStudentList(id) {
            const studentList = document.getElementById(id);
            studentList.style.display = (studentList.style.display === 'none' || studentList.style.display === '') ? 'block' : 'none';
        }
        async function generateClassPDF(tableId, className) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('portrait', 'pt', 'a4');
        doc.setFontSize(16);
        doc.text(`Liste des étudiants pour la classe ${className}`, 40, 50);

        doc.autoTable({
            html: `#${tableId}`,
            startY: 70,
            styles: { cellPadding: 5, fontSize: 12, overflow: 'linebreak', columnWidth: 'auto' },
            headStyles: { fillColor: '#007bff', textColor: '#ffffff' },
            alternateRowStyles: { fillColor: '#f2f2f2' },
        });

        doc.save(`Liste_Etudiants_${className}.pdf`);
    }
        function importCSV(tableId) {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = '.csv';
            input.onchange = e => {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = event => {
                    const csvData = event.target.result;
                    // Convertir les données CSV en objet JSON
                    const rows = csvData.split('\n').slice(1); // Ignore la première ligne (en-têtes)
                    const data = rows.map(row => {
                        const columns = row.split(',');
                        return {
                            id: columns[0],
                            nom: columns[1],
                            prenom: columns[2],
                            email: columns[3],
                            classe_id: columns[4]
                        };
                    });

                    // Envoyer les données à Laravel via une requête POST
                    fetch('/import-csv', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                alert('Importation réussie !');
                                location.reload(); // Recharger la page pour voir les nouvelles données
                            } else {
                                alert('Échec de l\'importation');
                            }
                        })
                        .catch(error => console.error('Erreur:', error));
                };
                reader.readAsText(file);
            };
            input.click();
        }

    </script>

</body>
</html>
