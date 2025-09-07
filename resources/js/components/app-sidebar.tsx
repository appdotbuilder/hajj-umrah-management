import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavManagement } from '@/components/nav-management';
import { NavData } from '@/components/nav-data';
import { NavReports } from '@/components/nav-reports';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { 
    LayoutGrid, Package, Users, Calculator, Archive, 
    FileText, Settings, 
    DollarSign, Plane, Building2,
    MapPin, Wallet
} from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Packages',
        href: '/packages',
        icon: Package,
    },
    {
        title: 'Pilgrims',
        href: '/pilgrims',
        icon: Users,
    },
];

const managementNavItems: NavItem[] = [
    {
        title: 'LA Simulation',
        href: '/la-simulation',
        icon: Calculator,
    },
    {
        title: 'Inventory',
        href: '/inventory',
        icon: Archive,
    },
    {
        title: 'Accounting',
        href: '/accounting',
        icon: Wallet,
    },
];

const dataNavItems: NavItem[] = [
    {
        title: 'Marketing Partners',
        href: '/marketing-partners',
        icon: Users,
    },
    {
        title: 'Suppliers',
        href: '/suppliers',
        icon: Building2,
    },
    {
        title: 'Banks',
        href: '/banks',
        icon: DollarSign,
    },
    {
        title: 'Airlines',
        href: '/airlines',
        icon: Plane,
    },
    {
        title: 'Facilities',
        href: '/facilities',
        icon: Building2,
    },
    {
        title: 'Visit Cities',
        href: '/visit-cities',
        icon: MapPin,
    },
];

const reportsNavItems: NavItem[] = [
    {
        title: 'Financial Reports',
        href: '/reports',
        icon: FileText,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: '/settings',
        icon: Settings,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
                <NavManagement items={managementNavItems} />
                <NavData items={dataNavItems} />
                <NavReports items={reportsNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
