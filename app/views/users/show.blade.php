@extends('layouts.master')

@section('title')
@parent
:: Profil
@stop

@section('content')
<h1><strong>{{ $user->username }}</strong></h1>
<p><strong>{{ $user->role }}</strong></p>


<p><strong>Username:</strong> {{ $user->username }}</p>
<p><strong>Date de naissance:</strong> {{ $user->birthdate }}</p>
<p><strong>Date d'inscription:</strong> {{ $user->created_at }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>

<br>

<p><strong>Dernière connexion:</strong> {{ $user->updated_at }}</p>


<br><br>


@stop