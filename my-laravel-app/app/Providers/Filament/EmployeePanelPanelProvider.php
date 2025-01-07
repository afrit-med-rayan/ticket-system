<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\CheckUserRole;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EmployeePanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('employee')
            ->path('employee')
            ->login()
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Red,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'secondary' => '#ffffff'
            ])
            ->font('Poppins')
            ->brandName('zimou')
            ->brandLogo(asset('images/zimoulogo.png'))
            ->discoverResources(in: app_path('Filament/EmployeePanel/Resources'), for: 'App\\Filament\\EmployeePanel\\Resources')
            ->discoverPages(in: app_path('Filament/EmployeePanel/Pages'), for: 'App\\Filament\\EmployeePanel\\Pages')
            ->pages([]) // No pages for employees, or use a custom page instead of the dashboard
            ->discoverWidgets(in: app_path('Filament/EmployeePanel/Widgets'), for: 'App\\Filament\\EmployeePanel\\Widgets')
            ->widgets([]) // No widgets for employees or provide a custom widget here
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                CheckUserRole::class,
            ]);
    }
}
