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
            <div v-if="$page.props.auth.user" class="flex">
              <a :href="route('auth.candidature')" class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900" :class="route().current('auth.candidature') ? 'border-indigo-500' : 'border-transparent'">Candidatura</a>
              <a v-if="$page.props.auth.user.userRoles.name == 'staff'" :href="route('candidature.index')" class="inline-flex items-center border-b-2 border-indigo-500 px-1 pt-1 text-sm font-medium text-gray-900" :class="route().current('candidature.index') ? 'border-indigo-500' : 'border-transparent'">Gestione candidature</a>
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


          <!-- Profile dropdown -->
          <Menu as="div" class="relative ml-3">
            <div>
              <MenuButton class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="sr-only">Open user menu</span>
                <div v-if="$page.props.auth.user" class="h-12 w-12 rounded-full overflow-hidden">
                    <img :src="$page.props.auth.user.profile_photo_url" alt="">
                </div>
                <div v-else class="h-12 w-12 rounded-full border border-gray-600 border-solid bg-gray-400 flex justify-center items-center text-white">
                    User
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
                </MenuItem>              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="space-y-1 pt-2 pb-4">
        <DisclosureButton as="a" :href="route('guest.home')" class="block border-l-4  py-2 pl-3 pr-4 text-base font-medium" :class="route().current('guest.home') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent bg-transparent text-gray-600'">Home</DisclosureButton>
        <DisclosureButton  v-if="$page.props.auth.user" as="a" :href="route('auth.candidature')" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700" :class="route().current('auth.candidature') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent bg-transparent text-gray-600'">Candidatura</DisclosureButton>
        <DisclosureButton v-if="$page.props.auth.user.userRoles.name == 'staff'" as="a" :href="route('candidature.index')" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700" :class="route().current('candidature.index') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent bg-transparent text-gray-600'">Gestione candidature</DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>

    <main class="">
        <section class="text-center">
            <div class="">
                <h1 class="font-bold text-3xl pt-12 text-gray-600">Benvenuto</h1>
                <p class="text-gray-600">Candidati ora per diventare uno sviluppatore di BitBoss</p>
                <div class="w-full bg-gray-900 max-w-xs py-1 rounded-lg mx-auto hover:bg-gray-800">
                    <a v-if="$page.props.auth.user" :href="route('auth.candidature')" class="block w-full text-white">{{ $page.props.auth.user.candidature ? 'Verifica la tua candidatura' : 'Candidati'}}</a>
                    <a v-else :href="route('auth.candidature')" class="block w-full text-white">Candidati</a>
                </div>
            </div>
        </section>
        <section class="">
            <div class="max-w-5xl mx-auto my-12 px-10">
                <ul>
                    <!-- <li> Mettere il footer sticky in fondo alla pagina
                    </li> -->
                    <!-- <li>Dopo la registrazione, l'utente deve finire sulla pagina per candidarsi.</li> -->
                    <!-- <li> Memorizzare la candidatura dell'utente
                    </li> -->
                    <!-- <li> Associare la candidatura all'utente che l'ha inviata
                    </li> -->
                    <!-- <li> Dare all'utente la possibilità di accedere ad una pagina dove è presente lo stato
                        della sua candidatura (accettata o rifiutata). Al login l'utente viene portato automaticamente
                        su
                        questa pagina.
                    </li> -->
                    <!-- <li>Un utente non può candidarsi più volte</li> -->
                    <!-- <li> Solo gli utenti admin possono accedere alla manipolazione delle candidature
                    </li> -->
                    <li> Notifica quando c’è una nuova candidatura (su Slack + Email agli utenti admin)
                    </li>
                    <!-- <li> Logica di accettazione o scarto dopo che admin ha cliccato sul pulsante
                    </li> -->
                    <!-- <li> Notifica al candidato quando viene accettato o rifiutato
                    </li> -->
                    <li> Popolare il database con un seed delle candidature
                    </li>
                </ul>
                <h2>Quando hai finito</h2>
                <p>Fai il push sul repository. Esamineremo il codice che hai scritto.</p>
                <h2>Cosa esamineremo</h2>
                <p>Guarderemo se il codice funziona e se i requisiti sono rispettati, certo.</p>
                <p>Ma guarderemo anche tutto il resto: la qualità e l'ordine del codice, l'inventiva per risolvere un
                    problema, quanto conosci Laravel, le ottimizzazioni e i piccoli dettagli.</p>
                <p>Non aver paura di usare troppo overengineering, di stravolgere tutto, o, al contrario, di usare la
                    nostra traccia, o di essere troppo banale. Prova - se ti va
                    - a
                    stupirci.</p>
            </div>
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
import { router } from '@inertiajs/vue3';
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

    export default {
        components: {
            Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems,
            Bars3Icon, BellIcon, XMarkIcon,
            ResponsiveNavLink
        },
        methods: {
            logout() {
                router.post(route('logout'));
            },
        }
    }
</script>

<style>

</style>
