@extends('backend.Layout.master')

@section('contentAdmin')
    <section class="content">
        <form action="{{ route('backend.Info.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Contact Info</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name_webSite">Name WebSite</label>
                                <input type="text" id="name_webSite" name="name_webSite" class="form-control"
                                    value="{{ old('name_webSite') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="phone" id="phone" name="phone" class="form-control"
                                    value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone2">Phone 2</label>
                                <input type="phone2" id="phone2" name="phone2" class="form-control"
                                    value="{{ old('phone2') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="address" id="address" name="address" class="form-control"
                                    value="{{ old('address') }}">
                            </div>
                            <div class="form-group">
                                <label for="support">Support</label>
                                <input type="support" id="support" name="support" class="form-control"
                                    value="{{ old('support') }}">
                            </div>
                            <div class="form-group">
                                <label for="contact__map">Link for location maps</label>
                                <input type="contact__map" id="contact__map" name="contact__map" class="form-control"
                                    value="{{ old('contact__map') }}">
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create new Category" class="btn btn-success ">
                </div>
            </div>
        </form>
    </section>
@endsection
