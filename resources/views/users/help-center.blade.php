@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Support</div>
                        <h2 class="page-title">Help Center</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <!-- Search Bar -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <form action="{{ route('help.center') }}" method="GET">
                                    <div class="input-icon mb-3">
                                        <input type="text" name="q" value="{{ request('q') }}"
                                            class="form-control form-control-lg" placeholder="Search for help topics...">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-search"></i>
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary px-5">
                                            <i class="ti ti-search me-2"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Categories -->
                <div class="row mb-4">
                    @php
                        $categories = [
                            [
                                'icon' => 'ti-music',
                                'title' => 'Music Playback',
                                'description' => 'Issues with playing songs or albums',
                            ],
                            [
                                'icon' => 'ti-user',
                                'title' => 'Account & Profile',
                                'description' => 'Manage your account settings and profile',
                            ],
                            [
                                'icon' => 'ti-credit-card',
                                'title' => 'Billing & Payments',
                                'description' => 'Questions about payments and subscriptions',
                            ],
                            [
                                'icon' => 'ti-download',
                                'title' => 'Downloads & Storage',
                                'description' => 'Help with downloading and storing music',
                            ],
                            [
                                'icon' => 'ti-device-mobile',
                                'title' => 'Mobile App',
                                'description' => 'Support for our mobile applications',
                            ],
                            [
                                'icon' => 'ti-shield',
                                'title' => 'Privacy & Security',
                                'description' => 'Information about data protection',
                            ],
                        ];
                    @endphp

                    @foreach ($categories as $category)
                        <div class="col-md-4 mb-3">
                            <div class="card card-link card-link-pop h-100">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xl bg-primary-lt">
                                            <i class="ti {{ $category['icon'] }} text-primary" style="font-size: 2rem;"></i>
                                        </span>
                                    </div>
                                    <h3 class="card-title mb-2">{{ $category['title'] }}</h3>
                                    <p class="text-muted">{{ $category['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Popular FAQs -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-help-circle me-2 text-primary"></i>Frequently Asked Questions
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            @php
                                $faqs = [
                                    [
                                        'question' => 'How do I verify my account as an artist?',
                                        'answer' =>
                                            'To verify your account as an artist, go to your profile settings and click on "Verification". Upload the required documents including your ID and proof of your music work. Our team will review your application within 3-5 business days.',
                                    ],
                                    [
                                        'question' => 'How can I create a cover of a song?',
                                        'answer' =>
                                            'To create a cover, first purchase the license for the song you want to cover. Then go to "My Assets" in your profile, find the purchased song, and click on "Create Cover". Upload your cover version and fill in the required details.',
                                    ],
                                    [
                                        'question' => 'What payment methods do you accept?',
                                        'answer' =>
                                            'We accept various payment methods including credit/debit cards, bank transfers, and digital wallets like PayPal. All payments are processed securely through our payment gateway.',
                                    ],
                                    [
                                        'question' => 'How do I withdraw my earnings?',
                                        'answer' =>
                                            'To withdraw your earnings, go to your Dashboard, click on "Earnings", and select "Withdraw". You need to have a minimum balance of Rp. 100,000 to request a withdrawal. Funds will be transferred to your registered bank account within 3-5 business days.',
                                    ],
                                    [
                                        'question' => 'How do royalties work for composers?',
                                        'answer' =>
                                            'Composers earn royalties whenever their original compositions are streamed, downloaded, or covered by other artists. The royalty rate is 70% of the net revenue generated. Payments are processed monthly and can be viewed in your earnings dashboard.',
                                    ],
                                ];
                            @endphp

                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {{ $faq['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-3">Still need help?</h3>
                                <p class="text-muted mb-4">
                                    Our support team is available to assist you with any questions or issues you may have.
                                    Please fill out the form and we'll get back to you as soon as possible.
                                </p>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="avatar bg-primary-lt">
                                            <i class="ti ti-mail text-primary"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="m-0">Email Support</h4>
                                        <p class="text-muted">support@playlistmusic.com</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="avatar bg-primary-lt">
                                            <i class="ti ti-phone text-primary"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="m-0">Phone Support</h4>
                                        <p class="text-muted">+62 812 3456 7890 (Mon-Fri, 9AM-5PM)</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="avatar bg-primary-lt">
                                            <i class="ti ti-messages text-primary"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="m-0">Live Chat</h4>
                                        <p class="text-muted">Available 24/7 for premium users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="#" method="POST" class="card card-md border">
                                    <div class="card-body">
                                        <h3 class="card-title">Contact Support</h3>
                                        <div class="mb-3">
                                            <label class="form-label">Subject</label>
                                            <select class="form-select">
                                                <option value="">Select a topic</option>
                                                <option>Account Issues</option>
                                                <option>Payment Problems</option>
                                                <option>Music Playback</option>
                                                <option>Verification Process</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" rows="4" placeholder="Describe your issue in detail"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Attachments (optional)</label>
                                            <input type="file" class="form-control">
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ti ti-send me-2"></i>Submit Request
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // You can add any help center specific JavaScript here
        });
    </script>
@endsection
