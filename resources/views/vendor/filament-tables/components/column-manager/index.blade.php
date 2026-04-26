@php
    use Filament\Tables\Enums\ColumnManagerResetActionPosition;
    use Illuminate\View\ComponentAttributeBag;
@endphp

@props([
    'applyAction',
    'columns' => null,
    'hasReorderableColumns',
    'hasToggleableColumns',
    'headingTag' => 'h3',
    'reorderAnimationDuration' => 300,
    'resetActionPosition' => ColumnManagerResetActionPosition::Header,
])

<div
    x-data="filamentTableColumnManager({
                columns: $wire.entangle('tableColumns'),
                isLive: {{ $applyAction->isVisible() ? 'false' : 'true' }},
            })"
    class="fi-ta-col-manager"
>
    <div class="fi-ta-col-manager-header">
        <{{ $headingTag }} class="fi-ta-col-manager-heading">
            {{ __('filament-tables::table.column_manager.heading') }}
        </{{ $headingTag }}>

        @if ($resetActionPosition === ColumnManagerResetActionPosition::Header)
            <div>
                <x-filament::link
                    :attributes="
                        \Filament\Support\prepare_inherited_attributes(
                            new ComponentAttributeBag([
                                'color' => 'danger',
                                'tag' => 'button',
                                'wire:click' => 'resetTableColumnManager',
                                'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                                'wire:target' => 'resetTableColumnManager',
                                'x-on:click' => 'resetDeferredColumns',
                            ])
                        )
                    "
                >
                    {{ __('filament-tables::table.column_manager.actions.reset.label') }}
                </x-filament::link>
            </div>
        @endif
    </div>

    @if ($hasToggleableColumns)
        <div style="display:flex;gap:0.5rem;padding:0.25rem 0 0.5rem;border-bottom:1px solid rgba(0,0,0,.06);margin-bottom:0.5rem;">
            <button
                type="button"
                x-on:click="
                    deferredColumns = deferredColumns.map(col => {
                        if (col.type === 'group' && col.columns) {
                            col.columns = col.columns.map(c => ({ ...c, isToggled: c.isToggleable !== false ? true : c.isToggled }));
                            return { ...col };
                        }
                        return col.isToggleable !== false ? { ...col, isToggled: true } : col;
                    });
                    if (isLive) applyTableColumnManager();
                "
                style="flex:1;font-size:.75rem;font-weight:600;padding:.35rem .75rem;border-radius:.5rem;background:rgb(var(--primary-600));color:#fff;cursor:pointer;border:none;"
            >
                Select All
            </button>
            <button
                type="button"
                x-on:click="
                    deferredColumns = deferredColumns.map(col => {
                        if (col.type === 'group' && col.columns) {
                            col.columns = col.columns.map(c => ({ ...c, isToggled: c.isToggleable !== false ? false : c.isToggled }));
                            return { ...col };
                        }
                        return col.isToggleable !== false ? { ...col, isToggled: false } : col;
                    });
                    if (isLive) applyTableColumnManager();
                "
                style="flex:1;font-size:.75rem;font-weight:600;padding:.35rem .75rem;border-radius:.5rem;background:rgb(var(--danger-600));color:#fff;cursor:pointer;border:none;"
            >
                Deselect All
            </button>
        </div>
    @endif

    <x-filament-tables::column-manager.content
        :columns="$columns"
        :has-reorderable-columns="$hasReorderableColumns"
        :has-toggleable-columns="$hasToggleableColumns"
        :reorder-animation-duration="$reorderAnimationDuration"
    />

    @if ($applyAction->isVisible() || $resetActionPosition === ColumnManagerResetActionPosition::Footer)
        <div class="fi-ta-col-manager-actions-ctn">
            @if ($applyAction->isVisible())
                {{ $applyAction }}
            @endif

            @if ($resetActionPosition === ColumnManagerResetActionPosition::Footer)
                <x-filament::button
                    color="danger"
                    wire:click="resetTableColumnManager"
                    x-on:click="resetDeferredColumns"
                >
                    {{ __('filament-tables::table.column_manager.actions.reset.label') }}
                </x-filament::button>
            @endif
        </div>
    @endif
</div>
