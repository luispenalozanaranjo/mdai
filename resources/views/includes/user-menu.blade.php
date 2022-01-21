<div id="user-menu">
	<div class="row align-items-center">
		<div class="col col-sm-2">
			<div class="main-logo">
				<a href="{{ route('dashboard') }}" class="d-inline-block">
					<figure>
						<img src="{{ URL::asset('images/logo-mda.png') }}" alt="MDAI" width="120">
					</figure>
				</a>
			</div>
		</div>
		<div class="col-7 d-none d-sm-block text-center">
			<mdai-datenow></mdai-datenow>
		</div>
		<div class="col col-sm-3">
			<div class="d-flex justify-content-end align-items-center items-hold">
				<mdai-notifications :user="{{ json_encode(Auth::user()->getInfo()) }}"></mdai-notifications>
				<mdai-profile v-if="!isMobileViewport" :user="{{ json_encode(Auth::user()->getInfo()) }}"></mdai-profile>
			</div>
		</div>
	</div>
</div>