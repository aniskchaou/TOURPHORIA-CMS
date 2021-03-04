<template>
    <div :id="schema.model">
        <div class="ts-field-list-item">
            <div class="ts-list-item">
                <draggable v-model="value" @start="drag=true" @end="drag=false">
                    <div class="ts-item" v-for="(item,index) in value">
                        <div class="ts-item-handle">
                            <span class="ts-title">{{item.title}}</span>
                            <div class="ts-actions">
                                <span @click="toggleCurrent(index)" class="fa fa-pencil"></span>
                                <span class="fa fa-trash" @click="removeItem(index)"></span>
                            </div>
                        </div>
                        <div class="ts-item-content" v-show="currentItem==index">
                            <vue-form-generator :model="item" :schema="{fields:filterSchema(schema.settings, index)}"></vue-form-generator>
                        </div>
                    </div>
                </draggable>
            </div>
            <button class="button button-primary button-add-new" @click="addNew">{{i18n.addNew}}</button>
        </div>
    </div>
</template>
<script>
    import VueFormGenerator from "vue-form-generator";
    import { abstractField } from "vue-form-generator";
    import draggable from 'vuedraggable'
    export default {
        mixins: [ abstractField ],
        data(){
            return {
                currentItem:null,
                i18n:traveler_settings.i18n,
            }
        },
        created(){
            let app = this;
            setTimeout(function () {
                app.checkEnableField();
            }, 100);
        },
        computed:{
        },
        watch: {
            model:{
                handler: function (after, before) {
                    this.checkEnableField();
                },
                deep: true
            },
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
            filterSchema(settings,index){
                let schema=[];
                for(let c of settings)
                {
                    let item=Object.assign({},c);
                    if(item.type=='stUpload'){
                        item.customModel=item.model + '_' +index;
                    }
                    schema.push(item);
                }
                return schema;
            },
            removeItem(index){
                let c=confirm(this.i18n.confirmDelete);
                if(c)
                {
                    this.value.splice(index,1);
                    this.currentItem=null;
                }
            },
            toggleCurrent(index){
                if(this.currentItem==index) this.currentItem=null;
                else this.currentItem=index;
            },
            genSchema(){
                return {
                    fields:this.schema.settings
                }
            },
            addNew()
            {
                let length=this.value.length;
                this.value.push(this.getDefaults());
                this.currentItem=length+1;
            },
            getDefaults()
            {
                let s={};
                for(let c of this.schema.settings)
                {
                    s[c.model]='';
                }
                return s;
            }
        },
        components:{
            "vue-form-generator": VueFormGenerator.component,
            draggable
        }
    }
</script>
<style lang="scss">
    .draggable-placeholder-inner{
        border: 1px dashed #0088F8;
        box-sizing: border-box;
        background: rgba(0, 136, 249, 0.09);
        color: #0088f9;
        text-align: center;
        padding: 0;
        display: flex;
        align-items: center;
    }
</style>