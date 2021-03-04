<!-- fieldAwesome.vue -->
<template>
    <div class="field-st-typography">
        <input ref="picker" type="text" :autocomplete="schema.autocomplete" :disabled="disabled" :placeholder="schema.placeholder" :readonly="schema.readonly" :name="schema.inputName"  :id="getFieldID(schema)">
        <select v-model="familyVal">
            <option value="">font-family</option>
            <option :value="index" v-for="(font,index) in fonts">{{font}}</option>
        </select>
        <select v-model="sizeVal">
            <option value="">font-size</option>
            <option :value="size+'px'" v-for="size in (0,150)">{{size+'px'}}</option>
        </select>
        <select v-model="styleVal">
            <option value="">font-style</option>
            <option :value="index" v-for="(item,index) in style">{{item}}</option>
        </select>
        <select v-model="weightVal">
            <option value="">font-weight</option>
            <option :value="item" v-for="(item) in weight">{{item}}</option>
        </select>
        <select v-model="lineHeightVal">
            <option value="">line-height</option>
            <option :value="size+'px'" v-for="size in (0,150)">{{size+'px'}}</option>
        </select>
        <select v-model="decoVal">
            <option value="">text-decoration</option>
            <option :value="item" v-for="(item) in ['blink','inherit','line-through','none','overline','underline']">{{item}}</option>
        </select>
        <select v-model="transformVal">
            <option value="">text-transform</option>
            <option :value="item" v-for="(item) in ['capitalize','inherit','lowercase','none','uppercase']">{{item}}</option>
        </select>
    </div>

</template>

<script>
    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data() {
            return {
                weight:['normal','bold','bolder','lighter',100,200,300,400,500,600,700,800,900,'inherit'],
                style:{
                    'normal':'Normal',
                    'italic':'Italic',
                    'oblique':'Oblique',
                    'inherit':'Inherit',
                },
                fonts:{
                    'arial'     : 'Arial',
                    'georgia'   : 'Georgia',
                    'helvetica' : 'Helvetica',
                    'palatino'  : 'Palatino',
                    'tahoma'    : 'Tahoma',
                    'times'     : '"Times New Roman", sans-serif',
                    'trebuchet' : 'Trebuchet',
                    'verdana'   : 'Verdana'
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
                }
            };
        },
        created(){
          if(typeof this.schema.fonts != 'undefined'){
              let addedFont = this.schema.fonts;
              if(addedFont.length){
                  for(let i = 0; i < addedFont.length; i++){
                      if(typeof addedFont[i].fontVal != 'undefined' && typeof addedFont[i].family != 'undefined'){
                          this.fonts[addedFont[i].fontVal] =    addedFont[i].family;
                      }
                  }
              }
          }
        },
        watch: {
            model() {
                if (window.$ && window.$.fn.spectrum) {
                    this.picker.spectrum("set", this.value['font-color']);
                }
            },
            disabled(val) {
                if (val)
                    this.picker.spectrum("disable");
                else
                    this.picker.spectrum("enable");
            }
        },
        computed:{
            familyVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['font-family']?this.value['font-family']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['font-family']=newVal;
                }
            },
            sizeVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['font-size']?this.value['font-size']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['font-size']=newVal;
                }
            },
            styleVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['font-style']?this.value['font-style']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['font-style']=newVal;
                }
            },
            weightVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['font-weight']?this.value['font-weight']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['font-weight']=newVal;
                }
            },
            lineHeightVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['line-height']?this.value['line-height']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['line-height']=newVal;
                }
            },
            decoVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['text-decoration']?this.value['text-decoration']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['text-decoration']=newVal;
                }
            },
            transformVal:{
                get(){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    return this.value['text-transform']?this.value['text-transform']:'';
                },
                set(newVal){
                    if(this.value.constructor != Object)
                    {
                        this.value={};
                    }
                    this.value['text-transform']=newVal;
                }
            },
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
                            this.value['font-color'] = color ? color.toString() : null;
                        }
                    }));
                    this.picker.spectrum("set", this.value['font-color']);
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