<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            User Avatar
        </h2>
    </header>
    
    <img src="{{ "/storage/$user->avatar" }}" alt="user avatar" class="w-9 h-9 rounded-full">
    <form action="{{ route('profile.avatar.ai') }}" method="post" class="mt-4">
        @csrf
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Generate avatar from ai
        </p>
        <x-primary-button>Generate Avatar</x-primary-button>
    </form>
    <p class="my-4 text-sm text-gray-600 dark:text-gray-400">
        or
    </p>
    @if (session('message'))
        <div class="text-red-500" style="color: green">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('profile.avatar') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" value="Upload Avatar from Computer" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>



        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>
</section>
