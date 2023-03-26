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
                        <div v-if="$page.props.auth.user" class="flex gap-8">
                            <a :href="route('auth.candidature')"
                                class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900"
                                :class="route().current('auth.candidature') ? 'border-indigo-500' : 'border-transparent'">Candidatura</a>
                            <a v-if="$page.props.auth.user.userRoles.name == 'staff'" :href="route('candidature.index')"
                                class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900"
                                :class="route().current('candidature.index') ? 'border-indigo-500' : 'border-transparent'">Gestione
                                candidature</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


                    <!-- Profile dropdown -->
                    <Menu as="div" class="relative ml-3">
                        <div>
                            <MenuButton
                                class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Open user menu</span>
                                <div v-if="$page.props.auth.user" class="h-12 w-12 rounded-full overflow-hidden">
                                    <img :src="$page.props.auth.user.profile_photo_url" alt="">
                                </div>
                                <div v-else class="h-12 w-12 rounded-full overflow-hidden bg-gray-300 text-white flex items-center justify-center">
                                    user
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

</template>

<script>
    // componenti originali
    import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
    import {
        Bars3Icon,
        BellIcon,
        XMarkIcon
    } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';


    export default {

        components: {

            // Componenti originali
            Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems,
            Bars3Icon,
            BellIcon,
            XMarkIcon,


        },
        methods: {

            // funzione per il logout
            logout() {
                router.post(route('logout'));
            },

        }

    }
</script>

<style>

</style>
