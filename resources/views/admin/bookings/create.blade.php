@extends('layouts.app-admin')

@section('title', 'Create New Booking')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Create New Booking
                    </h2>
                    <p class="text-muted mt-1">Create a new artist booking request</p>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form action="#" method="post" class="card">
                <div class="card-header">
                    <h3 class="card-title">Booking Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Select Artist</label>
                            <select class="form-select" required>
                                <option value="">Select an artist</option>
                                @php
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
                                @endphp
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist }}">{{ $artist }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Event Name</label>
                            <input type="text" class="form-control" placeholder="Enter event name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Event Date</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Event Time</label>
                            <input type="time" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Duration (hours)</label>
                            <input type="number" class="form-control" min="1" max="8" value="2"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Expected Attendees</label>
                            <input type="number" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label required">Venue/Location</label>
                            <input type="text" class="form-control" placeholder="Enter venue name and address" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Total Fee (Rp)</label>
                            <input type="number" class="form-control" min="1000000" step="1000000" required>
                            <small class="form-hint">Enter amount in Indonesian Rupiah (Rp)</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Deposit Amount (Rp)</label>
                            <input type="number" class="form-control" min="1000000" step="1000000" required>
                            <small class="form-hint">Typically 30% of the total fee</small>
                        </div>
                    </div>

                    <div class="hr-text">Event Organizer Information</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Company/Organization Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Contact Person Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Phone Number</label>
                            <input type="tel" class="form-control" placeholder="e.g. 08123456789" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Email Address</label>
                            <input type="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="hr-text">Performance Requirements</div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Technical Requirements</label>
                            <textarea class="form-control" rows="4" placeholder="Sound system, stage size, lighting, etc."></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Hospitality Requirements</label>
                            <textarea class="form-control" rows="4" placeholder="Accommodation, transportation, meals, etc."></textarea>
                        </div>
                    </div>

                    <div class="hr-text">Additional Information</div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Special Requests</label>
                            <textarea class="form-control" rows="3" placeholder="Any special requests or additional information"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Event Type</label>
                            <select class="form-select">
                                <option value="">Select event type</option>
                                @php
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
                                @foreach ($eventTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Booking Status</label>
                            <select class="form-select">
                                <option value="Pending" selected>Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" required>
                            <span class="form-check-label">I confirm that all information provided is accurate and
                                complete</span>
                        </label>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="d-flex">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-link">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="ti ti-device-floppy"></i>
                            Create Booking
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
