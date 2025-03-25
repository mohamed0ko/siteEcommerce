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
                @foreach ($sliders as $slider)
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th style="width: 20%">
                                    Title
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $slider->title1 }}</td>

                                <td>
                                    <ul class="list-inline">



                                        <img alt="Product Image" class="img-thumbnail shadow-sm" src="{{ $slider->image1 }}"
                                            style="border-radius: 10px; width: 80px; height: 80px; object-fit: cover;">


                                    </ul>

                                </td>





                                <td class="project-actions
                                        text-right"
                                    style="display:flex; float: right;">

                                    &nbsp;
                                    <a class="btn btn-info btn-sm" href="{{ route('backend.Slider.edit', $slider->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    &nbsp;

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
