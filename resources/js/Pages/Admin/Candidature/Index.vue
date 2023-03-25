<template>
    <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="font-bold flex flex-shrink-0 items-center text-gray-600">
                        BitBossTest
                    </div>
                    <div class="hidden sm:ml-16 sm:flex sm:space-x-8 ">
                        <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                        <a :href="route('guest.home')"
                            class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-gray-900"
                            :class="route().current('guest.home') ? 'border-indigo-500' : 'border-transparent'">Home</a>
                        <a v-if="$page.props.auth.user" :href="route('auth.candidature')"
                            class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900"
                            :class="route().current('auth.candidature') ? 'border-indigo-500' : 'border-transparent'">Candidatura</a>
                        <a v-if="$page.props.auth.user.userRoles.name == 'staff'" :href="route('candidature.index')"
                            class="relative inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900"
                            :class="route().current('candidature.index') ? 'border-indigo-500' : 'border-transparent'">
                            Gestione candidature
                            <div v-if="candidatures.find(candidature => candidature.status == 'in verifica')" class="absolute bottom-[-10px] right-[-10px] bg-red-200 px-2 h-6 rounded-full flex justify-center items-center">
                                new
                            </div>
                        </a>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


                    <!-- Profile dropdown -->
                    <Menu as="div" class="relative ml-3">
                        <div>
                            <MenuButton
                                class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Open user menu</span>
                                <div class="h-12 w-12 rounded-full overflow-hidden">
                                    <img :src="$page.props.auth.user.profile_photo_url" alt="">
                                </div>
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-200"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems v-if="$page.props.auth.user"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem v-slot="{ active }">
                                <form method="POST" @submit.prevent="logout">
                                    <button type="submit" class="w-full text-left"
                                        :class="[active ? 'bg-gray-100' : '', ' block px-4 py-2 text-sm text-gray-700']">
                                        Log Out
                                    </button>
                                </form>
                                </MenuItem>

                            </MenuItems>
                            <MenuItems v-else
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem v-slot="{ active }">
                                <a :href="route('login')"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ $t('Login') }}</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <a :href="route('register')"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ $t('Register') }}</a>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="space-y-1 pt-2 pb-4">
                <DisclosureButton as="a" :href="route('guest.home')"
                    class="block border-l-4  py-2 pl-3 pr-4 text-base font-medium"
                    :class="route().current('guest.home') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' :
                        'border-transparent bg-transparent text-gray-600'">
                    Home</DisclosureButton>
                <DisclosureButton v-if="$page.props.auth.user" as="a" :href="route('guest.home')"
                    class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700"
                    :class="route().current('auth.candidature') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' :
                        'border-transparent bg-transparent text-gray-600'">
                    Candidatura</DisclosureButton>
                <DisclosureButton v-if="$page.props.auth.user.userRoles.name == 'staff'" as="a"
                    :href="route('candidature.index')"
                    class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700"
                    :class="route().current('candidature.index') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' :
                        'border-transparent bg-transparent text-gray-600'">
                    Gestione candidature</DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>

    <main class="">
        <Green v-if="$page.props.flash.sessionGreen">{{ $page . props . flash . sessionGreen }}</Green>
        <Red v-if="$page.props.flash.sessionRed">{{ $page . props . flash . sessionRed }}</Red>
        <section class="text-center">
            <div class="">
                <h1 class="font-bold text-3xl pt-12 text-gray-600">
                    {{ candidature ? 'Candidatura inviata!' : 'Candidati' }}</h1>
                <p class="text-gray-600">
                    {{ candidature ? 'Controlla lo stato della tua candidatura qui sotto' : 'Presenta la tua candidatura' }}
                </p>

            </div>
        </section>
        <section class="">
            <div class="max-w-5xl mx-auto my-12 px-10">
                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200 w-full overflow-x-auto">
                        <li class=" min-w-[600px]" v-for="candidature in candidatures" :key="candidature.id">
                            <CandidatureCard :candidature="candidature"></CandidatureCard>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-white">
        <div
            class="sticky bottom-0 left-0 mx-auto max-w-7xl py-12 px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="mt-8 md:order-1 md:mt-0 w-full">
                <p class="text-center text-xs leading-5 text-gray-500">In bocca al lupo! © BitBoss srl</p>
            </div>
        </div>
    </footer>
</template>

<script>
    // componenti originali
    import {
        router,
        useForm,
        usePage
    } from '@inertiajs/vue3';
    import {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems
    } from '@headlessui/vue';
    import {
        Bars3Icon,
        BellIcon,
        XMarkIcon
    } from '@heroicons/vue/24/outline';
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
    import Red from '@/Components/Sessions/Red.vue';
    import Green from '@/Components/Sessions/Green.vue';
    import CandidatureCard from '@/Components/Partials/Candidature/CandidatureCard.vue';

    export default {
        components: {

            // Componenti originali
            Disclosure,
            DisclosureButton,
            DisclosurePanel,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,

            Bars3Icon,
            BellIcon,
            XMarkIcon,
            CalendarIcon,
            MapPinIcon,
            UsersIcon,

            ResponsiveNavLink,
            InputLabel,
            InputError,
            TextInput,
            PrimaryButton,

            // Componenti personalizzati
            Green,
            Red,
            CandidatureCard,
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
            candidatures: Object,
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
        mounted() {}
    }
</script>

<style>

</style>
