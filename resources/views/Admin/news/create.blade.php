@extends('Admin.layouts.master')


@section('content')


    <!-- Browser Default -->
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">  اضافه کردن  خبر</h5>
            <div class="card-body">
                <form class="browser-default-validation" action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                    @method('POST')
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
                        <label class="form-label" for="basic-default-name">عنوان </label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            id="basic-default-name"
                            placeholder="عنوان را وارد کنید "
                            required />
                    </div>
                    <div class="mb-3">
                        <label class="d-block form-label">دسته بندی خبر</label>
                        <div class="form-check mb-2">
                            <select name="category_id" class="form-select" aria-label="Default select example">
                                <option selected>دسته بندی رو انتخاب کنید</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="d-block form-label">نویسنده</label>
                        <div class="form-check mb-2">
                            <select name="admin_id" class="form-select" aria-label="Default select example">
                                <option selected>نویسنده رو انتخاب کنید</option>
                                @foreach($admins as $admin)
                                    <option value="{{$admin->id}}">{{$admin->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-bio">توضیحات</label>
                        <textarea
                            class="form-control"
                            id="basic-default-bio"
                            name="description"
                            rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-bio">  محتوا </label>
                        <textarea
                            name="content"
                            type="text"
                            class="form-control"
                            id="basic-default-name"
                        > </textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-bio">   عکس خبر </label>
                        <input
                            name="image"
                            type="file"
                            class="form-control"
                            id="basic-default-name"
                            placeholder="  عکس خبر  را وارد کنید "
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
