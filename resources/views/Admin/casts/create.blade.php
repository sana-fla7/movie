@extends("Admin.layouts.master")
@section("content")
    <!-- Basic Bootstrap Table -->
    <div class="card">

        <h5 class="card-header  w-30 mx-auto text-dark" > فرم افزودن  </h5>
        <form action="{{route('casts.store')}}" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>نام و نام خانوادگی</label>
                <input type="text" name="full_name" class="form-control">
            </div>
            <div class="mb-3">
                <label>عکس</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label>توضیحات</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="mb-3">
                <label>نقش</label>
                <select name="role" class="form-control">
                    <option value="actor">بازیگر</option>
                    <option value="director">کارگردان</option>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">افزودن </button>
        </form>
    </div>
    <!--/ Basic Bootstrap Table -->

    <hr class="my-5" />
@endsection
