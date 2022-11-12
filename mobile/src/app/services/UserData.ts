import { Injectable } from '@angular/core';

@Injectable({
    providedIn: 'root'
})
export class UserData {
    static user: any = {};

    public static setUser(user) {
        UserData.user = JSON.stringify(user);
        localStorage.setItem('user', UserData.user);
    }

    public static getUser(): any {
        if (!UserData.user.id) {
            UserData.user = localStorage.getItem('user');
        }

        return JSON.parse(UserData.user);
    }
}
