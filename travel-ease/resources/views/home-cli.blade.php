@extends('layout')
@section('principal')
    <h1>Bem vindo cliente! {{Auth::user()->name}} </h1>
@endsection