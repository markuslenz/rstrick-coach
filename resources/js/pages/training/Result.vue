<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Button } from '@/components/ui/button'
import { Smile, Annoyed } from 'lucide-vue-next'
import { show } from '@/routes/trainings'

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Training',
        href: '',
    },
];

const props = defineProps({ 
    result: Object,
    trick: Object,
    judgeID: Number,
})

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Result" />
    
        <div class="px-4 py-4">
            <Table>
                <TableHeader>
                    <TableRow class="bg-gray-200">
                        <TableHead class="font-extrabold">Question</TableHead>
                        <TableHead class="font-extrabold">Your Answer</TableHead>
                        <TableHead class="font-extrabold">Trick</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow>
                        <TableCell>Difficulty Judge</TableCell>
                        <TableCell>{{ props.result.judge.name }}</TableCell>
                        <TableCell>{{ props.trick.judge.name }}</TableCell>
                    </TableRow>
                    <TableRow>
                        <TableCell>Level</TableCell>
                        <TableCell>{{ props.result.level }}</TableCell>
                        <TableCell>{{ props.trick.level }}</TableCell>
                    </TableRow>
                    <TableRow>
                        <TableCell>Trick name</TableCell>
                        <TableCell>{{ props.result.trick_name }}</TableCell>
                        <TableCell>{{ props.trick.name }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            <div class="container py-2 px-2 mx-0 min-w-full flex flex-col items-center">
                <div class="flex bg-green-200 px-4 py-4 rounded-lg" v-if="props.result.is_correct == true">
                    <div class="flex-1"><Smile class="h-20 w-20 text-green-800"/></div>
                    <div class="flex-1 text-3xl font-extrabold text-green-800">Yes, correct!</div>
                
                </div>
                <div class="flex bg-red-200 px-4 py-4 rounded-lg" v-else>
                    <div class="flex-1"><Annoyed class="h-20 w-20 text-red-700" /></div>
                    <div class="flex-1 text-3xl font-extrabold text-red-700">Sorry, that's wrong</div>
                </div>
            </div>
            <div class="container py-2 px-2 mx-0 min-w-full flex flex-col items-center">
                <Button class="inline-flex items-center justify-center w-8/12 font-bold" size="lg">
                    <Link v-if="judgeID" :href="show(judgeID).url">Next Trick</Link>
                    <Link v-else :href="show().url">Next Trick</Link>
                </Button>
            </div>
        </div>
    </AppLayout>
</template>