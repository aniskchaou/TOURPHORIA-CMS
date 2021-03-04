<template>
    <div :id="schema.model">
        <select v-model="value" class="form-control">
            <option :value="item.value" :selected="(item.value === value)" v-for="(item,index) in schema.choices">{{item.label}}</option>
        </select>
        <div class="hint" v-html="hintHtml"></div>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data(){
            return {
                hintHtml: ""
            }
        },
        created(){
            let app = this;
            setTimeout(function () {
                app.checkEnableField();
            }, 100);

            if(this.value == "") {
                if (this.schema.std != null) {
                    this.value = this.schema.std;
                }
            }
            if(this.schema.v_hint == 'yes'){
                this.hintHtml = this.schema.desc;
            }
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