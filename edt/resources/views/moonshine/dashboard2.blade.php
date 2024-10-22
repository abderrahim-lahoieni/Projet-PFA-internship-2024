@extends('layouts.moonshine')

@section('content')
<div class="p-4 text-bold">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <div>
         <h1>Bienvenue sur le tableau de bord !</h1>
     </div>
    <div class="mt-2 text-right">
        <!-- Indication icon -->
        <i class="fas fa-info-circle text-primary" id="infoIcon" style="cursor: pointer;"></i>
        <!-- Hidden indication text -->
            <i id="infoText" style="display: none;">Cliquez sur l'icône pour accéder aux statistiques ou à l'Emploi du Temps!</i>
    </div>
    <!-- Image Section -->
    <button onclick="redirectToRoute()" class="text-right mb-4">
        <img src="https://tse1.mm.bing.net/th?id=OIP.-bCcxHHq2hEhKs5ZqEEGYQHaHa&pid=Api&P=0&h=180" alt="Descriptive Alt Text" class="img-fluid" style="max-width: 100%; height: auto;">
    </button>
    <!-- Image Section -->
    <button onclick="redirectToTimetable()" class="text-left mb-4">
        <img src="https://tse3.mm.bing.net/th?id=OIP.RCKqtE5zL1cKLIgdPGkcaQHaHZ&pid=Api&P=0&h=180" alt="Descriptive Alt Text" class="img-fluid" style="max-width: 100%; height: auto;">
    </button>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var infoIcon = document.getElementById('infoIcon');
        var infoText = document.getElementById('infoText');
        if (infoIcon && infoText ) {
            infoIcon.addEventListener('click', function() {
                // Toggle visibility of the indication text
                if (infoText.style.display === 'none') {
                    infoText.style.display = 'block';
                } else {
                    infoText.style.display = 'none';
                }
                console.log("Icon clicked: Toggled visibility");
            });
        } else {
            console.error("Failed to find elements with IDs 'infoIcon' or 'infoText'");
        }
    });
    function redirectToRoute() {
        window.location.href = "{{ route('dashboard') }}";
    }

    function redirectToTimetable() {
        window.location.href = "{{ route('emploi-du-temps.index') }}"; // Adjust this route to your timetable route
    }
</script>
@endsection
