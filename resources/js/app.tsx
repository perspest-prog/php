import './bootstrap';
import { createRoot } from 'react-dom/client';
import { StrictMode } from 'react';
import NotificationHandler from './NotificationHandler';

window.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('#notifications')

    if (!container) {
        return
    }

    const root = createRoot(container)

    root.render(
        <StrictMode>
            <NotificationHandler />
        </StrictMode>
    )
})