@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>

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
                @foreach ($orders as $order)
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    order
                                </th>
                                <th style="width: 25%">
                                    Name
                                </th>
                                <th style="width: 15%">
                                    Email
                                </th>
                                <th style="width: 15%">
                                    Address
                                </th>
                                <th style="width: 10%">
                                    Phone
                                </th>



                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td>
                                    <a>
                                        {{ $order->firstname }}
                                        {{ $order->lastname }}
                                    </a>
                                    <br />
                                    <small>
                                        Created {{ $order->created_at }}
                                    </small>
                                </td>

                                <td>
                                    {{ $order->email }}
                                </td>
                                <td>
                                    {{ $order->addrres }}

                                </td>
                                <td>
                                    {{ $order->phone }}


                                </td>

                                <td class="project-actions
                                        text-right"
                                    style="display:flex; float: right;">
                                    <a class="btn
                                    btn-primary btn-sm"
                                        href="{{ route('backend.Order.show', $order->id) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Show
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('backend.Order.destroy', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Order ?');">
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
