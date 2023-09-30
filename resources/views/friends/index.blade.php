<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Friends
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6  container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                       <div class="py-2">
                        <h1 class="fw-bold">Friends</h1>
                        <div class="py-3">
                            @forelse ( $friends as $friend )
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('profile',$friend) }}">{{ $friend->name }}</a>
                                <form class="ms-2 d-inline" action="{{ route('friends.destroy',$friend) }}"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="text-danger ">Unfriend</button>
                                </form>
                            </div>
                            @empty
                                 You have no friend
                            @endforelse

                        </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                       <div class="py-2">
                        <h1 class="fw-bold">Friend Request</h1>
                        <div class="py-3">
                            <div class="d-flex justify-content-between">
                               @forelse ($pendingFriendsFrom as $pendingFriendFrom )
                              <a href="">{{ $pendingFriendFrom->name}}</a>
                                <div class="mx-3">
                                    <form class="ms-2 d-inline" action="{{ route('friends.patch',$pendingFriendFrom) }}"  method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button  class="text-primary ">Accept</button>
                                    </form>
                                    <form class="ms-2 d-inline" action="{{ route('friends.destroy',$pendingFriendFrom) }}"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="text-primary ">Reject</button>
                                    </form>
                                </div>
                             </div>
                                @empty
                                You have no friend request
                            @endforelse
                        </div>
                       </div>
                       <div class="py-2">
                        <h1 class="fw-bold">Pending Friend Request</h1>
                        <div class="py-3">
                            <div class="d-flex justify-content-between">
                                @forelse ($pendingFriendsto as $pendingFriend )

                                <a href="{{ route('profile',$pendingFriend) }}">{{ $pendingFriend->name }}</a>
                                <div class="px-3">
                                    <form class="ms-2" action="{{ route('friends.destroy',$pendingFriend) }}"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-primary">Cancel</button>
                                    </form>

                                </div>
                            </div>
                            @empty
                            You have no friend request
                            @endforelse
                        </div>
                       </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
</x-app-layout>
