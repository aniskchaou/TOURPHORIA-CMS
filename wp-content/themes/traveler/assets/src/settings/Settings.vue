<template>
    <div class="traveler-tab">
      <div class="sub-header">
          <span class="save-message" :class="'type-'+message.type" v-if="message.content">{{message.content}}</span>
          <button class="button button-primary" @click="saveSettings"> <i v-show="onSaving" class="fa fa-spinner fa-spin fa-fw"></i> {{i18n.saveChanges}}</button>
      </div>
        <vue-form-generator v-if="schema.fields"  :model="model" :schema="genSchema(schema.fields)"></vue-form-generator>
        <div class="sub-tabs" v-if="schema.tabs">
            <div class="sub-tabs-nav">
                <a @click="currentSubTab=subtab.id" v-for="(subtab,subIndex) in schema.tabs" :class="subtab.id==currentSubTab?'active':''" >{{subtab.title}}</a>
            </div>
            <div class="sub-tabs-content">
                <div class="sub-tab" v-show="subtab.id==currentSubTab" v-for="(subtab,subIndex) in schema.tabs">
                    <vue-form-generator v-if="subtab.fields"  :model="model" :schema="genSchema(subtab.fields)"></vue-form-generator>
                </div>
            </div>
        </div>
        <div v-if="!apiFinished" class="traveler-loading">
            <div class="loading-text">{{i18n.loading}}</div>
        </div>
    </div>
</template>
<script>
    import API from './api'
    import VueFormGenerator from "vue-form-generator";

    export default {
        data(){
            return {
                info:traveler_settings.info,
                i18n:traveler_settings.i18n,
                schema:{},
                currentSubTab:'general_tab',
                apiFinished:false,
                model:{},
                message:{
                  type:'',
                  content:''
                },
                onSaving:false
            }
        },
        created(){
            this.loadSchema(this.currentTab);
        },
        // when route changes and this component is already rendered,
        // the logic will be slightly different.
        beforeRouteUpdate (to, from, next) {
            this.message={
                type:'',
                content:''
            };
            next();
            this.loadSchema(this.currentTab);
        },
        computed:{
            currentTab(){
                return this.$route.params.id?this.$route.params.id:'option_general';
            }

        },
        methods:{

            saveSettings()
            {
                if(this.onSaving) return;

                let app=this;
                this.onSaving=true;
                this.message={
                    type:'',
                    content:''
                };
                API.saveSettings(this.model).then(function(rs){
                    let body=rs.data;
                    app.onSaving=false;

                    if(body.message)
                    {
                        app.message={
                            type:body.status?'success':'danger',
                            content:body.message
                        }
                    }
                }).catch(function () {
                    app.onSaving=false;
                    alert('Can not save theme settings');
                })
            },
            genSchema(fields){
                for(let i=0;i<fields.length;i++)
                {
                    if(fields[i].type=='spectrum')
                    {
                        fields[i]['colorOptions']={
                            showPalette:true,
                            palette: [
                                ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
                                ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
                                ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
                                ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
                                ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
                                ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
                                ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
                                ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
                            ]
                        };

                    }
                }
                return {
                    fields:fields
                }
            },
            loadSchema(tab)
            {
                let app=this;
                this.apiFinished=false;
                this.schema={};
                this.model={};
                API.getSchema(tab).then(function (rs) {
                    app.apiFinished=true;
                    let body=rs.data;
                    if(body.status)
                    {
                        app.schema=body.schema;
                        app.model=body.model;
                        if(body.schema.tabs.length){
                            app.currentSubTab=body.schema.tabs[0]['id'];
                        }
                    }
                    if(body.message)
                    {
                        alert(body.message);
                    }
                }).catch(function (e) {
                    app.apiFinished=true;
                    alert('Can not load theme settings');
                })
            },
        },
        components:{
            "vue-form-generator": VueFormGenerator.component
        }
    }
</script>
