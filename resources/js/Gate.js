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
        this.user.permissions.forEach((item) => {
            if (item.name === permission) {
                return true;
            }
        });
        return false;        
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

