{{--
    Thumbnail picker for the article's existing assets (Insert image / Attach
    file). Click a card to choose it, click it again to clear the choice.
    Inline styles only: the plugin ships no compiled CSS of its own.
--}}
@php
    $statePath = $getStatePath();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-data="{ state: $wire.$entangle(@js($statePath)) }"
        role="radiogroup"
        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(8.5rem, 1fr)); gap: 0.75rem;"
    >
        @foreach ($choices as $uuid => $choice)
            <button
                type="button"
                role="radio"
                data-asset-choice="{{ $uuid }}"
                x-on:click="state = (state === @js($uuid)) ? null : @js($uuid)"
                x-bind:aria-checked="state === @js($uuid) ? 'true' : 'false'"
                x-bind:style="state === @js($uuid)
                    ? { outline: '2px solid var(--primary-500)', outlineOffset: '2px', borderColor: 'var(--primary-500)' }
                    : { outline: 'none' }"
                title="{{ $choice['name'] }}"
                style="display: flex; flex-direction: column; gap: 0.375rem; padding: 0.5rem; border: 1px solid rgba(127, 127, 127, 0.3); border-radius: 0.75rem; background: transparent; color: inherit; text-align: left; cursor: pointer;"
            >
                @if ($choice['url'])
                    <img
                        src="{{ $choice['url'] }}"
                        alt=""
                        loading="lazy"
                        style="display: block; width: 100%; height: 5.5rem; object-fit: cover; border-radius: 0.5rem;"
                    >
                @else
                    <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 5.5rem; border-radius: 0.5rem; background: rgba(127, 127, 127, 0.12);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" style="width: 2rem; height: 2rem; opacity: 0.7;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <path d="M14 2v6h6" />
                        </svg>
                    </span>
                @endif

                <span style="font-size: 0.8125rem; font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    {{ $choice['name'] }}
                </span>

                <span style="font-size: 0.75rem; opacity: 0.7;">
                    {{ $choice['scope'] }} · {{ $choice['size'] }}
                </span>
            </button>
        @endforeach
    </div>
</x-dynamic-component>
