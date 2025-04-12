@extends('layouts.app-admin')

@section('title', 'Edit Booking')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit Booking
                </h2>
                <p class="text-muted mt-1">Update booking information</p>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.bookings.show', $id) }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i>
                        Back to Details
                    </a>
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
                'John Mayer', 'Taylor Swift', 'Ed Sheeran', 'Adele', 
                'Bruno Mars', 'Ariana Grande', 'Justin Bieber', 'Dua Lipa',
                'The Weeknd', 'Billie Eilish'
            ];
            $locations = [
                'Jakarta Convention Center', 'Bali International Convention Centre', 
                'ICE BSD City', 'Sentul International Convention Center',
                'Gelora Bung Karno', 'Ancol Beach City', 'Trans Studio Bandung',
                'Candi Borobudur', 'Prambanan Temple', 'Taman Mini Indonesia Indah'
            ];
            $eventTypes = [
                'Music Festival', 'Corporate Event', 'Wedding', 'Birthday Party',
                'Charity Concert', 'Product Launch', 'Award Show', 'University Event',
                'New Year Celebration', 'Anniversary'
            ];
            
            // Generate random data for this specific booking to pre-fill the form
            $bookingId = 'BK-' . (1000 + (int)$id);
            $randomDate = \Carbon\Carbon::now()->addDays(rand(1, 60));
            $randomStatus = $statuses[array_rand($statuses)];
            $randomArtist = $artists[array_rand($artists)];
            $randomLocation = $locations[array_rand($locations)];
            $randomEvent = $eventTypes[array_rand($eventTypes)] . ' ' . date('Y');
            $randomFee = rand(10, 100) * 1000000;
            $randomDeposit = $randomFee * 0.3;
            $randomDuration = rand(1, 4);
            $randomAttendees = rand(100, 5000);
            $randomOrganizer = 'PT ' . str_replace(' ', '', $randomEvent) . ' Indonesia';
            $randomContactPerson = ['John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 'Michael Brown'][array_rand(['John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 'Michael Brown'])];
            $randomContactPhone = '08' . rand(10, 99) . rand(1000, 9999) . rand(1000, 9999);
            $randomContactEmail = strtolower(str_replace(' ', '', $randomContactPerson)) . '@example.com';
            $randomTechReq = "Professional sound system with minimum 10,000 watts\nStage size minimum 8x6 meters\n4 wireless microphones (Shure SM58 or equivalent)\nIn-ear monitoring system for all band members\nLighting system with operator";
            $randomHospReq = "Private dressing room with refreshments\nAccommodation for artist and team (" . rand(3, 8) . " rooms)\nTransportation from airport/hotel to venue\nMeals for artist and crew (" . rand(5, 15) . " people)\nSecurity personnel during performance";
        @endphp

        <form action="#" method="post" class="card">
            <div class="card-header">
                <h3 class="card-title">Booking Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Booking ID</label>
                        <input type="text" class="form-control" value="{{ $bookingId }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Select Artist</label>
                        <select class="form-select" required>
                            <option value="">Select an artist</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist }}" {{ $artist == $randomArtist ? 'selected' : '' }}>{{ $artist }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Event Name</label>
                        <input type="text" class="form-control" value="{{ $randomEvent }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Event Date</label>
                        <input type="date" class="form-control" value="{{ $randomDate->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Event Time</label>
                        <input type="time" class="form-control" value="{{ rand(17, 19) }}:00" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Duration (hours)</label>
                        <input type="number" class="form-control" min="1" max="8" value="{{ $randomDuration }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Expected Attendees</label>
                        <input type="number" class="form-control" min="1" value="{{ $randomAttendees }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Status</label>
                        <select class="form-select" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $status == $randomStatus ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label required">Venue/Location</label>
                        <input type="text" class="form-control" value="{{ $randomLocation }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Total Fee (Rp)</label>
                        <input type="number" class="form-control" min="1000000" step="1000000" value="{{ $randomFee }}" required>
                        <small class="form-hint">Enter amount in Indonesian Rupiah (Rp)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Deposit Amount (Rp)</label>
                        <input type="number" class="form-control" min="1000000" step="1000000" value="{{ (int)$randomDeposit }}" required>
                        <small class="form-hint">Typically 30% of the total fee</small>
                    </div>
                </div>

                <div class="hr-text">Event Organizer Information</div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Company/Organization Name</label>
                        <input type="text" class="form-control" value="{{ $randomOrganizer }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Contact Person Name</label>
                        <input type="text" class="form-control" value="{{ $randomContactPerson }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Phone Number</label>
                        <input type="tel" class="form-control" value="{{ $randomContactPhone }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Email Address</label>
                        <input type="email" class="form-control" value="{{ $randomContactEmail }}" required>
                    </div>
                </div>

                <div class="hr-text">Performance Requirements</div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Technical Requirements</label>
                        <textarea class="form-control" rows="4">{{ $randomTechReq }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Hospitality Requirements</label>
                        <textarea class="form-control" rows="4">{{ $randomHospReq }}</textarea>
                    </div>
                </div>

                <div class="hr-text">Additional Information</div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Special Requests</label>
                        <textarea class="form-control" rows="3">{{ rand(0, 1) ? 'Artist has requested a specific brand of bottled water and organic snacks in the dressing room.' : '' }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Event Type</label>
                        <select class="form-select">
                            <option value="">Select event type</option>
                            @foreach($eventTypes as $type)
                                <option value="{{ $type }}" {{ strpos($randomEvent, $type) !== false ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <a href="{{ route('admin.bookings.show', $id) }}" class="btn btn-link">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <i class="ti ti-device-floppy"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
