<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<flux:header container>
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" href="{{ route('welcome') }}" :current="request()->is('/')">
            Home
        </flux:navbar.item>

        @auth
            <flux:navbar.item icon="adjustments-horizontal" href="{{ route('dashboard') }}" :current="request()->is('dashboard')">
                Dashboard
            </flux:navbar.item>
        @endauth

    </flux:navbar>

    <flux:spacer />

    <flux:button x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />

    @auth
        <flux:dropdown position="top" align="start">
            <flux:button class="mx-2" size="sm" icon-trailing="chevron-down">{{ auth()->user()->name }}</flux:button>

            <flux:menu>
                <flux:menu.item icon="arrow-right-start-on-rectangle" wire:click="logout">
                    Logout
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    @else
        <flux:button size="sm" class="mx-1" href="{{ route('login') }}" icon-trailing="arrow-up-right">Login</flux:button>
    @endauth
</flux:header>