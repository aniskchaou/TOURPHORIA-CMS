<template>
    <div v-html="options"></div>
</template>

<script>
    import { abstractField } from "vue-form-generator";
    import API from '../api';

    export default {
        mixins: [ abstractField ],
        data(){
            return {
                options: "",
            }
        },
        created(){
            let app=this;
            API.getEmailDocument().then(function (rs) {
                app.options = rs.data.rows;
            })
        }
    };
</script>