	<div id="app-loader" class="active">
		<div class="d-flex align-items-center justify-content-center h-100">
			<div class="cont">
				<div class="sk-cube-grid">
					<div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div>
				</div>
				<p>Cargando...</p>
			</div>
		</div>
	</div>

	<script src="{{ mix('/js/app.js') }}"></script>

	{{-- @if( config('app.debug') )
		{{ dd( DB::getQueryLog() ) }}
	@endif --}}
</body>
</html>