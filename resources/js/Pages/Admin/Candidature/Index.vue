<template>
    <AppLayout title="Gestione Candidature">

        <!-- inizio sezione jumbotron -->
        <template #jumbotron>
            <section class="text-center">
                <div class="">
                    <h1 class="font-bold text-3xl pt-12 text-gray-600">
                        {{ candidature ? 'Candidatura inviata!' : 'Candidati' }}</h1>
                    <p class="text-gray-600">
                        {{ candidature ? 'Controlla lo stato della tua candidatura qui sotto' : 'Presenta la tua candidatura' }}
                    </p>

                </div>
            </section>

        </template>
        <!-- fine sezione jumbotron -->
        <!-- inizio sezione del contenuto del main -->
        <template #main_content>
            <section class="">
                <div class="max-w-5xl mx-auto my-12 px-10">
                    <div class="overflow-hidden bg-white shadow sm:rounded-md">

                        <!-- inizio tabella delle candidature -->
                        <ul role="list" class="divide-y divide-gray-200 w-full overflow-x-auto max-h-[85vh]">
                            <li class=" min-w-[600px]" v-for="candidature in candidatures" :key="candidature.id">
                                <CandidatureCard :candidature="candidature"></CandidatureCard>
                            </li>
                        </ul>
                        <!-- inizio tabella delle candidature -->

                    </div>
                </div>
            </section>

        </template>
        <!-- fine sezione del contenuto del main -->

    </AppLayout>
</template>

<script>
    // componenti originali

    // componenti personalizzati
    import AppLayout from '@/Layouts/AppLayout.vue';
    import CandidatureCard from '@/Components/Partials/Candidature/CandidatureCard.vue';

    export default {
        components: {

            // Componenti personalizzati
            AppLayout,
            CandidatureCard,
        },

        props: {
            candidatures: Object,
        },
    }
</script>

<style>

</style>
