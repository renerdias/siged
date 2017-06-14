<template>
<box direction="row" center>
    <div class="pagination">
        <a class="page" v-show="showPreviousButton" @click="goFirstPage()">
            <i class="fa fa-step-backward"></i>
        </a>
        <a class="page" v-show="showPreviousButton" @click="goPreviousPage()">
            <i class="fa fa-caret-left"></i>
        </a>
        <a class="page" v-show="showPreviousButton" @click="goPage(page-1)">{{page-1}}</a>
        <a class="page active">{{page}}</a>
        <a class="page" v-show="showNextButton" @click="goPage(page+1)">{{page+1}}</a>
        <a class="page" v-show="showNextButton" @click="goNextPage()">
            <i class="fa fa-caret-right"></i>
        </a>
        <a class="page" v-show="showNextButton" @click="goLastPage()">
            <i class="fa fa-step-forward"></i>
        </a>
    </div>
</box>
</template>
<script>
import Box from './r2-box.vue';
export default {
    components: {
        Box
    },
    props: ["total", "page", "itensPerPage"],
    computed: {
        totalPages: function() {
            return Math.ceil(this.total / this.itensPerPage) || 1
        },
        showNextButton: function() {
            return this.page != this.totalPages
        },
        showPreviousButton: function() {
            return this.page != 1
        }
    },
    methods: {
        goNextPage: function() {
            this.$emit('change-page', this.page + 1)
        },
        goPreviousPage: function() {
            this.$emit('change-page', this.page - 1)
        },
        goFirstPage: function() {
            this.$emit('change-page', 1)
        },
        goLastPage: function() {
            this.$emit('change-page', this.totalPages)
        },
        goPage: function(page) {
            this.$emit('change-page', page)
        }
    }
}
</script>
<style>
.pagination {
    background: #f2f2f2;
    padding: 20px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border-top: 1px solid rgb(222, 222, 222);
}

.page {
    display: inline-block;
    padding: 5px 15px;
    margin-right: 4px;
    border-radius: 3px;
    border: solid 1px #c0c0c0;
    background: #e9e9e9;
    box-shadow: inset 0px 1px 0px rgba(255, 255, 255, .8), 0px 1px 3px rgba(0, 0, 0, .1);
    font-size: .9em;
    font-weight: bold;
    text-decoration: none;
    color: #717171;
    text-shadow: 0px 1px 0px rgba(255, 255, 255, 1);
}

.page:hover,
.page.gradient:hover {
    background: #fefefe;
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
    background: -moz-linear-gradient(0% 0% 270deg, #FEFEFE, #f0f0f0);
}

.page.active {
    border: none;
    background: #616161;
    box-shadow: inset 0px 0px 8px rgba(0, 0, 0, .5), 0px 1px 0px rgba(255, 255, 255, .8);
    color: #f0f0f0;
    text-shadow: 0px 0px 3px rgba(0, 0, 0, .5);
}



.page.gradient {
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f8f8f8), to(#e9e9e9));
    background: -moz-linear-gradient(0% 0% 270deg, #f8f8f8, #e9e9e9);
}


.pagination.dark {
    background: #414449;
    color: #feffff;
}

.page.dark {
    border: solid 1px #32373b;
    background: #3e4347;
    box-shadow: inset 0px 1px 1px rgba(255, 255, 255, .1), 0px 1px 3px rgba(0, 0, 0, .1);
    color: #feffff;
    text-shadow: 0px 1px 0px rgba(0, 0, 0, .5);
}

.page.dark:hover,
.page.dark.gradient:hover {
    background: #3d4f5d;
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#547085), to(#3d4f5d));
    background: -moz-linear-gradient(0% 0% 270deg, #547085, #3d4f5d);
}

.page.dark.active {
    border: none;
    background: #2f3237;
    box-shadow: inset 0px 0px 8px rgba(0, 0, 0, .5), 0px 1px 0px rgba(255, 255, 255, .1);
}

.page.dark.gradient {
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#565b5f), to(#3e4347));
    background: -moz-linear-gradient(0% 0% 270deg, #565b5f, #3e4347);
}
</style>
