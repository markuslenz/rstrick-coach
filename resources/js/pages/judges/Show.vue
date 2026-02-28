<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import judgeRoutes from '@/routes/judges'
import trickRoutes from '@/routes/tricks'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Eye } from 'lucide-vue-next'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const props = defineProps({
    judge: Object,
    tricks: Array,
})

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.judges.title'),
        href: judgeRoutes.index().url,
    },
    {
        title: t('ui.judges.view'),
        href: judgeRoutes.show(props.judge.id).url,
    },
]
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head :title="t('ui.judges.title')" />

        <div class="px-4 py-4">
            <h1 class="mb-4 text-2xl font-bold text-heading">{{ judge.name }}</h1>
            <hr />
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>{{ t('forms.trick_name') }}</TableHead>
                            <TableHead class="text-center">{{ t('forms.level') }}</TableHead>
                            <TableHead></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="trick in props.tricks" :key="trick.id">
                            <TableCell>{{ trick.name }}</TableCell>
                            <TableCell class="text-center">{{ trick.level }}</TableCell>
                            <TableCell>
                                <div>
                                    <Link :href="trickRoutes.show(trick.id).url"  class="inline-icon-text">
                                        <Eye class="h-4 w-4" />
                                        {{ t('buttons.view') }}
                                    </Link>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.inline-icon-text {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}
</style>