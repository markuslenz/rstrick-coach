<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, show } from '@/routes/judges'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Eye } from 'lucide-vue-next'

const props = defineProps({
    judge: Object,
    tricks: Array,
})

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Judge Types',
        href: index().url,
    },
    {
        title: 'View Judge Type',
        href: '',
    },
]
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="View Judge Type" />

        <div class="px-4 py-4">
            <h1 class="mb-4 text-2xl font-bold text-heading">{{ judge.name }}</h1>
            <hr />
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Trick</TableHead>
                            <TableHead>Level</TableHead>
                            <TableHead></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="trick in tricks" :key="trick.id">
                            <TableCell>{{  trick.name }}</TableCell>
                            <TableCell>Level {{ trick.level }}</TableCell>
                            <TableCell>
                                <div  class="flex gap-2 align-center">
                                    <Eye class="h-4 w-4"/>
                                    <Link :href="show(judge.id).url">View</Link>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>