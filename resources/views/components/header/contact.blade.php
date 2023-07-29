<div class="md:w-1/2 w-full flex gap-6 justify-center md:justify-start">
<p>
        <!-- Lien pour le téléphone -->
        <a href="tel:{{ env('TEL_ADMIN') }}" class="underline hover:text-primary transition-colors duration-100 ease"
        aria-label="numéro du restaurant"
        >{{ env('TEL_ADMIN') }}</a>
    </p>
    <p>
        <!-- Lien pour l'e-mail -->
        <a href="mailto:{{ env('MAIL_ADMIN') }}" class="underline hover:text-primary transition-colors duration-100 ease"
        aria-label="adresse mail du restaurant"
        >{{ env('MAIL_ADMIN') }}</a>
    </p>
</div>