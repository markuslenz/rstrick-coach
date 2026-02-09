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

const { permission } = usePage().props

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Tricks',
        href: tricks.index(),
        icon: Activity
    },
    {
        title: 'Judge Types',
        href: judges.index(),
        icon: GraduationCap 
    },
    {
        title: 'Trainings',
        href: trainings.index(),
        icon: Trophy
    }
];

const footerNavItems: NavItem[] = [
    {
        title: 'User Administration',
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
