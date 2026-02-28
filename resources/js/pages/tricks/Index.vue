<script setup lang="ts">
import { Link, Head, usePage, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { index, create, edit, destroy, show } from '@/routes/tricks'
import { AlertCircleIcon, MoreHorizontal, Eye, SquarePen, Trash } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('ui.tricks.title'),
        href: index().url,
    },
];

const page = usePage()

const { permission } = usePage().props

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

        <Head :title="t('ui.tricks.title')" />

        <div class="px-4 py-4">
            <Alert v-if="page.props.flash?.message" class="bg-blue-200 mb-3">
                <AlertCircleIcon class="h-4 w-4" />
                <AlertTitle>{{ t('ui.alert.title') }}</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>

            <Button class="mb-3" v-if="permission.canEdit">
                <Link :href="create().url">{{ t('buttons.new_trick') }}</Link>
            </Button>
            <div class="rounded-md border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="text-center">{{ t('forms.id') }}</TableHead>
                            <TableHead>{{ t('forms.name') }}</TableHead>
                            <TableHead class="text-center">{{ t('forms.level') }}</TableHead>
                            <TableHead>{{ t('forms.judge') }}</TableHead>
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
                                <div v-if="permission.canEdit">
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
                                                <Link :href="edit(trick.id).url">{{ t('buttons.edit') }}</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem class="flex gap-2">
                                                <Eye class="h-4 w-4"/>
                                                <Link :href="show(trick.id).url">{{ t('buttons.view') }}</Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @select.prevent="confirmDelete(trick.id, trick.name)" class="flex gap-2 text-red-600">
                                                <Trash class="h-4 w-4"/>
                                                <span>{{ t('buttons.delete') }}</span>
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                    <Dialog v-model:open="openDialog">
                                        <DialogContent>
                                            <DialogHeader>
                                                <DialogTitle>{{ t('ui.tricks.dialog.title') }}</DialogTitle>
                                                <DialogDescription>
                                                    {{ t('ui.tricks.dialog.description') }} <b>{{ selectedRowName }}</b>?
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
                                    <Link :href="show(trick.id).url" class="inline-icon-text">
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