
@extends('Admin.layouts.master')

@section('content')

    <!-- Browser Default -->
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">اضافه کردن کالکشن</h5>
            <div class="card-body">
                <form class="browser-default-validation" action="{{ route('collection.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-name">عنوان</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            id="basic-default-name"
                            placeholder="عنوان را وارد کنید"
                            required />
                    </div>

                    <div class="mb-3">
                        <label class="d-block form-label">انتخاب فیلم</label>
                        <div class="form-check mb-2">
                            <select name="movie_id" class="form-select" required>
                                <option value="" selected disabled>فیلم را انتخاب کنید</option>

                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}">
                                        {{ $movie->title }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-bio">عکس کالکشن</label>
                        <input
                            name="image"
                            type="file"
                            class="form-control"
                            id="basic-default-bio"
                            placeholder="عکس کالکشن را وارد کنید"
                        />
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Browser Default -->

@endsection
