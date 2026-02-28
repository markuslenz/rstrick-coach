<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3'

import AppLayout from '@/layouts/AppLayout.vue'
import { dashboard } from '@/routes'
import { type BreadcrumbItem } from '@/types'
import { useI18n } from 'vue-i18n'

const page = usePage()

const { t } = useI18n()

const user = page.props.auth.user

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: t('ui.dashboard.title'),
        href: dashboard().url,
    },
]

defineProps({
    attempts_all: Number,
    attempts_all_pass: Number,
    attempts_all_pct: Number,
})
</script>

<template>
    <Head :title="t('ui.dashboard.title')" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
                <div class="px-4 py-4 text-2xl font-extrabold">{{ t('ui.dashboard.salutation') }} {{ user.name }}</div>
                <div class="pl-4 pb-5 text-xl">{{ t('ui.dashboard.greetings') }}</div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border-3 border-sidebar-border/70 dark:border-sidebar-border bg-gray-100 text-gray-700"
                >
                    <!--<PlaceholderPattern /> -->
                    <div class="text-2xl font-extrabold text-center py-4">{{ t('ui.dashboard.total_trainings') }}</div>
                    <div class="text-6xl font-extrabold text-center py-4">{{ attempts_all }}</div>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border-3 border-sidebar-border/70 dark:border-sidebar-border bg-gray-100 text-gray-700"
                >
                    <div class="text-2xl font-extrabold text-center py-4">{{ t('ui.dashboard.passed_trainings') }}</div>
                    <div class="text-6xl font-extrabold text-center py-4">{{ attempts_all_pass }}</div>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border-3 border-sidebar-border/70 dark:border-sidebar-border bg-gray-100 text-gray-700"
                >
                    <div class="text-2xl font-extrabold text-center py-4">{{ t('ui.dashboard.success_rate') }}</div>
                    <div class="text-6xl font-extrabold text-center py-4">{{ attempts_all_pct }} %</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
