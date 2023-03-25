<template>
    <div class="block hover:bg-gray-50">
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <p class="truncate text-sm font-bold text-indigo-600 capitalize">{{ candidature . first_name }}
                    {{ candidature . last_name }}</p>
                <div class="ml-2 flex flex-shrink-0">
                    <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 text-gray-800"
                        :class="bg_color_for_candidature_status">{{ candidature . status }}</p>
                </div>
            </div>
            <div class="mt-2 grid grid-cols-6 gap-5">
                <div class="col-span-4">
                    <p class="flex items-center text-sm text-gray-500">
                        {{ candidature . notes }}
                    </p>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 col-span-2 flex-col items-end justify-center gap-4">
                    <form @submit.prevent="changeStatusOfCandidature(candidature.id)" class="ml-auto text-xs">
                        <select class="text-xs rounded-lg" name="" id="" v-model="change_status_of_candidature">
                            <option class="text-xs" value="in verifica">in verifica</option>
                            <option class="text-xs" value="approvato">In approvato</option>
                            <option class="text-xs" value="rifiutato">rifiutato</option>
                        </select>
                    </form>
                    <div class="flex justify-end ml-auto">
                        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                        <p>
                            Inviata il
                            {{ ' ' }}
                            <time>{{ candidature . created_at . substr(0, 10) }}</time>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // componenti originali
    import {
        CalendarIcon
    } from '@heroicons/vue/20/solid'
import { usePage } from '@inertiajs/vue3';

    export default {
        components: {
            CalendarIcon,
        },
        data() {
            return {
                change_status_of_candidature: this.candidature.status,
            }
        },
        props: {
            candidature: Object,
        },
        watch: {
            change_status_of_candidature() {
                this.changeStatusOfCandidature(this.candidature.id);
            }
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
            async changeStatusOfCandidature(candidature_id) {
                await axios.patch(route('candidature.update', candidature_id), {
                    change_to: this.change_status_of_candidature,
                })
                .then(response => {
                    this.candidature.status = response.data.candidature_status;
                    usePage().props.flash.sessionGreen = response.data.sessionGreen;
                })
            }
        }

    }
</script>

<style>

</style>
