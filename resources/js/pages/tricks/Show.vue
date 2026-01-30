<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { index, show } from '@/routes/tricks';

const props = defineProps({ trick: Object, judge: Object })


const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Tricks',
        href: index().url,
    },
    {
        title: 'View Trick',
        href: '',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="View Trick" />

        <div class="px-4 py-4">
            <h1 class="mb-4 text-2xl font-bold text-heading">Trick: {{ trick.name }}</h1>

            <div class="youtube-container">
                <iframe
                    :src="trick.url + '?autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1'"
                    title="YouTube video player" 
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                >
                </iframe>
            </div>
            <div>Difficulty Level: {{ trick.level }}</div>
            <div>Difficulty Judge: {{ judge.name }}</div>
            <div>Description: {{ trick.description }}</div>
        </div>
    </AppLayout>
</template>

<style scoped>
.youtube-container {
    /* overflow: hidden; */
    width: 100%;
    /* Keep it the right aspect-ratio */
    aspect-ratio: 16/9;
    /* No clicking/hover effects */
    /* pointer-events: none; */

    iframe {
        /* Extend it beyond the viewport... */
        width: 300%;
        height: 100%;
        /* ...and bring it back again */
        margin-left: -100%;
    }
}
</style>