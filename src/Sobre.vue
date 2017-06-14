<template>
<window title="Sobre">
    <box direction="row" :padding="[20]" center>
        <img src="src/assets/img/pagina-construcao.svg"></img>
    </box>
    <box direction="column" expand class="about" v-if="false">
        <box direction="row" expand>
            <box direction="row" :padding="[0,15]" column-center>
                <img src="src/assets/img/logo-white.svg" style="height:60px" class="r2-box"></img>
            </box>
            <box direction="column" style="">
                <h3 style="padding: 0px 10px; font-size: 30px;font-weight: bold;letter-spacing: 4px;">ESCOLA</h3>
                <h5 style="padding: 0px 10px;color: #8f9296;"><i>"Quem detém o Conhecimento, detém o Poder!"</i></h5>
            </box>
        </box>
        <box direction="column" expand>
            <box direction="row" expand>
                <i class="fa fa-map-marker"></i>
                <p><span>Rua José Alves dos Santos</span> São José do Divino, Brasil</p>
            </box>
            <box direction="row" expand>
                <i class="fa fa-phone"></i>
                <p>(33) 98838-4122</p>
            </box>
            <box direction="row" expand>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:renerdias@msn.com">renerdias@msn.com</a></p>
            </box>
        </box>
    </box>
</window>
</template>

<script>
import Box from "./components/r2-box.vue";
import Window from "./components/r2-window.vue";
export default {
    components: {
        Box,
        Window
    }
}
</script>
<style>
.about {
    background-color: #292c2f;
    box-sizing: border-box;
    width: 100%;
    text-align: left;
    font: bold 16px sans-serif;
    padding: 55px 50px;
    color: #92999f;
}

.about h3 {
    font: normal 36px 'Cookie', cursive;
    margin: 0;
}

.about h3 span {
    // color: #5383d3;
}

.about .footer-company-name {
    //color: #8f9296;
    font-size: 14px;
    font-weight: normal;
    margin: 0;
}

.about i {
    background-color: #33383b;
    color: #ffffff;
    font-size: 25px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    text-align: center;
    line-height: 42px;
    margin: 10px 15px;
    vertical-align: middle;
}

.about i.fa-envelope {
    font-size: 17px;
    line-height: 38px;
}

.about p {
    display: inline-block; //color: #ffffff;
    vertical-align: middle;
    margin: 0;
}

.about p span {
    display: block;
    font-weight: normal;
    font-size: 14px;
    line-height: 2;
}

.about p a {
    //color: #5383d3;
    text-decoration: none;
    ;
}

.about .footer-company-about {
    line-height: 20px;
    color: #92999f;
    font-size: 13px;
    font-weight: normal;
    margin: 0;
}

.about .footer-company-about span {
    display: block;
    color: #ffffff;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 20px;
}

.about .footer-icons {
    margin-top: 25px;
}

.about .footer-icons a {
    display: inline-block;
    width: 35px;
    height: 35px;
    cursor: pointer;
    background-color: #33383b;
    border-radius: 2px;
    font-size: 20px;
    color: #ffffff;
    text-align: center;
    line-height: 35px;
    margin-right: 3px;
    margin-bottom: 5px;
}
</style>
