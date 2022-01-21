export default {
	state: {
		modalTerminar: false,
		action: {
			status: false,
			text: null,
		},
		toast: {
			status: false,
			text: null,
			icon: null,
			time: 300
		}
	},
	getters: {
		terminarStatus: function(state){
			return state.modalTerminar;
		},
		actionStatus: function(state){
			return state.action.status;
		},
		actionText: function(state){
			return state.action.text;
		},
		toast: function(state){
			return state.toast;
		}
	},
	mutations: {
		toggleTerminar: function(state){
			state.modalTerminar = !state.modalTerminar;
		},
		toggleAction: function(state){
			state.action.status = !state.action.status;
		},
		addActionText: function(state, val){
			state.action.text = val;
		},
		enableToast: function(state, data){
			state.toast.text = data.text;
			state.toast.type = data.type ? data.type : 'success';

			setTimeout(() => {
				state.toast.status = true;
			}, state.toast.time);
		},
		disableToast: function(state){
			state.toast.status = false;
		}
	}
}
