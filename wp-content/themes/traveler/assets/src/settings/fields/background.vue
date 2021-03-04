<!-- fieldAwesome.vue -->
<template>
    <div class="field-st-typography">
        <input ref="picker" type="text" >
        <select v-model="repeatVal">
            <option value="">background-repeat</option>
            <option :value="index" v-for="(item,index) in repeat">{{item}}</option>
        </select>
        <select v-model="attachmentVal">
            <option value="">background-attachment</option>
            <option :value="index" v-for="(item, index) in attachment">{{item}}</option>
        </select>
        <select v-model="positionVal">
            <option value="">background-position</option>
            <option :value="index" v-for="(item,index) in position">{{item}}</option>
        </select>
        <input type="text" v-model="sizeVal" placeholder="background-size"/>
        <div class="field-st-upload">
            <div class="ts-upload-input-group">
                <input
                        class="form-control"
                        type="text"
                        v-model="imageUrl"
                        :disabled="disabled"
                        :maxlength="schema.max"
                        :placeholder="schema.placeholder"
                        :readonly="schema.readonly" >
                <button @click="openUploader" class="button button-primary"><i class="fa fa-plus"></i></button>
            </div>
            <button v-if="imageUrl" @click="clearImage" class="button button-remove"><i class="fa fa-minus"></i></button>
            <div class="ts-media-wrap">
                <img v-if="imageUrl" :src="imageUrl" alt="">
            </div>
        </div>
    </div>

</template>

<script>
    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data() {
            return {
                repeat:{
                    'no-repeat':'No Repeat',
                    'repeat':'Repeat All',
                    'repeat-x':'Repeat Horizontally',
                    'repeat-y':'Repeat Vertically',
                    'inherit':'Inherit'
                },
                attachment: {
                    'fixed':'Fixed',
                    'scroll':'Scroll',
                    'inherit':'Inherit'
                },
                position:{
                    'left top':'Left Top',
                    'left center':'Left Center',
                    'left bottom':'Left Bottom',
                    'center top':'Center Top',
                    'center center':'Center Center',
                    'center bottom':'Center Bottom',
                    'right top':'Right Top',
                    'right center':'Right Center',
                    'right bottom':'Right Bottom'
                },
                picker: null,
                colorOptions:{
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
                },
                fileManager:{},
                imageUrl: this.value['background-image']
            };
        },
        watch: {
            model() {
                if (window.$ && window.$.fn.spectrum) {
                    this.picker.spectrum("set", this.value);
                }
            },
            disabled(val) {
                if (val)
                    this.picker.spectrum("disable");
                else
                    this.picker.spectrum("enable");
            }
        },
        created(){
            let id='ts'+this.schema.model;
            let app=this;
            if(typeof wp.media.frames[id] === 'undefined'){
                wp.media.frames[id] = wp.media({
                    title: 'Select image',
                    multiple: false,
                    library: {
                        type: 'image'
                    },
                    button: {
                        text: 'Use selected image'
                    }
                });

                wp.media.frames[id].on('select', function(){
                    var selection =wp.media.frames[id].state().get('selection');

                    // no selection
                    if (!selection) {
                        return;
                    }

                    // iterate through selected elements
                    selection.each(function(attachment) {
                        let url = attachment.attributes.url;
                        app.imageUrl = url;
                        app.value['background-image']=url;
                    });
                });
            }

        },
        computed:{
            repeatVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['background-repeat']?this.value['background-repeat']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['background-repeat']=newVal;
                }
            },
            attachmentVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['background-attachment']?this.value['background-attachment']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['background-attachment']=newVal;
                }
            },
            positionVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['background-position']?this.value['background-position']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['background-position']=newVal;
                }
            },
            sizeVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['background-size']?this.value['background-size']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['background-size']=newVal;
                }
            },
        },
        methods:{
            openUploader()
            {
                let id='ts'+this.schema.model;
                if(wp.media.frames[id]) {
                    wp.media.frames[id].open();
                    return;
                }
            },
            clearImage(){
                this.imageUrl = '';
                this.value['background-image']='';
            }
        },
        mounted() {
            this.$nextTick(function () {
                if(this.value.constructor != Object)
                {
                    this.value={};
                }
                if (window.$ && window.$.fn.spectrum) {
                    this.picker = $(this.$refs.picker).spectrum("destroy").spectrum(_.defaults(this.colorOptions || {}, {
                        showInput: true,
                        showAlpha: true,
                        disabled: this.schema.disabled,
                        allowEmpty: !this.schema.required,
                        preferredFormat: "hex",
                        change: (color) => {
                            this.value['background-color'] = color ? color.toString() : null;
                        }
                    }));
                    this.picker.spectrum("set", this.value['background-color']);
                } else {
                    console.warn("Spectrum color library is missing. Please download from http://bgrins.github.io/spectrum/ and load the script and CSS in the HTML head section!");
                }
            });
        },
        beforeDestroy() {
            if (this.picker)
                this.picker.spectrum("destroy");
        }
    };
</script>