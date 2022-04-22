<template>
    <div class="container" data-app>
        <h3>Screening Form</h3>
        <v-form
            ref="screeningForm"
            v-model="valid"
            lazy-validation
        >
            <label class="text1">
                Firstname:
                <v-icon size="10" color="red" class="mb-3">mdi-star</v-icon>
            </label>
            <v-text-field
                v-model="firstname"
                :rules="firstnameRules"
                label="First name"
                solo
                required
            />

            <!-- D-O-B -->
            <label class="text1">
                Date of birth:
                <v-icon size="10" color="red" class="mb-3">mdi-star</v-icon>
            </label>
            <v-menu
                ref="menu"
                v-model="menu"
                :close-on-content-click="false"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        solo
                        v-model="dateOfBirth"
                        label="Birthday date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        :rules="dateOfBirthRules"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="dateOfBirth"
                    :active-picker.sync="activePicker"
                    :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
                    min="1950-01-01"
                    @change="save"
                ></v-date-picker>
            </v-menu>
            <!-- End D-O-B -->

            <label class="text1">
                Migraine headaches frequency:
                <v-icon size="10" color="red" class="mb-3">mdi-star</v-icon>
            </label>
            <v-select
                solo
                v-model="headacheFrequency"
                :rules="headacheFrequencyRules"
                :items="items"
                filled
                label="Select headache frequency"
            ></v-select>
            <div v-if="this.eligibility.data === 'over 18'">
                <label class="text1">Please, specify your migraine level:
                    <v-icon size="10" color="red" class="mb-3">mdi-star</v-icon>
                </label>
                <v-select
                    solo
                    v-model="headacheLevel"
                    :items="headacheLevelItems"
                    :rules="headacheLevelItemsRules"
                    filled
                    label="Select headacheLevel"
                ></v-select>
            </div>

            <v-btn
                class="deep--orange"
                @click="submitScreeningForm"
            >
                Submit
            </v-btn>
            <v-card-text class="red">
                <span v-if="this.eligibility.data === 'under 18'">
                    Your must be over 18
                </span>
                <span v-else-if="this.error !== ''">
                    {{ this.error }}
                </span>
            </v-card-text>

        </v-form>
    </div>
</template>

<script>
import Vuetify from "vuetify";

export default {
    name: "screening-form",
    vuetify: new Vuetify(),
    data: (vm) => ({
        firstname: '',
        firstnameRules: [
            v => !!v || 'First Name is required',
            v => /[a-zA-Z]+$/.test(v) || 'First Name must be non digit characters',
        ],
        activePicker: null,
        dateOfBirth: '',
        dateOfBirthRules: [
            v => !!v || 'Date of birth is required',
        ],
        menu: false,
        items: ['Monthly', 'Weekly', 'Daily'],
        headacheFrequency: '',
        headacheFrequencyRules: [
            v => !!v || 'Headache frequency is required',
        ],
        dialog: false,
        headacheLevelItems: ['1-2', '2-3', '5+'],
        headacheLevelItemsRules: [
            v => !!v || 'Headache level is required',
        ],
        headacheLevel: '',
        responseData: {},
        eligibility: '',
        valid: false,
        error: ''
    }),
    methods:{
        save (dateOfBirth) {
            this.$refs.menu.save(dateOfBirth)
            const formData = {
                dateOfBirth: this.dateOfBirth
            };
            const headers = {
                "Authorization": "Bearer my-token",
                "My-Custom-Header": "Custom header"
            };
            return axios.post("/api/checkEligibilitys", formData, {headers})
                .then(response => this.eligibility = response.data)
                .catch(err => console.log(err));
        },
        submitScreeningForm(){

            if(this.$refs.screeningForm.validate() === true) {

                this.error = ''

                const formData = {
                    firstname: this.firstname,
                    dateOfBirth: this.dateOfBirth,
                    headacheFrequency: this.headacheFrequency,
                    headacheLevel: this.headacheLevel
                };
                const headers = {
                    "Authorization": "Bearer my-token",
                    "My-Custom-Header": "Custom header"
                };
                axios.post("/api/screenings", formData, { headers })
                    .then(function(response){
                        console.log(response.data.data)
                        localStorage.setItem("responseValue", response.data.data);
                        window.location.href = "/result-page"
                    })
                    .catch(function(err){
                        console.log(err)
                    });
            }
            else{
                this.error = "Please, fill all the necessary fields!"
            }
        }
    },
    watch: {
        menu(val) {
            val && setTimeout(() => (this.activePicker = 'YEAR'))
        },
    }
}
</script>

<style scoped>

</style>

