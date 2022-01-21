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
                    <a href="{{ route('checklists.home') }}" class="text-link mr-32">
                        <span class="fa fa-chevron-left mr-4"></span>
                        Volver atrás
                    </a>
                    <a href="{{ route('checklists.editar', $checklist->id) }}" class="btn btn-action btn-primary">Editar checklist</a>
                </div>
            </div>
        </div>
	</div>

    <mdai-checklist-detalle :checklist="{{ json_encode($checklist) }}" :nodo="{{ json_encode($nodo) }}" />
@endsection