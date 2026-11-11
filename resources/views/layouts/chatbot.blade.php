{{-- Widget Chatbot AI "Bot Konselor Sebaya" — di-include dari layouts/app.blade.php --}}
<div class="ci-chat" id="ciChat" data-endpoint="{{ Route::has('chatbot.send') ? route('chatbot.send') : '' }}">

    <section class="ci-chat-panel" id="ciChatPanel" role="dialog" aria-label="Bot Konselor Sebaya" hidden>
        <header class="ci-chat-head">
            <span class="ci-avatar" aria-hidden="true">🤖</span>
            <div>
                <strong>Bot Konselor Sebaya</strong>
                <small>Teman cerita pertamamu</small>
            </div>
            <button type="button" class="btn-close btn-close-white" data-chatbot-close aria-label="Tutup chat"></button>
        </header>

        <div class="ci-chat-notice">
            Bot ini bukan pengganti psikolog atau psikiater. Dalam keadaan darurat, telepon
            <strong>119 ekstensi 8</strong> atau buka <a href="https://healing119.id" target="_blank" rel="noopener">healing119.id</a>.
        </div>

        <div class="ci-chat-log" id="ciChatLog" role="log" aria-live="polite"></div>

        <div class="ci-chat-suggest" id="ciChatSuggest">
            <button type="button">Aku lagi stres dengan tugas</button>
            <button type="button">Aku butuh teman cerita</button>
            <button type="button">Bagaimana cara buat jadwal konseling?</button>
        </div>

        <form class="ci-chat-form" id="ciChatForm" autocomplete="off">
            <label for="ciChatInput" class="visually-hidden">Tulis pesan</label>
            <textarea id="ciChatInput" rows="1" maxlength="1000" placeholder="Tulis pesanmu di sini..."></textarea>
            <button type="submit" class="ci-chat-send" id="ciChatSend" aria-label="Kirim pesan">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4 20-7z"/></svg>
            </button>
        </form>

        <footer class="ci-chat-foot">
            <a class="ci-link" href="@auth{{ route('appointments.create') }}@else{{ Route::has('login') ? route('login') : url('/') }}@endauth">Butuh sesi langsung? Buat jadwal konseling</a>
            <button type="button" id="ciChatClear">Hapus percakapan</button>
        </footer>
    </section>

    <button type="button" class="ci-chat-fab" id="ciChatFab" data-chatbot-toggle
        aria-controls="ciChatPanel" aria-expanded="false" aria-label="Buka chat Bot Konselor Sebaya">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span class="ci-chat-fab-label">Ngobrol dengan Bot</span>
    </button>
</div>
