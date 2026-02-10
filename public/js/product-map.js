window.addEventListener("load", () => {
    const mapEl = document.getElementById("map");
    if (!mapEl) return;

    const lat = Number(mapEl.dataset.lat);
    const lng = Number(mapEl.dataset.lng);

    // ❌ JIKA BELUM DISET → JANGAN INIT LEAFLET
    if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
        mapEl.innerHTML = `
            <div style="text-align:center">
                <strong>📍 Lokasi belum tersedia</strong><br>
                <span style="font-size:12px;color:#888">
                    Penjual belum mengatur lokasi
                </span>
            </div>
        `;
        return;
    }

    // ✅ BARU INIT MAP JIKA VALID
    const map = L.map(mapEl, {
        zoomControl: true,
        scrollWheelZoom: false,
    }).setView([lat, lng], 15);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    // 🔵 HANYA RADIUS (TANPA PIN)
    const circle = L.circle([lat, lng], {
        radius: 500,
        color: "#2563eb",
        fillColor: "#3b82f6",
        fillOpacity: 0.25,
        weight: 2,
    }).addTo(map);

    map.fitBounds(circle.getBounds(), {
        padding: [20, 20],
    });

    // FIX ukuran
    setTimeout(() => map.invalidateSize(), 400);
    setTimeout(() => map.invalidateSize(true), 900);
});
