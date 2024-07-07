<table class="table w-75 mx-auto">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mimes Type</th>
            <th scope="col">Name</th>
            <th scope="col">Disk</th>
            <th scope="col">Size</th>
            <th scope="col">View</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($files as $file)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $file->mimeType }}</td>
                <td>{{ $file->original_name }}</td>
                <td>{{ $file->disk }}</td>
                <td>{{ round($file->size / 1024, 2) }} KB</td>
                @php
                    $fileUrl = \Storage::disk($file->disk)->url($file->path);
                @endphp
                <td>
                    <img src="{{ $fileUrl }}" alt="image" style="height: 40px; weight:40px;">
                </td>
                <td>
                    <form method="post" action="{{ route('form.destroy', $file->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
