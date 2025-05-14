@extends('layouts.landing-page')

@section('content')
    <!-- Explore Navigation -->
    <div class="mb-8" id="cartContainer">
        <div class="w-full mb-4 flex justify-between items-center flex-wrap ">
            <h1 class="text-3xl font-bold mb-3"><i class="ti ti-money mr-2 "></i> Pembayaran (3 item)</h1>
            <a href="{{route('cart',['idUser' => Auth::id()])}}"
                class=" text-md px-4 py-2 bg-gray-900 flex items-center justify-center rounded-xl mb-3 hover:bg-black hover:text-white">
                <i class="ti ti-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="w-full mb-8">

            <div class="flex flex-wrap">

                <div class="flex flex-col w-full md:w-8/12">




                    <div class=" bg-black rounded-xl p-2 w-full ">
                        <div class="border border-gray-700 rounded-xl shadow-sm p-4">

                            <div class="relative">
                                <a href="#"
                                    class="absolute top-0 right-0 z-10 rounded-xl border  border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-gray-50 hover:bg-gray-50 hover:text-gray-800">
                                    <i class="ti ti-pencil mr-2"></i>
                                    Ubah Profil
                                </a>
                            </div>

                            <div class="flex ">
                                <div class="w-36">Nama</div>
                                <div class="">Alice Artist</div>
                            </div>
                            <div class="flex ">
                                <div class="w-36">Alamat</div>
                                <div class="">Jl. Baurekso no. 20</div>
                            </div>
                            <div class="flex ">
                                <div class="w-36">Kota</div>
                                <div class="">Surabaya</div>
                            </div>
                            <div class="flex ">
                                <div class="w-36">Telpon/Wa</div>
                                <div class="">085736547889</div>
                            </div>
                            <div class="flex ">
                                <div class="w-36">Email</div>
                                <div class="">alice@email.com</div>
                            </div>
                        </div>
                    </div>

                    <div class=" bg-black rounded-xl p-2 w-full ">
                        <div class="border border-gray-700 rounded-xl shadow-sm p-4">

                            <div class="flex w-full ">
                                <div class=" w-48">Metode Pembayaran</div>
                                <div class=" w-8/12">
                                    <select id="pilihan" name="pilihan"
                                        class=" bg-black text-white border text-sm  border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400 w-full">
                                        <option value="1">Pilh Metode</option>
                                        <option value="2">QRIS</option>
                                        <option value="3">Virtual Account</option>
                                        <option value="3">ATM</option>
                                        <option value="3">Lainnya</option>
                                    </select>


                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="space-y-4 bg-black p-2 rounded-xl w-full ">
                        <!-- Loop per seller -->
                        <div class="border border-gray-700 rounded-xl shadow-sm p-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-white mb-4"> John Music</h2>
                                <div class="w-1/12 flex justify-center">
                                    <a href="#"
                                        class="p-2 flex justify-center items-center h-8 w-8 rounded-lg bg-red-600 text-white hover:bg-red-700 ">
                                        <i class="ti ti-trash"></i>
                                    </a>

                                </div>
                            </div>



                            <!-- Loop per item lagu -->
                            <div class="space-y-4">

                                <div class="flex justify-between items-center">

                                    <div class="flex justify-between items-center bg-gray-900 p-3 rounded-md w-11/12">
                                        <div class="flex items-center">
                                            <img id="fullscreenPlayerCoverAvatar" src="https://picsum.photos/14"
                                                alt="Song Cover" class="w-12 h-12 rounded-lg object-cover mr-4" />
                                            <div>
                                                <p class="text-sm font-medium text-white">Lagu: Freedom Sound</p>
                                                <p class="text-sm text-gray-400">Lisensi: Cover</p>
                                            </div>


                                        </div>
                                        <div class="text-right text-sm font-bold text-white">
                                            Rp 50.000
                                        </div>
                                    </div>
                                    <div class="w-1/12 flex justify-center">
                                        <a href="#"
                                            class="p-2 flex justify-center items-center h-8 w-8 rounded-lg bg-red-600 text-white hover:bg-red-700 ">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>

                                </div>

                                <div class="flex justify-between items-center">

                                    <div class="flex justify-between items-center bg-gray-900 p-3 rounded-md w-11/12">
                                        <div class="flex items-center">
                                            <img id="fullscreenPlayerCoverAvatar" src="https://picsum.photos/14"
                                                alt="Song Cover" class="w-12 h-12 rounded-lg object-cover mr-4" />
                                            <div>
                                                <p class="text-sm font-medium text-white">Lagu: Summer Vibe</p>
                                                <p class="text-sm text-gray-400">Lisensi: Remake</p>
                                            </div>


                                        </div>

                                        <div class="text-right text-sm font-bold text-white">
                                            Rp 100.000
                                        </div>
                                    </div>
                                    <div class="w-1/12 flex justify-center">
                                        <a href="#"
                                            class="p-2 flex justify-center items-center h-8 w-8 rounded-lg bg-red-600 text-white hover:bg-red-700 ">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>

                                </div>



                            </div>
                        </div>

                        <!-- Seller lainnya -->
                        <div class="border border-gray-700 rounded-xl shadow-sm p-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-white mb-4"> Musik Kita</h2>
                                <div class="w-1/12 flex justify-center">
                                    <a href="#"
                                        class="p-2 flex justify-center items-center h-8 w-8 rounded-lg bg-red-600 text-white hover:bg-red-700 ">
                                        <i class="ti ti-trash"></i>
                                    </a>

                                </div>
                            </div>

                            <div class="space-y-4">

                                <div class="flex justify-between items-center">

                                    <div class="flex justify-between items-center bg-gray-900 p-3 rounded-md w-11/12">
                                        <div class="flex items-center">
                                            <img id="fullscreenPlayerCoverAvatar" src="https://picsum.photos/14"
                                                alt="Song Cover" class="w-12 h-12 rounded-lg object-cover mr-4" />
                                            <div>
                                                <p class="text-sm font-medium text-white">Lagu: Chill Beat</p>
                                                <p class="text-sm text-gray-400">Lisensi: Remake</p>
                                            </div>


                                        </div>

                                        <div class="text-right text-sm font-bold text-white">
                                            Rp 75.000
                                        </div>
                                    </div>
                                    <div class="w-1/12 flex justify-center">
                                        <a href="#"
                                            class="p-2 flex justify-center items-center h-8 w-8 rounded-lg bg-red-600 text-white hover:bg-red-700 ">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                </div>


                <div class="flex flex-col bg-black p-2 rounded-xl w-full md:w-4/12">
                    <div class="border border-gray-700 rounded-xl shadow-sm p-5 flex flex-col ">

                        <div class="flex flex-wrap justify-between mb-2 px-3">
                            <div>Subtotal </div>
                            <div class="ml-2">Rp. 75,000</div>
                        </div>
                        <div class="flex flex-wrap justify-between mb-2 px-3">
                            <div>PPN (12%) </div>
                            <div class="ml-2">Rp. 7,500</div>
                        </div>
                        <div class="flex flex-wrap justify-between mb-2 px-3">
                            <div>Biaya Admin </div>
                            <div class="ml-2">Rp. 17,500</div>
                        </div>
                        <div class="flex flex-wrap justify-between my-2 text-xl p-3 bg-slate-900 rounded-xl ">
                            <div>Grand total </div>
                            <div class="ml-2">Rp. 117,500</div>
                        </div>

                        <div class="block">

                            <a href="{{route('payment-done')}}"
                                class="block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200 mt-8 text-center text-lg">
                                Checkout
                            </a>

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
            // Category pill click
            const categoryPills = document.querySelectorAll('.category-pill');
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    // Here you would typically filter content based on the selected category
                });
            });

            // Toggle menu function
            window.toggleMenu = function(menuId) {
                const menu = document.getElementById(menuId);
                if (menu) {
                    menu.classList.toggle('hidden');

                    // Close when clicking outside
                    const closeMenu = function(e) {
                        if (!menu.contains(e.target) && !e.target.closest(
                                `[onclick="toggleMenu('${menuId}')"]`)) {
                            menu.classList.add('hidden');
                            document.removeEventListener('click', closeMenu);
                        }
                    };

                    document.addEventListener('click', closeMenu);
                }
            };

            // Add animation delay to grid items
            document.querySelectorAll('.scroll-item').forEach((item, index) => {
                item.style.setProperty('--index', index);
            });

            // Initialize AOS animation library if it exists
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true
                });
            }
        });
    </script>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const elCart = document.getElementById('cartContainer');
            const elMain = document.getElementById('mainContent');

            if (elCart) {
                elMain.classList.add('w-full');
            }


        });
    </script>
@endpush
