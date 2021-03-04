<template>
    <div class="traveler-settings-container">
        <ul class="traveler-header">
            <li class="traveler-logo"><a><img :alt="info.blog_info" :src="info.logo"></a></li>
            <li class="traveler-version"><span>{{info.name}}</span></li>
        </ul>
        <div class="traveler-tabs">
            <ul class="traveler-tabs-nav">
                <router-link  :key="index" tag="li" v-for="(tab,index) in sections" :to="{name:'Settings',params:{id:tab.id}}" ><a v-html="tab.title"></a></router-link>

            </ul>
            <div class="traveler-tabs-content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
    import API from './api'
    import VueFormGenerator from "vue-form-generator";

    export default {
        data(){
            return {
                sections:traveler_settings.sections,
                info:traveler_settings.info,
                i18n:traveler_settings.i18n,
            }
        },
        created(){
            if(!this.$route.params.id || typeof this.$route.params.id == 'undefined'){
                this.$router.push({name:'Settings',params:{id:'option_general'}});
            }

            //
        },
        methods:{

        },
        components:{
            "vue-form-generator": VueFormGenerator.component,
        }
    }
</script>
<style lang="scss" src="./app.scss" ></style>
