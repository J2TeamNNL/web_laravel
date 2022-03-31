@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<a href="{{ route('courses.create') }}">
    Thêm
</a>
<table border="1" width="100%">
    <caption>
        <form>
            Search:
            <input type="search" name="q" value="{{ $search }}">
        </form>
    </caption>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    @foreach ($data as $each)
        <tr>
            <td>
                {{ $each->id }}
            </td>
            <td>
                {{ $each->name }}
            </td>
            <td>
                {{ $each->year_created_at }}
            </td>
            <td>
                <a href="{{ route('courses.edit', $each) }}">
                    Edit
                </a>
            </td>
            <td>
                <form action="{{ route('courses.destroy', $each) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $data->links() }}