
<template>
    <svg @click="close-session-red" :height="height" :width="width" :class="[fill, bgColor ]" version="1.1" viewBox="0 0 700 500" xmlns="http://www.w3.org/2000/svg">
 <g fill-rule="evenodd">
  <path d="m140 294.84h418.14l8.75-8.75v-41.055l-8.75-8.75h-418.14l-8.75 8.75v41.055z"/>
  <path d="m551.25 148.79h17.5v52.5h-17.5z"/>
  <path d="m133.11 148.79h17.5v52.5h-17.5z"/>
  <path d="m141.86 166.29h419.18v17.5h-419.18z"/>
  <path d="m157.5 396.78h-17.5l-8.75-8.75v-140.18l8.75-8.75h420l8.75 8.75v140.18l-8.75 8.75h-18.586v-21.926h-17.5v21.926h-17.5v-61.25h-17.5v61.25h-13.773v-21.926h-17.5v21.926h-17.5v-61.25h-17.5v61.25h-13.789v-21.926h-17.5v21.926h-17.5v-61.25h-17.5v61.25h-13.789v-21.926h-17.5v21.926h-17.5v-61.25h-17.5v61.25h-13.773v-21.926h-17.5v21.926h-17.5v-61.25h-17.5v61.25h-13.789v-21.926h-17.5v21.926h-17.5v-61.25h-17.5z"/>
 </g></svg>
</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent({
        props: {
            height: {
                type: Number,
                default: 20,
            },
            width: {
                type: Number,
                default: 20,
            },
            fill: {
                type: String,
                default: 'inherit',
            },
            bgColor: {
                type: String,
                default: 'inherit',
            }
        }
    });
</script>
