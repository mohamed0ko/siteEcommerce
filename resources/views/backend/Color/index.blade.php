@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            {{--   <button type="button" value="" class="btn btn-success "><a href="{{ route('backend.CategoriesAdd') }}">Create
                    new
                    color</a></button> --}}
            <div class="card-header">
                <h3 class="card-title">color</h3>


                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @foreach ($colors as $color)
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    id
                                </th>
                                <th style="width: 20%">
                                    color Name
                                </th>
                                <th style="width: 15%">

                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $color->id }}
                                </td>
                                <td>
                                    <a>
                                        {{ $color->name }}
                                    </a>
                                    <br />
                                    <small>
                                        Created {{ $color->created_at }}
                                    </small>
                                </td>
                                <td>
                                    <div
                                        style="background-color: {{ $color->code }}; width: 35px; height: 35px; border-radius: 50%;">

                                    </div>

                                </td>

                                <td class="project-actions text-right" style="display:flex; float: right;">
                                    {{--  <a class="btn btn-primary btn-sm" href="">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a> --}}
                                    <a class="btn btn-info btn-sm" href="{{ route('backend.Color.edit', $color->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('backend.Color.destroy', $color->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this color?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"> <i class="fas fa-trash">
                                            </i>Delete</button>
                                    </form>




                                </td>
                            </tr>

                        </tbody>
                    </table>
                @endforeach


            </div>

        </div>
        <div class="pagination" style="float: right">
            {{ $colors->links('pagination::bootstrap-5') }}
        </div>

    </section>
@endsection
