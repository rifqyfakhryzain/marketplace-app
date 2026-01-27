document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('chat-button');
    const popup = document.getElementById('chat-popup');

    if (!btn || !popup) return;

    btn.addEventListener('click', () => {
        popup.classList.toggle('hidden');
    });

    popup.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.classList.add('hidden');
        }
    });
});
