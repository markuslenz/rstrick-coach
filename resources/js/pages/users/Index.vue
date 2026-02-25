<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { index, edit, destroy } from '@/routes/users'
import { type BreadcrumbItem } from '@/types'
import { AlertCircleIcon, MoreHorizontal, SquarePen, Trash } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.users.title'),
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

const openDialog = ref(false)

const selectedRowId = ref<Number | null>(null)
const selectedRowName = ref<String | null>(null)

function confirmDelete(id: Number, name: String) {
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

        <Head :title="t('ui.users.title')" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <AlertCircleIcon class="h-4 w-4" />
                <AlertTitle>{{ t('ui.alert.title' )}}</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="text-center">{{ t('forms.id') }}</TableHead>
                            <TableHead>{{ t('forms.name') }}</TableHead>
                            <TableHead>{{ t('forms.email') }}</TableHead>
                            <TableHead>{{ t('forms.role') }}</TableHead>
                            <TableHead class="text-center"></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in props.users" :key="user.id">
                            <TableCell class="text-center">{{ user.id }}</TableCell>
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell>{{ user.role }}</TableCell>
                            <TableCell class="text-center space-x-2">
                                <div v-if="user.id !== admin.id">
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <Button variant="ghost" class="h-8 w-8 p-0">
                                                <span class="sr-only">{{ t('buttons.open_menu') }}</span>
                                                <MoreHorizontal class="h-4 w-4" />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent align="end">
                                            <DropdownMenuLabel>{{ t('buttons.actions') }}</DropdownMenuLabel>
                                            <DropdownMenuItem class="flex gap-2">
                                                <SquarePen class="h-4 w-4"/>
                                                <Link :href="edit(user.id).url">{{ t('buttons.edit') }}</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @select.prevent="confirmDelete(user.id, user.name)" class="flex gap-2 text-red-600">
                                                <Trash class="h-4 w-4"/>
                                                <span>{{ t('buttons.delete') }}</span>
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                    <Dialog v-model:open="openDialog">
                                        <DialogContent>
                                            <DialogHeader>
                                                <DialogTitle>{{ t('ui.users.dialog.title') }}</DialogTitle>
                                                <DialogDescription>
                                                    {{ t('ui.users.dialog.description') }} <b>{{ selectedRowName }}</b>?
                                                </DialogDescription>
                                            </DialogHeader>
                                            <DialogFooter>
                                                <DialogClose as-child>
                                                    <Button variant="outline">{{ t('buttons.cancel') }}</Button>
                                                </DialogClose>
                                                <Button class="bg-red-600"
                                                    @click="deleteRow">{{ t('buttons.delete') }}</Button>
                                            </DialogFooter>
                                        </DialogContent>
                                    </Dialog>
                                </div>
                                <div v-else>
                                    
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>