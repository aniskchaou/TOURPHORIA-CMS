<!-- fieldAwesome.vue -->
<template>
    <ace-editor v-model="value" @init="editorInit" lang="css" theme="chrome" width="100%" height="400"></ace-editor>
</template>

<script>
    import { abstractField } from "vue-form-generator";
    import AcaEditor from "vue2-ace-editor";

    export default {
        mixins: [ abstractField ],
        methods: {
            editorInit: function () {
                require('brace/mode/css');
                require('brace/theme/chrome');
            }
        },
        components:{
            "ace-editor": AcaEditor,
        },
    };
</script>