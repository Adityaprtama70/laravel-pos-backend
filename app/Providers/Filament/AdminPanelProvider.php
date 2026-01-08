<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->registration()
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->brandName('POS SaaS Technorise')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->darkMode(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \Filament\Widgets\AccountWidget::class,
                \Filament\Widgets\FilamentInfoWidget::class,
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn(): string => '
                    <style>
                        :root {
                            --gray-950: 0, 0, 0; /* Pure Black Background */
                            --gray-900: 20, 20, 20; /* Very Dark Gray for Cards */
                        }
                        .fi-body {
                            background-color: rgb(var(--gray-950)) !important;
                        }
                        .fi-main {
                            background-color: rgb(var(--gray-950)) !important;
                        }
                        .fi-sidebar {
                            background-color: rgb(var(--gray-950)) !important;
                            border-right-color: #333 !important;
                        }
                        .fi-section {
                            background-color: rgb(var(--gray-900)) !important;
                            border-color: #333 !important;
                        }
                        .fi-input, .fi-select-input {
                            background-color: #222 !important;
                            border-color: #444 !important;
                            color: white !important;
                        }
                    </style>
                '
            )
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
            ])
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn(): string => app()->environment(['local', 'development']) ?
                    '<script>
                        function fillLoginForm() {
                            const emailInput = document.querySelector(\'input[type="email"]\');
                            const passwordInput = document.querySelector(\'input[type="password"]\');

                            if (emailInput && emailInput.value === \'\') {
                                emailInput.value = \'admin@admin.com\';
                                emailInput.dispatchEvent(new Event(\'input\', { bubbles: true }));
                                emailInput.dispatchEvent(new Event(\'change\', { bubbles: true }));
                            }

                            if (passwordInput && passwordInput.value === \'\') {
                                passwordInput.value = \'password\';
                                passwordInput.dispatchEvent(new Event(\'input\', { bubbles: true }));
                                passwordInput.dispatchEvent(new Event(\'change\', { bubbles: true }));
                            }
                        }

                        document.addEventListener(\'DOMContentLoaded\', function() {
                            setTimeout(fillLoginForm, 100);
                            setTimeout(fillLoginForm, 500);
                            setTimeout(fillLoginForm, 1000);
                        });

                        document.addEventListener(\'livewire:init\', function() {
                            setTimeout(fillLoginForm, 100);
                            setTimeout(fillLoginForm, 500);
                        });

                        window.addEventListener(\'load\', function() {
                            setTimeout(fillLoginForm, 100);
                        });
                    </script>' : ''
            );
    }
}
