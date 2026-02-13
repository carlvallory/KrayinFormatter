<script>
    (function() {
        try {
            const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            const cookieName = 'krayin_timezone';
            
            // Check if cookie exists and matches current timezone to avoid unnecessary writes
            const match = document.cookie.match(new RegExp('(^| )' + cookieName + '=([^;]+)'));
            const currentCookie = match ? match[2] : null;

            if (currentCookie !== timezone) {
                // Set cookie for 1 year
                const date = new Date();
                date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
                document.cookie = cookieName + "=" + timezone + "; expires=" + date.toUTCString() + "; path=/";
            }
        } catch (e) {
            console.error('KrayinFormatter: Failed to detect timezone', e);
        }
    })();
</script>
