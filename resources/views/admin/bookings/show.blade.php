@extends('layouts.app-admin')

@section('title', 'Booking Details')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Booking Details
                    </h2>
                    <p class="text-muted mt-1">View and manage booking information</p>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i>
                            Back to List
                        </a>
                        <button type="button" class="btn btn-primary" onclick="window.print()">
                            <i class="ti ti-printer"></i>
                            Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
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

                // Generate random data for this specific booking
                $bookingId = 'BK-' . (1000 + (int) $id);
                $randomDate = \Carbon\Carbon::now()->addDays(rand(1, 60));
                $randomStatus = $statuses[array_rand($statuses)];
                $randomArtist = $artists[array_rand($artists)];
                $randomLocation = $locations[array_rand($locations)];
                $randomEvent = $eventTypes[array_rand($eventTypes)] . ' ' . date('Y');
                $randomFee = rand(10, 100) * 1000000;
                $randomDeposit = $randomFee * 0.3;
                $randomBalance = $randomFee * 0.7;
                $randomDuration = rand(1, 4);
                $randomAttendees = rand(100, 5000);
                $randomOrganizer = 'PT ' . str_replace(' ', '', $randomEvent) . ' Indonesia';
                $randomContactPerson = ['John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 'Michael Brown'][
                    array_rand(['John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 'Michael Brown'])
                ];
                $randomContactPhone = '08' . rand(10, 99) . rand(1000, 9999) . rand(1000, 9999);
                $randomContactEmail = strtolower(str_replace(' ', '.', $randomContactPerson)) . '@example.com';

                $statusClass = match ($randomStatus) {
                    'Pending' => 'bg-yellow',
                    'Confirmed' => 'bg-blue',
                    'Completed' => 'bg-green',
                    'Cancelled' => 'bg-red',
                    default => 'bg-secondary',
                };

                $timeline = [
                    [
                        'date' => \Carbon\Carbon::now()->subDays(rand(5, 15))->format('M d, Y'),
                        'event' => 'Booking request received',
                    ],
                    [
                        'date' => \Carbon\Carbon::now()->subDays(rand(3, 10))->format('M d, Y'),
                        'event' => 'Initial deposit payment received',
                    ],
                ];

                if ($randomStatus == 'Confirmed' || $randomStatus == 'Completed') {
                    $timeline[] = [
                        'date' => \Carbon\Carbon::now()->subDays(rand(1, 5))->format('M d, Y'),
                        'event' => 'Booking confirmed by artist',
                    ];
                    $timeline[] = [
                        'date' => \Carbon\Carbon::now()->subDays(rand(0, 3))->format('M d, Y'),
                        'event' => 'Contract signed by both parties',
                    ];
                }

                if ($randomStatus == 'Completed') {
                    $timeline[] = ['date' => $randomDate->format('M d, Y'), 'event' => 'Event completed successfully'];
                    $timeline[] = [
                        'date' => $randomDate->addDays(1)->format('M d, Y'),
                        'event' => 'Final payment received',
                    ];
                }

                if ($randomStatus == 'Cancelled') {
                    $timeline[] = [
                        'date' => \Carbon\Carbon::now()->subDays(rand(1, 3))->format('M d, Y'),
                        'event' => 'Booking cancelled by client',
                    ];
                    $timeline[] = [
                        'date' => \Carbon\Carbon::now()->subDays(rand(0, 1))->format('M d, Y'),
                        'event' => 'Refund processed (70% of deposit)',
                    ];
                }
            @endphp

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Booking Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Booking ID</div>
                                    <div class="datagrid-content">{{ $bookingId }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">
                                        <span class="badge {{ $statusClass }}">{{ $randomStatus }}</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Artist</div>
                                    <div class="datagrid-content">{{ $randomArtist }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Event Name</div>
                                    <div class="datagrid-content">{{ $randomEvent }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Event Date</div>
                                    <div class="datagrid-content">{{ $randomDate->format('d F Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Event Time</div>
                                    <div class="datagrid-content">{{ rand(17, 19) }}:00 - {{ rand(21, 23) }}:00</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Duration</div>
                                    <div class="datagrid-content">{{ $randomDuration }} hour(s)</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Location</div>
                                    <div class="datagrid-content">{{ $randomLocation }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Expected Attendees</div>
                                    <div class="datagrid-content">{{ number_format($randomAttendees) }} people</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Total Fee</div>
                                    <div class="datagrid-content">Rp {{ number_format($randomFee, 0, ',', '.') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Deposit Paid</div>
                                    <div class="datagrid-content">Rp {{ number_format($randomDeposit, 0, ',', '.') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Remaining Balance</div>
                                    <div class="datagrid-content">Rp {{ number_format($randomBalance, 0, ',', '.') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::now()->subDays(rand(15, 30))->format('d M Y, H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Updated</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::now()->subDays(rand(1, 5))->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Event Organizer Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Company Name</div>
                                    <div class="datagrid-content">{{ $randomOrganizer }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Contact Person</div>
                                    <div class="datagrid-content">{{ $randomContactPerson }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Phone Number</div>
                                    <div class="datagrid-content">{{ $randomContactPhone }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email</div>
                                    <div class="datagrid-content">{{ $randomContactEmail }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Performance Requirements</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 class="mb-2">Technical Requirements</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">Professional sound system with minimum 10,000 watts</li>
                                    <li class="list-group-item">Stage size minimum 8x6 meters</li>
                                    <li class="list-group-item">4 wireless microphones (Shure SM58 or equivalent)</li>
                                    <li class="list-group-item">In-ear monitoring system for all band members</li>
                                    <li class="list-group-item">Lighting system with operator</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="mb-2">Hospitality Requirements</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">Private dressing room with refreshments</li>
                                    <li class="list-group-item">Accommodation for artist and team ({{ rand(3, 8) }}
                                        rooms)</li>
                                    <li class="list-group-item">Transportation from airport/hotel to venue</li>
                                    <li class="list-group-item">Meals for artist and crew ({{ rand(5, 15) }} people)
                                    </li>
                                    <li class="list-group-item">Security personnel during performance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                @if ($randomStatus == 'Pending')
                                    <button class="btn btn-success mb-2">
                                        <i class="ti ti-check"></i> Confirm Booking
                                    </button>
                                    <button class="btn btn-danger mb-2">
                                        <i class="ti ti-x"></i> Reject Booking
                                    </button>
                                @elseif($randomStatus == 'Confirmed')
                                    <button class="btn btn-primary mb-2">
                                        <i class="ti ti-file-invoice"></i> Generate Contract
                                    </button>
                                    <button class="btn btn-info mb-2">
                                        <i class="ti ti-send"></i> Send Reminder
                                    </button>
                                    <button class="btn btn-warning mb-2">
                                        <i class="ti ti-calendar"></i> Reschedule
                                    </button>
                                    <button class="btn btn-danger mb-2">
                                        <i class="ti ti-ban"></i> Cancel Booking
                                    </button>
                                @elseif($randomStatus == 'Completed')
                                    <button class="btn btn-success mb-2">
                                        <i class="ti ti-receipt"></i> Generate Invoice
                                    </button>
                                    <button class="btn btn-info mb-2">
                                        <i class="ti ti-star"></i> Add Review
                                    </button>
                                @else
                                    <button class="btn btn-secondary mb-2">
                                        <i class="ti ti-refresh"></i> Reactivate Booking
                                    </button>
                                @endif
                                <a href="{{ route('admin.bookings.edit', $id) }}" class="btn btn-outline-primary">
                                    <i class="ti ti-edit"></i> Edit Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Timeline</h3>
                        </div>
                        <div class="card-body">
                            <ul class="timeline">
                                @foreach ($timeline as $item)
                                    <li class="timeline-event">
                                        <div class="timeline-event-icon bg-primary-lt">
                                            <i class="ti ti-calendar-event"></i>
                                        </div>
                                        <div class="timeline-event-card">
                                            <div class="timeline-event-date">{{ $item['date'] }}</div>
                                            <div class="timeline-event-content">
                                                <p class="text-muted">{{ $item['event'] }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Notes</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Add a note about this booking..."></textarea>
                            </div>
                            <button class="btn btn-primary w-100">
                                <i class="ti ti-plus"></i> Add Note
                            </button>

                            <div class="mt-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="avatar avatar-xs me-2">JD</span>
                                            <div>
                                                <span class="text-body">John Doe</span>
                                                <span
                                                    class="text-muted ms-2">{{ \Carbon\Carbon::now()->subDays(rand(1, 3))->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted">Client requested a specific song list. Shared with the
                                                artist via email.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-sm mt-2">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="avatar avatar-xs me-2">AS</span>
                                            <div>
                                                <span class="text-body">Admin System</span>
                                                <span
                                                    class="text-muted ms-2">{{ \Carbon\Carbon::now()->subDays(rand(4, 7))->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-muted">Booking created and initial confirmation email sent to
                                                organizer.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
