<template>
    <div :id="schema.model">
        <v-select label="name" :filterable="false" :options="options" @search="onSearch" v-on="onChange()" v-model="selected">
            <template slot="no-options">
                {{ typingText }}
            </template>
            <template slot="option" slot-scope="option">
                <div class="d-center" v-html="option.name"></div>
            </template>
            <template slot="selected-option" slot-scope="option">
                <div class="selected d-center" v-html="option.name"></div>
            </template>
        </v-select>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";
    import vSelect from 'vue-select';
    import API from '../api';

    export default {
        props: ['schema'],
        data(){
            return {
                typingText: traveler_settings.i18n.typing,
                options: [],
                selected: {id: this.value, name: this.schema.sld},
            }
        },
        created() {
            let app = this;
            setTimeout(function () {
                app.checkEnableField();
            }, 100);
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
            },
            onSearch(search, loading) {
                loading(true);
                let app=this;
                API.postSelectAjax(search, this.schema.post_type, this.schema.sparam).then(function (rs) {
                    let body=rs.data;
                    app.options=body.rows;
                    loading(false);
                })
            },
            onChange(){
                if (this.selected !== null) {
                    this.value = this.selected.id;
                }else{
                    this.value = '';
                }
            },
        },
        components:{
            "v-select": vSelect,
        },
        watch: {
            model:{
                handler: function (after, before) {
                    this.checkEnableField();
                },
                deep: true
            },
        },
        mixins: [ abstractField ],
    };
</script>