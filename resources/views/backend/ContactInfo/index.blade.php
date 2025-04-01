@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Info</h3>

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
                @foreach ($Contact_info as $Contact)
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th style="width: 25%">
                                    Name
                                </th>
                                <th style="width: 15%">
                                    Email
                                </th>
                                <th style="width: 15%">
                                    Phone
                                </th>
                                <th style="width: 15%">
                                    Phone 2
                                </th>
                                <th style="width: 15%">
                                    Address
                                </th>
                                <th style="width: 10%">
                                    Support
                                </th>



                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $Contact->id }}
                                </td>
                                <td>
                                    <a>
                                        {{ $Contact->name_webSite }}
                                    </a>
                                    <br />
                                    <small>
                                        Created {{ $Contact->created_at }}
                                    </small>
                                </td>

                                <td>
                                    {{ $Contact->email }}
                                </td>
                                <td>
                                    {{ $Contact->phone }}
                                </td>
                                <td>
                                    {{ $Contact->phone2 }}
                                </td>
                                <td>
                                    {{ $Contact->address }}
                                </td>
                                <td>
                                    {{ $Contact->support }}
                                </td>

                            </tr>
                            <tr>
                                <td class="project-actions
                                text-right"
                                    style="display:flex; float: right;">
                                    <a class="btn
                            btn-primary btn-sm"
                                        href="{{ route('backend.Info.edit', $Contact->id) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Edit
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('backend.Info.destroy', $Contact->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Product ?');">
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
