{{-- <link rel="stylesheet" href="{{ asset('dashboard.css') }}">

<x-app-layout>
    <x-slot name="header">
        <!-- Header content here, if needed -->
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        File Upload
                    </div>
                    <div class="card-body">
                        <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="folder_id" value="{{ optional($currentFolder)->id }}">
                            <div class="form-group">
                                <label for="file">Choose a File</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Create Folder
                    </div>
                    <div class="card-body">
                        <form action="{{ route('folder.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_folder_id" value="{{ optional($currentFolder)->id }}">
                            <div class="form-group">
                                <label for="folderName">Folder Name</label>
                                <input type="text" class="form-control" id="folderName" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Folder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Files and Folders</h2>
                <h3>Current Folder: {{ optional($currentFolder)->name }}</h3>

                <!-- Display Folders -->
                <ul class="folders-list">
                    @foreach ($rootFolders as $folder)
                        <li class="folder" data-folder-id="{{ $folder->id }}">{{ $folder->name }}</li>
                    @endforeach
                </ul>

                <!-- Display Files -->
                <ul class="files-list">
                    @foreach ($filesInCurrentFolder as $file)
                        <li class="file">{{ $file->name }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your custom JavaScript -->
<script>
    $(document).ready(function() {
        // Handle folder click
        $('.folder').click(function() {
            var folderId = $(this).data('folder-id');
            // Redirect to the dashboard with the clicked folder's ID
            window.location.href = '{{ route("dashboard") }}?folder_id=' + folderId;
        });

        // Handle file click
        $('.file').click(function() {
            // Implement the logic to display the file or handle the click
            var fileName = $(this).text();
            console.log('Clicked on file: ' + fileName);
        });
    });
</script>

</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="m-1 p-4" style="color: rgb(52, 114, 213)">
                        <ul>
                            <li><a href="{{ url('/') }}">HOME/</a></li>
                        </ul>
                    </nav>
                    <div style="display: flex; justify-content: space-around">
                        <div>
                            <!-- Create Folder Section -->
                            <h3 class="text-lg font-semibold mb-4">Create Folder</h3>
                            <form action="{{ route('folder.store') }}" method="post" class="mb-4">
                                @csrf
                                <div class="flex">
                                    <input type="text" name="name" class="form-input rounded-l-md" placeholder="Folder Name" required>
                                    <button type="submit" class="bg-blue-500 btn text-white px-4 py-2 rounded-r-md" style="background-color: rgb(38, 110, 191);">Create</button>
                                </div>
                            </form>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Upload File</h3>
                            <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="flex">
                                    <input type="file" name="file" class="form-input rounded-l-md" required>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md" style="background-color: rgb(38, 110, 191);">Upload</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Folders Section -->
                    <h3 class="text-lg font-semibold mb-4">Folders</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($rootFolders as $folder)
                                <div class="rounded-lg p-4 text-dark" style="background-color: rgba(233, 232, 232, 0.635)">
                                    <a href="{{ route('folder.show', ['id' => $folder->id]) }}">
                                        <img src="https://cdn.icon-icons.com/icons2/2963/PNG/512/macos_big_sur_folder_icon_186046.png" width="100px">
                                        {{ $folder->name }}
                                    </a>
                                </div>
                           
                        @endforeach
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Files Section -->
                    <h3 class="text-lg font-semibold mt-3 mb-4">Files</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($filesInCurrentFolder as $file)
                            <a href="{{ route('shared.link', ['encrypted_id' => encrypt($file->id)]) }}" target="_blank" style="background-color: rgba(233, 232, 232, 0.635)">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9y815E0kLt2Qj6jKuvcmCNkfzCVEMJU2ZlQ&usqp=CAU" width="100px">
                                <p>
                                    {{ $file->name }}
                                </p>
                                <span class="m-2 mt-1 text-sm text-gray-500">
                                    Expires on
                                    @if ($file->expires_at)
                                        {{ $file->expires_at->format('Y-m-d H:i') }}
                                    @else 
                                        after 2 days
                                    @endif
                                </span>
                            </a>

                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
