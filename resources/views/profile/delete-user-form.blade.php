<x-jet-action-section>
    <x-slot name="title">
        {{ __('Hesabı Sil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Hesabınızı kalıcı olarak silin.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Hesabınızı sildiğinizde, tüm kaynakları ve verileri kalıcı olarak silinecektir. Hesabınızı silmeden önce saklamak istediğiniz herhangi bir veri veya bilgiyi indirin.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Hesabı Sil') }}
            </x-jet-danger-button>
        </div>

        <!-- Hesap Silme Onayı Modalı -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Hesabı Sil') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Hesabınızı silmek istediğinize emin misiniz? Hesabınızı sildiğinizde, tüm kaynakları ve verileri kalıcı olarak silinecektir. Hesabınızı kalıcı olarak silmek istediğinizi onaylamak için lütfen şifrenizi girin.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Şifre') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('İptal') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Hesabı Sil') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
