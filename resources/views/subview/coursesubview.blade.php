<table class="table table-hover">
    <thead>
        <tr class='mgttableHead'>
            <th scope="col" width="60">#</th>
            <th scope="col" width="100">code</th>
            <th scope="col">name</th>
            <th scope="col">description</th>
            <th scope="col" width="60">type</th>
            <th scope="col" width="60">#Hours</th>
            <th scope="col" width="60" class="borders">action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($course as $row)
            <tr class="mgttablerow">
                <th scope="row">{{ ++$no }}</th>
                <td>{{ $row->code }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->description }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->nortionlHours }}</td>
                <th>
                    <div class="btn-group">


                        @if ($row->status == 'Deleted')
                            <button href="" class="btn btn-info btn-sm" disabled><i class="fa fa-edit"></i>
                                start</button>
                            <form role="form" method="get" action="/mgt/delMenu">
                                @csrf
                                @method('get')
                                <input type="hidden" name="id" value="{{ $row->id }}">
                                <input type="hidden" name="status" value="Active">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-trash">
                                        Enable </i></button>
                            </form>
                        @else
                            <a href="" class="btn btn-info btn-sm startBatch" data-toggle="modal"
                                data-target="#startModel" data-row="{{ $row->id }}" data-code="{{ $row->code }}"
                                data-name="{{ $row->name }}"><i class="fa fa-edit">
                                    start</i>
                            </a>
                            <form role="form" method="get" action="/mgt/delMenu">
                                @csrf
                                @method('get')
                                <input type="hidden" name="id" value="{{ $row->id }}">
                                <input type="hidden" name="status" value="Deleted">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash">
                                        Disable</i></button>
                            </form>
                        @endif

                    </div>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>

<span class="text-center plink">{{ $course->links() }}</span>
