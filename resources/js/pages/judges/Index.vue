<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, create, edit, destroy, show } from '@/routes/judges'
import { Rocket, MoreHorizontal, Eye, SquarePen, Trash } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Judge Types',
        href: index().url,
    },
]

const page = usePage()

const user = page.props.auth.user

interface Judge {
    id: number,
    name: string,
}

interface Props {
    judges: Judge[];
}

const openDialog = ref(false)

const selectedRowId = ref<Number | null>(null)
const selectedRowName = ref<String | null>(null)

function confirmDelete(id: Number, name: String) {
    selectedRowId.value = id
    selectedRowName.value = name
    openDialog.value = true
}

function deleteRow() {
    if (!selectedRowId.value) return
    router.delete(destroy(selectedRowId.value).url)
    openDialog.value = false
    selectedRowId.value = null
    selectedRowName.value = null
}

// Get props from Inertia
const props = defineProps<Props>()
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
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="text-center">ID</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead class="text-center"></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="judge in props.judges" :key="judge.id">
                            <TableCell class="text-center">{{ judge.id }}</TableCell>
                            <TableCell class="font-medium">{{ judge.name }}</TableCell>
                            <TableCell class="text-center space-x-2">
                                <div v-if="user.role == 'admin'">
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <Button variant="ghost" class="h-8 w-8 p-0">
                                                <span class="sr-only">Open menu</span>
                                                <MoreHorizontal class="h-4 w-4" />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent align="end">
                                            <DropdownMenuLabel>Actions</DropdownMenuLabel>
                                            <DropdownMenuItem class="flex gap-2">
                                                <SquarePen class="h-4 w-4" />
                                                <Link :href="edit(judge.id).url">Edit</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem class="flex gap-2">
                                                <Eye class="h-4 w-4" />
                                                <Link :href="show(judge.id).url">View</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @select.prevent="confirmDelete(judge.id, judge.name)"
                                                class="flex gap-2 text-red-600">
                                                <Trash class="h-4 w-4" />
                                                <span>Delete</span>
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                    <Dialog v-model:open="openDialog">
                                        <DialogContent>
                                            <DialogHeader>
                                                <DialogTitle>Delete Judge Type</DialogTitle>
                                                <DialogDescription>
                                                    Are you sure you want to delete the Judge Type <b>{{ selectedRowName
                                                        }}</b>?
                                                </DialogDescription>
                                            </DialogHeader>
                                            <DialogFooter>
                                                <DialogClose as-child>
                                                    <Button variant="outline">Cancel</Button>
                                                </DialogClose>
                                                <Button class="bg-red-600" @click="deleteRow">Delete</Button>
                                            </DialogFooter>
                                        </DialogContent>
                                    </Dialog>
                                </div>
                                <div class="flex gap-2" v-else>
                                    <Eye class="h-4 w-4" />
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