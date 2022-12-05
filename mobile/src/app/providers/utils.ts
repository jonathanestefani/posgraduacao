import { Injectable } from '@angular/core';

@Injectable({
    providedIn: 'root'
})
export class Utils {
    public constructor() { }

    public buildQuery(obj: any, numPrefix?: any, tempkey?: any) {
        let outputString: any = [];

        obj = !obj ? {} : obj;

        Object.keys(obj).forEach((val) => {
            let key = val;

            if (numPrefix && !isNaN(key as any)) {
                key = numPrefix + key;
            }

            key = encodeURIComponent(key.replace(/[!'()*]/g, escape));

            if (tempkey) {
                key = tempkey + '[' + key + ']';
            }

            if (typeof obj[val] === 'object') {
                const query = this.buildQuery(obj[val], null, key);

                if (query) {
                    outputString.push(query);
                }
            } else {
                const value = encodeURIComponent(obj[val] + ''.replace(/[!'()*]/g, escape));

                if (key) {
                    outputString.push(key + '=' + value);
                }
            }
        });

        return outputString.join('&');
    }

    public convertDateToBrazilian(date: string) {
        try {
            return (date !== '' && date !== undefined ? date.split('-')[2] + '/' + date.split('-')[1] + '/' + date.split('-')[0] : '');
        } catch (error) {
            return '';
        }
    }

    public convertDateToAmerican(date: string) {
        try {
            return (date !== '' && date !== undefined ? date.split('/')[2] + '-' + date.split('/')[1] + '-' + date.split('/')[0] : '');
        } catch (error) {
            return '';
        }
    }

    public removeCaracters(str: string) {
        return String(str).replace(/[().-\/\\ ]/ig, '');
    }
}
