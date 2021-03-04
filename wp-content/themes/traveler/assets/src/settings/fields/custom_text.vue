<template>
    <div>
    <input
            class="form-control"
            type="text"
            v-model="value"/>
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
            if(this.value == "") {
                if (this.schema.std != null) {
                    this.value = this.schema.std;
                }
            }

            if(this.schema.v_hint == 'yes'){
                this.hintHtml = this.schema.desc;
            }
        }
    };
</script>