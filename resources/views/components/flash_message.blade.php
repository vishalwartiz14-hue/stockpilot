@if(session('success'))
    <div id="flashMessage"
         class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3 transition-opacity duration-500">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            let message = document.getElementById('flashMessage');

            if (message) {
                message.style.opacity = '0';

                setTimeout(() => {
                    message.remove();
                }, 200);
            }
        }, 5000);
    </script>
@endif