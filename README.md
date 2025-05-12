# Panduan Praktik Terbaik Proyek Laravel

# Analisis README.md Laravel Best Practices

Dokumen README.md yang Anda miliki sudah cukup komprehensif dan mencakup berbagai jenis arsitektur Laravel, termasuk:

1. Monolitik (Blade + Alpine.js)
2. Inertia.js (Vue.js/React)
3. API-First
4. Microservices

Namun, ada beberapa area yang dapat ditingkatkan untuk memastikan panduan ini benar-benar dapat diterapkan untuk semua jenis proyek Laravel:

## Perbaikan yang Direkomendasikan

### 1. Melengkapi Bagian Backend
Bagian "Pengembangan Backend (Laravel)" tampaknya tidak lengkap. Perlu ditambahkan detail tentang:
- Struktur folder
- Penanganan database
- Middleware
- Service providers
- Autentikasi
- Otorisasi
- Testing

### 2. Menambahkan Contoh Kode
Dokumen akan lebih bermanfaat jika menyertakan contoh kode singkat untuk setiap poin praktik terbaik.

### 3. Menambahkan Panduan Spesifik untuk Laravel 10+
Perlu ditambahkan fitur-fitur baru di Laravel 10+ seperti:
- Laravel Pennant (feature flags)
- Laravel Reverb (WebSockets)
- Process Interaction API
- Invokable validation rules

### 4. Memperluas Bagian Deployment dan DevOps
Tambahkan informasi tentang:
- CI/CD pipeline
- Docker containerization
- Kubernetes orchestration
- Serverless deployment options

### 5. Menambahkan Panduan Integrasi dengan Ecosystem Laravel
Tambahkan panduan untuk integrasi dengan:
- Laravel Nova
- Laravel Horizon
- Laravel Telescope
- Laravel Sanctum
- Laravel Jetstream
- Laravel Breeze
- Laravel Livewire

### 6. Menambahkan Panduan Migrasi
Tambahkan panduan untuk migrasi dari:
- Laravel versi lama ke Laravel 10+
- Migrasi dari arsitektur monolitik ke Inertia.js
- Migrasi dari monolitik ke API-first

### 7. Menambahkan Panduan Performa
Tambahkan praktik terbaik untuk:
- Caching
- Database optimization
- Asset optimization
- Server-side rendering vs. client-side rendering

### 8. Menambahkan Panduan Keamanan
Perluas bagian keamanan dengan:
- OWASP Top 10 untuk Laravel
- Praktik terbaik untuk autentikasi
- Praktik terbaik untuk otorisasi
- Keamanan API

## Kesimpulan
Dokumen ini sudah menjadi dasar yang baik, tetapi perlu dilengkapi dengan detail lebih spesifik dan contoh implementasi untuk menjadi panduan komprehensif yang dapat diterapkan untuk semua jenis proyek Laravel. Saya sarankan untuk mengembangkan setiap bagian dengan contoh kode dan penjelasan lebih mendalam, serta memastikan bahwa semua fitur terbaru Laravel tercakup.

## 🔧 Pengembangan Backend (Laravel)

### 1. Arsitektur dan Struktur Kode
- **Struktur Folder yang Terorganisir:**
  - Pisahkan kode berdasarkan fungsionalitas: Controllers, Services, Repositories, Models, Requests, Migrations, dll.
  - Hindari menumpuk terlalu banyak logika dalam satu file atau folder
- **Pemisahan Logika Bisnis:**
  - Gunakan Service Layer untuk logika bisnis yang kompleks
  - Jaga controller tetap ramping, pindahkan logika bisnis ke services
  - Terapkan Repository Pattern untuk interaksi database (contoh: UserRepository, OrderRepository)
- **Implementasi Design Pattern:**
  - Gunakan Factory Pattern untuk pembuatan objek kompleks
  - Terapkan Observer Pattern untuk event handling
  - Implementasi Strategy Pattern untuk algoritma yang dapat dipertukarkan

### 2. Standar Penulisan Kode
- Ikuti Standar PSR (PHP Standards Recommendations)
- **Keterbacaan dan Kebersihan Kode:**
  - Gunakan camelCase untuk nama variabel dan PascalCase untuk nama class
  - Pertahankan indentasi yang konsisten (2 atau 4 spasi)
  - Tulis komentar dan dokumentasi untuk kode yang kompleks
  - Gunakan Dependency Injection untuk mengelola dependencies dan hindari penggunaan Facade berlebihan
- **Penamaan yang Jelas:**
  - Gunakan nama yang deskriptif untuk fungsi dan variabel
  - Hindari singkatan yang membingungkan
  - Konsisten dalam penggunaan bahasa (Inggris/Indonesia)

### 3. Validasi dan Keamanan
- Implementasikan Validasi Request sebelum memproses input
- Buat Form Requests untuk validasi input pengguna
- Sanitasi Data Pengguna untuk mencegah SQL Injection
- Gunakan Laravel Policies dan Gates untuk kontrol akses berbasis peran
- Implementasikan hash password yang tepat (menggunakan bcrypt() atau argon2)
- Gunakan Laravel Sanctum atau Passport untuk autentikasi API
- **Keamanan Tambahan:**
  - Implementasi CORS dengan benar
  - Gunakan SSL/TLS untuk komunikasi yang aman
  - Terapkan pembatasan upload file
  - Implementasi proteksi terhadap XSS dan CSRF

### 4. Penanganan Error dan Logging
- Manfaatkan exception handler bawaan Laravel
- Implementasikan logging terstruktur dengan Laravel Log
- Buat halaman error kustom (404, 500, dll.) untuk pengalaman pengguna yang lebih baik
- **Monitoring dan Alert:**
  - Implementasi sistem monitoring
  - Atur notifikasi untuk error kritis
  - Gunakan tools monitoring seperti Sentry atau NewRelic

### 5. Pengembangan API
- Gunakan Laravel Resources untuk struktur output API yang konsisten
- Implementasikan versioning API untuk pengembangan masa depan
- Pastikan penanganan request/response JSON
- Implementasikan Rate Limiting untuk proteksi API
- **Dokumentasi API:**
  - Gunakan tools seperti Swagger/OpenAPI
  - Buat dokumentasi yang lengkap dan terstruktur
  - Sertakan contoh penggunaan API

### 6. Testing
- Tulis Unit Tests dan Feature Tests menggunakan PHPUnit dan tools testing Laravel
- Gunakan Mocking dan Factories untuk memfasilitasi testing
- Pastikan coverage test yang memadai untuk controllers, services, dan models
- **Jenis Testing Tambahan:**
  - Integration Testing
  - End-to-end Testing
  - Performance Testing
  - Security Testing

## 🌐 Pengembangan Frontend

### 1. Layout dan Komponen
- Gunakan Laravel Blade untuk template yang bersih dan terstruktur
- Implementasikan @yield dan @section untuk area layout dinamis
- Buat partial views untuk komponen yang dapat digunakan kembali
- Gunakan Tailwind CSS atau Bootstrap untuk styling
- **Optimasi Layout:**
  - Implementasi lazy loading untuk gambar
  - Gunakan CSS Grid dan Flexbox untuk layout responsif
  - Optimalkan assets untuk performa

### 2. Komponen UI
- Desain responsif menggunakan utility classes
- Buat komponen modular yang dapat digunakan kembali
- Integrasikan Alpine.js untuk interaktivitas ringan
- Implementasikan komponen interaktif (toggles, modals, dropdowns)
- **Aksesibilitas:**
  - Implementasi standar WCAG
  - Gunakan ARIA labels dengan benar
  - Pastikan navigasi keyboard berfungsi

### 3. JavaScript & Framework Frontend
- Pertimbangkan Inertia.js untuk integrasi Vue.js, React, atau Svelte
- Implementasikan State Management ketika diperlukan
- Gunakan axios untuk request HTTP dengan proteksi CSRF
- Gunakan Single File Components untuk framework berbasis komponen
- **Optimasi JavaScript:**
  - Code splitting
  - Tree shaking
  - Minifikasi kode
  - Caching yang efektif

### 4. Penanganan Form
- Implementasikan Laravel Form Request Validation
- Tangani validasi sisi klien
- Gunakan Laravel Collective atau HTML standar untuk form dinamis
- **Fitur Form Lanjutan:**
  - Upload file dengan preview
  - Auto-save
  - Multi-step forms
  - Real-time validation

### 5. Alpine.js & Interaksi Dinamis
- Manfaatkan direktif Alpine.js untuk interaktivitas
- Minimalkan penggunaan jQuery kecuali jika diperlukan
- **Interaksi Lanjutan:**
  - Infinite scroll
  - Live search
  - Real-time updates
  - Drag and drop

### 6. Optimasi
- Gunakan Laravel Mix/vite untuk bundling asset
- Implementasikan Lazy Loading
- Optimasi rendering komponen
- **Performa Frontend:**
  - Optimasi gambar
  - Minifikasi CSS/JS
  - Implementasi PWA
  - Caching browser

## 🚀 Integrasi API

### 1. Desain API
- Ikuti prinsip RESTful atau GraphQL
- Implementasikan autentikasi yang tepat
- Atur Rate Limiting
- **Standar API:**
  - Versioning yang proper
  - Dokumentasi yang lengkap
  - Error handling yang konsisten

### 2. Konsumsi API Frontend
- Gunakan axios atau fetch untuk panggilan API
- Implementasikan penanganan error yang tepat
- **Fitur Lanjutan:**
  - Caching response
  - Retry mechanism
  - Cancel requests
  - Progress indicators

### 3. Penanganan Response
- Gunakan kode status HTTP yang sesuai
- Kembalikan response JSON yang konsisten
- **Format Response:**
  - Standarisasi format error
  - Pagination yang konsisten
  - Meta data yang informatif

## ⚙️ Alur Kerja Pengembangan

### 1. Version Control (Git)
- Buat branch fitur
- Tulis pesan commit yang jelas
- Ikuti praktik terbaik alur kerja Git
- **Strategi Branch:**
  - GitFlow atau Trunk Based Development
  - Protected branches
  - Code review process
  - Automated merge checks

### 2. CI/CD
- Implementasikan automated testing
- Gunakan tools CI/CD (GitHub Actions, GitLab CI, Jenkins)
- **Pipeline Automation:**
  - Build automation
  - Test automation
  - Deployment automation
  - Environment management

### 3. Docker
- Gunakan Docker untuk lingkungan pengembangan yang konsisten
- Pertahankan konfigurasi container yang tepat
- **Best Practices Docker:**
  - Multi-stage builds
  - Optimasi image size
  - Security scanning
  - Container orchestration

### 4. Monitoring dan Maintenance
- **Sistem Monitoring:**
  - Server monitoring
  - Application performance monitoring
  - Error tracking
  - User analytics
- **Maintenance Rutin:**
  - Database optimization
  - Security updates
  - Backup strategy
  - Performance tuning

### 5. Dokumentasi
- **Dokumentasi Kode:**
  - PHPDoc standards
  - Inline comments
  - README files
  - API documentation
- **Dokumentasi Proyek:**
  - Setup guide
  - Deployment process
  - Troubleshooting guide
  - Change log

Mengikuti panduan komprehensif ini akan menghasilkan proyek yang terstruktur dengan baik, dapat diskalakan, dan mudah dipelihara yang dapat dengan mudah disesuaikan dengan kebutuhan masa depan.


# Panduan Praktik Terbaik Proyek Laravel

Dokumen ini menguraikan aturan-aturan komprehensif yang harus diterapkan dalam proyek Laravel dengan berbagai jenis arsitektur dan stack teknologi.

## 🔧 Pengembangan Backend (Laravel)

### 1. Arsitektur dan Struktur Kode
- **Struktur Folder yang Terorganisir:**
  - Pisahkan kode berdasarkan fungsionalitas: Controllers, Services, Repositories, Models, Requests, Migrations, dll.
  - Hindari menumpuk terlalu banyak logika dalam satu file atau folder
  - Untuk proyek besar, pertimbangkan struktur domain-driven (DDD) atau modular

  ```php:app/Domains/User/Controllers/UserController.php
  namespace App\Domains\User\Controllers;
  
  use App\Domains\User\Services\UserService;
  
  class UserController extends Controller
  {
      protected $userService;
      
      public function __construct(UserService $userService)
      {
          $this->userService = $userService;
      }
      
      // Controller methods...
  }
  ```

- **Pemisahan Logika Bisnis:**
  - Gunakan Service Layer untuk logika bisnis yang kompleks
  - Jaga controller tetap ramping, pindahkan logika bisnis ke services
  - Terapkan Repository Pattern untuk interaksi database (contoh: UserRepository, OrderRepository)

  ```php:app/Services/OrderService.php
  namespace App\Services;
  
  use App\Repositories\OrderRepository;
  
  class OrderService
  {
      protected $orderRepository;
      
      public function __construct(OrderRepository $orderRepository)
      {
          $this->orderRepository = $orderRepository;
      }
      
      public function processOrder(array $data)
      {
          // Logika bisnis kompleks di sini
          // ...
          
          return $this->orderRepository->create($data);
      }
  }
  ```

- **Implementasi Design Pattern:**
  - Gunakan Factory Pattern untuk pembuatan objek kompleks
  - Terapkan Observer Pattern untuk event handling
  - Implementasi Strategy Pattern untuk algoritma yang dapat dipertukarkan
  - Pertimbangkan Command Pattern untuk operasi yang dapat dibatalkan atau dijadwalkan

### 2. Standar Penulisan Kode
- Ikuti Standar PSR (PHP Standards Recommendations)
- **Keterbacaan dan Kebersihan Kode:**
  - Gunakan camelCase untuk nama variabel dan PascalCase untuk nama class
  - Pertahankan indentasi yang konsisten (2 atau 4 spasi)
  - Tulis komentar dan dokumentasi untuk kode yang kompleks
  - Gunakan Dependency Injection untuk mengelola dependencies dan hindari penggunaan Facade berlebihan
  - Gunakan Laravel Pint untuk formatting kode otomatis

  ```bash
  php artisan pint
  ```

- **Penamaan yang Jelas:**
  - Gunakan nama yang deskriptif untuk fungsi dan variabel
  - Hindari singkatan yang membingungkan
  - Konsisten dalam penggunaan bahasa (Inggris/Indonesia)

### 3. Validasi dan Keamanan
- Implementasikan Validasi Request sebelum memproses input
- Buat Form Requests untuk validasi input pengguna

  ```php:app/Http/Requests/StoreUserRequest.php
  namespace App\Http\Requests;
  
  use Illuminate\Foundation\Http\FormRequest;
  
  class StoreUserRequest extends FormRequest
  {
      public function rules()
      {
          return [
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email',
              'password' => 'required|min:8|confirmed',
          ];
      }
  }
  ```

- Sanitasi Data Pengguna untuk mencegah SQL Injection
- Gunakan Laravel Policies dan Gates untuk kontrol akses berbasis peran

  ```php:app/Policies/PostPolicy.php
  namespace App\Policies;
  
  use App\Models\Post;
  use App\Models\User;
  
  class PostPolicy
  {
      public function update(User $user, Post $post)
      {
          return $user->id === $post->user_id || $user->hasRole('admin');
      }
  }
  ```

- Implementasikan hash password yang tepat (menggunakan bcrypt() atau argon2)
- Gunakan Laravel Sanctum atau Passport untuk autentikasi API
- **Keamanan Tambahan:**
  - Implementasi CORS dengan benar
  - Gunakan SSL/TLS untuk komunikasi yang aman
  - Terapkan pembatasan upload file
  - Implementasi proteksi terhadap XSS dan CSRF
  - Gunakan Laravel Security Checker untuk memindai kerentanan

### 4. Penanganan Error dan Logging
- Manfaatkan exception handler bawaan Laravel
- Implementasikan logging terstruktur dengan Laravel Log
- Buat halaman error kustom (404, 500, dll.) untuk pengalaman pengguna yang lebih baik

  ```php:app/Exceptions/Handler.php
  namespace App\Exceptions;
  
  use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
  use Throwable;
  
  class Handler extends ExceptionHandler
  {
      public function register()
      {
          $this->reportable(function (Throwable $e) {
              if (app()->bound('sentry')) {
                  app('sentry')->captureException($e);
              }
          });
      }
  }
  ```

- **Monitoring dan Alert:**
  - Implementasi sistem monitoring
  - Atur notifikasi untuk error kritis
  - Gunakan tools monitoring seperti Sentry, NewRelic, atau Laravel Telescope

### 5. Pengembangan API
- Gunakan Laravel Resources untuk struktur output API yang konsisten

  ```php:app/Http/Resources/UserResource.php
  namespace App\Http\Resources;
  
  use Illuminate\Http\Resources\Json\JsonResource;
  
  class UserResource extends JsonResource
  {
      public function toArray($request)
      {
          return [
              'id' => $this->id,
              'name' => $this->name,
              'email' => $this->email,
              'created_at' => $this->created_at->toISOString(),
          ];
      }
  }
  ```

- Implementasikan versioning API untuk pengembangan masa depan
- Pastikan penanganan request/response JSON
- Implementasikan Rate Limiting untuk proteksi API
- **Dokumentasi API:**
  - Gunakan tools seperti Swagger/OpenAPI atau Scribe
  - Buat dokumentasi yang lengkap dan terstruktur
  - Sertakan contoh penggunaan API

### 6. Testing
- Tulis Unit Tests dan Feature Tests menggunakan PHPUnit dan tools testing Laravel
- Gunakan Mocking dan Factories untuk memfasilitasi testing

  ```php:tests/Feature/UserTest.php
  namespace Tests\Feature;
  
  use App\Models\User;
  use Tests\TestCase;
  
  class UserTest extends TestCase
  {
      public function test_user_can_be_created()
      {
          $response = $this->postJson('/api/users', [
              'name' => 'Test User',
              'email' => 'test@example.com',
              'password' => 'password',
              'password_confirmation' => 'password',
          ]);
          
          $response->assertStatus(201)
                   ->assertJsonPath('data.name', 'Test User');
      }
  }
  ```

- Pastikan coverage test yang memadai untuk controllers, services, dan models
- **Jenis Testing Tambahan:**
  - Integration Testing
  - End-to-end Testing dengan Laravel Dusk
  - Performance Testing
  - Security Testing
  - Gunakan GitHub Actions atau GitLab CI untuk automated testing

### 7. Database dan Eloquent
- Gunakan migrasi untuk semua perubahan skema database
- Implementasikan seeder dan factory untuk data testing
- Optimalkan query dengan eager loading untuk menghindari N+1 problem

  ```php:app/Http/Controllers/PostController.php
  public function index()
  {
      // Hindari N+1 problem dengan eager loading
      return Post::with(['user', 'comments', 'categories'])->paginate(15);
  }
  ```

- Gunakan indeks database untuk meningkatkan performa query
- Implementasikan soft deletes untuk data yang sensitif
- Gunakan Query Builder atau Raw SQL untuk query kompleks yang sulit diekspresikan dengan Eloquent

### 8. Caching dan Performa
- Implementasikan caching untuk data yang sering diakses
- Gunakan Laravel Queue untuk tugas yang memakan waktu

  ```php:app/Jobs/ProcessPodcast.php
  namespace App\Jobs;
  
  use Illuminate\Bus\Queueable;
  use Illuminate\Contracts\Queue\ShouldQueue;
  use Illuminate\Foundation\Bus\Dispatchable;
  use Illuminate\Queue\InteractsWithQueue;
  use Illuminate\Queue\SerializesModels;
  
  class ProcessPodcast implements ShouldQueue
  {
      use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
      
      public function handle()
      {
          // Proses yang memakan waktu
      }
  }
  ```

- Optimalkan asset dengan Laravel Mix/Vite
- Gunakan Lazy Collections untuk memproses dataset besar
- Implementasikan Redis untuk caching dan queue

## 🌐 Pengembangan Frontend

### 1. Layout dan Komponen

#### Monolitik (Blade + Alpine.js)
- Gunakan Laravel Blade untuk template yang bersih dan terstruktur
- Implementasikan @yield dan @section untuk area layout dinamis

  ```php:resources/views/layouts/app.blade.php
  <!DOCTYPE html>
  <html>
  <head>
      <title>@yield('title', 'Default Title')</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
      <header>@include('partials.header')</header>
      <main>@yield('content')</main>
      <footer>@include('partials.footer')</footer>
  </body>
  </html>
  ```

- Buat partial views untuk komponen yang dapat digunakan kembali
- Gunakan Tailwind CSS atau Bootstrap untuk styling
- Implementasikan Blade Components untuk UI yang konsisten

  ```php:resources/views/components/button.blade.php
  <button {{ $attributes->merge(['class' => 'px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600']) }}>
      {{ $slot }}
  </button>
  ```

#### Inertia.js (Vue.js/React)
- Struktur komponen mengikuti best practices Vue.js/React
- Implementasi layout persistent

  ```javascript:resources/js/Layouts/AppLayout.vue
  <template>
    <div>
      <header>
        <!-- Header content -->
      </header>
      <main>
        <slot />
      </main>
      <footer>
        <!-- Footer content -->
      </footer>
    </div>
  </template>
  ```

- Shared components library
- State management dengan Pinia (Vue) atau Redux/Context (React)

  ```javascript:resources/js/stores/user.js
  // Pinia store example
  import { defineStore } from 'pinia'
  
  export const useUserStore = defineStore('user', {
    state: () => ({
      user: null,
    }),
    actions: {
      setUser(user) {
        this.user = user
      },
      logout() {
        this.user = null
      }
    }
  })
  ```

#### SPA dengan API Backend
- Arsitektur terpisah untuk frontend dan backend
- Implementasi token-based authentication
- Cross-origin resource sharing (CORS) setup

  ```php:config/cors.php
  return [
      'paths' => ['api/*'],
      'allowed_methods' => ['*'],
      'allowed_origins' => ['http://localhost:3000', 'https://yourfrontend.com'],
      'allowed_origins_patterns' => [],
      'allowed_headers' => ['*'],
      'exposed_headers' => [],
      'max_age' => 0,
      'supports_credentials' => true,
  ];
  ```

- State management yang robust

### 2. Komponen UI

#### Blade + Alpine.js
- Desain responsif menggunakan utility classes
- Buat komponen modular yang dapat digunakan kembali
- Integrasikan Alpine.js untuk interaktivitas ringan

  ```html:resources/views/components/dropdown.blade.php
  <div x-data="{ open: false }" class="relative">
      <button @click="open = !open" class="flex items-center">
          {{ $trigger }}
      </button>
      
      <div x-show="open" @click.away="open = false" class="absolute mt-2 w-48 bg-white shadow-lg rounded-md">
          {{ $content }}
      </div>
  </div>
  ```

- Implementasikan komponen interaktif (toggles, modals, dropdowns)
- **Aksesibilitas:**
  - Implementasi standar WCAG
  - Gunakan ARIA labels dengan benar
  - Pastikan navigasi keyboard berfungsi

#### Vue.js/React Components
- Atomic Design principles
- Reusable component patterns
- Component composition
- Props and events handling
- Custom hooks/composables

  ```javascript:resources/js/Composables/useForm.js
  // Vue composable example
  import { ref } from 'vue'
  import { router } from '@inertiajs/vue3'
  
  export function useForm(initialData) {
    const form = ref({ ...initialData })
    const errors = ref({})
    
    function submit(method, url, options = {}) {
      router[method](url, form.value, {
        onError: (e) => errors.value = e,
        ...options
      })
    }
    
    return { form, errors, submit }
  }
  ```

#### Framework-Agnostic
- Design system consistency
- Shared styling methodology
- Component documentation
- Cross-browser compatibility

### 3. JavaScript & Framework Frontend

#### Monolitik
- Alpine.js untuk interaktivitas ringan

  ```html:resources/views/components/counter.blade.php
  <div x-data="{ count: 0 }">
      <button @click="count--">-</button>
      <span x-text="count"></span>
      <button @click="count++">+</button>
  </div>
  ```

- Vanilla JavaScript modules
- Laravel Vite bundling

  ```javascript:vite.config.js
  import { defineConfig } from 'vite';
  import laravel from 'laravel-vite-plugin';
  
  export default defineConfig({
      plugins: [
          laravel({
              input: ['resources/css/app.css', 'resources/js/app.js'],
              refresh: true,
          }),
      ],
  });
  ```

#### Inertia.js
- Vue.js atau React setup
- Inertia adapter configuration
- Shared utilities
- Progress indicators
- Form handling

### 3. JavaScript & Framework Frontend (lanjutan)

#### API-Driven SPA
- Framework-specific routing

  ```javascript:src/router/index.js
  // Vue Router example
  import { createRouter, createWebHistory } from 'vue-router'
  import Home from '../views/Home.vue'
  import Dashboard from '../views/Dashboard.vue'
  
  const routes = [
    { path: '/', component: Home },
    { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } }
  ]
  
  const router = createRouter({
    history: createWebHistory(),
    routes
  })
  
  // Navigation guards
  router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.getters.isAuthenticated) {
      next('/login')
    } else {
      next()
    }
  })
  
  export default router
  ```

- API client setup

  ```javascript:src/services/api.js
  import axios from 'axios'

  const api = axios.create({
    baseURL: process.env.VUE_APP_API_URL || 'http://localhost:8000/api',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    withCredentials: true
  })
  
  // Request interceptor for adding auth token
  api.interceptors.request.use(config => {
    const token = localStorage.getItem('token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  })
  
  // Response interceptor for handling errors
  api.interceptors.response.use(
    response => response,
    error => {
      if (error.response && error.response.status === 401) {
        // Handle unauthorized access
        store.dispatch('logout')
        router.push('/login')
      }
      return Promise.reject(error)
    }
  )
  
  export default api
  ```

- Authentication flow
- Error boundaries
- State persistence

### 4. Penanganan Form

#### Blade Forms
- Implementasikan Laravel Form Request Validation
- Tangani validasi sisi klien dengan Alpine.js

  ```html:resources/views/forms/contact.blade.php
  <form action="/contact" method="POST" x-data="{ 
    name: '', 
    email: '', 
    message: '',
    errors: {},
    validateEmail() {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!re.test(this.email)) {
        this.errors.email = 'Email tidak valid'
      } else {
        delete this.errors.email
      }
    }
  }">
    @csrf
    
    <div class="mb-4">
      <label for="name">Nama</label>
      <input type="text" id="name" name="name" x-model="name" required>
      <span x-show="errors.name" x-text="errors.name" class="text-red-500"></span>
      @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    
    <div class="mb-4">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" x-model="email" @blur="validateEmail()" required>
      <span x-show="errors.email" x-text="errors.email" class="text-red-500"></span>
      @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Kirim</button>
  </form>
  ```

- Gunakan Laravel Collective atau HTML standar untuk form dinamis
- **Fitur Form Lanjutan:**
  - Upload file dengan preview
  - Auto-save
  - Multi-step forms
  - Real-time validation

#### Inertia Forms
- Form helper libraries

  ```javascript:resources/js/Pages/Contact.vue
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const form = useForm({
    name: '',
    email: '',
    message: ''
  })
  
  function submit() {
    form.post('/contact', {
      preserveScroll: true,
      onSuccess: () => form.reset()
    })
  }
  </script>
  
  <template>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="name">Nama</label>
        <input type="text" id="name" v-model="form.name">
        <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
      </div>
      
      <div class="mb-4">
        <label for="email">Email</label>
        <input type="email" id="email" v-model="form.email">
        <div v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</div>
      </div>
      
      <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-500 text-white rounded">
        Kirim
      </button>
    </form>
  </template>
  ```

- Validation integration
- File upload handling
- Progress indicators
- Server-side validation

#### API Forms
- Form state management
- Custom form hooks/composables
- Validation strategies
- File upload with presigned URLs
- Error handling

### 5. Alpine.js & Interaksi Dinamis
- Manfaatkan direktif Alpine.js untuk interaktivitas

  ```html:resources/views/components/modal.blade.php
  <div x-data="{ open: false }">
    <button @click="open = true" class="px-4 py-2 bg-blue-500 text-white rounded">
      Buka Modal
    </button>
    
    <div x-show="open" @click.away="open = false" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow-lg max-w-md mx-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-bold">{{ $title }}</h3>
          <button @click="open = false" class="text-gray-500">&times;</button>
        </div>
        <div>
          {{ $slot }}
        </div>
        <div class="mt-4 flex justify-end">
          <button @click="open = false" class="px-4 py-2 bg-gray-200 rounded mr-2">
            Batal
          </button>
          {{ $footer ?? '' }}
        </div>
      </div>
    </div>
  </div>
  ```

- Minimalkan penggunaan jQuery kecuali jika diperlukan
- **Interaksi Lanjutan:**
  - Infinite scroll
  - Live search
  - Real-time updates
  - Drag and drop

### 6. Optimasi
- Gunakan Laravel Vite untuk bundling asset

  ```bash
  npm install
  npm run dev
  ```

- Implementasikan Lazy Loading

  ```javascript:resources/js/router.js
  // Vue Router lazy loading example
  const routes = [
    {
      path: '/dashboard',
      component: () => import('./pages/Dashboard.vue') // Lazy loaded
    }
  ]
  ```

- Optimasi rendering komponen
- **Performa Frontend:**
  - Optimasi gambar
  - Minifikasi CSS/JS
  - Implementasi PWA
  - Caching browser

## 🔄 Arsitektur Spesifik

### 1. Monolitik (Blade + Alpine.js)
- Server-side rendering
- Progressive enhancement
- Blade components

  ```php:app/View/Components/Alert.php
  namespace App\View\Components;
  
  use Illuminate\View\Component;
  
  class Alert extends Component
  {
      public $type;
      public $message;
      
      public function __construct($type = 'info', $message = null)
      {
          $this->type = $type;
          $this->message = $message;
      }
      
      public function render()
      {
          return view('components.alert');
      }
  }
  ```

- Asset compilation
- Session handling

### 2. Inertia.js (Vue.js/React)
- Server-side initial load
- Client-side navigation
- Shared data handling

  ```php:app/Http/Middleware/HandleInertiaRequests.php
  namespace App\Http\Middleware;
  
  use Illuminate\Http\Request;
  use Inertia\Middleware;
  
  class HandleInertiaRequests extends Middleware
  {
      public function share(Request $request)
      {
          return array_merge(parent::share($request), [
              'auth' => [
                  'user' => $request->user() ? [
                      'id' => $request->user()->id,
                      'name' => $request->user()->name,
                      'email' => $request->user()->email,
                  ] : null,
              ],
              'flash' => [
                  'message' => fn () => $request->session()->get('message'),
                  'error' => fn () => $request->session()->get('error'),
              ],
          ]);
      }
  }
  ```

- Modal handling
- File downloads
- Error pages

### 3. API-First
- API versioning

  ```php:routes/api.php
  Route::prefix('v1')->group(function () {
      Route::apiResource('users', UserController::class);
      Route::apiResource('posts', PostController::class);
  });
  
  Route::prefix('v2')->group(function () {
      Route::apiResource('users', V2\UserController::class);
      Route::apiResource('posts', V2\PostController::class);
  });
  ```

- Authentication strategies
- Rate limiting

  ```php:app/Http/Kernel.php
  protected $middlewareGroups = [
      'api' => [
          \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
          'throttle:api',
          \Illuminate\Routing\Middleware\SubstituteBindings::class,
      ],
  ];
  ```

- API documentation
- CORS configuration
- Response formatting

  ```php:app/Http/Controllers/Api/UserController.php
  public function index()
  {
      $users = User::paginate(15);
      
      return UserResource::collection($users)
          ->additional([
              'meta' => [
                  'version' => '1.0',
                  'api_status' => 'stable'
              ]
          ]);
  }
  ```

### 4. Microservices
- Service discovery
- API gateway
- Message queues

  ```php:app/Jobs/ProcessOrder.php
  namespace App\Jobs;
  
  use Illuminate\Bus\Queueable;
  use Illuminate\Contracts\Queue\ShouldQueue;
  use Illuminate\Foundation\Bus\Dispatchable;
  use Illuminate\Queue\InteractsWithQueue;
  use Illuminate\Queue\SerializesModels;
  
  class ProcessOrder implements ShouldQueue
  {
      use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
      
      protected $orderId;
      
      public function __construct($orderId)
      {
          $this->orderId = $orderId;
      }
      
      public function handle()
      {
          // Proses order
          // Kirim notifikasi ke service lain
      }
  }
  ```

- Service communication
- Distributed logging
- Circuit breakers

## 📦 Package Management

### 1. Composer (Backend)
- Dependencies management

  ```bash
  composer require laravel/sanctum
  composer require spatie/laravel-permission
  ```

- Version constraints

  ```json:composer.json
  "require": {
      "php": "^8.1",
      "laravel/framework": "^10.0",
      "spatie/laravel-permission": "^5.5"
  }
  ```

- Private packages
- Security updates

  ```bash
  composer audit
  composer update --with-all-dependencies
  ```

### 2. NPM/Yarn (Frontend)
- Package selection
- Version management
- Build tools
- Development dependencies

  ```json:package.json
  {
    "scripts": {
      "dev": "vite",
      "build": "vite build"
    },
    "devDependencies": {
      "@vitejs/plugin-vue": "^4.0.0",
      "autoprefixer": "^10.4.13",
      "laravel-vite-plugin": "^0.7.2",
      "postcss": "^8.4.21",
      "tailwindcss": "^3.2.7",
      "vite": "^4.0.0",
      "vue": "^3.2.47"
    },
    "dependencies": {
      "@inertiajs/vue3": "^1.0.0",
      "axios": "^1.3.4",
      "pinia": "^2.0.33"
    }
  }
  ```

## 🚀 Deployment dan DevOps

### 1. Continuous Integration/Continuous Deployment
- Automated testing
- Build pipelines
- Deployment strategies

  ```yaml:.github/workflows/laravel.yml
  name: Laravel CI/CD
  
  on:
    push:
      branches: [ main, develop ]
    pull_request:
      branches: [ main, develop ]
  
  jobs:
    laravel-tests:
      runs-on: ubuntu-latest
      
      steps:
      - uses: actions/checkout@v3
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
          extensions: mbstring, dom, fileinfo, mysql
          coverage: xdebug
      
      - name: Copy .env
        run: cp .env.example .env
      
      - name: Install Composer dependencies
        run: composer install --prefer-dist --no-interaction
      
      - name: Generate key
        run: php artisan key:generate
      
      - name: Directory permissions
        run: chmod -R 777 storage bootstrap/cache
      
      - name: Create database
        run: |
          mkdir -p database
          touch database/database.sqlite
      
      - name: Execute tests
        env:
          DB_CONNECTION: sqlite
          DB_DATABASE: database/database.sqlite
        run: php artisan test --coverage
  
    deploy:
      needs: laravel-tests
      if: github.ref == 'refs/heads/main'
      runs-on: ubuntu-latest
      
      steps:
      - name: Deploy to production
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          key: ${{ secrets.SSH_KEY }}
          script: |
            cd /var/www/production
            git pull origin main
            composer install --no-interaction --no-dev --prefer-dist
            php artisan migrate --force
            php artisan optimize
            php artisan config:cache
            php artisan route:cache
            php artisan view:cache
  ```

### 2. Containerization
- Docker setup untuk lingkungan pengembangan dan produksi

  ```dockerfile:Dockerfile
  FROM php:8.1-fpm
  
  # Arguments defined in docker-compose.yml
  ARG user
  ARG uid
  
  # Install system dependencies
  RUN apt-get update && apt-get install -y \
      git \
      curl \
      libpng-dev \
      libonig-dev \
      libxml2-dev \
      zip \
      unzip
  
  # Clear cache
  RUN apt-get clean && rm -rf /var/lib/apt/lists/*
  
  # Install PHP extensions
  RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
  
  # Get latest Composer
  COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
  
  # Create system user to run Composer and Artisan Commands
  RUN useradd -G www-data,root -u $uid -d /home/$user $user
  RUN mkdir -p /home/$user/.composer && \
      chown -R $user:$user /home/$user
  
  # Set working directory
  WORKDIR /var/www
  
  USER $user
  ```

- Docker Compose untuk orkestrasi multi-container

  ```yaml:docker-compose.yml
  version: '3'
  services:
    app:
      build:
        args:
          user: laravel
          uid: 1000
        context: ./
        dockerfile: Dockerfile
      image: laravel-app
      container_name: laravel-app
      restart: unless-stopped
      working_dir: /var/www/
      volumes:
        - ./:/var/www
      networks:
        - laravel
  
    db:
      image: mysql:8.0
      container_name: laravel-db
      restart: unless-stopped
      environment:
        MYSQL_DATABASE: ${DB_DATABASE}
        MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
        MYSQL_PASSWORD: ${DB_PASSWORD}
        MYSQL_USER: ${DB_USERNAME}
        SERVICE_TAGS: dev
        SERVICE_NAME: mysql
      volumes:
        - ./docker-compose/mysql:/docker-entrypoint-initdb.d
        - mysql-data:/var/lib/mysql
      networks:
        - laravel
  
    nginx:
      image: nginx:alpine
      container_name: laravel-nginx
      restart: unless-stopped
      ports:
        - 8000:80
      volumes:
        - ./:/var/www
        - ./docker-compose/nginx:/etc/nginx/conf.d/
      networks:
        - laravel
  
    redis:
      image: redis:alpine
      container_name: laravel-redis
      restart: unless-stopped
      networks:
        - laravel
  
  networks:
    laravel:
      driver: bridge
  
  volumes:
    mysql-data:
      driver: local
  ```

- Multi-stage builds untuk optimasi image
- Container orchestration dengan Kubernetes

  ```yaml:kubernetes/deployment.yaml
  apiVersion: apps/v1
  kind: Deployment
  metadata:
    name: laravel-app
    labels:
      app: laravel
  spec:
    replicas: 3
    selector:
      matchLabels:
        app: laravel
    template:
      metadata:
        labels:
          app: laravel
      spec:
        containers:
        - name: laravel-app
          image: your-registry/laravel-app:latest
          ports:
          - containerPort: 80
          env:
          - name: APP_ENV
            value: production
          - name: DB_HOST
            value: mysql-service
          - name: REDIS_HOST
            value: redis-service
          resources:
            limits:
              cpu: "1"
              memory: "512Mi"
            requests:
              cpu: "0.5"
              memory: "256Mi"
  ```

### 3. Monitoring dan Logging
- Implementasi logging terpusat

  ```php:config/logging.php
  'channels' => [
      'stack' => [
          'driver' => 'stack',
          'channels' => ['single', 'slack', 'papertrail'],
          'ignore_exceptions' => false,
      ],
      
      'papertrail' => [
          'driver' => 'monolog',
          'level' => env('LOG_LEVEL', 'debug'),
          'handler' => SyslogUdpHandler::class,
          'handler_with' => [
              'host' => env('PAPERTRAIL_URL'),
              'port' => env('PAPERTRAIL_PORT'),
              'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
          ],
      ],
  ]
  ```

- Application Performance Monitoring (APM)
- Error tracking dengan Sentry atau Bugsnag

  ```php:app/Exceptions/Handler.php
  public function register()
  {
      $this->reportable(function (Throwable $e) {
          if ($this->shouldReport($e) && app()->bound('sentry')) {
              app('sentry')->captureException($e);
          }
      });
  }
  ```

- Health checks dan alerting

  ```php:routes/api.php
  Route::get('/health', function () {
      $services = [
          'database' => DB::connection()->getPdo() ? true : false,
          'redis' => Redis::connection()->ping() ? true : false,
          'storage' => Storage::disk('local')->exists('.gitignore') ? true : false,
      ];
      
      $allHealthy = !in_array(false, $services);
      
      return response()->json([
          'status' => $allHealthy ? 'healthy' : 'unhealthy',
          'services' => $services,
          'environment' => app()->environment(),
          'version' => config('app.version'),
      ], $allHealthy ? 200 : 503);
  });
  ```

### 4. Scaling dan High Availability
- Load balancing
- Database replication
- Caching strategies
- Queue workers

  ```bash
  # Start queue workers
  php artisan queue:work --tries=3 --backoff=3 --queue=high,default,low
  
  # Supervisor configuration
  [program:laravel-worker]
  process_name=%(program_name)s_%(process_num)02d
  command=php /var/www/artisan queue:work --sleep=3 --tries=3 --max-time=3600
  autostart=true
  autorestart=true
  stopasgroup=true
  killasgroup=true
  user=www-data
  numprocs=8
  redirect_stderr=true
  stdout_logfile=/var/log/supervisor/worker.log
  stopwaitsecs=3600
  ```

- Horizontal scaling

## 📊 Analitik dan Monitoring

### 1. Aplikasi Monitoring
- Laravel Telescope untuk debugging lokal

  ```bash
  composer require laravel/telescope --dev
  php artisan telescope:install
  php artisan migrate
  ```

- Logging terstruktur
- Performance metrics
- Error tracking

### 2. User Analytics
- Event tracking
- Conversion funnels
- User journey analysis
- A/B testing

  ```php:app/Http/Controllers/ExperimentController.php
  public function showHomepage()
  {
      // Simple A/B test example
      $variant = rand(0, 1) === 0 ? 'A' : 'B';
      
      // Log which variant was shown
      Log::info('User shown variant', [
          'user_id' => auth()->id() ?? 'guest',
          'variant' => $variant,
          'page' => 'homepage'
      ]);
      
      return view('home', [
          'variant' => $variant
      ]);
  }
  ```

### 3. Business Intelligence
- Data warehousing
- Reporting dashboards
- KPI tracking
- Data exports

## 🔒 Keamanan dan Compliance

### 1. Security Best Practices
- Regular security audits
- Dependency scanning

  ```bash
  composer audit
  npm audit
  ```

- OWASP Top 10 compliance
- Security headers

  ```php:app/Http/Middleware/SecurityHeaders.php
  namespace App\Http\Middleware;
  
  use Closure;
  use Illuminate\Http\Request;
  
  class SecurityHeaders
  {
      public function handle(Request $request, Closure $next)
      {
          $response = $next($request);
          
          $response->headers->set('X-XSS-Protection', '1; mode=block');
          $response->headers->set('X-Frame-Options', 'DENY');
          $response->headers->set('X-Content-Type-Options', 'nosniff');
          $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
          $response->headers->set('Content-Security-Policy', "default-src 'self'");
          $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
          
          return $response;
      }
  }
  ```

### 2. Data Protection
- GDPR compliance
- Data encryption
- Privacy by design
- Data retention policies

  ```php:app/Console/Commands/PruneOldData.php
  namespace App\Console\Commands;
  
  use Illuminate\Console\Command;
  use App\Models\User;
  use Carbon\Carbon;
  
  class PruneOldData extends Command
  {
      protected $signature = 'data:prune';
      protected $description = 'Prune old data according to retention policies';
      
      public function handle()
      {
          // Example: Delete inactive users older than 2 years
          $cutoffDate = Carbon::now()->subYears(2);
          
          $count = User::where('last_login_at', '<', $cutoffDate)
                      ->where('status', 'inactive')
                      ->delete();
          
          $this->info("Pruned {$count} inactive users.");
          
          // Add more data pruning logic here
          
          return Command::SUCCESS;
      }
  }
  ```

### 3. Authentication and Authorization
- Multi-factor authentication
- Role-based access control
- OAuth2 implementation
- JWT handling

  ```php:config/auth.php
  'guards' => [
      'web' => [
          'driver' => 'session',
          'provider' => 'users',
      ],
      
      'api' => [
          'driver' => 'sanctum',
          'provider' => 'users',
      ],
  ],
  ```

## 📚 Dokumentasi

### 1. Kode dan API
- PHPDoc untuk semua classes dan methods

  ```php:app/Services/PaymentService.php
  /**
   * Process a payment transaction
   *
   * @param  \App\Models\Order  $order  The order to process payment for
   * @param  array  $paymentDetails  Payment details including method and token
   * @return \App\Models\Transaction  The created transaction
   * @throws \App\Exceptions\PaymentFailedException  When payment processing fails
   */
  public function processPayment(Order $order, array $paymentDetails): Transaction
  {
      // Implementation
  }
  ```

- API documentation dengan Swagger/OpenAPI
- Postman collections

### 2. Proyek dan Onboarding
- README yang komprehensif
- Installation guide
- Development workflow
- Contribution guidelines

  ```markdown:CONTRIBUTING.md
  # Contribution Guidelines
  
  Thank you for considering contributing to our project!
  
  ## Pull Request Process
  
  1. Ensure any install or build dependencies are removed before the end of the layer.
  2. Update the README.md with details of changes to the interface, if applicable.
  3. The PR should work with our CI/CD pipeline.
  4. PRs require approval from at least one maintainer before being merged.
  
  ## Code Standards
  
  - Follow PSR-12 coding standard
  - Write tests for new features
  - Keep functions small and focused
  - Use meaningful variable and function names
  ```

- Architecture diagrams

## 🔄 Migrasi dan Upgrade

### 1. Migrasi Versi Laravel
- Upgrade path planning
- Backward compatibility
- Feature deprecation strategy

  ```bash
  # Example upgrade from Laravel 9 to 10
  composer require laravel/framework:^10.0 --update-with-all-dependencies
  php artisan view:clear
  php artisan route:clear
  php artisan config:clear
  php artisan event:clear
  ```

### 2. Migrasi Arsitektur
- Monolitik ke Inertia.js
- Monolitik ke API-first
- Legacy code refactoring strategy

### 3. Database Migrations
- Schema evolution
- Data migration strategies
- Zero-downtime migrations

  ```php:database/migrations/2023_01_01_000000_add_status_to_orders_table.php
  public function up()
  {
      // Add new column without breaking existing code
      Schema::table('orders', function (Blueprint $table) {
          $table->string('status')->nullable()->after('total');
      });
      
      // Update existing records
      DB::table('orders')->whereNull('status')->update([
          'status' => 'pending'
      ]);
      
      // Make column required after data is migrated
      Schema::table('orders', function (Blueprint $table) {
          $table->string('status')->nullable(false)->change();
      });
  }
  ```

## 🌐 Internationalization dan Localization

### 1. Multi-language Support
- Laravel Localization setup

  ```php:resources/lang/en/messages.php
  return [
      'welcome' => 'Welcome to our application!',
      'login' => 'Log in',
      'register' => 'Register',
  ];
  ```

  ```php:resources/lang/id/messages.php
  return [
      'welcome' => 'Selamat datang di aplikasi kami!',
      'login' => 'Masuk',
      'register' => 'Daftar',
  ];
  ```

- Translation management
- Language switching

  ```php:app/Http/Middleware/SetLocale.php
  namespace App\Http\Middleware;
  
  use Closure;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\App;
  
  class SetLocale
  {
      public function handle(Request $request, Closure $next)
      {
          if ($request->has('lang')) {
              $locale = $request->get('lang');
              App::setLocale($locale);
              session()->put('locale', $locale);
          } elseif (session()->has('locale')) {
              App::setLocale(session()->get('locale'));
          }
          
          return $next($request);
      }
  }
  ```

### 2. Localization
- Date and time formatting
- Number and currency formatting
- Right-to-left (RTL) support
- Cultural considerations

## 🧪 Eksperimental dan Fitur Baru

### 1. Laravel Fitur Terbaru
- Laravel Pennant (feature flags)
- Laravel Reverb (WebSockets)
- Process Interaction API
- Invokable validation rules

```php:app/Rules/StrongPassword.php
namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class StrongPassword implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (strlen($value) < 8) {
            $fail('The '.$attribute.' must be at least 8 characters.');
        }
        
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('The '.$attribute.' must contain at least one uppercase letter.');
        }
        
        if (!preg_match('/[a-z]/', $value)) {
            $fail('The '.$attribute.' must contain at least one lowercase letter.');
        }
        
        if (!preg_match('/[0-9]/', $value)) {
            $fail('The '.$attribute.' must contain at least one number.');
        }
        
        if (!preg_match('/[^A-Za-z0-9]/', $value)) {
            $fail('The '.$attribute.' must contain at least one special character.');
        }
    }
}
```

### 2. Teknologi Emerging
- WebAssembly integration
- Progressive Web Apps (PWA)

  ```javascript:public/service-worker.js
  // Service Worker for PWA
  const CACHE_NAME = 'v1_cache';
  const urlsToCache = [
    '/',
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/images/logo.png'
  ];
  
  // Install a service worker
  self.addEventListener('install', event => {
    event.waitUntil(
      caches.open(CACHE_NAME)
        .then(cache => {
          return cache.addAll(urlsToCache);
        })
    );
  });
  
  // Cache and return requests
  self.addEventListener('fetch', event => {
    event.respondWith(
      caches.match(event.request)
        .then(response => {
          // Return the cached response if found
          if (response) {
            return response;
          }
          
          // Otherwise fetch from network
          return fetch(event.request)
            .then(response => {
              // Check if we received a valid response
              if (!response || response.status !== 200 || response.type !== 'basic') {
                return response;
              }
              
              // Clone the response
              const responseToCache = response.clone();
              
              caches.open(CACHE_NAME)
                .then(cache => {
                  cache.put(event.request, responseToCache);
                });
              
              return response;
            })
            .catch(() => {
              // If fetch fails, show offline page
              return caches.match('/offline');
            });
        })
    );
  });
  
  // Update service worker
  self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    
    event.waitUntil(
      caches.keys().then(cacheNames => {
        return Promise.all(
          cacheNames.map(cacheName => {
            if (cacheWhitelist.indexOf(cacheName) === -1) {
              return caches.delete(cacheName);
            }
          })
        );
      })
    );
  });
  ```

- Server-sent events
- GraphQL implementation

  ```php:app/GraphQL/Queries/UsersQuery.php
  namespace App\GraphQL\Queries;
  
  use App\Models\User;
  use GraphQL\Type\Definition\Type;
  use Rebing\GraphQL\Support\Query;
  use Rebing\GraphQL\Support\Facades\GraphQL;
  
  class UsersQuery extends Query
  {
      protected $attributes = [
          'name' => 'users',
          'description' => 'A query of users'
      ];
      
      public function type(): Type
      {
          return Type::listOf(GraphQL::type('User'));
      }
      
      public function args(): array
      {
          return [
              'id' => [
                  'name' => 'id',
                  'type' => Type::int()
              ],
              'email' => [
                  'name' => 'email',
                  'type' => Type::string()
              ]
          ];
      }
      
      public function resolve($root, $args)
      {
          $query = User::query();
          
          if (isset($args['id'])) {
              $query->where('id', $args['id']);
          }
          
          if (isset($args['email'])) {
              $query->where('email', $args['email']);
          }
          
          return $query->get();
      }
  }
  ```

### 3. AI Integration
- Laravel integration with OpenAI
- Recommendation engines
- Content generation
- Chatbots and virtual assistants

  ```php:app/Services/AiService.php
  namespace App\Services;
  
  use Illuminate\Support\Facades\Http;
  
  class AiService
  {
      protected $apiKey;
      
      public function __construct()
      {
          $this->apiKey = config('services.openai.api_key');
      }
      
      public function generateContentSuggestion(string $topic, int $maxTokens = 150)
      {
          $response = Http::withHeaders([
              'Authorization' => 'Bearer ' . $this->apiKey,
              'Content-Type' => 'application/json',
          ])->post('https://api.openai.com/v1/completions', [
              'model' => 'text-davinci-003',
              'prompt' => "Generate a blog post outline about {$topic}",
              'max_tokens' => $maxTokens,
              'temperature' => 0.7,
          ]);
          
          if ($response->successful()) {
              return $response->json()['choices'][0]['text'];
          }
          
          return null;
      }
      
      public function moderateContent(string $content)
      {
          $response = Http::withHeaders([
              'Authorization' => 'Bearer ' . $this->apiKey,
              'Content-Type' => 'application/json',
          ])->post('https://api.openai.com/v1/moderations', [
              'input' => $content
          ]);
          
          if ($response->successful()) {
              return $response->json()['results'][0];
          }
          
          return null;
      }
  }
  ```

## 🔄 Arsitektur Spesifik (Lanjutan)

### 1. Event-Driven Architecture
- Event broadcasting
- WebSockets dengan Laravel Echo

  ```javascript:resources/js/bootstrap.js
  import Echo from 'laravel-echo';
  import Pusher from 'pusher-js';
  
  window.Pusher = Pusher;
  
  window.Echo = new Echo({
      broadcaster: 'pusher',
      key: import.meta.env.VITE_PUSHER_APP_KEY,
      cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
      forceTLS: true
  });
  
  window.Echo.private('orders')
      .listen('OrderShipped', (e) => {
          console.log(e.order);
          // Update UI or show notification
      });
  ```

- Event sourcing
- CQRS pattern

### 2. Domain-Driven Design
- Bounded contexts
- Aggregates and entities
- Value objects
- Domain events

  ```php:app/Domains/Ordering/Events/OrderPlaced.php
  namespace App\Domains\Ordering\Events;
  
  use App\Domains\Ordering\Models\Order;
  use Illuminate\Foundation\Events\Dispatchable;
  use Illuminate\Queue\SerializesModels;
  
  class OrderPlaced
  {
      use Dispatchable, SerializesModels;
      
      public $order;
      
      public function __construct(Order $order)
      {
          $this->order = $order;
      }
  }
  ```

### 3. Hexagonal Architecture
- Ports and adapters
- Use cases
- Domain separation
- Infrastructure independence

  ```php:app/Core/Ports/OrderRepositoryInterface.php
  namespace App\Core\Ports;
  
  use App\Core\Domain\Order;
  
  interface OrderRepositoryInterface
  {
      public function findById(int $id): ?Order;
      public function save(Order $order): void;
      public function findAllByUserId(int $userId): array;
  }
  ```

  ```php:app/Infrastructure/Persistence/EloquentOrderRepository.php
  namespace App\Infrastructure\Persistence;
  
  use App\Core\Domain\Order;
  use App\Core\Ports\OrderRepositoryInterface;
  use App\Models\Order as EloquentOrder;
  
  class EloquentOrderRepository implements OrderRepositoryInterface
  {
      public function findById(int $id): ?Order
      {
          $eloquentOrder = EloquentOrder::find($id);
          
          if (!$eloquentOrder) {
              return null;
          }
          
          return $this->mapToDomainModel($eloquentOrder);
      }
      
      public function save(Order $order): void
      {
          // Implementation
      }
      
      public function findAllByUserId(int $userId): array
      {
          // Implementation
      }
      
      private function mapToDomainModel(EloquentOrder $eloquentOrder): Order
      {
          // Map Eloquent model to domain model
      }
  }
  ```

## 📱 Mobile Integration

### 1. API for Mobile Apps
- Consistent API design
- Authentication for mobile
- Push notifications

  ```php:app/Services/PushNotificationService.php
  namespace App\Services;
  
  use App\Models\User;
  
  class PushNotificationService
  {
      public function sendToUser(User $user, string $title, string $body, array $data = [])
      {
          foreach ($user->devices as $device) {
              if ($device->platform === 'ios') {
                  $this->sendToIos($device->token, $title, $body, $data);
              } elseif ($device->platform === 'android') {
                  $this->sendToAndroid($device->token, $title, $body, $data);
              }
          }
      }
      
      protected function sendToIos(string $token, string $title, string $body, array $data)
      {
          // Implementation using Apple Push Notification service
      }
      
      protected function sendToAndroid(string $token, string $title, string $body, array $data)
      {
          // Implementation using Firebase Cloud Messaging
      }
  }
  ```

### 2. Progressive Web Apps
- Service workers
- Offline capabilities
- Home screen installation
- Push notifications

### 3. Native App Integration
- API authentication
- Deep linking
- Shared code strategies
- Cross-platform considerations

## 🧩 Third-Party Integrations

### 1. Payment Gateways
- Stripe, PayPal, Midtrans integration
- Subscription management
- Webhook handling

  ```php:app/Http/Controllers/WebhookController.php
  namespace App\Http\Controllers;
  
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Log;
  use App\Models\Payment;
  use Stripe\Webhook;
  use Stripe\Exception\SignatureVerificationException;
  
  class WebhookController extends Controller
  {
      public function handleStripeWebhook(Request $request)
      {
          $payload = $request->getContent();
          $sigHeader = $request->header('Stripe-Signature');
          $endpointSecret = config('services.stripe.webhook_secret');
          
          try {
              $event = Webhook::constructEvent(
                  $payload, $sigHeader, $endpointSecret
              );
          } catch (SignatureVerificationException $e) {
              return response()->json(['error' => 'Invalid signature'], 400);
          }
          
          // Handle the event
          switch ($event->type) {
              case 'payment_intent.succeeded':
                  $paymentIntent = $event->data->object;
                  $this->handleSuccessfulPayment($paymentIntent);
                  break;
              case 'payment_intent.payment_failed':
                  $paymentIntent = $event->data->object;
                  $this->handleFailedPayment($paymentIntent);
                  break;
              default:
                  Log::info('Unhandled event type: ' . $event->type);
          }
          
          return response()->json(['status' => 'success']);
      }
      
      private function handleSuccessfulPayment($paymentIntent)
      {
          // Update payment status in database
          Payment::where('payment_intent_id', $paymentIntent->id)
              ->update(['status' => 'completed']);
          
          // Additional business logic
      }
      
      private function handleFailedPayment($paymentIntent)
      {
          // Update payment status in database
          Payment::where('payment_intent_id', $paymentIntent->id)
              ->update([
                  'status' => 'failed',
                  'error_message' => $paymentIntent->last_payment_error->message ?? null
              ]);
          
          // Additional business logic
      }
  }
  ```

### 2. Social Media
- OAuth authentication
- Social sharing
- Social feeds integration

### 3. Email and Messaging
- Mailchimp, SendGrid, Mailgun
- SMS gateways
- WhatsApp Business API

  ```php:app/Services/EmailService.php
  namespace App\Services;
  
  use App\Mail\WelcomeEmail;
  use App\Mail\OrderConfirmation;
  use App\Models\User;
  use App\Models\Order;
  use Illuminate\Support\Facades\Mail;
  
  class EmailService
  {
      public function sendWelcomeEmail(User $user)
      {
          Mail::to($user->email)->send(new WelcomeEmail($user));
      }
      
      public function sendOrderConfirmation(Order $order)
      {
          Mail::to($order->user->email)->send(new OrderConfirmation($order));
      }
      
      public function subscribeToNewsletter(string $email, string $name = null)
      {
          // Integration with newsletter service like Mailchimp
          $client = new \MailchimpMarketing\ApiClient();
          $client->setConfig([
              'apiKey' => config('services.mailchimp.api_key'),
              'server' => config('services.mailchimp.server_prefix')
          ]);
          
          try {
              $response = $client->lists->addListMember(
                  config('services.mailchimp.list_id'),
                  [
                      'email_address' => $email,
                      'status' => 'subscribed',
                      'merge_fields' => [
                          'FNAME' => $name ?? '',
                      ]
                  ]
              );
              
              return true;
          } catch (\Exception $e) {
              report($e);
              return false;
          }
      }
  }
  ```

### 4. Analytics and Tracking
- Google Analytics
- Facebook Pixel
- Custom event tracking

## 🚀 Performance Optimization

### 1. Database Optimization
- Query optimization
- Indexing strategies
- Database scaling
- Query caching

```php:app/Repositories/ProductRepository.php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository
{
    public function getFeaturedProducts($limit = 10)
    {
        return Cache::remember('featured_products', 3600, function () use ($limit) {
            return Product::where('featured', true)
                ->with(['category', 'images'])
                ->withAvg('reviews', 'rating')
                ->orderBy('created_at', 'desc')
                ->take($limit)
                ->get();
        });
    }
    
    public function searchProducts($query, $filters = [])
    {
        $cacheKey = 'product_search_' . md5($query . serialize($filters));
        
        return Cache::remember($cacheKey, 1800, function () use ($query, $filters) {
            $products = Product::query();
            
            // Search by name or description
            if ($query) {
                $products->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                });
            }
            
            // Apply filters
            if (isset($filters['category_id'])) {
                $products->where('category_id', $filters['category_id']);
            }
            
            if (isset($filters['min_price'])) {
                $products->where('price', '>=', $filters['min_price']);
            }
            
            if (isset($filters['max_price'])) {
                $products->where('price', '<=', $filters['max_price']);
            }
            
            // Include relationships and order
            return $products->with(['category', 'images'])
                ->withAvg('reviews', 'rating')
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        });
    }
}
```

### 2. Application Caching
- Response caching
- Route caching
- View caching
- Data caching

  ```bash
  # Cache configuration
  php artisan config:cache
  
  # Cache routes
  php artisan route:cache
  
  # Cache views
  php artisan view:cache
  ```

  ```php:app/Http/Kernel.php
  protected $middlewareGroups = [
      'web' => [
          // Other middleware...
          \Illuminate\Routing\Middleware\SubstituteBindings::class,
          \App\Http\Middleware\CacheResponse::class,
      ],
  ];
  ```

  ```php:app/Http/Middleware/CacheResponse.php
  namespace App\Http\Middleware;
  
  use Closure;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Cache;
  
  class CacheResponse
  {
      public function handle(Request $request, Closure $next)
      {
          // Don't cache if authenticated or posting data
          if ($request->user() || !$request->isMethod('GET')) {
              return $next($request);
          }
          
          $cacheKey = 'page_cache_' . sha1($request->fullUrl());
          
          if (Cache::has($cacheKey)) {
              return Cache::get($cacheKey);
          }
          
          $response = $next($request);
          
          // Cache the response for 30 minutes if it's successful
          if ($response->status() === 200) {
              Cache::put($cacheKey, $response, 1800);
          }
          
          return $response;
      }
  }
  ```

### 3. Frontend Optimization
- Asset bundling and minification
- Lazy loading
- Code splitting
- Image optimization

  ```javascript:vite.config.js
  import { defineConfig } from 'vite';
  import laravel from 'laravel-vite-plugin';
  import vue from '@vitejs/plugin-vue';
  import { splitVendorChunkPlugin } from 'vite';
  import { imagetools } from 'vite-imagetools';
  
  export default defineConfig({
      plugins: [
          laravel({
              input: ['resources/css/app.css', 'resources/js/app.js'],
              refresh: true,
          }),
          vue(),
          splitVendorChunkPlugin(),
          imagetools()
      ],
      build: {
          rollupOptions: {
              output: {
                  manualChunks: {
                      vendor: ['vue', 'axios'],
                      ui: ['@headlessui/vue', '@heroicons/vue'],
                  }
              }
          }
      }
  });
  ```

### 4. Server Optimization
- PHP-FPM tuning
- Nginx/Apache configuration
- Content Delivery Network (CDN)
- Load balancing

  ```nginx:nginx/sites-available/laravel.conf
  server {
      listen 80;
      server_name example.com;
      root /var/www/html/public;
  
      add_header X-Frame-Options "SAMEORIGIN";
      add_header X-Content-Type-Options "nosniff";
  
      index index.php;
  
      charset utf-8;
  
      location / {
          try_files $uri $uri/ /index.php?$query_string;
      }
  
      location = /favicon.ico { access_log off; log_not_found off; }
      location = /robots.txt  { access_log off; log_not_found off; }
  
      error_page 404 /index.php;
  
      location ~ \.php$ {
          fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
          fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
          include fastcgi_params;
      }
  
      location ~ /\.(?!well-known).* {
          deny all;
      }
      
      # Cache static assets
      location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
          expires 30d;
          add_header Cache-Control "public, no-transform";
      }
  }
  ```

## 🧠 Praktik Terbaik Tambahan

### 1. Code Quality
- Static analysis dengan PHPStan atau Psalm

  ```bash
  composer require --dev phpstan/phpstan
  
  # Create phpstan.neon configuration
  echo "parameters:
    level: 5
    paths:
        - app
        - tests
    excludePaths:
        - app/Console/Kernel.php
    checkMissingIterableValueType: false" > phpstan.neon
  
  # Run analysis
  ./vendor/bin/phpstan analyse
  ```

- Automated code reviews
- Code style enforcement
- Refactoring strategies

### 2. Dependency Management
- Composer optimization
- NPM/Yarn best practices
- Dependency updates strategy
- Security audits

  ```bash
  # Optimize autoloader
  composer dump-autoload --optimize
  
  # Update dependencies securely
  composer update --with-all-dependencies
  
  # Check for security vulnerabilities
  composer audit
  ```

### 3. Collaboration
- Pull request templates
- Issue templates
- Code review guidelines
- Documentation standards

  ```markdown:.github/PULL_REQUEST_TEMPLATE.md
  ## Description
  
  Please include a summary of the change and which issue is fixed. Please also include relevant motivation and context.
  
  Fixes # (issue)
  
  ## Type of change
  
  - [ ] Bug fix (non-breaking change which fixes an issue)
  - [ ] New feature (non-breaking change which adds functionality)
  - [ ] Breaking change (fix or feature that would cause existing functionality to not work as expected)
  - [ ] This change requires a documentation update
  
  ## How Has This Been Tested?
  
  Please describe the tests that you ran to verify your changes. Provide instructions so we can reproduce.
  
  ## Checklist:
  
  - [ ] My code follows the style guidelines of this project
  - [ ] I have performed a self-review of my own code
  - [ ] I have commented my code, particularly in hard-to-understand areas
  - [ ] I have made corresponding changes to the documentation
  - [ ] My changes generate no new warnings
  - [ ] I have added tests that prove my fix is effective or that my feature works
  - [ ] New and existing unit tests pass locally with my changes
  ```

## 🔄 Integrasi Ecosystem Laravel

### 1. Laravel Nova
- Custom resources
- Custom fields
- Custom actions
- Dashboard customization

  ```php:app/Nova/User.php
  namespace App\Nova;
  
  use Laravel\Nova\Fields\ID;
  use Laravel\Nova\Fields\Text;
  use Laravel\Nova\Fields\Gravatar;
  use Laravel\Nova\Fields\Password;
  use Laravel\Nova\Fields\BelongsToMany;
  
  class User extends Resource
  {
      public static $model = \App\Models\User::class;
      public static $title = 'name';
      public static $search = ['id', 'name', 'email'];
      
      public function fields()
      {
          return [
              ID::make()->sortable(),
              
              Gravatar::make()->maxWidth(50),
              
              Text::make('Name')
                  ->sortable()
                  ->rules('required', 'max:255'),
              
              Text::make('Email')
                  ->sortable()
                  ->rules('required', 'email', 'max:254')
                  ->creationRules('unique:users,email')
                  ->updateRules('unique:users,email,{{resourceId}}'),
              
              Password::make('Password')
                  ->onlyOnForms()
                  ->creationRules('required', 'string', 'min:8')
                  ->updateRules('nullable', 'string', 'min:8'),
                  
              BelongsToMany::make('Roles'),
          ];
      }
  }
  ```

### 2. Laravel Horizon
- Queue monitoring
- Queue configuration
- Performance metrics
- Failed job handling

  ```php:config/horizon.php
  'environments' => [
      'production' => [
          'supervisor-1' => [
              'connection' => 'redis',
              'queue' => ['default', 'emails', 'notifications'],
              'balance' => 'auto',
              'maxProcesses' => 10,
              'tries' => 3,
              'timeout' => 60,
          ],
      ],
      
      'local' => [
          'supervisor-1' => [
              'connection' => 'redis',
              'queue' => ['default', 'emails', 'notifications'],
              'balance' => 'simple',
              'processes' => 3,
              'tries' => 3,
          ],
      ],
  ],
  ```

### 3. Laravel Telescope
- Request monitoring
- Exception tracking
- Database query logging
- Cache operation monitoring

  ```php:app/Providers/TelescopeServiceProvider.php
  protected function gate()
  {
      Gate::define('viewTelescope', function ($user) {
          return in_array($user->email, [
              'admin@example.com',
              'developer@example.com'
          ]) || $user->hasRole('admin');
      });
  }
  ```

### 4. Laravel Jetstream
- Authentication scaffolding
- Team management
- API token management
- Profile management

### 5. Laravel Livewire
- Real-time components
- Form handling
- Validation
- File uploads

  ```php:app/Http/Livewire/ContactForm.php
  namespace App\Http\Livewire;
  
  use Livewire\Component;
  use App\Models\Contact;
  
  class ContactForm extends Component
  {
      public $name;
      public $email;
      public $message;
      public $success = false;
      
      protected $rules = [
          'name' => 'required|min:3',
          'email' => 'required|email',
          'message' => 'required|min:10',
      ];
      
      public function updated($propertyName)
      {
          $this->validateOnly($propertyName);
      }
      
      public function submit()
      {
          $validatedData = $this->validate();
          
          Contact::create($validatedData);
          
          $this->reset(['name', 'email', 'message']);
          $this->success = true;
      }
      
      public function render()
      {
          return view('livewire.contact-form');
      }
  }
  ```

  ```html:resources/views/livewire/contact-form.blade.php
  <div>
      @if ($success)
          <div class="bg-green-100 p-4 mb-4 rounded">
              Pesan Anda telah dikirim. Terima kasih!
          </div>
      @endif
      
      <form wire:submit.prevent="submit">
          <div class="mb-4">
              <label for="name" class="block mb-2">Nama</label>
              <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border rounded">
              @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>
          
          <div class="mb-4">
              <label for="email" class="block mb-2">Email</label>
              <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 border rounded">
              @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>
          
          <div class="mb-4">
              <label for="message" class="block mb-2">Pesan</label>
              <textarea id="message" wire:model="message" rows="4" class="w-full px-3 py-2 border rounded"></textarea>
              @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>
          
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
              <span wire:loading.remove>Kirim Pesan</span>
              <span wire:loading>Mengirim...</span>
          </button>
      </form>
  </div>
  ```

## 🌟 Kesimpulan

Mengikuti panduan komprehensif ini akan menghasilkan proyek yang terstruktur dengan baik, dapat diskalakan, dan mudah dipelihara yang dapat dengan mudah disesuaikan dengan kebutuhan masa depan, terlepas dari arsitektur atau stack teknologi yang dipilih.

Panduan ini mencakup semua jenis proyek Laravel, termasuk:
- Monolitik dengan Blade + Alpine.js
- Inertia.js dengan Vue.js atau React
- API-First untuk SPA atau aplikasi mobile
- Microservices untuk aplikasi terdistribusi

Setiap proyek memiliki kebutuhan unik, jadi gunakan panduan ini sebagai referensi dan sesuaikan dengan kebutuhan spesifik proyek Anda. Selalu ikuti prinsip SOLID, DRY, dan KISS untuk memastikan kode yang bersih dan dapat dipelihara.

## 🧠 Prinsip Pengembangan Perangkat Lunak

### 1. SOLID Principles
SOLID adalah akronim yang mewakili lima prinsip desain berorientasi objek yang diperkenalkan oleh Robert C. Martin (Uncle Bob).

#### S - Single Responsibility Principle (SRP)
Sebuah kelas harus memiliki satu, dan hanya satu, alasan untuk berubah.

```php:app/Services/OrderService.php
// Contoh yang buruk: Kelas dengan banyak tanggung jawab
class OrderBad {
    public function createOrder($data) { /* ... */ }
    public function calculateTax($order) { /* ... */ }
    public function sendOrderEmail($order) { /* ... */ }
    public function generateInvoicePdf($order) { /* ... */ }
}

// Contoh yang baik: Kelas dengan tanggung jawab tunggal
class OrderService {
    protected $taxCalculator;
    protected $notificationService;
    protected $pdfGenerator;
    
    public function __construct(
        TaxCalculator $taxCalculator,
        NotificationService $notificationService,
        PdfGenerator $pdfGenerator
    ) {
        $this->taxCalculator = $taxCalculator;
        $this->notificationService = $notificationService;
        $this->pdfGenerator = $pdfGenerator;
    }
    
    public function createOrder($data) {
        $order = Order::create($data);
        $order->tax = $this->taxCalculator->calculate($order);
        $order->save();
        
        $this->notificationService->sendOrderConfirmation($order);
        $this->pdfGenerator->generateInvoice($order);
        
        return $order;
    }
}
```

#### O - Open/Closed Principle (OCP)
Entitas perangkat lunak (kelas, modul, fungsi, dll.) harus terbuka untuk ekstensi, tetapi tertutup untuk modifikasi.

```php:app/Services/PaymentProcessors/PaymentProcessor.php
// Interface untuk processor pembayaran
interface PaymentProcessor {
    public function processPayment(Order $order, array $paymentDetails);
}

// Implementasi untuk Stripe
class StripePaymentProcessor implements PaymentProcessor {
    public function processPayment(Order $order, array $paymentDetails) {
        // Implementasi pembayaran Stripe
    }
}

// Implementasi untuk PayPal
class PayPalPaymentProcessor implements PaymentProcessor {
    public function processPayment(Order $order, array $paymentDetails) {
        // Implementasi pembayaran PayPal
    }
}

// Service yang menggunakan processor
class PaymentService {
    protected $processor;
    
    public function __construct(PaymentProcessor $processor) {
        $this->processor = $processor;
    }
    
    public function chargeOrder(Order $order, array $paymentDetails) {
        return $this->processor->processPayment($order, $paymentDetails);
    }
}
```

#### L - Liskov Substitution Principle (LSP)
Objek dari kelas turunan harus dapat menggantikan objek dari kelas induk tanpa mempengaruhi kebenaran program.

```php:app/Models/User.php
// Kelas dasar
class User {
    public function login($credentials) {
        // Logika login standar
    }
}

// Kelas turunan yang mematuhi LSP
class AdminUser extends User {
    public function login($credentials) {
        // Mungkin menambahkan logging tambahan
        Log::info('Admin login attempt', ['email' => $credentials['email']]);
        
        // Tetapi masih memanggil logika dasar atau mengimplementasikan dengan cara yang kompatibel
        return parent::login($credentials);
    }
}

// Kelas turunan yang melanggar LSP
class GuestUser extends User {
    public function login($credentials) {
        // Melanggar kontrak dengan melempar exception
        throw new \Exception('Guest users cannot login');
    }
}
```

#### I - Interface Segregation Principle (ISP)
Klien tidak boleh dipaksa bergantung pada interface yang tidak mereka gunakan.

```php:app/Contracts/Repositories/UserRepository.php
// Interface yang terlalu besar (melanggar ISP)
interface UserRepositoryBig {
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function sendWelcomeEmail(User $user);
    public function resetPassword(User $user);
    public function generateApiToken(User $user);
}

// Interface yang lebih kecil dan fokus (mematuhi ISP)
interface UserRepository {
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}

interface UserEmailService {
    public function sendWelcomeEmail(User $user);
    public function sendPasswordResetEmail(User $user);
}

interface UserTokenService {
    public function generateApiToken(User $user);
    public function revokeApiToken(User $user, $tokenId);
}
```

#### D - Dependency Inversion Principle (DIP)
Modul tingkat tinggi tidak boleh bergantung pada modul tingkat rendah. Keduanya harus bergantung pada abstraksi.

```php:app/Http/Controllers/UserController.php
// Melanggar DIP - bergantung langsung pada implementasi konkret
class UserControllerBad {
    public function store(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        // Ketergantungan langsung pada implementasi konkret
        $mailer = new SmtpMailer();
        $mailer->sendWelcomeEmail($user);
        
        return response()->json($user);
    }
}

// Mematuhi DIP - bergantung pada abstraksi
class UserController {
    protected $userRepository;
    protected $mailer;
    
    public function __construct(UserRepository $userRepository, Mailer $mailer) {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }
    
    public function store(Request $request) {
        $user = $this->userRepository->create($request->validated());
        $this->mailer->sendWelcomeEmail($user);
        
        return response()->json($user);
    }
}
```

### 2. DRY (Don't Repeat Yourself)
Prinsip DRY menyatakan bahwa setiap potongan pengetahuan atau logika dalam sistem harus memiliki representasi tunggal dan tidak ambigu.

```php:app/Traits/HasSlug.php
// Contoh yang melanggar DRY - kode duplikat di beberapa model
class ProductBad extends Model {
    protected static function boot() {
        parent::boot();
        
        static::creating(function ($product) {
            $slug = Str::slug($product->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}

class CategoryBad extends Model {
    protected static function boot() {
        parent::boot();
        
        static::creating(function ($category) {
            $slug = Str::slug($category->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}

// Contoh yang mematuhi DRY - menggunakan trait untuk berbagi kode
trait HasSlug {
    protected static function bootHasSlug() {
        static::creating(function ($model) {
            $slugField = $model->slugField ?? 'name';
            $slugColumn = $model->slugColumn ?? 'slug';
            
            $slug = Str::slug($model->{$slugField});
            $count = static::whereRaw("$slugColumn RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->{$slugColumn} = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}

class Product extends Model {
    use HasSlug;
    
    // Kustomisasi jika diperlukan
    protected $slugField = 'name';
    protected $slugColumn = 'slug';
}

class Category extends Model {
    use HasSlug;
}
```

### 3. KISS (Keep It Simple, Stupid)
Prinsip KISS menyatakan bahwa sebagian besar sistem bekerja paling baik jika mereka tetap sederhana, bukan dibuat kompleks.

```php:app/Services/DateFormatter.php
// Contoh yang melanggar KISS - terlalu kompleks
class DateFormatterBad {
    public function formatDate($date, $format = null, $locale = null, $timezone = null) {
        if (!$date instanceof \DateTime) {
            if (is_string($date)) {
                try {
                    $date = new \DateTime($date);
                } catch (\Exception $e) {
                    throw new \InvalidArgumentException("Invalid date string: {$date}");
                }
            } elseif (is_int($date)) {
                $date = (new \DateTime())->setTimestamp($date);
            } else {
                throw new \InvalidArgumentException("Unsupported date format");
            }
        }
        
        if ($timezone) {
            try {
                $date->setTimezone(new \DateTimeZone($timezone));
            } catch (\Exception $e) {
                throw new \InvalidArgumentException("Invalid timezone: {$timezone}");
            }
        }
        
        if ($locale) {
            $formatter = new \IntlDateFormatter(
                $locale,
                \IntlDateFormatter::MEDIUM,
                \IntlDateFormatter::SHORT
            );
            
            if ($format) {
                $formatter->setPattern($format);
            }
            
            return $formatter->format($date);
        }
        
        return $date->format($format ?: 'Y-m-d H:i:s');
    }
}

// Contoh yang mematuhi KISS - lebih sederhana dan fokus
class DateFormatter {
    public function format(\DateTime $date, string $format = 'Y-m-d H:i:s'): string {
        return $date->format($format);
    }
    
    public function formatLocalized(\DateTime $date, string $locale, string $format = null): string {
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::MEDIUM,
            \IntlDateFormatter::SHORT
        );
        
        if ($format) {
            $formatter->setPattern($format);
        }
        
        return $formatter->format($date);
    }
}
```

## 🔄 Arsitektur Spesifik (Lanjutan)

### 4. Vertical Slice Architecture
Mengorganisir kode berdasarkan fitur atau "slice" vertikal, bukan berdasarkan lapisan teknis.

```
app/
  Features/
    ManageProducts/
      CreateProduct/
        CreateProductCommand.php
        CreateProductHandler.php
        CreateProductValidator.php
        CreateProductResponse.php
      UpdateProduct/
        UpdateProductCommand.php
        UpdateProductHandler.php
        UpdateProductValidator.php
        UpdateProductResponse.php
      ListProducts/
        ListProductsQuery.php
        ListProductsHandler.php
        ListProductsResponse.php
    ManageOrders/
      PlaceOrder/
        PlaceOrderCommand.php
        PlaceOrderHandler.php
        PlaceOrderValidator.php
        PlaceOrderResponse.php
```

### 5. Clean Architecture
Memisahkan kode menjadi lapisan yang berbeda dengan aturan ketergantungan yang ketat.

```
app/
  Domain/
    Entities/
      User.php
      Order.php
      Product.php
    ValueObjects/
      Email.php
      Money.php
      Address.php
    Repositories/
      UserRepositoryInterface.php
      OrderRepositoryInterface.php
    Services/
      OrderService.php
      PaymentService.php
  Application/
    UseCases/
      CreateOrder/
        CreateOrderUseCase.php
        CreateOrderRequest.php
        CreateOrderResponse.php
      ProcessPayment/
        ProcessPaymentUseCase.php
        ProcessPaymentRequest.php
        ProcessPaymentResponse.php
  Infrastructure/
    Persistence/
      Eloquent/
        EloquentUserRepository.php
        EloquentOrderRepository.php
      Redis/
        RedisCartRepository.php
    ExternalServices/
      StripePaymentGateway.php
      MailchimpNewsletterService.php
  Interfaces/
    Http/
      Controllers/
        OrderController.php
        PaymentController.php
      Requests/
        CreateOrderRequest.php
        ProcessPaymentRequest.php
      Resources/
        OrderResource.php
```

## 🔄 Praktik Terbaik Tambahan

### 1. Defensive Programming
Menulis kode yang dapat menangani kondisi tak terduga dan input yang tidak valid.

```php:app/Services/UserService.php
class UserService {
    public function getUserDetails($userId) {
        // Validasi input
        if (!is_numeric($userId) || $userId <= 0) {
            throw new InvalidArgumentException('User ID must be a positive number');
        }
        
        // Cari user dengan defensive check
        $user = User::find($userId);
        
        if (!$user) {
            throw new UserNotFoundException("User with ID {$userId} not found");
        }
        
        // Pastikan data yang dikembalikan konsisten
        return [
            'id' => $user->id,
            'name' => $user->name ?? 'Unknown',
            'email' => $user->email,
            'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            'status' => $user->status ?? 'inactive'
        ];
    }
}
```

### 2. Fail Fast
Mendeteksi dan melaporkan kesalahan sesegera mungkin dalam proses eksekusi.

```php:app/Http/Controllers/OrderController.php
public function store(CreateOrderRequest $request)
{
    // Validasi sudah dilakukan di Request class (fail fast)
    
    // Periksa stok sebelum memproses lebih lanjut
    $product = Product::find($request->product_id);
    
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }
    
    if ($product->stock < $request->quantity) {
        return response()->json([
            'error' => 'Not enough stock available',
            'available' => $product->stock
        ], 422);
    }
    
    // Periksa status pembayaran user jika perlu
    if (auth()->user()->hasPendingPayments() && !auth()->user()->canMakeNewOrder()) {
        return response()->json([
            'error' => 'You have pending payments that need to be settled first'
        ], 403);
    }
    
    // Jika semua validasi lolos, baru proses order
    $order = $this->orderService->createOrder(
        auth()->user(),
        $product,
        $request->quantity,
        $request->shipping_address
    );
    
    return new OrderResource($order);
}
```

### 3. Command Query Responsibility Segregation (CQRS)
Memisahkan operasi yang mengubah data (commands) dari operasi yang membaca data (queries).

```php:app/Commands/CreateOrderCommand.php
namespace App\Commands;

class CreateOrderCommand
{
    public $userId;
    public $productId;
    public $quantity;
    public $shippingAddress;
    
    public function __construct($userId, $productId, $quantity, $shippingAddress)
    {
        $this->userId = $userId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->shippingAddress = $shippingAddress;
    }
}
```

```php:app/Handlers/CreateOrderHandler.php
namespace App\Handlers;

use App\Commands\CreateOrderCommand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Events\OrderCreated;

class CreateOrderHandler
{
    public function handle(CreateOrderCommand $command)
    {
        $user = User::findOrFail($command->userId);
        $product = Product::findOrFail($command->productId);
        
        // Mengurangi stok
        $product->decrementStock($command->quantity);
        
        // Membuat order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $product->price * $command->quantity,
            'status' => 'pending',
            'shipping_address' => $command->shippingAddress
        ]);
        
        // Menambahkan item order
        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => $command->quantity,
            'price' => $product->price
        ]);
        
        // Memicu event
        event(new OrderCreated($order));
        
        return $order;
    }
}
```

```php:app/Queries/GetUserOrdersQuery.php
namespace App\Queries;

class GetUserOrdersQuery
{
    public $userId;
    public $status;
    public $page;
    public $perPage;
    
    public function __construct($userId, $status = null, $page = 1, $perPage = 15)
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->page = $page;
        $this->perPage = $perPage;
    }
}
```

```php:app/Handlers/GetUserOrdersHandler.php
namespace App\Handlers;

use App\Queries\GetUserOrdersQuery;
use App\Models\Order;

class GetUserOrdersHandler
{
    public function handle(GetUserOrdersQuery $query)
    {
        $ordersQuery = Order::where('user_id', $query->userId);
        
        if ($query->status) {
            $ordersQuery->where('status', $query->status);
        }
        
        return $ordersQuery->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate($query->perPage, ['*'], 'page', $query->page);
    }
}
```

### 4. Feature Flags
Menggunakan feature flags untuk mengaktifkan atau menonaktifkan fitur secara dinamis.

```php:config/features.php
return [
    'new_checkout_process' => env('FEATURE_NEW_CHECKOUT', false),
    'advanced_search' => env('FEATURE_ADVANCED_SEARCH', false),
    'user_profiles' => env('FEATURE_USER_PROFILES', true),
    'api_v2' => env('FEATURE_API_V2', false),
];
```

```php:app/Providers/FeatureServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FeatureManager;

class FeatureServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('features', function ($app) {
            return new FeatureManager(config('features'));
        });
    }
}
```

```php:app/Services/FeatureManager.php
namespace App\Services;

class FeatureManager
{
    protected $features;
    
    public function __construct(array $features)
    {
        $this->features = $features;
    }
    
    public function isEnabled($feature)
    {
        return isset($this->features[$feature]) && $this->features[$feature];
    }
    
    public function isDisabled($feature)
    {
        return !$this->isEnabled($feature);
    }
    
    public function all()
    {
        return $this->features;
    }
}
```

```php:app/Http/Controllers/CheckoutController.php
public function process(Request $request)
{
    if (app('features')->isEnabled('new_checkout_process')) {
        return $this->processNewCheckout($request);
    }
    
    return $this->processLegacyCheckout($request);
}
```

## 🧪 Praktik Testing Lanjutan

### 1. Test-Driven Development (TDD)
Menulis test sebelum menulis kode implementasi.

```php:tests/Unit/Services/TaxCalculatorTest.php
namespace Tests\Unit\Services;

use App\Services\TaxCalculator;
use PHPUnit\Framework\TestCase;

class TaxCalculatorTest extends TestCase
{
    /** @test */
    public function it_calculates_tax_for_standard_rate()
    {
        // Arrange
        $calculator = new TaxCalculator();
        $amount = 100;
        $rate = 0.1; // 10%
        
        // Act
        $tax = $calculator->calculate($amount, $rate);
        
        // Assert
        $this->assertEquals(10, $tax);
    }
    
    /** @test */
    public function it_calculates_tax_for_zero_rate()
    {
        // Arrange
        $calculator = new TaxCalculator();
        $amount = 100;
        $rate = 0;
        
        // Act
        $tax = $calculator->calculate($amount, $rate);
        
        // Assert
        $this->assertEquals(0, $tax);
    }
    
    /** @test */
    public function it_throws_exception_for_negative_amount()
    {
        // Arrange
        $calculator = new TaxCalculator();
        $amount = -100;
        $rate = 0.1;
        
        // Assert & Act
        $this->expectException(\InvalidArgumentException::class);
        $calculator->calculate($amount, $rate);
    }
}
```

### 2. Behavior-Driven Development (BDD)
Menulis test yang menggambarkan perilaku yang diharapkan dari sistem.

```php:tests/Feature/PlaceOrderTest.php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaceOrderTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_can_place_an_order_for_a_product()
    {
        // Given we have a signed in user
        $user = User::factory()->create();
        $this->actingAs($user);
        
        // And a product with sufficient stock
        $product = Product::factory()->create([
            'name' => 'Laptop',
            'price' => 1000,
            'stock' => 10
        ]);
        
        // When they submit a new order
        $response = $this->postJson('/api/orders', [
            'product_id' => $product->id,
            'quantity' => 1,
            'shipping_address' => '123 Test Street'
        ]);
        
        // Then the order should be created successfully
        $response->assertStatus(201)
            ->assertJsonPath('data.status', 'pending')
            ->assertJsonPath('data.total', 1000);
        
        // And the product stock should be reduced
        $this->assertEquals(9, $product->fresh()->stock);
        
        // And the order should be in the database
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total' => 1000,
            'status' => 'pending'
        ]);
    }
    
    /** @test */
    public function a_user_cannot_order_more_than_available_stock()
    {
        // Given we have a signed in user
        $user = User::factory()->create();
        $this->actingAs($user);
        
        // And a product with limited stock
        $product = Product::factory()->create([
            'stock' => 5
        ]);
        
        // When they try to order more than available
        $response = $this->postJson('/api/orders', [
            'product_id' => $product->id,
            'quantity' => 10,
            'shipping_address' => '123 Test Street'
        ]);
        
        // Then they should receive an error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['quantity']);
        
        // And no order should be created
        $this->assertDatabaseMissing('orders', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
        
        // And the product stock should remain unchanged
        $this->assertEquals(5, $product->fresh()->stock);
    }
}
```

### 3. Contract Testing
Memastikan bahwa API memenuhi kontrak yang telah ditentukan.

```php:tests/Feature/Api/ProductApiTest.php
namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_returns_the_correct_json_structure_for_a_product()
    {
        // Arrange
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 99.99,
            'stock' => 100
        ]);
        
        // Act
        $response = $this->getJson("/api/products/{$product->id}");
        
        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'stock',
                    'created_at',
                    'updated_at'
                ]
            ])
            ->assertJsonPath('data.name', 'Test Product')
            ->assertJsonPath('data.price', 99.99);
    }
    
    /** @test */
    public function it_returns_the_correct_json_structure_for_product_collection()
    {
        // Arrange
        Product::factory()->count(3)->create();
        
        // Act
        $response = $this->getJson("/api/products");
        
        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'price',
                        'stock',
                        'created_at',
                        'updated_at'
                    ]
                ],
                'links',
                'meta'
            ])
            ->assertJsonCount(3, 'data');
    }
}
```

## 🌟 Kesimpulan

Mengikuti prinsip-prinsip SOLID, DRY, dan KISS, serta praktik terbaik lainnya yang diuraikan dalam panduan ini, akan membantu Anda membangun aplikasi Laravel yang:

1. **Mudah Dipelihara**: Kode yang terorganisir dengan baik dan mengikuti prinsip-prinsip desain yang solid akan lebih mudah dipelihara dan diperbarui seiring waktu.

2. **Skalabel**: Arsitektur yang dirancang dengan baik memungkinkan aplikasi Anda tumbuh dan berkembang tanpa menjadi beban teknis.

3. **Testable**: Kode yang mengikuti prinsip-prinsip SOLID secara alami lebih mudah untuk diuji, yang mengarah pada aplikasi yang lebih andal.

4. **Fleksibel**: Dengan memisahkan komponen dan menggunakan abstraksi, aplikasi Anda dapat beradaptasi dengan perubahan persyaratan dengan lebih mudah.

5. **Performant**: Praktik terbaik untuk optimasi performa memastikan aplikasi Anda tetap cepat dan responsif bahkan saat skala meningkat.

Ingat bahwa tidak ada pendekatan "satu ukuran untuk semua" dalam pengembangan perangkat lunak. Panduan ini menyediakan kerangka kerja yang kuat, tetapi Anda harus selalu menyesuaikan praktik-praktik ini dengan kebutuhan spesifik proyek Anda.

Selalu pertimbangkan konteks proyek Anda:
- Ukuran dan kompleksitas aplikasi
- Keahlian tim pengembangan
- Batas waktu dan anggaran
- Persyaratan performa dan skalabilitas
- Kebutuhan bisnis jangka panjang

Dengan menerapkan prinsip-prinsip dan praktik terbaik ini secara bijaksana, Anda akan dapat membangun aplikasi Laravel yang kuat, dapat dipelihara, dan sukses yang memberikan nilai bagi pengguna dan bisnis Anda.