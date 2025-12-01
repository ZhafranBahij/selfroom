<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Inventories\Pages\ManageInventories;
use App\Filament\Resources\Items\Pages\ManageItems;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Resources\Accounts\AccountResource;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Filament\Resources\Items\ItemResource;
use App\Filament\Resources\Inventories\InventoryResource;
use App\Filament\Resources\Journals\JournalResource;
use App\Filament\Resources\Tasks\TaskResource;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->login()
            ->colors([
                'primary' => Color::Pink,
                // 'danger' => Color::Rose,
                // 'gray' => Color::Slate,
                // 'info' => Color::Blue,
                // 'success' => Color::Emerald,
                // 'warning' => Color::Orange,
            ])
            ->spa()
            // ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            // ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->resources([
                AccountResource::class,
                TransactionResource::class,
                ItemResource::class,
                InventoryResource::class,
                JournalResource::class,
                TaskResource::class,
            ])
            ->pages([
                Dashboard::class,
            ])
            ->navigationGroups([
                'Finance',
                'Inventory',
                'Diary',
            ])
            ->navigationItems([
                // Finance Group
                NavigationItem::make('Accounts')
                    ->url(fn (): string => AccountResource::getUrl())
                    ->icon('heroicon-o-banknotes')
                    ->group('Finance')
                    ->sort(1),
                NavigationItem::make('Transactions')
                    ->url(fn (): string => TransactionResource::getUrl())
                    ->icon('heroicon-o-currency-dollar')
                    ->group('Finance')
                    ->sort(2),
                
                // Inventory Group
                NavigationItem::make('Items')
                    ->url(fn (): string => ItemResource::getUrl())
                    ->icon('heroicon-o-cube')
                    ->group('Inventory')
                    ->sort(1),
                NavigationItem::make('Inventories')
                    ->url(fn (): string => InventoryResource::getUrl())
                    ->icon('heroicon-o-rectangle-stack')
                    ->group('Inventory')
                    ->sort(2),
                
                // Diary Group
                NavigationItem::make('Journals')
                    ->url(fn (): string => JournalResource::getUrl())
                    ->icon('heroicon-o-book-open')
                    ->group('Diary')
                    ->sort(1),
            ])
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
            ]);
    }
}
