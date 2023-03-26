<template>

    <AppLayout title="Home"> 

      <!-- inizio sezione jumbotron -->
      <template #jumbotron>
        <section class="text-center">
            <div class="">
                <h1 class="font-bold text-3xl pt-12 text-gray-600">Benvenuto</h1>
                <p class="text-gray-600">Candidati ora per diventare uno sviluppatore di BitBoss</p>
                <div v-if="$page.props.auth.user" class="w-full bg-gray-900 max-w-xs py-1 rounded-lg mx-auto hover:bg-gray-800">
                    <a :href="route('auth.candidature')" class="block w-full text-white">{{ $page.props.auth.user.candidature ? 'Verifica la tua candidatura' : 'Candidati'}}</a>
                  </div>
                <div v-else class="w-full bg-gray-900 max-w-xs py-1 rounded-lg mx-auto hover:bg-gray-800">
                  <a  :href="route('auth.candidature')" class="block w-full text-white">Candidati</a>
                  </div>
                
            </div>
        </section>
      </template>
      <!-- fine sezione jumbotron -->

      <!-- inizio sezione del contenuto del main -->
      <template #main_content>
        <section class="">
            <div class="max-w-5xl mx-auto my-12 px-10">
                <ul>
                    <li> Mettere il footer sticky in fondo alla pagina
                    </li>
                    <li>Dopo la registrazione, l'utente deve finire sulla pagina per candidarsi.</li>
                    <li> Memorizzare la candidatura dell'utente
                    </li>
                    <li> Associare la candidatura all'utente che l'ha inviata
                    </li>
                    <li> Dare all'utente la possibilità di accedere ad una pagina dove è presente lo stato
                        della sua candidatura (accettata o rifiutata). Al login l'utente viene portato automaticamente
                        su
                        questa pagina.
                    </li>
                    <li>Un utente non può candidarsi più volte</li>
                    <li> Solo gli utenti admin possono accedere alla manipolazione delle candidature
                    </li>
                    <li> Notifica quando c’è una nuova candidatura (su Slack + Email agli utenti admin)
                    </li>
                    <li> Logica di accettazione o scarto dopo che admin ha cliccato sul pulsante
                    </li>
                    <li> Notifica al candidato quando viene accettato o rifiutato
                    </li>
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
      </template>
      <!-- fine sezione del contenuto del main -->

    </AppLayout>

</template>

<script>
// componenti originali
import { router } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/AppLayout.vue';

    export default {
        components: {
            AppLayout,
        },
    }
</script>

<style>

</style>
