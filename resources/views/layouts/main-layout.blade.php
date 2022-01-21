@include('includes.head')
@routes

<div id="app" v-cloak>
	@include('includes.header')

	<main>
		<div class="wrapper">
			<transition name="fade">
				<mdai-action-loader v-if="$store.getters.actionStatus" :text="$store.getters.actionText"></mdai-action-loader>
			</transition>

			<div class="h-100 d-flex">
				<mdai-main-menu :menu="{{ json_encode( $user_menu ?? '' ) }}" logo="{{ URL::asset('images/logo-mda-alt.png') }}"></mdai-main-menu>

				<div class="main-content w-100 px-16 pb-16 pl-sm-92 pr-sm-32 pt-80 pt-sm-92 pb-sm-32">
					@yield('main-content')
				</div>
			</div>

			<transition name="fade">
				<mdai-toast v-if="$store.getters.toast.status" :type="$store.getters.toast.type" :text="$store.getters.toast.text" />
			</transition>
		</div>
	</main>
</div>

@include('includes.footer-clean')