<template>

    <!-- sessione di conferma -->
    <Green v-if="$page.props.flash.sessionGreen">{{ $page . props . flash . sessionGreen }}</Green>
    <!-- sessione di errore -->
    <Red v-if="$page.props.flash.sessionRed">{{ $page . props . flash . sessionRed }}</Red>

</template>

<script>

    // componenti personalizzati
    import Red from '@/Components/Sessions/Red.vue';
    import Green from '@/Components/Sessions/Green.vue';

    export default {
        components: {

            // Componenti personalizzati
            Green, 
            Red,

        },    
    }

</script>

<style>

</style>