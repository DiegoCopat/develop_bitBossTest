<template>
    <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <DisclosureButton class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
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
            <a :href="route('guest.home')" class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-gray-900" :class="route().current('guest.home') ? 'border-indigo-500' : 'border-transparent'">Home</a>
            <a v-if="$page.props.auth.user" :href="route('auth.candidature')" class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900" :class="route().current('auth.candidature') ? 'border-indigo-500' : 'border-transparent'">Candidatura</a>
            <a v-if="$page.props.auth.user.userRoles.name == 'staff'" :href="route('candidature.index')" class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900" :class="route().current('candidature.index') ? 'border-indigo-500' : 'border-transparent'">Gestione candidature</a>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


          <!-- Profile dropdown -->
          <Menu as="div" class="relative ml-3">
            <div>
              <MenuButton class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="sr-only">Open user menu</span>
                <div class="h-12 w-12 rounded-full overflow-hidden">
                    <img :src="$page.props.auth.user.profile_photo_url" alt="">
                </div>
              </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems v-if="$page.props.auth.user" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <MenuItem v-slot="{ active }">
                    <form method="POST" @submit.prevent="logout">
                        <button type="submit" class="w-full text-left" :class="[active ? 'bg-gray-100' : '', ' block px-4 py-2 text-sm text-gray-700']">
                            Log Out
                        </button>
                    </form>
                </MenuItem>
                
              </MenuItems>
              <MenuItems v-else class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <MenuItem v-slot="{ active }">
                  <a :href="route('login')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ $t('Login') }}</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a :href="route('register')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ $t('Register') }}</a>
                </MenuItem>              
            </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="space-y-1 pt-2 pb-4">
        <DisclosureButton as="a" :href="route('guest.home')" class="block border-l-4  py-2 pl-3 pr-4 text-base font-medium" :class="route().current('guest.home') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent bg-transparent text-gray-600'">Home</DisclosureButton>
        <DisclosureButton  v-if="$page.props.auth.user" as="a" :href="route('guest.home')" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700" :class="route().current('auth.candidature') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent bg-transparent text-gray-600'">Candidatura</DisclosureButton>
        <DisclosureButton v-if="$page.props.auth.user.userRoles.name == 'staff'" as="a" :href="route('candidature.index')" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700" :class="route().current('candidature.index') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent bg-transparent text-gray-600'">Gestione candidature</DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>

    <main class="">
      <Green v-if="$page.props.flash.sessionGreen">{{ $page . props . flash . sessionGreen }}</Green>
      <Red v-if="$page.props.flash.sessionRed">{{ $page . props . flash . sessionRed }}</Red>
      <section class="text-center">
        <div class="">
          <h1 class="font-bold text-3xl pt-12 text-gray-600">{{ candidature ? 'Candidatura inviata!' : 'Candidati' }}</h1>
          <p class="text-gray-600">{{ candidature ? 'Controlla lo stato della tua candidatura qui sotto' : 'Presenta la tua candidatura' }}</p>
          
        </div>
      </section>
      <section class="">
            <div v-if="!candidature" class="max-w-5xl mx-auto my-12 px-10">
                <form @submit.prevent="submitNewCandidature" class="grid grid-cols-1 sm:grid-cols-2 gap-3" >
                    <div>
                        <InputLabel class="text-xs" for="first_name" :value="$t('First Name')" />
                        <TextInput
                            id="first_name"
                            v-model="create_new_candidature.first_name"
                            type="text"
                            class="mt-1 block w-full text-sm"
                            required
                            autofocus
                            autocomplete="first_name"
                        />
                        <InputError class="mt-2" :message="create_new_candidature.errors.first_name" />
                    </div>
                    <div>
                        <InputLabel class="text-xs" for="last_name" :value="$t('Last Name')" />
                        <TextInput
                            id="last_name"
                            v-model="create_new_candidature.last_name"
                            type="text"
                            class="mt-1 block w-full text-sm"
                            required
                            autofocus
                            autocomplete="last_name"
                        />
                        <InputError class="mt-2" :message="create_new_candidature.errors.last_name" />
                    </div>
                    <div>
                        <InputLabel class="text-xs" for="email" :value="$t('Email')" />
                        <TextInput
                            id="email"
                            v-model="create_new_candidature.email"
                            type="text"
                            class="mt-1 block w-full text-sm"
                            required
                            autofocus
                            autocomplete="email"
                        />
                        <InputError class="mt-2" :message="create_new_candidature.errors.email" />
                    </div>
                    <div>
                        <InputLabel class="text-xs" for="phone" :value="$t('Phone')" />
                        <TextInput
                            id="phone"
                            v-model="create_new_candidature.phone"
                            type="text"
                            class="mt-1 block w-full text-sm"
                            required
                            autofocus
                            autocomplete="phone"
                        />
                        <InputError class="mt-2" :message="create_new_candidature.errors.phone" />
                    </div>
                    <div class="sm:col-span-2">
                        <InputLabel class="text-xs" for="notes" :value="$t('Notes')" />
                        <textarea class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="phone" cols="30" rows="5" required
                            autofocus v-model="create_new_candidature.notes"></textarea>
                        <InputError class="mt-2" :message="create_new_candidature.errors.notes" />
                    </div>
                    <PrimaryButton type="submit" class=" col-span-2 flex justify-center max-w-md mx-auto w-full">
                      <div>
                        Invia candidatura
                      </div>
                    </PrimaryButton>
                </form>
            </div>
            <div v-else class="max-w-5xl mx-auto my-12 px-10">
              <div class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200 w-full overflow-x-auto">
      <li class=" min-w-[600px]">
        <div class="block hover:bg-gray-50">
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="truncate text-sm font-bold text-indigo-600 capitalize">{{ candidature.first_name }} {{ candidature.last_name }}</p>
              <div class="ml-2 flex flex-shrink-0">
                <p class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 text-gray-800" :class="bg_color_for_candidature_status">{{ candidature.status }}</p>
              </div>
            </div>
            <div class="mt-2 grid grid-cols-6 gap-5">
              <div class="col-span-4">
                <p class="flex items-center text-sm text-gray-500">
                  {{ candidature.notes }}
                </p>
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 col-span-2 flex justify-end">
                <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                <p>
                  Inviata il 
                  {{ ' ' }}
                  <time>{{ candidature.created_at.substr(0, 10) }}</time>
                </p>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>            </div>
        </section>
    </main>
    <footer class="bg-white">
        <div class="sticky bottom-0 left-0 mx-auto max-w-7xl py-12 px-6 md:flex md:items-center md:justify-between lg:px-8">
        <div class="mt-8 md:order-1 md:mt-0 w-full">
            <p class="text-center text-xs leading-5 text-gray-500">In bocca al lupo! © BitBoss srl</p>
        </div>
        </div>
    </footer>
</template>

<script>
// componenti originali
import { router, useForm, usePage } from '@inertiajs/vue3';
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { CalendarIcon, MapPinIcon, UsersIcon } from '@heroicons/vue/20/solid'

import InputLabel from '@/Components/InputLabel.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// componenti personalizzati
import Red from '@/Components/Sessions/Red.vue';
import Green from '@/Components/Sessions/Green.vue';

    export default {
        components: {

          // Componenti originali
            Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems,

            Bars3Icon, BellIcon, XMarkIcon,
            CalendarIcon, MapPinIcon, UsersIcon,

            ResponsiveNavLink, InputLabel, InputError, TextInput, PrimaryButton,

            // Componenti personalizzati
            Green, Red,
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
            if(this.candidature) {
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
