self.addEventListener('install', (event) => {
  self.skipWaiting();
  event.waitUntil(
    caches.open('shane-logsdon-io-static-v23').then((cache) => {
      return cache.addAll(["/"]).catch(() => {});
    })
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys
          .filter((key) => key !== 'shane-logsdon-io-static-v23')
          .map((key) => caches.delete(key))
      )
    ).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  // Let the browser handle cross-origin requests normally.
  const url = new URL(event.request.url);
  if (url.origin !== self.location.origin) { return; }

  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request, { mode: "same-origin" });
    })
    .catch(() => {})
  );
});
