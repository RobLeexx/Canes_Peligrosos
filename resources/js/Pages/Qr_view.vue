<template>
<v-app>
    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
              <v-card>
              <v-alert
                outlined
                type="success"
                text
              ><h1 style="font-weight: bold">Documento Válido {{ diaC }}/{{ mesC }}/{{ anioC }}</h1>
              Documento validado en la página oficial de C.A.C Bolivia, verifica si las credenciales coinciden con el documento escaneado.
              </v-alert>
              <div style="display: flex; justify-content: center; padding: 30px">
                <v-img src="/storage/img/logoPol.png" min-height="200px" max-width="200px"></v-img>
              </div>
              <v-row>
                <v-col cols="12" sm="6">
                  <v-card-title>PROPIETARIO: {{  propietario.paterno  }} {{  propietario.materno  }} {{  propietario.nombres  }}</v-card-title>
                  <h1 style="padding: 15px">Cédula de Identidad: {{  propietario.documento  }} {{  propietario.docExp  }}</h1>
                  <h1 style="padding: 15px">Fecha de nacimiento del propietario: {{  propietario.dateProp  }}</h1>
                  <h1 style="padding: 15px">Residencia: {{  propietario.departamento  }}</h1>
                  <div style="padding: 20px">
                    <v-alert v-if="antecedente.aCanes != 'Ninguno' || antecedente.aRejap != 'Ninguno' || antecedente.aFelcc != 'Ninguno' || antecedente.aFelcv != 'Ninguno' || antecedente.aFelcn != 'Ninguno'"
                      type="warning"
                    >El Propietario TIENE ANTECEDENTES</v-alert>
                    <v-alert v-else
                      type="success"
                    >El Propietario NO TIENE ANTECEDENTES</v-alert>
                  </div>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-card-title>NOMBRE DEL CAN: {{ can.nomPerro }}</v-card-title>
                  <h1 style="padding: 15px">Raza del Can: {{  can.razaCan  }}</h1>
                  <h1 style="padding: 15px">Fecha de nacimiento del Can: {{  can.dateNacPerro  }}</h1>
                  <h1 style="padding: 15px">Capacitación: {{  capacitacion.estado  }}</h1>
                  <div style="padding: 20px">
                    <v-alert v-if="can.antecedentesCan == 'No'"
                      type="success"
                    >El Can NO TIENE ANTECEDENTES</v-alert>
                    <v-alert v-else
                      type="warning"
                    >El Can TIENE ANTECEDENTES</v-alert>
                  </div>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-card-title>REGSITRADO POR: {{ gradoSec }} {{ sec.paterno }} {{ sec.materno }} {{ sec.nombres }}</v-card-title>
                  <h1 style="padding: 15px">Registrado en: {{  propietario.cac  }}</h1>
                  <h1 style="padding: 15px">Fecha de registro: {{  creacion  }}</h1>
                </v-col>
                <v-col cols="12" sm="6" v-if="propietario.grupo != 'Ninguno'">
                  <v-card-title>CAPACITADO POR: {{ gradoCap }} {{ cap.paterno }} {{ cap.materno }} {{ cap.nombres }}</v-card-title>
                  <h1 style="padding: 15px">Inicio de capacitacion: {{  grupo.inicio  }}</h1>
                  <h1 style="padding: 15px">Fin de capacitacion: {{  grupo.fin  }}</h1>
                </v-col>
              </v-row>
              <v-card-title>
              </v-card-title>
              </v-card>
            </div>
        </div>
    </div>
</v-app>
</template>

<script>
import moment from 'moment'

export default {
    props: {
            propietario: Object,
            can: Object,
            antecedente: Object,
            capacitacion: Object,
            sec: Object,
            cap: Object,
            grupo: Object,
        },
    data(){
      return{
      gradoSec: [],
      gradoCap: [],
      diaC: [],
      mesC: [],
      anioC: [],
      creacion: [],
      }
    },
    created(){
      switch (this.sec.grado)
            {
                case 'Cabo':
                    this.gradoSec = 'Pol.';
                    break
                case 'Sargento':
                    this.gradoSec = 'Sgto.';
                    break
                case 'Suboficial':
                    this.gradoSec = 'Sof.';
                    break
                case 'Subteniente':
                    this.gradoSec = 'Subtte.';
                    break
                case 'Teniente':
                    this.gradoSec = 'Tte.';
                    break
                case 'Capitán':
                    this.gradoSec = 'Cap.';
                    break
                case 'Mayor':
                    this.gradoSec = 'My.';
                    break
                case 'Teniente Coronel':
                    this.gradoSec = 'Tcnl.';
                    break
                case 'Coronel':
                    this.gradoSec = 'Cnl.';
                    break
                case 'General':
                    this.gradoSec = 'Gnal.';
                    break
                case 'Estudiante':
                    this.gradoSec = 'Est.';
                    break
                case 'Técnico':
                    this.gradoSec = 'Tec.';
                    break
                case 'Licenciado':
                    this.gradoSec = 'Lic.';
                    break
                case 'Ingeniero':
                    this.gradoSec = 'Ing.';
                    break
                case 'Máster':
                    this.gradoSec = 'Msc.';
                    break
                case 'Doctor':
                    this.gradoSec = 'Doc.';
                    break
                default:
                    this.gradoSec = 'Funcionario';
                    break
            }
            if(this.propietario.grupo != 'Ninguno')
            {
                switch (this.cap.grado)
                {
                    case 'Cabo':
                        this.gradoCap = 'Pol.';
                        break
                    case 'Sargento':
                        this.gradoCap = 'Sgto.';
                        break
                    case 'Suboficial':
                        this.gradoCap = 'Sof.';
                        break
                    case 'Subteniente':
                        this.gradoCap = 'Subtte.';
                        break
                    case 'Teniente':
                        this.gradoCap = 'Tte.';
                        break
                    case 'Capitán':
                        this.gradoCap = 'Cap.';
                        break
                    case 'Mayor':
                        this.gradoCap = 'My.';
                        break
                    case 'Teniente Coronel':
                        this.gradoCap = 'Tcnl.';
                        break
                    case 'Coronel':
                        this.gradoCap = 'Cnl.';
                        break
                    case 'General':
                        this.gradoCap = 'Gnal.';
                        break
                    case 'Estudiante':
                        this.gradoCap = 'Est.';
                        break
                    case 'Técnico':
                        this.gradoCap = 'Tec.';
                        break
                    case 'Licenciado':
                        this.gradoCap = 'Lic.';
                        break
                    case 'Ingeniero':
                        this.gradoCap = 'Ing.';
                        break
                    case 'Máster':
                        this.gradoCap = 'Msc.';
                        break
                    case 'Doctor':
                        this.gradoCap = 'Doc.';
                        break
                    default:
                        this.gradoCap = 'Funcionario';
                        break
                }
            }

      this.creacion = moment(String(this.propietario.created_at)).format('YYYY-MM-DD hh:mm')
    },

    mounted(){
      var today = new Date();
      let dia = today.getDate();
      let mes = today.getMonth()+1;
      let anio = today.getFullYear();
      this.diaC = dia;
      this.mesC = mes;
      this.anioC = anio;
    },

    components: {
      moment,
    },
}
</script>
