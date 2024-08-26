const CACHE_NAME = 'karyawan-dashboard';
const urlsToCache = [
    '/',
    'index',
    'assets/css/style.css',
    'assets/js/script.js',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css',
    'https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css',
    'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css',
    'https://kit.fontawesome.com/ae360af17e.js',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js',
    'https://code.jquery.com/jquery-3.7.1.js',
    'https://cdn.datatables.net/2.0.8/js/dataTables.js'
];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                if (response) {
                    return response;
                }
                return fetch(event.request);
            })
    );
});
