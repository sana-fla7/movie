
@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">فیلم‌ها</h5>
            <a href="{{ route('movies.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن فیلم
            </a>
        </div>

        @if (session('status'))
            <div class="alert alert-success m-3">{{ session('status') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>پوستر</th>
                    <th>عنوان</th>
                    <th>دسته بندی</th>
                    <th>سال</th>
                    <th>کشور</th>
                    <th>IMDb</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                @forelse($movies as $movie)
                    <tr>
                        <td>
                            @if($movie->poster)
                                <img src="{{ asset('storage/' . $movie->poster) }}"
                                     alt="{{ $movie->title }}"
                                     width="50" height="70" style="object-fit: cover;" />
                            @else
                                <img src="{{ asset('storage/movies/images.png') }}"
                                     alt="بدون پوستر"
                                     width="50" height="70" style="object-fit: cover;" />
                            @endif
                        </td>

                        <td><span class="fw-medium">{{ $movie->title }}</span></td>
                        <td>{{ $movie->category->name ?? '—' }}</td>
                        <td>{{ $movie->year }}</td>
                        <td>{{ $movie->country }}</td>
                        <td>
                            <span class="badge bg-label-warning">{{ $movie->imdb }}</span>
                        </td>

                        <td>
                            @if($movie->status)
                                <span class="badge bg-label-success">فعال</span>
                            @else
                                <span class="badge bg-label-danger">غیرفعال</span>
                            @endif
                        </td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('movies.edit', $movie->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>

                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف فیلم مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="ti ti-trash me-1"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="8" style="white-space: normal;">
                            <strong>توضیحات:</strong>
                            <div class="mb-2">{{ $movie->description }}</div>

                            <hr class="my-2">

                            <strong>محتوا:</strong>
                            <div>{{ $movie->content }}</div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-3">
                            هیچ فیلمی ثبت نشده است.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
