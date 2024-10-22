@extends('layouts.moonshine')

@section('content')
<style>
    header {
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>
<!-- Header -->
<header class="  p-4">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <h3 > <u>Statistiques</u></h3>
    </div>
</header>

<!-- Main Content -->
<div class="container p-4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Statistics Row -->
    <div class="row text-center mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <i class="fas fa-building text-primary fa-3x mb-2"></i>
                    <h3 class="text-primary">{{ $departementsCount }}</h3>
                    <p class="text-muted">Départements</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher text-success fa-3x mb-2"></i>
                    <h3 class="text-success">{{ $enseignantsCount }}</h3>
                    <p class="text-muted">Enseignants </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row text-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <i class="fas fa-school text-info fa-3x mb-2"></i>
                    <h3 class="text-info">{{ $classesCount }}</h3>
                    <p class="text-muted">Groupes</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <i class="fas fa-door-open text-warning fa-3x mb-2"></i>
                    <h3 class="text-warning">{{ $sallesCount }}</h3>
                    <p class="text-muted">Salles</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
