<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, show } from '@/routes/tricks'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const props = defineProps({ 
    trick: Object, 
    judge: Object 
})


const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.tricks.title'),
        href: index().url,
    },
    {
        title: t('ui.tricks.view'),
        href: show(props.trick.id).url,
    },
]
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head :title="t('ui.tricks.view')" />

        <div class="px-4 py-4">
            <h1 class="mb-4 text-2xl font-bold text-heading">Trick: {{ props.trick.name }}</h1>

            <div class="youtube-container" v-if="props.trick.youtube">
                <iframe
                    :src="props.trick.youtube + '?autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1'"
                    title="YouTube video player" 
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                >
                </iframe>
            </div>
            <div v-if="props.trick.video_url">
                <video controls width="100%" :src="'/storage/' + props.trick.video_url"></video>
            </div>
            <div class="space-x-4 pt-6">
                <span class="font-bold">{{ t('forms.level') }}:</span>
                <span>{{ props.trick.level }}</span>
            </div>
            <div class="space-x-4">
                <span class="font-bold">{{ t('forms.judge') }}:</span>
                <span>{{ props.judge.name }}</span>
            </div>
            <div class="space-x-4">
                <span class="font-bold">{{ t('forms.description') }}:</span>
                <span>{{ props.trick.description }}</span>
            </div>
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