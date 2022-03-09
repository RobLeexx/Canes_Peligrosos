<template>
    <app-layout>
        <template #header>
            <div style="display: flex; align-items: center">
                <v-btn fab small text :href="route('capacitaciones')"><v-icon>mdi-arrow-left-circle</v-icon></v-btn>
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                Grupo {{ grupo.id }}</div>
            </div>
        </template>
    <v-app v-if="this.grupo.estado == 'En Curso'">
        <div class="py-12" style="background: #4a6813">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <v-row style="padding: 20px">
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Tipo de Capacitación:</h1>&nbsp;{{ grupo.tipo }}
                          </v-row>
                        </v-col>
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Turno:</h1>&nbsp;{{ grupo.turno }} ({{ grupo.horario }})
                          </v-row>
                        </v-col>
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Fechas:</h1>&nbsp;desde el&nbsp;<h1 style="font-weight: bold">{{ grupo.inicio }}</h1>&nbsp;hasta el&nbsp;<h1 style="font-weight: bold">{{ grupo.fin }}</h1>
                          </v-row>
                        </v-col>
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Estado:</h1>&nbsp;{{ grupo.estado }}
                          </v-row>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                <v-card style="padding: 50px">
                    <v-col cols="12" sm="12" style="text-align:center">
                        <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding-bottom: 35px" >
                            Asistencia</h1>
                    </v-col>
                    <v-divider style="padding-bottom: 40px"></v-divider>
                    <v-row>
                        <v-col cols="12" sm="3" style="padding-top: 0; padding-bottom: 5px">
                            <div style="font-weight: bold; padding: 5px">Propietarios</div>
                        </v-col>
                        <v-col cols="12" sm="9">
                          <v-row style="display: flex;justify-content: space-around">
                            <h1>¿Asistencia Completa?</h1>
                          </v-row>
                        </v-col>
                    </v-row>
                    <v-row v-for="cap in caps" :key="cap.id">
                        <v-col cols="12" sm="3" style="align-items: center;display: flex">
                            <div>{{ cap.id }}. {{ cap.paterno }} {{ cap.materno }} {{ cap.nombres }}</div>
                        </v-col>
                        <v-col cols="12" sm="9">
                          <v-row style="display: flex;justify-content: space-around">
                            <v-switch v-model="cap.d1" :onclick="pushFaltas(cap.id)"></v-switch>
                            <h1 v-if="cap.d1" style="align-items: center;display: flex">Sí</h1>
                            <h1 v-else style="align-items: center;display: flex">No</h1>
                          </v-row>
                        </v-col>
                    </v-row>
                </v-card>

                <v-card style="padding: 50px">
                    <v-col cols="12" sm="12" style="text-align:center">
                        <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding: 35px" >
                            Observaciones</h1>
                    </v-col>
                    <v-divider style="padding-bottom: 40px"></v-divider>
                    <v-row v-for="cap in caps" :key="cap.id">
                        <v-col cols="12" sm="3">
                            <div>{{ cap.id }}. {{ cap.paterno }} {{ cap.materno }} {{ cap.nombres }}</div>
                        </v-col>
                        <v-col cols="12" sm="9">
                            <v-text-field outlined v-model="cap.observaciones" :onkeypress="obs()"></v-text-field>
                        </v-col>
                    </v-row>
                </v-card>
                <v-divider></v-divider>
                  <v-card-actions style="padding: 12px; display: flex">
                      <v-btn v-if="faltas()"
                          color="primary"
                          :disabled="finDate || disableBtnFlag || obsNull"
                          :loading="disableBtnFlag"
                          @click="submitData"
                      >
                          Finalizar
                      </v-btn>

                        <v-dialog v-else
                          v-model="dialog"
                          persistent
                          max-width="50%"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                v-bind="attrs"
                                v-on="on"
                                :disabled="finDate || obsNull"
                            >
                                Finalizar
                              <v-icon right>
                                mdi-alert-circle
                              </v-icon>
                            </v-btn>
                          </template>
                          <v-card>
                            <v-card-title class="text-h5" style="display: flex; justify-content: center; background-color: #f28d21; color: white">
                              Advertencia
                            </v-card-title>
                            <v-divider></v-divider>
                            <v-card-text style="padding: 15px; font-weight: bold">Los Siguientes Integrantes tienen faltas:</v-card-text>
                            <v-card-text style="color: red">{{ faltones }}</v-card-text>
                            <v-alert
                              dense
                              border="left"
                              type="warning"
                            >
                              Estos propietarios <strong>no tendrán su autorización disponible</strong> pero pueden volver a pertenecer a otro grupo.
                            </v-alert>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn
                                color="primary"
                                text
                                @click="dialog = false"
                              >
                                Volver
                              </v-btn>
                              <v-btn
                                color="primary"
                                :disabled="disableBtnFlag"
                                :loading="disableBtnFlag"
                                @click="submitData"
                              >
                                Guardar de todas formas
                              </v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>

                      <h1 v-if="finDate" style="padding-left: 10px; padding-top: 5px">
                          Puede finalizar {{ dias }} ({{ this.grupo.fin }})
                      </h1>
                  </v-card-actions>
                </div>
            </div>
        </div>
    </v-app>
    <v-app v-else>
        <div class="py-12" style="background: #4a6813">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="box-shadow: 0px 0px 30px">
                    <v-row style="padding: 20px">
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Tipo de Capacitación:</h1>&nbsp;{{ grupo.tipo }}
                          </v-row>
                        </v-col>
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Turno:</h1>&nbsp;{{ grupo.turno }} ({{ grupo.horario }})
                          </v-row>
                        </v-col>
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Fechas:</h1>&nbsp;desde el&nbsp;<h1 style="font-weight: bold">{{ grupo.inicio }}</h1>&nbsp;hasta el&nbsp;<h1 style="font-weight: bold">{{ grupo.fin }}</h1>
                          </v-row>
                        </v-col>
                        <v-col cols="12" sm="6">
                          <v-row style="padding: 15px">
                            <h1 style="font-weight: bold">Estado:</h1>&nbsp;{{ grupo.estado }}
                          </v-row>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                    <v-card style="padding: 50px">
                    <v-col cols="12" sm="12" style="text-align:center">
                        <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding-bottom: 35px" >
                            Completos</h1>
                    </v-col>
                    <v-divider style="padding-bottom: 40px"></v-divider>
                    <div style="padding-bottom: 20px">
                      <v-row>
                          <v-col cols="12" sm="6" style="padding-top: 0; padding-bottom: 5px">
                              <div style="font-weight: bold; padding: 5px">Integrantes</div>
                          </v-col>
                          <v-col cols="12" sm="6">
                            <v-row>
                              <div style="font-weight: bold; padding: 5px">Observaciones</div>
                            </v-row>
                          </v-col>
                      </v-row>
                      <v-row v-for="cap in caps" :key="cap.id">
                        <div v-if="cap.estado == 'Finalizado'" style="align-items: center;display: flex; width: 100%">
                          <v-col cols="12" sm="6">
                              <div>{{ cap.id }}. {{ cap.paterno }} {{ cap.materno }} {{ cap.nombres }}</div>
                          </v-col>
                          <v-col cols="12" sm="6">
                              <div>{{ cap.observaciones }}</div>
                          </v-col>
                        </div>
                      </v-row>
                    </div>

                    <v-divider></v-divider>
                    <v-col cols="12" sm="12" style="text-align:center">
                        <h1 style="
                            display: flex;
                            justify-content: center;
                            font-size: x-large;
                            padding-top: 35px;
                            padding-bottom: 35px" >
                            Incompletos</h1>
                    </v-col>
                    <div style="padding-bottom: 20px">
                      <v-row>
                          <v-col cols="12" sm="6" style="padding-top: 0; padding-bottom: 5px">
                              <div style="font-weight: bold; padding: 5px">Integrantes</div>
                          </v-col>
                          <v-col cols="12" sm="6">
                            <v-row>
                              <div style="font-weight: bold; padding: 5px">Observaciones</div>
                            </v-row>
                          </v-col>
                      </v-row>
                      <v-row v-for="cap in caps" :key="cap.id">
                        <div v-if="cap.estado == 'Incompleto'" style="align-items: center;display: flex; width: 100%">
                          <v-col cols="12" sm="6">
                              <div>{{ cap.id }}. {{ cap.paterno }} {{ cap.materno }} {{ cap.nombres }}</div>
                          </v-col>
                          <v-col cols="12" sm="6">
                              <div>{{ cap.observaciones }}</div>
                          </v-col>
                        </div>
                      </v-row>
                    </div>
                    </v-card>
                </div>
            </div>
        </div>
    </v-app>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from 'moment'

    export default {
        props: {
            grupo: Object,
            propietarios: Array,
            capacitaciones: Array,
        },
        data: function() {
            return{
                dias: [],
                caps:[],
                faltones: [],
                obser: [],
                dialog: false,
                form:{
                  id: this.grupo.id,
                  capacitador: this.grupo.capacitador,
                  integrantes: this.grupo.integrantes,
                  tipo: this.grupo.tipo,
                  turno: this.grupo.turno,
                  horario: this.grupo.horario,
                  inicio: this.grupo.inicio,
                  fin: this.grupo.fin,
                  completos: null,
                  incompletos: null,
                  observados: null,
                  estado: 'Finalizado',
                },
                disableBtnFlag: false,
                cnt: 1,
            }
        },
        created () {
          /* Merge Capacitaciones y Propietarios */
            let mergedSubjects = this.propietarios.map(subject => {
            let otherSubject = this.capacitaciones.find(element => element.id === subject.id)
            const reg = {...subject, ...otherSubject}
            this.caps.push(reg)})
            this.dias = moment(this.grupo.fin, "YYYY-MM-DD").locale('es').fromNow()
            let horario2 = this.grupo.horario.replace(',',' -');
            this.grupo.horario = horario2;
        },
        computed: {
            finDate(){
                var today = new Date();
                var fin = new Date(this.grupo.fin);
                var diferencia = fin.getDate()+1 - today.getDate();
                var diferencia1 = fin.getMonth() - today.getMonth();
                var diferencia2 = fin.getFullYear() - today.getFullYear();
                if(diferencia2 >= 0 ){
                  if(diferencia2 == 0 )
                  {
                    if(diferencia1 == 0)
                    {
                      if(diferencia <= 0)
                      {
                        return false;
                      }
                      else
                      {
                        return true;
                      }
                    }
                    else if(diferencia1 < 0)
                    {
                      return false;
                    }
                    else
                    {
                      return true;
                    }
                  }
                  else
                  {
                    return true;
                  }
                }
                else{
                  return false;
                }
            },
            obsNull(){
              let obCom = 0
              for(let n = 0; n < this.caps.length; n++)
              {
                if(this.caps[n].observaciones)
                {
                  obCom++
                }
              }
              if(this.caps.length == obCom)
              {
                return false
              }
              else
              {
                return true
              }
            }
        },
        methods: {
            submitData() {
                /* Completos e Incompletos */
                let com = 0
                let inc = 0
                for(let n = 0; n < this.caps.length; n++)
                {
                  if(this.caps[n].d1)
                  {
                    com++
                  }
                  else
                  {
                    inc++
                  }
                }
                if(com == this.caps.length)
                {
                  this.form.completos = this.grupo.integrantes
                  this.form.incompletos = null
                }
                else if(inc == this.caps.length)
                {
                  this.form.incompletos = this.grupo.integrantes
                  this.form.completos = null
                }
                /* subir datos */
                this.form.observados = this.obser
                this.$inertia.put(route('grupos.update', this.grupo.id), this.form);

                /* Primer Click */
                if(!this.disableBtnFlag) {
                    this.disableBtnFlag = true;
                }
            },
            reenviarRegistros() {
                    this.caps = this.caps.map(this.getDisplayRegistros);
                },
            getDisplayRegistros(caps) {
                caps.asistenciaCompleta = false
                return {
                    id: caps.id,
                    paterno: caps.paterno,
                    materno: caps.materno,
                    nombres: caps.nombres,
                    celular: caps.celular,
                    observaciones: caps.observaciones,
                    documento: caps.documento,
                    estado: caps.estado,

                    /* Asistencia */
                    d1: caps.asistenciaCompleta,
                };
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            },
            faltas(){
              let asistencias = 0;
              let fal = [];
              let falID = [];
              let nombres = ' '
              for(let n = 0; n < this.caps.length; n++)
              {
                if(this.caps[n].d1)
                {
                  asistencias++
                }
                else if(this.faltones == fal.toString())
                {
                  break;
                }
                else
                {
                  fal.push(nombres.concat(this.caps[n].id, '. ', this.caps[n].paterno, ' ',this.caps[n].materno, ' ',this.caps[n].nombres))
                  falID.push(this.caps[n].id)
                }
              }
              if(asistencias == this.caps.length)
              {
                return true
              }
              else
              {
                localStorage.setItem("ids", fal)
                localStorage.setItem("id", falID)
                return false
              }
            },
            pushFaltas(id){
                this.faltones = localStorage.getItem("ids")
                this.form.incompletos = localStorage.getItem("id")
                if(this.grupo.integrantes.includes(this.form.incompletos + ','))
                {
                  this.form.completos = this.grupo.integrantes.replace(this.form.incompletos + ',', '')
                }
                else if(this.grupo.integrantes.includes(',' + this.form.incompletos))
                {
                  this.form.completos = this.grupo.integrantes.replace(',' + this.form.incompletos, '')
                }
                else
                {
                  this.form.completos = this.grupo.integrantes.replace(this.form.incompletos + ',', '')
                  this.form.completos = this.grupo.integrantes.replace(',' + this.form.incompletos, '')
                }
            },
            obs(){
              let observacionesAll = []
              for(let n = 0; n < this.caps.length; n++)
              {
                let id = ''
                if(this.caps[n].observaciones)
                {
                  observacionesAll.push(id.concat(this.caps[n].observaciones))
                }
              }
              /*console.log(observacionesAll.toString())*/
              this.obser = observacionesAll.toString()
            }
        },
        mounted(){
          this.reenviarRegistros();
        },
        components: {
            AppLayout,
            moment,
        },
    }
</script>
