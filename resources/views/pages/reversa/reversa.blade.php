@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
<mdai-reversa :promesa="{{ json_encode($data->promesa) }}"
:etapas="{{ json_encode($data->etapas) }}"
></mdai-reversa>
@endsection