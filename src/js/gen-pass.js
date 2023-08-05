var genPassword = (function() {
    return {
        get: function (passwordLength, hasUpperLower, hasDigit, hasSpecial, skipChars, elem, elemRepeat) {
            passwordLength = passwordLength || 6;
            hasUpperLower = typeof hasUpperLower === 'undefined' ? 1 : hasUpperLower;
            hasDigit = typeof hasDigit === 'undefined' ? 1 : hasDigit;
            hasSpecial = typeof hasSpecial === 'undefined' ? 0 : hasSpecial;
            skipChars = skipChars || '0oOIl@';

            var password = '';
            var digitChars = '1234567890';
            var lowerChars = 'abcdefghijklmnopqrstuvwxyz';
            var upperChars = lowerChars.toUpperCase();
            var specialChars = '!@#$%^&*()_+';

            // exclude some characters, by default 0 o O I l @
            lowerChars = lowerChars.replace(new RegExp('['+skipChars+']','g'),'');
            upperChars = upperChars.replace(new RegExp('['+skipChars+']','g'),'');
            digitChars = digitChars.replace(new RegExp('['+skipChars+']','g'),'');
            specialChars = specialChars.replace(new RegExp('['+skipChars+']','g'),'');

            // what if everyone is excluded
            if (!lowerChars)
            throw 'Error, all lower chars removed!';
            if (hasUpperLower && !upperChars)
            throw 'Error, all upper chars removed!';
            if (hasSpecial && !specialChars)
            throw 'Error, all special chars removed!';
            if (hasDigit && !digitChars)
            throw 'Error, all digits chars removed!';

            // not enough
            var minLength = passwordLength - 1 - hasUpperLower - hasDigit - hasSpecial;

            if (minLength<0)
            throw 'Error, increase password length or simple password strength!';

            // take one required character
            function randomChar(charSet) {
                Math.random();
                return charSet[ Math.floor(Math.random() * charSet.length) ];
            }
            password += randomChar(lowerChars);
            if (hasUpperLower) {
                password += randomChar(upperChars);
                lowerChars += upperChars;
            }
            if (hasDigit) {
                password += randomChar(digitChars);
                lowerChars += digitChars;
            }
            if (hasSpecial) {
                password += randomChar(specialChars);
                lowerChars += specialChars;
            }

            // add the remaining characters of the password
            while (passwordLength > password.length) {
                password += randomChar(lowerChars);
            }

            // mix, otherwise the first characters lUdSc
            return password.split('').sort(function(){return 0.5 - Math.random();}).join('');
        }}
    }());

export {genPassword};
