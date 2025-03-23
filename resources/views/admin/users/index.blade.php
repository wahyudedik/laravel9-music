@extends('layouts.app')

@section('content')
    @include('layouts.includes.admin.navbar');

    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">User</h2>
                {{-- <p class="text-muted mb-0">list view</p> --}}
            </div>
            <div>
                <a href="{{ url('admin/user/create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> New User
                </a>
            </div>
        </div>

        @php

        @endphp

        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">List View</h5>
                        <div class="d-flex align-items-center">
                            <div></div>
                        </div>
                        {{-- <a href="#" class="text-decoration-none">View All</a> --}}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">Region</th>
                                        <th scope="col">Follow</th>
                                        <th scope="col">Last Login</th>
                                        <th scope="col">Create at</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <img src="https://picsum.photos/40/40?random=2" class="rounded me-3"
                                                        alt="Song">
                                                    <div class="d-flex flex-column">
                                                        <div>{{ $user->name }}</div>
                                                        <div class="small text-secondary">{{ $user->username }}</div>
                                                        <div class="small text-secondary">{{ $user->email }}</div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <div>{{ $user->country }}</div>
                                                    <div class="small text-secondary">{{ $user->region }}</div>
                                                    <div class="small text-secondary">{{ $user->city }}</div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="d-flex flex-column small">
                                                    <div>followers {{ $user->followers }}</div>
                                                    <div>following {{ $user->following }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="small">
                                                    @if ($user->last_login)
                                                        {{ \Carbon\Carbon::parse($user->last_login)->diffForHumans() }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>

                                            </td>
                                            <td class="small">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y H:i') }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a type="button"
                                                        href="{{ url('/admin/user/' . $user->id . '/edit') }}"
                                                        class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="tooltip" title="Delete"
                                                        onclick="delData('{{ $user->id }}','{{ $user->name }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                @if ($users->hasPages())
                                    {{-- pagination front end ngebug --}}
                                    {{-- <tfoot>
                                        <tr>
                                            <td colspan="20">
                                                <div class="p-3">
                                                    {{ $users->links() }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot> --}}
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="modal" id="modal-confirm-delete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="delete-message">Apakah akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btnDelete" data-delete=""
                        onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container w-100 " style="height: 100px;"></div>

    @include('layouts.includes.footer');
@endsection
@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('scripts')
    <script>
        function delData(userId, userName) {
            document.querySelector('.delete-message').innerText = `Are you sure you want to delete "${userName}"?`;
            document.querySelector('.btnDelete').setAttribute('data-delete', userId);
            var modal = new bootstrap.Modal(document.getElementById('modal-confirm-delete'));
            modal.show();
        }

        function confirmDelete() {
            let userId = document.querySelector('.btnDelete').getAttribute('data-delete');
            fetch(`{{ url('/admin/user/') }}/${userId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if(data.error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: `${data.error}`,
                            showConfirmButton: false,
                        });
                    }
                    if(data.success){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: `${data.success}`,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            location.reload();
                        });
                    }

                })
                .catch(error => console.error("Error:", error));

            var modal = bootstrap.Modal.getInstance(document.getElementById('modal-confirm-delete'));
            modal.hide();
        }


        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        @endif

    </script>

@endpush
