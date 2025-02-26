<x-guest-layout>
    <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            
            <select id="role_id" name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @foreach(\App\Models\Role::all() as $role)
            <option value="{{ $role->id }}">{{ $role->role }}</option>
        @endforeach
            </select>
            
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        
         <!-- Candidate Specific Section -->
         <div id="candidate-section" class="mt-4" style="display: none;">
            <div class="border rounded-md p-4 bg-gray-50">
                <h3 class="font-medium text-gray-700 mb-2">Informations additionnelles candidat</h3>
                
                <!-- Date de naissance -->
                <div class="mt-3">
                    <x-input-label for="birth_date" :value="__('Date de naissance')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <x-input-label for="address" :value="__('Address')" />
                    <input id="address" class="block mt-1 w-full" type="text" name="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>
            <div class="mt-4 " id="phone">
            <x-input-label for="phone" :value="__('phone')" />
            <input type="text" name="phone" >
        </div>
        <div class="mt-4 " id="document">
            <x-input-label for="document" :value="__('document')" />
            <input type="file" name="document" >
        </div>
        </div>
       

                <!-- Other Roles Section (Profile Photo) -->
                <div id="other-roles-section" class="mt-4" style="display: none;">
            <div class="border rounded-md p-4 bg-gray-50">
                <h3 class="font-medium text-gray-700 mb-2">Photo de profil</h3>
                
                <div class="mt-3">
                    <x-input-label for="profile_photo" :value="__('Télécharger une photo')" />
                    <input id="profile_photo" name="profile_photo" type="file" class="block mt-1 w-full" accept="image/*">
                    <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                </div>
            </div>
        </div>



        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script > 
function toggleSections() {
    const roleSelect = document.getElementById('role_id');
    const candidateSection = document.getElementById('candidate-section');
    const otherRolesSection = document.getElementById('other-roles-section');
    
    const candidateRoleId = "1";
    
    if(roleSelect.value == candidateRoleId) {
        candidateSection.style.display = "block";
        otherRolesSection.style.display = "none";
    } else {
        candidateSection.style.display = "none";
        otherRolesSection.style.display = "block";
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleSections();
    
    const roleSelect = document.getElementById('role_id');
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleSections);
    }
});
</script>

<script  src="{{ asset('../../../public/js/register.js')}}"></script>
