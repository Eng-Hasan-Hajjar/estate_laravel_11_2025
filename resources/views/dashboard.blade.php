<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Navigation Buttons for User, Role, and Permission Management -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="admin-page" >
                            admin page
                        </a>   
                    <a href="{{ route('users.index') }}" >
                             Users
                        </a>
                        <a href="{{ route('roles.index') }}" >
                             Roles
                        </a>
                        <a href="{{ route('permissions.index') }}" >
                            Permessions 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
