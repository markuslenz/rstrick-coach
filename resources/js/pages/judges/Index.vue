<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { index, create, edit, destroy } from '@/routes/judges';
import { Rocket } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Judge Types',
        href: index().url,
    },
];

const page = usePage();

const user = page.props.auth.user;

const handleDelete = (id: number) => {
    router.delete(destroy(id).url);
}

interface Judge {
    id: number,
    name: string,
}

interface Props{
    judges: Judge[];
}

// Get props from Inertia
const props = defineProps<Props>();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Judge Types" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <Rocket class="h-4 w-4" />
                <AlertTitle>Notification!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>
            
            <Button class="mb-3" v-if="user.role == 'admin'">
                <Link :href="create()">New Judge Type</Link>
            </Button>
            
            <Table>
                <TableCaption>A list of all Judge Types</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead class="text-center">ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead class="text-center">Action</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="judge in props.judges" :key="judge.id">
                        <TableCell class="text-center">{{ judge.id }}</TableCell>
                        <TableCell class="font-medium">{{ judge.name }}</TableCell>
                        <TableCell class="text-center space-x-2">
                            <Button class="text-xs px-2 py-1.5" v-if="user.role == 'admin'"><Link :href="edit(judge.id).url">Edit</Link></Button>
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button class="bg-red-600 text-xs px-2 py-1.5" v-if="user.role == 'admin'">Delete</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>Delete Judge Type</DialogTitle>
                                        <DialogDescription>
                                            Are you sure you want to delete the Judge Type <b>{{ judge.name }}</b>?
                                        </DialogDescription>
                                    </DialogHeader>
                                    <DialogFooter>
                                        <DialogClose as-child>
                                            <Button variant="outline">Cancel</Button>
                                        </DialogClose>
                                        <Button class="bg-red-600" @click="handleDelete(judge.id)">Delete</Button>
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