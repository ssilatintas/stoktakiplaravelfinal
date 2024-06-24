<div>
    <!-- API Token Oluştur -->
    <x-jet-form-section submit="createApiToken">
        <x-slot name="title">
            {{ __('API Tokeni Oluştur') }}
        </x-slot>

        <x-slot name="description">
            {{ __('API tokenleri üçüncü taraf hizmetlerin, uygulamamıza kendi adınıza kimlik doğrulaması yapmasına izin verir.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Adı -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Token Adı') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="createApiTokenForm.name" autofocus />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Token İzinleri -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <x-jet-label for="permissions" value="{{ __('İzinler') }}" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <x-jet-checkbox wire:model.defer="createApiTokenForm.permissions" :value="$permission"/>
                                <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="created">
                {{ __('Oluşturuldu.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Oluştur') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-jet-section-border />

        <!-- API Tokenleri Yönet -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('API Tokenleri Yönet') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Artık gerekli değilse mevcut tokenlerinizden herhangi birini silebilirsiniz.') }}
                </x-slot>

                <!-- API Token Listesi -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div>
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Son kullanım') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('İzinler') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Sil') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    <!-- Token Değeri Modalı -->
    <x-jet-dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            {{ __('API Tokeni') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('Yeni API tokeninizi kopyalayın. Güvenliğiniz için bir daha gösterilmeyecek.') }}
            </div>

            <x-jet-input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full"
                autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Kapat') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- API Token İzinleri Modalı -->
    <x-jet-dialog-modal wire:model="managingApiTokenPermissions">
        <x-slot name="title">
            {{ __('API Tokeni İzinleri') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <x-jet-checkbox wire:model.defer="updateApiTokenForm.permissions" :value="$permission"/>
                        <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('İptal') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('Kaydet') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Token Silme Onayı Modalı -->
    <x-jet-confirmation-modal wire:model="confirmingApiTokenDeletion">
        <x-slot name="title">
            {{ __('API Tokeni Sil') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Bu API tokenini silmek istediğinizden emin misiniz?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('İptal') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Sil') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
