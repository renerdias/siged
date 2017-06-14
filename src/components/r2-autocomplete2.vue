<template>
<div class="width__xs-100" style="position: relative; display: table;">
    <p class="box r2-row box__is-center" style='justify-content: flex-start !important;'>
        <input type="text" v-model="modelValue" @change="key_change" class="width__xs-100">
        <input type="text" v-model="keyword" class="width__xs-100" placeholder="Pesquisar..." @input="onInput($event.target.value)" @keyup.esc="closeDropdown" @blur="closeDropdown" @keydown.down="moveDown" @keydown.prevent.up="moveUp" @keydown.enter="select">
        <i class="fa fa-search" style="float:right;margin-left: -30px; z-index:2;"></i>
    </p>
    <ul v-show="isOpen" class="options-list card-1 width__xs-100">
        <li :class="{'highlighted': highlightedPosition === 0 }" @mouseenter="highlightedPosition = 0" @mousedown="select">
            Pesquisando por "{{ enteredValue }}"
        </li>

        <li :class="{'highlighted': index === highlightedPosition - 1 }" v-for="(option, index) in fOptions" @mouseenter="highlightedPosition = index + 1" @mousedown="select">
            <slot :item="option"></slot>
        </li>
    </ul>
    <!--
<select v-model="value">
<option value=""></option>
<option v-for="option in fOptions" :value="option[modelKey]||option">{{ option[modelDisplay]||option }}</option>

</select>
-->
</div>
</template>
<!--
**********    IMPLEMENTAR    **********

    :default-suggestion="true"
    v-on:selected="done">
    display-key='value'
    v-model="value"

    model
    key?
    display?
    // Para pesquisa via ajax
    remote="https://twitter.github.io/typeahead.js/data/films/queries/%QUERY.json'"

    //
    //:local="localValues"
    local:[Array]

    // Mínimo de caracteres para realizar pesquisa/filtro
    // (opcional)
    minChar: 3,


ERRO QUANDO CLICADO COM BOTAO DIREITO
TypeError: t.enteredValue is undefined
-->
<script>
export default {
    props: {
        options: {
            type: Array,
            required: true
        },
        // Limitar o número de itens que são mostrados na lista
        // (opcional)
        limit: {
            type: Number,
            default: 5
        },
        modelValue: {
            type: [String, Number],
            required: false
        },
        modelKey: {
            type: [String, Number],
            required: true
        },
        modelDisplay: {
            type: String,
            required: true
        },
        keyChange: {
            type: Function
        }
    },
    data() {
        return {
            isOpen: false,
            highlightedPosition: 0,
            keyword: '',
            enteredValue: ''
        }
    },
    watch: {
        highlightedPosition() {
            this.keyword = this.highlightedPosition === 0 ? this.enteredValue : this.fOptions[this.highlightedPosition - 1][this.modelDisplay]
        }
    },
    computed: {
        /*
        value(){
            const selectedOption = this.fOptions[this.highlightedPosition - 1]
            if (this.keyValue || selectedOption){
                return this.keyValue || selectedOption[this.modelKey];
            }
        },
        */
        fOptions() {
            //const re = new RegExp(this.enteredValue, 'i')
            //return this.options.filter(o => o[this.modelKey].match(re) || o[this.modelDisplay].match(re))
            //Verifica se e uma array
            if (Object.prototype.toString.call(this.options) === '[object Array]') {
                return this.options.filter((value) => {
                    //Verifica se o valor e um objeto
                    if (typeof value === 'object') {
                        var obj = value;
                        for (var key in obj) {
                            if (obj.hasOwnProperty(key)) {
                                var vlr = obj[key];
                                //Transforma o valor em string
                                vlr = vlr.toString();
                                //Verifica se o valor e uma string
                                if (typeof vlr === 'string') {
                                    //Tranforma em minusculo
                                    vlr = vlr.toLowerCase();
                                    //Tranforma em minusculo
                                    var query = this.enteredValue.toLowerCase();
                                    //
                                    if (vlr.indexOf(query) >= 0) {
                                        return true;
                                    }
                                }
                            }
                        }
                        return false;
                    } else {
                        vlr = value.toString();
                        //Verifica se o valor e uma string
                        if (typeof vlr === 'string') {
                            //Tranforma em minusculo
                            vlr = vlr.toLowerCase();
                            //Tranforma em minusculo
                            var query = this.enteredValue.toLowerCase();
                            //
                            if (vlr.indexOf(query) >= 0) {
                                return true;
                            }
                        }
                    }
                }).slice(0, this.limit);
            } else {
                console.error('autocomplete array inválida!');
            }
        }
    },
    methods: {
        key_change() {
            this.$emit('key-change', this.modelValue);
        },
        onInput(value) {
            this.highlightedPosition = 0
            this.isOpen = !!value
            this.enteredValue = value
        },
        moveDown() {
            if (!this.isOpen) {
                return
            }
            this.highlightedPosition =
                (this.highlightedPosition + 1) % (this.fOptions.length + 1)
        },
        moveUp() {
            if (!this.isOpen) {
                return
            }
            this.highlightedPosition = this.highlightedPosition - 1 < 0 ? this.fOptions.length : this.highlightedPosition - 1
        },
        select() {
            const selectedOption = this.highlightedPosition === 0 ? {
                title: this.enteredValue
            } : this.fOptions[this.highlightedPosition - 1]
            this.$emit('select', selectedOption)
            this.isOpen = false
            this.keyword = this.enteredValue = selectedOption[this.modelDisplay]
            console.log(this.$root);
        },
        closeDropdown() {
            this.keyword = this.enteredValue
            this.isOpen = false
        }
    }
}
</script>
<style>
ul.options-list {
    z-index: 20;
    display: flex;
    flex-direction: column;
    border-radius: 0 0 3px 3px;
    position: absolute;
    overflow: hidden;
}

ul.options-list li {
    width: 100%;
    flex-wrap: wrap;
    background: white;
    margin: 0;
    border-bottom: 1px solid #eee;
    color: #363636;
    padding: 7px;
    cursor: pointer;
}

ul.options-list li.highlighted {
    /*background: #f8f8f8*/
    background-color: #e0e0e0;
    background-image: -webkit-linear-gradient(#f0f0f0, #e0e0e0);
    box-shadow: inset rgba(0, 0, 0, 0.2) 0 1px 2px;
}
</style>
