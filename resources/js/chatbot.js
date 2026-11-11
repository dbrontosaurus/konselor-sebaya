/**
 * Widget Chatbot AI "Bot Konselor Sebaya".
 * Markup ada di resources/views/layouts/chatbot.blade.php.
 * Endpoint dibaca dari atribut data-endpoint (route chatbot.send).
 */
const root = document.getElementById('ciChat');

if (root) {
    const panel = document.getElementById('ciChatPanel');
    const fab = document.getElementById('ciChatFab');
    const log = document.getElementById('ciChatLog');
    const form = document.getElementById('ciChatForm');
    const input = document.getElementById('ciChatInput');
    const sendBtn = document.getElementById('ciChatSend');
    const suggest = document.getElementById('ciChatSuggest');
    const clearBtn = document.getElementById('ciChatClear');

    const endpoint = root.dataset.endpoint || '';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const STORE_KEY = 'console-ing-chat';
    const MAX_LEN = 1000;
    const GREETING =
        'Halo, aku Bot Konselor Sebaya. Kamu bisa cerita apa saja yang sedang kamu rasakan. ' +
        'Kalau kamu butuh bicara langsung dengan konselor, aku bisa bantu arahkan ke jadwal konseling.';

    let history = [];
    let pending = false;

    /* ---------- Penyimpanan (hanya selama tab terbuka) ---------- */
    const load = () => {
        try {
            const raw = sessionStorage.getItem(STORE_KEY);
            history = raw ? JSON.parse(raw) : [];
        } catch (e) {
            history = [];
        }
    };
    const save = () => {
        try {
            sessionStorage.setItem(STORE_KEY, JSON.stringify(history.slice(-30)));
        } catch (e) { /* abaikan jika storage tidak tersedia */ }
    };

    /* ---------- Render ---------- */
    const scrollDown = () => { log.scrollTop = log.scrollHeight; };

    const addBubble = (role, text, isError = false) => {
        const el = document.createElement('div');
        el.className = 'ci-msg ' + (role === 'user' ? 'ci-msg-user' : 'ci-msg-bot') + (isError ? ' ci-msg-error' : '');
        el.textContent = text; // textContent: aman dari XSS
        log.appendChild(el);
        scrollDown();
        return el;
    };

    const showTyping = () => {
        const el = document.createElement('div');
        el.className = 'ci-msg ci-msg-bot ci-typing';
        el.setAttribute('aria-label', 'Bot sedang mengetik');
        el.innerHTML = '<span></span><span></span><span></span>';
        log.appendChild(el);
        scrollDown();
        return el;
    };

    const renderAll = () => {
        log.innerHTML = '';
        addBubble('bot', GREETING);
        history.forEach((m) => addBubble(m.role, m.text));
        suggest.hidden = history.length > 0;
    };

    /* ---------- Buka / tutup ---------- */
    const setOpen = (open) => {
        panel.hidden = !open;
        root.classList.toggle('is-open', open);
        fab.setAttribute('aria-expanded', String(open));
        fab.setAttribute('aria-label', open ? 'Tutup chat Bot Konselor Sebaya' : 'Buka chat Bot Konselor Sebaya');
        if (open) {
            scrollDown();
            setTimeout(() => input.focus(), 50);
        }
    };

    document.querySelectorAll('[data-chatbot-toggle]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            setOpen(panel.hidden);
        });
    });
    document.querySelectorAll('[data-chatbot-close]').forEach((btn) => {
        btn.addEventListener('click', () => { setOpen(false); fab.focus(); });
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !panel.hidden) { setOpen(false); fab.focus(); }
    });

    /* ---------- Kirim pesan ---------- */
    const send = async (text) => {
        text = text.trim().slice(0, MAX_LEN);
        if (!text || pending) return;

        pending = true;
        sendBtn.disabled = true;
        suggest.hidden = true;

        addBubble('user', text);
        const prior = history.slice(-8);
        history.push({ role: 'user', text });
        save();

        input.value = '';
        input.style.height = 'auto';

        if (!endpoint) {
            addBubble('bot', 'Chatbot belum terhubung ke server. Hubungi pengelola Console-Ing.', true);
            pending = false;
            sendBtn.disabled = false;
            return;
        }

        const typing = showTyping();
        try {
            const res = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ message: text, history: prior }),
            });

            let data = {};
            try { data = await res.json(); } catch (e) { /* respons bukan JSON */ }
            typing.remove();

            if (res.ok && data.reply) {
                addBubble('bot', data.reply);
                history.push({ role: 'bot', text: data.reply });
                save();
            } else if (res.status === 429) {
                addBubble('bot', 'Kamu mengirim terlalu cepat. Tunggu sebentar, lalu coba lagi.', true);
            } else if (res.status === 419) {
                addBubble('bot', 'Sesi halaman sudah berakhir. Muat ulang halaman, lalu kirim lagi.', true);
            } else {
                addBubble('bot', data.reply || 'Bot sedang tidak bisa menjawab. Coba lagi sebentar.', true);
            }
        } catch (err) {
            typing.remove();
            addBubble('bot', 'Koneksi terputus. Periksa internetmu, lalu coba lagi.', true);
        } finally {
            pending = false;
            sendBtn.disabled = false;
            input.focus();
        }
    };

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        send(input.value);
    });
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            send(input.value);
        }
    });
    input.addEventListener('input', () => {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 110) + 'px';
    });
    suggest.querySelectorAll('button').forEach((btn) => {
        btn.addEventListener('click', () => send(btn.textContent));
    });
    clearBtn.addEventListener('click', () => {
        history = [];
        save();
        renderAll();
    });

    load();
    renderAll();
}
