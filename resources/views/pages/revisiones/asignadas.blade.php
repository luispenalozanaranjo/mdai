@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-30">
		<h1 class="heading-1 text-normal">Revisiones asignadas</h1>
		<p>2 revisiones asignadas en total.</p>
	</div>

	<div class="table">
		<table>
			<thead>
				<tr>
					<th>RUT</th>
					<th>Estado</th>
					<th>Fecha entrada</th>
					<th>Usuario encargado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>11.111.111-1</td>
					<td>Promesado</td>
					<td>28-09-2019 10:47</td>
					<td>John Doe</td>
					<td>
						<div class="row-actions">
							<a href="#"><span class="fa fa-eye"></span></a>
						</div>
					</td>
				</tr>
				<tr>
					<td>11.111.111-1</td>
					<td>Promesado</td>
					<td>28-09-2019 10:47</td>
					<td>John Doe</td>
					<td>
						<div class="row-actions">
							<a href="#"><span class="fa fa-eye"></span></a>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection