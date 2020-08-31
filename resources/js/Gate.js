export default class Gate{

    constructor(user){
        this.user = user;
    }

    isRoot () {
        return this.user.is_root == 1;
    }

    canPermission (permission) {
        if (this.user.is_root) {
            return true;
        }

        let check = false;
        this.user.permissions.forEach((item) => {
            if (item.name == permission) {
                check = true;
            }
        });
        return check;
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

