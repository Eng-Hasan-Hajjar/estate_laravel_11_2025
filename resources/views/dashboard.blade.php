<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    <!-- Navigation Buttons for User, Role, and Permission Management -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="admin-page" >
                            admin page
                        </a>   
                    <a href="{{ route('users.index') }}" class="text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition ease-in-out duration-300">
                            إدارة المستخدمين
                        </a>
                        <a href="{{ route('roles.index') }}" class="text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition ease-in-out duration-300">
                            إدارة الأدوار
                        </a>
                        <a href="{{ route('permissions.index') }}" class="text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition ease-in-out duration-300">
                            إدارة الصلاحيات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
