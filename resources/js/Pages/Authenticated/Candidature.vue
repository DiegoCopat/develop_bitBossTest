<template>
    <AppLayout title="Invio Candidatura">

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
                <div v-if="!candidature" class="max-w-5xl mx-auto my-12 px-10">

                    <!-- inizio form di candidatura -->
                    <form @submit.prevent="submitNewCandidature" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <InputLabel class="text-xs" for="first_name" :value="$t('First Name')" />
                            <TextInput id="first_name" v-model="create_new_candidature.first_name" type="text"
                                class="mt-1 block w-full text-sm" required autofocus autocomplete="first_name" />
                            <InputError class="mt-2" :message="create_new_candidature.errors.first_name" />
                        </div>
                        <div>
                            <InputLabel class="text-xs" for="last_name" :value="$t('Last Name')" />
                            <TextInput id="last_name" v-model="create_new_candidature.last_name" type="text"
                                class="mt-1 block w-full text-sm" required autofocus autocomplete="last_name" />
                            <InputError class="mt-2" :message="create_new_candidature.errors.last_name" />
                        </div>
                        <div>
                            <InputLabel class="text-xs" for="email" :value="$t('Email')" />
                            <TextInput id="email" v-model="create_new_candidature.email" type="text"
                                class="mt-1 block w-full text-sm" required autofocus autocomplete="email" />
                            <InputError class="mt-2" :message="create_new_candidature.errors.email" />
                        </div>
                        <div>
                            <InputLabel class="text-xs" for="phone" :value="$t('Phone')" />
                            <TextInput id="phone" v-model="create_new_candidature.phone" type="text"
                                class="mt-1 block w-full text-sm" required autofocus autocomplete="phone" />
                            <InputError class="mt-2" :message="create_new_candidature.errors.phone" />
                        </div>
                        <div class="sm:col-span-2">
                            <InputLabel class="text-xs" for="notes" :value="$t('Notes')" />
                            <textarea
                                class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                id="phone" cols="30" rows="5" required autofocus v-model="create_new_candidature.notes"></textarea>
                            <InputError class="mt-2" :message="create_new_candidature.errors.notes" />
                        </div>
                        <PrimaryButton type="submit"
                            class=" sm:col-span-2 flex justify-center max-w-md mx-auto w-full">
                            <div>
                                Invia candidatura
                            </div>
                        </PrimaryButton>
                    </form>
                    <!-- fine form di candidatura -->

                </div>
                <div v-else class="max-w-5xl mx-auto my-12 px-10">
                    <div class="overflow-hidden bg-white shadow sm:rounded-md">
                        <ul role="list" class="divide-y divide-gray-200 w-full overflow-x-auto">
                            <li class=" min-w-[600px]">
                                <div class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <p class="truncate text-sm font-bold text-indigo-600 capitalize">
                                                {{ candidature . first_name }} {{ candidature . last_name }}</p>
                                            <div class="ml-2 flex flex-shrink-0">
                                                <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 text-gray-800"
                                                    :class="bg_color_for_candidature_status">{{ candidature . status }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2 grid grid-cols-6 gap-5">
                                            <div class="col-span-4">
                                                <p class="flex items-center text-sm text-gray-500">
                                                    {{ candidature . notes }}
                                                </p>
                                            </div>
                                            <div
                                                class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 col-span-2 flex justify-end">
                                                <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                    aria-hidden="true" />
                                                <p>
                                                    Inviata il
                                                    {{ ' ' }}
                                                    <time>{{ candidature . created_at . substr(0, 10) }}</time>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </template>
        <!-- fine sezione del contenuto del main -->

    </AppLayout>
</template>

<script>
    // componenti originali
    import {
        router,
        useForm,
        usePage
    } from '@inertiajs/vue3';
    import {
        CalendarIcon,
        MapPinIcon,
        UsersIcon
    } from '@heroicons/vue/20/solid'

    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import TextInput from '@/Components/TextInput.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    // componenti personalizzati
    import AppLayout from '@/Layouts/AppLayout.vue';

    export default {
        components: {

            // Componenti originali

            CalendarIcon,
            MapPinIcon,
            UsersIcon,

            InputLabel,
            InputError,
            TextInput,
            PrimaryButton,

            // Componenti personalizzati
            AppLayout,
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
        methods: {

            // funzione per l'invio della candidatura
            submitNewCandidature() {
                this.create_new_candidature.submit('post', route('auth.candidature.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.create_new_candidature.reset();
                    }
                })
            },
            // funzione per il logout
            logout() {
                router.post(route('logout'));
            },
        },
        mounted() {
            const user = usePage().props.auth.user;
            this.create_new_candidature.first_name = user.name.split(" ")[0];
            this.create_new_candidature.last_name = user.name.split(" ")[1];
            this.create_new_candidature.email = user.email;
        }
    }
</script>

<style>

</style>
