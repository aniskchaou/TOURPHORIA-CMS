<template>
    <div class="google-fonts-wrapper">
        <div class="item-font" v-for="(fitem, findex) in inputs" :key="fitem.id">
            <div class="select-box">
                <div class="del-item" @click="removeDiv(findex)">
                    <span class="dashicons dashicons-minus"></span>
                </div>
                <select v-model="fitem.fontVal" v-if="Object.keys(dataFonts).length">
                    <option value="-1">---- Choose One ----</option>
                    <option :value="index" v-for="(item, index) in dataFonts">{{ item.family }}</option>
                </select>
            </div>
            <div class="item-font-sub">
                <div class="item-font-varial" v-if="typeof varial[fitem.fontVal] != 'undefined' && varial[fitem.fontVal].length">
                    <label v-for="(vitem, vindex) in varial[fitem.fontVal]"><input type="checkbox" :value="vitem" v-model="fitem.variants"> {{ vitem }}</label>
                </div>
                <div class="item-font-subset" v-if="typeof subset[fitem.fontVal] != 'undefined' && subset[fitem.fontVal].length">
                    <label v-for="(sitem, sindex) in subset[fitem.fontVal]"><input type="checkbox" :value="sitem"  v-model="fitem.subsets"> {{ sitem }}</label>
                </div>
            </div>
        </div>
        <button class="btn btn-primary pull-right" @click="cloneDiv">Add Google Font</button>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data(){
            return {
                fontID: '-1',
                dataFonts: [],
                varial: {

                },
                subset: {

                },
                counter: 0,
                inputs: [
                    {
                        id: 'gfont',
                        fontVal: '-1',
                        family: '',
                        variants: [],
                        subsets: []
                    }
                ]
            }
        },
        created(){
            this.dataFonts = this.schema.choose;
            if(typeof this.schema.std != 'undefined') {
                let dataChoose = this.schema.std;
                if (dataChoose.length) {
                    this.inputs = [];
                    for (let i = 0; i < dataChoose.length; i++) {
                        if(typeof dataChoose[i].fontVal !== 'undefined') {
                            this.inputs.push({
                                id: `gfont${i}`,
                                fontVal: dataChoose[i].fontVal,
                                family: dataChoose[i].family,
                                variants: dataChoose[i].variants,
                                subsets: dataChoose[i].subsets
                            });
                            this.varial[dataChoose[i].fontVal] = this.dataFonts[dataChoose[i].fontVal].variants;
                            this.subset[dataChoose[i].fontVal] = this.dataFonts[dataChoose[i].fontVal].subsets;
                        }
                    }
                    this.counter = dataChoose.length - 1;
                }
                this.value = this.inputs;
            }
        },
        methods:{
            removeDiv(index){
                this.inputs.splice(index, 1);
            },
            cloneDiv(){
                this.inputs.push({
                    id: `gfont${++this.counter}`,
                    fontVal: '-1',
                    family: '',
                    variants: [],
                    subsets: []
                });
            },
        },
        watch: {
            inputs:{
                handler: function (after, before) {
                    for(let i = 0; i < Object.keys(after).length; i++){
                        let dataTemp = this.dataFonts[after[i].fontVal];
                        if(typeof dataTemp != 'undefined') {
                            if (typeof dataTemp.variants != 'undefined') {
                                if (dataTemp.variants.length) {
                                    this.varial[after[i].fontVal] = dataTemp.variants;
                                }
                            }
                            if (typeof dataTemp.subsets != 'undefined') {
                                if (dataTemp.subsets.length) {
                                    this.subset[after[i].fontVal] = dataTemp.subsets;
                                }
                            }
                            if(typeof  dataTemp.family != 'undefined'){
                                after[i].family = dataTemp.family;
                            }
                        }
                    }
                    this.value = this.inputs;
                },
                deep: true
            },
        }
    };
</script>
<style lang="scss">
    .google-fonts-wrapper{
        overflow: hidden;
        .item-font{
            margin-bottom: 15px;
            .select-box{
                position: relative;
                .del-item{
                    position: absolute;
                    height: 35px;
                    width: 45px;
                    background: #cc0000;
                    text-align: center;
                    line-height: 35px;
                    cursor: pointer;
                    top: 1px;
                    span{
                        color: #fff;
                        line-height: 35px;
                    }
                }
                select{
                    min-height: 35px;
                    padding-left: 50px;
                }
            }

            .item-font-sub{
                margin-top: 10px;
                overflow: hidden;
                .item-font-varial{
                    width: 30%;
                    float: left;
                }
                .item-font-subset{
                    width: 30%;
                    float: left;
                }
                label{
                    display: block;
                    margin-bottom: 5px;
                    input{

                    }
                }
            }
        }
    }
</style>