<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { index, create, edit, destroy, show } from '@/routes/tricks';
import { Rocket } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'


const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Tricks',
        href: index().url,
    },
];

const page = usePage();

const user = page.props.auth.user;

interface Trick {
    id: number,
    name: string,
    url: string,
    level: string,
    judge_id: number,
    description: string,
}

interface Props {
    tricks: Trick[],
}

const handleDelete = (id: number) => {
    router.delete(destroy(id).url);
}

// Get props from Inertia
const props = defineProps<Props>();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Tricks" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <Rocket class="h-4 w-4" />
                <AlertTitle>Notification!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>

            <Button class="mb-3" v-if="user.role == 'admin'">
                <Link :href="create().url">New Trick</Link>
            </Button>

            <Table>
                <TableCaption>A list of all Tricks</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead class="text-center">ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead class="text-center">Level</TableHead>
                        <TableHead>Judge Type</TableHead>
                        <TableHead class="text-center">Action</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="trick in props.tricks" :key="trick.id">
                        <TableCell class="text-center">{{ trick.id }}</TableCell>
                        <TableCell class="font-medium">{{ trick.name }}</TableCell>
                        <TableCell class="text-center">{{ trick.level }}</TableCell>
                        <TableCell>{{ trick.judge.name }}</TableCell>
                        <TableCell class="text-center space-x-2">
                            <Button class="text-xs px-2 py-1.5" v-if="user.role == 'admin'"><Link :href="edit(trick.id).url">Edit</Link></Button>
                            <Button class="text-xs px-2 py-1.5"><Link :href="show(trick.id).url">View</Link></Button>
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button class="bg-red-600 text-xs px-2 py-1.5" v-if="user.role == 'admin'">Delete</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>Delete Judge Type</DialogTitle>
                                        <DialogDescription>
                                            Are you sure you want to delete the Trick <b>{{ trick.name }}</b>?
                                        </DialogDescription>
                                    </DialogHeader>
                                    <DialogFooter>
                                        <DialogClose as-child>
                                            <Button variant="outline">Cancel</Button>
                                        </DialogClose>
                                        <Button class="bg-red-600" @click="handleDelete(trick.id)">Delete</Button>
                                    </DialogFooter>
                                </DialogContent>                                
                            </Dialog>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

    </AppLayout>
</template>