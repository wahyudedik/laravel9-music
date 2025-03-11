<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Manajemen dan Tata Kelola SPBE">
    <meta name="author" content="devtim">
    <meta name="keyword" content="Manajemen dan Tata Kelola SPBE">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon-spbe.png') }}" type="image/png">

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{asset('template/dist')}}/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="{{asset('template/dist')}}/css/vendors/simplebar.css">

    <!-- Main styles for this application-->
    <link href="{{asset('template/dist')}}/css/light-style.css" rel="stylesheet">

    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{asset('template/dist')}}/css/examples.css" rel="stylesheet">
    <link href="{{asset('template/dist')}}/css/style-wizard-form.css" rel="stylesheet">
    <link href="{{asset('template/dist')}}/css/style-wizard-form-short.css" rel="stylesheet">
    <link href="{{asset('template/dist')}}/css/style-wizard-form-long.css" rel="stylesheet">
    <link href="{{asset('template/dist')}}/css/style-wizard-form_bsr.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css" integrity="sha512-iVAPZRCMdOOiZWYKdeY78tlHFUKf/PqAJEf/0bfnkxJ8MHQHqNXB/wK2y6RH/LmoQ0avRlGphSn06IMMxSW+xw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css" />

    <!-- Colorlib calender -->
    <link rel="stylesheet" href="{{asset('calender16')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('calender16')}}/css/rome.css">

    <!-- Fullcalender -->
    <link href="{{asset('calender19')}}/fullcalendar/packages/core/main.css" rel='stylesheet' />
    <link href="{{asset('calender19')}}/fullcalendar/packages/daygrid/main.css" rel='stylesheet' />
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" /> -->

    <!-- Datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/brands.min.css" integrity="sha512-nS1/hdh2b0U8SeA8tlo7QblY6rY6C+MgkZIeRzJQQvMsFfMQFUKp+cgMN2Uuy+OtbQ4RoLMIlO2iF7bIEY3Oyg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" integrity="sha512-R+xPS2VPCAFvLRy+I4PgbwkWjw1z5B5gNDYgJN5LfzV4gGNeRQyVrY7Uk59rX+c8tzz63j8DeZPLqmXvBxj8pA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/regular.min.css" integrity="sha512-EbT6icebNlvxlD4ECiLvPOVBD0uQdt4pHRg8Gpkfirdu9W8l2rtRZO8rThjqeIK08ubcFeiFKHbek7y+lEbWIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/solid.min.css" integrity="sha512-EvFBzDO3WBynQTyPJI+wLCiV0DFXzOazn6aoy/bGjuIhGCZFh8ObhV/nVgDgL0HZYC34D89REh6DOfeJEWMwgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/svg-with-js.min.css" integrity="sha512-YhTJO2S6UzEZDGOYCBmb5KMqKnvix8bVnI2NKJmLXdp8UTPOnU2aBXQI2w3p6K0zjvYdpqZXNXVEwxo37PGAOQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/v4-font-face.min.css" integrity="sha512-lwrv151LKaLF51WT132OTpKxuqmeVe4rKKk5zYIDNLATaWmEkh1RuZOrlcPVVDVJ7pP0bUBnpgrSOsdKPk8/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/v4-shims.min.css" integrity="sha512-juNw36A2S+8vPLyCQCBmfxRf1+gFYy07BozcavXe9adyITkvA9LuVCbkZI9kp59tjUrn/S7zeDFN1Brz1JqJnA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/v5-font-face.min.css" integrity="sha512-q7oLGfg6SLsObFCqz+01EtC3xCKoXujNKLx+aWol8xl6YLF7X9/HXhmlxabjo8uicrLlGhiY3b46ejzQVsGOoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/brands.min.js" integrity="sha512-helwW+1jTcWdOarbAV4eDgcPQg/WEM20j9oo7HE5caJ8hZXdW0mgYGuxafhlf4j4gYAuOL8WsX1QTy6HUnpWKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/fontawesome.min.js" integrity="sha512-TXHaOs+47HgWwY4hUqqeD865VIBRoyQMjI27RmbQVeKb1pH1YTq0sbuHkiUzhVa5z0rRxG8UfzwDjIBYdPDM3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/regular.min.js" integrity="sha512-tniEMPtb6i8oNX19RVx075Km+lJ1dJSrHjvsqZ5VZUAqffgx91Z0ahb6r2nP13+l9zT5RzpxcC1VPdMQswVosw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/solid.min.js" integrity="sha512-LKdDHe5ZhpmiH6Kd6crBCESKkS6ryNpGRoBjGeh5mM/BW3NRN4WH8pyd7lHgQTTHQm5nhu0M+UQclYQalQzJnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/v4-shims.min.js" integrity="sha512-pd9YFLsGdZIRG1ChLLdpxgGT+xR7rVjsHqm6RP0toUadPB4XZZ7LlqzX3IhnpMd2Cb8b2s8yVFwY21epgr84qw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <!-- Masukkan script dan CSS SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
   

    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    <link href="{{asset('template/dist')}}/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
</head>

<body>


        @include('layout.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('layout.header')
        <div class="body flex-grow-1 px-3">
            @yield('content')
        </div>
        <footer class="footer mt-4">
            <div class="ms-auto">Hak Cipta © 2022 Kementerian Komunikasi dan Informatika RI</a></div>
        </footer>
    </div>



    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('template/dist/')}}/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="{{asset('template/dist/')}}/vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{asset('template/dist/')}}/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="{{asset('template/dist/')}}/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <!-- Datatable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <!-- Colorlib calender -->
    <script src="{{asset('calender16')}}/js/rome.js"></script>
    <script src="{{asset('calender16')}}/js/main.js"></script>
    <script src=""></script>
    <!-- Fullcalender -->
    <script src="{{asset('calender19')}}/fullcalendar/packages/core/main.js"></script>
    <script src="{{asset('calender19')}}/fullcalendar/packages/interaction/main.js"></script>
    <script src="{{asset('calender19')}}/fullcalendar/packages/daygrid/main.js"></script>
    <script src="{{ asset('template/dist/js/toasts.js') }}"></script>

    {{-- Date Picker --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/locales-all.min.js"></script> -->

    <!-- jQuery Validate -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.js"></script> --}}
    <script src="{{asset('jquery-validation-1.19.5')}}/dist/jquery.validate.js"></script>
    <script src="{{asset('jquery-validation-1.19.5')}}/dist/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js" integrity="sha512-nwnflbQixsRIWaXWyQmLkq4WazLLsPLb1k9tA0SEx3Njm+bjEBVbLTijfMnztBKBoTwPsyz4ToosyNn/4ahTBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // jQuery defined date picker class
            $(".datepicker").datepicker({
                format: "dd/mm/yyyy",
                autoclose:true //to close picker once year is selected
            });

            // Jquery Validate
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0}');

            $.validator.addMethod("alphabet", function(value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
            }, "Alphabet only please");

            $.validator.addMethod('width', function(value, element, width) {
                return $(element).data('imageWidth') == width;
            }, "Your image's width not match");

            $.validator.addMethod('height', function(value, element, height) {
                return $(element).data('imageHeight') == height;
            }, "Your image's height not match");

            $('#toggleMenu').click(function(){

                var hide = $('#sidebar').hasClass('hide');

                if(hide){
                    $(this).html('<i class="fa fa-angle-right"></i>');
                }
                else{
                    $(this).html('<i class="fa fa-angle-left"></i>');
                }

            });
        });
    </script>

    <!-- Firebase -->
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script>

        const firebaseConfig = {
            apiKey: "AIzaSyDK4QX0J55CAlgZJUjXyOOv1zeW9DX7Sns",
            authDomain: "manajemen-spbe.firebaseapp.com",
            projectId: "manajemen-spbe",
            storageBucket: "manajemen-spbe.appspot.com",
            messagingSenderId: "927871765892",
            appId: "1:927871765892:web:59cf19bb05fd1ac10061d1",
            measurementId: "G-KCQC957N29"
          };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
                messaging
                .requestPermission()
                .then(function () {
                    console.log('token:');
                    console.log(messaging.getToken({ vapidKey: 'BCTG0cKWPWwEFUJMnsmkrQ5PNf_j0e0ecRd6y2n0SiundvLQrD7ibPjaqdGZEKjRbE6zFwJLxbE0VxIw_iZctgs' }));
                    return messaging.getToken({ vapidKey: 'BCTG0cKWPWwEFUJMnsmkrQ5PNf_j0e0ecRd6y2n0SiundvLQrD7ibPjaqdGZEKjRbE6zFwJLxbE0VxIw_iZctgs' })
                })
                .then(function(token) {
                    console.log(token);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ url("fcmtoken") }}',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            console.log('Token saved successfully.');
                        },
                        error: function (err) {
                            console.log('User Token Error'+ err);
                        },
                    });

                }).catch(function (err) {
                    console.log('User Token Error'+ err);
                });
         }

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });

    </script>
    <!-- / Firebase / -->

    <!-- OffCanvas -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', '.pull-bs-canvas-right, .pull-bs-canvas-left', function(){
                $('body').prepend('<div class="bs-canvas-overlay bg-dark position-fixed w-100 h-100"></div>');
                if($(this).hasClass('pull-bs-canvas-right'))
                    $('.bs-canvas-right').addClass('me-0');
                else
                    $('.bs-canvas-left').addClass('ms-0');
                return false;
            });

            $(document).on('click', '.bs-canvas-close, .bs-canvas-overlay', function(){
                var elm = $(this).hasClass('bs-canvas-close') ? $(this).closest('.bs-canvas') : $('.bs-canvas');
                elm.removeClass('me-0 ms-0');
                $('.bs-canvas-overlay').remove();
                return false;
            });

            $('#notif-button').click(function(){
                $('.notif-badge').remove();
                console.log('remove badge notif');

                $.ajax({
                    url: '{{ url("notification/read_all") }}',
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Notification success read');
                    },
                    error: function (err) {
                        console.log('Notification error'+ err);
                    },
                });
            });
        });
    </script>
    <!-- / OffCanvas / -->

    @yield('scriptjs')
</body>

</html>
