<img id="application-logo" src="{{ asset('images/logo (normal).svg') }}" alt="Application Logo" {{ $attributes }}>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logo = document.getElementById('application-logo');
    
    function updateLogo() {
        const isDark = document.documentElement.classList.contains('dark');
        if (isDark) {
            logo.src = "{{ asset('images/logo (night).svg') }}";
        } else {
            logo.src = "{{ asset('images/logo (normal).svg') }}";
        }
    }
    
    // Update logo on page load
    updateLogo();
    
    // Update logo when theme changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                updateLogo();
            }
        });
    });
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
});
</script>
