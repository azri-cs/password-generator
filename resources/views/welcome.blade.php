<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Secure Advanced Password Generator</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        <div class="flex lg:justify-center lg:col-start-2">
            <svg class="h-14 w-auto text-gray-500 lg:h-20 lock-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>

            <svg class="h-14 w-auto text-gray-500 lg:h-20 unlock-icon hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </div>
    </header>

    <main class="my-6">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h1 class="text-2xl font-bold mb-4">Secure Advanced Password Generator</h1>
            <div class="mb-4">
                <label class="block mb-2">
                    <input type="checkbox" id="lowercase" class="mr-2" checked>
                    Lowercase Letters
                </label>
                <label class="block mb-2">
                    <input type="checkbox" id="uppercase" class="mr-2" checked>
                    Uppercase Letters
                </label>
                <label class="block mb-2">
                    <input type="checkbox" id="numbers" class="mr-2" checked>
                    Numbers
                </label>
                <label class="block mb-2">
                    <input type="checkbox" id="symbols" class="mr-2" checked>
                    Symbols
                </label>
                <label class="block mb-2">
                    <input type="checkbox" id="unique" class="mr-2">
                    Each character must occur at most once
                </label>
                <label class="block mb-2">
                    <input type="checkbox" id="excludeLookalike" class="mr-2">
                    Exclude look-alike characters
                </label>
            </div>
            <div class="mb-4">
                <label class="block mb-2">
                    Password Length:
                    <input type="number" id="passwordLength" min="4" max="50" value="12" class="w-full p-2 border rounded">
                </label>
            </div>
            <button id="generate" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Generate Password</button>
            <div class="relative mt-4">
                <input type="text" id="password" readonly class="w-full p-2 pr-10 border rounded bg-gray-100" placeholder="Your password will appear here">
                <button id="copy" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                    <svg class="h-6 w-6 text-gray-500 hover:text-blue-500 copy-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-medium text-green-500 copy-text hidden">Copied!</span>
                </button>
            </div>
        </div>
    </main>

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Built with TailwindCSS & JavaScript
    </footer>

    <script>
        const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
        const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const numberChars = '0123456789';
        const symbolChars = '!#$%&()*+@^';
        const lookalikeChars = 'Il1O0';

        function generateSecurePassword(passwordLength, chars) {
            const array = new Uint32Array(passwordLength);
            crypto.getRandomValues(array);

            let password = '';
            for (let i = 0; i < passwordLength; i++) {
                password += chars[array[i] % chars.length];
            }
            return password;
        }

        function generatePassword() {
            const lowercase = document.getElementById('lowercase').checked;
            const uppercase = document.getElementById('uppercase').checked;
            const numbers = document.getElementById('numbers').checked;
            const symbols = document.getElementById('symbols').checked;
            const unique = document.getElementById('unique').checked;
            const excludeLookalike = document.getElementById('excludeLookalike').checked;
            const passwordLength = parseInt(document.getElementById('passwordLength').value);

            let chars = '';
            if (lowercase) chars += lowercaseChars;
            if (uppercase) chars += uppercaseChars;
            if (numbers) chars += numberChars;
            if (symbols) chars += symbolChars;

            if (excludeLookalike) {
                chars = chars.split('').filter(char => !lookalikeChars.includes(char)).join('');
            }

            if (chars === '') {
                alert('Please select at least one character type.');
                return;
            }

            if (unique && passwordLength > chars.length) {
                alert(`Cannot generate a password of length ${passwordLength} with unique characters. Maximum length with current settings is ${chars.length}.`);
                return;
            }

            let password = generateSecurePassword(passwordLength, chars);

            if (unique) {
                // Ensure uniqueness
                const uniqueChars = new Set(password);
                while (uniqueChars.size < passwordLength) {
                    const newChar = generateSecurePassword(1, chars);
                    if (!uniqueChars.has(newChar)) {
                        uniqueChars.add(newChar);
                    }
                }
                password = Array.from(uniqueChars).join('');
            }

            document.getElementById('password').value = password;
        }

        async function copyPassword() {
            const passwordField = document.getElementById('password');
            const copyIcon = document.querySelector('.copy-icon');
            const copyText = document.querySelector('.copy-text');

            if (passwordField.value.trim() === '') {
                alert('Please generate a password first.');
                return;
            }

            try {
                await navigator.clipboard.writeText(passwordField.value);
                copyIcon.classList.add('hidden');
                copyText.classList.remove('hidden');
                setTimeout(() => {
                    copyIcon.classList.remove('hidden');
                    copyText.classList.add('hidden');
                }, 2000);
            } catch (err) {
                console.error('Failed to copy: ', err);
                alert('Failed to copy password. Please try again.');
            }
        }

        document.getElementById('generate').addEventListener('click', generatePassword);
        document.getElementById('copy').addEventListener('click', copyPassword);

        // Lock/Unlock icon transition
        const lockIcon = document.querySelector('.lock-icon');
        const unlockIcon = document.querySelector('.unlock-icon');

        lockIcon.addEventListener('mouseenter', () => {
            lockIcon.classList.add('hidden');
            unlockIcon.classList.remove('hidden');
        });

        unlockIcon.addEventListener('mouseleave', () => {
            unlockIcon.classList.add('hidden');
            lockIcon.classList.remove('hidden');
        });
    </script>
    </body>
</html>
