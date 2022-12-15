import { Injectable } from '@angular/core';
import { IUser } from '../Interfaces/User/IUser';

@Injectable({
    providedIn: 'root'
})
export class UserData {
    static user: IUser = {};

    public static setUser(user) {
        localStorage.setItem('user', JSON.stringify(user));

        UserData.user = user;
    }

    public static getUser(): IUser {
        if (!UserData.user && !UserData.user.id) {
            UserData.user = JSON.parse(localStorage.getItem('user'));
        }

        return UserData.user as IUser;
    }
}
