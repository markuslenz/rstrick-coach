<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3'

import AppLayout from '@/layouts/AppLayout.vue'
import { index, edit, destroy } from '@/routes/users'
import { type BreadcrumbItem } from '@/types'
import { Rocket } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: index().url,
    },
]

const page = usePage()

const admin = page.props.auth.user

interface User {
    id: number,
    name: string,
    email: string,
    role: string,
}

interface Props {
    users: User[],
}

// Get props from Inertia
const props = defineProps<Props>()

const handleDelete = (id: number) => {
    router.delete(destroy(id).url)
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Users" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <Rocket class="h-4 w-4" />
                <AlertTitle>Notification!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>

            <Table>
                <TableCaption>A list of all users</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead class="text-center">ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Role</TableHead>
                        <TableHead class="text-center">Action</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user in props.users" :key="user.id">
                        <TableCell class="text-center">{{ user.id }}</TableCell>
                        <TableCell>{{ user.name }}</TableCell>
                        <TableCell>{{ user.email }}</TableCell>
                        <TableCell>{{ user.role }}</TableCell>
                        <TableCell class="text-center space-x-2">
                            <Button class="text-xs px-2 py-1.5" v-if="user.id !== admin.id">
                                <Link :href="edit(user.id).url">Edit</Link>
                            </Button>
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button class="bg-red-600 text-xs px-2 py-1.5" v-if="user.id !== admin.id">Delete</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>Delete User</DialogTitle>
                                        <DialogDescription>
                                            Are you sure you want to delete the User <b>{{ user.name }}</b>?
                                        </DialogDescription>
                                    </DialogHeader>
                                    <DialogFooter>
                                        <DialogClose as-child>
                                            <Button variant="outline">Cancel</Button>
                                        </DialogClose>
                                        <Button class="bg-red-600" @click="handleDelete(user.id)">Delete</Button>
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