<template>
    <div class="checkbox" :class="[_type,_icon]">
        <label class="message">{{message}}</label>
        <input type="checkbox" class="titlebutton button">
        <label class="message">{{message}}</label>
    </div>
</template>

<script>
export default {
    name: 'r2-checkbox',
    props: {
        checked-value
        unchecked-value
        
        'type': {
            type: String,
            default: 'info'
        },
        'message':{default:null},
        'show':{type: Boolean, default:false},
        'timeclose':{type: Number, default:0},
        icon:{type: Boolean, default:false}
    },
    data: function () {
        return {
        }
    },
    computed: {
        _type: function (){
            let val = this.type.toString();
            return this.normalize(val);
        },
        _show: function (){
console.log('checkbox:' + this.show);
            return this.coerce().boolean(this.show);
        }
    },
    methods: {
        normalize(val){
            return (val == 'info' || val == 'information' ? 'info' : (val == 'warn' || val == 'warning' ? 'warn' : (val == 'error' ? 'error' : '')));
        },
close:function(){
console.log('checkbox:' + this.show);
    //this.$set(this.show,false);
this.$set(this, 'show', false);
},
        coerce: function () {
            return {
                boolean: function (val){
                    return (typeof val === 'string' ? (val === 'false' || val === 'null' || val === 'undefined' ? false : val === 'true' ? true : val) : val);
                }
            }
        }
    },
    mounted () {

    }
}
</script>

<style>

</style>
