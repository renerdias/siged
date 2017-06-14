/**
 * Some Alpha Regex helpers.
 * https://github.com/chriso/validator.js/blob/master/src/lib/alpha.js
 */
//'./alpha_helper';
export const alpha = {
    pt: /^[A-ZÃÁÀÂÇÉÊÍÕÓÔÚÜ]*$/i
};

export const alphaSpaces = {
    pt: /^[A-ZÃÁÀÂÇÉÊÍÕÓÔÚÜ\s]*$/i
};

export const alphanumeric = {
    pt: /^[0-9A-ZÃÁÀÂÇÉÊÍÕÓÔÚÜ]*$/i
};

export const alphaDash = {
    pt: /^[0-9A-ZÃÁÀÂÇÉÊÍÕÓÔÚÜ_-]*$/i
};

/*
import {
    alpha
} from './alpha_helper';
*/
export default (value, [locale] = [null]) => {
    // Match at least one locale.
    if (!locale) {
        return Object.keys(alpha)
            .some(loc => alpha[loc].test(value));
    }

    return (alpha[locale] || alpha.en)
        .test(value);
};
