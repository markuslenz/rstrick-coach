<script setup lang="ts">
import { Link, Head, usePage } from '@inertiajs/vue3'

import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, show } from '@/routes/trainings'

const page = usePage()

const user = page.props.auth.user

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Training',
        href: index().url,
    },
]

interface Judge {
    id: number,
    name: string,
}

interface Props {
    judges: Judge[],
}

// Get props from Inertia
const props = defineProps<Props>()

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Trainings" />

        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="px-4 py-4 text-2xl font-extrabold">Hi {{ user.name }}</div>
            <div class="pl-4 pb-5 text-xl">Which kind of training do you want to start today?</div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border-3 border-sidebar-border/70 dark:border-sidebar-border bg-gray-100 text-gray-700 pt-10">
                    <div class="text-2xl font-extrabold text-center py-4">
                        <Link :href="show()">All Difficulties</Link>
                    </div>
                </div>
                <div 
                    v-for="judge in props.judges" 
                    :key="judge.id"
                    class="relative aspect-video overflow-hidden rounded-xl border-3 border-sidebar-border/70 dark:border-sidebar-border bg-gray-100 text-gray-700 pt-10"
                >
                    <div class="text-2xl font-extrabold text-center py-4">
                        <Link :href="show(judge.id)">{{ judge.name }}</Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>