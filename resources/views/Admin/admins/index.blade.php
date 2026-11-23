@extends("Admin.layouts.master")
@section("content")
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header">
            <h5 class="mb-0">ادمین‌ها</h5>
            <a href="{{ route('admins.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> افزودن ادمین
            </a>
        </div>

        @if (session('status'))
            <div class="alert alert-success m-3">{{ session('status') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger m-3">{{ session('error') }}</div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام کامل</th>
                    <th>نام کاربری</th>
                    <th>ایمیل</th>
                    <th>تلفن</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($admins as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}</td>
                        <td><span class="fw-medium">{{ $item->fullname }}</span></td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone ?? '—' }}</td>
                        <td>{{ $item->created_at->format('Y/m/d') }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admins.edit', $item->id) }}">
                                        <i class="ti ti-pencil me-1"></i> ویرایش
                                    </a>
                                    <form action="{{ route('admins.destroy', $item->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این ادمین مطمئن هستید؟')">
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
                        <td colspan="7" class="text-center text-muted py-3">هیچ ادمینی ثبت نشده است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $admins->links() }}
        </div>
    </div>
@endsection
