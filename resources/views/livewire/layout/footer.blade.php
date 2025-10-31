<footer class="bg-blue-900 text-white mt-12">
  <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
    
    <!-- Logo / Marca -->
    <div>
      <x-application-logo></x-application-logo>
      <p class="text-gray-300 text-sm">
        Tu tienda confiable en papelería y productos escolares al mejor precio.
      </p>
    </div>

    <!-- Links -->
    <div>
      <h3 class="text-lg font-semibold mb-3">Enlaces</h3>
      <ul class="space-y-2 text-gray-300">
        <li><a href="{{ route('cliente.nuevo') }}" class="hover:text-pink-400">Lo nuevo</a></li>
        <li><a href="#" class="hover:text-pink-400">Catálogo PDF</a></li>
        <li><a href="#" class="hover:text-pink-400">Quiero comprar</a></li>
        <li><a href="{{ route('cliente.contacto') }}" class="hover:text-pink-400">Contacto</a></li>
      </ul>
    </div>

    <!-- Contacto -->
    <div>
      <h3 class="text-lg font-semibold mb-3">Contacto</h3>
      <ul class="space-y-2 text-gray-300">
        <li>📍 Veracruz, México</li>
        <li>📞 +52 1 241 341 1184</li>
        <li>✉️ contacto@dnovac.com</li>
      </ul>
    </div>

<!-- Redes Sociales -->
<div>
  <h3 class="text-lg font-semibold mb-3">Síguenos</h3>
  <div class="flex space-x-4">

    <!-- Facebook -->
    <a href="https://www.facebook.com/dnovacimportadorapapelera/?locale=es_LA" target="_blank" rel="noopener noreferrer" class="text-white hover:text-yellow-400" aria-label="Facebook">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2.04c-5.5 0-9.96 4.46-9.96 9.96 0 4.41 3.6 8.06 8.01 8.93v-6.31H8.9v-2.62h1.15V9.83c0-1.14.67-2.69 2.71-2.69.78 0 1.61.14 1.61.14v1.77H13.4c-.89 0-1.16.55-1.16 1.12v1.34h1.98l-.32 2.62h-1.66v6.31c4.41-.87 8.01-4.52 8.01-8.93 0-5.5-4.46-9.96-9.96-9.96z" />
      </svg>
    </a>

    <!-- Instagram -->
    <a href="https://www.instagram.com/dnovacmx/?hl=es-la" target="_blank" rel="noopener noreferrer" class="text-white hover:text-yellow-400" aria-label="Instagram">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.148 3.227-1.667 4.771-4.919 4.919-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.07-1.646-.07-4.85s.012-3.584.07-4.85c.148-3.227 1.667-4.771 4.919-4.919C8.354 2.175 8.74 2.163 12 2.163zm0 2.713c-2.43 0-2.71.01-3.66.052-2.9.13-4.13 1.36-4.26 4.26-.04 1.01-.05 1.28-.05 3.81s.01 2.8.05 3.81c.13 2.9 1.36 4.13 4.26 4.26 1.01.04 1.28.05 3.81.05s2.8-.01 3.81-.05c2.9-.13 4.13-1.36 4.26-4.26.04-1.01.05-1.28.05-3.81s-.01-2.8-.05-3.81c-.13-2.9-1.36-4.13-4.26-4.26-.95-.042-1.23-.052-3.66-.052zM12 7.16c-2.67 0-4.84 2.17-4.84 4.84s2.17 4.84 4.84 4.84 4.84-2.17 4.84-4.84-2.17-4.84-4.84-4.84zm0 7.51c-1.47 0-2.67-1.2-2.67-2.67s1.2-2.67 2.67-2.67 2.67 1.2 2.67 2.67-1.2 2.67-2.67 2.67zm4.18-7.73c0 .61-.49 1.1-1.1 1.1s-1.1-.49-1.1-1.1.49-1.1 1.1-1.1 1.1.49 1.1 1.1z"/>
      </svg>
    </a>

    <!-- TikTok -->
    <a href="https://www.tiktok.com/@dnovacmx/video/7526795833363254546" target="_blank" rel="noopener noreferrer" class="text-white hover:text-yellow-400" aria-label="TikTok">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-2.1.04-4.14-.6-5.73-2.04-2.83-2.56-3.8-6.3-2.63-9.76 1.4-4.04 4.67-6.8 8.98-7.49 1.08-.18 2.17-.16 3.23.05.02-1.3.01-2.6.01-3.89.01-.16.01-.32.01-.48zM12 4.71c-1.31 0-2.62 0-3.93 0-.01 1.23-.08 2.45-.17 3.67-.09 1.17-.26 2.34-.51 3.49-.43 1.95-.21 4.11.8 5.86 1.43 2.48 4.6 3.49 7.21 2.22 1.2-.57 2.08-1.56 2.59-2.79.51-1.23.6-2.58.35-3.86-.23-1.18-.75-2.31-1.41-3.32-.67-1.02-1.52-1.9-2.54-2.58-.9-.6-1.92-.98-3-1.15-1.09-.17-2.19-.15-3.28.02.01-1.3.01-2.59.01-3.89.1-.01.19-.01.28-.01 1.23 0 2.47 0 3.71 0v.01z"/>
      </svg>
    </a>

    <!-- YouTube -->
    <a href="https://www.youtube.com/@DNOVAC-MX" target="_blank" rel="noopener noreferrer" class="text-white hover:text-yellow-400" aria-label="YouTube">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.376.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.376-.505a3.017 3.017 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
      </svg>
    </a>

  </div>
</div>

  <!-- Footer Bottom -->
  <div class="text-gray-300 text-sm py-4 tems-center justify-center  text-center">
    © 2025 D'novac - Todos los derechos reservados.
  </div>
</footer>
