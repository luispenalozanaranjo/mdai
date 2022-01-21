<template>
    <div class="support" :class="theme">
        <div class="d-flex align-items-center">
            <span class="fa mr-16" :class="getIcon"></span>
            <div class="support-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        theme: { type: String, default: 'info' }
    },
    data: function(){
        return {};
    },
    computed: {
        getIcon: function(){
            switch(this.theme){
                case 'success':
                    return 'fa-check-circle';
                case 'error':
                case 'warning':
                    return 'fa-exclamation-circle';
                case 'info':
                    return 'fa-info-circle';
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .support{
        padding:12px 16px;
        width:100%;
        border-radius: 6px;
        border:1px solid transparent;

        [class*="heading-"]{
            margin-bottom:4px;
            color:#555;
        }

        .fa{
            font-size: 24px;
        }

        &.success{
            .fa{color:#5c9961}
            background-color:#e0f1e1;
            border-color:#cce9cf;
        }

        &.warning{
            .fa{color:#e7c03d}
            background-color:#fbf3d5;
            border-color:#f1e5bc;
        }
        
        &.info{
            .fa{color:#2e8d93}
            background-color:#e1eff3;
            border-color:#cbe1e4;
        }

        &.error{
            .fa{color:$color-primary;}
            background-color:#fde6e6;
            border-color:#fcd5d5;
        }
    }
</style>