@include('includes.head')
@routes

<div id="app">
    @include('includes.header')
    
    <main>
        <div class="wrapper">
            <transition name="fade">
                <mdai-action-loader v-if="$store.getters.actionStatus" :text="$store.getters.actionText" />
            </transition>

            @yield('main-content')

            <transition name="fade">
                <mdai-toast v-if="$store.getters.toast.status" :type="$store.getters.toast.type" :text="$store.getters.toast.text" />
            </transition>
        </div>
    </main>
</div>

@include('includes.footer-clean')