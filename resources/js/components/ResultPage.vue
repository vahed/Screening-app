<template>
    <div>
        <v-card-actions class="justify-center">
            <v-card-title class="red--text">{{ getVal }}</v-card-title>
        </v-card-actions>
    </div>
</template>

<script>
export default {
    name: "result-page",
    computed:{
        getVal(){
            let responseValue = localStorage.getItem("responseValue");
            let resetValue = '';
            localStorage.setItem("responseValue", resetValue);
            return responseValue
        }
    },
}
</script>

<style scoped>

</style>
