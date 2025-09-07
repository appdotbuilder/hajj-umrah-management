import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { router, usePage } from '@inertiajs/react';
import { Palette } from 'lucide-react';

interface User {
    id: number;
    name: string;
    email: string;
    theme: string;
    role: string;
}

export function ThemeSelector() {
    const { auth } = usePage<{ auth: { user: User } }>().props;
    const user = auth.user;

    const themes = [
        { value: 'purple', name: 'Purple', color: 'bg-purple-600' },
        { value: 'green', name: 'Green', color: 'bg-green-600' },
        { value: 'blue', name: 'Blue', color: 'bg-blue-600' },
    ];

    const handleThemeChange = (theme: string) => {
        router.patch('/settings/theme', { theme }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const currentTheme = themes.find(t => t.value === user?.theme) || themes[0];

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button variant="ghost" size="icon" className="h-9 w-9 rounded-md">
                    <Palette className="h-5 w-5" />
                    <span className="sr-only">Select theme color</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
                {themes.map((theme) => (
                    <DropdownMenuItem 
                        key={theme.value}
                        onClick={() => handleThemeChange(theme.value)}
                        className="flex items-center gap-3"
                    >
                        <div className={`w-4 h-4 rounded-full ${theme.color}`} />
                        <span>{theme.name}</span>
                        {currentTheme.value === theme.value && (
                            <span className="ml-auto text-xs">✓</span>
                        )}
                    </DropdownMenuItem>
                ))}
            </DropdownMenuContent>
        </DropdownMenu>
    );
}