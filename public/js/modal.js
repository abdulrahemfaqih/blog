
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.addEventListener('click', (e) => {
    const modals = document.querySelectorAll('[id$="-modal"]');
    modals.forEach(modal => {
        if (e.target === modal) {
            const modalId = modal.getAttribute('id');
            closeModal(modalId);
        }
    });
});

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('[id$="-modal"]');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                const modalId = modal.getAttribute('id');
                closeModal(modalId);
            }
        });
    }
});
