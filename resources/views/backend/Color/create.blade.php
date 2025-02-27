@extends('backend.Layout.master')

@section('contentAdmin')
    <section class="content">
        <form action="{{ route('backend.Color.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Color</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Color</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="card-body">
                                <label for="code">Select Color:</label>
                                <input type="color" class="form-control" name="code" id="code"
                                    value="{{ old('code') }}" required>
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
                    <input type="submit" value="Create new Color" class="btn btn-success ">
                </div>
            </div>
        </form>
    </section>
@endsection
