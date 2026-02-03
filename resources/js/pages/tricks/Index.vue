<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, create, edit, destroy, show } from '@/routes/tricks'
import { Rocket, MoreHorizontal, Eye, SquarePen, Trash } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Tricks',
        href: index().url,
    },
];

const page = usePage()

const user = page.props.auth.user

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

const openDialog = ref(false)

const selectedRowId = ref<Number | null>(null)
const selectedRowName = ref<String | null>(null)

function confirmDelete(id: Number, name: string) {
  selectedRowId.value = id
  selectedRowName.value = name
  openDialog.value = true
}

function deleteRow() {
    if(!selectedRowId.value) return
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
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="text-center">ID</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead class="text-center">Level</TableHead>
                            <TableHead>Judge Type</TableHead>
                            <TableHead></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="trick in props.tricks" :key="trick.id">
                            <TableCell class="text-center">{{ trick.id }}</TableCell>
                            <TableCell class="font-medium">{{ trick.name }}</TableCell>
                            <TableCell class="text-center">{{ trick.level }}</TableCell>
                            <TableCell>{{ trick.judge.name }}</TableCell>
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
                                                <SquarePen class="h-4 w-4"/>
                                                <Link :href="edit(trick.id).url">Edit</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem class="flex gap-2">
                                                <Eye class="h-4 w-4"/>
                                                <Link :href="show(trick.id).url">View</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @select.prevent="confirmDelete(trick.id, trick.name)" class="flex gap-2 text-red-600">
                                                <Trash class="h-4 w-4"/>
                                                <span>Delete</span>
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                    <Dialog v-model:open="openDialog">
                                        <DialogContent>
                                            <DialogHeader>
                                                <DialogTitle>Delete Trick</DialogTitle>
                                                <DialogDescription>
                                                    Are you sure you want to delete the Trick <b>{{ selectedRowName }}</b>?
                                                </DialogDescription>
                                            </DialogHeader>
                                            <DialogFooter>
                                                <DialogClose as-child>
                                                    <Button variant="outline">Cancel</Button>
                                                </DialogClose>
                                                <Button class="bg-red-600"
                                                    @click="deleteRow">Delete</Button>
                                            </DialogFooter>
                                        </DialogContent>
                                    </Dialog>
                                </div>
                                <div v-else>
                                    <Link :href="show(trick.id).url" class="inline-icon-text">
                                        <Eye class="h-4 w-4" />
                                        View
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