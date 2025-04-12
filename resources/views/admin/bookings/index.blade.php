@extends('layouts.app-admin')

@section('title', 'Booking Artist Management')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Booking Artist Management
                    </h2>
                    <p class="text-muted mt-1">Manage artist booking requests and schedules</p>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-plus"></i>
                            Create New Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Bookings</h3>
                    <div class="card-actions">
                        <div class="row g-2">
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search bookings...">
                                </div>
                            </div>
                            <div class="col-auto">
                                <select class="form-select">
                                    <option value="all">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Artist</th>
                                    <th>Event Name</th>
                                    <th>Event Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Fee</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statuses = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];
                                    $artists = [
                                        'John Mayer',
                                        'Taylor Swift',
                                        'Ed Sheeran',
                                        'Adele',
                                        'Bruno Mars',
                                        'Ariana Grande',
                                        'Justin Bieber',
                                        'Dua Lipa',
                                        'The Weeknd',
                                        'Billie Eilish',
                                    ];
                                    $locations = [
                                        'Jakarta Convention Center',
                                        'Bali International Convention Centre',
                                        'ICE BSD City',
                                        'Sentul International Convention Center',
                                        'Gelora Bung Karno',
                                        'Ancol Beach City',
                                        'Trans Studio Bandung',
                                        'Candi Borobudur',
                                        'Prambanan Temple',
                                        'Taman Mini Indonesia Indah',
                                    ];
                                    $eventTypes = [
                                        'Music Festival',
                                        'Corporate Event',
                                        'Wedding',
                                        'Birthday Party',
                                        'Charity Concert',
                                        'Product Launch',
                                        'Award Show',
                                        'University Event',
                                        'New Year Celebration',
                                        'Anniversary',
                                    ];
                                @endphp

                                @for ($i = 1; $i <= 10; $i++)
                                    @php
                                        $randomDate = \Carbon\Carbon::now()->addDays(rand(1, 60))->format('M d, Y');
                                        $randomStatus = $statuses[array_rand($statuses)];
                                        $randomArtist = $artists[array_rand($artists)];
                                        $randomLocation = $locations[array_rand($locations)];
                                        $randomEvent = $eventTypes[array_rand($eventTypes)];
                                        $randomFee = 'Rp ' . number_format(rand(10, 100) * 1000000, 0, ',', '.');
                                        $statusClass = match ($randomStatus) {
                                            'Pending' => 'bg-yellow',
                                            'Confirmed' => 'bg-blue',
                                            'Completed' => 'bg-green',
                                            'Cancelled' => 'bg-red',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <tr>
                                        <td>BK-{{ 1000 + $i }}</td>
                                        <td>{{ $randomArtist }}</td>
                                        <td>{{ $randomEvent }} {{ date('Y') }}</td>
                                        <td>{{ $randomDate }}</td>
                                        <td>{{ $randomLocation }}</td>
                                        <td>
                                            <span class="badge {{ $statusClass }}">{{ $randomStatus }}</span>
                                        </td>
                                        <td>{{ $randomFee }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('admin.bookings.show', $i) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.bookings.edit', $i) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>25</span> entries</p>
                    <ul class="pagination m-0 ms-auto">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <i class="ti ti-chevron-left"></i>
                                prev
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                next
                                <i class="ti ti-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
