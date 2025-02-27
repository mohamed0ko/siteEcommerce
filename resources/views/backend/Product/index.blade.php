@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>

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
                @foreach ($products as $product)
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th style="width: 20%">
                                    Product Name
                                </th>
                                <th style="width: 15%">
                                    Image
                                </th>

                                <th style="width: 8%">
                                    Price
                                </th>
                                <th style="width: 8%">
                                    Quantity
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 23%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    <a>
                                        {{ $product->name }}
                                    </a>
                                    <br />
                                    <small>
                                        Created {{ $product->created_at }}
                                    </small>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        @php
                                            $images = json_decode($product->imagepath);
                                        @endphp
                                        @if (is_array($images) && count($images))
                                            @foreach ($images as $image)
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar"
                                                        src="{{ asset('storage/' . $image) }}"
                                                        style="border-radius: 50%; display: inline; width: 4rem;">
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>

                                </td>
                                <td class="project_progress">
                                    <span class="badge badge-primary"> ${{ $product->price }}</span>
                                </td>
                                <td class="project_progress">
                                    <span class="badge badge-primary text-center"> {{ $product->quantity }}</span>
                                </td>


                                <td class="project-state">

                                    <span class="badge badge-{{ $product->status ? 'success' : 'danger' }}">
                                        {{ $product->status ? 'Enable' : 'Disable' }}</span>

                                </td>
                                <td class="project-actions
                                        text-right"
                                    style="display:flex; float: right;">
                                    <a class="btn
                                    btn-primary btn-sm"
                                        href="{{ route('backend.Product.show', $product->id) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    &nbsp;
                                    <a class="btn btn-info btn-sm" href="{{ route('backend.Product.edit', $product->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('backend.Product.destroy', $product->id) }}" method="POST"
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
