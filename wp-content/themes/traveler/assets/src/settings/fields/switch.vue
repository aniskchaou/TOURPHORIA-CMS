<!-- fieldAwesome.vue -->
<template>
    <div :id="schema.model">
        <div class="switch-button-control">
            <div class="switch-button" :class="{ enabled: isEnabled }" @click="toggle">
                <div class="button"></div>
            </div>
            <div class="switch-button-label">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data(){
            return {
                isEnabled: false,
                color: {
                    type: String,
                    required: false,
                    default: "#4D4D4D"
                }
            }
        },
        created() {
            if(this.value == 'on'){
                this.isEnabled = true;
            }else{
                this.isEnabled = false;
            }
            let app = this;
            setTimeout(function () {
                app.checkEnableField();
            }, 100);
        },
        methods:{
            toggle: function() {
                if(this.isEnabled){
                    this.isEnabled = false;
                    this.value = 'off';
                }else{
                    this.isEnabled = true;
                    this.value = 'on';
                }
            },
            checkEnableField(){
                let condition = this.schema.condition;
                if(typeof condition != 'undefined' && condition != ''){
                    let arr_cond = condition.split(',');
                    if(arr_cond.length){
                        let c = 0;
                        for(let i = 0; i< arr_cond.length; i++){
                            let arr_sub = arr_cond[i].split(':is');
                            if(typeof this.schema.model != 'undefined' && this.schema.model != null) {
                                if ('(' + this.model[arr_sub[0]] + ')' != arr_sub[1]) {
                                    c++;
                                }
                            }
                        }

                        let cComp = document.getElementById(this.schema.model);
                        if(cComp != null) {
                            if (c > 0) {
                                cComp.parentNode.parentNode.classList.add("st-admin-hidden");
                            } else {
                                cComp.parentNode.parentNode.classList.remove("st-admin-hidden");
                            }
                        }
                    }
                }
            }
        },
        watch: {
            model:{
                handler: function (after, before) {
                    this.checkEnableField();
                },
                deep: true
            },
        }
    };
</script>
<style lang="scss">
    // For switch-button styling
    // For switch-button styling
    .switch-button-control {
        display: flex;
        flex-direction: row;
        align-items: center;

        .switch-button {
            $switch-button-height: 27px;
            $switch-button-color: #E1B42B;
            $switch-button-border-thickness: 1px;
            $switch-transition: all 0.3s ease-in-out;
            $switch-is-rounded: true;

            height: 30px;
            width: 80px;
            border-radius: 40px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            position: relative;
            background: #eceeef;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);

            .button {
                height: 22px;
                width: 22px;
                background:  $switch-button-color;
                transition: all 0.3s ease-in-out;
                margin-left: 4px;
                margin-top: 3.5px;
                border: none;
                background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
                background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
                border-radius: 100%;
                box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
                position: relative;
                &:after{
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    margin: -6px 0 0 -6px;
                    width: 12px;
                    height: 12px;
                    background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
                    background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
                    border-radius: 6px;
                    box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
                }
            }

            &:before{
                position: absolute;
                content: 'ON';
                font-weight: 600;
                color: #fff;
                display: none;
                top: 6px;
                left: 9px;
                font-size: 11px;
                transition: all 0.3s ease-in-out;
            }
            &:after{
                position: absolute;
                content: 'OFF';
                font-weight: 600;
                top: 6px;
                right: 9px;
                color: #666;
                font-size: 11px;
                display: inline-block;
                transition: all 0.3s ease-in-out;
            }

            &.enabled {
                background-color: $switch-button-color;
                box-shadow: none;

                .button {
                    background: white;
                    transform: translateX(calc(calc( 36px - (2 * -6px)) + (2 *1px)));
                }

                &:before{
                    display: inline-block;
                }

                &:after{
                    display: none;
                }
            }

        }

        .switch-button-label {
            margin-left: 10px;
        }
    }

</style>