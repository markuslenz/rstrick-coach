<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Activity, LayoutGrid, Users, GraduationCap, Trophy } from 'lucide-vue-next';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import tricks from '@/routes/tricks';
import judges from '@/routes/judges';
import users from '@/routes/users';
import trainings from '@/routes/trainings';
import { type NavItem } from '@/types';
import AppLogo from './AppLogo.vue';
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const { permission } = usePage().props

const mainNavItems: NavItem[] = [
    {
        title: t('ui.dashboard.title'),
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: t('ui.tricks.title'),
        href: tricks.index(),
        icon: Activity
    },
    {
        title: t('ui.judges.title'),
        href: judges.index(),
        icon: GraduationCap 
    },
    {
        title: t('ui.trainings.title'),
        href: trainings.index(),
        icon: Trophy
    }
];

const footerNavItems: NavItem[] = [
    {
        title: t('ui.users.title'),
        href: users.index(),
        icon: Users,
    }
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems"  v-if="permission.isAdmin"/>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
