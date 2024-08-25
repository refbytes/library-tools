import './bootstrap';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Alpine.directive('clipboard', (el) => {
    el.addEventListener('click', (e) => {
        navigator.clipboard.writeText(e.target.attributes['data-target'].value);
        e.preventDefault();
    })
})

Livewire.start()
