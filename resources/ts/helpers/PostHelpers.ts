"use strict";

function getHashFromUrl(url: string): string | null {
    const splitUrl = url.split('-');
    return splitUrl.length > 0 ? splitUrl[splitUrl.length - 1] : null;
}

export {getHashFromUrl};