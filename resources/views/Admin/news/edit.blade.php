@extends('Admin.layouts.master')


@section('content')

    <!-- Browser Default -->
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">   ویرایش کردن  خبر {{$news->title}}</h5>
            <div class="card-body">
                <form class="browser-default-validation" action="{{route('news.update' , $news->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
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
                        <label class="form-label" for="basic-default-name">عنوان  خبر </label>
                        <input
                            value="{{$news->title}}"
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
                                    @if($category->id === $news->category_id)
                                        <option selected value="{{$category->id}}">{{$category->title}}</option>
                                    @endif
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
                            required>
                           {{$news->description}}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-bio">  محتوا </label>
                        <textarea
                            name="content"
                            type="text"
                            class="form-control"
                            id="basic-default-name"
                        >
                            {{$news->content}}

                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-bio">   تصویر خبر </label>
                        <input
                            name="image"
                            type="file"
                            class="form-control"
                            id="basic-default-name"
                            placeholder=" تصویر خبر  را وارد کنید "
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
