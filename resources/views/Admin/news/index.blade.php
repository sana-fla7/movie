@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">اخبار</h5>
            <a href="{{ route('news.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن خبر
            </a>
        </div>

        @if (session('status'))
            <div class="alert alert-success m-3">{{ session('status') }}</div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>دسته‌بندی</th>
                    <th>نویسنده</th>
                    <th>توضیحات</th>
                    <th>محتوا</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($news as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}"
                                     alt="{{ $item->title }}"
                                     width="70" height="50" style="object-fit: cover;" />
                            @else
                                <img src="{{ asset('storage/news/images.png') }}"
                                     alt="بدون تصویر"
                                     width="70" height="50" style="object-fit: cover;" />
                            @endif
                        </td>
                        <td><span class="fw-medium">{{ $item->title }}</span></td>
                        <td>{{ $item->category->title ?? '—' }}</td>
                        <td>{{ $item->admin->fullname ?? $item->admin->name ?? '—' }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @if($item->status)
                                <span class="badge bg-label-success">فعال</span>
                            @else
                                <span class="badge bg-label-danger">غیرفعال</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('Y/m/d') }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('news.edit', $item->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این خبر مطمئن هستید؟')">
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
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">هیچ خبری ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
