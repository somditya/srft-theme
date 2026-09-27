document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('srfti-cookie-banner');
    const floatingBtn = document.getElementById('cookie-floating-settings');
    const modal = document.getElementById('srfti-cookie-modal');
    
    // Checkboxes matching the new layout
    const sessionCheckbox = document.getElementById('session-cookies-toggle');
    const persistentCheckbox = document.getElementById('persistent-cookies-toggle');
    const optionalCheckbox = document.getElementById('optional-cookies-toggle');

    // Accessibility Focus Variables
    let lastFocusedElement;
    const focusableElementsString = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]';

    // 1. Check existing consent
    const consentState = localStorage.getItem('srfti_cookie_consent');
    if (!consentState) {
        if (banner) banner.removeAttribute('hidden');
        if (floatingBtn) floatingBtn.setAttribute('hidden', '');
    } else {
        if (banner) banner.setAttribute('hidden', '');
        if (floatingBtn) floatingBtn.removeAttribute('hidden');
        const parsed = JSON.parse(consentState);
        applyConsent(parsed);
        
        // Load saved states into toggles
        if (sessionCheckbox) sessionCheckbox.checked = parsed.session !== false; 
        if (persistentCheckbox) persistentCheckbox.checked = parsed.persistent !== false;
        if (optionalCheckbox) optionalCheckbox.checked = parsed.optional;
    }

    // 2. ACCESSIBLE MODAL CONTROLS
    function openModal(triggerElement) {
        if (!modal) return;
        lastFocusedElement = triggerElement; 
        modal.removeAttribute('hidden');
        
        const closeBtn = document.getElementById('close-cookie-modal');
        if (closeBtn) closeBtn.focus();
        else modal.focus();

        document.addEventListener('keydown', trapTabKey);
        document.addEventListener('keydown', handleEscape);
    }

    function closeModalLogic() {
        if (!modal) return;
        modal.setAttribute('hidden', '');
        if (lastFocusedElement) lastFocusedElement.focus();
        document.removeEventListener('keydown', trapTabKey);
        document.removeEventListener('keydown', handleEscape);
    }

    function trapTabKey(e) {
        if (e.key !== 'Tab') return;
        const focusableElements = modal.querySelectorAll(focusableElementsString);
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) { 
            if (document.activeElement === firstElement) {
                lastElement.focus();
                e.preventDefault();
            }
        } else { 
            if (document.activeElement === lastElement) {
                firstElement.focus();
                e.preventDefault();
            }
        }
    }

    function handleEscape(e) {
        if (e.key === 'Escape') closeModalLogic();
    }

    // 3. EVENT DELEGATION
    document.body.addEventListener('click', (e) => {
        
        // Open Modal
        const openTrigger = e.target.closest('#cookie-customize-btn') || e.target.closest('#cookie-floating-settings');
        if (openTrigger) {
            e.preventDefault();
            openModal(openTrigger);
        }

        // Close Modal via X button
        if (e.target.closest('#close-cookie-modal')) {
            e.preventDefault();
            closeModalLogic();
        }

        // Accept All
        if (e.target.closest('#cookie-accept-btn') || e.target.closest('#modal-accept-btn')) {
            e.preventDefault();
            saveConsent({ session: true, persistent: true, optional: true });
            closeModalLogic();
        }

        // Deny All
        if (e.target.closest('#cookie-reject-btn') || e.target.closest('#modal-reject-btn')) {
            e.preventDefault();
            saveConsent({ session: false, persistent: false, optional: false });
            closeModalLogic();
        }

        // Save Preferences from Modal
        if (e.target.closest('#save-cookie-prefs-btn')) {
            e.preventDefault();
            saveConsent({
                session: sessionCheckbox ? sessionCheckbox.checked : true,
                persistent: persistentCheckbox ? persistentCheckbox.checked : true,
                optional: optionalCheckbox ? optionalCheckbox.checked : false
            });
            closeModalLogic();
        }
    });

    // 4. CORE LOGIC
    function saveConsent(prefs) {
        localStorage.setItem('srfti_cookie_consent', JSON.stringify(prefs));
        if (banner) banner.setAttribute('hidden', '');
        if (floatingBtn) floatingBtn.removeAttribute('hidden');
        applyConsent(prefs);
    }

   function applyConsent(prefs) {
        // Fire custom event for any other non-Google scripts
        const event = new CustomEvent('srfti_consent_updated', { detail: prefs });
        document.dispatchEvent(event);

        // Define gtag if it isn't ready yet
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}

        if (prefs.optional) {
            console.log('Optional cookies allowed - Activating Site Kit Analytics.');
            
            // Send the 'granted' signal to Google Consent Mode
            gtag('consent', 'update', {
                'analytics_storage': 'granted',
                'ad_storage': 'granted',
                'ad_user_data': 'granted',
                'ad_personalization': 'granted'
            });
        } else {
            console.log('Optional cookies denied - Site Kit Analytics remains paused.');
            
            // Ensure it stays denied if they change their mind and turn it off
            gtag('consent', 'update', {
                'analytics_storage': 'denied',
                'ad_storage': 'denied',
                'ad_user_data': 'denied',
                'ad_personalization': 'denied'
            });
        }
    }
}); 