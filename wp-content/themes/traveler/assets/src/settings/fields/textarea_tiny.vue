<template>
    <div :id="schema.model">
        <vue-mce v-model="value" :config="config"></vue-mce>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";
    import { component } from 'vue-mce';

    export default {
        mixins: [ abstractField ],
        props: ['schema'],
        data(){
            return {
                config: {
                    height: 500,
                    inline: false,
                    theme: 'modern',
                    fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 34px 38px 42px 48px 54px 60px",
                    plugins: 'code visualblocks visualchars image link media table hr anchor insertdatetime textcolor colorpicker',
                    relative_urls : true,
                    remove_script_host : false,
                },
            }
        },
        created() {
            let app = this;
            setTimeout(function () {
                app.checkEnableField();
            }, 100);
        },
        components: {
            'vue-mce': component,
        },
        methods:{
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