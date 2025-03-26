@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">My Collection</div>
                    <h2 class="page-title">Wishlist</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-dashboard me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if(count($wishlistItems ?? []) > 0)
                <div class="row row-cards">
                    @foreach($wishlistItems as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-status-top bg-primary"></div>
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <span class="avatar avatar-md" style="background-image: url({{ $item['image'] }})"></span>
                                        </div>
                                        <div class="col">
                                            <h3 class="card-title mb-0">{{ $item['title'] }}</h3>
                                            <div class="text-muted">{{ $item['artist'] }}</div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="me-auto">
                                                    <span class="text-muted d-block">{{ $item['album'] }}</span>
                                                </div>
                                                <span class="badge bg-primary-lt">{{ $item['type'] }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="me-auto">
                                                    <div class="text-muted">
                                                        <i class="ti ti-calendar me-1"></i> Added {{ $item['added_date'] }}
                                                    </div>
                                                </div>
                                                @if($item['price'])
                                                    <span class="h4 mb-0">{{ $item['price'] }}</span>
                                                @else
                                                    <span class="badge bg-green">Free</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-link">Preview</a>
                                        <div class="ms-auto">
                                            <button class="btn btn-primary">
                                                <i class="ti ti-shopping-cart me-2"></i>Add to Cart
                                            </button>
                                            <button class="btn btn-icon btn-ghost-danger" data-bs-toggle="tooltip" title="Remove from wishlist">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty">
                    <div class="empty-img">
                        <i class="ti ti-heart-off" style="font-size: 4rem; color: var(--primary-color);"></i>
                    </div>
                    <p class="empty-title">Your wishlist is empty</p>
                    <p class="empty-subtitle text-muted">
                        Explore our music collection and add your favorite songs to your wishlist.
                    </p>
                    <div class="empty-action">
                        <a href="{{ route('popular-songs') }}" class="btn btn-primary">
                            <i class="ti ti-music me-2"></i>Explore Music
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Example of using SweetAlert for wishlist actions
        const removeButtons = document.querySelectorAll('.btn-ghost-danger');
        removeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Remove from wishlist?',
                    text: "This item will be removed from your wishlist",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e53935',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Here you would normally send an AJAX request to remove the item
                        // For demo purposes, we'll just show a success message
                        const card = this.closest('.col-md-6');
                        card.style.opacity = '0';
                        setTimeout(() => {
                            card.remove();
                            // Check if there are any items left
                            const remainingItems = document.querySelectorAll('.col-md-6').length;
                            if (remainingItems === 0) {
                                location.reload(); // Reload to show empty state
                            }
                        }, 300);
                        
                        Swal.fire(
                            'Removed!',
                            'The item has been removed from your wishlist.',
                            'success'
                        )
                    }
                })
            });
        });
    });
</script>
@endsection
