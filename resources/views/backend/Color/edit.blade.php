@extends('backend.Layout.master')

@section('contentAdmin')
    <section class="content">
        <form action="{{ route('backend.Color.update', $color->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Color</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Color Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $color->name }}">
                            </div>
                            <div class="card-body">
                                <label for="code">Select Color:</label>
                                <input type="color" class="form-control" name="code" id="code"
                                    value="{{ old('code', $color->code) }}">
                            </div>





                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('backend.Color.index') }}" class="btn btn-secondary">Back</a>
                    <input type="submit" value="Update Category" class="btn btn-success ">
                </div>
            </div>
        </form>
    </section>
@endsection
