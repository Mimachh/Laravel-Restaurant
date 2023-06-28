@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Tableau de bord</h1>
    <p class="welcome-text">Bienvenue {{ userName() }} <span class="coucou">&#x1F44B;</span></p>
    <p>{{ getRolesName() }}</p>
@endsection