@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Brand</h3>


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
                @foreach ($brands as $brand)
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    id
                                </th>
                                <th style="width: 20%">
                                    Brand Name
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $brand->id }}
                                </td>
                                <td>
                                    <a>
                                        {{ $brand->name }}
                                    </a>
                                    <br />
                                    <small>
                                        Created {{ $brand->created_at }}
                                    </small>
                                </td>

                                <td class="project-actions text-right" style="display:flex; float: right;">
                                    {{--  <a class="btn btn-primary btn-sm" href="">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a> --}}
                                    <a class="btn btn-info btn-sm" href="{{ route('backend.Brand.edit', $brand->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('backend.Brand.destroy', $brand->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Brand?');">
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
            {{ $brands->links('pagination::bootstrap-5') }}
        </div>

    </section>
@endsection
