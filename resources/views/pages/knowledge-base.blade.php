<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Search --}}
        <div>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    :placeholder="__('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.search_placeholder')"
                />
            </x-filament::input.wrapper>
        </div>

        @if (strlen($search) >= 2)
            {{-- Search Results --}}
            <div>
                <h2 class="text-lg font-semibold mb-4">
                    {{ __('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.search_results_heading') }}
                </h2>

                @php
                    $results = $this->getSearchResults();
                @endphp

                @if ($results->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ __('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.no_results') }}
                        </p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($results as $article)
                            <div class="fi-ta-record p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                                <h3 class="text-base font-medium">
                                    {{ $article->title }}
                                </h3>
                                @if ($article->excerpt)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ Str::limit($article->excerpt, 150) }}
                                    </p>
                                @endif
                                <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                    @if ($article->category)
                                        <span>{{ $article->category->name }}</span>
                                    @endif
                                    @if ($article->published_at)
                                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            {{-- Categories --}}
            <div>
                <h2 class="text-lg font-semibold mb-4">
                    {{ __('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.categories_heading') }}
                </h2>

                @php
                    $categories = $this->getCategories();
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($categories as $category)
                        <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                @if ($category->icon)
                                    <x-filament::icon
                                        :icon="$category->icon"
                                        class="h-6 w-6 text-primary-500"
                                    />
                                @else
                                    <x-filament::icon
                                        icon="heroicon-o-folder"
                                        class="h-6 w-6 text-primary-500"
                                    />
                                @endif
                                <div>
                                    <h3 class="font-medium">{{ $category->name }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ trans_choice('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.articles_count', $category->articles_count, ['count' => $category->articles_count]) }}
                                    </p>
                                </div>
                            </div>
                            @if ($category->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    {{ Str::limit($category->description, 100) }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
