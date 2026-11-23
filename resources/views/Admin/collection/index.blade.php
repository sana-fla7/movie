@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">کالکشن‌ها</h5>
            <a href="{{ route('collection.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن کالکشن
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
                    <th>فیلم</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($collections as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}"
                                     alt="{{ $item->title }}"
                                     width="80" height="60" style="object-fit: cover;" />
                            @else
                                <img src="{{ asset('storage/collection/images.png') }}"
                                     alt="بدون تصویر"
                                     width="80" height="60" style="object-fit: cover;" />
                            @endif
                        </td>
                        <td><span class="fw-medium">{{ $item->title }}</span></td>
                        <td>{{ $item->movie->title ?? '—' }}</td>
                        <td>{{ $item->created_at->format('Y/m/d') }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('collection.edit', $item->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('collection.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این کالکشن مطمئن هستید؟')">
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
                        <td colspan="5" class="text-center text-muted py-3">هیچ کالکشنی ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $collections->links() }}
        </div>
    </div>
@endsection
