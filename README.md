# Secure Advanced Password Generator

## Overview

This project is a web-based, secure, and advanced password generator. It allows users to create strong, customizable passwords with various options for enhanced security and usability. The generator uses cryptographically secure random number generation to ensure the highest level of security in password creation.

## Features

- Customizable character sets:
    - Lowercase letters
    - Uppercase letters
    - Numbers
    - Symbols
- Option to ensure each character occurs at most once
- Option to exclude look-alike characters (e.g., 'Il1O0')
- Adjustable password length
- Cryptographically secure random number generation
- One-click copy to clipboard functionality
- Responsive design for desktop and mobile use

## Technology Stack

- HTML5
- JavaScript (ES6+)
- Tailwind CSS (via CDN)
- Web Crypto API

## How to Use

1. Clone this repository or download the HTML file.
2. Open the HTML file in a modern web browser.
3. Customize your password requirements:
    - Check/uncheck the desired character types
    - Toggle the "Each character must occur at most once" option if needed
    - Toggle the "Exclude look-alike characters" option if desired
    - Set the password length using the number input
4. Click the "Generate Password" button.
5. Your generated password will appear in the text field.
6. Click the copy icon next to the password to copy it to your clipboard.

## Security Features

This password generator uses the Web Crypto API's `crypto.getRandomValues()` method to generate cryptographically strong random values. This approach is significantly more secure than using `Math.random()` and is suitable for generating passwords for security-sensitive applications.

## Customization

You can easily customize the character sets used for password generation by modifying the following constants in the JavaScript code:

```javascript
const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const numberChars = '0123456789';
const symbolChars = '!#$%&()*+@^';
const lookalikeChars = 'Il1O0';
```

## Browser Compatibility

This password generator should work in all modern browsers that support ES6+ and the Web Crypto API. This includes:

- Chrome 43+
- Firefox 36+
- Safari 10.1+
- Edge 12+
- Opera 30+

## Contributing

Currently not open for contributions.

## License

This project is open source and available under the [MIT License](LICENSE).

## Disclaimer

While this password generator uses cryptographically secure random number generation, the security of your passwords also depends on how you use and store them. Always use unique passwords for different accounts and consider using a password manager for added security.
