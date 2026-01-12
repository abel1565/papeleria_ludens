import './bootstrap';
// resources/js/app.js
import './../../vendor/power-components/livewire-powergrid/dist/powergrid';

import { initFlowbite } from 'flowbite';

// carga inicial
document.addEventListener('DOMContentLoaded', () => {
    initFlowbite();
});

// cuando navegas entre páginas (CLAVE)
document.addEventListener('inertia:navigate', () => {
    initFlowbite();
});

document.addEventListener('livewire:navigated', () => {
    initFlowbite();
});
