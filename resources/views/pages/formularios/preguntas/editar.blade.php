@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6">
                <h1 class="heading-1 text-normal">{{ $title }}</h1>
            </div>
            <div class="col-12 col-sm-6">
                <div class="btn-holder d-flex align-items-center justify-content-end">
                    <a href="{{ route('checklists.detalle', $checklist->id) }}" class="text-link">
                        <span class="fa fa-chevron-left mr-4"></span>
                        Volver atrás
                    </a>
                </div>
            </div>
        </div>
	</div>

    <mdai-checklist-pregunta-editar :checklist="{{ json_encode($checklist) }}" :pregunta="{{ json_encode($pregunta) }}" />
@endsection