<template>

    <Head :title="title" />

    <Header />

    <Sessions />

    <main class="">

        <slot name="jumbotron" />

        <slot name="main_content" />
    </main>

    <Footer />

</template>

<script>
    // componenti originali
    import {
        router,
        useForm,
        usePage,
        Head,
    } from '@inertiajs/vue3';
    import {
        CalendarIcon,
        MapPinIcon,
        UsersIcon
    } from '@heroicons/vue/20/solid'

    import InputLabel from '@/Components/InputLabel.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import InputError from '@/Components/InputError.vue';
    import TextInput from '@/Components/TextInput.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    // componenti personalizzati
    import Sessions from '@/Layouts/Partials/Sessions.vue';
    import Header from '@/Layouts/Partials/Header.vue';
    import Footer from '@/Layouts/Partials/Footer.vue';

    export default {
        components: {

            // Componenti originali
            Head,

            CalendarIcon,
            MapPinIcon,
            UsersIcon,

            ResponsiveNavLink,
            InputLabel,
            InputError,
            TextInput,
            PrimaryButton,

            // Componenti personalizzati
            Sessions,
            Header,
            Footer,
        },
        data() {
            return {
                // form per la creazione di una candidatura
                create_new_candidature: useForm({
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    notes: '',
                })
            }
        },
        props: {
            title: String,
            candidature: Object,
        },
        computed: {
            bg_color_for_candidature_status() {
                if (this.candidature) {
                    switch (this.candidature.status) {
                        case 'in verifica':
                            return 'bg-amber-200';
                        case 'approvato':
                            return 'bg-green-100';
                        case 'rifiutato':
                            return 'bg-red-100';
                    }
                }
            }
        },

    }
</script>

<style>

</style>
