<table aria-describedby="{{ __('Book list') }}">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('Title')}}</th>
            <th scope="col">{{__('ISBN')}}</th>
            <th scope="col">{{__('Publication year')}}</th>
            <th scope="col">{{__('Created by')}}</th>
            <th scope="col">{{__('Created at')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->isbn_code }}</td>
            <td>{{ $book->publication_year }}</td>
            <td>{{ $book->created_by }}</td>
            <td>{{ americanFormat($book->created_at) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
