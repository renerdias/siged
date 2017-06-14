<template>
<window title="Backup" size="800px">
    <infobar type="warn" icon="true" message="Realize backup's periodicamente, a segurança de suas informações pode depender disso!" show="true"></infobar>
    <infobar :type="infobar.tipo" icon="true" :message="infobar.mensagem" :show="infobar.exibir"></infobar>
    <modal v-if="show">
        <box direction="row" center :padding="[0]">
            <spinner show="true"> </spinner>
            <span>Aguarde a realização do backup...</span>
        </box>







        <svg id="wrap" width="300" height="300">

          <!-- background -->
          <svg>
            <circle cx="150" cy="150" r="130" style="stroke: #7986cb; stroke-width:18; fill:transparent"/>
            <circle cx="150" cy="150" r="115" style="fill:#3f51b5"/>
            <path style="stroke: #3f51b5; stroke-dasharray:820; stroke-dashoffset:820; stroke-width:18; fill:transparent" d="M150,150 m0,-130 a 130,130 0 0,1 0,260 a 130,130 0 0,1 0,-260">
              <animate attributeName="stroke-dashoffset" dur="6s" to="-820" repeatCount="indefinite"/>
            </path>
          </svg>

        <!-- image -->
        <svg>
            <path id="hourglass" d="M150,150 C60,85 240,85 150,150 C60,215 240,215 150,150 Z" style="stroke: white; stroke-width:5; fill:white;" />

            <path id="frame" d="M100,97 L200, 97 M100,203 L200,203 M110,97 L110,142 M110,158 L110,200 M190,97 L190,142 M190,158 L190,200 M110,150 L110,150 M190,150 L190,150" style="stroke:#7986cb; stroke-width:6; stroke-linecap:round" />

            <animateTransform xlink:href="#frame" attributeName="transform" type="rotate" begin="0s" dur="3s" values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
            <animateTransform xlink:href="#hourglass" attributeName="transform" type="rotate" begin="0s" dur="3s" values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
          </svg>

        <!-- sand -->
        <svg>
            <!-- upper part -->
            <polygon id="upper" points="120,125 180,125 150,147" style="fill:#3f51b5;">
              <animate attributeName="points" dur="3s" keyTimes="0; 0.8; 1" values="120,125 180,125 150,147; 150,150 150,150 150,150; 150,150 150,150 150,150" repeatCount="indefinite"/>
            </polygon>

            <!-- falling sand -->
            <path id="line" stroke-linecap="round" stroke-dasharray="1,4" stroke-dashoffset="200.00" stroke="#3f51b5" stroke-width="2" d="M150,150 L150,198">
              <!-- running sand -->
              <animate attributeName="stroke-dashoffset" dur="3s" to="1.00" repeatCount="indefinite"/>
              <!-- emptied upper -->
              <animate attributeName="d" dur="3s" to="M150,195 L150,195" values="M150,150 L150,198; M150,150 L150,198; M150,198 L150,198; M150,195 L150,195" keyTimes="0; 0.65; 0.9; 1" repeatCount="indefinite"/>
              <!-- last drop -->
              <animate attributeName="stroke" dur="3s" keyTimes="0; 0.65; 0.8; 1" values="#3f51b5;#3f51b5;transparent;transparent" to="transparent" repeatCount="indefinite"/>
            </path>

            <!-- lower part -->
            <g id="lower">
              <path d="M150,180 L180,190 A28,10 0 1,1 120,190 L150,180 Z" style="stroke: transparent; stroke-width:5; fill:#3f51b5;">
                <animateTransform attributeName="transform" type="translate" keyTimes="0; 0.65; 1" values="0 15; 0 0; 0 0" dur="3s" repeatCount="indefinite" />
              </path>
              <animateTransform xlink:href="#lower" attributeName="transform"
                            type="rotate"
                            begin="0s" dur="3s"
                            values="0 150 150; 0 150 150; 180 150 150"
                            keyTimes="0; 0.8; 1"
                            repeatCount="indefinite"/>
            </g>

            <!-- lower overlay - hourglass -->
            <path d="M150,150 C60,85 240,85 150,150 C60,215 240,215 150,150 Z" style="stroke: white; stroke-width:5; fill:transparent;">
              <animateTransform attributeName="transform"
                            type="rotate"
                            begin="0s" dur="3s"
                            values="0 150 150; 0 150 150; 180 150 150"
                            keyTimes="0; 0.8; 1"
                            repeatCount="indefinite"/>
            </path>

            <!-- lower overlay - frame -->
            <path id="frame" d="M100,97 L200, 97 M100,203 L200,203" style="stroke:#7986cb; stroke-width:6; stroke-linecap:round">
              <animateTransform attributeName="transform"
                            type="rotate"
                            begin="0s" dur="3s"
                            values="0 150 150; 0 150 150; 180 150 150"
                            keyTimes="0; 0.8; 1"
                            repeatCount="indefinite"/>
            </path>
          </svg>
        </svg>







    </modal>
    <box direction="row" :padding="[0]">
        <table class="w3-table w3-bordered w3-striped w3-hoverable">
            <thead>
                <tr class="w3-red">
                    <th style="width: 50px;"></th>
                    <th>Data</th>
                    <th>Início</th>
                    <th>Término</th>
                    <th>Duração</th>
                    <th>Tamanho</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="_backup in backupList">
                    <td class="icons">
                        <i class="fa fa-check-circle" :class="[_backup.st_registro == 'A' ? 'r2-text-blue' : '']">
                            </i>
                    </td>
                    <td>{{_backup.data}}</td>
                    <td>{{_backup.inicio}}</td>
                    <td>{{_backup.termino}}</td>
                    <td>{{_backup.duracao}}</td>
                    <td>{{_backup.tamanho}}</td>
                    <td>{{_backup.detalhes}}</td>
                </tr>
            </tbody>
        </table>
    </box>
    <box direction="row" reverse :padding="[5,10]">
        <button @click="executar()" class="button button-red width__xs-40">
            <i class="fa fa-cog"></i> Executar
        </button>
    </box>
</window>
</template>
<script>
import Box from "../../../components/r2-box.vue";
import Infobar from "../../../components/r2-infobar.vue";
import Window from "../../../components/r2-window.vue";
import Spinner from "../../../components/r2-spinner.vue";
import Modal from "../../../components/r2-modal.vue";
import * as backupService from "../BackupService";
export default {
    components: {
        Box,
        Infobar,
        Window,
        Spinner,
        Modal
    },
    data() {
        return {
            infobar: {
                exibir: false
            },
            show: false,
            backupList: [{
                    st_registro: 'A',
                    data: 'Data',
                    inicio: '16:00',
                    termino: '17:00',
                    duracao: '01:00',
                    tamanho: '30m',
                    detalhes: 'Realizado por: Rener Dias<br>Perfil: Detalhes'
                },
                {
                    st_registro: 'A',
                    data: 'Data',
                    inicio: '16:00',
                    termino: '17:00',
                    duração: '01:00',
                    tamanho: '30m',
                    detalhes: '<th>Detalhes</th>'
                },
                {
                    st_registro: 'A',
                    data: 'Data',
                    inicio: '16:00',
                    termino: '17:00',
                    duração: '01:00',
                    tamanho: '30m',
                    detalhes: '<th>Detalhes</th>'
                },
                {
                    st_registro: 'A',
                    data: 'Data',
                    inicio: '16:00',
                    termino: '17:00',
                    duração: '01:00',
                    tamanho: '30m',
                    detalhes: '<th>Detalhes</th>'
                },
                {
                    st_registro: 'A',
                    data: 'Data',
                    inicio: '16:00',
                    termino: '17:00',
                    duração: '01:00',
                    tamanho: '30m',
                    detalhes: '<th>Detalhes</th>'
                }
            ]
        }
    },
    methods: {
        executar() {
            this.show = true;
            let minTime = 10000;
            let startTime = new Date().getTime();
            backupService.executar()
                .then((response, erro) => {
                    let resultado = response.data;
                    if (resultado.execucao == "sucesso") {
                        setTimeout(() => {
                            this.show = false;
                            this.exibirBarra('success', true, resultado.mensagem);
                            notyf.confirm(resultado.mensagem);
                        }, minTime - (new Date().getTime() - startTime));
                    } else if (resultado.execucao == "erro") {
                        setTimeout(() => {
                            this.show = false;
                            this.exibirBarra('error', true, resultado.mensagem);
                            notyf.alert(resultado.mensagem);
                            console.error(resultado.log);
                        }, minTime - (new Date().getTime() - startTime));
                    }
                })
                .catch((erro) => {
                    setTimeout(() => {
                        this.show = false;
                        notyf.alert('Ocorreu um erro desconchecido!');
                        console.error('Módulo Bairro: ' + erro);
                        this.exibirBarra('error', true, erro);
                    }, minTime - (new Date().getTime() - startTime));
                })

        },
        exibirBarra(t, b, str) {
            this.infobar = {
                tipo: t,
                mensagem: str,
                exibir: b
            }
        }
    }
}
</script>
<style>

</style>
