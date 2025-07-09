<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Calendar, ChartBarIcon, FileText, Folder, HelpCircle, LayoutGrid, Mail, MessageSquare, Phone, Receipt, Settings, ShoppingBag, User, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { Chart } from 'chart.js';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
        isActive: true,
        items: [
            {
                title: 'Ecommerce',
                href: '/dashboard/ecommerce',
                isActive: true,
            },
            {
                title: 'Analytics',
                href: '/dashboard/analytics',
            },
            {
                title: 'Marketing',
                href: '/dashboard/marketing',
            },
            {
                title: 'CRM',
                href: '/dashboard/crm',
            },
            {
                title: 'Stocks',
                href: '/dashboard/stocks',
                badge: 'NEW',
            },
        ],
    },
    {
        title: 'Analytics',
        href: '/analytics',
        icon: ChartBarIcon,
    },
    {
        title: 'Marketing',
        href: '/marketing',
        icon: Phone,
    },
    {
        title: 'CRM',
        href: '/crm',
        icon: User,
    },
    {
        title: 'Sales',
        href: '/sales',
        icon: ShoppingBag,
        badge: 'New',
    },
    {
        title: 'Inbox',
        href: '/inbox',
        icon: Mail,
    },
    {
        title: 'Calendar',
        href: '/calendar',
        icon: Calendar,
    },
    {
        title: 'Chat',
        href: '/chat',
        icon: MessageSquare,
    },
    {
        title: 'Files',
        href: '/files',
        icon: FileText,
    },
    {
        title: 'Invoice',
        href: '/invoice',
        icon: Receipt,
    },
    {
        title: 'Users',
        href: '/users',
        icon: Users,
    },
    {
        title: 'Settings',
        href: '/settings',
        icon: Settings,
    },
    {
        title: 'Help Center',
        href: '/help',
        icon: HelpCircle,
    },
];

const footerNavItems: NavItem[] = [

];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
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
            <NavFooter :items="footerNavItems" />
            <!-- <NavUser /> -->
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
