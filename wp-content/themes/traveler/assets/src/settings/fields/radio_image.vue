<template>
    <div :id="schema.model">
        <vue-select-image :dataImages="dataImages" w="900" v-model="value" :is-multiple="false"
                          @onselectimage="onSelectImage" :selectedImages="idSelected">
        </vue-select-image>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";
    import VueSelectImage from 'vue-select-image';

    export default {
        mixins: [ abstractField ],
        props: ['schema'],
        data(){
            return {
                dataImages: this.schema.choices,
                idSelected: []
            }
        },
        created(){
            this.idSelected.push(this.value);
            let app = this;
            setTimeout(function () {
                app.checkEnableField();
            }, 100);
        },
        methods:{
            onSelectImage: function (data) {
                this.idSelected = [];
                this.idSelected.push(data.id);
                this.value = data.id;
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
        components:{
            VueSelectImage
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