<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 col-md-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @auth
                        @if (auth()->user()->id != $user->id)

                            @if (auth()->user()->isFriendsWith($user))
                                <span>You and {{ $user->name }} are friends </span>

                                <form class="ms-2 d-inline" action="{{ route('friends.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-primary">Unfriend</button>
                                </form>
                            @else
                                @if (auth()->user()->hasPendingFriendRequestFor($user))
                                    <div class="d-flex">

                                        Waiting for {{ $user->name }} to accept your friend request

                                        <form class="ms-2" action="{{ route('friends.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-primary">Cancel</button>
                                        </form>

                                    </div>
                                @elseif ($user->hasPendingFriendRequestFor(auth()->user()))
                                    <span>
                                        {{ $user->name }} Has send you a friend request
                                        <form class="ms-2 d-inline" action="{{ route('friends.patch', $user) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-primary">Accept</button>
                                        </form>
                                        <form class=" d-inline" action="{{ route('friends.destroy', $user) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger">Reject</button>
                                        </form>
                                    </span>
                                @else
                                    <form action="{{ route('friends.store', $user) }}" method="POST">
                                        @csrf
                                        <button class="text-primary"> Add as a Friend</button>
                                    </form>
                                @endauth
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
