window.addEventListener("load", () => {
    const mapEl = document.getElementById("map");
    if (!mapEl) return;

    const lat = Number(mapEl.dataset.lat);
    const lng = Number(mapEl.dataset.lng);

    if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
        mapEl.innerHTML =
            "<p style='text-align:center;padding:1rem;color:#888'>Lokasi penjual belum diset</p>";
        return;
    }

    const map = L.map(mapEl, {
        zoomControl: true,
        scrollWheelZoom: false,
        dragging: true,
    }).setView([lat, lng], 15);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    // 🔵 RADIUS SAJA (TANPA MARKER)
    const circle = L.circle([lat, lng], {
        radius: 500, // meter
        color: "#2563eb",
        fillColor: "#3b82f6",
        fillOpacity: 0.25,
        weight: 2,
    }).addTo(map);

    // Fokus ke radius
    map.fitBounds(circle.getBounds(), {
        padding: [20, 20],
    });

    // 🔥 FIX ukuran map di halaman berat
    setTimeout(() => map.invalidateSize(), 400);
    setTimeout(() => map.invalidateSize(true), 900);
});
