export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return true;
        // return this.user.role_users.type.name === 'Admin';
    }

    isUser(){
        return true;
        // return this.user.role_users.type.name === 'User';
    }

    isAdminOrUser(){
        if(this.user.role_users.type.name === 'User' || this.user.role_users.type.name === 'Admin'){
            return true;
        }
    }
}

