@extends('backend.Layout.master')

@section('contentAdmin')
    <section class="content">
        <form action="{{ route('backend.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input type="text" id="name" name="name" disabled
                                    value="{{ old('name', $user->name) }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name"> Email</label>
                                <input type="text" id="email" name="email" disabled
                                    value="{{ old('email', $user->email) }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name"> Phone</label>
                                <input type="text" id="phone" name="phone" disabled
                                    value="{{ old('phone', $user->phone) }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Address</label>
                                <textarea id="address" name="address" disabled class="form-control" rows="4">{{ old('address', $user->address) }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="status">Roles</label>
                                <select id="status" name="user_type" class="form-control custom-select">
                                    <option selected disabled>Select Role</option>
                                    <option value="1"
                                        {{ old('user_type', $user->user_type ?? '') == 1 ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="0"
                                        {{ old('user_type', $user->user_type ?? '') == 0 ? 'selected' : '' }}>
                                        User</option>
                                </select>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <a href=""{{ route('backend.user.index') }} class="btn btn-secondary">Back</a>
                    <input type="submit" value="Update Uasr" class="btn btn-success float-right">
                </div>
            </div>
        </form>


    </section>
@endsection
