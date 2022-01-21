@include('includes.head')
@routes

<main id="app">
	<div class="wrapper">
		<transition name="fade">
			<mdai-action-loader v-if="$store.getters.actionStatus" :text="$store.getters.actionText"></mdai-action-loader>
		</transition>

		@yield('main-content')

		<transition name="fade">
			<mdai-toast
				v-if="$store.getters.toast.status"
				:type="$store.getters.toast.type"
				:text="$store.getters.toast.text"
			></mdai-toast>
		</transition>
	</div>
</main>

@include('includes.footer-clean')